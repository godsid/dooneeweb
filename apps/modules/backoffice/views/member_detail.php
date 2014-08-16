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
    
<?php include('footer.php'); ?>
