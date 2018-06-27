<!-- Start footer -->
<div class="footer container-fluid">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <?if(!empty($aFooterMenu)){?>
				<div class="navigation-footer">
                                    <?foreach($aTopMenu as $mnu){?>
					<a href="<?=substr(HOST, 0, strlen(HOST)-1)?><?=$mnu['link']?>" title="<?=$mnu['title']?>"><?=$mnu['title']?></a>
                                    <?}?>
                                    <?if(empty($aAuth['id'])){?>
                                        <a href="<?=HOST?>register/" title="Register">Register</a>
                                    <?}?>
				</div>
                            <?}?>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 boder-left">
				<div class="contact-footer">
					<i class="fa fa-phone" aria-hidden="true"></i> <?=$aSettings['phone']?>
					<div class="clearfix"></div>
					<a href="mailto:<?=$aSettings['email']?>" title="">
						<i class="fa fa-envelope-o" aria-hidden="true"></i> <?=$aSettings['email']?>
					</a>
					<div class="clearfix"></div>
					<?=$aSettings['address']?>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 boder-left">
				<div class="social-footer">
                                    <?if($aSettings['facebook']){?>
					<a href="<?=$aSettings['facebook']?>" title=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <?}?>
                                    <?if($aSettings['twitter']){?>   
					<a href="<?=$aSettings['twitter']?>" title=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <?}?>
                                    <?if($aSettings['instagram']){?>
					<a href="<?=$aSettings['instagram']?>" title=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <?}?>
                                    <?if($aSettings['google']){?>
					<a href="<?=$aSettings['google']?>" title=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    <?}?>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 boder-left">
				<div class="logo-footer">
					<a href="<?=HOST?>" title=""><img src="<?=HOST?>images/logo_lookies_footer.png" alt="" /></a>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!-- Stop footer -->

<script src="<?=HOST?>js/bootstrap.min.js"></script>
</body>
</html>