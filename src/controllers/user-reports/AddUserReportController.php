<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserReportService.php';

class AddUserReportController extends BaseController {
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

    public function post($url_params) {
        $user_id = $_POST['user_id'];
        $reporter = $_POST['reporter'];
        $description = $_POST['description'];

        $post = $this->service->addNewReport($user_id, $reporter, $description);

        $response = new BaseResponse(true, $post, "Successfully reported user", 200);

        return $response->toJSON();
    }
}