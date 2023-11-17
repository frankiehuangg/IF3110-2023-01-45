<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

class CreatePostController extends BaseController {
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

    public function post($url_params) {
        $post_content = $_POST['post_content'];
        $resources = isset($_POST['resources']) ? explode(',', $_POST['resources']) : null;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : $_SESSION['user_id'];

        $post = $this->service->createPost($post_content, $resources, );

        $response = new BaseResponse(true, $post, 'Post created successfully', 200);

        return $response->toJSON();
    }
};

?>
