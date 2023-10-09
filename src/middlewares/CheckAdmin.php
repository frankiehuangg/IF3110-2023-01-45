<?php

require_once PROJECT_ROOT_PATH . '/src/exceptions/BadRequestException.php';
require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

class CheckAdmin {
    private static $instance;

    private function __construct() {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function __invoke($path, $method) {
        $is_admin = AuthService::getInstance()->isAdmin();

        if (!$is_admin) {
            throw new BadRequestException('You must be an admin to access this page!');
        }

        return true;
    }

};

?>
