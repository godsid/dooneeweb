<div>
	<ul class="breadcrumb">
		<li>
			<a href="<?=backoffice_url('/home')?>">Home</a>
		</li>
		<?php
		if(isset($breadcrumb)){

			for($i=0,$j=count($breadcrumb)-1;$i<$j;$i++) {
		?>
			<li>
				 <span class="divider">/</span> <a href="<?=$breadcrumb[$i]['url']?>"><?=$breadcrumb[$i]['title']?></a>
			</li>
		<?php	
			}
		?>
			<li>
				 <span class="divider">/</span> <span><?=$breadcrumb[$i]['title']?></span>
			</li>
		<?php
		}
		?>
		
	</ul>
</div>