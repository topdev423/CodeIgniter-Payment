<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to commission management
 * @author Teamtweaks
 *
 */
class Commission_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function get_total_order_amount($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal ,u.full_name from fc_users u
			JOIN fc_payment p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' group by p.dealCodeNumber
			) pr";
		return $this->ExecuteQuery($Query);
	}
	
	public function get_total_paid_details($sid='0'){
		$Query = "select sum(amount) as totalPaid from ".VENDOR_PAYMENT." where `status`='success' and `vendor_id`='".$sid."' group by `vendor_id`";
		return $this->ExecuteQuery($Query);
	}
}