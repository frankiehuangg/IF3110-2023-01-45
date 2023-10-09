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
        <link rel="stylesheet" href="/public/css/report-card.css">
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
                    <h2 class="main-header-title">Reports</h2>
                </div>
                <div id="reports">
                    <div class="report" id="report-list">
                    </div>
                </div>
                <div>
                    <button class="pagination" id="prev-page" onclick="redirect(0)">PREVIOUS</button>
                    <button class="pagination" id="next-page" onclick="redirect(1)">NEXT</button>
                </div>
            </div>
            <div class="right-sidebar">
                <?php echo Searchbar() ?>
            </div>
        </div>
        
        <script defer async src="/public/js/lib.js"></script>
        <script defer async src="/public/js/reports.js"></script>
        <script defer async src="/public/js/logout.js"></script>
    </body>
</html>
