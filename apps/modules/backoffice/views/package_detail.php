<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Packages</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/package/edit/'.$package['package_id'])?>" class="btn btn-setting btn-round"><i class="icon-edit"></i></a>
						</div>
					</div>
					<div class="box-content">
						<div class="row-fluid">
							<div><span class="span2">Banner: </span><span class="span10"><img src="<?=static_url($package['banner'])?>" height="100" /></span></div>
							<div><span class="span2">ชื่อ: </span><span class="span10"><?=$package['title']?></span></div>
							<div><span class="span2">ชื่อรหัส: </span><span class="span10"><?=$package['name']?></span></div>
							<div><span class="span2">ราคา: </span><span class="span10"><?=$package['price']?> บาท</span></div>
							<div><span class="span2">ใช้งานได้: </span><span class="span10"><?=$package['dayleft']?> วัน</span></div>
							<div><span class="span2">รายละเอียด: </span><span class="span10"><?=$package['detail']?></span></div>
							<div><span class="span2">เงื่อนไข: </span><span class="span10"><?=$package['conditions']?></span></div>
								

						</div>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
