<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to cms management
 * @author Teamtweaks
 *
 */
class Cms_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	function get_all_details($table='',$condition='',$sortArr=''){
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		return $this->db->get_where($table,$condition);
	}

}