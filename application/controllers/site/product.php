<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * User related functions
 * @author Teamtweaks
 *
 */

class Product extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model(array('product_model','user_model'));

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
		$this->data['likedProducts'] = array();
		if ($this->data['loginCheck'] != ''){
			//$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
            
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

	public function onboarding(){
		if ($this->checkLogin('U') == ''){
			redirect(base_url());
		}else {
			$this->data['userDetails'] = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
			if ($this->data['userDetails']->num_rows() == 1){
				if ($this->data['mainCategories']->num_rows()>0){
					foreach ($this->data['mainCategories']->result() as $cat){
						//						$condition = " where p.category_id like '".$cat->id.",%' OR p.category_id like '%,".$cat->id."' OR p.category_id like '%,".$cat->id.",%' OR p.category_id='".$cat->id."' order by p.created desc";
						$condition = " where FIND_IN_SET('".$cat->id."',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('".$cat->id."',p.category_id) order by p.created desc";
						$this->data['productDetails'][$cat->cat_name] = $this->product_model->view_product_details($condition);
					}
				}
				$this->load->view('site/user/onboarding',$this->data);
			}else {
				redirect(base_url());
			}
		}
	}

	public function onboarding_get_products_categories(){
		$returnCnt = '<div id="onboarding-category-items"><ol class="stream vertical">';
		$left = $top = $count = 0;
		$width = 220;
		$productArr = array();
		$catID = explode(',', $this->input->get('categories'));
		if (count($catID)>0){
			foreach ($catID as $cat){
				//				$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
				$condition = " where FIND_IN_SET('".$cat."',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('".$cat."',p.category_id) order by p.created desc";
				$productDetails = $this->product_model->view_product_details($condition);
				if ($productDetails->num_rows()>0){
					foreach ($productDetails->result() as $productRow){
						if (!in_array($productRow->id, $productArr)){
							array_push($productArr, $productRow->id);
							$img = '';
							$imgArr = explode(',', $productRow->image);
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
							if ($img!=''){
								$count++;
								$leftPos = $count%3;
								$leftPos = ($leftPos==0)?3:$leftPos;
								$leftPos--;
								if ($count%3 == 0){
									$topPos = $count/3;
								}else {
									$topPos	= ceil($count/3);
								}
								$topPos--;
								$leftVal = $leftPos*$width;
								$topVal = $topPos*$width;
								$returnCnt .='
									<li style="opacity: 1; top: '.$topVal.'px; left: '.$leftVal.'px;" class="start_marker_"><span class="pre hide"></span>
										<div class="figure-item">
											<a class="figure-img">
												<span style="background-image:url(\''.base_url().'images/product/'.$img.'\')" class="figure">
													<em class="back"></em>
													<img height="200" data-height="640" data-width="640" src="'.base_url().'images/product/'.$img.'"/>
												</span>
											</a>
											<a tid="'.$productRow->seller_product_id.'" class="button fancy noedit" href="#"><span><i></i></span>'.LIKE_BUTTON.'</a>
										</div>
									</li>
								';
							}
						}
					}
				}
			}
		}
		$returnCnt .= '
			</div>
		';
		echo $returnCnt;
	}

	public function onboarding_get_users_follow(){
		$catID = explode(',', $this->input->get('categories'));
		$productArr = array();
		$userArr = array();
		$userCountArr = array();
		$returnArr = array();

		/************Get Suggested Users List******************************/

		$returnArr['suggested'] = '<ul class="suggest-list">';
		if (count($catID)>0){
			foreach ($catID as $cat){
				//				$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
				$condition = " where FIND_IN_SET('".$cat."',p.category_id) and p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 and FIND_IN_SET('".$cat."',p.category_id)";
				$productDetails = $this->product_model->view_product_details($condition);
				if ($productDetails->num_rows()>0){
					foreach ($productDetails->result() as $productRow){
						if (!in_array($productRow->id, $productArr)){
							array_push($productArr, $productRow->id);
							if ($productRow->user_id != ''){
								if (!in_array($productRow->user_id, $userArr)){
									array_push($userArr, $productRow->user_id);
									$userCountArr[$productRow->user_id] = 1;
								}else {
									$userCountArr[$productRow->user_id]++;
								}
							}
						}
					}
				}
			}
		}
		arsort($userCountArr);
		$limitCount = 0;
		foreach ($userCountArr as $user_id => $products){
			if ($user_id!=''){
				$condition = array('id'=>$user_id,'is_verified'=>'Yes','status'=>'Active');
				$userDetails = $this->product_model->get_all_details(USERS,$condition);
				if ($userDetails->num_rows()==1){
					$condition = array('user_id'=>$user_id,'status'=>'Publish');
					$userProductDetails = $this->product_model->get_all_details(PRODUCT,$condition);
					if ($limitCount<10){
						$userImg = $userDetails->row()->thumbnail;
						if ($userImg == ''){
							$userImg = 'user-thumb1.png';
						}
						$returnArr['suggested'] .= '
							<li><span class="vcard"><img src="'.base_url().'images/users/'.$userImg.'"></span>
							<b>'.$userDetails->row()->full_name.'</b><br>
							'.$userDetails->row()->followers_count.' followers<br>
							'.$userProductDetails->num_rows().' things<br>
							<a uid="'.$user_id.'" class="follow-user-link" href="javascript:void(0)">Follow</a>
							<span class="category-thum">';
						$plimit = 0;
						if ($userProductDetails->num_rows()>0){
							foreach ($userProductDetails->result() as $userProduct){
								if ($plimit>3){break;}
								$img = '';
								$imgArr = explode(',', $userProduct->image);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
								if ($img != ''){

									$returnArr['suggested'] .='<img alt="'.$userProduct->product_name.'" src="'.base_url().'images/product/'.$img.'">';
									$plimit++;
								}
							}
						}

						$returnArr['suggested'] .='</span>
							</li>
						';
						$limitCount++;
					}
				}
			}
		}
		$returnArr['suggested'] .='</ul>';

		/***********************************************************/

		/****************Get Top Users For All Categories**********/
		$returnArr['categories'] = '';
		if ($this->data['mainCategories']->num_rows()>0){
			foreach ($this->data['mainCategories']->result() as $catRow){
				if ($catRow->id != '' && $catRow->cat_name != ''){
					$returnArr['categories'] .= '
					<div style="display:none;" class="intxt '.url_title($catRow->cat_name,'_',TRUE).'">
					<p class="stit"><span>'.$catRow->cat_name.'</span>
					<button class="btns-blue-embo btn-followall">Follow All</button></p>
					<ul class="suggest-list">';
					$userCountArr = $this->product_model->get_top_users_in_category($catRow->id);
					$limitCount = 0;
					foreach ($userCountArr as $user_id => $products){
						if ($user_id!=''){
							$condition = array('id'=>$user_id,'is_verified'=>'Yes','status'=>'Active');
							$userDetails = $this->product_model->get_all_details(USERS,$condition);
							if ($userDetails->num_rows()==1){
								$condition = array('user_id'=>$user_id,'status'=>'Publish');
								$userProductDetails = $this->product_model->get_all_details(PRODUCT,$condition);
								if ($limitCount<10){
									$userImg = $userDetails->row()->thumbnail;
									if ($userImg == ''){
										$userImg = 'user-thumb1.png';
									}
									$returnArr['categories'] .= '
											<li><span class="vcard"><img src="'.base_url().'images/users/'.$userImg.'"></span>
											<b>'.$userDetails->row()->full_name.'</b><br>
											'.$userDetails->row()->followers_count.' followers<br>
											'.$userProductDetails->num_rows().' things<br>
											<a uid="'.$user_id.'" class="follow-user-link" href="javascript:void(0)">Follow</a>
											<span class="category-thum">';
									$plimit = 0;
									if ($userProductDetails->num_rows()>0){
										foreach ($userProductDetails->result() as $userProduct){
											if ($plimit>3){break;}
											$img = '';
											$imgArr = explode(',', $userProduct->image);
											if (count($imgArr)>0){
												foreach ($imgArr as $imgRow){
													if ($imgRow != ''){
														$img = $imgRow;
														break;
													}
												}
											}
											if ($img != ''){
													
												$returnArr['categories'] .='<img alt="'.$userProduct->product_name.'" src="'.base_url().'images/product/'.$img.'">';
												$plimit++;
											}
										}
									}

									$returnArr['categories'] .='</span>
											</li>
										';
									$limitCount++;
								}
							}
						}
					}
					$returnArr['categories'] .='</ul></div>';
				}
			}
		}

		/**********************************************************/

		echo json_encode($returnArr);
	}

	public function display_product_shuffle(){
		$productDetails = $this->product_model->view_product_details(' where p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" or p.status="Publish" and p.quantity > 0 and p.user_id=0');
		if ($productDetails->num_rows()>0){
			$productId = array();
			foreach ($productDetails->result() as $productRow){
				array_push($productId, $productRow->id);
			}
			array_filter($productId);
			shuffle($productId);
			$pid = $productId[0];
			$productName = '';
			foreach ($productDetails->result() as $productRow){
				if ($productRow->id == $pid){
					$productName = $productRow->product_name;
				}
			}
			if ($productName == ''){
				redirect(base_url());
			}else {
				$link = 'things/'.$pid.'/'.url_title($productName,'-');
				redirect($link);
			}
		}else {
			redirect(base_url());
		}
	}

	public function load_short_url(){
		$short_url = $this->uri->segment(2,0);
		if ($short_url != ''){
			$url_details = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$short_url));
			if ($url_details->num_rows()==1){
				redirect($url_details->row()->long_url);
			}else {
				show_error('Invalid short url provided. Make sure the url you typed is correct. <a href="'.base_url().'">Click here</a> to go home page.','404','Invalid Url');
			}
		}

	}

	public function get_short_url(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			$returnStr['message'] = 'Login required';
		}else {
			$url = $this->input->post('url');
			$product_type = $this->input->post('product_type');
			$pidArr = explode('things/', $url);
			$pidArr = explode('/', $pidArr[1]);
			$pid = $pidArr[0];
			if ($product_type == 'selling'){
				$product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$pid));
				$pid = $product_details->row()->seller_product_id;
			}

			//Check same refer url exists in db
			$check_url = $this->product_model->get_all_details(SHORTURL,array('product_id'=>$pid,'user_id'=>$this->checkLogin('U')));

			if ($check_url->num_rows()>0){
				$short_url = $check_url->row()->short_url;
			}else {
				$short_url = $this->get_rand_str('6');
				$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$short_url));
				while ($checkId->num_rows()>0){
					$short_url = $this->get_rand_str('6');
					$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$short_url));
				}
				$this->product_model->simple_insert(SHORTURL,array('short_url'=>$short_url,'long_url'=>$url,'product_id'=>$pid,'user_id'=>$this->checkLogin('U')));
			}

			$returnStr['short_url']=base_url().'t/'.$short_url;
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);

	}

	public function display_product_detail(){
		$pid = $this->uri->segment(2,0);
		$limit = 0;
		$relatedArr = array();
		$relatedProdArr = array();
		//		$condition = " where p.id = '".$pid."' AND p.status = 'Publish'";
		$condition = "  where p.status='Publish' and u.group='Seller' and u.status='Active' and p.id='".$pid."' or p.status='Publish' and p.user_id=0 and p.id='".$pid."'";
		$this->data['productDetails'] = $this->product_model->view_product_details($condition);
		$this->data['PrdAttrVal'] = $this->product_model->view_subproduct_details_join($pid);
		if ($this->data['productDetails']->num_rows()==1){
			$this->data['productComment'] = $this->product_model->view_product_comments_details('where c.product_id='.$this->data['productDetails']->row()->seller_product_id.' order by c.dateAdded desc');

			$catArr = explode(',', $this->data['productDetails']->row()->category_id);
			if (count($catArr)>0){
				foreach ($catArr as $cat){
					if ($limit>2)break;
					if ($cat != ''){
						//						$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' AND p.id != '".$pid."' OR p.category_id='".$cat."' AND p.status = 'Publish' AND p.id != '".$pid."'";
						$condition =' where FIND_IN_SET("'.$cat.'",p.category_id) and p.quantity>0 and p.status="Publish" and u.group="Seller" and u.status="Active" and p.id != "'.$pid.'" or p.status="Publish" and p.quantity > 0 and p.user_id=0 and FIND_IN_SET("'.$cat.'",p.category_id) and p.id != "'.$pid.'" GROUP BY p.id';
						$relatedProductDetails = $this->product_model->view_product_details($condition);
						if ($relatedProductDetails->num_rows()>0){
							foreach ($relatedProductDetails->result() as $relatedProduct){
                                print_r($relatedProduct); die;
								if (!in_array($relatedProduct->id, $relatedArr)){
									array_push($relatedArr, $relatedProduct->id);
									$relatedProdArr[] = $relatedProduct;
									$limit++;
								}
							}
						}
					}
				}
			}
		}
		$this->data['relatedProductsArr'] = $relatedProdArr;
		
        
        $recentLikeArr = $this->product_model->get_recent_like_users($this->data['productDetails']->row()->seller_product_id);
		$recentUserLikes = array();
		if ($recentLikeArr->num_rows()>0){
			foreach ($recentLikeArr->result() as $recentLikeRow){
				if ($recentLikeRow->user_id != ''){
					$recentUserLikes[$recentLikeRow->user_id] = $this->product_model->get_recent_user_likes($recentLikeRow->user_id,$this->data['productDetails']->row()->seller_product_id);
				}
			}
		}
		$this->data['recentLikeArr'] = $recentLikeArr;
		$this->data['recentUserLikes'] = $recentUserLikes;
		if ($this->checkLogin('U') != ''){
			$this->data['userDetails'] = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		}else {
			$this->data['userDetails'] = array();
		}
		$this->data['seller_product_details'] = $this->product_model->get_all_details(PRODUCT,array('user_id'=>$this->data['productDetails']->row()->user_id,'id !='=>$pid,'status'=>'Publish'));
		$this->data['seller_affiliate_products'] = $this->product_model->get_all_details(USER_PRODUCTS,array('user_id'=>$this->data['productDetails']->row()->user_id));

		if ($this->data['productDetails']->row()->meta_title != ''){
			$this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
			$this->data['heading'] = $this->data['productDetails']->row()->meta_title;
		}else {
			$this->data['meta_title'] = $this->data['productDetails']->row()->product_name;
			$this->data['heading'] = $this->data['productDetails']->row()->product_name;
		}
		if ($this->data['productDetails']->row()->meta_keyword != ''){
			$this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
		}else {
			$this->data['meta_keyword'] = $this->data['productDetails']->row()->product_name;
		}
		if ($this->data['productDetails']->row()->meta_description != ''){
			$this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
		}else {
			$this->data['meta_description'] = $this->data['productDetails']->row()->product_name;
		}
		$this->data['product_feedback'] = $this->product_model->product_feedback_view($this->data['productDetails']->row()->user_id);
        
        
        // getting product rating summary
        $this->data['rating_summary'] = $this->product_model->get_product_rating_summary($this->data['productDetails']->row()->seller_product_id);

		$this->load->view('site/product/product_detail',$this->data);
	}

	public function delete_featured_find(){
		$uid = $this->checkLogin('U');
		$dataArr = array('feature_product'=>'');
		$condition = array('id'=>$uid);
		$this->product_model->update_details(USERS,$dataArr,$condition);
		echo '1';
	}

	public function add_featured_find(){
		$pid = $this->input->post('tid');
		$uid = $this->checkLogin('U');
		$dataArr = array('feature_product'=>$pid);
		$condition = array('id'=>$uid);
		$this->product_model->update_details(USERS,$dataArr,$condition);
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$createdTime = mdate($datestring,$time);
		$actArr = array(
			'activity'		=>	'featured',
			'activity_id'	=>	$pid,
			'user_id'		=>	$this->checkLogin('U'),
			'activity_ip'	=>	$this->input->ip_address(),
			'created'		=>	$createdTime
		);
		$this->product_model->simple_insert(NOTIFICATIONS,$actArr);
		$this->send_feature_noty_mail($pid);
		echo '1';
	}
	/* Ajax update for Product Details product */
	public function ajaxProductDetailAttributeUpdate(){

		$attrPriceVal = $this->product_model->get_all_details(SUBPRODUCT,array('pid'=>$this->input->post('attId'),'product_id'=>$this->input->post('prdId')));
		/*$shopattrVal = $this->product_model->get_all_details(SHOPPING_CART,array('user_id'=>$this->checkLogin('U'),'attribute_values'=>$attrPriceVal->row()->attr_id,'product_id'=>$this->input->post('prdId')));
		 if($shopattrVal->row()->quantity != ''){ $ShopVals = $shopattrVal->row()->quantity; }else{ $ShopVals = 0;} .'|'.$ShopVals*/
		if ($attrPriceVal->num_rows() == 0){
			$product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$this->input->post('prdId')));
			echo '0|'.$product_details->row()->sale_price;
		}else {
			echo $attrPriceVal->row()->attr_id.'|'.$attrPriceVal->row()->attr_price;
		}
	}

	public function share_with_someone(){
		$returnStr['status_code'] = 0;
		$thing = array();
		$thing['url'] = $this->input->post('url');
		$thing['name'] = $this->input->post('name');
		$thing['id'] = $this->input->post('oid');
		$thing['refid'] = $this->input->post('ooid');
		$thing['msg'] = $this->input->post('message');
		$thing['uname'] = $this->input->post('uname');
		$thing['timage'] = base_url().$this->input->post('timage');
		$email = $this->input->post('emails');
		$users = $this->input->post('users');
		if (valid_email($email)){
			$this->send_thing_share_mail($thing,$email);
			$returnStr['status_code'] = 1;
		}else {
			if($this->lang->line('invalid_email') != '')
			$returnStr['message'] = $this->lang->line('invalid_email');
			else
			$returnStr['message'] = 'Invalid email';
		}
		echo json_encode($returnStr);
	}

	public function send_thing_share_mail($thing='',$email=''){

		$newsid='2';
		$template_values=$this->product_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array(
			'meta_title'=> $this->config->item('meta_title'),
			'logo'=> $this->data['logo'],
			'uname'=>ucfirst($thing['uname']),
			'name'=>$thing['name'],
			'url'=>$thing['url'],
			'msg'=>$thing['msg'],
			'timage'=>$thing['timage'],
			'email_title'=>$this->config->item('email_title')
		);
		extract($adminnewstemplateArr);
		if ($this->data['userDetails']->row()->full_name != ''){
			$uname = $this->data['userDetails']->row()->full_name;
		}
		$subject = $template_values['news_subject'];
		$message .= '<!DOCTYPE HTML>
								<html>
								<head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
								<meta name="viewport" content="width=device-width"/>
								<title>'.$adminnewstemplateArr['meta_title'].' - Share Things</title>
								<body>';
		include('./newsletter/registeration'.$newsid.'.php');
			
		$message .= '</body>
								</html>';
		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,		
							'to_mail_id'=>$email,
							'subject_message'=>$subject,
							'body_messages'=>$message
		);
		$email_send_to_common = $this->product_model->common_email_send($email_values);

		/*		echo $this->email->print_debugger();die;
		 */
	}

	public function add_have_tag(){
		$returnStr['status_code'] = 0;
		$tid = $this->input->post('thing_id');
		$uid = $this->checkLogin('U');
		if ($uid != ''){
			$ownArr = explode(',', $this->data['userDetails']->row()->own_products);
			$ownCount = $this->data['userDetails']->row()->own_count;
			if (!in_array($tid, $ownArr)){
				array_push($ownArr, $tid);
				$ownCount++;
				$dataArr = array('own_products'=>implode(',', $ownArr),'own_count'=>$ownCount);
				$wantProducts = $this->product_model->get_all_details(WANTS_DETAILS,array('user_id'=>$this->checkLogin('U')));
				if ($wantProducts->num_rows() == 1){
					$wantProductsArr = explode(',', $wantProducts->row()->product_id);
					if (in_array($tid, $wantProductsArr)){
						if (($key = array_search($tid, $wantProductsArr))!== false){
							unset($wantProductsArr[$key]);
						}
						$wantsCount = $this->data['userDetails']->row()->want_count;
						$wantsCount--;
						$dataArr['want_count'] = $wantsCount;
						$this->product_model->update_details(WANTS_DETAILS,array('product_id'=>implode(',', $wantProductsArr)),array('user_id'=>$uid));
					}
				}
				$this->product_model->update_details(USERS,$dataArr,array('id'=>$uid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function delete_have_tag(){
		$returnStr['status_code'] = 0;
		$tid = $this->input->post('thing_id');
		$uid = $this->checkLogin('U');
		if ($uid != ''){
			$ownArr = explode(',', $this->data['userDetails']->row()->own_products);
			$ownCount = $this->data['userDetails']->row()->own_count;
			if (in_array($tid, $ownArr)){
				if ($key = array_search($tid, $ownArr) !== false){
					unset($ownArr[$key]);
					$ownCount--;
				}
				$this->product_model->update_details(USERS,array('own_products'=>implode(',', $ownArr),'own_count'=>$ownCount),array('id'=>$uid));
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function upload_product_image(){
		$returnStr['status_code'] = 0;
		$config['overwrite'] = FALSE;
		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		//	    $config['max_size'] = 2000;
		$config['upload_path'] = './images/product';
		$this->load->library('upload', $config);
		if ( $this->upload->do_upload('thefile')){
			$imgDetails = $this->upload->data();
			$returnStr['image']['url'] = base_url().'images/product/'.$imgDetails['file_name'];
			$returnStr['image']['width'] = $imgDetails['image_width'];
			$returnStr['image']['height'] = $imgDetails['image_height'];
			$returnStr['image']['name'] = $imgDetails['file_name'];
			
			$croping = TRUE;
			
			$this->load->library('image_lib');
			$thumb_file = './images/product/' .$imgDetails['file_name'];
			list($image_width, $image_height, $type, $attr) = getimagesize($thumb_file);
					
			if($image_width == $image_height){
				$croping = FALSE;					
			}else if($image_width > $image_height){
				$box_size = $image_height;
				$y_axis = 0;
				$x_axis = ($image_width - $image_height)/2;
			}else{
				$box_size = $image_width;
				$y_axis = ($image_height - $image_width)/2;
				$x_axis = 0;
			}
			
			if($croping){
				$image_config['image_library'] = 'gd2';
				$image_config['source_image'] = $thumb_file;
				$image_config['new_image'] = './images/product/thumbs/' . $imgDetails['file_name'];
				$image_config['quality'] = "100%";
				$image_config['maintain_ratio'] = FALSE;
				$image_config['width'] = $box_size;
				$image_config['height'] = $box_size;
				$image_config['x_axis'] = $x_axis ;
				$image_config['y_axis'] = $y_axis ;
				
				$this->image_lib->clear();
				$this->image_lib->initialize($image_config);				
				$this->image_lib->crop();
			}
			$returnStr['status_code'] = 1;
		}else {
			if($this->lang->line('cant_upload') != '')
			$returnStr['message'] = $this->lang->line('cant_upload');
			else
			$returnStr['message'] = 'Can\'t be upload';
		}
		echo json_encode($returnStr);
	}

	public function add_new_thing(){
		$returnStr['status_code'] = 0;
		$returnStr['message'] = '';
		if ($this->checkLogin('U') != ''){
			$short_url = $this->get_rand_str('6');
			$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$short_url));
			while ($checkId->num_rows()>0){
				$short_url = $this->get_rand_str('6');
				$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$short_url));
			}
			$result = $this->product_model->add_user_product($this->checkLogin('U'),$short_url);
			if ($result['image'] != ''){
				$this->imageResizeWithSpace(210, 210, $result['image'], './images/product/thumb/');
			}
			$returnStr['status_code'] = 1;
			$userDetails = $this->data['userDetails'];
			$total_added = $userDetails->row()->products;
			$total_added++;
			$this->product_model->update_details(USERS,array('products'=>$total_added),array('id'=>$this->checkLogin('U')));
			$returnStr['thing_url'] = 'user/'.$userDetails->row()->user_name.'/things/'.$result['pid'].'/'.url_title($this->input->post('name'),'-');
		}
		echo json_encode($returnStr);
	}

	public function extract_image_urls(){
		include('./simple_html_dom.php');
		//	$returnStr['status_code'] = 0;
		$returnStr['response'] = array();
		$host_name_arr = explode('/', $this->input->get('url'));
		$url = 'http://'.$this->input->get('url');
		$url = str_replace(" ", '%20', $url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //Set curl to return the data instead of printing it to the browser.
		$html_cnt = curl_exec($ch);
		//echo $html_cnt;die;
/*		echo "<pre>"; print_r(curl_getinfo($ch)) . '<br/>';
		echo "<pre>"; var_dump(curl_getinfo($ch, CURLINFO_HTTP_CODE)) . '<br/>';
echo curl_errno($ch) . '<br/>';
echo curl_error($ch) . '<br/>';*/
		curl_close($ch);
		/*$html_cnt = file_get_html($url);*/
		$html_base = new simple_html_dom();
		$html_base->load($html_cnt);
//		var_dump($html_cnt);//die;
		foreach($html_base->find('img') as $imageURL)      ////Map Url
		{
			if (substr($imageURL->src, 0,4)=='http' || substr($imageURL->src, 0,2)=='//'){
				//				if (substr($imageURL->src, -3,3)=='jpg' || substr($imageURL->src, -3,3)=='png' || substr($imageURL->src, -3,3)=='gif' || substr($imageURL->src, -4,4)=='jpeg'){
				array_push($returnStr['response'], $imageURL->src);
				$returnStr['alt'][] = $imageURL->alt;
				//				}
			}else {
				//				if (substr($imageURL->src, -3,3)=='jpg' || substr($imageURL->src, -3,3)=='png' || substr($imageURL->src, -3,3)=='gif' || substr($imageURL->src, -4,4)=='jpeg'){
				if (substr($imageURL->src,0,1)=='/'){
					array_push($returnStr['response'], 'http://'.$host_name_arr[0].$imageURL->src);
				}else {
					array_push($returnStr['response'], 'http://'.$host_name_arr[0].'/'.$imageURL->src);
				}
				$returnStr['alt'][] = $imageURL->alt;
				//				}
			}
		}
		foreach($html_base->find('title') as $titleName)
		{
			$returnStr['title'][] = $titleName->innertext;
		}
		$html_base->clear();
		unset($html_base);
		echo json_encode($returnStr);
	}

	public function display_user_thing(){
		$uname = $this->uri->segment(2,0);
		$pid = $this->uri->segment(4,0);
		$this->data['productUserDetails'] = $this->product_model->get_all_details(USERS,array('user_name'=>$uname));
		$this->data['productDetails'] = $this->product_model->view_notsell_product_details(' where p.seller_product_id="'.$pid.'" and p.status="Publish"');
		if ($this->data['productDetails']->num_rows() == 1){
			$this->data['heading'] = $this->data['productDetails']->row()->product_name;
			$categoryArr = explode(',', $this->data['productDetails']->row()->category_id);
			$catID = 0;
			if (count($categoryArr)>0){
				foreach ($categoryArr as $catRow){
					if ($catRow != ''){
						$catID = $catRow;
						break;
					}
				}
			}
			$this->data['relatedProductsArr'] = $this->product_model->get_products_by_category($catID);
			if ($this->data['productDetails']->row()->meta_title != ''){
				$this->data['meta_title'] = $this->data['productDetails']->row()->meta_title;
			}else {
				$this->data['meta_title'] = $this->data['productDetails']->row()->product_name;
			}
			if ($this->data['productDetails']->row()->meta_keyword != ''){
				$this->data['meta_keyword'] = $this->data['productDetails']->row()->meta_keyword;
			}else {
				$this->data['meta_keyword'] = $this->data['productDetails']->row()->product_name;
			}
			if ($this->data['productDetails']->row()->meta_description != ''){
				$this->data['meta_description'] = $this->data['productDetails']->row()->meta_description;
			}else {
				$this->data['meta_description'] = $this->data['productDetails']->row()->product_name;
			}
            
            // getting product rating summary
            $this->data['rating_summary'] = $this->product_model->get_product_rating_summary($this->data['productDetails']->row()->seller_product_id);
            
			$this->load->view('site/product/display_user_product',$this->data);
		}else {
			$this->load->view('site/product/product_detail',$this->data);
		}
	}

	public function sales_create(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$userType = $this->data['userDetails']->row()->group;
			if ($userType == 'Seller'){
				$pid = $this->input->get('ntid');
				$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
				if ($productDetails->num_rows()==1){
					if ($productDetails->row()->user_id == $this->data['userDetails']->row()->id){
						$this->data['productDetails'] = $productDetails;
						$this->data['editmode'] = '0';
						$this->load->view('site/product/edit_seller_product',$this->data);
					}else {
						show_404();
					}
				}else {
					show_404();
				}
			}else {
				redirect('seller-signup');
			}
		}
	}

	/**
	 *
	 * Ajax function for delete the product pictures
	 */
	public function editPictureProducts(){
		$ingIDD = $this->input->post('imgId');
		$currentPage = $this->input->post('cpage');
		$id = $this->input->post('val');
		$productImage = explode(',',$this->session->userdata('product_image_'.$ingIDD));
		if(count($productImage) < 2) {
			echo json_encode("No");exit();
		} else {
			$empImg = 0;
			foreach ($productImage as $product) {
				if ($product != ''){
					$empImg++;
				}
			}
			if ($empImg<2){
				echo json_encode("No");exit();
			}
			$this->session->unset_userdata('product_image_'.$ingIDD);
			$resultVar = $this->setPictureProducts($productImage,$this->input->post('position'));
			$insertArrayItems = trim(implode(',',$resultVar)); //need validation here...because the array key changed here

			$this->session->set_userdata(array('product_image_'.$ingIDD => $insertArrayItems));
			$dataArr = array('image' => $insertArrayItems);
			$condition = array('id' => $ingIDD);
			$this->product_model->update_details(PRODUCT,$dataArr,$condition);
			echo json_encode($insertArrayItems);
		}
	}


	public function edit_product_detail(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$pid = $this->uri->segment(2,0);
			$viewMode = $this->uri->segment(4,0);
			$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
			if ($productDetails->num_rows()==1){
				if ($productDetails->row()->user_id == $this->checkLogin('U')){
					$this->data['productDetails'] = $productDetails;
					$this->load->view('site/product/edit_user_product',$this->data);
				}else {
					show_404();
				}
			}else {
				$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
				$this->data['categoryView'] = $this->product_model->get_category_details($productDetails->row()->category_id);
				$this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
				$this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
				$this->data['SubPrdVal'] = $this->product_model->view_subproduct_details($productDetails->row()->id);
				if ($productDetails->num_rows()==1){
					if ($productDetails->row()->user_id == $this->checkLogin('U')){
						$this->data['productDetails'] = $productDetails;
						$this->data['editmode'] = '1';
						if ($viewMode == ''){
							$this->load->view('site/product/edit_seller_product',$this->data);
						}else {
							$this->load->view('site/product/edit_seller_product_'.$viewMode,$this->data);
						}
					}else {
						show_404();
					}
				}else {
					show_404();
				}
			}
		}
	}

	public function edit_user_product_process(){
		$mode = $this->input->post('submit');
		$pid = $this->input->post('productID');
		if ($pid != ''){
			if ($mode == 'Upload'){
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				//			    $config['max_size'] = 2000;
				$config['upload_path'] = './images/product';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('uploadphoto')){
					$imgDetails = $this->upload->data();
					$this->imageResizeWithSpace(600, 600, $imgDetails['file_name'], './images/product/');
					$this->imageResizeWithSpace(210, 210, $imgDetails['file_name'], './images/product/thumb/');
					$dataArr['image'] = $imgDetails['file_name'];
					$this->product_model->update_details(USER_PRODUCTS,$dataArr,array('seller_product_id'=>$pid));
					if($this->lang->line('poto_chage_succ') != '')
					$lg_err_msg = $this->lang->line('poto_chage_succ');
					else
					$lg_err_msg = 'Photo changed successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					echo '<script>window.history.go(-1)</script>';
				}else {
					if($this->lang->line('cant_upload') != '')
					$lg_err_msg = $this->lang->line('cant_upload');
					else
					$lg_err_msg = 'Can\'t able to upload';
					$this->setErrorMessage('error',$lg_err_msg);
					echo '<script>window.history.go(-1)</script>';
				}
			}else {
				$excludeArr = array('productID','submit','uploadphoto');
				$dataArr = array(
					'seourl'	=>	url_title($this->input->post('product_name'),'-'),
					'modified'	=>	'now()'
					);
					$this->product_model->commonInsertUpdate(USER_PRODUCTS,'update',$excludeArr,$dataArr,array('seller_product_id'=>$pid));
					if($this->lang->line('det_updat_succ') != '')
					$lg_err_msg = $this->lang->line('det_updat_succ');
					else
					$lg_err_msg = 'Details updated successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					redirect('user/'.$this->data['userDetails']->row()->user_name.'/things/'.$pid.'/'.url_title($this->input->post('product_name'),'-'));

			}
		}
	}

	public function update_price_range_in_table($mode='',$price_range='',$product_id='0',$old_product_details=''){
		$list_values = $this->product_model->get_all_details(LIST_VALUES,array('list_value'=>$price_range));
		if ($list_values->num_rows() == 1){
			$products = explode(',', $list_values->row()->products);
			$product_count = $list_values->row()->product_count;
			if ($mode == 'add'){
				if (!in_array($product_id, $products)){
					array_push($products, $product_id);
					$product_count++;
				}
			}else if ($mode == 'edit'){
				$old_price_range = '';
				if ($old_product_details!='' && count($old_product_details)>0 && $old_product_details->num_rows()==1){
					$old_price_range = $old_product_details->row()->price_range;
				}
				if ($old_price_range != '' && $old_price_range != $price_range){
					$old_list_values = $this->product_model->get_all_details(LIST_VALUES,array('list_value'=>$old_price_range));
					if ($old_list_values->num_rows() == 1){
						$old_products = explode(',', $old_list_values->row()->products);
						$old_product_count = $old_list_values->row()->product_count;
						if (in_array($product_id, $old_products)){
							if (($key=array_search($product_id, $old_products)) !== false){
								unset($old_products[$key]);
								$old_product_count--;
								$updateArr = array('products'=>implode(',', $old_products),'product_count'=>$old_product_count);
								$updateCondition = array('list_value'=>$old_price_range);
								$this->product_model->update_details(LIST_VALUES,$updateArr,$updateCondition);
							}
						}
					}
					if (!in_array($product_id, $products)){
						array_push($products, $product_id);
						$product_count++;
					}
				}else if ($old_price_range != '' && $old_price_range == $price_range){
					if (!in_array($product_id, $products)){
						array_push($products, $product_id);
						$product_count++;
					}
				}
			}
			$updateArr = array('products'=>implode(',', $products),'product_count'=>$product_count);
			$updateCondition = array('list_value'=>$price_range);
			$this->product_model->update_details(LIST_VALUES,$updateArr,$updateCondition);
		}
	}

	public function sell_it(){
		$mode = $this->uri->segment(4,0);
		$pid = $this->input->post('PID');
		$nextMode = $this->input->post('nextMode');
		$excludeArr = array('PID','nextMode','changeorder','imaged','gateway_tbl_length','category_id','attribute_name','attribute_val');
		if ($mode == '1'){
			$price_range = 0;
			$price = $this->input->post('sale_price');
			if ($price>0 && $price<21){
				$price_range = '1-20';
			}else if ($price>20 && $price<101){
				$price_range = '21-100';
			}else if ($price>100 && $price<201){
				$price_range = '101-200';
			}else if ($price>200 && $price<501){
				$price_range = '201-500';
			}else if ($price>500){
				$price_range = '501+';
			}
			if ($pid == ''){
				$old_product_details = array();
				//$condition = array('product_name' => $product_name);
			}else {
				$old_product_details = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
				//$condition = array('product_name' => $product_name,'seller_product_id !=' => $pid);
			}
			$dataArr = array('seller_product_id'=>$pid);
			$checkProduct = $this->product_model->get_all_details(PRODUCT,$dataArr);
			if ($checkProduct->num_rows()==0){
				$userProduct = $this->product_model->get_all_details(USER_PRODUCTS,$dataArr);
				if ($userProduct->num_rows()==1){
					$dataArr['image']	=	$userProduct->row()->image;
					$dataArr['seourl']	=	url_title($this->input->post('product_name'),'-');
					$dataArr['user_id'] =	$userProduct->row()->user_id;
					$dataArr['price_range'] =	$price_range;
					$dataArr['category_id']	=	$userProduct->row()->category_id;
					$this->product_model->commonInsertUpdate(PRODUCT,'insert',$excludeArr,$dataArr);
					$product_id = $this->product_model->get_last_insert_id();
					$this->update_price_range_in_table('add',$price_range,$product_id,$old_product_details);
					$this->product_model->commonDelete(USER_PRODUCTS,array('seller_product_id'=>$pid));
					if($this->lang->line('change_saved') != '')
					$lg_err_msg = $this->lang->line('change_saved');
					else
					$lg_err_msg = 'Yeah ! changes have been saved';
					$this->setErrorMessage('success',$lg_err_msg);
					$addedProd = $this->session->userdata('prodID');
					if ($addedProd == ''){
						$addedProd = array();
					}
					array_push($addedProd, $pid);
					$this->session->set_userdata('prodID',$addedProd);
					redirect('things/'.$pid.'/edit/'.$nextMode);
				}
			}else {
				$dataArr['seourl']	=	url_title($this->input->post('product_name'),'-');
				$dataArr['price_range'] =	$price_range;
				$this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,$dataArr,array('seller_product_id'=>$pid));
				$this->update_price_range_in_table('edit',$price_range,$old_product_details->row()->id,$old_product_details);
				if($this->lang->line('change_saved') != '')
				$lg_err_msg = $this->lang->line('change_saved');
				else
				$lg_err_msg = 'Yeah ! changes have been saved';
				$this->setErrorMessage('success',$lg_err_msg);
				redirect('things/'.$pid.'/edit');
			}
		}else if ($mode == 'seo'){
			$this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,array(),array('seller_product_id'=>$pid));
			if($this->lang->line('change_saved') != '')
			$lg_err_msg = $this->lang->line('change_saved');
			else
			$lg_err_msg = 'Yeah ! changes have been saved';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('things/'.$pid.'/edit/'.$nextMode);
		}else if ($mode == 'images'){
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			//		    $config['max_size'] = 2000;
			$config['upload_path'] = './images/product';
			$this->load->library('upload', $config);
			//echo "<pre>";print_r($_FILES);die;
			$ImageName = '';
			if ( $this->upload->do_multi_upload('product_image')){
				$logoDetails = $this->upload->get_multi_upload_data();
				foreach ($logoDetails as $fileDetails){
					$this->imageResizeWithSpace(600, 600, $fileDetails['file_name'], './images/product/');
					$this->imageResizeWithSpace(210, 210, $fileDetails['file_name'], './images/product/thumb/');
					$ImageName .= $fileDetails['file_name'].',';
				}
			}
			$existingImage = $this->input->post('imaged');

			$newPOsitionArr = $this->input->post('changeorder');
			$imagePOsit = array();

			for($p=0;$p<sizeof($existingImage);$p++) {
				$imagePOsit[$newPOsitionArr[$p]] = $existingImage[$p];
			}

			ksort($imagePOsit);
			foreach ($imagePOsit as $keysss => $vald) {
				$imgArraypos[]=$vald;
			}
			$imagArraypo0 = @implode(",",$imgArraypos);
			$allImages = $imagArraypo0.','.$ImageName;

			$dataArr = array( 'image' => $allImages);
			$this->product_model->update_details(PRODUCT,$dataArr,array('seller_product_id'=>$pid));
			if($this->lang->line('change_saved') != '')
			$lg_err_msg = $this->lang->line('change_saved');
			else
			$lg_err_msg = 'Yeah ! changes have been saved';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('things/'.$pid.'/edit/'.$nextMode);
		}else if ($mode == 'categories'){
			if ($this->input->post('category_id') != ''){
				$category_id = implode(',', $this->input->post('category_id'));
			}else {
				$category_id = '';
			}
			$dataArr = array( 'category_id' => $category_id);
			$this->product_model->update_details(PRODUCT,$dataArr,array('seller_product_id'=>$pid));
			if($this->lang->line('change_saved') != '')
			$lg_err_msg = $this->lang->line('change_saved');
			else
			$lg_err_msg = 'Yeah ! changes have been saved';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('things/'.$pid.'/edit/'.$nextMode);
		}else if ($mode == 'list') {
			$list_name_str = $list_val_str = '';
			$list_name_arr = $this->input->post('attribute_name');
			$list_val_arr = $this->input->post('attribute_val');
			if (is_array($list_name_arr) && count($list_name_arr)>0){
				$list_name_str = implode(',', $list_name_arr);
				$list_val_str = implode(',', $list_val_arr);
			}
			$dataArr = array( 'list_name' => $list_name_str,'list_value'=>$list_val_str);
			$this->product_model->update_details(PRODUCT,$dataArr,array('seller_product_id'=>$pid));

			//Update the list table
			if (is_array($list_val_arr)){
				foreach ($list_val_arr as $list_val_row){
					$list_val_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$list_val_row));
					if ($list_val_details->num_rows()==1){
						$product_count = $list_val_details->row()->product_count;
						$products_in_this_list = $list_val_details->row()->products;
						$products_in_this_list_arr = explode(',', $products_in_this_list);
						if (!in_array($pid, $products_in_this_list_arr)){
							array_push($products_in_this_list_arr, $pid);
							$product_count++;
							$list_update_values = array(
								'products'=>implode(',', $products_in_this_list_arr),
								'product_count'=>$product_count
							);
							$list_update_condition = array('id'=>$list_val_row);
							$this->product_model->update_details(LIST_VALUES,$list_update_values,$list_update_condition);
						}
					}
				}
			}

			if($this->lang->line('change_saved') != '')
			$lg_err_msg = $this->lang->line('change_saved');
			else
			$lg_err_msg = 'Yeah ! changes have been saved';
			$this->setErrorMessage('success',$lg_err_msg);
			redirect('things/'.$pid.'/edit/'.$nextMode);
		}else if ($mode == 'attribute') {
			$dataArr = array('seller_product_id'=>$pid);
			$checkProduct = $this->product_model->get_all_details(PRODUCT,$dataArr);
			if ($checkProduct->num_rows()==1){
				$prodId = $checkProduct->row()->id;
				$Attr_name_str = $Attr_val_str = '';
				$Attr_type_arr = $this->input->post('product_attribute_type');
				$Attr_name_arr = $this->input->post('product_attribute_name');
				$Attr_val_arr = $this->input->post('product_attribute_val');
				if (is_array($Attr_type_arr) && count($Attr_type_arr)>0){
					for($k=0;$k<sizeof($Attr_type_arr);$k++){
						$dataSubArr = '';
						$dataSubArr = array('product_id'=> $prodId,'attr_id'=>$Attr_type_arr[$k],'attr_name'=>$Attr_name_arr[$k],'attr_price'=>$Attr_val_arr[$k]);
						//echo '<pre>'; print_r($dataSubArr);
						$this->product_model->add_subproduct_insert($dataSubArr);
					}
				}
					
				if($this->lang->line('change_saved') != '')
				$lg_err_msg = $this->lang->line('change_saved');
				else
				$lg_err_msg = 'Yeah ! changes have been saved';
				$this->setErrorMessage('success',$lg_err_msg);
			}else {
				if($this->lang->line('prod_not_found_db') != '')
				$lg_err_msg = $this->lang->line('prod_not_found_db');
				else
				$lg_err_msg = 'Product not found in database';
				$this->setErrorMessage('error',$lg_err_msg);
			}
			redirect('things/'.$pid.'/edit/'.$nextMode);

		}else {
			show_404();
		}
	}

	public function delete_product(){
		$pid = $this->uri->segment(2,0);
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
			if ($productDetails->num_rows()==1){
				if ($productDetails->row()->user_id == $this->checkLogin('U')){
					$this->product_model->commonDelete(USER_PRODUCTS,array('seller_product_id'=>$pid));
					$productCount = $this->data['userDetails']->row()->products;
					$productCount--;
					$this->product_model->update_details(USERS,array('products'=>$productCount),array('id'=>$this->checkLogin('U')));
					if($this->lang->line('prod_del_succ') != '')
					$lg_err_msg = $this->lang->line('prod_del_succ');
					else
					$lg_err_msg = 'Product deleted successfully';
					$this->setErrorMessage('success',$lg_err_msg);
					redirect('user/'.$this->data['userDetails']->row()->user_name.'/added');
				}else {
					show_404();
				}
			}else {
				$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
				if ($productDetails->num_rows()==1){
					if ($productDetails->row()->user_id == $this->checkLogin('U')){
						$this->product_model->commonDelete(PRODUCT,array('seller_product_id'=>$pid));
						$productCount = $this->data['userDetails']->row()->products;
						$productCount--;
						$this->product_model->update_details(USERS,array('products'=>$productCount),array('id'=>$this->checkLogin('U')));
						if($this->lang->line('prod_del_succ') != '')
						$lg_err_msg = $this->lang->line('prod_del_succ');
						else
						$lg_err_msg = 'Product deleted successfully';
						$this->setErrorMessage('success',$lg_err_msg);
						redirect('user/'.$this->data['userDetails']->row()->user_name.'/added');
					}else {
						show_404();
					}
				}else {
					show_404();
				}
			}
		}
	}

	public function add_reaction_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 0){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows() == 0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$dataArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'),'ip'=>$this->input->ip_address());
					$this->user_model->simple_insert(PRODUCT_LIKES,$dataArr);
					$actArr = array(
						'activity_name'	=>	'fancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$likes++;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes++;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					/*
					 * -------------------------------------------------------
					 * Creating list automatically when user likes a product
					 * -------------------------------------------------------
					 *
					 $listCheck = $this->user_model->get_list_details($tid,$this->checkLogin('U'));
					 if ($listCheck->num_rows() == 0){
					 $productCategoriesArr = explode(',', $productDetails->row()->category_id);
					 if (count($productCategoriesArr)>0){
					 foreach ($productCategoriesArr as $productCategoriesRow){
					 if ($productCategoriesRow != ''){
					 $productCategory = $this->user_model->get_all_details(CATEGORY,array('id'=>$productCategoriesRow));
					 if ($productCategory->num_rows()==1){

					 }
					 }
					 }
					 }
					 }
					 */
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);

	}

	public function delete_reaction_tag(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U') == ''){
			if($this->lang->line('u_must_login') != '')
			$returnStr['message'] = $this->lang->line('u_must_login');
			else
			$returnStr['message'] = 'You must login';
		}else {
			$tid = $this->input->post('thing_id');
			$checkProductLike = $this->user_model->get_all_details(PRODUCT_LIKES,array('product_id'=>$tid,'user_id'=>$this->checkLogin('U')));
			if ($checkProductLike->num_rows() == 1){
				$productDetails = $this->user_model->get_all_details(PRODUCT,array('seller_product_id'=>$tid));
				if ($productDetails->num_rows()==0){
					$productDetails = $this->user_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$tid));
					$productTable = USER_PRODUCTS;
				}else {
					$productTable = PRODUCT;
				}
				if ($productDetails->num_rows()==1){
					$likes = $productDetails->row()->likes;
					$conditionArr = array('product_id'=>$tid,'user_id'=>$this->checkLogin('U'));
					$this->user_model->commonDelete(PRODUCT_LIKES,$conditionArr);
					$actArr = array(
						'activity_name'	=>	'unfancy',
						'activity_id'	=>	$tid,
						'user_id'		=>	$this->checkLogin('U'),
						'activity_ip'	=>	$this->input->ip_address()
					);
					$this->user_model->simple_insert(USER_ACTIVITY,$actArr);
					$likes--;
					$dataArr = array('likes'=>$likes);
					$condition = array('seller_product_id'=>$tid);
					$this->user_model->update_details($productTable,$dataArr,$condition);
					$totalUserLikes = $this->data['userDetails']->row()->likes;
					$totalUserLikes--;
					$this->user_model->update_details(USERS,array('likes'=>$totalUserLikes),array('id'=>$this->checkLogin('U')));
					$returnStr['status_code'] = 1;
				}else {
					if($this->lang->line('prod_not_avail') != '')
					$returnStr['message'] = $this->lang->line('prod_not_avail');
					else
					$returnStr['message'] = 'Product not available';
				}
			}else {
				$returnStr['status_code'] = 1;
			}
		}
		echo json_encode($returnStr);
	}

	public function loadListValues(){
		$returnStr['listCnt'] = '<option value="">--Select--</option>';
		$lid = $this->input->post('lid');
		$lvID = $this->input->post('lvID');
		if ($lid != ''){
			$listValues = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>$lid));
			if ($listValues->num_rows()>0){
				foreach ($listValues->result() as $listRow){
					$selStr = '';
					if ($listRow->id == $lvID){
						$selStr = 'selected="selected"';
					}
					$returnStr['listCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->list_value.'</option>';
				}
			}
		}
		echo json_encode($returnStr);
	}

	public function approve_comment(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')!=''){
			$cid = $this->input->post('cid');
			$this->product_model->update_details(PRODUCT_COMMENTS,array('status'=>'Active'),array('id'=>$cid));
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			$createdTime = mdate($datestring,$time);
			$product_id = $this->input->post('tid');
			$user_id = $this->input->post('uid');
			$this->product_model->commonDelete(NOTIFICATIONS,array('comment_id'=>$cid));
			$actArr = array(
				'activity'		=>	'comment',
				'activity_id'	=>	$product_id,
				'user_id'		=>	$user_id,
				'activity_ip'	=>	$this->input->ip_address(),
				'comment_id'	=>	$cid,
				'created'		=>	$createdTime
			);
			$this->product_model->simple_insert(NOTIFICATIONS,$actArr);
			$this->send_comment_noty_mail($product_id,$cid);
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function delete_comment(){
		$returnStr['status_code'] = 0;
		if ($this->checkLogin('U')!=''){
			$cid = $this->input->post('cid');
			$this->product_model->commonDelete(PRODUCT_COMMENTS,array('id'=>$cid));
			$returnStr['status_code'] = 1;
		}
		echo json_encode($returnStr);
	}

	public function send_feature_noty_mail($pid='0'){
		if ($pid!= '0'){
			$productUserDetails = $this->product_model->get_product_full_details($pid);
			if ($productUserDetails->num_rows()>0){
				$emailNoty = explode(',', $productUserDetails->row()->email_notifications);
				if (in_array('featured', $emailNoty)){
					if ($productUserDetails->prodmode == 'seller'){
						$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
					}else {
						$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
					}

					$newsid='10';
					$template_values=$this->product_model->get_newsletter_template_details($newsid);
					$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$productUserDetails->row()->full_name,'cfull_name'=>$this->data['userDetails']->row()->full_name,'product_name'=>$productUserDetails->row()->product_name,'user_name'=>$this->data['userDetails']->row()->user_name);
					extract($adminnewstemplateArr);
					$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
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
										'to_mail_id'=>$productUserDetails->row()->email,
										'subject_message'=>$subject,
										'body_messages'=>$message
					);
					$email_send_to_common = $this->product_model->common_email_send($email_values);
				}
			}
		}
	}

	public function contactform(){

		$dataArrVal = array();
		foreach($this->input->post() as $key => $val){
			$dataArrVal[$key] = trim(addslashes($val));
		}

		$this->product_model->simple_insert(CONTACTSELLER,$dataArrVal);
		//$contact_id = $this->product_model->get_last_insert_id();
		$this->data['productVal'] = $this->product_model->get_all_details(PRODUCT,array( 'id' => $this->input->post('product_id')));


		$newimages = array_filter(@explode(',',$this->data['productVal']->row()->image));

		$newsid='20';
		$template_values=$this->product_model->get_newsletter_template_details($newsid);

		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],
							'name'=>$this->input->post('name'),
							'question'=>$this->input->post('question'),
							'email'=>$this->input->post('email'),
							'phone'=>$this->input->post('phone'),
							'productId'=>$this->data['productVal']->row()->id,
							'productName'=>$this->data['productVal']->row()->product_name,
							'productSeourl'=>$this->data['productVal']->row()->seourl,
							'productImage'=>$newimages[0],
		);
		extract($adminnewstemplateArr);



		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";

		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
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
							'to_mail_id'=>$this->input->post('selleremail'),
							'cc_mail_id'=>$this->config->item('site_contact_mail'),
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
		);

		$email_send_to_common = $this->product_model->common_email_send($email_values);
		$this->setErrorMessage('success','Message Sent Successfully!');
		echo 'Success';

	}

	public function send_comment_noty_mail($pid='0',$cid='0'){
		if ($pid!= '0' && $cid != '0'){
			$likeUserList = $this->product_model->get_like_user_full_details($pid);
			if ($likeUserList->num_rows()>0){
				$productUserDetails = $this->product_model->get_product_full_details($pid);
				$commentDetails = $this->product_model->view_product_comments_details('where c.id='.$cid);
				if ($productUserDetails->num_rows()>0 && $commentDetails->num_rows()==1){
					foreach ($likeUserList->result() as $likeUserListRow){
						$emailNoty = explode(',', $likeUserListRow->email_notifications);
						if (in_array('comments_on_fancyd', $emailNoty)){
							if ($productUserDetails->prodmode == 'seller'){
								$prodLink = base_url().'things/'.$productUserDetails->row()->id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}else {
								$prodLink = base_url().'user/'.$productUserDetails->row()->user_name.'/things/'.$productUserDetails->row()->seller_product_id.'/'.url_title($productUserDetails->row()->product_name,'-');
							}

							$newsid='8';
							$template_values=$this->product_model->get_newsletter_template_details($newsid);
							$adminnewstemplateArr=array('logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'),'full_name'=>$likeUserListRow->full_name,'cfull_name'=>$commentDetails->row()->full_name,'user_name'=>$commentDetails->row()->user_name,'product_name'=>$productUserDetails->row()->product_name);
							extract($adminnewstemplateArr);
							$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
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
												'to_mail_id'=>$likeUserListRow->email,
												'subject_message'=>$subject,
												'body_messages'=>$message
							);
							$email_send_to_common = $this->product_model->common_email_send($email_values);
						}
					}
				}
			}
		}
	}

	public function add_product_via_email(){
		$returnStr['status_code'] = 0;
		$returnStr['message'] = '';
		if ($this->checkLogin('U') != ''){

			/***---Update in db---***/
			$userDetails = $this->data['userDetails'];
			$dataArr = array(
				'user_id'	=>	$this->checkLogin('U'),
				'user_name'	=>	$userDetails->row()->user_name,
				'title'		=>	$this->input->post('title'),
				'comment'		=>	$this->input->post('comment')
			);
			$this->product_model->simple_insert(UPLOAD_MAILS,$dataArr);
			/***---Update in db---***/
			 	
			/***---Send Mail---***/
			$newsid='18';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$full_name = $userDetails->row()->full_name;
			if ($full_name == ''){
				$full_name = $userDetails->row()->user_name;
			}
			$thumbnail = '';
			if ($userDetails->row()->thumbnail != ''){
				$thumbnail = '<img width="100px" src="'.base_url().'images/users/'.$userDetails->row()->thumbnail.'"/>';
			}
			$adminnewstemplateArr=array(
				'logo'=> $this->data['logo'],
				'meta_title'=>$this->config->item('meta_title'),
				'user_name'=>$userDetails->row()->user_name,
				'title'=>$this->input->post('title'),
				'comment'=>$this->input->post('comment')
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
			/***---Send Mail---***/

			$returnStr['status_code'] = 1;
			if($this->lang->line('ur_msg_sent') != '')
			$returnStr['message'] = $this->lang->line('ur_msg_sent');
			else
			$returnStr['message'] = 'Your message sent';
		}else {
			if($this->lang->line('login_requ') != '')
			$returnStr['message'] = $this->lang->line('login_requ');
			else
			$returnStr['message'] = 'Login required';
		}
		echo json_encode($returnStr);
	}

	public function ajaxProductAttributeUpdate(){

		$conditons = array('pid'=>$this->input->post('pid'));
		$dataArr = array('attr_id'=>$this->input->post('attId'),'attr_name'=>$this->input->post('attname'),'attr_price'=>$this->input->post('attprice'));
		$subproductDetails = $this->product_model->edit_subproduct_update($dataArr,$conditons);
	}

	public function remove_attr(){
		if ($this->checkLogin('U') != ''){
			$this->product_model->commonDelete(SUBPRODUCT,array('pid'=>$this->input->post('pid')));
		}
	}

	/**
	 *
	 * Update unique id for products
	 */

	/*	public function qq(){
	 $productDetails = $this->product_model->get_all_details(PRODUCT,array());
	 foreach ($productDetails->result() as $row){
	 $pid = mktime();
	 $checkId = $this->product_model->check_product_id($pid);
	 while ($checkId->num_rows()>0){
	 $pid = mktime();
	 $checkId = $this->product_model->check_product_id($pid);
	 }
	 $this->product_model->update_details(PRODUCT,array('seller_product_id'=>$pid),array('id'=>$row->id));
	 echo $row->id.' , ';
	 }
	 echo 'rows updated';
	 }
	 */

	public function update_owns(){
		echo 'Updating Own Products<br/><hr/><br/>';
		$user_list = $this->product_model->get_all_details(USERS,array());
		if ($user_list->num_rows()>0){
			foreach ($user_list->result() as $user_details){
				$own_count = 0;
				$own_products = array_filter(explode(',', $user_details->own_products));
				if (count($own_products)>0){
					$id_str = '';
					foreach ($own_products as $id_row){
						$id_str .= $id_row.',';
					}
					$id_str = substr($id_str, 0,-1);
					$Query = "select `id` from ".PRODUCT." where `seller_product_id` in ('".$id_str."')";
					$products = $this->product_model->ExecuteQuery($Query);
					$own_count += $products->num_rows();
					$Query = "select `id` from ".USER_PRODUCTS." where `seller_product_id` in ('".$id_str."')";
					$products = $this->product_model->ExecuteQuery($Query);
					$own_count += $products->num_rows();
				}
				$this->product_model->update_details(USERS,array('own_count'=>$own_count),array('id'=>$user_details->id));
				echo $user_details->id.'-*--'.$user_details->user_name.'--*-'.$own_count.'<br/>';
			}
		}
		echo 'Complete.!';
	}

	public function qq(){
		$productDetails = $this->product_model->get_all_details(PRODUCT,array());
		foreach ($productDetails->result() as $row){
			$pid = $this->get_rand_str('6');
			$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$pid));
			while ($checkId->num_rows()>0){
				$pid = $this->get_rand_str('6');
				$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$pid));
			}
			$url = base_url().'things/'.$row->id.'/'.url_title($row->product_name,'-');
			$this->product_model->simple_insert(SHORTURL,array('short_url'=>$pid,'long_url'=>$url));
			$urlid = $this->product_model->get_last_insert_id();
			$this->product_model->update_details(PRODUCT,array('short_url_id'=>$urlid),array('seller_product_id'=>$row->seller_product_id));
		}
		echo 'Short urls for selling products added<br/>';
		$productDetails = $this->product_model->view_notsell_product_details('');
		foreach ($productDetails->result() as $row){
			$pid = $this->get_rand_str('6');
			$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$pid));
			while ($checkId->num_rows()>0){
				$pid = $this->get_rand_str('6');
				$checkId = $this->product_model->get_all_details(SHORTURL,array('short_url'=>$pid));
			}
			$url = base_url().'user/'.$row->user_name.'/things/'.$row->seller_product_id.'/'.url_title($row->product_name,'-');
			$this->product_model->simple_insert(SHORTURL,array('short_url'=>$pid,'long_url'=>$url));
			$urlid = $this->product_model->get_last_insert_id();
			$this->product_model->update_details(USER_PRODUCTS,array('short_url_id'=>$urlid),array('seller_product_id'=>$row->seller_product_id));
		}
		echo 'Short urls for affiliate products added';
			
	}

	public function qq_update_counts(){
		$qryCount = 0;
		$user_list = $this->product_model->get_all_details(USERS,array());
		$qryCount++;
		if ($user_list->num_rows()>0) {
			foreach ($user_list->result() as $user_list_row){
				$sell_products = $this->product_model->get_all_details(PRODUCT,array('user_id'=>$user_list_row->id));
				$qryCount++;
				$affil_products = $this->product_model->get_all_details(USER_PRODUCTS,array('user_id'=>$user_list_row->id));
				$qryCount++;
				$total_products = $sell_products->num_rows()+$affil_products->num_rows();
				if ($total_products != $user_list_row->products){
					$this->product_model->update_details(USERS,array('products'=>$total_products),array('id'=>$user_list_row->id));
					$qryCount++;
				}
			}
		}
		echo $qryCount++.' queries executed.';
	}

	public function check_upload(){
		$url = 'http://hugoboss.scene7.com/is/image/hugoboss/20_hbeu50264459_001_10?$re_productSliderCategory$';
//		$img_data = file_get_contents($image_url);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //Set curl to return the data instead of printing it to the browser.
		$img_data = curl_exec($ch);
		curl_close($ch);
		echo $url.'<br/>';
echo $img_data;die;
		$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
		$img_name_arr = explode('.', $img_full_name);
		$img_name = $img_name_arr[0];
		$ext = $img_name_arr[1];
		if ($ext == ''){
			$ext = 'jpg';
		}
		$new_name = str_replace(array(',','&','<','>','$','(',')'), '', $img_name.mktime().'.'.$ext);
		$new_img = 'images/product/'.$new_name;

		file_put_contents($new_img, $img_data);
	}

}
/*End of file product.php */
/* Location: ./application/controllers/site/product.php */