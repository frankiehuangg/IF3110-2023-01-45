<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseResponse.php';
require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';
require_once PROJECT_ROOT_PATH . '/src/components/UserCard.php';

class RetrieveUserController extends BaseController {
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
        $n = $_GET['n'];

        $response = $this->service->getNLastUsers($n);
        $response_users = array_map(function($response) {
            return $response->toResponse();
        }, $response);

        $html = "";
        foreach ($response_users as $response_user) {
            $html = $html . UserCard($response_user);
        }

        $response = new BaseResponse(true, $html, 'User retrieved successfully', 200);

        return $response->toJSON();
    }
};

?>