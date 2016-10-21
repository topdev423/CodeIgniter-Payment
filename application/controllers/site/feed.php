<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Landing page functions
 * @author Teamtweaks
 *
 */

class Feed extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
//		echo $this->session->userdata('fc_session_user_id');die;
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
    /**
     * 
     * 
     */
   	public function feeds(){
	 	$this->data['heading'] = $this->config->item('meta_title');
		$this->data['sitelink'] = base_url(); 
		$this->data['sitedescription'] = $this->config->item('meta_description'); 
		
	 	$productDetails = $this->product_model->view_product_details(" where p.status='Publish' and p.quantity > 0 order by p.created desc");
		if ($productDetails->num_rows()>0){
			$this->data['productDetails'] = $productDetails->result();
		}else {
			$this->data['productDetails'] = '';
		}
	 	$this->load->view('site/feed/feed',$this->data);
	}

	public function user(){
	 	$this->data['heading'] = $this->config->item('meta_title');
		$this->data['sitelink'] = base_url(); 
		$this->data['sitedescription'] = $this->config->item('meta_description');
		$uname = $this->uri->segment(4,0);
		$userProfileDetails = $this->product_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->num_rows() == 1){
			$addedDetails = $this->product_model->get_all_details(PRODUCT,array('user_id'=>$userProfileDetails->row()->id));
			$addedProductArr = $addedDetails->result();
			$addedNotsellDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('user_id'=>$userProfileDetails->row()->id));
			$addedNotsellProductArr = $addedNotsellDetails->result();
//			$likedDetails = $this->product_model->get_recent_user_likes($userProfileDetails->row()->id,'','500');
//			if ($likedDetails->num_rows()>0){
//				$this->data['likedProductArr'] = $likedDetails->result();
//			}else {
				$this->data['likedProductArr'] = '';
//			}
		 	$this->data['productDetails'] = array_merge($addedProductArr,$addedNotsellProductArr);
			$this->load->view('site/feed/feed',$this->data);
		}else {
			show_404();
		}
	}

	public function store(){
		$this->data['heading'] = $this->config->item('meta_title');
		$this->data['sitelink'] = base_url(); 
		$this->data['sitedescription'] = $this->config->item('meta_description');
		$uname = $this->uri->segment(4,0);
		$userProfileDetails = $this->product_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->num_rows() == 1){
			$addedDetails = $this->product_model->get_all_details(PRODUCT,array('user_id'=>$userProfileDetails->row()->id));
			$addedProductArr = $addedDetails->result();
			$addedNotsellDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('user_id'=>$userProfileDetails->row()->id));
			$addedNotsellProductArr = $addedNotsellDetails->result();
//			$likedDetails = $this->product_model->get_recent_user_likes($userProfileDetails->row()->id,'','500');
//			if ($likedDetails->num_rows()>0){
//				$this->data['likedProductArr'] = $likedDetails->result();
//			}else {
				$this->data['likedProductArr'] = '';
//			}
		 	$this->data['productDetails'] = array_merge($addedProductArr,$addedNotsellProductArr);
			$this->load->view('site/feed/feed',$this->data);
		}else {
			show_404();
		}
	}
	
}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */