<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */

class Order extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('order_model');
		$this->load->model('product_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->order_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->order_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
	}


	/**
	 *
	 * Loading Order Page
	 */

	public function index(){

		if ($this->data['loginCheck'] != ''){
			$this->data['heading'] = 'Order Confirmation';
			if($this->uri->segment(2) == 'giftsuccess'){
				if($this->uri->segment(4)==''){
					$transId = $_REQUEST['txn_id'];
					$Pray_Email = $_REQUEST['payer_email'];
				}else{
					$transId = $this->uri->segment(4);
					$Pray_Email = '';
				}
				$this->data['Confirmation'] = $this->order_model->PaymentGiftSuccess($this->uri->segment(3),$transId,$Pray_Email);
				redirect("order/confirmation/gift");
			}elseif($this->uri->segment(2) == 'subscribesuccess'){
				$transId = $this->uri->segment(4);
				$Pray_Email = '';

				$this->data['Confirmation'] = $this->order_model->PaymentSubscribeSuccess($this->uri->segment(3),$transId);
				redirect("order/confirmation/subscribe");

			}elseif($this->uri->segment(2) == 'success'){
				if($this->uri->segment(5)==''){
					$transId = $_REQUEST['txn_id'];
					$Pray_Email = $_REQUEST['payer_email'];
				}else{
					$transId = $this->uri->segment(5);
					$Pray_Email = '';
				}
				$this->data['Confirmation'] = $this->order_model->PaymentSuccess($this->uri->segment(3),$this->uri->segment(4),$transId,$Pray_Email);
				redirect("order/confirmation/cart");
				//$this->load->view('site/order/order.php',$this->data);
					
			}elseif($this->uri->segment(2) == 'successgift'){

				$transId = 'GIFT'.$this->uri->segment(4);
				$Pray_Email = '';
				$this->data['Confirmation'] = $this->order_model->PaymentSuccess($this->uri->segment(3),$this->uri->segment(4),$transId,$Pray_Email);
				redirect("order/confirmation");
					
			}elseif($this->uri->segment(2) == 'failure'){
				$this->data['Confirmation'] = 'Failure';
				$this->data['errors'] = $this->uri->segment(3);
				$this->load->view('site/order/order.php',$this->data);
			}elseif($this->uri->segment(2) == 'notify'){
				$this->data['Confirmation'] = 'Failure';
				$this->load->view('site/order/order.php',$this->data);
			}elseif($this->uri->segment(2) == 'confirmation'){
				$this->data['Confirmation'] = 'Success';
				$this->load->view('site/order/order.php',$this->data);
			}


		}else{
			redirect('login');
		}
	}
	
	
	public function ipnpayment(){

		mysql_query('CREATE TABLE IF NOT EXISTS fc_transactions ( `id` int(255) NOT NULL AUTO_INCREMENT,`payment_cycle` varchar(500) NOT NULL,`txn_type` varchar(500) NOT NULL, `last_name` varchar(500) NOT NULL,`next_payment_date` varchar(500) NOT NULL, `residence_country` varchar(500) NOT NULL, `initial_payment_amount` varchar(500) NOT NULL, `currency_code` varchar(500) NOT NULL, `time_created` varchar(500) NOT NULL, `verify_sign` varchar(750) NOT NULL, `period_type` varchar(500) NOT NULL, `payer_status` varchar(500) NOT NULL, `test_ipn` varchar(500) NOT NULL, `tax` varchar(500) NOT NULL, `payer_email` varchar(500) NOT NULL, `first_name` varchar(500) NOT NULL, `receiver_email` varchar(500) NOT NULL, `payer_id` varchar(500) NOT NULL, `product_type` varchar(500) NOT NULL, `shipping` varchar(500) NOT NULL, `amount_per_cycle` varchar(500) NOT NULL, `profile_status` varchar(500) NOT NULL, `charset` varchar(500) NOT NULL, `notify_version` varchar(500) NOT NULL, `amount` varchar(500) NOT NULL, `outstanding_balance` varchar(500) NOT NULL, `recurring_payment_id` varchar(500) NOT NULL, `product_name` varchar(500) NOT NULL,`custom_values` varchar(500) NOT NULL, `ipn_track_id` varchar(500) NOT NULL, `tran_date` datetime NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;');

		mysql_query("insert into fc_transactions set  payment_cycle='".$_REQUEST['payment_cycle']."', txn_type='".$_REQUEST['txn_type']."', last_name='".$_REQUEST['last_name']."',
next_payment_date='".$_REQUEST['next_payment_date']."', residence_country='".$_REQUEST['residence_country']."', initial_payment_amount='".$_REQUEST['initial_payment_amount']."',
currency_code='".$_REQUEST['currency_code']."', time_created='".$_REQUEST['time_created']."', verify_sign='".$_REQUEST['verify_sign']."', period_type= '".$_REQUEST['period_type']."', payer_status='".$_REQUEST['payer_status']."', test_ipn='".$_REQUEST['test_ipn']."', tax='".$_REQUEST['tax']."', payer_email='".$_REQUEST['payer_email']."', first_name='".$_REQUEST['first_name']."', receiver_email='".$_REQUEST['receiver_email']."', payer_id='".$_REQUEST['payer_id']."', product_type='".$_REQUEST['product_type']."', shipping='".$_REQUEST['shipping']."', amount_per_cycle='".$_REQUEST['amount_per_cycle']."', profile_status='".$_REQUEST['profile_status']."', charset='".$_REQUEST['charset']."',
notify_version='".$_REQUEST['notify_version']."', amount='".$_REQUEST['amount']."', outstanding_balance='".$_REQUEST['payment_status']."', recurring_payment_id='".$_REQUEST['txn_id']."', product_name='".$_REQUEST['product_name']."', custom_values ='".$_REQUEST['custom']."', ipn_track_id='".$_REQUEST['ipn_track_id']."', tran_date=NOW()");


		$this->data['heading'] = 'Order Confirmation'; 

		if($_REQUEST['payment_status'] == 'Completed'){
			$newcustom = explode('|',$_REQUEST['custom']);
	
			if($newcustom[0]=='Product'){
				$userdata = array('fc_session_user_id' => $newcustom[1],'randomNo' => $newcustom[2]);
				$this->session->set_userdata($userdata);	
				$transId = $_REQUEST['txn_id'];
				$Pray_Email = $_REQUEST['payer_email'];
				$this->data['Confirmation'] = $this->order_model->PaymentSuccess($newcustom[1],$newcustom[2],$transId,$Pray_Email);	
				$this->session->unset_userdata($userdata);
			}elseif($newcustom[0]=='Gift'){
				$userdata = array('fc_session_user_id' => $newcustom[1]);
				$this->session->set_userdata($userdata);
				$transId = $_REQUEST['txn_id'];
				$Pray_Email = $_REQUEST['payer_email'];
				$this->data['Confirmation'] = $this->order_model->PaymentGiftSuccess($newcustom[1],$transId,$Pray_Email);	
				$this->session->unset_userdata($userdata);
			}

		}	
			
	}

	public function insert_product_comment(){
		$uid= $this->checkLogin('U');
		$returnStr['status_code'] = 0;
		$comments = $this->input->post('comments');
		$product_id = $this->input->post('cproduct_id');
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$conditionArr = array(
				'comments'=>$comments,
				'user_id'=>$uid,
				'product_id'=>$product_id,
				'status'=>'InActive',
				'dateAdded'=>mdate($datestring,$time)
		);
		$this->order_model->simple_insert(PRODUCT_COMMENTS,$conditionArr);
		$cmtID = $this->order_model->get_last_insert_id();
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$createdTime = mdate($datestring,$time);
		$actArr = array(
					'activity'		=>	'own-product-comment',
					'activity_id'	=>	$product_id,
					'user_id'		=>	$this->checkLogin('U'),
					'activity_ip'	=>	$this->input->ip_address(),
					'created'		=>	$createdTime,
					'comment_id'	=> $cmtID
		);
		$this->order_model->simple_insert(NOTIFICATIONS,$actArr);
		$this->send_comment_noty_mail($cmtID,$product_id);
		$this->send_comment_noty_mail_to_admin($cmtID,$product_id);
		$returnStr['status_code'] = 1;
		echo json_encode($returnStr);
	}

	public function send_comment_noty_mail($cmtID='0',$pid='0'){
		if ($this->checkLogin('U')!=''){
			if ($cmtID != '0' && $pid != '0'){
				$productUserDetails = $this->product_model->get_product_full_details($pid);
				if ($productUserDetails->num_rows()==1){
					$emailNoty = explode(',', $productUserDetails->row()->email_notifications);
					if (in_array('comments', $emailNoty)){
						$commentDetails = $this->product_model->view_product_comments_details('where c.id='.$cmtID);
						if ($commentDetails->num_rows() == 1){
							if ($productUserDetails->prodmode == 'seller'){
								$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}else {
								$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}

							$newsid='1';
							$template_values=$this->order_model->get_newsletter_template_details($newsid);
							$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'full_name'=>$commentDetails->row()->full_name,'product_name'=>$productUserDetails->row()->product_name,'user_name'=>$commentDetails->row()->user_name);
							extract($adminnewstemplateArr);
							$subject = $template_values['news_subject'];

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
								$sender_email=$this->data['siteContactMail'];
								$sender_name=$this->data['siteTitle'];
							}else{
								$sender_name=$template_values['sender_name'];
								$sender_email=$template_values['sender_email'];
							}

							$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$productUserDetails->row()->email,
												'subject_message'=>$subject,
												'body_messages'=>$message
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
						}
					}
				}
			}
		}
	}

	public function send_comment_noty_mail_to_admin($cmtID='0',$pid='0'){
		if ($this->checkLogin('U')!=''){
			if ($cmtID != '0' && $pid != '0'){
				$productUserDetails = $this->product_model->get_product_full_details($pid);
				if ($productUserDetails->num_rows()==1){
					$commentDetails = $this->product_model->view_product_comments_details('where c.id='.$cmtID);
					if ($commentDetails->num_rows() == 1){
						if ($productUserDetails->prodmode == 'seller'){
							$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
						}else {
							$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
						}

						$newsid='20';
						$template_values=$this->order_model->get_newsletter_template_details($newsid);
						$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'full_name'=>$commentDetails->row()->full_name,'product_name'=>$productUserDetails->row()->product_name,'user_name'=>$commentDetails->row()->user_name);
						extract($adminnewstemplateArr);
						$subject = $template_values['news_subject'];

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
							$sender_email=$this->data['siteContactMail'];
							$sender_name=$this->data['siteTitle'];
						}else{
							$sender_name=$template_values['sender_name'];
							$sender_email=$template_values['sender_email'];
						}

						$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$this->data['siteContactMail'],
												'subject_message'=>$subject,
												'body_messages'=>$message
						);
						$email_send_to_common = $this->product_model->common_email_send($email_values);
					}
				}
			}
		}
	}

}

