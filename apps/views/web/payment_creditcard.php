<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
  <?php //include('home_slide.php'); ?>
  <!-- container -->
  <section id="contents">
    <div class="container bx-register">
      <h2><a href="javascript:;" title="เติมเงิน">เติมเงิน / ซื้อแพ็คเกจ <i class="icon-double-angle-right"></i></a></h2>
      <div class="inner">
          <div class="left form-contact-register _sf-col-xs-12-md-push-2-md-8">
              <form id="contact-doonee" name="contact-doonee" method="post" action="<?=base_url('/payment/creditcard_submit')?>">
                  <fieldset class="_sf-col-sm-push-1-sm-10 pd0">
                    <legend class="hid">ชำระเงิน ผ่านบัตรเครดิต</legend>
                    <p>
                      <label for="email" class="hid">Credit Card Number</label>
                      <input type="email" class="txt-box email _sf-col-xs-12 required" id="email" name="email" value="<?=isset($member['email'])?$member['email']:''?>" placeholder="Credit Card Number">
                      <?php if(isset($error_message['email'])){?><span class="txt-red"><?=$error_message['email']?></span><?php }?>
                    </p>
                    <p>
                      <input type="text" maxlength="13" class="txt-box _sf-col-xs-2" id="id-card" name="id-card" placeholder="MM">
                      <span class="txt-box _sf-col-xs-1">/</span>
                      <input type="text" maxlength="13" class="txt-box _sf-col-xs-3" id="id-card" name="id-card" placeholder="YYYY">
                      
                    </p>

                    
                    <p>
                      <label for="id-card" class="hid">เลขที่บัตรประชาชน 13 หลัก</label>
                      <input type="text" maxlength="13" class="txt-box _sf-col-xs-3" id="id-card" name="id-card" placeholder="CVV2/CVC2">
                    </p>
                    <p>
                      <label for="id-card" class="hid">เลขที่บัตรประชาชน 13 หลัก</label>
                      <input type="text" maxlength="13" class="txt-box _sf-col-xs-12" id="id-card" name="id-card" placeholder="Full name">
                    </p>
                    
                    <p class="ctrl-btn-sub mt2">
                      <button type="submit" class="ui-btn btn-profile" name="send" id="send" value="สมัครสมาชิก">สมัครสมาชิก</button> <span class="mh1">หรือ</span> <a title="เข้าสู่ระบบผ่าน Facebook " href="javascript:;" class="fb-signin"><i class="icon-facebook"></i> Connect <span>with</span> Facebook</a>
                    </p>
                  </fieldset>
                </form>
          </div>
          
          <?php ?>
          
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