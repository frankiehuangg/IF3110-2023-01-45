<?php 

require_once PROJECT_ROOT_PATH . '/src/bases/BaseModel.php';

class UserReportModel extends BaseModel {
    public $report_id;
    public $user_id;
    public $reporter;
    public $description;
    public $status;

    public function __construct() {
        $this->_primary_key = 'report_id';
    }

    public function constructFromArray($array) {
        $this->report_id                = $array['report_id'];
        $this->user_id                  = $array['user_id'];
        $this->reporter                 = $array['reporter'];
        $this->description              = $array['description'];
        $this->status                   = $array['status'];
    }
}

?>