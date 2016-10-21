<?php $this->load->view('admin/templates/header.php');?>
<style>
.add_no_button{
	padding: 3px;
	cursor: pointer;
	color: green;
	background-color: rgb(175, 218, 226);
	font-weight: bold;
}
.remove_no_button{
	padding: 3px;
	cursor: pointer;
	color: red;
	background-color: rgb(248, 179, 179);
	font-weight: bold;
}
</style>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Widget</h6>
                        <div id="widget_tab">
              				<ul>
               			
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
				
                    <form action="admin/footer/insertEditFooter" method="post" class = "form_container left_label" id="widget_form" enctype="multipart/form-data">
                     <div id="tab1">
						<ul>
                        <li>
								<div class="form_grid_12">
								<div class="form_input" style="margin:0 0 0 320px;">
                                								<label class="field_title" for="no_class_on">Title <span class="req">*</span></label>
									<input name="widget_title" id="widget_title" type="text" tabindex="1" class="large required no_class_on tipTop" onkeyup="removeError(this.id);"  title="Please enter title"/> <span style="color:#F00;" class="redFont" id="widget_title_Err"></span> <br /><br /><br />
                                    								<label class="field_title" for="no_class_on">Name</label>

									<input name="widget_name[]" id= '' type="text" tabindex="1" class="large no_class_on tipTop"   title="Please enter name"/><br /><br /><br />
                                    								<label class="field_title" for="no_class_on">Link</label>

									<input name="widget_link[]" type="text" tabindex="1" class="large no_class_on tipTop" title="Please enter link"/><br /><br /><br />
                                    								<label class="field_title" for="no_class_on">Icon</label>

									<input name="widget_icon[]" type="file" tabindex="1" class="large no_class_on tipTop"  title="Please choose icon"/><br /><br /><br />

									<input type="button" class="add_no_cls add_no_button" onclick="add_no_cls(this)" value="+ add new"/>
                                    

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


<script>
$('#widget_form').validate();
function addFooter()
{
	var widget_title = $('#widget_title').val();
	var id = $('#m').val();
	alert(id);
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
				'<label class="field_title" for="no_class_on">Icon</label>'+'<div class="uploader" id="uniform-undefined"><input name="widget_icon[]" type="file" tabindex="1" class="large no_class_on tipTop" size="19" style="opacity: 0;" original-title="Please choose icon"/><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div><br /><br /><br />'+'<input type="button" id ="clicked" name ="clicked" class="add_no_cls add_no_button" onclick="add_no_cls(this)" value="+ add new">'+
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
<script type="text/javascript">

</script>

