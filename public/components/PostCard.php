<?php

require_once PROJECT_ROOT_PATH . '/src/models/PostModel.php';

function PostCard($post) {
    $postID = $post->getPostID();
    $postText = $post->getPostText();
    $likeCount = $post->getLikeCount();
    $postTime = $post->getPostTime();

    $html = <<<"EOT"
    <a href="/post/$postID" class="post-card position-relative">
        $postID<br>
        $postText<br>
        $likeCount<br>
        $postTime<br>
    </a>
    EOT;

    return $html;
}

?>
