<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> <?=($this->uri->segment(4)=='news')?"ข่าว/โปรโมชั่น":"วิธีการรับชม"?></h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/article/submit/'.$this->uri->segment(4)).'/'.(isset($article['article_id'])?$article['article_id']:'')?>">
							<fieldset>
								<div class="control-group<?=isset($article['title_error'])?' error':''?>">
									<label class="control-label">หัวข้อ *</label>
									<div class="controls">
										<input class="input-xxlarge" type="text" name="title" value="<?=(isset($article['title'])?$article['title']:'')?>">
										<?php
										if(isset($article['title_error'])){
											echo '<span class="help-inline">',$article['title_error'],'</span>';
										}
										?>
										
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">รูปปก</label>
									<div class="controls">
										<?php
										if(isset($article['cover'])){
											echo '<img src="',$article['cover'],'" /><br/><br/>';
											echo '<input type="hidden" name="cover_tmp" value="',$article['cover'],'" />';
										}
										?>
										<input class="input-xlarge" name="cover" type="file" value="">
										<p class="help-block">ขนาด 1148 x 374</p>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">รายละเอียด</label>
									<div class="controls">
										<textarea class="input-xlarge span11 cleditor" name="description" rows="5"><?=(isset($article['description'])?$article['description']:'')?></textarea>
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
