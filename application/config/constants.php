<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Table Constants
|--------------------------------------------------------------------------
|
*/
define('TBL_PREF',						'fc_');

define('ADMIN',							TBL_PREF.'admin');
define('ADMIN_SETTINGS',				TBL_PREF.'admin_settings');
define('SUBADMIN',						TBL_PREF.'subadmin');
define('USERS',							TBL_PREF.'users');
define('CATEGORY',						TBL_PREF.'category');
define('COUPONCARDS',					TBL_PREF.'couponcards');
define('GIFTCARDS',						TBL_PREF.'giftcards');
define('GIFTCARDS_SETTINGS',			TBL_PREF.'giftcards_settings');
define('GIFTCARDS_TEMP',				TBL_PREF.'giftcards_temp');
define('SUBSCRIBERS_LIST',				TBL_PREF.'subscribers_list');
define('NEWSLETTER',					TBL_PREF.'newsletter');
define('CMS',							TBL_PREF.'cms');
define('PRODUCT',						TBL_PREF.'product');
define('PRODUCT_RATING',                TBL_PREF.'prduct_rating');
define('PRODUCT_CATEGORY',				TBL_PREF.'product_category');
define('LOCATIONS',						TBL_PREF.'location');
define('PAYMENT_GATEWAY',				TBL_PREF.'payment_gateway');
define('STATE_TAX',						TBL_PREF.'state_tax');
define('ATTRIBUTE',						TBL_PREF.'attribute');
define('PRODUCT_LIKES',					TBL_PREF.'product_likes');
define('LANGUAGES',						TBL_PREF.'languages');
define('SHOPPING_CART',					TBL_PREF.'shopping_carts');
define('PAYMENT',						TBL_PREF.'payment');
define('SHIPPING_ADDRESS',				TBL_PREF.'shipping_address');
define('COUNTRY_LIST',		 			TBL_PREF.'country');
define('USER_ACTIVITY',		 			TBL_PREF.'user_activity');
define('LISTS_DETAILS',		 			TBL_PREF.'lists');
define('WANTS_DETAILS',		 			TBL_PREF.'wants');
define('LIST_VALUES',		 			TBL_PREF.'list_values');
define('FANCYYBOX',		 				TBL_PREF.'fancybox');
define('FANCYYBOX_TEMP', 				TBL_PREF.'fancybox_temp');
define('FANCYYBOX_USES', 				TBL_PREF.'fancybox_uses');
define('USER_PRODUCTS', 				TBL_PREF.'user_product');
define('PRODUCT_COMMENTS', 				TBL_PREF.'product_comments');
define('NOTIFICATIONS', 				TBL_PREF.'notifications');
define('VENDOR_PAYMENT', 				TBL_PREF.'vendor_payment_table');
define('REVIEW_COMMENTS', 				TBL_PREF.'review_comments');
define('BANNER_CATEGORY', 				TBL_PREF.'banner_category');
define('PRICING', 						TBL_PREF.'pricing');
define('LAYOUT', 						TBL_PREF.'layout');
define('CONTROLMGMT', 					TBL_PREF.'control');
define('FOOTER', 						TBL_PREF.'footer');
define('UPLOAD_MAILS', 					TBL_PREF.'upload_mails');
define('THEME_LAYOUT', 					TBL_PREF.'theme_layout');
define('PRODUCT_ATTRIBUTE', 			TBL_PREF.'product_attribute');
define('SUBPRODUCT', 					TBL_PREF.'subproducts');
define('PRODUCT_FEEDBACK', 					TBL_PREF.'product_feedback');
define('SHORTURL',	 					TBL_PREF.'short_url');
define('UPLOAD_REQ',	 				TBL_PREF.'upload_requests');
define('CONTACTSELLER', 				TBL_PREF.'contact_seller');

/*
|--------------------------------------------------------------------------
| Path Constants
|--------------------------------------------------------------------------
|
*/

define('CATEGORY_PATH',					'images/category/');
define('GIFTPATH', 						'images/giftcards/');
define('PRODUCTPATH', 					'images/product/');
define('FANCYBOXPATH', 					'images/fancyybox/');
define('FOOTERPATH', 					'images/footer/');


/* End of file constants.php */
/* Location: ./application/config/constants.php */