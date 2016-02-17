<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <?php echo $content_top; ?>

  <h1>Transaction Response</h1>

  <div class="checkout-product">
    <table>
      <tbody>
        <tr>
          <td class="name">Transaction Reference</td>
          <td class="model"><?php echo $eyowo_transaction_reference ?></td>
        </tr>

        <tr>
          <td class="name">Transaction Status</td>
          <td class="model" <?php if ($eyowo_transaction_status != "Approved") { ?> style="color: red;" <?php } ?>>
            <?php echo $eyowo_transaction_status ?>
          </td>
        </tr>

        <tr>
          <td class="name">Transaction Status Reason</td>
          <td class="model"><?php echo $eyowo_transaction_status_reason ?></td>
        </tr>

        <tr>
          <td class="name">Transaction Amount</td>
          <td class="model"><?php echo $eyowo_transaction_amount ?></td>
        </tr>

        <tr>
          <td class="name">Transaction Date</td>
          <td class="model"><?php echo $eyowo_transaction_date ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>