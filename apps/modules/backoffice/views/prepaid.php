<?php include('header.php'); ?>
			<?php include('breadcrumb.php'); ?>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Prepaid Card</h2>
						<div class="box-icon">
							<a href="<?=backoffice_url('/prepaid/create/')?>" title="สร้างบัตรเติมเงิน" class="btn btn-edit btn-round"><i class="icon-plus-sign"></i></a>
						</div>
					</div>
					<div class="box-search">
						<form method="GET" id="searchForm" action="<?=backoffice_url('/movie/search')?>">
							<!--<label class="inline-label">Serial: <input class="input-xlarge" type="text" name="q_serial"></label>
							<label class="inline-label">Serial: <input class="input-xlarge" type="text" name="q_stratdate"></label>
							<label class="inline-label">Serial: <input class="input-xlarge" type="text" name="q_expiredate "></label>

							<input type="submit" value="Search" style="display:none;" /><a href="javascript:$('#searchForm').submit();" class="btn"><i class="glyphicon icon-search"></i> Search</a>-->
						</form>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Serial</th>
								  <th>Price</th>
								  <th>Package</th>
								  <th>User</th>
								  <th>Start Date</th>
								  <th>Expire Date</th>
								  <th>Used Date</th>
								  <th>Create Date</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($prepaids['items'] as $prepaid){ ?>
							<tr>
								<td><a href="<?=backoffice_url('/prepaid/'.$prepaid['serial_number'])?>"><?=$prepaid['serial_number']?></a></td>
								<td class="center"><?=$prepaid['price']?></td>
								<td class="center"><?=$prepaid['title']?></td>
								<td class="center"><?=$prepaid['email']?></td>
								<td class="center"><?=$prepaid['start_date']?></td>
								<td class="center"><?=$prepaid['expire_date']?></td>
								<td class="center"><?=$prepaid['used_date']?></td>
								<td class="center"><?=$prepaid['create_date']?></td>
								<td class="center">
									<span class="label"><?php echo $prepaid['status']?></span>
								</td>
								<td class="center">
									<a class="btn btn-info" href="<?=backoffice_url('/prepaid/edit/'.$prepaid['serial_number'])?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
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
