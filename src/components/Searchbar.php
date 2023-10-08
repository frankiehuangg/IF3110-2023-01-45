<?php

function Searchbar() {
    $html =<<< "EOT"
    <div class="right-sidebar-header">
        <div class="search-bar">
            <form action="#">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search" class="search-bar-input">
            </form>
        </div>
    </div>
    <div class="right-sidebar-container"></div>
    EOT;

    return $html;
}