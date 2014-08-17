<?php 
	include('header.php');	
?>
  <body>
	<?php include('menu.php'); ?>
  <?php //include('home_slide.php'); ?>
  <!-- container -->
  <section id="contents">
    <div class="container bx-register">
      <h2><a href="javascript:;" title="เข้าสู่ระบบ">เข้าสู่ระบบ<i class="icon-double-angle-right"></i></a></h2>
      <div class="inner">
          <div class="left form-contact-register _sf-col-xs-12-md-push-2-md-8">
              <form id="contact-doonee" name="contact-doonee" method="post" action="<?=base_url('/member/auth')?>">
                  <fieldset class="_sf-col-sm-push-1-sm-10 pd0">
                    <legend class="hid">เข้าสู่ระบบ</legend>
                    <?php if(isset($_GET['formregister'])){ ?><p class="success"> สมัครสมาชิกเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ</p><?php }?>
                    <p>
                      <label for="email" class="hid">อีเมล์</label>
                      <input type="email" class="txt-box email _sf-col-xs-12 required" id="email" name="email" placeholder="อีเมล์">
                    </p>
                    <p>
                      <label for="password" class="hid">รหัสผ่าน</label>
                      <input type="password" class="txt-box _sf-col-xs-12" id="password" name="password" placeholder="รหัสผ่าน">
                    </p>
                    <p class="ctrl-btn-sub mt2">
                      <button type="submit" class="ui-btn btn-profile" name="send" id="send" value="เข้าสู่ระบบ">เข้าสู่ระบบ</button> <span class="mh1">หรือ</span> <a title="เข้าสู่ระบบผ่าน Facebook " href="javascript:getloginFB();" id="fb-signin" class="fb-signin"><i class="icon-facebook"></i> Connect <span>with</span> Facebook</a>
                    </p>
                  </fieldset>
                </form>
          </div>
      </div>
    </div>
</section>
  <!-- /container -->
  <!-- footer -->
    <?php include('footer.php');?>
  <!-- /footer -->

  <!-- javascript -->
	<?php include('javascript.php');?>
  <!-- /javascript -->
  </body>
</html>