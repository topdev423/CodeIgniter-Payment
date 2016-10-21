<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading;?></h6>
                        
					</div>
					<div class="widget_content">
					<?php 
					if ($sellerDetails->row()->paypal_email != ''){
						$attributes = array('class' => 'form_container left_label', 'id' => 'add_vendor_payment_form');
						echo form_open_multipart('admin/commission/add_vendor_payment',$attributes) 
					?>
						<ul>
	 							
<!-- 							<li>
								<div class="form_grid_12">
								<label class="field_title" for="transaction_id">Transaction Id<span class="req">*</span></label>
								<div class="form_input">
									<input name="transaction_id" id="transaction_id" type="text" tabindex="1" class="required large tipTop" title="Please enter the transaction id"/>
								</div>
								</div>
							</li>
	 							
							<li>
								<div class="form_grid_12">
								<label class="field_title" for="payment_type">Payment Type<span class="req">*</span></label>
								<div class="form_input">
									<input name="payment_type" id="payment_type" type="text" tabindex="2" class="required large tipTop" title="Please enter the payment type"/>
									<span class="input_instruction green">Example:- Paypal, Credit card, etc...</span>
								</div>
								</div>
							</li>
 -->	 							
							<li>
								<div class="form_grid_12">
								<label class="field_title" for="amount">Amount<span class="req">*</span></label>
								<div class="form_input">
									<input name="amount" id="" type="text" tabindex="3" class="required number large tipTop" title="Please enter the amount"/>
									<span class="input_instruction green">Balance amount is <?php echo $currencySymbol.number_format($paid_to_balance,2);?></span>
								</div>
								</div>
							</li>
							
							<li>
							<input type="hidden" name="balance_due" value="<?php echo $paid_to_balance;?>"/>
							<input type="hidden" name="vendor_id" value="<?php echo $sellerDetails->row()->id;?>"/>
							<input type="hidden" name="paypal_email" value="<?php echo $sellerDetails->row()->paypal_email;?>"/>
							<input type="hidden" name="status" value="success"/>
							<div class="form_grid_12">
								<div class="form_input">
									<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Pay with Paypal</span></button>
								</div>
							</div>
							</li>
						</ul>
                    
						</form>
						<?php }else {
						$attributes = array('class' => 'form_container left_label', 'id' => 'add_vendor_payment_form');
						echo form_open_multipart('admin/commission/add_vendor_payment_manual',$attributes) 	
						?>
							<ul>
		 							
	 							<li>
									<div class="form_grid_12">
									<label class="field_title" for="transaction_id">Transaction Id<span class="req">*</span></label>
									<div class="form_input">
										<input name="transaction_id" id="transaction_id" type="text" tabindex="1" class="required large tipTop" title="Please enter the transaction id"/>
									</div>
									</div>
								</li>
		 							
								<li>
									<div class="form_grid_12">
									<label class="field_title" for="payment_type">Payment Type<span class="req">*</span></label>
									<div class="form_input">
										<input name="payment_type" id="payment_type" type="text" tabindex="2" class="required large tipTop" title="Please enter the payment type"/>
										<span class="input_instruction green">Example:- Paypal, Credit card, etc...</span>
									</div>
									</div>
								</li>
	 	 							
								<li>
									<div class="form_grid_12">
									<label class="field_title" for="amount">Amount<span class="req">*</span></label>
									<div class="form_input">
										<input name="amount" id="" type="text" tabindex="3" class="required number large tipTop" title="Please enter the amount"/>
										<span class="input_instruction green">Balance amount is <?php echo $currencySymbol.number_format($paid_to_balance,2);?></span>
									</div>
									</div>
								</li>
								
								<li>
								<input type="hidden" name="balance_due" value="<?php echo $paid_to_balance;?>"/>
								<input type="hidden" name="vendor_id" value="<?php echo $sellerDetails->row()->id;?>"/>
								<input type="hidden" name="status" value="success"/>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>ADD PAYMENT</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<script type="text/javascript">
$('#add_vendor_payment_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>