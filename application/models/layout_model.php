<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Layout_model extends My_Model
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

	public function view_controller_details(){
		$this->db->select('*');
		$this->db->from(CONTROLMGMT);
		$ControlList = $this->db->get();

		//echo '<pre>'; print_r($ControlList->result()); die;
		return $ControlList;
	}
}

?>