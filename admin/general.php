<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = 'general';

$aSubmenu = array();

$aItem = app::getSettings();

if(!empty($_POST['sent'])){
    
    app::setSettings('phone', $_POST['phone']);
    app::setSettings('email', $_POST['email']);
    app::setSettings('facebook', $_POST['facebook']);
    app::setSettings('twitter', $_POST['twitter']);
    app::setSettings('instagram', $_POST['instagram']);
    app::setSettings('google', $_POST['google']);
    app::setSettings('address', $_POST['address']);
    app::setSettings('analytics_script', $_POST['analytics_script']);
    
    header('Location: general.php?updated=1'); 
    exit();
    
}

include 'templates/general_tpl.php';