<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */

class Cart extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('cart_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->cart_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->cart_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		//$this->data['MiniCartViewSet'] = $this->cart_model->mini_cart_view($this->data['common_user_id']);
	}


	/**
	 *
	 * Loading Cart Page
	 */

	public function index(){
			
		if ($this->data['loginCheck'] != ''){
			$this->data['heading'] = 'Cart';
			$this->data['cartViewResults'] = $this->cart_model->mani_cart_view($this->data['common_user_id']);
			$this->data['countryList'] = $this->cart_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
			$this->load->view('site/cart/cart.php',$this->data);
		}else{
			redirect('login');
		}
	}


	/****************** Insert the cart to user********************/

	public function insertEditCart(){

		$excludeArr = array('addtocart');
		$dataArrVal = array();
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}

		$datestring = "%Y-%m-%d 23:59:59";
		$code = $this->get_rand_str('10');
		$exp_days = $this->config->item('cart_expiry_days');

		$dataArry_data = array('expiry_date' => mdate($datestring,strtotime($exp_days.' days')), 'code' => $code,'user_id' => $this->data['common_user_id']);
		$dataArr = array_merge($dataArrVal,$dataArry_data);

		$condition ='';

		$this->cart_model->commonInsertUpdate(GIFTCARDS_TEMP,'insert',$excludeArr,$dataArr,$condition);

		if ($this->checkLogin('U') != ''){
			if($this->lang->line('gift_add_success') != '')
				$lg_err_msg = $this->lang->line('gift_add_success');
			else 
				$lg_err_msg = 'Giftcard Added You Cart successfully';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('gift-cards');
		}else{
			redirect('login');
		}
	}


	public function cartadd(){

		$excludeArr = array('addtocart','attr_color','mqty');
		$dataArrVal = array();
		$mqty = $this->input->post('mqty');
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}

		$datestring = date('Y-m-d H:i:s',now());
		$indTotal = ( $this->input->post('price') + $this->input->post('product_shipping_cost') + ($this->input->post('price') * 0.01 * $this->input->post('product_tax_cost')) ) * $this->input->post('quantity');

		$dataArry_data = array('created' => $datestring, 'user_id' => $this->data['common_user_id'], 'indtotal' => $indTotal, 'total' => $indTotal);
		$dataArr = array_merge($dataArrVal,$dataArry_data);

		$condition ='';

		$this->data['productVal'] = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'product_id' => $this->input->post('product_id'),'attribute_values' => $this->input->post('attribute_values')));
		$for_qty_check = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'product_id' => $this->input->post('product_id')));

		if($for_qty_check->num_rows > 0){
			$new_tot_qty = 0;
			foreach ($for_qty_check->result() as $for_qty_check_row){
				$new_tot_qty += $for_qty_check_row->quantity;
			}
			$new_tot_qty += $this->input->post('quantity');
			if ($new_tot_qty <= $mqty){
				if ($this->data['productVal']->num_rows > 0){
					$newQty = $this->data['productVal']->row()->quantity + $this->input->post('quantity');
					$indTotal = ( $this->input->post('price') + $this->input->post('product_shipping_cost') + ($this->input->post('price') * 0.01 * $this->input->post('product_tax_cost')) ) * $newQty ;
					$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
					$condition =array('id' => $this->data['productVal']->row()->id);
					$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);
				}else {
					$this->cart_model->commonInsertUpdate(SHOPPING_CART,'insert',$excludeArr,$dataArr,$condition);
				}
			}else{
				$cart_qty = $new_tot_qty - $this->input->post('quantity');
				echo 'Error|'.$cart_qty; die;
			}
		}else{
			$this->cart_model->commonInsertUpdate(SHOPPING_CART,'insert',$excludeArr,$dataArr,$condition);
		}

		if ( $this->checkLogin('U')!= ''){
			/***Mini cart Lg****/

			$mini_cart_lg = array();

			if($this->lang->line('items') != '')
			$mini_cart_lg['lg_items'] =  stripslashes($this->lang->line('items'));
			else
			$mini_cart_lg['lg_items'] =  "items";

			if($this->lang->line('header_description') != '')
			$mini_cart_lg['lg_description'] =  stripslashes($this->lang->line('header_description'));
			else
			$mini_cart_lg['lg_description'] =  "Description";

			if($this->lang->line('qty') != '')
			$mini_cart_lg['lg_qty'] =  stripslashes($this->lang->line('qty'));
			else
			$mini_cart_lg['lg_qty'] =  "Qty";

			if($this->lang->line('giftcard_price') != '')
			$mini_cart_lg['lg_price'] =  stripslashes($this->lang->line('giftcard_price'));
			else
			$mini_cart_lg['lg_price'] =  "Price";

			if($this->lang->line('order_sub_total') != '')
			$mini_cart_lg['lg_sub_tot'] =  stripslashes($this->lang->line('order_sub_total'));
			else
			$mini_cart_lg['lg_sub_tot'] =  "Order Sub Total";

			if($this->lang->line('proceed_to_checkout') != '')
			$mini_cart_lg['lg_proceed'] =  stripslashes($this->lang->line('proceed_to_checkout'));
			else
			$mini_cart_lg['lg_proceed'] =  "Proceed to Checkout";

			/***Mini cart Lg****/

			echo 'Success|'.$this->cart_model->mini_cart_view($this->data['common_user_id'],$mini_cart_lg);
		}else{
			echo 'login|lgoin';
		}
	}


	public function ajaxUpdate(){
		$excludeArr = array('id','qty','updval');

		$productVal = $this->cart_model->get_all_details(SHOPPING_CART,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('updval')));

		$newQty = $this->input->post('qty');
		$indTotal = ( $productVal->row()->price + $productVal->row()->product_shipping_cost + ($productVal->row()->price * 0.01 * $productVal->row()->product_tax_cost) ) * $newQty ;
			
		$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
		$condition =array('id' => $productVal->row()->id);
		$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition);

		echo number_format($indTotal,2,'.','').'|'.$this->data['CartVal'] = $this->cart_model->mani_cart_total($this->data['common_user_id']);

		return;
	}


	public function ajaxDelete(){

		$delt_id = $this->input->post('curval');
		$CondID = $this->input->post('cart');
		if($CondID =='gift'){
			$this->db->delete(GIFTCARDS_TEMP, array('id' => $delt_id));
			echo $this->data['GiftVal'] = $this->cart_model->mani_gift_total($this->data['common_user_id']);
		}elseif($CondID =='subscribe'){
			$this->db->delete(FANCYYBOX_TEMP, array('id' => $delt_id));
			echo $this->data['SubscribeVal'] = $this->cart_model->mani_subcribe_total($this->data['common_user_id']);
		}elseif($CondID == 'cart'){
			$this->db->delete(SHOPPING_CART, array('id' => $delt_id));
			echo $this->data['CartVal'] = $this->cart_model->mani_cart_total($this->data['common_user_id']);
		}
		return;
	}

	public function checkCode(){

		$Code = $this->input->post('code');
		$amount = $this->input->post('amount');
		$shipamount = $this->input->post('shipamount');

		echo $this->cart_model->Check_Code_Val($Code,$amount,$shipamount,$this->data['common_user_id']);

		return;

	}
	public function checkCodeRemove(){

		$this->cart_model->Check_Code_Val_Remove($this->data['common_user_id']);
		echo $this->data['CartVal'] = $this->cart_model->mani_cart_coupon_sucess($this->data['common_user_id']);
		return;

	}
	public function checkCodeSuccess(){
		echo $this->data['CartVal'] = $this->cart_model->mani_cart_coupon_sucess($this->data['common_user_id']);
	}


	public function ajaxChangeAddress(){

		if($this->input->post('add_id') != ''){
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('add_id')));

			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $ChangeAdds->row()->country));
			$MainShipCost = number_format($ShipCostVal->row()->shipping_cost,2,'.','');
			$MainTaxCost = number_format(($this->input->post('amt') * 0.01 * $ShipCostVal->row()->shipping_tax),2,'.','');
			$TotalAmts = number_format(( ($this->input->post('amt') + $MainShipCost + $MainTaxCost) - $this->input->post('disamt')),2,'.','');

			$condition = array('user_id' => $this->data['common_user_id']);
			$dataArr2 = array('shipping_cost' => $MainShipCost, 'tax' => $ShipCostVal->row()->shipping_tax);
			$this->cart_model->update_details(SHOPPING_CART,$dataArr2,$condition);

			echo $Chg_Adds = $MainShipCost.'|'.$MainTaxCost.'|'.$ShipCostVal->row()->shipping_tax.'|'.$TotalAmts.'|'.$ChangeAdds -> row() -> full_name.'<br>'.$ChangeAdds -> row() -> address1.'<br>'.$ChangeAdds -> row() -> city.' '.$ChangeAdds -> row() -> state.' '.$ChangeAdds -> row() -> postal_code.'<br>'.$ChangeAdds -> row() -> country.'<br>'.$ChangeAdds -> row() -> phone;

		}else{
			echo '0';
		}


	}
	public function ajaxSubscribeAddress(){

		if($this->input->post('add_id') != ''){
			$ChangeAdds =  $this->cart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $this->data['common_user_id'],'id' => $this->input->post('add_id')));

			$ShipCostVal = $this->cart_model->get_all_details(COUNTRY_LIST,array( 'country_code' => $ChangeAdds->row()->country));
			$MainShipCost = number_format($ShipCostVal->row()->shipping_cost,2,'.','');
			$MainTaxCost = number_format(($this->input->post('amt') * 0.01 * $ShipCostVal->row()->shipping_tax),2,'.','');
			$TotalAmts = number_format(($this->input->post('amt') + $MainShipCost + $MainTaxCost),2,'.','');


			echo $Chg_Adds = $MainShipCost.'|'.$MainTaxCost.'|'.$ShipCostVal->row()->shipping_tax.'|'.$TotalAmts.'|'.$ChangeAdds -> row() -> full_name.'<br>'.$ChangeAdds -> row() -> address1.'<br>'.$ChangeAdds -> row() -> city.' '.$ChangeAdds -> row() -> state.' '.$ChangeAdds -> row() -> postal_code.'<br>'.$ChangeAdds -> row() -> country.'<br>'.$ChangeAdds -> row() -> phone;


		}else{
			echo '0';
		}


	}

	public function ajaxDeleteAddress(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$delID = $this->input->post('del_ID');
			$checkAddrCount = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('id' => $delID ,'primary'=>'Yes' ));

			if ($checkAddrCount->num_rows == 0){
				$this->cart_model->commonDelete(SHIPPING_ADDRESS,array('id' => $delID));
				echo '0';
			}else{
				echo '1';
			}
		}
	}

	public function insert_shipping_address(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$is_default = $this->input->post('set_default');
			if ($is_default == ''){
				$primary = 'No';
			}else{
				$primary = 'Yes';
			}
			$checkAddrCount = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
			if ($checkAddrCount->num_rows == 0){
				$primary = 'Yes';
			}
			$excludeArr = array('ship_id','set_default');
			$dataArr = array('primary'=>$primary);


			$this->cart_model->commonInsertUpdate(SHIPPING_ADDRESS,'insert',$excludeArr,$dataArr,$condition);
			$shipID = $this->cart_model->get_last_insert_id();
			if($this->lang->line('ship_add_success') != '')
				$lg_err_msg = $this->lang->line('ship_add_success');
			else 
				$lg_err_msg = 'Shipping address added successfully';
			$this->setErrorMessage('success',$lg_err_msg);

			if ($primary == 'Yes'){
				$condition = array('id !='=>$shipID,'user_id'=>$this->checkLogin('U'));
				$dataArr = array('primary'=>'No');
				$this->cart_model->update_details(SHIPPING_ADDRESS,$dataArr,$condition);
			}
			redirect('cart');
		}
	}



	public function cartcheckout(){
		if($this->input->post('Ship_address_val') !=''){
			$shipping_address = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('id'=>$this->input->post('Ship_address_val')));
			$userid = $this->checkLogin('U');
			if ($this->data['userDetails']->row()->postal_code == '' || $this->data['userDetails']->row()->postal_code == 0){
				$this->cart_model->update_details(USERS,array('postal_code'=>$shipping_address->row()->postal_code),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->address == ''){
				$this->cart_model->update_details(USERS,array('address'=>$shipping_address->row()->address1),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->address2 == ''){
				$this->cart_model->update_details(USERS,array('address2'=>$shipping_address->row()->address2),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->city == ''){
				$this->cart_model->update_details(USERS,array('city'=>$shipping_address->row()->city),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->state == ''){
				$this->cart_model->update_details(USERS,array('state'=>$shipping_address->row()->state),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->country == ''){
				$this->cart_model->update_details(USERS,array('country'=>$shipping_address->row()->country),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->phone_no == ''){
				$this->cart_model->update_details(USERS,array('phone_no'=>$shipping_address->row()->phone),array('id'=>$userid));
			}
			$userid = $this->checkLogin('U');
			$this->cart_model->addPaymentCart($userid);
			redirect("checkout/cart");
		}else{
			if($this->lang->line('add_ship_addr_msg') != '')
				$lg_err_msg = $this->lang->line('add_ship_addr_msg');
			else 
				$lg_err_msg = 'Please Add the Shipping address';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect("cart");
		}
	}

	public function Subscribecheckout(){
		if($this->input->post('SubShip_address_val') !=''){
			$shipping_address = $this->cart_model->get_all_details(SHIPPING_ADDRESS,array('id'=>$this->input->post('SubShip_address_val')));
			$userid = $this->checkLogin('U');
			if ($this->data['userDetails']->row()->postal_code == '' || $this->data['userDetails']->row()->postal_code == 0){
				$this->cart_model->update_details(USERS,array('postal_code'=>$shipping_address->row()->postal_code),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->address == ''){
				$this->cart_model->update_details(USERS,array('address'=>$shipping_address->row()->address1),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->address2 == ''){
				$this->cart_model->update_details(USERS,array('address2'=>$shipping_address->row()->address2),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->city == ''){
				$this->cart_model->update_details(USERS,array('city'=>$shipping_address->row()->city),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->state == ''){
				$this->cart_model->update_details(USERS,array('state'=>$shipping_address->row()->state),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->country == ''){
				$this->cart_model->update_details(USERS,array('country'=>$shipping_address->row()->country),array('id'=>$userid));
			}
			if ($this->data['userDetails']->row()->phone_no == ''){
				$this->cart_model->update_details(USERS,array('phone_no'=>$shipping_address->row()->phone),array('id'=>$userid));
			}
			$this->cart_model->addPaymentSubscribe($userid);
			redirect("checkout/subscribe");
		}else{
			if($this->lang->line('add_ship_addr_msg') != '')
				$lg_err_msg = $this->lang->line('add_ship_addr_msg');
			else 
				$lg_err_msg = 'Please Add the Shipping address';
			$this->setErrorMessage('error',$lg_err_msg);
			redirect("cart");
		}
	}

	public function getQty($pid,$val){
		if ($pid>0 && $this->checkLogin('U')!= ''&&$val>0){
			$Query = "select sum(quantity) as QTY from ".SHOPPING_CART." where product_id='".$pid."' and user_id='".$this->checkLogin('U')."' and id!='".$val."'";
			$resultArr = $this->cart_model->ExecuteQuery($Query);
			if ($resultArr->num_rows()>0){
				$qty = $resultArr->row()->QTY;
				if ($qty==''){
					$qty = 0;
				}
			}else {
				$qty = 0;
			}
		}else {
			$qty = 0;
		}
		echo $qty;
	}
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */