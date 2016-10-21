<?php 
if(isset($fancyboxDetail) && $this->uri->segment(1) == 'fancybox'){
?>

<div class="popup thing-detail no-end-days" style="display:none;">
	<div class="photo-frame">
		<span class="frame-zoom"><i class="mask"></i><i class="crop"><em></em></i></span>
		<div class="figure-list-wrapper">
			<ul class="figure-list after">
			<?php 
			$imgArr = explode(',', $fancyboxDetail->row()->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
			?>
				<li><a href="<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>" data-bigger="<?php echo base_url()?>images/fancyybox/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/fancyybox/<?php echo $imgRow;?>)" class="frame"></a></li>
			<?php 
					}
				}
			}
			?>		
			</ul>
		</div>
		<a href="#prev" title="Prev" class="move prev disabled"><span class="arrow"></span></a>
		<a href="#next" title="Next" class="move next disabled"><span class="arrow"></span></a>
	</div>
	<div class="zoom-container"></div>
	<div class="thing-info">
        <h3><?php echo $fancyboxDetail->row()->name;?></h3>
		
		<p class="price"><?php echo $currencySymbol;?><?php echo $fancyboxDetail->row()->price;?> <span class="usd"><!--  <a class="code">--><?php echo $currencyType;?><!--</a>--></span> <small style="display: none;" price="<?php echo $fancyboxDetail->row()->sale_price;?>" sample="1,000.23">/ <?php if($this->lang->line('header_approx') != '') { echo stripslashes($this->lang->line('header_approx')); } else echo "approximately"; ?> %s</small></p>
		
		<ul class="currency_codes">
			<li><a href="#"><?php if($this->lang->line('header_usd') != '') { echo stripslashes($this->lang->line('header_usd')); } else echo "US Dollar (USD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_cad') != '') { echo stripslashes($this->lang->line('header_cad')); } else echo "Canadian Dollar (CAD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_eur') != '') { echo stripslashes($this->lang->line('header_eur')); } else echo "Euro (EUR)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_gbp') != '') { echo stripslashes($this->lang->line('header_gbp')); } else echo "British Pound Sterling (GBP)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_jpy') != '') { echo stripslashes($this->lang->line('header_jpy')); } else echo "Japanese Yen (JPY)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_krw') != '') { echo stripslashes($this->lang->line('header_krw')); } else echo "South Korean Won (KRW)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_try') != '') { echo stripslashes($this->lang->line('header_try')); } else echo "Turkish Lira (TRY)"; ?></a></li>
		</ul>
		
		
		 
		<div class="description" style="">
		<?php echo $fancyboxDetail->row()->description;?>
		</div>
		
	</div>
	<div class="clear"></div>
	<span class="ly-close"></span>
</div>
<?php }?>