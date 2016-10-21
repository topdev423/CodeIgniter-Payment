<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Landing page functions
 * @author Teamtweaks
 *
 */

class Landing extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('product_model');

		if($_SESSION['sMainCategories'] == ''){
			$sortArr1 = array('field'=>'cat_position','type'=>'asc');
			$sortArr = array($sortArr1);
			$_SESSION['sMainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=>'0','status'=>'Active'),$sortArr);
		}
		$this->data['mainCategories'] = $_SESSION['sMainCategories'];

		if($_SESSION['sColorLists'] == ''){
			$_SESSION['sColorLists'] = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>'1'));
		}
		$this->data['mainColorLists'] = $_SESSION['sColorLists'];

		$this->data['loginCheck'] = $this->checkLogin('U');
		//		echo $this->session->userdata('fc_session_user_id');die;
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
            //$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
            //$this->data['ratedProducts'] = $this->product_model->get_all_details(PRODUCT_RATING, array('user_id'=>$this->checkLogin('U')));
            
            // getting the products which are rated by the current user.
			$ratedProducts = $this->product_model->get_user_product_ratings($this->checkLogin('U'));
            $userRatedProducts = array();
            if($ratedProducts && count($ratedProducts)>0){
                foreach($ratedProducts as $ratedProduct){ //print_r($ratedProduct); die;
                    $userRatedProducts[$ratedProduct["product_id"]] = $ratedProduct["rating"];
                }
            }
            $this->data['ratedProducts'] = $userRatedProducts;
		}
			
	}

	/**
	 *
	 *
	 */
	public function index(){
		$this->data['heading'] = '';


		$cat = $this->input->get('c');
		$whereCond = $qry_str = '';
		if ($cat != ''){
			$catDetails = $this->product_model->get_all_details(CATEGORY,array('seourl'=>$cat));
			if ($catDetails->num_rows()==1){
				$catID = $catDetails->row()->id;
				if ($catID != ''){
					$whereCond = ' and FIND_IN_SET("'.$catID.'",p.category_id)';
				}
			}
		}
		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg')*6;
			$limitPaging = $paginationVal.',6 ';
		} else {
			$limitPaging = ' 6';
		}
		$newPage = $this->input->get('pg')+1;
		if ($cat != ''){
			$qry_str = '?c='.$cat.'&pg='.$newPage;
		}else {
			$qry_str = '?pg='.$newPage;
		}
        
        //getting the sort option on home page
        $sortby_new = $this->input->get('sortby');
        
        $landing_sorting_option = $this->session->userdata('landing_sorting_option'); // sort optino from session
        
        if($landing_sorting_option && $landing_sorting_option =='newest-oldest'){
            $sort_rating ='';
            $sort_array_rating = 'created';
        }
        else{
            $sort_rating =' avg_rating desc, ';
            $sort_array_rating = 'avg_rating';
        }
        
        if($sortby_new && $sortby_new =='newest-oldest'){
            $sort_rating ='';
            $sort_array_rating = 'created';
            $this->session->set_userdata('landing_sorting_option', 'newest-oldest');   
        }
        else{
            $this->session->unset_userdata('landing_sorting_option');
        }

		$this->data['layoutList'] = $layoutList = $this->product_model->view_controller_details();
		$totalSellingProducts = $this->product_model->get_total_records(PRODUCT);
		$totalAffilProducts = $this->product_model->get_total_records(USER_PRODUCTS);
		$this->data['totalProducts'] = $totalAffilProducts->row()->total+$totalSellingProducts->row()->total;
		if($layoutList->row()->product_control == 'affiliates'){
			$sellingProductDetails = array();
		}else {
			$sellingProductDetails = $this->product_model->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' ".$whereCond." or p.status='Publish' and p.quantity > 0 and p.user_id=0 ".$whereCond." GROUP BY p.id order by ".$sort_rating." p.created desc limit ".$limitPaging);
		}
		if($layoutList->row()->product_control == 'selling'){
			$affiliateProductDetails = array();
		}else {
			//echo $sort_rating;exit();
			$affiliateProductDetails = $this->product_model->view_notsell_product_details(" where p.status='Publish' and u.status='Active' ".$whereCond." or p.status='Publish' and p.user_id=0 ".$whereCond." GROUP BY p.id order by ".$sort_rating." p.created desc limit ".$limitPaging);
			/*$affiliateProductDetails = $this->product_model->view_notsell_product_details(" where p.status='Publish' and u.status='Active' ".$whereCond." or p.status='Publish' and p.user_id=0 ".$whereCond." GROUP BY p.id order by p.created desc limit ".$limitPaging);*/

		}
		$this->data['productDetails'] = $this->product_model->get_sorted_array($sellingProductDetails,$affiliateProductDetails, $sort_array_rating, 'desc');

		$paginationDisplay  = '<a title="'.$newPage.'" class="btn-more" href="'.base_url().$qry_str.'" style="display: none;">See More Products</a>';
		$this->data['paginationDisplay'] = $paginationDisplay;

		$this->load->view('site/landing/landing',$this->data);
	}

	public function upload_request(){
		$returnStr['status_code'] = 0;
		$returnStr['message'] = '';
		if ($this->checkLogin('U')==''){
			$returnStr['message'] = 'Login required';
		}else {
			$dataArr = array(
				'user_id' => $this->checkLogin('U'),
				'message' => $this->input->post('msg')
			);
			$this->product_model->simple_insert(UPLOAD_REQ,$dataArr);
			$this->send_upload_request_mail();
			$returnStr['status_code'] = 1;
			$returnStr['message'] = 'Your request received. We will contact you soon';
		}
		echo json_encode($returnStr);
	}

	public function send_upload_request_mail(){
		if ($this->checkLogin('U')!=''){
			$newsid='19';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$full_name = $this->data['userDetails']->row()->full_name;
			if ($full_name == ''){
				$full_name = $this->data['userDetails']->row()->user_name;
			}
			$adminnewstemplateArr=array(
				'logo'=> $this->data['logo'],
				'meta_title'=>$this->config->item('meta_title'),
				'msg'=>$this->input->post('msg')
			);
			extract($adminnewstemplateArr);
			$subject = $template_values['news_subject'];
			$message .= '<!DOCTYPE HTML>
                                <html>
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <meta name="viewport" content="width=device-width"/>
                                <title>'.$template_values['news_subject'].'</title><body>';
			include('./newsletter/registeration'.$newsid.'.php');

			$message .= '</body>
                                </html>';

			if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				$sender_email=$this->data['siteContactMail'];
				$sender_name=$this->data['siteTitle'];
			}else{
				$sender_name=$template_values['sender_name'];
				$sender_email=$template_values['sender_email'];
			}

			$email_values = array('mail_type'=>'html',
												'from_mail_id'=>$sender_email,
												'mail_name'=>$sender_name,
												'to_mail_id'=>$this->data['siteContactMail'],
												'subject_message'=>$subject,
												'body_messages'=>$message
			);
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
	}

}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */