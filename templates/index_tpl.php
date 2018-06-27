<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>

<div class="cookieco-offers delivery-block container-fluid">
    <div class="container">
    <?if(!empty($aSections)){?>
        <?foreach($aSections as $sect){?>
        <div class="row">            
            
            <h1><?=$sect['header']?></h1>
            
            <?=$sect['content']?>
            
        </div> 
        <?}?>            
    <?}?>
    </div>
</div>

<?php include '_footer_tpl.php'?>