-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-06-02 14:50:06
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ckeditor`
--

-- --------------------------------------------------------

--
-- 資料表結構 `index_backend`
--

CREATE TABLE `index_backend` (
  `id` int(11) NOT NULL,
  `title` varchar(33) COLLATE utf32_unicode_ci NOT NULL,
  `school` varchar(33) COLLATE utf32_unicode_ci NOT NULL,
  `context` text COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- 傾印資料表的資料 `index_backend`
--

INSERT INTO `index_backend` (`id`, `title`, `school`, `context`) VALUES
(2, 'testt', 'erwewr', '<p><img alt=\"\" src=\"http://localhost/ckeditor4-filemanager/uploads/Sci-fi_Space_Art-X-Wing_on_patrol-_Spacescapes_1280x1024.jpg\" style=\"height:266px; width:333px\" /></p>\r\n\r\n<p><span style=\"color:#2ecc71\"><span style=\"font-size:20px\"><span style=\"background-color:#2c3e50\">123</span></span></span></p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `index_backend`
--
ALTER TABLE `index_backend`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `index_backend`
--
ALTER TABLE `index_backend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
