
		<a href="cart" class="mn-cart">
			<span class="glyphicon glyphicon-shopping-cart icon-big icon_align" style="color:#BEBFC5" aria-hidden="true"></span><?php echo $countMiniVal; ?>
		</a>
		<div style="display: none;" class="menu-contain-cart after" id="cart_popup">
			<table>
				<thead>
					<tr>
						<th><?php echo $lg_description; ?></th>
						<td><?php echo $lg_qty; ?></td>
						<td class="price"><?php echo $lg_price; ?></td>
					</tr>
				</thead>
			</table>