<?php
//Obtain Page Name
function obtainPageName(){
    $archive = basename($_SERVER['PHP_SELF']);
    $page = str_replace(".php", "", $archive);
    return $page;
}