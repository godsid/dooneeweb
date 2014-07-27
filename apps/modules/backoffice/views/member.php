<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Members</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Username</th>
								  <th>Date registered</th>
								  <th>Role</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($members['items'] as $member){ ?>
							<tr>
								<td><?=$member['email']?></td>
								<td class="center"><?=$member['create_date']?></td>
								<td class="center"></td>
								<td class="center">
									<?php if($member['status']=='ACTIVE'){?>
									<span class="label label-success">Active</span>
									<?php }else{?>
									<span class="label">InActive</span>
									<?php }?>
								</td>
								<td class="center">
									<?php if($member['status']=='ACTIVE'){?>
									<a class="btn btn-danger" href="<?=backoffice_url('/member/inactive/'.$member['user_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{?>
									<a class="btn btn-success" href="<?=backoffice_url('/member/active/'.$member['user_id'])?>">
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
