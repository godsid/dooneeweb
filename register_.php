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
      <!-- container -->
      <section id="contents">

          <div class="container bx-register">
          	<h2><a href="#" title="สมัครสมาชิก">สมัครสมาชิก <i class="icon-double-angle-right"></i></a></h2>
            
            <div class="inner">
                <div class="left form-contact-register _sf-col-xs-12-md-push-2-md-8">
                    <form id="contact-doonee" name="contact-doonee" method="post" action="register.php">
                        <fieldset class="_sf-col-sm-push-1-sm-10 pd0">
                          <legend class="hid">สมัครสมาชิกใหม่</legend>
                          <p>
                            <label for="u-name" class="hid">ชื่อ</label>
                            <input type="text" class="txt-box _sf-col-xs-12" id="u-name" name="u-name" placeholder="ชื่อ">
                          </p>
                          <p>
                            <label for="l-name" class="hid">นามสกุล</label>
                            <input type="text" class="txt-box _sf-col-xs-12" id="l-name" name="l-name" placeholder="นามสกุล">
                          </p>
                          <!--<p>
                            <label for="id-card" class="hid">เลขที่บัตรประชาชน 13 หลัก</label>
                            <input type="text" maxlength="13" class="txt-box _sf-col-xs-12" id="id-card" name="id-card" placeholder="เลขที่บัตรประชาชน 13 หลัก">
                          </p>-->
                          <p>
                            <label for="sex">เพศ : </label>
                            <input type="radio" id="sex1" name="sex" class="ml2"> <label for="sex1">ชาย</label>
                            <input type="radio" id="sex2" name="sex" class="ml2"> <label for="sex2">หญิง</label>
                          </p>
                          <p>
                            <label for="tel" class="hid">เบอร์โทรศัพท์</label>
                            <input type="text" maxlength="10" class="txt-box _sf-col-xs-12" id="tel" name="tel" placeholder="เบอร์โทรศัพท์">
                          </p>
                          <p>
                            <label for="email" class="hid">อีเมล์</label>
                            <input type="email" class="txt-box email _sf-col-xs-12 required" id="email" name="email" placeholder="อีเมล์">
                          </p>
                          <p>
                            <label for="pass" class="hid">รหัสผ่าน</label>
                            <input type="password" class="txt-box _sf-col-xs-12" id="pass" name="pass" placeholder="รหัสผ่าน">
                          </p>
                          <p>
                            <label for="rpass" class="hid">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="txt-box _sf-col-xs-12" id="rpass" name="rpass" placeholder="ยืนยันรหัสผ่าน">
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
                            <li>1.	อ่านเงื่อนไขการให้บริการ อย่างละเอียดเพื่อผลประโยชน์ต่อตัวสมาชิกเอง</li>
                            <li>2.	ห้าม มิให้สมาชิกเขียนข้อความไปในทางดูถูก ดูหมิ่น ลบหลู่หรือจาบจ้วงต่อ 3 สถาบันหลักของปวงชนชาวไทยคือ ชาติ ศาสนาและพระมหากษัตริย์ เป็นอันขาด</li>
                            <li>3.	ข้อ ความและรูปภาพที่ปรากฎใน Website เกิดจากการเขียนและอัปโหลดเองของสมาชิกเอง โดยไม่ได้มีการตรวจสอบจากผู้ดูแลเว็ปไซต์ ดังนั้นสมาชิกจึงสัญญาว่า จะไม่เขียนข้อความ และอัปโหลดรูปที่ไม่เหมาะสมไปในทางพาดพิงค์ ให้เกิดความเสื่อมเสีย และล่วงละเมิดต่อสิทธิส่วนบุคคล ต่อบุคคลหนึ่งบุคคลใด โดยไม่ได้รับความยินยอมจากบุคคลนั้น หากผิดจากนี้ผู้ที่ถูกล่วงละเมิด สามารถร้องขอไปยังผู้เขียนบทความหรือผู้อัปโหลดรูปนั้น โดยจะต้องให้ความร่วมมือในการแก้ไขหรือลบ ข้อมูลนั้นๆ</li>
                            <li>4.	Website มีสิทธิที่จะลบข้อมูลหรือข้อความต่างๆที่พิจารณาแล้วเห็นว่ามีความไม่เหมาะ สม โดยอาจมีการบอกกล่าวตักเตือนไปก่อนหรือไม่ก็ได้แล้วแต่วิจารณญาณของผู้ดูแล เว็ปไซต์</li>
                            <li>5.	Website ไม่ขอรับผิดชอบหากเกิดมีการฟ้องร้องเอาผิดต่อสมาชิก อันเกิดจากการกระทำใดๆภายในเว็ป Website ไม่ว่าในกรณีใดๆทั้งสิ้น</li>
                            <li>6.	ลิขสิทธิ์ ในบทความต่างๆใน Website เป็นของผู้เขียนและ Website ร่วมกัน โดย Website สามารถนำไปใช้ได้ในกิจการของเว็ปตามแต่จะเห็นสมควร โดยไม่จำเป็นต้องแจ้งให้ทราบก็ได้แล้วแต่กรณี</li>
                            <li>7.	สมาชิก สัญญาว่าจะไม่กระทำการใดๆโดยตั้งใจ อันทำให้เกิดการแตกความสามัคคี/ก่อกวน/ทำความเดือดร้อน ภายใน Website หากมีการกระทำผิด Website มีสิทธิพิจารณาลบ หรือแบนสมาชิกคนนั้นได้ตามเห็นสมควร</li>
                            <li>8.	Website สัญญาว่าจะดูแลข้อมูลต่างๆที่มี ให้มีความปลอดภัยและสามารถใช้งานได้โดยสะดวก อย่างดีที่สุด ไม่นับกรณีที่เป็นเหตุสุดวิสัยจริงๆเช่น ความเสียหายที่เกิดจาก Hardware, Virus, Hacker เป็นต้น</li>
                            <li>9.	สมาชิก สัญญาว่าจะไม่ใช้งาน Website ไปในทางที่เรียกว่ามิจฉาชีพ หลอกลวง ล่อลวง หรือการอื่นๆอันเป็นความผิดตามที่กฎหมายได้บัญญัติไว้</li>
                            <li>10.	สมาชิกจะไม่ดำเนินการฟ้องร้อง Website ไม่ว่าในกรณีใดๆทั้งสิ้นที่เกิดจากการใช้งานในเว็ป Website</li>
                            <li>11.	Website มีสิทธิ ยกเลิก ปรับปรุง เปลี่ยนแปลงหรือเพิ่มเติม การทำงานต่างๆในเว็ปไซต์ได้โดยเสรี โดยไม่ต้องมีการแจ้งล่วงหน้า</li>
                            <li>12.	สมาชิกได้อ่านและตกลงตามเงื่อนไขดังกล่าวมานี้แล้วจึงใช้งาน</li>
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
    <?php @include('incs/footer.html'); ?>
    <!-- /footer -->
	<!-- javascript -->
	<?php @include('incs/js.html'); ?>
    <!-- /javascript -->
  </body>
</html>
