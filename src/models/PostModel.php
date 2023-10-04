<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class PostModel extends BaseModel {
    public $post_id;
    public $post_content;
    public $post_timestamp;
    public $likes;
    public $replies;
    public $shares;

    public function __construct() {
        $this->_primary_key = 'post_id';
    }

    public function constructFromArray($array) {
        $this->post_id          = $array['post_id'];
        $this->post_content     = $array['post_content'];
        $this->post_timestamp   = $array['post_timestamp'];
        $this->likes            = $array['likes'];
        $this->replies          = $array['replies'];
        $this->shares           = $array['shares'];

        return $this;
    }

    public function toResponse() {
        return array(
            'post_id'           => $this->post_id,
            'post_content'      => $this->post_content,
            'post_timestamp'    => $this->post_timestamp,
            'likes'             => $this->likes,
            'replies'           => $this->replies,
            'shares'            => $this->shares
        );
    }
}
?>
