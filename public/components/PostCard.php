<?php

require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';

function PostCard($post) {
    $userProfilePicture = '/public/image/default.png';
    $userDisplayName = '@' . 'amongusofficial';
    $username = 'amongos';
    $postID        = $post->getPostID();
    $postContent   = $post->getPostContent();
    $postTimestamp = $post->getPostTimestamp();
    $postLikes     = $post->getLikes();
    $postReplies   = $post->getReplies();
    $postShares    = $post->getShares();
    # $postResources = $post->getResources();
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
        </div>
    </a>
    EOT;

    return $html;
}

?>
