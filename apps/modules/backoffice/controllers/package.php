<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	var $breadcrumb;
	var $page;
	var $limit;
	public function __construct(){
		parent::__construct();

		$this->page = $this->input->get('page');
		$this->limit = $this->input->get('limit');
		$this->page = $this->page?$this->page:1;
		$this->limit = $this->limit?$this->limit:30;

		$this->breadcrumb[] = array('title'=>'Packages','url'=>backoffice_url('/package'));
		$this->load->model('package_model','mPackage');
	}

	public function index($packageID=""){
		if($packageID){
			$this->detail($packageID);
		}else{
			$data['breadcrumb'] = $this->breadcrumb;

			$data['packages'] = $this->mPackage->getPackages($this->page,$this->limit);
			$data['packages']['pageing']['url'] = backoffice_url('/package');
			$data['pageing'] = $this->load->view('pageing',$data['packages']['pageing'],true);
			$this->load->view('package',$data);	
		}
		
	}
	public function detail($packageID=""){
		$data['package'] = $this->mPackage->getPackage($packageID);
		$this->breadcrumb[] = array('title'=>$data['package']['title'],'url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_detail',$data);
	}
	public function edit($packageID=""){
		$data['package'] = $this->mPackage->getPackage($packageID);
		$this->breadcrumb[] = array('title'=>$data['package']['title'],'url'=>backoffice_url('/package/'.$packageID));
		$this->breadcrumb[] = array('title'=>'Edit','url'=>'');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_form',$data);
	}
	public function submit($packageID=false){
		$isError = false;
		$package = $this->input->post();

		if(empty($package['title'])){
			$isError = true;
			$package['title_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		if(empty($package['name'])){
			$isError = true;
			$package['name_error'] = "ยังไม่ได้ใส่ข้อมูล";
		}
		$data['package'] = $package;
		unset($package);
		if($isError){
			$this->load->view('package_form',$data);
		}else{
			if(is_numeric($packageID)){
				$this->mPackage->updatePackage($packageID,$data['package']);
			}else{
				$packageID = $this->mPackage->setPackage($data['package']);
			}
			redirect(backoffice_url('/package'));	
		}
	}
	
	public function active($packageID){
		if(is_numeric($packageID)){
			$this->mPackage->updatePackage($packageID,array('status'=>'ACTIVE'));
		}
		redirect(backoffice_url('/package'));
	}
	public function inactive($packageID){
		if(is_numeric($packageID)){
			$this->mPackage->updatePackage($packageID,array('status'=>'INACTIVE'));
		}
		redirect(backoffice_url('/package'));
	}

	public function add(){
		$this->breadcrumb[] = array('title'=>'Add','url'=>'#');
		$data['breadcrumb'] = $this->breadcrumb;
		$this->load->view('package_form',$data);
	}
}

/* End of file package.php */
/* Location: ./application/modeules/backoffice/controllers/package.php */