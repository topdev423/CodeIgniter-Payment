<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Location extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('location_model');
		if ($this->checkPrivileges('location',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the location list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/location/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the location list page
	 */
	public function display_location_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Location List';
			$condition = array();
			$this->data['locationList'] = $this->location_model->get_all_details(LOCATIONS,$condition);
			$this->load->view('admin/location/display_location',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the location dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Location Dashboard';
			$condition = 'order by `created` desc';
			$this->data['locationList'] = $this->user_model->get_location_details($condition);
			$this->load->view('admin/location/display_location_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new location form
	 */
	public function add_location_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Location';
			$this->load->view('admin/location/add_location',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditLocation(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$location_id = $this->input->post('location_id');
			$location_name = $this->input->post('location_name');
			$seourl = url_title($location_name, '-', TRUE);
			if ($location_id == ''){
				$condition = array('location_name' => $location_name);
				$duplicate_name = $this->location_model->get_all_details(LOCATIONS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','Location name already exists');
					redirect('admin/location/add_location_form');
				}
			}
			$excludeArr = array("location_id","status");
			
			if ($this->input->post('status') != ''){
				$location_status = 'Active';
			}else {
				$location_status = 'InActive';
			}
			$location_data=array();
			
			$inputArr = array('status' => $location_status,'seourl'=>$seourl);
			$datestring = "%Y-%m-%d %H:%M:%S";
			$time = time();
			if ($location_id == ''){
				$location_data = array(
					'dateAdded'	=>	mdate($datestring,$time),
				);
			}
			$dataArr = array_merge($inputArr,$location_data);
			$condition = array('id' => $location_id);
			if ($location_id == ''){
				$this->location_model->commonInsertUpdate(LOCATIONS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Location added successfully');
			}else {
				if($location_status=='Active'){
				$dataArr1=array('status'=>'InActive');
				$conditionArr=array('id !='=>$location_id);
				$this->location_model-> update_details(LOCATIONS,$dataArr1,$conditionArr);
				}
				$this->location_model->commonInsertUpdate(LOCATIONS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Location updated successfully');
			}
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_location_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Location';
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->data['location_details'] = $this->location_model->get_all_details(LOCATIONS,$condition);
			if ($this->data['location_details']->num_rows() == 1){
				$this->load->view('admin/location/edit_location',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the user status
	 */
	public function change_location_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->location_model->update_details(LOCATIONS,$newdata,$condition);
			$this->setErrorMessage('success','Location Status Changed Successfully');
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_location(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Location';
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->data['location_details'] = $this->location_model->get_all_details(LOCATIONS,$condition);
			if ($this->data['location_details']->num_rows() == 1){
				$this->load->view('admin/location/view_location',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_location(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$location_id = $this->uri->segment(4,0);
			$condition = array('id' => $location_id);
			$this->location_model->commonDelete(LOCATIONS,$condition);
			$this->setErrorMessage('success','Location deleted successfully');
			redirect('admin/location/display_location_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_user_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(LOCATIONS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/location/display_user_list');
		}
	}
}

/* End of file location.php */
/* Location: ./application/controllers/admin/location.php */