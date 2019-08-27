-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2019-08-27 07:04:08
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
-- 表的结构 `hr_jrclienttenthouold`
--

CREATE TABLE `hr_jrclienttenthouold` (
  `jgh` varchar(20) NOT NULL,
  `sfz` varchar(50) NOT NULL,
  `zyue` double NOT NULL,
  `huoqi` double NOT NULL,
  `dingqi` double NOT NULL,
  `jghsfz` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `hr_jrclienttenthouold`
--
ALTER TABLE `hr_jrclienttenthouold`
  ADD KEY `jghsfz` (`jghsfz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
