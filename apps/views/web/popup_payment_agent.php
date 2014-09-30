<!--login popup-->
<!-- credit card -->
<style>#popup-payment-creditcard .z-regis:after { content: "";background:none;border:none;}</style>
<div id="popup-payment-creditcard" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระผ่านบัตรเครดิต</p>
  <div class="_cd-col-xs-12-sm-6">
    <div class="z-login form-control">
      <form action="<?=base_url('/payment/creditcard/0/')?>" method="post"  id="2c2p-payment-form">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
            <li>
            <label>หมายเลขบัตรเครดิต</label>
            <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx" class="_sf-col-xs-12" id="cardnumber" data-encrypt="cardnumber" value="4111111111111111" maxlength="16"></li>
            <li><label class="span12">วันหมดอายุ Ex.01/2014</label></li>
            <li>
              <input type="text" placeholder="MM" value="12" class="_sf-col-xs-2" id="month" data-encrypt="month" maxlength="2"><span class="_sf-col-xs-1">/</span>
               <input type="text" placeholder="YYYY" value="2015" class="_sf-col-xs-4" id="year" data-encrypt="year" value="123" maxlength="4"></li>
            <li>
            <label>หมายเลข cvv (หลังบัตร)</label>
            <input type="password" placeholder="CVV2/CVC2" class="_sf-col-xs-12" id="cvv" data-encrypt="cvv" maxlength="4" autocomplete="off"></li>
            <input type="submit" value="submit" />
            <input type="hidden" name="encryptedCardInfo" value="" />
          </ul>
        </fieldset>
      </form>
    </div>
    <div class="z-regis" style="border-left:none;">
      <p class="hd"><i class="gly-user"></i>&nbsp; </p>
      <p class="btn-regis"> <img src="<?=static_url('/img/visa-master.png')?>" ></p>
      <p class="btn-regis"> <img src="<?=static_url('/img/cvv.gif')?>" style="width:130px;position:absolute;left:-120px;" ></p>
    </div>
  </div>
</div>

<!-- ATM, BANKCOUNTER, IBANKING -->
<div id="popup-payment-bank" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่านตู้เอทีเอ็ม</p>
  <div class="_cd-col-xs-12-sm-12">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
          <style type="text/css">a img{width:120px;padding: 5px;}</style>
            <li style="text-align:center;">
            <a href="<?=base_url('/payment/channel/0/SCB')?>"><img src="<?=static_url("/img/bank/SCB.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/TMB')?>"><img src="<?=static_url("/img/bank/TMB.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/TBANK')?>"><img src="<?=static_url("/img/bank/TBANK.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/BAY')?>"><img src="<?=static_url("/img/bank/BAY.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/BBL')?>"><img src="<?=static_url("/img/bank/BBL.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/UOB')?>"><img src="<?=static_url("/img/bank/UOB.jpg")?>" ></a>
            
            <a href="<?=base_url('/payment/channel/0/KTB')?>"><img src="<?=static_url("/img/bank/KTB.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/KBANK')?>"><img src="<?=static_url("/img/bank/KBANK.jpg")?>" ></a>
            </li>
          </ul>
        </fieldset>
    </div>
  </div>
</div>
<!-- WEBPAY -->
<div id="popup-payment-webpay" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่านตู้เอทีเอ็ม</p>
  <div class="_cd-col-xs-12-sm-6">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
            <li><a href="<?=base_url('/payment/channel/0/SCB')?>"><img src="<?=static_url("/img/bank/SCB.jpg")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/KTB')?>"><img src="<?=static_url("/img/bank/KTB.jpg")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/UOB')?>"><img src="<?=static_url("/img/bank/UOB.jpg")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TMB')?>"><img src="<?=static_url("/img/bank/TMB.jpg")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BBL')?>"><img src="<?=static_url("/img/bank/BBL.jpg")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BAY')?>"><img src="<?=static_url("/img/bank/BAY.jpg")?>" ></a></li>
          </ul>
        </fieldset>
    </div>
  </div>
</div>
<!-- OVERTHECOUNTER -->
<div id="popup-payment-paypoint" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่าน</p>
  <div class="_cd-col-xs-12-sm-12">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกจุดชำระเงิน</legend>
          <ul class="section-regis">
            <li style="text-align:center;">
            <a href="<?=base_url('/payment/channel/0/MPAY')?>"><img src="<?=static_url("/img/bank/MPAY.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/7ELEVEN')?>"><img src="<?=static_url("/img/bank/7ELEVEN.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/TRUEMONEY')?>"><img src="<?=static_url("/img/bank/TRUEMONEY.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/TOT')?>"><img src="<?=static_url("/img/bank/TOT.jpg")?>" ></a>
            <a href="<?=base_url('/payment/channel/0/TESCO')?>"><img src="<?=static_url("/img/bank/TESCO.jpg")?>" ></a>
            
            <a href="<?=base_url('/payment/channel/0/PAYATPOST')?>"><img src="<?=static_url("/img/bank/PAYATPOST.jpg")?>" ></a>
            
            <a href="<?=base_url('/payment/channel/0/BIGC')?>"><img src="<?=static_url("/img/bank/BIGC.jpg")?>" ></a></li>
          </ul>
        </fieldset>
    </div>
  </div>
</div>
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
          <input type="submit" value="ยืนยันการเติมเงิน" />
        </fieldset>
        </form>
    </div>
  </div>
</div>
<!--/payment popup-->
