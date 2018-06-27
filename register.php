<?php
include 'includes/common.php';

$aAuth = check_auth();

$aSettings = app::getSettings();

$alias = 'register';

$aPage = $oPages->get_page($alias);


$oMenu = app::loadModel('menu');
$aTopMenu = $oMenu->get_menu(1, 0, null, $alias);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $alias);

$oUsers = app::loadModel('user');

if(isset($_POST['sent'])){
    $result = $oUsers->add_user($_POST['data'], $_FILES['doc']);
    if(is_numeric($result)){
        $login = $oUsers->login($_POST['data']['username'], $_POST['data']['password']);
        if($login){
            //email to admin
            $oEmail = app::loadModel('email');
            $subject = "New registration on ".SITE_NAME;
            $body = "";
            $body .= "<b>Username: </b>".htmlspecialchars($_POST['data']['username'])."<br />";
            $body .= "<b>Name: </b>".htmlspecialchars($_POST['data']['name'])."<br />";
            $body .= "<b>Email: </b>".htmlspecialchars($_POST['data']['email'])."<br />";
            //$body .= "<b>Phone: </b>".htmlspecialchars($_POST['data']['phone'])."<br />";
            $body .= "<b>Address: </b>".htmlspecialchars($_POST['data']['address'])."<br />";
            
            $admin_email = $aSettings['email'];
            //$admin_email = ADMIN_EMAIL;            
            $result = $oEmail->email($admin_email, $subject, $body);
            
            header("Location: ".HOST."account/");
        }else{
            $error = 'Registration failed. Please try later.';
        }
    }else{
        $error = $result;
    }
}


include 'templates/register_tpl.php';