<!DOCTYPE html>
<html lang="th">
  <!-- Top Head -->
  <?php @include('incs/header-top.html'); ?>
  <!-- /Top Head -->
  <script>
   $(document).ready(function(){
			 $("#nav-drop li a").removeClass("selected");
			 $('#nav-drop>li:nth-child(3)>a').addClass('selected');
	}); 
  
  </script>
  <body>

    
      <!-- Header -->
	  <?php @include('incs/header.html'); ?>
      <!-- /Header -->
      <!-- container -->
      <section id="contents">

          <div class="container bx-all-pro">
          	<h2 class="big"><a href="#" title="ข่าว/โปรโมชั่น">ข่าว/<span class="txt-red">โปรโมชั่น</span> <i class="icon-double-angle-right"></i></a></h2>
            
            <div id="toc" class="mask-col">
                <article class="contents-auto reader">
                	<figure><img src="img/thumb/big-promotion.jpg" alt="ดูหนังจัดเต็ม!! ซื้อแพ็คเกจดูหนัง 3 เดือน รับสิทธิ์ดูหนังฟรีเพิ่มอีก 1 เดือน เมื่อชำระผ่าน AIS mPAY Mastercard"><figcaption class="hid">ดูหนังจัดเต็ม!! ซื้อแพ็คเกจดูหนัง 3 เดือน รับสิทธิ์ดูหนังฟรีเพิ่มอีก 1 เดือน เมื่อชำระผ่าน AIS mPAY Mastercard</figcaption></figure>
                	<h1><span class="txt-red">ดูหนังจัดเต็ม!! ซื้อแพ็คเกจดูหนัง 3 เดือน</span> รับสิทธิ์ดูหนังฟรีเพิ่มอีก 1 เดือน เมื่อชำระผ่าน AIS mPAY Mastercard</h1>
                    <p>ลูกค้าที่ซื้อ Package Doonee 3 เดือน ราคา 387 บาท และชำระผ่าน <span class="txt-brown">AIS mPAY MasterCard</span> รับสิทธิ์พิเศษดูหนังฟรีอีก 1 เดือนเต็มคุ้มสุดๆ บอกเลย!!</p>
					<p><span class="txt-brown">AIS mPAY MasterCard</span> บัตรซื้อสินค้าออนไลน์แทนบัตรเครดิต เป็นบริการใหม่ที่จะช่วยเพิ่มความสะดวกสบายซื้อสินค้าออนไลน์แทนบัตรเครดิต โดยไม่จำเป็นต้องมีบัตรเครดิต ก็สามารถซื้อของกับเว็บไซต์ที่รับชำระผ่านบัตรเครดิต (MasterCard) ได้ ร่วมกับเว็บไซต์ Doonee.com ในเครือ MTHAI! มอบสิทธิพิเศษให้ลูกค้าที่ดูหนังออนไลน์บนเว็บไซต์ Doonee.com 
                    </p>
                    
                    <p><strong>เงื่อนไขการเข้าร่วม promotion</strong></p>
					<ul>
                    	<li>- ลูกค้าต้องชำระผ่านบัตร AIS mPAY MasterCard เท่านั้น</li>
                        <li>- ลูกค้าจะได้รับสิทธิ์ดูหนังฟรี 1 เดือนทันทีหลังจากทำรายการ</li>
                        <li>- ระยะเวลาโปรโมชั่นตั้งแต่วันนี้ -24 พฤศจิกายน 2556 (3 เดือน) นะค่ะ</li>
                    </ul>

                </article>
                <aside id="aside" class="aside">
                	<div class="ads_300x250">
                    	<img src="img/ads_300x250.jpg" alt="ADs">
                    </div>
                    
                    <div class="sr-related">
                    	<h3><a href="#" title="โปรโมชั่นอื่นๆ">โปรโมชั่นอื่นๆ</a></h3>
                        <div class="thm-news">
                        <? for($i=1;$i<=4;$i++){
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
                        <a class="more" href="#" title="ดูทั้งหมด &raquo;">ดูทั้งหมด &raquo;</a>
                    </div>
                </aside>
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
