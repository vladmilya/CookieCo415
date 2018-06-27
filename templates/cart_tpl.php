<?php include '_header_tpl.php'?>

<?php include '_menu_tpl.php'?>

<style>
    .cart-buttons{float:right}
    .cart-table, p{
        font-family: "BerlinSansFBDemi-Bold";
        font-size: 18px;

    }
    .cart-table td{
        vertical-align: middle!important;
    }
    .cart-table td table td{
        padding:5px;
    }
</style>

<script>
    $(document).ready(function(){
        getTotal();
        $('.qtyField').each(function(){
            $(this).keyup(function(){
                if(!isNaN($(this).val())){ 
                    var prod = $(this).attr('prod');
                    var mod = $(this).attr('mod');
                    var qty = $(this).val();
                    $.post( "<?=HOST?>_set_qty.php", { prod: prod, mod: mod, qty:qty } );
                }
                getTotal();
            })
        });
    });
    
    function getTotal(){
        var total = 0;
        $('.qtyField').each(function(){
            var price = $(this).parent().parent().find('.priceVal').text();
            if(!isNaN($(this).val())){                
                total+=$(this).val()*1*price;
            }
        });
        total = total.toFixed(2).replace(/./g, function(c, i, a) {
            return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
        });
        $('#totalPrice').text(total);
    }
    
    $(function() {
        jQuery("input.number_only").keyup(function(event){
            checkNumberFields(this, event);
        }).keypress(function(event){
            checkNumberFields(this, event);
        }).change(function(event){
            checkNumberFields(this, event);
        }).click(function(){
                this.select();
        });
        $('form').delegate("input.number_only", 'keyup',function(event){checkNumberFields(this, event)});
        $('form').delegate("input.number_only", 'keypress',function(event){checkNumberFields(this, event)});
        $('form').delegate("input.number_only", 'change',function(event){checkNumberFields(this, event)});
        $('form').delegate("input.number_only", 'click',function(event){checkNumberFields(this, event)});
        
        $('.price_input').each(function(){
            var price_inp = $(this);
            var hh_input = price_inp.parent().next().find('.hh_price_input');
            if(hh_input.val() == ''){
                hh_input.val($(this).val());
            }
        });        
        
    });

    function checkNumberFields(e, k){
        var str = jQuery(e).val();
        var new_str = s = "";
        for(var i=0; i < str.length; i++){
                s = str.substr(i,1);
                if((s!=" " && isNaN(s) == false) || s=='.'){
                        new_str += s;
                }
        }
        jQuery(e).val(new_str);
    }
</script>

<div class="contact-us container-fluid">
    <div class="container">
        <div class="row">
            
            <h1>Shopping Cart</h1>
            
            <?if(!empty($error)){?>
            <div class="alert alert-danger" role="alert"><?=$error?></div>
            <?}?>
            <?if(isset($success)){?>
            <div class="alert alert-success" role="alert">Thank you for your order!<br />Our managers will contact you shortly by email.</div>
            <?}?>
            
            <?if(!empty($aCart['items'])){?>
            <form action="<?=HOST?>cart/checkout/" method="post" name="checkout_form">
            <input type="hidden" name="sent_cart" value="1"/>
            <table class="table table-striped cart-table">
                <?foreach($aCart['items'] as $k=>$prod){?>
                <tr>
                    <td width="100"><?if(!empty($prod['image'])){?><img src="<?=HOST.$prod['image']?>" width="100"/><?}?></td>
                    <td><?=$prod['name']?></td>
                    <td>
                        <table cellspasing="0" cellpadding="0">
                            <?foreach($prod['prices'] as $c=>$p){?>
                            <tr>
                                <td width="100"><?=$p['name']?></td>
                                <td width="100">$<?=  number_format($p['price'], 2, '.', ',')?><span class="priceVal hidden"><?=$p['price']?></span></td>
                                <td><input type="text" class="qtyField number_only" prod="<?=$k?>" mod="<?=$c?>" name="qty[<?=$k?>][<?=$c?>]" value="<?=$p['qty']?>" size="3"/></td>
                            </tr>
                            <?}?>
                        </table>
                    </td>
                    <td width="100"><a href="<?=HOST?>cart/delete/<?=$k?>" onclick="return confirm('Are you sure you want to delete this product from your shopping cart?')"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <?}?>
                <tr>
                    <td colspan="3" align="right">TOTAL:</td>
                    <td>$<span id="totalPrice">0.00</span></td>
                </tr>
            </table>
            </form>
                
            <?}else{?>
            <p>Your Shopping Cart is Empty</p>
            <?}?>
            
            <?if(!empty($aCart['items'])){?><button class="button-f1 cart-buttons" type="button" onclick="document.checkout_form.submit()">Checkout</button><?}?>
            <button class="button-f1 cart-buttons" type="button" onclick="parent.location='<?=isset($_SESSION['back_to_menu']) ? $_SESSION['back_to_menu'] : (HOST.'products/')?>';return false;">Continue Shopping</button>

        </div>
    </div>
</div>

<?php include '_footer_tpl.php'?>