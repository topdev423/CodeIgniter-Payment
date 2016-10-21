<?php
require 'src/facebook.php';
include('../commonsettings/fc_admin_settings.php');


$basepathurl = $config['base_url'];
$callback_website_url=$config['base_url'].'googlelogin/facebookRedirect';
$app_id = $config['facebook_app_id'];;
$app_secret = $config['facebook_app_secret'];;

$my_url = $basepathurl.'facebook/user.php'; 
session_start(); 

if(isset($_REQUEST["code"]))
{
 $code = $_REQUEST["code"];
}
else
{
	 $code = 0;
}

  
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
     $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'] . "&scope=email,user_birthday,read_stream";

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }

   
   if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
       . "&client_secret=" . $app_secret . "&code=" . $code;
	   
			$URL = $token_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent = curl_exec($curl_handle);
			curl_close($curl_handle);



     $response = $pageContent;
	 //echo "<pre>";print_r($response);//die;
     $params = null;
     parse_str($response, $params);

     $_SESSION['access_token'] = $params['access_token'];

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

	$FBlogout='https://www.facebook.com/logout.php?next='.$basepathurl.'user/logout.html%3Fsecret%3D&access_token='.$params['access_token'];


			$URL1 = $graph_url;
			$curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$URL1);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			$pageContent1 = curl_exec($curl_handle);
			curl_close($curl_handle);





//echo $pageContent1;die;



     $user = json_decode($pageContent1);
//	echo "<pre>";print_r($user);die;
	 if(!empty($user))
	 {
		 $_SESSION['email']=$user->email;
		 $_SESSION['first_name']=$user->first_name;
		 
		 $_SESSION['last_name']=$user->last_name;
		// header('Location: http://www.example.com/');
		//echo 'Location: '.$callback_website_url;die;
		$picturtmp_name = 'fb-'.$user->username;
		$_SESSION['fb_user_id'] = $user->id;
		$profile_Image = 'http://graph.facebook.com/'.$user->username.'/picture?width=200&height=200';
		$_SESSION['fb_image_name'] = $picturtmp_name.'.jpg'; // insert $userImage in db table field.
		$userImage = $_SESSION['fb_image_name'];
		$savepath = '../images/users/';
		$thumb_image = file_get_contents($profile_Image);
		$thumb_file = $savepath . $userImage;
		file_put_contents($thumb_file, $thumb_image);
		 header('Location: '.$callback_website_url);
		 //redirect($callback_website_url);
		 
		}
		else
		{
		//echo 'Location: '.$basepathurl;die;
			header('Location: '.$basepathurl);
			//redirect($basepathurl);
		}
	 
	 
 
		/*if(($user)&&(!isset($_SESSION['fblv_user_id']))){<?php ?> 
		

		$mail = $user->email; 
		$fb_id = $user->id;

		//Login User
		$select = "SELECT * FROM ".USER." WHERE fb_id='$fb_id'";
		$selUserQry = $userDAO->ExecuteQuery($select,'selectassoc');
		unset($selUserQry[0]['password']);
		$SelRow= $userDAO->ExecuteQuery($select,'norows');;
		
		if($SelRow>0){
		
			$update = "update ".USER." set last_login_date = now(), last_login_ip = '".$_SERVER['REMOTE_ADDR']."',emailAddress='".$mail."' where id = '".$selUserQry[0]['id']."'";
			$userDAO->ExecuteQuery($update,'update');
					
			$_SESSION['f_dummy'] ='facebook';
			$_SESSION['f_login'] = $selUserQry[0]['fb_id'];
			$_SESSION['FBlogout']=$FBlogout;
			$_SESSION['fblv_user_id'] = $selUserQry[0]['id'];
			Redirect("index.html");exit;
		}else{
		//Insert as a User
			$random = substr(number_format(time() * rand(),0,'',''),0,6); 	
			$firstName 		= $user->first_name;
			$lastName 		= $user->last_name;
			$gender 		= $user->gender;
			$email 			= $user->email;
			$verified 		= $user->verified;
			$fb_id          = $user->id;
			$username 		= $user->username;
	
			if($email!=''){
			
			$picturtmp_name = rand(0,99).'_'.$firstName ;


			$profile_Image = 'http://graph.facebook.com/'.$username.'/picture?width400&height=500';
			$userImage = $picturtmp_name . '.jpg'; // insert $userImage in db table field.
			$savepath = '../images/user/';
			
			$thumb_image = file_get_contents($profile_Image);
			$thumb_file = $savepath . $userImage;
			file_put_contents($thumb_file, $thumb_image);
			
					
			$insQuery="INSERT INTO ".USER." (emailAddress,fname,lname,status,dateAdded,verify,fb_id,userImage,last_login_ip) VALUES('".$email."','".$firstName."','".$lastName."','Active',now(),'".$verified."','".$fb_id."','".$userImage."','".$_SERVER['REMOTE_ADDR']."') ";
			 $selUserQry = $userDAO->ExecuteQuery($insQuery,'insert');	
			 $id= mysql_insert_id();		
			 
				$_SESSION['f_dummy'] ='facebook';			
				$_SESSION['FBlogout']=$FBlogout;
				$_SESSION['f_login'] = $fb_id;
				$_SESSION['fblv_user_id'] = $id;
				$update = "update ".USER." set last_login_date = now(), last_login_ip = '".$_SERVER['REMOTE_ADDR']."' where id = '".$id."'";
				$userDAO->ExecuteQuery($update,'update');
		
			
							
		$subject = 'Welcome to '.$json_result[0]['site_name'].' - Thank you for Registration using Facebook';
		$message = '<body background="'.BASE_PATH.'images/main-bg.gif" leftmargin="0" rightmargin="15" topmargin="15" bottommargin="0" >
					
<div style="width:600px;background:#FFFFFF; margin:0 auto; border-radius:10px;-webkit-border-radius:10px;-moz-border-radius:10px;-ms-border-radius:10px;-o-border-radius:10px; box-shadow:0 0 5px #ccc; -webkit-box-shadow:0 0 5px #ccc;-moz-box-shadow:0 0 5px #ccc;-ms-box-shadow:0 0 5px #ccc;-o-box-shadow:0 0 5px #ccc; border:1px solid #b9b9b9;">

<div style="background:#C9CACB; padding:10px; border-radius:10px 10px 0 0;-webkit-border-top-left-radius:10px;-webkit-border-top-right-radius:10px;-moz-border-top-left-radius:10px;-moz-border-top-right-radius:10px;-ms-border-top-left-radius:10px;-ms-border-top-right-radius:10px;-o-border-top-left-radius:10px;-o-border-top-right-radius:10px; text-align:center;">
    
   <div style="float:left; width:50%;"> <a href="'.BASE_PATH.'" target="_blank"><img src="'.LOGO_PATH.$json_result[0]['logo_image'].'" style="border:none;"  alt="'.$json_result[0]['site_name'].'" width="300" height="55" /></a></div>
	<div style="float:right; width:50%; text-align:right; font-family:Myriad Pro; font-size:20px; color:#11367E; padding-top:30px;">'.date('l').', '.date('M').'  '.date('d').', '.date('Y').'</div>
    <div style="clear:both;"></div>
    
    </div>
    
    <div style=" background:#FFFFFF; padding:10px; width:580px;">
 		<div style="font-family:Myriad Pro; font-size:24px; color:#bc240c; padding-bottom:15px;">Thank You for Registering '.$json_result[0]['site_name'].' using Facebook</div>

	<div  style="font-family:Myriad Pro; font-size:16px; color:#000;padding-bottom:15px; line-height:24px; text-align:justify;">You are now a part of an exclusive community of '.ucfirst($json_result[0]['site_name']).'</div>
	<div  style="font-family:Myriad Pro; font-size:16px; color:#000;padding-bottom:15px; line-height:24px; text-align:justify;">To login to the site, just <a href="'.BASE_PATH.'signin.html" target="_blank"> signin</a> here with this email address: '.$email.'</div>

	<div  style="font-family:Myriad Pro; font-size:18px; color:#000;padding-bottom:15px;">Regards</div>
	<div  style="font-family:Myriad Pro; font-size:18px; color:#000;padding-bottom:15px;">'.strtoupper($json_result[0]['site_name'].' Team').'</div>
  </div>
    
    
    <div style="background:#C9CACB; padding:10px; width:580px;border-radius:0 0 10px 10px;-webkit-border-bottom-left-radius:10px;-webkit-border-bottom-right-radius:10px;-moz-border-bottom-left-radius:10px;-moz-border-bottom-right-radius:10px;-ms-border-bottom-left-radius:10px;-ms-border-bottom-right-radius:10px;-o-border-bottom-left-radius:10px;-o-border-bottom-right-radius:10px;">
    
    
   <div style="font-size:13px; font-weight:normal; font-family:Myriad Pro; color:#000;  text-align:center; padding-bottom:10px;">'.$json_result[0]['footer_content'].' </div>  
   
    <div style="font-size:13px; font-weight:normal; font-family:Myriad Pro; color:#000;  text-align:center;padding-bottom:10px;  ">Visit us on the web at: <a href="'.BASE_PATH.'index.html" style="color:#990000;text-decoration:none;" target="_blank">'.$json_result[0]['site_url'].'</a></div>

 <div style="font-size:13px; font-weight:normal; font-family:Myriad Pro; color:#000;  text-align:center; padding-bottom:10px; ">Email us:  <a href="mailto:'.$json_result[0]['support_email'].'" style="color:#990000;text-decoration:none;">'.$json_result[0]['support_email'].'</a></div>

  </div>

</div>
</body>'; 
							
			$res = $userDAO->pearEmailSending(strip_tags($json_result[0]['support_email']),$email,$subject,$message);				
				
		Redirect("index.html");exit;
		
		}else{ 
		
		$res1 =$userDAO->setErrorMessage('error',"Your FB Account is currently enabled with Privacy Setting. Please Register in ".$json_result[0]['site_name'].". ");
		
		Redirect("user/login.html");
		}
		
	}

   <?php ?>}*/
   
   }
   
   
			
	