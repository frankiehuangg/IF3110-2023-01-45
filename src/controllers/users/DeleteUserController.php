<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

class DeleteUserController extends BaseController {
    protected static $instance;
    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                UserService::getInstance()
            );
        }

        return self::$instance;
    }

    public function delete($urlParams) {
        $user_id = $urlParams[0];

        $posts = PostService::getInstance()->getAllByUserID($user_id);

        foreach ($posts as $post) {
            PostService::getInstance()->deletePost($post->get('post_id'));
        }

        $user = $this->service->deleteUser($user_id);

        $response = new BaseResponse(true, $user, 'User deleted successfully', 200);

        return $response->toJSON();
    }
};

?>