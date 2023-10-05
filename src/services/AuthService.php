<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/UserRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/UserModel.php';
require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';

class AuthService extends BaseService {
    protected static $instance;
    private $user_service;

    private function __construct() {
        $this->pengguna_service = UserService::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isAdmin() {
        return $this->isLogin() && (isset($_SESSION['is_admin'])) && ($_SESSION['is_admin'] === 1);
    }

    public function isLogin() {
        return isset($_SESSION['user_id']);
    }

    public function register($username, $email, $password, $confirm_password) {
        if ($password !== $confirm_password) {
            throw new BadRequestException('Password and confirm password do not match');
        }

        $user_model = $this->pengguna_service->create($username, $email, $password);
    }

    public function login($email_username, $password) {
        $user = null;

        $user_by_email = $this->pengguna_service->getByUsername($email_username);
        if ($user_by_email && !is_null($user_by_email->getUsername())) {
            $user = $user_by_email;
        }

        if (is_null($user)) {
            $user_by_username = $this->pengguna_service->getByUsername($email_username);
            if ($user_by_username && !is_null($user_by_username->getUsername())) {
                $user = $user_by_username;
            }
        }

        if (is_null($user)) {
            throw new BadRequestException('User not found!');
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if (!password_verify($user->getPassword(), $password_hash)) {
            echo "Password is " . $password . " db password is " . $user->getPassword();
            throw new BadRequestException('Password doesn\'t match!');
        }

        $_SESSION['user_id'] = $user->getUsername();
        $_SESSION['is_admin'] = $user->isAdmin();

        return $user;
    }
}

?>
