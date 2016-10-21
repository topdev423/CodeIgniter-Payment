<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class Layout extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('layout_model');
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
							'text'=>$text);
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
			$text = $this->input->post('text');
			$dataArr = array('text'=>$text);
			$this->data['heading'] = 'Edit Layout List';
			$this->layout_model->update_details(LAYOUT,$dataArr,$condition);
			$this->setErrorMessage('success','Layout Updated successfully');
			redirect('admin/layout/display_layout_list');
		}
	}



	//Change the control options

	public function changecontrol(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->layout_model->commonInsertUpdate(CONTROLMGMT,'update',array('control_tbl_length','control'),array(),array('id'=>1));
			$this->setErrorMessage('success','Controls updated successfully');
			redirect('admin/layout/display_control_list');
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

	public function display_layout_list()
	{

		$this->data['heading'] = 'Text Layouts';
		$condition =array();
		$this->data['layoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);
		//echo $this->$db->last_query(); die;
		$this->load->view('admin/layout/display_layout',$this->data);
	}


	public function display_control_list()
	{


		$this->data['heading'] = 'Control List';
		$this->data['controlList'] = $this->layout_model->view_controller_details();
		//echo $this->$db->last_query(); die;
		//print_r($this->data['controlList']->result()); die;
			
		$this->load->view('admin/layout/display_control',$this->data);
	}

	public function display_theme_layout(){
		$this->data['heading'] = 'Theme Layout';
		$this->data['theme_layout'] = $this->layout_model->get_all_details(THEME_LAYOUT,array());
		$this->load->view('admin/layout/display_theme_layout',$this->data);
	}

	public function editThemeLayout($id=''){
		$this->data['heading'] = 'Edit Theme Layout';
		$condition = array('id'=>$id);
		$this->data['themeDetail'] = $this->layout_model->get_all_details(THEME_LAYOUT,$condition);

		$this->load->view('admin/layout/edit_theme_layout',$this->data);

	}
	
	public function EditThemeLayoutProcess(){
		$excludeArr = array('theme_id');
		$dataArr = array();
		$condArr = array('id'=>$this->input->post('theme_id'));
		$this->layout_model->commonInsertUpdate(THEME_LAYOUT,'update',$excludeArr,$dataArr,$condArr);
		$this->setErrorMessage('success','Theme updated successfully');
		redirect('admin/layout/display_theme_layout');
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

	public function set_default_theme(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->layout_model->update_details(THEME_LAYOUT,array('value'=>''),array());
			$this->setErrorMessage('success','Theme restored to default');
			redirect('admin/layout/display_theme_layout');
		}
	}

}