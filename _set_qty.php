<?php
include 'includes/common.php';

$aAuth = check_auth();
if($aAuth['id']){
    $product = intval($_POST['prod']);
    $price = $_POST['mod'];
    $qty = floatval($_POST['qty']);
    
    $oCart = app::loadModel('cart');
    
    $oCart->update_quantity($product, $price, $qty);
}
