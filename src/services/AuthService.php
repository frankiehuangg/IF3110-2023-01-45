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
        $this->user_service = UserService::getInstance();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function isLogin() {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin() {
        return $this->isLogin() && (isset($_SESSION['is_admin'])) && ($_SESSION['is_admin'] == 1);
    }

    public function register($username, $email, $password, $confirm_password) {
        if ($password !== $confirm_password) {
            throw new BadRequestException('Password and confirm password do not match');
        }

        if (!is_null($this->user_service->getByEmail($email)->get('email'))) {
            throw new BadRequestException('Email already exists!');
        }
        if (!is_null($this->user_service->getByUsername($username)->get('username'))) {
            throw new BadRequestException('Username already exists!');
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $user_model = $this->user_service->create($username, $email, $hashed_password);
    
        return $user_model;
    }

    public function resetPassword($emailr, $passwordr, $confirm_password) {
        if ($passwordr!== $confirm_password) {
            throw new BadRequestException('Password and confirm password do not match');
        }

        $user = $this->user_service->getByEmail($emailr);
        if (!isset($user)) {
            throw new BadRequestException('User not found');
        }

        $hashed_password = password_hash($passwordr, PASSWORD_DEFAULT);

        $user_model = $this->user_service->updateUser($user->user_id, NULL, $hashed_password);

        return $user_model;
    }

    public function login($email_username, $password) {
        $user = null;

        $user_by_email = $this->user_service->getByUsername($email_username);
        if ($user_by_email && !is_null($user_by_email->get('username'))) {
            $user = $user_by_email;
        }

        if (is_null($user)) {
            $user_by_username = $this->user_service->getByUsername($email_username);
            if ($user_by_username && !is_null($user_by_username->get('username'))) {
                $user = $user_by_username;
            }
        }

        if (is_null($user)) {
            throw new BadRequestException('User not found!');
        }

        if (!password_verify($password, $user->get('password'))) {
            throw new BadRequestException('Password doesn\'t match!');
        }

        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['is_admin'] = $user->is_admin;
        $_SESSION['username'] = $user->username;

        return $user;
    }

    public function logout() {
          unset($_SESSION['user_id']);
          unset($_SESSION['is_admin']);
          unset($_SESSION['username']);
    }
}

?>
