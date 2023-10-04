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

    public function getByID($resource_id) {
        return $this->findOne(['resource_id' => [$resource_id, PDO::PARAM_INT]]);
    }
};

?>