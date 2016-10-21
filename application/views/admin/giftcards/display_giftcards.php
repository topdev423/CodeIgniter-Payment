<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/giftcards/change_giftcards_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php 
						if ($allPrev == '1' || in_array('2', $giftcards)){
							if ($giftcard_status == 'Enable'){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return disableGiftCards('admin/giftcards/change_giftcards_status/2','<?php echo $subAdminMail; ?>');" class="tipTop" title="click here to disable giftcards"><span class="icon delete_co"></span><span class="btn_link">Disable Giftcards</span></a>
							</div>
						<?php }else {?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return disableGiftCards('admin/giftcards/change_giftcards_status/1','<?php echo $subAdminMail; ?>');" class="tipTop" title="click here to enable giftcards"><span class="icon active_co"></span><span class="btn_link">Enable Giftcards</span></a>
							</div>
						<?php 
						}
						}
						if ($allPrev == '1' || in_array('3', $giftcards)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
					<div class="widget_content">
						<table class="display display_tbl" id="gift_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
								 Code
							</th>
							<th class="tip_top" title="Click to sort">
								 Value
							</th>
                            <th class="tip_top" title="Click to sort">
								 Used Amount
							</th>
							<th class="tip_top" title="Click to sort">
								 Recipient Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Recipient Email
							</th>
							<th class="tip_top" title="Click to sort">
								 Sender Name
							</th>
							<th class="tip_top" title="Click to sort">
								 Sender Email
							</th>
							<th class="tip_top" title="Click to sort">
								Created Date
							</th>
							<th class="tip_top" title="Click to sort">
								Expiry Date
							</th>
							<th class="tip_top" title="Click to sort">
								Card Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($giftCardsList->num_rows() > 0){
							foreach ($giftCardsList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->code;?>
							</td>
							<td class="center">
								<?php 
									echo $row->price_value;
								?>
							</td>
                            <td class="center">
								<?php 
									echo $row->used_amount;
								?>
							</td>
							<td class="center">
								<?php 
									echo $row->recipient_name;
								?>
							</td>
							<td class="center">
								<?php 
									echo $row->recipient_mail;
								?>
							</td>
							<td class="center">
								<?php 
									echo $row->sender_name;
								?>
							</td>
							<td class="center">
								<?php 
									echo $row->sender_mail;
								?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
							<td class="center">
								<?php echo $row->expiry_date;?>
							</td>
							<td class="center">
								<?php 
								$var1 = strtotime($row->expiry_date); 
								$var2 = strtotime(date('Y-m-d')); 
								
								if($var1 < $var2){
									echo 'expired';
								}else {
									echo $row->card_status;
								}
								?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('3', $giftcards)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/giftcards/delete_giftcard/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
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
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 Code
							</th>
							<th>
								 Value
							</th>
							<th>
								 Recipient Name
							</th>
							<th>
								 Recipient Email
							</th>
							<th>
								 Sender Name
							</th>
							<th>
								 Sender Email
							</th>
							<th>
								Created Date
							</th>
							<th>
								Expiry Date
							</th>
							<th>
								Card Status
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>