<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to giftcards management
 * @author Teamtweaks
 *
 */
class Giftcards_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * This function save the giftcard settings in a file
    */
   public function saveGiftcardSettings(){
		$getGiftcardSettings = $this->get_all_details(GIFTCARDS_SETTINGS,array());
		$config = '<?php ';
		foreach($getGiftcardSettings->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['giftcard_$key'] = '$value'; ";
		}
		$config .= ' ?>';
		$file = 'commonsettings/fc_giftcard_settings.php';
		file_put_contents($file, $config);
   }
   
   /**
    * 
    * Getting gift card details
    * @param String $condition
    */
   public function get_giftcard_details($condition=''){
   		$Query = " select * from ".GIFTCARDS." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
}