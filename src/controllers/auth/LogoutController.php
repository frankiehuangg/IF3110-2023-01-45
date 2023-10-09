<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

class LogoutController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                AuthService::getInstance()
            );
        }

        return self::$instance;
    }

    public function post($url_params) {
        $this->service->logout();

        $response = new BaseResponse(true, null, "Successfully logged out", 200);

        return $response->toJSON();
    }
}

?>