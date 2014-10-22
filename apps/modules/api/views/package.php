<h3>เลือกวิธีการชำระเงิน</h3>
    <ul class="ic-pay _cd-col-xs-6-sm-4-md-2">
        <li><a href="<?=base_url('/api/payment/creditcard/'.$package['package_id'])?>" data-channel="creditcard" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-creditcard" title="บัตรเครดิต" ><i class="icon-credit-card"></i> บัตรเครดิต</a></li>
        <li><a href="<?=base_url('/api/payment/paypoint/'.$package['package_id'])?>" data-channel="paypoint" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-paypoint" title="จุดรับชำระค่าบริการ"><i class="icon-usd"></i> จุดรับชำระค่าบริการ</a></li>
        <li><a href="<?=base_url('/api/payment/atm/'.$package['package_id'])?>" data-channel="atm" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="เอทีเอ็ม"><i class="icon-money"></i> เอทีเอ็ม</a></li> 
        <li><a href="<?=base_url('/api/payment/bankcounter/'.$package['package_id'])?>" data-channel="bankcounter" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="เคาน์เตอร์ธนาคาร"><i class="icon-laptop"></i> ธนาคาร</a></li>
        <li><a href="<?=base_url('/api/payment/ibanking/'.$package['package_id'])?>" data-channel="ibanking" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-bank" title="ไอแบงก์กิ้ง"><i class="icon-btc"></i> ไอแบงก์กิ้ง</a></li>
        <li><a href="<?=base_url('/api/payment/prepaidcard/'.$package['package_id'])?>" data-channel="prepaidcard" data-package="<?=$package['package_id']?>" class="payment-popup" rel="#popup-payment-prepaidcard" title="บัตรเติมเงิน"><i class="icon-btc"></i> บัตรเติมเงิน</a></li>
    </ul>
</div>