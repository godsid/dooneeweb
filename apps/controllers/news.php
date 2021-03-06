<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {
    var $categories;
    var $memberLogin;
    var $page;
    var $limit;
	public function __construct(){
        parent::__construct();
        $this->load->model('member_model','mMember');
        $this->load->model('category_model','mCategory');
        $this->load->model('article_model','mArticle');
        $this->categories = $this->mCategory->getCategoriesMenu();
        $this->memberLogin = $this->mMember->getMemberLogin();
        $this->page = $this->input->get('page'); $this->page = $this->page?$this->page:1;
        $this->limit = $this->input->get('limit'); $this->limit = $this->limit?$this->limit:30;
    }
    public function index($newsID=""){
        $view['memberLogin'] = $this->memberLogin;
        $view['categories'] = $this->categories;
        if(is_numeric($newsID)){
            $view['article'] = $this->mArticle->getArticle($newsID);    
            $this->load->view('web/article_detail',$view);
        }else{
            $view['article'] = $this->mArticle->getNews($this->page,$this->limit);
            $this->load->view('web/article',$view);
        }
    }
}