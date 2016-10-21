<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Users extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('user_model');
		if ($this->checkPrivileges('user',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	public function display_user_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Users List';
			$condition = array('group'=>'User');
			$this->data['usersList'] = $this->user_model->get_all_details(USERS,$condition);
			$this->load->view('admin/users/display_userlist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Users Dashboard';
			$condition = 'order by `created` desc';
			$this->data['usersList'] = $this->user_model->get_users_details($condition);
			$this->load->view('admin/users/display_user_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new user form
	 */
	public function add_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New User';
			$this->load->view('admin/users/add_user',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditUser(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->input->post('user_id');
			$user_name = $this->input->post('user_name');
			$password = md5($this->input->post('new_password'));
			$email = $this->input->post('email');
			if ($user_id == ''){
				$unameArr = $this->config->item('unameArr');
				if (!preg_match('/^\w{1,}$/', trim($user_name))){
					$this->setErrorMessage('error','User name not valid. Only alphanumeric allowed');
					echo "<script>window.history.go(-1);</script>";exit;
				}
				if (in_array($user_name, $unameArr)){
					$this->setErrorMessage('error','User name already exists');
					echo "<script>window.history.go(-1);</script>";exit;
				}
				$condition = array('user_name' => $user_name);
				$duplicate_name = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','User name already exists');
					redirect('admin/users/add_user_form');
				}else {
					$condition = array('email' => $email);
					$duplicate_mail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicate_mail->num_rows() > 0){
						$this->setErrorMessage('error','User email already exists');
						redirect('admin/users/add_user_form');
					}
				}
			}
			$excludeArr = array("user_id","thumbnail","new_password","confirm_password","group","status");
			if ($this->input->post('group') != ''){
				$user_group = 'User';
			}else {
				$user_group = 'Seller';
			}
			if ($this->input->post('status') != ''){
				$user_status = 'Active';
			}else {
				$user_status = 'Inactive';
			}
			$inputArr = array('group' => $user_group, 'status' => $user_status);
			if ($user_group == 'Seller'){
				$inputArr['request_status'] = 'Approved';
			}
			$datestring = "%Y-%m-%d";
			$time = time();
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    $config['max_size'] = 2000;
		    $config['upload_path'] = './images/users';
		    $this->load->library('upload', $config);
			if ( $this->upload->do_upload('thumbnail')){
		    	$imgDetails = $this->upload->data();
		    	$inputArr['thumbnail'] = $imgDetails['file_name'];
			}
			if ($user_id == ''){
				$user_data = array(
					'password'	=>	$password,
					'is_verified'	=>	'Yes',
					'created'	=>	mdate($datestring,$time),
					'modified'	=>	mdate($datestring,$time),
				);
			}else {
				$user_data = array('modified' =>	mdate($datestring,$time));
			}
			$dataArr = array_merge($inputArr,$user_data);
			$condition = array('id' => $user_id);
			if ($user_id == ''){
				$this->user_model->commonInsertUpdate(USERS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User added successfully');
			}else {
				$this->user_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','User updated successfully');
			}
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_user_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit User';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/edit_user',$this->data);
			}else {
				redirect('admin');
			}
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
			$this->user_model->update_details(USERS,$newdata,$condition);
			$this->setErrorMessage('success','User Status Changed Successfully');
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View User';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->user_model->get_all_details(USERS,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/users/view_user',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_user(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->user_model->commonDelete(USERS,$condition);
			$this->setErrorMessage('success','User deleted successfully');
			redirect('admin/users/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function change the user status, delete the user record
	 */
	public function change_user_status_global(){
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
			$this->user_model->activeInactiveCommon(USERS,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','User records deleted successfully');
			}else {
				$this->setErrorMessage('success','User records status changed successfully');
			}
			redirect('admin/users/display_user_list');
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */