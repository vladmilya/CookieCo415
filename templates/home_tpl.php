<?php include '_header_tpl.php'?>

<!-- Start home-fon-header -->
<div class="home-fon-header" style="background-image:url(<?=HOST.$aSections[0]['img']?>);">
		
    <?php include '_menu_tpl.php'?>
	
    <!-- Start logo home page -->
    <div class="logo-home-page"><h1><img src="images/logo_lookies.png" alt="<?=$aSections[1]['header']?>" /></h1></div>
    <!-- Stop logo home page -->

</div>
<!-- Stop home-fon-header -->

<!-- Start The Cookie Co. 415 Herbal Mission -->
<div class="cookie-herbal-mission container-fluid">
	<div class="container">
		<div class="row">
			<h2><?=$aSections[0]['header']?></h2>
			<?=$aSections[0]['content']?>
		</div>
	</div>
</div>
<!-- Stop The Cookie Co. 415 Herbal Mission -->

<!-- Start logo-block-1 -->
<div class="logo-block-1 container-fluid" style="background-image:url(<?=HOST.$aSections[1]['img']?>);">
			<div class="block-5logo">
				<?=$aSections[1]['content']?>
			</div>
	</div>
</div>
<!-- Stop logo-block-1 -->

<!-- Start logo-block-2 -->
<div class="logo-block-2 container-fluid">
	<div class="container">
		<div class="row">
			<div class="table-logoblock2">
				<?=$aSections[2]['content']?>
			</div>
		</div>
	</div>
</div>
<!-- Stop logo-block-1 -->

<!-- Start CookieCo offers FREE DELIVERY in the San Francisco Bay Area. -->
<div class="cookieco-offers container-fluid">
	<div class="container">
		<div class="row">
			<h2><?=$aSections[3]['header']?></h2>
			
			<?=$aSections[3]['content']?>
			
		</div>
	</div>
</div>
<!-- Stop CookieCo offers FREE DELIVERY in the San Francisco Bay Area. -->

<?php include '_footer_tpl.php'?>