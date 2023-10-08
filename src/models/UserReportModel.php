<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseModel.php';

class UserReportModel extends BaseModel {
    public $user_id;
    public $reporter_id;
    public $description;

    public function __construct() {
        $this->_primary_key = 'report_id';
    }

    public function constructFromArray($array) {
        $this->user_id                  = $array['user_id'];
        $this->reporter_id              = $array['reporter_id'];
        $this->description              = $array['description'];
    }
}

?>