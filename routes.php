<?php

$routes = array(
    '/'                 => PROJECT_ROOT_PATH . '/public/view/home.php',
    '/login'            => PROJECT_ROOT_PATH . '/public/view/login.php',
    '/register'         => PROJECT_ROOT_PATH . '/public/view/register.php',
    '/forget-password'  => PROJECT_ROOT_PATH . '/public/view/forget-password.php',
    '/logout'           => PROJECT_ROOT_PATH . '/public/view/logout.php',
    '/post/*'           => PROJECT_ROOT_PATH . '/public/view/post-detail.php',
    '/user/*'           => PROJECT_ROOT_PATH . '/public/view/user-detail.php',
    '/explore'          => PROJECT_ROOT_PATH . '/public/view/explore.php',
    '/report-list/*'    => PROJECT_ROOT_PATH . '/public/view/reports.php',
);