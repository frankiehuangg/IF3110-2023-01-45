<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';

class PostReportsRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'post_reports';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}