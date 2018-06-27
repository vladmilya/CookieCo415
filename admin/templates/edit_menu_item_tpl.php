<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header"><?=$pageTitle?></h1>
    
    <h2><?if(isset($aItem)) echo 'Edit';else echo 'Add'?> menu item</h2>
    
    <?if(!empty($error)){?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?}?>
    <form action="" method="post" name="login" class="form-horizontal">
     
        <input type="hidden" name="sent" value="1"> 
        <div class="dataGrid">
            
            <div class="form-group">
                <label for="inputTitle" class="col-sm-2 control-label">Title *</label>
                <div class="col-sm-10">
                    <input name="title" id="inputTitle" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['title']) ? $_POST['title'] : (isset($aItem['title']) ? $aItem['title'] : ''))?>" required/>
                </div>
            </div>
            
            <input type="hidden" name="parent_id" value="0" />
            <?/*<div class="form-group">
                <label for="inputTitleEn" class="col-sm-2 control-label">Parent Item</label>
                <div class="col-sm-10">
                    <select name="parent_id" class="form-control">
                        <option value="0">---</option>
                        <?if(!empty($aParentMenu)){?>
                        <?foreach($aParentMenu as $pm){?>
                        <?if($pm['id'] != $aItem['id']){?>
                        <option value="<?=$pm['id']?>"<?if($pm['id'] == @$aItem['parent_id'] or $pm['id'] == @$_POST['parent_id']) echo ' selected'?>><?=$pm['title']?></option>  
                        <?}?>
                        <?}?>
                        <?}?>
                    </select>
                </div>
            </div>*/?>
            
            <div class="form-group">
                <label for="inputLink" class="col-sm-2 control-label">Link *</label>
                <div class="col-sm-10">
                    <input name="link" id="inputLink" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['link']) ? $_POST['link'] : (isset($aItem['link']) ? $aItem['link'] : ''))?>" required/>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">                 
                    <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block btn100"/>                        
                    <input type="button" value="Cancel" class="btn btn-lg btn-info btn-block btn100" onclick="parent.location='menu.php?id=<?=$menuId?>'"/>       
                </div>
            </div>
        </div>
            
        <br />
        
        
    </form>
    
    </div>
    
</div>

<?php include '_footer_tpl.php'?>