<?php
include 'includes/common.php';

$aAuth = check_auth(HOST.'login/');
if(!$aAuth['verified']){
     header("Location: ".HOST."login/");die;
}

$aSettings = app::getSettings();

$alias = 'cart';

$aPage = $oPages->get_page('menu');

$oMenu = app::loadModel('menu');
$aTopMenu = $oMenu->get_menu(1, 0, null, $alias);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $alias);

$oProducts = app::loadModel('product');
$oCart = app::loadModel('cart');

$aCart = $oCart->get_cart();

if(isset($_GET['add'])){//add item to cart
   $itemId = intval($_GET['add']);   
   
   $aProduct = $oProducts->get_product($itemId);
   if(!empty($aProduct['id'])){       
       $res = $oCart->add_item($aProduct);
       if($res === "ok"){
           header("Location: ".HOST."cart/");die;
       }else{
           $error = $res;
       }
   }else{
       header("Location: ".HOST."menu/");die;
   }   
}elseif(isset($_GET['delete'])){//delete
    $itemId = intval($_GET['delete']);
    $res = $oCart->delete_item($itemId);
    if($res){
        header("Location: ".HOST."cart/");die;
    }else{
        $error = "Unknown prduct item!";
    }
}elseif(isset($_GET['checkout'])){//checkout
    if(isset($_POST['sent_cart'])){
        if(!empty($_POST['qty'])){
            $aPreparedCart = array();
            foreach($_POST['qty'] as $item_id => $item){
                $aItem = $aCart['items'][$item_id];
                foreach($item as $unit=>$qty){
                    if($qty > 0){
                        $aPreparedCart['products'][] = array('name'=>$aItem['name'], 'quantity'=>$qty, 'unit'=>$aItem['prices'][$unit]['name'], 'price'=>$aItem['prices'][$unit]['price']);
                    }
                }
            }
            if(!empty($aPreparedCart['products'])){
                $oUsers = app::loadModel('user');
                $aUser = $oUsers->get_user($aAuth['id']);
                $aPreparedCart['patient']['name'] = $aUser['name'];
                $aPreparedCart['patient']['address'] = $aUser['address'];
                $aPreparedCart['patient']['email'] = $aUser['email'];
                
                $jsonOrder = json_encode($aPreparedCart);
                
                //POS API
                $apikey = API_KEY;
                $apiURL = API_URL;
                
                $sign = sha1($jsonOrder.$apikey);
                $data = array('order'=>$jsonOrder, 'sign'=>$sign);
                $result = post_curl_request($apiURL, $data);
                $aResult = json_decode($result, true);
                if(isset($aResult['error'])){
                    $error = $aResult['error'];
                }else{
                    if(!empty($aResult['orderId'])){
                        $oEmail = app::loadModel('email');
                        
                        $subject = "New order on ".SITE_NAME;
                        $body = 'New order has been posted on '.SITE_NAME.'<br /><br />';
                        
                        $body.='<b>Patient:</b><br />';
                        $body.='<table width="100%" cellspacing="0">
                                <tr><td>Name: </td><td>'.$aPreparedCart['patient']['name'].'</td></tr>
                                <tr><td>Address: </td><td>'.$aPreparedCart['patient']['address'].'</td></tr>
                                <tr><td>Email: </td><td>'.$aPreparedCart['patient']['email'].'</td></tr>
                                </table><br />';                        
                        
                        $body.='<b>Order:</b><br />';
                        $body.='<table width="100%" cellspacing="0">';
                        $orderTotal = 0;
                        foreach($aPreparedCart['products'] as $ord_item){
                            $orderTotal+=$ord_item['price']*$ord_item['quantity'];
                            $body.='<tr>
                                    <td>'.$ord_item['name'].'</td>
                                    <td>'.$ord_item['quantity'].' '.$ord_item['unit'].'</td> 
                                    <td>$'.number_format($ord_item['price']*$ord_item['quantity'],2,'.',',').'</td>
                                    </tr>';
                        }
                        $body.='<tr><td colspan="2"><b>TOTAL:</b></td><td><b>$'.number_format($orderTotal,2,'.',',').'</b></td></tr>';
                        $body.='</table>';
                        
                        //$admin_email = $aSettings['email'];
                        $admin_email = ADMIN_EMAIL;                  
                        $result = $oEmail->email($admin_email, $subject, $body);
                        
                        $oCart->clear_cart();
                        $success = true;
                        $aCart = $oCart->get_cart();
                    }else{
                        $error = "Sorry, but due to technical issues your order has not been submitted. Please try again later";
                    }
                }
            } 
        } 
        //dump($_POST['qty']);
        //dump($aCart);           
    }    
    
}

include 'templates/cart_tpl.php';