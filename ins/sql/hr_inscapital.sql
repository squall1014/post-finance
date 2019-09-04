-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-09-04 03:26:55
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
-- 表的结构 `hr_inscapital`
--

CREATE TABLE `hr_inscapital` (
  `capitalid` int(255) NOT NULL,
  `capital` varchar(100) NOT NULL,
  `beizhu` varchar(100) DEFAULT NULL,
  `stats` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hr_inscapital`
--

INSERT INTO `hr_inscapital` (`capitalid`, `capital`, `beizhu`, `stats`) VALUES
(1, '本行活期', NULL, '0'),
(2, '本行定期', NULL, '0'),
(3, '本行理财', NULL, '0'),
(4, '保险未到期', NULL, '0'),
(5, '他行', NULL, '0'),
(6, '现金', NULL, '0');

--
-- 转储表的索引
--

--
-- 表的索引 `hr_inscapital`
--
ALTER TABLE `hr_inscapital`
  ADD PRIMARY KEY (`capitalid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `hr_inscapital`
--
ALTER TABLE `hr_inscapital`
  MODIFY `capitalid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
