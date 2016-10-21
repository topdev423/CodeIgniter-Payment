<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Checkout extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('checkout_model');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->checkout_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->checkout_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array());
		define("API_LOGINID",$this->config->item('payment_2'));
    }
    
  
	/**
	 * 
	 * Loading Cart Page
	 */
	
	public function index(){
	 	
		if ($this->data['loginCheck'] != ''){
			$this->data['heading'] = 'Checkout'; 
			
			$this->data['checkoutViewResults'] = $this->checkout_model->mani_checkout_total($this->data['common_user_id']);	
			$this->data['GiftViewTotal'] = $this->checkout_model->mani_gift_total($this->data['common_user_id']);				
			$this->data['SubCribViewTotal'] = $this->checkout_model->mani_subcribe_total($this->data['common_user_id']);							
			//echo '<pre>'; print_r($this->data['SubCribViewTotal']); die;
			$this->data['countryList'] = $this->checkout_model->get_all_details(COUNTRY_LIST,array());	
		 	$this->load->view('site/checkout/checkout.php',$this->data);
		}else{
			redirect('login');
		}	
	}
	
	
	/****************** Insert the checkout to user********************/
	
	public function PaymentProcess(){
	
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
		//echo '<pre>';print_r($_POST); die;
	
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Products';
			
			$totalAmount = $this->input->post('total_price');
			//User ID
			$loginUserId = $this->checkLogin('U');
			//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('randomNo');
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', $loginUserId.'|'.$lastFeatureInsertId.'|Product'); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			
//			echo base_url().'order/success/'.$loginUserId.'/'.$lastFeatureInsertId; die;
			
			$this->paypal_class->submit_paypal_post(); 
						
	}
	
	public function PaymentCredit(){
	
		$excludeArr = array('creditvalue','shipping_id','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		//User ID
			$loginUserId = $this->checkLogin('U');
		//DealCodeNumber
			$lastFeatureInsertId = $this->session->userdata('randomNo');
		
		if($this->input->post('creditvalue')=='authorize'){	
			//Authorize.net Intergration

			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

			error_reporting(-1);
			define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['Login_ID']);    // Add your API LOGIN ID
			define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['Transaction_Key']); // Add your API transaction key
			define("API_MODE",$Auth_Setting_Details['mode']);

				if(API_MODE	=='sandbox'){
					define("AUTHORIZENET_SANDBOX",true);// Set to false to test against production
				}else{
					define("AUTHORIZENET_SANDBOX",false);
				}       
				define("TEST_REQUEST", "FALSE"); 
				require_once './authorize/AuthorizeNet.php';
				
				$transaction = new AuthorizeNetAIM;
				$transaction->setSandbox(AUTHORIZENET_SANDBOX);
				$transaction->setFields(
					array(
					'amount' =>  $this->input->post('total_price'), 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				//redirect('site/shopcart/returnpage/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
				redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$response->transaction_id);
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				redirect('order/failure/'.$response->response_reason_text); 
			}

		}else if($this->input->post('creditvalue')=='paypaldodirect'){	
			
			$shipValID = $this->checkout_model->get_all_details(SHIPPING_ADDRESS,array( 'id' => $this->input->post('shipping_id')));	
			//echo '<pre>';print_r($shipValID->row()); die;
		
			$PaypalDodirect = unserialize($this->data['paypal_credit_card_settings']['settings']);
			$dodirects = array(
				'Sandbox' => $PaypalDodirect['mode'], 			// Sandbox / testing mode option.
				'APIUsername' =>$PaypalDodirect['Paypal_API_Username'], 	// PayPal API username of the API caller
				'APIPassword' => $PaypalDodirect['paypal_api_password'], 	// PayPal API password of the API caller
				'APISignature' => $PaypalDodirect['paypal_api_Signature'], 	// PayPal API signature of the API caller
				'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
				'APIVersion' => '85.0'		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			);
			
			// Show Errors
			if($dodirects['Sandbox']){
				error_reporting(E_ALL);
				ini_set('display_errors', '1');
			}
			
		
			$this->load->library('Paypal_pro', $dodirects);	
		
			$DPFields = array(
							'paymentaction' => '', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
							'ipaddress' => $this->input->ip_address(), 							// Required.  IP address of the payer's browser.
							'returnfmfdetails' => '1'				// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
						);
						
						
		$CCDetails = array(
							'creditcardtype' => $this->input->post('cardType'), 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
							'acct' => $this->input->post('cardNumber'), 								// Required.  Credit card number.  No spaces or punctuation.  
							'expdate' => $this->input->post('CCExpDay').$this->input->post('CCExpMnth'), 	// Required.  Credit card expiration date.  Format is MMYYYY
							'cvv2' => $this->input->post('creditCardIdentifier'), 				// Requirements determined by your PayPal account settings.  Security digits for credit card.
							'startdate' => '', 							// Month and year that Maestro or Solo card was issued.  MMYYYY
							'issuenumber' => ''							// Issue number of Maestro or Solo card.  Two numeric digits max.
						);
						
		$PayerInfo = array(
							'email' => $this->input->post('email'), 	// Email address of payer.
							'payerid' => '', 							// Unique PayPal customer ID for payer.
							'payerstatus' => '', 	// Status of payer.  Values are verified or unverified
							'business' => '' 		
												// Payer's business name.
						);
						
		$PayerName = array(
							'salutation' => 'Mr.', 						// Payer's salutation.  20 char max.
							'firstname' => $this->input->post('full_name'), 							// Payer's first name.  25 char max.
							'middlename' => '', 						// Payer's middle name.  25 char max.
							'lastname' => '', 							// Payer's last name.  25 char max.
							'suffix' => ''								// Payer's suffix.  12 char max.
						);

//'x_amount'				=> ,
	//			'x_email'				=> $this->input->post('email'),
						
		$BillingAddress = array(
								'street' => $this->input->post('address'), 						// Required.  First street address.
								'street2' => '', 						// Second street address.
								'city' => $this->input->post('city'), 							// Required.  Name of City.
								'state' => $this->input->post('state'), 							// Required. Name of State or Province.
								'countrycode' => $this->input->post('country'), 					// Required.  Country code.
								'zip' => $this->input->post('postal_code'), 							// Required.  Postal code of payer.
								'phonenum' => $this->input->post('phone_no') 						// Phone Number of payer.  20 char max.
							);
							
		$ShippingAddress = array(
								'shiptoname' => $shipValID->row()->full_name,		// Required if shipping is included.  Person's name associated with this address.  32 char max.
								'shiptostreet' => $shipValID->row()->address1,		// Required if shipping is included.  First street address.  100 char max.
								'shiptostreet2' => $shipValID->row()->address2,  	// Second street address.  100 char max.
								'shiptocity' => $shipValID->row()->city,			// Required if shipping is included.  Name of city.  40 char max.
								'shiptostate' => $shipValID->row()->state,			// Required if shipping is included.  Name of state or province.  40 char max.
								'shiptozip' => $shipValID->row()->postal_code, 		// Required if shipping is included.  Postal code of shipping address.  20 char max.
								'shiptocountry' => $shipValID->row()->country, 		// Required if shipping is included.  Country code of shipping address.  2 char max.
								'shiptophonenum' => $shipValID->row()->phone		// Phone number for shipping address.  20 char max.
								);
							
		$PaymentDetails = array(
								'amt' => $this->input->post('total_price'), 							// Required.  Total amount of order, including shipping, handling, and tax.  
								'currencycode' => $this->data['currencyType'], 					// Required.  Three-letter currency code.  Default is USD.
								'itemamt' => '', 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
								'shippingamt' => '', 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
								'insuranceamt' => '', 					// Total shipping insurance costs for this order.  
								'shipdiscamt' => '', 					// Shipping discount for the order, specified as a negative number.
								'handlingamt' => '', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
								'taxamt' => '', 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
								'desc' => '', 							// Description of the order the customer is purchasing.  127 char max.
								'custom' => '', 						// Free-form field for your own use.  256 char max.
								'invnum' => '', 						// Your own invoice or tracking number
								'buttonsource' => '', 					// An ID code for use by 3rd party apps to identify transactions.
								'notifyurl' => '', 						// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
								'recurring' => ''						// Flag to indicate a recurring transaction.  Value should be Y for recurring, or anything other than Y if it's not recurring.  To pass Y here, you must have an established billing agreement with the buyer.
							);
		
		// For order items you populate a nested array with multiple $Item arrays.  
		// Normally you'll be looping through cart items to populate the $Item array
		// Then push it into the $OrderItems array at the end of each loop for an entire 
		// collection of all items in $OrderItems.
				
		$OrderItems = array();
			
		$Item	 = array(
							'l_name' => '', 						// Item Name.  127 char max.
							'l_desc' => '', 						// Item description.  127 char max.
							'l_amt' => '', 							// Cost of individual item.
							'l_number' => '', 						// Item Number.  127 char max.
							'l_qty' => '', 							// Item quantity.  Must be any positive integer.  
							'l_taxamt' => '', 						// Item's sales tax amount.
							'l_ebayitemnumber' => '', 				// eBay auction number of item.
							'l_ebayitemauctiontxnid' => '', 		// eBay transaction ID of purchased item.
							'l_ebayitemorderid' => '' 				// eBay order ID for the item.
					);
		
		array_push($OrderItems, $Item);
		
		$Secure3D = array(
						  'authstatus3d' => '', 
						  'mpivendor3ds' => '', 
						  'cavv' => '', 
						  'eci3ds' => '', 
						  'xid' => ''
						  );
						  
		$PayPalRequestData = array(
								'DPFields' => $DPFields, 
								'CCDetails' => $CCDetails, 
								'PayerInfo' => $PayerInfo, 
								'PayerName' => $PayerName, 
								'BillingAddress' => $BillingAddress, 
								'ShippingAddress' => $ShippingAddress, 
								'PaymentDetails' => $PaymentDetails, 
								'OrderItems' => $OrderItems, 
								'Secure3D' => $Secure3D
							);
							
		$PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
		
	
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			//$this->load->view('paypal_error',$errors);
			$newerrors = $errors['Errors'][0]['L_LONGMESSAGE'];
			redirect('order/failure/'.$newerrors); 
		}else{
			// Successful call.  Load view or whatever you need to do here.	
			redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$PayPalResult['TRANSACTIONID']);
		}
			
			
		}
	
	}
	
	
	/************************** Gift Cart Submit Options  *******************************/
	
	
	public function PaymentProcessGift(){
	
		$excludeArr = array('paypalmode','paypalEmail','total_price','PaypalSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
			/*Paypal integration start */
			$this->load->library('paypal_class');
			
			$item_name = $this->config->item('email_title').' Gifts';
			
			$totalAmount = $this->input->post('total_price');                
			//User ID
			$loginUserId = $this->checkLogin('U');
			
			$quantity = 1;
			
			if($this->input->post('paypalmode') == 'sandbox'){
				$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
			}else{
				$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
			}
			
			$this->paypal_class->add_field('currency_code', $this->data['currencyType']);
			
			$this->paypal_class->add_field('business',$this->input->post('paypalEmail')); // Business Email
			
			$this->paypal_class->add_field('return',base_url().'order/giftsuccess/'.$loginUserId); // Return URL
			
			$this->paypal_class->add_field('cancel_return', base_url().'order/failure'); // Cancel URL
			
			$this->paypal_class->add_field('notify_url', base_url().'site/order/ipnpayment'); // Notify url
			
			$this->paypal_class->add_field('custom', $loginUserId.'|Gift'); // Custom Values			
			
			$this->paypal_class->add_field('item_name', $item_name); // Product Name
			
			$this->paypal_class->add_field('user_id', $loginUserId);
			
			$this->paypal_class->add_field('quantity', $quantity); // Quantity
			//echo $totalAmount;die;
			  $this->paypal_class->add_field('amount', $totalAmount); // Price
			//$this->paypal_class->add_field('amount', 1); // Price
			
			$this->paypal_class->submit_paypal_post(); 
						
	}
	
	public function PaymentCreditGift(){
	
		
		$excludeArr = array('creditvalue','cardType','email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		//User ID
			$loginUserId = $this->checkLogin('U');
		if($this->input->post('creditvalue')=='authorize'){
			
			
			$Auth_Details=unserialize(API_LOGINID); 
			$Auth_Setting_Details=unserialize($Auth_Details['settings']);	

			error_reporting(-1);
			define("AUTHORIZENET_API_LOGIN_ID",$Auth_Setting_Details['Login_ID']);    // Add your API LOGIN ID
			define("AUTHORIZENET_TRANSACTION_KEY",$Auth_Setting_Details['Transaction_Key']); // Add your API transaction key
			define("API_MODE",$Auth_Setting_Details['mode']);

				if(API_MODE	=='sandbox'){
					define("AUTHORIZENET_SANDBOX",true);// Set to false to test against production
				}else{
					define("AUTHORIZENET_SANDBOX",false);
				}       
				define("TEST_REQUEST", "FALSE"); 
				require_once './authorize/AuthorizeNet.php';
				
				$transaction = new AuthorizeNetAIM;
				$transaction->setSandbox(AUTHORIZENET_SANDBOX);
				$transaction->setFields(
					array(
					'amount' =>  $this->input->post('total_price'), 
					'card_num' =>  $this->input->post('cardNumber'), 
					'exp_date' => $this->input->post('CCExpDay').'/'.$this->input->post('CCExpMnth'),
					'first_name' => $this->input->post('full_name'),
					'last_name' => '',
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'phone' => $this->input->post('phone_no'),
					'email' =>  $this->input->post('email'),
					'card_code' => $this->input->post('creditCardIdentifier'),
					)
				);
				$response = $transaction->authorizeAndCapture();
		
			if( $response->approved ){
				//$moveShoppingDataToPayment = $this->ibrandshopping_model->moveShoppingDataToPayment(); 
				redirect('order/giftsuccess/'.$loginUserId.'/'.$response->transaction_id);
 			}else{		
				//redirect('site/shopcart/cancel?failmsg='.$response->response_reason_text); 
				redirect('order/failure/'.$response->response_reason_text); 
			}
			
		}else if($this->input->post('creditvalue')=='paypaldodirect'){	
			
			$PaypalDodirect = unserialize($this->data['paypal_credit_card_settings']['settings']);
			$dodirects = array(
				'Sandbox' => $PaypalDodirect['mode'], 			// Sandbox / testing mode option.
				'APIUsername' =>$PaypalDodirect['Paypal_API_Username'], 	// PayPal API username of the API caller
				'APIPassword' => $PaypalDodirect['paypal_api_password'], 	// PayPal API password of the API caller
				'APISignature' => $PaypalDodirect['paypal_api_Signature'], 	// PayPal API signature of the API caller
				'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
				'APIVersion' => '85.0'		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			);
			
			// Show Errors
			if($dodirects['Sandbox']){
				error_reporting(E_ALL);
				ini_set('display_errors', '1');
			}
			
		
			$this->load->library('Paypal_pro', $dodirects);	
		
			$DPFields = array(
							'paymentaction' => '', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
							'ipaddress' => $this->input->ip_address(), 							// Required.  IP address of the payer's browser.
							'returnfmfdetails' => '1'				// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
						);
						
						
		$CCDetails = array(
							'creditcardtype' => $this->input->post('cardType'), 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
							'acct' => $this->input->post('cardNumber'), 								// Required.  Credit card number.  No spaces or punctuation.  
							'expdate' => $this->input->post('CCExpDay').$this->input->post('CCExpMnth'), 	// Required.  Credit card expiration date.  Format is MMYYYY
							'cvv2' => $this->input->post('creditCardIdentifier'), 				// Requirements determined by your PayPal account settings.  Security digits for credit card.
							'startdate' => '', 							// Month and year that Maestro or Solo card was issued.  MMYYYY
							'issuenumber' => ''							// Issue number of Maestro or Solo card.  Two numeric digits max.
						);
						
		$PayerInfo = array(
							'email' => $this->input->post('email'), 	// Email address of payer.
							'payerid' => '', 							// Unique PayPal customer ID for payer.
							'payerstatus' => '', 	// Status of payer.  Values are verified or unverified
							'business' => '' 		
												// Payer's business name.
						);
						
		$PayerName = array(
							'salutation' => 'Mr.', 						// Payer's salutation.  20 char max.
							'firstname' => $this->input->post('full_name'), 							// Payer's first name.  25 char max.
							'middlename' => '', 						// Payer's middle name.  25 char max.
							'lastname' => '', 							// Payer's last name.  25 char max.
							'suffix' => ''								// Payer's suffix.  12 char max.
						);

//'x_amount'				=> ,
	//			'x_email'				=> $this->input->post('email'),
						
		$BillingAddress = array(
								'street' => $this->input->post('address'), 						// Required.  First street address.
								'street2' => '', 						// Second street address.
								'city' => $this->input->post('city'), 							// Required.  Name of City.
								'state' => $this->input->post('state'), 							// Required. Name of State or Province.
								'countrycode' => $this->input->post('country'), 					// Required.  Country code.
								'zip' => $this->input->post('postal_code'), 							// Required.  Postal code of payer.
								'phonenum' => $this->input->post('phone_no') 						// Phone Number of payer.  20 char max.
							);
							
		$ShippingAddress = array(
								'shiptoname' => $this->input->post('full_name'),		// Required if shipping is included.  Person's name associated with this address.  32 char max.
								'shiptostreet' => $this->input->post('address'),		// Required if shipping is included.  First street address.  100 char max.
								'shiptostreet2' => $this->input->post('address2'),  	// Second street address.  100 char max.
								'shiptocity' => $this->input->post('city'),			// Required if shipping is included.  Name of city.  40 char max.
								'shiptostate' => $this->input->post('state'),			// Required if shipping is included.  Name of state or province.  40 char max.
								'shiptozip' => $this->input->post('postal_code'), 		// Required if shipping is included.  Postal code of shipping address.  20 char max.
								'shiptocountry' => $this->input->post('country'), 		// Required if shipping is included.  Country code of shipping address.  2 char max.
								'shiptophonenum' => $this->input->post('phone_no')		// Phone number for shipping address.  20 char max.
								);
							
		$PaymentDetails = array(
								'amt' => $this->input->post('total_price'), 							// Required.  Total amount of order, including shipping, handling, and tax.  
								'currencycode' => $this->data['currencyType'], 					// Required.  Three-letter currency code.  Default is USD.
								'itemamt' => '', 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
								'shippingamt' => '', 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
								'insuranceamt' => '', 					// Total shipping insurance costs for this order.  
								'shipdiscamt' => '', 					// Shipping discount for the order, specified as a negative number.
								'handlingamt' => '', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
								'taxamt' => '', 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
								'desc' => '', 							// Description of the order the customer is purchasing.  127 char max.
								'custom' => '', 						// Free-form field for your own use.  256 char max.
								'invnum' => '', 						// Your own invoice or tracking number
								'buttonsource' => '', 					// An ID code for use by 3rd party apps to identify transactions.
								'notifyurl' => '', 						// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
								'recurring' => ''						// Flag to indicate a recurring transaction.  Value should be Y for recurring, or anything other than Y if it's not recurring.  To pass Y here, you must have an established billing agreement with the buyer.
							);
		
		// For order items you populate a nested array with multiple $Item arrays.  
		// Normally you'll be looping through cart items to populate the $Item array
		// Then push it into the $OrderItems array at the end of each loop for an entire 
		// collection of all items in $OrderItems.
				
		$OrderItems = array();
			
		$Item	 = array(
							'l_name' => '', 						// Item Name.  127 char max.
							'l_desc' => '', 						// Item description.  127 char max.
							'l_amt' => '', 							// Cost of individual item.
							'l_number' => '', 						// Item Number.  127 char max.
							'l_qty' => '', 							// Item quantity.  Must be any positive integer.  
							'l_taxamt' => '', 						// Item's sales tax amount.
							'l_ebayitemnumber' => '', 				// eBay auction number of item.
							'l_ebayitemauctiontxnid' => '', 		// eBay transaction ID of purchased item.
							'l_ebayitemorderid' => '' 				// eBay order ID for the item.
					);
		
		array_push($OrderItems, $Item);
		
		$Secure3D = array(
						  'authstatus3d' => '', 
						  'mpivendor3ds' => '', 
						  'cavv' => '', 
						  'eci3ds' => '', 
						  'xid' => ''
						  );
						  
		$PayPalRequestData = array(
								'DPFields' => $DPFields, 
								'CCDetails' => $CCDetails, 
								'PayerInfo' => $PayerInfo, 
								'PayerName' => $PayerName, 
								'BillingAddress' => $BillingAddress, 
								'ShippingAddress' => $ShippingAddress, 
								'PaymentDetails' => $PaymentDetails, 
								'OrderItems' => $OrderItems, 
								'Secure3D' => $Secure3D
							);
							
		$PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
		
	
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])){
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			//$this->load->view('paypal_error',$errors);
			$newerrors = $errors['Errors'][0]['L_LONGMESSAGE'];
			redirect('order/failure/'.$newerrors); 
		}else{
			// Successful call.  Load view or whatever you need to do here.	
			redirect('order/success/'.$loginUserId.'/'.$lastFeatureInsertId.'/'.$PayPalResult['TRANSACTIONID']);
		}
			
			
		}
	
	}

	/******************************************* Subscribe Form *****************************************************************/
	
	public function PaymentCreditSubscribe(){
	
	
		$excludeArr = array('email','cardNumber','CCExpDay','CCExpMnth','creditCardIdentifier','total_price','CreditSubscribeSubmit','invoiceNumber');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
		
		//Authorize.net Intergration
		$this->load->library('authorize_arb');
		
		// Start with a create object
		$this->authorize_arb->startData('create');
		
		// Locally-defined reference ID (can't be longer than 20 chars)
		$refId = substr(md5( microtime() . 'ref' ), 0, 20);
		$this->authorize_arb->addData('refId', $refId);
		
		// Data must be in this specific order
		// For full list of possible data, refer to the documentation:
		// http://www.authorize.net/support/ARB_guide.pdf
		
		
		$subscription_data = array(
			'name' => $this->config->item('email_title').' Subscription',
			'paymentSchedule' => array(
				'interval' => array(
					'length' => 1,
					'unit' => 'months',
					),
				'startDate' => date('Y-m-d'),
				'totalOccurrences' => 9999,
				'trialOccurrences' => 0,
				),
			'amount' => $this->config->item('total_price'),
			'trialAmount' => 0.00,
			'payment' => array(
				'creditCard' => array(
					'cardNumber' => $this->input->post('cardNumber'),
					'expirationDate' => $this->input->post('CCExpMnth').'-'.$this->input->post('CCExpDay'),
					'cardCode' => $this->input->post('creditCardIdentifier'),
					),
				),
			'order' => array(
				'invoiceNumber' => $this->config->item('invoiceNumber'),
				'description' =>  $this->config->item('email_title').' Subscription',
				),
			'customer' => array(
				'id' => $this->checkLogin('U'),
				'email' => $this->config->item('email'),
				'phoneNumber' => $this->config->item('phone_no'),
				),
			'billTo' => array(
				'firstName' => $this->config->item('full_name'),
				'lastName' => '',
				'address' => $this->config->item('address'),
				'city' => $this->config->item('city'),
				'state' => $this->config->item('state'),
				'zip' => $this->config->item('postal_code'),
				'country' => $this->config->item('country'),
				),
			);
			
		$this->authorize_arb->addData('subscription', $subscription_data);
		
		// Send request
		if( $this->authorize_arb->send() ){
			//echo '<h1>Success! ID: ' . $this->authorize_arb->getId() . '</h1>';
			redirect('order/subscribesuccess/'.$loginUserId.'/'.$this->authorize_arb->getId());
		}else{
			//echo '<h1>Epic Fail!</h1>';
			//echo '<p>' . $this->authorize_arb->getError() . '</p>';
			redirect('order/failure'); 
		}
		
		// Show debug data
		//$this->authorize_arb->debug();
		
	}
	
	/******************************************Payment Balance Zero Using Gift Card*******************************************************/
	
	public function PaymentGiftFree(){
	
		$excludeArr = array('total_price','PaypalSubmit');
    	$dataArr = array();
    	$condition =array('id' => $this->checkLogin('U'));
		$this->checkout_model->commonInsertUpdate(USERS,'update',$excludeArr,$dataArr,$condition);
	
		
		$item_name = $this->config->item('email_title').' Products';
			
		$totalAmount = $this->input->post('total_price');
			//User ID
		$loginUserId = $this->checkLogin('U');
			//DealCodeNumber
		$lastFeatureInsertId = $this->session->userdata('randomNo');
			
		redirect('order/successgift/'.$loginUserId.'/'.$lastFeatureInsertId); // Return URL
			
						
	}
	

}

/* End of file checkout.php */
/* Location: ./application/controllers/site/checkout.php */