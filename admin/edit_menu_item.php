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

if(!empty($_GET['item_id'])){//edit
    
    if(isset($_POST['sent'])){
        $ok = $oMenu->edit_item($_GET['item_id']);
        if($ok == 'ok') {
            header('Location: menu.php?id='.$menuId); 
            exit();
        }
        else $error = $ok;
    }    
    $aItem = $oMenu->get_menu_item($_GET['item_id']);    
    
    
}else{//add
    if(isset($_POST['sent'])){
        $ok = $oMenu->add_item($_GET['id']);
        if($ok == 'ok') {
            header('Location: menu.php?id='.$menuId); 
            exit();
        }
        else $error = $ok;
    }
}

$aParentMenu = $oMenu->get_menu($menuId, 0, 1, '', true);

include 'templates/edit_menu_item_tpl.php';
?>