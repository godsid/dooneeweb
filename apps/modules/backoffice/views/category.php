<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Categorys</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/category/create/')?>" title="เพิ่ม Category" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form method="post" action="<?=backoffice_url('/category/submitSort')?>">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Category</th>
								  <th>Order</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($categories['items'] as $category){ ?>
							<tr>
								<td>
									<a href="<?=backoffice_url('/category/'.$category['category_id'])?>"><?=($category['parent_id']>0?"--":""),$category['title']?></a>
								</td>
								<td>
									<input type="hidden" name="sort[category_id][]" value="<?=$category['category_id']?>" />
									<input type="text" name="sort[order][]" value="<?=$category['sort']?>" width="10"  />
								</td>

								<td class="center">
									<?php if($category['status']=='ACTIVE'){?>
									<span class="label label-success">Active</span>
									<?php }else{?>
									<span class="label">InActive</span>
									<?php }?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/category/edit/'.$category['category_id'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<?php if($category['status']=='ACTIVE'){?>
									<a class="btn btn-danger" href="<?=backoffice_url('/category/inactive/'.$category['category_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{?>
									<a class="btn btn-success" href="<?=backoffice_url('/category/active/'.$category['category_id'])?>">
										<i class="icon-ok-circle icon-white"></i>  
										Active                                            
									</a>
									<?php }?>
								</td>
							</tr>
							<?php }?>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" value="Save"></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						  </tbody>
					  </table>
					  </form>       
					  <div class="pagination pagination-centered"><?=$pageing?></div>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
