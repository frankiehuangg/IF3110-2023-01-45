<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';

class GetPostController extends BaseController {
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
        $post_id = $urlParams[0];

        if (!isset($post_id)) {
            throw new BadRequestException('Post ID not set!');
        }

        $post = $this->service->getById($post_id);

        $response = new BaseResponse(true, $post, 'User data retrieved successfully', 200);
        
        return $response->toJSON();
    }
}

?>