<?php $k = 0; ?>
<?php foreach ($giftMiniRes as $giftRow): ?>
		<div id="GiftMindivId_'<?php echo $k; ?>'">
			<table>
				<tbody>
					<tr>
						<th class="info">
							<a href="gift-cards">
								<img src="images/site/blank.gif" style="background-image:url(<?php echo GIFTPATH.$giftMiniSet->row()->image; ?>)" alt="<?php echo $giftMiniSet->row()->title; ?>">
								<strong><?php echo $giftMiniSet->row()->title; ?></strong><br><?php echo $giftRow->recipient_name; ?>
							</a>
						</th>
						<td class="qty">1</td>
						<td class="price"><?php echo $currencySymbol . number_format($giftRow->price_value,2,'.',''); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
<?php $k++; ?>
<?php endforeach; ?>
