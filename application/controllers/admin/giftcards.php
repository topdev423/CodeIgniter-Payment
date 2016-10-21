<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to giftcards management 
 * @author Teamtweaks
 *
 */
class Giftcards extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('giftcards_model');
		if ($this->checkPrivileges('giftcards',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the giftcards list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * This function loads the giftcards dashboard
	 */
	public function display_giftcards_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Gift Cards Dashboard';
			$condition = 'order by `created` desc';
			$this->data['giftCardsList'] = $this->giftcards_model->get_giftcard_details($condition);
			$this->load->view('admin/giftcards/display_giftcards_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the giftcards list page
	 */
	public function display_giftcards(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Gift Cards List';
			$condition = array();
			$this->data['giftCardsList'] = $this->giftcards_model->get_all_details(GIFTCARDS,$condition);
			$this->load->view('admin/giftcards/display_giftcards',$this->data);
		}
	}
	
	/**
	 * 
	 * Change the giftcards settings
	 */
	public function insertEditGiftcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$excludeArr = array("gift_image");
			$dataArr = array();
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    $config['max_size'] = 2000;
		    $config['upload_path'] = './images/giftcards';
		    $this->load->library('upload', $config);
			if ( $this->upload->do_upload('gift_image')){
		    	$logoDetails = $this->upload->data();
		    	$dataArr['image'] = $logoDetails['file_name'];
			}
			$condition = array('id' => '1');
			($this->config->item('giftcard_id') == '') ? $modeVal = 'insert' : $modeVal = 'update';
			$this->giftcards_model->commonInsertUpdate(GIFTCARDS_SETTINGS,$modeVal,$excludeArr,$dataArr,$condition);
			$this->giftcards_model->saveGiftcardSettings();
			$this->setErrorMessage('success','Giftcards settings updated successfully');
			redirect('admin/giftcards/edit_giftcards_settings');
		}
	}
	
	/**
	 * 
	 * This function loads the edit giftcards settings
	 */
	public function edit_giftcards_settings(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Giftcards Settings';
			$this->data['giftcards_settings'] = $this->giftcards_model->get_all_details(GIFTCARDS_SETTINGS,array());
			$this->load->view('admin/giftcards/edit_giftcards_settings',$this->data);
		}
	}
	
	/**
	 * 
	 * This function delete the giftcard from db
	 */
	public function delete_giftcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$gift_id = $this->uri->segment(4,0);
			$condition = array('id' => $gift_id);
			$this->giftcards_model->commonDelete(GIFTCARDS,$condition);
			$this->setErrorMessage('success','Giftcard deleted successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * Changing giftcard mode as Disable | Enable
	 */
	public function change_giftcards_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$status = ($mode == '1')?'Enable':'Disable';
			$condition = array('id' => '1');
			$data = array('status'=>$status);
			$this->giftcards_model->update_details(GIFTCARDS_SETTINGS,$data,$condition);
			$this->giftcards_model->saveGiftcardSettings();
			$this->setErrorMessage('success','Giftcards '.$status.'d Successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * This function delete the giftcards 
	 */
	public function change_giftcards_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->giftcards_model->activeInactiveCommon(GIFTCARDS,'id');
			$this->setErrorMessage('success','Giftcards deleted successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
}

/* End of file giftcards.php */
/* Location: ./application/controllers/admin/giftcards.php */