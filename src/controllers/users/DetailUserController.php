<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';
require_once PROJECT_ROOT_PATH . '/src/components/UserCard.php';

class DetailUserController extends BaseController {
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
        $user_id = $urlParams[0];

        $responses = $this->service->getAllByUserID($user_id);

        if (empty($responses)) {
            $helper = new static(UserService::getInstance());

            $response = $helper->service->getById($user_id);

            $html = UserCard($response->toResponse());

            $response = new BaseResponse(true, $html, 'User data retrieved successfully', 200);

            return $response->toJSON();
        }

        $response_posts = array_map(function($response) {
            $resources = [];
            foreach ($response[2] as $res) {
                $resources[] = $res->toResponse();
            }
            return [$response[0]->toResponse(), $response[1]->toResponse(), $resources];
        }, $responses);

        if (isset($_GET['json'])) {
            $response = new BaseResponse(true, $response_posts, 'User posts retrieved successfully', 200);
            return $response->toJSON();
        }  

        $html = UserCard($response_posts[0][1]);

        foreach ($response_posts as $response_post) {
            $html = $html . PostCard($response_post);
        }

        $response = new BaseResponse(true, $html, 'User data retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>