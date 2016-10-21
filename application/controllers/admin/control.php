<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class ControlMgmt extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('control_model');
		if ($this->checkPrivileges('product',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	public function add_layout_list(){
		$this->data['heading'] = 'Add Text Layout';
		$this->load->view('admin/layout/add_layout',$this->data);
	}

	public function insertEditLayout(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$this->data['heading'] = 'Display Text Layout';
			$place = $this->input->post('place');
			$text = $this->input->post('text');
				
			$dataArr = array('place'=>$place,
							'place'=>$text,
							'status'=>'InActive');
			$this->layout_model->simple_insert(LAYOUT,$dataArr);
			$this->data['layoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);
			$this->setErrorMessage('success','Layout Added successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

	public function EditLayout(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$layout_id = $this->input->post('layout_id');
			$condition =array('id'=>$layout_id);
			$place = $this->input->post('place');
			$text = $this->input->post('text');
			$dataArr = array('place'=>$place,
							'place'=>$text);
			$this->data['heading'] = 'Edit Layout List';
			$this->layout_model->update_details(LAYOUT,$dataArr,$condition);
			$this->setErrorMessage('success','Layout Updated successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

		
	public function EditviewLayout($id=''){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Text Layout';

			$condition = array('id'=>$id);
			$this->data['EditlayoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);

			$this->load->view('admin/layout/edit_layout',$this->data);
				
		}
	}

	public function display_control_list()
	{
		$this->data['heading'] = 'Display Control Management';
		$this->data['controlList'] = $this->control_model->get_all_details(CONTROLMGMT,$condition);
		$this->load->view('admin/control/display_control',$this->data);
	}


	public function change_layout_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$layout_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $layout_id);
			$this->layout_model->update_details(LAYOUT,$newdata,$condition);
			$this->setErrorMessage('success','layout '.$status.' Successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

	public function delete_layout_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$delete_layout_list_id = $this->uri->segment(4,0);
			$condition = array('id' => $delete_layout_list_id);
			if($condition!='')
			{
				$this->layout_model->commonDelete(LAYOUT,$condition);
			}
			$this->setErrorMessage('success','Layout deleted successfully');
			redirect('admin/layout/display_layout_list');
		}
	}


}