<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Movies</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/category/submit/').(isset($category['category_id'])?$category['category_id']:'')?>">
							<fieldset>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group<?=isset($category['title_error'])?' error':''?>">
									<label class="control-label">ชื่อ *</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="title" value="<?=(isset($category['title'])?$category['title']:'')?>">
										<?php
										if(isset($category['title_error'])){
											echo '<span class="help-inline">',$category['title_error'],'</span>';
										}
										?>
										
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Category หลัก</label>
									<div class="controls">
										<select name="parent_id">
											<option value="0">Category หลัก</option>
										<?php foreach($parent as $p){?>
											<option value="<?=$p['category_id']?>" <?=(isset($category)&&$p['category_id']==$category['parent_id']?"selected":"") ?> ><?=$p['title']?></option>
										<?php }?>
										</select>
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
