<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class PostModel extends BaseModel {
    private $post_id;
    private $post_text;
    private $like_count;
    private $post_time;
    // private $last_modify_time;
    private $resource_id;

    public function __construct() {
        $this->_primary_key = 'user_id';
        return $this;
    }

    public function constructFromArray($array) {
        $this->post_id          = $array['post_id'];
        $this->post_text        = $array['post_text'];
        $this->like_count       = $array['like_count'];
        $this->post_time        = $array['current_time'];
        // $this->last_modify_time = $array['current_time'];
        $this->resource_id      = $array['resource_id'];

        return $this;
    }

    public function updatePost($array) {
        if ($array['post_text'] != '') {
            $this->post_text = $array['post_text'];
        }
        // if ($array['time'] != '') {
        //     $this->last_modify_time = $array['time'];
        // }
        if ($array['resource_id'] != ['']) {
            $this->resource_id = $array['resource_id'];
        }
    }

    public function getPostID()    { return $this->post_id; }
    public function getPostText()  { return $this->post_text; }
    public function getLikeCount() { return $this->like_count; }
    public function getPostTime()  { return $this->post_time; }

    public function like()             { $this->like_count++; }
    public function unlike()           { $this->like_count--; }
}
?>
