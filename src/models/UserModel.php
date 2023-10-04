<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseModel.php';

class UserModel extends BaseModel {
    public $username;
    public $description;
    public $follower_count;
    public $following_count;
    public $join_date;
    public $birthday;
    public $profile_picture_path;

    public function __construct() {
        $this->_primary_key = 'username';
    }

    public function constructFromArray($array) {
        $this->username                 = $array['username'];
        $this->description              = $array['description'];
        $this->follower_count           = $array['follower_count'];
        $this->following_count          = $array['following_count'];
        $this->join_date                = $array['join_date'];
        $this->birthday                 = $array['birthday'];
        $this->profile_picture_path     = $array['profile_picture_path'];

        return $this;
    }

    public function getUsername()           { return $this->username; }
    public function getDescription()        { return $this->description; }
    public function getFollowerCount()      { return $this->follower_count; }
    public function getFollowingCount()     { return $this->following_count; }
    public function getJoinDate()           { return $this->join_date; }
    public function getBirthday()           { return $this->birthday; }
    public function getProfilePicturePath() { return $this->profile_picture_path; }
}

?>
