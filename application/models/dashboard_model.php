<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	function getCountDetails($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		
		//$this->db->where(JOB.".dateAdded >= DATE_SUB(NOW(),INTERVAL 30 DAY)", NULL, FALSE);
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	
	function getRecentDetails($tableName='',$fieldName='',$userOrderBy='',$userLimit='',$whereCondition=array())
	{
		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		$this->db->order_by($fieldName, $userOrderBy);
		$this->db->limit($userLimit);
		$countQuery = $this->db->get();
		return $countQuery->result_array();
	}
	
	function getTodayUsersCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		
		$this->db->where("created >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE);
		//$this->db->like("created",date('Y-m-d', strtotime('-24 hours')));
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	
	function getThisMonthCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		
		$this->db->where("created >= DATE_SUB(NOW(),INTERVAL 30 DAY)", NULL, FALSE);
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	
	function getLastYearCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		//date("Y");
		$this->db->like('created', date("Y"));
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
		
	}
	
	function getDashboardOrderDetails()
	{
		$this->db->from(PAYMENT);
		$this->db->order_by('id','desc');
		$this->db->limit(3);
		$this->db->group_by('dealCodeNumber');
		$orderQueryDashboard = $this->db->get();
		return $orderQueryDashboard->result_array();
		//$this->db->where($whereCondition);
	}
}