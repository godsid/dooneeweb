<!-- PREPAIDCARD -->
<div id="popup-payment-prepaidcard" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่าน บัตรเติมเงิน</p>
  <div class="_cd-col-xs-12-sm-12">
    <div class="z-login form-control">
      <form action="<?=base_url('/payment/card/0/')?>" method="post"  id="prepaidcard-payment-form">
        <fieldset style="text-align:center;">
          <legend class="hd"><i class="gly-log-in"></i> กรอกเลขบัตร</legend>
          <h3>ใส่รหัสบัตรเติมเงินของคุณ 16 หลัก</h3>
          <br />
          <p style="width:480px;margin:auto;">
            <input type="text" placeholder="xxxx" name="code[1]" tabindex="1" maxlength="4" class="_sf-col-xs-2"><span class="_sf-col"></span>
            <input type="text" placeholder="xxxx" name="code[2]" tabindex="2" maxlength="4" class="_sf-col-xs-2"><span class="_sf-col"></span>
            <input type="text" placeholder="xxxx" name="code[3]" tabindex="3" maxlength="4" class="_sf-col-xs-2"><span class="_sf-col"></span>
            <input type="text" placeholder="xxxx" name="code[4]" tabindex="4" maxlength="4" class="_sf-col-xs-2">
          </p>
          <br />
          <p>จำนวนวันดูหนังของรหัสบัตรเติมเงินจะนับตั้งแต่<br/>เมื่อคุณเริมใช้บริการดูหนังครั้งแรก</p>
          <input type="submit" value="ยืนยันการเติมเงิน" id="bt-prepaid" />
        </fieldset>
        </form>
    </div>
  </div>
</div>