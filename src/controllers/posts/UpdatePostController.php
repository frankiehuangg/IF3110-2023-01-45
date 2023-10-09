<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

class UpdatePostController extends BaseController {
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

    public function patch($urlParams) {
        $post_id = $urlParams[0];
        parse_str(file_get_contents('php://input'), $_PATCH);
        $post_content = $_PATCH['post_content'];

        $post = $this->service->updatePost($post_id, $post_content);

        $response = new BaseResponse(true, $post, 'Post updated successfully', 200);

        return $response->toJSON();
    }
};

?>