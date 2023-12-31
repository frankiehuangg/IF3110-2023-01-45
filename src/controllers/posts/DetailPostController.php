<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';

class DetailPostController extends BaseController {
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
        $post_id = $_GET['post_id'];

        $response = $this->service->getPostByID($post_id);

        $resources = [];
        foreach ($response[2] as $res) {
            $resources[] = $res->toResponse();
        }

        $html = PostCard([$response[0]->toResponse(), $response[1]->toResponse(), $resources]);

        $response = new BaseResponse(true, $html, 'Posts retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>