<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">

          <div class="container bx-package">
            <h2><a href="<?=base_url('/package')?>" title="ซื้อแพ็คเกจ">ซื้อแพ็คเกจ <i class="icon-double-angle-right"></i></a></h2>
            <div id="accordion" class="inner accordion">
        <!-- Package -->
              <?php foreach($packages as $package){?>

                <div class="pk-1">
                  <h2><?=$package['title']?></h2>
                    <p class="pic"><img src="<?=static_url($package['banner'])?>" alt="<?=$package['title']?>"></p>
                    <div class="row bar">
                        <div class="pay _sf-col-sm-push-3-xs-12-sm-9">
                            <?php 
                              $clickLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" ';
                            ?>
                            <h3>เลือกวิธีการชำระเงิน</h3>
                            <ul class="ic-pay _cd-col-xs-6-sm-4-md-2">
                                <li><a href="<?=base_url('/payment/creditcard/'.$package['package_id'])?>" <?=$clickLogin?> title="บัตรเครดิต"><i class="icon-credit-card"></i> บัตรเครดิต</a></li>
                                <li><a href="<?=base_url('/payment/paypoint/'.$package['package_id'])?>" <?=$clickLogin?> title="จุดรับชำระค่าบริการ"><i class="icon-usd"></i> จุดรับชำระค่าบริการ</a></li>
                                <li><a href="<?=base_url('/payment/atm/'.$package['package_id'])?>" <?=$clickLogin?> title="เอทีเอ็ม"><i class="icon-money"></i> เอทีเอ็ม</a></li> 
                                <li><a href="<?=base_url('/payment/bankcounter/'.$package['package_id'])?>" <?=$clickLogin?> title="เคาน์เตอร์ธนาคาร"><i class="icon-laptop"></i> เคาน์เตอร์ธนาคาร</a></li>
                                <li><a href="<?=base_url('/payment/ibanking/'.$package['package_id'])?>" <?=$clickLogin?> title="ไอแบงก์กิ้ง"><i class="icon-btc"></i> ไอแบงก์กิ้ง</a></li>
                            </ul>
                        </div>
                        <!--
                        <div class="btn _sf-col-sm-pull-9-xs-12-sm-3">
                          <a class="ui-btn btn-regis lb-popup" href="javascript:;" rel="#popup-login" title="สมัครสมาชิก">สมัครสมาชิก <small>ดูหนังไม่จำกัด</small></a>
                        </div>
                        -->
                        <div class="btn _sf-col-sm-pull-9-xs-12-sm-3">
                          <a class="ui-btn btn-package" href="javascript:;" title="เงื่อนไขบริการ">เงื่อนไขบริการ</a>
                        </div>
                        
                    </div>
                    <div class="pane" style="display:none">
                      <?=nl2br($package['conditions'])?>
                    </div>
                    <footer><?=$package['detail']?></footer>
                </div>
                <?php }?>
                <!-- /Package -->
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