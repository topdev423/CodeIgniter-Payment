<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to couponcards management 
 * @author Teamtweaks
 *
 */

class Couponcards extends MY_Controller { 

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('couponcards_model');
		if ($this->checkPrivileges('couponcards',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the couponcards list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/couponcards/display_couponcards');
		}
	}
	
	/**
	 * 
	 * This function loads the couponcards list page
	 */
	public function display_couponcards(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Coupon Codes List';
			$condition = array();
			$this->data['couponCardsList'] = $this->couponcards_model->get_all_details(COUPONCARDS,$condition);
			$this->load->view('admin/couponcards/display_couponcards',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new couponcard form
	 */
	public function add_couponcard_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Coupon Code';
			$this->data['code'] = $this->get_rand_str('10');
			$this->data['CateogyView'] = $this->couponcards_model->view_category_details();
			$this->data['ProductView'] = $this->couponcards_model->view_product_details();
			$this->load->view('admin/couponcards/add_couponcard',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a couponcard
	 */
	public function insertEditCouponcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$coupon_id = $this->input->post('coupon_id');
			$coupon_type = $this->input->post('coupon_type');
			
			$excludeArr = array("coupon_id","price_type","status","category_id","product_id");
			if($coupon_type!='shipping'){
			
				if ($this->input->post('price_type') != ''){
					$priceType = '1';
				}else {
					$priceType = '2';
				}
				if($this->input->post('category_id') != ''){
					$categoryid = @implode(',',$this->input->post('category_id'));
				}else{
					$categoryid = '';
				}
				if($this->input->post('product_id') != ''){
					$productid = @implode(',',$this->input->post('product_id'));
				}else{
					$productid = '';
				}
				$inputArr = array('status' => 'Active','category_id' => $categoryid, 'product_id' => $productid,'price_type' =>	$priceType);
				
			}else{
				$priceType = 3;
				$inputArr = array('status' => 'Active','price_type'	=> $priceType);
			}
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($coupon_id == ''){
				$coupon_data = array('price_type'	=>	$priceType);
			}else {
				$coupon_data = array();
			}
			$dataArr = array_merge($inputArr,$coupon_data);
			$condition = array('id' => $coupon_id);
			if ($coupon_id == ''){
				$this->couponcards_model->commonInsertUpdate(COUPONCARDS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Coupon Code added successfully');
			}else {
				$this->couponcards_model->commonInsertUpdate(COUPONCARDS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Coupon Code updated successfully');
			}
			redirect('admin/couponcards/display_couponcards');
		}
	}
	
	/**
	 * 
	 * This function loads the edit couponcard form
	 */
	public function edit_couponcard_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Coupon Code';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['couponcard_details'] = $this->couponcards_model->get_all_details(COUPONCARDS,$condition);
			
			$newCatArr = @explode(',',$this->data['couponcard_details']->row()->category_id);
			$newPrdArr = @explode(',',$this->data['couponcard_details']->row()->product_id);			
			$this->data['CateogyView'] = $this->couponcards_model->view_edit_category_details($newCatArr);
			$this->data['ProductView'] = $this->couponcards_model->view_product_details($newPrdArr);
			if ($this->data['couponcard_details']->num_rows() == 1){
				$this->load->view('admin/couponcards/edit_couponcard',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the couponcard status
	 */
	public function change_couponcard_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->couponcards_model->update_details(COUPONCARDS,$newdata,$condition);
			$this->setErrorMessage('success','Coupon Code Status Changed Successfully');
			redirect('admin/couponcards/display_couponcards');
		}
	}
	
	/**
	 * 
	 * This function delete the couponcard from db
	 */
	public function delete_couponcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$coupon_id = $this->uri->segment(4,0);
			$condition = array('id' => $coupon_id);
			$this->couponcards_model->commonDelete(COUPONCARDS,$condition);
			$this->setErrorMessage('success','Coupon Code deleted successfully');
			redirect('admin/couponcards/display_couponcards');
		}
	}
	
	/**
	 * 
	 * This function change the couponcards status
	 */
	public function change_couponcards_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->couponcards_model->activeInactiveCommon(COUPONCARDS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Coupon Code deleted successfully');
			}else {
				$this->setErrorMessage('success','Coupon Code status changed successfully');
			}
			redirect('admin/couponcards/display_couponcards');
		}
	}
}

/* End of file couponcards.php */
/* Location: ./application/controllers/admin/couponcards.php */