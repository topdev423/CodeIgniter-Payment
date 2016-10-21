<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Product_model extends My_Model
{

	public function add_product($dataArr=''){
		$this->db->insert(PRODUCT, $dataArr);
	}

	public function add_subproduct_insert($dataArr=''){
		$this->db->insert(SUBPRODUCT,$dataArr);
	}

	public function edit_product($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(PRODUCT,$dataArr);
	}

	public function edit_subproduct_update($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(SUBPRODUCT,$dataArr);
	}

	public function view_product($condition=''){
		return $this->db->get_where(PRODUCT,$condition);
			
	}

	public function view_affliated($condition=''){
		return $this->db->get_where(USER_PRODUCTS,$condition);
			
	}


	public function view_product_details($condition = ''){

		$select_qry = "select p.*, p.seller_product_id, AVG(COALESCE(pr.rating, 0)) as avg_rating, u.full_name,u.user_name,sh.short_url,u.email as selleremail,u.id as sellerid,u.thumbnail,u.feature_product from ".PRODUCT." p
		LEFT JOIN ".USERS." u on (u.id=p.user_id) 
        LEFT JOIN ".PRODUCT_RATING." pr on (p.seller_product_id = pr.product_id) 
		LEFT JOIN ".SHORTURL." sh on (sh.id=p.short_url_id)
		".$condition;

		$productList = $this->ExecuteQuery($select_qry);
        //echo $this->db->last_query();exit();
		return $productList;
			
	}

	public function view_follow_list($id=''){

		$getfollow = $this->db->query("SELECT ".LISTS_DETAILS.".*, ".USERS.".`user_name` as pname FROM ".LISTS_DETAILS." JOIN ".USERS." ON ".USERS.".`id` = ".LISTS_DETAILS.".`user_id` WHERE  FIND_IN_SET($id,".LISTS_DETAILS.".followers)");

		return $getfollow;
			
	}




	public function get_allcatProd_details($condition = ''){
		$select_qry = "select p.*,c.cat_name from ".PRODUCT." p
		LEFT JOIN ".CATEGORY." c on (c.id=p.category_id) where p.id=".$condition." and p.status='Active'";
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}

	public function product_feedback_view($seller_id){
		if ($seller_id == '')$seller_id=0;
		/*$select_qry = "select * from ".PRODUCT." where user_id='".$userid."'";
		 $attList = $this->ExecuteQuery($select_qry);
		 return  $attList->result_array();*/

		$this->db->select(array(PRODUCT_FEEDBACK.'.*',USERS.'.full_name',USERS.'.user_name',USERS.'.thumbnail',PRODUCT.'.product_name',PRODUCT.'.image'));
		$this->db->from(PRODUCT_FEEDBACK);
		$this->db->join(USERS, USERS.'.id = '.PRODUCT_FEEDBACK.'.voter_id');
		$this->db->join(PRODUCT, PRODUCT.'.id = '.PRODUCT_FEEDBACK.'.product_id');
		//$this->db->from(PRODUCT_FEEDBACK);
		$this->db->where(array(PRODUCT_FEEDBACK.'.seller_id'=>$seller_id,PRODUCT_FEEDBACK.'.status'=>'Active'));
		//$this->db->limit(7);
		$query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query(); die;
		return $result;

	}

	public function get_product_details()
	{
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT_FEEDBACK.'.*');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		return $feedback_query = $this->db->get();
	}

	public function get_productfeed_details($condition='')
	{

		$this->db->select('u.id as userId,u.user_name as userName,s.email as seller_email,p.id as productId,p.product_name,image as image,pf.*');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_FEEDBACK.' as pf','pf.product_id=p.id','inner');
		$this->db->join(USERS.' as u','u.id='.'pf.voter_id','inner');
		$this->db->join(USERS.' as s','s.id='.'pf.seller_id','inner');
		$this->db->order_by('pf.id','desc');
		$this->db->where('pf.id',$condition);
		return $feedback_query = $this->db->get();

	}


	public function get_featured_details($pid='0'){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
		$productList = $this->ExecuteQuery($Query);
		$productList->mode = 'sell_product';
		if ($productList->num_rows() != 1){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
			$productList = $this->ExecuteQuery($Query);
			$productList->mode = 'user_product';
		}
		return $productList;
	}

	public function get_banner_img($pid='0'){
		$Query = "select banner_image from fc_users where id=".$pid;
		$productList = $this->ExecuteQuery($Query);

		return $productList;
	}

	public function get_rating_val($pid='0'){
		$Query = "select p.rating from fc_prduct_rating p LEFT JOIN ".PRODUCT." u on u.seller_product_id=p.product_id where u.id=".$pid;
		$productList = $this->ExecuteQuery($Query);

		return $productList;
	}

	public function get_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			if (count($productIds)>0){
				$this->db->where_in('p.seller_product_id',$productIds);
				$this->db->where('p.status','Publish');
				$this->db->select('p.*, pr.rating, u.full_name, u.user_name, u.thumbnail, u.feature_product');
				$this->db->from(PRODUCT.' as p');
				$this->db->join(USERS.' as u','u.id=p.user_id');
				$this->db->join(PRODUCT_RATING.' as pr','p.seller_product_id=pr.product_id');
				$productList = $this->db->get();
			}
		}
		return $productList;
	}

	public function get_notsell_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			if (count($productIds)>0){
				/*$this->db->where_in('p.seller_product_id',$productIds);
				$this->db->where('p.status','Publish');
				$this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
				$this->db->from(USER_PRODUCTS.' as p');
				$this->db->join(USERS.' as u','u.id=p.user_id');
				$productList = $this->db->get();*/

				$this->db->where_in('p.seller_product_id',$productIds);
				$this->db->where('p.status','Publish');
				$this->db->select('p.*, pr.rating, u.full_name, u.user_name, u.thumbnail, u.feature_product');
				$this->db->from(USER_PRODUCTS.' as p');
				$this->db->join(USERS.' as u','u.id=p.user_id');
				$this->db->join(PRODUCT_RATING.' as pr','p.seller_product_id=pr.product_id');
				$productList = $this->db->get();
			}
		}
		return $productList;
	}

	public function view_notsell_product_details($condition = ''){
		/*$select_qry = "select p.*, p.seller_product_id, AVG(COALESCE(pr.rating, 0)) as avg_rating, sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
        LEFT JOIN ".PRODUCT_RATING." pr on (p.seller_product_id = pr.product_id)
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id
		".$condition;*/
		$select_qry = "select p.*, COALESCE(pr.rating, 0) as avg_rating, sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
        LEFT JOIN ".PRODUCT_RATING." pr on p.seller_product_id=pr.product_id 
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id
		".$condition;
		/*$select_qry = "select p.*, p.seller_product_id, sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id
		".$condition;*/
		//echo $select_qry;exit();
		$productList = $this->ExecuteQuery($select_qry);
		/*echo $select_qry;
		echo "/br";
		var_dump($productList->result());exit();*/
		return $productList;
			
	}

	public function view_notsell_product_details_add($condition = ''){

		$select_qry = "select p.*, COALESCE(pr.rating, 0) as avg_rating, sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
        LEFT JOIN ".PRODUCT_RATING." pr on p.seller_product_id=pr.product_id AND pr.user_id=".$condition." 
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id where p.user_id=
		".$condition." and p.status='Publish'";
		
		$productList = $this->ExecuteQuery($select_qry);
	
		return $productList;
			
	}

	public function view_notsell_product_details_own($condition = '', $id){

		$select_qry = "select p.*, COALESCE(pr.rating, 0) as avg_rating, sh.short_url,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p
		LEFT JOIN ".USERS." u on u.id=p.user_id 
        LEFT JOIN ".PRODUCT_RATING." pr on p.seller_product_id=pr.product_id AND pr.user_id=".$id." 
		LEFT JOIN ".SHORTURL." sh on sh.id=p.short_url_id where p.seller_product_id in (
		".$condition.") and p.status='Publish'";
		
		$productList = $this->ExecuteQuery($select_qry);
	
		return $productList;
			
	}

	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE;
		return $attList = $this->ExecuteQuery($select_qry);

	}
	public function view_subproduct_details($prdId=''){
		$select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_subproduct_details_join($prdId=''){
		$select_qry = "select a.*,b.attr_name as attr_type from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_id = b.id where a.product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_shopping_cart_subproduct_val($userid='',$prdId=''){
		$select_qry = "select quantity,attribute_values from ".SHOPPING_CART." where product_id = '".$prdId."' and user_id='".$userid."'";
		return $shopAttrList = $this->ExecuteQuery($select_qry);

	}
	public function view_product_atrribute_details(){
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);

	}

	public function view_category_details(){

		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){

			$catView .= $this->view_category_list($CatRow,'1');

			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";
			$SubList = $this->ExecuteQuery($sel_qry);

			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list($SubCatRow,'2');
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list($SubCatRow1,'3');

					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";
					$SubList2 = $this->ExecuteQuery($sel_qry2);

					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list($SubCatRow2,'4');

					}
				}
			}
		}
			
		return $catView;
	}

	public function view_category_list($CatRow,$val){
		$SubcatView ='';
		$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
		return $SubcatView;
	}

	public function get_category_details($catList=''){
		$catListArr = explode(',', $catList);
		$select_qry = "select * from ".CATEGORY." where rootID=0 and status='Active'";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){

			$catView .= $this->get_category_list($CatRow,'1',$catListArr);

			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."' and status='Active' ";
			$SubList = $this->ExecuteQuery($sel_qry);

			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->get_category_list($SubCatRow,'2',$catListArr);
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."' and status='Active' ";
				$SubList1 = $this->ExecuteQuery($sel_qry1);
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->get_category_list($SubCatRow1,'3',$catListArr);

					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."' and status='Active' ";
					$SubList2 = $this->ExecuteQuery($sel_qry2);

					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->get_category_list($SubCatRow2,'4',$catListArr);

					}
				}
			}
		}
		return $catView;
	}

	public function get_category_list($CatRow,$val,$catListArr=''){
		$SubcatView ='';
		if (in_array($CatRow->id, $catListArr)){
			$checkStr = 'checked="checked"';
		}else {
			$checkStr = '';
		}
		$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" '.$checkStr.' class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
		return $SubcatView;
	}

	public function get_cat_list($ids=''){
		$this->db->where_in('id',explode(',', $ids));
		return $this->db->get(CATEGORY);
	}

	public function get_top_users_in_category($cat=''){
		$productArr = array();
		$userArr = array();
		$userCountArr = array();
		$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
		$productDetails = $this->view_product_details($condition);
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
		arsort($userCountArr);
		return $userCountArr;
	}

	public function get_recent_like_users($pid='',$limit='10',$sort='desc'){
		$Query = 'select pl.*, p.product_name, count(pl.rating) as likes, u.full_name, u.user_name,u.thumbnail from '.PRODUCT_RATING.' pl
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" GROUP BY u.id order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}

	public function get_recent_user_likes($uid='',$pid='',$limit='3',$sort='desc'){
		$condition = '';
		if ($pid!=''){
			$condition = ' and pl.product_id != "'.$pid.'" ';
		}
		$Query = 'select pl.*,u.user_name,u.full_name,u.thumbnail,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_RATING.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' GROUP BY p.id order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}

	public function get_like_user_full_details($pid='0'){
		$Query = "select u.* from ".PRODUCT_RATING.' p
					JOIN '.USERS.' u on u.id=p.user_id
					where p.product_id='.$pid;
		return $this->ExecuteQuery($Query);
	}

	public function getCategoryValues($selVal,$whereCond) {
		$sel = 'select '.$selVal.' from '.CATEGORY.' c LEFT JOIN '.CATEGORY.' sbc ON c.id = sbc.rootID '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function getCategoryResults($selVal,$whereCond) {
		$sel = 'select '.$selVal.' from '.CATEGORY.' '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function searchShopyByCategory($whereCond) {
		$sel = 'select p.*, AVG(COALESCE(pr.rating, 0)) as avg_rating from '.PRODUCT.' p
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id
                LEFT JOIN '.PRODUCT_RATING.' pr on (p.seller_product_id = pr.product_id) 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}

	public function add_user_product($uid='',$short_url=''){
		$returnStr = array();
		$seller_product_id = mktime();
		$checkId = $this->check_product_id($seller_product_id);
		while ($checkId->num_rows()>0){
			$seller_product_id = mktime();
			$checkId = $this->check_product_id($seller_product_id);
		}
		$url = base_url().'user/'.$this->data['userDetails']->row()->user_name.'/things/'.$seller_product_id.'/'.url_title($this->input->post('name'),'-');
		$this->simple_insert(SHORTURL,array('short_url'=>$short_url,'long_url'=>$url));
		$urlid = $this->get_last_insert_id();
		$returnStr['pid'] = $seller_product_id;
		$returnStr['image'] = '';
		$image_name = $this->input->post('image');
		if ($this->input->post('tag_url') && $this->input->post('photo_url')!=''){

			/****----------Move image to server-------------****/

			$image_url = trim(addslashes($this->input->post('photo_url')));
			$image_url = str_replace(" ", '%20', $image_url);

//			$img_data = file_get_contents($image_url);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
			curl_setopt($ch, CURLOPT_URL, $image_url);
			curl_setopt($ch, CURLOPT_REFERER, $image_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //Set curl to return the data instead of printing it to the browser.
			$img_data = curl_exec($ch);
			curl_close($ch);

			$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
			$img_name_arr = explode('.', $img_full_name);
			$img_name = $img_name_arr[0];
			$ext = $img_name_arr[1];
			if ($ext == ''){
				$ext = 'jpg';
			}
			$new_name = str_replace(array(',','&','<','>','$','(',')','?'), '', $img_name.mktime().'.'.$ext);
			$new_img = 'images/product/'.$new_name;

			file_put_contents($new_img, $img_data);
			$returnStr['image'] = $new_name;

			/****----------Move image to server-------------****/

			$image_name = $new_name;

		}
		$dataArr = array(
			'product_name'	=>	$this->input->post('name'),
			'seourl'		=>	url_title($this->input->post('name'),'-'),
			'web_link'		=>	$this->input->post('link'),
			'category_id'	=>	$this->input->post('category'),
			'excerpt'		=>	$this->input->post('note'),
			'image'			=>	$image_name,
			'user_id'		=>	$uid,
			'seller_product_id' => $seller_product_id,
			'short_url_id'	=>	$urlid
		);
		$this->simple_insert(USER_PRODUCTS,$dataArr);
		return $returnStr;
	}

	public function check_product_id($pid=''){
		$checkId = $this->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}

	public function get_products_by_category($categoryid='',$sort='desc'){
		$Query = "select p.*, AVG(COALESCE(pr.rating, 0)) as avg_rating, u.user_name,u.full_name,u.thumbnail 
            from ".PRODUCT." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
            LEFT JOIN ".PRODUCT_RATING." pr on (p.seller_product_id = pr.product_id)
			where p.status='Publish' and FIND_IN_SET('".$categoryid."',p.category_id) GROUP BY p.id order by p.`created` ".$sort;
		return $this->ExecuteQuery($Query);
	}

	public function view_product_comments_details($condition = ''){
		$select_qry = "select p.product_name,c.product_id,u.full_name,u.user_name,u.thumbnail,c.comments ,u.email,c.id,c.status,c.user_id as CUID
		from ".PRODUCT_COMMENTS." c 
		LEFT JOIN ".USERS." u on u.id=c.user_id 
		LEFT JOIN ".PRODUCT." p on p.seller_product_id=c.product_id ".$condition;
		$productComment = $this->ExecuteQuery($select_qry);
		return $productComment;
			
	}
	public function Update_Product_Comment_Count($product_id){

		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count + 1) WHERE seller_product_id='".$product_id."'";
		$this->ExecuteQuery($Query);
	}
	public function Update_Product_Comment_Count_Reduce($product_id){

		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count - 1) WHERE seller_product_id='".$product_id."'";
		return $this->ExecuteQuery($Query);
	}
	public function get_products_search_results($search_key='',$limit='5'){
		$Query = 'select p.* from '.PRODUCT.' p
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where (p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" and u.group="Seller")
				or( p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 )
				limit '.$limit;
				
		/*$Query = 'select p.* from '.PRODUCT.' p		where (p.product_name like "%'.$search_key.'%") limit '.$limit;*/
		
		return $this->ExecuteQuery($Query);
	}
	public function get_user_search_results($search_key='',$limit='5'){
		$Query = 'select * from '.USERS.' where full_name like "%'.$search_key.'%" and status="Active" OR user_name like "%'.$search_key.'%" and status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}

	public function get_product_full_details($pid='0'){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".PRODUCT." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
		$productDetails = $this->ExecuteQuery($Query);
		if ($productDetails->num_rows() == 0){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".USER_PRODUCTS." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
			$productDetails = $this->ExecuteQuery($Query);
			$productDetails->prodmode = 'user';
		}else {
			$productDetails->prodmode = 'seller';
		}
		return $productDetails;
	}

	public function get_user_created_lists($pid='0'){
		$Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$pid."',product_id)";
		return $this->ExecuteQuery($Query);
	}
	//Get details from the control thr home

	public function view_controller_details(){
		$this->db->select('*');
		$this->db->from(CONTROLMGMT);
		$ControlList = $this->db->get();

		//echo '<pre>'; print_r($ControlList->result()); die;
		return $ControlList;
	}

	public function empty_pid_list(){
		$dataArr = array(
		'products'=>'',
		'product_count'=>'0'
		);
		$condArr = array('list_id'=>'2');
		$this->update_details(LIST_VALUES,$dataArr,$condArr);
	}

	public function get_upload_requests(){
		$Query = "select up.*,u.user_name,u.full_name from ".UPLOAD_REQ." up JOIN ".USERS." u on u.id=up.user_id";
		return $this->ExecuteQuery($Query);
	}
    
    public function get_product_rating($product_id, $user_id){
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $result = $this->db->get(PRODUCT_RATING);
        return $result->row();
    }
    
    public function add_product_rating($dataArr=''){
        $this->db->insert(PRODUCT_RATING, $dataArr);
    }
    
     public function remove_product_rating($productID, $userID){
        $this->db->where("product_id", $productID);
        $this->db->where("user_id", $userID);
        $this->db->delete(PRODUCT_RATING); 
    }
    
    public function get_user_product_ratings($user_id){
        $this->db->where('user_id', $user_id);
        $result = $this->db->get(PRODUCT_RATING);
        return $result->result_array();
    }
    
    public function get_product_rating_summary($product_id){
        
        $this->db->select("count(id) as rating_total_users, avg(rating) as product_avg_rating");
        $this->db->where('product_id', $product_id);
        $result = $this->db->get(PRODUCT_RATING);
        //echo $this->db->last_query();
        return $result->row();
    }
}

?>