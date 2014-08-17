<?php 
	include('header.php');	
?>
  <body>
	<?php include('menu.php'); ?>
  <?php //include('home_slide.php'); ?>
  <!-- container -->
  <section id="contents">
    <div class="container bx-register">
      <h2><a href="javascript:;" title="สมัครสมาชิก">สมัครสมาชิก <i class="icon-double-angle-right"></i></a></h2>
      <div class="inner">
          <div class="left form-contact-register _sf-col-xs-12-md-push-2-md-8">
              <form id="contact-doonee" name="contact-doonee" method="post" action="<?=base_url('/member/register_submit')?>">
                  <fieldset class="_sf-col-sm-push-1-sm-10 pd0">
                    <legend class="hid">สมัครสมาชิกใหม่</legend>
                    <p>
                      <label for="email" class="hid">อีเมล์</label>
                      <input type="email" class="txt-box email _sf-col-xs-12 required" id="email" name="email" value="<?=isset($member['email'])?$member['email']:''?>" placeholder="อีเมล์">
                      <?php if(isset($error_message['email'])){?><span class="error"><?=$error_message['email']?></span><?php }?>
                    </p>
                    <p>
                      <label for="firstname" class="hid">ชื่อ</label>
                      <input type="text" class="txt-box _sf-col-xs-12" id="firstname" name="firstname" value="<?=isset($member['firstname'])?$member['firstname']:''?>" placeholder="ชื่อ">
                      <?php if(isset($error_message['firstname'])){?><span class="error"><?=$error_message['firstname']?></span><?php }?>
                    </p>
                    <p>
                      <label for="lastname" class="hid">นามสกุล</label>
                      <input type="text" class="txt-box _sf-col-xs-12" id="lastname" name="lastname" value="<?=isset($member['lastname'])?$member['lastname']:''?>" placeholder="นามสกุล">
                      <?php if(isset($error_message['lastname'])){?><span class="error"><?=$error_message['lastname']?></span><?php }?>
                    </p>
                    <!--<p>
                      <label for="id-card" class="hid">เลขที่บัตรประชาชน 13 หลัก</label>
                      <input type="text" maxlength="13" class="txt-box _sf-col-xs-12" id="id-card" name="id-card" placeholder="เลขที่บัตรประชาชน 13 หลัก">
                    </p>-->
                    <p>
                      <label for="gender" >เพศ : </label>
                      <input type="radio" id="gender1" name="gender" value="MAIL" class="ml2" <?=(isset($member['gender'])&&$member['gender']=='MAIL')?'checked="checked"':''?>> <label for="gender1">ชาย</label>
                      <input type="radio" id="gender2" name="gender" value="FEMAIL" class="ml2" <?=(isset($member['gender'])&&$member['gender']=='FEMAIL')?'checked="checked"':''?>> <label for="gender2">หญิง</label>
                      <?php if(isset($error_message['gender'])){?><br/><span class="error"><?=$error_message['gender']?></span><?php }?>
                    </p>
                    <p>
                      <label for="tel" class="hid">เบอร์โทรศัพท์</label>
                      <input type="text" maxlength="10" class="txt-box _sf-col-xs-12" id="tel" name="phone" value="<?=isset($member['phone'])?$member['phone']:''?>" placeholder="เบอร์โทรศัพท์">
                      <?php if(isset($error_message['phone'])){?><span class="error"><?=$error_message['phone']?></span><?php }?>
                    </p>
                    
                    <p>
                      <label for="password" class="hid">รหัสผ่าน</label>
                      <input type="password" class="txt-box _sf-col-xs-12" id="password" name="password" placeholder="รหัสผ่าน">
                      <?php if(isset($error_message['password'])){?><span class="error"><?=$error_message['password']?></span><?php }?>
                    </p>
                    <p>
                      <label for="rpassword" class="hid">ยืนยันรหัสผ่าน</label>
                      <input type="password" class="txt-box _sf-col-xs-12" id="rpassword" name="rpassword" placeholder="ยืนยันรหัสผ่าน">
                    </p>

                    <p class="ctrl-btn-sub mt2">
                      <button type="submit" class="ui-btn btn-profile" name="send" id="send" value="สมัครสมาชิก">สมัครสมาชิก</button> <span class="mh1">หรือ</span> <a title="เข้าสู่ระบบผ่าน Facebook " href="javascript:getloginFB();" id="fb-signin" class="fb-signin"><i class="icon-facebook"></i> Connect <span>with</span> Facebook</a>
                    </p>
                  </fieldset>
                </form>
          </div>
          
          <?php /*?><div class="right policy">
              <h3>ข้อกำหนด และเงื่อนไข</h3>
              <div class="box-msg">
                  <ol>
                      <li>1.  อ่านเงื่อนไขการให้บริการ อย่างละเอียดเพื่อผลประโยชน์ต่อตัวสมาชิกเอง</li>
                      <li>2.  ห้าม มิให้สมาชิกเขียนข้อความไปในทางดูถูก ดูหมิ่น ลบหลู่หรือจาบจ้วงต่อ 3 สถาบันหลักของปวงชนชาวไทยคือ ชาติ ศาสนาและพระมหากษัตริย์ เป็นอันขาด</li>
                      <li>3.  ข้อ ความและรูปภาพที่ปรากฎใน Website เกิดจากการเขียนและอัปโหลดเองของสมาชิกเอง โดยไม่ได้มีการตรวจสอบจากผู้ดูแลเว็ปไซต์ ดังนั้นสมาชิกจึงสัญญาว่า จะไม่เขียนข้อความ และอัปโหลดรูปที่ไม่เหมาะสมไปในทางพาดพิงค์ ให้เกิดความเสื่อมเสีย และล่วงละเมิดต่อสิทธิส่วนบุคคล ต่อบุคคลหนึ่งบุคคลใด โดยไม่ได้รับความยินยอมจากบุคคลนั้น หากผิดจากนี้ผู้ที่ถูกล่วงละเมิด สามารถร้องขอไปยังผู้เขียนบทความหรือผู้อัปโหลดรูปนั้น โดยจะต้องให้ความร่วมมือในการแก้ไขหรือลบ ข้อมูลนั้นๆ</li>
                      <li>4.  Website มีสิทธิที่จะลบข้อมูลหรือข้อความต่างๆที่พิจารณาแล้วเห็นว่ามีความไม่เหมาะ สม โดยอาจมีการบอกกล่าวตักเตือนไปก่อนหรือไม่ก็ได้แล้วแต่วิจารณญาณของผู้ดูแล เว็ปไซต์</li>
                      <li>5.  Website ไม่ขอรับผิดชอบหากเกิดมีการฟ้องร้องเอาผิดต่อสมาชิก อันเกิดจากการกระทำใดๆภายในเว็ป Website ไม่ว่าในกรณีใดๆทั้งสิ้น</li>
                      <li>6.  ลิขสิทธิ์ ในบทความต่างๆใน Website เป็นของผู้เขียนและ Website ร่วมกัน โดย Website สามารถนำไปใช้ได้ในกิจการของเว็ปตามแต่จะเห็นสมควร โดยไม่จำเป็นต้องแจ้งให้ทราบก็ได้แล้วแต่กรณี</li>
                      <li>7.  สมาชิก สัญญาว่าจะไม่กระทำการใดๆโดยตั้งใจ อันทำให้เกิดการแตกความสามัคคี/ก่อกวน/ทำความเดือดร้อน ภายใน Website หากมีการกระทำผิด Website มีสิทธิพิจารณาลบ หรือแบนสมาชิกคนนั้นได้ตามเห็นสมควร</li>
                      <li>8.  Website สัญญาว่าจะดูแลข้อมูลต่างๆที่มี ให้มีความปลอดภัยและสามารถใช้งานได้โดยสะดวก อย่างดีที่สุด ไม่นับกรณีที่เป็นเหตุสุดวิสัยจริงๆเช่น ความเสียหายที่เกิดจาก Hardware, Virus, Hacker เป็นต้น</li>
                      <li>9.  สมาชิก สัญญาว่าจะไม่ใช้งาน Website ไปในทางที่เรียกว่ามิจฉาชีพ หลอกลวง ล่อลวง หรือการอื่นๆอันเป็นความผิดตามที่กฎหมายได้บัญญัติไว้</li>
                      <li>10. สมาชิกจะไม่ดำเนินการฟ้องร้อง Website ไม่ว่าในกรณีใดๆทั้งสิ้นที่เกิดจากการใช้งานในเว็ป Website</li>
                      <li>11. Website มีสิทธิ ยกเลิก ปรับปรุง เปลี่ยนแปลงหรือเพิ่มเติม การทำงานต่างๆในเว็ปไซต์ได้โดยเสรี โดยไม่ต้องมีการแจ้งล่วงหน้า</li>
                      <li>12. สมาชิกได้อ่านและตกลงตามเงื่อนไขดังกล่าวมานี้แล้วจึงใช้งาน</li>
                  </ol>
              </div>
              <p class="agree">
                <input type="checkbox" value="1" name="agree" id="agree"> <label class="wa" for="agree">ยอมรับข้อกำหนดและเงื่อนไข</label>
              </p>
          </div><?php */?>
          
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