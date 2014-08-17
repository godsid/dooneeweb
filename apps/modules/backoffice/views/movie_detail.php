<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Movies: <?=$movie['title']?></h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/movie/edit/'.$movie['movie_id'])?>" title="แก้ไข" class="btn btn-edit btn-round"><i class="icon-edit"></i></a>
						</div>
					</div>
					<div class="box-content">
							<div><span class="span2">ภาพปก: </span><span class="span10"><img src="<?=static_url($movie['cover'])?>" width="100" /></span></div>
							<div><span class="span2">ชื่อหนัง (ภาษาไทย): </span><span class="span10"><?=$movie['title']?></span></div>
							<div><span class="span2">ชื่อหนัง (ภาษาอังกฤษ): </span><span class="span10"><?=$movie['title_en']?></span></div>
							<div><span class="span2">หมวดหมู่: </span><span class="span10">
							<?php foreach ($movie['category'] as $category) { 
								echo $category['title'],", ";
							} ?>
							</span></div>
							<div><span class="span2">Clip url: </span><span class="span10"><a href="<?=$movie['path']?>"><?=$movie['path']?></a></span></div>
							<div><span class="span2">Rating/คะแนน: </span><span class="span10"><?=$movie['rating']?> / <?=$movie['score']?></span></div>
							<div><span class="span2">นักแสดง: </span><span class="span10"><?=$movie['cast']?></span></div>
							<div><span class="span2">ผู้กำกับ: </span><span class="span10"><?=$movie['director']?></span></div>
							<div><span class="span2">ประเภท: </span><span class="span10"><?=$movie['genre']?></span></div>
							<div><span class="span2">เสียง/คำบรรยาย: </span><span class="span10"><?=$movie['audio']?> / <?=$movie['subtitle']?></span></div>
							<div><span class="span2">ความยาว: </span><span class="span10"><?=(int)($movie['length']/60)?> นาที</span></div>
							<div><span class="span2">ปี: </span><span class="span10"><?=$movie['year']?></span></div>
							<div><span class="span2">รายละเอียด: </span><span class="span10"><?=nl2br($movie['description'])?></span></div>
							<div><span class="span2">ซีรี่ย์: </span><span class="span10"><?=$movie['is_series']?></span></div>
							<div><span class="span2">ฟรี: </span><span class="span10"><?=$movie['is_free']?></span></div>
							<div><span class="span2">HD : </span><span class="span10"><?=$movie['is_hd']?></span></div>
							<div><span class="span2">แนะนำ : </span><span class="span10"><?=$movie['is_hot']?></span></div>
							<div><span class="span2">3D : </span><span class="span10"><?=$movie['is_3d']?></span></div>
							<div><span class="span2">เมื่อ: </span><span class="span10"><?=$movie['create_date']?></span></div>
							<div><span class="span2">แก้ไขล่าสุด: </span><span class="span10"><?=(is_null($movie['edit_date']))?'-':$movie['edit_date']?></span></div>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
