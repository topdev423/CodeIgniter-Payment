<?php
$this->load->view('admin/templates/header',$this->data);
?>
<style>
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
.notifications{
	float: left;
	width: 940px;
	background-color: white;
	padding: 20px;
	margin: 20px;
	box-shadow: 0px 0px 10px rgb(213, 190, 190);
}
ol.commentContainer{
	height: 200px;
	overflow: scroll;
	width: 930px;
}
li.comment{
	position: relative;
	padding: 17px 0 12px 43px;
	z-index: 1;
	min-height: 20px;
	border-bottom: 1px solid #ECEEF4;
	clear: both;
	margin-top:10px;
}
li.comment span.vcard{
	font-weight: bold;
	top: -4px;
	position: absolute;
	left: 0;
	z-index: 1;
	float: none;
}
a.url img{
	margin: 4px 4px 0 0;
	display: inline-block;
	float: none;
	max-width: 33px;
	max-height: 33px;
	border-radius: 3px;
	vertical-align: top;
}
span.nickname{
	color: #2a5f95;
	padding: 2px 0 0 6px;
	display: inline-block;
	font-size: 13px;
	line-height: 18px;
	font-style: normal;
}
li.comment p.c-text{
	font-size: 13px;
	position: relative;
	z-index: 2;
	display: inline-block;
	vertical-align: middle;
	line-height: 18px;
	padding: 0;
	margin: 1px 0;
	color: #3a3d41;
	word-break: normal;
}
li.comment p:last{
	font-size: 10px;
	font-style: italic;
	color: green;
	padding: 0;
	line-height: 18px;
	margin: 0;
}
</style>
		


	<div id="content">
		
		<div class="notifications altered">
		<?php if ($order_details->num_rows()>0){
		$subTotal = $order_details->row()->total-($order_details->row()->tax+$order_details->row()->shippingcost)+$order_details->row()->discountAmount;
		?>
			<div class="review_top">
				<p class="fl"><span class="r_left fl">Order Id : </span><span class="fl">#<?php echo $order_details->row()->dealCodeNumber;?></span></p>
				<p class="fr"><span class="r_left fl">Sub Total : </span><span class="fl"><?php echo $currencySymbol.number_format($subTotal,2);?></span></p>
				<div style="clear: both;"></div>
				<p class="fl"><span class="r_left fl">Order Date : </span><span class="fl"><?php echo $order_details->row()->created;?></span></p>
				<p class="fr"><span class="r_left" style="clear:both;">Discount : </span><span class=""><?php echo $currencySymbol.$order_details->row()->discountAmount;?></span></p>
				<p class="fr" style="width:100%;text-align:right;"><span class="r_left" style="clear:both;">Shipping : </span><span class=""><?php echo $currencySymbol.$order_details->row()->shippingcost;?></span></p>
				<p class="fr" style="width:100%;text-align:right;"><span class="r_left" style="clear:both;">Tax : </span><span class=""><?php echo $currencySymbol.$order_details->row()->tax;?></span></p>
				<p class="fr" style="width:100%;text-align:right;"><span class="r_left" style="clear:both;">Grand Total : </span><span class=""><?php echo $currencySymbol.$order_details->row()->total;?></span></p>
			</div>
<!-- 			<hr class="review_hr"> -->
		<?php 
		foreach ($order_details->result() as $orderRow){
			if ($prod_details[$orderRow->product_id]->num_rows()==1){
				$prodImg = 'dummyProductImage.jpg';
				$imgArr = array_filter(explode(',', $prod_details[$orderRow->product_id]->row()->image));
				if (count($imgArr)>0){
					$prodImg = $imgArr[0];
				}
		?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:left;border:1px solid #cecece; width:99.5%;">
		        <tbody>
			        <tr bgcolor="#f3f3f3">
			        	<td width="14%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Image</span></td>
			            <td width="42%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
			            <td width="8%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
			            <td width="10%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
			            <td width="10%" style="text-align:center;border-right:1px solid #cecece;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
			            <td width="20%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Received Status</span></td>
			         </tr><tr>
			            <td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="<?php echo base_url();?>images/product/<?php echo $prodImg;?>" alt="<?php echo $prod_details[$orderRow->product_id]->row()->product_name;?>" width="70"></span></td>
						<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $prod_details[$orderRow->product_id]->row()->product_name;?>
						<?php if($orderRow->attr_name !='' || $orderRow->attr_type){ echo '<br>'.$orderRow->attr_type.' / '.$orderRow->attr_name;}?>
						</span></td>
			            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $orderRow->quantity;?></span></td>
			            <td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $currencySymbol.$orderRow->price;?></span></td>
			            <td style="text-align:center;border-top:1px solid #cecece;border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $currencySymbol.$orderRow->sumtotal;?></span></td>
			            <td style="text-align:center;border-top:1px solid #cecece;">
			            <?php if ($view_mode=='user'){?>
			            	<select style="margin: 10px;border:1px solid;" onchange="javascript:changeReceivedStatus(this,'<?php echo $orderRow->id;?>')">
	                        	<option <?php if ($orderRow->received_status == 'Not received yet'){echo 'selected="selected"';}?> value="Not received yet"><?php if($this->lang->line('order_not_received_yet') != '') { echo stripslashes($this->lang->line('order_not_received_yet')); } else echo "Not received yet"; ?></option>
	                        	<option <?php if ($orderRow->received_status == 'Product received'){echo 'selected="selected"';}?> value="Product received"><?php if($this->lang->line('order_product_received') != '') { echo stripslashes($this->lang->line('order_product_received')); } else echo "Product received"; ?></option>
<!-- 	                        	<option <?php if ($orderRow->received_status == 'Need refund'){echo 'selected="selected"';}?> value="Need refund"><?php if($this->lang->line('order_need_refund') != '') { echo stripslashes($this->lang->line('order_need_refund')); } else echo "Need refund"; ?></option> -->
	                        </select>
	                        <img alt="Loading" style="display: none;margin-top:20px;" class="status_loading_<?php echo $row->dealCodeNumber;?>" src="images/site/ajax-loader.gif"/>
	                    <?php }else {?>
	                    	<span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><?php echo $orderRow->received_status;?></span>
	                    <?php }?>    
			            </td>
			        </tr>
		        </tbody>
	        </table>
	        <div class="review_comments" style="float: left;">
	        	<h2>Comments</h2>
	        	 <?php 
	        	 if ($order_comments->num_rows()>0){
	        	 ?>
	        	 <section class="comments comments-list comments-list-new">
		        	 <ol class="commentContainer">
		        	 <?php 
		        	 $cmt_count = 0;
		        	 foreach ($order_comments->result() as $cmt_row){
		        	 	if ($cmt_row->product_id == $orderRow->product_id){
		        	 		$cmt_count++;
			        	 	$comment_from = $cmt_row->comment_from;
		        	 		if ($comment_from == 'user'){
		        	 			$comment_from = 'Buyer';
		        	 		}
			        	 	$cmtTime = strtotime($cmt_row->date);
			        	 	$cmt_time = timespan($cmtTime).' ago';
			        	 	$userImg = 'user-thumb.png';
			        	 	if ($comment_from == 'admin'){
				        	 	$userImg = 'user_thumb.png';
			        	 	}else if ($comment_from == 'seller'){
				        	 	$userImg = 'user-thumb1.png';
			        	 	}
		        	 ?>
		        		 <li class="comment" style="position: relative;padding: 17px 0 12px 43px;z-index: 1;min-height: 20px;">
							<a class="milestone" id="comment-1866615"></a>
							<span class="vcard">
								<a class="url">
									<img src="images/users/<?php echo $userImg;?>" alt="" class="photo">
									<span class="fn nickname"><?php echo ucfirst($comment_from);?></span>
								</a>
							</span>
							<p class="c-text" style="font-size:13px;"><?php echo $cmt_row->comment;?></p>
							<p style="font-size: 10px;font-style:italic;color:green;"><?php echo $cmt_time;?></p>
						</li>
					<?php 
		        	 	}
		        	 }
					?>	
					</ol>
				</section>
				<?php 
				if ($cmt_count==0){
				?>
				<p style="margin: 10px 0 0;color: #0F6697;"><i>No comments available</i></p>
				<?php 	
				}
	        	 }else {
				?>
				<p style="margin: 10px 0 0;color: #0F6697;"><i>No comments available</i></p>
				<?php }?>
				<div style="margin:20px 0;float:left;">
					<form action="javascript:void(0)" onsubmit="post_order_comment_admin('<?php echo $orderRow->product_id;?>','<?php echo $order_details->row()->dealCodeNumber;?>')" method="post">
	                    <textarea class="text order_comment_<?php echo $orderRow->product_id;?>" name="comments" placeholder="<?php if($this->lang->line('header_write_comment') != '') { echo stripslashes($this->lang->line('header_write_comment')); } else echo "Write a comment"; ?>..." id="comments"></textarea><br />
	                    <input type="submit" class="submit button" value=" <?php if($this->lang->line('header_post_comment') != '') { echo stripslashes($this->lang->line('header_post_comment')); } else echo "Post Comment"; ?> " />
	                    <img alt="loading" src="images/site/loading.gif" style="display: none;"/>
	                </form>
                </div>
	        </div>
	      <?php 
			}
		}
	      ?>  
	       <?php }else{?>
	       <h3>Reviews not available</h3>
	       <?php }?> 
		</div>
		
	</div>
   		

	<!-- / container -->
<?php
$this->load->view('admin/templates/footer',$this->data);
?>
