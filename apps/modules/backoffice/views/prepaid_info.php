<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>
<div class="box-content">
	<table border="1" class="table table-striped table-bordered bootstrap-datatable datatable">
	  <thead>
		<tr>
			<th>Serial</th>
			<th><?=chunk_split($prepaid['serial_number'],4,' ')?></th>
		</tr>
		<tr>
			<th>Code</th>
			<th><?=chunk_split($prepaid['code'],4,' ')?></th>
		</tr>
		<tr>
			<th>Price</th>
			<th><?=$prepaid['price']?></th>
		</tr>
		<tr>
			<th>Package</th>
			<th><?=$package['title']?></th>
		</tr>
		<tr>
			<th>User</th>
			<th><a href="<?=backoffice_url('/member/'.$prepaid['user_id'])?>" target="_blank"><?=$prepaid['user_id']?></a></th>
		</tr>
		<tr>
			<th>Start Date</th>
			<th><?=$prepaid['start_date']?></th>
		</tr>
		<tr>
			<th>Expire Date</th>
			<th><?=$prepaid['expire_date']?></th>
		</tr>
		<tr>
			<th>Used Date</th>
			<th><?=$prepaid['used_date']?></th>
		</tr>
		<tr>
			<th>Create Date</th>
			<th><?=$prepaid['create_date']?></th>
		</tr>
		<tr>
			<th>Status</th>
			<th><?=$prepaid['status']?></th>
		</tr>
	  </thead>
	</table>
</div>
</html>