<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseRepository.php';

class UserReportRepository extends BaseRepository {
    protected static $instance;
    protected $tableName = 'user_reports';

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

    public function getReportId($report_id) {
        return $this->findOne(['report_id' => [$report_id, PDO::PARAM_INT]]);
    }

    public function getReported($user_id) {
        return $this->findOne(['user_id' => [$user_id, PDO::PARAM_INT]]);
    }

    public function getReporter($reporter_id) {
        return $this->findOne(['reporter' => [$reporter_id, PDO::PARAM_INT]]);
    }
}

?>