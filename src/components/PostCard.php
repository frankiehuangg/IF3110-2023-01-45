<?php

require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';

function PostCard($response_post) {
    $post_id                = $response_post[0]['post_id'];
    $profile_picture_path   = $response_post[1]['profile_picture_path'];
    $display_name           = $response_post[1]['display_name'] ? $response_post[1]['display_name'] : $response_post[1]['username'];
    $username               = $response_post[1]['username'];
    $user_id                = $response_post[1]['user_id'];
    $post_timestamp         = $response_post[0]['post_timestamp'];
    $post_content           = $response_post[0]['post_content'];
    $replies                = $response_post[0]['replies'];
    $shares                 = $response_post[0]['shares'];
    $likes                  = $response_post[0]['likes'];
    $resources              = $response_post[2];

    $resources_html = "<div class=\"post-images\">";
    foreach ($resources as $resource) {
        $extension = explode(".", $resource['resource_path'])[1];
        
        $image = array("png", "jpg", "jpeg");
        $video = array("mp4");

        if (in_array($extension, $image)) {
            $resources_html = $resources_html . <<<"EOT"
                <div class="post-image">
                    <img src="$resource[resource_path]" width="100%" height="100%" />
                </div>
            EOT;
        } else if (in_array($extension, $video)) {
            $resources_html = $resources_html . <<<"EOT"
                <div class="post-image">
                    <video width="400" controls>
                        <source src="$resource[resource_path]" type="video/$extension" />
                    </video>
                </div>
            EOT;
        }

    }
    $resources_html = "$resources_html </div>";

    $html = <<<"EOT"
    <div class="node post-card">
        <div class="main_content_node">
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
                        <div class="node top_content_node_post_timestamp">$post_timestamp</div>
                    </div>
                    <div class="node middle_content_node">$post_content $resources_html</div>
                    <div class="bottom_content_node">
                        <div class="node bottom_content_node_element">
                            <div class="bottom_content_node_icon">
                                <i class="bi bi-chat-left"></i>
                            </div>
                            <div class="bottom_content_node_text">
                                $replies
                            </div>
                        </div>
                        <div class="node bottom_content_node_element">
                            <div class="bottom_content_node_icon">
                                <i class="bi bi-repeat"></i>
                            </div>
                            <div class="bottom_content_node_text">
                                $shares
                            </div>                        
                        </div>
                        <div class="node bottom_content_node_element">
                            <div class="bottom_content_node_icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div class="bottom_content_node_text">
                                $likes
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    EOT;

    return $html;
}

?>
