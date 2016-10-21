<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to payment gateway management
 * @author Teamtweaks
 *
 */

class Paygateway extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('paygateway_model');
		if ($this->checkPrivileges('paygateway',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the paygateway list
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/paygateway/display_gateway');
		}
	}
	
	/**
	 * 
	 * This function loads the paygateway list
	 */
	public function display_gateway(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Payment Gateway';
			$condition = array();
			$this->data['gatewayLists'] = $this->paygateway_model->get_all_details(PAYMENT_GATEWAY,$condition);
			$this->load->view('admin/paygateway/display_gateway',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit gateway form
	 */
	public function edit_gateway_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Gateway Settings';
			$gateway_id = $this->uri->segment(4,0);
			$condition = array('id' => $gateway_id);
			$this->data['gateway_details'] = $this->paygateway_model->get_all_details(PAYMENT_GATEWAY,$condition);
			if ($this->data['gateway_details']->num_rows() == 1){
				$this->load->view('admin/paygateway/edit_gateway',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function insert and edit a payment gateway
	 */
	public function insertEditGateway(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$demoserverChk){
				$gateway_id = $this->input->post('gateway_id');
				$mode = $this->input->post('mode');
				$gatewaySettings = array();
				if ($mode == ''){
					$gatewaySettings['mode'] = 'sandbox';
				}else {
					$gatewaySettings['mode'] = 'live';
				}
				$excludeArr = array("gateway_id","mode");
				foreach ($this->input->post() as $key => $val){
					if (!in_array($key, $excludeArr)){
						$gatewaySettings[$key] = $val;
					}
				}
				$dataArr = array('settings' => serialize($gatewaySettings));
				$condition = array('id' => $gateway_id);
				if ($gateway_id == ''){
					$this->setErrorMessage('success','Payment gateway added successfully');
				}else {
					$this->paygateway_model->update_details(PAYMENT_GATEWAY,$dataArr,$condition);
					$this->paygateway_model->savePaymentSettings();
					$this->setErrorMessage('success','Payment gateway updated successfully');
				}
				redirect('admin/paygateway/display_gateway');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/paygateway/display_gateway');
			}
		}
	}
	
	/**
	 * 
	 * This function change the gateway status
	 */
	public function change_gateway_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$demoserverChk){
				$mode = $this->uri->segment(4,0);
				$gateway_id = $this->uri->segment(5,0);
				$status = ($mode == '0')?'Disable':'Enable';
				$newdata = array('status' => $status);
				$condition = array('id' => $gateway_id);
				$this->paygateway_model->update_details(PAYMENT_GATEWAY,$newdata,$condition);
				$this->paygateway_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment Gateway Status Changed Successfully');
				redirect('admin/paygateway/display_gateway');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/paygateway/display_gateway');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the seller request records
	 */
	public function change_paygateway_status_global(){
		if (!$demoserverChk){
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$this->paygateway_model->activeInactiveCommon(PAYMENT_GATEWAY,'id');
				$this->paygateway_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment gateway records status changed successfully');
				redirect('admin/paygateway/display_gateway');
			}
		}else {
			$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
			redirect('admin/paygateway/display_gateway');
		}
	}
}

/* End of file paygateway.php */
/* Location: ./application/controllers/admin/paygateway.php */