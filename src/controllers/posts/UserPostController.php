<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';

class RetrievePostController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                PostService::getInstance()
            );
        }

        return self::$instance;
    }

    public function get($urlParams) {
    }
};

?>