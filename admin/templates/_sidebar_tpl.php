        <div class="col-sm-3 col-md-2 sidebar">
          <?php if(!empty($aSubmenu)){?>
          <ul class="nav nav-sidebar">
            <?php foreach($aSubmenu as $itm){?>
            <li<?php if($itm['active']){?> class="active"<?php }?>><a href="<?=$itm['url']?>"><?=$itm['title']?></a></li>
            <?php }?>
          </ul>
          <?php }?>
        </div>