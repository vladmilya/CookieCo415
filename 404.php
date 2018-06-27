<?php
header("HTTP/1.0 404 Not Found");
include 'includes/common.php';

$aSettings = app::getSettings();


include 'templates/404_tpl.php';