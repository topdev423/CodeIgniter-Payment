<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 *
 */

class Shop extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model','shop');
		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->shop->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];
		
		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->shop->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->shop->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
	public function index(){
		$this->data['heading'] = 'Shop';
		$this->data['bannerList'] = $this->shop->get_all_details(BANNER_CATEGORY,array('status'=>'Publish'));
		$this->data['recentProducts'] = $this->shop->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 order by p.created desc limit 4");
		$this->load->view('site/shop/display_shop_list',$this->data);
    }
	
}
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */