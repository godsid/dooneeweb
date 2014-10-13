<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">
          <div class="container bx-package">
            <h2><a href="<?=base_url('/member/package')?>" title="แพคเกจของคุณ">แพคเกจของคุณ <i class="icon-double-angle-right"></i></a></h2>
            <div id="accordion" class="inner accordion">
        <!-- Package -->
                <?php if(sizeof($package)){ ?>
                <div class="pk-1">
                  <h2><b class="txt-black">Package ของคุณ เหลืออีก <?=ceil((strtotime($memberLogin['expire_date'])-time())/86400)?> วัน : </b> <?=$package['title']?></h2>
                    <p class="pic"><img src="<?=static_url($package['banner'])?>" alt="<?=$package['title']?>"></p>
                    <div class="row bar">
                        <div class="pay _sf-col-sm-push-3-xs-12-sm-9">
                            <!--<h3>เลือกวิธีการชำระเงิน</h3>
                            <ul class="ic-pay _cd-col-xs-6-sm-4-md-2">
                                <li><a href="#" title="บัตรเครดิต"><i class="icon-credit-card"></i> บัตรเครดิต</a></li>
                                <li><a href="#" title="ATM"><i class="icon-money"></i> ATM</a></li>
                                <li><a href="#" title="จุดรับชำระค่าบริการ"><i class="icon-usd"></i> จุดรับชำระค่าบริการ</a></li>
                                <li><a href="#" title="เคาน์เตอร์ธนาคาร"><i class="icon-btc"></i> เคาน์เตอร์ธนาคาร</a></li>
                                <li><a href="#" title="True Money"><i class="icon-laptop"></i> True Money</a></li>
                                <li><a href="#" title="SMS"><i class="icon-tablet"></i> SMS</a></li>
                            </ul>-->
                        </div>
                        <div class="btn _sf-col-sm-pull-9-xs-12-sm-3">
                          <a class="ui-btn btn-package" href="javascript:;" title="เงื่อนไขบริการ">เงื่อนไขบริการ</a>
                        </div>
                    </div>
                    <div class="pane" style="display:none">
                      <?=nl2br($package['conditions'])?>
                    </div>
                    <footer><?=$package['detail']?></footer>
                </div>
                <?php }else{?>
                <div class="pk-1">
                  <h2><b class="txt-black">คุณยังไม่ได้สั่งซื้อ Package</b></h2>
                  <h2><a href="<?=base_url('/package')?>"><b class="txt-red">สั่งซื้อ Package</b></a></h2>
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