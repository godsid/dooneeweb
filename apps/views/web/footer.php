<footer id="footer">
  <?php if(isset($memberLogin)&&$memberLogin){ ?>
	<section class="ft-profile">
    	<a class="sw-expand-ft" onclick="$(this).toggleClass('active'); $('.ft-detail').toggleClass('expand').slideToggle(200);$('html, body').animate({scrollTop: $('.ft-logo').offset().top}, 200);" href="javascript:;" title="Expand"><span>บัญชีของฉัน</span> <i class="icon-double-angle-up"></i></a>
    	<ul class="ft-detail _cd-col-xs-6-md-3 container">
        	<li>
            	<h2><a href="<?=base_url('/member/profile')?>" title="บัญชีของฉัน"><i class="icon-smile"></i> บัญชีของฉัน</a></h2>
                <div class="inner ft-profile">
                    <p><b>อีเมล : <?=$memberLogin['email']?></b></p>
                    <p class="txt-big txt-blue">ดูหนังได้อีก <?php if(isset($memberLogin['expire_date'])){
                  $expireTime = strtotime($memberLogin['expire_date'])-time();
                  if($expireTime>0){
                    echo ceil($expireTime/86400);
                  }else{
                    echo 0;
                  }
                }
                else{
                  echo 0;
                }?> วัน</p>
                    <!--<p><a class="ui-btn btn-edit-profile" href="<?=base_url('/member/form')?>" title="แก้ไขข้อมูลส่วนตัว">แก้ไขข้อมูลส่วนตัว</a></p>-->
                    <p><a class="ui-btn-red btn-fill" href="<?=base_url('/package')?>" title="เติมเงินดูหนัง">เติมเงินดูหนัง</a></p>
                    <p><a class="ui-btn-blue btn-pk" href="<?=base_url('/member/package')?>" title="ดูแพ็กเกจของคุณ">ดูแพ็กเกจของคุณ</a></p>
                    <p><a class="ui-btn-green btn-pk" href="<?=base_url('/logout')?>" title="ออกจากระบบ">ออกจากระบบ</a></p>
                </div>
            </li>
            <li>
            <h2><a href="javascript:;" title="เติมเงิน"><i class="icon-money"></i> วิธีเติมเงิน</a></h2>
                <div class="inner pay">
                    <ul class="ic-pay _cd-col-xs-6">
                        <li><a href="<?=base_url('/help/11')?>" title="บัตรเครดิต"><i class="icon-credit-card"></i> บัตรเครดิต</a></li>
                        <li><a href="<?=base_url('/help/8')?>" title="จุดรับชำระค่าบริการ"><i class="icon-usd"></i> จุดรับชำระค่าบริการ</a></li>
                        <li><a href="<?=base_url('/help/9')?>" title="เอทีเอ็ม"><i class="icon-money"></i> เอทีเอ็ม</a></li> 
                        <li><a href="<?=base_url('/help/9')?>" title="เคาน์เตอร์ธนาคาร"><i class="icon-laptop"></i> เคาน์เตอร์ธนาคาร</a></li>
                        <li><a href="<?=base_url('/help/9')?>" title="ไอแบงก์กิ้ง"><i class="icon-btc"></i> ไอแบงก์กิ้ง</a></li>
                        <li><a href="<?=base_url('/help/10')?>" title="บัตรเติมเงิน"><i class="icon-credit-card"></i> บัตรเติมเงิน</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <h2><a href="javascript:;" title="ประวัติการเข้าชม"><i class="icon-time"></i> ประวัติการเข้าชม <!--<i class="icon-double-angle-right"></i>--></a></h2>
                <ul class="inner _cd-col-xs-4 thm-mv-small">
                <?php foreach($memberLogin['history'] as $history){?>
                	<li>
                    	<a title="<?=$history['title_en']?>" href="<?=base_url('/movie/'.$history['movie_id'].(is_numeric($history['episode_id'])?"/".$history['episode_id']:""))?>">
                            <img alt="<?=$history['title']?>" src="<?=static_url($history['cover'])?>">
                            <h3><?=$history['title']?></h3>
                        </a>
                    </li>
                <?php }?>
                </ul>
                <!--<p class="more"><a href="<?=base_url('/member/history')?>" title="ดูทั้งหมด">ดูทั้งหมด</a></p>-->
            </li>
            <li>
            	<h2><a href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด <!--<i class="icon-double-angle-right"></i>--></a></h2>
                <ul class="inner _cd-col-xs-4 thm-mv-small">
                	<?php foreach($memberLogin['favorites'] as $favorites){?>
                  <li>
                      <a title="<?=$favorites['title_en']?>" href="<?=base_url('/movie/'.$favorites['movie_id'])?>">
                            <img alt="<?=$favorites['title']?>" src="<?=static_url($favorites['cover'])?>">
                            <h3><?=$favorites['title']?></h3>
                        </a>
                    </li>
                <?php }?>
                   
                </ul>
                <!-- <p class="more"><a href="<?=base_url('/member/favorite')?>" title="ดูทั้งหมด">ดูทั้งหมด</a></p>-->
            </li>
        </ul>
    </section>
    <?php } ?>
    <div class="bar">
        <div class="container">
            <h2 class="ft-logo"><a href="<?=home_url()?>" title="DooneeTV"><img src="<?=static_url('/img/logo.png')?>" alt="Doonee TV" /></a></h2>
             <nav>
                <span class="copy"><b class="txt-red">DooneeTV</b> © 2014</span> |
                <a href="<?=base_url('/conditions')?>" title="ข้อกำหนดและเงื่อนไข">ข้อกำหนดและเงื่อนไข</a> |
                <a href="<?=base_url('/privacy')?>" title="นโยบายความเป็นส่วนตัว">นโยบายความเป็นส่วนตัว</a> |
                <a href="<?=base_url('/contactus')?>" title="ติดต่อเรา">ติดต่อเรา</a> |
                <a href="tel:028846188" title="Call Center">เบอร์ Call Center 02 884 6188</a>
             </nav>
             <div class="follow">
                <a class="ln" href="javascript:;" title="line">line</a>
                <a class="gg" href="https://plus.google.com/112188704808586278131" onclick="window.open(this.href);return false;" rel="publisher" title="google+">google+</a>
                <a class="tw" href="javascript:;" title="twitter">twitter</a>
                <a class="fb" href="https://www.facebook.com/dooneetvfanpage" onclick="window.open(this.href);return false;" title="facebook">facebook</a>
				<a class="yt icon-youtube-sign" href="http://www.youtube.com/channel/UCO3sNKV6Q3edWmAA6aXS0AA" target="_blank" title="youtube">youtube</a>
               
             </div>
             <p id="back2top" class="btn-back2top"><a href="javascript:;" title="back to top"></a></p>
         </div>
         <div class="truehit"><?php @include('truehit.php');?></div>
     </div>
</footer>

<!--login popup-->
<div id="popup-login" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ระบบสมาชิก</p>
  <div class="_cd-col-xs-12-sm-6">
    <div class="z-login form-control">
      <form action="<?=base_url('/member/login')?>" method="post" class="formLogin" id="login-webcam">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เข้าสู่ระบบ</legend>
          <ul class="section-regis">
            <li>
              <label for="email" class="hidden-xs _sf-col-xs-12">Email</label>
              <input type="text" placeholder="อีเมล์" class="_sf-col-xs-12" id="email" name="email" maxlength="100">
            </li>
            <li>
              <label for="password" class="hidden-xs _sf-col-xs-12">Password</label>
              <input type="password" placeholder="รหัสผ่าน" class="_sf-col-xs-12" id="password" name="password" maxlength="100">
            </li>
            <li class="keeplogin">
              <input type="checkbox" name="remember" id="keeplogged" value="yes">
              <label for="keeplogged">จดจำข้อมูลของฉัน</label>
            </li>
            <li> <a href="<?=base_url('/member/forgotpassword')?>" title="ลืมพาสเวิร์ด">ลืมรหัสผ่าน</a> </li>
            <li class="ctrl-submit">
              <button type="submit" id="btn-submit" value="เข้าสู่ระบบ" class="ui-btn btn-profile">เข้าสู่ระบบ</button>
            </li>
          </ul>
        </fieldset>
      </form>
    </div>
    <div class="z-regis">
      <p class="hd"><i class="gly-user"></i> สมัครสมาชิกใหม่</p>
      <p class="btn-regis"> <a href="<?=base_url('/register')?>" title="สมัครสมาชิก DooneeTV ที่นี่">สมัครสมาชิก DooneeTV ที่นี่</a> </p>
      <div class="c-fb">
        <p class="title">สมัครใช้งานด้วย</p>
        <a title="เข้าสู่ระบบผ่าน Facebook " href="javascript:getloginFB();" id="fb-signin" class="fb-signin"><i class="icon-facebook"></i> Connect <span>with</span> Facebook</a>
        <em>คุณสามารถใช้ Facebook ของคุณ ในการเข้าสู่บริการของ Doonee.TV</em> </div>
    </div>
  </div>
</div>
<!--/login popup-->

<!--Age popup-->  
<div id="popup-age" class="overlay thm-age">
<a class="close"></a>
  <p class="Head"><i class="icm-group"></i> แจ้งเตือน</p>
  <div>
    <h1><i class="icon-warning-sign"></i> แจ้งเตือน</h1>
    <p>ภาพและเนื้อหาต่อไปนี้ ไม่เหมาะสมแก่เด็ก และเยาวชนอายุต่ำกว่า 18 ปี</p>
    <h2>กรุณายืนยันอายุของคุณ</h2>
    <div class="btn-group _cd-col-xs-6">
       <span><a id="confirm_rate" class="ui-btn-gray" title="over 18+" href="javascript:;">ข้าพเจ้า 18+ แล้ว</a></span>
       <span><a class="ui-btn-gray close" title="under 18+" href="javascript:close18();">ยังไม่ถึง 18 ปี</a></span>
    </div>
  </div>
</div>
<!--/Age popup-->
<div id="fb-root"></div>
