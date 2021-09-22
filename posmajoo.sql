/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 80013
 Source Host           : localhost:3306
 Source Schema         : posmajoo

 Target Server Type    : MySQL
 Target Server Version : 80013
 File Encoding         : 65001

 Date: 22/09/2021 11:35:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_idx`(`id`, `username`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'admin', '$2y$10$Dxn/sfyga8QqaoWEeDr1eOfMRp3FA267C944rs6L6522V22m6IHSS', NULL, NULL, '2020-12-22 11:11:13', '2021-09-15 22:47:04', NULL);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'PACKAGE', '<ul><li>Product bundled</li><li>Lower price</li></ul>', 'PACKAGE-1632235450_f1ae19bb1199651db003.png', '2021-09-21 09:44:10', '2021-09-21 09:44:10', NULL);
INSERT INTO `category` VALUES (2, 'PRINTER', '<ul><li>Print cashier receipt<br></li></ul>', 'printer-1632235549_f55d8afab89a254a1161.png', '2021-09-21 09:45:49', '2021-09-21 09:45:49', NULL);
INSERT INTO `category` VALUES (3, 'BARCODE SCANNER', '<ul><li>Faster sales with scanned item labels<br></li></ul>', 'Barcode-scanner-1632235662_f0b6cb516d90c7e117b1.png', '2021-09-21 09:47:42', '2021-09-21 09:47:42', NULL);
INSERT INTO `category` VALUES (4, 'STANDEE', '<ul><li>ergonomic support device<br></li></ul>', 'Standee-1632235858_f60bdf66e94e82b0029a.png', '2021-09-21 09:50:58', '2021-09-21 09:50:58', NULL);
INSERT INTO `category` VALUES (5, 'CASH DRAWER', '<ul><li>Cashier drawer for saving money<br></li></ul>', 'Cash-drawer-1632235973_ddce1558672725699a0c.png', '2021-09-21 09:52:53', '2021-09-21 09:52:53', NULL);
INSERT INTO `category` VALUES (6, 'DEVICE', '<ul><li>Touchscreen cashier device</li></ul>', 'device-1632236057_cd282a142dae8c006096.png', '2021-09-21 09:54:17', '2021-09-21 09:54:17', NULL);
INSERT INTO `category` VALUES (7, 'THERMAL PAPER', '<ul><li><span style=\"color: rgb(77, 81, 86); font-family: arial, sans-serif; font-size: 14px;\">Used in thermal printers</span><br></li></ul>', 'thermal-paper-1632236117_1aea342a08ae09c4bb80.png', '2021-09-21 09:55:17', '2021-09-21 09:55:17', NULL);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_price` bigint(10) NOT NULL,
  `status` enum('requested','pending','progressed','rejected','finished') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `user_id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  INDEX `order_ibfk_1`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` bigint(10) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `total` bigint(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `order_id`, `product_id`) USING BTREE,
  INDEX `order_detail_ibfk_1`(`order_id`) USING BTREE,
  INDEX `order_detail_ibfk_2`(`product_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` bigint(10) NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 1, 'STARTER SPRINTER PACKAGE', '<ul><li>6 months subscription to majoo starter</li><li><span style=\"font-size: 1rem;\">Advan harvard 01</span></li><li><span style=\"font-size: 1rem;\">Built-in 58mm printer</span></li><li><span style=\"font-size: 1rem;\">5 thermal receipts</span></li><li><span style=\"font-size: 1rem;\">Install and setup</span></li></ul>', 2550000, 'Starter-Sprinter-Package-1632243191_a773c19f8fe51fc309f5.png', '2021-09-21 11:53:11', '2021-09-21 23:55:01', NULL);
INSERT INTO `product` VALUES (2, 1, 'ADVANCE GALAXY PACKAGE', '<ul><li>12 + 1 month majoo Advance subscription bonus</li><li>Samsung A7 Lite 8.7\" tablet or Advan Sketch 10.1</li><li>58mm . Bluetooth Printer</li><li>Standee Neo 360°</li><li>5 thermal receipts</li><li>Install and setup</li></ul>', 5850000, 'Advance-Galaxy-Package-1632243550_e24777747eb2ec507056.png', '2021-09-21 11:59:10', '2021-09-22 00:04:14', NULL);
INSERT INTO `product` VALUES (3, 1, 'STARTER LITE PACKAGE', '<ul><li>12 + 1 month majoo starter subscription bonus</li><li>Advan GTAB 8</li><li>58mm . Bluetooth Printer</li><li>Standee Neo 360°</li><li>5 thermal receipts</li><li>Install and setup</li></ul>', 3550000, 'Starter-Lite-Package-1632243680_f543374fc52e3b3246bc.png', '2021-09-21 12:01:20', '2021-09-22 00:04:16', NULL);
INSERT INTO `product` VALUES (4, 1, 'DESKTOP PACKAGE', '<ul><li>12 + 1 month majoo starter subscription bonus</li><li>Sunmi T2 Single 15\"</li><li>Printer 80mm All in One</li><li>10 thermal receipts</li><li>Install and setup</li></ul>', 11600000, 'Desktop-Package-1632243789_3b196557920d4cbd225d.png', '2021-09-21 12:03:10', '2021-09-22 00:04:17', NULL);
INSERT INTO `product` VALUES (5, 2, 'PRINTER KASIR BLUETOOTH MOBILE 58MM', '<ul><li>Print a mobile cash register</li><li>Economical mobile printer</li></ul>', 475000, 'Printer-Kasir-Bluetooth-Mobile-58mm-1632236786_cc110588665de6c50899.png', '2021-09-21 10:06:26', '2021-09-21 23:55:47', NULL);
INSERT INTO `product` VALUES (6, 2, 'PRINTER KASIR BLUETOOTH DESKTOP 58MM', '<ul><li>Print desktop cash register</li><li>Economical desktop printer</li></ul>', 475000, 'Printer-Kasir-Bluetooth-Desktop-58mm-1632236881_928727963ce61d91bc8f.png', '2021-09-21 10:08:01', '2021-09-21 23:55:45', NULL);
INSERT INTO `product` VALUES (7, 2, 'PRINTER KASIR DAPUR ETHERNET 80MM', '<ul><li>Print cashier receipts with autocutter</li><li>Print sticker labels with autocutter</li></ul>', 1325000, 'Printer-Kasir-Dapur-Ethernet-80mm-1632236943_751a363cdf54f81b207c.png', '2021-09-21 10:09:03', '2021-09-21 23:55:43', NULL);
INSERT INTO `product` VALUES (8, 2, 'PRINTER KASIR DAPUR EPSON TM T82 ETHERNET 80MM', '<ul><li>Print cashier receipts with autocutter</li><li>Print sticker labels with autocutter</li></ul>', 2400000, 'Printer-Kasir-Dapur-Epson-TM-T82-Ethernet-80mm-1632237078_dc070c127eaa4a4af4ee.png', '2021-09-21 10:11:18', '2021-09-21 23:55:42', NULL);
INSERT INTO `product` VALUES (9, 3, 'BLUETOOTH BARCODE SCANNER LASER', '<ul><li>Fast sales by scanning item labels</li><li>Handheld and Autoscan</li></ul>', 495000, 'Bluetooth-Barcode-Scanner-Laser-1632237128_245fec912686a903cb94.png', '2021-09-21 10:12:08', '2021-09-21 23:55:40', NULL);
INSERT INTO `product` VALUES (10, 4, 'STANDEE COMPACT 5MM', '<ul><li>Static tablet holder for 7 &amp; 8inch tablets</li><li>Available in black and white</li></ul>', 250000, 'Standee-Compact-5mm-1632237202_60d7c11380d3681925cc.png', '2021-09-21 10:13:22', '2021-09-21 23:55:38', NULL);
INSERT INTO `product` VALUES (11, 4, 'STANDEE NEO 360', '<ul><li>Free rotation 360°</li><li>Magnetic tablet hook and charger cable hook</li></ul>', 250000, 'Standee-Neo-360-1632237284_48399af923c7cbeb28d0.png', '2021-09-21 10:14:44', '2021-09-21 23:55:36', NULL);
INSERT INTO `product` VALUES (12, 4, 'STANDEE NEO PLUS 360', '<ul><li>Free rotation 360°</li><li>Tablet hook magnet</li><li>Customer display module and marketing display module</li></ul>', 1500000, 'Standee-Neo-Plus-360-1632237318_5533398c7dc554b8044c.png', '2021-09-21 10:15:18', '2021-09-21 23:55:35', NULL);
INSERT INTO `product` VALUES (13, 5, 'LACI KASIR ENIBIT MINI CASHDRAWER', '<ul><li>Cashier drawer to save money<br></li></ul>', 595000, 'Laci-Kasir-Enibit-Mini-Cashdrawer-1632237357_238c6b99e027fbad04bb.png', '2021-09-21 10:15:57', '2021-09-21 23:55:34', NULL);
INSERT INTO `product` VALUES (14, 6, 'TABLET SAMSUNG TAB A7 LITE', '<ul><li>8.7 inch android tablet cash register<br></li></ul>', 2750000, 'Tablet-Samsung-Tab-A7-Lite-1632237402_06291472a1d35163328a.png', '2021-09-21 10:16:42', '2021-09-21 23:55:32', NULL);
INSERT INTO `product` VALUES (15, 6, 'TABLET ADVAN SKETSA 10 INCH', '<ul><li>10 inch android tablet cash register</li><li>RAM/ROM 4GB/32GB</li></ul>', 2750000, 'Tablet-Advan-Sketsa-10-inch-1632237476_bcee69f02c46933a5482.png', '2021-09-21 10:17:56', '2021-09-21 23:55:29', NULL);
INSERT INTO `product` VALUES (16, 6, 'TABLET ADVAN GTAB 8', '<ul><li>8 inch android tablet cash register</li></ul>', 1750000, 'Tablet-Advan-GTab-8-1632237518_59f2401c50c660d30aeb.png', '2021-09-21 10:18:38', '2021-09-21 23:55:26', NULL);
INSERT INTO `product` VALUES (17, 6, 'ADVAN HARVARD 01', '<ul><li>Mobile Pos Android 5\" with built-in 58mm printer<br></li></ul>', 1799000, 'Advan-Harvard-01-1632237555_3194b6b5e09a9afa81d6.png', '2021-09-21 10:19:15', '2021-09-21 23:55:24', NULL);
INSERT INTO `product` VALUES (18, 6, 'KOMPUTER KASIR DESKTOP SUNMI T2 MINI', '<ul><li>11 inch touch screen and cash register printer<br></li></ul>', 5750000, 'Komputer-Kasir-Desktop-Sunmi-T2-Mini-1632237607_4fd41cfc405c9e9fb879.png', '2021-09-21 10:20:07', '2021-09-21 23:55:22', NULL);
INSERT INTO `product` VALUES (19, 6, 'KOMPUTER KASIR DESKTOP SUNMI T2 SINGLE 15', '<ul><li>15 inch touch screen and cash register printer<br></li></ul>', 8750000, 'Komputer-Kasir-Desktop-Sunmi-T2-Single-15-1632237657_2e73ec41f7b8c4804376.png', '2021-09-21 10:20:58', '2021-09-21 23:55:19', NULL);
INSERT INTO `product` VALUES (20, 6, 'KOMPUTER KASIR DESKTOP SUNMI T2 DUAL 15', '<ul><li>Dual touch screen 15 + 15 inch customer display and cash register printer<br></li></ul>', 1175000, 'Komputer-Kasir-Desktop-Sunmi-T2-Dual-15-1632237691_3f174ee10c82b0108f1d.png', '2021-09-21 10:21:31', '2021-09-21 23:55:17', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
