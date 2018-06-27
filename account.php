<?php
include 'includes/common.php';

$oUsers = app::loadModel('user');

$aAuth = check_auth(HOST.'login/');

$aSettings = app::getSettings();

$alias = 'account';

$aPage = $oPages->get_page('register');


$oMenu = app::loadModel('menu');
$aTopMenu = $oMenu->get_menu(1, 0, null, $alias);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $alias);

if(isset($_POST['sent'])){
    $result = $oUsers->edit_user($aAuth['id'], $_POST['data'], $_FILES['doc']);
    if($result === "ok"){
        header("Location: ".HOST."account/");
    }else{
        $error = $result;
    }
}

$aUser = $oUsers->get_user($aAuth['id']);

$oCart = app::loadModel('cart');
$aCart = $oCart->get_cart();

include 'templates/account_tpl.php';