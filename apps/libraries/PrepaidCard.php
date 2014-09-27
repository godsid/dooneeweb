<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PrepaidCard {
	var $CI;
	var $secret_key = "+b)4_=67!3;k53A";//ห้ามแก้ไข ถ้าเปลี่ยนบัตนที่ถูกสร้างไว้แล้วจะใช้ไม่ได้
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('backoffice/prepaid_model','mPrepaid');
	}
	public function generate($startDate,$expireDate,$package,$price,$count=1,$create_by='',$export=false){
		if($export){
			echo  "serial_number,code,price,package,start_date,expire_date\r\n";
		}
		for($i=0;$i<$count;$i++){
			$serial_number = random_string('numeric',16);
			$password = random_string('numeric',12);
			$checksum = $this->checksum($password);
			$code = $password.substr($checksum, -4);
			$hash_code = do_hash($password.$this->secret_key.$checksum);

			if($this->CI->mPrepaid->setPrepaid(array(
				'serial_number'=>$serial_number,
				'code'=>$code,
				'hash_code'=>$hash_code,
				'price'=>$price,
				'package_id'=>$package['package_id'],
				'start_date'=>$startDate,
				'expire_date'=>$expireDate,
				'create_by'=>$create_by
				))){
				if($export){
					echo $serial_number,",",$code,",",$price,",",$package['title'],",",$startDate,",",$expireDate,"\r\n";
				}
			}
		}
		return true;
	}
	
	public function validateChecksum($code){
		if(!preg_match("#^[0-9]{16}$#",$code)){
			
			return false;
		}
		$realCode = substr($code, 0, 12);
		$checksum = substr($code,-4);
		$checksumCode = substr($this->checksum($realCode),-4);
		return ($checksum == $checksumCode);
	}
	private function checksum($password){
		return sprintf("%u", crc32($password));
	}
}
?>



