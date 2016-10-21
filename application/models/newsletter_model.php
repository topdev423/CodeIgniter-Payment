<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Newsletter_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function send_mail_subcribers($valuesStr){
		$this->db->select('subscrip_mail');
		$this->db->from(SUBSCRIBERS_LIST);
		
		$this->db->where_in('id',$valuesStr);
		$query = $this->db->get();
		return $result = $query->result_array();
	}
	public function get_newsletter_details($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	public function send_mail_subcribers_list($valuesArr,$NewsId){
		$newsid=$NewsId->row()->id;
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('news_subject'=> $NewsId->row()->news_subject,'logo_image'=>$this->config->item('logo_image'),'logo'=> $this->data['logo'],'news_descrip'=>$NewsId->row()->news_descrip,'email'=>$this->config->item('email'),'title'=>$this->data['title']);
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$NewsId->row()->news_subject.'</title><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		foreach($valuesArr as $SubscriberEmail){		
			$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$NewsId->row()->sender_email,
							'mail_name'=>$NewsId->row()->sender_name,
							'to_mail_id'=>$SubscriberEmail['subscrip_mail'],
							'subject_message'=>strip_tags($NewsId->row()->news_descrip),
							'body_messages'=>$message
							);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
		
	}
}