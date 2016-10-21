<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all common db related functions
 * @author Teamtweaks
 *
 */
class My_Model extends CI_Model {

	/**
	 *
	 * This function connect the database and load the functions from CI_Model
	 */
	public function __construct()
	{
		parent::__construct();
		//		$this->load->database();
	}

	/**
	 *
	 * This function returns the table contents based on data
	 * @param String $table	->	Table name
	 * @param Array $condition	->	Conditions
	 * @param Array $sortArr	->	Sorting details
	 *
	 * return Array
	 */
	public function get_all_details($table='',$condition='',$sortArr=''){
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		return $this->db->get_where($table,$condition);
	}

	/**
	 *
	 * This function update the table contents based on params
	 * @param String $table		->	Table name
	 * @param Array $data		->	New data
	 * @param Array $condition	->	Conditions
	 */
	public function update_details($table='',$data='',$condition=''){
		$this->db->where($condition);
		$this->db->update($table,$data);
	}

	/**
	 *
	 * Simple function for inserting data into a table
	 * @param String $table
	 * @param Array $data
	 */
	public function simple_insert($table='',$data=''){
		//echo "<pre>";print_r($data);die;
		$this->db->insert($table,$data);
	}

	/**
	 *
	 * This function do all insert and edit operations
	 * @param String $table		->	Table name
	 * @param String $mode		->	insert, update
	 * @param Array $excludeArr
	 * @param Array $dataArr
	 * @param Array $condition
	 */
	public function commonInsertUpdate($table='',$mode='',$excludeArr='',$dataArr='',$condition=''){
		$inputArr = array();
		foreach ($this->input->post() as $key => $val){
			if (!in_array($key, $excludeArr)){
				$inputArr[$key] = $val;
			}
		}
		$finalArr = array_merge($inputArr,$dataArr);
		if ($mode == 'insert'){
			return $this->db->insert($table,$finalArr);
		}else if ($mode == 'update'){
			$this->db->where($condition);
			return $this->db->update($table,$finalArr);
		}


	}

	/**
	 *
	 * For getting last insert id
	 */
	public function get_last_insert_id(){
		return $this->db->insert_id();
	}

	/**
	 *
	 * This function do the delete operation
	 * @param String $table
	 * @param Array $condition
	 */
	public function commonDelete($table='',$condition=''){
		$this->db->delete($table,$condition);
	}

	/**
	 *
	 * This function return the admin settings details
	 */
	public function getAdminSettings(){
		$this->db->select('*');
		$this->db->where(ADMIN.'.id','1');
		$this->db->from(ADMIN_SETTINGS);
		$this->db->join(ADMIN,ADMIN.'.id = '.ADMIN_SETTINGS.'.id');

		$result = $this->db->get();
		unset($result->row()->admin_password);
		return $result;
	}

	/**
	 *
	 * This function change the status of records and delete the records
	 * @param String $table
	 * @param String $column
	 */
	public function activeInactiveCommon($table='', $column=''){
		$data =  $_POST['checkbox_id'];
		for ($i=0;$i<count($data);$i++){
			if($data[$i] == 'on'){
				unset($data[$i]);
			}
		}
		$mode  = $this->input->post('statusMode');
		$AdmEmail  = strtolower($this->input->post('SubAdminEmail'));
		/*$getAdminSettingsDetails = $this->getAdminSettings();
		 $config = '<?php ';
		 foreach($getAdminSettingsDetails ->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
			}
			$file = 'fc_admin_action_settings.php';
			file_put_contents($file, $config);
			vinu@teamtweaks.com
			*/


		$json_admin_action_value = file_get_contents('fc_admin_action_settings.php');
		if($json_admin_action_value !=''){
			$json_admin_action_result = unserialize($json_admin_action_value);
		}
			
		foreach ($json_admin_action_result as $valds) {
			$json_admin_action_result_Arr[] = $valds;
		}

		if(sizeof($json_admin_action_result)>29){
			unset($json_admin_action_result_Arr[1]);
		}

		$json_admin_action_result_Arr[] = array($AdmEmail,$mode,$table,$data,date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']);

			
		$file = 'fc_admin_action_settings.php';
		file_put_contents($file, serialize($json_admin_action_result_Arr));
			

		$this->db->where_in($column,$data);
		if (strtolower($mode) == 'delete'){
			$this->db->delete($table);
		}else {
			$statusArr = array('status' => $mode);
			$this->db->update($table,$statusArr);
		}
	}

	/**
	 *
	 * Common function for selecting records from table
	 * @param String $tableName
	 * @param Array $paraArr
	 */
	public function selectRecordsFromTable($tableName,$paraArr){
		extract($paraArr);
		$this->db->select($selectValues);
		$this->db->from($tableName);

		if(!empty($whereCondition))
		{
			$this->db->where($whereCondition);
		}

		if(!empty($sortArray))
		{
			foreach($sortArray as $key=>$val)
			{
				$this->db->order_by($key,$val);
			}
		}

		if($perpage !='')
		{
			$this->db->limit($perpage,$start);
		}

		if(!empty($likeQuery))
		{
			$this->db->like($likeQuery);
		}
		$query = $this->db->get();

		return $result = $query->result_array();

	}

	/**
	 *
	 * Common function for executing mysql query
	 * @param String $Query	->	Mysql Query
	 */
	public function ExecuteQuery($Query){
		return $this->db->query($Query);
	}

	/**
	 *
	 * Category -> product count function
	 * @param String $res	->product category colum values
	 * @param String $id	->Category id
	 */
	public function productPerCategory($res,$id){

		$option_exp="";
			
		echo '<pre>'; $res->num_rows;
		print_r($res);  die;

		for($i=0;$i<=count($res->num_rows);$i++){
			$option_exp .= $res[$i]['category_id'].",";
		}

		$option_exploded = explode(',',$option_exp);
		$valid_option =array_filter($option_exploded);
		$occurences = array_count_values($valid_option);
			
		if($occurences[$id] == ''){
			return '0';
		}else{
			return $occurences[$id];
		}

	}

	public function mini_cart_view($userid = '',$mini_cart_lg=array()){
		extract($mini_cart_lg);
			
		$minCartVal = ''; $GiftMiniValue = ''; $CartMiniValue = ''; $SubscribMiniValue = '';  $minCartValLast = ''; $giftMiniAmt = 0; $cartMiniAmt = 0; $SubcribMiniAmt = 0; $cartMiniQty = 0;

		$giftMiniSet = $this->minicart_model->get_all_details(GIFTCARDS_SETTINGS,array( 'id' => '1'));
		$giftMiniRes = $this->minicart_model->get_all_details(GIFTCARDS_TEMP,array( 'user_id' => $userid));
		$shipMiniVal = $this->minicart_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userid));
		$SubcribeMiniRes = $this->minicart_model->get_all_details(FANCYYBOX_TEMP,array( 'user_id' => $userid));

		$this->db->select('a.*,b.product_name,b.seourl,b.image,b.id as prdid,b.price as orgprice');
		$this->db->from(SHOPPING_CART.' as a');
		$this->db->join(PRODUCT.' as b' , 'b.id = a.product_id');
		$this->db->where('a.user_id = '.$userid);
		$cartMiniVal = $this->db->get();

		if($cartMiniVal -> num_rows() > 0 ){
			$s=0;
			foreach ($cartMiniVal->result() as $CartRow){
					
				$newImg = @explode(',',$CartRow->image);
				$cartMiniAmt = $cartMiniAmt + $CartRow->indtotal;

				$CartMiniValue.= '<div id="cartMindivId_'.$s.'"><table><tbody><tr>
	       	<th class="info"><a href="things/'.$CartRow->prdid.'/'.$CartRow->seourl.'"><img src="images/site/blank.gif" style="background-image:url('.PRODUCTPATH.$newImg[0].')" alt="'.$CartRow->product_name.'"><strong>'.$CartRow->product_name.'</strong><br /></a></th>
			<td class="qty">'.$CartRow->quantity.'</td>
            <td class="price">'.$this->data['currencySymbol'].$CartRow->indtotal.'</td>
		</tr></tbody></table></div>';
				$cartMiniQty = $cartMiniQty + $CartRow->quantity;
				$s++;
			}
		}

		if($SubcribeMiniRes -> num_rows() > 0 ){
			$s=0;
			foreach ($SubcribeMiniRes->result() as $SubCribRow){
					
				$SubscribMiniValue.= '<div id="SubcribtMinidivId_'.$s.'"><table><tbody><tr>
        	<th class="info"><a href="fancybox/'.$SubCribRow->fancybox_id.'/'.$SubCribRow->seourl.'"><img src="images/site/blank.gif" style="background-image:url('.FANCYBOXPATH.$SubCribRow->image.')" alt="'.$SubCribRow->name.'"><strong>'.$SubCribRow->name.'</strong></a></th>
            <td class="qty">1</td>
            <td class="price">'.$this->data['currencySymbol'].number_format($SubCribRow->price,2,'.','').'</td>
		</tr></tbody></table></div>';
				$SubcribMiniAmt = $SubcribMiniAmt + $SubCribRow->price;
				$s++;
			}
		}

		if($giftMiniRes->num_rows() > 0 ){
			$GiftMiniValue = $this->load->view('site/cart/GiftMiniValue.php', array('giftMiniRes' => $giftMiniRes->result(), 'currencySymbol' => $this->data['currencySymbol']), TRUE);

			foreach ($giftMiniRes->result() as $giftRow){
				$giftMiniAmt = $giftMiniAmt + $giftRow->price_value;
			}
		}

		$countMiniVal = $giftMiniRes -> num_rows() + $cartMiniQty + $SubcribeMiniRes-> num_rows();
		
		if($countMiniVal == 0){
			$cartMiniDisp = $this->load->view('site/cart/cartMiniDisp.php', array(), TRUE);
		}else{
			$minCartVal_array['countMiniVal'] = $countMiniVal;
			$minCartVal_array['lg_items'] = $lg_items;
			$minCartVal_array['lg_description'] = $lg_description;
			$minCartVal_array['lg_qty'] = $lg_qty;
			$minCartVal_array['lg_price'] = $lg_price;
			
			$totalMiniCartAmt = $giftMiniAmt + $cartMiniAmt + $SubcribMiniAmt;
			$minCartValLast_array['lg_sub_tot'] = $lg_sub_tot;	
			$minCartValLast_array['lg_sub_total'] = $this->data['currencySymbol'] . number_format($totalMiniCartAmt,2,'.','');
			$minCartValLast_array['lg_proceed'] = $lg_proceed;
			
			$minCartVal = $this->load->view('site/cart/minCartVal.php', $minCartVal_array, TRUE);
			$minCartValLast = $this->load->view('site/cart/minCartValLast.php', $minCartValLast_array, TRUE);
			
			$cartMiniDisp = $minCartVal.$CartMiniValue.$SubscribMiniValue.$GiftMiniValue.$minCartValLast;

		}
		
		return $cartMiniDisp;
	}

	/**
	 *
	 * Retrieve records using where_in
	 * @param String $table
	 * @param Array $fieldsArr
	 * @param String $searchName
	 * @param Array $searchArr
	 * @param Array $joinArr
	 * @param Array $sortArr
	 * @param Integer $limit
	 *
	 * @return Array
	 */
	public function get_fields_from_many($table='',$fieldsArr='',$searchName='',$searchArr='',$joinArr='',$sortArr='',$limit='',$condition=''){
		if ($searchArr != '' && count($searchArr)>0 && $searchName != ''){
			$this->db->where_in($searchName, $searchArr);
		}
		if ($condition != '' && count($condition)>0){
			$this->db->where($condition);
		}
		$this->db->select($fieldsArr);
		$this->db->from($table);
		if ($joinArr != '' && is_array($joinArr)){
			foreach ($joinArr as $joinRow){
				if (is_array($joinRow)){
					$this->db->join($joinRow['table'],$joinRow['on'],$joinRow['type']);
				}
			}
		}
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'], $sortRow['type']);
				}
			}
		}
		if ($limit!=''){
			$this->db->limit($limit);
		}
		return $this->db->get();
	}

	public function get_total_records($table='',$condition=''){
		$Query = 'SELECT COUNT(*) as total FROM '.$table.' '.$condition;
		return $this->ExecuteQuery($Query);
	}

	public function common_email_send($eamil_vaues = array())
	{

		/*		echo  'From : '.$eamil_vaues['from_mail_id'].' <'.$eamil_vaues['mail_name'].'><br/>'.
		 'To   : '.$eamil_vaues['to_mail_id'].'<br/>'.
		 'Subject : '.$eamil_vaues['subject_message'].'<br/>'.
		 'Message : '.trim(stripslashes($eamil_vaues['body_messages']));die;*/

		//Prevent mail for pleasureriver
		$server_ip = $this->input->ip_address();
		$mail_id = '';
		if ($demoserverChk){
			if (isset($eamil_vaues['mail_id'])){
				$mail_id = $eamil_vaues['mail_id'];
			}
		}else {
			$mail_id = 'set';
		}

		if ($mail_id != ''){
			if (is_file('./fc_smtp_settings.php'))
			{
				include('fc_smtp_settings.php');
			}


			// Set SMTP Configuration

			if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){
				$emailConfig = array(
					'protocol' => 'smtp',
					'smtp_host' => $config['smtp_host'],
					'smtp_port' => $config['smtp_port'],
					'smtp_user' => $config['smtp_user'],
					'smtp_pass' => $config['smtp_pass'],
					 'auth' => true,
				);
			}

			// Set your email information
			$from = array('email' => $eamil_vaues['from_mail_id'],'name' => $eamil_vaues['mail_name']);
			$to = $eamil_vaues['to_mail_id'];
			$subject = $eamil_vaues['subject_message'];
			$message = stripslashes($eamil_vaues['body_messages']);
			// Load CodeIgniter Email library

			if($config['smtp_user'] != '' && $config['smtp_pass'] != ''){

				$this->load->library('email', $emailConfig);

			}else {
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
				// Additional headers
				$headers .= 'To: '.$eamil_vaues['to_mail_id']. "\r\n";
				$headers .= 'From: '.$eamil_vaues['mail_name'].' <'.$eamil_vaues['from_mail_id'].'>' . "\r\n";
				if($eamil_vaues['cc_mail_id'] != '')
				{
					$headers .= 'Cc: '.$eamil_vaues['cc_mail_id']. "\r\n";
				}
					
				// Mail it
				mail($eamil_vaues['to_mail_id'], trim(stripslashes($eamil_vaues['subject_message'])), trim(stripslashes($eamil_vaues['body_messages'])), $headers);
				return 1;
			}

			// Sometimes you have to set the new line character for better result

			$this->email->set_newline("\r\n");
			// Set email preferences
			$this->email->set_mailtype($eamil_vaues['mail_type']);
			$this->email->from($from['email'],$from['name']);
			$this->email->to($to);
			if($eamil_vaues['cc_mail_id'] != '')
			{
				$this->email->cc($eamil_vaues['cc_mail_id']);
			}
			$this->email->subject($subject);
			$this->email->message($message);
			// Ready to send email and check whether the email was successfully sent

			if (!$this->email->send()) {
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
				// Additional headers
				$headers .= 'To: '.$eamil_vaues['to_mail_id']. "\r\n";
				$headers .= 'From: '.$eamil_vaues['mail_name'].' <'.$eamil_vaues['from_mail_id'].'>' . "\r\n";
				if($eamil_vaues['cc_mail_id'] != '')
				{
					$headers .= 'Cc: '.$eamil_vaues['cc_mail_id']. "\r\n";
				}
					
				// Mail it
				mail($eamil_vaues['to_mail_id'], trim(stripslashes($eamil_vaues['subject_message'])), trim(stripslashes($eamil_vaues['body_messages'])), $headers);
				return 1;

			}
			else {
				// Show success notification or other things here
				//echo 'Success to send email';

					


				return 1;
			}
		}else {
			return 1;
		}
	}
	//get newsletter template
	public function get_newsletter_template_details($apiId='')
	{
		$twitterQuery = "select * from ".NEWSLETTER." where id=".$apiId. " AND status='Active'";
		$twitterQueryDetails  = mysql_query($twitterQuery);
		return $twitterFetchDetails = mysql_fetch_assoc($twitterQueryDetails);
	}

	/**
	 *
	 * Merge two arrays and sort the result array using array_multisort
	 * @param Array $ar1
	 * @param Array $ar2
	 * @param String $field	=> Field name for sort
	 * @param String $type	=> Sort type asc or desc
	 */
	public function get_sorted_array($ar1=array(),$ar2=array(),$field='id',$type='asc'){
		$products_list_arr = array();
		if (count($ar1)>0 && $ar1->num_rows()>0){
			foreach ($ar1->result() as $ar1_row){
				$products_list_arr['product'][] = $ar1_row;
				$products_list_arr[$field][] = $ar1_row->$field;
			}
		}

		if (count($ar2)>0 && $ar2->num_rows()>0){
			foreach ($ar2->result() as $ar2_row){
				$products_list_arr['product'][] = $ar2_row;
				$products_list_arr[$field][] = $ar2_row->$field;
			}
		}

		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}

		array_multisort($products_list_arr[$field],$sort,
		$products_list_arr['product']
		);

		return $products_list_arr['product'];
	}

	/**
	 *
	 * This function save the admin details in a file
	 */
	public function saveAdminSettings($common_prefix=''){
		if ($this->input->post('https_enabled')=='yes'){
			if (substr(base_url(), 0,7)=='http://'){
				$b_url = 'https://'.substr(base_url(), strpos(base_url(), 'http://')+7);
			}else {
				$b_url = base_url();
			}
			$https_enabled = 'yes';
		}else {
			if ($this->input->post('https_enabled')=='no'){
				if (substr(base_url(), 0,8)=='https://'){
					$b_url = 'http://'.substr(base_url(), strpos(base_url(), 'https://')+8);
				}else {
					$b_url = base_url();
				}
				$https_enabled = 'no';
			}else {
				if (HTTTPS_ENABLED == 'yes'){
					if (substr(base_url(), 0,7)=='http://'){
						$b_url = 'https://'.substr(base_url(), strpos(base_url(), 'http://')+7);
					}else {
						$b_url = base_url();
					}
					$https_enabled = 'yes';
				}else {
					if (substr(base_url(), 0,8)=='https://'){
						$b_url = 'http://'.substr(base_url(), strpos(base_url(), 'https://')+8);
					}else {
						$b_url = base_url();
					}
					$https_enabled = 'no';
				}
			}
		}
		$getAdminSettingsDetails = $this->getAdminSettings();
		$config = '<?php ';
		foreach($getAdminSettingsDetails->row() as $key => $val){
			$value = addslashes($val);
			$config .= "\n\$config['$key'] = '$value'; ";
		}
		$config .= "\n\$config['common_prefix'] = '".$common_prefix."'; ";
		$config .= "\n\$config['https_enabled'] = '".$https_enabled."'; ";
		$config .= "\n\$config['base_url'] = '".$b_url."'; ";
		$config .= ' ?>';
		$file = 'commonsettings/fc_admin_settings.php';
		file_put_contents($file, $config);
	}
}