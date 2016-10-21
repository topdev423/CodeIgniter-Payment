<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to notifications
 * @author Teamtweaks
 *
 */
class Notify_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
                public function get_new_notifications($searchArr=array(),$activityArr=array(),$uid='0'){
		if (count($searchArr)>0){
			$activitySearch = 'and `activity` in (';
			$activitySearchStr = '';
			foreach ($searchArr as $searchRow){
				$activitySearchStr .= '\''.$searchRow.'\',';
			}
			$activitySearchStr = substr($activitySearchStr, 0, -1);
			$activitySearch .= $activitySearchStr;
			$activitySearch .= ')';
		}else {
			$activitySearch = '';
		}
		$activityIdStr = '';
		foreach ($activityArr as $activityRow){
			$activityIdStr .= "'".$activityRow."',";
		}
		$activityIdStr = substr($activityIdStr, 0,-1);
// 		$Query = 'select * from '.NOTIFICATIONS.' where `user_id` != "1'.$uid.'" '.$activitySearch.' and created > (now() - interval 5 day) order by created desc';
 		$Query = 'select * from '.NOTIFICATIONS.' where `status`= "0" and `user_id` != "'.$uid.'" '.$activitySearch.' and `activity_id` in ('.$activityIdStr.') order by id desc limit 1000';
		return $this->ExecuteQuery($Query);
	}
        public function update_noti($uid='0'){
            $Query='update '.NOTIFICATIONS.' set status="1" where `user_id`  != "'.$uid.'" ';
            return $this->ExecuteQuery($Query);
        }


        public function get_latest_notifications($searchArr=array(),$activityArr=array(),$uid='0'){
		if (count($searchArr)>0){
			$activitySearch = 'and `activity` in (';
			$activitySearchStr = '';
			foreach ($searchArr as $searchRow){
				$activitySearchStr .= '\''.$searchRow.'\',';
			}
			$activitySearchStr = substr($activitySearchStr, 0, -1);
			$activitySearch .= $activitySearchStr;
			$activitySearch .= ')';
		}else {
			$activitySearch = '';
		}
		$activityIdStr = '';
		foreach ($activityArr as $activityRow){
			$activityIdStr .= "'".$activityRow."',";
		}
		$activityIdStr = substr($activityIdStr, 0,-1);
// 		$Query = 'select * from '.NOTIFICATIONS.' where `user_id` != "1'.$uid.'" '.$activitySearch.' and created > (now() - interval 5 day) order by created desc';
 		$Query = 'select * from '.NOTIFICATIONS.' where `user_id` != "'.$uid.'" '.$activitySearch.' and `activity_id` in ('.$activityIdStr.') order by id desc limit 1000';
		return $this->ExecuteQuery($Query);
	}
	
	public function get_active_sell_products($condition='',$fields=''){
		$Query = "select ".$fields." from ".PRODUCT." p 
				LEFT JOIN ".USERS." u on (u.id=p.user_id) ".$condition;
		return $this->ExecuteQuery($Query);
	}
	
}