<?php
error_reporting(E_ALL);
ini_set("display_errors","on");
session_start();

require('config.php');
require('app_config.php');
require('func.php');
require('helpers.php');
function __autoload($class_name) {
    if($class_name == 'PHPMailer'){
        require("PHPMailer/class.phpmailer.php"); 
    }elseif($class_name == 'db'){
        require_once 'db.php';
    }elseif($class_name == 'app'){
        require_once 'app.php';
    }
    else{
        require_once ABS.'models/'.$class_name . '.php';
    }
} 

db::connect($aConf);

$oPages = app::loadModel('page');


if(isset($_SERVER['HTTPS'])){
    $ssl = 1;
}else{
    $ssl = 0;
}
       
?>