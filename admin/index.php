<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = '';

$aSubmenu = array();

include 'templates/index_tpl.php';
?>
