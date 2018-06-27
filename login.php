<?php
include 'includes/common.php';

$oUsers = app::loadModel('user');
$oUsers->logout();

$aSettings = app::getSettings();

$alias = 'login';

$aPage = $oPages->get_page($alias);


$oMenu = app::loadModel('menu');
$aTopMenu = $oMenu->get_menu(1, 0, null, $alias);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $alias);



if(isset($_POST['sent'])){
    $result = $oUsers->login($_POST['username'], $_POST['password']);
    if($result){
        $aAuth = check_auth();
        if(!empty($aAuth['verified'])){
            header("Location: ".HOST."menu/");
        }else{
            header("Location: ".HOST."account/");
        }
    }else{
        $error = 'Authorization failed.';
    }    
}

include 'templates/login_tpl.php';