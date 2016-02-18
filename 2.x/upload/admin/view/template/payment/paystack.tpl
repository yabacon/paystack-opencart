<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-pp-std-uk" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button> <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1>

<?php echo $heading_title; ?>
			</h1>
			<ul class="breadcrumb">
<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?>
				</a></li>
<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
<?php if (isset($error['error_warning'])) { ?>
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i> 
<?php echo $error['error_warning']; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button> 
		</div>

<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pencil"></i> 
<?php echo $text_edit; ?>
				</h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pp-std-uk" class="form-horizontal">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?>
						</a></li>
						<li><a href="#tab-status" data-toggle="tab"><?php echo $tab_order_status; ?>
						</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab-general">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="entry-test-secret"><?php echo $entry_test_secret; ?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_test_secret" value="<?php echo $paystack_test_secret; ?>" placeholder="<?php echo $entry_test_secret; ?>" id="entry-test-secret" class="form-control" />

<?php if (!$paystack_live && $error_keys) { ?>
									<div class="text-danger">
<?php echo $error_keys; ?>
									</div>
<?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="entry-test-public"><?php echo $entry_test_public; ?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_test_public" value="<?php echo $paystack_test_public; ?>" placeholder="<?php echo $entry_test_public; ?>" id="entry-test-public" class="form-control" />

<?php if (!$paystack_live && $error_keys) { ?>
									<div class="text-danger">
<?php echo $error_keys; ?>
									</div>
<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-live-demo"><span data-toggle="tooltip" title="<?php echo $help_live; ?>"><?php echo $entry_live; ?>
								</span></label> 
								<div class="col-sm-10">
									<select name="paystack_live" id="input-live-demo" class="form-control">
										<option value="1" <?php echo ($paystack_live ? 'selected="selected"':''); ?>><?php echo $text_yes; ?>
										</option>
										<option value="0" <?php echo ($paystack_live ? '':'selected="selected"'); ?>><?php echo $text_no; ?>
										</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="entry-live-secret"><?php echo $entry_live_secret; ?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_live_secret" value="<?php echo $paystack_live_secret; ?>" placeholder="<?php echo $entry_live_secret; ?>" id="entry-live-secret" class="form-control" />

<?php if ($paystack_live && $error_keys) { ?>
									<div class="text-danger">
<?php echo $error_keys; ?>
									</div>
<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="entry-live-public"><?php echo $entry_live_public; ?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_live_public" value="<?php echo $paystack_live_public; ?>" placeholder="<?php echo $entry_live_public; ?>" id="entry-live-public" class="form-control" />

<?php if ($paystack_live && $error_keys) { ?>
									<div class="text-danger">
<?php echo $error_keys; ?>
									</div>
<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-debug"><span data-toggle="tooltip" title="<?php echo $help_debug; ?>"><?php echo $entry_debug; ?>
								</span></label> 
								<div class="col-sm-10">
									<select name="paystack_debug" id="input-debug" class="form-control">

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
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?>
								</span></label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_total" value="<?php echo $paystack_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-sort-order">
<?php echo $entry_sort_order; ?>
								</label> 
								<div class="col-sm-10">
									<input type="text" name="paystack_sort_order" value="<?php echo $paystack_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-geo-zone">
<?php echo $entry_geo_zone; ?>
								</label> 
								<div class="col-sm-10">
									<select name="paystack_geo_zone_id" id="input-geo-zone" class="form-control">
										<option value="0">
<?php echo $text_all_zones; ?>
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
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?>
								</label> 
								<div class="col-sm-10">
									<select name="paystack_status" id="input-status" class="form-control">

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
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab-status">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_approved_status; ?>
								</label> 
								<div class="col-sm-10">
									<select name="paystack_approved_status_id" class="form-control">

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
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_declined_status; ?>
								</label> 
								<div class="col-sm-10">
									<select name="paystack_declined_status_id" class="form-control">

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
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_error_status; ?>
								</label> 
								<div class="col-sm-10">
									<select name="paystack_error_status_id" class="form-control">

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
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div style="color:#222222;text-align:center;">
			<a href="http://www.paystack.com" target="_blank"><?php echo $heading_title; ?>
			v1.0.0</a>
		</div>
	</div>
</div>

<?php echo $footer; ?>
