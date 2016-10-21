<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" href="css/site/my-account.css" type="text/css" media="all"/>

<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<style type="text/css" media="screen">


#edit-details {
    color: #FF3333;
    font-size: 11px;
}
.option-area select.option {
    border: 1px solid #D1D3D9;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 1px #EEEEEE;
    height: 22px;
    margin: 5px 0 12px;
}
a.selectBox.option {
    margin: 5px 0 10px;
    padding: 3px 0;
}
a.selectBox.option .selectBox-label {
    font: inherit !important;
    padding-left: 10px;
}
.button:hover {
	background: #3e73b7;
}
.button {
	cursor: pointer;
	overflow: visible;
	margin: 5px 0px;
	padding: 8px 8px 10px 7px;
	border: 0;
	border-radius: 4px;
	font-weight: bold;
	font-size: 15px;
	line-height: 22px;
	text-align: center;
	color: #fff;
	background: #588cc7;
}
</style>

 <!-- Section_start -->
<div class="lang-en wider no-subnav thing signed-out winOS">

<div id="container-wrapper">
	<div class="container ">
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
	<?php 
	if ($productDetails->num_rows()==1){
		$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
        
        // checking if the product has already been rated by the user.
        $fancyClass = 'fancyr';
        $fancyText = LIKE_BUTTON;
        if($ratedProducts && count($ratedProducts)>0){
            if(array_key_exists($productDetails->row()->seller_product_id, $ratedProducts)){
                $fancyClass = 'fancyrd';
                $fancyText = LIKED_BUTTON;
            }
        }
	    ?>
        
		<div class="wrapper-content right-sidebar" style="background:none; box-shadow:none;">
			<div id="content" style="padding:0px; background:none;width: 680px;">
            
            <div class="detail_leftbar">
            
				<div class="figure-row first">
					<div class="figure-product figure-640 big">
						
						<figure>
							<span class="wrapper-fig-image">
								<span class="fig-image" style="background:#FFFFFF;"><img src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $productDetails->row()->product_name;?>"></span>
							</span>
                        </figure>
                        
                        <div class="product_title">
                        
                            <figcaption style="text-align:left;"><?php echo $productDetails->row()->product_name;?></figcaption>
						    
						    <br class="hidden">
						    
						    <p style="text-align:left;"><?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?> <a href="<?php if ($productDetails->row()->user_id != '0'){echo base_url().'user/'.$productDetails->row()->user_name.'/added';}else {echo base_url().'user/administrator';}?>" class="username"><?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?></a> + <?php echo $productDetails->row()->likes;?> <?php if($this->lang->line('product_others') != '') { echo stripslashes($this->lang->line('product_others')); } else echo "others"; ?></p>
                            
                            
						    
       
						    <br class="hidden">
						    
						    <a id="prod_popup_<?php echo $productDetails->row()->seller_product_id; ?>" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> rating="true"><span><i></i></span><?php echo $fancyText;?></a>
                            
                            
                            <a style="display: none" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="button fancy <?php //echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?>><span><i></i></span><?php echo $fancyText;?></a>
                        
                        </div>
                        
                        <?php if($rating_summary){ ?>
                            <div class="single-star-rating">
                                <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating" class="imdbRating">
                                    <div class="ratingValue">
                                        <strong title="<?php echo round($rating_summary->product_avg_rating, 2); ?> based on <?php echo $rating_summary->rating_total_users; ?> user ratings">
                                            <span itemprop="ratingValue"><?php echo round($rating_summary->product_avg_rating, 2); ?></span>
                                        </strong>
                                    </div>
                                    <span itemprop="ratingCount" class="small"><?php echo $rating_summary->rating_total_users; ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        
						<ul class="detail_thing_info1">
                            <?php 
	                            $img = 'dummyProductImage.jpg';
		                            $imgArr = explode(',', $productDetails->row()->image);
		                            if (count($imgArr)>0){
			                            foreach ($imgArr as $imgRow){
				                            if ($imgRow != ''){
					                            $img = $pimg = $imgRow;
					                            break;
				                            }
			                            }
		                            }
		                            $colorID = '0';
		                            $listNameArr = explode(',', $productDetails->row()->list_name);
		                            $listValueArr = explode(',', $productDetails->row()->list_value);
		                            if (count($listNameArr)>0){
			                            for ($i=0;$i<count($listNameArr);$i++){
				                            if ($listNameArr[$i] == '1'){
					                            if ($listValueArr[$i] != ''){
						                            $colorID = $listValueArr[$i];break;
					                            }
				                            }
			                            }
		                            }
		                            $color = '';
		                            if ($colorID != '0'){
			                            $listArr = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$colorID));
			                            if ($listArr->num_rows()>0){
				                            $color = $listArr->row()->list_value;	
			                            }
		                            }
		                            $ownClass = '';
		                            if ($loginCheck != ''){
			                            $ownArr = explode(',', $userDetails->row()->own_products);
			                            if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				                            $ownClass = 'own-selected';
			                            }
		                            }
                            ?>
						<li><a href="things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
                        
						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list-left"><i class="want_icon"></i><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></a></li>
                        
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="feature_icon"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        
                        
                        <?php if ($loginCheck != ''  && ($userDetails->row()->id == $productDetails->row()->user_id)){?>
						<li><a id="edit-details" class="" href="things/<?php echo $productDetails->row()->seller_product_id;?>/edit"><?php if($this->lang->line('product_edit_dtls') != '') { echo stripslashes($this->lang->line('product_edit_dtls')); } else echo "Edit details"; ?><i class="won_icon"></i></a></li>
                        
						<li><a style="font-size: 11px; color: #f33;" uid="<?php echo $productDetails->row()->user_id;?>" thing_id="<?php echo $productDetails->row()->seller_product_id;?>" ntid="7220865" class="remove_new_thing" href="things/<?php echo $productDetails->row()->seller_product_id;?>/delete"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?><i class="color_icon"></i></a></li>
                        <?php }?>  

                    </ul>

					</div>
					<!-- / figure-product figure-640 -->
				</div>
				<!-- / figure-row -->
                				<!-- Seller Story -->
				<?php 
					$store_img = 'user_thumb.png';
					if ($productDetails->row()->thumbnail != ''){
						$store_img = $productDetails->row()->thumbnail;
					}
					$followClass = '';
		        	$followText = 'Follow';
			        if ($loginCheck != ''){
				        $followingListArr = explode(',', $userDetails->row()->following);
				        if (in_array($productDetails->row()->user_id, $followingListArr)){
				        	$followClass = 'following';
				        	$followText = 'Following';
				        }
			        }
				?>
                
                <div class="TabbedPanels" id="TabbedPanels1">
         
                    <ul class="TabbedPanelsTabGroup">
                      <li tabindex="0" class="TabbedPanelsTab  TabbedPanelsTabSelected"><?php if($this->lang->line('item_details') != '') { echo stripslashes($this->lang->line('item_details')); } else echo "Item Details"; ?></li>
                      <li tabindex="0" class="TabbedPanelsTab">
                        		<div class="rating_star">
                        				<?php foreach($product_feedback as $feedbacks) {  $totals = $totals+$feedbacks['rating']; }  $totalratingstars = $totals/count($product_feedback);  ?>
                                        <div class="rat_star1" style="width:<?php echo round($totalratingstars) * 20; ?>%"></div>
                            </div>
                       (<?php  echo $rownum = count($product_feedback); ?>)</li>
                      <li tabindex="0" class="TabbedPanelsTab"><?php if($this->lang->line('shipping_policies') != '') { echo stripslashes($this->lang->line('shipping_policies')); } else echo "Shipping & Policies"; ?></li>
                    </ul>
                        <div class="TabbedPanelsContentGroup">
                          <div class="TabbedPanelsContent  TabbedPanelsContentVisible" style="display: block;">
                          <?php  echo $productDetails->row()->description; ?><div class="clear"></div> 
                          </div>
                          <div class="TabbedPanelsContent" style="display: none;">
                           <?php  
                           $rownum = count($product_feedback); 
						   
                           if ($rownum>0){
                           foreach($product_feedback as $feedback) { 
                           	$pimg = 'dummyproductimage.jpg';
                           	$pimg_arr = array_filter(explode(',', $feedback['image']));
                           	if (count($pimg_arr)>0){
                           		foreach ($pimg_arr as $pimg_row){
                           			if (file_exists('images/product/'.$pimg_row)){
                           				$pimg = $pimg_row;break;
                           			}
                           		}
                           	}
                           	$total = $total+$feedback['rating'];?>
                            <div class="tabbed_review">
                            	<div class="tabbed_left">
                                	<a href="user/<?php echo $feedback['user_name']; ?>"><img src="images/users/<?php echo $feedback['thumbnail']; ?>" width="30px" height="30px" /></a>
                                    <span><?php if($this->lang->line('reviewed_by') != '') { echo stripslashes($this->lang->line('reviewed_by')); } else echo "Reviewed By"; ?></span>
                                    <p><a href="user/<?php echo $feedback['user_name']; ?>"><?php echo $feedback['full_name']; ?></a></p>
                                </div>
                                <div class="tabbed_right">
                                	<div class="tabbed_top">
                                		<div class="rating_star">
                                            <div class="rat_star1" style="width:<?php echo $feedback['rating']*20; ?>%"></div>
                                        </div>
                                   		<span class="date"><?php echo date("M d Y", strtotime($feedback['dateAdded'])); ?></span>
                                    </div>    
                                    <span class="tab_rev_title"><?php echo $feedback['title']; ?></span>
                                    <a style="float: left;margin: 0px 0 0 20px;width: 30px;" href="things/<?php echo $feedback['product_id']; ?>/<?php echo url_title($feedback['product_name'],'-');?>">
                                    	<img src="images/product/<?php echo $pimg; ?>" width="30px" />
                                    </a>
                                    <span class="tab_rev_txt"><?php echo $feedback['description']; ?> </span>
                                </div>
                            </div>
                            <?php } }else {?>
                            <p></p>
                            <?php }?>
                          </div>
                          <div class="TabbedPanelsContent" style="display: none;">
                         <?php echo $productDetails->row()->shipping_policies; ?>
                         <div class="clear"></div>
                          </div>
                          
                          
                          
                     <script type="text/javascript" class="" style="display: none;">
                        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
                        //--&gt;
                        </script>
                        
                        </div>
                </div>
                
				
                 <section class="comments comments-list comments-list-new" style="padding-bottom: 0;">
                    
                    <!--<button id="btn-viewall-comments" class="toggle">View all 28 comments <i></i></button>
					<button id="toggle-comments" class="toggle"><span>View all 28 comments</span> <i></i></button>-->
                    
					<!-- template for normal comments -->
					
					<!-- template for reported comments -->
					
					<ol user_id="">
						
						<li class="loading"><span><?php if($this->lang->line('display_loading') != '') { echo stripslashes($this->lang->line('display_loading')); } else echo "Loading"; ?>...</span></li>
					</ol>
					<ol user_id="">
						<?php 
						if ($productComment->num_rows() > 0){
							foreach ($productComment->result() as $cmtrow){
								if ($cmtrow->status == 'Active'){
									
							
						?>
						
						<li class="comment">
							<a class="milestone" id="comment-1866615"></a>
							<span class="vcard"><a href="<?php echo base_url();?>user/<?php echo $cmtrow->user_name;?>" class="url"><img src="images/users/<?php if($cmtrow->thumbnail!=''){ echo $cmtrow->thumbnail;}else{echo 'user-thumb.png';}?>" alt="" class="photo"><span class="fn nickname"><?php echo ucfirst($cmtrow->user_name);?></span></a></span>
							<p class="c-text"><?php echo $cmtrow->comments;?></p>
							
                            
						</li>
						
						<?php 
								}else {
									if ($loginCheck != '' && $productDetails->row()->user_id > 0 && $loginCheck == $productDetails->row()->user_id){
						?>
						<li class="comment">
							<a class="milestone" id="comment-1866615"></a>
							<span class="vcard"><a href="<?php echo base_url();?>user/<?php echo $cmtrow->user_name;?>" class="url"><img src="images/users/<?php if($cmtrow->thumbnail!=''){ echo $cmtrow->thumbnail;}else{echo 'user-thumb.png';}?>" alt="" class="photo"><span class="fn nickname"><?php echo ucfirst($cmtrow->user_name);?></span></a></span>
							<p class="c-text"><?php echo $cmtrow->comments;?></p>
							<p style="float:left;width:100%;text-align:left;">
								<a style="font-size: 11px; color: #188A0E;" onclick="javascript:approveCmt(this);" data-uid="<?php echo $cmtrow->CUID;?>" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="<?php echo $cmtrow->id;?>"><?php if($this->lang->line('approve') != '') { echo stripslashes($this->lang->line('approve')); } else echo "Approve"; ?></a>
								<a style="font-size: 11px; color: #f33;" onclick="javascript:deleteCmt(this);" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="<?php echo $cmtrow->id;?>"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a>
							</p>	
                            
						</li>
						<?php 		
									}else {
										if ($loginCheck != '' && $cmtrow->CUID > 0 && $loginCheck == $cmtrow->CUID){
						?>
						<li class="comment">
							<a class="milestone" id="comment-1866615"></a>
							<span class="vcard"><a href="<?php echo base_url();?>user/<?php echo $cmtrow->user_name;?>" class="url"><img src="images/users/<?php if($cmtrow->thumbnail!=''){ echo $cmtrow->thumbnail;}else{echo 'user-thumb.png';}?>" alt="" class="photo"><span class="fn nickname"><?php echo ucfirst($cmtrow->user_name);?></span></a></span>
							<p class="c-text"><?php echo $cmtrow->comments;?></p>
							<p style="float:left;width:100%;text-align:left;font-size: 11px; color: #188A0E;">
								<?php if($this->lang->line('wait_for_approve') != '') { echo stripslashes($this->lang->line('wait_for_approve')); } else echo "Waiting for approval"; ?>
								<a style="font-size: 11px; color: #f33;margin-left:10px" onclick="javascript:deleteCmt(this);" data-tid="<?php echo $productDetails->row()->seller_product_id;?>" data-cid="<?php echo $cmtrow->id;?>"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a>
							</p>	
                            
						</li>
						<?php 
										}
									}
								}
							}
						}?>
						
					</ol>
					

				</section>
				<!-- / comments -->
 <!-- Comment start -->  
  <script type="text/javascript">
$(function() {

$(".submit").click(function() {
	var requirelogin = $(this).attr('require-login');
	if(requirelogin){
		var thingURL = $(this).parent().next().find('a:first').attr('href');
		window.location = baseURL+thingURL;
		return false;
	}
	var comments = $("#comments").val();
	var product_id = $("#cproduct_id").val();
    var dataString = '&comments=' + comments + '&cproduct_id=' + product_id;
	
	if(comments=='')
     {
    alert('<?php if($this->lang->line('your_cmt_empty') != '') { echo stripslashes($this->lang->line('your_cmt_empty')); } else echo "Your comment is empty"; ?>');
     }
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading"><?php if($this->lang->line('load_cmt') != '') { echo stripslashes($this->lang->line('load_cmt')); } else echo "Loading Comment"; ?>...</span>');
$.ajax({
		type: "POST",
  url: baseURL+'site/order/insert_product_comment',
   data: dataString,
  cache: false,
  dataType:'json',
  success: function(json){
		if(json.status_code == 1){
				alert('<?php if($this->lang->line('your_cmt_wait_aprove') != '') { echo stripslashes($this->lang->line('your_cmt_wait_aprove')); } else echo "Your comment is waiting for approval"; ?>');
				window.location.reload();
			}
    document.getElementById('comments').value='';
	$("#flash").hide();
	
  }
 });
}
return false;
	});



});


</script> 
<div id="flash"></div>
        <div style="float: left;margin: 4px 4px 0 0;"> 
        <?php 
        $user_img = 'comment_icon.png';
        if ($loginCheck != '' && $userDetails->row()->thumbnail != ''){
        	$user_img = $userDetails->row()->thumbnail;
        }
        ?>
        
        	<img src="images/users/<?php echo $user_img;?>" width="33px" height="33px"/>
        </div>
        <div >
                <form action="#" method="post">
                    <input type="hidden" name="cproduct_id" id="cproduct_id" value="<?php echo $productDetails->row()->seller_product_id;?>"/>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $loginCheck ;?>"/>
                    <textarea class="text detail_input" name="comments" placeholder="<?php if($this->lang->line('header_write_comment') != '') { echo stripslashes($this->lang->line('header_write_comment')); } else echo "Write a comment"; ?>..." id="comments" style="height: 23px;margin: 4px 4px 0 0;width: 80%;"></textarea>
                    <input type="submit" <?php if($loginCheck==''){ ?>require-login='true'<?php }?> class="submit button" value=" <?php if($this->lang->line('header_post_comment') != '') { echo stripslashes($this->lang->line('header_post_comment')); } else echo "Post"; ?> " style="width: 10%;float: right;height: 35px;margin: 4px 0 0 0;" />
                </form>
                <?php if($loginCheck==''){ ?>
                	<p><?php if($this->lang->line('product_please') != '') { echo stripslashes($this->lang->line('product_please')); } else echo "Please"; ?> <a href="login?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_login') != '') { echo stripslashes($this->lang->line('product_login')); } else echo "login"; ?></a> <?php if($this->lang->line('credit_or') != '') { echo stripslashes($this->lang->line('credit_or')); } else echo "or"; ?> <a href="signup?next=things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>"><?php if($this->lang->line('product_signup') != '') { echo stripslashes($this->lang->line('product_signup')); } else echo "signup"; ?></a> <?php if($this->lang->line('product_to_post') != '') { echo stripslashes($this->lang->line('product_to_post')); } else echo "to post comments"; ?></p>
                <?php }?>
        </div>
                
                
                
                </div>
                
                
                
                <div class="detail_leftbar1">
				<?php 
				if (count($relatedProductsArr)>0 && $relatedProductsArr[0]->seller_product_id){
				?>
				<div class="might-fancy">
					<h3 class="selstory-head detail_link_list"><?php if($this->lang->line('giftcard_you_might') != '') { echo stripslashes($this->lang->line('giftcard_you_might')); } else echo "You might also"; ?> <?php echo LIKE_BUTTON;?>...</h3>
                    
					<div style="height: 259px;" class="figure-row fancy-suggestions anim might_box">
					<?php 
					$limitCount = 0;
					foreach ($relatedProductsArr as $relatedRow){
                        if($relatedRow->seller_product_id){
						    if ($limitCount<3){
							    $limitCount++;
						    $img = 'dummyProductImage.jpg';
						    $imgArr = explode(',', $relatedRow->image);
						    if (count($imgArr)>0){
							    foreach ($imgArr as $imgRow){
								    if ($imgRow != ''){
									    $img = $imgRow;
									    break;
								    }
							    }
						    }
                            
                            
                            // checking if the product has already been rated by the user.
                            $fancyClass = 'fancyr';
                            $fancyText = LIKE_BUTTON;
                            if($ratedProducts && count($ratedProducts)>0){
                                if(array_key_exists($relatedRow->seller_product_id, $ratedProducts)){
                                    $fancyClass = 'fancyrd';
                                    $fancyText = LIKED_BUTTON;
                                }
                            }
					    ?>
							    <div class="figure-product figure-200 might_box_list">
								    <a href="<?php echo base_url();?>things/<?php echo $relatedRow->id;?>/<?php echo url_title($relatedRow->product_name,'-');?>">
								    <figure>
								    <span class="wrapper-fig-image">
									    <span class="fig-image">
										    <img style="width: 200px; height: 200px;" src="<?php echo base_url();?>images/product/<?php echo $img;?>">
									    </span>
								    </span>
								    <figcaption><?php echo $relatedRow->product_name;?></figcaption>
								    </figure>
								    </a>
								    <br class="hidden">
								    <span class="username"><a href="<?php if ($relatedRow->user_id != '0'){echo 'user/'.$relatedRow->user_name;}else {echo 'user/administrator';}?>"><?php if ($relatedRow->user_id != '0'){echo $relatedRow->full_name;}else {echo 'administrator';}?></a> <em>+ <?php echo $relatedRow->likes;?></em></span>
								    <br class="hidden">
								    <a id="prod_popup_<?php echo $relatedRow->seller_product_id; ?>" href="#" item_img_url="images/product/<?php echo $img;?>" tid="<?php echo $relatedRow->seller_product_id;?>" class="button <?php echo $fancyClass;?>" <?php if ($loginCheck==''){?>require_login="true"<?php }?> rating="true"><span><i></i></span><?php echo $fancyText;?></a>
							    </div>
					    <?php 
					    }
                        }
                    }
					?>
							</div>
				</div>
				<?php }?>
				<?php 
				if ($recentLikeArr->num_rows()>0){
				?>
				</div>
                <div class="detail_leftbar1">
                <h3 id="recently-fancied-by" class="detail_link_list"><?php if($this->lang->line('recently') != '') { echo stripslashes($this->lang->line('recently')); } else echo "Recently"; ?> <?php echo LIKED_BUTTON;?> <?php if($this->lang->line('user_by') != '') { echo stripslashes($this->lang->line('user_by')); } else echo "by"; ?>...</h3>
                
				<div class="recently-fancied might_box">
					<?php 
					foreach ($recentLikeArr->result() as $userRow){
						if ($userRow->user_id != '' && $userRow->user_id != $loginCheck){
							$userImg = 'user-thumb1.png';
							if ($userRow->thumbnail != ''){
								$userImg = $userRow->thumbnail;
							}
							$followClass = 'follow';
					        $followText = 'Follow';
					        if ($loginCheck != ''){
						        $followingListArr = explode(',', $userDetails->row()->following);
						        if (in_array($userRow->user_id, $followingListArr)){
						        	$followClass = 'following';
						        	$followText = 'Following';
						        }
					        } 
					?>
					<div class="figure-row">
						<div class="user">
							<div class="vcard">
								<a href="<?php echo base_url().'user/'.$userRow->user_name;?>" class="url"><img width="40px" height="40px" src="<?php echo base_url();?>images/users/<?php echo $userImg;?>" alt="<?php echo $userRow->full_name;?>" class="photo"></a>
								<a href="<?php echo base_url().'user/'.$userRow->user_name;?>"><strong class="fn nickname"><?php echo $userRow->full_name;?></strong></a>
							</div>
							<!-- / vcard -->
							
							<a href="#" <?php if ($loginCheck==''){?>require_login="true"<?php }?> uid="<?php echo $userRow->user_id;?>" class="follow-link <?php echo $followClass;?>"><?php echo $followText;?></a>
							
						</div>
						<!-- /user -->
					<?php 
					if ($recentUserLikes[$userRow->user_id]->num_rows()>0 && $dontRun){
						foreach ($recentUserLikes[$userRow->user_id]->result() as $userLikeRow){
							if ($userLikeRow->product_name != ''){
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',',$userLikeRow->image);
								if (count($imgArr)>0){
									foreach ($imgArr as $imgRow){
										if ($imgRow != ''){
											$img = $imgRow;
											break;
										}
									}
								}
					?>
						
						<div class="figure-product figure-140">
						
						
						
						<a href="<?php echo base_url().'things/'.$userLikeRow->PID.'/'.url_title($userLikeRow->product_name,'-');?>"><figure><span class="wrapper-fig-image"><span class="fig-image"><img width="140px" src="<?php echo base_url();?>images/product/<?php echo $img;?>" alt="<?php echo $userLikeRow->product_name;?>"></span></span></figure></a>
						
						
						</div>
					<?php 
							}
						}
					}
					?>	
						
					</div>
					<!-- / figure-row -->
				<?php 
						}
				}
				?>
				</div>
				<!-- / recently-fancied -->
				<?php 
				}
				?>
			</div>
            
            </div>
            
			<!-- / content -->

			<aside id="sidebar" style="padding:0px; width: 255px;">
          
				<section class="thing-section gift-section">
                
                		<div class="detail_sidebar">
                
                	<p class="prices">
						<strong class="price"><?php echo $currencySymbol;?><span id="SalePrice"><?php echo $productDetails->row()->sale_price;?></span></strong> <?php echo $currencyType;?><br>
						
					</p>
					
                    <h3><?php echo $productDetails->row()->product_name;?></h3>

					<div class="thing-description">
					<?php 
					$short_des = word_limiter($productDetails->row()->excerpt,25);
					if ($short_des == ''){
						$short_des = word_limiter($productDetails->row()->description,25);
					}
					?>	
						<p><?php echo $short_des;?> <a href="<?php echo 'things/'.$productDetails->row()->id.'/'.url_title($productDetails->row()->product_name);?>"><?php if($this->lang->line('fancy_more') != '') { echo stripslashes($this->lang->line('fancy_more')); } else echo "more"; ?></a></p>
						
					</div>
                    <div class="quick-shipping" <?php if($productDetails->row()->ship_immediate == 'true'){?>style="display: block;"<?php }?>>
                        <span class="icon truck"></span> <?php if($this->lang->line('header_immed_ship') != '') { echo stripslashes($this->lang->line('header_immed_ship')); } else echo "Immediate Shipping"; ?> <span class="tooltip"><i class="icon"></i> <small><?php if($this->lang->line('header_ship_within') != '') { echo stripslashes($this->lang->line('header_ship_within')); } else echo "Ships within 1-3 business days"; ?> <b></b></small></span>
					</div>

					<ul class="figure-list after">
					
						<?php 
						$limitCount = 0;
						$imgArr = explode(',', $productDetails->row()->image);
						if (count($imgArr)>0){
							foreach ($imgArr as $imgRow){
								if ($limitCount>5)break;
								if ($imgRow != '' && $imgRow != $pimg){
									$limitCount++;
						?>
						  <li><a href="<?php echo base_url().PRODUCTPATH.$imgRow;?>" data-bigger="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url().PRODUCTPATH.$imgRow;?>)"></a></li>
						<?php 
								}
							}
						}
						?>
					</ul>

					<div class="option-area detail_option1">
                    	<div class="detail_option">
					<input type="hidden" id="original_sale_price" value="<?php echo $productDetails->row()->sale_price;?>"/>	
						<label for="quantity"><?php if($this->lang->line('header_quant_Avail') != '') { echo stripslashes($this->lang->line('header_quant_Avail')); } else echo "Quantity ( Available"; ?> : <?php echo $productDetails->row()->quantity;?> )</label>
						<span style="display: inline-block; position: relative;" class="input-number">
							<input name="quantity" id="quantity" data-mqty="<?php echo $productDetails->row()->quantity;?>" class="option quantity" value="1" min="1" onkeyup="javascript:changeQty(this);" type="number">
							<a style="position: absolute; top: 5px; right: 0px; height: 11px; padding: 0px 7px;" class="btn-up" onclick="javascript:increaseQty();" href="javascript:void(0);"><span></span></a>
							<a style="position: absolute; top: 17px; right: 0px; height: 11px; padding: 0px 7px;" class="btn-down" onclick="javascript:decreaseQty();" href="javascript:void(0);"><span></span></a>
						</span>
						<div style="color:#FF0000;" id="QtyErr"></div>
						 <?php  
                   	$attrValsSetLoad = ''; //echo '<pre>'; print_r($PrdAttrVal->result_array()); 
					if($PrdAttrVal->num_rows>0){ 
						$attrValsSetLoad = $PrdAttrVal->row()->pid; 
					?>
                   <label for="quantity"><?php if($this->lang->line('options') != '') { echo stripslashes($this->lang->line('options')); } else echo "Options"; ?></label>
                   	<select name="attr_name_id" id="attr_name_id" class="option  selectBox" style="border:1px solid #D1D3D9;width: 190px;" onchange="ajaxCartAttributeChange(this.value,'<?php echo $productDetails->row()->id; ?>');" >
                        <option value="0">--------------- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?> ---------------</option>
                        <?php foreach($PrdAttrVal->result_array() as $Prdattrvals ){ ?>
                        <option value="<?php echo $Prdattrvals['pid']; ?>"><?php echo $Prdattrvals['attr_type'].'/'.$Prdattrvals['attr_name']; ?></option>
                        <?php } ?>
                        </select>
				<div style="color:#FF0000;" id="AttrErr"></div>
				<div id="loadingImg_<?php echo $productDetails->row()->id; ?>"></div>
              <?php } ?>
					<div style="color:#FF0000;" id="ADDCartErr"></div>
                <input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productDetails->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productDetails->row()->category_id;?>">                
                <input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productDetails->row()->user_id;?>">
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $productDetails->row()->sale_price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productDetails->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productDetails->row()->tax_cost;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="<?php echo $attrValsSetLoad; ?>">

				<input type="button" class="greencart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="ajax_add_cart('<?php echo $PrdAttrVal->num_rows; ?>');" />
                    
					</div>
					</div>
                    
                    </div>
						<div class="detail_sidebar_list">
                        
							<h3 class="detail_link_list"><?php if($this->lang->line('actions') != '') { echo stripslashes($this->lang->line('actions')); } else echo "Actions"; ?></h3>
                            
                            
                            
                            <ul class="detail_thinginfo">
<?php 
	$img = 'dummyProductImage.jpg';
		$imgArr = explode(',', $productDetails->row()->image);
		if (count($imgArr)>0){
			foreach ($imgArr as $imgRow){
				if ($imgRow != ''){
					$img = $pimg = $imgRow;
					break;
				}
			}
		}
		$colorID = '0';
		$listNameArr = explode(',', $productDetails->row()->list_name);
		$listValueArr = explode(',', $productDetails->row()->list_value);
		if (count($listNameArr)>0){
			for ($i=0;$i<count($listNameArr);$i++){
				if ($listNameArr[$i] == '1'){
					if ($listValueArr[$i] != ''){
						$colorID = $listValueArr[$i];break;
					}
				}
			}
		}
		$color = '';
		if ($colorID != '0'){
			$listArr = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$colorID));
			if ($listArr->num_rows()>0){
				$color = $listArr->row()->list_value;	
			}
		}
		$ownClass = '';
		if ($loginCheck != ''){
			$ownArr = explode(',', $userDetails->row()->own_products);
			if (in_array($productDetails->row()->seller_product_id, $ownArr)){
				$ownClass = 'own-selected';
			}
		}
?>
						<li><a href="javascript:void(0);" onclick="product_details_contact_form(this);" <?php if ($loginCheck==''){?>require-login="true"<?php }?> class="" id=""><i style="background-position: -136px -40px;"></i><?php if($this->lang->line('contact_seller') != '') { echo stripslashes($this->lang->line('contact_seller')); } else echo "Contact Seller"; ?></a></li>
						<li><a href="things/<?php echo $productDetails->row()->id;?>/<?php echo url_title($productDetails->row()->product_name,'-');?>" id="show-someone" class="show" uid="<?php echo $loginCheck;?>" tid="<?php echo $productDetails->row()->id;?>" tname="<?php echo $productDetails->row()->product_name;?>" tuser="<?php if ($productDetails->row()->user_id != '0'){echo $productDetails->row()->full_name;}else {echo 'administrator';}?>" data-timage="<?php //echo base_url();?>images/product/<?php echo $img;?>" price="<?php echo $productDetails->row()->sale_price;?>" reacts="<?php echo $productDetails->row()->likes;?>" username="<?php if ($loginCheck != ''){if (count($userDetails)>0){echo $userDetails->row()->user_name;}}?>" action="buy" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="link_icon"></i><?php if($this->lang->line('header_share') != '') { echo stripslashes($this->lang->line('header_share')); } else echo "Share"; ?></a></li>
                        
						<li><a href="#" onclick="" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" class="list" id="show-add-to-list"><i class="want_icon"></i><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></a></li>
                        
						<li><a href="#" tid="<?php echo $productDetails->row()->seller_product_id;?>" class="<?php if (count($userDetails)>0){if ($productDetails->row()->seller_product_id == $userDetails->row()->feature_product){ echo 'feature-selected';}else {echo 'feature';}}else {echo 'feature';}?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>"><i class="feature_icon"></i><?php if($this->lang->line('product_feature') != '') { echo stripslashes($this->lang->line('product_feature')); } else echo "Feature on my profile"; ?> </a></li>
                        
						<li><a href="#" class="own <?php echo $ownClass;?>" require_login="<?php if (count($userDetails)>0){echo 'false';}else {echo 'true';}?>" tid="<?php echo $productDetails->row()->seller_product_id;?>"><i class="won_icon"></i><?php if($this->lang->line('product_i_ownit') != '') { echo stripslashes($this->lang->line('product_i_ownit')); } else echo "I own it"; ?></a></li>
                        
						<li><a href="<?php base_url();?>shopby/all?c=<?php echo $color;?>" class="color"><i class="color_icon"></i><?php if($this->lang->line('product_find_similar') != '') { echo stripslashes($this->lang->line('product_find_similar')); } else echo "Find similar colors"; ?></a></li>
                        
                        <li><a class="color" onclick="javascript:$(this).find('input').select()" id="short_url_link"><i style="background-position: -60px -60px;"></i><input type="text" readonly value="<?php echo base_url().'t/'.$productDetails->row()->short_url; ?>"/></a></li>

                    </ul>
                            
    					</div>
                        
                        <div class="detail_sidebar_list">
                <?php 
                $store_name = $productDetails->row()->full_name;
                if ($store_name == ''){
	                $store_name = $productDetails->row()->user_name;
                }
                if ($store_name == '' && $productDetails->row()->user_id==0){
                	$store_name = 'Administrator';
                }
                ?>
                <h2 class="selstory-head detail_link_list"><?php if($this->lang->line('more_from') != '') { echo stripslashes($this->lang->line('more_from')); } else echo "More from"; echo ' '.$store_name;?></h2>
				<div class="seller-details">
<!-- 				    <h3><a href="user/<?php echo $productDetails->row()->user_name;?>" class="url"><img src="images/users/<?php echo $store_img;?>" alt="<?php echo $productDetails->row()->full_name;?>" class="photo"></a>
					<div class="selname-story">
						<p><b><a href="user/<?php echo $productDetails->row()->user_name;?>"><?php echo $productDetails->row()->full_name;?></a></b>
						 : <?php echo word_limiter($productDetails->row()->about,16);?></p>
					</div>
				    </h3>
				    
				    <a href="#" class="follow-user-link <?php echo $followClass;?>" <?php if ($loginCheck==''){echo 'require_login="true"';}?> uid="<?php echo $productDetails->row()->user_id;?>"><?php echo $followText;?></a>
				    <div class="clear"></div>
 -->				    <ul>
					<?php 
					$limitProd = 0;
					if ($seller_product_details->num_rows()>0){
						foreach ($seller_product_details->result() as $seller_product_details_row){
							if ($limitProd==6)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_product_details_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					?>
                    
					<li><a href="things/<?php echo $seller_product_details_row->id;?>/<?php echo url_title($seller_product_details_row->product_name,'-');?>" class="figure-img">
						<span style="background-image: url(<?php echo base_url();?>images/product/<?php echo $img;?>);"></span>
					</a></li>
					<?php 
						}
					}
					if ($limitProd<6 && $seller_affiliate_products->num_rows()>0){
						foreach ($seller_affiliate_products->result() as $seller_affiliate_products_row){
							if ($limitProd==6)break;
							$limitProd++;
							$img = 'dummyProductImage.jpg';
							$imgArr = array_filter(explode(',', $seller_affiliate_products_row->image));
							if (count($imgArr)>0){
								foreach ($imgArr as $imgRow){
									if ($imgRow != ''){
										$img = $imgRow;
										break;
									}
								}
							}
					?>
					<li><a href="user/<?php echo $productDetails->row()->user_name;?>/things/<?php echo $seller_affiliate_products_row->seller_product_id;?>/<?php echo url_title($seller_affiliate_products_row->product_name,'-');?>" class="figure-img">
						<span style="background-image: url(<?php echo base_url();?>images/product/<?php echo $img;?>);"></span>
					</a></li>
					<?php 
						}
					}
					?>
				    </ul>
				</div>
				<?php 
				?>
                
                
				<!-- / Seller Story -->

                
                
                

<!--Comment End-->


				</div>
					
				</section>
          
				<!-- / thing-section -->
				<hr>
			</aside>
			<!-- / sidebar -->
			<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
				</div>
			<?php 
	}else {
	?>
			<div class="wrapper-content right-sidebar" style="width:100%;">
			<p style="float:left;width:80%;padding:10%;text-align:center;font-size:17px;"><?php if($this->lang->line('fancy_prod_unavail') != '') { echo stripslashes($this->lang->line('fancy_prod_unavail')); } else echo "This product details not available"; ?></p>
			<?php 
     $this->load->view('site/templates/footer_menu');
     ?>
		
		<a href="#header" id="scroll-to-top"><span><?php if($this->lang->line('signup_jump_top') != '') { echo stripslashes($this->lang->line('signup_jump_top')); } else echo "Jump to top"; ?></span></a>
		</div>
	<?php }?>
		</div>
		<!-- / wrapper-content -->

		

	

	<!-- / container -->
</div>

</div>

<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>filesjquery_zoomer.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>selectbox.js"></script>
<script type="text/javascript" src="js/site/thing_page.js"></script>
<script type="text/javascript">
function increaseQty(){
	var mqty = $('.quantity').data('mqty');
	var oldQty = $('.quantity').val();
	if(oldQty-oldQty != 0){
		oldQty = 0;
	}
	if(oldQty<0){
		oldQty = 0;
	}
	oldQty++;
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function decreaseQty(){
	var mqty = $('.quantity').data('mqty');
	var oldQty = $('.quantity').val();
	if(oldQty-oldQty != 0){
		oldQty = 1;
	}
	if(oldQty<0){
		oldQty = 1;
	}
	if(oldQty>1){
		oldQty--;
	}
	if(oldQty<1){
		oldQty = 1;
	}
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function changeQty(e){
	$('.add_to_cart').disable(false);
	var mqty = $('.quantity').data('mqty');
	var oldQty = $(e).val();
	if(oldQty-oldQty != 0){
		oldQty = 1;
	}
	if(oldQty<0){
		oldQty = 1;
	}
	if(oldQty=='' || oldQty == '0'){
		$('.add_to_cart').disable();
	}
	if(oldQty>mqty){
		alert('<?php if($this->lang->line('max_stock_of_this_product_is') != '') { echo stripslashes($this->lang->line('max_stock_of_this_product_is')); } else echo "Maximum stock of this product is"; ?> '+mqty);
		oldQty = mqty;
	}
	$('.quantity').val(oldQty);
}
function changeAttrPrice(attr){
	var sale_price = $('#original_sale_price').val();
//	var old_price = $('#attr_'+attr).data('price');
	var attr_price = $('#attr_'+attr).val();
	if(attr_price == 0){
		attr_price = sale_price;
	}
//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);
//	$('#price').val(new_price);
	$('#price').val(attr_price);
//	$('#attr_'+attr).data('price',attr_price);
//	$('p.prices').find('span').text(new_price);
	$('p.prices').find('span').text(attr_price);
}
function changeAttrPricePopup(attr){
	var sale_price = $('#original_sale_price').val();
//	var old_price = $('#attr_'+attr).data('price');
	var attr_price = $('.attr_'+attr).val();
	if(attr_price == 0){
		attr_price = sale_price;
	}
//	var new_price = (parseInt(sale_price)-parseInt(old_price))+parseInt(attr_price);
//	$('#price').val(new_price);
	$('#price').val(attr_price);
//	$('#attr_'+attr).data('price',attr_price);
//	$('p.prices').find('span').text(new_price);
	$('p.prices').find('span').text(attr_price);
	$('p.price').find('span.popup_price').text(attr_price);
}
function changeAttrArr(attr){
	var attr_val = $('#attr_'+attr+' :selected').text();
	var attrStr = $('#attribute_values').val();
	var attrArr = attrStr.split("|");
	
	if(attrArr == ''){
		attrArr = new Array();
	}
	attrArr[attr] = attr_val;
//	$('#attribute_values').val(attrArr[]);
}
</script>
<style>
.feature-selected i.feature_icon{
	background-position: -45px -80px !important;
}
.own-selected i.won_icon{
	background-position: -77px -58px !important;
}
</style>
<?php
$this->load->view('site/templates/footer');
?>