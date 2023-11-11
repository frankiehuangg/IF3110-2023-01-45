<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

class LoginController extends BaseController {
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
        if (!isset($_POST['username'])) {
            throw new BadRequestException('Username not set!');
        }

        if (!isset($_POST['password'])) {
            throw new BadRequestException('Password not set!');
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $post = $this->service->login($username, $password);

        $response = new BaseResponse(true, $post, "Successfully logged in", 200);

        return $response->toJSON();
    }
}

?>