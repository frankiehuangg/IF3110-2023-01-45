<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseService.php';
require_once PROJECT_ROOT_PATH . '/src/repositories/PostReportsRepository.php';
require_once PROJECT_ROOT_PATH . '/src/models/PostReportsModel.php';

class PostReportsService extends BaseService {
    protected static $instance;
    protected $repository;

    private function __construct($repository) {
        $this->repository = $repository;
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static(
                PostReportsRepository::getInstance()
            );
        }

        return self::$instance;
    }

    public function createPostReports($post_id,$reporter,$description) {
        $post_reports = new PostReportsModel();

        $post_reports->set('post_id', $post_id);
        $post_reports->set('reporter', $reporter);
        $post_reports->set('description', $description);

        $post_reports_last_id = $this->repository->insert($post_reports, array(
            'post_id' => PDO::PARAM_INT,
            'reporter' => PDO::PARAM_STR,
            'description' => PDO::PARAM_STR
        ));

        $post_reports_sql = $this->repository->getByID($post_reports_last_id);

        $result_post_reports = new PostReportsModel();
        $result_post_reports->constructFromArray($post_reports_sql);

        return $result_post_reports;
    }
}