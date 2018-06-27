<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = 'products';

$oProducts = app::loadModel('product');

$catId = isset($_GET['cat']) ? intval($_GET['cat']) : 0;



if(!empty($aCategories)){
    foreach($aCategories as $k=>$v){
        $aSubmenu[] = array('title'=>$v['name'],'url'=>'products.php?cat='.$k, 'active'=> ($catId == $k ? true : false));
    }
}

$SEARCH_ROWS_MAX = 10;

if(isset($_GET['activate'])){
    $oProducts->activate_product($_GET['activate'], 1);
    header("Location: ".(!empty($_SESSION['back_to_products']) ? $_SESSION['back_to_products'] : 'products.php'));
}
if(isset($_GET['deactivate'])){
    $oProducts->activate_product($_GET['deactivate'], 0);
    header("Location: ".(!empty($_SESSION['back_to_products']) ? $_SESSION['back_to_products'] : 'products.php'));
}
if(isset($_GET['remove'])){
    $oProducts->delete_product($_GET['remove']);
    header("Location: ".(!empty($_SESSION['back_to_products']) ? $_SESSION['back_to_products'] : 'products.php'));
}

$aProducts = $oProducts->get_products($catId, 0, 0, true);

$_SESSION['back_to_products'] = $_SERVER['REQUEST_URI'];

include 'templates/products_tpl.php';