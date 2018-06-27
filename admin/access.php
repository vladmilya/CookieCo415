<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = 'access';

$aSubmenu = array();

if(@$_POST['pass_sent']){
    $is_admin = db::get_one("SELECT id FROM ".PREF."admin_part WHERE password = '".md5($_POST['current_pass'])."'");
    if($is_admin){
        if(!empty($_POST['new_pass'])){
            if($_POST['new_pass'] === $_POST['conf_new_pass']){
                db::query("UPDATE ".PREF."admin_part SET password='".md5($_POST['new_pass'])."' WHERE id='1'");
                header("Location: access.php?admin_pass_updated=1");
            }
            else{
                header("Location: access.php?mismatch_admin_pass=1");
            }
        }else{
            header("Location: access.php?empty_pass_error=1");
        }
    }
    else{
        header("Location: access.php?pass_error=1");
    }
}

if(isset($_POST['email'])){
    db::query("UPDATE ".PREF."admin_part SET email=? WHERE id='1'", array($_POST['email']));
    header("Location: access.php?email_updated=1");
}
$currEmail = db::get_one("SELECT email FROM ".PREF."admin_part WHERE id='1'");

include 'templates/access_tpl.php';
?>


