<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/src/components/PostCard.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';
require_once PROJECT_ROOT_PATH . '/src/components/UserCard.php';

class GetUserDetailController extends BaseController {
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

    public function get($urlParams) {
        $user_id = $urlParams[0];

        $responses = $this->service->getById($user_id);

        $response = new BaseResponse(true, $response, 'User data retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>