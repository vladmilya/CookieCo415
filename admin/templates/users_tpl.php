<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>
<style>
    .glyphicon-remove{color:#f00}
    .on{color:#0d0}
    .off{color:#aaa}
    .table-striped tr td{vertical-align: middle!important}
</style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header">User List</h1>
    <?if(!empty($aUsers)){?>
    <table class="table table-striped">
         <tr>
            <th><?sortableHeader('Name', 'users.php?cat='.$cat, 'name', $ord, false, $ordby)?></th>            
            <th><?sortableHeader('Email', 'users.php?cat='.$cat, 'email', $ord, false, $ordby)?></th>
            <th><?sortableHeader('Reg. Date', 'users.php?cat='.$cat, 'reg_date', $ord, true, $ordby)?></th>
            <th width="100"><?sortableHeader('Verified', 'users.php?cat='.$cat, 'verified', $ord, false, $ordby)?></th>
            <th width="50">Delete</th>
        </tr>
        <?foreach($aUsers as $k=>$user){?>
        <tr>
            <td><a href="user_details.php?id=<?=$user['id']?>"><?=$user['name']?></a></td>
            <td><?=$user['email']?></td>
            <td><?=strftime("%m/%d/%Y",$user['reg_date'])?></td>
            <td><?if($user['verified'] == '1'){?><span class="glyphicon glyphicon glyphicon-ok on" aria-hidden="true"></span><?}?></td>
            <td><a href="users.php?cat=<?=$cat?>&remove=<?=$user['id']?>" onclick="return confirm('Are you sure you want to delete user <?=$user['name']?>?')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>
        <?}?>
    </table>
    <?=$sPageListing?>
    <?}else{?>
    <p>Users not found</p>
     <?}?>
    
</div>

<?php include '_footer_tpl.php'?>