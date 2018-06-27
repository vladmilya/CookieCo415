<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = 'products';

$oProducts = app::loadModel('product');

$catId = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if(!empty($aCategories)){
    foreach($aCategories as $k=>$v){
        $aSubmenu[] = array('title'=>$v['name'],'url'=>'products.php?cat='.$k, 'active'=> ($catId == $k ? true : false));
    }
}


if(!$productId){
    if(!empty($_POST['sent_product'])){//add
        $result = $oProducts->add_product($_POST['data'], $_FILES['image']);
        if($result == 'ok'){
            header("Location: products.php?cat=".$catId);die;
        }else{
            $error = $result;
        } 
    }
}else{
    if(isset($_GET['del_product_img'])){
        $oProducts->delete_product_image($productId);
        header("Location: edit_product.php?cat=".$catId."&id=".$productId);die;
    }
    if(!empty($_POST['sent_product'])){//update
        $result = $oProducts->edit_product($productId, $_POST['data'], $_FILES['image']);
        if($result == 'ok'){
            header("Location: ".(!empty($_SESSION['back_to_products']) ? $_SESSION['back_to_products'] : 'products.php'));die;
        }else{
            $error = $result;
        } 
    }    
    $aItem = $oProducts->get_product($productId);
}

$productCat = isset($aItem['cat_id']) ? $aItem['cat_id'] : (isset($_POST['data']['cat_id']) ? intval($_POST['data']['cat_id']) : $catId);
if($productCat){
    $aPrices = $aMeasures[$aCategories[$productCat]['measure_type']];
}

include 'templates/edit_product_tpl.php';