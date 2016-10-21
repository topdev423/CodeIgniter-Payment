<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Attribute management 
 * Attribute mentioned as 'List'
 * @author Teamtweaks
 *
 */ 

class Attribute extends MY_Controller {
 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('attribute_model');
		if ($this->checkPrivileges('attribute',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the attribute list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/attribute/display_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function loads the attribute list page
	 */
	public function display_attribute_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'List Details';
			$this->data['attributeList'] = $this->attribute_model->view_attribute_details();
			$this->load->view('admin/attribute/display_attribute_list',$this->data);
		}
	}

	/**
	 * 
	 * This function loads the list values page
	 */
	public function display_list_values(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Color List';
			$this->data['listValues'] = $this->attribute_model->get_list_values();
			$this->load->view('admin/attribute/display_list_values',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new attribute form
	 */
	public function add_attribute_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Color';
			$this->data['Attribute_id'] = $this->uri->segment(4,0);
			$this->load->view('admin/attribute/add_attribute',$this->data);
		}
	}
	
	
	
	/**
	 * 
	 * This function insert attribute
	 */
	public function insertAttribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			
			$attribute_name = $this->input->post('attribute_name');
			$condition = array('attribute_name' => $attribute_name);
			$duplicate_name = $this->attribute_model->get_all_details(ATTRIBUTE,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','List name already exists');
				redirect('admin/attribute/add_attribute_form/');
			}
			$seourl = url_title($attribute_name,'',TRUE);
			$excludeArr = array("status");
			
			if ($this->input->post('status') != ''){
				$attribute_status = 'Active';
			}else {
				$attribute_status = 'Inactive';
			}
			
			$dataArr = array( 'attribute_name' => $attribute_name,'status' => $attribute_status,'attribute_seourl'=>$seourl );
			
			$this->attribute_model->add_attribute($dataArr);
			$this->setErrorMessage('success','List added successfully');
			redirect('admin/attribute/display_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function Edit attribute
	 */
	public function EditAttribute(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		

			$attribute_id = $this->input->post('attribute_id');			
			$attribute_name = $this->input->post('attribute_name');
			
			$condition = array('id' => $attribute_id);

			$excludeArr = array("status");
			$seourl = url_title($attribute_name,'',TRUE);
			$dataArr = array( 'attribute_name' => $attribute_name,'status' => 'Active','attribute_seourl'=>$seourl );
			
			$this->attribute_model->edit_attribute($dataArr,$condition);
			$this->setErrorMessage('success','List updated successfully');
			redirect('admin/attribute/display_attribute_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit attribute form
	 */
	public function edit_attribute_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit List';
			$attribute_id = $this->uri->segment(4,0);
			$condition = array('id' => $attribute_id);
			$this->data['attribute_details'] = $this->attribute_model->view_attribute($condition);
			if ($this->data['attribute_details']->num_rows() == 1){
				$this->load->view('admin/attribute/edit_attribute',$this->data);
			}else {
				redirect('admin');
			}
		}
	}

	/**
	 * 
	 * This function loads the edit list value form
	 */
	public function edit_list_value_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Color';
			$list_value_id = $this->uri->segment(4,0);
			$condition = array('id' => $list_value_id);
			$this->data['list_value_details'] = $this->attribute_model->get_all_details(LIST_VALUES,$condition);
			if ($this->data['list_value_details']->num_rows() == 1){
				$this->data['list_details'] = $this->attribute_model->get_all_details(ATTRIBUTE,array());
				$this->load->view('admin/attribute/edit_list_value',$this->data);
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
			$this->attribute_model->update_details(ATTRIBUTE,$newdata,$condition);
			$this->setErrorMessage('success','List Status Changed Successfully');
			redirect('admin/attribute/display_attribute_list');
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
			$this->data['heading'] = 'View List';
			$attribute_id = $this->uri->segment(4,0);
			$condition = array('id' => $attribute_id);
			$this->data['attribute_details'] = $this->attribute_model->get_all_details(ATTRIBUTE,$condition);
			if ($this->data['attribute_details']->num_rows() == 1){
				$this->load->view('admin/attribute/view_attribute',$this->data);
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
			$this->attribute_model->commonDelete(ATTRIBUTE,$condition);
			$this->setErrorMessage('success','List deleted successfully');
			redirect('admin/attribute/display_attribute_list');
		}
	}

	/**
	 * 
	 * This function delete the list value from db
	 */
	public function delete_list_value(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$list_value_id = $this->uri->segment(4,0);
			$condition = array('id' => $list_value_id);
			$this->attribute_model->commonDelete(LIST_VALUES,$condition);
			$this->setErrorMessage('success','List value deleted successfully');
			redirect('admin/attribute/display_list_values');
		}
	}
	
	/**
	 * 
	 * This function change the attribute status, delete the attribute record
	 */
	public function change_attribute_status_global(){
	
		if($this->input->post('checkboxID')!=''){
		
			if($this->input->post('checkboxID')=='0'){
				redirect('admin/attribute/add_attribute_form/0');
			}else{
				redirect('admin/attribute/add_attribute_form/'.$this->input->post('checkboxID'));			
			}
	
		}else{
			if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
				$this->attribute_model->activeInactiveCommon(ATTRIBUTE,'id');
				if (strtolower($this->input->post('statusMode')) == 'delete'){
					$this->setErrorMessage('success','Attribute records deleted successfully');
				}else {
					$this->setErrorMessage('success','Attribute records status changed successfully');
				}
				redirect('admin/attribute/display_attribute_list');
			}
		}
	}

	/**
	 * 
	 * This function delete the list value record
	 */
	public function change_list_value_status_global(){
	
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
			$this->attribute_model->activeInactiveCommon(LIST_VALUES,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','List values deleted successfully');
			}
			redirect('admin/attribute/display_list_values');
		}
	}
	
	/**
	 * 
	 * This function loads the add new attribute form
	 */
	public function add_list_value_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add Color';
			$this->data['list_details'] = $this->attribute_model->get_all_details(ATTRIBUTE,array());
			$this->load->view('admin/attribute/add_list_value',$this->data);
		}
	}
	
	public function insertEditListValue(){
		$list_id = $this->input->post('list_name');
		if ($list_id == ''){
			$this->setErrorMessage('error','Select the list');
			echo "<script>window.history.go(-1)</script>";
		}else {
			$lvID = $this->input->post('lvID');
			$list_value = $this->input->post('list_value');
			$seourl = url_title($list_value,'',TRUE);
			if ($lvID == ''){
				$dataArr = array(
					'list_id'	=>	$list_id,
					'list_value'=>	$list_value
				);
			}else {
				$dataArr = array(
					'id !='		=>	$lvID,
					'list_id'	=>	$list_id,
					'list_value'=>	$list_value
				);
			}
			$duplicateCheck = $this->attribute_model->get_all_details(LIST_VALUES,$dataArr);
			$dataArr = array(
				'list_id'	=>	$list_id,
				'list_value'=>	$list_value,
				'list_value_seourl'=> $seourl
			);
			if ($duplicateCheck->num_rows()==0){
				if ($lvID == ''){
					$this->attribute_model->simple_insert(LIST_VALUES,$dataArr);
					$this->setErrorMessage('success','Color inserted successfully');
				}else {
					$condition = array('id'=>$lvID);
					$this->attribute_model->update_details(LIST_VALUES,$dataArr,$condition);
					$this->setErrorMessage('success','Color updated successfully');
				}
				redirect('admin/attribute/display_list_values');
			}else {
				$this->setErrorMessage('error','Color name already exists');
				echo "<script>window.history.go(-1)</script>";
			}
		}
	}
}

/* End of file attribute.php */
/* Location: ./application/controllers/admin/attribute.php */