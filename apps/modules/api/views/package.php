<script type="text/javascript">
//<![CDATA[
document.write('<link href="http://doonee.tv/assets/fonts/fontface.css" rel="stylesheet">');
document.write('<link href="http://doonee.tv/assets/css/font-awesome.min.css" rel="stylesheet">');
//]]>
</script>
<style>
*{ margin:0; padding:0; list-style-type:none}
html{font-family:sans-serif;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;-ms-text-size-adjust:100%}
body{padding:0;margin:0;font-family:"supermarket",tahoma;font-size:13px;background:#fff;color:#313234}
*, *:before, *:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
.thm-api>h3{ font:21px/40px "supermarket"; color:#363533; padding:0 10px}
[class*="ic-pay"]{ padding:0 5px; margin:0; list-style-type:none}
[class*="ic-pay"]>li{ width:50%; float:left; padding:0 5px; margin-bottom:10px}
[class*="ic-pay"]>li>a{display:block;font:700 14px/32px tahoma;padding:7px 0;text-align:left;text-indent:5px;background:#31353d;color:#fff;text-decoration:none}
[class*="ic-pay"]>li:nth-child(2)>a{font-size:11px}
[class*="ic-pay"]>li:nth-child(4)>a{font-size:12px}
[class*="ic-pay"]>li:nth-child(1)>a:hover{color:#df4442}
[class*="ic-pay"]>li:nth-child(2)>a:hover{color:#acc32a}
[class*="ic-pay"]>li:nth-child(3)>a:hover{color:#2e81fd}
[class*="ic-pay"]>li:nth-child(4)>a:hover{color:#d42efd}
[class*="ic-pay"]>li:nth-child(5)>a:hover{color:#fda42e}
[class*="ic-pay"]>li:nth-child(6)>a:hover{color:#ef05b5}
[class*="ic-pay"]>li>a:hover{background:#121212}
[class*="ic-pay"]>li>a>i{display:inline-block;font-size:18px;vertical-align:middle;text-align:center}
[class*="ic-pay"]>li>a>img{max-height:32px;margin:0 auto;vertical-align:middle}
[class*="ui-btn"]{display:inline-block;padding:3px 16px;text-align:center;font:700 16px/30px "supermarket",tahoma;color:#212121;background:#b7b8bc;text-shadow:0 1px 0 #fff;border:none;cursor:pointer;text-transform:uppercase}
form [type="submit"]{display:inline-block;padding:3px 20px;background:#31353e;color:#fff;text-shadow:0 1px 0 rgba(0,0,0,.5);border:none;font-size:16px; cursor:pointer}
</style>
<div class="thm-api">
  	<h3><i class="icon-money"></i> เลือกวิธีการชำระเงิน</h3>
    <ul class="ic-pay _cd-col-xs-6-sm-4-md-2">
        <li><a href="<?=base_url('/api/payment/creditcard/'.$package['package_id'])?>" data-channel="creditcard" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-creditcard" title="บัตรเครดิต" ><i class="icon-credit-card"></i> บัตรเครดิต</a></li>
        <li><a href="<?=base_url('/api/payment/paypoint/'.$package['package_id'])?>" data-channel="paypoint" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-paypoint" title="จุดรับชำระค่าบริการ"><i class="icon-usd"></i> จุดรับชำระค่าบริการ</a></li>
        <li><a href="<?=base_url('/api/payment/atm/'.$package['package_id'])?>" data-channel="atm" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="เอทีเอ็ม"><i class="icon-money"></i> เอทีเอ็ม</a></li> 
        <li><a href="<?=base_url('/api/payment/bankcounter/'.$package['package_id'])?>" data-channel="bankcounter" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="เคาน์เตอร์ธนาคาร"><i class="icon-laptop"></i> ธนาคาร</a></li>
        <li><a href="<?=base_url('/api/payment/ibanking/'.$package['package_id'])?>" data-channel="ibanking" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="ไอแบงก์กิ้ง"><i class="icon-btc"></i> ไอแบงก์กิ้ง</a></li>
        <li><a href="<?=base_url('/api/payment/prepaidcard/'.$package['package_id'])?>" data-channel="prepaidcard" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-prepaidcard" title="บัตรเติมเงิน"><i class="icon-btc"></i> บัตรเติมเงิน</a></li>
    </ul>
</div>

