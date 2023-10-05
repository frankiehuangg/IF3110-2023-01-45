<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

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

    public function get($url_params) {
        $n = $_GET['n'];

        $posts = $this->service->getNLastPosts($n);

        $response = new BaseResponse(true, $posts, 'Post created successfully', 200);

        return $response->toJSON();
    }
};

?>