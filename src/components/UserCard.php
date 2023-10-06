<?php

require_once PROJECT_ROOT_PATH . '/src/models/UserModel.php';

function UserCard($response_post) {
    $user_id                = $response_post['user_id'];
    $username               = $response_post['username'];
    $email                  = $response_post['email'];
    $description            = $response_post['description'];
    $display_name           = $response_post['display_name'];
    $follower_count         = $response_post['follower_count'];
    $following_count        = $response_post['following_count'];
    $join_date              = $response_post['join_date'];
    $birthday_date          = $response_post['birthday_date'];
    $birthday_month         = $response_post['birthday_month'];
    $birthday_year          = $response_post['birthday_year'];
    $profile_picture_path   = $response_post['profile_picture_path'];

    $html = <<<"EOT"
    <a href="/user/$user_id" class="node post-card">
        $username<br>
        $email<br>
        $description<br>
        $display_name<br>
        $follower_count<br>
        $following_count<br>
        $join_date<br>
        $birthday_date<br>
        $birthday_month<br>
        $birthday_year<br>
        $profile_picture_path<br>
    </a>
    EOT;

    return $html;
}

?>
