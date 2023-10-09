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
    <div class="profile-card">
        <div class="profile-header">
        </div>
        <div class="profile-container">
            <div class="profile-picture">
                <img src="$profile_picture_path" class="profile-picture-img">
            </div>
            <div class="profile-display-name">
                display_name
            </div>
            <div class="profile-username">
                @$username
            </div>
            <div class="profile-join-date">
                <div class="profile-join-date-icon">
                    <i class="bi bi-calendar"></i>
                </div>
                <div class="profile-join-date-text">
                    Joined $join_date
                </div>
            </div>
            <div class="profile-follow-container">
                <div class="profile-follow">
                    <div class="profile-follow-count">$following_count</div>
                    <div class="profile-follow-text">Following</div>
                </div>
                <div class="profile-follow">
                    <div class="profile-follow-count">$follower_count</div>
                    <div class="profile-follow-text">Follower</div>
                </div>
            </div>
        </div>
    </div>
    EOT;

    return $html;
}

?>