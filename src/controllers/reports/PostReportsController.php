<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseController.php';
require_once PROJECT_ROOT_PATH . '/src/services/PostReportsService.php';

class PostReportsController extends BaseController {
    protected static $instance;

    private function __construct($service) {
        parent::__construct($service);
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                PostReportsService::getInstance()
            );
        }

        return self::$instance;
    }

    public function post($url_params) {
        $post_id = $_POST['post_id'];
        $reporter = $_POST['reporter'];
        $description = $_POST['description'];

        $post_reports = $this->service->createPostReports($post_id,$reporter,$description);

        $response = new BaseResponse(true, $post_reports, 'Post reports created successfully', 200);

        return $response->toJSON();
    }
}