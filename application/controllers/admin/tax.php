<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Tax management 
 * @author Teamtweaks
 *
 */

class Tax extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('tax_model');
		if ($this->checkPrivileges('tax',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the Tax list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/tax/display_tax_list');
		}
	}
	
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function display_tax_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Tax List';
			$condition = array();
			$this->data['taxList'] = $this->tax_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('admin/tax/display_tax',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the Tax list page
	 */
	public function display_tax_statelist(){ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'State Tax List';
			$statetax_id = $this->uri->segment(4,0);
			$condition = array('country_id' => $statetax_id);
			$this->data['taxList'] = $this->tax_model->get_all_details(STATE_TAX,$condition);
			$this->load->view('admin/tax/display_tax',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the add new Tax form
	 */
	public function add_tax_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Tax';
			$this->data['countryDisplay'] = $this->tax_model->SelectAllCountry();
			$this->load->view('admin/tax/add_tax',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a Tax
	 */
	public function insertEditTax(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$tax_id = $this->input->post('tax_id');
			$tax_name = $this->input->post('state_name');
			$seourl = url_title($tax_name, '-', TRUE);
			$GetCountry = array('id' => $this->input->post('country_id'));
			$GetCountryDetails = $this->tax_model->get_all_details(LOCATION,$GetCountry);
			$inputArr = array('seourl'=>$seourl,'country_name' => $GetCountryDetails->row()->location_name,'country_code' => $GetCountryDetails->row()->iso_code2);
			if ($tax_id == ''){
				$condition = array('state_name' => $tax_name);
				$duplicate_name = $this->tax_model->get_all_details(STATE_TAX,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Tax name already exists');
					redirect('admin/tax/add_tax_form');
				}
			}
			$excludeArr = array("tax_id","status");
			
			if ($this->input->post('status') != ''){
				$tax_status = 'Active';
			}else {
				$tax_status = 'InActive';
			}
			$tax_data=array();
			$inputArr['status']= $tax_status;
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($tax_id == ''){
				$tax_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}
			$dataArr = array_merge($inputArr,$tax_data);
			$condition = array('id' => $tax_id);
			if ($tax_id == ''){
				$this->tax_model->commonInsertUpdate(STATE_TAX,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Tax added successfully');
			}else {
				$this->tax_model->commonInsertUpdate(STATE_TAX,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Tax updated successfully');
			}
			redirect('admin/tax/display_tax_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit Tax form
	 */
	public function edit_tax_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Tax';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->data['countryDisplay'] = $this->tax_model->SelectAllCountry();
			$this->data['tax_details'] = $this->tax_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('admin/tax/edit_tax',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the Tax status
	 */
	public function change_tax_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->tax_model->update_details(LOCATIONS,$newdata,$condition);
			$this->setErrorMessage('success','Tax Status Changed Successfully');
			redirect('admin/tax/display_tax_list');
		}
	}
	
	/**
	 * 
	 * This function loads the Tax view page
	 */
	public function view_tax(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Tax';
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->data['tax_details'] = $this->tax_model->get_all_details(STATE_TAX,$condition);
			if ($this->data['tax_details']->num_rows() == 1){
				$this->load->view('admin/tax/view_tax',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the Tax record from db
	 */
	public function delete_tax(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$tax_id = $this->uri->segment(4,0);
			$condition = array('id' => $tax_id);
			$this->tax_model->commonDelete(STATE_TAX,$condition);
			$this->setErrorMessage('success','State deleted successfully');
			redirect('admin/tax/display_tax_list');
		}
	}
	
	/**
	 * 
	 * This function change the Tax status, delete the Tax record
	 */
	public function change_user_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(LOCATIONS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/tax/display_user_list');
		}
	}
}

/* End of file Tax.php */
/* Tax: ./application/controllers/admin/Tax.php */