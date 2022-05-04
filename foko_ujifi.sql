/*
 Navicat Premium Data Transfer

 Source Server         : local (db list filtered)
 Source Server Type    : MySQL
 Source Server Version : 100109
 Source Host           : localhost:3306
 Source Schema         : foko_ujifi

 Target Server Type    : MySQL
 Target Server Version : 100109
 File Encoding         : 65001

 Date: 04/05/2022 23:43:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aszf
-- ----------------------------
DROP TABLE IF EXISTS `aszf`;
CREATE TABLE `aszf`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_creation` datetime(0) NULL DEFAULT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of aszf
-- ----------------------------

-- ----------------------------
-- Table structure for beallitasok
-- ----------------------------
DROP TABLE IF EXISTS `beallitasok`;
CREATE TABLE `beallitasok`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kulcs` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ertek` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tabla` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `kulcs`(`kulcs`, `tabla`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of beallitasok
-- ----------------------------

-- ----------------------------
-- Table structure for csoport
-- ----------------------------
DROP TABLE IF EXISTS `csoport`;
CREATE TABLE `csoport`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_vezeto1` int(11) NULL DEFAULT NULL,
  `ID_vezeto2` int(11) NULL DEFAULT NULL,
  `hely` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ID_tabor` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `ID_vezeto1`(`ID_vezeto1`) USING BTREE,
  INDEX `ID_vezeto2`(`ID_vezeto2`) USING BTREE,
  INDEX `ID_tabor`(`ID_tabor`) USING BTREE,
  CONSTRAINT `csoport_ibfk_1` FOREIGN KEY (`ID_vezeto1`) REFERENCES `jelentkezo` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `csoport_ibfk_2` FOREIGN KEY (`ID_vezeto2`) REFERENCES `jelentkezo` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `csoport_ibfk_3` FOREIGN KEY (`ID_tabor`) REFERENCES `tabor` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of csoport
-- ----------------------------
INSERT INTO `csoport` VALUES (1, 'Akármi csoport 123', NULL, 4, NULL, 1);
INSERT INTO `csoport` VALUES (5, 'csoport 3', 2, NULL, 'asdasd', 1);
INSERT INTO `csoport` VALUES (17, '', NULL, NULL, NULL, 1);
INSERT INTO `csoport` VALUES (18, 'dfgsdgf', 1, NULL, NULL, 1);
INSERT INTO `csoport` VALUES (21, 'sadfsd', NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for dieta
-- ----------------------------
DROP TABLE IF EXISTS `dieta`;
CREATE TABLE `dieta`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `megnevezes`(`megnevezes`) USING BTREE,
  INDEX `ID`(`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dieta
-- ----------------------------

-- ----------------------------
-- Table structure for emelet
-- ----------------------------
DROP TABLE IF EXISTS `emelet`;
CREATE TABLE `emelet`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `szint` smallint(6) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of emelet
-- ----------------------------

-- ----------------------------
-- Table structure for epulet
-- ----------------------------
DROP TABLE IF EXISTS `epulet`;
CREATE TABLE `epulet`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `utca_hsz` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `irszam` smallint(4) NULL DEFAULT NULL,
  `lakokneme` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of epulet
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for folyoso
-- ----------------------------
DROP TABLE IF EXISTS `folyoso`;
CREATE TABLE `folyoso`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of folyoso
-- ----------------------------

-- ----------------------------
-- Table structure for jelenetkezo_dieta
-- ----------------------------
DROP TABLE IF EXISTS `jelenetkezo_dieta`;
CREATE TABLE `jelenetkezo_dieta`  (
  `ID_dieta` int(11) NOT NULL,
  `ID_jelentkezo` int(11) NOT NULL,
  UNIQUE INDEX `ID_dieta`(`ID_dieta`, `ID_jelentkezo`) USING BTREE,
  INDEX `jelenetkezo_dieta_ibfk_2`(`ID_jelentkezo`) USING BTREE,
  CONSTRAINT `jelenetkezo_dieta_ibfk_1` FOREIGN KEY (`ID_dieta`) REFERENCES `dieta` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jelenetkezo_dieta_ibfk_2` FOREIGN KEY (`ID_jelentkezo`) REFERENCES `jelentkezo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jelenetkezo_dieta
-- ----------------------------

-- ----------------------------
-- Table structure for jelentkezo
-- ----------------------------
DROP TABLE IF EXISTS `jelentkezo`;
CREATE TABLE `jelentkezo`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_tabor` int(11) NULL DEFAULT NULL,
  `nev_elotag` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nev_vezetek` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nev_kereszt` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `szuletesnap` date NULL DEFAULT NULL,
  `nevnap` date NULL DEFAULT NULL,
  `szallas_kulcsszo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nem` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `eloleg` smallint(6) NOT NULL DEFAULT 0,
  `eloleg_megerkezett` datetime(0) NULL DEFAULT NULL,
  `taborba_megerkezett` smallint(1) NULL DEFAULT NULL,
  `ID_szallasszoba` int(11) NULL DEFAULT NULL,
  `ID_csoport` int(11) NULL DEFAULT NULL,
  `ID_aszf` int(11) NULL DEFAULT NULL,
  `DATE_creation` datetime(0) NULL DEFAULT NULL,
  `DATE_lastmod` datetime(0) NULL DEFAULT NULL,
  `ID_szerepkor` int(11) UNSIGNED NULL DEFAULT NULL,
  `ID_user` int(11) UNSIGNED NULL DEFAULT NULL,
  `MOD_user` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `jel_tabor`(`ID_tabor`) USING BTREE,
  INDEX `jel_aszf`(`ID_aszf`) USING BTREE,
  INDEX `MOD_user`(`MOD_user`) USING BTREE,
  INDEX `ID_csoport`(`ID_csoport`) USING BTREE,
  CONSTRAINT `jel_aszf` FOREIGN KEY (`ID_aszf`) REFERENCES `aszf` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `jel_tabor` FOREIGN KEY (`ID_tabor`) REFERENCES `tabor` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `jelentkezo_ibfk_1` FOREIGN KEY (`MOD_user`) REFERENCES `jelentkezo` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `jelentkezo_ibfk_2` FOREIGN KEY (`ID_csoport`) REFERENCES `csoport` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jelentkezo
-- ----------------------------
INSERT INTO `jelentkezo` VALUES (1, 1, NULL, 'wm', 'asd', 'asd@dsa', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2022-04-20 23:28:31', '2022-04-27 01:19:38', 1, 1, NULL);
INSERT INTO `jelentkezo` VALUES (2, 1, 'munkavegzo', '', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2022-04-22 13:24:32', '2022-04-22 21:38:12', NULL, NULL, NULL);
INSERT INTO `jelentkezo` VALUES (3, 1, 'dsa', 'dsads', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 5, NULL, '2022-04-22 12:07:54', '2022-04-29 23:41:15', NULL, 1, NULL);
INSERT INTO `jelentkezo` VALUES (4, 1, 'sdfsfd', '', '', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2022-04-29 23:06:19', '2022-04-29 23:14:54', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for jelentkezo_jog
-- ----------------------------
DROP TABLE IF EXISTS `jelentkezo_jog`;
CREATE TABLE `jelentkezo_jog`  (
  `ID_jelentkezo` int(11) NOT NULL,
  `ID_jog` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jelentkezo_jog
-- ----------------------------
INSERT INTO `jelentkezo_jog` VALUES (1, 4);
INSERT INTO `jelentkezo_jog` VALUES (3, 2);

-- ----------------------------
-- Table structure for jelentkezo_napok
-- ----------------------------
DROP TABLE IF EXISTS `jelentkezo_napok`;
CREATE TABLE `jelentkezo_napok`  (
  `ID_jelentkezo` int(11) NULL DEFAULT NULL,
  `ID_napok` int(11) NULL DEFAULT NULL,
  INDEX `ID_jelentkezo`(`ID_jelentkezo`) USING BTREE,
  INDEX `ID_napok`(`ID_napok`) USING BTREE,
  CONSTRAINT `jelentkezo_napok_ibfk_1` FOREIGN KEY (`ID_jelentkezo`) REFERENCES `jelentkezo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jelentkezo_napok_ibfk_2` FOREIGN KEY (`ID_napok`) REFERENCES `napok` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jelentkezo_napok
-- ----------------------------

-- ----------------------------
-- Table structure for jelentkezo_segitomunka
-- ----------------------------
DROP TABLE IF EXISTS `jelentkezo_segitomunka`;
CREATE TABLE `jelentkezo_segitomunka`  (
  `ID_jelentkezo` int(11) NULL DEFAULT NULL,
  `ID_segito_munka` int(11) NULL DEFAULT NULL,
  UNIQUE INDEX `ID_jelentkezo`(`ID_jelentkezo`, `ID_segito_munka`) USING BTREE,
  INDEX `ID_segito_munka`(`ID_segito_munka`) USING BTREE,
  CONSTRAINT `jelentkezo_segitomunka_ibfk_1` FOREIGN KEY (`ID_jelentkezo`) REFERENCES `jelentkezo` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `jelentkezo_segitomunka_ibfk_2` FOREIGN KEY (`ID_segito_munka`) REFERENCES `segitomunka` (`ID`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jelentkezo_segitomunka
-- ----------------------------
INSERT INTO `jelentkezo_segitomunka` VALUES (2, 1);
INSERT INTO `jelentkezo_segitomunka` VALUES (2, 2);

-- ----------------------------
-- Table structure for jog
-- ----------------------------
DROP TABLE IF EXISTS `jog`;
CREATE TABLE `jog`  (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jog
-- ----------------------------
INSERT INTO `jog` VALUES (1, 'asd1', 'groups');
INSERT INTO `jog` VALUES (2, 'asd2', 'b');
INSERT INTO `jog` VALUES (3, 'asd3', 'c');
INSERT INTO `jog` VALUES (4, 'dsa', 'd');

-- ----------------------------
-- Table structure for kedvezmenyesdatum
-- ----------------------------
DROP TABLE IF EXISTS `kedvezmenyesdatum`;
CREATE TABLE `kedvezmenyesdatum`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NULL DEFAULT NULL,
  `ID_tabor` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `ID_tabor`(`ID_tabor`) USING BTREE,
  CONSTRAINT `kedvezmenyesdatum_ibfk_1` FOREIGN KEY (`ID_tabor`) REFERENCES `tabor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kedvezmenyesdatum
-- ----------------------------

-- ----------------------------
-- Table structure for korsav
-- ----------------------------
DROP TABLE IF EXISTS `korsav`;
CREATE TABLE `korsav`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kor_min` int(255) NULL DEFAULT NULL,
  `kor_max` int(255) NULL DEFAULT NULL,
  `nemkell_szallas` tinyint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of korsav
-- ----------------------------

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime(0) NULL DEFAULT NULL,
  `msg` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (2, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);

-- ----------------------------
-- Table structure for napok
-- ----------------------------
DROP TABLE IF EXISTS `napok`;
CREATE TABLE `napok`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `reggeli_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `tizorai_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `ebed_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `uzsonna_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `vacsora_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `szallas_kerheto` tinyint(1) NOT NULL DEFAULT 0,
  `ID_tabor` int(11) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `ID_tabor`(`ID_tabor`) USING BTREE,
  CONSTRAINT `napok_ibfk_1` FOREIGN KEY (`ID_tabor`) REFERENCES `tabor` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of napok
-- ----------------------------
INSERT INTO `napok` VALUES (5, '2022-04-07', 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `napok` VALUES (6, '2022-04-06', 0, 0, 0, 0, 0, 0, 1);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('59130d5aac11f00b5bc3cb091867bde9f32b1330f03f4145fba3745ceff9ecd83150df14c34404fc', 1, 1, 'api-application', '[]', 0, '2022-04-25 01:39:30', '2022-04-25 01:39:30', '2023-04-25 01:39:30');
INSERT INTO `oauth_access_tokens` VALUES ('9eccc9d235d1db8608b6db4c05e8a96bcd46ec8259eccd12976ce38dd7ff8a38b27a21279694fb6b', 1, 1, 'api-application', '[]', 0, '2022-04-25 01:37:46', '2022-04-25 01:37:46', '2023-04-25 01:37:46');
INSERT INTO `oauth_access_tokens` VALUES ('9f2d110c439186c4f345d642442d2b5d948a6c0f6980c581c3dca29279c2b0d822c5afe9a592f076', 1, 1, 'api-application', '[]', 0, '2022-04-25 01:39:48', '2022-04-25 01:39:48', '2023-04-25 01:39:48');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_auth_codes_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', '8IDl23czllNkv4ASqHOqTwreIp55IoDhLEfOInD8', NULL, 'http://localhost', 1, 0, 0, '2022-04-25 01:16:52', '2022-04-25 01:16:52');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'qI57fOWK9inv6HXauu4Lu7P7Depi5nAXVk47j5yz', 'users', 'http://localhost', 0, 1, 0, '2022-04-25 01:16:52', '2022-04-25 01:16:52');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2022-04-25 01:16:52', '2022-04-25 01:16:52');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for segitomunka
-- ----------------------------
DROP TABLE IF EXISTS `segitomunka`;
CREATE TABLE `segitomunka`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `megnevezes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of segitomunka
-- ----------------------------
INSERT INTO `segitomunka` VALUES (1, 'Csoport Vezető', 'csoport_vezeto');
INSERT INTO `segitomunka` VALUES (2, 'akármi', 'valami');

-- ----------------------------
-- Table structure for szerepkor
-- ----------------------------
DROP TABLE IF EXISTS `szerepkor`;
CREATE TABLE `szerepkor`  (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of szerepkor
-- ----------------------------
INSERT INTO `szerepkor` VALUES (1, 'asd');

-- ----------------------------
-- Table structure for szerepkor_jog
-- ----------------------------
DROP TABLE IF EXISTS `szerepkor_jog`;
CREATE TABLE `szerepkor_jog`  (
  `ID_szerepkor` int(11) NOT NULL,
  `ID_jog` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Compact;

-- ----------------------------
-- Records of szerepkor_jog
-- ----------------------------
INSERT INTO `szerepkor_jog` VALUES (1, 1);
INSERT INTO `szerepkor_jog` VALUES (1, 2);
INSERT INTO `szerepkor_jog` VALUES (1, 3);

-- ----------------------------
-- Table structure for szoba
-- ----------------------------
DROP TABLE IF EXISTS `szoba`;
CREATE TABLE `szoba`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ferohely_felnott` smallint(4) NULL DEFAULT NULL,
  `ferohely_gyerek` smallint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of szoba
-- ----------------------------

-- ----------------------------
-- Table structure for tabor
-- ----------------------------
DROP TABLE IF EXISTS `tabor`;
CREATE TABLE `tabor`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `motto` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ID_aszf` int(11) NULL DEFAULT NULL,
  `varos` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cim` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ferohely` int(11) NULL DEFAULT NULL,
  `kor_min` int(11) NULL DEFAULT NULL,
  `kor_max` int(11) NULL DEFAULT NULL,
  `REG_start` datetime(0) NULL DEFAULT NULL,
  `REG_end` datetime(0) NULL DEFAULT NULL,
  `DATE_creation` datetime(0) NULL DEFAULT NULL,
  `DATE_lastmod` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `tabor_aszf`(`ID_aszf`) USING BTREE,
  CONSTRAINT `tabor_aszf` FOREIGN KEY (`ID_aszf`) REFERENCES `aszf` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tabor
-- ----------------------------
INSERT INTO `tabor` VALUES (1, 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-20 23:30:31', '2022-04-24 18:44:20');
INSERT INTO `tabor` VALUES (2, 'dsasda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-24 18:56:54', NULL);

-- ----------------------------
-- Table structure for taborar
-- ----------------------------
DROP TABLE IF EXISTS `taborar`;
CREATE TABLE `taborar`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_tabor` int(255) NULL DEFAULT NULL,
  `AR_reggeli` int(255) NULL DEFAULT NULL,
  `AR_tizorai` int(255) NULL DEFAULT NULL,
  `AR_ebed` int(255) NULL DEFAULT NULL,
  `AR_uzsonna` int(255) NULL DEFAULT NULL,
  `AR_vacsora` int(255) NULL DEFAULT NULL,
  `AR_jelenlet` int(255) NULL DEFAULT NULL,
  `AR_szallas` int(255) NULL DEFAULT NULL,
  `ID_kor` int(255) NULL DEFAULT NULL,
  `ID_kedvdatum` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `ID_kor`(`ID_kor`) USING BTREE,
  INDEX `ID_kedvdatum`(`ID_kedvdatum`) USING BTREE,
  INDEX `ID_tabor`(`ID_tabor`) USING BTREE,
  CONSTRAINT `taborar_ibfk_1` FOREIGN KEY (`ID_kor`) REFERENCES `korsav` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `taborar_ibfk_2` FOREIGN KEY (`ID_kedvdatum`) REFERENCES `kedvezmenyesdatum` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `taborar_ibfk_3` FOREIGN KEY (`ID_tabor`) REFERENCES `tabor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of taborar
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `access_level` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `api_token`(`api_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'WMage', 'bsebi88@gmail.com', '2022-04-14 14:30:48', '$2y$10$EXXObg.eeax8X4IHlwKHd.TBRCfkObvL6PL/HkSGVaAC9wHlyCo72', 'asdasdasd', 'QqUNpjJxEVz8B5EZX022zaZS9JdSp9l49xyNEbHjnOz93EMXwIw6HJlcwRat', 2, '2022-04-06 14:31:01', NULL);

-- ----------------------------
-- Triggers structure for table aszf
-- ----------------------------
DROP TRIGGER IF EXISTS `aszf_creation`;
delimiter ;;
CREATE TRIGGER `aszf_creation` BEFORE INSERT ON `aszf` FOR EACH ROW BEGIN 
SET NEW.DATE_creation = NOW(); 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table aszf
-- ----------------------------
DROP TRIGGER IF EXISTS `aszf_update_block`;
delimiter ;;
CREATE TRIGGER `aszf_update_block` BEFORE UPDATE ON `aszf` FOR EACH ROW BEGIN 
SET NEW.ID = OLD.ID; 
SET NEW.text = OLD.text; 
SET NEW.DATE_creation = OLD.DATE_creation; 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table epulet
-- ----------------------------
DROP TRIGGER IF EXISTS `epulet_creation_lakokneme`;
delimiter ;;
CREATE TRIGGER `epulet_creation_lakokneme` BEFORE INSERT ON `epulet` FOR EACH ROW BEGIN 
IF (NEW.lakokneme NOT IN ('F', 'N', 'V')) THEN
SET NEW.lakokneme = NULL;
END IF; 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table epulet
-- ----------------------------
DROP TRIGGER IF EXISTS `epulet_update_lakokneme`;
delimiter ;;
CREATE TRIGGER `epulet_update_lakokneme` BEFORE UPDATE ON `epulet` FOR EACH ROW BEGIN 
IF (NEW.lakokneme NOT IN ('F', 'N', 'V')) THEN
SET NEW.lakokneme = NULL;
END IF; 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table jelentkezo
-- ----------------------------
DROP TRIGGER IF EXISTS `jelentkezok_creation_nem`;
delimiter ;;
CREATE TRIGGER `jelentkezok_creation_nem` BEFORE INSERT ON `jelentkezo` FOR EACH ROW BEGIN 
SET NEW.DATE_creation = NOW(); 
IF (NEW.nem NOT IN ('F', 'N')) THEN
SET NEW.nem = NULL;
END IF; 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table jelentkezo
-- ----------------------------
DROP TRIGGER IF EXISTS `jelentkezok_lastmod_nem`;
delimiter ;;
CREATE TRIGGER `jelentkezok_lastmod_nem` BEFORE UPDATE ON `jelentkezo` FOR EACH ROW BEGIN 
SET NEW.DATE_lastmod = NOW(); 
IF (NEW.nem NOT IN ('F', 'N')) THEN
SET NEW.nem = NULL;
END IF; 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tabor
-- ----------------------------
DROP TRIGGER IF EXISTS `tabor_creation`;
delimiter ;;
CREATE TRIGGER `tabor_creation` BEFORE INSERT ON `tabor` FOR EACH ROW BEGIN 
SET NEW.DATE_creation = NOW(); 
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tabor
-- ----------------------------
DROP TRIGGER IF EXISTS `tabor_lastmod`;
delimiter ;;
CREATE TRIGGER `tabor_lastmod` BEFORE UPDATE ON `tabor` FOR EACH ROW BEGIN 
SET NEW.DATE_lastmod = NOW(); 
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
