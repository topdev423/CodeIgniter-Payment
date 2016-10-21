<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to seller management
 * @author Teamtweaks
 *
 */

class Seller extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('seller_model');
		if ($this->checkPrivileges('seller',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller requests page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/seller/display_seller_dashboard');
		}
	}
	
	/**
	 * 
	 * This function loads the sellers dashboard
	 */
	public function display_seller_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Sellers Dashboard';
			$condition = array('group'=>'Seller');
			$this->data['sellerList'] = $this->seller_model->get_all_details(USERS,$condition);
			$Query = "select p.sell_id,MAX(p.total) as topAmt,sum(p.quantity) as totQty, u.user_name,u.full_name from ".PAYMENT." p 
						LEFT JOIN ".USERS." u on u.id=p.sell_id
						Where p.status='Paid'
						group by p.dealCodeNumber
						order by p.total+0 desc";
			$this->data['topSellDetails'] = $this->seller_model->ExecuteQuery($Query);
			$condition = array('request_status'=>'Pending','group'=>'User');
			$this->data['pendingList'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_seller_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the seller requests page
	 */
	public function display_seller_requests(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Seller Requests';
			$condition = array('request_status' => 'Pending','group' => 'User');
			$this->data['sellerRequests'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_seller_requests',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the sellers list page
	 */
	public function display_seller_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Seller List';
			$condition = array('group' => 'Seller');
			$this->data['sellersList'] = $this->seller_model->get_all_details(USERS,$condition);
			$this->load->view('admin/seller/display_sellerlist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a seller
	 */
	public function insertEditSeller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$seller_id = $this->input->post('seller_id');
			$excludeArr = array("seller_id");
			$dataArr = array();
			$condition = array('id' => $seller_id);
			if ($seller_id == ''){
				$this->setErrorMessage('success','Seller added successfully');
			}else {
				$this->seller_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Seller updated successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function change the seller request status
	 */
	public function change_seller_request(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
			}
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','Seller Request '.$status.' Successfully');
			redirect('admin/seller/display_seller_requests');
		}
	}
	
	/**
	 * 
	 * This function change the seller status
	 */
	public function change_seller_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Rejected':'Approved';
			$newdata = array('request_status' => $status);
			if ($status == 'Rejected'){
				$newdata['group'] = 'User';
			}else if ($status == 'Approved'){
				$newdata['group'] = 'Seller';
			}
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','Seller Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit seller form
	 */
	public function edit_seller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Seller';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['seller_details'] = $this->seller_model->get_all_details(USERS,$condition);
			if ($this->data['seller_details']->num_rows() == 1 && $this->data['seller_details']->row()->group == 'Seller'){
				$this->load->view('admin/seller/edit_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the seller view page
	 */
	public function view_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Seller';
			$seller_id = $this->uri->segment(4,0);
			$condition = array('id' => $seller_id);
			$this->data['seller_details'] = $this->seller_model->get_all_details(USERS,$condition);
			if ($this->data['seller_details']->num_rows() == 1){
				$this->load->view('admin/seller/view_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the seller record from db
	 */
	public function delete_seller(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$seller_id = $this->uri->segment(4,0);
			$condition = array('id' => $seller_id);
			$this->seller_model->commonDelete(USERS,$condition);
			$this->setErrorMessage('success','Seller deleted successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function delete the seller request records
	 */
	public function change_seller_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->seller_model->activeInactiveCommon(USERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Seller records deleted successfully');
			}else {
				$this->setErrorMessage('success','Seller records status changed successfully');
			}
			redirect('admin/seller/display_seller_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_user_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->seller_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','Seller Status Changed Successfully');
			redirect('admin/seller/display_seller_list');
		}
	}
	
	public function update_refund(){
		if ($this->checkLogin('A') != ''){
			$uid = $this->input->post('uid');
			$refund_amount = $this->input->post('amt');
			if ($uid != ''){
				$this->seller_model->update_details(USERS,array('refund_amount'=>$refund_amount),array('id'=>$uid));
			}
		}
	}
}

/* End of file seller.php */
/* Location: ./application/controllers/admin/seller.php */