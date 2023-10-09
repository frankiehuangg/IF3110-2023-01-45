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
        $resources_html = $resources_html . <<<"EOT"
            <div class="post-image">
                <img src='$resource[resource_path]' />
            </div>
        EOT;
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
                            <div class="tweet-box-button">
                            <label for="input-files" class="attach-file-button">
                                <i class="fa-solid fa-photo-film"></i>
                            </label>
                            <input type="file" name="file-resource" id="input-files" accept="image/*" multiple style="display: none">
                            <button type="submit" class="post-tweet-button" id="submit-button">Tweet</button>
                            </div>                  
                        </div>
                        <div class="node bottom_content_node_element">
                            <div class="tweet-box-button">
                            <label for="input-files" class="attach-file-button">
                                <i class="fa-solid fa-photo-film"></i>
                            </label>
                            <input type="file" name="file-resource" id="input-files" accept="image/*" multiple style="display: none">
                            <button type="submit" class="post-tweet-button" id="submit-button">Tweet</button>
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
