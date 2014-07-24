<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Banners</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/banner/create/')?>" title="เพิ่ม Banner" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Banner</th>
								  <th>Day</th>
								  <th>Price</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($banners['items'] as $banner){ ?>
							<tr>
								<td><a href="<?=backoffice_url('/banner/'.$banner['banner_id'])?>"><?=$banner['title']?></a></td>
								<td class="center"><?=$banner['dayleft']?></td>
								<td class="center"><?=$banner['price']?></td>
								<td class="center">
									<?php if($banner['status']=='ACTIVE'){?>
									<span class="label label-success">Active</span>
									<?php }else{?>
									<span class="label">InActive</span>
									<?php }?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/banner/edit/'.$banner['banner_id'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<?php if($banner['status']=='ACTIVE'){?>
									<a class="btn btn-danger" href="<?=backoffice_url('/banner/inactive/'.$banner['banner_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{?>
									<a class="btn btn-success" href="<?=backoffice_url('/banner/active/'.$banner['banner_id'])?>">
										<i class="icon-ok-circle icon-white"></i>  
										Active                                            
									</a>
									<?php }?>
								</td>
							</tr>
							<?php }?>
						  </tbody>
					  </table>       
					  <div class="pagination pagination-centered"><?=$pageing?></div>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
