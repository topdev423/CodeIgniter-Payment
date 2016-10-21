<?php
class Multilanguage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->helper('language');
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('admin_model');
		$this->load->model('multilanguage_model');

		if ($this->checkPrivileges('multilang',$this->privStatus) == FALSE){
			redirect('admin');
		}

	}

	function index()
	{
		$this->display_language_list();
	}

	function display_language_list()
	{

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Multilanguage Manage';
			$this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
			$this->data['language_list'] = $result = $this->multilanguage_model->get_language_list();
			$this->load->view('admin/multilanguage/language_list',$this->data);
		}
	}

	function edit_language()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$selectedLanguage = $this->uri->segment('4');
			$languagDirectory = APPPATH."language/".$selectedLanguage;
			if(!is_dir($languagDirectory))
			{
				mkdir($languagDirectory,0777);
				$filePath = APPPATH."language/".$selectedLanguage."/".$selectedLanguage."_lang.php";
				file_put_contents($filePath,'');
			}

		 $this->lang->load($selectedLanguage, $selectedLanguage);

		 $filePath = APPPATH."language/en/en_lang.php";
		 $fileValues = file_get_contents($filePath);

		 /********************************** Key value explode start *************************************/
		 $fileKeyValues_explode1 = explode("\$lang['", $fileValues);
		 $language_file_keys = array();
		 foreach($fileKeyValues_explode1 as $fileKeyValues2)
		 {
		 	$fileKeyValues_explode2 = explode("']", $fileKeyValues2);
		 	$language_file_keys[] = $fileKeyValues_explode2[0];
		 }
		 /********************************** Key value explode end *************************************/

		 /**********************************  value explode start *************************************/
		 $fileValues_explode1 = explode("']='", $fileValues);
		 $language_file_values = array();

		 //echo "<pre>";print_r($fileValues_explode1);die;
		 foreach($fileValues_explode1 as $fileValues2)
		 {
		 	$fileValues_explode2 = explode("';", $fileValues2);
		 	$language_file_values[] = $fileValues_explode2[0];
		 }
		 /**********************************  value explode end *************************************/

		 //echo "<pre>";print_r($language_file_values);die;
		 $this->data['file_key_values'] = $language_file_keys;
		 $this->data['file_lang_values'] = $language_file_values;
		 $this->data['selectedLanguage'] = $selectedLanguage;
		 $this->data['heading'] = 'Edit Language';
		 $this->data['admin_settings'] = $result = $this->admin_model->getAdminSettings();
		 $this->load->view('admin/multilanguage/language_edit',$this->data);

		}
	}

	function languageAddEditValues()
	{
			
		$getLanguageKeyDetails = $this->input->post('languageKeys');
		$getLanguageContentDetails = $this->input->post('language_vals');
		$selectedLanguage = $this->input->post('selectedLanguage');
		// echo "<pre>";print_r($getLanguageContentDetails);die;
		/* file write start*/
		$loopItem = 0;
		$config = '<?php';
		foreach($getLanguageKeyDetails as $key_val)
		{
			$language_file_values = addslashes($getLanguageContentDetails[$loopItem]);
			$config .= "\n\$lang['$key_val'] = '$language_file_values'; ";
			$loopItem = $loopItem+1;
		}
			
		$config .= ' ?>';
			
		$languagDirectory = APPPATH."language/".$selectedLanguage;
		if(!is_dir($languagDirectory))
		{
			mkdir($languagDirectory,0777);
		}
			
		$filePath = APPPATH."language/".$selectedLanguage."/".$selectedLanguage."_lang.php";
		file_put_contents($filePath, $config);
		redirect('admin/multilanguage/display_language_list');
	}

	function delete_language(){
		$languageId = $this->uri->segment('4');
		$delete_language = $this->multilanguage_model->delete_language($languageId);
		$this->setErrorMessage('success'," Language deleted changed successfully");
		redirect('admin/multilanguage/display_language_list');
	}

	function change_multi_language_details()
	{
		$statusMode = $this->input->post('statusMode');
		$checkbox_id = $this->input->post('checkbox_id');

		if($statusMode != '' && !empty($checkbox_id))
		{
			$change_language_status = $this->multilanguage_model->change_language_status($statusMode,$checkbox_id);
			$this->setErrorMessage('success'," Language settings changed successfully");
			redirect('admin/multilanguage/display_language_list');
		}
		else
		{
			redirect('admin');
		}

	}

	function change_language_status()
	{
		$current_status = $this->uri->segment('4');
		$languageId = $this->uri->segment('5');

		if($current_status != '' && $languageId != ''){
			$change_language_details = $this->multilanguage_model->change_language_details($current_status,$languageId);
			$this->setErrorMessage('success'," Language settings changed successfully");
			redirect('admin/multilanguage/display_language_list');
				
		}else {
			redirect('admin');
		}
	}
	
	public function change_language_default($lid="0",$lcode="en"){
		$this->multilanguage_model->update_details(LANGUAGES,array('default'=>'no'),array());
		$this->multilanguage_model->update_details(LANGUAGES,array('default'=>'yes'),array('id'=>$lid));
		$Query = "ALTER TABLE  ".USERS." CHANGE  `language`  `language` VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '".$lcode."'";
		$this->multilanguage_model->ExecuteQuery($Query);
		$this->setErrorMessage('success','Default language changed successfully');
		redirect('admin/multilanguage/display_language_list');
	}

	public function add_new_lg(){
		if ($this->checkLogin('A')==''){
			show_404();
		}else {
			$this->data['heading'] = 'Add New Language';
			$this->load->view('admin/multilanguage/add_new_lg',$this->data);
		}
	}

	public function add_lg_process(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$lname = $this->input->post('name');
			$lcode = $this->input->post('lang_code');
			$duplicateName = $this->multilanguage_model->get_all_details(LANGUAGES,array('name'=>$lname));
			if ($duplicateName->num_rows()>0){
				$this->setErrorMessage('error','Language name already exists');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$duplicateCode = $this->multilanguage_model->get_all_details(LANGUAGES,array('lang_code'=>$lcode));
				if ($duplicateCode->num_rows()>0){
					$this->setErrorMessage('error','Language code already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$this->multilanguage_model->commonInsertUpdate(LANGUAGES,'insert',array(),array());
					$this->setErrorMessage('success','Language added successfully');
					redirect('admin/multilanguage/display_language_list');
				}
			}
		}
	}

}

?>