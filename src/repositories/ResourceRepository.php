<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';

class ResourceRepository extends BaseRepository {
    protected static $instance;

    protected $tableName = 'resources';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getAllByPostID($post_id) {
        return $this->findOne(['post_id' => [$post_id, PDO::PARAM_INT]]);
    }

    public function getByResourcePath($resource_path) {
        return $this->findOne(['resource_path' => [$resource_path, PDO::PARAM_STR]]);
    }
};

?>