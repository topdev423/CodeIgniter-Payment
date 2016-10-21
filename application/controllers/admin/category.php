<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Category management
 * @author Teamtweaks
 *
 */

class Category extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('category_model');
		if ($this->checkPrivileges('category',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}

	/**
	 *
	 * This function loads the category list page
	 */
	public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/category/display_category_list');
		}
	}

	/**
	 *
	 * This function loads the category list page
	 */
	public function display_category_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Category List';
			$this->data['categoryView'] = $this->category_model->view_category_details();
			$this->load->view('admin/category/display_category_list',$this->data);
		}
	}

	/**
	 *
	 * This function loads the add new category form
	 */
	public function add_category_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Category';
			$this->data['Category_id'] = $this->uri->segment(4,0);
			$this->load->view('admin/category/add_category',$this->data);
		}
	}
	/**
	 *
	 * This function insert category
	 */
	public function insertCategory(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cat_id = $this->input->post('cat_id');
			$category_name = $this->input->post('category_name');

			$condition = array('cat_name' => $category_name,'rootID'=>$cat_id);
			$duplicate_name = $this->category_model->get_all_details(CATEGORY,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Category name already exists');
				redirect('admin/category/add_category_form/'.$cat_id);
			}

			$excludeArr = array("status");
				
			if ($this->input->post('status') != ''){
				$category_status = 'Active';
			}else {
				$category_status = 'Inactive';
			}
				
			$seourlBase = $seourl = url_title($category_name, '-', TRUE);
			$seourl_check = '0';
			$duplicate_url = $this->category_model->get_all_details(CATEGORY,array('seourl'=>$seourl));
			if ($duplicate_url->num_rows()>0){
				$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
			}else {
				$seourl_check = '1';
			}
			$urlCount = $duplicate_url->num_rows();
			while ($seourl_check == '0'){
				$urlCount++;
				$duplicate_url = $this->category_model->get_all_details(CATEGORY,array('seourl'=>$seourl));
				if ($duplicate_url->num_rows()>0){
					$seourl = $seourlBase.'-'.$urlCount;
				}else {
					$seourl_check = '1';
				}
			}
			$seo_title = $this->input->post('meta_title');
			$seo_keyword = $this->input->post('meta_keyword');
			$seo_description = $this->input->post('meta_description');
				
			$inputArr = array(
						'cat_name' => $category_name,
						'seourl' => $seourl,
						'rootID' => $cat_id,
						'seo_title' => $seo_title,
						'seo_keyword' => $seo_keyword,
						'seo_description' => $seo_description,
						'status' => $category_status
			);
				
				
			if($this->input->post('category_image') !=''){
					
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/category';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('category_image')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('admin/category/add_category_form/'.$cat_id);
				}
				$category_data = array( 'image' => $ImageName);
			}else{
				$category_data = array();
			}

			$dataArr = array_merge($inputArr,$category_data);

			$this->category_model->add_category($dataArr);
			$this->setErrorMessage('success','category added successfully');
			redirect('admin/category/display_category_list');
		}
	}



	/**
	 *
	 * This function Edit category
	 */
	public function EditCategory(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {


			$category_id = $this->input->post('category_id');
			$category_name = $this->input->post('category_name');
				
			$condition = array('id' => $category_id);

			$excludeArr = array("status");
				
			if ($this->input->post('status') != ''){
				$category_status = 'Active';
			}else {
				$category_status = 'Inactive';
			}
				

				
			$seourl = url_title($category_name, '-', TRUE);
			$seo_title = $this->input->post('meta_title');
			$seo_keyword = $this->input->post('meta_keyword');
			$seo_description = $this->input->post('meta_description');
				
			$inputArr = array(
						'cat_name' => $category_name,
			//						'seourl' => $seourl,
						'seo_title' => $seo_title,
						'seo_keyword' => $seo_keyword,
						'seo_description' => $seo_description,
						'status' => $category_status
			);
				
			$category_data = array();
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/category/';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('category_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
				$category_data = array( 'image' => $ImageName);
			}


			$dataArr = array_merge($inputArr,$category_data);


			//echo '<pre>'; print_r($dataArr); die;
				
			$this->category_model->edit_category($dataArr,$condition);
			$this->setErrorMessage('success','category Updated successfully');
			redirect('admin/category/display_category_list');
		}
	}

	/**
	 *
	 * This function loads the edit category form
	 */
	public function edit_category_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Category';
			$category_id = $this->uri->segment(4,0);
			$condition = array('id' => $category_id);
			$this->data['category_details'] = $this->category_model->view_category($condition);
			if ($this->data['category_details']->num_rows() == 1){
				$this->load->view('admin/category/edit_category',$this->data);
			}else {
				redirect('admin');
			}
		}
	}

	/**
	 *
	 * This function change the category status
	 */
	public function change_category_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$category_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $category_id);
			$this->category_model->update_details(CATEGORY,$newdata,$condition);
			$this->setErrorMessage('success','Category Status Changed Successfully');
			redirect('admin/category/display_category_list');
		}
	}

	/**
	 *
	 * This function loads the category view page
	 */
	public function view_category(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Category';
			$category_id = $this->uri->segment(4,0);
			$condition = array('id' => $category_id);
			$this->data['category_details'] = $this->category_model->get_all_details(CATEGORY,$condition);
			if ($this->data['category_details']->num_rows() == 1){
				$this->load->view('admin/category/view_category',$this->data);
			}else {
				redirect('admin');
			}
		}
	}

	/**
	 *
	 * This function delete the category record from db
	 */
	public function delete_category(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$category_id = $this->uri->segment(4,0);
			$condition = array('id' => $category_id);
			$this->category_model->commonDelete(CATEGORY,$condition);
			$this->setErrorMessage('success','Category deleted successfully');
			redirect('admin/category/display_category_list');
		}
	}

	/**
	 *
	 * This function change the category status, delete the category record
	 */
	public function change_category_status_global(){

		if($_POST['checkboxID']!=''){

			if($_POST['checkboxID']=='0'){
				redirect('admin/category/add_category_form/0');
			}else{
				redirect('admin/category/add_category_form/'.$_POST['checkboxID']);
			}

		}else{
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$this->category_model->activeInactiveCommon(CATEGORY,'id');
				if (strtolower($_POST['statusMode']) == 'delete'){
					$this->setErrorMessage('success','Category records deleted successfully');
				}else {
					$this->setErrorMessage('success','Category records status changed successfully');
				}
				redirect('admin/category/display_category_list');
			}
		}
	}

	public function changePosition(){
		if ($this->checkLogin('A') != ''){
			$catID = $this->input->post('catID');
			$pos = $this->input->post('pos');
			$this->category_model->update_details(CATEGORY,array('cat_position'=>$pos),array('id'=>$catID));
		}
	}

	public function display_banner_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Banner List';
			$condition = array();
			$this->data['bannerList'] = $this->category_model->get_all_details(BANNER_CATEGORY,$condition);
			$this->load->view('admin/category/display_banner_list',$this->data);
		}
	}

	public function add_banner_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Banner';
			$this->load->view('admin/category/add_banner',$this->data);
		}
	}

	public function insertBanner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$excludeArr = array("status","banner_image");
				
			if ($this->input->post('status') != ''){
				$banner_status = 'Publish';
			}else {
				$banner_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $banner_status
			);
				
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/category/banner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
			}else{
				$logoDetails = $this->upload->display_errors();
				$this->setErrorMessage('error',strip_tags($logoDetails));
				redirect('admin/category/add_banner_form');
			}
			$category_data = array( 'image' => $ImageName);

			$dataArr = array_merge($inputArr,$category_data);

			$this->category_model->commonInsertUpdate(BANNER_CATEGORY,'insert',$excludeArr,$dataArr);
			$this->setErrorMessage('success','Banner added successfully');
			redirect('admin/category/display_banner_list');
		}
	}

	public function change_banner_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$category_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $category_id);
			$this->category_model->update_details(BANNER_CATEGORY,$newdata,$condition);
			$this->setErrorMessage('success','Banner Status Changed Successfully');
			redirect('admin/category/display_banner_list');
		}
	}

	public function change_banner_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->category_model->activeInactiveCommon(BANNER_CATEGORY,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Banner records deleted successfully');
			}else {
				$this->setErrorMessage('success','Banner records status changed successfully');
			}
			redirect('admin/category/display_banner_list');
		}
	}

	public function delete_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$category_id = $this->uri->segment(4,0);
			$condition = array('id' => $category_id);
			$this->category_model->commonDelete(BANNER_CATEGORY,$condition);
			$this->setErrorMessage('success','Banner deleted successfully');
			redirect('admin/category/display_banner_list');
		}
	}

	public function edit_banner_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Banner';
			$category_id = $this->uri->segment(4,0);
			$condition = array('id' => $category_id);
			$this->data['banner_details'] = $this->category_model->get_all_details(BANNER_CATEGORY,array('id'=>$category_id));
			if ($this->data['banner_details']->num_rows() == 1){
				$this->load->view('admin/category/edit_banner',$this->data);
			}else {
				redirect('admin');
			}
		}
	}

	public function editBanner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$bid = $this->input->post('banner_id');
			$excludeArr = array("status","banner_image","banner_id");
				
			if ($this->input->post('status') != ''){
				$banner_status = 'Publish';
			}else {
				$banner_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $banner_status
			);
				
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/category/banner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
				$category_data = array( 'image' => $ImageName);
			}else{
				$category_data = array();
			}

			$dataArr = array_merge($inputArr,$category_data);
			$condition = array('id'=>$bid);
			$this->category_model->commonInsertUpdate(BANNER_CATEGORY,'update',$excludeArr,$dataArr,$condition);
			$this->setErrorMessage('success','Banner updated successfully');
			redirect('admin/category/display_banner_list');
		}
	}
}

/* End of file category.php */
/* Location: ./application/controllers/admin/category.php */