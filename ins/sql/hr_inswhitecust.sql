-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-09-04 03:27:35
-- 服务器版本： 8.0.16
-- PHP 版本： 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `posthr`
--

-- --------------------------------------------------------

--
-- 表的结构 `hr_inswhitecust`
--

CREATE TABLE `hr_inswhitecust` (
  `whitecustid` int(255) NOT NULL,
  `whitecust` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sfz` varchar(20) NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `intention` int(255) NOT NULL,
  `service` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_one` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `money_one` double DEFAULT NULL,
  `product_two` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `money_two` double DEFAULT NULL,
  `phonebank` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `facilitate` varchar(11) DEFAULT NULL,
  `capital` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `insdate` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `insdates` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '维护日期',
  `record` varchar(11) DEFAULT NULL,
  `dwname` varchar(11) NOT NULL,
  `jgh` varchar(11) NOT NULL,
  `expdate` varchar(11) DEFAULT NULL,
  `exp` varchar(100) DEFAULT NULL,
  `expstats` int(11) NOT NULL DEFAULT '1',
  `beizhu` varchar(100) DEFAULT NULL,
  `stats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `hr_inswhitecust`
--
ALTER TABLE `hr_inswhitecust`
  ADD PRIMARY KEY (`whitecustid`),
  ADD UNIQUE KEY `sfz` (`sfz`,`jgh`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hr_inswhitecust`
--
ALTER TABLE `hr_inswhitecust`
  MODIFY `whitecustid` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
