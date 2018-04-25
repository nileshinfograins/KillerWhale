<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
$paypal_id='sankla.aamit-facilitator@gmail.com';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body>
  <div class="product">            
    <div class="btn">
        <form action='<?php echo $paypal_url; ?>' method='post' name='frmPayPal1'>
            <input type='hidden' name='business' value='<?php echo $paypal_id;?>'>
            <input type='hidden' name='cmd' value='_xclick'>
			<input type="hidden" name="lc" value="AU">  
            <input type='hidden' name='item_name' value='Report'>
            <input type='hidden' name='item_number' value='1'>
            <input type='hidden' name='amount' value='<?php echo $amount; ?>'>
            <input type='hidden' name='no_shipping' value='1'>
            <input type='hidden' name='currency_code' value='USD'>
            <input type='hidden' name='handling' value='0'>
            <input type="hidden" name="bn" value="PP-BuyNowBF">
            <input type='hidden' name='cancel_return' value='<?php echo base_url();?>payment/cancel_payment/<?php echo $transaction_id; ?>'>
            <input type='hidden' name='return' value='<?php echo base_url();?>payment/success_payment/<?php echo $transaction_id; ?>'>
            <input type='hidden' name='notify_url' value='<?php echo base_url();?>payment/success_payment/<?php echo $transaction_id; ?>'>

            <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form> 
    </div>
</div>

</body>
</html>

<script type="text/javascript">
document.frmPayPal1.submit();
</script>

