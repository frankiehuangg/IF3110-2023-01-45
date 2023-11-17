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

        $post_content = $_PATCH['post_content'] ?? null;
        $likes = isset($_PATCH['likes']) ? $_PATCH['likes'] : null;
        $replies = isset($_PATCH['replies']) ? $_PATCH['replies'] : null;
        $retweets = isset($_PATCH['retweets']) ? $_PATCH['retweets'] : null;

        $post = $this->service->updatePost($post_id, $post_content, $likes, $replies, $retweets);

        $response = new BaseResponse(true, $post, 'Post updated successfully', 200);

        return $response->toJSON();
    }
};

?>