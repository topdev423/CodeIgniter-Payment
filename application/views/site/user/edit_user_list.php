<?php
$this->load->view('site/templates/header',$this->data);
?>
<link rel="stylesheet" href="css/site/<?php echo SITE_COMMON_DEFINE ?>timeline.css" type="text/css" media="all"/>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>profile.css" />


<script src="js/site/<?php echo SITE_COMMON_DEFINE ?>profile.js"></script>

<!-- Section_start -->
<div id="container-wrapper">
	<div class="container">
      <?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
  <div id="content" class="collaborative">
			<h2><?php if($this->lang->line('header_list_settings') != '') { echo stripslashes($this->lang->line('header_list_settings')); } else echo "List Settings"; ?></h2>
			<form action="site/user/edit_user_list_details" method="post" onsubmit="return listSettings();">
				<dl>
					<dt><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></dt>
					<dd><input id="setting-title" name="setting-title" type="text" value="<?php echo $list_details->row()->name;?>" class="text" /></dd>
				</dl>
				<dl>
					<dt><?php if($this->lang->line('header_contributors') != '') { echo stripslashes($this->lang->line('header_contributors')); } else echo "Contributors"; ?></dt>
					<dd>
						<ul class="contributors-list">
							<li><a href="user/<?php echo $user_profile_details->row()->user_name;?>"><span class="thum"><img src="images/users/<?php if ($user_profile_details->row()->thumbnail != ''){echo $user_profile_details->row()->thumbnail;}else {echo 'user-thumb1.png';}?>" alt="<?php echo $user_profile_details->row()->full_name;?>" /></span><?php echo $user_profile_details->row()->full_name;?></a><small><?php if($this->lang->line('header_cretor') != '') { echo stripslashes($this->lang->line('header_cretor')); } else echo "Creator"; ?></small></li>
							
						</ul>
				</dd>
				</dl>
				<dl>
					<dt><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></dt>
					<dd>
						<ul class="category-list">
							<?php if ($mainCategories->num_rows()>0){
								foreach ($mainCategories->result() as $row){
                      				if ($row->cat_name != ''){
							?>
							<li>
								<label for="<?php echo $row->id;?>">
									<input <?php if ($list_category_details->row()->id == $row->id){echo 'checked="checked"';}?> id="<?php echo $row->id;?>" name="category" type="radio" value="<?php echo $row->id;?>" > 
									<strong><?php echo $row->cat_name;?></strong>
								</label>
							</li>
						  	<?php 
                      				}
								}
							}
	                      	?>
						</ul>
					</dd>
				</dl>
				<div class="btn-area">
					<button class="button save" type="submit" lid='35155485' oid="15341005"><?php if($this->lang->line('header_save') != '') { echo stripslashes($this->lang->line('header_save')); } else echo "Save"; ?></button>
                    <a href="#" class="delete settings" id="show-delete-to-list" lid="<?php echo $list_details->row()->id;?>" uid="<?php echo $user_profile_details->row()->id;?>"><?php if($this->lang->line('edit_del_list') != '') { echo stripslashes($this->lang->line('edit_del_list')); } else echo "Delete list"; ?></a>
				</div>
				<input type="hidden" name="lid" value="<?php echo $list_details->row()->id;?>"/>
				<input type="hidden" name="uid" value="<?php echo $user_profile_details->row()->id;?>"/>
			</form>
		</div>
<script type="text/javascript">
function listSettings(){
	var title = $('#setting-title').val();
	$('#setting-title').parent().find('p').remove();
	if(title == ''){
		$('#setting-title').parent().append('<p style="color:red">List title required</p>');
		$('#setting-title').focus();
		return false;
	}
}
</script>
<?php
$this->load->view('site/templates/footer_menu');
$this->load->view('site/templates/footer');
?>