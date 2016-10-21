<?php $message .= '<table bgcolor=\"#7da2c1\" width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
<tbody>
<tr>
<td style=\"padding: 40px;\">
<table width=\"610\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"border: #1d4567 1px solid; font-family: Arial, Helvetica, sans-serif;\">
<tbody>
<tr>
<td><a href=\"'.base_url().'\"><img alt=\"'.$meta_title.'\" src=\"'.base_url().'images/logo/'.$logo.'\" style=\"margin: 15px 5px 0; padding: 0px; border: none;\" /></a></td>
</tr>
<tr>
<td valign=\"top\">
<table bgcolor=\"#FFFFFF\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 100%;\">
<tbody>
<tr>
<td colspan=\"2\">
<h3 style=\"padding: 10px 15px; margin: 0px; color: #0d487a;\">Contact Seller</h3>
<p style=\"padding: 0px 15px 10px 15px; font-size: 12px; margin: 0px;\">&nbsp;</p>
</td>
</tr>
<tr>
<td valign=\"top\" style=\"font-size: 12px; padding: 10px 15px;\">
<p><strong>Contact Name :</strong> '.$name.'</p>
<p><strong>Contact Email :</strong> '.$email.'</p>
<p><strong>Contact Phone :</strong> '.$phone.'</p>
<p><strong>Contact Question :</strong> '.$question.'</p>
</td>
</tr>
<tr>
</tr>
</tbody>
</table>
<table bgcolor=\"#FFFFFF\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width: 100%;\">
<tbody>
<tr>
<td>Product Name</td>
<td>Product Image</td>
</tr>
<tr>
<td><a href=\"'.base_url().'things/'.$productId.'/'.$productSeourl.'\">'.$productName.'</a></td>
<td><img width=\"100\" alt=\"'.$productImage.'\" src=\"images/product/'.$productName.'\" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td valign=\"top\" style=\"font-size: 12px; padding: 10px 15px;\">
<p>&nbsp;</p>
<p><strong>- '.$email_title.' Team</strong></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';  ?>