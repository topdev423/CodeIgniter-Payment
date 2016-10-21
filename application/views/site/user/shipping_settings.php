<?php
$this->load->view('site/templates/header',$this->data);
?>
<link rel="stylesheet" media="all" type="text/css" href="css/site/<?php echo SITE_COMMON_DEFINE ?>setting.css">
<!-- Section_start -->
<div class="lang-en no-subnav wider winOS">
<!-- Section_start -->
<div id="container-wrapper">
	<div class="container set_area">
		<?php if($flash_data != '') { ?>
		<div class="errorContainer" id="<?php echo $flash_data_type;?>">
			<script>setTimeout("hideErrDiv('<?php echo $flash_data_type;?>')", 3000);</script>
			<p><span><?php echo $flash_data;?></span></p>
		</div>
		<?php } ?>
        

        <div id="content">
		<h2 class="ptit"><?php if($this->lang->line('shipping_address') != '') { echo stripslashes($this->lang->line('shipping_address')); } else echo "Shipping Address"; ?></h2>
	<?php if ($shippingList->num_rows() == 0){?>
		<div class=" section shipping no-data">
			
			<span class="icon"><i class="ic-ship"></i></span>
			<p><?php if($this->lang->line('shipping_no_shipaddr') != '') { echo stripslashes($this->lang->line('shipping_no_shipaddr')); } else echo "You haven't added any shipping address yet."; ?></p>
			
			<button class="btn-shipping add_"><i class="ic-plus"></i> <?php if($this->lang->line('shipping_add_ship') != '') { echo stripslashes($this->lang->line('shipping_add_ship')); } else echo "Add Shipping Address"; ?></button>
		</div>
	<?php 
	}else {
	?>
	<div class="section shipping">
            <h3><?php if($this->lang->line('shipping_saved_addrs') != '') { echo stripslashes($this->lang->line('shipping_saved_addrs')); } else echo "Your Saved Shipping Addresses"; ?></h3>
                	<div class="chart-wrap">
            <table class="chart">
                <thead>
                    <tr>
                        <th><?php if($this->lang->line('shipping_default') != '') { echo stripslashes($this->lang->line('shipping_default')); } else echo "Default"; ?></th>
                        <th><?php if($this->lang->line('shipping_nickname') != '') { echo stripslashes($this->lang->line('shipping_nickname')); } else echo "Nick Name"; ?></th>
                        <th><?php if($this->lang->line('shipping_address_comm') != '') { echo stripslashes($this->lang->line('shipping_address_comm')); } else echo "Address"; ?></th>
                        <th><?php if($this->lang->line('shipping_phone') != '') { echo stripslashes($this->lang->line('shipping_phone')); } else echo "Phone"; ?></th>
                        <th><?php if($this->lang->line('purchases_option') != '') { echo stripslashes($this->lang->line('purchases_option')); } else echo "Option"; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shippingList->result() as $row){?>
                    <tr aid="<?php echo $row->id;?>" isdefault="<?php if($row->primary == 'Yes'){echo TRUE; }else {echo FALSE;}?>">
                        <td><?php if($row->primary == 'Yes'){?><i class="ic-check"></i><?php }?></td>
                        <td><?php echo $row->nick_name;?></td>
                        
                        <td><?php echo $row->address1.', '.$row->address2.'<br/>'.$row->city.'<br/>'.$row->state.'<br/>'.$row->country.'-'.$row->postal_code;?></td>
                        <td><?php echo $row->phone;?></td>
                        
                        <td><a aid="<?php echo $row->id;?>" class="edit_"><?php if($this->lang->line('shipping_edit') != '') { echo stripslashes($this->lang->line('shipping_edit')); } else echo "Edit"; ?></a> / <a class="remove_"><?php if($this->lang->line('shipping_delete') != '') { echo stripslashes($this->lang->line('shipping_delete')); } else echo "Delete"; ?></a></td>
                    </tr>
                    <?php }?>
                    
                </tbody>
            </table>
			</div>
            	<button class="btn-shipping add_"><i class="ic-plus"></i> <?php if($this->lang->line('shipping_add_ship') != '') { echo stripslashes($this->lang->line('shipping_add_ship')); } else echo "Add Shipping Address"; ?></button>
			</div>
	<?php 
	}
	?>
	</div>

		
		<?php 
		$this->load->view('site/user/settings_sidebar');
     $this->load->view('site/templates/side_footer_menu');
     ?>

	</div>
	<!-- / container -->
</div>
</div>


<!-- Section_start -->
<script type="text/javascript" src="js/site/<?php echo SITE_COMMON_DEFINE ?>address_helper.js"></script>
<script type="text/javascript" src="js/site/jquery.validate.js"></script>
<script>

	$("#shippingEditForm").validate();
	$("#shippingAddForm").validate();

	jQuery(function($) {
		var $select = $('.gift-recommend select.select-round');
		$select.selectBox();
		$select.each(function(){
			var $this = $(this);
			if($this.css('display') != 'none') $this.css('visibility', 'visible');
		});
	});
</script>
<?php 
$this->load->view('site/templates/footer',$this->data);
?>
