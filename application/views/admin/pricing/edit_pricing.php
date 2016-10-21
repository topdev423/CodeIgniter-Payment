<?php
$this->load->view('admin/templates/header.php');
$priceListVal= $this->data['EditpriceList']->result_array();


?>




<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
                        <div id="widget_tab">
              				<ul>
               			
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
                    <form action="admin/pricing/EditPricing" method="post" onsubmit="return addPricing();" class = "form_container left_label" >
                     <div id="tab1">
						<ul>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price Range From<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price_from" id="price_from" tabindex="9" class="large tipTop" onkeyup="removeError(this.id);"  value = "<?php echo $priceListVal[0]['pricing_from']; ?>" title="Please enter the product price" /> <span style="color:#F00;" class="redFont" id="price_from_Err"></span> 
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Price Range To<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="price_to" id="price_to" tabindex="9" onkeyup="removeError(this.id);"  value = "<?php echo $priceListVal[0]['pricing_to']; ?>" class="required large tipTop" title="Please enter the product price" /> <span style="color:#F00;" class="redFont" id="price_to_Err"></span> </span>	
								</div>
								</div>
							</li>
								
								
							</ul>
                     </div>
                      
                      
                      <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
                    <input type="hidden" name="price_id" value="<?php echo $priceListVal[0]['id']; ?>"/>  
                    <input type="hidden" name="userID" value="<?php if ($loginID != ''){echo $loginID;}else {echo '0';}?>"/>  
            
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
<script type="text/javascript">
function addPricing(){

var price_from = $('#price_from').val();
var price_to = $('#price_to').val();

if(!$.isNumeric(price_from)){
	$('#price_from_Err').html('Invalid price');	
				return false;
}else if(!$.isNumeric(price_to)){
$('#price_to_Err').html('Invalid price');	
				return false;
}else{
return ture; 
}
}
	function removeError(idval){
       $("#"+idval+"_Err").html('');
	   }
	
</script>