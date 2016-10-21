<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Tax_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	
	public function SelectAllCountry(){
	//print_r($OrderAsc);die;

		$this->db->select('*');
		$this->db->from(LOCATIONS);
		//$this->db->where('status','Active');
		$this->db->order_by('location_name','asc');
		$query =  $this->db->get();
		
//echo $this->db->last_query();die;
		return $result = $query->result_array();
	}
	
}