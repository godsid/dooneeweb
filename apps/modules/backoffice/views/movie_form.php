<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Movies</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=backoffice_url('/movie/submit/').(isset($movie['movie_id'])?$movie['movie_id']:'')?>">
							<fieldset>
								<?php
								if(isset($movie['movie_id'])){
									//echo '<input type="hidden" name="movie_id" value="',$movie['movie_id'],'">';
								}
								?>
								<!--<legend>Datepicker, Autocomplete, WYSIWYG</legend>-->
								<div class="control-group<?=isset($movie['title_error'])?' error':''?>">
									<label class="control-label">ชื่อเรื่อง (ภาษาไทย) *</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="title" value="<?=(isset($movie['title'])?$movie['title']:'')?>">
										<?php
										if(isset($movie['title_error'])){
											echo '<span class="help-inline">',$movie['title_error'],'</span>';
										}
										?>
									</div>
								</div>
								<div class="control-group<?=isset($movie['title_en_error'])?' error':''?>">
									<label class="control-label">ชื่อเรื่อง (ภาษาอังกฤษ) *</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="title_en" value="<?=(isset($movie['title_en'])?$movie['title_en']:'')?>">
										<?php
										if(isset($movie['title_en_error'])){
											echo '<span class="help-inline">',$movie['title_en_error'],'</span>';
										}
										?>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">ภาพปก</label>
									<div class="controls">
										<?php
										if(isset($movie['cover'])){
											echo '<img src="',$movie['cover'],'" /><br/><br/>';
											echo '<input type="hidden" name="cover_tmp" value="',$movie['cover'],'" />';
										}
										?>
										<input class="input-xlarge" name="cover" type="file" value="">
										<p class="help-block">ขนาด 258 x 386</p>
									</div>
								</div>
								<?php if($movie['is_series']=='NO'){?>
								<div class="control-group">
									<label class="control-label">ไฟล์วีดีโอ</label>
									<div class="controls">
										<stong><?=$movie['path']?></stong>
									</div>
								</div>
								<?php }?>
								<div class="control-group">
									<label class="control-label">คำบรรยายใต้ภาพ</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="summary" value="<?=(isset($movie['summary'])?$movie['summary']:'')?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">หมวดหมู่</label>
									<div class="controls">
										<input type="hidden" name="category_tmp" value="<?=implode(',',$movie['category'])?>" />
										<select class="span6" name="category[]" multiple="multiple">
											<?php foreach ($categories as $categorie) {?>
											<option value="<?=$categorie['category_id']?>" <?=(isset($movie['category'])&&in_array($categorie['category_id'], $movie['category'])?'selected':'')?>><?=$categorie['parent_id']>0?" - ":""?><?=$categorie['title']?></option>
											<?php }?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label"></label>
									<div class="controls">
										<label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_free" <?=(isset($movie['is_free'])&&$movie['is_free']=='YES'?'checked':'')?>> ฟรี
									    </label>
									    <label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_hd" <?=(isset($movie['is_hd'])&&$movie['is_hd']=='YES'?'checked':'')?>> HD
									    </label>
									    <label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_hot" <?=(isset($movie['is_hot'])&&$movie['is_hot']=='YES'?'checked':'')?>> Hot
									    </label>
									    <!--<label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_3d" <?=(isset($movie['is_3d'])&&$movie['is_3d']=='YES'?'checked':'')?>> 3D
									    </label>-->
									    <label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_series" <?=(isset($movie['is_series'])&&$movie['is_series']=='YES'?'checked':'')?>> Series
									    </label>
									    <label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_18" <?=(isset($movie['is_18'])&&$movie['is_18']=='YES'?'checked':'')?>> 18+
									    </label>
									    <label class="checkbox inline">
											<input type="checkbox" value="YES" name="is_soon" <?=(isset($movie['is_soon'])&&$movie['is_soon']=='YES'?'checked':'')?>> Coming Soon
									    </label>
									</div>
								</div>
								<?php if(isset($movie['is_series'])&&$movie['is_series']=='YES'){?>
								<div class="control-group episode">
									<label class="control-label">Series Episode</label>
										<div class="controls">
										<div class="row-fluid sortable">
											<div class="box span11">
												<div class="box-header well" data-original-title>
													<h2><i class="icon-film"></i> Series Episode</h2>
													<div class="box-icon">
									                    <a href="javascript:;" onclick="$('.episode .box-content').toggle('slow',function(){$('')})" class="btn btn-minimize btn-round btn-default"><i class="icon-chevron-down"></i></a>
									                </div>
												</div>
												<div class="box-content hide">
													<?php $i=1;foreach ($movie['episodes']['items'] as $episode) {?>
													<p><?=($i++),".",$episode['title']?> ( /series/<?=$episode['path']?>.mp4) <a href="<?=backoffice_url('/movie/deleteEpisode/'.$episode['episode_id'])?>" onclick="if(window.confirm('ต้องการลบนี้ข้อมูลใช่หรือไม่')){deleteEpisode(this);return false;}else{return false;}" title="ลบ" class="btn btn-default"><i class="icon-trash"></i></a></p>
													<?php }?>
													
													<div class="control-group">
														<label class="control-label span1">ชื่อตอน</label>
														<div class="controls span11">
															<input class="input-xlarge span6" type="text" id="ep_title" name="ep_title" value="<?=(isset($movie['ep_title'])?$movie['ep_title']:'')?>" />
															<br/>
															<button class="btn btn-primary addEpisode" type="button">Add</button>
														</div>
													</div>
													<!--<div class="control-group">
														<label class="control-label span1">Package</label>
														<div class="controls span11">
															<select name="ep_package" id="ep_package">
																<option value=""></option>
																<option value=""></option>
																<option value=""></option>
																<option value=""></option>
																<option value=""></option>
															</select>
														</div>
													</div>
													-->
												</div>
											</div>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									$('.addEpisode').click(function(){
										$.post('<?=backoffice_url("/movie/addEpisode/".$movie["movie_id"])?>',{
												title:$('#ep_title').val()
											},function(resp){
												if(resp.status=='success'){
													node = '<p>'+resp.items.title+' ( '+resp.items.path+') <a href="<?=backoffice_url("/movie/deleteEpisode/")?>'+resp.items.episode_id+'" onclick="if(window.confirm(\'ต้องการลบนี้ข้อมูลใช่หรือไม่\')){deleteEpisode(this);return false;}else{return false;}" title="ลบ" class="btn btn-default"><i class="icon-trash"></i></a></p>';
													$(node).insertBefore($('.episode .box-content .control-group'));
													$('#ep_title').val('');
												}else{
													alert(resp.message);
												}
										});
									});
									function deleteEpisode(obj){
										$.get(obj.href,function(resp){
											console.log(resp);
											//if(resp.status==true){
												$(obj).parent().remove();
											//}
										});

									}
								</script>
								<?php }?>
								<!--
								<div class="control-group">
									<label class="control-label">ตัวอย่าง</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="trailer" value="<?=(isset($movie['trailer'])?$movie['trailer']:'')?>">
									</div>
								</div>
								-->
								<div class="control-group">
									<label class="control-label">เรื่องย่อ</label>
									<div class="controls">
										<textarea class="input-xlarge span11" name="description" rows="5"><?=(isset($movie['description'])?$movie['description']:'')?></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Rating หนัง</label>
									<div class="controls">
										<select name="rating">
											<option value="G" <?=(isset($movie['rating'])&&$movie['rating']=='G'?'selected':'')?>>G</option>
											<option value="PG" <?=(isset($movie['rating'])&&$movie['rating']=='PG'?'selected':'')?>>PG</option>
											<option value="PG-13" <?=(isset($movie['rating'])&&$movie['rating']=='PG-13'?'selected':'')?>>PG-13</option>
											<option value="R" <?=(isset($movie['rating'])&&$movie['rating']=='R'?'selected':'')?>>R</option>
											<option value="NC-17" <?=(isset($movie['rating'])&&$movie['rating']=='NC-17'?'selected':'')?>>NC-17</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ดาว</label>
									<div class="controls">
										<select name="score">
											<option value="1" <?=(isset($movie['score'])&&$movie['score']=='1'?'selected':'')?>>1</option>
											<option value="2" <?=(isset($movie['score'])&&$movie['score']=='2'?'selected':'')?>>2</option>
											<option value="3" <?=(isset($movie['score'])&&$movie['score']=='3'?'selected':'')?>>3</option>
											<option value="4" <?=(isset($movie['score'])&&$movie['score']=='4'?'selected':'')?>>4</option>
											<option value="5" <?=(isset($movie['score'])&&$movie['score']=='5'?'selected':'')?>>5</option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">นักแสดง</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="cast" value="<?=(isset($movie['cast'])?$movie['cast']:'')?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ผู้กำกับ</label>
									<div class="controls">
										<input class="input-xlarge span6" type="text" name="director" value="<?=(isset($movie['director'])?$movie['director']:'')?>">
									</div>
								</div>
								<!--
								<div class="control-group">
									<label class="control-label">ประเภทหนัง</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="genre" value="<?=(isset($movie['genre'])?$movie['genre']:'')?>">
									</div>
								</div>
								-->
								<div class="control-group">
									<label class="control-label">เสียง</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="audio" value="<?=(isset($movie['audio'])?$movie['audio']:'')?>"><i> exp: EN,TH </i>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">คำบรรยาย</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="subtitle" value="<?=(isset($movie['subtitle'])?$movie['subtitle']:'')?>"> <i> exp: EN,TH </i>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">ความยาว</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="length" value="<?=(isset($movie['length'])?$movie['length']:'')?>"> นาที
									</div>

								</div>
								<div class="control-group">
									<label class="control-label">ปี</label>
									<div class="controls">
										<input class="input-xlarge" type="text" name="year" value="<?=(isset($movie['year'])?$movie['year']:'')?>"><i> exp: 2014 </i>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tags</label>
									<?php
									$tags_id = array();
									$tags_name = array();
									foreach($movie['tags'] as $tags){
										$tags_id[] = $tags['tags_id'];
										$tags_name[] = $tags['tags_name'];
									}
									?>
									<div class="controls">
										<input type="hidden" name="tags_tmp" value='<?=(isset($movie['tags'])?json_encode($movie['tags']):'[]')?>' />
										<input class="input-xlarge" type="text" name="tags" value="<?=(isset($movie['tags'])?implode(', ',$tags_name):'')?>"><i> แยกคำด้วย คอมม่า (,) </i>
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
