<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?=($this->uri->segment(3)=='news')?"ข่าว/โปรโมชั่น":"วิธีการรับชม"?></h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/article/create/'.$this->uri->segment(3))?>" title="เพิ่ม หัวข้อ" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Title</th>
								  <th>Cover</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($articles['items'] as $article){ ?>
							<tr>
								<td><a href="<?=backoffice_url('/article/edit/'.strtolower($article['type']).'/'.$article['article_id'])?>"><?=$article['title']?></a></td>
								<td class="center">
									<img src="<?=$article['cover']?>" width="80" />
								</td>
								<td class="center">
									<?php if($article['status']=='ACTIVE'){?>
									<span class="label label-success">Active</span>
									<?php }else{?>
									<span class="label">InActive</span>
									<?php }?>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/article/edit/'.strtolower($article['type']).'/'.$article['article_id'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<?php if($article['status']=='ACTIVE'){?>
									<a class="btn btn-danger" href="<?=backoffice_url('/article/inactive/'.strtolower($article['type']).'/'.$article['article_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{?>
									<a class="btn btn-success" href="<?=backoffice_url('/article/active/'.strtolower($article['type']).'/'.$article['article_id'])?>">
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
