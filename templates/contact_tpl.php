<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>

<div class="contact-us container-fluid">
    <div class="container">
    <?if(!empty($aSections)){?>
        <?foreach($aSections as $sect){?>
        <div class="row">            
            
            <h1><?=$sect['header']?></h1>
            
            <div class="contact-footer">
                    <i class="fa fa-phone" aria-hidden="true"></i> <?=$aSettings['phone']?>
                    <div class="clearfix"></div>
                    <a href="mailto:<?=$aSettings['email']?>" title="">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i> <?=$aSettings['email']?>
                    </a>
                    <div class="clearfix"></div>
                    <?=$aSettings['address']?>
            </div>	
            
            <?=$sect['content']?>
            
        </div> 
        <?}?>            
    <?}?>
    </div>
</div>

<?php include '_footer_tpl.php'?>