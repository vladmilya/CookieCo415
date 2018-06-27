<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?> 
<style>
     .user_img img{
        max-width: 400px;
        cursor:zoom-in;
    }
</style>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header">User Details</h1>
    
    <?if(!empty($error)){?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?}?>
    
    <form action="" method="post" id="editProductForm" class="form-horizontal">
        
        <input type="hidden" name="sent_user" value="1"> 
        
        <div class="form-group">
            <label for="inputUsername" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="data[username]" id="inputUsername" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['username']) ? $_POST['data']['username'] : (isset($aUser['username']) ? $aUser['username'] : ''))?>" readonly/>
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="data[name]" id="inputName" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['name']) ? $_POST['data']['name'] : (isset($aUser['name']) ? $aUser['name'] : ''))?>" />
            </div>
        </div> 
        
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="data[email]" id="inputEmail" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['email']) ? $_POST['data']['email'] : (isset($aUser['email']) ? $aUser['email'] : ''))?>" />
            </div>
        </div> 
        
        <div class="form-group">
            <label for="inputAddress" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <input type="text" name="data[address]" id="inputEmail" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['address']) ? $_POST['data']['address'] : (isset($aUser['address']) ? $aUser['address'] : ''))?>" />
            </div>
        </div> 
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Driver License</label>
        <?if(!empty($aUser['driver_license'])){?>
            <div class="user_img">
                <a href="<?=HOST.$aUser['driver_license']?>" target="_blank" title="Click to open in a new tab"><img src="<?=HOST.$aUser['driver_license']?>"/></a>
            </div>                     
        <?}?>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">Rec.</label>
        <?if(!empty($aUser['rec'])){?>
            <div class="user_img">
                <a href="<?=HOST.$aUser['rec']?>" target="_blank" title="Click to open in a new tab"><img src="<?=HOST.$aUser['rec']?>"/></a>
            </div>                     
        <?}?>
        </div>
        
        <div class="form-group">
            <label for="inputNotes" class="col-sm-2 control-label">Notes</label>
            <div class="col-sm-10">
                <textarea name="data[notes]" id="inputNotes" class="form-control" rows="6"><?=htmlspecialchars(isset($_POST['data']['notes']) ? $_POST['data']['notes'] : (isset($aUser['address']) ? $aUser['notes'] : ''))?></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputVerified" class="col-sm-2 control-label">Verified</label>
            <div class="col-sm-10">
                <input type="checkbox" name="data[verified]" id="inputVerified" class="form-control" value="1" <?if($aUser['verified']){?>checked<?}?> style="width:auto"/>
            </div>
        </div> 
        
        <div class="form-group">
            <label for="inputTitleEn" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">                 
                    <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block btn100"/>    
                    <input type="button" value="Cancel" class="btn btn-lg btn-info btn-block btn100" onclick="parent.location='<?=isset($_SESSION['back_to_users']) ? $_SESSION['back_to_users'] : 'users.php'?>';return false;"/>                     
            </div>
        </div>
        
    </form>
    
</div>
<?php include '_footer_tpl.php'?>