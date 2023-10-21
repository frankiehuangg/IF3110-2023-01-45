<?php

require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';
require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

class CheckLogin {
    private static $instance;

    private function __construct() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function __invoke($path, $method) {
        $is_login = AuthService::getInstance()->isLogin();

        if (!$is_login) {
            throw new BadRequestException('You are not logged in!');
        }

        return true;
    }
}

?>