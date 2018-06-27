<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>
<script>
$(document).ready(function(){
   $(".modal").on("show.bs.modal", function() {
        var width = $(this).find('.modal-body').find('img').width();
        var width = width + 2*15;
        $(this).find(".modal-content").css("width", width);
        $(this).find(".modal-dialog").css("width", width);
    });

});
</script>
<style>
    .text-1{width: 100%; height: 210px;}
    .modal-body{
       text-align: center; 
    }
    .prices{
        margin:auto;
        display: table;
    }
    .prices .p{
        margin: 0px 20px 20px 20px;
        float: left;
        text-align: center;
    }
    .prices .p b{
        display:block;
        padding:5px;
        border-bottom: 1px #000 solid;
        margin-bottom: 5px;
    }
    .clear{clear:both;}
</style>
<div class="product-unit container-fluid">
    <div class="container">
        <div class="row">
            
            <div class="menu-block">
                    <a <?if(0 === $catId) echo 'class="active"'?> href="<?=HOST?>menu/" title="">ALL</a>
                    <?php if(!empty($aCategories)){
                            foreach($aCategories as $k=>$v){?>
                    <a href="<?=HOST?>menu/<?=$k?>/" title="<?=$v['name']?>" <?if($k === $catId) echo 'class="active"'?>><?=$v['name']?></a>
                            <?php }
                    }?>
            </div>

            <div class="clearfix"></div>
            
            <?php if(!empty($aProducts)){?>
                <?foreach($aProducts as $k=>$prod){?>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <!-- Start productunit-block -->
                    <div class="productunit-block">
                            <div class="productunit-body" style="background-image:url(<?if(!empty($prod['image'])){?><?=HOST.$prod['image']?><?}?>);">
                                <a href="#" data-toggle="modal" data-target="#mod<?=$prod['id']?>" class="popup-on">
                                    <div class="text-1"><?=$prod['name']?></div>
                                    <div class="text-23">
                                            <div class="text-2"><?=$aCategories[$prod['cat_id']]['name']?></div>
                                            <?if(!empty($prod['thc'])){?>
                                            <div class="text-3">THC: <?=$prod['thc']?>%</div>
                                            <?}?>
                                    </div>
                                </a>
                                
                                <div class="modal fade" id="mod<?=$prod['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?=$prod['name']?></h4>
                                      </div>
                                      <div class="modal-body">
                                          <?if(!empty($prod['prices'])){?>
                                          <div class="prices">
                                              <?foreach($prod['prices'] as $p){?>
                                              <div class="p"><b><?=$p['name']?></b><span>$<?=  number_format($p['price'], 2, '.', ',')?></span></div>
                                              <?}?>
                                              <div class="clear"></div>
                                          </div>
                                          <?}?>
                                        <?if(!empty($prod['image'])){
                                            $size = getimagesize ( $prod['image'] );
                                            ?>
                                        <img src="<?=HOST.$prod['image']?>" alt="<?=$prod['name']?>" <?=$size[3]?>/>
                                        <?}?>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?if(isset($aAuth['id']) and !empty($aAuth['verified'])){?>
                                <a href="<?=HOST?>cart/add/<?=$prod['id']?>" title="" class="cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                                <?}?>
                            </div>
                    </div>
                    <!-- Stop productunit-block -->
            </div>
                <?}?>
            <?}else{?>
            <p>Products not found</p>
            <?}?>

        </div>
    </div>
</div>

<?php include '_footer_tpl.php'?>