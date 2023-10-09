<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserReportService.php';

class DeleteUserReportController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UserReportService::getInstance()
            );
        }

        return self::$instance;
    }

    public function delete($url_params) {
        $report_id = $_GET['report_id'];

        $delete = $this->service->deleteReport($report_id);

        $response = new BaseResponse(true, $delete, "Successfully deleted report", 200);

        return $response->toJSON();
    }
}

?>