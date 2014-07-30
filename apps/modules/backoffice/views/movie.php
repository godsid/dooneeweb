<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-film"></i> Movies</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/movie/create/')?>" title="เพิ่มภาพยนต์ใหม่" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Name</th>
								  <th>Category</th>
								  <th>Ratio</th>
								  <th>Sound</th>
								  <th>Subtitle</th>
								  <th>Length</th>
								  <th>Year</th>
								  <th>CreateDate</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($movies['items'] as $movie){ ?>
							<tr>
								<td><a href="<?=backoffice_url('/movie/'.$movie['movie_id'])?>"><?=$movie['title']?><br/><?=$movie['title_en']?></a></td>
								<td class="center"></td>
								<td class="center">
									<?php
									if($movie['is_free']){
										echo 'Free ';
									}
									if($movie['is_hot']){
										echo 'Hot ';
									}
									if($movie['is_hd']){
										echo 'HD ';
									}
									?>
								</td>
								<td class="center"><?=$movie['audio']?></td>
								<td class="center"><?=$movie['subtitle']?></td>
								<td class="center"><?=($movie['length']/60)?> Min</td>
								<td class="center"><?=$movie['year']?></td>
								<td class="center"><?=$movie['create_date']?></td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/movie/edit/'.$movie['movie_id'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<?php
									if($movie['status']=='ACTIVE'){ ?>
										<a class="btn btn-danger" href="<?=backoffice_url('/movie/inactive/'.$movie['movie_id'])?>">
										<i class="icon-lock icon-white"></i> 
										InActive
									</a>
									<?php }else{ ?>
										<a class="btn btn-success" href="<?=backoffice_url('/movie/active/'.$movie['movie_id'])?>">
										<i class="icon-ok-circle icon-white"></i> 
										Active
									</a>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						  </tbody>
					  </table>       
					  <div class="pagination pagination-centered"><?=$pageing?></div>          
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
