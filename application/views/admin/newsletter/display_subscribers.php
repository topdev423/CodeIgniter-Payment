<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<div id="content">
  <div class="grid_container">
    <?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/newsletter/change_newsletter_status_global',$attributes) 
			?>
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon blocks_images"></span>
          <h6><?php echo $heading?></h6>
          <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
            <?php if ($allPrev == '1' || in_array('2', $newsletter)){?>
            <div class="lenghtMenu" style="float:left; margin-top:7px;">
              <select id="mail_contents" data-placeholder="Select Email Template" name="mail_contents" style=" width:300px" class="chzn-select" tabindex="13">
              <option></option>
                <?php 
		  if ($NewsList->num_rows() > 0){
		  foreach ($NewsList->result() as $SendNews){ if($SendNews->id >11){?>
                <option value="<?php echo $SendNews->id;?>"><?php echo $SendNews->news_title; ?></option>
                <?php }}} ?>
              </select>
            </div>
            <div class="btn_30_light" style="height: 29px;"> <a href="javascript:void(0)" onclick="return SelectValidationAdmin('SendMailAll','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any template and click here to send email button"><span class="icon email_co"></span><span class="btn_link">Send Mail To All User</span></a> </div>
            <div class="btn_30_light" style="height: 29px;"> <a href="javascript:void(0)" onclick="return checkBoxWithSelectValidationAdmin('SendMail','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and select template click here to send email button"><span class="icon email_co"></span><span class="btn_link">Send</span></a> </div>
            <div class="btn_30_light" style="height: 29px;"> <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a> </div>
            <div class="btn_30_light" style="height: 29px;"> <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a> </div>
            <?php 
						}
						if ($allPrev == '1' || in_array('3', $newsletter)){
						?>
            <div class="btn_30_light" style="height: 29px;"> <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a> </div>
            <?php }?>
          </div>
        </div>
        <div class="widget_content">
          <table class="display" id="subscriber_tbl">
            <thead>
              <tr>
                <th class="center"> <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                </th>
                <th class="tip_top" title="Click to sort"> Email Address </th>
                <th class="tip_top" title="Click to sort"> Status </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php 
						if ($subscribersList->num_rows() > 0){
							foreach ($subscribersList->result() as $row){
						?>
              <tr>
                <td class="center tr_select "><input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
                </td>
                <td class="center"><?php echo $row->subscrip_mail;?> </td>
                <td class="center"><?php 
							if ($allPrev == '1' || in_array('2', $newsletter)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
                  <a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
                  <?php
								}else {	
							?>
                  <a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/newsletter/change_subscribers_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
                  <?php 
								}
							}else {
							?>
                  <span class="badge_style b_done"><?php echo $row->status;?></span>
                  <?php }?>
                </td>
                <td class="center"><!--<?php if ($allPrev == '1' || in_array('2', $newsletter)){?>
								<span><a class="action-icons c-edit" href="admin/users/edit_user_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/users/view_user/<?php echo $row->id;?>" title="View">View</a></span>-->
                  <?php if ($allPrev == '1' || in_array('3', $newsletter)){?>
                  <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/newsletter/delete_subscribers/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
                  <?php }?>
                </td>
              </tr>
              <?php 
							}
						}
						?>
            </tbody>
            <tfoot>
              <tr>
                <th class="center"> <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                </th>
                <th> Email Address </th>
                <th> Status </th>
                <th> Action </th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
      <input type="hidden" name="SubAdminEmail" id="SubAdminEmail" />
    <input type="hidden" name="statusMode" id="statusMode"/>
    </form>
  </div>
  <span class="clear"></span> </div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
