<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';

class RetrievePostController extends BaseController {
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

    public function get($url_params) {
        $n = $_GET['n'];

        $responses = $this->service->getNLastPosts($n);
        $response_posts = array_map(function($response) {
            $resources = [];
            foreach ($response[2] as $res) {
                $resources[] = $res->toResponse();
            }
            
            return [$response[0]->toResponse(), $response[1]->toResponse(), $resources];
        }, $responses);

        $html = "";
        foreach ($response_posts as $response_post) {
            $html = $html . PostCard($response_post);
        }

        $response = new BaseResponse(true, $html, 'Posts retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>