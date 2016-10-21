<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Location_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	public function SelectAllCountry(){
	//print_r($OrderAsc);die;

		$this->db->select('*');
		$this->db->from(COUNTRY_LIST);
		//$this->db->where('status','Active');
		$this->db->order_by('name','asc');
		$query =  $this->db->get();
		
//echo $this->db->last_query();die;
		return $result = $query->result_array();
	}
	
	/**
    * 
    * This function save the currency details in a file
    */
   public function saveCurrencySettings(){
		$getCurrencyDetails = $this->get_all_details(COUNTRY_LIST,array('currency_default'=>'Yes'));
		$config = '<?php ';
		foreach($getCurrencyDetails->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['currency_$key'] = '$value'; ";
		}
		$config .= ' ?>';
		$file = 'commonsettings/fc_currency_settings.php';
		file_put_contents($file, $config);
   }
   
   public function updateCurrencyDetails($excludeArr,$dataArr,$condition){
   		$inputArr = array();
		foreach ($this->input->post() as $key => $val){
			if (!in_array($key, $excludeArr)){
				$inputArr[$key] = $val;
			}
		}
		$finalArr = array_merge($inputArr,$dataArr);
		$Query = "Update ".COUNTRY_LIST.' set ';
		foreach ($finalArr as $finalKey=>$finalRow){
			$Query .= '`'.$finalKey.'`="'.htmlentities($finalRow).'",';
		}
		$Query = substr($Query, 0, -1);
		if (count($condition)>0){
			$Query .= ' where ';
			foreach ($condition as $key=>$val){
				$Query .= '`'.$key.'`="'.htmlentities($val).'"';
			}
		}
//		echo $Query;
 		mysql_query($Query);
   }
}