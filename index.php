<?php
include 'includes/common.php';

$aAuth = check_auth();

$oMenu = app::loadModel('menu'); 

$aSettings = app::getSettings();

if(isset($_GET['d'])){
    $alias = $_GET['d'];
}else{
    $alias = 'home';
}
$aPage = $oPages->get_page($alias);

if(empty($aPage)){
    header("HTTP/1.1 301 Moved Permanently");    
    header("Location: ".HOST."404/");
}

$aSections = $oPages->get_fixed_sections($alias, false);
$aSections = array_values($aSections);

if($alias === 'home'){
    $tpl = 'home';
    $actve_menu = 5;
}elseif($alias === 'directions'){
    $tpl = 'directions';
    $actve_menu = $alias;
}elseif($alias === 'contact'){
    $tpl = 'contact';
    $actve_menu = $alias;
}else{
    $tpl = 'index';
    $actve_menu = $alias;
}

$aTopMenu = $oMenu->get_menu(1, 0, null, $actve_menu);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $actve_menu);

$oCart = app::loadModel('cart');
$aCart = $oCart->get_cart();

include 'templates/'.$tpl.'_tpl.php';