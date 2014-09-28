<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prepaid extends CI_Controller {

	var $breadcrumb;
	
	public function __construct(){
		parent::__construct();

		$this->load->model('user_model','mUser');
		if(!$this->mUser->auth()){
			redirect(backoffice_url('/user/login'));
		}
		
		$this->load->library('PrepaidCard');
		$this->load->helper('security');
		$this->load->model('prepaid_model','mPrepaid');
		$this->load->model('package_model','mPackage');


		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('page');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Members','url'=>backoffice_url('/member'));
	}
	public function index($serial_number=""){
		//$this->prepaidcard->generate(date('Y-m-d'),date('Y-m-d',strtotime('+100 day')),1,199,5);
		$view['prepaids'] = $this->mPrepaid->getPrepaids($this->page,$this->limit);
		$view['prepaids']['pageing']['url'] = base_url('/prepaid');
		$view['pageing'] = $this->load->view('pageing',$view['prepaids']['pageing'],true);
		$this->load->view('prepaid',$view);
	}
	public function info($serialNumber=''){
		header("Content-type: Text/html; Charset:utf8;");
		$view['prepaid'] = $prepaid = $this->mPrepaid->getPrepaid($serialNumber);
		$view['package'] = $this->mPackage->getPackage($prepaid['package_id']);
		
		$this->load->view('prepaid_info',$view);
	}
	public function search(){
		$serialNumber = $this->input->get('q_serial');
		$search = "serial_number='".str_replace(' ','',$serialNumber."'");
		$view['prepaids'] = $this->mPrepaid->searchPrepaids($search,$this->page,$this->limit);
		$view['prepaids']['pageing']['url'] = base_url('/prepaid');
		$view['pageing'] = $this->load->view('pageing',$view['prepaids']['pageing'],true);
		$this->load->view('prepaid',$view);
	}

	public function create(){
		$this->load->model('package_model','mPackage');
		$view['packages'] = $this->mPackage->getPackages();
		$view['packages'] = $view['packages']['items'];
		//var_dump($view);
		$this->load->view('prepaid_form',$view);
	}
	public function submit(){
		set_time_limit(0);
		$userID = $this->session->userdata('user_id');
		$packageID = $this->input->post('package_id');
		$startDate = $this->input->post('start_date');
		$expireDate = $this->input->post('expire_date');
		$count = $this->input->post('count');
		$export = $this->input->post('export');

		$this->load->model('package_model','mPackage');
		$package = $this->mPackage->getPackage($packageID);

		$this->prepaidcard->generate($startDate,$expireDate,$package,$package['price'],$count,$userID,$export);
		if($export){
			header("Content-type: text/plain; charset=utf-8;");
	    	header('Content-Transfer-Encoding: binary');
	    	header('Accept-Ranges: bytes');
	    	header('Content-Disposition: attachment; filename="prepaidCard-'.date('ymd').'.csv"');
		}else{
			redirect(backoffice_url('/prepaid/create'));
		}
	}
}