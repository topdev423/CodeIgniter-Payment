<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * Notifications related functions
 * @author Teamtweaks
 *
 */
class Notify extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('cookie', 'date', 'email'));
        $this->load->model('notify_model');

        if ($_SESSION['sMainCategories'] == '') {
            $sortArr1 = array('field' => 'cat_position', 'type' => 'asc');
            $sortArr = array($sortArr1);
            $_SESSION['sMainCategories'] = $this->notify_model->get_all_details(CATEGORY, array('rootID' => '0', 'status' => 'Active'), $sortArr);
        }
        $this->data['mainCategories'] = $_SESSION['sMainCategories'];

        if ($_SESSION['sColorLists'] == '') {
            $_SESSION['sColorLists'] = $this->notify_model->get_all_details(LIST_VALUES, array('list_id' => '1'));
        }
        $this->data['mainColorLists'] = $_SESSION['sColorLists'];

        $this->data['loginCheck'] = $this->checkLogin('U');
        $this->data['likedProducts'] = array();
        if ($this->data['loginCheck'] != '') {
            //$this->data['likedProducts'] = $this->notify_model->get_all_details(PRODUCT_LIKES, array('user_id' => $this->checkLogin('U')));
            
            $ratedProducts = $this->product_model->get_user_product_ratings($this->checkLogin('U'));
            $this->data['likedProducts'] = $ratedProducts;
        }
    }

    public function get_notifycount() {
        //Language Start
        // exit();

        if ($this->lang->line('login_required') != '')
            $login_required = stripslashes($this->lang->line('login_required'));
        else
            $login_required = "Login required";

        if ($this->lang->line('follows_you') != '')
            $follows_you = stripslashes($this->lang->line('follows_you'));
        else
            $follows_you = "follows you";

        if ($this->lang->line('featured') != '')
            $featured = stripslashes($this->lang->line('featured'));
        else
            $featured = "featured";


        if ($this->lang->line('commented_on') != '')
            $commented_on = stripslashes($this->lang->line('commented_on'));
        else
            $commented_on = "commented on";


        if ($this->lang->line('no_notifications') != '')
            $no_notifications = stripslashes($this->lang->line('no_notifications'));
        else
            $no_notifications = "No Notifications";

        if ($this->lang->line('no_notifications_available') != '')
            $no_notifications_available = stripslashes($this->lang->line('no_notifications_available'));
        else
            $no_notifications_available = "No notifications available";

        if ($this->lang->line('ago') != '')
            $ago = stripslashes($this->lang->line('ago'));
        else
            $ago = "ago";


        //Language End

        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U') == '') {
            $returnStr['message'] = $login_required;
        } else {
            $notifications = array_filter(explode(',', $this->data['userDetails']->row()->notifications));
            $searchArr = array();
            if (count($notifications) > 0) {
                if (in_array('wmn-follow', $notifications)) {
                    array_push($searchArr, 'follow');
                }
                if (in_array('wmn-comments_on_fancyd', $notifications)) {
                    array_push($searchArr, 'comment');
                }
                if (in_array('wmn-fancyd', $notifications)) {
                    array_push($searchArr, 'like');
                }
                if (in_array('wmn-featured', $notifications)) {
                    array_push($searchArr, 'featured');
                }
                if (in_array('wmn-comments', $notifications)) {
                    array_push($searchArr, 'own-product-comment');
                }
                $likedProductsIdArr = array();
                if (count($this->data['likedProducts']) > 0) {
                    foreach ($this->data['likedProducts'] as $likeProdRow) {
                        array_push($likedProductsIdArr, $likeProdRow['product_id']);
                    }
                    array_filter($likedProductsIdArr);
                }
//		 		$fieldsArr = array('product_name');
//   	 			$likedProductsDetails = $this->notify_model->get_fields_from_many(PRODUCT,$fieldsArr,'seller_product_id',$likedProductsIdArr);
                if (count($likedProductsIdArr) > 0) {
                    $fields = " p.product_name,p.id,p.seller_product_id,p.image,u.full_name,u.user_name,u.thumbnail,u.feature_product ";
                    $condition = ' where p.status="Publish" and u.status="Active" and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ')
			 						or p.status="Publish" and p.user_id=0 and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ') ';
                    $likedProductsDetails = $this->notify_model->get_active_sell_products($condition, $fields);
                } else {
                    $likedProductsDetails = '';
                }
                $addedSellProducts = $this->notify_model->get_all_details(PRODUCT, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedUserProducts = $this->notify_model->get_all_details(USER_PRODUCTS, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedSellProductsArr = array();
                $addedUserProductsArr = array();
                $addedProductsArr = array();
                if ($addedSellProducts->num_rows() > 0) {
                    foreach ($addedSellProducts->result() as $addedSellProductsRow) {
                        array_push($addedSellProductsArr, $addedSellProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedSellProductsRow->seller_product_id);
                    }
                }
                if ($addedUserProducts->num_rows() > 0) {
                    foreach ($addedUserProducts->result() as $addedUserProductsRow) {
                        array_push($addedUserProductsArr, $addedUserProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedUserProductsRow->seller_product_id);
                    }
                }
                $activityArr = array_merge($likedProductsIdArr, $addedProductsArr);
                array_push($activityArr, $this->checkLogin('U'));
                $allNoty = $this->notify_model->get_new_notifications($searchArr, $activityArr, $this->checkLogin('U'));
//                                $n_count=$allNoty->num_rows();
//                                echo $n_count;
//                                exit($n_count);
//                                die(json_encode($n_count));

                if ($allNoty->num_rows() > 0) {
                    
                    $notyCount = 0;
                    $notyFinal = array();
                    foreach ($allNoty->result() as $allRow) {
                        //		if ($notyCount>4)break;
                        if ($allRow->activity == 'like') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'like', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'featured') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'featured', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'follow') {
                            if ($this->checkLogin('U') == $allRow->activity_id) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'follow', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'comment') {
                            if (in_array($allRow->activity_id, $likedProductsIdArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'comment', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'own-product-comment') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'own-product-comment', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        }
                    }
                    echo $notyCount;
                    
                }
            }
        }
    }

    public function getlatest() {

        //Language Start
        if ($this->lang->line('login_required') != '')
            $login_required = stripslashes($this->lang->line('login_required'));
        else
            $login_required = "Login required";

        if ($this->lang->line('follows_you') != '')
            $follows_you = stripslashes($this->lang->line('follows_you'));
        else
            $follows_you = "follows you";

        if ($this->lang->line('featured') != '')
            $featured = stripslashes($this->lang->line('featured'));
        else
            $featured = "featured";


        if ($this->lang->line('commented_on') != '')
            $commented_on = stripslashes($this->lang->line('commented_on'));
        else
            $commented_on = "commented on";


        if ($this->lang->line('no_notifications') != '')
            $no_notifications = stripslashes($this->lang->line('no_notifications'));
        else
            $no_notifications = "No Notifications";

        if ($this->lang->line('no_notifications_available') != '')
            $no_notifications_available = stripslashes($this->lang->line('no_notifications_available'));
        else
            $no_notifications_available = "No notifications available";

        if ($this->lang->line('ago') != '')
            $ago = stripslashes($this->lang->line('ago'));
        else
            $ago = "ago";


        //Language End

        $returnStr['status_code'] = 0;
        if ($this->checkLogin('U') == '') {
            $returnStr['message'] = $login_required;
        } else {
            $notifications = array_filter(explode(',', $this->data['userDetails']->row()->notifications));
            $searchArr = array();
            if (count($notifications) > 0) {
                if (in_array('wmn-follow', $notifications)) {
                    array_push($searchArr, 'follow');
                }
                if (in_array('wmn-comments_on_fancyd', $notifications)) {
                    array_push($searchArr, 'comment');
                }
                if (in_array('wmn-fancyd', $notifications)) {
                    array_push($searchArr, 'like');
                }
                if (in_array('wmn-featured', $notifications)) {
                    array_push($searchArr, 'featured');
                }
                if (in_array('wmn-comments', $notifications)) {
                    array_push($searchArr, 'own-product-comment');
                }
                $likedProductsIdArr = array();
                if (count($this->data['likedProducts']) > 0) {
                    foreach ($this->data['likedProducts'] as $likeProdRow) {
                        array_push($likedProductsIdArr, $likeProdRow['product_id']);
                    }
                    array_filter($likedProductsIdArr);
                }
//		 		$fieldsArr = array('product_name');
//   	 			$likedProductsDetails = $this->notify_model->get_fields_from_many(PRODUCT,$fieldsArr,'seller_product_id',$likedProductsIdArr);
                if (count($likedProductsIdArr) > 0) {
                    $fields = " p.product_name,p.id,p.seller_product_id,p.image,u.full_name,u.user_name,u.thumbnail,u.feature_product ";
                    $condition = ' where p.status="Publish" and u.status="Active" and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ')
			 						or p.status="Publish" and p.user_id=0 and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ') ';
                    $likedProductsDetails = $this->notify_model->get_active_sell_products($condition, $fields);
                } else {
                    $likedProductsDetails = '';
                }
                $addedSellProducts = $this->notify_model->get_all_details(PRODUCT, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedUserProducts = $this->notify_model->get_all_details(USER_PRODUCTS, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedSellProductsArr = array();
                $addedUserProductsArr = array();
                $addedProductsArr = array();
                if ($addedSellProducts->num_rows() > 0) {
                    foreach ($addedSellProducts->result() as $addedSellProductsRow) {
                        array_push($addedSellProductsArr, $addedSellProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedSellProductsRow->seller_product_id);
                    }
                }
                if ($addedUserProducts->num_rows() > 0) {
                    foreach ($addedUserProducts->result() as $addedUserProductsRow) {
                        array_push($addedUserProductsArr, $addedUserProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedUserProductsRow->seller_product_id);
                    }
                }
                $activityArr = array_merge($likedProductsIdArr, $addedProductsArr);
                array_push($activityArr, $this->checkLogin('U'));
                $allNoty = $this->notify_model->get_latest_notifications($searchArr, $activityArr, $this->checkLogin('U'));
                if ($allNoty->num_rows() > 0) {
                    $notyCount = 0;
                    $notyFinal = array();
                    foreach ($allNoty->result() as $allRow) {
                        //		if ($notyCount>4)break;
                        if ($allRow->activity == 'like') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'like', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'featured') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'featured', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'follow') {
                            if ($this->checkLogin('U') == $allRow->activity_id) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'follow', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'comment') {
                            if (in_array($allRow->activity_id, $likedProductsIdArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'comment', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'own-product-comment') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'own-product-comment', 'activity_id' => $allRow->activity_id));
                                $notyCount++;
                            }
                        }
                    }
                    if ($notyCount > 0) {
                        $returnStr['content'] = '<ul>';
                        $total_count = 0;
                        foreach ($notyFinal as $notyFinalRow) {
                            if ($total_count > 4)
                                break;
                            $activityUserDetails = $this->notify_model->get_all_details(USERS, array('id' => $notyFinalRow['user_id']));
                            if ($activityUserDetails->num_rows() > 0) {
                                $userImg = 'user-thumb1.png';
                                if ($activityUserDetails->row()->thumbnail != '') {
                                    if (file_exists('images/users/' . $activityUserDetails->row()->thumbnail)) {
                                        $userImg = $activityUserDetails->row()->thumbnail;
                                    }
                                }
                                $activityUserLink = '<a style="padding-left:0px !important;" class="photo"  href="user/' . $activityUserDetails->row()->user_name . '">
			   	 					<img src="images/users/' . $userImg . '" class="photo" style="left:0px;" />
									</a>';
                                if ($notyFinalRow['activity'] != 'follow') {
                                    if (in_array($notyFinalRow['activity_id'], $addedSellProductsArr)) {
                                        $prodTbl = PRODUCT;
                                    } else if (in_array($notyFinalRow['activity_id'], $addedUserProductsArr)) {
                                        $prodTbl = USER_PRODUCTS;
                                    } else {
                                        $prodTbl = '';
                                    }
                                    if ($notyFinalRow['activity'] == 'comment') {
                                        $prodTbl = 'comment';
                                    }
                                    if ($prodTbl == PRODUCT) {
                                        foreach ($addedSellProducts->result() as $addedSellProductsRow) {
                                            if ($addedSellProductsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                $imgArr = array_filter(explode(',', $addedSellProductsRow->image));
                                                if (count($imgArr) > 0) {
                                                    if (file_exists('images/product/' . $imgArr[0])) {
                                                        $prodImg = $imgArr[0];
                                                    }
                                                } else {
                                                    $prodImg = 'dummyProductImage.jpg';
                                                }
                                                $activityProdName = $addedSellProductsRow->product_name;
                                                $activityProdLink = '<a style="padding-left:0px !important;margin-left:0px !important;" class="thing" href="things/' . $addedSellProductsRow->id . '/' . url_title($addedSellProductsRow->product_name, '-') . '">
													<img src="images/product/' . $prodImg . '" class="thing" />
													</a>';
                                                break;
                                            }
                                        }
                                    } else if ($prodTbl == USER_PRODUCTS) {
                                        foreach ($addedUserProducts->result() as $addedUserProductsRow) {
                                            if ($addedUserProductsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                $imgArr = array_filter(explode(',', $addedUserProductsRow->image));
                                                if (count($imgArr) > 0) {
                                                    if (file_exists('images/product/' . $imgArr[0])) {
                                                        $prodImg = $imgArr[0];
                                                    }
                                                } else {
                                                    $prodImg = 'dummyProductImage.jpg';
                                                }
                                                $activityProdName = $addedUserProductsRow->product_name;
                                                $activityProdLink = '<a style="padding-left:0px !important;margin-left:0px !important;" class="thing" href="user/' . $this->data['userDetails']->row()->user_name . '/things/' . $addedUserProductsRow->seller_product_id . '/' . url_title($addedUserProductsRow->product_name, '-') . '">
													<img src="images/product/' . $prodImg . '" class="thing"  />
													</a>';
                                                break;
                                            }
                                        }
                                    } else if ($prodTbl == 'comment') {
                                        if ($likedProductsDetails != '' && $likedProductsDetails->num_rows() > 0) {
                                            foreach ($likedProductsDetails->result() as $likedProductsDetailsRow) {
                                                if ($likedProductsDetailsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                    $imgArr = array_filter(explode(',', $likedProductsDetailsRow->image));
                                                    if (count($imgArr) > 0) {
                                                        if (file_exists('images/product/' . $imgArr[0])) {
                                                            $prodImg = $imgArr[0];
                                                        }
                                                    } else {
                                                        $prodImg = 'dummyProductImage.jpg';
                                                    }
                                                    $activityProdName = $likedProductsDetailsRow->product_name;
                                                    $activityProdLink = '<a  style="padding-left:0px !important;margin-left:0px !important;"class="thing"  href="things/' . $likedProductsDetailsRow->id . '/' . url_title($likedProductsDetailsRow->product_name, '-') . '">
														<img src="images/product/' . $prodImg . '"  class="thing"  />
														</a>';
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        $activityProdName = '';
                                        $activityProdLink = '';
                                    }
                                }
                                $li_count = 0;
                                if ($notyFinalRow['activity'] == 'follow') {
                                    if ($activityUserLink != '') {
                                        $userImg = 'user-thumb1.png';
                                        if ($activityUserDetails->row()->thumbnail != '') {
                                            if (file_exists('images/users/' . $activityUserDetails->row()->thumbnail)) {
                                                $userImg = $activityUserDetails->row()->thumbnail;
                                            }
                                        }
                                        $returnStr['content'] .= '<li >' . $activityUserLink . $activityUserDetails->row()->full_name . ' ' . $follows_you . '
				   	 					</li>';
                                        $li_count++;
                                        $total_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'like') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li >' . $activityUserLink . $activityProdLink . $activityUserDetails->row()->full_name . ' ' . LIKED_BUTTON . ' ' . $activityProdName . '</li>';
                                        $li_count++;
                                        $total_count++;
                                        $total_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'featured') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li >' . $activityUserLink . $activityProdLink . $activityUserDetails->row()->full_name . ' ' . $featured . ' ' . $activityProdName . '</li>';
                                        $li_count++;
                                        $total_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'comment') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li >' . $activityUserLink . $activityProdLink . $activityUserDetails->row()->full_name . ' ' . $commented_on . ' ' . $activityProdName . '</li>';
                                        $li_count++;
                                        $total_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'own-product-comment') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li >' . $activityUserLink . $activityProdLink . $activityUserDetails->row()->full_name . ' ' . $commented_on . ' ' . $activityProdName . '</li>';
                                        $li_count++;
                                        $total_count++;
                                    }
                                }
                            }
                        }
                        if ($li_count == 0) {
                            $returnStr['status_code'] = 2;
                            $returnStr['content'] .= '<li style="padding-right:0px;padding-left:100px;width:150px;">' . $no_notifications . '</li>';
                        } else {
                            $returnStr['status_code'] = 1;
                        }
                        $returnStr['content'] .= '<div style="clear:both !important;"></div></ul>';
                    } else {
                        $returnStr['status_code'] = 2;
                        $returnStr['content'] = '<ul><li style="padding-right:0px;padding-left:100px;width:150px;">' . $no_notifications . '</li></ul>';
                    }
                } else {
                    $returnStr['status_code'] = 2;
                    $returnStr['content'] = '<ul><li style="padding-right:0px;padding-left:100px;width:150px;">' . $no_notifications . '</li></ul>';
                }
            } else {
                $returnStr['status_code'] = 2;
                $returnStr['content'] = '<ul><li style="padding-right:0px;padding-left:100px;width:150px;">' . $no_notifications . '</li></ul>';
            }
        }
        echo json_encode($returnStr);
    }

    public function display_notifications() {


        //Language Start
        if ($this->lang->line('login_required') != '')
            $login_required = stripslashes($this->lang->line('login_required'));
        else
            $login_required = "Login required";

        if ($this->lang->line('follows_you') != '')
            $follows_you = stripslashes($this->lang->line('follows_you'));
        else
            $follows_you = "follows you";

        if ($this->lang->line('featured') != '')
            $featured = stripslashes($this->lang->line('featured'));
        else
            $featured = "featured";


        if ($this->lang->line('commented_on') != '')
            $commented_on = stripslashes($this->lang->line('commented_on'));
        else
            $commented_on = "commented on";


        if ($this->lang->line('no_notifications') != '')
            $no_notifications = stripslashes($this->lang->line('no_notifications'));
        else
            $no_notifications = "No Notifications";

        if ($this->lang->line('no_notifications_available') != '')
            $no_notifications_available = stripslashes($this->lang->line('no_notifications_available'));
        else
            $no_notifications_available = "No notifications available";

        if ($this->lang->line('ago') != '')
            $ago = stripslashes($this->lang->line('ago'));
        else
            $ago = "ago";


        //Language End

        if ($this->checkLogin('U') == '') {
            show_404();
        } else {

            $notifications = array_filter(explode(',', $this->data['userDetails']->row()->notifications));
            $searchArr = array();
            if (count($notifications) > 0) {
                if (in_array('wmn-follow', $notifications)) {
                    array_push($searchArr, 'follow');
                }
                if (in_array('wmn-comments_on_fancyd', $notifications)) {
                    array_push($searchArr, 'comment');
                }
                if (in_array('wmn-fancyd', $notifications)) {
                    array_push($searchArr, 'like');
                }
                if (in_array('wmn-featured', $notifications)) {
                    array_push($searchArr, 'featured');
                }
                if (in_array('wmn-comments', $notifications)) {
                    array_push($searchArr, 'own-product-comment');
                }
                $likedProductsIdArr = array();
                if (count($this->data['likedProducts']) > 0) {
                    foreach ($this->data['likedProducts'] as $likeProdRow) {
                        array_push($likedProductsIdArr, $likeProdRow['product_id']);
                    }
                    array_filter($likedProductsIdArr);
                }
//		 		$fieldsArr = array('product_name','id','seller_product_id','image');
//   	 			$likedProductsDetails = $this->notify_model->get_fields_from_many(PRODUCT,$fieldsArr,'seller_product_id',$likedProductsIdArr);
                if (count($likedProductsIdArr) > 0) {
                    $fields = " p.product_name,p.id,p.seller_product_id,p.image,u.full_name,u.user_name,u.thumbnail,u.feature_product ";
                    $condition = ' where p.status="Publish" and u.status="Active" and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ')
			 						or p.status="Publish" and p.user_id=0 and p.seller_product_id in (' . implode(',', $likedProductsIdArr) . ') ';
                    $likedProductsDetails = $this->notify_model->get_active_sell_products($condition, $fields);
                } else {
                    $likedProductsDetails = '';
                }
                $addedSellProducts = $this->notify_model->get_all_details(PRODUCT, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedUserProducts = $this->notify_model->get_all_details(USER_PRODUCTS, array('user_id' => $this->checkLogin('U'), 'status' => 'Publish'));
                $addedSellProductsArr = array();
                $addedUserProductsArr = array();
                $addedProductsArr = array();
                if ($addedSellProducts->num_rows() > 0) {
                    foreach ($addedSellProducts->result() as $addedSellProductsRow) {
                        array_push($addedSellProductsArr, $addedSellProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedSellProductsRow->seller_product_id);
                    }
                }
                if ($addedUserProducts->num_rows() > 0) {
                    foreach ($addedUserProducts->result() as $addedUserProductsRow) {
                        array_push($addedUserProductsArr, $addedUserProductsRow->seller_product_id);
                        array_push($addedProductsArr, $addedUserProductsRow->seller_product_id);
                    }
                }
                $activityArr = array_merge($likedProductsIdArr, $addedProductsArr);
                array_push($activityArr, $this->checkLogin('U'));
                $allNoty = $this->notify_model->get_latest_notifications($searchArr, $activityArr, $this->checkLogin('U'));
                $this->notify_model->update_noti($this->checkLogin('U'));
                if ($allNoty->num_rows() > 0) {
                    $notyCount = 0;
                    $notyFinal = array();
                    foreach ($allNoty->result() as $allRow) {
                        if ($allRow->activity == 'like') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'like', 'activity_id' => $allRow->activity_id, 'created' => $allRow->created));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'featured') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'featured', 'activity_id' => $allRow->activity_id, 'created' => $allRow->created));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'follow') {
                            if ($this->checkLogin('U') == $allRow->activity_id) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'follow', 'activity_id' => $allRow->activity_id, 'created' => $allRow->created));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'comment') {
                            if (in_array($allRow->activity_id, $likedProductsIdArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'comment', 'activity_id' => $allRow->activity_id, 'created' => $allRow->created, 'comment_id' => $allRow->comment_id));
                                $notyCount++;
                            }
                        } else if ($allRow->activity == 'own-product-comment') {
                            if (in_array($allRow->activity_id, $addedProductsArr)) {
                                array_push($notyFinal, array('user_id' => $allRow->user_id, 'activity' => 'own-product-comment', 'activity_id' => $allRow->activity_id, 'created' => $allRow->created, 'comment_id' => $allRow->comment_id));
                                $notyCount++;
                            }
                        }
                    }
                    if ($notyCount > 0) {
                        $returnStr['content'] = '<ul class="notify-list">';
                        foreach ($notyFinal as $notyFinalRow) {
                            $activityUserDetails = $this->notify_model->get_all_details(USERS, array('id' => $notyFinalRow['user_id']));
                            if ($activityUserDetails->num_rows() > 0) {
                                $userImg = 'user-thumb1.png';
                                if ($activityUserDetails->row()->thumbnail != '') {
                                    if (file_exists('images/users/' . $activityUserDetails->row()->thumbnail)) {
                                        $userImg = $activityUserDetails->row()->thumbnail;
                                    }
                                }
                                $activityUserLink = '<a href="user/' . $activityUserDetails->row()->user_name . '">
			   	 					<img src="images/users/' . $userImg . '" class="avartar" style="float:left;position:static;"/>
									</a>';
                                $activityUserNameLink = '<a href="user/' . $activityUserDetails->row()->user_name . '" class="user">' . $activityUserDetails->row()->full_name . '</a>';
                                $activityTime = strtotime($notyFinalRow['created']);
                                $actTime = timespan($activityTime) . ' ' . $ago . '';
                                if ($notyFinalRow['activity'] != 'follow') {
                                    if (in_array($notyFinalRow['activity_id'], $addedSellProductsArr)) {
                                        $prodTbl = PRODUCT;
                                    } else if (in_array($notyFinalRow['activity_id'], $addedUserProductsArr)) {
                                        $prodTbl = USER_PRODUCTS;
                                    } else {
                                        $prodTbl = '';
                                    }
                                    if ($notyFinalRow['activity'] == 'comment') {
                                        $prodTbl = 'comment';
                                    }
                                    if ($prodTbl == PRODUCT) {
                                        foreach ($addedSellProducts->result() as $addedSellProductsRow) {
                                            if ($addedSellProductsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                $imgArr = array_filter(explode(',', $addedSellProductsRow->image));
                                                if (count($imgArr) > 0) {
                                                    if (file_exists('images/product/' . $imgArr[0])) {
                                                        $prodImg = $imgArr[0];
                                                    }
                                                } else {
                                                    $prodImg = 'dummyProductImage.jpg';
                                                }
                                                $activityProdName = $addedSellProductsRow->product_name;
                                                $activityProdLink = '<a href="things/' . $addedSellProductsRow->id . '/' . url_title($addedSellProductsRow->product_name, '-') . '">
													<img src="images/site/blank.gif" style="background-image:url(\'images/product/' . $prodImg . '\');float: right;background-position: 50% 50%;  background-size: cover;" class="u"/>
													</a>';
                                                $activityProdNameLink = '<a href="things/' . $addedSellProductsRow->id . '/' . url_title($addedSellProductsRow->product_name, '-') . '">' . $activityProdName . '</a>.';
                                                break;
                                            }
                                        }
                                    } else if ($prodTbl == USER_PRODUCTS) {
                                        foreach ($addedUserProducts->result() as $addedUserProductsRow) {
                                            if ($addedUserProductsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                $imgArr = array_filter(explode(',', $addedUserProductsRow->image));
                                                if (count($imgArr) > 0) {
                                                    if (file_exists('images/product/' . $imgArr[0])) {
                                                        $prodImg = $imgArr[0];
                                                    }
                                                } else {
                                                    $prodImg = 'dummyProductImage.jpg';
                                                }
                                                $activityProdName = $addedUserProductsRow->product_name;
                                                $activityProdLink = '<a href="user/' . $this->data['userDetails']->row()->user_name . '/things/' . $addedUserProductsRow->seller_product_id . '/' . url_title($addedUserProductsRow->product_name, '-') . '">
													<img src="images/site/blank.gif" style="background-image:url(\'images/product/' . $prodImg . '\');float: right;background-position: 50% 50%;  background-size: cover;" class="u"/>
													</a>';
                                                $activityProdNameLink = '<a href="user/' . $this->data['userDetails']->row()->user_name . '/things/' . $addedUserProductsRow->seller_product_id . '/' . url_title($addedUserProductsRow->product_name, '-') . '">' . $activityProdName . '</a>.';
                                                break;
                                            }
                                        }
                                    } else if ($prodTbl == 'comment') {
                                        if ($likedProductsDetails != '' && $likedProductsDetails->num_rows() > 0) {
                                            foreach ($likedProductsDetails->result() as $likedProductsDetailsRow) {
                                                if ($likedProductsDetailsRow->seller_product_id == $notyFinalRow['activity_id']) {
                                                    $imgArr = array_filter(explode(',', $likedProductsDetailsRow->image));
                                                    if (count($imgArr) > 0) {
                                                        if (file_exists('images/product/' . $imgArr[0])) {
                                                            $prodImg = $imgArr[0];
                                                        }
                                                    } else {
                                                        $prodImg = 'dummyProductImage.jpg';
                                                    }
                                                    $activityProdName = $likedProductsDetailsRow->product_name;
                                                    $activityProdLink = '<a href="things/' . $likedProductsDetailsRow->id . '/' . url_title($likedProductsDetailsRow->product_name, '-') . '">
														<img src="images/site/blank.gif" style="background-image:url(\'images/product/' . $prodImg . '\');float: right;background-position: 50% 50%;  background-size: cover;" class="u"/>
														</a>';
                                                    $activityProdNameLink = '<a href="things/' . $likedProductsDetailsRow->id . '/' . url_title($likedProductsDetailsRow->product_name, '-') . '">' . $activityProdName . '</a>.';
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        $activityProdName = '';
                                        $activityProdLink = '';
                                    }
                                }
                                if ($notyFinalRow['comment_id'] != '0') {
                                    $cmtDetails = $this->notify_model->get_all_details(PRODUCT_COMMENTS, array('id' => $notyFinalRow['comment_id']));
                                    $comment = '';
                                    if ($cmtDetails->num_rows() > 0) {
                                        $comment = $cmtDetails->row()->comments;
                                        $activityTime = strtotime($cmtDetails->row()->dateAdded);
                                        $actTime = timespan($activityTime) . ' ' . $ago . '';
                                    }
                                }
                                $li_count = 0;
                                if ($notyFinalRow['activity'] == 'follow') {
                                    if ($activityUserLink != '') {
                                        $userImg = 'user-thumb1.png';
                                        if ($activityUserDetails->row()->thumbnail != '') {
                                            if (file_exists('images/users/' . $activityUserDetails->row()->thumbnail)) {
                                                $userImg = $activityUserDetails->row()->thumbnail;
                                            }
                                        }
                                        $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $activityUserLink . '
			   	 						<p class="right" style="width:790px;"><span class="title"> ' . $activityUserNameLink . ' ' . $follows_you . '</span>
			   	 						<span class="activity-reply">' . $actTime . '</span></p>
			   	 						</li>';
                                        $li_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'like') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $activityProdLink . $activityUserLink . '
			   	 						<p class="right" style="width:720px;"><span class="title"> ' . $activityUserNameLink . ' ' . LIKED_BUTTON . ' ' . $activityProdNameLink . '</span>
			   	 						<span class="activity-reply">' . $actTime . '</span></p>
			   	 						</li>';
                                        $li_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'featured') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $activityProdLink . $activityUserLink . '
			   	 						<p class="right" style="width:720px;"><span class="title"> ' . $activityUserNameLink . ' ' . $featured . ' ' . $activityProdNameLink . '</span>
			   	 						<span class="activity-reply">' . $actTime . '</span></p>
			   	 						</li>';
                                        $li_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'comment') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $activityProdLink . $activityUserLink . ' 
			   	 						<p class="right" style="width:720px;"><span class="title"> ' . $activityUserNameLink . ' ' . $commented_on . ' ' . $activityProdNameLink . '</span>
			   	 						<span class="cmt">' . $comment . '</span>
			   	 						<span class="activity-reply">' . $actTime . '</span></p>
			   	 						</li>';
                                        $li_count++;
                                    }
                                } else if ($notyFinalRow['activity'] == 'own-product-comment') {
                                    if ($activityUserLink != '' && $activityProdLink != '') {
                                        $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $activityProdLink . $activityUserLink . ' 
			   	 						<p class="right" style="width:720px;"><span class="title"> ' . $activityUserNameLink . ' ' . $commented_on . ' ' . $activityProdNameLink . '</span>
			   	 						<span class="cmt">' . $comment . '</span>
			   	 						<span class="activity-reply">' . $actTime . '</span></p>
			   	 						</li>';
                                        $li_count++;
                                    }
                                }
                            }
                        }
                        if ($li_count == 0) {
                            $returnStr['content'] .= '<li class="notification-item" style="width:850px;">' . $no_notifications_available . '</li>';
                            $returnStr['status_code'] = 2;
                        } else {
                            $returnStr['status_code'] = 1;
                        }
                        $returnStr['content'] .= '</ul>';
                    } else {
                        $returnStr['status_code'] = 2;
                        $returnStr['content'] = '<ul class="notify-list"><li class="notification-item" style="width:850px;">' . $no_notifications_available . '</li></ul>';
                    }
                } else {
                    $returnStr['status_code'] = 2;
                    $returnStr['content'] = '<ul class="notify-list"><li class="notification-item" style="width:850px;">' . $no_notifications_available . '</li></ul>';
                }
            } else {
                $returnStr['status_code'] = 2;
                $returnStr['content'] = '<ul class="notify-list"><li class="notification-item" style="width:850px;">' . $no_notifications_available . '</li></ul>';
            }
        }
        $this->data['notyList'] = $returnStr['content'];
        $this->data['heading'] = 'Notifications';
        $this->load->view('site/notification/display_notification', $this->data);
    }

}

/*End of file notify.php */
/* Location: ./application/controllers/site/notify.php */