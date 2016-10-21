<?php if ($loginCheck != ''){?>

<!-- add_rating overlay -->
<div id="add-rating-new" style="display:none;" show_when_fancy="<?php if ($userDetails->row()->display_lists == 'Yes'){echo 'true';}else {echo 'false';}?>" class="popup ly-title update add-rating animated" style="margin-top: 5px; margin-left: 750.5px; opacity: 1; display: block;" tid="">
    <div id="rating-container" class="default" style="display: block;">
        <p class="ltit"><?php if($this->lang->line('header_add_rating') != '') { echo stripslashes($this->lang->line('header_add_rating')); } else echo "Rate it"; ?></p>
        <button class="ly-close" type="button"><i class="ic-del-black"></i></button>
        <div class="fancyd-item">
            <div class="image-wrapper">
                <div class="item-image"><img src="images/site/product-3.jpg"></div>
            </div>
            <div class="rating-message-container">
                <div class="rating-success-message">
                    <p>Success</p>
                    <img width="45" src="images/mark-tick.png" alt="" style="padding: 0 5px;">
                    <span>Thank you for rating!</span>
                </div>
            </div>
            <div class="item-categories">
                <form action="#">
                    <input type="hidden" value="0" class="popup_product_id" />
                    <fieldset class="list-categories">
                        <div class="list-box">
                        
                            <div id="rating-stars-cont" class="stars stars-example-fontawesome-o">
                                <select id="example-fontawesome-o" name="rating" data-current-rating="0">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <div class="rating-numbers">
                                    <span class="title current-rating">
                                        <span class="value">0</span>
                                    </span>
                                    <span class="title your-rating hidden">
                                        <span class="value active-rating br-current-rating">0</span>/10
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </fieldset>
                    <fieldset class="new-list">
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="btn-area">
                <button class="btn-add-to-list btn-done" type="button"><?php if($this->lang->line('header_done') != '') { echo stripslashes($this->lang->line('header_done')); } else echo "Done"; ?></button>
                <a class="learn-more" href="<?php echo base_url('pages/ratings'); ?>">Learn more about rating system</a>
                <button class="btn-want clear-rating" type="button"><b><?php if($this->lang->line('header_reset') != '') { echo stripslashes($this->lang->line('header_reset')); } else echo "Reset"; ?></b></button>
                <div class="set-dropdown" style="display: none;">
                    <ul>
                        <li><a class="btn-create-list" href="#"><?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?></a></li>
                    </ul>
                    <div class="hr"></div>
                    <ul>
                        <li><a href="settings/preferences"><?php if($this->lang->line('header_list_settings') != '') { echo stripslashes($this->lang->line('header_list_settings')); } else echo "List Settings"; ?></a></li>
                    </ul>
                </div>
            </div>
    </div>
</div>
<!-- /add_rating overlay -->

<!-- add_to_list overlay -->
<div id="add-to-list-new" style="display:none;" show_when_fancy="<?php if ($userDetails->row()->display_lists == 'Yes'){echo 'true';}else {echo 'false';}?>" class="popup ly-title update add-to-list animated" style="margin-top: 5px; margin-left: 750.5px; opacity: 1; display: block;" tid="">
    <div class="add_to_list default" style="display: block;">
        <p class="ltit"><?php if($this->lang->line('header_add_list') != '') { echo stripslashes($this->lang->line('header_add_list')); } else echo "Add to List"; ?></p>
        <button class="ly-close" type="button"><i class="ic-del-black"></i></button>
        <div class="fancyd-item">
            <div class="image-wrapper">
                <div class="item-image"><img src="images/site/product-3.jpg"></div>
            </div>
            <div class="item-categories">
                <form action="#">
                    <fieldset class="list-categories">
                    <div class="list-box">
                    <ul></ul>
                    </div>
                    </fieldset>
                    <fieldset class="new-list">
                        <i class="ic-plus"></i>
                        <input type="text" placeholder="<?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?>" id="quick-create-list" name="list_name">
                        <button class="btn-create" type="submit" style="display: none;"><?php if($this->lang->line('header_create') != '') { echo stripslashes($this->lang->line('header_create')); } else echo "Create"; ?></button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="btn-area">
                <button class="btn-add-to-list btn-done" type="button"><?php if($this->lang->line('header_done') != '') { echo stripslashes($this->lang->line('header_done')); } else echo "Done"; ?></button>
                <button id="i-want-this" class="btn-want" type="button"><i class="ic-plus"></i> <b><?php if($this->lang->line('header_want') != '') { echo stripslashes($this->lang->line('header_want')); } else echo "Want"; ?></b></button>
                <a class="btn-set" href="#"><i class="ic-setting"></i><span class="hidden"><?php if($this->lang->line('header_settings') != '') { echo stripslashes($this->lang->line('header_settings')); } else echo "Settings"; ?></span><i class="ic-arrow"></i></a>
                <div class="set-dropdown" style="display: none;">
                    <ul>
                        <li><a class="btn-create-list" href="#"><?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?></a></li>
                    </ul>
                    <div class="hr"></div>
                    <ul>
                        <li><a href="settings/preferences"><?php if($this->lang->line('header_list_settings') != '') { echo stripslashes($this->lang->line('header_list_settings')); } else echo "List Settings"; ?></a></li>
                    </ul>
                </div>
            </div>
    </div>
    <div style="display: none;" class="create-list">
        <p class="ltit"><?php if($this->lang->line('header_create_nwlist') != '') { echo stripslashes($this->lang->line('header_create_nwlist')); } else echo "Create New List"; ?></p>
        <button title="Close" class="close cancel"><i class="ic-del-black"></i></button>
        <form loid="14528007">
        <fieldset>
            <div class="frm">
                <p><b class="stit"><?php if($this->lang->line('header_title') != '') { echo stripslashes($this->lang->line('header_title')); } else echo "Title"; ?></b> <input type="text" placeholder="<?php if($this->lang->line('header_enter_title') != '') { echo stripslashes($this->lang->line('header_enter_title')); } else echo "Enter a title"; ?>" class="right" name="list_name"></p>
                
            </div>
            <?php if ($mainCategories->num_rows()>0){?>
            <div class="frm">
                <p>
                    <b class="stit"><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></b>
                    <select class="right" id="categories-for-new-list" name="category_id">
                    <option value="0"><?php if($this->lang->line('header_select_cate') != '') { echo stripslashes($this->lang->line('header_select_cate')); } else echo "Select category"; ?></option>
                    <?php 
                      foreach ($mainCategories->result() as $row){
                          if ($row->cat_name != ''){
                      ?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->cat_name;?></option>
                    <?php 
                          }
                      }
                    ?>
                    </select>
                </p>
            </div>
            <?php }?>
             
            <div class="frm">
                <b class="stit"><?php if($this->lang->line('header_contributors') != '') { echo stripslashes($this->lang->line('header_contributors')); } else echo "Contributors"; ?></b>
                <div class="right">
            <ul class="user-list">
                        <li>
                        <?php 
                        $img = 'user-thumb1.png';
                        if ($userDetails->row()->thumbnail != ''){
                            $img = $userDetails->row()->thumbnail;
                        }
                        ?>
                            <img alt="<?php echo $userDetails->row()->user_name;?>" src="images/users/<?php echo $img;?>">
                            <span class="left"><b><?php echo $userDetails->row()->full_name;?></b><?php echo $userDetails->row()->user_name;?></span>
                            <span class="right"><?php if($this->lang->line('header_cretor') != '') { echo stripslashes($this->lang->line('header_cretor')); } else echo "Creator"; ?></span>
                        </li>
                        <script id="tpl-invite-user-list" type="fancy/template">
                            &lt;li data-id="##id##"&gt;&lt;img src="##image_url##"&gt;&lt;span class="left"&gt;&lt;b&gt;##fullname##&lt;/b&gt;##username##&lt;/span&gt;&lt;span class="right"&gt;&lt;a href="#"&gt;&lt;i class="ic-del"&gt;&lt;/i&gt;&lt;span class="hidden"&gt;Delete&lt;/span&gt;&lt;/a&gt;&lt;/span&gt;&lt;/li&gt;
                        </script>
                    </ul>
                 </div>
            </div>

        </fieldset>
        <div class="btn-area">
            <button class="btn-create" type="submit"><?php if($this->lang->line('header_create_list') != '') { echo stripslashes($this->lang->line('header_create_list')); } else echo "Create list"; ?></button>
            <button class="cancel" type="button"><?php if($this->lang->line('header_cancel') != '') { echo stripslashes($this->lang->line('header_cancel')); } else echo "Cancel"; ?></button>
        </div>
        </form>
    </div>
</div>
<!-- /add_to_list overlay -->

<!-- change photo -->
<div style="margin-top: 218px; margin-left: 770.5px; opacity: 1; display: none;" class="popup change-photo none animated">
    <form id="form-photo" method="post" action="site/user_settings/change_photo" enctype="multipart/form-data">
    <p class="ltit"><?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?></p>
    <div class="photoframe">
        <div class="uploading">
            <span><?php if($this->lang->line('settings_uploading') != '') { echo stripslashes($this->lang->line('settings_uploading')); } else echo "Uploading..."; ?></span>
        </div>
        <img id="uploaded-photo" src="images/site/blank.gif" style="background-image:url('images/users/<?php if ($userDetails->row()->thumbnail == ''){ echo 'user-thumb1.png';}else { echo $userDetails->row()->thumbnail;}?>');" alt="">
        <a href="#" id="delete_profile_image"><?php if($this->lang->line('header_delete_photo') != '') { echo stripslashes($this->lang->line('header_delete_photo')); } else echo "Delete Photo"; ?></a>
    </div>
    <div class="frm">
        <p><?php if($this->lang->line('header_allow_types') != '') { echo stripslashes($this->lang->line('header_allow_types')); } else echo "Allowed file types JPG or PNG. Maximum width and height 600px"; ?></p>
        <div class="file_input_div">
            <button class="file_input_button"><?php if($this->lang->line('header_choose_file') != '') { echo stripslashes($this->lang->line('header_choose_file')); } else echo "Choose file"; ?></button>
            <input id="fileName" class="file_input_textbox" readonly="readonly" placeholder="<?php if($this->lang->line('header_no_file') != '') { echo stripslashes($this->lang->line('header_no_file')); } else echo "No file has been selected"; ?>" type="text">
            <input id="uploadavatar" name="upload-file" class="file_input_hidden" onChange="document.getElementById('fileName').value = this.value.split(/[/\\]/).reverse()[0]" type="file">
        </div>
    </div>
    <div class="btn-area">
        <button id="save_profile_image" class="btns-blue-embo"><?php if($this->lang->line('header_up_photo') != '') { echo stripslashes($this->lang->line('header_up_photo')); } else echo "Upload Photo"; ?></button>
    </div>
    <button class="ly-close" title="Close"><i class="ic-del-black"></i></button>
    </form>
</div>
<!-- /change photo -->
<?php }?>