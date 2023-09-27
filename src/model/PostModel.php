<?php

require_once PROJECT_ROOT_PATH . "./src/bases/PostModel.php";

class PostModel extends BaseModel {
    public $post_id;
    public $post_text;
    public $like_count;
    public $post_time;
    // public $last_modify_time;

    public function __construct() {
        $this->_primary_key = 'user_id';
        return $this;
    }

    public function constructFromArray($array) {
        $this->post_id    = $array['post_id'];
        $this->post_text  = $array['post_text'];
        $this->like_count = $array['like_count'];
        $this->post_time  = $array['post_time'];

        return $this;
    }

    public function getPostID() { return $this->post_id; }
    public function getPostText() { return $this->post_text; }
    public function getLikeCount() { return $this->like_count; }
    public function getPostTime() { return $this->post_time; }

    public function setPostText($text) { $this->post_text = $text; }
    public function like() { $this->like_count++; }
    public function unlike() { $this->like_count--; }
}
>
