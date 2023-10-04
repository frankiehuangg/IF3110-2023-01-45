<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';

class PostRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'posts';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getAll() {
        return $this->findAll();
    }

    public function getByID($post_id) {
        return $this->findOne(['post_id' => [$post_id, PDO::PARAM_INT]]);
    }
}

?>
