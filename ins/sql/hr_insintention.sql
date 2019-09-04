-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-09-04 03:27:11
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
-- 表的结构 `hr_insintention`
--

CREATE TABLE `hr_insintention` (
  `intentionid` int(255) NOT NULL,
  `intention` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `beizhu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `stats` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hr_insintention`
--

INSERT INTO `hr_insintention` (`intentionid`, `intention`, `beizhu`, `stats`, `sort`) VALUES
(1, '趸交', NULL, 0, NULL),
(2, '规模型期交', NULL, 0, NULL),
(3, '长期险[年金型、万能型]', NULL, 0, NULL),
(4, '长期险[保障型]', NULL, 0, NULL),
(5, '中短', NULL, 11, NULL),
(6, '长趸', NULL, 11, NULL),
(7, '规模型期交', NULL, 11, NULL),
(8, '长期险', NULL, 11, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `hr_insintention`
--
ALTER TABLE `hr_insintention`
  ADD PRIMARY KEY (`intentionid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hr_insintention`
--
ALTER TABLE `hr_insintention`
  MODIFY `intentionid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
