<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> บัตรเติมเงิน</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/prepaid/submit/').(isset($package['package_id'])?$package['package_id']:'')?>">
							<fieldset>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group">
									<label class="control-label">Package *</label>
									<div class="controls">
										<input type="hidden" name="partner_tmp" value="<?=isset($package['partner'])?$package['partner']:''?>" />
										<select name="package_id" class="span6">
											<?php foreach ($packages as $package) {?>
											<option value="<?=$package['package_id']?>"><?=$package['title']?></option>
											<?php }?>
										</select>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label">วันเริ่มใช้ *</label>
									<div class="controls">
										<input class="input-xlarge datepicker" id="start_date" type="text" name="start_date">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">วันหมดอายุ *</label>
									<div class="controls">
										<input class="input-xlarge datepicker" id="expire_date" type="text" name="expire_date">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">จำนวน * ใบ</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="count">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Export Data </label>
									<div class="controls">
										<input class="input-xlarge" id="export" type="checkbox" value="true" name="export"> <label class="checkbox inline" for="export">ส่งออกข้อมูลเป็น Excel ด้วย</label>
									</div>
								</div>
								
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Save changes</button>
								  <button type="reset" class="btn">Cancel</button>
								</div>
							</fieldset>
						</form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
    <script>
	  $(function() {
	    $( ".datepicker" ).datepicker({
	    	showAnim:"slideDown",
	    	dateFormat:"yy-mm-dd",
	    	minDate: -20,
	    	maxDate: "+5Y" 
	    });
	  });
	</script>
<?php include('footer.php'); ?>
