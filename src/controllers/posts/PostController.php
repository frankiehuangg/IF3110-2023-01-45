<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/PostRepository.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';

class PostController extends BaseController {
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
        $post_content = $_GET['post_content'];

        $posts = $this->service->getAll($post_content);
        $response_posts = array_map(function($post) {
            return $post->toResponse();
        }, $posts);

        $html = "";
        foreach ($response_posts as $response_post) {
            $html = $html . PostCard($response_post);
        }

        $response = new BaseResponse(true, $html, 'Posts retrieved successfully', 200);

        return $response->toJSON();
    }
}

?>
