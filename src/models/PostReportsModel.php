<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class PostReportsModel extends BaseModel {
    public $post_id;
    public $reporter;
    public $description;

    public function __construct() {
        $this->_primary_key = 'post_id, reporter';
    }

    public function constructFromArray($array) {
        $this->post_id          = $array['post_id'];
        $this->reporter         = $array['reporter'];
        $this->description      = $array['description'];

        return $this;
    }

    public function toResponse() {
        return array(
            'post_id'           => $this->post_id,
            'reporter'          => $this->reporter,
            'description'       => $this->description
        );
    }
}