<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/ResourceService.php';

class GetResourceController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                ResourceService::getInstance()
            );
        }

        return self::$instance;
    }

    public function get($urlParams) {
        $post_id = $_GET['post_id'];

        if (!isset($post_id)) {
            throw new BadRequestException('Post ID not set!');
        }

        $resources = $this->service->getResourcesByPostId($post_id);

        $response = new BaseResponse(true, $resources, 'Resource data retrieved successfully', 200);

        return $response->toJSON();
    }
}

?>