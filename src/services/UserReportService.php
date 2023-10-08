<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/UserReportRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/UserReportModel.php';
require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';

class UserReportService extends BaseService {
    protected static $instance;
    private $user_report_repository;

    private function __construct($user_report_repository) {
        $this->user_report_repository = $user_report_repository;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UserReportRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getAll() {
        $find_sql = $this->user_report_repository->getAll();

        $reports = [];
        foreach ($find_sql as $report_sql) {
            $report = new UserReportModel();
            $reports[] = $report->constructFromArray($report_sql);
        }

        return $reports;
    }

    public function addNewReport($user_id, $reporter, $description) {
        $report = new UserReportModel();
        $report->set('user_id', $user_id);
        $report->set('reporter', $reporter);
        $report->set('description', $description);

        $add_sql = $this->user_report_repository->insert($report, array(
            'user_id'       => PDO::PARAM_INT,
            'reporter'      => PDO::PARAM_INT,
            'description'   => PDO::PARAM_STR
        ));

        $get = $this->user_report_repository->getReportId($add_sql);
        $result_report = new UserReportModel();
        $result_report->constructFromArray($get);

        return  $result_report;
    }

    public function updateStatus($report_id, $status) {
        $report = $this->user_report_repository->findReportById($report_id);

        if (!isset($report)) {
            throw new BadRequestException('Report not found');
        }

        $report->set('status', $status);

        $report_model = $this->user_report_repository->update($report, array(
            'status' => PDO::PARAM_STR
        ));

        $report = $this->user_report_repository->getReportById($report_id);
        return $report;
    }

    public function deleteReport($report_id) {
        $report = new UserReportModel();
        $report->set('report_id', $report_id);

        return $this->user_report_repository->delete($report);
    }
}

?>