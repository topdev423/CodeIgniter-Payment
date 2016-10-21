<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to Cart Page
 * @author Teamtweaks
 *
 */
class Checkout_model extends My_Model
{
	
	public function add_checkout($dataArr=''){
			$this->db->insert(PRODUCT,$dataArr);
	}

	public function edit_checkout($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT,$dataArr);
	}
	
	
	public function view_checkout($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	
	
	public function mani_gift_total($userid=''){
		
		$giftRes = $this->checkout_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$giftAmt = 0;
		if($giftRes -> num_rows() > 0 ){ 
			
			foreach ($giftRes->result() as $giftRow){
				$giftAmt = $giftAmt + $giftRow->price_value;
			}

		}
		
		return number_format($giftAmt,2,'.','');

	}
	
	public function mani_checkout_total($userid=''){
		
		
		$checkoutVal = $this->checkout_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$checkoutAmt = 0; $checkoutShippingAmt = 0; $checkoutTaxAmt = 0;
		$Shipping_Val = $this->checkout_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'dealCodeNumber' => $this->session->userdata('randomNo')));
		
		if($checkoutVal -> num_rows() > 0 ){ 
			foreach ($checkoutVal->result() as $CartRow){
				$checkoutAmt = $checkoutAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price) + $CartRow->price)  * $CartRow->quantity);
			}
			$checkoutSAmt = $Shipping_Val->row()->shippingcost;
			$checkoutTAmt = $Shipping_Val->row()->tax;
			$grantAmt = $checkoutAmt + $checkoutSAmt + $checkoutTAmt ;
			
		}
		
		$this->db->select('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
		return number_format($checkoutAmt,2,'.','').'|'.number_format($checkoutSAmt,2,'.','').'|'.number_format($checkoutTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.$countVal.'|'.number_format($query->row()->discountAmount,2,'.','').'|'.$Shipping_Val->row()->shippingid;

	}
	
	
	
	public function mani_subcribe_total($userid=''){
	
		$SubcribRes = $this->checkout_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));
		$SubcribAmt = 0; $SubcribSAmt = 0; $SubcribTAmt = 0; $SubcribTotalAmt = 0;
		if($SubcribRes -> num_rows() > 0 ){ 
			
			foreach ($SubcribRes->result() as $SubscribRow){
				$SubcribAmt = $SubcribAmt + $SubscribRow->price;
			}
			$SubcribSAmt = $SubcribRes->row()->shipping_cost;
			$SubcribTAmt = $SubcribRes->row()->tax;
			$SubcribTotalAmt = $SubcribAmt + $SubcribSAmt + $SubcribTAmt ;

		}
		
		
		return number_format($SubcribAmt,2,'.','').'|'.number_format($SubcribSAmt,2,'.','').'|'.number_format($SubcribTAmt,2,'.','').'|'.number_format($SubcribTotalAmt,2,'.','');

	}
	
	
	
	public function view_checkout_details($condition = ''){
		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$checkoutList = $this->ExecuteQuery($select_qry);
		return $checkoutList;
			
	}
	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	
	
	
	
}

?>