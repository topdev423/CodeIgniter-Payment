<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class User_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Users details
    * @param String $condition
    */
   public function get_users_details($condition=''){
   		$Query = " select * from ".USERS." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   
   public function insertUserQuick($fullname='',$username='',$email='',$pwd='',$brand='no'){
   
    $api_id = $this->input->post('api_id');
	$thumbnail = $this->input->post('thumbnail');
	
	if($thumbnail != '')
		$thumbnail = $thumbnail;
	else
		$thumbnail = '';
	
	/* get Referal user id start */
	
	$getReferalUserId =$this->getReferalUserId();
	
	
	/* get Referal user id end */
   		$dataArr = array(
			'full_name'	=>	$fullname,
			'user_name'	=>	$username,
			'group'		=>	'User',
			'email'		=>	$email,
			'password'	=>	md5($pwd),
			'status'	=>	'Active',
			'is_verified'=>	'No',
   			'is_brand'	=> $brand,
			'api_id'	=> $api_id,
			'thumbnail'	=> $thumbnail,
			'referId' => $getReferalUserId,
			'created'	=>	mdate($this->data['datestring'],time()),
   			'email_notifications'	=>	implode(',', $this->data['emailArr']),
	    	'notifications'			=>	implode(',', $this->data['notyArr'])
		);
		
		$this->simple_insert(USERS,$dataArr);
		if($this->session->userdata('referenceName') != '')
		{
			$this->session->unset_userdata('referenceName');
		}
		
		include('fc_mail_chimp_settings.php');
			
		if($config['mailchimp_status'] = 'Yes'){
			$mailchimp = 1;
			include('./mailchimp/mailchimpapi.php');
		}
		
   }
   
   public function updateUserQuick($fullname='',$username='',$email='',$pwd=''){
   		$dataArr = array(
			'full_name'	=>	$fullname,
			'user_name'	=>	$username,
			'password'	=>	md5($pwd)
		);
		$conditionArr = array('email'=>$email);
		$this->update_details(USERS,$dataArr,$conditionArr);
   }
   
   
   public function updategiftcard($table='',$temp_id='',$user_id=''){
   		$dataArr = array('user_id'	=>	$user_id,);
		$conditionArr = array('user_id'=>$temp_id);
		$this->update_details($table,$dataArr,$conditionArr);
   }
    
   public function get_purchase_details($uid='0'){
   	 	$Query = "select p.*,u.full_name from ".PAYMENT." p JOIN ".USERS." u on u.id=p.user_id where p.user_id='".$uid."' and p.status='Paid' group by p.dealCodeNumber order by created desc";
   	 	return $this->ExecuteQuery($Query);
   }
   
   public function get_like_details_fully($uid='0'){
   		$Query = 'select p.*,u.full_name,u.user_name,pl.rating from '.PRODUCT_RATING.' pl
   					JOIN '.PRODUCT.' p on pl.product_id=p.seller_product_id
   					LEFT JOIN '.USERS.' u on p.user_id=u.id
   					where pl.user_id='.$uid.' and p.status="Publish" order by pl.time desc';

   		return $this->ExecuteQuery($Query);
   }
   
   public function get_like_details_fully_user_products($uid='0'){
   		$Query = 'select p.*,u.full_name,u.user_name from '.PRODUCT_RATING.' pl
   					JOIN '.USER_PRODUCTS.' p on pl.product_id=p.seller_product_id
   					LEFT JOIN '.USERS.' u on p.user_id=u.id
   					where pl.user_id='.$uid.' and p.status="Publish" order by pl.time desc';
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_activity_details($uid='0',$limit='5',$sort='desc'){
   		$Query = 'select a.*,p.product_name,p.id as productID,up.product_name as user_product_name,u.full_name,u.user_name from '.USER_ACTIVITY.' a
   					LEFT JOIN '.PRODUCT.' p on a.activity_id=p.seller_product_id
   					LEFT JOIN '.USER_PRODUCTS.' up on a.activity_id=up.seller_product_id
   					LEFT JOIN '.USERS.' u on a.activity_id=u.id
   					where a.user_id='.$uid.' order by a.activity_time '.$sort.' limit '.$limit;
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_list_details($tid='0',$uid='0'){
   		$Query = 'select l.*,c.cat_name from '.LISTS_DETAILS.' l
   					LEFT JOIN '.CATEGORY.' c on l.category_id=c.id
   					where l.user_id='.$uid.' and l.product_id='.$tid.' or l.user_id='.$uid.' and l.product_id like "'.$tid.',%" or l.user_id='.$uid.' and l.product_id like "%,'.$tid.'" or l.user_id='.$uid.' and l.product_id like "%,'.$tid.',%"';
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_search_user_list($search_key='',$uid='0'){
   		$Query = 'select * from '.USERS.' where
   					`full_name` like "%'.$search_key.'%" and `id` != "'.$uid.'" and `status` = "Active"
   					or 
   					`user_name` like "%'.$search_key.'%" and `id` != "'.$uid.'" and `status` = "Active"';
   		return $this->ExecuteQuery($Query);
   }
   
   
   public function social_network_login_check($apiId='')
   {
   		 $twitterQuery = "select api_id from ".USERS." where api_id=".$apiId. " AND status='Active'";

		$twitterQueryDetails  = mysql_query($twitterQuery);
		$twitterFetchDetails = mysql_fetch_row($twitterQueryDetails);
		
		return $twitterCountById = mysql_num_rows($twitterQueryDetails);
   }
   
   public function get_social_login_details($apiId='')
   {
   		 $twitterQuery = "select * from ".USERS." where api_id=".$apiId. " AND status='Active'";

		$twitterQueryDetails  = mysql_query($twitterQuery);
		return $twitterFetchDetails = mysql_fetch_assoc($twitterQueryDetails);
		
		//return $twitterCountById = mysql_num_rows($twitterQueryDetails);
   }
   
   public function googleLoginCheck($email='')
   {
  // echo $email;die;
   		$this->db->select('id');
		$this->db->from(USERS);
		$this->db->where('email',$email);
		$this->db->where('status','Active');
		$googleQuery = $this->db->get();
		return $googleResult = $googleQuery->num_rows(); 
   }
   
   public function google_user_login_details($email='')
   {
   		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email',$email);
		$this->db->where('status','Active');
		$googleQuery1 = $this->db->get();
		return $googleResult1 = $googleQuery1->row_array(); 
   }
   
	public function getReferalUserId()
	{
		$referenceName = $this->session->userdata('referenceName');
		$referenceId = '';
		if($referenceName != '')
		{
			$this->db->select('id');
			$this->db->from(USERS);
			$this->db->where('user_name',$referenceName);
			$referQuery = $this->db->get();
			$referResult = $referQuery->row_array();
			
			if(!empty($referResult))
			{
				return $referenceId = $referResult['id'];
			}
			else
			{
				return $referenceId = '';
			}
		}
		else
		{
			return $referenceId = '';
		}
	}
	
	public function getReferalList($perpage='',$start='')
	{
		//echo $this->session->userdata('fc_session_user_id');die;
		$this->db->select('full_name,user_name,email,thumbnail');
		$this->db->from(USERS);
		$this->db->where('referId',$this->session->userdata('fc_session_user_id'));
		
		if($perpage !='')
		{
			$this->db->limit($perpage,$start);
		}			
		
		
		$this->db->order_by('id','desc');
		$referQuery = $this->db->get();
		return $referResult = $referQuery->result_array();
	}
	
	public function get_userlike_products($uid='0',$limit='5'){
		$Query = "select pl.*,p.id as pid,p.product_name,p.image from ".PRODUCT_RATING.' pl 
					JOIN '.PRODUCT.' p on pl.product_id=p.seller_product_id 
					where pl.user_id='.$uid.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	
	public function get_user_orders_list($uid='0'){
		$Query = "select *, sum(sumtotal) as TotalPrice from ".PAYMENT.' where sell_id='.$uid.' and status="Paid" group by dealCodeNumber order by created desc';
		return $this->ExecuteQuery($Query);
	}
	
	public function get_subscriptions_list($uid='0'){
		$Query = "select * from ".FANCYYBOX_USES.' where user_id='.$uid.' group by invoice_no order by created desc';
		return $this->ExecuteQuery($Query);
	}
	
	public function get_gift_cards_list($email=''){
		$Query = "select * from ".GIFTCARDS.' where recipient_mail=\''.$email.'\' order by created desc';
		return $this->ExecuteQuery($Query);
	}
	
	public function get_purchase_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image,pAr.attr_name as attr_type,sp.attr_name');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');	
		$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');	
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');	
		$this->db->where('p.user_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
	
	public function get_order_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image,pAr.attr_name as attr_type,sp.attr_name');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->join(SUBPRODUCT.' as sp' , 'sp.pid = p.attribute_values','left');
		$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = sp.attr_id','left');
		$this->db->where('p.sell_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
}