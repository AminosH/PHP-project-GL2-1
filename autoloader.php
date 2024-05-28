<?php
function myAutoloader($className) {
    $path = "C:/xampp/htdocs/PHP-project-GL2-1/classes/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;
    if (!file_exists($fullPath)) {
        return false;
    }
    include_once $fullPath;
    return null;
}

spl_autoload_register('myAutoloader');
