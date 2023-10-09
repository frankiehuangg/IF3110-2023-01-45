<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserReportService.php';

class GetUserReportController extends BaseController {
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
    
    public function get($url_params) {
        $page = $_GET['page'];
        $amount = 10;

        $res = $this->service->getPagination($page, $amount);

        $response = new BaseResponse(true, $res, "Successfully retrieved reports", 200);
    
        return $response->toJSON();
    }
}