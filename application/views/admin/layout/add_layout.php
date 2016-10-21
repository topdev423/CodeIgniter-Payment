<?php $this->load->view('admin/templates/header.php');?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add Layout</h6>
                        <div id="widget_tab">
              				<ul>
               			
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
                    <form action="admin/layout/insertEditLayout" method="post" onsubmit="return addLayout();" class = "form_container left_label" >
                     <div id="tab1">
						<ul>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Place<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="place" id="place" tabindex="9" class="large tipTop" onkeyup="removeError(this.id);"  title="Please enter the Welcome Text" /> <span style="color:#F00;" class="redFont" id="place_Err"></span> 
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Description<span class="req">*</span></label>
								<div class="form_input">
								<input type="text" name="text" id="text" tabindex="9" onkeyup="removeError(this.id);" class="large tipTop" title="Please enter the Welcome Tags" /></span>	<span style="color:#F00;" class="redFont" id="price_to_Err"></span><span style="color:#F00;" class="redFont" id="text_Err"></span>
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
function addLayout(){

var place = $('#place').val();
var text = $('#text').val();

if(place==''){
	$('#place_Err').html('This field required');	
				return false;
}else if(text==''){
$('#text_Err').html('This field required');	
					return false;
}else{
return ture; 
}
}
	function removeError(idval){
       $("#"+idval+"_Err").html('');
	   }
	
</script>