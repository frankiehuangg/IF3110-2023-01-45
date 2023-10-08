<?php

require_once PROJECT_ROOT_PATH . '/src/components/Sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial=scale=1.0">
        <link rel="stylesheet" href="/public/css/global.css">
        <link rel="stylesheet" href="/public/css/sidebar.css">
        <link rel="stylesheet" href="/public/css/searchbar.css">
        <link rel="stylesheet" href="/public/css/shared.css">
        <link rel="stylesheet" href="/public/css/explore.css">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Profile</title>
    </head>
    <body>
    <div class="form-container">
        <div class="page d-flex">
            <div class="left-sidebar">
                <?php echo Sidebar() ?>
            </div>
            <div class="main">
                <div class="main-header">
                    <h2 class="main-header-title">Explore</h2>
                </div>
                <div class="explore-search">
                <div class="search-bar">
                    <form action="#">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search" class="search-bar-input">
                    </form>
                </div>
                </div>
                <div id="content">
                    <div class="user-list d-flex flex-wrap" id="user-list">
                    </div>
                </div>
            </div>
            <div class="right-sidebar">
            </div>
        </div>  
        <script defer async src="/public/js/lib.js"></script>
        <script defer async src="/public/js/user-detail.js"></script>
    </body>
</html>