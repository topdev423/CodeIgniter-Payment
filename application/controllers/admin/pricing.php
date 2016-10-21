<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class Pricing extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('pricing_model');
		if ($this->checkPrivileges('pricerange',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	public function add_pricing(){
		$this->data['heading'] = 'Add Price Range';
		$this->load->view('admin/pricing/add_pricing',$this->data);
	}

	public function insertEditPricing(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$pricing_from = $this->input->post('price_from');
			$pricing_to = $this->input->post('price_to');

			if($pricing_from < $pricing_to){
				$dataArr = array('pricing_from'=>$pricing_from,
							'pricing_to'=>$pricing_to,
							'price_range'=>$pricing_from.' - '.$pricing_to,
							'status'=>'Active');
				$this->pricing_model->simple_insert(PRICING,$dataArr);
				$this->data['priceList'] = $this->pricing_model->get_all_details(PRICING,$condition);
				$this->setErrorMessage('success','Price Range Added Successfully');
				redirect('admin/pricing/display_pricing');
			}else{
				$this->setErrorMessage('error','Price Range Invalid');
				redirect('admin/pricing/add_pricing');
			}
		}
	}



	public function EditPricing(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$price_id = $this->input->post('price_id');
			$condition =array('id'=>$price_id);
			$pricing_from = $this->input->post('price_from');
			$pricing_to = $this->input->post('price_to');
			if($pricing_from<$pricing_to){
				$dataArr = array('pricing_from'=>$pricing_from,
							'pricing_to'=>$pricing_to,
							'price_range'=>$pricing_from.' - '.$pricing_to);
				$this->data['heading'] = 'Edit Price List';
				$this->product_model->update_details(PRICING,$dataArr,$condition);
				$this->setErrorMessage('success','Price Updated successfully');
				redirect('admin/pricing/display_pricing');
			}else{
					
				$this->setErrorMessage('error','Price Range Invalid');
				redirect('admin/pricing/EditviewPricing/'.$price_id.'');
					
			}
		}
	}

	public function EditviewPricing($id=''){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Price Range';

			$condition = array('id'=>$id);
			$this->data['EditpriceList'] = $this->pricing_model->get_all_details(PRICING,$condition);

			$this->load->view('admin/pricing/edit_pricing',$this->data);

		}
	}

	public function display_pricing()
	{

		$this->data['heading'] = 'Price Range List';
		$this->data['priceList'] = $this->pricing_model->get_all_details(PRICING,$condition);
		$this->load->view('admin/pricing/display_pricing',$this->data);
	}


	public function change_pricing_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$pricing_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $pricing_id);
			$this->pricing_model->update_details(PRICING,$newdata,$condition);
			$this->setErrorMessage('success','Price Range '.$status.' Successfully');
			redirect('admin/pricing/display_pricing');
		}
	}

	public function delete_pricing_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$delete_pricing_list_id = $this->uri->segment(4,0);
			$condition = array('id' => $delete_pricing_list_id);
			if($condition!='')
			{
				$this->product_model->commonDelete(PRICING,$condition);
			}
			$this->setErrorMessage('success','Price Range Deleted Successfully');
			redirect('admin/pricing/display_pricing');
		}
	}

	public function change_pricing_status_global(){
		if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
			$this->product_model->activeInactiveCommon(PRICING,'id');
			if (strtolower($this->input->post('statusMode')) == 'delete'){
				$this->setErrorMessage('success','Price range records deleted successfully');
			}else {
				$this->setErrorMessage('success','Price range records status changed successfully');
			}
			redirect('admin/pricing/display_pricing');
		}
	}

}