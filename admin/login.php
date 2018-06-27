<?php
include_once '../includes/common.php';
unset($_SESSION['admin_ids']);
unset($_SESSION['sorting']);
if(isset($_POST['login']) and isset($_POST['pass'])){  
    app::auth($_POST['login'], $_POST['pass'], './index.php', './login.php');
}
include 'templates/login_tpl.php';
?>