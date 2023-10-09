<?php

$routes = array(
    '/'             => PROJECT_ROOT_PATH . '/public/view/home.php',
    '/login'        => PROJECT_ROOT_PATH . '/public/view/login.php',
    '/register'     => PROJECT_ROOT_PATH . '/public/view/register.php',
    '/forget-pass'  => PROJECT_ROOT_PATH . '/public/view/forget-password.php',
    '/logout'       => PROJECT_ROOT_PATH . '/public/view/logout.php',
    '/tweet'        => PROJECT_ROOT_PATH . '/public/view/create-post.php',
    '/post/*'       => PROJECT_ROOT_PATH . '/public/view/post-detail.php',
    '/user/*'       => PROJECT_ROOT_PATH . '/public/view/user-detail.php',
    '/post-reports' => PROJECT_ROOT_PATH . '/public/view/post-reports.php',
    '/user-reports' => PROJECT_ROOT_PATH . '/public/view/user-reports.php',
    '/explore'      => PROJECT_ROOT_PATH . '/public/view/explore.php',
    '/create-user'  => PROJECT_ROOT_PATH . '/public/view/create-user.php',
);