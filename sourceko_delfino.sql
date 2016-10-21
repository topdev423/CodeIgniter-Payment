/*
Navicat MySQL Data Transfer

Source Server         : Bluehost MySQL
Source Server Version : 50542
Source Host           : ftp.source-kode.com:3306
Source Database       : sourceko_delfino

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-06-15 17:08:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for country_code
-- ----------------------------
DROP TABLE IF EXISTS `country_code`;
CREATE TABLE `country_code` (
  `Country` varchar(80) NOT NULL,
  `Code` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of country_code
-- ----------------------------

-- ----------------------------
-- Table structure for fc_admin
-- ----------------------------
DROP TABLE IF EXISTS `fc_admin`;
CREATE TABLE `fc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_admin
-- ----------------------------
INSERT INTO `fc_admin` VALUES ('1', '2013-07-17', '2016-06-15', 'admin', 'admin', 'sample@sample.com', 'super', 'a:10:{s:5:\"users\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:8:\"category\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:11:\"subcategory\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:7:\"product\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:6:\"slider\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:5:\"video\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:3:\"cms\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:5:\"order\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:10:\"statistics\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}s:10:\"newsletter\";a:4:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";}}', '2016-06-15 08:09:25', '2015-10-21 12:37:28', '222.127.94.6', 'Yes', 'Active');

-- ----------------------------
-- Table structure for fc_admin_settings
-- ----------------------------
DROP TABLE IF EXISTS `fc_admin_settings`;
CREATE TABLE `fc_admin_settings` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `site_contact_mail` varchar(200) NOT NULL,
  `site_contact_number` varchar(50) NOT NULL,
  `email_title` varchar(400) NOT NULL,
  `google_verification` varchar(500) NOT NULL,
  `google_verification_code` longtext NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `pinterest` varchar(500) NOT NULL,
  `googleplus_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(500) NOT NULL,
  `rss_link` varchar(500) NOT NULL,
  `youtube_link` varchar(500) NOT NULL,
  `footer_content` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_keyword` varchar(150) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `fevicon_image` varchar(255) NOT NULL,
  `facebook_api` varchar(100) NOT NULL,
  `facebook_secret_key` varchar(100) NOT NULL,
  `paypal_api_name` varchar(100) NOT NULL,
  `paypal_api_pw` varchar(100) NOT NULL,
  `paypal_api_key` varchar(100) NOT NULL,
  `authorize_net_key` varchar(100) NOT NULL,
  `paypal_id` varchar(500) NOT NULL,
  `paypal_live` enum('1','2') NOT NULL,
  `smtp_port` int(200) NOT NULL,
  `smtp_uname` varchar(200) NOT NULL,
  `smtp_password` varchar(200) NOT NULL,
  `consumer_key` varchar(500) NOT NULL,
  `consumer_secret` varchar(500) NOT NULL,
  `google_client_secret` varchar(500) NOT NULL,
  `google_client_id` varchar(500) NOT NULL,
  `google_redirect_url` varchar(500) NOT NULL,
  `google_developer_key` varchar(500) NOT NULL,
  `facebook_app_id` text NOT NULL,
  `facebook_app_secret` text NOT NULL,
  `like_text` mediumtext NOT NULL,
  `unlike_text` mediumtext NOT NULL,
  `liked_text` mediumtext NOT NULL,
  `fancyybox_banner` text NOT NULL,
  `sharing_name` text NOT NULL,
  `logo_site` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_admin_settings
-- ----------------------------
INSERT INTO `fc_admin_settings` VALUES ('1', 'sample@sample.com', '', 'Sexiest Shoppe', '', '', '', '', '', 'http://google.com', '', '', '', '&copy;  2015 Akara ', 'img-s1.jpg', 'Sexiest Shoppe', 'Sexiest Shoppe', 'Sexiest Shoppe', 'cc2ed7d98505681a281e61c34279c3ca.png', '', '', '', '', '', '', 'gopinath@teamtweaks.com', '2', '465', 'admin@teamtweaks.com', '', '', '', '', '', '', '', '', '', 'Rate it', 'Reset', 'Rated', '', '', 'd.png');

-- ----------------------------
-- Table structure for fc_attribute
-- ----------------------------
DROP TABLE IF EXISTS `fc_attribute`;
CREATE TABLE `fc_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attribute_seourl` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_attribute
-- ----------------------------
INSERT INTO `fc_attribute` VALUES ('1', 'color', 'Active', '2013-08-16 01:21:38', 'color');
INSERT INTO `fc_attribute` VALUES ('2', 'price', 'Active', '2013-08-16 01:21:44', 'price');

-- ----------------------------
-- Table structure for fc_banner_category
-- ----------------------------
DROP TABLE IF EXISTS `fc_banner_category`;
CREATE TABLE `fc_banner_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `link` mediumtext NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_banner_category
-- ----------------------------

-- ----------------------------
-- Table structure for fc_category
-- ----------------------------
DROP TABLE IF EXISTS `fc_category`;
CREATE TABLE `fc_category` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(500) NOT NULL,
  `rootID` int(20) NOT NULL,
  `seourl` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `cat_position` int(11) NOT NULL,
  `seo_title` longblob NOT NULL,
  `seo_keyword` longblob NOT NULL,
  `seo_description` longblob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_category
-- ----------------------------
INSERT INTO `fc_category` VALUES ('1', 'Mens', '0', 'mens', 'shop_men2.jpg', 'Active', '4', 0x4D656E73, 0x4D656E73, 0x4D656E73, '2013-07-23 07:00:00');
INSERT INTO `fc_category` VALUES ('2', 'Womens', '0', 'womens', 'shop_girls.jpg', 'Active', '5', 0x576F6D656E73, 0x576F6D656E73, 0x576F6D656E73, '2013-07-24 21:12:31');
INSERT INTO `fc_category` VALUES ('32', 'Pets', '0', 'pets', 'shop_pets.jpg', 'Active', '6', 0x50657473, 0x50657473, 0x50657473, '2013-07-31 23:36:38');
INSERT INTO `fc_category` VALUES ('45', 'T-Shirts', '44', 't-shirts', '', 'Active', '0', '', '', '', '2013-09-03 00:08:40');
INSERT INTO `fc_category` VALUES ('33', 'Kids', '0', 'kids', 'shop_kids.jpg', 'Active', '3', 0x4B696473, 0x4B696473, 0x4B696473, '2013-07-31 23:36:54');
INSERT INTO `fc_category` VALUES ('34', 'Home', '0', 'home', 'shop_men.jpg', 'Active', '1', 0x486F6D65, 0x486F6D65, 0x486F6D65, '2013-07-31 23:37:17');
INSERT INTO `fc_category` VALUES ('35', 'Gadgets', '0', 'gadgets', 'shop_girls1.jpg', 'Active', '8', 0x47616467657473, 0x47616467657473, 0x47616467657473, '2013-07-31 23:37:31');
INSERT INTO `fc_category` VALUES ('36', 'Art', '0', 'art', 'shop_kids1.jpg', 'Active', '9', 0x417274, 0x417274, 0x417274, '2013-07-31 23:37:51');
INSERT INTO `fc_category` VALUES ('37', 'Food', '0', 'food', 'shop_men1.jpg', 'Active', '2', 0x466F6F64, 0x466F6F64, 0x466F6F64, '2013-07-31 23:38:03');
INSERT INTO `fc_category` VALUES ('38', 'Media', '0', 'media', 'shop_men3.jpg', 'Active', '7', 0x4D65646961, 0x4D65646961, 0x4D65646961, '2013-07-31 23:38:16');
INSERT INTO `fc_category` VALUES ('39', 'Other', '0', 'other', 'shop_pets1.jpg', 'Active', '10', 0x4F74686572, 0x4F74686572, 0x4F74686572, '2013-07-31 23:38:30');
INSERT INTO `fc_category` VALUES ('44', 'Mens Collection', '1', 'mens-collection', '', 'Active', '0', '', '', '', '2013-09-03 00:08:16');
INSERT INTO `fc_category` VALUES ('56', 'Clothes', '1', 'clothes', '', 'Active', '0', '', '', '', '2013-09-09 21:29:54');
INSERT INTO `fc_category` VALUES ('58', 'Clothes', '32', 'clothes-5', '', 'Active', '0', '', '', '', '2013-09-09 21:30:40');
INSERT INTO `fc_category` VALUES ('48', 'Clothes', '33', 'clothes-2', '', 'Active', '0', '', '', '', '2013-09-09 19:29:17');
INSERT INTO `fc_category` VALUES ('55', 'Clothes', '2', 'clothes-1', '', 'Active', '0', '', '', '', '2013-09-09 21:28:17');
INSERT INTO `fc_category` VALUES ('52', 'Clothes', '51', 'clothes-4', '', 'Active', '0', '', '', '', '2013-09-09 21:26:52');
INSERT INTO `fc_category` VALUES ('57', 'Clothes', '44', 'clothes-3', '', 'Active', '0', '', '', '', '2013-09-09 21:30:10');
INSERT INTO `fc_category` VALUES ('59', 'foods', '33', 'foods', '', 'Active', '0', '', '', '', '2013-09-09 21:36:10');
INSERT INTO `fc_category` VALUES ('60', 'veg', '59', 'veg', '', 'Active', '0', '', '', '', '2013-09-09 21:36:31');

-- ----------------------------
-- Table structure for fc_cms
-- ----------------------------
DROP TABLE IF EXISTS `fc_cms`;
CREATE TABLE `fc_cms` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(500) NOT NULL,
  `page_title` varchar(200) NOT NULL,
  `seourl` blob NOT NULL,
  `hidden_page` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category` enum('Main','Sub') NOT NULL DEFAULT 'Main',
  `parent` int(11) NOT NULL DEFAULT '0',
  `meta_tag` varchar(500) NOT NULL,
  `meta_description` blob NOT NULL,
  `description` blob NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `priority` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_cms
-- ----------------------------
INSERT INTO `fc_cms` VALUES ('1', 'Privacy Policy', 'Privacy Policy', 0x707269766163792D706F6C696379, 'No', 'Main', '0', 'Privacy Policy', 0x5072697661637920506F6C696379205072697661637920506F6C696379205072697661637920506F6C6963795072697661637920506F6C696379205072697661637920506F6C696379, 0x3C703E5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C6963795072697661637920506F6C696379266E6273703B5072697661637920506F6C6963795072697661637920506F6C6963795072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C6963795072697661637920506F6C696379266E6273703B5072697661637920506F6C69637920266E6273703B5072697661637920506F6C696379266E6273703B5072697661637920506F6C6963795072697661637920506F6C696379266E6273703B5072697661637920506F6C696379266E6273703B3C2F703E, 'Publish', 'Privacy Policy', '0');
INSERT INTO `fc_cms` VALUES ('2', 'About Us', 'About Us', 0x61626F75742D7573, 'No', 'Main', '0', '', '', 0x3C703E41626F75742055733C2F703E, 'Publish', '', '0');
INSERT INTO `fc_cms` VALUES ('3', 'Andriod', 'Andriod', 0x616E6472696F64, 'No', 'Main', '0', '', '', 0x3C703E416E6472696F643C2F703E, 'Publish', '', '0');
INSERT INTO `fc_cms` VALUES ('4', 'Business', 'Business', 0x627573696E657373, 'No', 'Main', '0', '', '', 0x3C703E427573696E6573733C2F703E, 'Publish', '', '0');
INSERT INTO `fc_cms` VALUES ('5', 'FAQ', 'FAQ', 0x666171, 'No', 'Main', '0', '', '', 0x3C703E4641513C2F703E, 'Publish', '', '0');
INSERT INTO `fc_cms` VALUES ('6', 'Contact', 'Contact', 0x636F6E74616374, 'No', 'Main', '0', '', '', 0x3C703E436F6E746163743C2F703E, 'Publish', '', '0');
INSERT INTO `fc_cms` VALUES ('7', 'Ratings', 'ratings', 0x726174696E6773, 'No', 'Main', '0', '', '', 0x3C703E696E666F2061626F757420726174696E672073797374656D3C2F703E, 'Publish', '', '0');

-- ----------------------------
-- Table structure for fc_contact_seller
-- ----------------------------
DROP TABLE IF EXISTS `fc_contact_seller`;
CREATE TABLE `fc_contact_seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` longblob NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `selleremail` varchar(500) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fc_contact_seller
-- ----------------------------

-- ----------------------------
-- Table structure for fc_control
-- ----------------------------
DROP TABLE IF EXISTS `fc_control`;
CREATE TABLE `fc_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_control` enum('selling','affiliates','both') NOT NULL,
  `home_control` enum('classic','grid','compact') NOT NULL,
  `popup_control` enum('on','off') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_control
-- ----------------------------
INSERT INTO `fc_control` VALUES ('1', 'both', 'compact', 'off');

-- ----------------------------
-- Table structure for fc_country
-- ----------------------------
DROP TABLE IF EXISTS `fc_country`;
CREATE TABLE `fc_country` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `contid` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seourl` varchar(750) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_type` char(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `currency_symbol` text NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_tax` decimal(10,2) NOT NULL,
  `meta_title` blob NOT NULL,
  `meta_keyword` blob NOT NULL,
  `meta_description` blob NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'Active',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currency_default` enum('No','Yes') CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=233 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_country
-- ----------------------------
INSERT INTO `fc_country` VALUES ('1', 'EU', 'AD', 'Andorra', 'andorra', 'EUR', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 04:33:27', 'No');
INSERT INTO `fc_country` VALUES ('2', 'AS', 'AE', 'United Arab Emirates', 'united-arab-emirates', 'AED', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('3', 'AS', 'AF', 'Afghanistan', 'afghanistan', 'AFN', '₱', '3.00', '0.00', '', '', '', '', 'Active', '2013-09-13 21:38:13', 'No');
INSERT INTO `fc_country` VALUES ('4', 'NA', 'AG', 'Antigua And Barbuda', 'antigua-and-barbuda', 'XCD', '$', '2.00', '3.00', '', '', '', '', 'Active', '2013-08-21 23:08:52', 'No');
INSERT INTO `fc_country` VALUES ('5', 'EU', 'AL', 'Albania', 'albania', 'ALL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('6', 'AS', 'AM', 'Armenia', 'armenia', 'AMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('7', 'AF', 'AO', 'Angola', 'angola', 'AOA', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('8', 'AN', 'AQ', 'Antarctica', 'antarctica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('9', 'SA', 'AR', 'Argentina', 'argentina', 'ARS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('10', 'OC', 'AS', 'American Samoa', 'american-samoa', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('11', 'EU', 'AT', 'Austria', 'austria', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('12', 'OC', 'AU', 'Australia', 'australia', 'AUD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-09-06 01:40:37', 'No');
INSERT INTO `fc_country` VALUES ('13', 'NA', 'AW', 'Aruba', 'aruba', 'AWG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('14', '', 'AX', 'Aland Islands', 'aland-islands', 'EUR', '€', '0.00', '0.00', '', '', '', '', 'Active', '2013-10-23 05:38:07', 'Yes');
INSERT INTO `fc_country` VALUES ('15', 'AS', 'AZ', 'Azerbaijan', 'azerbaijan', 'AZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('16', '', 'BA', 'Bosnia And Herzegovina', 'bosnia-and-herzegovina', 'BAM', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('17', 'NA', 'BB', 'Barbados', 'barbados', 'BBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('18', 'AS', 'BD', 'Bangladesh', 'bangladesh', 'BDT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('19', 'EU', 'BE', 'Belgium', 'belgium', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('20', 'AF', 'BF', 'Burkina Faso', 'burkina-faso', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('21', 'EU', 'BG', 'Bulgaria', 'bulgaria', 'BGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('22', 'AS', 'BH', 'Bahrain', 'bahrain', 'BHD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('23', 'AF', 'BI', 'Burundi', 'burundi', 'BIF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('24', 'AF', 'BJ', 'Benin', 'benin', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('25', 'NA', 'BM', 'Bermuda', 'bermuda', 'BMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('26', '', 'BN', 'Brunei', 'brunei', 'BND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('27', 'SA', 'BO', 'Bolivia', 'bolivia', 'BOB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('28', '', 'BQ', 'Bonaire, Saint Eustatius And Saba ', 'bonaire,-saint-eustatius-and-saba', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('29', 'SA', 'BR', 'Brazil', 'brazil', 'BRL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('30', 'NA', 'BS', 'Bahamas', 'bahamas', 'BSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('31', 'AS', 'BT', 'Bhutan', 'bhutan', 'BTN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('32', 'AN', 'BV', 'Bouvet Island', 'bouvet-island', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('33', 'AF', 'BW', 'Botswana', 'botswana', 'BWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('34', 'EU', 'BY', 'Belarus', 'belarus', 'BYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('35', 'NA', 'BZ', 'Belize', 'belize', 'BZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('36', 'NA', 'CA', 'Canada', 'canada', 'CAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('37', '', 'CD', 'Democratic Republic Of The Congo', 'democratic-republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('38', 'AF', 'CF', 'Central African Republic', 'central-african-republic', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('39', '', 'CG', 'Republic Of The Congo', 'republic-of-the-congo', 'DRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('40', 'EU', 'CH', 'Switzerland', 'switzerland', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('41', '', 'CI', 'Ivory Coast', 'ivory-coast', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('42', 'SA', 'CL', 'Chile', 'chile', 'CLP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('43', 'AF', 'CM', 'Cameroon', 'cameroon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('44', 'AS', 'CN', 'China', 'china', 'CNY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('45', 'SA', 'CO', 'Colombia', 'colombia', 'COP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('46', 'NA', 'CR', 'Costa Rica', 'costa-rica', 'CRC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('47', 'NA', 'CU', 'Cuba', 'cuba', 'CUP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('48', 'AF', 'CV', 'Cape Verde', 'cape-verde', 'CVE', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('49', 'EU', 'CY', 'Cyprus', 'cyprus', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('50', 'EU', 'CZ', 'Czech Republic', 'czech-republic', 'CZK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('51', 'EU', 'DE', 'Germany', 'germany', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('52', 'AF', 'DJ', 'Djibouti', 'djibouti', 'DJF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('53', 'EU', 'DK', 'Denmark', 'denmark', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('54', 'NA', 'DM', 'Dominica', 'dominica', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('55', 'NA', 'DO', 'Dominican Republic', 'dominican-republic', 'DOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('56', 'AF', 'DZ', 'Algeria', 'algeria', 'DZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('57', 'SA', 'EC', 'Ecuador', 'ecuador', 'ECS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('58', 'EU', 'EE', 'Estonia', 'estonia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('59', 'AF', 'EG', 'Egypt', 'egypt', 'EGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('60', 'AF', 'EH', 'Western Sahara', 'western-sahara', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('61', 'AF', 'ER', 'Eritrea', 'eritrea', 'ERN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('62', 'EU', 'ES', 'Spain', 'spain', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('63', 'AF', 'ET', 'Ethiopia', 'ethiopia', 'ETB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('64', 'EU', 'FI', 'Finland', 'finland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('65', 'OC', 'FJ', 'Fiji', 'fiji', 'FJD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('66', '', 'FM', 'Micronesia', 'micronesia', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('67', 'EU', 'FO', 'Faroe Islands', 'faroe-islands', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('68', 'EU', 'FR', 'France', 'france', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('69', 'AF', 'GA', 'Gabon', 'gabon', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('70', 'EU', 'GB', 'United Kingdom', 'united-kingdom', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('71', 'NA', 'GD', 'Grenada', 'grenada', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('72', 'AS', 'GE', 'Georgia', 'georgia', 'GEL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('73', 'SA', 'GF', 'French Guiana', 'french-guiana', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('74', '', 'GG', 'Guernsey', 'guernsey', 'GGP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('75', 'AF', 'GH', 'Ghana', 'ghana', 'GHS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('76', 'NA', 'GL', 'Greenland', 'greenland', 'DKK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('77', 'AF', 'GM', 'Gambia', 'gambia', 'GMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('78', 'AF', 'GN', 'Guinea', 'guinea', 'GNF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('79', 'NA', 'GP', 'Guadeloupe', 'guadeloupe', 'EUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('80', 'AF', 'GQ', 'Equatorial Guinea', 'equatorial-guinea', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('81', 'EU', 'GR', 'Greece', 'greece', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('82', 'NA', 'GT', 'Guatemala', 'guatemala', 'QTQ', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('83', 'OC', 'GU', 'Guam', 'guam', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('84', 'AF', 'GW', 'Guinea-Bissau', 'guineabissau', 'GWP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('85', 'SA', 'GY', 'Guyana', 'guyana', 'GYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('86', 'AS', 'HK', 'Hong Kong', 'hong-kong', 'HKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('87', 'NA', 'HN', 'Honduras', 'honduras', 'HNL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('88', 'EU', 'HR', 'Croatia', 'croatia', 'HRK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('89', 'NA', 'HT', 'Haiti', 'haiti', 'HTG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('90', 'EU', 'HU', 'Hungary', 'hungary', 'HUF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('91', 'AS', 'ID', 'Indonesia', 'indonesia', 'IDR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('92', 'EU', 'IE', 'Ireland', 'ireland', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('93', 'AS', 'IL', 'Israel', 'israel', 'ILS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('94', '', 'IM', 'Isle Of Man', 'isle-of-man', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('95', 'AS', 'IN', 'India', 'india', 'INR', 'Rs', '15.00', '10.00', '', '', '', '', 'Active', '2013-08-21 23:09:55', 'No');
INSERT INTO `fc_country` VALUES ('96', 'AS', 'IO', 'British Indian Ocean Territory', 'british-indian-ocean-territory', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('97', 'AS', 'IQ', 'Iraq', 'iraq', 'IQD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('98', '', 'IR', 'Iran', 'iran', 'IRR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('99', 'EU', 'IS', 'Iceland', 'iceland', 'ISK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('100', 'EU', 'IT', 'Italy', 'italy', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('101', '', 'JE', 'Jersey', 'jersey', 'GBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('102', 'NA', 'JM', 'Jamaica', 'jamaica', 'JMD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('103', 'AS', 'JO', 'Jordan', 'jordan', 'JOD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('104', 'AS', 'JP', 'Japan', 'japan', 'JPY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('105', 'AF', 'KE', 'Kenya', 'kenya', 'KES', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('106', 'AS', 'KG', 'Kyrgyzstan', 'kyrgyzstan', 'KGS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('107', 'AS', 'KH', 'Cambodia', 'cambodia', 'KHR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('108', 'OC', 'KI', 'Kiribati', 'kiribati', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('109', 'AF', 'KM', 'Comoros', 'comoros', 'KMF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('110', 'NA', 'KN', 'Saint Kitts And Nevis', 'saint-kitts-and-nevis', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('111', '', 'KP', 'North Korea', 'north-korea', 'KPW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('112', '', 'KR', 'South Korea', 'south-korea', 'KRW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('113', 'AS', 'KW', 'Kuwait', 'kuwait', 'KWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('114', 'AS', 'KZ', 'Kazakhstan', 'kazakhstan', 'KZT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('115', '', 'LA', 'Laos', 'laos', 'LAK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('116', 'AS', 'LB', 'Lebanon', 'lebanon', 'LBP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('117', 'NA', 'LC', 'Saint Lucia', 'saint-lucia', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('118', 'EU', 'LI', 'Liechtenstein', 'liechtenstein', 'CHF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('119', 'AS', 'LK', 'Sri Lanka', 'sri-lanka', 'LKR', 'Rs', '20.00', '12.00', '', '', '', '', 'Active', '2013-08-21 23:35:34', 'No');
INSERT INTO `fc_country` VALUES ('120', 'AF', 'LR', 'Liberia', 'liberia', 'LRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('121', 'AF', 'LS', 'Lesotho', 'lesotho', 'LSL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('122', 'EU', 'LT', 'Lithuania', 'lithuania', 'LTL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('123', 'EU', 'LU', 'Luxembourg', 'luxembourg', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('124', 'EU', 'LV', 'Latvia', 'latvia', 'LVL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('125', '', 'LY', 'Libya', 'libya', 'LYD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('126', 'AF', 'MA', 'Morocco', 'morocco', 'MAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('127', 'EU', 'MC', 'Monaco', 'monaco', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('128', '', 'MD', 'Moldova', 'moldova', 'MDL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('129', '', 'ME', 'Montenegro', 'montenegro', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('130', 'AF', 'MG', 'Madagascar', 'madagascar', 'MGF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('131', 'OC', 'MH', 'Marshall Islands', 'marshall-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('132', '', 'MK', 'Macedonia', 'macedonia', 'MKD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('133', 'AF', 'ML', 'Mali', 'mali', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('134', 'AS', 'MM', 'Myanmar', 'myanmar', 'MMK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('135', 'AS', 'MN', 'Mongolia', 'mongolia', 'MNT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('136', '', 'MO', 'Macao', 'macao', 'MOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('137', 'OC', 'MP', 'Northern Mariana Islands', 'northern-mariana-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('138', 'NA', 'MQ', 'Martinique', 'martinique', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('139', 'AF', 'MR', 'Mauritania', 'mauritania', 'MRO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('140', 'NA', 'MS', 'Montserrat', 'montserrat', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('141', 'AF', 'MU', 'Mauritius', 'mauritius', 'MUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('142', 'AS', 'MV', 'Maldives', 'maldives', 'MVR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('143', 'AF', 'MW', 'Malawi', 'malawi', 'MWK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('144', 'NA', 'MX', 'Mexico', 'mexico', 'MXN', '', '0.00', '0.00', '', '', '', 0x3C703E3C7374726F6E673E54726176656C696E6720746F204D657869636F3C2F7374726F6E673E3C2F703E0D0A3C703E4D657869636F207661636174696F6E2072656E74616C7320616E64204D657869636F207661636174696F6E20686F6D6573206861766520696E6372656173656420696E20766F6C756D652C206173206861732074686520746F757269736D20696E64757374727920696E2074686520617265612E2054686973206973206F6E65206F6620746865206D6F737420706F70756C617220706C6163657320746F20766973697420696E207468652077686F6C65206F66204E6F7274682020416D657269636120616E64206974206973206561737920746F20736565207768792E204D657869636F20636F766572732061206875676520737572666163652061726561206F662061726F756E64203736302C30303020737175617265206D696C65732C207768696368206D65616E73207468657265206973206365727461696E6C79206E6F7420612073686F7274616765206F66207468696E677320746F2073656520616E6420646F20686572652E3C2F703E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E5468696E677320746F20646F20696E204D657869636F3C2F7374726F6E673E3C2F703E0D0A3C703E416674657220636865636B696E6720696E746F204D657869636F207661636174696F6E2072656E74616C7320616E64204D657869636F207661636174696F6E20686F6D65732C206C697374696E672074686520706C6163657320746F207669736974206973206365727461696E6C79206120776F727468207768696C65207468696E6720746F20646F2E204F6E65207468696E672074686174207468697320706C616365206973206B6E6F776E20666F7220697320686176696E6720736F6D65206772656174207369746573206F66206172636861656F6C6F676963616C20696E7465726573742C2077686963682061726520677265617420776974682070656F706C652074686174206C6F766520746F206578706C6F72652E2049742077617320686572652074686174206D616E7920646966666572656E7420666F726D73206F6620636F6D6D756E69636174696F6E207765726520646576656C6F7065642C20696E636C7564696E672077726974696E672E20416C6F6E677369646520746869732C206C6F7473206F662061726974686D6574696320616E6420617374726F6E6F6D7920626173656420646973636F7665726965732068617665206265656E206D6164652068657265206F766572207468652063656E7475726965732C207768696368206D616B6573207468697320616E20696E746572657374696E6720706C61636520746F20766973697420666F7220616C6C206F66207468652066616D696C792E3C2F703E0D0A3C703E266E6273703B3C2F703E0D0A3C703E4F6620636F757273652C206120766973697420746F2061204D657869636F207661636174696F6E2072656E74616C2077696C6C20616C6C6F772070656F706C6520746F206578706C6F726520736F6D65206F6620746865206D616E792062656163686573207468617420617265206F6E206F666665722E20546865207265616C6974792069732074686174207468657265206973206365727461696E6C79206E6F7420612073686F7274616765206F6620746F70207175616C697479206265616368657320746F206578706C6F72652E204D657869636F20697320686F6D6520746F2061726F756E6420362C303030206D696C6573206F6620636F617374206C696E652C207768696368206D65616E7320746861742074686572652061726520612067726561742072616E6765206F6620646966666572656E7420626561636865732C20696E636C7564696E6720636F7665732C2063617665732062757420616C736F20736D616C6C20626179732E20546865207761766573206865726520617265206E6F7420706172746963756C61726C79206C617267652C20627574206D616E79206F66207468652062656163686573206172652077656C6C206B6E6F776E20666F7220696E636F72706F726174696E67206578636974696E672077617465722073706F72747320696E746F20657665727920646179206C6966652E3C2F703E0D0A3C703E266E6273703B3C2F703E0D0A3C703E416C6F6E677369646520746865206265616368657320616E6420746865206D616E79206172636861656F6C6F676963616C20646973636F76657269657320746861742061726520776F727468206578706C6F72696E672C20616E6F74686572206F7074696F6E20697320746F20657870657269656E6365206D616E79206F662074686520616476656E7475726573207468617420617265206F6E206F666665722E204D657869636F2069732066756C6C206F6620746F7572206775696465732074686174207370656369616C69736520696E20616C6C207479706573206F66207468696E67732E205468697320696E636C7564657320746865206C696B6573206F662034783420746F7572732C2062757420616C736F206775696465642077616C6B7320616E64206D6F756E7461696E2062696B652072696465732E205468697320616C6C6F77732070656F706C6520746F206578706C6F7265207468697320677265617420706C616365207573696E6720646966666572656E7420666F726D73206F66207472616E73706F72742C20776869636820616C6C6F7773207468656D20746F20736565204D657869636F20696E20612077686F6C65206E6577206C696768742E204F6620636F757273652C2074686572652061726520706C656E7479206F66206F7074696F6E7320746F2063686F6F73652066726F6D20686572652E3C2F703E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E4163636F6D6D6F646174696F6E7320696E204D657869636F3C2F7374726F6E673E3C2F703E0D0A3C703E4163636F6D6D6F646174696F6E7320696E204D657869636F2068617665206265656E206120687567652070617274206F662068656C70696E6720746F2067726F772074686520746F757269736D20696E64757374727920686572652E20546865205269747A204361726C746F6E206973206365727461696E6C79206F6E65206F6620746865206772656174657220686F74656C7320696E2074686520617265612E204A75737420696E2066726F6E74206F662069742C2069732061726F756E6420312C3230306674206F662077686974652073616E64792062656163682C207768696368206D65616E732072656C6178696E672068657265206973206365727461696E6C79206E6F7420676F696E6720746F20626520646966666963756C742E20497420697320636F6E76656E69656E746C79206C6F63617465642C207768696368206D65616E73207468617420616C6C20746865206D616A6F722061747472616374696F6E73206172652077697468696E20612073686F72742064697374616E6365206F662074686520686F74656C20686572652E2054686520666163696C6974696573206865726520617265206D6F7265207468616E206C75787572696F757320616E6420746865792068656C702070656F706C6520746F2073656520746865207472756520626561757479206F66204D657869636F2E3C2F703E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E5765617468657220696E204D657869636F3C2F7374726F6E673E3C2F703E0D0A3C703E546865207765617468657220696E204D657869636F206973206B6E6F776E20666F72206265696E6720657863657074696F6E616C20647572696E67207468652073756D6D6572206D6F6E7468732C207768696368206D616B6573206974207065726665637420666F7220612073756D6D6572207661636174696F6E2E20447572696E67207468652073756D6D6572206D6F6E7468732C207468726F7567686F757420746869732067726561742064657374696E6174696F6E2C2076697369746F72732073686F756C64206578706563742074656D706572617475726573206F662061726F756E6420323820266465673B43207768696368206973207761726D2C20627574206365727461696E6C7920636F6D666F727461626C65206174207468652073616D652074696D652E20497420697320647572696E67207468652073756D6D6572206D6F6E746873207468617420746865206D616A6F72697479206F662074686520746F757269737473207468617420766973697420686572652E3C2F703E, 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('145', 'AS', 'MY', 'Malaysia', 'malaysia', 'MYR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('146', 'AF', 'MZ', 'Mozambique', 'mozambique', 'MZN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('147', 'AF', 'NA', 'Namibia', 'namibia', 'NAD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('148', 'OC', 'NC', 'New Caledonia', 'new-caledonia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('149', 'AF', 'NE', 'Niger', 'niger', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('150', 'AF', 'NG', 'Nigeria', 'nigeria', 'NGN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('151', 'NA', 'NI', 'Nicaragua', 'nicaragua', 'NIO', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('152', 'EU', 'NL', 'Netherlands', 'netherlands', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('153', 'EU', 'NO', 'Norway', 'norway', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('154', 'AS', 'NP', 'Nepal', 'nepal', 'NPR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('155', 'OC', 'NR', 'Nauru', 'nauru', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('156', 'OC', 'NZ', 'New Zealand', 'new-zealand', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('157', 'AS', 'OM', 'Oman', 'oman', 'OMR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('158', 'NA', 'PA', 'Panama', 'panama', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('159', 'SA', 'PE', 'Peru', 'peru', 'PEN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('160', 'OC', 'PF', 'French Polynesia', 'french-polynesia', 'CFP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('161', 'OC', 'PG', 'Papua New Guinea', 'papua-new-guinea', 'PGK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('162', 'AS', 'PH', 'Philippines', 'philippines', 'PHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('163', 'AS', 'PK', 'Pakistan', 'pakistan', 'PKR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('164', 'EU', 'PL', 'Poland', 'poland', 'PLN', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('165', '', 'PM', 'Saint Pierre And Miquelon', 'saint-pierre-and-miquelon', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('166', 'NA', 'PR', 'Puerto Rico', 'puerto-rico', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('167', '', 'PS', 'Palestinian Territory', 'palestinian-territory', 'PAB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('168', 'EU', 'PT', 'Portugal', 'portugal', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('169', 'OC', 'PW', 'Palau', 'palau', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('170', 'SA', 'PY', 'Paraguay', 'paraguay', 'PYG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('171', 'AS', 'QA', 'Qatar', 'qatar', 'QAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('172', 'AF', 'RE', 'Reunion', 'reunion', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('173', 'EU', 'RO', 'Romania', 'romania', 'RON', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('174', '', 'RS', 'Serbia', 'serbia', 'RSD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('175', '', 'RU', 'Russia', 'russia', 'RUB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('176', 'AF', 'RW', 'Rwanda', 'rwanda', 'RWF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('177', 'AS', 'SA', 'Saudi Arabia', 'saudi-arabia', 'SAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('178', 'OC', 'SB', 'Solomon Islands', 'solomon-islands', 'SBD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('179', 'AF', 'SC', 'Seychelles', 'seychelles', 'SCR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('180', 'AF', 'SD', 'Sudan', 'sudan', 'SDG', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('181', 'EU', 'SE', 'Sweden', 'sweden', 'SEK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('182', 'AS', 'SG', 'Singapore', 'singapore', 'SGD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('183', '', 'SH', 'Saint Helena', 'saint-helena', 'SHP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('184', 'EU', 'SI', 'Slovenia', 'slovenia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('185', '', 'SJ', 'Svalbard And Jan Mayen', 'svalbard-and-jan-mayen', 'NOK', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('186', '', 'SK', 'Slovakia', 'slovakia', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('187', 'AF', 'SL', 'Sierra Leone', 'sierra-leone', 'SLL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('188', 'EU', 'SM', 'San Marino', 'san-marino', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('189', 'AF', 'SN', 'Senegal', 'senegal', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('190', 'AF', 'SO', 'Somalia', 'somalia', 'SOS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('191', 'SA', 'SR', 'Suriname', 'suriname', 'SRD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('192', '', 'SS', 'South Sudan', 'south-sudan', 'SSP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('193', 'AF', 'ST', 'Sao Tome And Principe', 'sao-tome-and-principe', 'STD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('194', 'NA', 'SV', 'El Salvador', 'el-salvador', 'SVC', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('195', '', 'SY', 'Syria', 'syria', 'SYP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('196', 'AF', 'SZ', 'Swaziland', 'swaziland', 'SZL', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('197', 'AF', 'TD', 'Chad', 'chad', 'XAF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('198', 'AN', 'TF', 'French Southern Territories', 'french-southern-territories', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('199', 'AF', 'TG', 'Togo', 'togo', 'XOF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('200', 'AS', 'TH', 'Thailand', 'thailand', 'THB', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('201', 'AS', 'TJ', 'Tajikistan', 'tajikistan', 'TJS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('202', 'OC', 'TK', 'Tokelau', 'tokelau', 'NZD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('203', 'OC', 'TL', 'East Timor', 'east-timor', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('204', 'AS', 'TM', 'Turkmenistan', 'turkmenistan', 'TMT', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('205', 'AF', 'TN', 'Tunisia', 'tunisia', 'TND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('206', 'OC', 'TO', 'Tonga', 'tonga', 'TOP', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('207', 'AS', 'TR', 'Turkey', 'turkey', 'TRY', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('208', 'NA', 'TT', 'Trinidad And Tobago', 'trinidad-and-tobago', 'TTD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('209', 'OC', 'TV', 'Tuvalu', 'tuvalu', 'AUD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('210', 'AS', 'TW', 'Taiwan', 'taiwan', 'TWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('211', '', 'TZ', 'Tanzania', 'tanzania', 'TZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('212', 'EU', 'UA', 'Ukraine', 'ukraine', 'UAH', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('213', 'AF', 'UG', 'Uganda', 'uganda', 'UGX', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('214', 'OC', 'UM', 'United States Minor Outlying Islands', 'united-states-minor-outlying-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('215', 'NA', 'US', 'United States', 'united-states', 'USD', '$', '0.00', '0.00', '', '', '', '', 'Active', '2013-10-14 08:02:37', 'No');
INSERT INTO `fc_country` VALUES ('216', 'SA', 'UY', 'Uruguay', 'uruguay', 'UYU', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('217', 'AS', 'UZ', 'Uzbekistan', 'uzbekistan', 'UZS', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('218', 'NA', 'VC', 'Saint Vincent And The Grenadines', 'saint-vincent-and-the-grenadines', 'XCD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('219', 'SA', 'VE', 'Venezuela', 'venezuela', 'VEF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('220', '', 'VI', 'U.S. Virgin Islands', 'u.s.-virgin-islands', 'USD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('221', '', 'VN', 'Vietnam', 'vietnam', 'VND', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('222', 'OC', 'VU', 'Vanuatu', 'vanuatu', 'VUV', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('223', '', 'WF', 'Wallis And Futuna', 'wallis-and-futuna', 'XPF', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('224', 'OC', 'WS', 'Samoa', 'samoa', 'WST', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('225', '', 'XK', 'Kosovo', 'kosovo', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('226', 'AS', 'YE', 'Yemen', 'yemen', 'YER', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('227', 'AF', 'YT', 'Mayotte', 'mayotte', 'EUR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('228', 'AF', 'ZA', 'South Africa', 'south-africa', 'ZAR', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('229', 'AF', 'ZM', 'Zambia', 'zambia', 'ZMW', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('230', 'AF', 'ZW', 'Zimbabwe', 'zimbabwe', 'ZWD', '', '0.00', '0.00', '', '', '', '', 'Active', '2013-08-21 22:57:12', 'No');
INSERT INTO `fc_country` VALUES ('232', '', '', 'ffgh', 'ffgh', 'AUD', '$', '0.00', '0.00', '', '', '', '', 'InActive', '2014-01-27 07:07:09', 'No');

-- ----------------------------
-- Table structure for fc_couponcards
-- ----------------------------
DROP TABLE IF EXISTS `fc_couponcards`;
CREATE TABLE `fc_couponcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `price_type` enum('1','2','3') NOT NULL DEFAULT '1',
  `coupon_type` varchar(500) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `quantity` int(100) NOT NULL,
  `description` blob NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `product_id` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `purchase_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_couponcards
-- ----------------------------

-- ----------------------------
-- Table structure for fc_fancybox
-- ----------------------------
DROP TABLE IF EXISTS `fc_fancybox`;
CREATE TABLE `fc_fancybox` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `excerpt` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `likes` bigint(20) NOT NULL,
  `comments` bigint(20) NOT NULL,
  `shipping_cost` float(10,2) NOT NULL,
  `tax` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `price_range` mediumtext NOT NULL,
  `purchased` bigint(20) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL,
  `meta_title` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_fancybox
-- ----------------------------

-- ----------------------------
-- Table structure for fc_fancybox_temp
-- ----------------------------
DROP TABLE IF EXISTS `fc_fancybox_temp`;
CREATE TABLE `fc_fancybox_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_fancybox_temp
-- ----------------------------

-- ----------------------------
-- Table structure for fc_fancybox_uses
-- ----------------------------
DROP TABLE IF EXISTS `fc_fancybox_uses`;
CREATE TABLE `fc_fancybox_uses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `fancybox_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `price` float(10,2) NOT NULL,
  `fancy_ship_cost` float(10,2) NOT NULL,
  `fancy_tax_cost` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seourl` mediumtext NOT NULL,
  `category_id` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `status` enum('Pending','Paid','Expired') NOT NULL DEFAULT 'Pending',
  `shipping_id` int(11) NOT NULL,
  `invoice_no` varchar(150) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `trans_id` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_fancybox_uses
-- ----------------------------

-- ----------------------------
-- Table structure for fc_footer
-- ----------------------------
DROP TABLE IF EXISTS `fc_footer`;
CREATE TABLE `fc_footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_title` varchar(250) NOT NULL,
  `widget_name` longtext NOT NULL,
  `widget_link` longtext NOT NULL,
  `widget_icon` longtext NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_footer
-- ----------------------------

-- ----------------------------
-- Table structure for fc_giftcards
-- ----------------------------
DROP TABLE IF EXISTS `fc_giftcards`;
CREATE TABLE `fc_giftcards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `description` blob NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `used_amount` decimal(10,2) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_giftcards
-- ----------------------------

-- ----------------------------
-- Table structure for fc_giftcards_settings
-- ----------------------------
DROP TABLE IF EXISTS `fc_giftcards_settings`;
CREATE TABLE `fc_giftcards_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `amounts` varchar(200) NOT NULL,
  `default_amount` varchar(100) NOT NULL,
  `expiry_days` int(11) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_giftcards_settings
-- ----------------------------
INSERT INTO `fc_giftcards_settings` VALUES ('1', 'Fancyy Gift Card', 'The perfect present for any occasion. Send a Fancyy Gift Card today and let your friends choose what they love!', 'd342fa6bce0de522e7ae8f3ab672a279.png', '10,25,50,100,500,1000', '100', '90', 'Enable');
INSERT INTO `fc_giftcards_settings` VALUES ('2', 'Fancyy Gift Card', 'The perfect present for any occasion. Send a Fancyy Gift Card today and let your friends choose what they love!', '', '10,25,50,100,500,1000', '100', '90', 'Enable');

-- ----------------------------
-- Table structure for fc_giftcards_temp
-- ----------------------------
DROP TABLE IF EXISTS `fc_giftcards_temp`;
CREATE TABLE `fc_giftcards_temp` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_mail` varchar(200) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `sender_mail` varchar(200) NOT NULL,
  `price_value` float(10,2) NOT NULL,
  `description` blob NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `card_status` enum('redeemed','not used','expired') NOT NULL DEFAULT 'not used',
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_giftcards_temp
-- ----------------------------

-- ----------------------------
-- Table structure for fc_giftguide
-- ----------------------------
DROP TABLE IF EXISTS `fc_giftguide`;
CREATE TABLE `fc_giftguide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(15) NOT NULL,
  `category` varchar(25) NOT NULL,
  `price` text NOT NULL,
  `description` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_giftguide
-- ----------------------------

-- ----------------------------
-- Table structure for fc_languages
-- ----------------------------
DROP TABLE IF EXISTS `fc_languages`;
CREATE TABLE `fc_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang_code` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `default` enum('no','yes') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_languages
-- ----------------------------
INSERT INTO `fc_languages` VALUES ('1', 'English', 'en', 'Active', 'yes');
INSERT INTO `fc_languages` VALUES ('2', 'Català', 'ca', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('4', 'dansk', 'da', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('5', 'Deutsch', 'de', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('7', 'Español', 'es', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('8', 'Eesti', 'et', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('9', 'Basque', 'eu', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('10', 'Filipino', 'fil', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('11', 'français', 'fr', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('12', 'Indonesian', 'id', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('13', 'Íslenska', 'is', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('14', 'Italiano', 'it', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('15', 'Lithuanian', 'lt', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('16', 'Nederlands', 'nl', 'Active', 'no');
INSERT INTO `fc_languages` VALUES ('17', 'norsk', 'no', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('18', 'Polski', 'pl', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('19', 'Português (br)', 'br', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('20', 'Português (pt)', 'pt', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('23', 'Slovenský', 'sk', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('24', 'Suomi', 'fi', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('27', 'Türkçe', 'tr', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('30', 'srpski (latinica)', 'sr-latn', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('31', 'svenska', 'sv', 'Inactive', 'no');
INSERT INTO `fc_languages` VALUES ('32', 'Thai', 'th', 'Active', 'no');

-- ----------------------------
-- Table structure for fc_layout
-- ----------------------------
DROP TABLE IF EXISTS `fc_layout`;
CREATE TABLE `fc_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` varchar(250) NOT NULL,
  `text` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_layout
-- ----------------------------
INSERT INTO `fc_layout` VALUES ('1', 'welcome text', 0x57656C636F6D6520746F20536578696573742053686F707065);
INSERT INTO `fc_layout` VALUES ('2', 'welcome tag', 0x536564756374697665207374796C657320666F7220776F726B202620706C61792C207377696D2C20636C75622026206C696E67657269652E2E2E);
INSERT INTO `fc_layout` VALUES ('3', 'signup title', 0x4A6F696E206E6F77);
INSERT INTO `fc_layout` VALUES ('4', 'signup description', 0x4A6F696E20686572652E20536861726520616E642073656C6C2070726F64756374732061726F756E642074686520776F726C64);
INSERT INTO `fc_layout` VALUES ('5', 'login title', 0x4C6F67696E);
INSERT INTO `fc_layout` VALUES ('6', 'login description', 0x4A6F696E20686572652E20536861726520616E642073656C6C2070726F64756374732061726F756E642074686520776F726C64);

-- ----------------------------
-- Table structure for fc_list_values
-- ----------------------------
DROP TABLE IF EXISTS `fc_list_values`;
CREATE TABLE `fc_list_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `list_value` varchar(200) NOT NULL,
  `products` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers` longtext NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  `list_value_seourl` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_list_values
-- ----------------------------
INSERT INTO `fc_list_values` VALUES ('1', '0', 'hgfhj', '', '0', ' ', '0', 'hgfhj');
INSERT INTO `fc_list_values` VALUES ('2', '1', 'white', '', '0', '', '0', 'white');
INSERT INTO `fc_list_values` VALUES ('3', '1', 'red', '', '0', '', '0', 'red');
INSERT INTO `fc_list_values` VALUES ('4', '1', 'pink', '', '0', '', '0', 'pink');
INSERT INTO `fc_list_values` VALUES ('5', '1', 'purple', '', '0', '', '0', 'purple');
INSERT INTO `fc_list_values` VALUES ('6', '1', 'skyblue', '', '0', '', '0', 'skyblue');
INSERT INTO `fc_list_values` VALUES ('7', '0', 'green', '', '0', ' ', '0', 'green');
INSERT INTO `fc_list_values` VALUES ('8', '1', 'yellow', '', '0', '', '0', 'yellow');
INSERT INTO `fc_list_values` VALUES ('10', '0', 'fgh', '', '0', '', '0', 'fgh');
INSERT INTO `fc_list_values` VALUES ('11', '0', 'black', '', '0', '', '0', 'black');
INSERT INTO `fc_list_values` VALUES ('12', '1', 'silver', '', '0', '', '0', 'silver');
INSERT INTO `fc_list_values` VALUES ('13', '0', 'fghfgh', '', '0', '', '0', 'fghfgh');
INSERT INTO `fc_list_values` VALUES ('14', '2', '1-20', ',17', '1', '', '0', '1-20');
INSERT INTO `fc_list_values` VALUES ('15', '2', '21-100', ',1,8,20', '3', '', '0', '21-100');
INSERT INTO `fc_list_values` VALUES ('16', '2', '101-200', '', '0', '', '0', '101-200');
INSERT INTO `fc_list_values` VALUES ('17', '2', '201-500', ',2', '1', '', '0', '201-500');
INSERT INTO `fc_list_values` VALUES ('18', '2', '501+', ',3,4,21,22', '4', '', '0', '501');

-- ----------------------------
-- Table structure for fc_lists
-- ----------------------------
DROP TABLE IF EXISTS `fc_lists`;
CREATE TABLE `fc_lists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` longtext NOT NULL,
  `followers` longtext NOT NULL,
  `banner` varchar(200) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `contributors` longtext NOT NULL,
  `contributors_invited` longtext NOT NULL,
  `product_count` bigint(20) NOT NULL,
  `followers_count` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_lists
-- ----------------------------
INSERT INTO `fc_lists` VALUES ('1', 'Mens', '1', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('2', 'Mens', '2', '1426696436,1426707973,1445458659,1445458572', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('3', 'Kids', '2', '1445356332,1445459022,1465604372', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('4', 'Art', '2', ',1465601482,1465602002', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('5', 'Womens', '2', '1428143715,1445339406', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('6', 'Pets', '2', '1445356332,1445459139', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('7', 'Media', '2', '1445337654', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('8', 'Womens', '1', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('9', 'Kids', '1', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('10', 'Media', '1', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('11', 'Art', '1', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('12', 'Mens', '3', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('13', 'Gadgets', '2', ',1445459218', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('14', 'Mens', '4', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('15', 'Food', '2', ',1445336783', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('16', 'dvfdsfv', '4', '1445337654', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('17', 'dgdrg', '4', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('18', 'Home', '2', ',1445337848', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('19', 'Media', '4', '1445337654', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('20', 'Home', '4', '1445337848,1445337654', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('21', 'Mens Collection', '4', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('22', 'T-Shirts', '4', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('23', 'Womens', '4', '1445339406', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('24', 'Mens Collection', '2', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('25', 'T-Shirts', '2', '', '', '', '0', '', '', '0', '0');
INSERT INTO `fc_lists` VALUES ('26', 'Art', '4', '', '', '', '0', '', '', '0', '0');

-- ----------------------------
-- Table structure for fc_location
-- ----------------------------
DROP TABLE IF EXISTS `fc_location`;
CREATE TABLE `fc_location` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(1000) NOT NULL,
  `location_code` varchar(500) NOT NULL,
  `iso_code2` varchar(500) NOT NULL,
  `iso_code3` varchar(500) NOT NULL,
  `country_tax` float(10,2) NOT NULL,
  `country_ship` decimal(10,2) NOT NULL,
  `seourl` varchar(1000) NOT NULL,
  `currency_type` varchar(500) NOT NULL,
  `currency_symbol` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_location
-- ----------------------------
INSERT INTO `fc_location` VALUES ('1', 'IN', '', '', '', '5.00', '15.00', 'india', 'INR', 'Rs', 'InActive', '2013-07-26 04:10:15', '', '', '');
INSERT INTO `fc_location` VALUES ('3', 'USA', '', 'US', 'USA', '1.00', '0.00', 'usa', 'USD', '$', 'Active', '2013-07-26 12:00:00', 0x555341, 0x555341, 0x555341);
INSERT INTO `fc_location` VALUES ('6', 'Uk', '', '', '', '10.00', '10.00', 'uk', 'USD', '$', 'InActive', '2013-07-29 13:00:00', '', '', '');
INSERT INTO `fc_location` VALUES ('7', 'Australia', '', 'AU', '', '10.00', '20.00', 'australia', 'AUD', '$', 'InActive', '2013-08-21 11:00:00', '', '', '');

-- ----------------------------
-- Table structure for fc_newsletter
-- ----------------------------
DROP TABLE IF EXISTS `fc_newsletter`;
CREATE TABLE `fc_newsletter` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(5000) NOT NULL,
  `news_descrip` blob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `news_image` varchar(500) NOT NULL,
  `news_subject` varchar(1000) NOT NULL,
  `sender_name` varchar(500) NOT NULL,
  `sender_email` varchar(500) NOT NULL,
  `news_seourl` varchar(1000) NOT NULL,
  `typeVal` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_newsletter
-- ----------------------------
INSERT INTO `fc_newsletter` VALUES ('1', 'Notification Mail', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E4869207B2466756C6C5F6E616D657D2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20636F6D6D656E746564206F6E203C6120687265663D227B2470726F644C696E6B7D223E7B2470726F647563745F6E616D657D3C2F613E2E20546F20736565207B2466756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-02 00:00:00', '', 'Notification Mail', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('2', 'show you something', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E7B24756E616D657D2074686F7567687420796F7520776F756C64206C696B653C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E3C6120687265663D227B2475726C7D223E7B246E616D657D3C2F613E3C2F703E0D0A3C703E3C6120687265663D227B2475726C7D223E3C696D67207372633D227B2474696D6167657D2220616C743D2222202F3E3C2F613E3C2F703E0D0A3C703E7B246D73677D3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-29 00:00:00', '', 'wants to show you something on', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('16', 'invite friends', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E48692074686572652C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20696E766974656420796F75206F6E207B24736974655469746C657D2E20546F206A6F696E207B24736974655469746C657D266E6273703B3C6120687265663D227B626173655F75726C28297D3F7265663D7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-11-05 00:00:00', '', 'Invitation for join to Admire', 'Admire for google', 'vinu@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` VALUES ('3', 'Registration Confirmation', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E436F6E6669726D20796F757220656D61696C20616464726573733C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E3C6120687265663D227B2463666D75726C7D22207461726765743D225F626C616E6B223E436C69636B206865726520746F20636F6E6669726D20796F757220656D61696C206164647265737320696E207B24656D61696C5F7469746C657D2E3C2F613E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-29 00:00:00', '', 'Registration Confirmation', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('4', 'Password Reset', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E486572655C277320596F7572204E65772050617373776F72643C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E4861766520796F7520666F7267657474656E20796F75722070617373776F72643F20446F6E5C277420776F7272792E2057652061726520726573657420796F75722070617373776F72642E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E3C7374726F6E673E4E65772050617373776F7264203A3C2F7374726F6E673E207B247077647D3C2F703E0D0A3C703E596F752063616E206C6F67696E207573696E672061626F76652070617373776F726420616E64206368616E676520796F75722070617373776F726420696D6D6564696174656C792E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D20546865207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-29 00:00:00', '', 'Password Reset', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('5', 'Forgot Password', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E486572655C277320596F7572204E65772050617373776F72643C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E4861766520796F7520666F7267657474656E20796F75722070617373776F72643F20446F6E5C277420776F7272792E2057652061726520726573657420796F75722070617373776F72642E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E3C7374726F6E673E4E65772050617373776F7264203A3C2F7374726F6E673E207B247077647D3C2F703E0D0A3C703E596F752063616E206C6F67696E207573696E672061626F76652070617373776F726420616E64206368616E676520796F75722070617373776F726420696D6D6564696174656C792E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-02 00:00:00', '', 'Forgot Password', 'vinu', 'vinu@teamtweaks.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('6', 'send mail subcribers list', 0x3C646976207374796C653D2277696474683A2036303070783B206261636B67726F756E643A20234646464646463B206D617267696E3A2030206175746F3B20626F726465722D7261646975733A20313070783B20626F782D736861646F773A203020302035707820236363633B20626F726465723A2031707820736F6C696420234441374341463B223E0D0A3C646976207374796C653D226261636B67726F756E643A20236637663766373B2070616464696E673A20313070783B20626F726465722D7261646975733A20313070782031307078203020303B20746578742D616C69676E3A2063656E7465723B223E3C6120687265663D227B626173655F75726C28297D22207461726765743D225F626C616E6B223E3C696D67207374796C653D226D617267696E3A20357078203230707820307078203070783B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F5F696D6167657D2220626F726465723D22302220616C743D227B247469746C657D222077696474683D2232303522202F3E203C2F613E3C2F6469763E0D0A3C646976207374796C653D226261636B67726F756E643A20236666663B2070616464696E673A20313070783B2077696474683A2035383070783B223E0D0A3C646976207374796C653D22666F6E742D66616D696C793A204D79726961642050726F3B20666F6E742D73697A653A20323470783B20636F6C6F723A20236461376361663B2070616464696E672D626F74746F6D3A20313570783B20666F6E742D7765696768743A20626F6C643B223E7B246E6577735F7375626A6563747D3C2F6469763E0D0A3C646976207374796C653D22666F6E742D66616D696C793A204D79726961642050726F3B20666F6E742D73697A653A20313670783B20636F6C6F723A20233030303B2070616464696E672D626F74746F6D3A20313570783B206C696E652D6865696768743A20323470783B20746578742D616C69676E3A206A7573746966793B223E7B246E6577735F646573637269707D3C2F6469763E0D0A3C646976207374796C653D22666F6E742D66616D696C793A204D79726961642050726F3B20666F6E742D73697A653A20313670783B20636F6C6F723A20233030303B2070616464696E672D626F74746F6D3A20313570783B206C696E652D6865696768743A20323470783B20746578742D616C69676E3A206A7573746966793B223E496620796F75206861766520616E79207175657374696F6E7320706C6561736520656D61696C203C61207374796C653D22636F6C6F723A20233565613030383B20746578742D6465636F726174696F6E3A206E6F6E653B2220687265663D226D61696C746F3A7B24746869732D2667743B636F6E6669672D2667743B6974656D2827656D61696C27297D223E7B24656D61696C7D3C2F613E3C2F6469763E0D0A3C646976207374796C653D22666F6E742D66616D696C793A204D79726961642050726F3B20666F6E742D73697A653A20313870783B20636F6C6F723A20233030303B2070616464696E672D626F74746F6D3A20313570783B206C696E652D6865696768743A20323870783B223E53696E636572656C79202C203C6272202F3E204D616E6167656D656E743C2F6469763E0D0A3C2F6469763E0D0A3C2F6469763E, 'Active', '2013-10-30 00:00:00', '', 'send mail subcribers list', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('7', 'Follow User Details', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E4869207B2466756C6C5F6E616D657D2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20666F6C6C6F777320796F75206F6E207B24656D61696C5F7469746C657D2E20546F20736565207B246366756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-29 00:00:00', '', 'Follow User Details', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('15', 'giftcard', 0x3C7461626C653E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E0D0A3C7461626C653E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D225C2671756F743B2F61646D696E2F6E6577736C65747465722F656469745F6E6577736C65747465725F666F726D2F7B626173655F75726C28297D5C2671756F743B223E3C696D67207372633D222F696D616765732F6C6F676F2F646973636F76657265642E706E675C2220616C743D22205F6D63655F7372633D222077696474683D225C22206865696768743D225C22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E0D0A3C703E3C7370616E3E3C7374726F6E673E4869207B24726E616D657D2C3C2F7374726F6E673E3C2F7370616E3E3C2F703E0D0A3C703E3C7374726F6E673E57656C636F6D6520746F207B24736974655469746C657D2E3C2F7374726F6E673E3C2F703E0D0A3C703E7B2466756C6C5F6E616D657D2068617320676976656E20796F75206120476966742043617264206F6E203C7374726F6E673E7B24736974655469746C657D3C2F7374726F6E673E2E204E6F7720636F6D65206F7665722C20646973636F76657220736F6D657468696E67207265616C6C79206E69636520616E64206275792069742E3C2F703E0D0A3C703E506C6561736520757365207468697320756E6971756520636F64653A207B24636F64657D207768656E20706179696E6720616E64207370656E6420796F7572207B2470726963655F76616C75657D20776973656C792E20506C65617365206B65657020696E206D696E6420746861742074686973204769667420436172642077696C6C20657870697265206F6E207B246578706972795F646174652E7B3C2F703E0D0A3C703E7B2466756C6C5F6E616D657D2068617320696E636C756465642074686520666F6C6C6F77696E67206D65737361676520666F7220796F753A3C2F703E0D0A3C703E7B246465736372697074696F6E7D3C2F703E0D0A3C703E57616E7420746F20736179207468616E6B733F2053656E6420616E20656D61696C20686572653A207B24656D61696C7D3C2F703E0D0A3C703E3C7370616E3E3C7374726F6E673E48617070792073686F7070696E67213C2F7374726F6E673E3C2F7370616E3E3C2F703E0D0A3C703E746865266E6273703B2D207B24656D61696C5F7469746C657D205465616D3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642077696474683D225C223E0D0A3C703E3C7370616E3E53656E7420776974682028686529617274206279203C2F7370616E3E3C7370616E3E3C7374726F6E673E7B24736974655469746C657D3C2F7374726F6E673E3C2F7370616E3E3C7370616E3E2E3C2F7370616E3E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-24 00:00:00', '', 'Giftcard', 'Admire for google', 'vinu@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` VALUES ('8', 'Notification Mail for Comments', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E4869207B2466756C6C5F6E616D657D2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20636F6D6D656E746564206F6E203C6120687265663D227B2470726F644C696E6B7D223E7B2470726F647563745F6E616D657D3C2F613E2E20546F20736565207B246366756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-10-29 00:00:00', '', 'Notification Mail for Comments', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('9', 'Follows User Notification Mail', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E4869207B2466756C6C5F6E616D657D2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20666F6C6C6F777320796F75206F6E207B24656D61696C5F7469746C657D2E20546F20736565207B246366756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-07-25 00:00:00', '', 'Follows User Notification Mail', 'admin', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('10', 'Notification Mail Featured product', 0x3C7461626C65206267636F6C6F723D2223376461326331222077696474683D22363430222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D2230223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C652077696474683D22363130222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D223022207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D6720616C743D227B246D6574615F7469746C657D22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D22207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C65206267636F6C6F723D2223464646464646222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D2230223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E4869207B2466756C6C5F6E616D657D2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70222077696474683D2235302522207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B223E0D0A3C703E7B246366756C6C5F6E616D657D20666561747572656420796F75722070726F64756374203C6120687265663D227B2470726F644C696E6B7D223E7B2470726F647563745F6E616D657D3C2F613E2E20546F20736565207B246366756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C74642076616C69676E3D22746F70222077696474683D2235302522207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2013-07-26 00:00:00', '', 'Notification Mail Featured product', 'Fancy Clone', 'admin@gmail.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('11', 'new test', 0x736466736466, 'Active', '2013-07-26 00:00:00', '', 'send mail1', 'Fancy Clone', 'vinu@teamtweaks.com', '', '2');
INSERT INTO `fc_newsletter` VALUES ('18', 'Comment notification to admin', 0x3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D2236343022206267636F6C6F723D2223376461326331223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C65207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B2220626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D2230222077696474683D22363130223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D67207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D2220616C743D227B246D6574615F7469746C657D22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C6520626F726465723D2230222063656C6C73706163696E673D2230222063656C6C70616464696E673D223022206267636F6C6F723D2223464646464646223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E486920266E6273703B61646D696E2C3C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E7B2466756C6C5F6E616D657D20636F6D6D656E746564206F6E203C6120687265663D227B2470726F644C696E6B7D223E7B2470726F647563745F6E616D657D3C2F613E2E20546F20736565207B2466756C6C5F6E616D657D5C27732070726F66696C65203C6120687265663D227B626173655F75726C28297D757365722F7B24757365725F6E616D657D223E636C69636B20686572653C2F613E2E3C2F703E0D0A3C2F74643E0D0A3C7464207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B222077696474683D22353025222076616C69676E3D22746F70223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2014-01-27 00:00:00', '', 'New comment received for one product', 'Fancyclone V2 for google', 'vinu@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` VALUES ('19', 'Invoice', 0x3C646976207374796C653D2277696474683A203130313270783B206261636B67726F756E643A20234646464646463B206D617267696E3A2030206175746F3B223E0D0A3C646976207374796C653D2277696474683A20313030253B206261636B67726F756E643A20233435344235363B20666C6F61743A206C6566743B206D617267696E3A2030206175746F3B223E0D0A3C646976207374796C653D2270616464696E673A20323070782030203130707820313570783B20666C6F61743A206C6566743B2077696474683A203530253B223E3C612069643D226C6F676F22207461726765743D225F626C616E6B2220687265663D227B626173655F75726C28297D223E3C696D67207469746C653D227B246D6574615F7469746C657D2220616C743D227B246D6574615F7469746C657D22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D22202F3E3C2F613E3C2F6469763E0D0A3C2F6469763E0D0A3C646976207374796C653D2277696474683A2039373070783B206261636B67726F756E643A20234646464646463B20666C6F61743A206C6566743B2070616464696E673A20323070783B20626F726465723A2031707820736F6C696420233435344235363B223E0D0A3C646976207374796C653D22666C6F61743A2072696768743B2077696474683A203335253B206D617267696E2D626F74746F6D3A20323070783B206D617267696E2D72696768743A203770783B223E0D0A3C7461626C65207374796C653D22626F726465723A2031707820736F6C696420236365636563653B222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D2230222077696474683D2231303025223E0D0A3C74626F64793E0D0A3C7472206267636F6C6F723D2223663366336633223E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B222077696474683D223837223E3C7370616E207374796C653D22666F6E742D73697A653A20313370783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20746578742D616C69676E3A2063656E7465723B2077696474683A20313030253B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20666C6F61743A206C6566743B223E4F726465722049643C2F7370616E3E3C2F74643E0D0A3C74642077696474683D22313030223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A206E6F726D616C3B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B2077696474683A20313030253B20666C6F61743A206C6566743B223E237B24696E766F6963655F6E756D6265727D3C2F7370616E3E3C2F74643E0D0A3C2F74723E0D0A3C7472206267636F6C6F723D2223663366336633223E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B222077696474683D223837223E3C7370616E207374796C653D22666F6E742D73697A653A20313370783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20746578742D616C69676E3A2063656E7465723B2077696474683A20313030253B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20666C6F61743A206C6566743B223E4F7264657220446174653C2F7370616E3E3C2F74643E0D0A3C74642077696474683D22313030223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A206E6F726D616C3B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B2077696474683A20313030253B20666C6F61743A206C6566743B223E7B24696E766F6963655F646174657D3C2F7370616E3E3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F6469763E0D0A3C646976207374796C653D22666C6F61743A206C6566743B2077696474683A20313030253B223E0D0A3C646976207374796C653D2277696474683A203439253B20666C6F61743A206C6566743B20626F726465723A2031707820736F6C696420236363636363633B206D617267696E2D72696768743A20313070783B223E3C7370616E207374796C653D22626F726465722D626F74746F6D3A2031707820736F6C696420236363636363633B206261636B67726F756E643A20236633663366333B2077696474683A2039352E38253B20666C6F61743A206C6566743B2070616464696E673A20313070783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D73697A653A20313370783B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303330353B223E5368697070696E6720416464726573733C2F7370616E3E0D0A3C646976207374796C653D22666C6F61743A206C6566743B2070616464696E673A20313070783B2077696474683A203936253B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D73697A653A20313370783B20636F6C6F723A20233033303030323B206C696E652D6865696768743A20323870783B223E0D0A3C7461626C652063656C6C73706163696E673D2230222063656C6C70616464696E673D22302220626F726465723D2230222077696474683D2231303025223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E46756C6C204E616D653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F66756C6C6E616D657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E416464726573733C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F61646472657373317D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E4164647265737320323C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F61646472657373327D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E436974793C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F636974797D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E436F756E7472793C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F636F756E7472797D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E53746174653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F73746174657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E5A6970636F64653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F706F7374616C636F64657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E50686F6E65204E756D6265723C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B24736869705F70686F6E657D3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F6469763E0D0A3C2F6469763E0D0A3C646976207374796C653D2277696474683A203439253B20666C6F61743A206C6566743B20626F726465723A2031707820736F6C696420236363636363633B223E3C7370616E207374796C653D22626F726465722D626F74746F6D3A2031707820736F6C696420236363636363633B206261636B67726F756E643A20236633663366333B2077696474683A2039352E37253B20666C6F61743A206C6566743B2070616464696E673A20313070783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D73697A653A20313370783B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303330353B223E42696C6C696E6720416464726573733C2F7370616E3E0D0A3C646976207374796C653D22666C6F61743A206C6566743B2070616464696E673A20313070783B2077696474683A203936253B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D73697A653A20313370783B20636F6C6F723A20233033303030323B206C696E652D6865696768743A20323870783B223E0D0A3C7461626C652063656C6C73706163696E673D2230222063656C6C70616464696E673D22302220626F726465723D2230222077696474683D2231303025223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E46756C6C204E616D653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F66756C6C6E616D657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E416464726573733C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F61646472657373317D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E4164647265737320323C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F61646472657373327D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E436974793C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F636974797D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E436F756E7472793C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F636F756E7472797D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E53746174653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F73746174657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E5A6970636F64653C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F706F7374616C636F64657D3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E50686F6E65204E756D6265723C2F74643E0D0A3C74643E3A3C2F74643E0D0A3C74643E7B2462696C6C5F70686F6E657D3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F6469763E0D0A3C2F6469763E0D0A3C2F6469763E0D0A3C646976207374796C653D22666C6F61743A206C6566743B2077696474683A20313030253B206D617267696E2D72696768743A2033253B206D617267696E2D746F703A20313070783B20666F6E742D73697A653A20313470783B20666F6E742D7765696768743A206E6F726D616C3B206C696E652D6865696768743A20323870783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20636F6C6F723A20233030303B206F766572666C6F773A2068696464656E3B223E0D0A3C7461626C652063656C6C73706163696E673D2230222063656C6C70616464696E673D22302220626F726465723D2230222077696474683D2231303025223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2233223E0D0A3C7461626C65207374796C653D22626F726465723A2031707820736F6C696420236365636563653B2077696474683A2039392E35253B222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D2230222077696474683D2231303025223E0D0A3C74626F64793E0D0A3C7472206267636F6C6F723D2223663366336633223E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B20746578742D616C69676E3A2063656E7465723B222077696474683D22313725223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B223E426167204974656D733C2F7370616E3E3C2F74643E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B20746578742D616C69676E3A2063656E7465723B222077696474683D22343325223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B223E50726F64756374204E616D653C2F7370616E3E3C2F74643E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B20746578742D616C69676E3A2063656E7465723B222077696474683D22313225223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B223E5174793C2F7370616E3E3C2F74643E0D0A3C7464207374796C653D22626F726465722D72696768743A2031707820736F6C696420236365636563653B20746578742D616C69676E3A2063656E7465723B222077696474683D22313425223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B223E556E69742050726963653C2F7370616E3E3C2F74643E0D0A3C7464207374796C653D22746578742D616C69676E3A2063656E7465723B222077696474683D22313525223E3C7370616E207374796C653D22666F6E742D73697A653A20313270783B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B20666F6E742D7765696768743A20626F6C643B20636F6C6F723A20233030303030303B206C696E652D6865696768743A20333870783B20746578742D616C69676E3A2063656E7465723B223E53756220546F74616C3C2F7370616E3E3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F6469763E0D0A3C2F6469763E0D0A3C2F6469763E, 'Active', '2014-01-28 00:00:00', '', 'Invoice', 'Fancyclone V2 for google', 'vinu@teamtweaks.com', '', '1');
INSERT INTO `fc_newsletter` VALUES ('20', 'contactseller', 0x3C7461626C65206267636F6C6F723D2223376461326331222077696474683D22363430222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D2230223E0D0A3C74626F64793E0D0A3C74723E0D0A3C7464207374796C653D2270616464696E673A20343070783B223E0D0A3C7461626C652077696474683D22363130222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D223022207374796C653D22626F726465723A20233164343536372031707820736F6C69643B20666F6E742D66616D696C793A20417269616C2C2048656C7665746963612C2073616E732D73657269663B223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D223E3C696D6720616C743D227B246D6574615F7469746C657D22207372633D227B626173655F75726C28297D696D616765732F6C6F676F2F7B246C6F676F7D22207374796C653D226D617267696E3A20313570782035707820303B2070616464696E673A203070783B20626F726465723A206E6F6E653B22202F3E3C2F613E3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F70223E0D0A3C7461626C65206267636F6C6F723D2223464646464646222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D223022207374796C653D2277696474683A20313030253B223E0D0A3C74626F64793E0D0A3C74723E0D0A3C746420636F6C7370616E3D2232223E0D0A3C6833207374796C653D2270616464696E673A203130707820313570783B206D617267696E3A203070783B20636F6C6F723A20233064343837613B223E436F6E746163742053656C6C65723C2F68333E0D0A3C70207374796C653D2270616464696E673A203070782031357078203130707820313570783B20666F6E742D73697A653A20313270783B206D617267696E3A203070783B223E266E6273703B3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F7022207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B223E0D0A3C703E3C7374726F6E673E436F6E74616374204E616D65203A3C2F7374726F6E673E207B246E616D657D3C2F703E0D0A3C703E3C7374726F6E673E436F6E7461637420456D61696C203A3C2F7374726F6E673E207B24656D61696C7D3C2F703E0D0A3C703E3C7374726F6E673E436F6E746163742050686F6E65203A3C2F7374726F6E673E207B2470686F6E657D3C2F703E0D0A3C703E3C7374726F6E673E436F6E74616374205175657374696F6E203A3C2F7374726F6E673E207B247175657374696F6E7D3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C7461626C65206267636F6C6F723D2223464646464646222063656C6C70616464696E673D2230222063656C6C73706163696E673D22302220626F726465723D223022207374796C653D2277696474683A20313030253B223E0D0A3C74626F64793E0D0A3C74723E0D0A3C74643E50726F64756374204E616D653C2F74643E0D0A3C74643E50726F6475637420496D6167653C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74643E3C6120687265663D227B626173655F75726C28297D7468696E67732F7B2470726F6475637449647D2F7B2470726F6475637453656F75726C7D223E7B2470726F647563744E616D657D3C2F613E3C2F74643E0D0A3C74643E3C696D672077696474683D223130302220616C743D227B2470726F64756374496D6167657D22207372633D22696D616765732F70726F647563742F7B2470726F647563744E616D657D22202F3E3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C74723E0D0A3C74642076616C69676E3D22746F7022207374796C653D22666F6E742D73697A653A20313270783B2070616464696E673A203130707820313570783B223E0D0A3C703E266E6273703B3C2F703E0D0A3C703E3C7374726F6E673E2D207B24656D61696C5F7469746C657D205465616D3C2F7374726F6E673E3C2F703E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E0D0A3C2F74643E0D0A3C2F74723E0D0A3C2F74626F64793E0D0A3C2F7461626C653E, 'Active', '2014-02-19 00:00:00', '', 'Someone Contacts You', 'Fancyclone V2 for google', 'sample@sample.com', '', '1');

-- ----------------------------
-- Table structure for fc_notifications
-- ----------------------------
DROP TABLE IF EXISTS `fc_notifications`;
CREATE TABLE `fc_notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activity` mediumtext COLLATE utf8_bin NOT NULL,
  `activity_id` bigint(20) NOT NULL,
  `activity_ip` mediumtext COLLATE utf8_bin NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fc_notifications
-- ----------------------------
INSERT INTO `fc_notifications` VALUES ('1', '2015-03-18 04:36:33', '2', 0x6C696B65, '1426696436', 0x3138302E3139312E3136312E313433, '0', '1');
INSERT INTO `fc_notifications` VALUES ('3', '2015-03-18 07:46:19', '2', 0x6C696B65, '1426707973', 0x3138302E3139312E3136312E313433, '0', '1');
INSERT INTO `fc_notifications` VALUES ('19', '2015-04-04 10:44:43', '2', 0x6C696B65, '1428143715', 0x3138302E3139312E3138382E39, '0', '1');
INSERT INTO `fc_notifications` VALUES ('52', '2015-10-21 08:29:44', '2', 0x6C696B65, '1445458659', 0x3138302E3139312E3135392E323130, '0', '1');
INSERT INTO `fc_notifications` VALUES ('53', '2015-10-22 04:50:31', '2', 0x6C696B65, '1445459218', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('54', '2015-10-22 06:37:15', '2', 0x6665617475726564, '1445339406', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('55', '2015-10-22 06:41:27', '2', 0x6C696B65, '1445336783', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('56', '2015-10-22 06:41:29', '2', 0x6C696B65, '1445337848', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('38', '2015-10-20 12:12:28', '4', 0x6C696B65, '1445337654', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('39', '2015-10-20 12:13:36', '4', 0x6C696B65, '1445337848', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('43', '2015-10-20 12:36:07', '4', 0x6C696B65, '1445339406', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('44', '2015-10-20 01:19:39', '2', 0x6C696B65, '1445339406', 0x3138302E3139312E3135392E323130, '0', '1');
INSERT INTO `fc_notifications` VALUES ('45', '2015-10-20 01:26:28', '2', 0x6C696B65, '1445337654', 0x3132332E3233372E3133312E323438, '0', '1');
INSERT INTO `fc_notifications` VALUES ('46', '2015-10-20 03:52:49', '2', 0x6C696B65, '1445356332', 0x3138302E3139312E3135392E323130, '0', '1');
INSERT INTO `fc_notifications` VALUES ('57', '2016-06-09 11:41:57', '2', 0x6C696B65, '1445356332', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('58', '2016-06-09 03:16:41', '2', 0x6C696B65, '1445459139', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('59', '2016-06-09 04:21:21', '2', 0x6C696B65, '1445337654', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('60', '2016-06-09 05:42:17', '2', 0x6C696B65, '1445459022', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('61', '2016-06-09 05:42:20', '2', 0x6C696B65, '1445458572', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('62', '2016-06-10 11:31:30', '2', 0x6C696B65, '1465601482', 0x3138302E3139302E3131342E313632, '0', '1');
INSERT INTO `fc_notifications` VALUES ('63', '2016-06-11 01:24:32', '2', 0x6C696B65, '1465604372', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('64', '2016-06-11 01:24:34', '2', 0x6C696B65, '1465604257', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('65', '2016-06-11 01:38:42', '2', 0x6C696B65, '1465601833', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('66', '2016-06-11 02:56:49', '2', 0x6C696B65, '1465602002', 0x3232322E3132372E39342E39, '0', '1');
INSERT INTO `fc_notifications` VALUES ('67', '2016-06-11 04:24:35', '2', 0x6C696B65, '1465604145', 0x3232322E3132372E39342E38, '0', '1');
INSERT INTO `fc_notifications` VALUES ('68', '2016-06-12 12:17:01', '2', 0x6C696B65, '1465690614', 0x3232322E3132372E39342E34, '0', '1');
INSERT INTO `fc_notifications` VALUES ('69', '2016-06-12 05:26:03', '2', 0x6C696B65, '1465690478', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('70', '2016-06-12 05:26:33', '2', 0x6C696B65, '1465690291', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('71', '2016-06-12 05:31:07', '2', 0x6C696B65, '1465690291', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('72', '2016-06-14 09:13:10', '2', 0x6665617475726564, '1445458659', 0x3232322E3132372E39342E35, '0', '1');
INSERT INTO `fc_notifications` VALUES ('73', '2016-06-14 09:13:48', '2', 0x6665617475726564, '1445458659', 0x3232322E3132372E39342E3133, '0', '1');
INSERT INTO `fc_notifications` VALUES ('74', '2016-06-14 09:13:53', '2', 0x6665617475726564, '1445458659', 0x3232322E3132372E39342E3132, '0', '1');
INSERT INTO `fc_notifications` VALUES ('76', '2016-06-14 10:41:46', '2', 0x636F6D6D656E74, '1445458659', 0x3232322E3132372E39342E36, '2', '1');
INSERT INTO `fc_notifications` VALUES ('77', '2016-06-15 02:26:00', '2', 0x6C696B65, '1445459218', 0x33312E31382E3234382E313332, '0', '0');
INSERT INTO `fc_notifications` VALUES ('78', '2016-06-15 02:30:19', '2', 0x6C696B65, '1445337654', 0x33312E31382E3234382E313332, '0', '0');
INSERT INTO `fc_notifications` VALUES ('79', '2016-06-15 02:31:04', '2', 0x6C696B65, '1445337654', 0x33312E31382E3234382E313332, '0', '0');
INSERT INTO `fc_notifications` VALUES ('80', '2016-06-15 02:43:16', '5', 0x6C696B65, '1465601833', 0x33312E31382E3234382E313332, '0', '1');
INSERT INTO `fc_notifications` VALUES ('81', '2016-06-15 03:05:33', '2', 0x6C696B65, '1445459218', 0x33312E31382E3234382E313332, '0', '0');

-- ----------------------------
-- Table structure for fc_payment
-- ----------------------------
DROP TABLE IF EXISTS `fc_payment`;
CREATE TABLE `fc_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(100) NOT NULL,
  `sell_id` bigint(20) NOT NULL,
  `product_id` int(100) NOT NULL,
  `price` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `coupon_id` varchar(200) NOT NULL,
  `discountAmount` varchar(500) NOT NULL,
  `couponCode` varchar(500) NOT NULL,
  `coupontype` varchar(500) NOT NULL,
  `shippingid` int(16) NOT NULL,
  `indtotal` varchar(500) NOT NULL,
  `sumtotal` decimal(10,2) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `shippingcost` varchar(500) NOT NULL,
  `shippingcountry` varchar(500) NOT NULL,
  `shippingcity` varchar(500) NOT NULL,
  `shippingstate` varchar(500) NOT NULL,
  `paidVoucherStatus` enum('Not Verified','Verified') NOT NULL,
  `paypal_transaction_id` varchar(500) NOT NULL,
  `dealCodeNumber` varchar(500) NOT NULL,
  `inserttime` varchar(65) NOT NULL,
  `status` enum('Pending','Paid') NOT NULL,
  `shipping_date` date NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `shipping_status` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `note` blob NOT NULL,
  `order_gift` enum('0','1') NOT NULL DEFAULT '0',
  `payer_email` varchar(500) NOT NULL,
  `received_status` enum('Not received yet','Product received','Need refund') NOT NULL,
  `review_status` enum('Not open','Opened','Closed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_payment
-- ----------------------------
INSERT INTO `fc_payment` VALUES ('1', '2015-09-14 06:18:49', '2015-09-14 07:18:49', '2', '2', '8', '80.00', '1', 'Yes', '', '0', '0.00', '', '', '1', '80.00', '80.00', '660.00', '0.00', '0.00', 'GR', 'Santorini', 'greece', 'Not Verified', '', '51980741', '1442236729', 'Pending', '0000-00-00', '', 'Pending', '', '0', '0.00', '0.00', '', '0', '', 'Not received yet', 'Not open');
INSERT INTO `fc_payment` VALUES ('2', '2015-09-14 06:18:49', '2015-09-14 07:18:49', '2', '2', '4', '580.00', '1', 'Yes', '', '0', '0.00', '', '', '1', '580.00', '580.00', '660.00', '0.00', '0.00', 'GR', 'Santorini', 'greece', 'Not Verified', '', '51980741', '1442236729', 'Pending', '0000-00-00', '', 'Pending', '', '0', '0.00', '0.00', '', '0', '', 'Not received yet', 'Not open');

-- ----------------------------
-- Table structure for fc_payment_gateway
-- ----------------------------
DROP TABLE IF EXISTS `fc_payment_gateway`;
CREATE TABLE `fc_payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(200) NOT NULL,
  `settings` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_payment_gateway
-- ----------------------------
INSERT INTO `fc_payment_gateway` VALUES ('1', 'Paypal IPN', 'a:3:{s:4:\"mode\";s:7:\"sandbox\";s:14:\"merchant_email\";s:35:\"vinubusiness1-facilitator@gmail.com\";s:14:\"paypal_ipn_url\";s:11:\"www.ipn.net\";}', 'Enable');
INSERT INTO `fc_payment_gateway` VALUES ('2', 'Credit Card (Paypal)', 'a:4:{s:4:\"mode\";s:7:\"sandbox\";s:19:\"Paypal_API_Username\";s:40:\"sandbo_1215254764_biz_api1.angelleye.com\";s:19:\"paypal_api_password\";s:10:\"1215254774\";s:20:\"paypal_api_Signature\";s:56:\"AiKZhEEPLJjSIccz.2M.tbyW5YFwAb6E3l6my.pY9br1z2qxKx96W18v\";}', 'Enable');
INSERT INTO `fc_payment_gateway` VALUES ('3', 'Credit Card (Authorize.net)', 'a:3:{s:4:\"mode\";s:7:\"sandbox\";s:8:\"Login_ID\";s:8:\"3Vf82YuX\";s:15:\"Transaction_Key\";s:16:\"47UfHXH638bbH26m\";}', 'Enable');

-- ----------------------------
-- Table structure for fc_prduct_rating
-- ----------------------------
DROP TABLE IF EXISTS `fc_prduct_rating`;
CREATE TABLE `fc_prduct_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` smallint(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fc_prduct_rating
-- ----------------------------
INSERT INTO `fc_prduct_rating` VALUES ('59', '6', '1445336783', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('67', '10', '1465690614', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('70', '7', '1465602002', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('71', '7', '1445459139', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('99', '5', '1465604257', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('101', '5', '1465604372', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('108', '6', '1465690478', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('121', '4', '1445459218', '5', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('126', '7', '1465690291', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('131', '7', '1445458572', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('132', '7', '1445339406', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('133', '7', '1445458659', '2', null, null);
INSERT INTO `fc_prduct_rating` VALUES ('136', '5', '1445337654', '2', null, '31.18.248.132');
INSERT INTO `fc_prduct_rating` VALUES ('137', '7', '1465601833', '2', null, '31.18.248.132');
INSERT INTO `fc_prduct_rating` VALUES ('138', '7', '1445459218', '2', null, '31.18.248.132');

-- ----------------------------
-- Table structure for fc_pricing
-- ----------------------------
DROP TABLE IF EXISTS `fc_pricing`;
CREATE TABLE `fc_pricing` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `pricing_from` int(50) NOT NULL,
  `pricing_to` int(50) NOT NULL,
  `price_range` varchar(250) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_pricing
-- ----------------------------
INSERT INTO `fc_pricing` VALUES ('10', '1', '100', '1 - 100', 'Active');
INSERT INTO `fc_pricing` VALUES ('11', '101', '200', '101 - 200', 'Active');
INSERT INTO `fc_pricing` VALUES ('12', '201', '300', '201 - 300', 'Active');
INSERT INTO `fc_pricing` VALUES ('13', '301', '500', '301 - 500', 'Active');
INSERT INTO `fc_pricing` VALUES ('14', '501', '1000', '501 - 1000', 'Active');
INSERT INTO `fc_pricing` VALUES ('15', '1001', '100000', '1001 - 100000', 'Active');

-- ----------------------------
-- Table structure for fc_product
-- ----------------------------
DROP TABLE IF EXISTS `fc_product`;
CREATE TABLE `fc_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `price_range` varchar(100) NOT NULL,
  `sale_price` decimal(20,2) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `weight` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `max_quantity` int(11) NOT NULL DEFAULT '1',
  `purchasedCount` int(11) NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `shipping_type` enum('Shippable','Not Shippable') NOT NULL,
  `shipping_cost` decimal(6,2) NOT NULL,
  `taxable_type` enum('Taxable','Not Taxable') NOT NULL,
  `tax_cost` decimal(6,2) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `option` longtext NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `comment_count` bigint(20) NOT NULL,
  `ship_immediate` enum('false','true') NOT NULL,
  `shipping_policies` longtext NOT NULL,
  `short_url_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product
-- ----------------------------
INSERT INTO `fc_product` VALUES ('20', '1445339406', '2015-10-22 00:20:58', '0000-00-00 00:00:00', 'test', 'test', '', '', '', '', '2', '88.88', '21-100', '80.00', 'tumblr_nvmpnsp7fK1stijv1o1_540.jpg', '<p>test</p>', '', '20', '1', '0', 'Publish', 'Shippable', '0.00', 'Taxable', '0.00', '', '', '2', '0', '', '', '0', 'false', '', '0');
INSERT INTO `fc_product` VALUES ('21', '1445459218', '2015-10-22 00:32:05', '0000-00-00 00:00:00', 'Retro Wally', 'Retro-Wally', '', '', '', '', '35', '50000000.00', '501+', '45000000.00', 'Retro_Wally.jpg', '<p>boat</p>', '', '20', '1', '0', 'Publish', 'Shippable', '0.00', 'Taxable', '0.00', '', '', '2', '0', '', '', '0', 'false', '', '0');
INSERT INTO `fc_product` VALUES ('22', '1445458659', '2015-10-22 01:09:25', '0000-00-00 00:00:00', 'Porsche 911', 'Porsche-911', '', '', '', '', '1', '120000.00', '501+', '118000.00', 'P15_0783_a5_rgb-1024x683.jpg', '<p><span>At Frankfurt, the Mission E concept was powered by a pair of permanent magnet synchronous motors teaming up for about 590 hp (440 kW). That power number and the acceleration estimate of 3.5 seconds for the 0-62 mph (100 km/h) sprint aren\'t quite in the same league as the world class 918, but they\'re nothing to scoff at and sound about right for an all-electric Porsche four-seater.</span></p>', '', '4', '1', '0', 'Publish', 'Shippable', '0.00', 'Taxable', '0.00', '', '', '2', '1', '', '', '0', 'false', '', '0');

-- ----------------------------
-- Table structure for fc_product_attribute
-- ----------------------------
DROP TABLE IF EXISTS `fc_product_attribute`;
CREATE TABLE `fc_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(500) NOT NULL,
  `attr_seourl` varchar(500) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for fc_product_category
-- ----------------------------
DROP TABLE IF EXISTS `fc_product_category`;
CREATE TABLE `fc_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product_category
-- ----------------------------

-- ----------------------------
-- Table structure for fc_product_comments
-- ----------------------------
DROP TABLE IF EXISTS `fc_product_comments`;
CREATE TABLE `fc_product_comments` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `product_id` int(200) NOT NULL,
  `comments` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product_comments
-- ----------------------------
INSERT INTO `fc_product_comments` VALUES ('2', '2', '1445458659', 0x5468697320617265612061626F7665206973206A757374206B696E6473207573656C657373207761737465206F662073706163652E2E205368697070696E6720, 'Active', '2016-06-14 10:41:15');

-- ----------------------------
-- Table structure for fc_product_feedback
-- ----------------------------
DROP TABLE IF EXISTS `fc_product_feedback`;
CREATE TABLE `fc_product_feedback` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `voter_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `rating` int(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longblob NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for fc_product_likes
-- ----------------------------
DROP TABLE IF EXISTS `fc_product_likes`;
CREATE TABLE `fc_product_likes` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `product_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_product_likes
-- ----------------------------
INSERT INTO `fc_product_likes` VALUES ('1', '1426696436', '2', '2015-03-18 10:36:33', '180.191.161.143');
INSERT INTO `fc_product_likes` VALUES ('3', '1426707973', '2', '2015-03-18 13:46:19', '180.191.161.143');
INSERT INTO `fc_product_likes` VALUES ('16', '1428143715', '2', '2015-04-04 04:44:43', '180.191.188.9');
INSERT INTO `fc_product_likes` VALUES ('34', '1445337654', '4', '2015-10-20 06:12:28', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('35', '1445337848', '4', '2015-10-20 06:13:36', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('39', '1445339406', '4', '2015-10-20 06:36:07', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('40', '1445339406', '2', '2015-10-20 07:19:39', '180.191.159.210');
INSERT INTO `fc_product_likes` VALUES ('48', '1445458659', '2', '2015-10-21 14:29:44', '180.191.159.210');
INSERT INTO `fc_product_likes` VALUES ('49', '1445459218', '2', '2015-10-21 22:50:31', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('50', '1445336783', '2', '2015-10-22 00:41:27', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('51', '1445337848', '2', '2015-10-22 00:41:29', '123.237.131.248');
INSERT INTO `fc_product_likes` VALUES ('52', '1445356332', '2', '2016-06-09 05:41:57', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('53', '1445459139', '2', '2016-06-09 09:16:41', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('54', '1445337654', '2', '2016-06-09 10:21:21', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('55', '1445459022', '2', '2016-06-09 11:42:17', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('56', '1445458572', '2', '2016-06-09 11:42:20', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('57', '1465601482', '2', '2016-06-10 17:31:30', '180.190.114.162');
INSERT INTO `fc_product_likes` VALUES ('58', '1465604372', '2', '2016-06-11 07:24:32', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('59', '1465604257', '2', '2016-06-11 07:24:34', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('60', '1465601833', '2', '2016-06-11 07:38:42', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('61', '1465602002', '2', '2016-06-11 08:56:49', '222.127.94.9');
INSERT INTO `fc_product_likes` VALUES ('62', '1465604145', '2', '2016-06-11 10:24:35', '222.127.94.8');
INSERT INTO `fc_product_likes` VALUES ('63', '1465690614', '2', '2016-06-11 18:17:02', '222.127.94.4');
INSERT INTO `fc_product_likes` VALUES ('64', '1465690478', '2', '2016-06-12 11:26:03', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('66', '1465690291', '2', '2016-06-12 11:31:07', '31.18.248.132');
INSERT INTO `fc_product_likes` VALUES ('67', '1445458659', '5', '2016-06-14 18:37:42', '202.50.52.10');

-- ----------------------------
-- Table structure for fc_review_comments
-- ----------------------------
DROP TABLE IF EXISTS `fc_review_comments`;
CREATE TABLE `fc_review_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deal_code` mediumtext NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `commentor_id` bigint(20) NOT NULL,
  `comment` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_from` enum('user','seller','admin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_review_comments
-- ----------------------------

-- ----------------------------
-- Table structure for fc_shipping_address
-- ----------------------------
DROP TABLE IF EXISTS `fc_shipping_address`;
CREATE TABLE `fc_shipping_address` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `nick_name` varchar(200) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `phone` bigint(9) NOT NULL,
  `primary` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_shipping_address
-- ----------------------------
INSERT INTO `fc_shipping_address` VALUES ('1', '2', 'dj delfino', 'dj', '1000 ocean drive', '', 'Santorini', 'greece', 'GR', '1000', '1111111111', 'Yes');

-- ----------------------------
-- Table structure for fc_shopping_carts
-- ----------------------------
DROP TABLE IF EXISTS `fc_shopping_carts`;
CREATE TABLE `fc_shopping_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `indtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `is_coupon_used` enum('Yes','No') NOT NULL DEFAULT 'No',
  `couponID` int(200) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `coupontype` varchar(100) NOT NULL,
  `cate_id` varchar(100) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `product_shipping_cost` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `product_tax_cost` decimal(10,2) NOT NULL,
  `attribute_values` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_shopping_carts
-- ----------------------------
INSERT INTO `fc_shopping_carts` VALUES ('1', '2015-03-24 21:26:34', '2015-03-24 15:26:34', '303463', '2', '1', '89.99', '1', '0.00', '89.99', '89.99', 'No', '0', '', '', '1', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('58', '2015-10-17 06:15:38', '2015-10-17 00:15:38', '2', '2', '1', '89.99', '1', '0.00', '89.99', '89.99', 'No', '0', '', '', '1', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('56', '2015-09-28 04:34:57', '2015-09-28 21:14:57', '2', '2', '8', '80.00', '3', '0.00', '240.00', '240.00', 'No', '0', '', '', '38', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('48', '2015-09-23 11:34:02', '2015-09-23 05:34:02', '1', '2', '1', '89.99', '1', '0.00', '89.99', '89.99', 'No', '0', '', '', '1', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('11', '2015-09-10 15:40:13', '2015-09-10 09:40:13', '610484', '2', '3', '799.00', '1', '0.00', '799.00', '799.00', 'No', '0', '', '', '33', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('59', '2015-10-20 13:06:59', '2015-10-20 07:06:59', '2', '0', '18', '100.00', '1', '0.00', '100.00', '100.00', 'No', '0', '', '', '1', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('60', '2015-10-22 06:29:44', '2015-10-22 00:29:44', '2', '2', '20', '80.00', '1', '0.00', '80.00', '80.00', 'No', '0', '', '', '2', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('61', '2015-10-22 06:34:31', '2015-10-22 00:34:31', '2', '2', '21', '45000000.00', '1', '0.00', '45000000.00', '45000000.00', 'No', '0', '', '', '35', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `fc_shopping_carts` VALUES ('62', '2015-10-22 07:09:42', '2015-10-22 01:09:42', '2', '2', '22', '118000.00', '1', '0.00', '118000.00', '118000.00', 'No', '0', '', '', '1', '0.00', '0.00', '0.00', '0.00', '0');

-- ----------------------------
-- Table structure for fc_short_url
-- ----------------------------
DROP TABLE IF EXISTS `fc_short_url`;
CREATE TABLE `fc_short_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_url` mediumtext NOT NULL,
  `long_url` longtext NOT NULL,
  `view_count` int(11) NOT NULL,
  `status` enum('Publish','Unpublish') NOT NULL DEFAULT 'Publish',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_short_url
-- ----------------------------
INSERT INTO `fc_short_url` VALUES ('183', 'uplPys', 'http://codebases.com/fancy-v2/user/kiran/things/1425293075/hgh', '0', 'Publish', '2015-03-02 03:44:35', '0', '0');
INSERT INTO `fc_short_url` VALUES ('184', 'Aa0CqY', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426696436/Nike-Dunk', '0', 'Publish', '2015-03-18 10:33:56', '0', '0');
INSERT INTO `fc_short_url` VALUES ('185', 'di2sEO', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426706850/stormtrooper', '0', 'Publish', '2015-03-18 13:27:30', '0', '0');
INSERT INTO `fc_short_url` VALUES ('186', 'eFj3S6', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426707973/Nike-Dunks', '0', 'Publish', '2015-03-18 13:46:13', '0', '0');
INSERT INTO `fc_short_url` VALUES ('187', 'O3po9L', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426708070/Nike-Dunk-Euro-Low-Tony-Parker-Limited-Edition', '0', 'Publish', '2015-03-18 13:47:50', '0', '0');
INSERT INTO `fc_short_url` VALUES ('188', 'WQkYA0', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426708188/Iridescence', '0', 'Publish', '2015-03-18 13:49:48', '0', '0');
INSERT INTO `fc_short_url` VALUES ('189', 'J6mZ7i', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426708325/Ring', '0', 'Publish', '2015-03-18 13:52:05', '0', '0');
INSERT INTO `fc_short_url` VALUES ('190', 'Ps43l5', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426708468/Star-light', '0', 'Publish', '2015-03-18 13:54:28', '0', '0');
INSERT INTO `fc_short_url` VALUES ('191', 'Wl8eMi', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426708548/Foot-print', '0', 'Publish', '2015-03-18 13:55:48', '0', '0');
INSERT INTO `fc_short_url` VALUES ('192', 'ydiZAS', 'http://codebases.com/fancy-v2/user/djdelfino/things/1426739647/Animated-GIF', '0', 'Publish', '2015-03-18 22:34:07', '0', '0');
INSERT INTO `fc_short_url` VALUES ('193', '3k5dO8', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1428133978/native', '0', 'Publish', '2015-04-04 01:52:58', '0', '0');
INSERT INTO `fc_short_url` VALUES ('194', '0tsI16', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1428143715/Black-Bikini', '0', 'Publish', '2015-04-04 04:35:15', '0', '0');
INSERT INTO `fc_short_url` VALUES ('195', 'Xcu2Da', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1428395534/Emerald', '0', 'Publish', '2015-04-07 02:32:14', '0', '0');
INSERT INTO `fc_short_url` VALUES ('196', 'RuO3hc', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1431502442/gif', '0', 'Publish', '2015-05-13 01:34:02', '0', '0');
INSERT INTO `fc_short_url` VALUES ('197', 'OGWV6c', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440468652/Memory-stick', '0', 'Publish', '2015-08-24 20:10:52', '0', '0');
INSERT INTO `fc_short_url` VALUES ('198', 'eYF4V5', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440468777/Adidas', '0', 'Publish', '2015-08-24 20:12:57', '0', '0');
INSERT INTO `fc_short_url` VALUES ('199', '3TEFKj', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440468859/Apple-watch', '0', 'Publish', '2015-08-24 20:14:19', '0', '0');
INSERT INTO `fc_short_url` VALUES ('200', 'A6jbwI', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440470531/Gucci', '0', 'Publish', '2015-08-24 20:42:11', '0', '0');
INSERT INTO `fc_short_url` VALUES ('201', 'o6ytMg', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440470579/A7rII', '0', 'Publish', '2015-08-24 20:42:59', '0', '0');
INSERT INTO `fc_short_url` VALUES ('202', '0pADFu', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440470656/Bikini', '0', 'Publish', '2015-08-24 20:44:16', '0', '0');
INSERT INTO `fc_short_url` VALUES ('203', 'tMT0im', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1440470840/Shoes', '0', 'Publish', '2015-08-24 20:47:20', '0', '0');
INSERT INTO `fc_short_url` VALUES ('204', '9qf80o', 'http://www.codebases.com/fancy-v2/things/5/test1', '0', 'Publish', '2015-08-24 23:38:22', '0', '0');
INSERT INTO `fc_short_url` VALUES ('205', 'MxKemp', 'http://www.codebases.com/fancy-v2/things/6/tesgint', '0', 'Publish', '2015-08-24 23:49:51', '0', '0');
INSERT INTO `fc_short_url` VALUES ('206', 'MNBRir', 'http://www.codebases.com/fancy-v2/things/7/test2', '0', 'Publish', '2015-08-24 23:53:34', '0', '0');
INSERT INTO `fc_short_url` VALUES ('207', 'BF4W3p', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1441597112/Citrus', '0', 'Publish', '2015-09-06 21:38:32', '0', '0');
INSERT INTO `fc_short_url` VALUES ('208', '8IABei', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1441597224/Green-dress', '0', 'Publish', '2015-09-06 21:40:24', '0', '0');
INSERT INTO `fc_short_url` VALUES ('209', 'Rh6usS', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1441760705/Skull-suit', '0', 'Publish', '2015-09-08 19:05:05', '0', '0');
INSERT INTO `fc_short_url` VALUES ('210', '3lZ42D', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1442238256/Gucci-Bra', '0', 'Publish', '2015-09-14 07:44:16', '0', '0');
INSERT INTO `fc_short_url` VALUES ('211', 'tOM3nd', 'http://www.codebases.com/fancy-v2/things/9/testing', '0', 'Publish', '2015-10-18 04:08:20', '0', '0');
INSERT INTO `fc_short_url` VALUES ('212', 'n5EBqu', 'http://www.codebases.com/fancy-v2/things/10/asasa', '0', 'Publish', '2015-10-18 04:29:19', '0', '0');
INSERT INTO `fc_short_url` VALUES ('213', 'mYIdn5', 'http://www.codebases.com/fancy-v2/things/11/sddsdsdsds', '0', 'Publish', '2015-10-18 04:30:28', '0', '0');
INSERT INTO `fc_short_url` VALUES ('214', 'gL0ONz', 'http://www.codebases.com/fancy-v2/things/12/sdsdsds', '0', 'Publish', '2015-10-18 04:34:52', '0', '0');
INSERT INTO `fc_short_url` VALUES ('215', 'CdFJ3E', 'http://www.codebases.com/fancy-v2/things/13/asas', '0', 'Publish', '2015-10-18 04:38:15', '0', '0');
INSERT INTO `fc_short_url` VALUES ('216', '8hOv1T', 'http://www.codebases.com/fancy-v2/things/14/wew', '0', 'Publish', '2015-10-19 23:11:48', '0', '0');
INSERT INTO `fc_short_url` VALUES ('217', 'j9Rsmw', 'http://www.codebases.com/fancy-v2/things/15/asasa', '0', 'Publish', '2015-10-19 23:28:42', '0', '0');
INSERT INTO `fc_short_url` VALUES ('218', 'F2r6wD', 'http://www.codebases.com/fancy-v2/things/16/asas', '0', 'Publish', '2015-10-19 23:33:07', '0', '0');
INSERT INTO `fc_short_url` VALUES ('219', '5U3NHq', 'http://www.codebases.com/fancy-v2/things/17/asasa', '0', 'Publish', '2015-10-19 23:39:23', '0', '0');
INSERT INTO `fc_short_url` VALUES ('220', 'NpMJXx', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445328718/540x675', '0', 'Publish', '2015-10-20 02:11:58', '0', '0');
INSERT INTO `fc_short_url` VALUES ('221', 'IjKJGb', 'http://www.codebases.com/fancy-v2/things/18/a-testing-mahr', '0', 'Publish', '2015-10-20 03:13:39', '0', '0');
INSERT INTO `fc_short_url` VALUES ('222', 'mZXId4', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445332563/test', '0', 'Publish', '2015-10-20 03:16:03', '0', '0');
INSERT INTO `fc_short_url` VALUES ('223', 'Km65yp', 'http://www.codebases.com/fancy-v2/things/19/a-test2', '0', 'Publish', '2015-10-20 03:21:17', '0', '0');
INSERT INTO `fc_short_url` VALUES ('224', 'BVW0UF', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445334713/asas', '0', 'Publish', '2015-10-20 03:51:53', '0', '0');
INSERT INTO `fc_short_url` VALUES ('225', 'sVHfol', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445336325/Proashahgshg', '0', 'Publish', '2015-10-20 04:18:45', '0', '0');
INSERT INTO `fc_short_url` VALUES ('226', 'ApQ3HJ', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445336498/aaaaaaaaaaaa', '0', 'Publish', '2015-10-20 04:21:38', '0', '0');
INSERT INTO `fc_short_url` VALUES ('227', '4vmlGd', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445336783/ok', '0', 'Publish', '2015-10-20 04:26:23', '0', '0');
INSERT INTO `fc_short_url` VALUES ('228', 'fuBUYW', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445337654/Travel', '0', 'Publish', '2015-10-20 04:40:54', '0', '0');
INSERT INTO `fc_short_url` VALUES ('229', 'keDS2i', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445337848/5', '0', 'Publish', '2015-10-20 04:44:08', '0', '0');
INSERT INTO `fc_short_url` VALUES ('230', 'f35m0P', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445339406/test', '0', 'Publish', '2015-10-20 05:10:06', '0', '0');
INSERT INTO `fc_short_url` VALUES ('231', '7fOc6M', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445356332/chrome', '0', 'Publish', '2015-10-20 09:52:12', '0', '0');
INSERT INTO `fc_short_url` VALUES ('232', '1jSsAq', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445416896/Product-Details-Can-be-changed-later', '0', 'Publish', '2015-10-21 02:41:36', '0', '0');
INSERT INTO `fc_short_url` VALUES ('233', '9EX6ve', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445420619/Nike-Dunk-Euro-Low-Tony-Parker-Limited-Edition', '0', 'Publish', '2015-10-21 03:43:39', '0', '0');
INSERT INTO `fc_short_url` VALUES ('234', 'OqV4K1', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445458572/Porsche-911', '0', 'Publish', '2015-10-21 14:16:12', '0', '0');
INSERT INTO `fc_short_url` VALUES ('235', 'aZDBzK', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445458659/Porsche-911', '0', 'Publish', '2015-10-21 14:17:39', '0', '0');
INSERT INTO `fc_short_url` VALUES ('236', 'hBHNod', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445459022/Mars-Rover', '0', 'Publish', '2015-10-21 14:23:42', '0', '0');
INSERT INTO `fc_short_url` VALUES ('237', '0kGysV', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445459139/Turtle', '0', 'Publish', '2015-10-21 14:25:39', '0', '0');
INSERT INTO `fc_short_url` VALUES ('238', 'RlXLaJ', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445459218/Retro-Wally', '0', 'Publish', '2015-10-21 14:26:58', '0', '0');
INSERT INTO `fc_short_url` VALUES ('239', '1vWmw8', 'http://www.codebases.com/fancy-v2/user/djdelfino/things/1445467306/29f', '0', 'Publish', '2015-10-21 16:41:46', '0', '0');
INSERT INTO `fc_short_url` VALUES ('240', '7knLhM', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465601237/Geometry', '0', 'Publish', '2016-06-10 17:27:17', '0', '0');
INSERT INTO `fc_short_url` VALUES ('241', '0flVkw', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465601482/Greece', '0', 'Publish', '2016-06-10 17:31:22', '0', '0');
INSERT INTO `fc_short_url` VALUES ('242', 'ImEk9Z', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465601833/Pinecone', '0', 'Publish', '2016-06-10 17:37:13', '0', '0');
INSERT INTO `fc_short_url` VALUES ('243', 'WwX2ol', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465602002/Einstien', '0', 'Publish', '2016-06-10 17:40:02', '0', '0');
INSERT INTO `fc_short_url` VALUES ('244', 'kfwDX0', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465604145/Pyramid-Yatch', '0', 'Publish', '2016-06-10 18:15:45', '0', '0');
INSERT INTO `fc_short_url` VALUES ('245', 'lh45RI', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465604257/Office', '0', 'Publish', '2016-06-10 18:17:37', '0', '0');
INSERT INTO `fc_short_url` VALUES ('246', 'TsClk6', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465604372/Arch20-Helicopter', '0', 'Publish', '2016-06-10 18:19:32', '0', '0');
INSERT INTO `fc_short_url` VALUES ('247', '5eS1OM', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465690291/Apple-Watch', '0', 'Publish', '2016-06-11 18:11:31', '0', '0');
INSERT INTO `fc_short_url` VALUES ('248', 'PaHndX', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465690478/Shoe', '0', 'Publish', '2016-06-11 18:14:38', '0', '0');
INSERT INTO `fc_short_url` VALUES ('249', '9MepWV', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465690537/Gucci', '0', 'Publish', '2016-06-11 18:15:37', '0', '0');
INSERT INTO `fc_short_url` VALUES ('250', '6OTR5t', 'http://source-kode.com/staging/implementation/delfino/user/djdelfino/things/1465690614/Adidas', '0', 'Publish', '2016-06-11 18:16:54', '0', '0');

-- ----------------------------
-- Table structure for fc_state_tax
-- ----------------------------
DROP TABLE IF EXISTS `fc_state_tax`;
CREATE TABLE `fc_state_tax` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(500) NOT NULL,
  `state_code` varchar(500) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` datetime NOT NULL,
  `state_tax` float(10,2) NOT NULL,
  `country_id` int(100) NOT NULL,
  `country_code` varchar(500) NOT NULL,
  `country_name` varchar(500) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_state_tax
-- ----------------------------

-- ----------------------------
-- Table structure for fc_subadmin
-- ----------------------------
DROP TABLE IF EXISTS `fc_subadmin`;
CREATE TABLE `fc_subadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `admin_name` varchar(24) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `admin_type` enum('super','sub') NOT NULL DEFAULT 'super',
  `privileges` text NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(16) NOT NULL,
  `is_verified` enum('No','Yes') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_subadmin
-- ----------------------------

-- ----------------------------
-- Table structure for fc_subproducts
-- ----------------------------
DROP TABLE IF EXISTS `fc_subproducts`;
CREATE TABLE `fc_subproducts` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attr_id` int(11) NOT NULL,
  `attr_name` text NOT NULL,
  `attr_price` decimal(10,2) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_subproducts
-- ----------------------------

-- ----------------------------
-- Table structure for fc_subscribers_list
-- ----------------------------
DROP TABLE IF EXISTS `fc_subscribers_list`;
CREATE TABLE `fc_subscribers_list` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `subscrip_mail` varchar(500) NOT NULL,
  `active` int(255) NOT NULL,
  `status` enum('Active','InActive') NOT NULL,
  `dateAdded` date NOT NULL,
  `verification_mail` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_subscribers_list
-- ----------------------------
INSERT INTO `fc_subscribers_list` VALUES ('1', 'djdelfino@gmail.com', '0', 'Active', '0000-00-00', '');
INSERT INTO `fc_subscribers_list` VALUES ('2', 'vvrahul@ymail.com', '0', 'Active', '0000-00-00', '');
INSERT INTO `fc_subscribers_list` VALUES ('3', 'krishna_bhatta@outlook.com', '0', 'Active', '0000-00-00', '');

-- ----------------------------
-- Table structure for fc_theme_layout
-- ----------------------------
DROP TABLE IF EXISTS `fc_theme_layout`;
CREATE TABLE `fc_theme_layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` mediumtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_theme_layout
-- ----------------------------
INSERT INTO `fc_theme_layout` VALUES ('1', 'header_bg', '', '2014-01-28 04:08:51');
INSERT INTO `fc_theme_layout` VALUES ('2', 'header_border_color', '', '2014-01-28 04:08:51');
INSERT INTO `fc_theme_layout` VALUES ('3', 'header_text_color', '', '2014-01-28 04:09:51');
INSERT INTO `fc_theme_layout` VALUES ('4', 'header_text_color_hover', '', '2014-01-28 04:09:51');
INSERT INTO `fc_theme_layout` VALUES ('5', 'body_bg_color', '', '2014-01-28 04:17:08');
INSERT INTO `fc_theme_layout` VALUES ('6', 'content_bg_color', '', '2014-01-28 04:17:08');
INSERT INTO `fc_theme_layout` VALUES ('7', 'product_title_color', '', '2014-01-28 04:44:34');
INSERT INTO `fc_theme_layout` VALUES ('8', 'product_price_color', '', '2014-01-28 04:44:34');
INSERT INTO `fc_theme_layout` VALUES ('9', 'body_text_color', '', '2014-01-28 06:28:56');
INSERT INTO `fc_theme_layout` VALUES ('10', 'seller_name_color', '', '2014-01-28 22:33:35');
INSERT INTO `fc_theme_layout` VALUES ('11', 'welcome_text_color', '', '2014-01-28 22:33:35');
INSERT INTO `fc_theme_layout` VALUES ('12', 'welcome_tag_color', '', '2014-01-28 22:44:35');
INSERT INTO `fc_theme_layout` VALUES ('13', 'menu_hover_color', '', '2014-01-28 22:44:35');
INSERT INTO `fc_theme_layout` VALUES ('14', 'jump_to_top_color', '', '2014-01-28 23:01:21');
INSERT INTO `fc_theme_layout` VALUES ('15', 'jump_to_top_bg_color', '', '2014-01-28 23:01:21');
INSERT INTO `fc_theme_layout` VALUES ('16', 'footer_bg_color', '', '2014-01-28 23:01:32');
INSERT INTO `fc_theme_layout` VALUES ('17', 'footer_widget_title_color', '', '2014-01-28 23:01:32');
INSERT INTO `fc_theme_layout` VALUES ('18', 'footer_links_color', '#b8b0b0', '2014-01-28 23:09:00');
INSERT INTO `fc_theme_layout` VALUES ('19', 'footer_links_hover_color', '#899394', '2014-01-28 23:09:00');
INSERT INTO `fc_theme_layout` VALUES ('20', 'side_headings_color', '', '2014-01-28 23:15:46');
INSERT INTO `fc_theme_layout` VALUES ('21', 'category_widget_bg_color', '', '2014-01-28 23:15:46');
INSERT INTO `fc_theme_layout` VALUES ('22', 'category_widget_text_color', '', '2014-01-28 23:18:06');
INSERT INTO `fc_theme_layout` VALUES ('23', 'link_color', '', '2014-01-28 23:18:06');
INSERT INTO `fc_theme_layout` VALUES ('24', 'seller_widget_bg_color', '', '2014-01-28 23:21:19');
INSERT INTO `fc_theme_layout` VALUES ('25', 'seller_widget_text_color', '', '2014-01-28 23:21:19');
INSERT INTO `fc_theme_layout` VALUES ('26', 'user_page_tab_bg_color', '', '2014-01-28 23:29:55');
INSERT INTO `fc_theme_layout` VALUES ('27', 'user_page_tab_bg_hover_color', '', '2014-01-28 23:29:55');
INSERT INTO `fc_theme_layout` VALUES ('28', 'user_page_tab_active_bg_color', '', '2014-01-28 23:31:29');
INSERT INTO `fc_theme_layout` VALUES ('29', 'user_page_tab_text_color', '', '2014-01-28 23:31:29');
INSERT INTO `fc_theme_layout` VALUES ('30', 'user_page_active_tab_text_color', '', '2014-01-28 23:32:03');
INSERT INTO `fc_theme_layout` VALUES ('31', 'user_page_tab_count_color', '', '2014-01-28 23:33:04');
INSERT INTO `fc_theme_layout` VALUES ('32', 'username_color', '', '2014-01-28 23:41:18');
INSERT INTO `fc_theme_layout` VALUES ('33', 'subheadings_color', '', '2014-01-28 23:42:28');
INSERT INTO `fc_theme_layout` VALUES ('34', 'label_color', '', '2014-01-28 23:42:28');
INSERT INTO `fc_theme_layout` VALUES ('35', 'form_comment_color', '', '2014-01-28 23:44:50');
INSERT INTO `fc_theme_layout` VALUES ('36', 'settings_menu_active_bg_color', '', '2014-01-28 23:46:08');
INSERT INTO `fc_theme_layout` VALUES ('37', 'settings_menu_active_text_color', '', '2014-01-28 23:46:08');
INSERT INTO `fc_theme_layout` VALUES ('38', 'hidden_text_color', '', '2014-01-28 23:49:56');

-- ----------------------------
-- Table structure for fc_transaction
-- ----------------------------
DROP TABLE IF EXISTS `fc_transaction`;
CREATE TABLE `fc_transaction` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `payment_cycle` varchar(500) NOT NULL,
  `txn_type` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `next_payment_date` varchar(500) NOT NULL,
  `residence_country` varchar(500) NOT NULL,
  `initial_payment_amount` varchar(500) NOT NULL,
  `currency_code` varchar(500) NOT NULL,
  `time_created` varchar(500) NOT NULL,
  `verify_sign` varchar(750) NOT NULL,
  `period_type` varchar(500) NOT NULL,
  `payer_status` varchar(500) NOT NULL,
  `test_ipn` varchar(500) NOT NULL,
  `tax` varchar(500) NOT NULL,
  `payer_email` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `receiver_email` varchar(500) NOT NULL,
  `payer_id` varchar(500) NOT NULL,
  `product_type` varchar(500) NOT NULL,
  `shipping` varchar(500) NOT NULL,
  `amount_per_cycle` varchar(500) NOT NULL,
  `profile_status` varchar(500) NOT NULL,
  `charset` varchar(500) NOT NULL,
  `notify_version` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL,
  `outstanding_balance` varchar(500) NOT NULL,
  `recurring_payment_id` varchar(500) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `custom_values` varchar(500) NOT NULL,
  `ipn_track_id` varchar(500) NOT NULL,
  `tran_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fc_transaction
-- ----------------------------

-- ----------------------------
-- Table structure for fc_upload_mails
-- ----------------------------
DROP TABLE IF EXISTS `fc_upload_mails`;
CREATE TABLE `fc_upload_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `title` text NOT NULL,
  `comment` longtext NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_upload_mails
-- ----------------------------

-- ----------------------------
-- Table structure for fc_upload_requests
-- ----------------------------
DROP TABLE IF EXISTS `fc_upload_requests`;
CREATE TABLE `fc_upload_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` blob NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_upload_requests
-- ----------------------------

-- ----------------------------
-- Table structure for fc_user_activity
-- ----------------------------
DROP TABLE IF EXISTS `fc_user_activity`;
CREATE TABLE `fc_user_activity` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(200) NOT NULL,
  `activity_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_user_activity
-- ----------------------------
INSERT INTO `fc_user_activity` VALUES ('1', 'fancy', '1426696436', '2', '2015-03-18 10:36:33', '180.191.161.143');
INSERT INTO `fc_user_activity` VALUES ('3', 'fancy', '1426707973', '2', '2015-03-18 13:46:19', '180.191.161.143');
INSERT INTO `fc_user_activity` VALUES ('18', 'fancy', '1428143715', '2', '2015-04-04 04:44:43', '180.191.188.9');
INSERT INTO `fc_user_activity` VALUES ('39', 'fancy', '1445337654', '4', '2015-10-20 06:12:28', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('40', 'fancy', '1445337848', '4', '2015-10-20 06:13:36', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('44', 'fancy', '1445339406', '4', '2015-10-20 06:36:07', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('45', 'fancy', '1445339406', '2', '2015-10-20 07:19:39', '180.191.159.210');
INSERT INTO `fc_user_activity` VALUES ('46', 'fancy', '1445337654', '2', '2015-10-20 07:26:28', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('47', 'fancy', '1445356332', '2', '2015-10-20 09:52:49', '180.191.159.210');
INSERT INTO `fc_user_activity` VALUES ('50', 'unfancy', '1445356332', '2', '2015-10-20 09:58:02', '180.191.159.210');
INSERT INTO `fc_user_activity` VALUES ('55', 'fancy', '1445458659', '2', '2015-10-21 14:29:44', '180.191.159.210');
INSERT INTO `fc_user_activity` VALUES ('56', 'fancy', '1445459218', '2', '2015-10-21 22:50:31', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('57', 'fancy', '1445336783', '2', '2015-10-22 00:41:27', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('58', 'fancy', '1445337848', '2', '2015-10-22 00:41:29', '123.237.131.248');
INSERT INTO `fc_user_activity` VALUES ('59', 'fancy', '1445356332', '2', '2016-06-09 05:41:57', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('60', 'fancy', '1445459139', '2', '2016-06-09 09:16:41', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('61', 'unfancy', '1445337654', '2', '2016-06-09 10:20:11', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('62', 'fancy', '1445337654', '2', '2016-06-09 10:21:21', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('63', 'fancy', '1445459022', '2', '2016-06-09 11:42:17', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('64', 'fancy', '1445458572', '2', '2016-06-09 11:42:20', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('65', 'fancy', '1465601482', '2', '2016-06-10 17:31:30', '180.190.114.162');
INSERT INTO `fc_user_activity` VALUES ('66', 'fancy', '1465604372', '2', '2016-06-11 07:24:32', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('67', 'fancy', '1465604257', '2', '2016-06-11 07:24:34', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('68', 'fancy', '1465601833', '2', '2016-06-11 07:38:42', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('69', 'fancy', '1465602002', '2', '2016-06-11 08:56:49', '222.127.94.9');
INSERT INTO `fc_user_activity` VALUES ('70', 'fancy', '1465604145', '2', '2016-06-11 10:24:35', '222.127.94.8');
INSERT INTO `fc_user_activity` VALUES ('71', 'fancy', '1465690614', '2', '2016-06-11 18:17:02', '222.127.94.4');
INSERT INTO `fc_user_activity` VALUES ('72', 'fancy', '1465690478', '2', '2016-06-12 11:26:03', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('73', 'fancy', '1465690291', '2', '2016-06-12 11:26:33', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('74', 'unfancy', '1465690291', '2', '2016-06-12 11:30:27', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('75', 'fancy', '1465690291', '2', '2016-06-12 11:31:07', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('76', 'fancy', '1445458659', '5', '2016-06-14 18:37:42', '202.50.52.10');
INSERT INTO `fc_user_activity` VALUES ('77', 'unfancy', '1445459218', '2', '2016-06-15 08:25:52', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('78', 'fancy', '1445459218', '2', '2016-06-15 08:26:00', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('79', 'unfancy', '1445337654', '2', '2016-06-15 08:29:57', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('80', 'fancy', '1445337654', '2', '2016-06-15 08:30:19', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('81', 'unfancy', '1445337654', '2', '2016-06-15 08:30:53', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('82', 'fancy', '1445337654', '2', '2016-06-15 08:31:04', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('83', 'fancy', '1465601833', '2', '2016-06-15 08:43:16', '31.18.248.132');
INSERT INTO `fc_user_activity` VALUES ('84', 'fancy', '1445459218', '2', '2016-06-15 09:05:33', '31.18.248.132');

-- ----------------------------
-- Table structure for fc_user_product
-- ----------------------------
DROP TABLE IF EXISTS `fc_user_product`;
CREATE TABLE `fc_user_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_product_id` bigint(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_name` varchar(100) NOT NULL,
  `seourl` varchar(500) NOT NULL,
  `meta_title` longblob NOT NULL,
  `meta_keyword` longblob NOT NULL,
  `meta_description` longblob NOT NULL,
  `excerpt` varchar(500) NOT NULL,
  `category_id` varchar(500) NOT NULL,
  `image` longtext NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('Publish','UnPublish') NOT NULL DEFAULT 'Publish',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `list_name` longtext NOT NULL,
  `list_value` longtext NOT NULL,
  `web_link` mediumtext NOT NULL,
  `short_url_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_user_product
-- ----------------------------
INSERT INTO `fc_user_product` VALUES ('38', '1445458572', '2015-10-21 14:16:12', '0000-00-00 00:00:00', 'Porsche 911', 'Porsche-911', '', '', '', '', '1', 'P15_0788_a5_rgb.jpg', '', 'Publish', '2', '1', '', '', '', '234');
INSERT INTO `fc_user_product` VALUES ('40', '1445459022', '2015-10-21 14:23:42', '0000-00-00 00:00:00', 'Mars Rover', 'Mars-Rover', '', '', '', '', '33', '1473926043187685190.jpg', '', 'Publish', '2', '1', '', '', '', '236');
INSERT INTO `fc_user_product` VALUES ('41', '1445459139', '2015-10-21 14:25:39', '0000-00-00 00:00:00', 'Turtle', 'Turtle', '', '', '', '', '32', 'P1010023m.jpg', '', 'Publish', '2', '1', '', '', '', '237');
INSERT INTO `fc_user_product` VALUES ('31', '1445336783', '2015-10-20 04:26:23', '0000-00-00 00:00:00', 'ok', 'ok', '', '', '', '', '37', '11207298_990813367606535_4670730218541813160_n1.jpg', '', 'Publish', '2', '1', '', '', '', '227');
INSERT INTO `fc_user_product` VALUES ('32', '1445337654', '2015-10-20 04:40:54', '0000-00-00 00:00:00', 'Travel', 'Travel', '', '', '', '', '38', 'travel_nm.jpg', '', 'Publish', '2', '2', '', '', '', '228');
INSERT INTO `fc_user_product` VALUES ('33', '1445337848', '2015-10-20 04:44:08', '0000-00-00 00:00:00', '5', '5', '', '', '', '', '34', '11224252_948350548540002_3600840908521942018_o.jpg', '', 'Publish', '2', '2', '', '', '', '229');
INSERT INTO `fc_user_product` VALUES ('35', '1445356332', '2015-10-20 09:52:12', '0000-00-00 00:00:00', 'chrome', 'chrome', '', '', '', '', '33', 'tumblr_lvndjgEP3D1qhkmt3o1_500.jpg', '', 'Publish', '2', '1', '', '', '', '231');
INSERT INTO `fc_user_product` VALUES ('47', '1465602002', '2016-06-10 17:40:02', '0000-00-00 00:00:00', 'Einstien', 'Einstien', '', '', '', '', '36', '12573707_1072433399457659_4627647055456105743_n.png', '', 'Publish', '2', '1', '', '', '', '243');
INSERT INTO `fc_user_product` VALUES ('46', '1465601833', '2016-06-10 17:37:13', '0000-00-00 00:00:00', 'Pinecone', 'Pinecone', '', '', '', '', '36', 'tumblr_mklyj1YxIk1qd0edbo1_r2_500.png', '', 'Publish', '2', '1', '', '', '', '242');
INSERT INTO `fc_user_product` VALUES ('48', '1465604145', '2016-06-10 18:15:45', '0000-00-00 00:00:00', 'Pyramid Yatch', 'Pyramid-Yatch', '', '', '', '', '35', '12829383_10153955642914641_5460942660974291351_o.jpg', '', 'Publish', '2', '1', '', '', '', '244');
INSERT INTO `fc_user_product` VALUES ('49', '1465604257', '2016-06-10 18:17:37', '0000-00-00 00:00:00', 'Office', 'Office', '', '', '', '', '39', '390433_228656307260003_352794270_n.jpg', '', 'Publish', '2', '1', '', '', '', '245');
INSERT INTO `fc_user_product` VALUES ('50', '1465604372', '2016-06-10 18:19:32', '0000-00-00 00:00:00', 'Arch20 Helicopter', 'Arch20-Helicopter', '', '', '', '', '33', 'Arch2O-zero-helicopter-by-hector-del-amo2.jpg', '', 'Publish', '2', '1', '', '', '', '246');
INSERT INTO `fc_user_product` VALUES ('51', '1465690291', '2016-06-11 18:11:31', '0000-00-00 00:00:00', 'Apple Watch', 'Apple-Watch', '', '', '', '', '35', 'Apple-watch2.jpg', '', 'Publish', '2', '1', '', '', '', '247');
INSERT INTO `fc_user_product` VALUES ('52', '1465690478', '2016-06-11 18:14:38', '0000-00-00 00:00:00', 'Shoe', 'Shoe', '', '', '', '', '2', '1618380_811894845544426_2622146602490347167_o1.jpg', '', 'Publish', '2', '1', '', '', '', '248');

-- ----------------------------
-- Table structure for fc_users
-- ----------------------------
DROP TABLE IF EXISTS `fc_users`;
CREATE TABLE `fc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginUserType` enum('normal','twitter','facebook','google') NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `group` enum('User','Seller') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `comment_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `is_verified` enum('Yes','No') NOT NULL,
  `is_brand` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_logout_date` datetime NOT NULL,
  `last_login_ip` varchar(50) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `s_address` varchar(100) NOT NULL,
  `s_city` varchar(50) NOT NULL,
  `s_district` varchar(50) NOT NULL,
  `s_state` varchar(50) NOT NULL,
  `s_country` varchar(20) NOT NULL,
  `s_postal_code` int(11) NOT NULL,
  `s_phone_no` varchar(20) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_description` text NOT NULL,
  `commision` int(11) NOT NULL,
  `web_url` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_no` varchar(100) NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `request_status` enum('Not Requested','Pending','Approved','Rejected') NOT NULL DEFAULT 'Not Requested',
  `verify_code` varchar(10) NOT NULL,
  `feature_product` int(100) NOT NULL,
  `followers_count` int(11) NOT NULL,
  `following_count` int(11) NOT NULL,
  `followers` varchar(200) NOT NULL,
  `following` varchar(200) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `google` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `about` varchar(200) NOT NULL,
  `age` enum('','13 to 17','18 to 24','25 to 34','35 to 44','45 to 54','55+') NOT NULL,
  `gender` enum('Male','Female','Unspecified') NOT NULL DEFAULT 'Unspecified',
  `language` varchar(10) NOT NULL DEFAULT 'en',
  `visibility` enum('Everyone','Only you') NOT NULL,
  `display_lists` enum('Yes','No') NOT NULL,
  `email_notifications` longtext NOT NULL,
  `notifications` longtext NOT NULL,
  `updates` enum('1','0') NOT NULL,
  `products` int(11) NOT NULL,
  `lists` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `location` mediumtext NOT NULL,
  `following_user_lists` longtext NOT NULL,
  `following_giftguide_lists` longtext NOT NULL,
  `api_id` bigint(20) NOT NULL,
  `own_products` longtext NOT NULL,
  `own_count` bigint(20) NOT NULL,
  `referId` int(11) NOT NULL,
  `want_count` bigint(20) NOT NULL,
  `refund_amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `paypal_email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_users
-- ----------------------------
INSERT INTO `fc_users` VALUES ('2', 'normal', 'dj delfino', 'djdelfino', 'Seller', 'djdelfino@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', 'Active', 'inactive', 'Yes', 'yes', '2015-03-18 04:15:22', '0000-00-00 00:00:00', '2016-06-15 10:58:12', '2016-06-12 03:35:38', '31.18.248.132', 'D40073531.jpg', '1000 ocean drive', '', 'Santorini', '', 'greece', 'GR', '1000', '1111111111', '1111', '1111', '', '1111', '1111', '1111', '1111111', 'dj delfino', 'stuff', '0', '', 'dj delfino', '111111111111111', '1111', 'Approved', '0JwUigCTBe', '1445458659', '0', '0', '', '', '', '', '', '0000-00-00', '\"No problem worth solving is simple.\"', '', 'Unspecified', 'en', 'Everyone', 'Yes', 'following,invited,shown_to_me,comments_on_fancyd,featured,mentions_me,comments', 'wmn-follow,wmn-mentioned_in_comment,wmn-comments_on_fancyd,wmn-fancyd,wmn-shown_to_me,wmn-join,wmn-featured,wmn-deal,wmn-promotion,wmn-followed_add_person,wmn-followed_add_store,wmn-followed_commented,wmn-followed_earned_deal,wmn-followed_promoted,wmn-comments', '1', '17', '11', '22', '', '', '', '0', ',1465604145,1465601833,1445336783', '3', '0', '0', '0.00', '');
INSERT INTO `fc_users` VALUES ('5', 'normal', 'Krishna Bhatta', 'krishna', 'User', 'krishna_bhatta@outlook.com', '4b8bafdec076f25030c303049f4e6586', 'Active', 'inactive', 'Yes', 'no', '2016-06-15 12:30:50', '0000-00-00 00:00:00', '2016-06-15 03:50:34', '2016-06-15 03:51:04', '110.44.113.19', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '0', '', '', '', '0', '', '', '', '', 'Not Requested', 'vOHBtI8GPs', '0', '0', '0', '', '', '', '', '', '0000-00-00', '', '', 'Unspecified', 'en', 'Everyone', 'Yes', 'following,invited,shown_to_me,comments_on_fancyd,featured,mentions_me,comments', 'wmn-follow,wmn-mentioned_in_comment,wmn-comments_on_fancyd,wmn-fancyd,wmn-shown_to_me,wmn-join,wmn-featured,wmn-deal,wmn-promotion,wmn-followed_add_person,wmn-followed_add_store,wmn-followed_commented,wmn-followed_earned_deal,wmn-followed_promoted,wmn-comments', '1', '0', '0', '1', '', '', '', '0', '', '0', '0', '0', '0.00', '');

-- ----------------------------
-- Table structure for fc_vendor_payment_table
-- ----------------------------
DROP TABLE IF EXISTS `fc_vendor_payment_table`;
CREATE TABLE `fc_vendor_payment_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` mediumtext COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` mediumtext COLLATE utf8_bin NOT NULL,
  `amount` float(20,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8_bin NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fc_vendor_payment_table
-- ----------------------------

-- ----------------------------
-- Table structure for fc_wants
-- ----------------------------
DROP TABLE IF EXISTS `fc_wants`;
CREATE TABLE `fc_wants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `product_id` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fc_wants
-- ----------------------------
INSERT INTO `fc_wants` VALUES ('1', '1', '1426706850,1426708070');
