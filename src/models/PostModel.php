<?php

require_once PROJECT_ROOT_PATH . "/src/bases/BaseModel.php";

class PostModel extends BaseModel {
    private $post_id;
    private $post_content;
    private $post_timestamp;
    private $likes;
    private $replies;
    private $shares;
    private $resource_id;

    public function __construct() {
        $this->_primary_key = 'post_id';
        return $this;
    }

    public function constructFromArray($array) {
        $this->post_id          = $array['post_id'];
        $this->post_content     = $array['post_content'];
        $this->post_timestamp   = $array['post_timestamp'];
        $this->likes            = $array['likes'];
        $this->replies          = $array['replies'];
        $this->shares           = $array['shares'];
        $this->resource_id      = $array['resource_id'];

        return $this;
    }

    public function updatePost($array) {
        if ($array['post_text'] != '') {
            $this->post_text = $array['post_text'];
        }
        if ($array['resource_id'] != ['']) {
            $this->resource_id = $array['resource_id'];
        }
    }

    public function getPostID()         { return $this->post_id; }
    public function getPostContent()    { return $this->post_content; }
    public function getPostTimestamp()  { return $this->post_timestamp; }
    public function getLikes()          { return $this->likes; }
    public function getReplies()        { return $this->replies; }
    public function getShares()         { return $this->shares; }
    public function getResources()      { return $this->resources; }

    # public function like()             { $this->like_count++; }
    # public function unlike()           { $this->like_count--; }
}
?>
