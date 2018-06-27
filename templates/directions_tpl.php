<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>

<div class="contact-us container-fluid" style="padding-bottom:0;">
    <?if(!empty($aSections)){?>
        <?foreach($aSections as $sect){?>
        <div class="row">            
            
            <h1><?=$sect['header']?></h1>
            
            <?=$sect['content']?>
            
        </div> 
        <?}?>            
    <?}?>
</div>

<?php include '_footer_tpl.php'?>