<?php $message .= '<div style=\"width: 1012px; background: #FFFFFF; margin: 0 auto;\">
<div style=\"width: 100%; background: #454B56; float: left; margin: 0 auto;\">
<div style=\"padding: 20px 0 10px 15px; float: left; width: 50%;\"><a id=\"logo\" target=\"_blank\" href=\"'.base_url().'\"><img title=\"'.$meta_title.'\" alt=\"'.$meta_title.'\" src=\"'.base_url().'images/logo/'.$logo.'\" /></a></div>
</div>
<div style=\"width: 970px; background: #FFFFFF; float: left; padding: 20px; border: 1px solid #454B56;\">
<div style=\"float: right; width: 35%; margin-bottom: 20px; margin-right: 7px;\">
<table style=\"border: 1px solid #cecece;\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">
<tbody>
<tr bgcolor=\"#f3f3f3\">
<td style=\"border-right: 1px solid #cecece;\" width=\"87\"><span style=\"font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; width: 100%; font-weight: bold; color: #000000; line-height: 38px; float: left;\">Order Id</span></td>
<td width=\"100\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: normal; color: #000000; line-height: 38px; text-align: center; width: 100%; float: left;\">#'.$invoice_number.'</span></td>
</tr>
<tr bgcolor=\"#f3f3f3\">
<td style=\"border-right: 1px solid #cecece;\" width=\"87\"><span style=\"font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; width: 100%; font-weight: bold; color: #000000; line-height: 38px; float: left;\">Order Date</span></td>
<td width=\"100\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: normal; color: #000000; line-height: 38px; text-align: center; width: 100%; float: left;\">'.$invoice_date.'</span></td>
</tr>
</tbody>
</table>
</div>
<div style=\"float: left; width: 100%;\">
<div style=\"width: 49%; float: left; border: 1px solid #cccccc; margin-right: 10px;\"><span style=\"border-bottom: 1px solid #cccccc; background: #f3f3f3; width: 95.8%; float: left; padding: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #000305;\">Shipping Address</span>
<div style=\"float: left; padding: 10px; width: 96%; font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #030002; line-height: 28px;\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
<tbody>
<tr>
<td>Full Name</td>
<td>:</td>
<td>'.$ship_fullname.'</td>
</tr>
<tr>
<td>Address</td>
<td>:</td>
<td>'.$ship_address1.'</td>
</tr>
<tr>
<td>Address 2</td>
<td>:</td>
<td>'.$ship_address2.'</td>
</tr>
<tr>
<td>City</td>
<td>:</td>
<td>'.$ship_city.'</td>
</tr>
<tr>
<td>Country</td>
<td>:</td>
<td>'.$ship_country.'</td>
</tr>
<tr>
<td>State</td>
<td>:</td>
<td>'.$ship_state.'</td>
</tr>
<tr>
<td>Zipcode</td>
<td>:</td>
<td>'.$ship_postalcode.'</td>
</tr>
<tr>
<td>Phone Number</td>
<td>:</td>
<td>'.$ship_phone.'</td>
</tr>
</tbody>
</table>
</div>
</div>
<div style=\"width: 49%; float: left; border: 1px solid #cccccc;\"><span style=\"border-bottom: 1px solid #cccccc; background: #f3f3f3; width: 95.7%; float: left; padding: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; color: #000305;\">Billing Address</span>
<div style=\"float: left; padding: 10px; width: 96%; font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #030002; line-height: 28px;\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
<tbody>
<tr>
<td>Full Name</td>
<td>:</td>
<td>'.$bill_fullname.'</td>
</tr>
<tr>
<td>Address</td>
<td>:</td>
<td>'.$bill_address1.'</td>
</tr>
<tr>
<td>Address 2</td>
<td>:</td>
<td>'.$bill_address2.'</td>
</tr>
<tr>
<td>City</td>
<td>:</td>
<td>'.$bill_city.'</td>
</tr>
<tr>
<td>Country</td>
<td>:</td>
<td>'.$bill_country.'</td>
</tr>
<tr>
<td>State</td>
<td>:</td>
<td>'.$bill_state.'</td>
</tr>
<tr>
<td>Zipcode</td>
<td>:</td>
<td>'.$bill_postalcode.'</td>
</tr>
<tr>
<td>Phone Number</td>
<td>:</td>
<td>'.$bill_phone.'</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div style=\"float: left; width: 100%; margin-right: 3%; margin-top: 10px; font-size: 14px; font-weight: normal; line-height: 28px; font-family: Arial, Helvetica, sans-serif; color: #000; overflow: hidden;\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">
<tbody>
<tr>
<td colspan=\"3\">
<table style=\"border: 1px solid #cecece; width: 99.5%;\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">
<tbody>
<tr bgcolor=\"#f3f3f3\">
<td style=\"border-right: 1px solid #cecece; text-align: center;\" width=\"17%\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; line-height: 38px; text-align: center;\">Bag Items</span></td>
<td style=\"border-right: 1px solid #cecece; text-align: center;\" width=\"43%\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; line-height: 38px; text-align: center;\">Product Name</span></td>
<td style=\"border-right: 1px solid #cecece; text-align: center;\" width=\"12%\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; line-height: 38px; text-align: center;\">Qty</span></td>
<td style=\"border-right: 1px solid #cecece; text-align: center;\" width=\"14%\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; line-height: 38px; text-align: center;\">Unit Price</span></td>
<td style=\"text-align: center;\" width=\"15%\"><span style=\"font-size: 12px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: #000000; line-height: 38px; text-align: center;\">Sub Total</span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>';  ?>