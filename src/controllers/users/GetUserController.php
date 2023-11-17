<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/UserService.php';

class GetUserController extends BaseController {
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
        $user_id = $_GET['user_id'];

        if (!isset($user_id)) {
            throw new BadRequestException('User ID not set!');
        }

        $user = $this->service->getById($user_id);

        $response = new BaseResponse(true, $user, 'User data retrieved successfully', 200);
        
        return $response->toJSON();
    }
}

?>