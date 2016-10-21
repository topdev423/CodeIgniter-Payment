<?php
$this->load->view('site/templates/header',$this->data);
$ProductVal = $this->data['userVal']->result_array(); 


 ?>
<script src="js/jquery/jRating.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jRating.jquery.css" type="text/css" />	
<link rel="stylesheet" href="css/site/my-account.css" type="text/css" />	

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
ol.commentContainer{
	height: 200px;
	overflow: scroll;
	width: 900px;
}
</style>
<div id="container-wrapper">
	<div class="container notify" style="width:940px;">
		
<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>

	<div id="content">
        <h2><?php if($this->lang->line('product_feedback') != '') { echo stripslashes($this->lang->line('product_feedback')); } else echo "Product Feedback"; ?></h2>
        <div class="shop_text" style="width: 95%;">
		      <form  action = "site/user/add_user_product_feedback" method = "post" <?php if ($feedback_details->num_rows()>0){?>onSubmit="return false;"<?php }else{?>onSubmit="return AddFeedback();"<?php }?>>
          <label><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></label><span style="color:#F00; ">*</span> <span style="color:#F00;" class="redFont" id="title_Err"></span> 
			<div class="clear"></div>
               <input type="text" name="title" class="input-text" <?php if ($feedback_details->num_rows()>0){?>value="<?php echo $feedback_details->row()->title;?>" disabled="disabled" <?php }?> id="title" onkeyup="removeError(this.id);" />
           <div class="clear"></div>
		<label><?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?></label><span style="color:#F00; ">*</span> <span style="color:#F00;" class="redFont" id="description_Err"></span><div class="clear"></div>
				<textarea  id= "description" name= "description" <?php if ($feedback_details->num_rows()>0){?> disabled="disabled" <?php }?> onkeyup="removeError(this.id);"  maxlength="200" ><?php if ($feedback_details->num_rows()>0){ echo $feedback_details->row()->description; }?></textarea>
	<div class="feedback_rating">
                 <div class="rating-text">
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $ProductVal[0]['id'];?>" />	
					<input type="hidden" name="seller_id" id="seller_id" value="<?php echo $ProductVal[0]['user_id'];?>" />	
                    <input type="hidden" name="rate" id="rate" value="<?php echo $loginCheck; ?>" />	
                    <input type="hidden" name="path" id="path" value="<?php echo base_url(); ?>" />	
				
                		<label><?php if($this->lang->line('ur_rat_this_prod') != '') { echo stripslashes($this->lang->line('ur_rat_this_prod')); } else echo "Your rating for this product"; ?> </label><span style="color:#F00;">*</span> <span style="color:#F00;" class="redFont" id="rating_value_Err"></span>	

<div class="clear"></div>
<?php if ($feedback_details->num_rows()>0){?>
										<div class="rating_star">
                                            <div class="rat_star1" style="width:<?php echo $feedback_details->row()->rating*20; ?>%"></div>
                                        </div>
                                        <?php }else {?>
                <div class="exemple">
                    <?php if($loginCheck!=''){  ?>
						<div class="star_rating">    
							<div class="exemple5" data="10_5"  style="width:60%;"></div>
                        </div>    
                         <?php }else{ ?>   
						<div class="star_rating" style="height:35px;">    	                         
                         	<div style="cursor:pointer;"><img src="images/10stars.png" alt="stars" onclick="javascript:sivarating();" /></div>
                            <div id="PetVoteRate"></div>
						</div>	                            
					<?php } ?>
						</div>
						<?php }?>
					<div class="clear"></div><br />
				<input type="hidden" name="rating_value" id="rating_value"   />
                   </div>  

            </div>
<?php if ($feedback_details->num_rows()==0){?>
            <button type="submit" class="btn-blue-embo-add"><span><?php if($this->lang->line('add_feedback') != '') { echo stripslashes($this->lang->line('add_feedback')); } else echo "Add feedback"; ?></span></button>
<?php }else {?>
            <button type="submit" onclick="javascript:window.history.go(-1)" class="btn-blue-embo-add"><span><?php if($this->lang->line('signup_goback') != '') { echo stripslashes($this->lang->line('signup_goback')); } else echo "Go Back"; ?></span></button>
<?php }?>
                     </form>
		
	</div>
	</div>
   		
		<?php 
		$this->load->view('site/templates/footer_menu',$this->data);
		?>

	</div>
	<!-- / container -->
</div>

<script type="text/javascript">
		$(document).ready(function(){
			$('.exemple5').jRating({
				length:4.6,
				decimalLength:1,
				onSuccess : function(){
					alert('Success : your rate has been saved :)');
					//$("#rating_value_Err").hide();
				},
				onError : function(){
					alert('Error : please retry');
				}
			});
		});
	</script>
    
    
    <script>
	function removeError(idval){
       $("#"+idval+"_Err").html('');
	   }
	
    function AddFeedback()
	{
	var title = $('#title').val();
	var description = $('#description').val();
		var rating_value = $('#rating_value').val();

	if(title=='')
	{
			$('#title_Err').html('Title is required');	
				return false;
	}else if(description=='')
	{
		$('#description_Err').html('Description is required');	
				return false;
	} else if(rating_value=='')
	{
		$('#rating_value_Err').html('Plese choose stars for your feedback');	
				return false;
	}
	} 
    
    </script>
<?php
$this->load->view('site/templates/footer',$this->data);
?>
