<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Product Attribute management 
 * Attribute mentioned as 'Product Attribute'
 * @author Teamtweaks
 *
 */ 

class Productattribute extends MY_Controller {
 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_attribute_model');
		if ($this->checkPrivileges('productattribute',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the Product attribute list page
     */
   	public function index(){	
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/productattribute/display_product_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function loads the Product attribute list page
	 */
	public function display_product_attribute_list(){
		//echo "df";die;
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Product Attribute Details';
			$this->data['attributeList'] = $this->product_attribute_model->view_attribute_details();
			$this->load->view('admin/productattribute/display_product_attribute_list',$this->data);
		}
	}

	
	/**
	 * 
	 * This function loads the add new Product attribute form
	 */
	public function add_product_attribute_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add Attribute';
			$this->data['Attribute_id'] = $this->uri->segment(4,0);
			$this->load->view('admin/productattribute/add_product_attribute',$this->data);
		}
	}
	
	
	
	/**
	 * 
	 * This function insert Product attribute
	 */
	public function insertAttribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			
			$attr_name = $this->input->post('attr_name');
			$condition = array('attr_name' => $attr_name);
			$duplicate_name = $this->product_attribute_model->get_all_details(PRODUCT_ATTRIBUTE,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Attribute name already exists');
				redirect('admin/productattribute/add_product_attribute_form/');
			}
			$seourl = url_title($attr_name,'',TRUE);
			$excludeArr = array("status");
			
			if ($this->input->post('status') != ''){
				$attribute_status = 'Active';
			}else {
				$attribute_status = 'Inactive';
			}
			
			$dataArr = array( 'attr_name' => $attr_name,'status' => $attribute_status,'attr_seourl'=>$seourl );
			
			$this->product_attribute_model->add_attribute($dataArr);
			$this->setErrorMessage('success','Attribute added successfully');
			redirect('admin/productattribute/display_product_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function Edit Product attribute
	 */
	public function EditAttribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		

			$attribute_id = $this->input->post('attribute_id');			
			$attribute_name = $this->input->post('attr_name');
			
			$condition = array('id' => $attribute_id);

			$excludeArr = array("status");
			$seourl = url_title($attribute_name,'',TRUE);
			$dataArr = array( 'attr_name' => $attribute_name,'status' => 'Active','attr_seourl'=>$seourl );
			
			$this->product_attribute_model->edit_attribute($dataArr,$condition);
			$this->setErrorMessage('success','Attribute updated successfully');
			redirect('admin/productattribute/display_product_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit Product attribute form
	 */
	public function edit_attribute_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Attribute';
			$attribute_id = $this->uri->segment(4,0);
			$condition = array('id' => $attribute_id);
			$this->data['attribute_details'] = $this->product_attribute_model->view_attribute($condition);
			if ($this->data['attribute_details']->num_rows() == 1){
				$this->load->view('admin/productattribute/edit_product_attribute',$this->data);
			}else {
				redirect('admin');
			}
		}
	}

	/**
	 * 
	 * This function change the attribute status
	 */
	public function change_attribute_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$attribute_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $attribute_id);
			$this->product_attribute_model->update_details(PRODUCT_ATTRIBUTE,$newdata,$condition);
			$this->setErrorMessage('success','Attribute Status Changed Successfully');
			redirect('admin/productattribute/display_product_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function loads the attribute view page
	 */
	public function view_attribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Attribute';
			$attribute_id = $this->uri->segment(4,0);
			$condition = array('id' => $attribute_id);
			$this->data['attribute_details'] = $this->product_attribute_model->get_all_details(PRODUCT_ATTRIBUTE,$condition);
			if ($this->data['attribute_details']->num_rows() == 1){
				$this->load->view('admin/productattribute/view_product_attribute',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the attribute record from db
	 */
	public function delete_attribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$attribute_id = $this->uri->segment(4,0);
			$condition = array('id' => $attribute_id);
			$this->product_attribute_model->commonDelete(PRODUCT_ATTRIBUTE,$condition);
			$this->setErrorMessage('success','Attribute deleted successfully');
			redirect('admin/productattribute/display_product_attribute_list');
		}
	}

	
	/**
	 * 
	 * This function change the attribute status, delete the attribute record
	 */
	public function change_attribute_status_global(){
	
		if($this->input->post('checkboxID')!=''){
		
			if($this->input->post('checkboxID')=='0'){
				redirect('admin/productattribute/add_product_attribute_form/0');
			}else{
				redirect('admin/productattribute/add_product_attribute_form/'.$this->input->post('checkboxID'));			
			}
	
		}else{
			if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
				$this->product_attribute_model->activeInactiveCommon(PRODUCT_ATTRIBUTE,'id');
				if (strtolower($this->input->post('statusMode')) == 'delete'){
					$this->setErrorMessage('success','Attribute records deleted successfully');
				}else {
					$this->setErrorMessage('success','Attribute records status changed successfully');
				}
				redirect('admin/productattribute/display_product_attribute_list');
			}
		}
	}


	
}

/* End of file attribute.php */
/* Location: ./application/controllers/admin/attribute.php */