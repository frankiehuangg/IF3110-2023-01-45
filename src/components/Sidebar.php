<?php

function Sidebar() {
    $html=<<<"EOT"
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fa-brands fa-x-twitter"></i>
        </div>
        <div class="sidebar-navigation-container">
            <a href="#" class="sidebar-navigation">
                <i class="fa-solid fa-house"></i>
                <div class="sidebar-navigation-text">
                    Home
                </div>
            </a>
            <a href="#" class="sidebar-navigation">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="sidebar-navigation-text">
                    Explore
                </div>
            </a>
            <a href="#" class="sidebar-navigation">
                <i class="fa-regular fa-heart"></i>
                <div class="sidebar-navigation-text">
                    Likes
                </div>
            </a>
            <a href="#" class="sidebar-navigation">
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
            <button class="sidebar-footer-element">Log Out</button>
        </div>
    </div>
    EOT;

    return $html;
}

?>