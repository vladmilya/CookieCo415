<!-- Start the upper band -->
<div class="upper-band container-fluid">
        <div class="container">
                <div class="row">						  
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
                        <div class="pull-left">					
                                <span><?=$aSettings['address']?></span>
                        </div>

                        <div class="pull-right">
                                <span><i class="fa fa-phone" aria-hidden="true"></i> <?=$aSettings['phone']?></span>
                                <span>&nbsp; <a href="mailto:<?=$aSettings['email']?>" title=""><i class="fa fa-envelope-o" aria-hidden="true"></i> <?=$aSettings['email']?></a></span> 
                        </div>
                </div>
        </div>
</div>
<!-- Stop the upper band -->

<!-- Start navigation -->
<div id="menu" class="default navigation container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
            <?if(!empty($aTopMenu)){?>
                <nav class="navbar navbar-default">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                            <?foreach($aTopMenu as $mnu){?>
                                <li<?if($mnu['active']){?> class="active"<?}?>><a href="<?=substr(HOST, 0, strlen(HOST)-1)?><?=$mnu['link']?>" title="<?=$mnu['title']?>"><?=$mnu['title']?></a></li>
                            <?}?>
                            <?if(empty($aAuth['id'])){?>
                                <li<?if($alias === 'register'){?> class="active"<?}?>><a href="<?=HOST?>register/" title="Register">Register</a></li>
                                <li<?if($alias === 'login'){?> class="active"<?}?>><a href="<?=HOST?>login/" title="Login">Login</a></li>
                            <?}else{?>
                                <li<?if($alias === 'account'){?> class="active"<?}?>><a href="<?=HOST?>account/" title="Account">Account</a></li>
                                <?if(!empty($aCart['items'])){?>
                                <li<?if($alias === 'cart'){?> class="active"<?}?>><a href="<?=HOST?>cart/" title="Shopping Cart">Cart (<?=count($aCart['items'])?>)</a></li>    
                                <?}?>
                                <li<?if($alias === 'login'){?> class="active"<?}?>><a href="<?=HOST?>login/" title="Login">Logout</a></li>
                            <?}?>
                            </ul>
                        </div>
                </nav>
            <?}?>
            </div>
        </div>
    </div>
</div>
<!-- Stop navigation -->