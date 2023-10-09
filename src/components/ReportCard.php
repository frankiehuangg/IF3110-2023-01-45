<?php

require_once PROJECT_ROOT_PATH . '/src/models/UserReportModel.php';

function UserReportCard() {
    $html =<<< "EOT"
    EOT;

    return $html;
}

?>

<div class="report-card">
    <div class="main-content">
        <div class="node profile_picture_node">
                    <a href="/user/$user_id">
                        <img src="$profile_picture_path" class="profile_picture_img_node">
                    </a>
                </div>
                <a href="/post/$post_id" class="node post-card-2">
                    <div class="node content_node">
                        <div class="top_content_node">
                            <div class="node top_content_node_display_name">$display_name</div>
                            <div class="node top_content_node_username">@$username | </div>
                        </div>
                    <div class="node middle_content_node">
                        <div class="user-profile">
                            <div class="user-profile-picture">
                            <a href="/user/$user_id">
                                <img src="$profile_picture_path" class="profile_picture_img_node">
                            </a>
                            </div>
                            <div class="user-profile-info">
                                <div class="node top_content_node_display_name">$display_name</div>
                                <div class="node top_content_node_username">@$username | </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom_content_node">
                        <button type="submit" class="reject-report-button" id="reject-button">Reject</button>
                        <button type="submit" class="accept-report-button" id="accept-button">Accept</button>
                    </div>
                </a>
        </div>
    </div>
</div>
