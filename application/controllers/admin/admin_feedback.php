<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to user management
 * @author Teamtweaks
 *
 */

class Admin_feedback extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('user_model','seller_model','product_model'));

		if ($this->checkPrivileges('user',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}

	/**
	 *
	 * This function loads the users list page
	 */
	public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
	public function display_product_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Product Feedback';
			$condition = array();
			$this->data['productFeedbackLists'] = $this->product_model->get_product_details();
			$this->load->view('admin/feedback/display_product_feedback',$this->data);
		}
	}

	public function display_shop_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Feedback';
			$condition = array();
			$this->data['shopFeedbackLists'] = $this->seller_model->get_shop_details();
				
			$this->load->view('admin/feedback/display_shop_feedback',$this->data);
		}
	}


	public function view_product_feedback($id='')
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');

		}else {

			$condition = $id;
			$this->data['heading'] = 'View Product Feedback';
			$this->data['GetproductFeedbackLists'] = $this->product_model->get_productfeed_details($condition);
			$this->load->view('admin/feedback/view_product_feedback',$this->data);
		}


	}

	public function view_shop_feedback($id=''){

		if ($this->checkLogin('A') == ''){
			redirect('admin');

		}else {

			$condition = $id;
			$this->data['heading'] = 'View Shop Feedback';
			$this->data['GetproductFeedbackLists'] = $this->seller_model->get_shopfeed_details($condition);
			$this->load->view('admin/feedback/view_shop_feedback',$this->data);
		}
	}


	public function delete_product_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_feedback_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_feedback_id);
			if($condition!='')
			{
				$this->product_model->commonDelete(PRODUCT_FEEDBACK,$condition);
			}
			$this->setErrorMessage('success','Product feedback deleted successfully');
			redirect('admin/admin_feedback/display_product_feedback');
		}
	}

	public function delete_shop_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$shop_feedback_id = $this->uri->segment(4,0);
			$condition = array('id' => $shop_feedback_id);
			if($condition!='')
			{
				$this->seller_model->commonDelete(FEEDBACK,$condition);
			}
			$this->setErrorMessage('success','Product feedback deleted successfully');
			redirect('admin/admin_feedback/display_shop_feedback');
		}
	}

	public function change_product_feedback_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_feedback_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $product_feedback_id);
			$this->user_model->update_details(PRODUCT_FEEDBACK,$newdata,$condition);
			if ($status=='Active'){
				$this->send_review_noty_mail($product_feedback_id);
			}
			$this->setErrorMessage('success','Product feedback Status '.$status.' Successfully');
			redirect('admin/admin_feedback/display_product_feedback');
		}
	}

	public function change_review_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->user_model->activeInactiveCommon(PRODUCT_FEEDBACK,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Review records deleted successfully');
			}else {
				$this->setErrorMessage('success','Review records status changed successfully');
			}
			redirect('admin/admin_feedback/display_product_feedback');
		}
	}

	public function send_review_noty_mail($fid='0'){
		if ($fid>0){
			$feedback_details = $this->product_model->get_productfeed_details($fid);
			$feedback_details_arr = $feedback_details->result_array();
			extract($feedback_details_arr[0]);
			$newsid='20';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'));
			extract($adminnewstemplateArr);
			$subject = $template_values['news_subject'];
			$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title><body>';
			include('./newsletter/registeration'.$newsid.'.php');

			$message .= '</body>
			</html>';


			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				$sender_email=$template_values['sender_email'];
			}

			$email_values = array('mail_type'=>'html',
                                    'from_mail_id'=>$sender_email,
                                    'mail_name'=>$sender_name,
									'to_mail_id'=>$seller_email,
									'subject_message'=>$subject,
									'body_messages'=>$message
			);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */