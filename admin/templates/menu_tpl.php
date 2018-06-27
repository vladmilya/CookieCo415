<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header"><?=$pageTitle?></h1>
    <form action="" method="post">
    <input type="hidden" name="sent" value="1" />
    
    <?=$menu?>
    
    <div class="controls">
        <input type="submit" value="Save Order" class="btn btn-lg btn-primary btn-block btn200"/>
        <input type="button" value="Add new item" onclick="parent.location='edit_menu_item.php?id=<?=$menuId?>';return false;" class="btn btn-lg btn-primary btn-block btn200"/>
    </div>
    </form>
</div>

<?php include '_footer_tpl.php'?>