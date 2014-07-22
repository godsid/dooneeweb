<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Movies</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="<?=backoffice_url('/package/submit/').(isset($package['package_id'])?$package['package_id']:'')?>">
							<fieldset>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group<?=isset($package['title_error'])?' error':''?>">
									<label class="control-label">ชื่อ *</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="title" value="<?=(isset($package['title'])?$package['title']:'')?>">
										<?php
										if(isset($package['title_error'])){
											echo '<span class="help-inline">',$package['title_error'],'</span>';
										}
										?>
										
									</div>
								</div>
								<div class="control-group<?=isset($package['title_en_error'])?' error':''?>">
									<label class="control-label">ชื่อรหัส *</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="name" value="<?=(isset($package['name'])?$package['name']:'')?>">
										<?php
										if(isset($package['name_error'])){
											echo '<span class="help-inline">',$package['name_error'],'</span>';
										}
										?>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">แบนเนอร์</label>
									<div class="controls">
										<?php
										if(isset($package['banner'])){
											echo '<img src="',$package['banner'],'" /><br/><br/>';
										}
										?>
										<input class="input-xlarge" name="banner" type="file" value="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ราคา</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="price" value="<?=(isset($package['price'])?$package['price']:'')?>"> บาท
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">จำนวนวัน</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="dayleft" value="<?=(isset($package['dayleft'])?$package['dayleft']:'')?>"> วัน
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">รายละเอียด</label>
									<div class="controls">
										<textarea class="input-xlarge span11" name="detail" rows="5"><?=(isset($package['detail'])?$package['detail']:'')?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">เงื่อนไข</label>
									<div class="controls">
										<textarea class="input-xlarge span11" name="conditions" rows="10"><?=(isset($package['conditions'])?$package['conditions']:'')?></textarea>
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
    
<?php include('footer.php'); ?>
