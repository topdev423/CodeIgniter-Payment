<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Add New Main Page</h6>
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
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="page_name">Page Name <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="page_name" id="page_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the page name"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="page_title">Page Title</label>
                    <div class="form_input">
                      <input name="page_title" id="page_title" type="text" tabindex="2" class="large tipTop" title="Please enter the page title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="description">Description</label>
                    <div class="form_input">
                      <textarea name="description" tabindex="3" class="large tipTop mceEditor" title="Please enter the page content"></textarea>
                    </div>
                  </div>
                </li>
                <li>
				<div class="form_grid_12">
					<label class="field_title" for="display_mode">Hidden Page<span class="req">*</span></label>
					<div class="form_input">
						<div class="yes_no">
							<input type="checkbox" tabindex="4" name="hidden_page" id="yes_no_yes" class="yes_no"/>
						</div>
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
                      <input name="meta_title" id="meta_title" type="text" tabindex="1" class="large tipTop" title="Please enter the page meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_tag">Meta Tag</label>
                    <div class="form_input">
                      <input name="meta_tag" id="meta_tag" type="text" tabindex="2" class="large tipTop" title="Please enter the page meta tag"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" id="meta_description" tabindex="3" class="large tipTop" title="Please enter the meta description"></textarea>
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
