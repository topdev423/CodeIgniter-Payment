<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to fancyy box
 * @author Teamtweaks
 *
 */
class Fancybox_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Fancybox card details
    * @param String $condition
    */
   public function get_fancybox_details($condition=''){
   		$Query = " select * from ".FANCYYBOX_USES." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   
   
    public function get_fancybox_count_details(){
   		$Query = " select name,count(*) as totCount from ".FANCYYBOX_USES." GROUP BY fancybox_id order by created DESC  ";
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_fancybox_View_details(){
   		$Query = " select a.status,a.indtotal,a.name,a.user_id,b.full_name from ".FANCYYBOX_USES." a join ".USERS." b on a.user_id = b.id LIMIT 0,10";
   		return $this->ExecuteQuery($Query);
   }
   
   public function get_fancybox_list_details(){
   		$Query = " select a.*,b.full_name from ".FANCYYBOX_USES." a join ".USERS." b on a.user_id = b.id ";
   		return $this->ExecuteQuery($Query);
   }
	
}