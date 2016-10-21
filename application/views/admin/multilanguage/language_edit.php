<?php
$this->load->view('admin/templates/header.php');
 if (is_file('./fc_smtp_settings.php'))
{
	include('fc_smtp_settings.php');
}

?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Language - <?php echo $selectedLanguage;?></h6>
					</div>
					<div class="widget_content">
                    <label class="error" style="font-size:18px;">Note: Dont Edit The Values Inside Of Curly Braces Eg: {SITENAME}</label>
                    <p style="font-size:12px;">Eg: Join {SITENAME} today  ---  Rejoignez {SITENAME} aujourd'hui</p>
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'languageEdit');
						echo form_open('admin/multilanguage/languageAddEditValues',$attributes) 
					?>
                     <input type="hidden" value="<?php echo $selectedLanguage;?>" name="selectedLanguage"/>
	 						<ul>                            
                            
                            	<?php
									$loopNumber = 0;
									foreach($file_key_values as $language_keys_item)
									{									
										if($loopNumber != '0') {
									?>
                            
								<li>
                                      <div class="form_grid_12">
                                        <label class="field_title" for="language_vals<?php echo $loopNumber;?>"><?php echo stripslashes($file_lang_values[$loopNumber]); ?> <span class="req">*</span></label>
                                        <div class="form_input">
                                          <input name="language_vals[]" id="language_vals<?php echo $loopNumber;?>" value="<?php  echo stripslashes($this->lang->line($language_keys_item)); ?>"  type="text" tabindex="1" class="required large tipTop" title="Please enter the language"/>
                                          <input name="languageKeys[]" value="<?php echo stripslashes($language_keys_item); ?>" id="smtp_host" type="hidden" tabindex="1" class="required large tipTop" title="Please enter the language"/>                                          
                                        </div>
                                      </div>
                                    </li>
                                    
								<?php 
									}
									$loopNumber = $loopNumber+1;} 
                                ?>
								
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                     	
										<button type="submit" class="btn_small btn_blue"><span>Save</span></button>
									</div>
								</div>
								</li>
							</ul>
                           
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
