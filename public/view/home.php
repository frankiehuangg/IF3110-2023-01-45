<?php

require_once PROJECT_ROOT_PATH . '/src/components/Sidebar.php';
require_once PROJECT_ROOT_PATH . '/src/components/Searchbar.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial=scale=1.0">
        <link rel="stylesheet" href="/public/css/global.css">
        <link rel="stylesheet" href="/public/css/home.css">
        <link rel="stylesheet" href="/public/css/sidebar.css">
        <link rel="stylesheet" href="/public/css/searchbar.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Home</title>
    </head>
    <body>
        <div class="page d-flex">
            <div class="left-sidebar">
                <?php echo Sidebar() ?>
            </div>
            <div class="main">
                <div class="main-header">
                    <h2 class="home">Home</h2>
                </div>
                <div class="tweet-box">
                    <form onsubmit="submitFrom(event)">
                        <div class="tweet-box-profile-picture">
                            <img src="/public/images/default.jpg" alt="Profile Picture" class="tweet-box-profile-picture-image"></img>
                        </div>
                        <div class="tweet-box-container">
                            <div class="tweet-box-input">
                                <input type="text" placeholder="What is happening?!">
                            </div>
                            <div class="tweet-box-button">
                                <button class="attach-file-button" id="input-files">
                                    <i class="fa-solid fa-photo-film"></i>
                                </button>
                                <button type="submit" class="post-tweet-button">Tweet</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="content">
                    <div class="post-list d-flex flex-wrap" id="post-list">
                    </div>
                </div>
            </div>
            <div class="right-sidebar">
                <?php echo Searchbar() ?>
            </div>
        </div>
        
        <script defer async src="/public/js/lib.js"></script>
        <script defer async src="/public/js/home.js"></script>
    </body>
</html>
