<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?=backoffice_url('/home')?>">Home</a>
		</li>
		<?php
		if(isset($breadcrumb)){
			foreach ($breadcrumb as $value) {
		?>
			<li>
				 <span class="divider">/</span> <a href="<?=$value['url']?>"><?=$value['title']?></a>
			</li>
		<?php	
			}
		}
		?>
		
	</ul>
</div>