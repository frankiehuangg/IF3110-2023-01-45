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
        <link rel="stylesheet" href="/public/css/shared.css">
        <link rel="stylesheet" href="/public/css/home.css">
        <link rel="stylesheet" href="/public/css/sidebar.css">
        <link rel="stylesheet" href="/public/css/searchbar.css">
        <link rel="stylesheet" href="/public/css/createuser.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Register</title>
    </head>
    <body>
        <div class="page d-flex">
            <div class="left-sidebar">
                <?php echo Sidebar() ?>
            </div>
            <div class="main">
                <div class="main-header">
                    <h2 class="main-header-title">Register</h2>
                </div>
                <div class="dataInputContainer">
                    <form class="Form" onsubmit="register(event)">
                        <div class="inputGroup">
                            <input type="text" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="inputGroup">
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="inputGroup">
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="inputGroup">
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="submitButton">Register</button>
                    </form>
                </div>
            </div>
            <div class="right-sidebar">
                <?php echo Searchbar() ?>
            </div>
        </div>
        
        <script defer async src="/public/js/lib.js"></script>
        <script defer async src="/public/js/home.js"></script>
        <script defer async src="/public/js/create-post.js"></script>
    </body>
</html>