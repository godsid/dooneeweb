<?php include('header.php'); ?>


			<?php include('breadcrumb.php'); ?>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Members</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
							<p><span class="span1">User ID:</span><span class="span11"><?=$member['user_id']?></span></p>
							<p><span class="span1">Email:</span><span class="span11"><?=$member['email']?></span></p>
							<p><span class="span1">Name:</span><span class="span11"><?=$member['firstname']?> <?=$member['lastname']?></span></p>
							<p><span class="span1">Phone:</span><span class="span11"><?=$member['phone']?></span></p>
							<p><span class="span1">Gender:</span><span class="span11"><?=$member['gender']?></span></p>
							<form method="post" action="<?=backoffice_url('/member/ruleSubmit/'.$member['user_id'])?>">
							<p><span class="span1">Role:</span><span class="span11">
								
								<select name="permission">
									<option value="ADMIN" <?=($member['permission']=='ADMIN'?'selected="selected"':'')?>>Admin</option>
									<option value="USER" <?=($member['permission']=='USER'?'selected="selected"':'')?>>User</option>
								</select>
								<input type="submit" value="Save" />
							</span></p>
							</form>
						</div>
					</div>
				</div><!--/span-->
			</div><!--/row-->

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Package</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
							<table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                        	<th>id</th>
                            <th>Package</th>
                            <th>Create</th>
                            <th>Expire</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($packages as $package){
                        	$expire = strtotime($package['expire_date']);
                         ?>
                        <tr>
                            <td><?=$package['package_id']?></td>
                            <td class="center"><?=$package['title']?></td>
                            <td class="center"><?=$package['create_date']?></td>
                            <td class="center">

                            	<?=$package['expire_date'],"<br/>","เหลือ ",floor(($expire-time())/(60*60*24))," วัน";
                            ?>
                            </td>
                            <td class="center"><?php 
                            	
                            	if($expire>time()){?>
                            		<span class="label-success label label-default">Active</span>
                            	<?php }else{?>
                            		<span class="label-default label label-warning ">Expire</span>
                            	<?php }
                            	?></td>
                        </tr>
                        <?php } ?>
                        
                        </tbody>
                    </table>
						</div>
					</div>
				</div><!--/span-->
			</div><!--/row-->

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Payment</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
							<table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Package</th>
                            <th>Channel</th>
                            <th>Agent/Card No.</th>
                            <th>Create</th>
                            <th>Response</th>
                            <th>Ref.</th>
                            <th>Error</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($invoices as $invoice) { ?>
                        <tr>
                            <td><?=$invoice['invoice_id']?></td>
                            <td class="center"><?=$invoice['title']?></td>
                            <td class="center"><?=$invoice['channel']?></td>
                            <td class="center"><?=$invoice['agent']?><?=$invoice['resp_pan']?></td>
                            <td class="center"><?=$invoice['create_date']?></td>
                            <td class="center"><?=$invoice['resp_date']?></td>
                            <td class="center"><?=$invoice['resp_tran_ref']?></td>
                            <td class="center"><?=$invoice['resp_fail_reason']?></td>
                            <td class="center">
                                <span class="label-warning label label-default"><?=$invoice['status']?></span>
                            </td>
                        </tr>
                        <?php }?>
                        
                        </tbody>
                    </table>
						</div>
					</div>
				</div><!--/span-->
			</div><!--/row-->
    
<?php include('footer.php'); ?>
