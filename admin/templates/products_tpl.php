<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>
<style>
    .glyphicon-remove{color:#f00}
    .on{color:#0d0}
    .off{color:#aaa}
    .table-striped tr td{vertical-align: middle!important}
</style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header">Products &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary navbar-btn" onclick="parent.location='edit_product.php?cat=<?=$catId?>'">Add New</button></h1>
     <?if(!empty($aProducts)){?>
    <table class="table table-striped">
        <tr>
            <th width="120">Photo</th>            
            <th>Name</th>
            <th>Category</th>
            <th width="150">Active/Inactive</th>
            <th width="100">Delete</th>
        </tr>
       <?foreach($aProducts as $k=>$prod){?>
        <tr>
            <td><?if(!empty($prod['image'])){?><img src="<?=HOST.$prod['image']?>" width="100"/><?}?></td>            
            <td><a href="edit_product.php?cat=<?=$catId?>&id=<?=$prod['id']?>"><?=$prod['name']?></a></td>
            <td><?=$aCategories[$prod['cat_id']]['name']?></td>
            <td><a href="products.php?cat=<?=$catId?>&<?=$prod['active'] == '1' ? 'deactivate' : 'activate'?>=<?=$prod['id']?>"><span class="glyphicon glyphicon glyphicon-ok <?=$prod['active'] == '1' ? 'on' : 'off'?>" aria-hidden="true"></span></a></td>
            <td><a href="products.php?cat=<?=$catId?>&remove=<?=$prod['id']?>" onclick="return confirm('Are you sure you want to delete this product?')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>
       <?}?>       
    </table>
    
    <?=$sPageListing?>
    
     <?}else{?>
    <p>Products not found</p>
     <?}?>
    
</div>

<?php include '_footer_tpl.php'?>