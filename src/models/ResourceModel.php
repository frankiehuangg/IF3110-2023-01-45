<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseModel.php';

class ResourceModel extends BaseModel {
    public $post_id;
    public $resource_id;
    public $resource_path;

    public function __construct() {
        $this->_primary_key = ['post_id', 'resource_id'];
    }

    public function constructFromArray($array) {
        $this->post_id          = $array['post_id'];
        $this->resource_id      = $array['resource_id'];
        $this->resource_path    = $array['resource_path'];

        return $this;
    }

    public function toResponse() {
        return array(
            'post_id'       => $this->post_id,
            'resource_id'   => $this->resource_id,
            'resource_path' => $this->resource_path
        );
    }
};

?>