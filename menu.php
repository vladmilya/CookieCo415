<?php
include 'includes/common.php';

$aAuth = check_auth();

$aSettings = app::getSettings();

$alias = 'menu';

$aPage = $oPages->get_page($alias);


$oMenu = app::loadModel('menu');
$aTopMenu = $oMenu->get_menu(1, 0, null, $alias);
$aFooterMenu = $oMenu->get_menu(2, 0, null, $alias);

$oProducts = app::loadModel('product');

$catId = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

$aProducts = $oProducts->get_products($catId, 0, true, 0);

$_SESSION['back_to_menu'] = $_SERVER['REQUEST_URI'];

$oCart = app::loadModel('cart');
$aCart = $oCart->get_cart();

include 'templates/menu_tpl.php';

