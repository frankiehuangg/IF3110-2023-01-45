<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

class RegisterController extends BaseController {
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
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $post = $this->service->register($username, $email, $password, $confirm_password);

        $response = new BaseResponse(true, $post, "Successfully registered", 200);

        return $response->toJSON();
    }
}

?>