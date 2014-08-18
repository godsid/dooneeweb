<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> <?=$page['title']?></h2>
					</div>
					<?php if(isset($page['success'])){ ?>
							<div class="alert alert-success"> บันทึกข้อมูลเรียบร้อยแล้ว</div>
					<?php }?>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/page/submit/'.$page['pagename'])?>">
							<fieldset>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group">
									<label class="control-label">รายละเอียด</label>
									<div class="controls">
										<textarea class="input-xlarge span10 cleditor" name="description" rows="20"><?=(isset($page['description'])?$page['description']:'')?></textarea>
									</div>
								</div>
								<div class="form-actions">
								  <button type="submit" class="btn btn-primary">Save changes</button>
								  <button type="reset" class="btn">Cancel</button>
								</div>
							</fieldset>
						</form>
					<script type="text/javascript">
						$(document).ready(function () { 
							$(".cleditor").cleditor({
							width: 800, // width not including margins, borders or padding
							height: 800
						}); });
					</script>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
