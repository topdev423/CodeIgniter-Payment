<?php
include_once('databaseValues.php');
$conn = @mysql_pconnect($hostName,$dbUserName,$dbPassword) or die("Database Connection Failed<br>". mysql_error());

mysql_select_db($databaseName, $conn) or die('DB not selected'); 

echo 'Add subproduct '.mysql_query("CREATE TABLE if not exists `fc_subproducts` (
 `pid` int(11) NOT NULL AUTO_INCREMENT,
 `product_id` int(11) NOT NULL,
 `attr_id` int(11) NOT NULL,
 `attr_name` text NOT NULL,
 `attr_price` decimal(10,2) NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8");
echo 'Add attribute tbl '.mysql_query("CREATE TABLE if not exists `fc_product_attribute` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `attr_name` varchar(500) NOT NULL,
 `attr_seourl` varchar(500) NOT NULL,
 `status` enum('Active','Inactive') NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8");
echo 'Add fancyybox banner'.mysql_query("ALTER TABLE  `fc_admin_settings` ADD  `fancyybox_banner` TEXT NOT NULL");
echo 'Alter subproduct lg '.mysql_query("ALTER TABLE  `fc_subproducts` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
echo 'Alter subproduct '.mysql_query("ALTER TABLE  `fc_subproducts` ADD  `attr_name` TEXT NOT NULL AFTER  `attr_id`");
echo 'Add sharing name '.mysql_query("ALTER TABLE  `fc_admin_settings` ADD  `sharing_name` TEXT NOT NULL");
echo 'Add Ship policy '.mysql_query("ALTER TABLE  `fc_product` ADD  `shipping_policies` longtext NOT NULL");
echo 'Add Feedback '.mysql_query("CREATE TABLE `fc_product_feedback` ( `id` int(50) NOT NULL AUTO_INCREMENT, `voter_id` int(50) NOT NULL, `product_id` int(50) NOT NULL, `seller_id` bigint(20) NOT NULL, `rating` int(50) NOT NULL, `title` varchar(255) NOT NULL, `description` longblob NOT NULL, `status` enum('Active','InActive') NOT NULL, `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8");

echo 'Create Control '.mysql_query("CREATE TABLE `fc_control` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `product_control` enum('selling','affiliates','both') NOT NULL,
 `home_control` enum('classic','grid','compact') NOT NULL,
 `popup_control` enum('on','off') NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
echo 'Insert Control '.mysql_query("INSERT INTO `fc_control` (`id`, `product_control`, `home_control`, `popup_control`) VALUES
(1, 'selling', 'compact', 'off')");
echo 'Create Layout'.mysql_query("CREATE TABLE `fc_layout` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `place` varchar(250) NOT NULL,
 `text` blob NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8");
echo 'Insert Layout'.mysql_query("INSERT INTO `fc_layout` (`id`, `place`, `text`) VALUES
(1, 'welcome text', 0x57656c636f6d6520746f204d792053697465),
(2, 'welcome tag', 0x446973636f76657220616d617a696e67207468696e67732061726f756e642074686520776f726c64),
(3, 'signup title', 0x4a6f696e206e6f77),
(4, 'signup description', 0x4a6f696e20686572652e20536861726520616e642073656c6c2070726f64756374732061726f756e642074686520776f726c64),
(5, 'login title', 0x4c6f67696e),
(6, 'login description', 0x4a6f696e20686572652e20536861726520616e642073656c6c2070726f64756374732061726f756e642074686520776f726c64)");
echo 'Create Footer'.mysql_query("CREATE TABLE `fc_footer` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `widget_title` varchar(250) NOT NULL,
 `widget_name` longtext NOT NULL,
 `widget_link` longtext NOT NULL,
 `widget_icon` longtext NOT NULL,
 `status` enum('Active','InActive') NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
echo 'Create Pricing'.mysql_query("CREATE TABLE `fc_pricing` (
 `id` int(50) NOT NULL AUTO_INCREMENT,
 `pricing_from` int(50) NOT NULL,
 `pricing_to` int(50) NOT NULL,
 `price_range` varchar(250) NOT NULL,
 `status` enum('Active','InActive') NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8");
echo 'Insert Pricing'.mysql_query("INSERT INTO `fc_pricing` (`id`, `pricing_from`, `pricing_to`, `price_range`, `status`) VALUES
(10, 1, 100, '1 - 100', 'Active'),
(11, 101, 200, '101 - 200', 'Active'),
(12, 201, 300, '201 - 300', 'Active'),
(13, 301, 500, '301 - 500', 'Active'),
(14, 501, 1000, '501 - 1000', 'Active'),
(15, 1001, 100000, '1001 - 100000', 'Active')");
echo 'Create Theme'.mysql_query("CREATE TABLE `fc_theme_layout` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` text NOT NULL,
 `value` mediumtext NOT NULL,
 `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8");
echo 'Insert Theme'.mysql_query("INSERT INTO `fc_theme_layout` (`id`, `name`, `value`, `created`) VALUES
(1, 'header_bg', '', '2014-01-28 11:08:51'),
(2, 'header_border_color', '', '2014-01-28 11:08:51'),
(3, 'header_text_color', '', '2014-01-28 11:09:51'),
(4, 'header_text_color_hover', '', '2014-01-28 11:09:51'),
(5, 'body_bg_color', '', '2014-01-28 11:17:08'),
(6, 'content_bg_color', '', '2014-01-28 11:17:08'),
(7, 'product_title_color', '', '2014-01-28 11:44:34'),
(8, 'product_price_color', '', '2014-01-28 11:44:34'),
(9, 'body_text_color', '', '2014-01-28 13:28:56'),
(10, 'seller_name_color', '', '2014-01-29 05:33:35'),
(11, 'welcome_text_color', '', '2014-01-29 05:33:35'),
(12, 'welcome_tag_color', '', '2014-01-29 05:44:35'),
(13, 'menu_hover_color', '', '2014-01-29 05:44:35'),
(14, 'jump_to_top_color', '', '2014-01-29 06:01:21'),
(15, 'jump_to_top_bg_color', '', '2014-01-29 06:01:21'),
(16, 'footer_bg_color', '', '2014-01-29 06:01:32'),
(17, 'footer_widget_title_color', '', '2014-01-29 06:01:32'),
(18, 'footer_links_color', '', '2014-01-29 06:09:00'),
(19, 'footer_links_hover_color', '', '2014-01-29 06:09:00'),
(20, 'side_headings_color', '', '2014-01-29 06:15:46'),
(21, 'category_widget_bg_color', '', '2014-01-29 06:15:46'),
(22, 'category_widget_text_color', '', '2014-01-29 06:18:06'),
(23, 'link_color', '', '2014-01-29 06:18:06'),
(24, 'seller_widget_bg_color', '', '2014-01-29 06:21:19'),
(25, 'seller_widget_text_color', '', '2014-01-29 06:21:19'),
(26, 'user_page_tab_bg_color', '', '2014-01-29 06:29:55'),
(27, 'user_page_tab_bg_hover_color', '', '2014-01-29 06:29:55'),
(28, 'user_page_tab_active_bg_color', '', '2014-01-29 06:31:29'),
(29, 'user_page_tab_text_color', '', '2014-01-29 06:31:29'),
(30, 'user_page_active_tab_text_color', '', '2014-01-29 06:32:03'),
(31, 'user_page_tab_count_color', '', '2014-01-29 06:33:04'),
(32, 'username_color', '', '2014-01-29 06:41:18'),
(33, 'subheadings_color', '', '2014-01-29 06:42:28'),
(34, 'label_color', '', '2014-01-29 06:42:28'),
(35, 'form_comment_color', '', '2014-01-29 06:44:50'),
(36, 'settings_menu_active_bg_color', '', '2014-01-29 06:46:08'),
(37, 'settings_menu_active_text_color', '', '2014-01-29 06:46:08'),
(38, 'hidden_text_color', '', '2014-01-29 06:49:56')");
echo 'Create Upload'.mysql_query("CREATE TABLE `fc_upload_mails` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `user_name` text NOT NULL,
 `title` text NOT NULL,
 `comment` longtext NOT NULL,
 `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");

echo 'Alter Language'.mysql_query("ALTER TABLE  `fc_languages` ADD  `default` ENUM(  'no',  'yes' ) NOT NULL");
echo 'Alter CMS'.mysql_query("ALTER TABLE  `fc_cms` ADD  `priority` BIGINT NOT NULL");

mysql_close();

 ?>