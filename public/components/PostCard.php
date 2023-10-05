<?php

require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';

function PostCard($post) {
    $userProfilePicture = '/public/image/default.png';
    $userDisplayName = '@' . 'amongusofficial';
    $username = 'amongos';
    $postID        = $post->get('post_id');
    $postContent   = $post->get('post_content');
    $postTimestamp = $post->get('post_timestamp');
    $postLikes     = $post->get('likes');
    $postReplies   = $post->get('replies');
    $postShares    = $post->get('shares');
    $postResources = '/public/image/haha.png';

    $html = <<<"EOT"
    <a href="/post/$postID" class="post-card position-relative">
        <div>
            $userProfilePicture <br>
            $userDisplayName    <br>
            $username           <br>
            $postTimestamp      <br>
            $postContent        <br>
            $postResources      <br>
            $postReplies        <br>
            $postShares         <br>
            $postLikes          <br>
            <form onsubmit="like(event, 'user1', $postID)">
            <div class="form-section-submit">
                <input type="submit" value="Like" id="like-button-{$postID}">
            </div>
            </form>
            <script defer async src="/public/js/lib.js"></script>
            <script defer async src="/public/js/like-post.js"></script>
        </div>
    </a>
    <br>
    EOT;

    return $html;
}

?>
