<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/UserRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/UserModel.php';

class UserService extends BaseService {
    protected static $instance;
    protected $repository;

    private function __construct($repository) {
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                UserRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function getByEmail($email) {
        $user = new UserModel();

        $user_sql = $this->repository->getByEmail($email);
        if ($user_sql) {
            $user->constructFromArray($user_sql);
        }

        return $user;
    }

    public function getByUsername($username) {
        $user = new UserModel();

        $user_sql = $this->repository->getByUsername($username);
        if ($user_sql) {
            $user->constructFromArray($user_sql);
        }

        return $user;
    }
};

?>
