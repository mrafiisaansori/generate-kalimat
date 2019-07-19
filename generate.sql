/*
 Navicat Premium Data Transfer

 Source Server         : generate rafiisa
 Source Server Type    : MySQL
 Source Server Version : 50556
 Source Host           : rafiisa.com:3306
 Source Schema         : generate

 Target Server Type    : MySQL
 Target Server Version : 50556
 File Encoding         : 65001

 Date: 17/07/2019 19:30:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
