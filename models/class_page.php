<?php
class class_page{
    
    public $root;
    protected $load_time;

    function __construct() {
        $this->load_time = time();
    }   
    
    function get_pages_headers(){
        $aPages = db::get("SELECT id, title FROM ".PREF."pages");        
        return $aPages;
    }
    
    function get_page($alias){
        $page = db::get_row("SELECT * FROM ".PREF."pages WHERE alias = ? LIMIT 1",array(db::clear($alias)));        
        return $page;
    }

    function get_page_admin($id){
        $page = db::get_row("SELECT * FROM ".PREF."pages WHERE id = '".intval($id)."' ");        
        return $page;
    }
       
    function edit_page($id){
        $top_image_sql = '';
        $is_image = false;
        if(@$_FILES['header_img']['name']){
            $is_image=preg_match("/^(image\/)[a-zA-Z]{3,4}/",$_FILES['header_img']['type']);
            if($is_image){
                $image_name ='gallery/'.$this->load_time.'_'.$_FILES['header_img']['name'];
                $full_name = ABS.$image_name;
                if(move_uploaded_file($_FILES['header_img']['tmp_name'],$full_name)){
                    //$this->resize_one('../'.$image_name, 957, 'w', '../'.$image_name);
                    $top_image_sql = " `header_img` = '".$image_name."', ";
                    $file_to_del = db::get_one("SELECT header_img FROM ".PREF."pages WHERE id = '".intval($id)."'");
                    if(!empty( $file_to_del)){
                        @unlink('../'.$file_to_del);
                    }
                }
            }
            else{
                return "Wrong top image format!";
            }
        }
      
        $ok = db::query("UPDATE ".PREF."pages SET                           
                            `meta_title` = ?,                            
                            `meta_keywords` = ?,
                            `meta_description` = ?
                            WHERE id = '".intval($id)."'
                            ",array(@stripslashes($_POST['meta_title']), @stripslashes($_POST['meta_keywords']),@stripslashes($_POST['meta_description'])));
        if($ok) return "ok";
        else return "database updating error";
    }    
    
    
    function del_top_img($id){
        $file_to_del = db::get_one("SELECT header_img FROM ".PREF."pages WHERE id = '".intval($id)."'");
        db::query("UPDATE  ".PREF."pages SET header_img = '' WHERE id = '".intval($id)."'");
        if(!empty($file_to_del)){
            @unlink('../'.$file_to_del);
        }
    }
    
    function get_fixed_sections($page_alias, $admin = true){
        if(!$admin){
            $displSQL = " AND display = 1";
        }else{
            $displSQL = "";
        }
        $aSectionsTemp = db::get("SELECT * FROM ".PREF."sections WHERE page_alias = ? AND fixed = 1".$displSQL, array($page_alias));
        $aSections = array();
        foreach($aSectionsTemp as $k=>$v){
            $aSections[$v['id']] = $v;
        }
        return $aSections;
    }
    
    function get_section($id){
        $aSection = db::get_row("SELECT * FROM ".PREF."sections WHERE id = '".intval($id)."'");
        $aBlocks = $this->get_section_blocks($aSection['id']);
        if(!empty($aBlocks)){
            $aSection['blocks'] = $aBlocks;
        }
        return $aSection;
    }
    
    function edit_section($id){
        if(isset($_POST['display'])){
            $dspl = 1;
        }else{
            $dspl = 0;
        }
        if(isset($_POST['order'])){
            $ordSql = "ord = '".intval($_POST['order'])."',";
        }else{
            $ordSql = "";
        }
        
        //image
        $image_sql = '';
        $is_image = false;
        if(@$_FILES['img']['name']){
            $is_image=preg_match("/^(image\/)[a-zA-Z]{3,4}/",$_FILES['img']['type']);
            if($is_image){
                $image_name ='gallery/'.$this->load_time.'_'.$_FILES['img']['name'];
                $full_name = ABS.$image_name;
                if(move_uploaded_file($_FILES['img']['tmp_name'],$full_name)){
                    //$this->resize_one('../'.$image_name, 957, 'w', '../'.$image_name);
                    $image_sql = " `img` = '".$image_name."', ";
                    $file_to_del = db::get_one("SELECT img FROM ".PREF."sections WHERE id = '".intval($id)."'");
                    if(!empty( $file_to_del)){
                        @unlink('../'.$file_to_del);
                    }
                }
            }
            else{
                return "Wrong image format!";
            }
        }       
        
        $ok = db::query("UPDATE ".PREF."sections SET 
                            `header` = ?,
                            `content` = ?,                            
                            $image_sql
                            $ordSql
                            `display` = '".$dspl."'
                         WHERE id = '".intval($id)."'",
                array(stripslashes($_POST['header']),stripslashes($_POST['content'])));
        if($ok) return "ok";
        else return "database updating error";
    }
    
       
    function del_section_img($id){
        $file_to_del = db::get_one("SELECT img FROM ".PREF."sections WHERE id = '".intval($id)."'");
        db::query("UPDATE  ".PREF."sections SET img = '' WHERE id = '".intval($id)."'");
        if(!empty($file_to_del)){
            @unlink('../'.$file_to_del);
        }
    }    
   
}