<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Footer_model extends My_Model
{

	public function add_product($dataArr=''){
		$this->db->insert(PRODUCT,$dataArr);
	}


	public function edit_product($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(PRODUCT,$dataArr);
	}


	public function view_product($condition=''){
		return $this->db->get_where(PRODUCT,$condition);
			
	}
	
		public function view_affliated($condition=''){
		return $this->db->get_where(USER_PRODUCTS,$condition);
			
	}



}

?>