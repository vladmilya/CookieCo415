<?php
class class_product{
    
    protected $load_time;

    function __construct() {
        $this->load_time = time();
    }
    
    public function get_products($category=0, $active_only=0, $prices=0, $paged=0){
        $where = '';
        if($category){
            $where.="AND cat_id = '".intval($category)."'";
        }
        if($active_only){
            $where.="AND active = '1'";
        }
        if($paged){
            $aProducts = db::get_pager("SELECT * FROM ".PREF."products WHERE 1 ".$where);
        }else{
            $aProducts = db::get("SELECT * FROM ".PREF."products WHERE 1 ".$where);
        }
        if($prices){
            foreach($aProducts as &$prod){
                $aPrices = db::get("SELECT * FROM ".PREF."product_modifiers WHERE product_id = '".$prod['id']."'");
                $prod['prices'] = $aPrices;
            }
        }
        return $aProducts;
    }
    
    public function get_product($id){
        $aProduct = db::get_row("SELECT * FROM ".PREF."products WHERE id = '".intval($id)."'");
        if(!empty($aProduct['id'])){
            $aPrices = array();
            $aPr = db::get("SELECT * FROM ".PREF."product_modifiers WHERE product_id = '".$aProduct['id']."'");
            if(!empty($aPr)){
                foreach($aPr as $p){
                    $aPrices[$p['code']] = $p;
                }
            }
            $aProduct['prices'] = $aPrices;
            return $aProduct;
        }else{
            return false;
        }
    }
    
    public function add_product($data, $file_data){
        if(empty($data['cat_id'])){
            return "Please select a category.";
        }
        if(empty($data['name'])){
            return "Please enter product name.";
        }
        global $aCategories, $aMeasures;
        //image
        $image_sql = '';
        $is_image = false;
        if(@$file_data['name']){
            $is_image=preg_match("/^(image\/)[a-zA-Z]{3,4}/",$file_data['type']);
            if($is_image){
                $image_name ='gallery/'.$this->load_time.'_'.$file_data['name'];
                $full_name = ABS.$image_name;
                if(move_uploaded_file($file_data['tmp_name'],$full_name)){
                    $image_sql = " `image` = '".$image_name."', ";
                }
            }else{
                return "Wrong image format!";
            }
        }       
        $mtype = $aCategories[$data['cat_id']]['measure_type'];
        db::query("INSERT INTO ".PREF."products SET 
                            `cat_id` = '".intval($data['cat_id'])."',
                            `name` = ?,                              
                            `thc` = ?,
                            `measure_type` = '".$mtype."',
                            $image_sql
                            `purchase_date` = '".$this->load_time."',
                            `active` = '1'
                        ",
                array(stripslashes($data['name']),stripslashes($data['thc'])));
        $productId = db::get_last_id();
        if($productId){            
            foreach($data['price'] as $k=>$p){
                if($p > 0){
                    $mname = $aMeasures[$aCategories[$data['cat_id']]['measure_type']][$k]['name'];
                    db::query("INSERT INTO ".PREF."product_modifiers SET
                             product_id = '".intval($productId)."',
                             code = ?,
                             name = ?,
                             price = '".floatval($p)."'",
                        array($k,$mname));
                }
            }
            return "ok";
        }else{
            return "Database inserting error.";
        }
    }
    
    public function edit_product($id, $data, $file_data){
        if(empty($data['cat_id'])){
            return "Please select a category.";
        }
        if(empty($data['name'])){
            return "Please enter product name.";
        }
        global $aCategories, $aMeasures;
        //image
        $image_sql = '';
        $is_image = false;
        if(@$file_data['name']){
            $is_image=preg_match("/^(image\/)[a-zA-Z]{3,4}/",$file_data['type']);
            if($is_image){
                $image_name ='gallery/'.$this->load_time.'_'.$file_data['name'];
                $full_name = ABS.$image_name;
                if(move_uploaded_file($file_data['tmp_name'],$full_name)){
                    $image_sql = " `image` = '".$image_name."', ";
                    $file_to_del = db::get_one("SELECT image FROM ".PREF."products WHERE id = '".intval($id)."'");
                    if(!empty( $file_to_del)){
                        @unlink('../'.$file_to_del);
                    }
                }
            }else{
                return "Wrong image format!";
            }
        } 
        $res = db::query("UPDATE ".PREF."products SET                            
                            `name` = ?,                              
                            `thc` = ?,
                            $image_sql
                            `cat_id` = '".intval($data['cat_id'])."'
                         WHERE id = '".intval($id)."'",
                array(stripslashes($data['name']),stripslashes($data['thc'])));
        db::query("DELETE FROM ".PREF."product_modifiers WHERE product_id = '".intval($id)."'");
        foreach($data['price'] as $k=>$p){
            if($p > 0){
                $mname = $aMeasures[$aCategories[$data['cat_id']]['measure_type']][$k]['name'];
                db::query("INSERT INTO ".PREF."product_modifiers SET
                         product_id = '".intval($id)."',
                         code = ?,
                         name = ?,
                         price = '".floatval($p)."'",
                    array($k,$mname));
            }
        }
        if($res){
            return "ok";
        }else{
            return "Database updating error.";
        }
    }
    
    public function activate_product($id, $operation=1){
        db::query("UPDATE ".PREF."products SET active = '".intval($operation)."' WHERE id = '".intval($id)."'");
        return true;
    }
    
    public function delete_product_image($id){
        $file_to_del = db::get_one("SELECT image FROM ".PREF."products WHERE id = '".intval($id)."'");
        if(!empty( $file_to_del)){
            @unlink('../'.$file_to_del);
        }
        db::query("UPDATE ".PREF."products SET image = '' WHERE id = '".intval($id)."'");
        return true;
    }
    
    public function delete_product($id){
        $file_to_del = db::get_one("SELECT image FROM ".PREF."products WHERE id = '".intval($id)."'");
        if(!empty( $file_to_del)){
            @unlink('../'.$file_to_del);
        }
        db::query("DELETE FROM ".PREF."products WHERE id = '".intval($id)."'");
        return true;
    }
    
}
