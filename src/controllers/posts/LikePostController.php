<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseController.php";
require_once PROJECT_ROOT_PATH . "/src/services/LikeService.php";

class LikePostController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                LikeService::getInstance()
            );
        }

        return self::$instance;
    }

    public function post($url_params) {
        $username = $_POST['username'];
        $post_id = $_POST['post_id'];

        $like = $this->service->likePost($username, $post_id);

        $response = new BaseResponse(true, $like, 'Post created successfully', 200);

        return $response->toJSON();
    }
}