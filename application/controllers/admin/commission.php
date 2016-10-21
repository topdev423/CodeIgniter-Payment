<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to seller commission tracking
 * @author Teamtweaks
 *
 */

class Commission extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('commission_model','commission');
		if ($this->checkPrivileges('seller',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller commission tracking page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			redirect('admin/commission/display_commission_lists');
		}
	}
	
	public function display_commission_lists(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Commission Lists';
			$sellerDetails = $this->commission->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow){
					$orderDetails[$sellerDetailsRow->id] = $this->commission->get_total_order_amount($sellerDetailsRow->id);
					$refund_amt = $sellerDetailsRow->refund_amount;
					$commission_to_admin[$sellerDetailsRow->id] = 0;
					$amount_to_vendor[$sellerDetailsRow->id] = 0;
					$total_amount = 0;
					$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
					$total_orders = 0;
					if ($orderDetails[$sellerDetailsRow->id]->num_rows()==1){
						$commission_percentage = $sellerDetailsRow->commision;
						$total_amount = $orderDetails[$sellerDetailsRow->id]->row()->TotalAmt;
						$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
						$total_amount = $total_amount-$refund_amt;
						$commission_to_admin[$sellerDetailsRow->id] = $total_amount*($commission_percentage*0.01);
						if ($commission_to_admin[$sellerDetailsRow->id]<0)$commission_to_admin[$sellerDetailsRow->id]=0;
						$amount_to_vendor[$sellerDetailsRow->id] = $total_amount-$commission_to_admin[$sellerDetailsRow->id];
						if ($amount_to_vendor[$sellerDetailsRow->id]<0)$amount_to_vendor[$sellerDetailsRow->id]=0;
						$total_orders = $orderDetails[$sellerDetailsRow->id]->row()->orders;
					}
					$paidDetails = $this->commission->get_total_paid_details($sellerDetailsRow->id);
					$paid_to[$sellerDetailsRow->id] = 0;
					if ($paidDetails->num_rows()==1){
						$paid_to[$sellerDetailsRow->id] = $paidDetails->row()->totalPaid;
						if ($paid_to[$sellerDetailsRow->id]<0)$paid_to[$sellerDetailsRow->id]=0;
					}
					$paid_to_balance[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id]-$paid_to[$sellerDetailsRow->id];
					if ($paid_to_balance[$sellerDetailsRow->id]<0)$paid_to_balance[$sellerDetailsRow->id]=0;
					$this->data['total_orders'][$sellerDetailsRow->id] = $total_orders;
					$this->data['commission_to_admin'][$sellerDetailsRow->id] = $commission_to_admin[$sellerDetailsRow->id];
					$this->data['amount_to_vendor'][$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id];
					$this->data['paid_to'][$sellerDetailsRow->id] = $paid_to[$sellerDetailsRow->id];
					$this->data['paid_to_balance'][$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
				}
			}
			$this->data['sellerDetails'] = $sellerDetails;
			$this->load->view('admin/commission/display_commission_lists',$this->data);
		}
	}
	
	public function view_paid_details(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Vendor payment details';
			$sid = $this->uri->segment(4,0);
			$this->data['paidDetails'] = $this->commission->get_all_details(VENDOR_PAYMENT,array('vendor_id'=>$sid));
			$this->load->view('admin/commission/view_paid_details',$this->data);
		}
	}
	
	public function add_pay_form(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Add vendor payment';
			$sid = $this->uri->segment(4,0);
			$this->data['sellerDetails'] = $this->commission->get_all_details(USERS,array('group'=>'Seller','id'=>$sid));
			if ($this->data['sellerDetails']->num_rows()==1){
				$this->data['orderDetails'] = $this->commission->get_total_order_amount($sid);
				$commission_percentage = $this->data['sellerDetails']->row()->commision;
				$total_amount = 0;
				if ($this->data['orderDetails']->num_rows()==1){
					$total_amount = $this->data['orderDetails']->row()->TotalAmt;
				}
				$this->data['total_amount'] = $total_amount;
				$total_amount = $total_amount-$this->data['sellerDetails']->row()->refund_amount;
				$commission_to_admin = $total_amount*($commission_percentage*0.01);
				if ($commission_to_admin<0)$commission_to_admin=0;
				$amount_to_vendor = $total_amount-$commission_to_admin;
				if ($amount_to_vendor<0)$amount_to_vendor=0;
				$this->data['paidDetails'] = $this->commission->get_total_paid_details($sid);
				$paid_to = 0;
				if ($this->data['paidDetails']->num_rows()==1){
					$paid_to = $this->data['paidDetails']->row()->totalPaid;
					if ($paid_to<0)$paid_to=0;
				}
				$paid_to_balance = $amount_to_vendor-$paid_to;
				if ($paid_to_balance<0)$paid_to_balance=0;
				$this->data['commission_to_admin'] = $commission_to_admin;
				$this->data['amount_to_vendor'] = $amount_to_vendor;
				$this->data['paid_to'] = $paid_to;
				$this->data['paid_to_balance'] = $paid_to_balance;
				$this->load->view('admin/commission/add_vendor_payment',$this->data);
			}else {
				show_404();
			}
		}
	}
	
	public function add_vendor_payment(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
/*			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$trans_id = $this->input->post('transaction_id');
				$duplicateCheck = $this->commission->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','Transaction id already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$excludeArr = array('balance_due');
					$this->commission->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
					$this->setErrorMessage('success','Payment added successfully');
					redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
				}
			}
*/		
			
			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			$seller_id = $this->input->post('vendor_id');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$randNumber = mt_rand();
				$key = 'team-fancyy-clone-tweaks';
				$encrypted_string = $this->encrypt->encode($randNumber, $key);
				
				$dataArr = array(
					'transaction_id'	=>	$randNumber,
					'payment_type'		=>	'paypal',
					'amount'			=>	$amount,
					'status'			=>	'pending',
					'vendor_id'			=>	$seller_id
				);
				$this->commission->simple_insert(VENDOR_PAYMENT,$dataArr);
				$this->data['randNumber'] = $randNumber;
				$this->data['code'] = $encrypted_string;
				$this->data['amount'] = $amount;
				$this->data['admin_id'] = $this->encrypt->encode($this->checkLogin('A'), $key);
				$this->data['seller_id'] = $this->encrypt->encode($seller_id, $key);
				$this->data['paypal_email'] = $this->input->post('paypal_email');
				$this->load->view('admin/commission/paypal_form',$this->data);
			}
		}
	}
	
	public function add_vendor_payment_manual(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$trans_id = $this->input->post('transaction_id');
				$duplicateCheck = $this->commission->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','Transaction id already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$excludeArr = array('balance_due');
					$this->commission->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
					$this->setErrorMessage('success','Payment added successfully');
					redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
				}
			}
		
		}
	}
	
	public function display_payment_success(){
		if ($this->checkLogin('A')!=''){
			$msg = $this->input->get('msg');
			if ($msg == 'success'){
				$key = 'team-fancyy-clone-tweaks';
				$randNumber = $this->encrypt->decode($this->input->get('trans'), $key);
				$seller_id = $this->encrypt->decode($this->input->get('sellId'),$key);
				$admin_id = $this->encrypt->decode($this->input->get('modeVal'),$key);
				if ($admin_id == $this->checkLogin('A')){
					$dataArr = array(
						'status'			=>	'success',
					);
					$this->commission->update_details(VENDOR_PAYMENT,$dataArr,array('transaction_id'=>$randNumber,'vendor_id'=>$seller_id));
					$this->data['heading'] = 'Payment Success';
					$this->load->view('admin/commission/payment_success',$this->data);
				}else {
					show_404();
				}
			}
		}else {
			show_404();
		}
	}
	
	public function display_payment_failed(){
		if ($this->checkLogin('A')!=''){
			$this->data['heading'] = 'Payment Failure';
			$this->load->view('admin/commission/payment_failed',$this->data);
		}else {
			show_404();
		}
	}
	
	
}

/* End of file commission.php */
/* Location: ./application/controllers/admin/commission.php */