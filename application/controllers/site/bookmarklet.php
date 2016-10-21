<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Bookmarklet related functions
 * @author Teamtweaks
 *
 */

class Bookmarklet extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('product_model','product');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
			$this->data['likedProducts'] = $this->product->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
		}
	}

	public function index(){
		$uid = $this->input->get('u');
		$this->data['uid'] = $uid;
		$this->load->view('site/bookmarklet/display_bookmarklet',$this->data);
	}

	public function display_bookmarklet(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Bookmarklet';
			$this->load->view('site/bookmarklet/display_bookmarklet_button',$this->data);
		}
	}

	public function add_bookmarklet_product(){
		$returnStr['status_code'] = 0;
		$returnStr['message'] = '';
		$is_user = '0';
		$uid = $this->input->post('uid');
		/*$user_details = $this->product->get_all_details(USERS,array('id'=>$uid));
		if ($user_details->num_rows() == 1){
			if ($user_details->row()->status == 'Active'){
				$is_user = '1';
			}else {
				if($this->lang->line('ur_acc_susp') != '')
				$returnStr['message'] = $this->lang->line('ur_acc_susp');
				else
				$returnStr['message'] = 'Your account was suspended. Please contact admin';
			}
		}else */if ($this->checkLogin('U')== ''){
			if($this->lang->line('u_must_log_to_prod') != '')
			$returnStr['message'] = $this->lang->line('u_must_log_to_prod');
			else
			$returnStr['message'] = 'You must login to add products';
			
			$returnStr['status'] = 'login';
		}else {
			$uid = $this->data['userDetails']->row()->id;
			$user_details = $this->data['userDetails'];
			$is_user = '1';
		}
			
		if ($is_user == '1'){
			$img_details = getimagesize($this->input->post('photo_url'));
			if (is_array($img_details)){
				if($img_details[0]>149 || $img_details[1]>149){

					$seller_product_id = mktime();
					$checkId = $this->check_product_id($seller_product_id);
					while ($checkId->num_rows()>0){
						$seller_product_id = mktime();
						$checkId = $this->check_product_id($seller_product_id);
					}
					$image_name = $this->input->post('photo_url');
					if ($this->input->post('photo_url')!=''){

						/****----------Move image to server-------------****/

						$image_url = trim(addslashes($this->input->post('photo_url')));

						$img_data = file_get_contents($image_url);

						$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
						$img_name_arr = explode('.', $img_full_name);
						$img_name = $img_name_arr[0];
						$ext = $img_name_arr[1];
						$ext_arr = explode('?', $ext);
						$ext = $ext_arr[0];
						if($ext == ''){
							$ext = 'jpg';
						}
						$new_name = str_replace(',', '', $img_name.mktime().'.'.$ext);
						$new_name = str_replace('$', '', $new_name);
						$new_name = str_replace('(', '', $new_name);
						$new_name = str_replace(')', '', $new_name);
						$new_name = str_replace('~', '', $new_name);
						$new_name = str_replace('>', '', $new_name);
						$new_name = str_replace('<', '', $new_name);
						$new_name = str_replace('&', '', $new_name);
						$new_name = str_replace('?', '', $new_name);
						$new_img = 'images/product/'.$new_name;

						file_put_contents($new_img, $img_data);

						/****----------Move image to server-------------****/

						$image_name = $new_name;

						$this->imageResizeWithSpace(600, 600, $image_name, './images/product/');
						$this->imageResizeWithSpace(210, 210, $image_name, './images/product/thumb/');

					}else {
						$image_name = 'dummyProductImage.jpg';
					}
						
					/***----------Short Url---------****/
					$short_url = $this->get_rand_str('6');
					$checkId = $this->product->get_all_details(SHORTURL,array('short_url'=>$short_url));
					while ($checkId->num_rows()>0){
						$short_url = $this->get_rand_str('6');
						$checkId = $this->product->get_all_details(SHORTURL,array('short_url'=>$short_url));
					}
					$thing_url = base_url().'user/'.$user_details->row()->user_name.'/things/'.$seller_product_id.'/'.url_title($this->input->post('name'),'-');
					$this->product->simple_insert(SHORTURL,array('short_url'=>$short_url,'long_url'=>$thing_url));
					$urlid = $this->product->get_last_insert_id();
					/***----------Short Url--------****/

					$dataArr = array(
						'product_name'	=>	$this->input->post('name'),
						'seourl'		=>	url_title($this->input->post('name'),'-'),
						'web_link'		=>	$this->input->post('link'),
						'category_id'	=>	$this->input->post('category'),
						'image'			=>	$image_name,
						'user_id'		=>	$uid,
						'seller_product_id' => $seller_product_id,
						'short_url_id'	=>	$urlid
					);
					$this->product->simple_insert(USER_PRODUCTS,$dataArr);
					$returnStr['status_code'] = 1;
					$total_added = $user_details->row()->products;
					$total_added++;
					$this->product->update_details(USERS,array('products'=>$total_added),array('id'=>$uid));
					$returnStr['thing_url'] = $thing_url;
				}else {
					if($this->lang->line('img_too_small') != '')
					$returnStr['message'] = $this->lang->line('img_too_small');
					else
					$returnStr['message'] = 'Selected image is too small. Please choose another image';
				}
			}else {
				if($this->lang->line('cant_uplod_img_pl_chos_another') != '')
				$returnStr['message'] = $this->lang->line('cant_uplod_img_pl_chos_another');
				else
				$returnStr['message'] = 'Can\'t able to upload image. Please choose another image';
			}
		}
		echo json_encode($returnStr);
	}

	public function check_product_id($pid=''){
		$checkId = $this->product->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->product->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}

}
/*End of file bookmarklet.php */
/* Location: ./application/controllers/site/bookmarklet.php */