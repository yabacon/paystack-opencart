<?php if (!$livemode) { ?>
<div class="warning"><?php echo $text_testmode; ?></div>
<?php } ?>

<form >
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <div class="buttons">
    <div class="right">
      <input type="button"  onclick="payWithPaystack()" value="<?php echo $button_confirm; ?>" class="button" />
    </div>
  </div>
</form>
 
<script>
  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: '<?php echo $key; ?>',
      email: '<?php echo $email; ?>',
      amount: <?php echo $amount; ?>,
      ref: '<?php echo $ref; ?>',
      callback: function(response){
          window.location.href='<?php echo html_entity_decode($callback); ?>';
      },
      onClose: function(){
          window.location.href='<?php echo html_entity_decode($callback); ?>';
      }
    });
    handler.openIframe();
  }
</script>
