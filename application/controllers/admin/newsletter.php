<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to newsletter management 
 * @author Teamtweaks
 *
 */

class Newsletter extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('newsletter_model');
		if ($this->checkPrivileges('newsletter',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the subscribers list page
     */
   	public function index(){	
   		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/newsletter/display_subscribers_list');
		}
	}
	
	/**
	 * 
	 * This function loads the subscribers list page
	 */
	public function display_subscribers_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Subscribers List';
			$condition = array();
			$this->data['subscribersList'] = $this->newsletter_model->get_all_details(SUBSCRIBERS_LIST,$condition);
			$this->data['NewsList'] = $this->newsletter_model->get_all_details(NEWSLETTER,$condition);
			
			$this->load->view('admin/newsletter/display_subscribers',$this->data);
		}
	}
	
	/**
	 * 
	 * This function change the subscribers status
	 */
	public function change_subscribers_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->newsletter_model->update_details(SUBSCRIBERS_LIST,$newdata,$condition);
			$this->setErrorMessage('success','Subscribers Status Changed Successfully');
			redirect('admin/newsletter/display_subscribers_list');
		}
	}
	

	/**
	 * 
	 * This function delete the subscribers record from db
	 */
	public function delete_subscribers(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->newsletter_model->commonDelete(SUBSCRIBERS_LIST,$condition);
			$this->setErrorMessage('success','Subscribers deleted successfully');
			redirect('admin/newsletter/display_subscribers_list');
		}
	}
	
	/**
	 * 
	 * This function change the subscribers status, delete the user record
	 */
	public function change_newsletter_status_global(){
	
		if($this->input->post('statusMode')=='SendMail' &&  $this->input->post('mail_contents')!=''){
			if(count($_POST['checkbox_id']) > 0){
					$data =  $_POST['checkbox_id'];
					for ($i=0;$i<count($data);$i++){
						if($data[$i] == 'on'){
							unset($data[$i]);
						}
					}
					
					$SubscribEmail=$this->newsletter_model->send_mail_subcribers($data);
					
					$condition1 = array('id' => $this->input->post('mail_contents'));
					$NewsTemplate= $this->newsletter_model->get_all_details(NEWSLETTER,$condition1);
					
					$this->newsletter_model->send_mail_subcribers_list($SubscribEmail, $NewsTemplate);
					$this->setErrorMessage('success'," Send Mail's successfully");
					redirect('admin/newsletter/display_subscribers_list');
			}else{
					$this->setErrorMessage('error'," Email Not Send");
					redirect('admin/newsletter/display_subscribers_list');
			}
		}else if($this->input->post('statusMode')=='SendMailAll'){
					$conditionval = array();
					$SubscribEmail=$this->newsletter_model->get_newsletter_details(SUBSCRIBERS_LIST,$conditionval);
					$condition1 = array('id' => $this->input->post('mail_contents'));
					$NewsTemplate= $this->newsletter_model->get_all_details(NEWSLETTER,$condition1);
					$this->newsletter_model->send_mail_subcribers_list($SubscribEmail, $NewsTemplate);
					$this->setErrorMessage('success'," Send Mail's successfully");
					redirect('admin/newsletter/display_subscribers_list');
		}else{
			if(count($this->input->post('checkbox_id')) > 0 &&  $this->input->post('statusMode') != ''){
				$this->newsletter_model->activeInactiveCommon(SUBSCRIBERS_LIST,'id');
				if (strtolower($this->input->post('statusMode')) == 'delete'){
					$this->setErrorMessage('success','Subscribers records deleted successfully');
				}else {
					$this->setErrorMessage('success','Subscribers records status changed successfully');
				}
				redirect('admin/newsletter/display_subscribers_list');
			}
		}
	}
	/* End of file subscribers*/
	
	
		/**
	 * 
	 * This function loads the newsletter page
	 */
	public function display_newsletter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Email Template List';
			$condition = array();
			$this->data['subscribersList'] = $this->newsletter_model->get_all_details(NEWSLETTER,$condition);
			$this->load->view('admin/newsletter/display_newsletter',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the newsletter page
	 */
	public function add_newsletter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add Email Template';
			$this->load->view('admin/newsletter/add_newsletter',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_newsletter_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Email Template';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->newsletter_model->get_all_details(NEWSLETTER,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/newsletter/edit_newsletter',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditNewsletter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$demoserverChk){
				$newsletter_id = $this->input->post('newsletter_id');
				$excludeArr = array("newsletter_id","status","news_descrip");
				$newsletter_status = 'Active';
				$dataArr = array();
				$datestring = "%Y-%m-%d";
				$time = time();
				if ($newsletter_id == ''){
					$code = $this->get_rand_str('10');
					$dataArr = array(
						'status' => $newsletter_status,
						'dateAdded'=>mdate($datestring,$time)
						
					);
				}
				
				$news_descripe = str_replace("'.base_url().'", base_url(), $_POST['news_descrip']);
				 //$news_descripe= str_replace(MCEDITER, MCEDITER_REPLY, $news_descrip1);
				
				
				
				if ($newsletter_id == ''){
					$condition = array();
					
					$this->newsletter_model->commonInsertUpdate(NEWSLETTER,'insert',$excludeArr,$dataArr,$condition);
					$news_id=$this->newsletter_model->get_last_insert_id();
					$news_content=$this->newsletter_model->get_all_details(NEWSLETTER,array('id'=>$news_id));
					$news_content_new = str_replace("{","'.",addslashes($news_content->row()->news_descrip));
					$news_descripe = str_replace("}",".'",$news_content_new);
					$config = "<?php \$message .= '";
					$config .= "$news_descripe";
					$config .= "';  ?>";
					$file = 'newsletter/registeration'.$news_id.'.php';
					file_put_contents($file, $config);
					$this->setErrorMessage('success','Newsletter added successfully');
				}else {
					
					$news_content_new = str_replace("'.","{",$_POST['news_descrip']);
					$news_descripe = str_replace(".'","}",$news_content_new);
					$news_descripe = str_replace("adminnewstemplateArr['","",$news_descripe);
					$news_descripe = str_replace("']","",$news_descripe);
					
					$dataArr = array(
						'news_descrip' => $news_descripe
					);
					
					$condition = array('id' => $newsletter_id);
					$this->newsletter_model->commonInsertUpdate(NEWSLETTER,'update',$excludeArr,$dataArr,$condition);
					$news_content=$this->newsletter_model->get_all_details(NEWSLETTER,array('id'=>$newsletter_id));
					$news_content_new = str_replace("{","'.",addslashes($news_content->row()->news_descrip));
					$news_descripe = str_replace("}",".'",$news_content_new);
					$config = "<?php \$message .= '";
					$config .= "$news_descripe";
					$config .= "';  ?>";
					$file = 'newsletter/registeration'.$newsletter_id.'.php';
					file_put_contents($file, $config);
					$this->setErrorMessage('success','Newsletter updated successfully');
				}
				redirect('admin/newsletter/display_newsletter');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/newsletter/display_newsletter');
			}
		}
	}
	
					/**
	 * 
	 * This function loads the user view page
	 */
	public function view_newsletter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Email Template';
			$user_id = $this->uri->segment(4,0);
			$condition = array('id' => $user_id);
			$this->data['user_details'] = $this->newsletter_model->get_all_details(NEWSLETTER,$condition);
			if ($this->data['user_details']->num_rows() == 1){
				$this->load->view('admin/newsletter/view_newsletter',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	/**
	 * 
	 * This function delete the subscribers record from db
	 */
	public function delete_newsletter(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$demoserverChk){
				$user_id = $this->uri->segment(4,0);
				$condition = array('id' => $user_id,'typeVal' => '1');
				$this->newsletter_model->commonDelete(NEWSLETTER,$condition);
				$this->setErrorMessage('success','Email template deleted successfully');
				redirect('admin/newsletter/display_newsletter');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/newsletter/display_newsletter');
			}
		}
	}

}




