<script src="<?=static_url('/js/jquery-1.10.1.min.js')?>"></script>
<script type="text/javascript">
//<![CDATA[
document.write('<link href="<?=static_url("/fonts/fontface.css")?>" rel="stylesheet">');
document.write('<link href="<?=static_url("/css/font-awesome.min.css")?>" rel="stylesheet">');
//]]>
</script>
<style>
*{ margin:0; padding:0; list-style-type:none}
html{font-family:sans-serif;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;-ms-text-size-adjust:100%}
body{padding:0;margin:0;font-family:"supermarket",tahoma;font-size:13px;background:#fff;color:#313234}
*, *:before, *:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
/* lightbox login*/
#exposeMask+img,img[src*="non"]{display:none!important}
.overlay{ position:relative; clear:both;width:100%;max-width:100%;margin:0 auto;padding-bottom:5px;z-index:9998;background:#31353E}
.overlay:after{ content:""; display:block; clear:both}
.overlay>.close{display:block;width:25px;height:25px;position:absolute;top:5px;right:5px;content:"X";color:#fff;text-align:center;z-index:99;text-decoration:none;cursor:pointer;border-radius:2em;-webkit-border-radius:2em;behavior:url(/pie/PIE.htc)}
.overlay>.close:before{content:"X";display:block;font:700 14px/25px tahoma;color:#fff}
.overlay>.close:hover{background:#c00}
.overlay>p{position:relative;height:35px;font:20px/38px "SuperMarket";color:#fff;background:#31353E;text-align:center;margin:0}
.overlay>div{position:relative;background:#fff;margin:0 5px;padding:10px 0}
.overlay>div img{ max-width:100%; height:auto}
.overlay>div>div{position:relative}
.overlay>div>div .hd{ display:block; width:100%;position:relative;font:700 22px/30px "SuperMarket";color:#333;margin:0 0 10px;border-bottom:1px solid #E5E5E5}
[class*="thm-login"]>div>.z-login{ padding:0 10px}
[class*="thm-login"]>div>.z-login form,[class*="thm-login"]>div>.z-login fieldset{ margin:0; padding:0; border:none}
[class*="thm-login"]>div>.z-login ul>li:after,[class*="section-1900"]>ul:after{content:"";display:block;clear:both}
[class*="thm-login"]>div>.z-login ul>li{margin-bottom:10px}
[class*="thm-login"]>div>.z-login ul>li.keeplogin,[class*="thm-login"]>div>.z-login ul>li.ctrl-submit{margin-bottom:0}
[class*="thm-login"]>div>.z-login label{padding:0;color:#666;font-size:15px}
[class*="thm-login"]>div>.z-login ul>li input{padding:6px 10px;border:1px solid #ccc;border-radius:.3em;-webkit-border-radius:.3em;behavior:url(/pie/PIE.htc);}
[class*="thm-login"]>div>.z-login ul>li input:focus{border-color:#66afe9;outline:none;box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
[class*="thm-login"]>div>.z-login ul>li.keeplogin label{margin:0;line-height:22px}
[class*="thm-login"]>div>.z-login ul>li.ctrl-submit{position:absolute;right:10px;bottom:8px;z-index:99}
[class*="thm-login"]>div>.z-login ul>li.ctrl-submit>*{cursor:pointer}
[class*="thm-login"]>div>.z-regis{border-left:1px dotted #666}
[class*="thm-login"]>div>.z-regis .btn-regis{display:block;padding:0;white-space:normal;margin:0 0 15px}
[class*="thm-login"]>div>.z-regis .btn-regis img{ position:relative!important; margin:0 auto!important; left:auto!important; display:block}
[class*="thm-login"]>div>.z-regis .btn-regis>a{display:block;padding:10px 25px;text-align:center;font:20px/28px "SuperMarket";color:#fff;text-shadow:0 1px 0 rgba(0,0,0,.5);background:#ee1c25;box-shadow:0 -5px 0 rgba(0, 0, 0, 0.2) inset;border-radius:.2em;-webkit-border-radius:.2em;behavior:url(/pie/PIE.htc)}
[class*="thm-login"]>div>.z-regis .c-fb{font:700 13px/18px tahoma}
[class*="thm-login"]>div>.z-regis .c-fb>.title{padding:0 10px}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin,a.fb-signin{display:inlin-block;max-width:195px;background:#3C62A1;height:34px;margin:0 auto;padding:3px 8px 2px;line-height:25px;font-size:13px;color:#fff;border:1px solid #284470;text-shadow:0 1px 0 rgba(0,0,0,0.5);border-radius:.3em;-webkit-border-radius:.3em;behavior:url(/pie/PIE.htc);box-shadow:0 20px 20px -20px rgba(255,255,255,0.5) inset, 0 1px 0 rgba(255,255,255,0.5) inset;white-space:nowrap}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin{display:block;margin:10px auto}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin>span,a.fb-signin>span{display:inline-block;vertical-align:middle;font-weight:lighter}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin>span{vertical-align:top}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin>i,a.fb-signin>i{font-size:18px;line-height:25px;padding:0 8px 0 3px;margin-right:5px;color:#fff!important;border-right:1px solid #4B689F;box-shadow:1px 0 0 rgba(255,255,255,0.3);vertical-align:middle}
[class*="thm-login"]>div>.z-regis .c-fb>a.fb-signin:hover,a.fb-signin:hover,[class*="thm-login"]>div>.z-regis .btn-regis>a:hover{opacity:.85;text-decoration:none}
[class*="thm-login"]>div>.z-regis .c-fb em{display:block;color:#444}
[class*="thm-age"]>div{text-align:center}
[class*="thm-age"]>div>h1{font-size:50px;color:#d3222a}
[class*="thm-age"]>div>p{font-size:16px;color:#636363}
[class*="thm-age"]>div>h2{font-size:22px;color:#d3222a}
[class*="thm-age"]>div>.btn-group{margin:20px 0}
[class*="thm-age"]>div>.btn-group>*{display:block}
[class*="thm-age"]>div>.btn-group>*>a{display:block;padding:20px;font-size:27px;color:#333;text-shadow:0 1px 0 #fff;border-radius:.1em;-webkit-border-radius:.1em;box-shadow:0 -3px 0 rgba(0,0,0,0.3) inset}
[class*="thm-age"]>div>.btn-group>*>a:hover{color:#fff;text-shadow:0 1px 0 rgba(0,0,0,0.5);background:#d3222a;opacity:1;filter:none}
#popup-payment-prepaidcard.overlay{background:url(<?=static_url('/img/bg-card-popup.png')?>) 50% 0 no-repeat #5dc8d3!important;background-size:100%}
#popup-payment-prepaidcard.overlay>p{background:none;height:79px;padding-top:20px;font-size:25px}
#popup-payment-prepaidcard.overlay>p>i{text-indent:-9999;visibility:hidden}
#popup-payment-prepaidcard.overlay>div{background:none;border:none;margin:0}
#popup-payment-prepaidcard.overlay>div form .hd{visibility:hidden;height:40px}
#popup-payment-prepaidcard.overlay>div form .hd+h3{font-size:20px}
#popup-payment-prepaidcard.overlay>div form p[style*="width"]{text-align:center;width:auto!important}
#popup-payment-prepaidcard.overlay>div form p[style*="width"]>*{display:inline-block;float:none}
#popup-payment-prepaidcard.overlay>div form p[style*="width"]>span{padding:0;width:15px}
#popup-payment-prepaidcard.overlay>div form p[style*="width"]>input{padding:5px; width:20%}
#popup-payment-prepaidcard.overlay>div form .ui-btn-balck{margin-top:10px}
[class*="ui-btn"]{display:inline-block;padding:3px 16px;text-align:center;font:700 16px/30px "supermarket",tahoma;color:#212121;background:#b7b8bc;text-shadow:0 1px 0 #fff;border:none;cursor:pointer;text-transform:uppercase}
form [type="submit"]{display:inline-block;padding:3px 20px;background:#31353e;color:#fff;text-shadow:0 1px 0 rgba(0,0,0,.5);border:none;font-size:16px; cursor:pointer}
</style>
<!-- ATM, BANKCOUNTER, IBANKING -->
<div id="popup-payment-bank" class="overlay thm-login"><a class="close"></a>
  <p class="Head"><i class="icm-group"></i> ชำระเงินผ่านตู้เอทีเอ็ม</p>
  <div class="_cd-col-xs-12-sm-12">
  <form action="<?=base_url('/api/payment/ibanking')?>" method="post" id="formPayment">
    <div class="z-login form-control">
        <fieldset>
          <legend class="hd"><i class="gly-log-in"></i> เลือกธนาคาร</legend>
          <ul class="section-regis">
          <style type="text/css">a img{width:120px;padding: 5px;}</style>
            <li style="text-align:center;">
            <a href="javascript:submit('SCB');"><img src="<?=static_url("/img/bank/scb.png")?>" ></a>
            <a href="javascript:submit('TMB');"><img src="<?=static_url("/img/bank/tmb.png")?>" ></a>
            <a href="javascript:submit('TBANK');"><img src="<?=static_url("/img/bank/thanachart.png")?>" ></a>
            <a href="javascript:submit('BAY');"><img src="<?=static_url("/img/bank/krungsri.png")?>" ></a>
            <a href="javascript:submit('BBL');"><img src="<?=static_url("/img/bank/bangkok-bank.png")?>" ></a>
            <a href="javascript:submit('UOB');"><img src="<?=static_url("/img/bank/uob.png")?>" ></a>
            <a href="javascript:submit('KTB');"><img src="<?=static_url("/img/bank/KTB.png")?>" ></a>
            <a href="javascript:submit('KBANK');"><img src="<?=static_url("/img/bank/kbank.png")?>" ></a>
            </li>
          </ul>
          <input type="hidden" name="package_id" value="<?=$package['package_id']?>" />
          <input type="hidden" name="member_id" value="<?=$member['member_id']?>" />
          <input type="hidden" name="device" value="android" />
          <input type="hidden" name="channel" value="ibanking" />
          <input type="hidden" name="agent" value="" id="agent" />
          <input type="submit" value="submit" style="display:none;">
        </fieldset>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){

      });
      function submit(agent){
          $("#agent").val(agent);
          $("#formPayment").submit();
      }
    </script>
  </form>
  </div>
</div>