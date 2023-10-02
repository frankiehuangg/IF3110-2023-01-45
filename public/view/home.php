<?php

require_once PROJECT_ROOT_PATH . '/src/services/PostService.php';
require_once PROJECT_ROOT_PATH . '/public/components/PostCard.php';

$postService = PostService::getInstance();
$posts = $postService->getNLastPosts(10);

usort($posts, function($a, $b) {
    return $a->getPostTimestamp() > $b->getPostTimestamp();
});

$postElmts = implode('', array_map(function($post) {
    return PostCard($post);
}, $posts));

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial=scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <div class="page d-flex">
            <div id="main">
                <div id="content">
                    <div class="post-list d-flex flex-wrap">
                        <?
                        echo $postElmts;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
