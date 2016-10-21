<div class="popup ly-title gift-recommend" style="display:none;">
	<h3 class="ltit"><?php if($this->lang->line('header_gift_recom') != '') { echo stripslashes($this->lang->line('header_gift_recom')); } else echo "Gift Recommendations"; ?></h3>
	<dl>
		<dt><?php if($this->lang->line('header_ask_the') != '') { echo stripslashes($this->lang->line('header_ask_the')); } else echo "Ask the"; ?> <?php echo $siteTitle;?> <?php if($this->lang->line('header_ask_experts') != '') { echo stripslashes($this->lang->line('header_ask_experts')); } else echo "experts"; ?></dt>
		<dd><p><?php if($this->lang->line('header_fill_form') != '') { echo stripslashes($this->lang->line('header_fill_form')); } else echo "Fill in the form below and we'll email you back with some great gift ideas you can buy right here on"; ?> <?php echo $siteTitle;?>.</p></dd>
	</dl>
	<dl>
		<dt><?php if($this->lang->line('header_description') != '') { echo stripslashes($this->lang->line('header_description')); } else echo "Description"; ?></dt>
		<dd>
			<select class="gift-target" id="gift-for">
				<option value="none"><?php if($this->lang->line('header_for') != '') { echo stripslashes($this->lang->line('header_for')); } else echo "For"; ?></option>
				<option value="male"><?php if($this->lang->line('settings_male') != '') { echo stripslashes($this->lang->line('settings_male')); } else echo "Male"; ?></option>
				<option value="female"><?php if($this->lang->line('settings_female') != '') { echo stripslashes($this->lang->line('settings_female')); } else echo "Female"; ?></option>
			</select>
			<select class="gift-category" id="gift-cat">
				<option value="none"><?php if($this->lang->line('header_category') != '') { echo stripslashes($this->lang->line('header_category')); } else echo "Category"; ?></option>
				<option value="1"><?php if($this->lang->line('header_mens') != '') { echo stripslashes($this->lang->line('header_mens')); } else echo "Men's"; ?></option><option value="2"><?php if($this->lang->line('header_womens') != '') { echo stripslashes($this->lang->line('header_womens')); } else echo "Women's"; ?></option><option value="3"><?php if($this->lang->line('header_kids') != '') { echo stripslashes($this->lang->line('header_kids')); } else echo "Kids"; ?></option><option value="4"><?php if($this->lang->line('header_pets') != '') { echo stripslashes($this->lang->line('header_pets')); } else echo "Pets"; ?></option><option value="5"><?php if($this->lang->line('header_home') != '') { echo stripslashes($this->lang->line('header_home')); } else echo "Home"; ?></option><option value="6"><?php if($this->lang->line('header_gadgets') != '') { echo stripslashes($this->lang->line('header_gadgets')); } else echo "Gadgets"; ?></option><option value="7"><?php if($this->lang->line('header_art') != '') { echo stripslashes($this->lang->line('header_art')); } else echo "Art"; ?></option><option value="8"><?php if($this->lang->line('header_food') != '') { echo stripslashes($this->lang->line('header_food')); } else echo "Food"; ?></option><option value="9"><?php if($this->lang->line('header_media') != '') { echo stripslashes($this->lang->line('header_media')); } else echo "Media"; ?></option><option value="11"><?php if($this->lang->line('header_atchitecture') != '') { echo stripslashes($this->lang->line('header_atchitecture')); } else echo "Architecture"; ?></option><option value="12"><?php if($this->lang->line('header_travel') != '') { echo stripslashes($this->lang->line('header_travel')); } else echo "Travel"; ?> &amp; <?php if($this->lang->line('header_destination') != '') { echo stripslashes($this->lang->line('header_destination')); } else echo "Destinations"; ?></option><option value="13"><?php if($this->lang->line('header_sports') != '') { echo stripslashes($this->lang->line('header_sports')); } else echo "Sports"; ?> &amp; <?php if($this->lang->line('header_outdoors') != '') { echo stripslashes($this->lang->line('header_outdoors')); } else echo "Outdoors"; ?></option><option value="14"><?php if($this->lang->line('header_diy') != '') { echo stripslashes($this->lang->line('header_diy')); } else echo "DIY"; ?> &amp; <?php if($this->lang->line('header_crafts') != '') { echo stripslashes($this->lang->line('header_crafts')); } else echo "Crafts"; ?></option><option value="15"><?php if($this->lang->line('header_workspace') != '') { echo stripslashes($this->lang->line('header_workspace')); } else echo "Workspace"; ?></option><option value="16"><?php if($this->lang->line('header_cars') != '') { echo stripslashes($this->lang->line('header_cars')); } else echo "Cars"; ?> &amp; <?php if($this->lang->line('header_vehicles') != '') { echo stripslashes($this->lang->line('header_vehicles')); } else echo "Vehicles"; ?></option><option value="10"><?php if($this->lang->line('header_other') != '') { echo stripslashes($this->lang->line('header_other')); } else echo "Other"; ?></option>
			</select>
			<select class="gift-point" id="gift-price">
				<option value="none"><?php if($this->lang->line('giftcard_price') != '') { echo stripslashes($this->lang->line('giftcard_price')); } else echo "Price"; ?></option>
				<option value="1-20">$1-20</option>
				<option value="20-100">$20-100</option>
				<option value="100-200">$100-200</option>
				<option value="200-500">$200-500</option>
				<option value="500+">$500+</option>
			</select><br>
			<textarea placeholder="<?php if($this->lang->line('header_much_detals') != '') { echo stripslashes($this->lang->line('header_much_detals')); } else echo "Please give us as much detail as possible to help you find the perfect gift, including information about the recipient, price range, etc."; ?>"></textarea>
		</dd>
	</dl>
	<div class="btn-area">
		<button class="btn-share"><?php if($this->lang->line('header_send_reqst') != '') { echo stripslashes($this->lang->line('header_send_reqst')); } else echo "Send Request"; ?></button>
	</div>
	<button title="Close" class="ly-close"><i class="ic-del-black"></i></button>
</div>