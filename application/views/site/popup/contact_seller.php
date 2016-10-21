<?php 
if(isset($productDetails) && $this->uri->segment(1) == 'things'){
?>
<!-- Contact Seller Form -->
<div class="popup contact_frm" style="display:none;">
	<div class="popup_wrap">
		
		<h3 class="stit"><?php if($this->lang->line('product_contact_seller') != '') { echo stripslashes($this->lang->line('product_contact_seller')); } else echo "Contact Seller"; ?></h3>
     <fieldset class="frm">
     	<ul class="popup_login_box">
        	<li>
            	<label><?php if($this->lang->line('product_questions') != '') { echo stripslashes($this->lang->line('product_questions')); } else echo "Question"; ?><font color="red">*</font></label>
				<textarea name="question" id="question" style="width:92%;"></textarea>
                <span id="div_question"></span>
			</li>
            <li>
            	<ul>
                <li>
                    <label><?php if($this->lang->line('signup_full_name') != '') { echo stripslashes($this->lang->line('signup_full_name')); } else echo "Name"; ?><font color="red">*</font></label>
                    <input type="text" name="name" class="fullname" <?php if ($loginCheck != ''){?>value="<?php if ($userDetails->row()->full_name != ''){echo $userDetails->row()->full_name;}else {echo $userDetails->row()->user_name;}?>"<?php }?> id="name" />
                     <span id="div_name"></span>
                </li>
                <li>
                	<label><?php if($this->lang->line('signup_emailaddrs') != '') { echo stripslashes($this->lang->line('signup_emailaddrs')); } else echo "Email Address"; ?><font color="red">*</font></label>
                    <input type="text" name="emailaddress" class="email" <?php if ($loginCheck!=''){?>value="<?php echo $userDetails->row()->email;?>"<?php }?> id="emailaddress" />
                     <span id="div_emailaddress"></span>
				</li>
                </ul>
			</li>
            <li>
            <label><?php if($this->lang->line('checkout_phone_no') != '') { echo stripslashes($this->lang->line('checkout_phone_no')); } else echo "Phone No"; ?></label>
                    <input type="text" name="phoneNumber" class="phoneNumber" id="phoneNumber" />
                    <span id="div_phoneNumber"></span>
            </li>
            
            <li>
            <input type="hidden" name="selleremail" id="selleremail" value="<?php echo $productDetails->row()->selleremail; ?>" />
            <input type="hidden" name="productId" id="productId" value="<?php echo $productDetails->row()->id;?>">
            <input type="hidden" name="sellerid" id="sellerid" value="<?php echo $productDetails->row()->sellerid; ?>" />
				<button class="btns-blue-embo btn-create sign" style="width: 150px;" onclick="javascript:ContactSeller();" from_popup="true" ><?php if($this->lang->line('product_submit') != '') { echo stripslashes($this->lang->line('product_submit')); } else echo "Submit"; ?></button>
                <div id="loadingImgContact" style="display:none;"><img src="images/loading.gif" alt="Loading..." /></div>
            </li>
            </ul>
                
                
                
      
            </fieldset>
		<button style="height: 38px;" title="Close" class="ly-close"><i class="ic-del-black"></i></button>
	</div>
</div>
<style>
/***** Contact Form *****/

.contact_frm .popup_wrap{
	background: none repeat scroll 0 0 #FFFFFF;
    margin: 0 auto;
    width: 650px;
	-moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px;
	position: relative;
}
.contact_frm .popup_wrap h3{cursor:auto;}
.contact_frm .popup_wrap .ly-close{
	-moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px;
}
.contact_frm .popup_wrap .frm{
	padding:15px;
	-moz-border-radius:0px 0px 10px 10px;-webkit-border-radius:0px 0px 10px 10px;border-radius:0px 0px 10px 10px;
}
.contact_frm .popup_login_box{
	float:left;
	width:100%;
}
.contact_frm .popup_login_box li{
	float:left;
	width:100%;
	margin-bottom:10px;
}
.contact_frm .popup_login_box li ul{
	float:left;
	width:100%;
}
.contact_frm .popup_login_box li ul li{
	float:left;
	width:48%;
}
.contact_frm .popup_login_box label{
	float:left;
	width:100%;
	font-size: 13px;
    font-style: normal;
    line-height: 18px;
}


.contact_frm .popup_login_box span{
	float:left;
	width:100%;
	color:#FF0000;
    font-style: normal;
}

/************************/
</style>
<?php }?>