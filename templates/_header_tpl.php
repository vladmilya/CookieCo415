<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$aPage['meta_title']?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="x-rim-auto-match" content="none">	
	<meta name="keywords" content="<?=$aPages['meta_keywords']?>" />
	<meta name="description" content="<?=$aPage['meta_description']?>" />
	<meta name="author" content="" />
	<link rel="shortcut icon" href="<?=HOST?>images/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="<?=HOST?>images/favicon.png" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?=HOST?>images/favicon.png" type="image/x-icon" />
	<link href="<?=HOST?>css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?=HOST?>font-awesome-4.6.2/css/font-awesome.css" />
	<link href="<?=HOST?>css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=HOST?>js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
			var $menu = $("#menu");
				
			$(window).scroll(function(){
				if ( $(this).scrollTop() > 30 && $menu.hasClass("default") ){
					$menu.fadeOut('fast',function(){
						$(this).removeClass("default")
							   .addClass("fixed")
							   .fadeIn('fast');
					});
				} else if($(this).scrollTop() <= 30 && $menu.hasClass("fixed")) {
					$menu.fadeOut('fast',function(){
						$(this).removeClass("fixed")
							   .addClass("default")
							   .fadeIn('fast');
					});
				}
			});
			
		});
	</script>
</head>
<body>