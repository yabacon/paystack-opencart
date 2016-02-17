<form method="post" action="<?php echo $action ?>" id="payment">
  <input type="hidden" name="eyw_walletcode" value="<?php echo $eyowo_wallet_code ?>" />
  <input type="hidden" name="eyw_transactionref" value="<?php echo $eyowo_transaction_reference ?>" />

  <input type="hidden" name="eyw_item_name_1" value="<?php echo $eyowo_transaction_name ?>" />
  <input type="hidden" name="eyw_item_description_1" value="<?php echo $eyowo_transaction_description ?>" />
  <input type="hidden" name="eyw_item_price_1" value="<?php echo $eyowo_transaction_total ?>" />

  <div class="buttons">
    <div class="right">
      <input type="submit" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
    </div>
  </div>

</form>