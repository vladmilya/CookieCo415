<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>
<style>
    .wellcome_msg{
        font-weight: bold;
        font-size: 16px;
        margin: 0 auto 30px auto;
        text-align: center;
    }
    .user_img img{
        max-width: 400px;
    }
</style>
<!-- Start Register -->
<div class="register container-fluid">
	<div class="container">
		<div class="row">
		
			<h1>Account</h1>
                        
                        <?if(empty($aAuth['verified'])){?>
                        <p class="wellcome_msg">
                            Thank you for registration!<br />Your account is not verified at the moment. Our responsible person will check provided information shortly.<br /> 
                            When verification is complete, you will be notified by email.
                        </p>
                        <?}else{?>
                        <p class="wellcome_msg">Welcome <?=$aAuth['name']?></p>
                        <?}?>
			
			<div class="form-register">
                             <?if(!empty($error)){?>
                            <div class="alert alert-danger" role="alert"><?=$error?></div>
                            <?}?>
                            <form action="" method="post" name="reg_form"  enctype="multipart/form-data">
                                <input type="hidden" name="sent" value="1" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="data[name]" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['name']) ? $_POST['data']['name'] : (isset($aUser['name']) ? $aUser['name'] : ''))?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="data[username]" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['username']) ? $_POST['data']['username'] : (isset($aUser['username']) ? $aUser['username'] : ''))?>"/>
                                </div>  
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="data[address]" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['address']) ? $_POST['data']['address'] : (isset($aUser['address']) ? $aUser['address'] : ''))?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="text" name="data[email]" class="form-control"  value="<?=htmlspecialchars(isset($_POST['data']['email']) ? $_POST['data']['email'] : (isset($aUser['email']) ? $aUser['email'] : ''))?>"/>
                                </div>
                                <div class="form-group">
                                    <?if(!empty($aUser['driver_license'])){?>
                                    <div class="user_img">
                                    <img src="<?=HOST.$aUser['driver_license']?>"/>
                                    </div>
                                    <?}?>
                                    <label>Upload driver license</label>
                                    <input type="file" name="doc[driver_license]"/>
                                </div>
                                <div class="form-group">
                                    <?if(!empty($aUser['rec'])){?>
                                    <div class="user_img">
                                    <img src="<?=HOST.$aUser['rec']?>"/>
                                    </div>
                                    <?}?>
                                    <label>Upload Rec.</label>
                                    <input type="file" name="doc[rec]"/>
                                </div>  

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="data[password]" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="data[confirm_password]" class="form-control" />
                                </div>

                                <button type="submit" class="button-f1">Submit</button>
			    </form>
			</div>
			
		</div>
	</div>
</div>
<!-- Stop Register -->

<?php include '_footer_tpl.php'?>