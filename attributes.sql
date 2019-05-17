/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : flyer

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-27 05:14:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `attribute_combinations`
-- ----------------------------
DROP TABLE IF EXISTS `attribute_combinations`;
CREATE TABLE `attribute_combinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_valuesids` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attribute_combinations
-- ----------------------------
INSERT INTO `attribute_combinations` VALUES ('4', '2047', '1,16,23,24,26');
INSERT INTO `attribute_combinations` VALUES ('7', '2047', '1,16,21,24,25,26');
INSERT INTO `attribute_combinations` VALUES ('8', '2047', '1,16,21,24,25,27');
INSERT INTO `attribute_combinations` VALUES ('9', '2047', '1,16,21,24,25,28');
INSERT INTO `attribute_combinations` VALUES ('10', '2047', '1,16,21,24,25,29');
INSERT INTO `attribute_combinations` VALUES ('11', '2047', '1,16,21,24,25,30');
INSERT INTO `attribute_combinations` VALUES ('12', '2047', '1,16,21,24,25,31');
INSERT INTO `attribute_combinations` VALUES ('13', '2047', '1,16,21,24,25,32');
INSERT INTO `attribute_combinations` VALUES ('14', '2047', '1,16,21,24,25,33');
INSERT INTO `attribute_combinations` VALUES ('15', '2047', '1,16,21,24,25,34');
INSERT INTO `attribute_combinations` VALUES ('16', '2047', '1,16,21,24,25,35');
INSERT INTO `attribute_combinations` VALUES ('45', '2047', '1,16,22,25,26');
INSERT INTO `attribute_combinations` VALUES ('46', '2047', '1,16,22,24,26');
INSERT INTO `attribute_combinations` VALUES ('56', '2047', '1,16,23,25,26');
INSERT INTO `attribute_combinations` VALUES ('59', '2047', '1,17,23,25,26');
INSERT INTO `attribute_combinations` VALUES ('60', '2047', '1,17,23,24,26');
INSERT INTO `attribute_combinations` VALUES ('71', '2047', '1,17,21,24,25,26');
INSERT INTO `attribute_combinations` VALUES ('72', '2047', '1,17,21,24,25,27');
INSERT INTO `attribute_combinations` VALUES ('73', '2047', '1,17,21,24,25,28');
INSERT INTO `attribute_combinations` VALUES ('74', '2047', '1,17,21,24,25,29');
INSERT INTO `attribute_combinations` VALUES ('75', '2047', '1,17,21,24,25,30');
INSERT INTO `attribute_combinations` VALUES ('76', '2047', '1,17,21,24,25,31');
INSERT INTO `attribute_combinations` VALUES ('77', '2047', '1,17,21,24,25,32');
INSERT INTO `attribute_combinations` VALUES ('78', '2047', '1,17,21,24,25,33');
INSERT INTO `attribute_combinations` VALUES ('79', '2047', '1,17,21,24,25,34');
INSERT INTO `attribute_combinations` VALUES ('80', '2047', '1,17,21,24,25,35');
INSERT INTO `attribute_combinations` VALUES ('81', '2047', '1,17,22,25,26');
INSERT INTO `attribute_combinations` VALUES ('82', '2047', '1,17,22,24,26');
INSERT INTO `attribute_combinations` VALUES ('83', '2047', '2,16,17,21,22,23,36,26');
INSERT INTO `attribute_combinations` VALUES ('87', '2047', '3,16,17,21,22,37,38,26,27,28,29,30,31,32,33,34,35');
INSERT INTO `attribute_combinations` VALUES ('88', '2047', '3,18,19,20,22,37,38,26,27,28,29,30,31,32,33,34,35');
INSERT INTO `attribute_combinations` VALUES ('90', '2047', '4,16,17,22,37,38,26');
INSERT INTO `attribute_combinations` VALUES ('91', '2047', '5,16,17,18,19,20,22,23,24,25,26');
INSERT INTO `attribute_combinations` VALUES ('92', '2047', '5,18,19,20,21,24,25,26');
INSERT INTO `attribute_combinations` VALUES ('93', '2047', '5,16,17,18,19,20,21,24,25,26,27,28,29,30,31,32,33,34,35');
INSERT INTO `attribute_combinations` VALUES ('94', '2047', '5,16,17,18,19,20,39,24,25,26,27,28,29,30,31,32,33,34,35');
INSERT INTO `attribute_combinations` VALUES ('95', '2048', '7,40,41,42,43,44,45,46,47,48,50,51,52,53,54');
INSERT INTO `attribute_combinations` VALUES ('96', '2048', '7,49,54,55');
INSERT INTO `attribute_combinations` VALUES ('97', '2049', '56,57,58,59');

-- ----------------------------
-- Table structure for `attribute_values`
-- ----------------------------
DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `value` text,
  `details` text,
  `imagepath` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attribute_values
-- ----------------------------
INSERT INTO `attribute_values` VALUES ('1', '1', 'Partial single sided gloss UV varnish', null, '/flyer/others/images/products/veredelung-glaenzend.png');
INSERT INTO `attribute_values` VALUES ('2', '1', 'Double sided partial gloss UV varnish', '4+machine seal/4 double sided print (CMYK)', '/flyer/others/images/products/veredelung-glaenzend.png');
INSERT INTO `attribute_values` VALUES ('3', '1', 'Single sided gloss UV varnish', null, '/flyer/others/images/products/veredelung-glaenzend.png');
INSERT INTO `attribute_values` VALUES ('4', '1', 'Double sided gloss UV coating', null, '/flyer/others/images/products/veredelung-glaenzend.png');
INSERT INTO `attribute_values` VALUES ('5', '1', 'Single sided glossy relief varnish', 'Varnish partially covering the front side', '/flyer/others/images/products/veredelung-glaenzend.png');
INSERT INTO `attribute_values` VALUES ('6', '1', 'Single sided matt lamination', null, '/flyer/others/images/products/veredelung-matt.png');
INSERT INTO `attribute_values` VALUES ('7', '1', 'Double sided matt lamination', null, '/flyer/others/images/products/veredelung-matt.png');
INSERT INTO `attribute_values` VALUES ('8', '1', 'Gold hot foil', 'With double sided dispersion coating\\nNew digital foil finish technology\\nFinish only on the front', '/flyer/others/images/products/veredelung-gold.png');
INSERT INTO `attribute_values` VALUES ('9', '1', 'Silver hot foil', 'With double sided dispersion coating\\nNew digital foil finish technology\\nFinish only on the front', '/flyer/others/images/products/veredelung-silber.png');
INSERT INTO `attribute_values` VALUES ('10', '1', 'Hologram hot foil', 'With double sided dispersion coating\\nNew digital foil finish technology\\nFinish only on the front', '/flyer/others/images/products/veredelung-folie-holo.png');
INSERT INTO `attribute_values` VALUES ('11', '1', 'Single sided soft touch matt lamination', null, '/flyer/others/images/products/veredelung-soft.png');
INSERT INTO `attribute_values` VALUES ('12', '1', 'Double sided soft touch matt lamination', null, '/flyer/others/images/products/veredelung-soft.png');
INSERT INTO `attribute_values` VALUES ('13', '1', 'Additional colour, silver', 'With double sided dispersion coating\\n5/5 double sided print (full colour, CMYK + special colour, silver)\\nSilver tone: HKS 99', '/flyer/others/images/products/farbig-5-5s.png');
INSERT INTO `attribute_values` VALUES ('14', '1', 'Additional colour, gold', 'With double sided dispersion coating\\n5/5 double sided print (full colour, CMYK + special colour, gold)\\nGold tone: rich pale gold', '/flyer/others/images/products/farbig-5-5g.png');
INSERT INTO `attribute_values` VALUES ('15', '1', 'Letterpress printing', 'Embossing (letterpress) is only possible on the front side\\n4+embossing/4 double sided print (CMYK)', '/flyer/others/images/products/veredelung-letterpress.png');
INSERT INTO `attribute_values` VALUES ('16', '2', 'Landscape <br>(8.5 x 5.5cm)', null, '/flyer/others/images/products/vk_plano_q.png');
INSERT INTO `attribute_values` VALUES ('17', '2', 'Portrait <br>(5.4 x 8.5cm)', null, '/flyer/others/images/products/vk_plano_h.png');
INSERT INTO `attribute_values` VALUES ('18', '2', 'Landscape <br>(8.5 x 5cm)', null, '/flyer/others/images/products/vk_plano_q9x5cm.png');
INSERT INTO `attribute_values` VALUES ('19', '2', 'Portrait <br> (5.4 x 9cm)', null, '/flyer/others/images/products/vk_plano_h.png');
INSERT INTO `attribute_values` VALUES ('20', '2', 'Square <br>(9.8 x 5.5cm)', null, '/flyer/others/images/products/vk_plano_quad.png');
INSERT INTO `attribute_values` VALUES ('21', '3', '300gsm silk paper', null, '/flyer/others/images/products/mat-matt-300_bestprice.png');
INSERT INTO `attribute_values` VALUES ('22', '3', '400gsm silk paper', null, '/flyer/others/images/products/mat-matt-400.png');
INSERT INTO `attribute_values` VALUES ('23', '3', '450gsm silk SBS board', null, '/flyer/others/images/products/mat-chromo-sulfat-450.png');
INSERT INTO `attribute_values` VALUES ('24', '3', '350gsm silk SBS board', null, '/flyer/others/images/products/mat-chromo-sulfat-350.png');
INSERT INTO `attribute_values` VALUES ('25', '4', '4+machine seal/0 (single sided print)', null, '/flyer/others/images/products/farbig-4la-0.png');
INSERT INTO `attribute_values` VALUES ('26', '4', '4+machine seal/4 (double sided print)', null, '/flyer/others/images/products/farbig-4la-4.png');
INSERT INTO `attribute_values` VALUES ('27', '4', '4+machine seal/4+ machine seal (double sided print)', null, '/flyer/others/images/products/farbig-4la-4.png');
INSERT INTO `attribute_values` VALUES ('28', '4', '4/0 single sided print (full colour)', null, '/flyer/others/images/products/farbig-4-0.png');
INSERT INTO `attribute_values` VALUES ('29', '4', '4/4 double sided print (full colour)', null, '/flyer/others/images/products/farbig-4-4.png');
INSERT INTO `attribute_values` VALUES ('30', '5', '1 design', null, '');
INSERT INTO `attribute_values` VALUES ('31', '5', '2 designs', null, '');
INSERT INTO `attribute_values` VALUES ('32', '5', '3 designs', null, '');
INSERT INTO `attribute_values` VALUES ('33', '5', '4 designs', null, '');
INSERT INTO `attribute_values` VALUES ('34', '5', '5 designs', null, '');
INSERT INTO `attribute_values` VALUES ('35', '5', '6 designs', null, '');
INSERT INTO `attribute_values` VALUES ('36', '5', '7 designs', null, '');
INSERT INTO `attribute_values` VALUES ('37', '5', '8 designs', null, '');
INSERT INTO `attribute_values` VALUES ('38', '5', '9 designs', null, '');
INSERT INTO `attribute_values` VALUES ('39', '5', '10 designs', null, '');
INSERT INTO `attribute_values` VALUES ('40', '7', 'more colours if desired', null, '/flyer/others/images/products/tyvek_set.png');
INSERT INTO `attribute_values` VALUES ('41', '7', 'red', null, '/flyer/others/images/products/tyvek_rot.png');
INSERT INTO `attribute_values` VALUES ('42', '7', 'blue', null, '/flyer/others/images/products/tyvek_blau.png');
INSERT INTO `attribute_values` VALUES ('43', '7', 'neon green', null, '/flyer/others/images/products/tyvek_neongruen.png');
INSERT INTO `attribute_values` VALUES ('44', '7', 'neon yellow', null, '/flyer/others/images/products/tyvek_neongelb.png');
INSERT INTO `attribute_values` VALUES ('45', '7', 'neon orange', null, '/flyer/others/images/products/tyvek_neonorange.png');
INSERT INTO `attribute_values` VALUES ('46', '7', 'neon pink', null, '/flyer/others/images/products/tyvek_neonpink.png');
INSERT INTO `attribute_values` VALUES ('47', '7', 'silver', null, '/flyer/others/images/products/tyvek_silber.png');
INSERT INTO `attribute_values` VALUES ('48', '7', 'gold', null, '/flyer/others/images/products/tyvek_gold.png');
INSERT INTO `attribute_values` VALUES ('49', '7', 'white', null, '/flyer/others/images/products/tyvek_weiss.png');
INSERT INTO `attribute_values` VALUES ('50', '7', 'sand', null, '/flyer/others/images/products/tyvek_sand.png');
INSERT INTO `attribute_values` VALUES ('51', '7', 'lavender', null, '/flyer/others/images/products/tyvek_lavendel.png');
INSERT INTO `attribute_values` VALUES ('52', '7', 'light blue', null, '/flyer/others/images/products/tyvek_hellblau.png');
INSERT INTO `attribute_values` VALUES ('53', '7', 'aqua', null, '/flyer/others/images/products/tyvek_aqua.png');
INSERT INTO `attribute_values` VALUES ('54', '8', '1/0 single sided print (full colour)', null, '/flyer/others/images/products/farbig-1-0.png');
INSERT INTO `attribute_values` VALUES ('55', '8', '4/0 single sided print (full colour)', null, '/flyer/others/images/products/farbig-4-0.png');
INSERT INTO `attribute_values` VALUES ('56', '10', 'Inner pages: squared paper', null, '/flyer/others/images/products/ausf_kariert.png');
INSERT INTO `attribute_values` VALUES ('57', '10', 'Inner pages blank', null, '/flyer/others/images/products/ausf_blanko.png');
INSERT INTO `attribute_values` VALUES ('58', '11', 'A4<br>(21 x 29.7 cm)', null, '/flyer/others/images/products/ef_din-a4_h.png');
INSERT INTO `attribute_values` VALUES ('59', '12', '50 sheets', null, '/flyer/others/images/products/50-blatt.png');

-- ----------------------------
-- Table structure for `attributes`
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` text,
  `order` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of attributes
-- ----------------------------
INSERT INTO `attributes` VALUES ('1', '2047', 'Finish', '1');
INSERT INTO `attributes` VALUES ('2', '2047', 'Size', '2');
INSERT INTO `attributes` VALUES ('3', '2047', 'Material', '3');
INSERT INTO `attributes` VALUES ('4', '2047', 'Colour mode', '4');
INSERT INTO `attributes` VALUES ('5', '2047', 'Number of Designs', '5');
INSERT INTO `attributes` VALUES ('6', '2047', 'Print Run and Delivery', '6');
INSERT INTO `attributes` VALUES ('7', '2048', 'Wrist Band Colour', '1');
INSERT INTO `attributes` VALUES ('8', '2048', 'Colour Mode', '2');
INSERT INTO `attributes` VALUES ('9', '2048', 'Print Run and Delivery ', '3');
INSERT INTO `attributes` VALUES ('10', '2049', ' Orientation', '1');
INSERT INTO `attributes` VALUES ('11', '2049', ' Size', '2');
INSERT INTO `attributes` VALUES ('12', '2049', 'Number of Sheets', '3');
INSERT INTO `attributes` VALUES ('13', '2049', 'Print Run and Delivery', '4');
