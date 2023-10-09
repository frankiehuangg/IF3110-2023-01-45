<?php

require_once PROJECT_ROOT_PATH . '/src/bases/BaseModel.php';

class UserModel extends BaseModel {
    public $user_id;
    public $username;
    public $password;
    public $email;
    public $description;
    public $display_name;
    public $follower_count;
    public $following_count;
    public $join_date;
    public $birthday_date;
    public $birthday_month;
    public $birthday_year;
    public $profile_picture_path;
    public $is_admin;

    public function __construct() {
        $this->_primary_key = 'user_id';
    }

    public function constructFromArray($array) {
        $this->user_id                  = $array['user_id'];
        $this->username                 = $array['username'];
        $this->password                 = $array['password'];
        $this->email                    = $array['email'];
        $this->description              = $array['description'];
        $this->display_name             = $array['display_name'];
        $this->follower_count           = $array['follower_count'];
        $this->following_count          = $array['following_count'];
        $this->join_date                = $array['join_date'];
        $this->birthday_date            = $array['birthday_date'];
        $this->birthday_month           = $array['birthday_month'];
        $this->birthday_year            = $array['birthday_year'];
        $this->profile_picture_path     = $array['profile_picture_path'];
        $this->is_admin                 = $array['is_admin'];

        return $this;
    }

    public function toResponse() {
        return array(
            'user_id'               => $this->user_id,
            'username'              => $this->username,
            'password'              => $this->password,
            'email'                 => $this->email,
            'description'           => $this->description,
            'display_name'          => $this->display_name,
            'follower_count'        => $this->follower_count,
            'following_count'       => $this->following_count,
            'join_date'             => $this->join_date,
            'birthday_date'         => $this->birthday_date,
            'birthday_month'        => $this->birthday_month,
            'birthday_year'         => $this->birthday_year,
            'profile_picture_path'  => $this->profile_picture_path,
            'is_admin'              => $this->is_admin
        );
    }
}

?>
