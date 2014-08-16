<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Banner</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/banner/submit/').(isset($banner['banner_id'])?$banner['banner_id']:'')?>">
							<fieldset>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group<?=isset($banner['title_error'])?' error':''?>">
									<label class="control-label">ชื่อ *</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="title" value="<?=(isset($banner['title'])?$banner['title']:'')?>">
										<?php
										if(isset($banner['title_error'])){
											echo '<span class="help-inline">',$banner['title_error'],'</span>';
										}
										?>
										
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">แบนเนอร์</label>
									<div class="controls">
										<?php
										if(isset($banner['cover'])){
											echo '<img src="',$banner['cover'],'" width="300" /><br/><br/>';
											echo '<input type="hidden" name="cover_tmp" value="',$banner['cover'],'" />';
										}
										?>
										<input class="input-xlarge" name="cover" type="file" value="">
										<p class="help-block">ขนาด 1170 x 483</p>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">รายละเอียด</label>
									<div class="controls">
										<input class="input-xlarge span10" type="text" name="description" value="<?=(isset($banner['description'])?$banner['description']:'')?>"> 
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ลิ้งค์</label>
									<div class="controls">
										<input class="input-xlarge span10" type="text" name="link" value="<?=(isset($banner['link'])?$banner['link']:'')?>"> 
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
