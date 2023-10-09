<?php

require_once PROJECT_ROOT_PATH . '/src/services/AuthService.php';

function Sidebar() {
    if (AuthService::getInstance()->isAdmin()) {
        $html=<<<"EOT"
        <div class="sidebar">
            <div class="sidebar-header">
                <a href="/" class="">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
            </div>
            <div class="sidebar-navigation-container">
                <a href="/" class="sidebar-navigation">
                    <i class="fa-solid fa-house"></i>
                    <div class="sidebar-navigation-text">
                        Home
                    </div>
                </a>
                <a href="/explore" class="sidebar-navigation">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <div class="sidebar-navigation-text">
                        Explore
                    </div>
                </a>
                <a href="/likes" class="sidebar-navigation">
                    <i class="fa-regular fa-heart"></i>
                    <div class="sidebar-navigation-text">
                        Likes
                    </div>
                </a>
                <a href="/user/{$_SESSION['user_id']}" class="sidebar-navigation">
                    <i class="fa-regular fa-user"></i>
                    <div class="sidebar-navigation-text">
                        Profile
                    </div>
                </a>
                <a href="/create-user" class="sidebar-navigation">
                    <i class="fa-solid fa-user-plus"></i>
                    <div class="sidebar-navigation-text">
                        Register User
                    </div>
                </a>
                <a href="/report-list/0" class="sidebar-navigation">
                    <i class="fa-regular fa-flag"></i>
                    <div class="sidebar-navigation-text">
                        Reports List
                    </div>
                </a>
            </div>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-footer-navigation">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <form onsubmit="logout(event)">
                    <button type="submit" id="logout-user" class="sidebar-footer-element">Log Out</button>
                </form>
            </div>
        </div>
        EOT;

        return $html;
    }
    $html=<<<"EOT"
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
        </div>
        <div class="sidebar-navigation-container">
            <a href="/" class="sidebar-navigation">
                <i class="fa-solid fa-house"></i>
                <div class="sidebar-navigation-text">
                    Home
                </div>
            </a>
            <a href="/explore" class="sidebar-navigation">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="sidebar-navigation-text">
                    Explore
                </div>
            </a>
            <a href="/likes" class="sidebar-navigation">
                <i class="fa-regular fa-heart"></i>
                <div class="sidebar-navigation-text">
                    Likes
                </div>
            </a>
            <a href="/user/{$_SESSION['user_id']}" class="sidebar-navigation">
                <i class="fa-regular fa-user"></i>
                <div class="sidebar-navigation-text">
                    Profile
                </div>
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-footer-navigation">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
            <form class="Form" onsubmit="logout(event)">
                <button type="submit" id="logout-user" class="sidebar-footer-element">Log Out</button>
            </form>
        </div>
    </div>
    EOT;
    return $html;
}

?>