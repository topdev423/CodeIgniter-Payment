<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twtest extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('user_model','product_model'));

		$this->load->library('twconnect');
		$this->load->helper('url');
	}

	public function index() {



		echo '<p><a href="' . base_url() . 'twtest/redirect">Connect to Twitter</a></p>';
		echo '<p><a href="' . base_url() . 'twtest/clearsession">Clear session</a></p>';

		echo 'Session data:<br/><pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
	}

	/* redirect to Twitter for authentication */
	public function redirect() {

		$twitter_data = $this->session->userdata('tw_access_token');
		$twitter_data_status = $this->session->userdata('tw_status');
		$fc_session_temp_id = $this->session->userdata('fc_session_temp_id');
		$this->session->unset_userdata($twitter_data);
		$this->session->unset_userdata($twitter_data_status);
		$this->session->unset_userdata($fc_session_temp_id);
		//echo "<pre>";print_r($this->session->all_userdata);
		//redirect('twtest/redirect');
		$this->load->library('twconnect');

		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */
		$ok = $this->twconnect->twredirect('twtest/callback');
		//		$ok = $this->twconnect->twredirect('twtest/callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}


	/* return point from Twitter */
	/* you have to call $this->twconnect->twprocess_callback() here! */
	public function callback() {
		$this->load->library('twconnect');

		$ok = $this->twconnect->twprocess_callback();

		if ( $ok ) { redirect('twtest/success'); }
		else redirect ('twtest/failure');
	}


	/* authentication successful */
	/* it should be a different function from callback */
	/* twconnect library should be re-loaded */
	/* but you can just call this function, not necessarily redirect to it */
	public function success() {

		echo 'Twitter connect succeded<br/>';
		echo '<p><a href="' . base_url() . 'twtest/clearsession">Do it again!</a></p>';

		$this->load->library('twconnect');
		$this->load->library('session');
		// saves Twitter user information to $this->twconnect->tw_user_info
		// twaccount_verify_credentials returns the same information
		$this->twconnect->twaccount_verify_credentials();



		echo 'Authenticated user info ("GET account/verify_credentials"):<br/><pre>';


		$twConnectId = $this->twconnect->tw_user_info;

		$twitterId = $twConnectId->id;
		$this->load->model('user_model');
		$twitterCountById = $this->user_model->social_network_login_check($twitterId);

		$a = $this->session->all_userdata();


		$aa= $this->session->userdata('tw_access_token');

		if($twitterCountById != 0)
		{

			//echo "redirect to login success page";
			$getLoginDetails = $this->user_model->get_social_login_details($twitterId);
			$userdata = array(
							'fc_session_user_id' => $getLoginDetails['id'],
							'session_user_name' => $getLoginDetails['user_name'], 
							'session_user_email' => $getLoginDetails['email'] 
			);
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

			$getFileNameArray = explode('/',$twConnectId->profile_image_url);

			$fileNameDetails = $getFileNameArray[5];

			if($fileNameDetails != '')
			{
				$fileNameDetails = $getFileNameArray[5];
			}
			else
			{
				$fileNameDetails = '';
			}

			$twitter_login_details = array('social_login_name'=>$twConnectId->name,'social_login_unique_id'=>$twConnectId->id,'screen_name'=>$twConnectId->screen_name,'social_image_name'=>$fileNameDetails);


			$url = $twConnectId->profile_image_url;
			$img = 'images/users/'.$fileNameDetails ;
			file_put_contents($img, file_get_contents($url));


			//echo "redirect to registration page";
			$social_login_name = $twConnectId->name;
			$this->session->set_userdata($twitter_login_details);
			//echo $a =$this->session->userdata($twise);
			redirect('signup');


			//redirect("signup#");
		}
		//echo "<br>".count($twitterQueryDetails);





	}


	/* authentication un-successful */
	public function failure() {

		//echo '<p>Twitter connect failed</p>';
		//echo '<p><a href="' . base_url() . 'twtest/clearsession">Try again!</a></p>';
		redirect('signup');
	}


	/* clear session */
	public function clearsession() {

		//$this->session->sess_destroy();
		$tw_data_arr = array(
		'tw_access_token'=>'',
		'tw_status'=>'',
		'social_login_name'=>'',
		'social_login_unique_id'=>'',
		'social_image_name'=>'',
		'tw_request_token'=>'',
		'screen_name'=>''
		);
		$this->session->unset_userdata($tw_data_arr);
	}

	/********************************For Invite Friends Start***************Vinu***********Nov-5-2013**************/

	public function invite_friends(){

		$this->clearsession();
		$ok = $this->twconnect->twredirect('twtest/invite_callback');

		if (!$ok) {
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}

	public function invite_callback(){

		$ok = $this->twconnect->twprocess_callback();

		if ( $ok )
		redirect('twtest/invite_success');
		else
		redirect ('twtest/invite_failure');
	}

	public function invite_success(){
		$this->twconnect->twaccount_verify_credentials();
		$tw_user_info = $this->twconnect->tw_user_info;
		$twitterId = $tw_user_info->id;
		$twitterName = $tw_user_info->screen_name;
		$twitterFriends = $tw_user_info->friends_count;
		if ($twitterFriends>0){
			$param_arr = array(
			'screen_name'=>$twitterName
			);
			$tw_friends_list = $this->twconnect->tw_get('https://api.twitter.com/1.1/followers/ids.json',$param_arr);
			$tw_friends_list_arr = $tw_friends_list->ids;
			if (count($tw_friends_list_arr)>0){
				$invite_text = 'Invites you to join on '.$this->data['siteTitle'].' ('.base_url().'?ref='.$this->data['userDetails']->row()->user_name.')';
				foreach ($tw_friends_list_arr as $tw_friend_id){
					if ($tw_friend_id != ''){
						$param_arr = array(
						'text'=>$invite_text,
						'user_id'=>$tw_friend_id
						);
						$msg_res = $this->twconnect->tw_post('https://api.twitter.com/1.1/direct_messages/new.json',$param_arr);
					}
				}
				echo "
				<script>
					alert('Invitations sent successfully');
					window.close();
				</script>
				";
			}
		}else {
			echo "
			<script>
				alert('No followers in your twitter account');
				window.close();
			</script>
			";
		}
	}

	public function invite_failure(){
		echo "
		<script>
			window.close();
		</script>
		";
	}

	/********************************For Invite Friends End***************Vinu***********Nov-5-2013**************/
}