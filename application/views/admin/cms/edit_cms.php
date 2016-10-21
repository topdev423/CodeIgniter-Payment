<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Edit Page</h6>
            <div id="widget_tab">
              <ul>
                <li><a href="#tab1" class="active_tab">Content</a></li>
                <li><a href="#tab2">SEO Details</a></li>
              </ul>
            </div>
          </div>
          <div class="widget_content">
            <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'adduser_form');
				echo form_open('admin/cms/insertEditCms',$attributes) 
			?>
            <div id="tab1">
              <ul>
              <?php if ($cms_details->row()->category == 'Sub'){?>
              	<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="parent">Select Main Page <span class="req">*</span></label>
                    <div class="form_input">
                      <select class="chzn-select required" name="parent" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select Main Page">
                      		<option value=""></option>
                      		<?php foreach ($cms_main_details->result() as $row){?>
                      		<option <?php if ($row->id == $cms_details->row()->parent){echo 'selected="selected"';}?> value="<?php echo $row->id;?>"><?php echo $row->page_name;?></option>
                      		<?php }?>
                      </select>
                    </div>
                  </div>
                </li>
               <?php }?>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="page_name">Page Name <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="page_name" id="page_name" type="text" value="<?php echo $cms_details->row()->page_name;?>" tabindex="2" class="required large tipTop" title="Please enter the page name"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="page_title">Page Title</label>
                    <div class="form_input">
                      <input name="page_title" id="page_title" type="text" value="<?php echo $cms_details->row()->page_title;?>" tabindex="3" class="large tipTop" title="Please enter the page title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description</label>
                    <div class="form_input">
                      <textarea name="description" tabindex="4" class="large tipTop mceEditor" title="Please enter the page content"><?php echo $cms_details->row()->description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
            <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="5"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
            <div id="tab2">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" value="<?php echo $cms_details->row()->meta_title;?>" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Tag</label>
                    <div class="form_input">
                      <input name="meta_tag" id="meta_tag" type="text" value="<?php echo $cms_details->row()->meta_tag;?>" tabindex="2" class="large tipTop" title="Please enter the page meta tag"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"><?php echo $cms_details->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
              </ul>
             <ul><li><div class="form_grid_12">
				<div class="form_input">
					<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
				</div>
			</div></li></ul>
			</div>
			<input type="hidden" name="cms_id" value="<?php echo $cms_details->row()->id;?>"/>
			<?php if ($cms_details->row()->category == 'Sub'){?>
				<input type="hidden" name="subpage" value="subpage"/>
			<?php }?>
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
