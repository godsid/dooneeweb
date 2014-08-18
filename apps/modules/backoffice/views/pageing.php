<?php if($maxPage>1){?>
<ul class="pagination">
<?php
$link=$url."?";
for($i=1;$i<=$maxPage;$i++){
	if($i==$page){
		echo '<li class="active"><a href="javascript:;">',$i,'</a></li>';
	}else{
		echo '<li><a href="',$link,'page=',($i),'&limit=',$itemPerPage,'"> ',$i,' </a></li>';
	}
}
?>
</ul>
<?php
}
/*

$stages = 3;
$targetpage  ="";
$total_pages  = $maxPage;
$limit = $itemPerPage;
$link=$url."?";
// Initial page num setup
if ($page == 0){$page = 1;}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$LastPagem1 = $lastpage - 1;

if($lastpage > 1){
	// Previous
	if ($page > 1){
		echo '<li><a href="',$link,'page=',$prev,'">Prev</a></li>';
	}else{
		echo '<li class="active"><a href="',$link,'page=',$prev,'">Prev</a></li>';
	}

	// Pages
	if ($lastpage < 7 + ($stages * 2)){ // Not enough pages to breaking it up
		for ($counter = 1; $counter <= $lastpage; $counter++){
			if ($counter == $page){
				echo '<li class="active"><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
			}else{
				echo '<li><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
			}
		}
	}
	elseif($lastpage > 5 + ($stages * 2)){ // Enough pages to hide a few?
	// Beginning only hide later pages
		if($page < 1 + ($stages * 2)){
			for ($counter = 1; $counter < 4 + ($stages * 2); $counter++){
				if ($counter == $page){
					echo '<li class="active"><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
				}else{
					echo '<li><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
				}
			}
			echo "...";			
			echo '<li><a href="',$link,'page=',$LastPagem1,'">',$LastPagem1,'</a></li>';
			echo '<li><a href="',$link,'page=',$lastpage,'">',$lastpage,'</a></li>';
		}
		// Middle hide some front and some back
		elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2)){
			echo '<li><a href="',$link,'page=1">1</a></li>';
			echo '<li><a href="',$link,'page=2">2</a></li>';
			echo "...";
			for ($counter = $page - $stages; $counter <= $page + $stages; $counter++){
				if ($counter == $page){
					echo '<li class="active"><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
				}else{
					echo '<li><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
				}
				echo "...";
				echo '<li><a href="',$link,'page=',$LastPagem1,'">',$LastPagem1,'</a></li>';
				echo '<li><a href="',$link,'page=',$lastpage,'">',$lastpage,'</a></li>';
			}
		}
	// End only hide early pages
	}else{
		echo '<li><a href="',$link,'page=1">1</a></li>';
		echo '<li><a href="',$link,'page=2">2</a></li>';
		echo "...";
		for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++){
			if ($counter == $page){
				echo '<li class="active"><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
			}else{
				echo '<li><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
			}
		}
	}

	// Next
	if ($page < $counter - 1){
		echo '<li><a href="',$next,'page=',$counter,'">Next</a></li>';
	}else{
		echo '<li class="active"><a href="',$link,'page=',$counter,'">',$counter,'</a></li>';
	}
	
}
*/

?>