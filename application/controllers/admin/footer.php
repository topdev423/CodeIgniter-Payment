<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class Footer extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('footer_model');
		if ($this->checkPrivileges('footer',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	public function add_footer_list(){
		$this->data['heading'] = 'Add New Widget';
		$this->load->view('admin/footer/add_footer',$this->data);
	}

	public function view_footer(){
		$this->data['heading'] = 'View Widget Details';
		$footer_id = $this->uri->segment(4,0);
		$Cond = array("id"=>$footer_id);
		$this->data['DataFooterVal'] = $this->footer_model->get_all_details(FOOTER,$Cond);
		//	print_r($this->datas['DataFooterVal']->result()); die;
		$this->load->view('admin/footer/view_footer',$this->data);
	}





	public function insertEditFooter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['upload_path'] = './images/footer/';
			$this->load->library('upload', $config);
			if ($this->upload->do_multi_upload_footer('widget_icon')){
				$logoDetails = $this->upload->get_multi_upload_data();
				foreach ($logoDetails as $fileDetails){
					if($fileDetails['orig_name'] != '')
					$ImageName .= $fileDetails['file_name'].',';
					else
					$ImageName .= ',';
				}
			}
				
				
			$widget_title = $_POST['widget_title'];
			$widget_name = implode("footsep",$_POST['widget_name']);
			$widget_link = implode("footsep",$this->input->post('widget_link'));
			$dataArr = array('widget_title'=>$widget_title,
								'widget_name'=>$widget_name,
								'widget_link'=>$widget_link,
								'widget_icon'=>$ImageName); 
			$this->footer_model->simple_insert(FOOTER,$dataArr);
			$this->data['heading'] = 'Display Widget';
			$this->setErrorMessage('success','Widget Added successfully');
			redirect('admin/footer/display_footer_list');
		}
	}

	public function EditFooter(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['upload_path'] = './images/footer/';
			$this->load->library('upload', $config);
			if ($this->upload->do_multi_upload_footer('widget_icon')){
				$logoDetails = $this->upload->get_multi_upload_data();
				foreach ($logoDetails as $fileDetails){
					if($fileDetails['orig_name'] != '')
						
						
					$ImageName .= $fileDetails['file_name'].',';
					else
					$ImageName .= ',';
				}
			}
				
				
			$widget_LastImage = implode(",",$this->input->post('widget_icons'));
			
			/*-----------------------------------------------------*/
			
			$old_arr = explode(',', $widget_LastImage);
			$new_arr = explode(',', $ImageName);
			for ($i=0;$i<count($new_arr);$i++){
				if ($new_arr[$i]!=''){
					$old_arr[$i]=$new_arr[$i];
				}
			}
			$widget_LastImageas = implode(',', $old_arr);
			
			/*-----------------------------------------------------*/
			$widget_title = $this->input->post('widget_title');
			$widget_name = implode("footsep",$this->input->post('widget_name'));
			$widget_link = implode("footsep",$this->input->post('widget_link'));

			$footer_id = $this->input->post('footer_id');
			$condition =array('id'=>$footer_id);

			$dataArr = array('widget_title'=>$widget_title,
								'widget_name'=>$widget_name,
								'widget_link'=>$widget_link,
								'widget_icon'=>$widget_LastImageas); 
			$this->data['heading'] = 'Edit Widget List';
			$this->footer_model->update_details(FOOTER,$dataArr,$condition);
			$this->setErrorMessage('success','Widget Updated successfully');
			redirect('admin/footer/display_footer_list');
		}
	}

		
	public function EditviewLayout($id=''){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$id = $this->uri->segment(4,0);
			$this->data['heading'] = 'Edit Widget';

			$condition = array('id'=>$id);
			$this->data['EditfooterList'] = $this->footer_model->get_all_details(FOOTER,$condition);
			$this->load->view('admin/footer/edit_footer',$this->data);
				
		}
	}

	public function display_footer_list()
	{

		$this->data['heading'] = 'Display Widget';
		$this->data['footerList'] = $this->footer_model->get_all_details(FOOTER,$condition);
		$this->load->view('admin/footer/display_footer',$this->data);
	}


	public function change_footer_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$footer_id = $this->uri->segment(5,0);
			
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $footer_id);
			$this->footer_model->update_details(FOOTER,$newdata,$condition);
			$this->setErrorMessage('success','Widget '.$status.' Successfully');
			redirect('admin/footer/display_footer_list');
		}
	}

	public function delete_footer_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$delete_footer_list_id = $this->uri->segment(4,0);
			$condition = array('id' => $delete_footer_list_id);
			if($condition!='')
			{
				$this->footer_model->commonDelete(FOOTER,$condition);
			}
			$this->setErrorMessage('success','Widget deleted successfully');
			redirect('admin/footer/display_footer_list');
		}
	}
	
	public function change_footer_status_global(){
	
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
			$this->footer_model->activeInactiveCommon(FOOTER,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','Footer widget deleted successfully');
			}else {
				$this->setErrorMessage('success','Footer widget changed successfully');
			}
			redirect('admin/footer/display_footer_list');
		}
	}


}