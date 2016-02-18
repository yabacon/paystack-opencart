<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
<?php foreach ($breadcrumbs as $breadcrumb) { ?>
<?php echo $breadcrumb['separator']; ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?>
        </a> 
<?php } ?>
    </div>
<?php if ($error_warning) { ?>
    <div class="warning">
<?php echo $error_warning; ?>
    </div>
<?php } ?>
    <div class="box">
        <div class="heading">
            <h1>
                <img src="view/image/payment.png" alt="" /> 
<?php echo $heading_title; ?>
            </h1>
            <div class="buttons">
                <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?>
                </a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?>
                </a>
            </div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">


                    <tr>
<?php if (!$paystack_live) { ?>
                        <td><span class="required">*</span> 
<?php } else { ?>
                        <td> 
<?php } ?>                        
<?php echo $entry_test_secret; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_test_secret" value="<?php echo $paystack_test_secret; ?>" />
<?php if (!$paystack_live && $error_keys) { ?>
                        <span class="error"><?php echo $error_test_keys; ?>
                        </span> 
<?php } ?>
                        </td>
                    </tr>
                    <tr>
<?php if (!$paystack_live) { ?>
                        <td><span class="required">*</span> 
<?php } else { ?>
                        <td> 
<?php } ?>                        
<?php echo $entry_test_public; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_test_public" value="<?php echo $paystack_test_public; ?>" />
<?php if (!$paystack_live && $error_keys) { ?>
                        <span class="error"><?php echo $error_test_keys; ?>
                        </span> 
<?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_live; ?>
                        </td>
                        <td><?php if ($paystack_live) { ?>
                        <input type="radio" name="paystack_live" value="1" checked="checked" />
<?php echo $text_yes; ?>
                        <input type="radio" name="paystack_live" value="0" />
<?php echo $text_no; ?>
<?php } else { ?>
                        <input type="radio" name="paystack_live" value="1" />
<?php echo $text_yes; ?>
                        <input type="radio" name="paystack_live" value="0" checked="checked" />
<?php echo $text_no; ?>
<?php } ?>
                        </td>
                    </tr>                    
                    <tr>
<?php if ($paystack_live) { ?>
                        <td><span class="required">*</span> 
<?php } else { ?>
                        <td> 
<?php } ?>                        
<?php echo $entry_live_secret; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_live_secret" value="<?php echo $paystack_live_secret; ?>" />
<?php if ($paystack_live && $error_keys) { ?>
                        <span class="error"><?php echo $error_live_keys; ?>
                        </span> 
<?php } ?>
                        </td>
                    </tr>
                    <tr>
<?php if ($paystack_live) { ?>
                        <td><span class="required">*</span> 
<?php } else { ?>
                        <td> 
<?php } ?>                        
<?php echo $entry_live_public; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_live_public" value="<?php echo $paystack_live_public; ?>" />
<?php if ($paystack_live && $error_keys) { ?>
                        <span class="error"><?php echo $error_live_keys; ?>
                        </span> 
<?php } ?>
                        </td>
                    </tr>


                    <tr>
                        <td><?php echo $entry_debug; ?>
                        </td>
                        <td>
                        <select name="paystack_debug">
<?php if ($paystack_debug) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?>
                            </option>
                            <option value="0"><?php echo $text_disabled; ?>
                            </option>
<?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?>
                            </option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?>
                            </option>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_total; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_total" value="<?php echo $paystack_total; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_approved_status; ?>
                        </td>
                        <td>
                        <select name="paystack_approved_status_id">
<?php foreach ($order_statuses as $order_status) { ?>
<?php if ($order_status['order_status_id'] == $paystack_approved_status_id) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
                            </option>
<?php } else if (!$paystack_approved_status_id && (strtoupper(trim($order_status['name'])) == 'PROCESSING')) { ?>
										<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
										</option>
<?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?>
                            </option>
<?php } ?>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_declined_status; ?>
                        </td>
                        <td>
                        <select name="paystack_declined_status_id">
<?php foreach ($order_statuses as $order_status) { ?>
<?php if ($order_status['order_status_id'] == $paystack_declined_status_id) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
                            </option>
<?php } else if (!$paystack_declined_status_id && (strtoupper(trim($order_status['name'])) == 'DENIED')) { ?>
										<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
										</option>
<?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?>
                            </option>
<?php } ?>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_error_status; ?>
                        </td>
                        <td>
                        <select name="paystack_error_status_id">
<?php foreach ($order_statuses as $order_status) { ?>
<?php if ($order_status['order_status_id'] == $paystack_error_status_id) { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
                            </option>
<?php } else if (!$paystack_error_status_id && (strtoupper(trim($order_status['name'])) == 'FAILED')) { ?>
										<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?>
										</option>
<?php } else { ?>
                            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?>
                            </option>
<?php } ?>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_geo_zone; ?>
                        </td>
                        <td>
                        <select name="paystack_geo_zone_id">
                            <option value="0"><?php echo $text_all_zones; ?>
                            </option>
<?php foreach ($geo_zones as $geo_zone) { ?>
<?php if ($geo_zone['geo_zone_id'] == $paystack_geo_zone_id) { ?>
                            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?>
                            </option>
<?php } else { ?>
                            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?>
                            </option>
<?php } ?>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_status; ?>
                        </td>
                        <td>
                        <select name="paystack_status">
<?php if ($paystack_status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?>
                            </option>
                            <option value="0"><?php echo $text_disabled; ?>
                            </option>
<?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?>
                            </option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?>
                            </option>
<?php } ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $entry_sort_order; ?>
                        </td>
                        <td>
                        <input type="text" name="paystack_sort_order" value="<?php echo $paystack_sort_order; ?>" size="1" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div style="text-align:center; color:#222222;">
        <a target="_blank" href="http://www.paystack.com/">Paystack v1.0.0</a>.
    </div>
</div>

<?php echo $footer; ?>
