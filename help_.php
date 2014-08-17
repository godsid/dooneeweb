<!DOCTYPE html>
<html lang="th">
  <!-- Top Head -->
  <?php @include('incs/header-top.html'); ?>
  <!-- /Top Head -->
  <script>
   $(document).ready(function(){
			 $("#nav-drop li a").removeClass("selected");
			 $('#nav-drop>li:nth-child(6)>a').addClass('selected');
	}); 
  
  </script>
  <body>

    
      <!-- Header -->
	  <?php @include('incs/header.html'); ?>
      <!-- /Header -->
      <!-- container -->
      <section id="contents">

          <div class="container bx-all-pro">
          	<h2 class="big"><a href="#" title="วิธีการดูหนัง">วิธีการดูหนัง <i class="icon-double-angle-right"></i></a></h2>
            <div class="thm-news _cd-col-xs-6-sm-4-md-3">
                <? for($i=1;$i<=8;$i++){
				  $img_url = "img/thumb/news-250x130-08.jpg";
				  $name = "Content Name";
				  switch($i%7)
				  {
					  case "0": 
								  $img_url = "img/thumb/news-250x130-01.jpg";
								  $name = "เล่น LINE ไม่จำกัด โทรฟรี 500นาที นาน 10เดือน";
						  break;
					  case "1": 
								  $img_url = "img/thumb/news-250x130-02.jpg";
								  $name = "Grand Openning i-mobile Shop สาขา บุรีรัมย์";
						  break;
					  case "2": 
								  $img_url = "img/thumb/news-250x130-03.jpg";
								  $name = "ซื้อมือถือ i-mobile DTV Series ทุกรุ่น รับของแถม 3ชิ้นฟรี มูลค่ากว่า 1,900.";
						  break;
					  case "3": 
								  $img_url = "img/thumb/news-250x130-04.jpg";
								  $name = "เล่น LINE ไม่จำกัด โทรฟรี 500นาที นาน 10เดือน";
						  break;
					  case "4": 
								  $img_url = "img/thumb/news-250x130-05.jpg";
								  $name = "แฟนคลับ “กิเลนผยอง” เตรียมเฮ กิจกรรมมีตแอนด์กรี๊ดกับสตาร์ดังของทีม";
						  break;  
					  case "5": 
								  $img_url = "img/thumb/news-250x130-06.jpg";
								  $name = "แฟนคลับ “กิเลนผยอง” เตรียมเฮ กิจกรรมมีตแอนด์กรี๊ดกับสตาร์ดังของทีม";
						  break;  
					  case "6": 
								  $img_url = "img/thumb/news-250x130-07.jpg";
								  $name = "Grand Openning i-mobile Shop สาขา บุรีรัมย์";
						  break;
					  case "7": 
								  $img_url = "img/thumb/news-250x130-08.jpg";
								  $name = "แฟนคลับ “กิเลนผยอง” เตรียมเฮ กิจกรรมมีตแอนด์กรี๊ดกับสตาร์ดังของทีม";
						  break;
				  } ?>
                  	<article>
                        <a title="<? echo $name; ?>" href="promotion-detail.php">
                            <img alt="<? echo $name; ?>" src="<? echo $img_url; ?>">
                            <h3><? echo $name; ?></h3>
                        </a>
                    </article>

                
			  <? } ?>
              </div>
              
              <div class="ctrl-page">
                <a class="load-more" href="#" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
              </div>
          </div>
		
        
          
      </section>
      <!-- /container -->
    
    <!-- footer -->
    <?php @include('incs/footer.html'); ?>
    <!-- /footer -->
	<!-- javascript -->
	<?php @include('incs/js.html'); ?>
    <!-- /javascript -->
  </body>
</html>
