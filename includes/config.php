<?php
//--------------database connection-------------------------
$aConf['host']="db host";
$aConf['user']="db user";
$aConf['password']="db pass";
$aConf['database']="db name";
$aConf['encoding']="utf8";



define('PREF', 'cc_');

//--------------folders------------------------------------
define('ABS', "/path/to/project/folder/");
define('HOST', 'http://project.server/');
define('SITE_NAME', 'Cookie Co.415');

//--------------pagination---------------------------------
$SEARCH_ROWS_MAX = 20;

//--------------email---------------------------------------
define('ADMIN_EMAIL', 'admin@example.com');
define('MAIL_SMTP',false);
define('SMTP_HOST','localhost');
define('SMTP_AUTH',false);
define('SMTP_USER','user');
define('SMTP_PASS','pass');
define('MAIL_FROM', 'mailer@example.com');
define('MAIL_CHARSET', 'windows-1251');

define('GALLERY_FOLDER', 'gallery');
define('IMAGE_ORIGINAL_WIDTH', '400');
define('MAX_ALLOWED_IMAGE_SIZE', '200000'); //bytes
define('MAX_ALLOWED_IMAGE_WIDTH', '2000');
define('MAX_ALLOWED_IMAGE_HEIGHT', '2000');

//-----------POS API-----------------------
define('API_KEY', '420softwarepos server api key');
define('API_URL', 'http://420softwarepos.server/API/PostOrder/');

//date format
define('DATE_FORMAT',"%m/%d/%Y");

//time format
define('TIME_FORMAT',"%I:%M:%S %p");

//main currency
define('CURRENCY',"$");

?>