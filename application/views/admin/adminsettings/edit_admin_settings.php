<?php
$this->load->view('admin/templates/header.php');
?>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_wrap tabby">
          <div class="widget_top"> <span class="h_icon list"></span>
            <h6>Global Site Configuration</h6>
            <div id="widget_tab">
              <ul>
                <li><a href="#tab1" class="active_tab">Admin Settings</a></li>
                <li><a href="#tab2">Social Media Settings</a></li>
                <li><a href="#tab3">Google Webmaster & SEO</a></li>
              </ul>
            </div>
          </div>
          <div class="widget_content">
            <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form', 'enctype' => 'multipart/form-data');
				echo form_open_multipart('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="main_settings"/>
            <div id="tab1">
              <ul>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="admin_name">Admin Name <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="admin_name" value="<?php echo $admin_settings->row()->admin_name;?>" id="admin_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the admin username"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email">Email Address <span class="req">*</span></label>
                    <div class="form_input">
                      <input name="email" id="email" type="text" value="<?php echo $admin_settings->row()->email;?>" tabindex="2" class="required large tipTop" title="Please enter the admin email address"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="site_contact_mail">Site Contact Email</label>
                    <div class="form_input">
                      <input name="site_contact_mail" id="site_contact_mail" value="<?php echo $admin_settings->row()->site_contact_mail;?>" type="text" tabindex="3" class="large tipTop" title="Please enter the site contact email"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="email_title">Site Name</label>
                    <div class="form_input">
                      <input name="email_title" id="email_title" type="text" value="<?php echo $admin_settings->row()->email_title;?>" tabindex="4" class="large tipTop" title="Please enter the email title"/>
                    </div>
                  </div>
                </li>
				<li>
                  <div class="form_grid_12">
                    <label class="field_title" for="logo_image">Site Logo</label>
                    <div class="form_input">
                      <input name="logo_site" id="logo_site" type="file" tabindex="5" class="large tipTop" title="Please select the site logo"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->logo_site;?>" width="100px"/></div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="logo_image">Logo</label>
                    <div class="form_input">
                      <input name="logo_image" id="logo_image" type="file" tabindex="5" class="large tipTop" title="Please select the logo image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->logo_image;?>" width="100px"/></div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="fevicon_image">Favicon</label>
                    <div class="form_input">
                      <input name="fevicon_image" id="fevicon_image" type="file" tabindex="6" class="large tipTop" title="Please select the favicon image"/>
                    </div>
                    <div class="form_input"><img src="<?php echo base_url();?>images/logo/<?php echo $admin_settings->row()->fevicon_image;?>" width="50px"/></div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="footer_content">Footer Content</label>
                    <div class="form_input">
                      <input name="footer_content" id="footer_content" type="text" value="<?php echo htmlentities($admin_settings->row()->footer_content);?>" tabindex="7" class="large tipTop" title="Please enter the footer copyright content"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="like_text">Like Button Text</label>
                    <div class="form_input">
                      <input name="like_text" id="like_text" type="text" value="<?php echo htmlentities($admin_settings->row()->like_text);?>" tabindex="8" class="large tipTop" title="Please enter the text for like button"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="liked_text">Liked Button Text</label>
                    <div class="form_input">
                      <input name="liked_text" id="liked_text" type="text" value="<?php echo htmlentities($admin_settings->row()->liked_text);?>" tabindex="9" class="large tipTop" title="Please enter the text for liked button"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="unlike_text">Unlike Button Text</label>
                    <div class="form_input">
                      <input name="unlike_text" id="unlike_text" type="text" value="<?php echo htmlentities($admin_settings->row()->unlike_text);?>" tabindex="10" class="large tipTop" title="Please enter the text for unlike button"/>
                    </div>
                  </div>
                </li>                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="common_prefix">Site Common Prefix</label>
                    <div class="form_input">
                      <input name="common_prefix" id="common_prefix" type="text" value="<?php echo substr(SITE_COMMON_DEFINE,0,-1);?>" tabindex="10" class="large tipTop" title="Please enter the common prefix for css and js files"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="common_prefix">Https Enabled ?</label>
                    <div class="form_input">
                      <input name="https_enabled" id="https_enabled_yes" type="radio" value="yes" tabindex="11" class="tipTop" title="Select if https enabled" <?php if (HTTTPS_ENABLED=='yes'){?>checked='checked'<?php }?>/><label for="https_enabled_yes" style="cursor: pointer;">Yes</label>
                      <input name="https_enabled" id="https_enabled_no" type="radio" value="no" tabindex="12" class="tipTop" title="Select if https disabled" <?php if (HTTTPS_ENABLED=='no'){?>checked='checked'<?php }?>/><label for="https_enabled_no" style="cursor: pointer;">No</label>
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
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="social"/>
            <div id="tab2">
            
              <ul>
              <div class="form_grid_12">
              <label class="error">Note: To create google api refer this   <a href="http://www.saaraan.com/2012/10/creating-google-oauth-api-key" target="_blank">Reference Link</a>  </label>
              </div>
              <div class="form_grid_12">              
              <label class="error">Note: To create Facebook api click below url, click Apps then Create New App <a href="https://developers.facebook.com/" target="_blank">Facebook Link</a>  </label>
              </div>
               <div class="form_grid_12">              
              <label  class="error">Note: To create Twitter api refer this <a href="https://dev.twitter.com/discussions/631" target="_blank">Reference Link</a>  </label>
              </div>
              <div class="form_grid_12">
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_link">Facebook Link</label>
                    <div class="form_input">
                      <input name="facebook_link" id="facebook_link" type="text" value="<?php echo $admin_settings->row()->facebook_link;?>" tabindex="10" class="large tipTop" title="Please enter the site facebook url"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="twitter_link">Twitter Link</label>
                    <div class="form_input">
                      <input name="twitter_link" id="twitter_link" type="text" tabindex="11" value="<?php echo $admin_settings->row()->twitter_link;?>" class="large tipTop" title="Please enter the site twitter url"/>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="consumer_key">Twitter Consumer Key</label>
                    <div class="form_input">
                      <input name="consumer_key" id="consumer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->consumer_key;?>" class="large tipTop" title="Please enter the twitter consumer key"/>
                       <label class="error">Note: For Twitter Callback URL Copy This Url and Paste It.  - <?php echo base_url();?>twtest/callback </label>
                    </div>
                   
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="consumer_secret">Twitter Secret Key</label>
                    <div class="form_input">
                      <input name="consumer_secret" id="consumer_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->consumer_secret;?>" class="large tipTop" title="Please enter the twitter secret key"/>
                    </div>
                  </div>
                </li>
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_id">Google Client Id</label>
                    <div class="form_input">
                      <input name="google_client_id" id="google_client_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_id;?>" class="large tipTop" title="Please enter the google client id"/>
                    </div>
                  </div>
                </li>
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_redirect_url">Google Redirect Url</label>
                    <div class="form_input">
                      <input name="google_redirect_url" id="google_redirect_url" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_redirect_url;?>" class="large tipTop" title="Please enter the google redirect url"/>
                      <label class="error">Note: For Google Redirect Url Copy This Url and Paste It. - <?php echo base_url();?>googlelogin/googleRedirect </label>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_client_secret">Google Secret Key</label>
                    <div class="form_input">
                      <input name="google_client_secret" id="google_client_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_client_secret;?>" class="large tipTop" title="Please enter the google secret key"/>
                    </div>
                  </div>
                </li>
                
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_developer_key">Google Developer Key</label>
                    <div class="form_input">
                      <input name="google_developer_key" id="google_developer_key" type="text" tabindex="11" value="<?php echo $admin_settings->row()->google_developer_key;?>" class="large tipTop" title="Please enter the google developer key"/>
                    </div>
                  </div>
                </li>
                
                
                
                 <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_app_id">Facebook App ID</label>
                    <div class="form_input">
                      <input name="facebook_app_id" id="facebook_app_id" type="text" tabindex="11" value="<?php echo $admin_settings->row()->facebook_app_id;?>" class="large tipTop" title="Please enter the facebook app id"/>
                    </div>
                  </div>
                </li>
                
               <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="facebook_app_secret">Facebook App Secret</label>
                    <div class="form_input">
                      <input name="facebook_app_secret" id="facebook_app_secret" type="text" tabindex="11" value="<?php echo $admin_settings->row()->facebook_app_secret;?>" class="large tipTop" title="Please enter the facebook app secret"/>
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
             <?php 
				$attributes = array('class' => 'form_container left_label', 'id' => 'settings_form');
				echo form_open('admin/adminlogin/admin_global_settings',$attributes) 
			?>
			<input type="hidden" name="form_mode" value="seo"/>
            <div id="tab3">
              <ul>
               <li>
                  <h3>Search Engine Information</h3>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_title">Meta Title</label>
                    <div class="form_input">
                      <input name="meta_title" id="meta_title" type="text" value="<?php echo $admin_settings->row()->meta_title;?>" tabindex="1" class="large tipTop" title="Please enter the site meta title"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_keyword">Meta Keyword</label>
                    <div class="form_input">
                      <input name="meta_keyword" id="meta_keyword" type="text" value="<?php echo $admin_settings->row()->meta_keyword;?>" tabindex="2" class="large tipTop" title="Please enter the site meta keyword"/>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_description">Meta Description</label>
                    <div class="form_input">
                      <textarea name="meta_description" class="" cols="70" rows="5" tabindex="3"><?php echo $admin_settings->row()->meta_description;?></textarea>
                    </div>
                  </div>
                </li>
                <li>
                  <h3>Google Webmaster Info</h3>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="google_verification_code">Google Analytics Code</label>
                    <div class="form_input">
                      <textarea name="google_verification_code" class="input_grow tipTop" title="Copy google analytics code and paste here" cols="70" rows="5" tabindex="4"><?php echo $admin_settings->row()->google_verification_code;?></textarea>
                      <br />
                      <span>For Examples:
                      <pre><?php echo htmlspecialchars('<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([_setAccount, UA-XXXXX-Y]);
  _gaq.push([_trackPageview]);

  (function() {
    var ga = document.createElement(script); ga.type = text/javascript; ga.async = true;
    ga.src = (https: == document.location.protocol ? https://ssl : http://www) + .google-analytics.com/ga.js;
    var s = document.getElementsByTagName(script)[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>'); ?></pre>
                      </span> </div>
                  </div>
                </li>
                <li>
                  <div class="form_grid_12">
                    <label class="field_title" for="meta_keyword">Google HTML Meta Verifcation Code</label>
                    <div class="form_input">
                      <input name="google_verification" id="google_verification" value="<?php echo str_replace('"', "'",$admin_settings->row()->google_verification);?>" type="text" tabindex="5" class="large tipTop" title="Google HTMl Verification Code. Eg: <meta name='google-site-verification' content='XXXXX'>"/>
                      <span><br />
                      Google Webmaster Verification using Meta tag. <br />For more reference: <a href="https://support.google.com/webmasters/answer/35638#3" target="_blank">https://support.google.com/webmasters/answer/35638#3</a></span></div>
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
