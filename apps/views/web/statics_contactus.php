<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">

          <div class="container bx-contact">
            <h2><a href="<?=base_url('/contactus')?>" title="ติดต่อเรา">ติดต่อเรา <i class="icon-double-angle-right"></i></a></h2>
            <div class="title">
              <p>สมาชิกของ DooNee.TV สามารติดต่อสอบถามทีมงานเกี่ยวกับ ปัญหาต่างๆ ในการใช้บริการ DooNee.TV ได้ที่นี่
ทางทีมงานจะทำการติดต่อกลับเมื่อมีการแจ้งเข้ามาในระบบ หรือติดต่อเบอร์โทร 02-884-6172</p>
        <p class="txt-orange">* กรุณา แจ้งเบอร์โทรศัพท์ที่สามารถติดต่อกลับได้สะดวกค่ะ</p>
            </div>
            <div class="inner">
        <div class="left _sf-col-xs-12-md-7">
                  <div class="detail">
                        <i class="icon-envelope"></i>
                        <h2>บริษัท เอสทีจี มีเดียเพล็กซ์ จำกัด</h2>
                        <address>อาคารเอสทีจี เพลส: เลขที่ 143/449 ถ.บรมราชชนนี แขวอรุณอมรินทร์ เขตบางกอกน้อย กรุงเทพ 10700 โทร. 0-2884-6370 แฟกซ์ 0-2433-6998</address>
                        <p class="email">E-Mail : <a href="mailto:webmaster@doonee.tv">webmaster@doonee.tv</a></p>
                        <p class="call txt-red">Call Center 02-884-6172</p>
                    </div>
                    <div class="map">
                    <!--
                    http://maps.googleapis.com/maps/api/staticmap?center=13.7851853/100.4703092&zoom=13&size=606x187&markers=color:red|13.7851853,100.4703092&sensor=true&language=th
                    https://www.google.com/maps/@13.7851853,100.4703092,17z?hl=th
                     -->
                        <img src="<?=static_url('/img/staticmap.png')?>" alt="บริษัท เอสทีจี มีเดียเพล็กซ์ จำกัด">
                        <div>
                            <h2><i class="icon-map-marker"></i> MY location</h2>
                            <p>Bangkok, thailand</p>
                            <a title="lightbox map" class="ui-btn" target="_blank" href="https://www.google.com/maps/@13.7851853,100.4703092,17z?hl=th">View map</a>
                        </div>
                    </div>
                </div>
                <?php if(isset($success)){?>
                <script type="text/javascript">
                  alert("ทำการบันทึกข้อมูลเรียบร้อยแล้วค่ะ");
                </script>
                <?php }?>
                <div class="right form-contact _sf-col-xs-12-md-5">
                    <form id="contact-doonee" name="contact-doonee" method="post" action="<?=base_url('/contactus/submit')?>">
                        <fieldset class="_sf-col-sm-push-1-sm-10 pd0">
                          <legend class="hid">ติดต่อเจ้าหน้าที่</legend>
                          <p <?=(isset($error)&&isset($error['topic']))?' class="has-error" ':''?>>
                            <label for="topic" class="hid">กรุณาเลือกหัวข้อที่ต้องการติดต่อ</label>
                            <select class="select-box required" name="topic" id="topic">
                              <option value="">กรุณาเลือกหัวข้อที่ต้องการติดต่อ</option>
                                <option value="สอบถามเกี่ยวกับโทรศัพท์มือถือ DooneeTV">สอบถามเกี่ยวกับโทรศัพท์มือถือ DooneeTV</option>
                                <option value="สอบถามเกี่ยวกับบริการของ DooneeTV">สอบถามเกี่ยวกับบริการของ DooneeTV</option>
                                <option value="สอบถามเกี่ยวกับการใช้งานเว็บไซต์ DooneeTV">สอบถามเกี่ยวกับการใช้งานเว็บไซต์ DooneeTV</option>
                                <option value="ติดต่อเป็นตัวแทนจำหน่าย โทรศัพท์มือถือ DooneeTV">ติดต่อเป็นตัวแทนจำหน่าย โทรศัพท์มือถือ DooneeTV</option>
                                <option value="ร้องเรียนเจ้าหน้าที่หรือร้านค้า DooneeTV">ร้องเรียนเจ้าหน้าที่หรือร้านค้า DooneeTV</option>
                            </select>
                          </p>
                          <p <?=(isset($error)&&isset($error['name']))?' class="has-error" ':''?>>
                            <label for="u-name" class="hid">ชื่อ-นามสกุล</label>
                            <input type="text" class="txt-box _sf-col-xs-12 required" id="u-name" name="name" placeholder="ชื่อ *" value="<?=(isset($data['name'])?$data['name']:(isset($memberLogin)&&$memberLogin?$memberLogin['firstname'].' '.$memberLogin['lastname']:''))?>">
                          </p>
                          <p <?=(isset($error)&&isset($error['email']))?' class="has-error" ':''?>>
                            <label for="email" class="hid">อีเมล์</label>
                            <input type="text" class="txt-box email _sf-col-xs-12 required" id="email" name="email" placeholder="อีเมล์ *" value="<?=(isset($data['email'])?$data['email']:(isset($memberLogin)&&$memberLogin?$memberLogin['email']:''))?>">
                          </p>
                          <p <?=(isset($error)&&isset($error['telephone']))?' class="has-error" ':''?>>
                            <label for="tel" class="hid">เบอร์โทรศัพท์</label>
                            <input type="text" class="txt-box _sf-col-xs-12" id="tel" name="telephone" placeholder="เบอร์โทรศัพท์ *" value="<?=(isset($data['telephone'])?$data['telephone']:'')?>">
                          </p>
                          <p <?=(isset($error)&&isset($error['feedback']))?' class="has-error" ':''?>>
                            <label for="feedback" class="hid">รายละเอียด</label>
                            <textarea class="txt-area _sf-col-xs-12" rows="6" id="feedback" name="feedback" placeholder="รายละเอียด"><?=(isset($data['feedback'])?$data['feedback']:'')?></textarea>
                          </p>
                          <p class="ctrl-btn-sub _cd-col-xs-push-3-xs-6">
                            <button type="submit" class="ui-btn btn-profile" id="send" value="ส่งข้อมูล">ส่งข้อมูล</button>
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