<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */
class User extends MY_Controller {

	function __construct(){
		//echo "<pre>";print_r($_REQUEST);echo "</pre>";// die;
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->library('twconnect');
		$this->load->model(array('user_model','product_model'));
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->user_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
			//$this->data['likedProducts'] = $this->user_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
            
            
             // getting the products which are rated by the current user.
            $ratedProducts = $this->product_model->get_user_product_ratings($this->checkLogin('U'));
            
            $userRatedProducts = array();
            if($ratedProducts && count($ratedProducts)>0){
                foreach($ratedProducts as $ratedProduct){ //print_r($ratedProduct); die;
                    $userRatedProducts[$ratedProduct["product_id"]] = $ratedProduct["rating"];
                }
            }
            $this->data['ratedProducts'] = $userRatedProducts; 
		}
	}

	/**
	 *
	 * Function for quick signup
	 */
	public function quickSignup(){
		$email = $this->input->post('email');
		$returnStr['success'] = '0';
		if (valid_email($email)){
			$condition = array('email'=>$email);
			$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateMail->num_rows()>0){
				$returnStr['msg'] = 'Email id already exists';
			}else {
				$fullname = substr($email, 0,strpos($email, '@'));
				$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$fullname));
				if ($checkAvail->num_rows()>0){
					$avail = FALSE;
				}else {
					$avail = TRUE;
					$username = $fullname;
				}
				while (!$avail){
					$username = $fullname.rand(1111, 999999);
					$checkAvail = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
					if ($checkAvail->num_rows()>0){
						$avail = FALSE;
					}else {
						$avail = TRUE;
					}
				}
				if ($avail){
					$pwd = $this->get_rand_str('6');
					$this->user_model->insertUserQuick($fullname,$username,$email,$pwd);
					$this->session->set_userdata('quick_user_name',$username);
					$returnStr['msg'] = 'Successfully registered';
					$returnStr['full_name'] = $fullname;
					$returnStr['user_name'] = $username;
					$returnStr['password'] = $pwd;
					$returnStr['email'] = $email;
					$returnStr['success'] = '1';
				}
			}
		}else {
			$returnStr['msg'] = "Invalid email id";
		}
		echo json_encode($returnStr);
	}

	/**
	 *
	 * Function for quick signup update
	 */
	public function quickSignupUpdate(){
		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		$username = $this->input->post('username');
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid. Only alphanumeric allowed';
		}elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			$email = $this->input->post('email');
			$condition = array('user_name'=>$username,'email !='=>$email);
			$duplicateName = $this->user_model->get_all_details(USERS,$condition);
			if ($duplicateName->num_rows()>0){
				$returnStr['msg'] = 'Username already exists';
			}else {
				$pwd = $this->input->post('password');
				$fullname = $this->input->post('fullname');
				$this->user_model->updateUserQuick($fullname,$username,$email,$pwd);
				$this->session->set_userdata('quick_user_name',$username);
				$returnStr['msg'] = 'Successfully registered';
				$returnStr['success'] = '1';
			}
		}
		echo json_encode($returnStr);
	}

	public function send_quick_register_mail(){
		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {
			$quick_user_name = $this->session->userdata('quick_user_name');
			if ($quick_user_name == ''){
				redirect(base_url());
			}else {
				$condition = array('user_name'=>$quick_user_name);
				$userDetails = $this->user_model->get_all_details(USERS,$condition);
				if ($userDetails->num_rows() == 1){
					$this->send_confirm_mail($userDetails);
					$this->login_after_signup($userDetails);
					$this->session->set_userdata('quick_user_name','');
					if ($userDetails->row()->is_brand == 'yes'){
						redirect(base_url().'create-brand');
					}else {
						redirect(base_url().'onboarding');
					}
				}else {
					redirect(base_url());
				}
			}
		}
	}

	public function registerUser(){
		$returnStr['success'] = '0';
		$unameArr = $this->config->item('unameArr');
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		if (!preg_match('/^\w{1,}$/', trim($username))){
			$returnStr['msg'] = 'User name not valid. Only alphanumeric allowed';
		}elseif (in_array($username, $unameArr)){
			$returnStr['msg'] = 'User name already exists';
		}else {
			$email = $this->input->post('email');
			$pwd = $this->input->post('pwd');
			$brand = $this->input->post('brand');
			if (valid_email($email)){
				$condition = array('user_name'=>$username);
				$duplicateName = $this->user_model->get_all_details(USERS,$condition);
				if ($duplicateName->num_rows()>0){
					$returnStr['msg'] = 'User name already exists';
				}else {
					$condition = array('email'=>$email);
					$duplicateMail = $this->user_model->get_all_details(USERS,$condition);
					if ($duplicateMail->num_rows()>0){
						$returnStr['msg'] = 'Email id already exists';
					}else {
						$this->user_model->insertUserQuick($fullname,$username,$email,$pwd,$brand);
						$this->session->set_userdata('quick_user_name',$username);
						$returnStr['msg'] = 'Successfully registered';
						$returnStr['success'] = '1';
					}
				}
			}else {
				$returnStr['msg'] = "Invalid email id";
			}
		}
		echo json_encode($returnStr);
	}

	public function resend_confirm_mail(){
		$mail = $this->input->post('mail');
		if ($mail == ''){
			echo '0';
		}else {
			$condition = array('email'=>$mail);
			$userDetails = $this->user_model->get_all_details(USERS,$condition);
			$this->send_confirm_mail($userDetails);
			echo '1';
		}
	}

	public function send_email_confirmation(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$this->send_confirm_mail($this->data['userDetails']);
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function send_confirm_mail($userDetails=''){
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		$newsid='3';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);

		$cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
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
							'to_mail_id'=>$email,
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message,
							'mail_id'=>'register mail'
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
	}

	public function signup_form(){
		if ($this->checkLogin('U') != ''){
			redirect(base_url());
		}else {
			$this->data['heading'] = 'Sign up';
			$this->load->view('site/user/signup.php',$this->data);
		}
	}

	/**
	 *
	 * Loading login page
	 */
	public function login_form(){
		if ($this->checkLogin('U')!=''){
			redirect(base_url());
		}else {
			$this->data['next'] = $this->input->get('next');
			//echo $this->data['next'];die;
			$this->data['heading'] = 'Sign in';
			$this->load->view('site/user/login.php',$this->data);
		}
	}

	public function login_user(){
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$next = $this->input->post('next');
		if ($this->form_validation->run() === FALSE)
		{
			if($this->lang->line('email_pwd_req') != '')
			$lg_err_msg = $this->lang->line('email_pwd_req');
			else
			$lg_err_msg = 'Email and password fields required';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect('login?next='.urlencode($next));
		}else {
			$email = $this->input->post('email');
			$pwd = md5($this->input->post('password'));
			$condition = array('email'=>$email,'password'=>$pwd,'status'=>'Active');
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == '1'){
				$userdata = array(
								'fc_session_user_id' => $checkUser->row()->id,
								'session_user_name' => $checkUser->row()->user_name,
								'session_user_email' => $checkUser->row()->email
				);
				//				echo "<pre>";print_r($userdata);
				$this->session->set_userdata($userdata);
				//				echo $this->session->userdata('fc_session_user_id');die;
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$newdata = array(
	               'last_login_date' => mdate($datestring,$time),
	               'last_login_ip' => $this->input->ip_address()
				);
				$condition = array('id' => $checkUser->row()->id);
				$this->user_model->update_details(USERS,$newdata,$condition);

				$this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$checkUser->row()->id);

				if($this->data['login_succ_msg'] != '')
				$lg_err_msg = $this->data['login_succ_msg'];
				else
				$lg_err_msg = 'You are Logged In ...';
				$this->setErrorMessage('success',$lg_err_msg);
				//				$this->session->set_flashdata('loadAfterLog', '1');
				if ($next=='close'){
					echo "
					<script>
					window.close();
					</script>
					";
				}else {
					redirect($next);
				}
			}else {
				if($this->lang->line('inval_log_det') != '')
				$lg_err_msg = $this->lang->line('inval_log_det');
				else
				$lg_err_msg = 'Invalid login details';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect('login?next='.urlencode($next));
			}
		}
	}

	public function login_after_signup($userDetails=''){
		if ($userDetails->num_rows() == '1'){
			$userdata = array(
							'fc_session_user_id' => $userDetails->row()->id,
							'session_user_name' => $userDetails->row()->user_name,
							'session_user_email' => $userDetails->row()->email
			);
			$this->session->set_userdata($userdata);
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$newdata = array(
               'last_login_date' => mdate($datestring,$time),
               'last_login_ip' => $this->input->ip_address()
			);
			$condition = array('id' => $userDetails->row()->id);
			$this->user_model->update_details(USERS,$newdata,$condition);

			$this->user_model->updategiftcard(GIFTCARDS_TEMP,$this->checkLogin('T'),$userDetails->row()->id);


		}else {
			redirect(base_url());
		}
	}

	public function confirm_register(){
		$uid = $this->uri->segment(4,0);
		$code = $this->uri->segment(5,0);
		$mode = $this->uri->segment(6,0);
		if($mode=='confirmation'){
			$condition = array('verify_code'=>$code,'id'=>$uid);
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){
				$conditionArr = array('id'=>$uid,'verify_code'=>$code);
				$dataArr = array('is_verified'=>'Yes');
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$subscribeCheck = $this->user_model->get_all_details(SUBSCRIBERS_LIST,array('subscrip_mail'=>$checkUser->row()->email));
				if ($subscribeCheck->num_rows() == 0){
					$this->user_model->simple_insert(SUBSCRIBERS_LIST,array('subscrip_mail'=>$checkUser->row()->email,'status'=>'Active'));
				}
				if($this->lang->line('mail_veri_succc') != '')
				$lg_err_msg = $this->lang->line('mail_veri_succc');
				else
				$lg_err_msg = 'Great going ! Your mail ID has been verified';
				$this->setErrorMessage('success',$lg_err_msg);
				$this->login_after_signup($checkUser);
				redirect(base_url());
			}else {
				if($this->lang->line('inval_conf_link') != '')
				$lg_err_msg = $this->lang->line('inval_conf_link');
				else
				$lg_err_msg = 'Invalid confirmation link';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());
			}
		}else {
			if($this->lang->line('inval_conf_link') != '')
			$lg_err_msg = $this->lang->line('inval_conf_link');
			else
			$lg_err_msg = 'Invalid confirmation link';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect(base_url());
		}
	}

	public function logout_user(){
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$newdata = array(
               'last_logout_date' => mdate($datestring,$time)
		);
		$condition = array('id' => $this->checkLogin('U'));
		$this->user_model->update_details(USERS,$newdata,$condition);
		$userdata = array(
						'fc_session_user_id'=>'',
						'session_user_name'=>'',
						'session_user_email'=>'',
						'fc_session_temp_id'=>''
						);
						$this->session->unset_userdata($userdata);

						@session_start();
						unset($_SESSION['token']);
						$twitter_return_values = array('tw_status'=>'',
										'tw_access_token'=>''
										);

										$this->session->unset_userdata($twitter_return_values);
										if($this->lang->line('logout_succ') != '')
										$lg_err_msg = $this->lang->line('logout_succ');
										else
										$lg_err_msg = 'Successfully logged out from your account';
										$this->setErrorMessage('success',$lg_err_msg);
										redirect(base_url());
	}

	public function forgot_password_form(){
		$this->data['heading'] = 'Forgot Password';
		$this->load->view('site/user/forgot_password.php',$this->data);
	}

	public function forgot_password_user(){
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			if($this->lang->line('email_requ') != '')
			$lg_err_msg = $this->lang->line('email_requ');
			else
			$lg_err_msg = 'Email address required';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect('forgot-password');
		}else {
			$email = $this->input->post('email');
			if (valid_email($email)){
				$condition = array('email'=>$email);
				$checkUser = $this->user_model->get_all_details(USERS,$condition);
				if ($checkUser->num_rows() == '1'){
					$pwd = $this->get_rand_str('6');
					$newdata = array('password' => md5($pwd));
					$condition = array('email' => $email);
					$this->user_model->update_details(USERS,$newdata,$condition);
					$this->send_user_password($pwd,$checkUser);
					if($this->lang->line('pwd_sen_mail') != '')
					$lg_err_msg = $this->lang->line('pwd_sen_mail');
					else
					$lg_err_msg = 'New password sent to your mail';
					$this->setErrorMessage('success',$lg_err_msg);
					redirect('login');
				}else {
					if($this->lang->line('mail_not_record') != '')
					$lg_err_msg = $this->lang->line('mail_not_record');
					else
					$lg_err_msg = 'Your email id not matched in our records';
					$this->setErrorMessage('error',$lg_err_msg);
					redirect('forgot-password');
				}
			}else {
				if($this->lang->line('mail_not_valid') != '')
				$lg_err_msg = $this->lang->line('mail_not_valid');
				else
				$lg_err_msg = 'Email id not valid';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect('forgot-password');
			}
		}
	}

	public function send_user_password($pwd='',$query){
		$newsid='5';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');

		$message .= '</body>
			</html>';
			

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message,
							'mail_id'=>'forgot'
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);

							/*		echo $this->email->print_debugger();die;
							 */
	}

	public function add_fancy_item(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 0){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows() == 0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$dataArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'),'ip'=>$this->input->ip_address());
					$this->user_model->simple_insert(PRODUCT_LIKES,$dataArr);
					$actArr = array(
						'activity_name'	=>	'fancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$datestring = "%Y-%m-%d %h:%i:%s";
					$time = time();
					$createdTime = mdate($datestring,$time);
					$actArr = array(
						'activity'		=>	'like',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address(),
						'created'		=>	$createdTime
					);
					$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
					$likes++;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes++;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					/*************Send Message to TWITTER*************/
					if($this->data['userDetails']->row()->twitter_id!=''){
					     $TwitterId = $this->data['userDetails']->row()->twitter_id;
						 if($productDetails->row()->image!=''){
							$image = base_url()."images/product/".$productDetails->row()->image;
						 }else{
						   $image = base_url()."images/product/no_image.gif";
						 }
						 $short_url = $this->user_model->get_all_details(SHORTURL,array('id'=>$productDetails->row()->short_url_id));
						 if($short_url->num_rows() ==1){
						   $url = base_url().'t/'.$short_url->row()->id;
						 }
						    include_once './twittercard/twitter-card.php';
							$card = new Twitter_Card();
							$card->setURL( 'http://www.nytimes.com/2012/02/19/arts/music/amid-police-presence-fans-congregate-for-whitney-houstons-funeral-in-newark.html' );
							$card->setTitle( 'Parade of Fans for Houston\'s Funeral' );
							$card->setDescription( 'NEWARK - The guest list and parade of limousines with celebrities emerging from them seemed more suited to a red carpet event in Hollywood or New York than than a gritty stretch of Sussex Avenue near the former site of the James M. Baxter Terrace public housing project here.' );
							$card->setImage( 'http://graphics8.nytimes.com/images/2012/02/19/us/19whitney-span/19whitney-span-articleLarge.jpg', 600, 330 );
	                        $send_tweets = $this->twconnect->tw_post('https://api.twitter.com/1.1/statuses/update.json',$card->asHTML());
						    print_r($send_tweets);
						
					 }
					 /*************************END*********************/
					 
					 //die;
					
					/*
					 * -------------------------------------------------------
					 * Creating list automatically when user likes a product
					 * -------------------------------------------------------
					 *
					 $listCheck = $this->user_model->get_list_details($tid,$this->checkLogin('U'));
					 if ($listCheck->num_rows() == 0){
						$productCategoriesArr = explode(',', $productDetails->row()->category_id);
						if (count($productCategoriesArr)>0){
						foreach ($productCategoriesArr as $productCategoriesRow){
						if ($productCategoriesRow != ''){
						$productCategory = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCategoriesRow));
						if ($productCategory->num_rows()==1){

						}
						}
						}
						}
						}
						*/
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function remove_fancy_item(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 1){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows()==0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$conditionArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'));
					$this->user_model->commonDelete(PRODUCT_LIKES,$conditionArr);
					$actArr = array(
						'activity_name'	=>	'unfancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$likes--;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes--;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function display_user_profile(){
		$username =  urldecode($this->uri->segment(2,0));


		if ($username == 'administrator'){
			$this->data['heading'] = $username;
			$this->load->view('site/user/display_admin_profile');
		}else {
			$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username,'status'=>'Active'));
			
			if ($userProfileDetails->num_rows()==1){
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name;
				}else {
					$this->data['heading'] = $username;
				}
				if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
					$this->load->view('site/user/display_user_profile_private',$this->data);
				}else {
					$this->data['productLikeDetails'] = $this->user_model->get_like_details_fully($userProfileDetails->row()->id);
					$this->data['userProductLikeDetails'] = $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id);
					$this->data['userProfileDetails'] = $userProfileDetails;
					$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
					$this->data['featureProductDetails'] = $this->product_model->get_featured_details($userProfileDetails->row()->feature_product);
					$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
					$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);

					$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
					$productIds = '';
					if (count($productIdsArr)>0){
						foreach ($productIdsArr as $pidRow){
							if ($pidRow != ''){
								$productIds .= $pidRow.',';
							}
						}
						$productIds = substr($productIds, 0,-1);
					}

					
					if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}
				
					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}
					
					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$user_id = $this->data['recentActivityDetails']->result_array();
					$userid = $user_id[0]['user_id'];
					if ($userid==''){
						$userid = 0;
					}
					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());

					$this->load->view('site/user/display_user_profile',$this->data);
				}
			}else {
				if($this->lang->line('user_det_not_avail') != '')
				$lg_err_msg = $this->lang->line('user_det_not_avail');
				else
				$lg_err_msg = 'User details not available';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());
			}
		}
	}

	public function add_follow(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			if (!in_array($follow_id, $followingListArr)){
				$followingListArr[] = $follow_id;
				$newFollowingList = implode(',', $followingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$followingCount++;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (!in_array($this->checkLogin('U'), $followersListArr)){
						$followersListArr[] = $this->checkLogin('U');
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount++;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				$actArr = array(
					'activity_name'	=>	'follow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address()
				);
				$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
				$datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();
				$createdTime = mdate($datestring,$time);
				$actArr = array(
					'activity'	=>	'follow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address(),
					'created'		=>	$createdTime
				);
				$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
				$this->send_noty_mail($followUserDetails->result_array());
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function add_follows(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_ids = $this->input->post('user_ids');
			$follow_ids_arr = explode(',', $follow_ids);
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			foreach ($follow_ids_arr as $flwRow){
				if (in_array($flwRow, $followingListArr)){
					if (($key = array_search($flwRow, $follow_ids_arr)) !== false){
						unset($follow_ids_arr[$key]);
					}
				}
			}
			if (count($follow_ids_arr)>0){
				$newfollowingListArr = array_merge($followingListArr,$follow_ids_arr);
				$newFollowingList = implode(',', $newfollowingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$newCount = count($follow_ids_arr);
				$followingCount = $followingCount+$newCount;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$conditionStr = 'where id IN ('.implode(',', $follow_ids_arr).')';
				$followUserDetailsArr = $this->user_model->get_users_details($conditionStr);
				if ($followUserDetailsArr->num_rows() > 0){
					foreach ($followUserDetailsArr->result() as $followUserDetails){
						$followersListArr = explode(',', $followUserDetails->followers);
						if (!in_array($this->checkLogin('U'), $followersListArr)){
							$followersListArr[] = $this->checkLogin('U');
							$newFollowersList = implode(',', $followersListArr);
							$followersCount = $followUserDetails->followers_count;
							$followersCount++;
							$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
							$condition = array('id'=>$followUserDetails->id);
							$this->user_model->update_details(USERS,$dataArr,$condition);
							$datestring = "%Y-%m-%d %h:%i:%s";
							$time = time();
							$createdTime = mdate($datestring,$time);
							$actArr = array(
								'activity'	=>	'follow',
								'activity_id'	=>	$followUserDetails->id,
								'user_id'		=>	$this->checkLogin('U'),
								'activity_ip'	=>	$this->input->ip_address(),
								'created'		=>	$createdTime
							);
							$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
							$this->send_noty_mails($followUserDetails);
						}
					}
				}
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function delete_follow(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') != ''){
			$follow_id = $this->input->post('user_id');
			$followingListArr = explode(',', $this->data['userDetails']->row()->following);
			if (in_array($follow_id, $followingListArr)){
				if(($key = array_search($follow_id, $followingListArr)) !== false) {
					unset($followingListArr[$key]);
				}
				$newFollowingList = implode(',', $followingListArr);
				$followingCount = $this->data['userDetails']->row()->following_count;
				$followingCount--;
				$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount);
				$condition = array('id'=>$this->checkLogin('U'));
				$this->user_model->update_details(USERS,$dataArr,$condition);
				$followUserDetails = $this->user_model->get_all_details(USERS,array('id'=>$follow_id));
				if ($followUserDetails->num_rows() == 1){
					$followersListArr = explode(',', $followUserDetails->row()->followers);
					if (in_array($this->checkLogin('U'), $followersListArr)){
						if(($key = array_search($this->checkLogin('U'), $followersListArr)) !== false) {
							unset($followersListArr[$key]);
						}
						$newFollowersList = implode(',', $followersListArr);
						$followersCount = $followUserDetails->row()->followers_count;
						$followersCount--;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount);
						$condition = array('id'=>$follow_id);
						$this->user_model->update_details(USERS,$dataArr,$condition);
					}
				}
				$actArr = array(
					'activity_name'	=>	'unfollow',
					'activity_id'	=>	$follow_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address()
				);
				$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
				$returnStr['status_code'] = 1;
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function display_user_added(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Products';
				}else {
					$this->data['heading'] = $username.' - Products';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['addedProductDetails'] = $this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				$this->data['rating_val'] = $this->product_model->get_rating_val($userProfileDetails->row()->id);
				/*$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"');*/
				$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id);
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);

				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}
					if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}				

					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}

					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$user_id = $this->data['recentActivityDetails']->result_array();
					$userid = $user_id[0]['user_id'];
					if ($userid==''){
						$userid = 0;
					}
					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());

				$this->load->view('site/user/display_user_added',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	public function display_user_lists(){

		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Lists';
				}else {
					$this->data['heading'] = $username.' - Lists';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['listDetails'] = $this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				//$str = $this->db->last_query();
				//echo $str; die;
				//var_dump($this->data['listDetails']->result());exit();
				if ($this->data['listDetails']->num_rows()>0){
					foreach ($this->data['listDetails']->result() as $listDetailsRow){
						$this->data['listImg'][$listDetailsRow->id] = '';

						if ($listDetailsRow->product_id != ''){
							$pidArr = array_filter(explode(',', $listDetailsRow->product_id));

							$productDetails = '';
							if (count($pidArr)>0){
								foreach ($pidArr as $pidRow){
									if ($pidRow!=''){
										$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										if ($productDetails->num_rows()==0){
											$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										}
										if ($productDetails->num_rows()==1)break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows()==1){
								$this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
								//echo $productDetails->row()->product_name;
							}
						}
					}
				}
				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}
				if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}					

					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}

					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$user_id = $this->data['recentActivityDetails']->result_array();
					$userid = $user_id[0]['user_id'];
					if ($userid==''){
						$userid = 0;
					}
					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());

				$this->load->view('site/user/display_user_lists',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	public function display_user_follow(){

		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		//echo $this->db->last_query(); die;
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Following Lists';
				}else {
					$this->data['heading'] = $username.' - Following Lists';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				//	echo $this->db->last_query();[user_id] => 152
				$user_id = $this->data['recentActivityDetails']->result_array();
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				$userid = $user_id[0]['user_id'];
				if ($userid==''){
					$userid = 0;
				}
				$this->data['listDetails'] = $this->product_model->view_follow_list($userid);
				//echo $this->db->last_query(); die;
				if ($this->data['listDetails']->num_rows()>0){
					foreach ($this->data['listDetails']->result() as $listDetailsRow){
						$this->data['listImg'][$listDetailsRow->id] = '';
						if ($listDetailsRow->product_id != ''){
							$pidArr = array_filter(explode(',', $listDetailsRow->product_id));

							$productDetails = '';
							if (count($pidArr)>0){
								foreach ($pidArr as $pidRow){
									if ($pidRow!=''){
										$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										if ($productDetails->num_rows()==0){
											$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pidRow,'status'=>'Publish'));
										}
										if ($productDetails->num_rows()==1)break;
									}
								}
							}
							if ($productDetails != '' && $productDetails->num_rows()==1){
								$this->data['listImg'][$listDetailsRow->id] = $productDetails->row()->image;
							}
						}
					}

				}
				
				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
					$productIds = '';
					if (count($productIdsArr)>0){
						foreach ($productIdsArr as $pidRow){
							if ($pidRow != ''){
								$productIds .= $pidRow.',';
							}
						}
						$productIds = substr($productIds, 0,-1);
					}
					if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}										

					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}

					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());
				$this->load->view('site/user/display_admin_follow',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	public function display_user_wants(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Wants';
				}else {
					$this->data['heading'] = $username.' - Wants';
				}

				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));
				$this->data['wantProductDetails'] = $this->product_model->get_wants_product($wantList);
				$this->data['notSellProducts'] = $this->product_model->get_notsell_wants_product($wantList);
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);

				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}

				if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}				

					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}

					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$user_id = $this->data['recentActivityDetails']->result_array();
					$userid = $user_id[0]['user_id'];
					if ($userid==''){
						$userid = 0;
					}
					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());

				$this->load->view('site/user/display_user_wants',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	public function display_user_owns(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Owns';
				}else {
					$this->data['heading'] = $username.' - Owns';
				}
				
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$this->data['follow'] = $this->product_model->view_follow_list($userProfileDetails->row()->id);
				$productIdsArr = array_filter(explode(',', $userProfileDetails->row()->own_products));
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				$productIds = '';
				if (count($productIdsArr)>0){
					foreach ($productIdsArr as $pidRow){
						if ($pidRow != ''){
							$productIds .= $pidRow.',';
						}
					}
					$productIds = substr($productIds, 0,-1);
				}
				if ($productIds != ''){
					$this->data['ownsProductDetails'] = $this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');
					/*$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"');*/
					$this->data['notSellProducts'] = $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id);
					/*$this->data['name_own'] = sizeof(array_filter($this->data['notSellProducts']->result())) + sizeof(array_filter($this->data['ownsProductDetails']->result()));echo $this->data['name_own'];*/

					if($productIds != '') {
						$this->data['name_own'] = $this->get_count_list($this->product_model->view_product_details(' where p.seller_product_id in ('.$productIds.') and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_own($productIds, $userProfileDetails->row()->id)->result());
					} else {
						$this->data['name_own'] = 0;
					}					

					$this->data['name_added'] = $this->get_count_list($this->product_model->view_product_details(' where p.user_id='.$userProfileDetails->row()->id.' and p.status="Publish"')->result(), $this->product_model->view_notsell_product_details_add($userProfileDetails->row()->id)->result());

					$this->data['name_rated'] = $this->get_count_list($this->user_model->get_like_details_fully($userProfileDetails->row()->id)->result(), $this->user_model->get_like_details_fully_user_products($userProfileDetails->row()->id)->result());

					$wantList = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id));

					$a = $this->product_model->get_wants_product($wantList);
					$b = $this->product_model->get_notsell_wants_product($wantList);

					if(($a != '' && $a->num_rows()>0)|| ($b != '' && $b->num_rows()>0)) {
						$this->data['name_want'] = $this->get_count_list($a->result(), $b->result());
					} else {
						$this->data['name_want'] = 0;
					}

					$this->data['name_list'] = $this->get_count_lists($this->product_model->get_all_details(LISTS_DETAILS,array('user_id'=>$userProfileDetails->row()->id))->result());

					$user_id = $this->data['recentActivityDetails']->result_array();
					$userid = $user_id[0]['user_id'];
					if ($userid==''){
						$userid = 0;
					}
					$this->data['name_follow'] = $this->get_count_lists($this->product_model->view_follow_list($userid)->result());
				
				}else {
					$this->data['addedProductDetails'] = '';
					$this->data['notSellProducts'] = '';
				}
				$this->load->view('site/user/display_user_owns',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	function get_count_list($a, $b) {
		$count=0;

		foreach ($b as $k)
		{
		    if (!empty($k->id))
		    {
		        $count++;
		    }
		}

		foreach ($a as $v)
		{

		    if (!empty($v->id))
		    {
		        $count++;
		    }
		}
		return $count;
	}

	function get_count_lists($a) {
		$count=0;

		foreach ($a as $k)
		{
		    if (!empty($k->id))
		    {
		        $count++;
		    }
		}
		return $count;
	}

	public function display_user_following(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Following';
				}else {
					$this->data['heading'] = $username.' - Following';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->following);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_following',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}

	public function display_user_followers(){
		$username =  urldecode($this->uri->segment(2,0));
		$userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$username));
		if ($userProfileDetails->num_rows()==1){
			if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
				$this->load->view('site/user/display_user_profile_private',$this->data);
			}else {
				if ($userProfileDetails->row()->full_name != ''){
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - Followers';
				}else {
					$this->data['heading'] = $username.' - Followers';
				}
				$this->data['userProfileDetails'] = $userProfileDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($userProfileDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $userProfileDetails->row()->followers);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
				$this->data['followingUserDetails'] = $followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);
				if ($followingUserDetails->num_rows()>0){
					foreach ($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserLikeDetails'][$followingUserRow->id] = $this->user_model->get_userlike_products($followingUserRow->id);
					}
				}
				$this->load->view('site/user/display_user_followers',$this->data);
			}
		}else {
			redirect(base_url());
		}
	}
    
    // fucntion to add product ratings.
    public function add_prduct_rating(){
        
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U') == ''){
            if($this->lang->line('login_requ') != '')
            $returnStr['message'] = $this->lang->line('login_requ');
            else
            $returnStr['message'] = 'Login required';
        }else {
            $tid = $this->input->post('tid');
            $uid = $this->input->post('uid');
            $rating = $this->input->post('rating');
            
            if($tid && $uid && $rating){
            
                $rating_data = array(
                    'rating' => $rating,
                    'product_id' => $tid,
                    'user_id' => $uid,
                    'ip_address' => $this->input->ip_address()
                );
                
                $this->product_model->remove_product_rating($tid, $uid);
                $this->product_model->add_product_rating($rating_data);
                
                
                // adding the user activity
                $actArr = array(
                    'activity_name'    =>    'fancy',
                    'activity_id'    =>    $tid,
                    'user_id'        =>    $this->checkLogin('U'),
                    'activity_ip'    =>    $this->input->ip_address()
                );
                $this->user_model->simple_insert(USER_ACTIVITY,$actArr);
                
                
                // adding the new notification
                $datestring = "%Y-%m-%d %h:%i:%s";
                $time = time();
                $createdTime = mdate($datestring,$time);
                $actArr = array(
                    'activity'       =>    'like',
                    'activity_id'    =>    $tid,
                    'user_id'        =>    $this->checkLogin('U'),
                    'activity_ip'    =>    $this->input->ip_address(),
                    'created'        =>    $createdTime
                );
                $this->user_model->simple_insert(NOTIFICATIONS, $actArr);
                
                
                /*************Send Message to TWITTER*************/
                if($this->data['userDetails']->row()->twitter_id!=''){
                     $TwitterId = $this->data['userDetails']->row()->twitter_id;
                     if($productDetails->row()->image!=''){
                        $image = base_url()."images/product/".$productDetails->row()->image;
                     }else{
                       $image = base_url()."images/product/no_image.gif";
                     }
                     $short_url = $this->user_model->get_all_details(SHORTURL,array('id'=>$productDetails->row()->short_url_id));
                     if($short_url->num_rows() ==1){
                       $url = base_url().'t/'.$short_url->row()->id;
                     }
                        include_once './twittercard/twitter-card.php';
                        $card = new Twitter_Card();
                        $card->setURL( 'http://www.nytimes.com/2012/02/19/arts/music/amid-police-presence-fans-congregate-for-whitney-houstons-funeral-in-newark.html' );
                        $card->setTitle( 'Parade of Fans for Houston\'s Funeral' );
                        $card->setDescription( 'NEWARK - The guest list and parade of limousines with celebrities emerging from them seemed more suited to a red carpet event in Hollywood or New York than than a gritty stretch of Sussex Avenue near the former site of the James M. Baxter Terrace public housing project here.' );
                        $card->setImage( 'http://graphics8.nytimes.com/images/2012/02/19/us/19whitney-span/19whitney-span-articleLarge.jpg', 600, 330 );
                        $send_tweets = $this->twconnect->tw_post('https://api.twitter.com/1.1/statuses/update.json',$card->asHTML());
                        print_r($send_tweets);
                    
                 }
                /*************************END*********************/
                
                // returning json data
                $returnStr['status_code'] = 1;
            }
            else{
                if($this->lang->line('prod_not_avail') != '')
                $returnStr['message'] = $this->lang->line('prod_not_avail');
                else
                $returnStr['message'] = 'Product not available';
            }
        }
        
        echo json_encode($returnStr);
    }
    
    // function to get product ratings from ajax
    public function get_prduct_rating(){
        
        $returnStr['status_code'] = 0;
        $returnStr['product_rating'] = 0;
        if ($this->checkLogin('U') == ''){
            if($this->lang->line('login_requ') != '')
            $returnStr['message'] = $this->lang->line('login_requ');
            else
            $returnStr['message'] = 'Login required';
        }else {
            $tid = $this->input->post('tid');
            $uid = $this->input->post('uid');
            
            $rating_data = $this->product_model->get_product_rating($tid, $uid);
            
            if($rating_data){
                $returnStr['product_rating'] = $rating_data->rating;
            }
            
            $returnStr['status_code'] = 1;
        }
        
        // return data
        echo json_encode($returnStr);
    }
    
    // fucntion to add product ratings.
    public function delete_prduct_rating(){
        
        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U') == ''){
            if($this->lang->line('login_requ') != '')
            $returnStr['message'] = $this->lang->line('login_requ');
            else
            $returnStr['message'] = 'Login required';
        }else {
            $tid = $this->input->post('tid');
            $uid = $this->input->post('uid');
            
            if($tid && $uid){
                $this->product_model->remove_product_rating($tid, $uid);
                
                
                // inserting user activity
                $actArr = array(
                    'activity_name'    =>    'unfancy',
                    'activity_id'    =>    $tid,
                    'user_id'        =>    $this->checkLogin('U'),
                    'activity_ip'    =>    $this->input->ip_address()
                );
                $this->user_model->simple_insert(USER_ACTIVITY,$actArr);
                
                $returnStr['status_code'] = 1;
            }
            else{
                if($this->lang->line('prod_not_avail') != '')
                $returnStr['message'] = $this->lang->line('prod_not_avail');
                else
                $returnStr['message'] = 'Product not available';
            }
        }
        
        // return data
        echo json_encode($returnStr);
    }

	public function add_list_when_fancyy(){
		$returnStr['status_code'] = 0;
		$returnStr['listCnt'] = '';
		$returnStr['wanted'] = 0;
		$uniqueListNames = array();
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$tid = $this->input->post('tid');
			$firstCatName = '';
			$firstCatDetails = '';
			$count = 1;

			//Adding lists which was not already created from product categories
			$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
			if ($productDetails->num_rows()==0){
				$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
			}
			if ($productDetails->num_rows()==1){
				$productCatArr = explode(',', $productDetails->row()->category_id);
				if (count($productCatArr)>0){
					$productCatNameArr = array();
					foreach ($productCatArr as $productCatID){
						if ($productCatID != ''){
							$productCatDetails = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCatID));
							if ($productCatDetails->num_rows()==1){
								if ($count == 1){
									$firstCatName = $productCatDetails->row()->cat_name;
								}
								$listConditionArr = array('name'=>$productCatDetails->row()->cat_name,'user_id'=>$this->checkLogin('U'));
								$listCheck = $this->user_model->get_all_details(LISTS_DETAILS,$listConditionArr);
								if ($count == 1){
									$firstCatDetails = $listCheck;
								}
								if ($listCheck->num_rows()==0){
									$this->user_model->simple_insert(LISTS_DETAILS,$listConditionArr);
									$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
									$listCount = $userDetails->row()->lists;
									if ($listCount<0 || $listCount == ''){
										$listCount = 0;
									}
									$listCount++;
									$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
								}
								$count++;
							}
						}
					}
				}
			}

			//Check the product id in list table
			$checkListsArr = $this->user_model->get_list_details($tid,$this->checkLogin('U'));

			if ($checkListsArr->num_rows() == 0){

				//Add the product id under the first category name
				if ($firstCatName!=''){
					$listConditionArr = array('name'=>$firstCatName,'user_id'=>$this->checkLogin('U'));
					if ($firstCatDetails == '' || $firstCatDetails->num_rows() == 0){
						$dataArr = array('product_id'=>$tid);
					}else {
						$productRowArr = explode(',', $firstCatDetails->row()->product_id);
						$productRowArr[] = $tid;
						$newProductRowArr = implode(',', $productRowArr);
						$dataArr = array('product_id'=>$newProductRowArr);
					}
					$this->user_model->update_details(LISTS_DETAILS,$dataArr,$listConditionArr);
					$listCntDetails = $this->user_model->get_all_details(LISTS_DETAILS,$listConditionArr);
					if ($listCntDetails->num_rows()==1){
						array_push($uniqueListNames, $listCntDetails->row()->id);
						$returnStr['listCnt'] .= '<li class="selected"><label for="'.$listCntDetails->row()->id.'"><input type="checkbox" checked="checked" id="'.$listCntDetails->row()->id.'" name="'.$listCntDetails->row()->id.'">'.$listCntDetails->row()->name.'</label></li>';
					}
				}
			}else {

				//Get all the lists which contain this product
				foreach ($checkListsArr->result() as $checkListsRow){
					array_push($uniqueListNames, $checkListsRow->id);
					$returnStr['listCnt'] .= '<li class="selected"><label for="'.$checkListsRow->id.'"><input type="checkbox" checked="checked" id="'.$checkListsRow->id.'" name="'.$checkListsRow->id.'">'.$checkListsRow->name.'</label></li>';
				}
			}
			$all_lists = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($all_lists->num_rows()>0){
				foreach ($all_lists->result() as $all_lists_row){
					if (!in_array($all_lists_row->id, $uniqueListNames)){
						$returnStr['listCnt'] .= '<li><label for="'.$all_lists_row->id.'"><input type="checkbox" id="'.$all_lists_row->id.'" name="'.$all_lists_row->id.'">'.$all_lists_row->name.'</label></li>';
					}
				}
			}

			//Check the product wanted status
			$wantedProducts = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantedProducts->num_rows()==1){
				$wantedProductsArr = explode(',', $wantedProducts->row()->product_id);
				if (in_array($tid, $wantedProductsArr)){
					$returnStr['wanted'] = 1;
				}
			}
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function add_item_to_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function remove_item_from_lists(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$lid = $this->input->post('list_ids');
			$listDetails = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			if ($listDetails->num_rows()==1){
				$product_ids = explode(',', $listDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
						unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(LISTS_DETAILS,array('product_id'=>$new_product_ids),array('id'=>$lid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function add_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (!in_array($tid, $product_ids)){
					array_push($product_ids, $tid);
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
			}else {
				$dataArr = array('user_id'=>$this->checkLogin('U'),'product_id'=>$tid);
				$this->user_model->simple_insert(WANTS_DETAILS,$dataArr);
			}
			$wantCount = $this->data['userDetails']->row()->want_count;
			if ($wantCount<=0 || $wantCount==''){
				$wantCount = 0;
			}
			$wantCount++;
			$dataArr = array('want_count'=>$wantCount);
			$ownProducts = explode(',', $this->data['userDetails']->row()->own_products);
			if (in_array($tid, $ownProducts)){
				if (($key = array_search($tid, $ownProducts)) !== false){
					unset($ownProducts[$key]);
				}
				$ownCount = $this->data['userDetails']->row()->own_count;
				$ownCount--;
				$dataArr['own_count'] = $ownCount;
				$dataArr['own_products'] = implode(',', $ownProducts);
			}
			$this->user_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function delete_want_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$wantDetails = $this->user_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
			if ($wantDetails->num_rows()==1){
				$product_ids = explode(',', $wantDetails->row()->product_id);
				if (in_array($tid, $product_ids)){
					if(($key = array_search($tid, $product_ids)) !== false) {
						unset($product_ids[$key]);
					}
				}
				$new_product_ids = implode(',', $product_ids);
				$this->user_model->update_details(WANTS_DETAILS,array('product_id'=>$new_product_ids),array('user_id'=>$this->checkLogin('U')));
				$wantCount = $this->data['userDetails']->row()->want_count;
				if ($wantCount<=0 || $wantCount==''){
					$wantCount = 1;
				}
				$wantCount--;
				$this->user_model->update_details(USERS,array('want_count'=>$wantCount),array('id'=>$this->checkLogin('U')));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function create_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('tid');
			$list_name = $this->input->post('list_name');
			$category_id = $this->input->post('category_id');
			$checkList = $this->user_model->get_all_details(LISTS_DETAILS,array('name'=>$list_name,'user_id'=>$this->checkLogin('U')));
			if ($checkList->num_rows() == 0){
				$dataArr = array('user_id'=>$this->checkLogin('U'),'name'=>$list_name,'product_id'=>$tid);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}
				$this->user_model->simple_insert(LISTS_DETAILS,$dataArr);
				$userDetails = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
				$listCount = $userDetails->row()->lists;
				if ($listCount<0 || $listCount == ''){
					$listCount = 0;
				}
				$listCount++;
				$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
				$returnStr['list_id'] = $this->user_model->get_last_insert_id();
				$returnStr['new_list'] = 1;
			}else {
				$productArr = explode(',', $checkList->row()->product_id);
				if (!in_array($tid, $productArr)){
					array_push($productArr, $tid);
				}
				$product_id = implode(',', $productArr);
				$dataArr = array('product_id'=>$product_id);
				if ($category_id != ''){
					$dataArr['category_id'] = $category_id;
				}
				$this->user_model->update_details(LISTS_DETAILS,$dataArr,array('user_id'=>$this->checkLogin('U'),'name'=>$list_name));
				$returnStr['list_id'] = $checkList->row()->id;
				$returnStr['new_list'] = 0;
			}
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function search_users(){
		$search_key = $this->input->post('term');
		$returnStr = array();
		if ($search_key != ''){
			$userList = $this->user_model->get_search_user_list($search_key,$this->checkLogin('U'));
			if ($userList->num_rows()>0){
				$i=0;
				foreach ($userList->result() as $userRow){
					$userArr['id'] = $userRow->id;
					$userArr['fullname'] = $userRow->full_name;
					$userArr['username'] = $userRow->user_name;
					if ($userRow->thumbnail != ''){
						$userArr['image_url'] = 'images/users/'.$userRow->thumbnail;
					}else {
						$userArr['image_url'] = 'images/users/user-thumb1.png';
					}
					array_push($returnStr, $userArr);
					$i++;
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function seller_signup_form(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			if ($this->data['userDetails']->row()->is_verified == 'No'){
				if($this->lang->line('cfm_mail_fst') != '')
				$lg_err_msg = $this->lang->line('cfm_mail_fst');
				else
				$lg_err_msg = 'Please confirm your email first';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect(base_url());
			}else {
				$this->data['heading'] = 'Seller Signup';
				$this->load->view('site/user/seller_register',$this->data);
			}
		}
	}

	public function create_brand_form(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			$this->data['heading'] = 'Seller Signup';
			$this->load->view('site/user/seller_register',$this->data);
		}
	}



	public function seller_signup(){
		if ($this->checkLogin('U')==''){
			redirect(base_url());
		}else {
			if ($this->data['userDetails']->row()->is_verified == 'No'){
				if($this->lang->line('cfm_mail_fst') != '')
				$lg_err_msg = $this->lang->line('cfm_mail_fst');
				else
				$lg_err_msg = 'Please confirm your email first';
				$this->setErrorMessage('error',$lg_err_msg);
				redirect('create-brand');

			}else {
				$dataArr = array(
					'request_status'	=>	'Pending'
					);
					$this->user_model->commonInsertUpdate(USERS,'update',array(),$dataArr,array('id'=>$this->checkLogin('U')));
					if($this->lang->line('sell_reg_succ_msg') != '')
					$lg_err_msg = $this->lang->line('sell_reg_succ_msg');
					else
					$lg_err_msg = 'Welcome onboard ! Our team is evaluating your request. We will contact you shortly';
					$this->setErrorMessage('success',$lg_err_msg);
					redirect(base_url());
			}
		}
	}

	public function view_purchase(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$purchaseList = $this->user_model->get_purchase_list($uid,$dealCode);
				$invoice = $this->get_invoice($purchaseList);
				echo $invoice;
			}
		}
	}

	public function view_order(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$dealCode = $this->uri->segment(3,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$orderList = $this->user_model->get_order_list($uid,$dealCode);
				$invoice = $this->get_invoice($orderList);
				echo $invoice;
			}
		}
	}

	public function get_invoice($PrdList){
		$shipAddRess = $this->user_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $PrdList->row()->shippingid ));

		$newsid='19';
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array(
			'logo'=> $this->data['logo'],
			'meta_title'=>$this->config->item('meta_title'),
			'ship_fullname'=>stripslashes($shipAddRess->row()->full_name),
			'ship_address1'=>stripslashes($shipAddRess->row()->address1),
			'ship_address2'=>stripslashes($shipAddRess->row()->address2),
			'ship_city'=>stripslashes($shipAddRess->row()->city),
			'ship_country'=>stripslashes($shipAddRess->row()->country),
			'ship_state'=>stripslashes($shipAddRess->row()->state),
			'ship_postalcode'=>stripslashes($shipAddRess->row()->postal_code),
			'ship_phone'=>stripslashes($shipAddRess->row()->phone),
			'bill_fullname'=>stripslashes($PrdList->row()->full_name),
			'bill_address1'=>stripslashes($PrdList->row()->address),
			'bill_address2'=>stripslashes($PrdList->row()->address2),
			'bill_city'=>stripslashes($PrdList->row()->city),
			'bill_country'=>stripslashes($PrdList->row()->country),
			'bill_state'=>stripslashes($PrdList->row()->state),
			'bill_postalcode'=>stripslashes($PrdList->row()->postal_code),
			'bill_phone'=>stripslashes($PrdList->row()->phone_no),
			'invoice_number'=>$PrdList->row()->dealCodeNumber,
			'invoice_date'=>date("F j, Y g:i a",strtotime($PrdList->row()->created))
		);
		extract($adminnewstemplateArr);
		$subject = $template_values['news_subject'];
		$message1 .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/></head>
<title>'.$template_values['news_subject'].'</title>
<body>

';
		include('./newsletter/registeration'.$newsid.'.php');

		$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
		$message = stripslashes(substr($message,0,strrpos($message,'</tbody>')));
		$message1 .= $message;
		$disTotal =0; $grantTotal = 0;
		foreach ($PrdList->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image);
		$unitPrice = ($cartRow->price*(0.01*$cartRow->product_tax_cost))+$cartRow->product_shipping_cost+$cartRow->price;
		$uTot = $unitPrice*$cartRow->quantity;
		if($cartRow->attr_name != '' || $cartRow->attr_type){ $atr = '<br>'.$cartRow->attr_type.' / '.$cartRow->attr_name; }else{ $atr = '';}
		$message1.='<tr>
            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'.base_url().PRODUCTPATH.$InvImg[0].'" alt="'.stripslashes($cartRow->product_name).'" width="70" /></span></td>
			<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.stripslashes($cartRow->product_name).$atr.'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.strtoupper($cartRow->quantity).'</span></td>
            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($unitPrice,2,'.','').'</span></td>
            <td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'.$this->data['currencySymbol'].number_format($uTot,2,'.','').'</span></td>
        </tr>';
		$grantTotal = $grantTotal + $uTot;
		}
		$private_total = $grantTotal - $PrdList->row()->discountAmount;
		$private_total = $private_total + $PrdList->row()->tax  + $PrdList->row()->shippingcost;
			
		$message1.='</table></td> </tr><tr><td colspan="3"><table border="0" cellspacing="0" cellpadding="0" style=" margin:10px 0px; width:99.5%;"><tr>
			<td width="460" valign="top" >';
		if($PrdList->row()->note !=''){
			$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"><tr>
                <td width="87" ><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Note:</span></td>
               
            </tr>
			<tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:left; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">'.stripslashes($PrdList->row()->note).'</span></td>
            </tr></table>';
		}
			
		if($PrdList->row()->order_gift == 1){
			$message1.='<table width="97%" border="0"  cellspacing="0" cellpadding="0"  style="margin-top:10px;"><tr>
                <td width="87"  style="border:1px solid #cecece;"><span style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; text-align:center; width:97%; color:#000000; line-height:24px; float:left; margin:10px;">This Order is a gift</span></td>
            </tr></table>';
		}
			
		$message1.='</td>
            <td width="174" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #cecece;">
            <tr bgcolor="#f3f3f3">
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Sub Total</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($grantTotal,'2','.','').'</span></td>
            </tr>
			<tr>
                <td width="87"  style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; text-align:center; width:100%; font-weight:bold; color:#000000; line-height:38px; float:left;">Discount Amount</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->discountAmount,'2','.','').'</span></td>
            </tr>
		<tr bgcolor="#f3f3f3">
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Cost</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->shippingcost,2,'.','').'</span></td>
              </tr>
			  <tr>
            <td width="31" style="border-right:1px solid #cecece;border-bottom:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:center; width:100%; color:#000000; line-height:38px; float:left;">Shipping Tax</span></td>
                <td  style="border-bottom:1px solid #cecece;" width="69"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($PrdList->row()->tax ,2,'.','').'</span></td>
              </tr>
			  <tr bgcolor="#f3f3f3">
                <td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
                <td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">'.$this->data['currencySymbol'].number_format($private_total,'2','.','').'</span></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        </tr>
    </table>
        </div>
        
        <!--end of left--> 
		
            
            <div style="width:27.4%; margin-right:5px; float:right;">
            
           
            </div>
        
        <div style="clear:both"></div>
        
    </div>
    </div></body></html>';
		return $message1;
	}

	public function change_order_status(){
		if ($this->checkLogin('U') == ''){
			show_404();
		}else {
			$uid = $this->input->post('seller');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$returnStr['status_code'] = 0;
				$dealCode = $this->input->post('dealCode');
				$status = $this->input->post('value');
				$dataArr = array('shipping_status'=>$status);
				$conditionArr = array('dealCodeNumber'=>$dealCode,'sell_id'=>$uid);
				$this->user_model->update_details(PAYMENT,$dataArr,$conditionArr);
				$returnStr['status_code'] = 1;
				echo json_encode($returnStr);
			}
		}
	}

	public function display_user_lists_home(){

		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				if ($userProfileDetails->row()->full_name == ''){
					$this->data['heading'] = $uname.' - List';
				}else {
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - List';
				}
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(PRODUCT.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.PRODUCT.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['product_details'] = $product_details = $this->product_model->get_fields_from_many(PRODUCT,$fieldsArr,PRODUCT.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
					$this->data['totalProducts'] = count($searchArr);
					$fieldsArr = array(USER_PRODUCTS.'.*',USERS.'.user_name',USERS.'.full_name');
					$condition = array(USER_PRODUCTS.'.status'=>'Publish');
					$joinArr1 = array('table'=>USERS,'on'=>USERS.'.id='.USER_PRODUCTS.'.user_id','type'=>'');
					$joinArr = array($joinArr1);
					$this->data['notsell_product_details'] = $this->product_model->get_fields_from_many(USER_PRODUCTS,$fieldsArr,USER_PRODUCTS.'.seller_product_id',$searchArr,$joinArr,'','',$condition);
				}else {
					$this->data['notsell_product_details'] = '';
					$this->data['product_details'] = '';
					$this->data['totalProducts'] = 0;
				}
				$this->load->view('site/user/user_list_home',$this->data);
			}
		}
	}

	public function display_user_lists_followers(){
		$lid = $this->uri->segment('4','0');
		$uname = $this->uri->segment('2','0');
		$this->data['user_profile_details'] = $userProfileDetails = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
		if ($userProfileDetails->row()->visibility == 'Only you' && $userProfileDetails->row()->id != $this->checkLogin('U')){
			$this->load->view('site/user/display_user_profile_private',$this->data);
		}else {
			$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
			$this->data['current_banner_image'] = $this->product_model->get_banner_img($userProfileDetails->row()->id);
			if ($this->data['list_details']->num_rows()==0){
				show_404();
			}else {
				if ($userProfileDetails->row()->full_name == ''){
					$this->data['heading'] = $uname.' - List';
				}else {
					$this->data['heading'] = $userProfileDetails->row()->full_name.' - List';
				}
				$fieldsArr = '*';
				$searchArr = explode(',', $list_details->row()->followers);
				$this->data['user_details'] = $user_details = $this->product_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
				if ($user_details->num_rows()>0){
					foreach ($user_details->result() as $userRow){
						$fieldsArr = array(PRODUCT_LIKES.'.*',PRODUCT.'.product_name',PRODUCT.'.image',PRODUCT.'.id as PID');
						$searchArr = array($userRow->id);
						$joinArr1 = array('table'=>PRODUCT,'on'=>PRODUCT_LIKES.'.product_id='.PRODUCT.'.seller_product_id','type'=>'');
						$joinArr = array($joinArr1);
						$sortArr1 = array('field'=>PRODUCT.'.created','type'=>'desc');
						$sortArr = array($sortArr1);
						$this->data['product_details'][$userRow->id] = $this->product_model->get_fields_from_many(PRODUCT_LIKES,$fieldsArr,PRODUCT_LIKES.'.user_id',$searchArr,$joinArr,$sortArr,'5');
					}
				}
				$fieldsArr = array(PRODUCT.'.*',USERS.'.user_name',USERS.'.full_name');
				$searchArr = array_filter(explode(',', $list_details->row()->product_id));
				if (count($searchArr)>0){
					$this->data['totalProducts'] = count($searchArr);
				}else {
					$this->data['totalProducts'] = 0;
				}

				$this->load->view('site/user/user_list_followers',$this->data);
			}
		}
	}

	public function follow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (!in_array($lid, $oldDetails)){
				array_push($oldDetails, $lid);
			}
			if (!in_array($this->checkLogin('U'), $followersArr)){
				array_push($followersArr, $this->checkLogin('U'));
				$followersCount++;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function unfollow_list(){
		$returnStr['status_code'] = 0;
		$lid = $this->input->post('lid');
		if ($this->checkLogin('U') != ''){
			$listDetails = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid));
			$followersArr = explode(',', $listDetails->row()->followers);
			$followersCount = $listDetails->row()->followers_count;
			$oldDetails = explode(',', $this->data['userDetails']->row()->following_user_lists);
			if (in_array($lid, $oldDetails)){
				if ($key = array_search($lid, $oldDetails) !== false){
					unset($oldDetails[$key]);
				}
			}
			if (in_array($this->checkLogin('U'), $followersArr)){
				if ($key = array_search($this->checkLogin('U'), $followersArr) !== false){
					unset($followersArr[$key]);
				}
				$followersCount--;
			}
			$this->product_model->update_details(USERS,array('following_user_lists'=>implode(',', $oldDetails)),array('id'=>$this->checkLogin('U')));
			$this->product_model->update_details(LISTS_DETAILS,array('followers'=>implode(',', $followersArr),'followers_count'=>$followersCount),array('id'=>$lid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function edit_user_lists(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->uri->segment('4','0');
			$uname = $this->uri->segment('2','0');
			if ($uname != $this->data['userDetails']->row()->user_name){
				show_404();
			}else {
				$this->data['user_profile_details'] = $this->user_model->get_all_details(USERS,array('user_name'=>$uname));
				$this->data['list_details'] = $list_details = $this->product_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->data['user_profile_details']->row()->id));
				if ($this->data['list_details']->num_rows()==0){
					show_404();
				}else {
					$this->data['list_category_details'] = $this->user_model->get_all_details(CATEGORY,array('id'=>$this->data['list_details']->row()->category_id));
					$this->data['heading'] = 'Edit List';
					$this->load->view('site/user/edit_user_list',$this->data);
				}
			}
		}
	}

	public function edit_user_list_details(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$list_title = $this->input->post('setting-title');
				$catID = $this->input->post('category');
				$duplicateCheck = $this->user_model->get_all_details(LISTS_DETAILS,array('user_id'=>$uid,'id !='=>$lid,'name'=>$list_title));
				if ($duplicateCheck->num_rows()>0){
					if($this->lang->line('list_tit_exist') != '')
					$lg_err_msg = $this->lang->line('list_tit_exist');
					else
					$lg_err_msg = 'List title already exists';
					$this->setErrorMessage('error',$lg_err_msg);
					echo '<script>window.history.go(-1);</script>';
				}else {
					if ($catID == ''){
						$catID = 0;
					}
					$this->user_model->update_details(LISTS_DETAILS,array('name'=>$list_title,'category_id'=>$catID),array('id'=>$lid,'user_id'=>$uid));
					if($this->lang->line('list_updat_succ') != '')
					$lg_err_msg = $this->lang->line('list_updat_succ');
					else
					$lg_err_msg = 'List updated successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					echo '<script>window.history.go(-1);</script>';
				}
			}
		}
	}

	public function delete_user_list(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')==''){
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}else {
			$lid = $this->input->post('lid');
			$uid = $this->input->post('uid');
			if ($uid != $this->checkLogin('U')){
				if($this->lang->line('u_cant_del_othr_lst') != '')
				$returnStr['message'] = $this->lang->line('u_cant_del_othr_lst');
				else
				$returnStr['message'] = 'You can\'t delete other\'s list';
			}else {
				$list_details = $this->user_model->get_all_details(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$uid));
				if ($list_details->num_rows() == 1){
					$followers_id = $list_details->row()->followers;
					if ($followers_id != ''){
						$searchArr = array_filter(explode(',', $followers_id));
						$fieldsArr = array('following_user_lists','id');
						$followersArr = $this->user_model->get_fields_from_many(USERS,$fieldsArr,'id',$searchArr);
						if ($followersArr->num_rows()>0){
							foreach ($followersArr->result() as $followersRow){
								$listArr = array_filter(explode(',', $followersRow->following_user_lists));
								if (in_array($lid, $listArr)){
									if (($key = array_search($lid, $listArr)) != false){
										unset($listArr[$key]);
										$this->user_model->update_details(USERS,array('following_user_lists'=>implode(',', $listArr)),array('id'=>$followersRow->id));
									}
								}
							}
						}
					}
					$this->user_model->commonDelete(LISTS_DETAILS,array('id'=>$lid,'user_id'=>$this->checkLogin('U')));
					$listCount = $this->data['userDetails']->row()->lists;
					$listCount--;
					if ($listCount == '' || $listCount < 0){
						$listCount = 0;
					}
					$this->user_model->update_details(USERS,array('lists'=>$listCount),array('id'=>$this->checkLogin('U')));
					$returnStr['url'] = base_url().'user/'.$this->data['userDetails']->row()->user_name.'/lists';
					if($this->lang->line('list_del_succ') != '')
					$lg_err_msg = $this->lang->line('list_del_succ');
					else
					$lg_err_msg = 'List deleted successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('lst_not_avail') != '')
					$returnStr['message'] = $this->lang->line('lst_not_avail');
					else
					$returnStr['message'] = 'List not available';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function image_crop(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$uid = $this->uri->segment(2,0);
			if ($uid != $this->checkLogin('U')){
				show_404();
			}else {
				$this->data['heading'] = 'Cropping Image';
				$this->load->view('site/user/crop_image',$this->data);
			}
		}
	}

	public function image_crop_process(){
		if($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$targ_w = $targ_h = 240;
			$jpeg_quality = 90;

			$src = 'images/users/'.$this->data['userDetails']->row()->thumbnail;
			$ext = substr($src, strpos($src , '.')+1);
			if ($ext == 'png'){
				$jpgImg = imagecreatefrompng($src);
				imagejpeg($jpgImg, $src, 90);
			}
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

			//			list($width, $height) = getimagesize($src);

			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			//		imagecopyresized($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],	$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			//		imagecopyresized($dst_r, $img_r,0,0, $_POST['x1'],$_POST['y1'], $_POST['x2'],$_POST['y2'],1024,980);
			//			header('Content-type: image/jpeg');
			imagejpeg($dst_r,'images/users/'.$this->data['userDetails']->row()->thumbnail);
			if($this->lang->line('prof_photo_change_succ') != '')
			$lg_err_msg = $this->lang->line('prof_photo_change_succ');
			else
			$lg_err_msg = 'Profile photo changed successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('user/'.$this->data['userDetails']->row()->user_name);
			exit;
		}
	}

	public function send_noty_mail($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails[0]['email_notifications']);
			if (in_array('following', $emailNoty)){
				$newsid='7';
				$template_values=$this->product_model->get_newsletter_template_details($newsid);
				$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
				extract($adminnewstemplateArr);
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
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
									'to_mail_id'=>$followUserDetails[0]['email'],
									'subject_message'=>$subject,
									'body_messages'=>$message
				);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}

	public function send_noty_mails($followUserDetails=array()){
		if (count($followUserDetails)>0){
			$emailNoty = explode(',', $followUserDetails->email_notifications);
			if (in_array('following', $emailNoty)){

				$newsid='9';
				$template_values=$this->product_model->get_newsletter_template_details($newsid);
				$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$followUserDetails[0]['full_name'],'cfull_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
				extract($adminnewstemplateArr);
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
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
									'to_mail_id'=>$followUserDetails->email,
									'subject_message'=>$subject,
									'body_messages'=>$message
				);
				$email_send_to_common = $this->product_model->common_email_send($email_values);
			}
		}
	}

	public function order_review(){
		if ($this->checkLogin('U')==''){
			show_404();
		}else {
			$uid = $this->uri->segment(2,0);
			$sid = $this->uri->segment(3,0);
			$dealCode = $this->uri->segment(4,0);
			if ($uid == $this->checkLogin('U')){
				$view_mode = 'user';
			}else if ($sid == $this->checkLogin('U')){
				$view_mode = 'seller';
			}else {
				$view_mode = '';
			}
			if ($view_mode == ''){
				show_404();
			}else {
				if ($view_mode == 'seller'){
					$this->db->select('p.*,pAr.attr_name as attr_type,sp.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
					$this->db->where('p.sell_id = "'.$sid.'" and p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
					$order_details = $this->db->get();
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid','sell_id'=>$sid));
				}else {
					//$order_details = $this->user_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
					$this->db->select('p.*,pAr.attr_name as attr_type,sp.attr_name');
					$this->db->from(PAYMENT.' as p');
					$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
					$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
					$this->db->where("p.status = 'Paid' and p.dealCodeNumber = '".$dealCode."'");
					$order_details = $this->db->get();
				}
				if ($order_details->num_rows()==0){
					show_404();
				}else {
					if ($view_mode == 'user'){
						$this->data['user_details'] = $this->data['userDetails'];
						$this->data['seller_details'] = $this->user_model->get_all_details(USERS,array('id'=>$sid));
					}elseif ($view_mode == 'seller'){
						$this->data['user_details'] = $this->user_model->get_all_details(USERS,array('id'=>$uid));
						$this->data['seller_details'] = $this->data['userDetails'];
					}
					foreach ($order_details->result() as $order_details_row){
						$this->data['prod_details'][$order_details_row->product_id] = $this->user_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
					}
					$this->data['view_mode'] = $view_mode;
					$this->data['order_details'] = $order_details;
					$sortArr1 = array('field'=>'date','type'=>'desc');
					$sortArr = array($sortArr1);
					$this->data['order_comments'] = $this->user_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
					$this->load->view('site/user/display_order_reviews',$this->data);
				}
			}
		}
	}
	/********* Coding for display add feedback form for user product *********/

	public function display_user_product_feedback($product_id)
	{
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$id =  array('id'=>$product_id);
			$this->data['userVal'] = $this->product_model->get_all_details(PRODUCT,$id);
			$this->data['feedback_details'] = $this->product_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id'=>$this->checkLogin('U'),'product_id'=>$product_id));
			$this->load->view('site/user/add_user_product_feedback',$this->data);
		}
	}


	/********* Coding for add feedback for user product *********/

	public function add_user_product_feedback()
	{
		$user_id = $this->input->post('rate');
		$rating = $this->input->post('rating_value');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$product_id = $this->input->post('product_id');
		$seller_id = $this->input->post('seller_id');
		if($user_id!='')
		{
			$this->user_model->simple_insert(PRODUCT_FEEDBACK,array('title' => $title,'description' => $description,'product_id' => $product_id,'seller_id'=>$seller_id,'rating' => $rating, 'voter_id' => $user_id,'status'=>'InActive'));
			if($this->lang->line('ur_feedback_add_succ') != '')
			$lg_err_msg = $this->lang->line('ur_feedback_add_succ');
			else
			$lg_err_msg = 'Your feedback added successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			//redirect($base_url);
			echo "<script>window.history.go(-1)</script>";

		}
	}


	public function post_order_comment(){
		if ($this->checkLogin('U') != ''){
			$this->user_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}

	public function change_received_status(){
		if ($this->checkLogin('U')!=''){
			$status = $this->input->post('status');
			$rid = $this->input->post('rid');
			$this->user_model->update_details(PAYMENT,array('received_status'=>$status),array('id'=>$rid));
		}
	}

	/******************Invite Friends********************/
	public function invite_friends(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Invite Friends';
			$this->load->view('site/user/invite_friends',$this->data);
		}
	}
     public function app_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/get_twitter_user';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}
	
	public function find_friends_twitter(){
		$returnStr['status_code'] = 1;
		$returnStr['url'] = base_url().'twtest/invite_friends';
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	public function find_friends_gmail(){
		$returnStr['status_code'] = 1;
		error_reporting(0);
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact=new GmailGetContacts();
		$access_token=$getcontact->get_request_token($oauth, false, true, true);
		$this->session->set_userdata('oauth_token',$access_token['oauth_token']);
		$this->session->set_userdata('oauth_token_secret',$access_token['oauth_token_secret']);
		$returnStr['url'] = "https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token=".$oauth->rfc3986_decode($access_token['oauth_token']);
		$returnStr['message'] = '';
		echo json_encode($returnStr);
	}

	public function find_friends_gmail_callback(){
		include_once './invite_friends/GmailOath.php';
		include_once './invite_friends/Config.php';
		error_reporting(0);
		$oauth =new GmailOath($consumer_key, $consumer_secret, $argarray, $debug, $callback);
		$getcontact_access=new GmailGetContacts();

		$request_token=$oauth->rfc3986_decode($this->input->get('oauth_token'));
		$request_token_secret=$oauth->rfc3986_decode($this->session->userdata('oauth_token_secret'));
		$oauth_verifier= $oauth->rfc3986_decode($this->input->get('oauth_verifier'));

		$contact_access = $getcontact_access->get_access_token($oauth,$request_token, $request_token_secret,$oauth_verifier, false, true, true);
		$access_token=$oauth->rfc3986_decode($contact_access['oauth_token']);
		$access_token_secret=$oauth->rfc3986_decode($contact_access['oauth_token_secret']);
		$contacts= $getcontact_access->GetContacts($oauth, $access_token, $access_token_secret, false, true,$emails_count);

		$count = 0;
		foreach($contacts as $k => $a)
		{
			$final = end($contacts[$k]);
			foreach($final as $email)
			{
				$this->send_invite_mail($email["address"]);
				$count++;
			}
		}
		if ($count>0){
			echo "
			<script>
				alert('Invitations sent successfully');
				window.close();
			</script>
			";
		}else {
			echo "
			<script>
				window.close();
			</script>
			";
		}
	}

	public function send_invite_mail($to=''){
		if ($to != ''){
			$newsid='16';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$adminnewstemplateArr=array('logo'=> $this->data['logo'],'siteTitle'=>$this->data['siteTitle'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$this->data['userDetails']->row()->full_name,'user_name'=>$this->data['userDetails']->row()->user_name);
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
									'to_mail_id'=>$to,
									'subject_message'=>$subject,
									'body_messages'=>$message
			);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
	}
	/***************************************************/
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */