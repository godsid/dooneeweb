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
            <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx" class="_sf-col-xs-12" id="cardnumber" data-encrypt="cardnumber" value="" maxlength="16"></li>
            <li><label class="span12">วันหมดอายุ Ex.01/2014</label></li>
            <li>
              <input type="text" placeholder="MM" value="" class="_sf-col-xs-2" id="month" data-encrypt="month" maxlength="2"><span class="_sf-col-xs-1">/</span>
               <input type="text" placeholder="YYYY" value="" class="_sf-col-xs-4" id="year" data-encrypt="year" value="123" maxlength="4"></li>
            <li><label>ชื่อ-นามสกุล บนบัตร</label>
            <input type="text" placeholder="ชื่อ นามสกุล" class="_sf-col-xs-12" id="customerName" data-encrypt="customerName" maxlength="50" autocomplete="off"></li>
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

<a href="<?=base_url('/api/payment/success')?>">SUCCESS</a> <a href="<?=base_url('/api/payment/error')?>">ERROR</a>