<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class LikeModel extends BaseModel {
    public $username;
    public $post_id;

    public function __construct() {
        $this->_primary_key = 'username, post_id';
        return $this;
    }

    public function constructFromArray($array)
    {
        $this->username = $array['username'];
        $this->post_id = $array['post_id'];

        return $this;
    }
}