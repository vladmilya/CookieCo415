<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header">Access</h1>
    
    <h2>Administrator's Password</h2>
    <?if(@$_GET['admin_pass_updated']){?>
    <div class="alert alert-success" role="alert">Administrator's password has been updated!</div>
    <?}?>
    <?if(@$_GET['pass_error']){?>
    <div class="alert alert-danger" role="alert">Wrong current password!</div>
    <?}?>
    <?if(@$_GET['mismatch_admin_pass']){?>
    <div class="alert alert-danger" role="alert">Passwords mismatch!</div>
    <?}?>
    <form action="" method="post" name="login" style="width:240px;">
     
        <input type="hidden" name="pass_sent" value="1">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-asterisk"></span></span>
            <input name="current_pass" type="password" class="form-control" placeholder="Current Password" aria-describedby="basic-addon1"/>
        </div>
        <br />
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-asterisk"></span></span>
            <input name="new_pass" type="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon2"/>
        </div>
        <br />
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-asterisk"></span></span>
            <input name="conf_new_pass" type="password" class="form-control" placeholder="Confirm New Password" aria-describedby="basic-addon3"/>	
        </div>
        <br />
        <input type="submit" value="Save" name="submit" class="btn btn-lg btn-primary btn-block" />
    </form>
    <br />
    <h2 class="sub-header">Administrator's Email Address</h2>
    <?if(@$_GET['email_updated']){?>
    <div class="alert alert-success" role="alert">Administrator's email has been updated!</div>
    <?}?>
    <form action="" method="post" name="email_form" style="width:240px;">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            <input name="email" type="email"  class="form-control"  value="<?=$currEmail?>"/>
        </div>
        <br />
	<input type="submit" value="Save" name="submit" class="btn btn-lg btn-primary btn-block" />
    </form>
</div>

<?php include '_footer_tpl.php'?>