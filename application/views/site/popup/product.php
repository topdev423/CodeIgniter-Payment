<?php 
if(isset($productDetails) && $this->uri->segment(1) == 'things'){
?>

<div class="popup thing-detail no-end-days" style="display:none;">
	<div class="photo-frame">
		<span class="frame-zoom"><i class="mask"></i><i class="crop"><em></em></i></span>
		<div class="figure-list-wrapper">
			<ul class="figure-list after">
			<?php 
			$imgArr = explode(',', $productDetails->row()->image);
			if (count($imgArr)>0){
				foreach ($imgArr as $imgRow){
					if ($imgRow != ''){
			?>
				<li><a href="<?php echo base_url();?>images/product/<?php echo $imgRow;?>" data-bigger="<?php echo base_url()?>images/product/<?php echo $imgRow;?>" style="background-image:url(<?php echo base_url();?>images/product/<?php echo $imgRow;?>)" class="frame"></a></li>
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
        <h3><?php echo $productDetails->row()->product_name;?></h3>
		
		<p class="price"><?php echo $currencySymbol;?><span id="SalePricePop"><?php echo $productDetails->row()->sale_price;?></span> <span class="usd"><!--  <a class="code">--><?php echo $currencyType;?><!--</a>--></span> <small style="display: none;" price="<?php echo $productDetails->row()->sale_price;?>" sample="1,000.23">/ <?php if($this->lang->line('header_approx') != '') { echo stripslashes($this->lang->line('header_approx')); } else echo "approximately"; ?> %s</small></p>
		
		<ul class="currency_codes">
			<li><a href="#"><?php if($this->lang->line('header_usd') != '') { echo stripslashes($this->lang->line('header_usd')); } else echo "US Dollar (USD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_cad') != '') { echo stripslashes($this->lang->line('header_cad')); } else echo "Canadian Dollar (CAD)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_eur') != '') { echo stripslashes($this->lang->line('header_eur')); } else echo "Euro (EUR)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_gbp') != '') { echo stripslashes($this->lang->line('header_gbp')); } else echo "British Pound Sterling (GBP)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_jpy') != '') { echo stripslashes($this->lang->line('header_jpy')); } else echo "Japanese Yen (JPY)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_krw') != '') { echo stripslashes($this->lang->line('header_krw')); } else echo "South Korean Won (KRW)"; ?></a></li>
			<li><a href="#"><?php if($this->lang->line('header_try') != '') { echo stripslashes($this->lang->line('header_try')); } else echo "Turkish Lira (TRY)"; ?></a></li>
		</ul>
		
		
        <div class="quick-shipping" sii="57397" style="padding-top:0;">
            <span class="icon truck"></span> <?php if($this->lang->line('header_immed_ship') != '') { echo stripslashes($this->lang->line('header_immed_ship')); } else echo "Immediate Shipping"; ?> <span class="tooltip"><i class="icon"></i> <small><?php if($this->lang->line('header_ship_within') != '') { echo stripslashes($this->lang->line('header_ship_within')); } else echo "Ships within 1-3 business days"; ?><b></b></small>
		</span></div>
		<div class="thing-option">
			<input type="hidden" id="original_sale_price" value="<?php echo $productDetails->row()->sale_price;?>"/>
			<p>
				<label for="sale-quantity"><?php if($this->lang->line('header_quant_Avail') != '') { echo stripslashes($this->lang->line('header_quant_Avail')); } else echo "Quantity ( Available"; ?> : <?php echo $productDetails->row()->quantity;?> )</label>
				<span style="display: inline-block; position: relative;" class="input-number">
				<input style="" id="popup-sale-quantity" data-mqty="<?php echo $productDetails->row()->quantity;?>" class="option number quantity" onkeyup="javascript:changeQty(this);" value="1" min="1" type="number">
				<a style="position: absolute; top: 0px; right: 0px; height: 8px; padding: 0px 7px;" class="btn-up" onclick="javascript:increaseQty();" href="javascript:void(0);">
				<span>
				</span>
				</a>
				<a style="position: absolute; top: 9px; right: 0px; height: 8px; padding: 0px 7px;" class="btn-down" onclick="javascript:decreaseQty();" href="javascript:void(0);">
				<span>
				</span>
				</a>
				</span>
			</p>
			<p>
			 <?php  
              		$attrValsSetLoad = ''; //echo '<pre>'; print_r($PrdAttrVal->result_array()); 
					if($PrdAttrVal->num_rows>0){ 
						$attrValsSetLoad = $PrdAttrVal->row()->pid; 
				?>
                   <label for="quantity"><?php if($this->lang->line('options') != '') { echo stripslashes($this->lang->line('options')); } else echo "Options"; ?></label>
                   	<select name="attr_name_id1" id="attr_name_id1" class="option  selectBox" style="height: 30px;border:1px solid #D1D3D9; width:150px;" onchange="ajaxCartAttributeChangePopup(this.value,'<?php echo $productDetails->row()->id; ?>');" >
                        <option value="0">---- <?php if($this->lang->line('checkout_select') != '') { echo stripslashes($this->lang->line('checkout_select')); } else echo "Select"; ?> ----</option>
                        <?php foreach($PrdAttrVal->result_array() as $Prdattrvals ){ ?>
                        <option value="<?php echo $Prdattrvals['pid']; ?>"><?php echo $Prdattrvals['attr_type'].'/'.$Prdattrvals['attr_name']; ?></option>
                        <?php } ?>
                        </select>
                        <div style="color:#FF0000;" id="AttrErr1"></div>
				<div id="loadingImg1_<?php echo $productDetails->row()->id; ?>"></div>
              <?php } ?>
              </p>
<!-- 			<input type="hidden" class="option number" name="product_id" id="product_id" value="<?php echo $productDetails->row()->id;?>">
                <input type="hidden" class="option number" name="cateory_id" id="cateory_id" value="<?php echo $productDetails->row()->category_id;?>">                
                <input type="hidden" class="option number" name="sell_id" id="sell_id" value="<?php echo $productDetails->row()->user_id;?>">
                <input type="hidden" class="option number" name="price" id="price" value="<?php echo $productDetails->row()->sale_price;?>">
                <input type="hidden" class="option number" name="product_shipping_cost" id="product_shipping_cost" value="<?php echo $productDetails->row()->shipping_cost;?>"> 
                <input type="hidden" class="option number" name="product_tax_cost" id="product_tax_cost" value="<?php echo $productDetails->row()->tax_cost;?>">
                <input type="hidden" class="option number" name="attribute_values" id="attribute_values" value="">
 -->                
                
			<p class="btns-area">
				<input type="button" class="btn-green-cart add_to_cart" <?php if ($loginCheck==''){echo 'require_login="true"';}?> name="addtocart" value="<?php if($this->lang->line('header_add_cart') != '') { echo stripslashes($this->lang->line('header_add_cart')); } else echo "Add to Cart"; ?>" onclick="ajax_add_cart('<?php echo $PrdAttrVal->num_rows; ?>');" />
			</p>
			
			

		</div>
		 
		<div class="description" style="">
		<?php echo $productDetails->row()->description;?>
		</div>
		
	</div>
	<div class="clear"></div>
	<span class="ly-close"></span>
</div>
<?php }?>