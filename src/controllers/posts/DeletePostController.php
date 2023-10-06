<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

class DeletePostController extends BaseController {
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

    public function delete($urlParams) {
        $post_id = $urlParams[0];

        $post = $this->service->deletePost($post_id);

        $response = new BaseResponse(true, $post, 'Post deleted successfully', 200);

        return $response->toJSON();
    }
};

?>