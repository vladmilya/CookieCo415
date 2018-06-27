<?php include '_header_tpl.php'?>

<?php include '_sidebar_tpl.php'?>
<style>
    .glyphicon-remove{color:#f00}
    .on{color:#0d0}
    .off{color:#aaa}
</style>
<script>
    function updateCategory(){
        $('#submitFlag').val(0);
        $('#editProductForm').submit();
    }
    function submitProduct(){
        $('#submitFlag').val(1);
        $('#editProductForm').submit();
    }
</script>
    
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header"><?if($productId) echo 'Edit';else echo 'Add'?> Product</h1>
    
    <?if(!empty($error)){?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?}?>

    <form action="" method="post" id="editProductForm" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="sent_product" value="0" id="submitFlag"> 
            
            <div class="form-group">
                <label for="inputCategory" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select name="data[cat_id]" class="form-control" id="inputCategory" <?if(!isset($aItem)){?>onchange="updateCategory()"<?}?>>
                        <option value="0">---</option>
                        <?if(!empty($aCategories)){?>
                        <?foreach($aCategories as $k=>$c){?>
                        <?if(isset($aItem)){
                            if($c['measure_type'] !== $aItem['measure_type']){
                                continue;
                            }
                        }?>
                        <option value="<?=$k?>"<?if((isset($aItem) and $k == $aItem['cat_id']) or (isset($_POST['data']['cat_id']) and $k == @$_POST['data']['cat_id']) or $k == $catId) echo ' selected'?>><?=$c['name']?></option>  
                        <?}?>
                        <?}?>
                    </select>
                </div>
            </div>
            
            <br />
            
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="data[name]" id="inputName" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['name']) ? $_POST['data']['name'] : (isset($aItem['name']) ? $aItem['name'] : ''))?>" />
                </div>
            </div> 
            
            <br />
            
            <div class="form-group">
                <label for="inputTHC" class="col-sm-2 control-label">THC</label>
                <div class="col-sm-10">
                    <input type="text" name="data[thc]" id="inputTHC" class="form-control" value="<?=htmlspecialchars(isset($_POST['data']['thc']) ? $_POST['data']['thc'] : (isset($aItem['thc']) ? $aItem['thc'] : ''))?>" />
                </div>
            </div> 
            
            <br /> 
            
            <div class="form-group">
                <label for="inputImg" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                    <?if(@$aItem['image']){?>                
                    <div><img src="../<?=$aItem['image']?>" alt="" width="500"/> <a class="delete" href="edit_product.php?cat=<?=intval($catId)?>&id=<?=intval($productId)?>&amp;del_product_img=1" onclick="return confirm('Are You Sure You Want to Delete this Image?')">delete</a></div>
                    <?}?>
                    <input type="file" id="inputImg" name="image"/>
                </div>
            </div>
            
            <br />
            
            <?php if(isset($aPrices)){?>
            <div class="form-group">
            <label class="col-sm-2 control-label">PRICE (<?=CURRENCY?>)</label>
            </div>
            <br />
                <?php foreach($aPrices as $m=>$price){?>
            
            <div class="form-group">
                <label for="input<?=$m?>" class="col-sm-2 control-label"><?=$price['name']?></label>
                <div class="col-sm-3">
                    <input type="text" name="data[price][<?=$m?>]" id="input<?=$m?>" class="form-control" value="<?=isset($aItem['prices'][$m])? $aItem['prices'][$m]['price']: 0?>" />
                </div>
            </div> 
            
            <br />                 
                <?}?>
            <?}?>
            
            <div class="form-group">
                <label for="inputTitleEn" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">                 
                    <input type="button" value="Save" class="btn btn-lg btn-primary btn-block btn100" onclick="submitProduct();return false;"/>    
                    <input type="button" value="Cancel" class="btn btn-lg btn-info btn-block btn100" onclick="parent.location='<?=isset($_SESSION['back_to_products']) ? $_SESSION['back_to_products'] : 'products.php'?>';return false;"/>                     
                </div>
            </div>
             </form>
    
</div>

<?php include '_footer_tpl.php'?>