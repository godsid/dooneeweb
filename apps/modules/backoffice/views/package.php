<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Packages</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/package/create/')?>" title="เพิ่ม Package" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Package</th>
								  <th>Day</th>
								  <th>Price</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($packages['items'] as $package){ ?>
							<tr>
								<td><a href="<?=backoffice_url('/package/'.$package['package_id'])?>"><?=$package['title']?></a></td>
								<td class="center"><?=$package['dayleft']?></td>
								<td class="center"><?=$package['price']?></td>
								<td class="center">
									<?php if($package['status']=='ACTIVE'){?>
									<span class="label label-success">Active</span>
									<?php }else{?>
									<span class="label">InActive</span>
									<?php }?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/package/edit/'.$package['package_id'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<?php if($package['status']=='ACTIVE'){?>
									<a class="btn btn-danger" href="<?=backoffice_url('/package/inactive/'.$package['package_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{?>
									<a class="btn btn-success" href="<?=backoffice_url('/package/active/'.$package['package_id'])?>">
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
