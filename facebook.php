/**
 * Facebook Login - Log in via Facebook
 * @author Daniel15 <dan.cx>
 */
 
 <?php
 class FacebookLogin
{
	const AUTHORIZE_URL = 'https://graph.facebook.com/oauth/authorize';
	const TOKEN_URL = 'https://graph.facebook.com/oauth/access_token';
	const PROFILE_URL = 'https://graph.facebook.com/me';
	
	private $client_id;
	private $client_secret;
	private $my_url;
	private $user_data;
	
	/**
	 * Create an instance of the FacebookLogin class
	 */
	public function __construct($client_id, $client_secret)
	{
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
		$this->my_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
	}
	
	/**
	 * Do a Facebook login - either redirects to Facebook or reads the returned result
	 */
	public function doLogin()
	{
		// Are we not returning from Facebook (ie. starting the login)?
		return !isset($_GET['code']) ? $this->startLogin() : $this->verifyLogin();
	}
	
	/**
	 * Start a login with Facebook - Redirect to their authentication URL
	 */
	private function startLogin()
	{
		$data = array(
			'client_id' => $this->client_id,
			'redirect_uri' => $this->my_url,
			'type' => 'web_server',
		);
		
		header('Location: ' . self::AUTHORIZE_URL . '?' . http_build_query($data));
		die();
	}
	
	/**
	 * Verify the token we receive from Facebook is valid, and get the user's details
	 */
	private function verifyLogin()
	{
		$data = array(
			'client_id' => $this->client_id,
			'redirect_uri' => $this->my_url,
			'client_secret' => $this->client_secret,
			'code' => $_GET['code'],
		);
		//echo "<pre>";print_r($data);die;

		// Get an access token
		$result = @file_get_contents(self::TOKEN_URL . '?' . http_build_query($data));
		parse_str($result, $result_array);
		//echo $result_array['access_token'];die;
		// Make sure we actually have a token
		//if (empty($result_array['access_token']))
			//throw new Exception('Invalid response received from Facebook. Response = "' . $result . '"');
		
		// Grab the user's data
		echo $this->access_token = $result_array['access_token'];die;
		$this->user_data = json_decode($this->getCurlOutput(self::PROFILE_URL . '?access_token=' . $this->access_token));
		return $this->user_data;
	}
	
	/**
	 * Helper function to get the user's Facebook info
	 */
	public function getUser()
	{
		return $this->user_data;
	}
	
	public function getCurlOutput($URL) {
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent = curl_exec($curl_handle);
			curl_close($curl_handle);
			return $pageContent;
	}
}

$facebook = new FacebookLogin('594286240609468', 'da4fee8760cbee65c330687f5eb54a06');
$user = $facebook->doLogin();
echo 'User\'s URL: ', $user->link, '<br />';
echo 'User\'s name: ', $user->name, '<br />';
echo 'Full details:<br /><pre>', print_r($user, true), '</ pre>';

?>