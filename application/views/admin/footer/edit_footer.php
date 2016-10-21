<?php
$this->load->view('admin/templates/header.php');
$EditfooterListVal= $this->data['EditfooterList']->result_array();
		$widget_name_array = array();
					$widget_link_array = array();
					$widget_icon_array = array();
					$widget_title_array = array();

 foreach($EditfooterListVal as $EditfooterListValss)
					{	
						//$widget_title_array[] = $DataFooterValss['widget_title'];
						$widget_name_array[] = explode("footsep",$EditfooterListValss['widget_name']);
						$widget_link_array[] = explode("footsep",$EditfooterListValss['widget_link']);
					$widget_icon_array[] = explode(",",$EditfooterListValss['widget_icon']);
					} 
					
					
					//print_r($widget_name_array); die;
					
					?>

 
	 							




<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Footer Widget</h6>
                        <div id="widget_tab">
              				<ul>
               			
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
                    <form action="admin/footer/EditFooter" method="post" enctype="multipart/form-data" onsubmit="return addFooter();" class = "form_container left_label" >
                     <div id="tab1">
						<ul>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Title<span class="req">*</span></label> 
								<div class="form_input">
								<input type="text" name="widget_title" id="widget_title" tabindex="9" class="large tipTop" onkeyup="removeError(this.id);"  value = " <?php echo $EditfooterListVal[0]['widget_title']; ?>" title="Please enter the Welcome Text" /> <span style="color:#F00;" class="redFont" id="widget_title_Err"></span>
								</div>
								</div>
							</li>
                            
                            <?php
									$loop_start_val =0;
									 foreach($widget_name_array as $widget_name_arrayVal){ 
										$loop_start_val_second =0 ;
											 foreach($widget_name_arrayVal as $widget_array_single){ ?>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Name</label>
								<div class="form_input">
								<input type="text" name="widget_name[]" id="widget_name" tabindex="9" onkeyup="removeError(this.id);"  value = "<?php echo $widget_name_array[$loop_start_val][$loop_start_val_second]; ?>" class="required large tipTop" title="Please enter the Welcome Tag" /> 
								</div>
								</div>
							</li>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Link</label>
								<div class="form_input">
								<input type="text" name="widget_link[]" id="widget_link" tabindex="9" onkeyup="removeError(this.id);"  value = "<?php echo $widget_link_array[$loop_start_val][$loop_start_val_second]; ?>" class="required large tipTop" title="Please enter the Welcome Tag" /> <span style="color:#F00;" class="redFont" id="place_Err"></span> </span>	
								</div>
								</div>
							</li>
                                <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Choose Icon</label>
								<div class="form_input">
							<input name="widget_icon[]"  type="file" tabindex="1" class="large no_class_on tipTop" title="Please choose icon"/>
								</div>
								</div>
							</li>
                            
                              <?php if($widget_icon_array[$loop_start_val][$loop_start_val_second]!=''){ ?>
                            <li>
								<div class="form_grid_12">
								<label class="field_title" for="description">Icon</label>
								<div class="form_input">
                              
								<img src="<?php echo FOOTERPATH.$widget_icon_array[$loop_start_val][$loop_start_val_second]; ?>" width = "100" height="100" title="<?php echo $widget_icon_array[$loop_start_val][$loop_start_val_second] ?>" /> 
                              
                                
                                
                             
								</div>
								</div>
							</li>
                            <?php }?>
						<input type="hidden" id ="widget_icons" name="widget_icons[]" value="<?php echo $widget_icon_array[$loop_start_val][$loop_start_val_second]; ?>"/>  
								   <?php $loop_start_val_second = $loop_start_val_second+1; } $loop_start_val = $loop_start_val+1; } ?>
								
							</ul>
                     </div>
                      
                      
                      <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
                    <input type="hidden" id ="footer_id" name="footer_id" value="<?php echo $EditfooterListVal[0]['id']; ?>"/>  
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
<script>
$('#widget_form').validate();
function addFooter()
{

	var widget_title = $('#widget_title').val();
	var id = $('#m').val();
	 //var res = str.split(" ",3); 
	if(widget_title==''){
		$('#widget_title_Err').html('This field required');	
					return false;
	}else{
					 
	}
}



	function removeError(idval){
       $("#"+idval+"_Err").html('');
	   }
		var i=2;
function add_no_cls(evt){

	var $li = $(evt).parent().parent().parent();
	

	$li.after(
			'<li>'+
			'<div class="form_grid_12">'+
			
			'<div class="form_input">'+
				'<label class="field_title" for="no_class_on">Name</label>'+'<input name="widget_name[]" type="text" tabindex="1"  class="large no_class_on tipTop" title="Please enter name"/><div class="clear"></div><br /><br /><br />'+
				'<label class="field_title" for="no_class_on">Link</label>'+'<input name="widget_link[]" type="text" tabindex="1" class="large no_class_on tipTop" title="Please enter link"/><br /><br /><br />'+
				'<label class="field_title" for="no_class_on">Icon</label>'+'<input name="widget_icon[]" type="file" tabindex="1" class="large no_class_on tipTop" title="Please choose icon"/><br /><br /><br />'+'<input type="button" id ="clicked" name ="clicked" class="add_no_cls add_no_button" onclick="add_no_cls(this)" value="add new">'+
				'<input type="button" class="add_no_cls remove_no_button" onclick="remove_no_cls(this)" value="- remove"/>'+
				'<input name="widget_hide_id" type="hidden" tabindex="1" value = '+i+' class="large no_class_on tipTop" title="Please choose icon"/>'+
			'</div>'+
			'</div>'+
		'</li>'
	);
	i= i+1;
					

}


function remove_no_cls(evt){
	$(evt).parent().parent().parent().remove();
}
</script>