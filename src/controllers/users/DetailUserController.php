<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
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
                UserService::getInstance()
            );
        }

        return self::$instance;
    }

    public function get($urlParams) {
        $user_id = $urlParams[0];

        $response = $this->service->getByID($user_id);

        $html = UserCard($response->toResponse());

        $response = new BaseResponse(true, $html, 'Posts retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>