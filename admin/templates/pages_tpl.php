<?php include '_header_tpl.php'?>
<script type="text/javascript" src="../includes/ckeditor/ckeditor.js"></script>
<?php include '_sidebar_tpl.php'?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    
    <h1 class="page-header"><?=$aItem['title']?></h1>
    
    <?if(!empty($error)){?>
    <div class="alert alert-danger" role="alert"><?=$error?></div>
    <?}?>
    <?if(!empty($_GET['updated'])){?>
    <div class="alert alert-success" role="alert">The page has been updated.</div>
    <?}?>
    
    
    
    <form action="" method="post" name="login" class="form-horizontal" enctype="multipart/form-data">
     
        <input type="hidden" name="sent" value="1"> 
        
            <div class="form-group">
                <label for="inputLink" class="col-sm-2 control-label">Link</label>
                <div class="col-sm-10">
                    <input name="alias" id="alias" type="text" class="form-control" value="<?=HOST.$aItem['alias']?>" readonly="true">
                </div>
            </div>
       
            <div class="form-group">
                <label for="inputMetaTitle" class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                    <input name="meta_title" id="inputMetaTitle" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['meta_title']) ? $_POST['meta_title'] : (isset($aItem['meta_title']) ? $aItem['meta_title'] : ''))?>"/>
                </div>
            </div>
            
            <br />
            
            <div class="form-group">
                <label for="inputMetaKeywords" class="col-sm-2 control-label">Meta Keywords</label>
                <div class="col-sm-10">
                    <input name="meta_keywords" id="inputMetaKeywords" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['meta_keywords']) ? $_POST['meta_keywords'] : (isset($aItem['meta_keywords']) ? $aItem['meta_keywords'] : ''))?>"/>
                </div>
            </div> 
            
            <br />
            
            <div class="form-group">
                <label for="inputMetaDescription" class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                    <input name="meta_description" id="inputMetaDescription" type="text" class="form-control" value="<?=htmlspecialchars(isset($_POST['meta_description']) ? $_POST['meta_description'] : (isset($aItem['meta_description']) ? $aItem['meta_description'] : ''))?>"/>
                </div>
            </div>
            
            <br />
            
            <div class="form-group">
                <label for="inputTitleEn" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">                 
                    <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block btn100"/>                      
                </div>
            </div>
            
        <br />
        
        
    </form>
    
    <?if(!empty($aSections)){?>
    <h2>Sections</h2>    
    
        <?foreach($aSections as $sect){?>
        <?if(isset($_GET['section']) and intval($_GET['section']) == $sect['id']){?>
    <a name="edit_section"></a><br /><br /><br /> 
            <form action="" method="post" name="login" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="sent_section" value="1"> 
            <div class="form-group">
                <p>ID: <?=$sect['id']?></p>
                <label for="inputHeader" class="col-sm-2 control-label">Header</label>
                <div class="col-sm-10">
                    <input type="text" name="header" id="inputHeader" class="form-control" value="<?=htmlspecialchars(isset($_POST['header']) ? $_POST['header'] : (isset($sect['header']) ? $sect['header'] : ''))?>" />
                </div>
            </div> 
            
            <br />
            
            <div class="form-group">
                <label for="inputContent" class="col-sm-2 control-label">Content</label>
                <div class="col-sm-10">
                    <textarea id="inputContent" name="content" class="form-control" cols="" rows=""><?=htmlspecialchars(isset($_POST['content']) ? $_POST['content'] : (isset($sect['content']) ? $sect['content'] : ''))?></textarea>
                    <script>
                        CKEDITOR.replace( 'inputContent', {
                            height:200
                        });
                    </script>              
                </div>
            </div>        
           
            <br />
            
            <div class="form-group">
                <label for="inputImg" class="col-sm-2 control-label">Background Image</label>
                <div class="col-sm-10">
                    <?if(@$sect['img']){?>                
                    <div><img src="../<?=$sect['img']?>" alt="" width="500"/> <a class="delete" href="pages.php?id=<?=intval($pageId)?>&amp;section=<?=$sect['id']?>&amp;del_sect_img=1" onclick="return confirm('Are You Sure You Want to Delete this Image?')">delete</a></div>
                    <?}?>
                    <input type="file" id="inputImgEn" name="img"/>
                </div>
            </div>
            
            <br />           
            
            <div class="form-group">
                <label for="inputdisplay" class="col-sm-2 control-label">Display</label>
                <div class="col-sm-10">
                    <input name="display" id="inputDisplay" type="checkbox" class="form-control" value="1" <?if(isset($_POST['display']) or $sect['display']) echo 'checked'?> style="width:auto"/>
                </div>
            </div>
            <?if(!$sect['fixed']){?>
            <div class="form-group">
                <label for="inputOrder" class="col-sm-2 control-label">Order</label>
                <div class="col-sm-10">
                    <input name="order" id="inputOrder" type="text" class="form-control" value="<?=$sect['ord']?>" style="width:80px">
                </div>
            </div>
            <?}?>
            <br />
            
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">                 
                    <input type="submit" value="Save" class="btn btn-lg btn-primary btn-block btn100"/>    <input type="button" value="Cancel" class="btn btn-lg btn-info btn-block btn100" onclick="parent.location='pages.php?id=<?=$aItem['id']?>';return false;"/>                     
                </div>
            </div>
             </form>
            <br/>
            
        <?}else{?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="pages.php?id=<?=$aItem['id']?>&section=<?=$sect['id']?>#edit_section" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                &nbsp; &nbsp;<span<?if(!$sect['display']) echo ' style="color:#999"'?>><?=$sect['id']?>. <?=$sect['header']?></span>
            </div>
          <div class="panel-body">
            <?=$sect['content']?>
          </div>
        </div>
        <?}?>
        <?}?>
    <?}?>
            
</div>

<?php include '_footer_tpl.php'?>