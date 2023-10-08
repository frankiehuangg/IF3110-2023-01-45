<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserReportService.php';

class UserReportController extends BaseController {
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
    
    public function patch($url_params) {
        $_PATCH = [];
        parse_str(file_get_contents('php://input'), $_PATCH);
        $report_id = $_PATCH['report_id'];

        $put = $this->service->updateStatus($report_id);

        $response = new BaseResponse(true, $put, "Successfully updated status", 200);

        return $response->toJSON();
    }
}