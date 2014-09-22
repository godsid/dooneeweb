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
  <div class="_cd-col-xs-12-sm-6">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
            <li><a href="<?=base_url('/payment/channel/0/SCB')?>"><img src="<?=static_url("/img/bank/SCB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/KTB')?>"><img src="<?=static_url("/img/bank/KTB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/KBANK')?>"><img src="<?=static_url("/img/bank/KBANK.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TMB')?>"><img src="<?=static_url("/img/bank/TMB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/UOB')?>"><img src="<?=static_url("/img/bank/UOB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BAY')?>"><img src="<?=static_url("/img/bank/BAY.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BBL')?>"><img src="<?=static_url("/img/bank/BBL.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TBANK')?>"><img src="<?=static_url("/img/bank/TBANK.png")?>" ></a></li>
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
            <li><a href="<?=base_url('/payment/channel/0/SCB')?>"><img src="<?=static_url("/img/bank/SCB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/KTB')?>"><img src="<?=static_url("/img/bank/KTB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/UOB')?>"><img src="<?=static_url("/img/bank/UOB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TMB')?>"><img src="<?=static_url("/img/bank/TMB.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BBL')?>"><img src="<?=static_url("/img/bank/BBL.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BAY')?>"><img src="<?=static_url("/img/bank/BAY.png")?>" ></a></li>
          </ul>
        </fieldset>
    </div>
  </div>
</div>
<!-- OVERTHECOUNTER -->
<div id="popup-payment-overthecounter" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่าน</p>
  <div class="_cd-col-xs-12-sm-6">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
            <li><a href="<?=base_url('/payment/channel/0/7ELEVEN')?>"><img src="<?=static_url("/img/bank/7ELEVEN.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TOT')?>"><img src="<?=static_url("/img/bank/TOT.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TESCO')?>"><img src="<?=static_url("/img/bank/TESCO.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/TRUEMONEY')?>"><img src="<?=static_url("/img/bank/TRUEMONEY.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/PAYATPOST')?>"><img src="<?=static_url("/img/bank/PAYATPOST.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/MPAY')?>"><img src="<?=static_url("/img/bank/MPAY.png")?>" ></a></li>
            <li><a href="<?=base_url('/payment/channel/0/BIGC')?>"><img src="<?=static_url("/img/bank/BIGC.png")?>" ></a></li>
          </ul>
        </fieldset>
    </div>
  </div>
</div>
<!--/login popup-->