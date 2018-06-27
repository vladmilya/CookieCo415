<?php
class class_menu{
    
    public $root;
    
    function get_menu($id, $startlevel = 0, $levels = null, $active=''){
        if($levels > 0){
            $levels--;
        }
        else{
            unset($levels);
        }
        
        $aLevel = db::get("SELECT * FROM ".PREF."menu WHERE menu_id = '".intval($id)."' AND parent_id = '".intval($startlevel)."' ORDER BY ord");
        if(!empty($aLevel)) foreach($aLevel as $k=>$v){
            $aMenu[$v['id']] = $v;
            $is_submenu = db::get_one("SELECT COUNT(*) FROM ".PREF."menu WHERE parent_id = '".$v['id']."' ");
            if($is_submenu){
                if(isset($levels)){
                    if($levels > 0){
                        $aMenu[$v['id']]['submenu'] = $this->get_menu($id, $v['id'],$levels,$active);
                    }
                }else{
                    $aMenu[$v['id']]['submenu'] = $this->get_menu($id, $v['id'],null,$active);
                }
                $aMenu[$v['id']]['is_submenu'] = 1;
            }else{
                $aMenu[$v['id']]['is_submenu'] = 0;
            }
            if($active == $v['id']){
                $aMenu[$v['id']]['active'] = 1;
            }elseif(!empty($active) and strstr($v['link'], $active)){
                $aMenu[$v['id']]['active'] = 1;
            }else{
                $aMenu[$v['id']]['active'] = 0;
            }
        }
        if(!empty($aMenu))
            return $aMenu;
        else
            return false;
    }

    function get_admin_menu($id, $menu=''){
        static $sMenu;
        if(!$menu){
            $aMenu = $this->get_menu($id, 0, null, '');
        }
        else{
            $aMenu = $menu;
        }
        if(empty($aMenu) or !count($aMenu)){
            return false;
        }
        
        $sMenu.= '<div class="menu"><ul>';
        foreach($aMenu as $top){
            $sMenu.='<li>';
            $del_btn = '<a class="delete" href="menu.php?id='.intval($id).'&del='.$top['id'].'" onclick="return confirm(\'Are You sure You want to delete this menu item?\')" title="delete"><span class="glyphicon glyphicon-remove"></span></a>';
            
            $sMenu.= '<a class="ttl" href="edit_menu_item.php?id='.intval($id).'&item_id='.$top['id'].'">'.$top['title'].'</a>
                          <input type="text" size="3" name="ord['.$top['id'].']" value="'.$top['ord'].'" title="order"/>
                          '.$del_btn;
            if(@$top['submenu']){
                $this->get_admin_menu($id, $top['submenu']);
            }
            $sMenu.='</li>';
        }
        $sMenu.='</ul></div>';
        return $sMenu;
    }
    
    function get_menu_item($id){
        $item = db::get_row("SELECT * FROM ".PREF."menu WHERE id = '".intval($id)."' ");        
        return $item;
    }
    
    function edit_item($id){
        if(!@trim($_POST['title']) or !@trim($_POST['link']) or !$id){
            return "Titles and Link are required fields";
        }
              
        $ok = db::query("UPDATE ".PREF."menu SET
                            `parent_id` = '".intval($_POST['parent_id'])."',
                            `title` = ?,                           
                            `link` = ?
                            WHERE id = '".(int)$id."'
                            ",array($_POST['title'],$_POST['link']));
        if($ok) return "ok";
        else return "database updating error";
    }
    
    function add_item($menu_id){
        if(!@trim($_POST['title']) or !@trim($_POST['link'])){
            return "Titles and Link are required fields";
        }
        $ord = db::get_one("SELECT MAX(ord) FROM ".PREF."menu WHERE `menu_id` = '".intval($menu_id)."'");      
        $ok = db::query("INSERT INTO ".PREF."menu SET
                            `menu_id` = '".intval($menu_id)."',
                            `parent_id` = '".intval($_POST['parent_id'])."',
                            `title` = ?,                            
                            `link` = ?,
                            `ord` = '".($ord+1)."'
                            ",array($_POST['title'],$_POST['link']));
        if($ok) return "ok";
        else return "database inserting error";
    }
    
    function delete_item($id){
        if(intval($id) != 1){
            $parent_id = db::get_one("SELECT parent_id FROM ".PREF."menu WHERE id = '".intval($id)."'");
            $del = db::query("DELETE FROM ".PREF."menu WHERE id = '".intval($id)."'");
            if($del){
                $ok = db::query("UPDATE ".PREF."menu SET parent_id = '".$parent_id."' WHERE parent_id = '".intval($id)."'");
                return true;
            }else{
                return false;
            }            
        }else{
            return false;
        }
    }

}