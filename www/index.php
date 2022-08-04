<?php

namespace App;

use App\Core\Middleware;

session_start();

if(!file_exists('conf.inc.php') && $_SERVER["REQUEST_URI"] !="/installer" ){

    header("Location: /installer");
    die();
}elseif(!file_exists('conf.inc.php')){

}else{
    require 'conf.inc.php';
    if($_SERVER["REQUEST_URI"] =="/installer"){
        header("Location: /");
    }
}

if (empty($_SESSION['csrf'])) { //csrf par session
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function myAutoloader($class)
{
    // $class => CleanWords
    $class = str_replace("App\\","",$class);
    $class = str_replace("\\", "/",$class);
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");

Middleware::start();