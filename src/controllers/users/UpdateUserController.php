<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';

class UpdateUserController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UserService::getInstance()
            );
        }

        return self::$instance;
    }

    public function patch($urlParams) {
        $user_id = $urlParams[0];
        parse_str(file_get_contents('php://input'), $_PATCH);

        $username = $_PATCH['username'] ?? null;
        $password = isset($_PATCH['password']) ? password_hash($_PATCH['password'], PASSWORD_DEFAULT) : null;
        $email = $_PATCH['email'] ?? null;
        $description = $_PATCH['description'] ?? null;
        $display_name = $_PATCH['display_name'] ?? null;
        $birthday_date = $_PATCH['birthday_date'] ?? null;
        $birthday_month = $_PATCH['birthday_month'] ?? null;
        $birthday_year = $_PATCH['birthday_year'] ?? null;
        $profile_picture_path = $_PATCH['profile_picture_path'] ?? null;

        $user = $this->service->updateUser($user_id, $username, $password, $email, $description, $display_name, $birthday_date, $birthday_month, $birthday_year, $profile_picture_path);

        $response = new BaseResponse(true, $user, 'User updated successfully', 200);

        return $response->toJSON();
    }
};

?>