<?php include '_header_tpl.php'?>
<script type="text/javascript" src="../includes/ckeditor/ckeditor.js"></script>
<?php include '_sidebar_tpl.php'?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header">General Settings</h1>
    
    <?if(!empty($error)){?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?}?>
    <?if(!empty($_GET['updated'])){?>
    <div class="alert alert-success" role="alert">The page has been updated.</div>
    <?}?>
    
    <form action="" method="post" name="login" class="form-horizontal">
        
        <input type="hidden" name="sent" value="1"> 
        
        <div class="form-group">
            <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-10">
                <input name="phone" id="inputPhone" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['phone']) ? $_POST['phone'] : (isset($aItem['phone']) ? $aItem['phone'] : ''))?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input name="email" id="inputEmail" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : (isset($aItem['email']) ? $aItem['email'] : ''))?>">
            </div>
        </div>
        
         <div class="form-group">
            <label for="inputAddress" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                <input name="address" id="inputAddress" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['address']) ? $_POST['address'] : (isset($aItem['address']) ? $aItem['address'] : ''))?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputFacebook" class="col-sm-2 control-label">Facebook</label>
            <div class="col-sm-10">
                <input name="facebook" id="inputFacebook" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['facebook']) ? $_POST['facebook'] : (isset($aItem['facebook']) ? $aItem['facebook'] : ''))?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputTwitter" class="col-sm-2 control-label">Twitter</label>
            <div class="col-sm-10">
                <input name="twitter" id="inputTwitter" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['twitter']) ? $_POST['twitter'] : (isset($aItem['twitter']) ? $aItem['twitter'] : ''))?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputInstagram" class="col-sm-2 control-label">Instagram</label>
            <div class="col-sm-10">
                <input name="instagram" id="inputInstagram" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['instagram']) ? $_POST['instagram'] : (isset($aItem['instagram']) ? $aItem['instagram'] : ''))?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="inputGoogle" class="col-sm-2 control-label">Google+</label>
            <div class="col-sm-10">
                <input name="google" id="inputGoogle" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['google']) ? $_POST['google'] : (isset($aItem['google']) ? $aItem['google'] : ''))?>">
            </div>
        </div>
        
         
        <div class="form-group">
            <label for="inputCopyrightFr" class="col-sm-2 control-label">Analytics Script</label>
            <div class="col-sm-10">
                <textarea name="analytics_script" id="inputAnalytics" class="form-control" cols="150" rows="10"><?=htmlspecialchars(isset($_POST['analytics_script']) ? $_POST['analytics_script'] : (isset($aItem['analytics_script']) ? $aItem['analytics_script'] : ''))?></textarea>
            </div>
        </div>
        <br />
            
        <div class="form-group">
            <label for="inputTitleEn" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">                 
                <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block btn100"/>                      
            </div>
        </div>
        
    </form>
    <br />
    
    
</div>

<?php include '_footer_tpl.php'?>