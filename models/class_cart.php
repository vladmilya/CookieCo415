<?php
class class_cart{
    
    protected $load_time;

    function __construct() {
        $this->load_time = time();
    }
    
    public function add_item($aData){ 
        if(isset($aData['id']) and !empty($aData['prices'])){
            if(!isset($_SESSION['cart']['items'][$aData['id']])){
                $_SESSION['cart']['items'][$aData['id']]['name'] = $aData['name'];
                $_SESSION['cart']['items'][$aData['id']]['image'] = $aData['image'];
                foreach($aData['prices'] as $k=>$price){
                    $_SESSION['cart']['items'][$aData['id']]['prices'][$price['code']]['name'] = $price['name'];                 
                    $_SESSION['cart']['items'][$aData['id']]['prices'][$price['code']]['price'] = $price['price'];
                    $_SESSION['cart']['items'][$aData['id']]['prices'][$price['code']]['qty'] = 0;                   
                }               
            }
            return "ok";
        }else{
            return "Wrong cart data format";
        }
    }
    
    public function get_cart(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart'];
        }else{
            return false;
        }
    }
    
    public function update_quantity($product, $price_code, $qty){
        if(isset($_SESSION['cart']['items'][intval($product)]['prices'][$price_code]['qty'])){
            $_SESSION['cart']['items'][intval($product)]['prices'][$price_code]['qty'] = floatval($qty);
            return true;
        }else{
            return false;
        }
    }
    
    public function delete_item($id){
        if(isset($_SESSION['cart']['items'][intval($id)])){
            unset($_SESSION['cart']['items'][intval($id)]);
            return true;
        }else{
            return false;
        }        
    }
    
    public function clear_cart(){
        unset($_SESSION['cart']);
        return true;
    }
    
}