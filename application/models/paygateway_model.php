<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to gateway management
 * @author Teamtweaks
 *
 */
class Paygateway_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * This function save the payment settings in a file
    */
   public function savePaymentSettings(){
		$getPaymentSettings = $this->get_all_details(PAYMENT_GATEWAY,array());
		$config = '<?php ';
		foreach($getPaymentSettings->result_array() as $key => $val){
			$value = serialize($val);
			$config .= "\n\$config['payment_$key'] = '$value'; ";
		}
		$config .= ' ?>';
		$file = 'commonsettings/fc_payment_settings.php';
		file_put_contents($file, $config);
   }
}