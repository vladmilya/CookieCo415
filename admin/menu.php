<?php
include_once '../includes/common.php';
app::checkAuth();

$oMenu = app::loadModel('menu');

$activeMenu = 'menu';

$menuId = isset($_GET['id']) ? intval($_GET['id']) : 1;

if($menuId == 1){
    $pageTitle = 'Top Menu';
}else{
    $pageTitle = 'Footer Menu';
}

$aSubmenu = array(
    0 => array('title'=>'Top Menu', 'url'=>'menu.php?id=1', 'active'=> ($menuId == 1 ? true : false)),
    1 => array('title'=>'Footer Menu', 'url'=>'menu.php?id=2', 'active'=>($menuId == 2 ? true : false)),
);

if(@$_POST['sent']){
    foreach($_POST['ord'] as $k=>$val){
        $ok = db::query("UPDATE ".PREF."menu SET ord='".intval($val)."' WHERE id='".intval($k)."'");
    }
    if(@$ok){
        header('Location: menu.php'); 
        exit();
    }
}

if(isset($_GET['del'])){
    $ok = $oMenu->delete_item($_GET['del']);
    header('Location: menu.php?id='.$menuId);
    exit();
}

$menu = $oMenu->get_admin_menu($menuId);

include 'templates/menu_tpl.php';
?>