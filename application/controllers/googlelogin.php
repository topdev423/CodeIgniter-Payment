<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Googlelogin extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	public function index()
	{
		$this->googleLoginProcess();
	}

	/* Job seeker login, registraiton and forgot password start*/

	function googleLoginProcess()
	{

		$getFileNameArray = explode('/',$profile_image_url);

		$fileNameDetails = $getFileNameArray[7];
			
		$url = $twConnectId->profile_image_url;
		$img = 'images/users/'.$fileNameDetails ;
		file_put_contents($img, file_get_contents($url));


		$url = $profile_image_url;
		$img = 'images/users/'.$fileNameDetails ;
		file_put_contents($img, file_get_contents($url));

		/*@mysql_query("INSERT INTO google_users (api_id, full_name,email, thumbnail) VALUES ($user_id, '$user_name','$email','$fileNameDetails')");*/

		$google_login_details = array('social_login_name'=>$user_name,'social_login_unique_id'=>$user_id,'screen_name'=>$user_name,'social_image_name'=>$fileNameDetails);

		$_SESSION['social_login_name']=$user_name;
		$_SESSION['social_login_unique_id']=$user_id;
		$_SESSION['screen_name']=$user_name;
		$_SESSION['social_image_name']=$fileNameDetails;
		//redirect('signup');
		header( 'Location: '.$originalBasePath.'signup' );

	}

	function googleRedirect()
	{
		require_once 'google-login-mats/index.php';

		$user_name  = '';
		$email = '';
		if (isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			//header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}


		if (isset($_SESSION['token']))
		{
			$gClient->setAccessToken($_SESSION['token']);
		}


		if ($gClient->getAccessToken())
		{
			//Get user details if user is logged in
			$user 				= $google_oauthV2->userinfo->get();
			$user_id 				= $user['id'];
			$user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			$email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			$profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
			$profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
			$personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
				
			$_SESSION['token'] 	= $gClient->getAccessToken();
		}
		else
		{
			//get google login url
			$authUrl = $gClient->createAuthUrl();
		}





			
		if($email != '')
		{
			$googleLoginCheck = $this->user_model->googleLoginCheck($email);

				
			if($googleLoginCheck > 0)
			{
				//echo "login";
				$getGoogleLoginDetails = $this->user_model->google_user_login_details($email);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;

				$userdata = array(
							'fc_session_user_id' => $getGoogleLoginDetails['id'],
							'session_user_name' => $getGoogleLoginDetails['user_name'], 
							'session_user_email' => $getGoogleLoginDetails['email'] 
				);
				//echo "<pre>";print_r($userdata);die;
				$this->session->set_userdata($userdata);

				if($this->data['login_succ_msg'] != '')
				$lg_err_msg = $this->data['login_succ_msg'];
				else
				$lg_err_msg = 'You are Logged In ...';
				$this->setErrorMessage('success',$lg_err_msg);
				redirect(base_url());
			}
			else
			{

				$google_login_details = array('social_login_name'=>$user_name,'social_login_unique_id'=>'','screen_name'=>$user_name,'social_image_name'=>'','social_email_name'=>$email,'loginUserType'=>'google');
				//echo "<pre>";print_r($google_login_details);die;
				//echo "redirect to registration page";
				$social_login_name = $user_name;
				$this->session->set_userdata($google_login_details);
				redirect('signup');
			}
		}
		else
		{
			redirect('');
		}
	}

	function facebookRedirect()
	{
		@session_start();
		//echo $_SESSION['email'];die;

		if($_SESSION['email'] !='')
		{
			$facebookLoginCheck = $this->user_model->googleLoginCheck($_SESSION['email']);
				
			if($facebookLoginCheck > 0)
			{
				//echo "login";
				$getFacebookLoginDetails = $this->user_model->google_user_login_details($_SESSION['email']);
				//echo "<pre>";print_r($getGoogleLoginDetails);die;
				$userdata = array(
							'fc_session_user_id' => $getFacebookLoginDetails['id'],
							'session_user_name' => $getFacebookLoginDetails['user_name'], 
							'session_user_email' => $getFacebookLoginDetails['email'] 
				);
				$this->session->set_userdata($userdata);
				$this->setErrorMessage('success','Login successfully');
				redirect(base_url());
			}
			else
			{

				$google_login_details = array('social_login_name'=>$_SESSION['first_name'],'social_login_unique_id'=>'','screen_name'=>$_SESSION['first_name'],'social_image_name'=>$_SESSION['fb_image_name'],'social_email_name'=>$_SESSION['email'],'loginUserType'=>'facebook');
					
				//echo "redirect to registration page";
				$social_login_name = $_SESSION['first_name'];
				$this->session->set_userdata($google_login_details);
				//echo $a =$this->session->userdata($twise);
				redirect('signup');
					
			}
		}
		else
		{
			redirect('');
		}


		//echo "<pre>";print_r($_REQUEST);die;
		//echo "hi";die;
	}




}