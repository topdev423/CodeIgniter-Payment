<?php
$feedHead =  "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0'>
<channel>
<title>".$heading." </title>
<link>".$sitelink." </link>
<description>".$sitedescription." </description>
<language>en-us</language>
<Products>"; 
if ($productDetails != '' && count($productDetails)>0){
	foreach ($productDetails as $datafeed)
	{
	$id=$datafeed->id;
	$title=$datafeed->product_name; 
	$link=$datafeed->created; 
	$price=$datafeed->sale_price; 
	$img = array_filter(explode(',', $datafeed->image));
	$imgLink = base_url().'images/product/'.$img[0];
	$prodLink = base_url().'things/'.$id.'/'.url_title($title,'-');
	$description=$datafeed->excerpt; 
	if ($description == ''){
		$description=$datafeed->description; 
	}
	
	 $feedHead .=  "
<Product>
<id>".$id."</id>
<title>".$title."</title>
<ProductDesc>".$description."</ProductDesc>
<ProductImage>".$imgLink."</ProductImage>
<Price>".$price."</Price>
<link>".$prodLink."</link>
</Product>
"; 
	} 
}
if ($likedProductArr != '' && count($likedProductArr)>0){
	foreach ($likedProductArr as $datafeed)
	{
	$img = array_filter(explode(',', $datafeed->image));
	$imgLink = base_url().'images/product/'.$img[0];
	$title=$datafeed->product_name; 
	$link=$datafeed->created; 
	$price=$datafeed->sale_price; 
	$id=$datafeed->id; 
	$description='Liked this product'; 
	$prodLink = base_url().'things/'.$id.'/'.url_title($title,'-');
	
	$feedHead .=  "
<Product>
<id>".$id."</id>
<title>".$title."</title>
<ProductDesc>".$description."</ProductDesc>
<ProductImage>".$imgLink."</ProductImage>
<Price>".$price."</Price>
<link>".$prodLink."</link>
</Product>
"; 
	} 
}
$feedHead .=  "
</Products>
</channel>
</rss>";
header("Content-Type: application/rss+xml"); 
echo $feedHead;
?>

