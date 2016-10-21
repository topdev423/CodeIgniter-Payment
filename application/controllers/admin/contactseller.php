<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to payment gateway management
 * @author Teamtweaks
 *
 */

class Contactseller extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('contactseller_model');
		if ($this->checkPrivileges('contactseller',$this->privStatus) == FALSE){
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
			redirect('admin/contactseller/display_contact_seller');
		}
	}
	
	/**
	 * 
	 * This function loads the Contact seller list
	 */
	public function display_contact_seller(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Contact Seller';
			$condition = array();
			$this->data['ContactList'] = $this->contactseller_model->get_all_details(CONTACTSELLER,$condition);
			$this->load->view('admin/contactseller/display_contact_seller',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit gateway form
	 */
	public function view_contactseller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Contact Seller Settings';
			$cont_Id = $this->uri->segment(4,0);
			$condition = array('id' => $cont_Id);
			$this->data['contact_seller_status'] = $this->contactseller_model->get_all_details(CONTACTSELLER,$condition);
			if ($this->data['contact_seller_status']->num_rows() == 1){
				$this->data['prodDetails'] = $this->contactseller_model->get_all_details(PRODUCT,array('id'=>$this->data['contact_seller_status']->row()->product_id));
				$this->load->view('admin/contactseller/view_contact_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
}

/* End of file contactseller.php */
/* Location: ./application/controllers/admin/contactseller.php */