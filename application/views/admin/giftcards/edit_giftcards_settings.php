<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Gift Cards Settings</h6>
          </div>
          <div class="widget_content">
            <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'giftsettings_form', 'enctype' => 'multipart/form-data');
				echo form_open_multipart('admin/giftcards/insertEditGiftcard',$attributes) 
			?>
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="title">Title <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="title" value="<?php echo $giftcards_settings->row()->title;?>" id="title" type="text" tabindex="1" class="required large tipTop" title="Please enter the title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description <span class="req">*</span></label>
                    <div class="form_input">
                      <textarea name="description" id="description"  tabindex="2" style="width:370px;" class="required small tipTop" title="Please enter the description"><?php echo $giftcards_settings->row()->description;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="gift_image">Image</label>
                    <div class="form_input">
                      <input name="gift_image" id="gift_image" type="file" tabindex="5" class="large tipTop" title="Please select the giftcard image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/giftcards/<?php echo $giftcards_settings->row()->image;?>" width="100px"/></div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="amounts">Amounts<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="amounts" class="required tags tipTop" style="display:none;" id="tags_Amt" type="text" value="<?php echo $giftcards_settings->row()->amounts;?>" tabindex="7"  title="Please enter the gift amounts"/>
                      <span class=" label_intro">Example : 10,20,30</span>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="default_amount">Default Amount<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="default_amount" id="default_amount" type="text" value="<?php echo $giftcards_settings->row()->default_amount;?>" tabindex="7" class="required large tipTop" title="Please enter the default amount"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="expiry_days">Expiry Days<span class="req">*</span></label>
                    <div class="form_input">
                      <input name="expiry_days" id="expiry_days" type="text" value="<?php echo $giftcards_settings->row()->expiry_days;?>" tabindex="7" class="required large tipTop" title="Please enter the expiry days"/>
                    </div>
                  </div>
                </li>
              </ul>
            <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
