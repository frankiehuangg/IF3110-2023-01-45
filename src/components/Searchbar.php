<?php

function Searchbar() {
    $html =<<< "EOT"
    <div class="right-sidebar-header">
        <div class="search-bar">
            <form action="#">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search" class="search-bar-input" id="search-bar-input" onkeyup="searchChange()">
            </form>
        </div>
    </div>
    EOT;

    return $html;
}