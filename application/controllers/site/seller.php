<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Seller related functions
 * @author Teamtweaks
 *
 */

class Seller extends MY_Controller {

	function __construct(){
	//echo "<pre>";print_r($_REQUEST);echo "</pre>";// die;
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model','product');
		$this->load->model('user_model','user');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
    public function index(){
    	$this->data['heading'] = 'Stores';
    	$this->data['sellers_list'] = $this->user->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
    	$this->load->view('site/seller/display_sellers_list',$this->data);
    }
    
    /**
     * 
     * Loads the store profile
     */
	public function view_profile(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->product->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $userProfileDetails->row()->brand_name;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['addedProductDetails'] = $this->product->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->data['notSellProducts'] = $this->product->view_notsell_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->load->view('site/seller/display_seller_profile',$this->data);
			}
		}else {
			show_404();
		}
	}
	
	public function display_store_following(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->product->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $userProfileDetails->row()->brand_name;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->following);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_following',$this->data);
			}
		}else {
			show_404();
		}
	}
	
	public function display_store_followers(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				$this->data['heading'] = $userProfileDetails->row()->brand_name;
				$this->data['userProfileDetails'] = $userProfileDetails;
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->followers);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_followers',$this->data);
			}
		}else {
			show_404();
		}
	}
}

/* End of file seller.php */
/* Location: ./application/controllers/site/seller.php */