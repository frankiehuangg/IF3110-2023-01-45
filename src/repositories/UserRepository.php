<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';

class UserRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'users';

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (!(isset(self::$instance))) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getByUsername($username) {
        return $this->findOne(['username' => [$username, PDO::PARAM_STR]]);
    }
};

?>
