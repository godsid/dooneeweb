<!DOCTYPE html>
<html lang="th">
  <!-- Top Head -->
  <?php @include('incs/header-top.html'); ?>
  <!-- /Top Head -->
  <script>
   $(document).ready(function(){
			 $("#nav-drop li a").removeClass("selected");
			 $('#nav-drop>li:nth-child(1)>a').addClass('selected');
	}); 
  
  </script>
  <body>

    
      <!-- Header -->
	  <?php @include('incs/header.html'); ?>
      <!-- /Header -->
      <!-- Highlight -->
      <section class="hl-slider container">
        <div id="slider" class="flexslider">
          <ul class="slides">
            <li>
              <a href="#" title="Test Slider 01">
                <img src="img/big-slide-01.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือนความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 02">
                <img src="img/big-slide-02.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 03">
                <img src="img/big-slide-03.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 04">
                <img src="img/big-slide-04.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 05">
                <img src="img/big-slide-05.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 06">
                <img src="img/big-slide-06.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 07">
                <img src="img/big-slide-07.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
            <li>
              <a href="#" title="Test Slider 08">
                <img src="img/big-slide-08.jpg" alt="">
                <div>
                    <h2><i class="icon-film"></i> CAPTAIN AMERICA: THE WINTER SOLDIER</h2>
                    <p>ความสุขทะลุจอ! กับ LG Smart TV จัดเต็มข้อเสนอสุดพิเศษ ให้ดูหนังฟรีนานถึง 6 เดือน</p>
                </div>
              </a>
            </li>
          </ul>
        </div>
        
        <div id="carousel" class="flexslider">
          <ul class="slides">
            <li>
              <img src="img/big-slide-01.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-02.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-03.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-04.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-05.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-06.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-07.jpg" alt="">
            </li>
            <li>
              <img src="img/big-slide-08.jpg" alt="">
            </li>
          </ul>
        </div>
      </section>
      <!-- /Highlight --> 
      <!-- container -->
      <section id="contents">
      	  <div class="container bx-mv-slide flexslider">
          	  <h2><a href="#" title="หนังยอดนิยม 20 อันดับ">หนังยอดนิยม <span class="txt-red">20 อันดับ</span> <i class="icon-double-angle-right"></i></a></h2>
              <ul class="slides thm-mv">
              <? for($i=1;$i<=20;$i++){
				  $img_url = "img/thumb/movies-10.jpg";
				  $name = "Content Name";
				  $type = "HD";
				  switch($i%10)
				  {
					  case "0": 
								  $img_url = "img/thumb/movies-01.jpg";
								  $name = "Immortal Masterpiece";
								  $type = "FREE";
						  break;
					  case "1": 
								  $img_url = "img/thumb/movies-02.jpg";
								  $name = "Prosecutor Princess";
								  $type = "FULL HD";
						  break;
					  case "2": 
								  $img_url = "img/thumb/movies-03.jpg";
								  $name = "The Day After Tomorrow";
								  $type = "HD";
						  break;
					  case "3": 
								  $img_url = "img/thumb/movies-04.jpg";
								  $name = "Roof top Prince";
								  $type = "HD";
						  break;
					  case "4": 
								  $img_url = "img/thumb/movies-05.jpg";
								  $name = "Full House";
								  $type = "FULL HD";
						  break;  
					  case "5": 
								  $img_url = "img/thumb/movies-06.jpg";
								  $name = "Full House";
								  $type = "FREE";
						  break;  
					  case "6": 
								  $img_url = "img/thumb/movies-07.jpg";
								  $name = "Prosecutor Princess";
								  $type = "HD";
						  break;
					  case "7": 
								  $img_url = "img/thumb/movies-08.jpg";
								  $name = "The Day After Tomorrow";
								  $type = "FULL HD";
						  break;
					  case "8": 
								  $img_url = "img/thumb/movies-09.jpg";
								  $name = "Roof top Prince";
								  $type = "HD";
						  break;
					  case "9": 
								  $img_url = "img/thumb/movies-10.jpg";
								  $name = "Full House";
								  $type = "HD";
						  break;           
				  } ?>
                <li>
                  	<article>
                        <a title="Immortal Masterpiece" class="lb-popup" href="javascript:;" rel="#popup-login">
                            <img alt="Immortal Masterpiece" src="<? echo $img_url; ?>">
                            <h3><? echo $name; ?></h3>
                            <span class="type <? if($i%5==0) { ?>free <? } ?>"><? echo $type; ?></span>
                        </a>
                        <footer>
                            <p class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star drop"></i></p>
                            <p class="fv"><a href="#" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
                        </footer>
                    </article>
                </li>
                
			  <? } ?>

              </ul>

          </div>
          
          <div class="container bx-all-movies">
          	<h2><a href="#" title="หนังทั้งหมด">หนังทั้งหมด <i class="icon-double-angle-right"></i></a></h2>
            <ul class="thm-mv">
                <? for($i=1;$i<=18;$i++){
				  $img_url = "img/thumb/movies-10.jpg";
				  $name = "Content Name";
				  $type = "HD";
				  switch($i%10)
				  {
					  case "0": 
								  $img_url = "img/thumb/movies-01.jpg";
								  $name = "Immortal Masterpiece";
								  $type = "FREE";
						  break;
					  case "1": 
								  $img_url = "img/thumb/movies-02.jpg";
								  $name = "Prosecutor Princess";
								  $type = "FULL HD";
						  break;
					  case "2": 
								  $img_url = "img/thumb/movies-03.jpg";
								  $name = "The Day After Tomorrow";
								  $type = "HD";
						  break;
					  case "3": 
								  $img_url = "img/thumb/movies-04.jpg";
								  $name = "Roof top Prince";
								  $type = "HD";
						  break;
					  case "4": 
								  $img_url = "img/thumb/movies-05.jpg";
								  $name = "Full House";
								  $type = "FULL HD";
						  break;  
					  case "5": 
								  $img_url = "img/thumb/movies-06.jpg";
								  $name = "Full House";
								  $type = "FREE";
						  break;  
					  case "6": 
								  $img_url = "img/thumb/movies-07.jpg";
								  $name = "Prosecutor Princess";
								  $type = "HD";
						  break;
					  case "7": 
								  $img_url = "img/thumb/movies-08.jpg";
								  $name = "The Day After Tomorrow";
								  $type = "FULL HD";
						  break;
					  case "8": 
								  $img_url = "img/thumb/movies-09.jpg";
								  $name = "Roof top Prince";
								  $type = "HD";
						  break;
					  case "9": 
								  $img_url = "img/thumb/movies-10.jpg";
								  $name = "Full House";
								  $type = "HD";
						  break;           
				  } ?>
                <li>
                  	<article>
                        <a title="Immortal Masterpiece" href="player.php">
                            <img alt="Immortal Masterpiece" src="<? echo $img_url; ?>">
                            <h3><? echo $name; ?></h3>
                            <span class="type <? if($i%5==0) { ?>free <? } ?>"><? echo $type; ?></span>
                        </a>
                        <footer>
                            <p class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star drop"></i></p>
                            <p class="fv<? if($i==10) { ?>ed<? } ?>"><a href="#" title="รายการโปรด"><i class="<? if($i==10) { ?>icon-heart<? } else {?>icon-heart-empty<? } ?>"></i> รายการโปรด</a></p>
                        </footer>
                    </article>
                </li>
                
			  <? } ?>
              </ul>
              
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
