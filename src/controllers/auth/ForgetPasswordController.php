<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . "/src/services/AuthService.php";

class ForgetPasswordController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        $this->service = $service;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                AuthService::getInstance()
            );
        }

        return self::$instance;
    }

    public function patch($url_params) {
        $_PATCH = [];
        parse_str(file_get_contents('php://input'), $_PATCH);

        if (!isset($_PATCH["email"])){ 
            throw new BadRequestException('Email not set!');   
        }

        if (!isset($_PATCH['password']) || !isset($_PATCH['confirm_password'])) {
            throw new BadRequestException('Password not set!');
        }

        $email = $_PATCH['email'];
        $password = $_PATCH['password'];
        $confirm_password = $_PATCH['confirm_password'];

        $put = $this->service->resetPassword($email, $password, $confirm_password);

        $response = new BaseResponse(true, $put, "Successfully reset password", 200);

        return $response->toJSON();
    }
}

?>