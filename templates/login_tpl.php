<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>

<!-- Start Register -->
<div class="register container-fluid">
	<div class="container">
		<div class="row">
		
			<h1>Login</h1>
			
			<div class="form-register">
                             <?if(!empty($error)){?>
                            <div class="alert alert-danger" role="alert"><?=$error?></div>
                            <?}?>
                            <form action="" method="post" name="reg_form"  enctype="multipart/form-data">
                                <input type="hidden" name="sent" value="1" />
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value=""/>
                                </div>                                
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>

                                <button type="submit" class="button-f1">Submit</button>
			    </form>
			</div>
			
		</div>
	</div>
</div>
<!-- Stop Register -->

<?php include '_footer_tpl.php'?>