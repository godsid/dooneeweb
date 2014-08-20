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
									</div>
								</div>
								<?php if(isset($movie['is_series'])&&$movie['is_series']=='YES'){?>
								<div class="control-group">
									<label class="control-label"></label>
									<div class="controls">
									</div>
								</div>
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
