-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-06-15 18:07:45
-- 服务器版本： 5.7.26
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
-- 数据库： `zhubao_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_block`
--

CREATE TABLE `mys_1_block` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `code` varchar(100) NOT NULL COMMENT '别名',
  `content` text NOT NULL COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资料块表';

--
-- 转存表中的数据 `mys_1_block`
--

INSERT INTO `mys_1_block` (`id`, `name`, `code`, `content`) VALUES
(1, 'D-shine', 'dshine', '{i-3}:6'),
(2, '关于我们图2', 'guanyuwomen', '{i-3}:7'),
(3, 'New arrivels', 'new_arrivels', '{i-0}:know more about our latest collection'),
(4, 'featured products', 'featured_products', '{i-0}:know more about our latest collection'),
(5, 'our featured categories', 'our_featured_categories', '{i-0}:make easy shop with our categories'),
(6, 'this is D-shine', 'this_is_dshine', '{i-0}:shop over our best brands'),
(7, 'some words from our customers', 'some_words_from_our_customers', '{i-0}:we satisfied more than 700 customers'),
(8, 'our brands', 'our_brands', '{i-0}:choose best with our favorite brands'),
(9, 'Blog Updates', 'blog_updates', '{i-0}:we satisfied more than 700 customers'),
(10, 'ABOUT D-SHINE', 'about_dshine', 'We provide the best Quality of products to you.We are always here to help our lovely customers.'),
(11, 'free shipping', 'free_shipping', '{i-0}:International'),
(12, '24 hours helpline', '24_hours_helplinet', '{i-3}:52'),
(13, 'see our', 'see_our', '{i-0}:latest offers'),
(14, 'see our图', 'see_ourtu', '{i-3}:51'),
(15, 'free shipping图', 'free_shippingt', '{i-3}:53'),
(16, 'how we work', 'how_we_work', '{i-0}:how we work'),
(17, 'meet our team', 'meet_our_team', '{i-0}:meet our team'),
(18, 'our clients', 'our_clients', '{i-0}:clients who are happy with our Dshine'),
(19, ' where to reach us', '_where_to_reach_us', 'You can reach us at the following address:'),
(20, ' Email us @', '_email_us_', 'Email your issues and suggestion for the following email addresses: '),
(21, 'need to call us?', 'need_to_call_us', 'From Monday to Friday,10:00 AM - 8:00 PM, call us at:'),
(22, ' we have great support', '_we_have_great_support', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure. We provide the best Quality of products to you.'),
(23, 'flickr photostream', 'flickr_photostream', '{i-4}:\"{\\\"file\\\":[\\\"69\\\",\\\"70\\\",\\\"71\\\",\\\"72\\\",\\\"73\\\",\\\"74\\\"],\\\"title\\\":[\\\"1\\\",\\\"2\\\",\\\"3\\\",\\\"5\\\",\\\"6\\\",\\\"4\\\"],\\\"description\\\":[\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\"]}\"'),
(24, 'show1', 'show1', '{i-4}:\"{\\\"file\\\":[\\\"81\\\",\\\"82\\\",\\\"83\\\",\\\"84\\\",\\\"85\\\",\\\"86\\\",\\\"87\\\",\\\"88\\\"],\\\"title\\\":[\\\"1\\\",\\\"2\\\",\\\"3\\\",\\\"4\\\",\\\"5\\\",\\\"6\\\",\\\"7\\\",\\\"8\\\"],\\\"description\\\":[\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\"]}\"'),
(25, 'show2', 'show2', '{i-4}:\"{\\\"file\\\":[\\\"89\\\",\\\"90\\\",\\\"91\\\",\\\"92\\\",\\\"93\\\",\\\"94\\\",\\\"95\\\",\\\"96\\\"],\\\"title\\\":[\\\"1s\\\",\\\"2s\\\",\\\"3s\\\",\\\"4s\\\",\\\"5s\\\",\\\"6s\\\",\\\"7s\\\",\\\"8s\\\"],\\\"description\\\":[\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\",\\\"\\\"]}\"'),
(26, 'Product Details', 'product_details', 'Dining furniture designs are plain in appearance, stripped to bare essentials (few turnings, no decorations), featuring natural materials; no ornamentation; strong emphasis on function.Dining furniture designs are plain in appearance, stripped to bare essentials (few turnings, no decorations), featuring natural materials; no ornamentation; strong emphasis on function.'),
(27, 'Product Details图', 'product_detailst', '{i-3}:97'),
(28, '购物车', 'gouwuche', '{i-3}:98'),
(29, 'latest products', 'latest_products', '{i-0}:know more about our latest collection');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin`
--

CREATE TABLE `mys_1_chanpin` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` int(10) UNSIGNED DEFAULT NULL COMMENT '浏览数',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '同步id',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数量',
  `avgsort` decimal(10,2) UNSIGNED DEFAULT '0.00' COMMENT '平均点评分数',
  `displayorder` int(10) DEFAULT '0' COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容主表';

--
-- 转存表中的数据 `mys_1_chanpin`
--

INSERT INTO `mys_1_chanpin` (`id`, `catid`, `title`, `thumb`, `keywords`, `description`, `hits`, `uid`, `author`, `status`, `url`, `link_id`, `tableid`, `inputip`, `inputtime`, `updatetime`, `comments`, `avgsort`, `displayorder`) VALUES
(1, 1, 'Cushion', '8', '', 'Bar Set Anniversary Ring', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=1', 0, 0, '127.0.0.1', 1642057440, 1642057602, 0, '0.00', 0),
(2, 1, 'Ovel', '9', '', 'Bar Set Anniversary Ring', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=2', 0, 0, '127.0.0.1', 1642057609, 1642057630, 0, '0.00', 0),
(3, 1, 'Radiant', '10', '', 'Bar Set Anniversary Ring', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=3', 0, 0, '127.0.0.1', 1642057632, 1642057647, 0, '0.00', 0),
(4, 1, 'Pear', '11', '', 'Bar Set Anniversary Ring', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=4', 0, 0, '127.0.0.1', 1642057649, 1642057663, 0, '0.00', 0),
(5, 1, 'Round', '12', '', 'Bar Set Anniversary Ring', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=5', 0, 0, '127.0.0.1', 1642057682, 1642057700, 0, '0.00', 0),
(6, 2, 'Curabitur cursus dignis', '13', '125.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=6', 0, 0, '127.0.0.1', 1642057855, 1642057927, 0, '0.00', 0),
(7, 2, 'Donec aliquam', '14', '125.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=7', 0, 0, '127.0.0.1', 1642057982, 1642058010, 0, '0.00', 0),
(8, 2, 'Gravida est', '15', '125.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=8', 0, 0, '127.0.0.1', 1642058012, 1642058039, 0, '0.00', 0),
(9, 2, 'Maximus quam posuere', '16', '125.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=9', 0, 0, '127.0.0.1', 1642058041, 1642058062, 0, '0.00', 0),
(10, 3, 'Bracelets', '48', '11 items', 'See the Collection', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=10', 0, 0, '127.0.0.1', 1642058114, 1642060613, 0, '0.00', 0),
(11, 3, 'Rings', '18', '21 items', 'See the Collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=11', 0, 0, '127.0.0.1', 1642058167, 1642058209, 0, '0.00', 0),
(12, 3, 'cNecklaces', '19', '30 items', 'See the Collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=12', 0, 0, '127.0.0.1', 1642058211, 1642058250, 0, '0.00', 0),
(13, 3, 'Earrings', '20', '55 items', 'See the Collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=13', 0, 0, '127.0.0.1', 1642058252, 1642058277, 0, '0.00', 0),
(14, 4, 'Maximus quam posuerea', '21', '455.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=14', 0, 0, '127.0.0.1', 1642058326, 1642058379, 0, '0.00', 0),
(15, 4, 'Gravida est', '22', '830.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=15', 0, 0, '127.0.0.1', 1642058381, 1642058406, 0, '0.00', 0),
(16, 4, 'Donec aliquam', '23', '525.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=16', 0, 0, '127.0.0.1', 1642058408, 1642058428, 0, '0.00', 0),
(17, 4, 'Curabitur cursus dignis', '24', '1025.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=17', 0, 0, '127.0.0.1', 1642058430, 1642058452, 0, '0.00', 0),
(18, 4, 'Curabitur cursus dignis', '25', '725.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=18', 0, 0, '127.0.0.1', 1642058454, 1642058476, 0, '0.00', 0),
(19, 4, 'Curabitur cursus dignis', '26', '825.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=19', 0, 0, '127.0.0.1', 1642058478, 1642058495, 0, '0.00', 0),
(20, 5, 'Jonh add', '27', '', 'Version:0.9StartHTML:00000184EndHTML:00000254StartFragment:00000218EndFragment:00000218SourceURL:htt...', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=20', 0, 0, '127.0.0.1', 1642058523, 1642058572, 0, '0.00', 0),
(21, 5, 'william parker', '28', '', 'D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=21', 0, 0, '127.0.0.1', 1642058575, 1642058603, 0, '0.00', 0),
(22, 5, 'Will smith', '29', '', 'Donec in velit eget lacus convallis dapibus. Nulla ultrices nulla sit amet justo pretium, ut tristiq...', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=22', 0, 0, '127.0.0.1', 1642058605, 1642058637, 0, '0.00', 0),
(23, 5, 'Dwayne johnson', '30', '', 'D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=23', 0, 0, '127.0.0.1', 1642058640, 1642058650, 0, '0.00', 0),
(24, 5, 'Dwayne johnson', '31', '', 'D-Shine is really excellent site for jewellery. I am very happy with the D-Shine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=24', 0, 0, '127.0.0.1', 1642058652, 1642058685, 0, '0.00', 0),
(25, 6, '1', '32', '', '1', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=25', 0, 0, '127.0.0.1', 1642058714, 1642058728, 0, '0.00', 0),
(26, 6, '2', '33', '', '2', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=26', 0, 0, '127.0.0.1', 1642058730, 1642058737, 0, '0.00', 0),
(27, 6, '3', '34', '', '3', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=27', 0, 0, '127.0.0.1', 1642058739, 1642058745, 0, '0.00', 0),
(28, 6, '4', '35', '', '4', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=28', 0, 0, '127.0.0.1', 1642058747, 1642058754, 0, '0.00', 0),
(29, 6, '5', '36', '', '5', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=29', 0, 0, '127.0.0.1', 1642058756, 1642058784, 0, '0.00', 0),
(30, 7, 'Discover our finely curated collection                               ', '41', '', 'Discover our finely curated collection', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=30', 0, 0, '127.0.0.1', 1642058807, 1642059124, 0, '0.00', 0),
(31, 7, 'Discover our finely curated collection                               ', '42', '', 'Discover our finely curated collection', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=31', 0, 0, '127.0.0.1', 1642058975, 1642059158, 0, '0.00', 0),
(32, 7, 'Discover our unriveled selection of must-have jewelry in timeless styles.                         ', '40', 'Dec', 'Discover our unriveled selection of must-have jewelry in timeless styles.', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=32', 0, 0, '127.0.0.1', 1642059007, 1642063436, 0, '0.00', 0),
(33, 7, 'Discover our finely curated collection                               ', '43', '', 'Discover our finely curated collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=33', 0, 0, '127.0.0.1', 1642059163, 1642059173, 0, '0.00', 0),
(34, 7, 'Discover our finely curated collection                               ', '44', '', 'Discover our finely curated collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=34', 0, 0, '127.0.0.1', 1642059176, 1642059189, 0, '0.00', 0),
(35, 3, 'Rings', '49', '21 TIMES', 'See the Collection', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=35', 0, 0, '127.0.0.1', 1642062850, 1642062947, 0, '0.00', 0),
(36, 6, '6', '62', '', '6', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=36', 0, 0, '127.0.0.1', 1642065481, 1642065551, 0, '0.00', 0),
(37, 8, 'Architecture', '', '', 'Architecture', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=37', 0, 0, '127.0.0.1', 1642123979, 1642123985, 0, '0.00', 0),
(38, 8, 'Beauty', '', '', 'Beauty', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=38', 0, 0, '127.0.0.1', 1642123987, 1642123991, 0, '0.00', 0),
(39, 8, 'Cars', '', '', 'Cars', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=39', 0, 0, '127.0.0.1', 1642123993, 1642124002, 0, '0.00', 0),
(40, 8, 'Entertainment', '', '', 'Entertainment', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=40', 0, 0, '127.0.0.1', 1642124004, 1642124021, 0, '0.00', 0),
(41, 8, 'People', '', '', 'People', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=41', 0, 0, '127.0.0.1', 1642124023, 1642124029, 0, '0.00', 0),
(42, 8, 'Templates', '', '', 'Templates', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=42', 0, 0, '127.0.0.1', 1642124031, 1642124038, 0, '0.00', 0),
(43, 8, 'Tour', '', '', 'Tour', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=43', 0, 0, '127.0.0.1', 1642124040, 1642124048, 0, '0.00', 0),
(44, 9, 'you can contribute', '64', 'Dec 14', 'you can contribute', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=44', 0, 0, '127.0.0.1', 1642124095, 1642124148, 0, '0.00', 0),
(45, 9, 'best site for sofas', '65', 'Dec 14', 'best site for sofas', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=45', 0, 0, '127.0.0.1', 1642124150, 1642124194, 0, '0.00', 0),
(46, 9, 'entertainment weeks', '66', 'Dec 14', 'entertainment weeks', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=46', 0, 0, '127.0.0.1', 1642124196, 1642124230, 0, '0.00', 0),
(47, 9, 'Dec 14', '67', 'Dec 14', 'Dec 14', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=47', 0, 0, '127.0.0.1', 1642124233, 1642124245, 0, '0.00', 0),
(48, 9, 'manufacture tips -1', '68', 'Dec 14', 'manufacture tips -1', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=48', 0, 0, '127.0.0.1', 1642124247, 1642124264, 0, '0.00', 0),
(49, 10, 'Art', '', '', 'Art', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=49', 0, 0, '127.0.0.1', 1642124276, 1642124300, 0, '0.00', 0),
(50, 10, 'Beauty', '', '', 'Beauty', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=50', 0, 0, '127.0.0.1', 1642124302, 1642124305, 0, '0.00', 0),
(51, 10, 'Beauty', '', '', 'Beauty', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=51', 0, 0, '127.0.0.1', 1642124307, 1642124315, 0, '0.00', 0),
(52, 10, 'Gallery', '', '', 'Gallery', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=52', 0, 0, '127.0.0.1', 1642124317, 1642124321, 0, '0.00', 0),
(53, 10, 'Games', '', '', 'Games', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=53', 0, 0, '127.0.0.1', 1642124323, 1642124326, 0, '0.00', 0),
(54, 10, 'Images', '', '', 'Images', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=54', 0, 0, '127.0.0.1', 1642124329, 1642124336, 0, '0.00', 0),
(55, 10, 'People', '', '', 'People', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=55', 0, 0, '127.0.0.1', 1642124338, 1642124342, 0, '0.00', 0),
(56, 10, 'Travelling', '', '', 'Travelling', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=56', 0, 0, '127.0.0.1', 1642124344, 1642124348, 0, '0.00', 0),
(57, 11, 'Maximus quam posuere', '75', '455.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=57', 0, 0, '127.0.0.1', 1642125391, 1642125470, 0, '0.00', 0),
(58, 11, 'Donec aliquam', '76', '830.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=58', 0, 0, '127.0.0.1', 1642125472, 1642125486, 0, '0.00', 0),
(59, 11, 'Maximus quam posuere', '80', '525.00', 'Baccarat', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=59', 0, 0, '127.0.0.1', 1642125488, 1642125563, 0, '0.00', 0),
(60, 11, 'quam posuere', '77', '1025.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=60', 0, 0, '127.0.0.1', 1642125511, 1642125524, 0, '0.00', 0),
(61, 11, 'quam posuere', '78', '725.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=61', 0, 0, '127.0.0.1', 1642125526, 1642125543, 0, '0.00', 0),
(62, 11, 'quam posuere', '79', '825.00', 'Baccarat', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=62', 0, 0, '127.0.0.1', 1642125545, 1642125557, 0, '0.00', 0),
(63, 12, 'Precious Jewels Ring', '', '', 'Rustic, natural, often made of bark-covered logs or simple planks. Look for junk shop finds when in the country (for authenticity), or purchase hand-made new versions. Rustic, natural, often made of bark-covered logs or simple planks. Look for junk shop finds when in the country (for authenticity), or purchase hand-made new versions. when in the country (for authenticity), or purchase hand-mad', 1, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=63', 0, 0, '127.0.0.1', 1642127293, 1642127914, 0, '0.00', 0),
(64, 13, 'shop &amp; save', '99', '', 'On all our store items', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=64', 0, 0, '127.0.0.1', 1642129269, 1642129316, 0, '0.00', 0),
(65, 13, 'Product catalog', '100', '', 'Product catalog', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=65', 0, 0, '127.0.0.1', 1642129318, 1642129334, 0, '0.00', 0),
(66, 13, 'product list', '101', '', 'Lorem ipsum dolor sit amet', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=66', 0, 0, '127.0.0.1', 1642129337, 1642129351, 0, '0.00', 0),
(67, 13, 'free shipping', '102', 'on orders over $299', 'This offer is valid on all our store items', 0, 1, 'admin', 9, '/index.php?s=chanpin&c=show&id=67', 0, 0, '127.0.0.1', 1642129353, 1642129380, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_category`
--

CREATE TABLE `mys_1_chanpin_category` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

--
-- 转存表中的数据 `mys_1_chanpin_category`
--

INSERT INTO `mys_1_chanpin_category` (`id`, `pid`, `pids`, `name`, `dirname`, `pdirname`, `child`, `childids`, `thumb`, `show`, `setting`, `displayorder`) VALUES
(1, 0, '0', 'New arrivels', 'arrivels', '', 0, '1', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"arrivels.html\",\"category\":\"arrivels.html\",\"search\":\"search.html\",\"show\":\"arrivels.html\"}}', 0),
(2, 0, '0', 'featured products', 'featured', '', 0, '2', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(3, 0, '0', 'our featured categories', 'featcategories', '', 0, '3', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(4, 0, '0', 'this is D-shine', 'thisdshine', '', 0, '4', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(5, 0, '0', 'some words from our customers', 'customers', '', 0, '5', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(6, 0, '0', 'our brands', 'brands', '', 0, '6', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(7, 0, '0', 'Blog Updates', 'blogupdates', '', 0, '7', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(8, 0, '0', 'categories', 'categories', '', 0, '8', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(9, 0, '0', 'Latest post', 'latestpost', '', 0, '9', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(10, 0, '0', 'tags', 'tags', '', 0, '10', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(11, 0, '0', 'product', 'product', '', 0, '11', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(12, 0, '0', 'other', 'other', '', 0, '12', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(13, 0, '0', '首页中间', 'syzj', '', 0, '13', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_category_data`
--

CREATE TABLE `mys_1_chanpin_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` int(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `jiage` mediumtext COMMENT '价格'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表';

--
-- 转存表中的数据 `mys_1_chanpin_category_data`
--

INSERT INTO `mys_1_chanpin_category_data` (`id`, `uid`, `catid`, `jiage`) VALUES
(63, 1, 12, '&lt;h3 class=&quot;heading price&quot;&gt;&lt;span style=&quot;text-decoration: line-through; color: rgb(127, 127, 127);&quot;&gt;$580&lt;/span&gt;&amp;nbsp;&amp;nbsp; &lt;span style=&quot;font-size: 18px;&quot;&gt;$420&lt;/span&gt;&lt;/h3&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_category_data_0`
--

CREATE TABLE `mys_1_chanpin_category_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表的附表';

--
-- 转存表中的数据 `mys_1_chanpin_category_data_0`
--

INSERT INTO `mys_1_chanpin_category_data_0` (`id`, `uid`, `catid`) VALUES
(63, 1, 12);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_comment`
--

CREATE TABLE `mys_1_chanpin_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '关联id',
  `cuid` int(10) UNSIGNED NOT NULL COMMENT '关联uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `orderid` bigint(18) UNSIGNED NOT NULL COMMENT '订单id',
  `uid` mediumint(8) UNSIGNED DEFAULT '0' COMMENT '评论者ID',
  `author` varchar(250) DEFAULT NULL COMMENT '评论者账号',
  `content` text COMMENT '评论内容',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort2` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort3` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort4` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort5` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort6` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort7` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort8` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort9` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `reply` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '回复id',
  `in_reply` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否存在回复',
  `status` smallint(1) UNSIGNED DEFAULT '0' COMMENT '审核状态',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论内容表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_comment_index`
--

CREATE TABLE `mys_1_chanpin_comment_index` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort2` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort3` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort4` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort5` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort6` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort7` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort8` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort9` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `tableid` smallint(5) UNSIGNED DEFAULT '0' COMMENT '附表id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_data_0`
--

CREATE TABLE `mys_1_chanpin_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容附表';

--
-- 转存表中的数据 `mys_1_chanpin_data_0`
--

INSERT INTO `mys_1_chanpin_data_0` (`id`, `uid`, `catid`, `content`) VALUES
(1, 1, 1, '&lt;p&gt;Bar Set Anniversary Ring&lt;/p&gt;'),
(2, 1, 1, '&lt;p&gt;Bar Set Anniversary Ring&lt;/p&gt;'),
(3, 1, 1, '&lt;p&gt;Bar Set Anniversary Ring&lt;/p&gt;'),
(4, 1, 1, '&lt;p&gt;Bar Set Anniversary Ring&lt;/p&gt;'),
(5, 1, 1, '&lt;p&gt;Bar Set Anniversary Ring&lt;/p&gt;'),
(6, 1, 2, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(7, 1, 2, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(8, 1, 2, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(9, 1, 2, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(10, 1, 3, '&lt;p&gt;See the Collection&lt;/p&gt;'),
(11, 1, 3, '&lt;p&gt;See the Collection&lt;/p&gt;'),
(12, 1, 3, '&lt;p&gt;See the Collection&lt;/p&gt;'),
(13, 1, 3, '&lt;p&gt;See the Collection&lt;/p&gt;'),
(14, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(15, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(16, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(17, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(18, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(19, 1, 4, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(20, 1, 5, '&lt;p&gt;Version:0.9\r\nStartHTML:00000184\r\nEndHTML:00000254\r\nStartFragment:00000218\r\nEndFragment:00000218\r\nSourceURL:https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/index.html#&lt;/p&gt;'),
(21, 1, 5, '&lt;p&gt;D-Shine is really excellent site for jewellery. I am very happy with the\r\n D-Shine products and dedicated services from them. D-Shine is really \r\nexcellent site for jewellery.&lt;/p&gt;'),
(22, 1, 5, '&lt;p&gt;Donec in velit eget lacus convallis dapibus. Nulla ultrices nulla sit \r\namet justo pretium, ut tristique diam ultrices. Nunc efficitur mauris \r\nsit amet imperdiet&lt;/p&gt;'),
(23, 1, 5, '&lt;p&gt;&lt;span class=&quot;t_q_start&quot;&gt;&lt;/span&gt; D-Shine is really excellent site for \r\njewellery. I am very happy with the D-Shine products and dedicated \r\nservices from them. D-Shine is really excellent site for jewellery.&lt;/p&gt;'),
(24, 1, 5, '&lt;p&gt;D-Shine is really excellent site for jewellery. I am very happy with the\r\n D-Shine products and dedicated services from them. D-Shine is really \r\nexcellent site for jewellery.&lt;/p&gt;'),
(25, 1, 6, '&lt;p&gt;1&lt;br/&gt;&lt;/p&gt;'),
(26, 1, 6, '&lt;p&gt;2&lt;br/&gt;&lt;/p&gt;'),
(27, 1, 6, '&lt;p&gt;3&lt;br/&gt;&lt;/p&gt;'),
(28, 1, 6, '&lt;p&gt;4&lt;br/&gt;&lt;/p&gt;'),
(29, 1, 6, '&lt;p&gt;5&lt;br/&gt;&lt;/p&gt;'),
(30, 1, 7, '&lt;p&gt;Discover our finely curated collection&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;'),
(34, 1, 7, '&lt;p&gt;Discover our finely curated collection&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;'),
(35, 1, 3, '&lt;p&gt;&lt;span style=&quot;color: rgb(32, 33, 36); font-family: consolas, &amp;quot;lucida console&amp;quot;, &amp;quot;courier new&amp;quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);&quot;&gt;See the Collection&lt;/span&gt;&lt;/p&gt;'),
(36, 1, 6, '&lt;p&gt;6&lt;/p&gt;'),
(31, 1, 7, '&lt;p&gt;Discover our finely curated collection&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;'),
(33, 1, 7, '&lt;p&gt;Discover our finely curated collection&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;'),
(32, 1, 7, '&lt;p&gt;Discover our unriveled selection of must-have jewelry in timeless styles.&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br/&gt;&lt;/p&gt;'),
(37, 1, 8, '&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;div style=&quot;position: absolute; width: 1px; height: 1px; overflow: hidden; left: -1000px; white-space: nowrap; top: 8px;&quot;&gt;Architecture&lt;/div&gt;'),
(38, 1, 8, '&lt;p&gt;Beauty&lt;/p&gt;'),
(39, 1, 8, '&lt;p&gt;Cars&lt;br/&gt;&lt;/p&gt;'),
(40, 1, 8, '&lt;p&gt;Entertainment&lt;/p&gt;'),
(41, 1, 8, '&lt;p&gt;People&lt;/p&gt;'),
(42, 1, 8, '&lt;p&gt;Templates&lt;/p&gt;'),
(43, 1, 8, '&lt;p&gt;Tour&lt;/p&gt;'),
(44, 1, 9, '&lt;h5 class=&quot;heading&quot;&gt;you can contribute&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(45, 1, 9, '&lt;h5 class=&quot;heading&quot;&gt;best site for sofas&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(46, 1, 9, '&lt;h5 class=&quot;heading&quot;&gt;entertainment weeks&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(47, 1, 9, '&lt;p&gt;Dec 14&lt;/p&gt;'),
(48, 1, 9, '&lt;h5 class=&quot;heading&quot;&gt;manufacture tips -1&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(49, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Art&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(50, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Beauty&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(51, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Beauty&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(52, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Gallery&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(53, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Games&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(54, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Images&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(55, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;People&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(56, 1, 10, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Travelling&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(57, 1, 11, '&lt;p&gt;Baccarat&lt;/p&gt;'),
(58, 1, 11, '&lt;p&gt;&lt;a href=&quot;https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/product.html#&quot;&gt;Baccarat&lt;/a&gt;&lt;/p&gt;'),
(59, 1, 11, '&lt;p&gt;&lt;a href=&quot;https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/product.html#&quot;&gt;Baccarat&lt;/a&gt;&lt;/p&gt;'),
(60, 1, 11, '&lt;p&gt;&lt;a href=&quot;https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/product.html#&quot;&gt;Baccarat&lt;/a&gt;&lt;/p&gt;'),
(61, 1, 11, '&lt;p&gt;&lt;a href=&quot;https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/product.html#&quot;&gt;Baccarat&lt;/a&gt;&lt;/p&gt;'),
(62, 1, 11, '&lt;p&gt;&lt;a href=&quot;https://demosc.chinaz.net/Files/DownLoad/moban/201810/moban3289/product.html#&quot;&gt;Baccarat&lt;/a&gt;&lt;/p&gt;'),
(63, 1, 12, '&lt;p&gt;Rustic, natural, often made of bark-covered logs or simple planks. Look \r\nfor junk shop finds when in the country (for authenticity), or purchase \r\nhand-made new versions. Rustic, natural, often made of bark-covered \r\nlogs or simple planks. Look for junk shop finds when in the country (for\r\n authenticity), or purchase hand-made new versions. when in the country \r\n(for authenticity), or purchase hand-mad&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(64, 1, 13, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;On all our store items&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(65, 1, 13, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Product catalog&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(66, 1, 13, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;Lorem ipsum dolor sit amet&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(67, 1, 13, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;This offer is valid on all our store items&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_draft`
--

CREATE TABLE `mys_1_chanpin_draft` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容草稿表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_flag`
--

CREATE TABLE `mys_1_chanpin_flag` (
  `flag` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文档标记id',
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标记表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_hits`
--

CREATE TABLE `mys_1_chanpin_hits` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `hits` int(10) UNSIGNED NOT NULL COMMENT '总点击数',
  `day_hits` int(10) UNSIGNED NOT NULL COMMENT '本日点击',
  `week_hits` int(10) UNSIGNED NOT NULL COMMENT '本周点击',
  `month_hits` int(10) UNSIGNED NOT NULL COMMENT '本月点击',
  `year_hits` int(10) UNSIGNED NOT NULL COMMENT '年点击量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='时段点击量统计';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_index`
--

CREATE TABLE `mys_1_chanpin_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容索引表';

--
-- 转存表中的数据 `mys_1_chanpin_index`
--

INSERT INTO `mys_1_chanpin_index` (`id`, `uid`, `catid`, `status`, `inputtime`) VALUES
(1, 1, 1, 9, 1642057440),
(2, 1, 1, 9, 1642057609),
(3, 1, 1, 9, 1642057632),
(4, 1, 1, 9, 1642057649),
(5, 1, 1, 9, 1642057682),
(6, 1, 2, 9, 1642057855),
(7, 1, 2, 9, 1642057982),
(8, 1, 2, 9, 1642058012),
(9, 1, 2, 9, 1642058041),
(10, 1, 3, 9, 1642058114),
(11, 1, 3, 9, 1642058167),
(12, 1, 3, 9, 1642058211),
(13, 1, 3, 9, 1642058252),
(14, 1, 4, 9, 1642058326),
(15, 1, 4, 9, 1642058381),
(16, 1, 4, 9, 1642058408),
(17, 1, 4, 9, 1642058430),
(18, 1, 4, 9, 1642058454),
(19, 1, 4, 9, 1642058478),
(20, 1, 5, 9, 1642058523),
(21, 1, 5, 9, 1642058575),
(22, 1, 5, 9, 1642058605),
(23, 1, 5, 9, 1642058640),
(24, 1, 5, 9, 1642058652),
(25, 1, 6, 9, 1642058714),
(26, 1, 6, 9, 1642058730),
(27, 1, 6, 9, 1642058739),
(28, 1, 6, 9, 1642058747),
(29, 1, 6, 9, 1642058756),
(30, 1, 7, 9, 1642058807),
(31, 1, 7, 9, 1642058975),
(32, 1, 7, 9, 1642059007),
(33, 1, 7, 9, 1642059163),
(34, 1, 7, 9, 1642059176),
(35, 1, 3, 9, 1642062850),
(36, 1, 6, 9, 1642065481),
(37, 1, 8, 9, 1642123979),
(38, 1, 8, 9, 1642123987),
(39, 1, 8, 9, 1642123993),
(40, 1, 8, 9, 1642124004),
(41, 1, 8, 9, 1642124023),
(42, 1, 8, 9, 1642124031),
(43, 1, 8, 9, 1642124040),
(44, 1, 9, 9, 1642124095),
(45, 1, 9, 9, 1642124150),
(46, 1, 9, 9, 1642124196),
(47, 1, 9, 9, 1642124233),
(48, 1, 9, 9, 1642124247),
(49, 1, 10, 9, 1642124276),
(50, 1, 10, 9, 1642124302),
(51, 1, 10, 9, 1642124307),
(52, 1, 10, 9, 1642124317),
(53, 1, 10, 9, 1642124323),
(54, 1, 10, 9, 1642124329),
(55, 1, 10, 9, 1642124338),
(56, 1, 10, 9, 1642124344),
(57, 1, 11, 9, 1642125391),
(58, 1, 11, 9, 1642125472),
(59, 1, 11, 9, 1642125488),
(60, 1, 11, 9, 1642125511),
(61, 1, 11, 9, 1642125526),
(62, 1, 11, 9, 1642125545),
(63, 1, 12, 9, 1642127293),
(64, 1, 13, 9, 1642129269),
(65, 1, 13, 9, 1642129318),
(66, 1, 13, 9, 1642129337),
(67, 1, 13, 9, 1642129353);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_recycle`
--

CREATE TABLE `mys_1_chanpin_recycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '删除理由',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容回收站表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_search`
--

CREATE TABLE `mys_1_chanpin_search` (
  `id` varchar(32) NOT NULL,
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `params` text NOT NULL COMMENT '参数数组',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `contentid` mediumtext NOT NULL COMMENT 'id集合',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '搜索时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

--
-- 转存表中的数据 `mys_1_chanpin_search`
--

INSERT INTO `mys_1_chanpin_search` (`id`, `catid`, `params`, `keyword`, `contentid`, `inputtime`) VALUES
('4db51cca0ede10915c226598a6d2a7e0', 0, '{\"param\":{\"keyword\":\"posuere\",\"page\":\"4\"},\"sql\":\"SELECT `mys_1_chanpin`.`id` FROM `mys_1_chanpin` WHERE `mys_1_chanpin`.`status` = 9 AND (`mys_1_chanpin`.`title` LIKE \\\"%posuere%\\\" OR `mys_1_chanpin`.`keywords` LIKE \\\"%posuere%\\\") ORDER BY NULL LIMIT 500\"}', 'posuere', '9,14,57,59,60,61,62', 1642219222);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_time`
--

CREATE TABLE `mys_1_chanpin_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '处理结果',
  `posttime` int(10) UNSIGNED NOT NULL COMMENT '定时发布时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容定时发布表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_chanpin_verify`
--

CREATE TABLE `mys_1_chanpin_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '是否新增',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `backuid` mediumint(8) UNSIGNED NOT NULL COMMENT '操作人uid',
  `backinfo` text NOT NULL COMMENT '操作退回信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容审核表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_form`
--

CREATE TABLE `mys_1_form` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `table` varchar(50) NOT NULL COMMENT '表名',
  `setting` text COMMENT '配置信息'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表单模型表';

--
-- 转存表中的数据 `mys_1_form`
--

INSERT INTO `mys_1_form` (`id`, `name`, `table`, `setting`) VALUES
(1, '联系', 'lianxi', '');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_form_lianxi`
--

CREATE TABLE `mys_1_form_lianxi` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED DEFAULT '0' COMMENT '录入者uid',
  `author` varchar(100) DEFAULT NULL COMMENT '录入者账号',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态值',
  `displayorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序值',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `name` varchar(255) DEFAULT NULL COMMENT 'NAME',
  `email` varchar(255) DEFAULT NULL COMMENT 'EMAIL',
  `subject` varchar(255) DEFAULT NULL COMMENT 'SUBJECT',
  `your_message` text COMMENT 'YOUR MESSAGE'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='联系表单表';

--
-- 转存表中的数据 `mys_1_form_lianxi`
--

INSERT INTO `mys_1_form_lianxi` (`id`, `uid`, `author`, `title`, `inputip`, `inputtime`, `status`, `displayorder`, `tableid`, `name`, `email`, `subject`, `your_message`) VALUES
(1, 1, 'admin', NULL, '127.0.0.1', 1642226781, 0, 0, 0, '', '', '', NULL),
(2, 1, 'admin', NULL, '127.0.0.1', 1642227011, 0, 0, 0, '', '', '', NULL),
(3, 1, 'admin', NULL, '127.0.0.1', 1642227022, 0, 0, 0, '', '', '', NULL),
(4, 1, 'admin', NULL, '127.0.0.1', 1642227074, 0, 0, 0, '', '', '', NULL),
(5, 1, 'admin', NULL, '127.0.0.1', 1642227157, 0, 0, 0, '', '', '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_form_lianxi_data_0`
--

CREATE TABLE `mys_1_form_lianxi_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED DEFAULT '0' COMMENT '录入者uid'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='联系表单附表';

--
-- 转存表中的数据 `mys_1_form_lianxi_data_0`
--

INSERT INTO `mys_1_form_lianxi_data_0` (`id`, `uid`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu`
--

CREATE TABLE `mys_1_guanyu` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` int(10) UNSIGNED DEFAULT NULL COMMENT '浏览数',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '同步id',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数量',
  `avgsort` decimal(10,2) UNSIGNED DEFAULT '0.00' COMMENT '平均点评分数',
  `displayorder` int(10) DEFAULT '0' COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容主表';

--
-- 转存表中的数据 `mys_1_guanyu`
--

INSERT INTO `mys_1_guanyu` (`id`, `catid`, `title`, `thumb`, `keywords`, `description`, `hits`, `uid`, `author`, `status`, `url`, `link_id`, `tableid`, `inputip`, `inputtime`, `updatetime`, `comments`, `avgsort`, `displayorder`) VALUES
(19, 5, 'What we did in 2018', '', '2018', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=19', 0, 0, '127.0.0.1', 1642145831, 1642145847, 0, '0.00', 0),
(17, 5, 'What we did in 2016', '', '2016', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=17', 0, 0, '127.0.0.1', 1642145795, 1642145816, 0, '0.00', 0),
(18, 5, 'What we did in 2017', '', '2017', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=18', 0, 0, '127.0.0.1', 1642145818, 1642145829, 0, '0.00', 0),
(16, 5, '      2018     2017     2016     2015  What we did in 2015', '', '2015', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=16', 0, 0, '127.0.0.1', 1642145775, 1642145793, 0, '0.00', 0),
(5, 2, 'PLANNING', '', '01.', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=5', 0, 0, '127.0.0.1', 1642065082, 1642065099, 0, '0.00', 0),
(6, 2, 'DESIGNING', '', '02.', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=6', 0, 0, '127.0.0.1', 1642065101, 1642065112, 0, '0.00', 0),
(7, 2, 'SHIPPING', '', '03.', 'We provide the best Quality of products to you.We are always here to help our lovely customers.We sh...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=7', 0, 0, '127.0.0.1', 1642065114, 1642065131, 0, '0.00', 0),
(8, 3, 'RUES JACK', '54', '', 'Founder', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=8', 0, 0, '127.0.0.1', 1642065145, 1642065189, 0, '0.00', 0),
(9, 3, 'STEVE BROAD', '55', '', 'Co-Founder', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=9', 0, 0, '127.0.0.1', 1642065191, 1642065204, 0, '0.00', 0),
(10, 3, 'OLIUS LISA', '56', '', 'Manager', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=10', 0, 0, '127.0.0.1', 1642065206, 1642065222, 0, '0.00', 0),
(11, 3, 'SAMUEL BURN', '57', '', 'Employee', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=11', 0, 0, '127.0.0.1', 1642065224, 1642065237, 0, '0.00', 0),
(12, 4, 'SMIKER WILL', '58', '', '“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=12', 0, 0, '127.0.0.1', 1642065248, 1642065334, 0, '0.00', 0),
(13, 4, 'KATRIN RUOS', '59', '', '“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=13', 0, 0, '127.0.0.1', 1642065336, 1642065359, 0, '0.00', 0),
(14, 4, 'DWAYNE JOHNSON', '60', '', '“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=14', 0, 0, '127.0.0.1', 1642065362, 1642065448, 0, '0.00', 0),
(15, 4, 'FUMIZ ROEY', '61', '', '“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedica...', 0, 1, 'admin', 9, '/index.php?s=guanyu&c=show&id=15', 0, 0, '127.0.0.1', 1642065451, 1642065466, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_category`
--

CREATE TABLE `mys_1_guanyu_category` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

--
-- 转存表中的数据 `mys_1_guanyu_category`
--

INSERT INTO `mys_1_guanyu_category` (`id`, `pid`, `pids`, `name`, `dirname`, `pdirname`, `child`, `childids`, `thumb`, `show`, `setting`, `displayorder`) VALUES
(5, 0, '0', 'TIMES', 'times', '', 0, '5', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(2, 0, '0', 'WORK', 'work', '', 0, '2', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(3, 0, '0', 'TEAM', 'team', '', 0, '3', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(4, 0, '0', 'CUSTOMERS', 'customers', '', 0, '4', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_category_data`
--

CREATE TABLE `mys_1_guanyu_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` int(3) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_category_data_0`
--

CREATE TABLE `mys_1_guanyu_category_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表的附表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_comment`
--

CREATE TABLE `mys_1_guanyu_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '关联id',
  `cuid` int(10) UNSIGNED NOT NULL COMMENT '关联uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `orderid` bigint(18) UNSIGNED NOT NULL COMMENT '订单id',
  `uid` mediumint(8) UNSIGNED DEFAULT '0' COMMENT '评论者ID',
  `author` varchar(250) DEFAULT NULL COMMENT '评论者账号',
  `content` text COMMENT '评论内容',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort2` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort3` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort4` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort5` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort6` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort7` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort8` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort9` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `reply` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '回复id',
  `in_reply` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否存在回复',
  `status` smallint(1) UNSIGNED DEFAULT '0' COMMENT '审核状态',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论内容表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_comment_index`
--

CREATE TABLE `mys_1_guanyu_comment_index` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort2` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort3` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort4` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort5` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort6` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort7` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort8` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort9` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `tableid` smallint(5) UNSIGNED DEFAULT '0' COMMENT '附表id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_data_0`
--

CREATE TABLE `mys_1_guanyu_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容附表';

--
-- 转存表中的数据 `mys_1_guanyu_data_0`
--

INSERT INTO `mys_1_guanyu_data_0` (`id`, `uid`, `catid`, `content`) VALUES
(19, 1, 5, '&lt;p&gt;We provide the best Quality of products to you.We are always here to \r\nhelp our lovely customers.We ship our products anywhere with more \r\nsecure.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(16, 1, 5, '&lt;p&gt;We provide the best Quality of products to you.We are always here to \r\nhelp our lovely customers.We ship our products anywhere with more \r\nsecure.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(17, 1, 5, '&lt;p&gt;We provide the best Quality of products to you.We are always here to \r\nhelp our lovely customers.We ship our products anywhere with more \r\nsecure.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(18, 1, 5, '&lt;p&gt;We provide the best Quality of products to you.We are always here to \r\nhelp our lovely customers.We ship our products anywhere with more \r\nsecure.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;We provide the best Quality of products to \r\nyou.We are always here to help our lovely customers.We ship our products\r\n anywhere with more secure.to help our lovely customers.&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(5, 1, 2, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.&lt;/span&gt;&lt;/p&gt;'),
(6, 1, 2, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.&lt;/span&gt;&lt;/p&gt;'),
(7, 1, 2, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;We provide the best Quality of products to you.We are always here to help our lovely customers.We ship our products anywhere with more secure.&lt;/span&gt;&lt;/p&gt;'),
(8, 1, 3, '&lt;h5 style=&quot;box-sizing: border-box; font-family: &amp;quot;PT Sans&amp;quot;, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(61, 61, 61); margin-top: 10px; margin-bottom: 10px; font-size: 14px; text-transform: capitalize; text-align: center; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Founder&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(9, 1, 3, '&lt;h5 style=&quot;box-sizing: border-box; font-family: &amp;quot;PT Sans&amp;quot;, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(61, 61, 61); margin-top: 10px; margin-bottom: 10px; font-size: 14px; text-transform: capitalize; text-align: center; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Co-Founder&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(10, 1, 3, '&lt;h5 style=&quot;box-sizing: border-box; font-family: &amp;quot;PT Sans&amp;quot;, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(61, 61, 61); margin-top: 10px; margin-bottom: 10px; font-size: 14px; text-transform: capitalize; text-align: center; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Manager&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(11, 1, 3, '&lt;h5 style=&quot;box-sizing: border-box; font-family: &amp;quot;PT Sans&amp;quot;, sans-serif; font-weight: 500; line-height: 1.1; color: rgb(61, 61, 61); margin-top: 10px; margin-bottom: 10px; font-size: 14px; text-transform: capitalize; text-align: center; white-space: normal; background-color: rgb(255, 255, 255);&quot;&gt;Employee&lt;/h5&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(12, 1, 4, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedicated services from them. Dshine is really excellent site for furnitures. ”&lt;/span&gt;&lt;/p&gt;'),
(13, 1, 4, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedicated services from them. Dshine is really excellent site for furnitures. ”&lt;/span&gt;&lt;/p&gt;'),
(14, 1, 4, '&lt;p&gt;&lt;span style=&quot;color: rgb(253, 64, 94); font-family: Questrial, sans-serif; text-transform: uppercase; background-color: rgb(255, 255, 255);&quot;&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedicated services from them. Dshine is really excellent site for furnitures. ”&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;'),
(15, 1, 4, '&lt;p&gt;&lt;span style=&quot;color: rgb(119, 119, 119); font-family: Questrial, sans-serif; font-size: 15px; letter-spacing: 1px; background-color: rgb(255, 255, 255);&quot;&gt;“ Dshine is really excellent site for furnitures.I am very happy with the Dshine products and dedicated services from them. Dshine is really excellent site for furnitures. ”&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_draft`
--

CREATE TABLE `mys_1_guanyu_draft` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容草稿表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_flag`
--

CREATE TABLE `mys_1_guanyu_flag` (
  `flag` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文档标记id',
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标记表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_hits`
--

CREATE TABLE `mys_1_guanyu_hits` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `hits` int(10) UNSIGNED NOT NULL COMMENT '总点击数',
  `day_hits` int(10) UNSIGNED NOT NULL COMMENT '本日点击',
  `week_hits` int(10) UNSIGNED NOT NULL COMMENT '本周点击',
  `month_hits` int(10) UNSIGNED NOT NULL COMMENT '本月点击',
  `year_hits` int(10) UNSIGNED NOT NULL COMMENT '年点击量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='时段点击量统计';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_index`
--

CREATE TABLE `mys_1_guanyu_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容索引表';

--
-- 转存表中的数据 `mys_1_guanyu_index`
--

INSERT INTO `mys_1_guanyu_index` (`id`, `uid`, `catid`, `status`, `inputtime`) VALUES
(19, 1, 5, 9, 1642145831),
(18, 1, 5, 9, 1642145818),
(17, 1, 5, 9, 1642145795),
(16, 1, 5, 9, 1642145775),
(5, 1, 2, 9, 1642065082),
(6, 1, 2, 9, 1642065101),
(7, 1, 2, 9, 1642065114),
(8, 1, 3, 9, 1642065145),
(9, 1, 3, 9, 1642065191),
(10, 1, 3, 9, 1642065206),
(11, 1, 3, 9, 1642065224),
(12, 1, 4, 9, 1642065248),
(13, 1, 4, 9, 1642065336),
(14, 1, 4, 9, 1642065362),
(15, 1, 4, 9, 1642065451);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_recycle`
--

CREATE TABLE `mys_1_guanyu_recycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '删除理由',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容回收站表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_search`
--

CREATE TABLE `mys_1_guanyu_search` (
  `id` varchar(32) NOT NULL,
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `params` text NOT NULL COMMENT '参数数组',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `contentid` mediumtext NOT NULL COMMENT 'id集合',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '搜索时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

--
-- 转存表中的数据 `mys_1_guanyu_search`
--

INSERT INTO `mys_1_guanyu_search` (`id`, `catid`, `params`, `keyword`, `contentid`, `inputtime`) VALUES
('701de6d5d3025978706a43b69f380cd5', 0, '{\"param\":{\"keyword\":\"2018\"},\"sql\":\"SELECT `mys_1_guanyu`.`id` FROM `mys_1_guanyu` WHERE `mys_1_guanyu`.`status` = 9 AND (`mys_1_guanyu`.`title` LIKE \\\"%2018%\\\" OR `mys_1_guanyu`.`keywords` LIKE \\\"%2018%\\\") ORDER BY NULL LIMIT 500\"}', '2018', '19,16', 1642146269);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_time`
--

CREATE TABLE `mys_1_guanyu_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '处理结果',
  `posttime` int(10) UNSIGNED NOT NULL COMMENT '定时发布时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容定时发布表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_guanyu_verify`
--

CREATE TABLE `mys_1_guanyu_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '是否新增',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `backuid` mediumint(8) UNSIGNED NOT NULL COMMENT '操作人uid',
  `backinfo` text NOT NULL COMMENT '操作退回信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容审核表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi`
--

CREATE TABLE `mys_1_lianxi` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` int(10) UNSIGNED DEFAULT NULL COMMENT '浏览数',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '同步id',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数量',
  `avgsort` decimal(10,2) UNSIGNED DEFAULT '0.00' COMMENT '平均点评分数',
  `displayorder` int(10) DEFAULT '0' COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容主表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_category`
--

CREATE TABLE `mys_1_lianxi_category` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_category_data`
--

CREATE TABLE `mys_1_lianxi_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` int(3) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_category_data_0`
--

CREATE TABLE `mys_1_lianxi_category_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表的附表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_comment`
--

CREATE TABLE `mys_1_lianxi_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '关联id',
  `cuid` int(10) UNSIGNED NOT NULL COMMENT '关联uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `orderid` bigint(18) UNSIGNED NOT NULL COMMENT '订单id',
  `uid` mediumint(8) UNSIGNED DEFAULT '0' COMMENT '评论者ID',
  `author` varchar(250) DEFAULT NULL COMMENT '评论者账号',
  `content` text COMMENT '评论内容',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort2` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort3` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort4` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort5` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort6` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort7` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort8` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort9` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `reply` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '回复id',
  `in_reply` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否存在回复',
  `status` smallint(1) UNSIGNED DEFAULT '0' COMMENT '审核状态',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论内容表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_comment_index`
--

CREATE TABLE `mys_1_lianxi_comment_index` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort2` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort3` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort4` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort5` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort6` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort7` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort8` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort9` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `tableid` smallint(5) UNSIGNED DEFAULT '0' COMMENT '附表id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_data_0`
--

CREATE TABLE `mys_1_lianxi_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容附表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_draft`
--

CREATE TABLE `mys_1_lianxi_draft` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容草稿表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_flag`
--

CREATE TABLE `mys_1_lianxi_flag` (
  `flag` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文档标记id',
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标记表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_hits`
--

CREATE TABLE `mys_1_lianxi_hits` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `hits` int(10) UNSIGNED NOT NULL COMMENT '总点击数',
  `day_hits` int(10) UNSIGNED NOT NULL COMMENT '本日点击',
  `week_hits` int(10) UNSIGNED NOT NULL COMMENT '本周点击',
  `month_hits` int(10) UNSIGNED NOT NULL COMMENT '本月点击',
  `year_hits` int(10) UNSIGNED NOT NULL COMMENT '年点击量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='时段点击量统计';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_index`
--

CREATE TABLE `mys_1_lianxi_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_recycle`
--

CREATE TABLE `mys_1_lianxi_recycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '删除理由',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容回收站表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_search`
--

CREATE TABLE `mys_1_lianxi_search` (
  `id` varchar(32) NOT NULL,
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `params` text NOT NULL COMMENT '参数数组',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `contentid` mediumtext NOT NULL COMMENT 'id集合',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '搜索时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_time`
--

CREATE TABLE `mys_1_lianxi_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '处理结果',
  `posttime` int(10) UNSIGNED NOT NULL COMMENT '定时发布时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容定时发布表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lianxi_verify`
--

CREATE TABLE `mys_1_lianxi_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '是否新增',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `backuid` mediumint(8) UNSIGNED NOT NULL COMMENT '操作人uid',
  `backinfo` text NOT NULL COMMENT '操作退回信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容审核表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu`
--

CREATE TABLE `mys_1_lunbotu` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` int(10) UNSIGNED DEFAULT NULL COMMENT '浏览数',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '同步id',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数量',
  `avgsort` decimal(10,2) UNSIGNED DEFAULT '0.00' COMMENT '平均点评分数',
  `displayorder` int(10) DEFAULT '0' COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容主表';

--
-- 转存表中的数据 `mys_1_lunbotu`
--

INSERT INTO `mys_1_lunbotu` (`id`, `catid`, `title`, `thumb`, `keywords`, `description`, `hits`, `uid`, `author`, `status`, `url`, `link_id`, `tableid`, `inputip`, `inputtime`, `updatetime`, `comments`, `avgsort`, `displayorder`) VALUES
(1, 1, 'traditional costume jewellery', '2', 'Shop now', 'new collections', 0, 1, 'admin', 9, '/index.php?s=lunbotu&c=show&id=1', 0, 0, '127.0.0.1', 1642055347, 1642055402, 0, '0.00', 0),
(2, 1, 'exquisite Designer Rings', '3', 'Shop now', 'new collections', 0, 1, 'admin', 9, '/index.php?s=lunbotu&c=show&id=2', 0, 0, '127.0.0.1', 1642055404, 1642055420, 0, '0.00', 0),
(3, 1, 'traditional Designer Jwellery', '4', 'Shop now', 'new collections', 0, 1, 'admin', 9, '/index.php?s=lunbotu&c=show&id=3', 0, 0, '127.0.0.1', 1642055422, 1642055440, 0, '0.00', 0),
(4, 1, 'Find your perfect diamond', '5', 'Shop now', 'By D-Shine', 0, 1, 'admin', 9, '/index.php?s=lunbotu&c=show&id=4', 0, 0, '127.0.0.1', 1642055442, 1642055464, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_category`
--

CREATE TABLE `mys_1_lunbotu_category` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

--
-- 转存表中的数据 `mys_1_lunbotu_category`
--

INSERT INTO `mys_1_lunbotu_category` (`id`, `pid`, `pids`, `name`, `dirname`, `pdirname`, `child`, `childids`, `thumb`, `show`, `setting`, `displayorder`) VALUES
(1, 0, '0', '轮播图', 'lunbotu', '', 0, '1', '', 1, '{\"linkurl\":\"\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"list\":\"list.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_category_data`
--

CREATE TABLE `mys_1_lunbotu_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` int(3) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_category_data_0`
--

CREATE TABLE `mys_1_lunbotu_category_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表的附表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_comment`
--

CREATE TABLE `mys_1_lunbotu_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '关联id',
  `cuid` int(10) UNSIGNED NOT NULL COMMENT '关联uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `orderid` bigint(18) UNSIGNED NOT NULL COMMENT '订单id',
  `uid` mediumint(8) UNSIGNED DEFAULT '0' COMMENT '评论者ID',
  `author` varchar(250) DEFAULT NULL COMMENT '评论者账号',
  `content` text COMMENT '评论内容',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort2` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort3` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort4` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort5` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort6` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort7` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort8` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort9` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `reply` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '回复id',
  `in_reply` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否存在回复',
  `status` smallint(1) UNSIGNED DEFAULT '0' COMMENT '审核状态',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论内容表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_comment_index`
--

CREATE TABLE `mys_1_lunbotu_comment_index` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort2` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort3` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort4` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort5` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort6` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort7` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort8` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort9` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `tableid` smallint(5) UNSIGNED DEFAULT '0' COMMENT '附表id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_data_0`
--

CREATE TABLE `mys_1_lunbotu_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容附表';

--
-- 转存表中的数据 `mys_1_lunbotu_data_0`
--

INSERT INTO `mys_1_lunbotu_data_0` (`id`, `uid`, `catid`, `content`) VALUES
(1, 1, 1, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;new collections&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(2, 1, 1, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;new collections&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(3, 1, 1, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;new collections&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(4, 1, 1, '&lt;p&gt;&lt;span style=&quot;color: #d4d4d4;&quot;&gt;By D-Shine&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_draft`
--

CREATE TABLE `mys_1_lunbotu_draft` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容草稿表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_flag`
--

CREATE TABLE `mys_1_lunbotu_flag` (
  `flag` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文档标记id',
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标记表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_hits`
--

CREATE TABLE `mys_1_lunbotu_hits` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `hits` int(10) UNSIGNED NOT NULL COMMENT '总点击数',
  `day_hits` int(10) UNSIGNED NOT NULL COMMENT '本日点击',
  `week_hits` int(10) UNSIGNED NOT NULL COMMENT '本周点击',
  `month_hits` int(10) UNSIGNED NOT NULL COMMENT '本月点击',
  `year_hits` int(10) UNSIGNED NOT NULL COMMENT '年点击量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='时段点击量统计';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_index`
--

CREATE TABLE `mys_1_lunbotu_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容索引表';

--
-- 转存表中的数据 `mys_1_lunbotu_index`
--

INSERT INTO `mys_1_lunbotu_index` (`id`, `uid`, `catid`, `status`, `inputtime`) VALUES
(1, 1, 1, 9, 1642055347),
(2, 1, 1, 9, 1642055404),
(3, 1, 1, 9, 1642055422),
(4, 1, 1, 9, 1642055442);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_recycle`
--

CREATE TABLE `mys_1_lunbotu_recycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '删除理由',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容回收站表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_search`
--

CREATE TABLE `mys_1_lunbotu_search` (
  `id` varchar(32) NOT NULL,
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `params` text NOT NULL COMMENT '参数数组',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `contentid` mediumtext NOT NULL COMMENT 'id集合',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '搜索时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_time`
--

CREATE TABLE `mys_1_lunbotu_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '处理结果',
  `posttime` int(10) UNSIGNED NOT NULL COMMENT '定时发布时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容定时发布表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_lunbotu_verify`
--

CREATE TABLE `mys_1_lunbotu_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '是否新增',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `backuid` mediumint(8) UNSIGNED NOT NULL COMMENT '操作人uid',
  `backinfo` text NOT NULL COMMENT '操作退回信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容审核表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news`
--

CREATE TABLE `mys_1_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `hits` int(10) UNSIGNED DEFAULT NULL COMMENT '浏览数',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '作者id',
  `author` varchar(50) NOT NULL COMMENT '作者名称',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `url` varchar(255) DEFAULT NULL COMMENT '地址',
  `link_id` int(10) NOT NULL DEFAULT '0' COMMENT '同步id',
  `tableid` smallint(5) UNSIGNED NOT NULL COMMENT '附表id',
  `inputip` varchar(15) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数量',
  `avgsort` decimal(10,2) UNSIGNED DEFAULT '0.00' COMMENT '平均点评分数',
  `displayorder` int(10) DEFAULT '0' COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容主表';

--
-- 转存表中的数据 `mys_1_news`
--

INSERT INTO `mys_1_news` (`id`, `catid`, `title`, `thumb`, `keywords`, `description`, `hits`, `uid`, `author`, `status`, `url`, `link_id`, `tableid`, `inputip`, `inputtime`, `updatetime`, `comments`, `avgsort`, `displayorder`) VALUES
(1, 4, 'The place where we are happy', '45', 'Dec', 'Sunny Days sweepin\' the clouds away. On my way to where the air is sweet. Can you tell me how to get how to get to Sesame Street. And when the odds are against him and their dangers work to do. You bet your life Speed Racer he will see it through. Till the one day when the lady met this fellow.', 1, 1, 'admin', 9, '/index.php?c=show&id=1', 0, 0, '127.0.0.1', 1642059208, 1642219665, 0, '0.00', 0),
(2, 4, 'New products of the week standard post', '46', 'Dec', 'It\'s time to light the lights. It\'s time to meet the Muppets on the Muppet Show tonight. Knight Rider: A shadowy flight into the dangerous world of a man  It\'s time to light the lights. It\'s time to meet the Muppets on the Muppet Show tonight. Knight Rider: A shadowy flight into the dangerous world of a man', 1, 1, 'admin', 9, '/index.php?c=show&id=2', 0, 0, '127.0.0.1', 1642059303, 1642219674, 0, '0.00', 0),
(3, 4, 'people know the beauty of nature', '47', 'Dec', 'I never thought I could feel so free! The movie star the professor and Mary Ann here on Gilligans Isle. Michael Knight a young loner on a crusade to champion never thought I could feel so free! The movie star the professor and Mary Ann here on Gilligans Isle. Michael Knight a young loner on a crusade to champion.', 1, 1, 'admin', 9, '/index.php?c=show&id=3', 0, 0, '127.0.0.1', 1642059324, 1642219655, 0, '0.00', 0),
(4, 4, 'i can enjoy the mega beats of city street', '63', 'Dec', 'I never thought I could feel so free. It\'s time to put on makeup. It\'s time to dress up right. It\'s time to raise the curtain on the Muppet Show tonight. I never thought I could feel so free. It\'s time to put on makeup. It\'s time to dress up right. It\'s time to raise the curtain on the Muppet Show tonight.', 15, 1, 'admin', 9, '/index.php?c=show&id=4', 0, 0, '127.0.0.1', 1642059363, 1642219683, 0, '0.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_category`
--

CREATE TABLE `mys_1_news_category` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_category_data`
--

CREATE TABLE `mys_1_news_category_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` int(3) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_category_data_0`
--

CREATE TABLE `mys_1_news_category_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目模型表的附表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_comment`
--

CREATE TABLE `mys_1_news_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论ID',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '关联id',
  `cuid` int(10) UNSIGNED NOT NULL COMMENT '关联uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `orderid` bigint(18) UNSIGNED NOT NULL COMMENT '订单id',
  `uid` mediumint(8) UNSIGNED DEFAULT '0' COMMENT '评论者ID',
  `author` varchar(250) DEFAULT NULL COMMENT '评论者账号',
  `content` text COMMENT '评论内容',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort2` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort3` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort4` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort5` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort6` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort7` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort8` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `sort9` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '评分值',
  `reply` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '回复id',
  `in_reply` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否存在回复',
  `status` smallint(1) UNSIGNED DEFAULT '0' COMMENT '审核状态',
  `inputip` varchar(50) DEFAULT NULL COMMENT '录入者ip',
  `inputtime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论内容表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_comment_index`
--

CREATE TABLE `mys_1_news_comment_index` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `support` int(10) UNSIGNED DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) UNSIGNED DEFAULT '0' COMMENT '反对数',
  `comments` int(10) UNSIGNED DEFAULT '0' COMMENT '评论数',
  `avgsort` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '平均分',
  `sort1` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort2` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort3` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort4` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort5` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort6` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort7` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort8` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `sort9` decimal(4,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '选项分数',
  `tableid` smallint(5) UNSIGNED DEFAULT '0' COMMENT '附表id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论索引表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_data_0`
--

CREATE TABLE `mys_1_news_data_0` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` smallint(5) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext COMMENT '内容'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容附表';

--
-- 转存表中的数据 `mys_1_news_data_0`
--

INSERT INTO `mys_1_news_data_0` (`id`, `uid`, `catid`, `content`) VALUES
(1, 1, 4, '&lt;p&gt;Sunny Days sweepin&amp;#39; the clouds away. On my way to where the air is \r\nsweet. Can you tell me how to get how to get to Sesame Street. And when \r\nthe odds are against him and their dangers work to do. You bet your life\r\n Speed Racer he will see it through. Till the one day when the lady met \r\nthis fellow.\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;'),
(2, 1, 4, '&lt;p&gt;It&amp;#39;s time to light the lights. It&amp;#39;s time to meet the Muppets on the \r\nMuppet Show tonight. Knight Rider: A shadowy flight into the dangerous \r\nworld of a man &amp;nbsp;It&amp;#39;s time to light the lights. It&amp;#39;s time to meet the \r\nMuppets on the Muppet Show tonight. Knight Rider: A shadowy flight into \r\nthe dangerous world of a man\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;'),
(3, 1, 4, '&lt;p&gt;I never thought I could feel so free! The movie star the professor and \r\nMary Ann here on Gilligans Isle. Michael Knight a young loner on a \r\ncrusade to champion never thought I could feel so free! The movie star \r\nthe professor and Mary Ann here on Gilligans Isle. Michael Knight a \r\nyoung loner on a crusade to champion.\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;'),
(4, 1, 4, '&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;I never thought I could feel so free. It&amp;#39;s time \r\nto put on makeup. It&amp;#39;s time to dress up right. It&amp;#39;s time to raise the \r\ncurtain on the Muppet Show tonight. I never thought I could feel so \r\nfree. It&amp;#39;s time to put on makeup. It&amp;#39;s time to dress up right. It&amp;#39;s time\r\n to raise the curtain on the Muppet Show tonight.\r\n &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_draft`
--

CREATE TABLE `mys_1_news_draft` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容草稿表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_flag`
--

CREATE TABLE `mys_1_news_flag` (
  `flag` tinyint(2) UNSIGNED NOT NULL DEFAULT '1' COMMENT '文档标记id',
  `id` int(10) UNSIGNED NOT NULL COMMENT '文档内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标记表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_hits`
--

CREATE TABLE `mys_1_news_hits` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `hits` int(10) UNSIGNED NOT NULL COMMENT '总点击数',
  `day_hits` int(10) UNSIGNED NOT NULL COMMENT '本日点击',
  `week_hits` int(10) UNSIGNED NOT NULL COMMENT '本周点击',
  `month_hits` int(10) UNSIGNED NOT NULL COMMENT '本月点击',
  `year_hits` int(10) UNSIGNED NOT NULL COMMENT '年点击量'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='时段点击量统计';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_index`
--

CREATE TABLE `mys_1_news_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容索引表';

--
-- 转存表中的数据 `mys_1_news_index`
--

INSERT INTO `mys_1_news_index` (`id`, `uid`, `catid`, `status`, `inputtime`) VALUES
(1, 1, 4, 9, 1642059208),
(2, 1, 4, 9, 1642059303),
(3, 1, 4, 9, 1642059324),
(4, 1, 4, 9, 1642059363);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_recycle`
--

CREATE TABLE `mys_1_news_recycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) UNSIGNED NOT NULL COMMENT '内容id',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` tinyint(3) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '删除理由',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容回收站表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_search`
--

CREATE TABLE `mys_1_news_search` (
  `id` varchar(32) NOT NULL,
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `params` text NOT NULL COMMENT '参数数组',
  `keyword` varchar(255) NOT NULL COMMENT '关键字',
  `contentid` mediumtext NOT NULL COMMENT 'id集合',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '搜索时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='搜索表';

--
-- 转存表中的数据 `mys_1_news_search`
--

INSERT INTO `mys_1_news_search` (`id`, `catid`, `params`, `keyword`, `contentid`, `inputtime`) VALUES
('0f7f3a1b3d29799b86686eb03c09246a', 0, '{\"param\":{\"keyword\":\"\"},\"sql\":\"SELECT `mys_1_news`.`id` FROM `mys_1_news` WHERE `mys_1_news`.`status` = 9 ORDER BY NULL LIMIT 500\"}', '', '1,2,3,4', 1642217071),
('5bd174858e21e9afabdccbc8b7cb98ed', 0, '{\"param\":{\"keyword\":\"POST\"},\"sql\":\"SELECT `mys_1_news`.`id` FROM `mys_1_news` WHERE `mys_1_news`.`status` = 9 AND (`mys_1_news`.`title` LIKE \\\"%POST%\\\" OR `mys_1_news`.`keywords` LIKE \\\"%POST%\\\") ORDER BY NULL LIMIT 500\"}', 'POST', '2', 1642220018);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_time`
--

CREATE TABLE `mys_1_news_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `result` text NOT NULL COMMENT '处理结果',
  `posttime` int(10) UNSIGNED NOT NULL COMMENT '定时发布时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容定时发布表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_news_verify`
--

CREATE TABLE `mys_1_news_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '作者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '是否新增',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `catid` mediumint(8) UNSIGNED NOT NULL COMMENT '栏目id',
  `status` tinyint(2) NOT NULL COMMENT '审核状态',
  `content` mediumtext NOT NULL COMMENT '具体内容',
  `backuid` mediumint(8) UNSIGNED NOT NULL COMMENT '操作人uid',
  `backinfo` text NOT NULL COMMENT '操作退回信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '录入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容审核表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_share_category`
--

CREATE TABLE `mys_1_share_category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `tid` tinyint(1) NOT NULL COMMENT '栏目类型，0单页，1模块，2外链',
  `pid` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `mid` varchar(20) NOT NULL COMMENT '模块目录',
  `pids` varchar(255) NOT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `dirname` varchar(30) NOT NULL COMMENT '栏目目录',
  `pdirname` varchar(100) NOT NULL COMMENT '上级目录',
  `child` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否有下级',
  `childids` text NOT NULL COMMENT '下级所有id',
  `domain` varchar(50) DEFAULT NULL COMMENT '绑定电脑域名',
  `mobile_domain` varchar(50) DEFAULT NULL COMMENT '绑定手机域名',
  `thumb` varchar(255) NOT NULL COMMENT '栏目图片',
  `show` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否显示',
  `content` mediumtext NOT NULL COMMENT '单页内容',
  `setting` text NOT NULL COMMENT '属性配置',
  `displayorder` smallint(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='共享模块栏目表';

--
-- 转存表中的数据 `mys_1_share_category`
--

INSERT INTO `mys_1_share_category` (`id`, `tid`, `pid`, `mid`, `pids`, `name`, `dirname`, `pdirname`, `child`, `childids`, `domain`, `mobile_domain`, `thumb`, `show`, `content`, `setting`, `displayorder`) VALUES
(1, 0, 0, '', '0', 'HOME', 'home', '', 0, '1', '', '', '', 1, '', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"index.html\",\"list\":\"page.html\",\"category\":\"category.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(2, 0, 0, 'licheng', '0', 'ABOUT', 'about', '', 0, '2', '', '', '', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In \r\npellentesque, diam viverra lacinia sodales, elit turpis consequat \r\nsapien, nec feugiat ex urna quis libero. Sed vel purus iaculis, lobortis\r\n neque vel, commodo enim. Quisque sollicitudin arcu ullamcorper libero \r\nconsectetur commodo.</p><p>lobortis neque vel, commodo enim!</p>', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"about.html\",\"list\":\"about.html\",\"category\":\"about.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0),
(3, 0, 0, '', '0', 'Product Category', 'product', '', 1, '3,5', '', '', '', 1, '', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"products.html\",\"list\":\"products.html\",\"category\":\"products.html\",\"search\":\"search.html\",\"show\":\"show_pros.html\"}}', 0),
(4, 1, 0, 'news', '0', 'BLOG', 'blog', '', 0, '4', '', '', '', 1, '', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"page.html\",\"list\":\"news.html\",\"category\":\"news.html\",\"search\":\"search.html\",\"show\":\"show_news.html\"}}', 0),
(5, 0, 3, '', '0,3', 'PRODUCTS', 'products', 'product/', 0, '5', '', '', '', 1, '', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"products.html\",\"list\":\"products.html\",\"category\":\"products.html\",\"search\":\"search.html\",\"show\":\"show_pros.html\"}}', 0),
(6, 1, 0, 'lianxi', '0', 'CONTACT US', 'contact', '', 0, '6', '', '', '', 1, '', '{\"linkurl\":\"\",\"urlrule\":\"0\",\"seo\":{\"list_title\":\"[第{page}页{join}]{catpname}{join}{modname}{join}{SITE_NAME}\",\"list_keywords\":\"\",\"list_description\":\"\"},\"template\":{\"pagesize\":\"10\",\"mpagesize\":\"10\",\"page\":\"contact.html\",\"list\":\"contact.html\",\"category\":\"contact.html\",\"search\":\"search.html\",\"show\":\"show.html\"}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_1_share_index`
--

CREATE TABLE `mys_1_share_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `mid` varchar(20) NOT NULL COMMENT '模块目录'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='共享模块内容索引表';

--
-- 转存表中的数据 `mys_1_share_index`
--

INSERT INTO `mys_1_share_index` (`id`, `mid`) VALUES
(1, 'news'),
(2, 'news'),
(3, 'news'),
(4, 'news'),
(5, 'licheng'),
(6, 'licheng'),
(7, 'licheng'),
(8, 'licheng');

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin`
--

CREATE TABLE `mys_admin` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '管理员uid',
  `setting` text COMMENT '相关配置',
  `usermenu` text COMMENT '自定义面板菜单，序列化数组格式'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

--
-- 转存表中的数据 `mys_admin`
--

INSERT INTO `mys_admin` (`id`, `uid`, `setting`, `usermenu`) VALUES
(1, 1, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_login`
--

CREATE TABLE `mys_admin_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED DEFAULT NULL COMMENT '会员uid',
  `loginip` varchar(50) NOT NULL COMMENT '登录Ip',
  `logintime` int(10) UNSIGNED NOT NULL COMMENT '登录时间',
  `useragent` varchar(255) NOT NULL COMMENT '客户端信息'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登录日志记录';

--
-- 转存表中的数据 `mys_admin_login`
--

INSERT INTO `mys_admin_login` (`id`, `uid`, `loginip`, `logintime`, `useragent`) VALUES
(1, 1, '127.0.0.1', 1642060496, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36'),
(2, 1, '127.0.0.1', 1642122898, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:95.0) Gecko/20100101 Firefox/95.0'),
(3, 1, '127.0.0.1', 1642232388, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36');

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_menu`
--

CREATE TABLE `mys_admin_menu` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `pid` smallint(5) UNSIGNED NOT NULL COMMENT '上级菜单id',
  `name` text NOT NULL COMMENT '菜单语言名称',
  `uri` varchar(255) DEFAULT NULL COMMENT 'uri字符串',
  `url` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `mark` varchar(255) DEFAULT NULL COMMENT '菜单标识',
  `hidden` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '是否隐藏',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标标示',
  `displayorder` int(5) DEFAULT NULL COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

--
-- 转存表中的数据 `mys_admin_menu`
--

INSERT INTO `mys_admin_menu` (`id`, `pid`, `name`, `uri`, `url`, `mark`, `hidden`, `icon`, `displayorder`) VALUES
(1, 0, '首页', '', '', 'home', 0, 'fa fa-home', 0),
(2, 1, '我的面板', '', '', 'home-my', 0, 'fa fa-home', 0),
(3, 2, '后台首页', 'home/main', '', '', 0, 'fa fa-home', 0),
(4, 2, '资料修改', 'api/my', '', '', 1, 'fa fa-user', 0),
(5, 2, '系统更新', 'cache/index', '', '', 1, 'fa fa-refresh', 0),
(6, 2, '文件更新', 'cloud/bf', '', '', 1, 'fa fa-code', 0),
(7, 0, '系统', '', '', 'system', 0, 'fa fa-globe', 5),
(8, 7, '系统维护', '', '', 'system-wh', 0, 'fa fa-cog', 0),
(9, 8, '系统环境', 'system/index', '', '', 0, 'fa fa-cog', 0),
(10, 8, '系统缓存', 'system_cache/index', '', '', 0, 'fa fa-clock-o', 0),
(11, 8, '附件设置', 'attachment/index', '', '', 0, 'fa fa-folder', 0),
(12, 8, '短信设置', 'sms/index', '', '', 1, 'fa fa-envelope', 0),
(13, 8, '邮件设置', 'email/index', '', '', 0, 'fa fa-envelope-open', 0),
(14, 8, '系统提醒', 'notice/index', '', '', 0, 'fa fa-bell', 0),
(15, 8, '数据字典', 'db/index', '', '', 1, 'fa fa-database', 0),
(16, 8, 'Bom检测', 'check_bom/index', '', '', 1, 'fa fa-code', 0),
(17, 8, '系统体检', 'check/index', '', '', 0, 'fa fa-wrench', 0),
(18, 7, '日志管理', '', '', 'system-log', 1, 'fa fa-calendar', 0),
(19, 18, 'PHP错误', 'error_php/index', '', '', 0, 'fa fa-bug', 0),
(20, 18, '系统错误', 'error/index', '', '', 0, 'fa fa-shield', 0),
(21, 18, '操作日志', 'system_log/index', '', '', 0, 'fa fa-calendar', 0),
(22, 18, '短信日志', 'sms_log/index', '', '', 0, 'fa fa-envelope', 0),
(23, 18, '邮件日志', 'email_log/index', '', '', 0, 'fa fa-envelope-open', 0),
(24, 0, '设置', '', '', 'config', 0, 'fa fa-cogs', 2),
(25, 24, '网站设置', '', '', 'config-web', 0, 'fa fa-cog', 0),
(26, 25, '网站设置', 'site_config/index', '', '', 0, 'fa fa-cog', 0),
(27, 25, '终端设置', 'site_client/index', '', '', 0, 'fa fa-cogs', 0),
(28, 25, '手机设置', 'site_mobile/index', '', '', 0, 'fa fa-mobile', 0),
(29, 25, '域名绑定', 'site_domain/index', '', '', 0, 'fa fa-globe', 0),
(30, 25, '水印设置', 'site_watermark/index', '', '', 0, 'fa fa-photo', 0),
(31, 24, '内容设置', '', '', 'config-content', 0, 'fa fa-navicon', 0),
(32, 31, '创建模块', 'module_create/index', '', '', 0, 'fa fa-plus', 0),
(33, 31, '模块管理', 'module/index', '', '', 0, 'fa fa-gears', 0),
(34, 31, '模块搜索', 'module_search/index', '', '', 0, 'fa fa-search', 0),
(35, 31, '模块评论', 'module_comment/index', '', '', 0, 'fa fa-comments', 0),
(36, 31, '网站表单', 'form/index', '', '', 0, 'fa fa-table', 0),
(37, 24, 'SEO设置', '', '', 'config-seo', 0, 'fa fa-internet-explorer', 0),
(38, 37, '站点SEO', 'seo_site/index', '', '', 0, 'fa fa-cog', 0),
(39, 37, '模块SEO', 'seo_module/index', '', '', 0, 'fa fa-gears', 0),
(40, 37, '内容SEO', 'seo_content/index', '', '', 0, 'fa fa-th-large', 0),
(41, 37, '栏目SEO', 'seo_category/index', '', '', 0, 'fa fa-reorder', 0),
(42, 37, '搜索SEO', 'seo_search/index', '', '', 0, 'fa fa-search', 0),
(43, 37, 'URL规则', 'urlrule/index', '', '', 0, 'fa fa-link', 0),
(44, 24, '用户设置', '', '', 'config-member', 0, 'fa fa-user', 0),
(45, 44, '用户设置', 'member_setting/index', '', '', 0, 'fa fa-cog', 0),
(46, 44, '字段划分', 'member_field/index', '', '', 0, 'fa fa-code', 0),
(47, 44, '通知设置', 'member_setting_notice/index', '', '', 0, 'fa fa-volume-up', 0),
(48, 24, '支付设置', '', '', 'config-pay', 0, 'fa fa-rmb', 0),
(49, 48, '支付设置', 'member_payconfig/index', '', '', 1, 'fa fa-cog', 0),
(50, 48, '支付接口', 'member_payapi/index', '', '', 1, 'fa fa-code', 0),
(51, 0, '权限', '', '', 'auth', 0, 'fa fa-user-circle', 4),
(52, 51, '后台权限', '', '', 'auth-admin', 0, 'fa fa-cog', 0),
(53, 52, '后台菜单', 'menu/index', '', '', 0, 'fa fa-list-alt', 0),
(54, 52, '角色权限', 'role/index', '', '', 0, 'fa fa-users', 0),
(55, 52, '角色账号', 'root/index', '', '', 0, 'fa fa-user', 0),
(56, 52, '审核流程', 'verify/index', '', '', 0, 'fa fa-sort-numeric-asc', 0),
(57, 51, '用户权限', '', '', 'auth-member', 0, 'fa fa-user', 0),
(58, 57, '用户菜单', 'member_menu/index', '', '', 0, 'fa fa-list-alt', 0),
(59, 57, '内容权限', 'module_member/index', '', '', 0, 'fa fa-th-large', 0),
(60, 57, '用户组权限', 'member_setting_group/index', '', '', 0, 'fa fa-group', 0),
(61, 0, '内容', '', '', 'content', 0, 'fa fa-th-large', 1),
(62, 61, '内容管理', '', '', 'content-module', 0, 'fa fa-th-large', 0),
(63, 62, '栏目管理', 'module_category/index', '', '', 0, 'fa fa-reorder', 0),
(64, 62, '静态生成', 'html/index', '', '', 0, 'fa fa-file-code-o', 0),
(65, 62, '内容维护', 'module_content/index', '', '', 0, 'fa fa-wrench', 0),
(66, 61, '网站表单', '', '', 'content-form', 0, 'fa fa-table', 0),
(67, 61, '内容审核', '', '', 'content-verify', 0, 'fa fa-edit', 0),
(68, 0, '界面', '', '', 'code', 1, 'fa fa-html5', 7),
(69, 68, '模板管理', '', '', 'code-html', 0, 'fa fa-home', 0),
(70, 69, '电脑模板', 'tpl_pc/index', '', '', 0, 'fa fa-desktop', 0),
(71, 69, '手机模板', 'tpl_mobile/index', '', '', 0, 'fa fa-mobile', 0),
(72, 69, '终端模板', 'tpl_client/index', '', '', 0, 'fa fa-cogs', 0),
(73, 68, '风格管理', '', '', 'code-css', 0, 'fa fa-css3', 99),
(74, 73, '系统文件', 'system_theme/index', '', '', 0, 'fa fa-chrome', 0),
(75, 73, '网站风格', 'theme/index', '', '', 0, 'fa fa-photo', 0),
(76, 0, '用户', '', '', 'member', 0, 'fa fa-user', 3),
(77, 76, '用户管理', '', '', 'member-list', 0, 'fa fa-user', 0),
(78, 77, '用户管理', 'member/index', '', '', 0, 'fa fa-user', 0),
(79, 77, '用户组管理', 'member_group/index', '', '', 0, 'fa fa-users', 0),
(80, 77, '提醒消息', 'member_notice/index', '', '', 0, 'fa fa-bell', 0),
(81, 77, '授权账号管理', 'member_oauth/index', '', '', 0, 'fa fa-qq', 0),
(82, 76, '审核管理', '', '', 'member-verify', 0, 'fa fa-edit', 0),
(83, 82, '注册审核', 'member_verify/index', '', '', 0, 'fa fa-edit', 0),
(84, 82, '申请审核', 'member_apply/index', '', '', 0, 'fa fa-users', 0),
(85, 0, '财务', '', '', 'pay', 1, 'fa fa-rmb', 8),
(86, 85, '财务管理', '', '', 'pay-list', 0, 'fa fa-rmb', 0),
(87, 86, '已付流水', 'member_paylog/index', '', '', 0, 'fa fa-calendar-check-o', 0),
(88, 86, '未付流水', 'member_paylog/not_index', '', '', 0, 'fa fa-calendar-times-o', 0),
(89, 86, '转账汇款', 'member_payremit/index', '', '', 0, 'fa fa-credit-card', 0),
(90, 86, '上门收款', 'member_paymeet/index', '', '', 0, 'fa fa-user', 0),
(91, 86, '虚拟金币', 'member_scorelog/index', '', '', 0, 'fa fa-diamond', 0),
(92, 86, '用户充值', 'member_pay/index', '', '', 0, 'fa fa-plus', 0),
(93, 0, '应用', '', '', 'app', 0, 'fa fa-puzzle-piece', 6),
(94, 93, '应用插件', '', '', 'app-plugin', 0, 'fa fa-puzzle-piece', 0),
(95, 94, '应用管理', 'cloud/local', '', '', 0, 'fa fa-folder', 0),
(96, 94, '联动菜单', 'linkage/index', '', '', 1, 'fa fa-columns', 0),
(97, 94, '任务队列', 'cron/index', '', '', 1, 'fa fa-indent', 0),
(98, 94, '附件管理', 'attachments/index', '', '', 0, 'fa fa-folder', 0),
(99, 0, '服务', '', '', 'cloud', 1, 'fa fa-cloud', 99),
(100, 99, '网站管理', '', '', 'cloud-dayrui', 0, 'fa fa-cloud', 0),
(101, 100, '我的网站', 'cloud/index', '', '', 0, 'fa fa-cog', 0),
(102, 100, '服务工单', 'cloud/service', '', '', 0, 'fa fa-user-md', 0),
(103, 100, '应用商城', 'cloud/app', '', '', 0, 'fa fa-puzzle-piece', 0),
(104, 100, '组件商城', 'cloud/func', '', '', 0, 'fa fa-plug', 0),
(105, 100, '模板商城', 'cloud/template', '', '', 0, 'fa fa-html5', 0),
(106, 100, '版本升级', 'cloud/update', '', '', 0, 'fa fa-refresh', 0),
(107, 100, '文件对比', 'cloud/bf', '', '', 0, 'fa fa-code', 0),
(108, 62, '文章管理', 'news/home/index', '', 'module-news', 0, 'fa fa-sticky-note', -1),
(109, 67, '文章审核', 'news/verify/index', '', 'verify-module-news', 0, 'fa fa-sticky-note', -1),
(110, 67, '文章评论', 'news/comment_verify/index', '', 'verify-comment-news', 0, 'fa fa-comments', -1),
(118, 62, '产品管理', 'chanpin/home/index', '', 'module-chanpin', 0, 'fa fa-gg-circle', -1),
(112, 67, '产品审核', 'chanpin/verify/index', '', 'verify-module-chanpin', 0, 'fa fa-gg-circle', -1),
(113, 67, '产品评论', 'chanpin/comment_verify/index', '', 'verify-comment-chanpin', 0, 'fa fa-comments', -1),
(114, 62, '轮播图管理', 'lunbotu/home/index', '', 'module-lunbotu', 0, 'fa fa-cc-jcb', -1),
(115, 67, '轮播图审核', 'lunbotu/verify/index', '', 'verify-module-lunbotu', 0, 'fa fa-cc-jcb', -1),
(116, 67, '轮播图评论', 'lunbotu/comment_verify/index', '', 'verify-comment-lunbotu', 0, 'fa fa-comments', -1),
(117, 94, '自定义资料', 'block/home/index', '', '', 0, 'fa fa-th-large', 0),
(119, 62, '关于管理', 'guanyu/home/index', '', 'module-guanyu', 0, 'fa fa-beer', -1),
(120, 67, '关于审核', 'guanyu/verify/index', '', 'verify-module-guanyu', 0, 'fa fa-beer', -1),
(121, 67, '关于评论', 'guanyu/comment_verify/index', '', 'verify-comment-guanyu', 0, 'fa fa-comments', -1),
(122, 66, '联系管理', 'form/lianxi/index', '', 'form-lianxi', 0, '', 0),
(123, 67, '联系审核', 'form/lianxi_verify/index', '', 'verify-form-lianxi', 0, NULL, 0),
(124, 62, '联系管理', 'lianxi/home/index', '', 'module-lianxi', 0, 'fa fa-houzz', -1),
(125, 67, '联系审核', 'lianxi/verify/index', '', 'verify-module-lianxi', 0, 'fa fa-houzz', -1),
(126, 67, '联系评论', 'lianxi/comment_verify/index', '', 'verify-comment-lianxi', 0, 'fa fa-comments', -1),
(128, 67, '历程审核', 'licheng/verify/index', '', 'verify-module-licheng', 0, 'fa fa-firefox', -1),
(129, 67, '历程评论', 'licheng/comment_verify/index', '', 'verify-comment-licheng', 0, 'fa fa-comments', -1);

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_notice`
--

CREATE TABLE `mys_admin_notice` (
  `id` int(10) NOT NULL COMMENT 'id',
  `site` int(5) NOT NULL COMMENT '站点id',
  `type` varchar(20) NOT NULL COMMENT '提醒类型：系统、内容、会员、应用',
  `msg` text NOT NULL COMMENT '提醒内容说明',
  `uri` varchar(100) NOT NULL COMMENT '对应的URI',
  `to_rid` smallint(5) NOT NULL COMMENT '指定角色组',
  `to_uid` int(10) NOT NULL COMMENT '指定管理员',
  `status` tinyint(1) NOT NULL COMMENT '未处理0，1已查看，2处理中，3处理完成',
  `uid` int(10) NOT NULL COMMENT '申请人',
  `username` varchar(100) NOT NULL COMMENT '申请人',
  `op_uid` int(10) NOT NULL COMMENT '处理人',
  `op_username` varchar(100) NOT NULL COMMENT '处理人',
  `updatetime` int(10) NOT NULL COMMENT '处理时间',
  `inputtime` int(10) NOT NULL COMMENT '提醒时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台提醒表';

--
-- 转存表中的数据 `mys_admin_notice`
--

INSERT INTO `mys_admin_notice` (`id`, `site`, `type`, `msg`, `uri`, `to_rid`, `to_uid`, `status`, `uid`, `username`, `op_uid`, `op_username`, `updatetime`, `inputtime`) VALUES
(1, 1, 'content', '联系提交审核', 'form/lianxi_verify/edit:id/1', 0, 0, 0, 1, 'admin', 0, '', 0, 1642226781),
(2, 1, 'content', '联系提交审核', 'form/lianxi_verify/edit:id/2', 0, 0, 0, 1, 'admin', 0, '', 0, 1642227011),
(3, 1, 'content', '联系提交审核', 'form/lianxi_verify/edit:id/3', 0, 0, 0, 1, 'admin', 0, '', 0, 1642227022),
(4, 1, 'content', '联系提交审核', 'form/lianxi_verify/edit:id/4', 0, 0, 0, 1, 'admin', 0, '', 0, 1642227074),
(5, 1, 'content', '联系提交审核', 'form/lianxi_verify/edit:id/5', 0, 0, 0, 1, 'admin', 0, '', 0, 1642227157);

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_role`
--

CREATE TABLE `mys_admin_role` (
  `id` smallint(5) NOT NULL,
  `site` text NOT NULL COMMENT '允许管理的站点，序列化数组格式',
  `name` text NOT NULL COMMENT '角色组语言名称',
  `system` text NOT NULL COMMENT '系统权限',
  `module` text NOT NULL COMMENT '模块权限',
  `application` text NOT NULL COMMENT '应用权限'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台角色权限表';

--
-- 转存表中的数据 `mys_admin_role`
--

INSERT INTO `mys_admin_role` (`id`, `site`, `name`, `system`, `module`, `application`) VALUES
(1, '', '超级管理员', '', '', ''),
(2, '', '网站编辑员', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_role_index`
--

CREATE TABLE `mys_admin_role_index` (
  `id` smallint(5) NOT NULL,
  `uid` mediumint(8) UNSIGNED DEFAULT NULL COMMENT '会员uid',
  `roleid` mediumint(8) UNSIGNED DEFAULT NULL COMMENT '角色组id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台角色组分配表';

--
-- 转存表中的数据 `mys_admin_role_index`
--

INSERT INTO `mys_admin_role_index` (`id`, `uid`, `roleid`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `mys_admin_verify`
--

CREATE TABLE `mys_admin_verify` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` text NOT NULL COMMENT '名称',
  `verify` text NOT NULL COMMENT '审核部署'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='审核管理表';

--
-- 转存表中的数据 `mys_admin_verify`
--

INSERT INTO `mys_admin_verify` (`id`, `name`, `verify`) VALUES
(1, '默认审核', '{\"edit\":\"1\",\"role\":{\"1\":\"2\"}}');

-- --------------------------------------------------------

--
-- 表的结构 `mys_attachment`
--

CREATE TABLE `mys_attachment` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `siteid` mediumint(5) UNSIGNED NOT NULL COMMENT '站点id',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `tableid` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '附件副表id',
  `download` mediumint(8) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `filesize` int(10) UNSIGNED NOT NULL COMMENT '文件大小',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filemd5` varchar(50) NOT NULL COMMENT '文件md5值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

--
-- 转存表中的数据 `mys_attachment`
--

INSERT INTO `mys_attachment` (`id`, `uid`, `author`, `siteid`, `related`, `tableid`, `download`, `filesize`, `fileext`, `filemd5`) VALUES
(1, 1, 'admin', 1, 'rand', 1, 0, 27563, 'png', 'a894242fa4c0f323770862868daa8705'),
(2, 1, 'admin', 1, 'rand', 1, 0, 47426, 'jpg', 'db549426170712802a93db1e1db61d52'),
(3, 1, 'admin', 1, 'rand', 1, 0, 20299, 'jpg', 'f65d64d9d51dd16f131ee0eefde10537'),
(4, 1, 'admin', 1, 'rand', 1, 0, 50526, 'jpg', '172161bc433c326d3ee538715b96a063'),
(5, 1, 'admin', 1, 'rand', 1, 0, 36090, 'jpg', 'abaa70c63248a93a973e13517eccae27'),
(6, 1, 'admin', 1, 'rand', 1, 0, 396100, 'png', 'bd4ffaa7a5806dba476df0c0b6a4382f'),
(7, 1, 'admin', 1, 'rand', 1, 0, 657223, 'png', '90c630310cad5d837edf7efeae3a4604'),
(8, 1, 'admin', 1, 'rand', 1, 0, 243775, 'png', '7b1e52b0cb82b559d18948ad42c266b2'),
(9, 1, 'admin', 1, 'rand', 1, 0, 294202, 'png', '41d8a906792623fb2b676bfcb9d03af1'),
(10, 1, 'admin', 1, 'rand', 1, 0, 281045, 'png', '07322ea36bcd288995e5098dd01c63ba'),
(11, 1, 'admin', 1, 'rand', 1, 0, 97058, 'png', '8ad68b45dcacc38b85fa54909c2c71de'),
(12, 1, 'admin', 1, 'rand', 1, 0, 275652, 'png', '6ae4e0c22db1304fd557d0dc56956b4f'),
(13, 1, 'admin', 1, 'rand', 1, 0, 30709, 'png', '29913cc923d26885926f5864c90ac98d'),
(14, 1, 'admin', 1, 'rand', 1, 0, 80394, 'png', '953429cfe46f755768bfdda70d03a518'),
(15, 1, 'admin', 1, 'rand', 1, 0, 43275, 'png', '75046e03412c05bf893529218d9284f3'),
(16, 1, 'admin', 1, 'rand', 1, 0, 63292, 'png', '6386b2ee50613542f2df00181c50d6d0'),
(17, 1, 'admin', 1, 'rand', 1, 0, 43275, 'png', '75046e03412c05bf893529218d9284f3'),
(18, 1, 'admin', 1, 'rand', 1, 0, 15607, 'png', '5e9199847ce5dae30422148d7024cf9b'),
(19, 1, 'admin', 1, 'rand', 1, 0, 14062, 'png', '4f30be540f9993885056c7657d2ac355'),
(20, 1, 'admin', 1, 'rand', 1, 0, 45028, 'png', '522940ef04ea030ec3ca12c6f9739d36'),
(21, 1, 'admin', 1, 'rand', 1, 0, 78840, 'png', '24be00ec9e027f55aee56db6de951e02'),
(22, 1, 'admin', 1, 'rand', 1, 0, 83736, 'png', '375f25951b37c238a61e90cf991f68b4'),
(23, 1, 'admin', 1, 'rand', 1, 0, 47350, 'png', '456282124b77b4fec4606afd95f519ba'),
(24, 1, 'admin', 1, 'rand', 1, 0, 31608, 'png', 'a976b5d092109d7a07d81a36a23fc15c'),
(25, 1, 'admin', 1, 'rand', 1, 0, 58327, 'png', 'fdccf13f409b74a8655b0693fdce5827'),
(26, 1, 'admin', 1, 'rand', 1, 0, 73252, 'png', 'd04d4a011f1af075075e5c4d5c3af848'),
(27, 1, 'admin', 1, 'rand', 1, 0, 160468, 'png', '602f03cdbcf2c2a15ca9f46c501d507e'),
(28, 1, 'admin', 1, 'rand', 1, 0, 159415, 'png', 'cbf11c61d898dbec831d534877c9b050'),
(29, 1, 'admin', 1, 'rand', 1, 0, 167081, 'png', '2faffca304f2a6cf09f9f3713753f0f9'),
(30, 1, 'admin', 1, 'rand', 1, 0, 119567, 'png', '133f167fcfaedf418aa498d13ec418d7'),
(31, 1, 'admin', 1, 'rand', 1, 0, 139755, 'png', 'aab7bc2944fa9ab7bcc47a2ec82603a8'),
(32, 1, 'admin', 1, 'rand', 1, 0, 3891, 'png', '72e94fb19ec1aa8b72cd31e014af243e'),
(33, 1, 'admin', 1, 'rand', 1, 0, 4281, 'png', '8b3cd103e853615d390b63dee0d141f6'),
(34, 1, 'admin', 1, 'rand', 1, 0, 3881, 'png', 'b53fa02d4505615b523801c05b6ad368'),
(35, 1, 'admin', 1, 'rand', 1, 0, 4596, 'png', 'e4c5dd5f341a232b9b485be29e2ac9d6'),
(36, 1, 'admin', 1, 'rand', 1, 0, 3200, 'png', '0ba9d34ba21ff6bdbd8e30ed8b127281'),
(37, 1, 'admin', 1, 'rand', 1, 0, 191135, 'png', '22513cbdee89f2a0650d05a92e04d9ba'),
(38, 1, 'admin', 1, 'rand', 1, 0, 161634, 'png', '6a85dcfde33ea1c9b89cf56dc726780a'),
(39, 1, 'admin', 1, 'rand', 1, 0, 137879, 'png', 'b71a32fbc664ca39bbc044e1fbdb64c0'),
(40, 1, 'admin', 1, 'rand', 1, 0, 75249, 'png', '0c8954a17e4b54739f9f80c79c055ded'),
(41, 1, 'admin', 1, 'rand', 1, 0, 167631, 'png', '10dd5b90b6fdffbcd980fbc3dbd8bf09'),
(42, 1, 'admin', 1, 'rand', 1, 0, 137858, 'png', '8da26fd0a68a88ecc86988e5eb5bdf77'),
(43, 1, 'admin', 1, 'rand', 1, 0, 153107, 'png', '7514ad06046341f9dd41f344c8237b70'),
(44, 1, 'admin', 1, 'rand', 1, 0, 191135, 'png', '22513cbdee89f2a0650d05a92e04d9ba'),
(45, 1, 'admin', 1, 'rand', 1, 0, 161634, 'png', '6a85dcfde33ea1c9b89cf56dc726780a'),
(46, 1, 'admin', 1, 'rand', 1, 0, 191135, 'png', '22513cbdee89f2a0650d05a92e04d9ba'),
(47, 1, 'admin', 1, 'rand', 1, 0, 137879, 'png', 'b71a32fbc664ca39bbc044e1fbdb64c0'),
(48, 1, 'admin', 1, 'rand', 1, 0, 58943, 'png', '4452656881dce99db27b87f74ff3fa05'),
(49, 1, 'admin', 1, 'rand', 1, 0, 15607, 'png', '5e9199847ce5dae30422148d7024cf9b'),
(50, 1, 'admin', 1, 'rand', 1, 0, 1720, 'png', 'd901aeb55765a035eb40972a2ebbfd10'),
(51, 1, 'admin', 1, 'rand', 1, 0, 1750, 'png', 'caca51f409e074ef733a69c2e9b42e02'),
(52, 1, 'admin', 1, 'rand', 1, 0, 1632, 'png', '6d9f3e4a01c5bdfda3bd2af78f77fcef'),
(53, 1, 'admin', 1, 'rand', 1, 0, 1436, 'png', '29fbc5855fab29df4fdf89d69e1e19d3'),
(54, 1, 'admin', 1, 'rand', 1, 0, 36310, 'png', 'e7527b503a71fe1bbbd9552c4e3e3a24'),
(55, 1, 'admin', 1, 'rand', 1, 0, 153035, 'png', 'f34544cea4bc74497d9b91f310eecfcd'),
(56, 1, 'admin', 1, 'rand', 1, 0, 151425, 'png', '517695ece3e909f099ad19aa4f05b117'),
(57, 1, 'admin', 1, 'rand', 1, 0, 119387, 'png', '0d514cdeac0788e638788139e6ab7a2f'),
(58, 1, 'admin', 1, 'rand', 1, 0, 139755, 'png', 'aab7bc2944fa9ab7bcc47a2ec82603a8'),
(59, 1, 'admin', 1, 'rand', 1, 0, 160468, 'png', '602f03cdbcf2c2a15ca9f46c501d507e'),
(60, 1, 'admin', 1, 'rand', 1, 0, 159415, 'png', 'cbf11c61d898dbec831d534877c9b050'),
(61, 1, 'admin', 1, 'rand', 1, 0, 119567, 'png', '133f167fcfaedf418aa498d13ec418d7'),
(62, 1, 'admin', 1, 'rand', 1, 0, 4281, 'png', '8b3cd103e853615d390b63dee0d141f6'),
(63, 1, 'admin', 1, 'rand', 1, 0, 86587, 'png', '46982714b1ac7bc74170dbb427e5292b'),
(64, 1, 'admin', 1, 'rand', 1, 0, 138941, 'png', '3d76a233409c3ef2ce0094f49ff554ee'),
(65, 1, 'admin', 1, 'rand', 1, 0, 159635, 'png', '3e37c725c632ff257b629e4dd5d38e16'),
(66, 1, 'admin', 1, 'rand', 1, 0, 158776, 'png', '87c3f4000b72971246601fb80fefa956'),
(67, 1, 'admin', 1, 'rand', 1, 0, 166129, 'png', '591edc41146a9c58b1c78f1c876e9f90'),
(68, 1, 'admin', 1, 'rand', 1, 0, 118724, 'png', '7fd97a30788f37536b73f2abc5a330b2'),
(69, 1, 'admin', 1, 'rand', 1, 0, 19468, 'png', '40f372387aab27e992498aab69781e15'),
(70, 1, 'admin', 1, 'rand', 1, 0, 22595, 'png', '992a63da56822e97e988243df6ac1642'),
(71, 1, 'admin', 1, 'rand', 1, 0, 20596, 'png', '11d141e056fac81af76e552a1065c825'),
(72, 1, 'admin', 1, 'rand', 1, 0, 23401, 'png', 'a0c0403cd16f1a04267ec69c40ffcd80'),
(73, 1, 'admin', 1, 'rand', 1, 0, 19331, 'png', 'a80142c55a5abfe15741aa05bde900e7'),
(74, 1, 'admin', 1, 'rand', 1, 0, 22087, 'png', 'cd00a3f8cd9007b181a2d23ebfc65975'),
(75, 1, 'admin', 1, 'rand', 1, 0, 71975, 'png', '6a690373f9903a85e3ce9e51378f2385'),
(76, 1, 'admin', 1, 'rand', 1, 0, 55055, 'png', 'de26d02cb3791a0b305af083863ab37e'),
(77, 1, 'admin', 1, 'rand', 1, 0, 21077, 'png', 'f6a7f586f7a4f8195293ec8201f24121'),
(78, 1, 'admin', 1, 'rand', 1, 0, 85019, 'png', '5bd4b053cee5828cb5715ae85ecd3f70'),
(79, 1, 'admin', 1, 'rand', 1, 0, 58832, 'png', '8a08f921e6f32d82a391fde579b396bb'),
(80, 1, 'admin', 1, 'rand', 1, 0, 46890, 'png', '2c0d4726759b826f7c9f17560c3b637c'),
(81, 1, 'admin', 1, 'rand', 1, 0, 93905, 'jpg', '2cbbae876b5d5a34773b0eb1f3e4071e'),
(82, 1, 'admin', 1, 'rand', 1, 0, 104310, 'jpg', 'cdacd0ef5941c49393a1e9784e446224'),
(83, 1, 'admin', 1, 'rand', 1, 0, 103462, 'jpg', '7a5c9ec9fd685bfdb0be31b0647b5e90'),
(84, 1, 'admin', 1, 'rand', 1, 0, 104485, 'jpg', 'e48d5bdf80d6f2d9ba9c9f6d8a0279a9'),
(85, 1, 'admin', 1, 'rand', 1, 0, 73229, 'jpg', '3d19d68d288059f522a12ffe7bbe8ff2'),
(86, 1, 'admin', 1, 'rand', 1, 0, 99037, 'jpg', '46cca234492f7f7b0798fd1133a711e2'),
(87, 1, 'admin', 1, 'rand', 1, 0, 107832, 'jpg', '240178913fced91c0b9c649252fa09cd'),
(88, 1, 'admin', 1, 'rand', 1, 0, 104739, 'jpg', '0f7e67873591f478c9dcad3ee97640f8'),
(89, 1, 'admin', 1, 'rand', 1, 0, 6563, 'jpg', 'ecd795da4dd5b4409094517508d9d76b'),
(90, 1, 'admin', 1, 'rand', 1, 0, 7188, 'jpg', '3b1e784599edce181ae6e1b518ac30e8'),
(91, 1, 'admin', 1, 'rand', 1, 0, 7613, 'jpg', '39c1f1ef2552db11cd1621ed440f850e'),
(92, 1, 'admin', 1, 'rand', 1, 0, 7510, 'jpg', '092bd1f830d6ff3b0932d310b9eb422e'),
(93, 1, 'admin', 1, 'rand', 1, 0, 5791, 'jpg', '9ac749485d78d622f9a5d643889d3c32'),
(94, 1, 'admin', 1, 'rand', 1, 0, 7064, 'jpg', 'f05b4b11a0a0c16e3f9a26db401099bb'),
(95, 1, 'admin', 1, 'rand', 1, 0, 7648, 'jpg', 'df98e6f32febd0337d27c71d333eac01'),
(96, 1, 'admin', 1, 'rand', 1, 0, 7382, 'jpg', '75ba40853c574d630611f54f80124b99'),
(97, 1, 'admin', 1, 'rand', 1, 0, 73252, 'png', 'd04d4a011f1af075075e5c4d5c3af848'),
(98, 1, 'admin', 1, 'rand', 1, 0, 1161, 'png', 'b2fc424b5e3fde14eb8b9ec7c71af05f'),
(99, 1, 'admin', 1, 'rand', 1, 0, 5598, 'jpg', '210cd42cf076f81d1fbaa76b3107e286'),
(100, 1, 'admin', 1, 'rand', 1, 0, 15259, 'jpg', '421e98276d7347c6cc68fb194411439b'),
(101, 1, 'admin', 1, 'rand', 1, 0, 5095, 'jpg', 'a9c71f3e29a139e3caf4d7710fe19095'),
(102, 1, 'admin', 1, 'rand', 1, 0, 20692, 'jpg', '9d9dbf2ba4b40f253726ffc2d4b764d7');

-- --------------------------------------------------------

--
-- 表的结构 `mys_attachment_data`
--

CREATE TABLE `mys_attachment_data` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '附件id',
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '入库时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件已归档表';

--
-- 转存表中的数据 `mys_attachment_data`
--

INSERT INTO `mys_attachment_data` (`id`, `uid`, `author`, `related`, `filename`, `fileext`, `filesize`, `attachment`, `remote`, `attachinfo`, `inputtime`) VALUES
(1, 1, 'admin', 'rand', 'dshine-logo', 'png', 27563, '202201/29faae88a117d4d.png', 0, '{\"width\":500,\"height\":209}', 1642053370),
(2, 1, 'admin', 'rand', '1', 'jpg', 47426, '202201/516ea34aeac80.jpg', 0, '{\"width\":1920,\"height\":661}', 1642055400),
(3, 1, 'admin', 'rand', '3', 'jpg', 20299, '202201/9e821f9293deb02.jpg', 0, '{\"width\":1920,\"height\":661}', 1642055409),
(4, 1, 'admin', 'rand', '5', 'jpg', 50526, '202201/319209ec9ea6531.jpg', 0, '{\"width\":1920,\"height\":661}', 1642055439),
(5, 1, 'admin', 'rand', '4', 'jpg', 36090, '202201/89f1573c3dc5006.jpg', 0, '{\"width\":1920,\"height\":661}', 1642055462),
(6, 1, 'admin', 'rand', 'Diamond_Sprite', 'png', 396100, '202201/8f0c6a62aedae76.png', 0, '{\"width\":351,\"height\":5807}', 1642056428),
(7, 1, 'admin', 'rand', 'ring', 'png', 657223, '202201/bab404932056961.png', 0, '{\"width\":1166,\"height\":779}', 1642056472),
(8, 1, 'admin', 'rand', '1', 'png', 243775, '202201/2f08433d902291e.png', 0, '{\"width\":600,\"height\":431}', 1642057496),
(9, 1, 'admin', 'rand', '5', 'png', 294202, '202201/f3cfbb4cb54660b.png', 0, '{\"width\":600,\"height\":431}', 1642057628),
(10, 1, 'admin', 'rand', '4', 'png', 281045, '202201/adfce981c133c.png', 0, '{\"width\":600,\"height\":431}', 1642057645),
(11, 1, 'admin', 'rand', '3', 'png', 97058, '202201/f0eb3937f6ee58d.png', 0, '{\"width\":600,\"height\":431}', 1642057663),
(12, 1, 'admin', 'rand', '2', 'png', 275652, '202201/bac8860bf5dfb2a.png', 0, '{\"width\":600,\"height\":431}', 1642057699),
(13, 1, 'admin', 'rand', '1', 'png', 30709, '202201/04ca6bf5b1ab7b8.png', 0, '{\"width\":270,\"height\":341}', 1642057903),
(14, 1, 'admin', 'rand', '2', 'png', 80394, '202201/280fe0a3f0767eb.png', 0, '{\"width\":270,\"height\":341}', 1642058007),
(15, 1, 'admin', 'rand', '3', 'png', 43275, '202201/47714c456dfe182.png', 0, '{\"width\":270,\"height\":341}', 1642058038),
(16, 1, 'admin', 'rand', '4', 'png', 63292, '202201/cf215720f301bfc.png', 0, '{\"width\":270,\"height\":341}', 1642058059),
(17, 1, 'admin', 'rand', '3', 'png', 43275, '202201/1f1daa0d8d02091.png', 0, '{\"width\":270,\"height\":341}', 1642058163),
(18, 1, 'admin', 'rand', '17', 'png', 15607, '202201/42463a7ac42eeb6.png', 0, '{\"width\":450,\"height\":450}', 1642058189),
(19, 1, 'admin', 'rand', '18', 'png', 14062, '202201/7daa4328885e022.png', 0, '{\"width\":450,\"height\":450}', 1642058240),
(20, 1, 'admin', 'rand', '19', 'png', 45028, '202201/c92cc95186796a.png', 0, '{\"width\":450,\"height\":450}', 1642058275),
(21, 1, 'admin', 'rand', '5', 'png', 78840, '202201/c56ce7a93aecbd.png', 0, '{\"width\":360,\"height\":333}', 1642058376),
(22, 1, 'admin', 'rand', '6', 'png', 83736, '202201/a39982bf82bf09b.png', 0, '{\"width\":360,\"height\":333}', 1642058404),
(23, 1, 'admin', 'rand', '7', 'png', 47350, '202201/74f9db6d28d403b.png', 0, '{\"width\":360,\"height\":333}', 1642058426),
(24, 1, 'admin', 'rand', '8', 'png', 31608, '202201/f5f15af4ea4458e.png', 0, '{\"width\":360,\"height\":333}', 1642058450),
(25, 1, 'admin', 'rand', '9', 'png', 58327, '202201/c197a7623c68af8.png', 0, '{\"width\":360,\"height\":333}', 1642058475),
(26, 1, 'admin', 'rand', '10', 'png', 73252, '202201/68c1b422a1f096.png', 0, '{\"width\":360,\"height\":333}', 1642058494),
(27, 1, 'admin', 'rand', '2', 'png', 160468, '202201/d79fb0a0900aab6.png', 0, '{\"width\":300,\"height\":300}', 1642058571),
(28, 1, 'admin', 'rand', '3', 'png', 159415, '202201/16ee3ea6c44d5bd.png', 0, '{\"width\":300,\"height\":300}', 1642058602),
(29, 1, 'admin', 'rand', '4', 'png', 167081, '202201/a98d91aee18ee1e.png', 0, '{\"width\":300,\"height\":300}', 1642058637),
(30, 1, 'admin', 'rand', '5', 'png', 119567, '202201/f7c48f850651cc8.png', 0, '{\"width\":300,\"height\":300}', 1642058649),
(31, 1, 'admin', 'rand', '1', 'png', 139755, '202201/3dcc742a35e2c05.png', 0, '{\"width\":300,\"height\":300}', 1642058684),
(32, 1, 'admin', 'rand', '1', 'png', 3891, '202201/31824db738d26.png', 0, '{\"width\":172,\"height\":57}', 1642058727),
(33, 1, 'admin', 'rand', '2', 'png', 4281, '202201/1115d613ade1836.png', 0, '{\"width\":172,\"height\":57}', 1642058735),
(34, 1, 'admin', 'rand', '3', 'png', 3881, '202201/3e655005ae569fe.png', 0, '{\"width\":172,\"height\":57}', 1642058743),
(35, 1, 'admin', 'rand', '4', 'png', 4596, '202201/1d9b48b68da8b07.png', 0, '{\"width\":172,\"height\":57}', 1642058752),
(36, 1, 'admin', 'rand', '5', 'png', 3200, '202201/a9a2cc8d75f81.png', 0, '{\"width\":172,\"height\":57}', 1642058763),
(37, 1, 'admin', 'rand', 'blog3', 'png', 191135, '202201/05acf3204ce7db8.png', 0, '{\"width\":795,\"height\":577}', 1642058951),
(38, 1, 'admin', 'rand', 'bloglist1', 'png', 161634, '202201/4ae725280cab952.png', 0, '{\"width\":830,\"height\":390}', 1642058996),
(39, 1, 'admin', 'rand', 'bloglist3', 'png', 137879, '202201/0e02dd2ef4822bf.png', 0, '{\"width\":830,\"height\":390}', 1642059027),
(40, 1, 'admin', 'rand', 'blog6', 'png', 75249, '202201/93c396ce58e7b07.png', 0, '{\"width\":795,\"height\":577}', 1642059105),
(41, 1, 'admin', 'rand', 'blog1', 'png', 167631, '202201/e27af2cf1b19231.png', 0, '{\"width\":795,\"height\":577}', 1642059138),
(42, 1, 'admin', 'rand', 'blog7', 'png', 137858, '202201/f046fa7daf08b2c.png', 0, '{\"width\":795,\"height\":577}', 1642059153),
(43, 1, 'admin', 'rand', 'blog5', 'png', 153107, '202201/45a8661054cfaa5.png', 0, '{\"width\":795,\"height\":577}', 1642059172),
(44, 1, 'admin', 'rand', 'blog3', 'png', 191135, '202201/7edca3bbbd4d.png', 0, '{\"width\":795,\"height\":577}', 1642059182),
(45, 1, 'admin', 'rand', 'bloglist1', 'png', 161634, '202201/ba27d8e6518b3a.png', 0, '{\"width\":830,\"height\":390}', 1642059280),
(46, 1, 'admin', 'rand', 'blog3', 'png', 191135, '202201/6869659c6bacb09.png', 0, '{\"width\":795,\"height\":577}', 1642059321),
(47, 1, 'admin', 'rand', 'bloglist3', 'png', 137879, '202201/559b6d25ca0ebe4.png', 0, '{\"width\":830,\"height\":390}', 1642059333),
(48, 1, 'admin', 'rand', '20', 'png', 58943, '202201/2b3219c183f8b23.png', 0, '{\"width\":450,\"height\":450}', 1642060688),
(49, 1, 'admin', 'rand', '17', 'png', 15607, '202201/8619561d1450467.png', 0, '{\"width\":450,\"height\":450}', 1642062890),
(50, 1, 'admin', 'rand', 'tel24-7_3', 'png', 1720, '202201/7d01c090b8b600e.png', 0, '{\"width\":37,\"height\":33}', 1642064084),
(51, 1, 'admin', 'rand', 'shopping-bag2', 'png', 1750, '202201/77490e351722406.png', 0, '{\"width\":35,\"height\":37}', 1642064129),
(52, 1, 'admin', 'rand', 'tel24-7_2', 'png', 1632, '202201/64e8fb844131186.png', 0, '{\"width\":42,\"height\":38}', 1642064149),
(53, 1, 'admin', 'rand', 'car3', 'png', 1436, '202201/1d8f11bed7c4035.png', 0, '{\"width\":44,\"height\":32}', 1642064169),
(54, 1, 'admin', 'rand', '1', 'png', 36310, '202201/d01a80dfc2ee621.png', 0, '{\"width\":296,\"height\":383}', 1642065188),
(55, 1, 'admin', 'rand', '2', 'png', 153035, '202201/48cdeedc9390a7b.png', 0, '{\"width\":577,\"height\":734}', 1642065203),
(56, 1, 'admin', 'rand', '3', 'png', 151425, '202201/871c886fb1d26c1.png', 0, '{\"width\":577,\"height\":740}', 1642065218),
(57, 1, 'admin', 'rand', '4', 'png', 119387, '202201/7dbb0bd93d36421.png', 0, '{\"width\":577,\"height\":734}', 1642065236),
(58, 1, 'admin', 'rand', '1', 'png', 139755, '202201/830d36b2a5307f0.png', 0, '{\"width\":300,\"height\":300}', 1642065266),
(59, 1, 'admin', 'rand', '2', 'png', 160468, '202201/54f34ce7236a1a1.png', 0, '{\"width\":300,\"height\":300}', 1642065358),
(60, 1, 'admin', 'rand', '3', 'png', 159415, '202201/3f84993200dc3bd.png', 0, '{\"width\":300,\"height\":300}', 1642065378),
(61, 1, 'admin', 'rand', '5', 'png', 119567, '202201/1ba8778598463c4.png', 0, '{\"width\":300,\"height\":300}', 1642065465),
(62, 1, 'admin', 'rand', '2', 'png', 4281, '202201/e2beaf1f6e3caf0.png', 0, '{\"width\":172,\"height\":57}', 1642065550),
(63, 1, 'admin', 'rand', 'bloglist5', 'png', 86587, '202201/7f46dfeaa43deb5.png', 0, '{\"width\":830,\"height\":390}', 1642067609),
(64, 1, 'admin', 'rand', 'lt1', 'png', 138941, '202201/5adad3173f29b22.png', 0, '{\"width\":300,\"height\":300}', 1642124112),
(65, 1, 'admin', 'rand', 'lt2', 'png', 159635, '202201/346a82da64cc776.png', 0, '{\"width\":300,\"height\":300}', 1642124184),
(66, 1, 'admin', 'rand', 'lt3', 'png', 158776, '202201/10bbb390629a09a.png', 0, '{\"width\":300,\"height\":300}', 1642124228),
(67, 1, 'admin', 'rand', 'lt4', 'png', 166129, '202201/78516550ac53284.png', 0, '{\"width\":300,\"height\":300}', 1642124239),
(68, 1, 'admin', 'rand', 'lt5', 'png', 118724, '202201/10deafbc658ced0.png', 0, '{\"width\":300,\"height\":300}', 1642124259),
(69, 1, 'admin', 'rand', '1', 'png', 19468, '202201/71eac65eacde683.png', 0, '{\"width\":93,\"height\":93}', 1642124708),
(70, 1, 'admin', 'rand', '2', 'png', 22595, '202201/4eebfbbb6386b1b.png', 0, '{\"width\":93,\"height\":93}', 1642124712),
(71, 1, 'admin', 'rand', '3', 'png', 20596, '202201/0e1b68814115d09.png', 0, '{\"width\":93,\"height\":93}', 1642124715),
(72, 1, 'admin', 'rand', '5', 'png', 23401, '202201/c2d8e098c9ff41.png', 0, '{\"width\":93,\"height\":93}', 1642124718),
(73, 1, 'admin', 'rand', '6', 'png', 19331, '202201/6cce85946beb273.png', 0, '{\"width\":93,\"height\":93}', 1642124722),
(74, 1, 'admin', 'rand', '4', 'png', 22087, '202201/4ab9232a21d6d76.png', 0, '{\"width\":93,\"height\":93}', 1642125129),
(75, 1, 'admin', 'rand', '1', 'png', 71975, '202201/a1513178b7fff7f.png', 0, '{\"width\":270,\"height\":341}', 1642125455),
(76, 1, 'admin', 'rand', '2', 'png', 55055, '202201/fca096cc9631.png', 0, '{\"width\":270,\"height\":341}', 1642125485),
(77, 1, 'admin', 'rand', '4', 'png', 21077, '202201/e628753d45a83d2.png', 0, '{\"width\":270,\"height\":341}', 1642125523),
(78, 1, 'admin', 'rand', '5', 'png', 85019, '202201/e941964ed80c.png', 0, '{\"width\":270,\"height\":341}', 1642125542),
(79, 1, 'admin', 'rand', '6', 'png', 58832, '202201/0f8ba7b6c35d438.png', 0, '{\"width\":270,\"height\":341}', 1642125556),
(80, 1, 'admin', 'rand', '3', 'png', 46890, '202201/e3e9ba18ac80e09.png', 0, '{\"width\":270,\"height\":341}', 1642125567),
(81, 1, 'admin', 'rand', '1', 'jpg', 93905, '202201/242f491a6ac19f0.jpg', 0, '{\"width\":635,\"height\":491}', 1642126727),
(82, 1, 'admin', 'rand', '2', 'jpg', 104310, '202201/68b089809975.jpg', 0, '{\"width\":635,\"height\":491}', 1642126729),
(83, 1, 'admin', 'rand', '3', 'jpg', 103462, '202201/03a8a62933a9dc5.jpg', 0, '{\"width\":635,\"height\":491}', 1642126732),
(84, 1, 'admin', 'rand', '4', 'jpg', 104485, '202201/7bb664d94bc247c.jpg', 0, '{\"width\":635,\"height\":491}', 1642126735),
(85, 1, 'admin', 'rand', '5', 'jpg', 73229, '202201/2348a60abfc5.jpg', 0, '{\"width\":635,\"height\":491}', 1642126738),
(86, 1, 'admin', 'rand', '6', 'jpg', 99037, '202201/3b1ec1f34abbac0.jpg', 0, '{\"width\":635,\"height\":491}', 1642126741),
(87, 1, 'admin', 'rand', '7', 'jpg', 107832, '202201/fba35127d27505c.jpg', 0, '{\"width\":635,\"height\":491}', 1642126743),
(88, 1, 'admin', 'rand', '8', 'jpg', 104739, '202201/2d099817a42c450.jpg', 0, '{\"width\":635,\"height\":491}', 1642126749),
(89, 1, 'admin', 'rand', '1s', 'jpg', 6563, '202201/b5c03092fee34a0.jpg', 0, '{\"width\":102,\"height\":102}', 1642126765),
(90, 1, 'admin', 'rand', '2s', 'jpg', 7188, '202201/e7c54b2ec4aa657.jpg', 0, '{\"width\":102,\"height\":102}', 1642126768),
(91, 1, 'admin', 'rand', '3s', 'jpg', 7613, '202201/c302f34271ea.jpg', 0, '{\"width\":102,\"height\":102}', 1642126770),
(92, 1, 'admin', 'rand', '4s', 'jpg', 7510, '202201/80da467c06b2219.jpg', 0, '{\"width\":102,\"height\":102}', 1642126774),
(93, 1, 'admin', 'rand', '5s', 'jpg', 5791, '202201/2300bf7ae31ffe5.jpg', 0, '{\"width\":102,\"height\":102}', 1642126776),
(94, 1, 'admin', 'rand', '6s', 'jpg', 7064, '202201/9d2b1fa3eaf15d2.jpg', 0, '{\"width\":102,\"height\":102}', 1642126779),
(95, 1, 'admin', 'rand', '7s', 'jpg', 7648, '202201/ca7b9bf27a67ee3.jpg', 0, '{\"width\":102,\"height\":102}', 1642126781),
(96, 1, 'admin', 'rand', '8s', 'jpg', 7382, '202201/a1fa6f4986270b4.jpg', 0, '{\"width\":102,\"height\":102}', 1642126785),
(97, 1, 'admin', 'rand', '10', 'png', 73252, '202201/d692b1b00cd916d.png', 0, '{\"width\":360,\"height\":333}', 1642128016),
(98, 1, 'admin', 'rand', 'cart3', 'png', 1161, '202201/1773983b5f4f723.png', 0, '{\"width\":26,\"height\":24}', 1642128092),
(99, 1, 'admin', 'rand', '2', 'jpg', 5598, '202201/ec4542b67905.jpg', 0, '{\"width\":370,\"height\":272}', 1642129302),
(100, 1, 'admin', 'rand', '3', 'jpg', 15259, '202201/5ddb55c65de7348.jpg', 0, '{\"width\":370,\"height\":272}', 1642129333),
(101, 1, 'admin', 'rand', '4', 'jpg', 5095, '202201/fa05840fbe1540d.jpg', 0, '{\"width\":370,\"height\":272}', 1642129350),
(102, 1, 'admin', 'rand', '1', 'jpg', 20692, '202201/41d6e4238607fb4.jpg', 0, '{\"width\":1170,\"height\":334}', 1642129379);

-- --------------------------------------------------------

--
-- 表的结构 `mys_attachment_remote`
--

CREATE TABLE `mys_attachment_remote` (
  `id` tinyint(2) UNSIGNED NOT NULL,
  `type` tinyint(2) NOT NULL COMMENT '类型',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL COMMENT '访问地址',
  `value` text NOT NULL COMMENT '参数值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='远程附件表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_attachment_unused`
--

CREATE TABLE `mys_attachment_unused` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '附件id',
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `siteid` mediumint(5) UNSIGNED NOT NULL COMMENT '站点id',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '入库时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='未使用的附件表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_cron`
--

CREATE TABLE `mys_cron` (
  `id` int(10) NOT NULL,
  `site` int(10) NOT NULL COMMENT '站点',
  `type` varchar(20) NOT NULL COMMENT '类型',
  `value` text NOT NULL COMMENT '参数值',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '状态',
  `error` text COMMENT '错误信息',
  `updatetime` int(10) UNSIGNED NOT NULL COMMENT '执行时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '写入时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='任务管理';

-- --------------------------------------------------------

--
-- 表的结构 `mys_export`
--

CREATE TABLE `mys_export` (
  `id` int(10) NOT NULL COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT '表名称',
  `value` text NOT NULL COMMENT '字段配置项目'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导出数据字段配置';

-- --------------------------------------------------------

--
-- 表的结构 `mys_field`
--

CREATE TABLE `mys_field` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` text NOT NULL COMMENT '字段别名语言',
  `fieldname` varchar(50) NOT NULL COMMENT '字段名称',
  `fieldtype` varchar(50) NOT NULL COMMENT '字段类型',
  `relatedid` smallint(5) UNSIGNED NOT NULL COMMENT '相关id',
  `relatedname` varchar(50) NOT NULL COMMENT '相关表',
  `isedit` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否可修改',
  `ismain` tinyint(1) UNSIGNED NOT NULL COMMENT '是否主表',
  `issystem` tinyint(1) UNSIGNED NOT NULL COMMENT '是否系统表',
  `ismember` tinyint(1) UNSIGNED NOT NULL COMMENT '是否会员可见',
  `issearch` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否可搜索',
  `disabled` tinyint(1) UNSIGNED NOT NULL COMMENT '禁用？',
  `setting` text NOT NULL COMMENT '配置信息',
  `displayorder` int(5) NOT NULL COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='字段表';

--
-- 转存表中的数据 `mys_field`
--

INSERT INTO `mys_field` (`id`, `name`, `fieldname`, `fieldtype`, `relatedid`, `relatedname`, `isedit`, `ismain`, `issystem`, `ismember`, `issearch`, `disabled`, `setting`, `displayorder`) VALUES
(1, '主题', 'title', 'Text', 1, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1,\"formattr\":\"onblur=\\\"check_title();get_keywords(\'keywords\');\\\"\"}}', 0),
(2, '缩略图', 'thumb', 'File', 1, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"ext\":\"jpg,gif,png\",\"size\":10,\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"}}', 0),
(3, '关键字', 'keywords', 'Text', 1, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"formattr\":\" data-role=\\\"tagsinput\\\"\"}}', 0),
(4, '描述', 'description', 'Textarea', 1, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":500,\"height\":60,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"filter\":\"mys_clearhtml\"}}', 0),
(5, '内容', 'content', 'Ueditor', 1, 'module', 1, 0, 1, 1, 1, 0, '{\"option\":{\"mode\":1,\"width\":\"100%\",\"height\":400},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(19, '描述', 'description', 'Textarea', 4, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":500,\"height\":60,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"filter\":\"mys_clearhtml\"}}', 0),
(18, '关键字', 'keywords', 'Text', 4, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"formattr\":\" data-role=\\\"tagsinput\\\"\"}}', 0),
(17, '缩略图', 'thumb', 'File', 4, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"ext\":\"jpg,gif,png\",\"size\":10,\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"}}', 0),
(16, '主题', 'title', 'Text', 4, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1,\"formattr\":\"onblur=\\\"check_title();get_keywords(\'keywords\');\\\"\"}}', 0),
(11, '主题', 'title', 'Text', 3, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1,\"formattr\":\"onblur=\\\"check_title();get_keywords(\'keywords\');\\\"\"}}', 0),
(12, '缩略图', 'thumb', 'File', 3, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"ext\":\"jpg,gif,png\",\"size\":10,\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"}}', 0),
(13, '关键字', 'keywords', 'Text', 3, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"formattr\":\" data-role=\\\"tagsinput\\\"\"}}', 0),
(14, '描述', 'description', 'Textarea', 3, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":500,\"height\":60,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"filter\":\"mys_clearhtml\"}}', 0),
(15, '内容', 'content', 'Ueditor', 3, 'module', 1, 0, 1, 1, 1, 0, '{\"option\":{\"mode\":1,\"width\":\"100%\",\"height\":400},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(20, '内容', 'content', 'Ueditor', 4, 'module', 1, 0, 1, 1, 1, 0, '{\"option\":{\"mode\":1,\"width\":\"100%\",\"height\":400},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(21, '主题', 'title', 'Text', 5, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1,\"formattr\":\"onblur=\\\"check_title();get_keywords(\'keywords\');\\\"\"}}', 0),
(22, '缩略图', 'thumb', 'File', 5, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"ext\":\"jpg,gif,png\",\"size\":10,\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"}}', 0),
(23, '关键字', 'keywords', 'Text', 5, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"formattr\":\" data-role=\\\"tagsinput\\\"\"}}', 0),
(24, '描述', 'description', 'Textarea', 5, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":500,\"height\":60,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"filter\":\"mys_clearhtml\"}}', 0),
(25, '内容', 'content', 'Ueditor', 5, 'module', 1, 0, 1, 1, 1, 0, '{\"option\":{\"mode\":1,\"width\":\"100%\",\"height\":400},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(26, '主题', 'title', 'Text', 1, 'form-1', 1, 1, 1, 0, 1, 0, '{\"option\":{\"width\":300,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(27, 'NAME', 'name', 'Text', 1, 'form-1', 1, 1, 0, 1, 0, 0, '{\"option\":{\"fieldtype\":\"\",\"fieldlength\":\"\",\"value\":\"\",\"width\":\"\",\"css\":\"\"},\"validate\":{\"required\":\"0\",\"pattern\":\"\",\"errortips\":\"\",\"check\":\"\",\"filter\":\"\",\"formattr\":\"\",\"tips\":\"\"},\"is_right\":\"0\"}', 0),
(28, 'EMAIL', 'email', 'Text', 1, 'form-1', 1, 1, 0, 1, 0, 0, '{\"option\":{\"fieldtype\":\"\",\"fieldlength\":\"\",\"value\":\"\",\"width\":\"\",\"css\":\"\"},\"validate\":{\"required\":\"0\",\"pattern\":\"\",\"errortips\":\"\",\"check\":\"\",\"filter\":\"\",\"formattr\":\"\",\"tips\":\"\"},\"is_right\":\"0\"}', 0),
(29, 'SUBJECT', 'subject', 'Text', 1, 'form-1', 1, 1, 0, 1, 0, 0, '{\"option\":{\"fieldtype\":\"\",\"fieldlength\":\"\",\"value\":\"\",\"width\":\"\",\"css\":\"\"},\"validate\":{\"required\":\"0\",\"pattern\":\"\",\"errortips\":\"\",\"check\":\"\",\"filter\":\"\",\"formattr\":\"\",\"tips\":\"\"},\"is_right\":\"0\"}', 0),
(30, 'YOUR MESSAGE', 'your_message', 'Textarea', 1, 'form-1', 1, 1, 0, 1, 0, 0, '{\"option\":{\"value\":\"\",\"width\":\"\",\"height\":\"\",\"css\":\"\"},\"validate\":{\"required\":\"0\",\"pattern\":\"\",\"errortips\":\"\",\"check\":\"\",\"filter\":\"\",\"formattr\":\"\",\"tips\":\"\"},\"is_right\":\"0\"}', 0),
(31, '主题', 'title', 'Text', 6, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"required\":1,\"formattr\":\"onblur=\\\"check_title();get_keywords(\'keywords\');\\\"\"}}', 0),
(32, '缩略图', 'thumb', 'File', 6, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"ext\":\"jpg,gif,png\",\"size\":10,\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"}}', 0),
(33, '关键字', 'keywords', 'Text', 6, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":400,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"formattr\":\" data-role=\\\"tagsinput\\\"\"}}', 0),
(34, '描述', 'description', 'Textarea', 6, 'module', 1, 1, 1, 1, 1, 0, '{\"option\":{\"width\":500,\"height\":60,\"fieldtype\":\"VARCHAR\",\"fieldlength\":\"255\"},\"validate\":{\"xss\":1,\"filter\":\"mys_clearhtml\"}}', 0),
(35, '内容', 'content', 'Ueditor', 6, 'module', 1, 0, 1, 1, 1, 0, '{\"option\":{\"mode\":1,\"width\":\"100%\",\"height\":400},\"validate\":{\"xss\":1,\"required\":1}}', 0),
(36, '价格', 'jiage', 'Ueditor', 12, 'chanpin-1', 1, 1, 0, 1, 0, 0, '{\"option\":{\"down_img\":\"0\",\"watermark\":\"0\",\"show_bottom_boot\":\"0\",\"mini\":\"0\",\"autofloat\":\"0\",\"autoheight\":\"0\",\"page\":\"0\",\"mode\":\"1\",\"tool\":\"\'bold\', \'italic\', \'underline\'\",\"mode2\":\"1\",\"tool2\":\"\'bold\', \'italic\', \'underline\'\",\"mode3\":\"1\",\"tool3\":\"\'bold\', \'italic\', \'underline\'\",\"attachment\":\"0\",\"value\":\"\",\"width\":\"100%\",\"height\":\"300\",\"css\":\"\"},\"validate\":{\"required\":\"0\",\"pattern\":\"\",\"errortips\":\"\",\"check\":\"\",\"filter\":\"\",\"formattr\":\"\",\"tips\":\"\",\"xss\":1},\"is_right\":\"0\"}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_linkage`
--

CREATE TABLE `mys_linkage` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `type` tinyint(1) UNSIGNED NOT NULL,
  `code` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='联动菜单表';

--
-- 转存表中的数据 `mys_linkage`
--

INSERT INTO `mys_linkage` (`id`, `name`, `type`, `code`) VALUES
(1, '中国地区', 0, 'address');

-- --------------------------------------------------------

--
-- 表的结构 `mys_linkage_data_1`
--

CREATE TABLE `mys_linkage_data_1` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `site` mediumint(5) UNSIGNED NOT NULL COMMENT '站点id',
  `pid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) DEFAULT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `cname` varchar(30) NOT NULL COMMENT '别名',
  `child` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否有下级',
  `hidden` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '前端隐藏',
  `childids` text COMMENT '下级所有id',
  `displayorder` mediumint(8) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='联动菜单数据表';

--
-- 转存表中的数据 `mys_linkage_data_1`
--

INSERT INTO `mys_linkage_data_1` (`id`, `site`, `pid`, `pids`, `name`, `cname`, `child`, `hidden`, `childids`, `displayorder`) VALUES
(1, 1, 0, '0', '北京', 'bj', 0, 0, '1', 0),
(2, 1, 0, '0', '成都', 'cd', 0, 0, '2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_mail_smtp`
--

CREATE TABLE `mys_mail_smtp` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `host` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `port` mediumint(8) UNSIGNED NOT NULL,
  `displayorder` smallint(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件账户表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member`
--

CREATE TABLE `mys_member` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` char(50) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `phone` char(20) NOT NULL COMMENT '手机号码',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '加密密码',
  `salt` char(10) NOT NULL COMMENT '随机加密码',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `money` decimal(10,2) UNSIGNED NOT NULL COMMENT 'RMB',
  `freeze` decimal(10,2) UNSIGNED NOT NULL COMMENT '冻结RMB',
  `spend` decimal(10,2) UNSIGNED NOT NULL COMMENT '消费RMB总额',
  `score` int(10) UNSIGNED NOT NULL COMMENT '虚拟币',
  `experience` int(10) UNSIGNED NOT NULL COMMENT '经验值',
  `regip` varchar(50) NOT NULL COMMENT '注册ip',
  `regtime` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `randcode` mediumint(6) UNSIGNED NOT NULL COMMENT '随机验证码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

--
-- 转存表中的数据 `mys_member`
--

INSERT INTO `mys_member` (`id`, `email`, `phone`, `username`, `password`, `salt`, `name`, `money`, `freeze`, `spend`, `score`, `experience`, `regip`, `regtime`, `randcode`) VALUES
(1, '11111', '', 'admin', 'c591a0737c70bc06a62c65f844be37a7', '8b6dd7db9a', '创始人', '1000000.00', '0.00', '0.00', 1000000, 1000000, '', 1642047090, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_data`
--

CREATE TABLE `mys_member_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否是管理员',
  `is_lock` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '账号锁定标识',
  `is_auth` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '实名认证标识',
  `is_verify` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '审核标识',
  `is_mobile` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '手机认证标识',
  `is_avatar` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '头像上传标识',
  `is_complete` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '完善资料标识'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

--
-- 转存表中的数据 `mys_member_data`
--

INSERT INTO `mys_member_data` (`id`, `is_admin`, `is_lock`, `is_auth`, `is_verify`, `is_mobile`, `is_avatar`, `is_complete`) VALUES
(1, 1, 0, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_explog`
--

CREATE TABLE `mys_member_explog` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '账号',
  `value` int(10) NOT NULL COMMENT '分数变化值',
  `mark` varchar(50) NOT NULL COMMENT '标记',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='经验值流水日志';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_group`
--

CREATE TABLE `mys_member_group` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` text NOT NULL COMMENT '用户组名称',
  `price` decimal(10,2) NOT NULL COMMENT '售价',
  `unit` tinyint(1) UNSIGNED NOT NULL COMMENT '价格单位:1虚拟币，0金钱',
  `days` int(10) UNSIGNED NOT NULL COMMENT '生效天数',
  `apply` tinyint(1) UNSIGNED NOT NULL COMMENT '是否申请',
  `register` tinyint(1) UNSIGNED NOT NULL COMMENT '是否允许注册',
  `setting` text NOT NULL COMMENT '用户组配置',
  `displayorder` smallint(5) NOT NULL COMMENT '排序'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组表';

--
-- 转存表中的数据 `mys_member_group`
--

INSERT INTO `mys_member_group` (`id`, `name`, `price`, `unit`, `days`, `apply`, `register`, `setting`, `displayorder`) VALUES
(1, '注册用户', '0.00', 0, 0, 1, 1, '{\"level\":{\"auto\":\"0\",\"unit\":\"0\",\"price\":\"0\"},\"verify\":\"0\"}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_group_index`
--

CREATE TABLE `mys_member_group_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `gid` smallint(5) UNSIGNED NOT NULL COMMENT '用户组id',
  `lid` smallint(5) UNSIGNED NOT NULL COMMENT '用户组等级id',
  `stime` int(10) UNSIGNED NOT NULL COMMENT '开通时间',
  `etime` int(10) UNSIGNED NOT NULL COMMENT '结束时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组归属表';

--
-- 转存表中的数据 `mys_member_group_index`
--

INSERT INTO `mys_member_group_index` (`id`, `uid`, `gid`, `lid`, `stime`, `etime`) VALUES
(1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_group_verify`
--

CREATE TABLE `mys_member_group_verify` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `gid` smallint(5) UNSIGNED NOT NULL COMMENT '用户组id',
  `lid` smallint(5) UNSIGNED NOT NULL COMMENT '用户组等级id',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '自定义字段信息',
  `inputtime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组申请审核';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_level`
--

CREATE TABLE `mys_member_level` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `gid` smallint(5) UNSIGNED NOT NULL COMMENT '用户id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `stars` tinyint(2) NOT NULL COMMENT '星星数量',
  `value` int(10) UNSIGNED NOT NULL COMMENT '升级值要求',
  `note` text NOT NULL COMMENT '备注',
  `apply` tinyint(1) UNSIGNED NOT NULL COMMENT '是否允许升级'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组级别表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_login`
--

CREATE TABLE `mys_member_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED DEFAULT NULL COMMENT '会员uid',
  `type` varchar(30) NOT NULL COMMENT '登录方式',
  `loginip` varchar(50) NOT NULL COMMENT '登录Ip',
  `logintime` int(10) UNSIGNED NOT NULL COMMENT '登录时间',
  `useragent` varchar(255) NOT NULL COMMENT '客户端信息'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登录日志记录';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_menu`
--

CREATE TABLE `mys_member_menu` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `pid` smallint(5) UNSIGNED NOT NULL COMMENT '上级菜单id',
  `name` text NOT NULL COMMENT '菜单语言名称',
  `uri` varchar(255) DEFAULT NULL COMMENT 'uri字符串',
  `url` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `mark` varchar(20) DEFAULT NULL COMMENT '菜单标识',
  `hidden` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '是否隐藏',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标标示',
  `group` text NOT NULL COMMENT '用户组划分',
  `site` text NOT NULL COMMENT '站点划分',
  `displayorder` int(5) DEFAULT NULL COMMENT '排序值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组菜单表';

--
-- 转存表中的数据 `mys_member_menu`
--

INSERT INTO `mys_member_menu` (`id`, `pid`, `name`, `uri`, `url`, `mark`, `hidden`, `icon`, `group`, `site`, `displayorder`) VALUES
(1, 0, '账号管理', '', '', 'user', 0, 'fa fa-user', '', '', 0),
(2, 1, '资料修改', 'account/index', '', '', 0, 'fa fa-cog', '', '', 0),
(3, 1, '头像设置', 'account/avatar', '', '', 0, 'fa fa-smile-o', '', '', 0),
(4, 1, '手机认证', 'account/mobile', '', '', 0, 'fa fa-mobile', '', '', 0),
(5, 1, '修改密码', 'account/password', '', '', 0, 'fa fa-expeditedssl', '', '', 0),
(6, 1, '账号绑定', 'account/oauth', '', '', 0, 'fa fa-qq', '', '', 0),
(7, 1, '登录记录', 'account/login', '', '', 0, 'fa fa-calendar', '', '', 0),
(8, 0, '财务管理', '', '', 'pay', 0, 'fa fa-rmb', '', '', 0),
(9, 8, '在线充值', 'recharge/index', '', '', 0, 'fa fa-rmb', '', '', 0),
(10, 8, '我的交易', 'paylog/index', '', '', 0, 'fa fa-calendar', '', '', 0),
(11, 8, '虚拟金币', 'scorelog/index', '', '', 0, 'fa fa-diamond', '', '', 0),
(12, 8, '申请提现', 'cash/index', '', '', 0, 'fa fa-credit-card', '', '', 0),
(13, 8, '提醒消息', 'notice/index', '', '', 0, 'fa fa-envelope', '', '', 0),
(14, 0, '内容管理', '', '', 'content-module', 0, 'fa fa-th-large', '', '', 0),
(15, 14, '我的评论', 'content/comment', '', '', 0, 'fa fa-comments', '', '', 0),
(16, 14, '文章管理', 'news/home/index', '', 'module-news', 0, 'fa fa-sticky-note', '', '', -1),
(19, 14, '产品管理', 'chanpin/home/index', '', 'module-chanpin', 0, 'fa fa-gg-circle', '', '', -1),
(18, 14, '轮播图管理', 'lunbotu/home/index', '', 'module-lunbotu', 0, 'fa fa-cc-jcb', '', '', -1),
(20, 14, '关于管理', 'guanyu/home/index', '', 'module-guanyu', 0, 'fa fa-beer', '', '', -1),
(21, 14, '联系管理', 'form/lianxi/index', '', 'form-lianxi', 0, '', '', '', 0),
(22, 14, '联系管理', 'lianxi/home/index', '', 'module-lianxi', 0, 'fa fa-houzz', '', '', -1);

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_notice`
--

CREATE TABLE `mys_member_notice` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '类型',
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '通知者uid',
  `isnew` tinyint(1) UNSIGNED NOT NULL COMMENT '新提醒',
  `content` text NOT NULL COMMENT '通知内容',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '提交时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员通知提醒表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_oauth`
--

CREATE TABLE `mys_member_oauth` (
  `id` int(10) NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '会员uid',
  `oid` varchar(255) NOT NULL COMMENT 'OAuth返回id',
  `oauth` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `expire_at` int(10) UNSIGNED NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户OAuth授权表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_paylog`
--

CREATE TABLE `mys_member_paylog` (
  `id` bigint(18) UNSIGNED NOT NULL,
  `site` int(10) NOT NULL COMMENT '站点',
  `mid` varchar(100) NOT NULL COMMENT '支付标识',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '付款人',
  `username` varchar(50) NOT NULL COMMENT '付款账号',
  `touid` int(10) UNSIGNED DEFAULT '0' COMMENT '收款人',
  `tousername` varchar(50) DEFAULT NULL COMMENT '收款人账号',
  `title` varchar(255) NOT NULL COMMENT '支付标题',
  `url` varchar(255) NOT NULL COMMENT '相关链接',
  `value` decimal(10,2) NOT NULL COMMENT '支付金额',
  `type` varchar(20) NOT NULL COMMENT '支付方式',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '支付状态',
  `result` text NOT NULL COMMENT '支付结果',
  `paytime` int(10) UNSIGNED NOT NULL COMMENT '支付时间',
  `inputtime` int(10) UNSIGNED NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户支付记录表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_scorelog`
--

CREATE TABLE `mys_member_scorelog` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '账号',
  `value` int(10) NOT NULL COMMENT '分数变化值',
  `mark` varchar(50) NOT NULL COMMENT '标记',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='金币流水日志';

-- --------------------------------------------------------

--
-- 表的结构 `mys_member_setting`
--

CREATE TABLE `mys_member_setting` (
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户属性参数表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_module`
--

CREATE TABLE `mys_module` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `site` text COMMENT '站点划分',
  `dirname` varchar(50) NOT NULL COMMENT '目录名称',
  `share` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '是否共享模块',
  `setting` text COMMENT '配置信息',
  `comment` text COMMENT '评论信息',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁用？',
  `displayorder` smallint(5) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模块表';

--
-- 转存表中的数据 `mys_module`
--

INSERT INTO `mys_module` (`id`, `site`, `dirname`, `share`, `setting`, `comment`, `disabled`, `displayorder`) VALUES
(1, '{\"1\":{\"html\":0,\"theme\":\"default\",\"domain\":\"\",\"template\":\"default\"}}', 'news', 1, '{\"order\":\"displayorder DESC,updatetime DESC\",\"verify_msg\":\"\",\"delete_msg\":\"\",\"list_field\":{\"title\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u4e3b\\u9898\",\"width\":\"\",\"func\":\"title\"},\"catid\":{\"use\":\"1\",\"order\":\"2\",\"name\":\"\\u680f\\u76ee\",\"width\":\"120\",\"func\":\"catid\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"updatetime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u66f4\\u65b0\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"comment_list_field\":{\"content\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u8bc4\\u8bba\",\"width\":\"\",\"func\":\"comment\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"inputtime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u8bc4\\u8bba\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"flag\":null,\"param\":null,\"search\":{\"use\":\"1\",\"field\":\"title,keywords\",\"total\":\"500\",\"length\":\"4\",\"param_join\":\"-\",\"param_rule\":\"0\",\"param_field\":\"\",\"param_join_field\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"param_join_default_value\":\"0\"}}', '', 0, 0),
(4, '{\"1\":{\"html\":0,\"theme\":\"default\",\"domain\":\"\",\"template\":\"default\"}}', 'chanpin', 0, '{\"order\":\"displayorder DESC,updatetime DESC\",\"verify_msg\":\"\",\"delete_msg\":\"\",\"list_field\":{\"title\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u4e3b\\u9898\",\"width\":\"\",\"func\":\"title\"},\"catid\":{\"use\":\"1\",\"order\":\"2\",\"name\":\"\\u680f\\u76ee\",\"width\":\"120\",\"func\":\"catid\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"updatetime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u66f4\\u65b0\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"comment_list_field\":{\"content\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u8bc4\\u8bba\",\"width\":\"\",\"func\":\"comment\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"inputtime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u8bc4\\u8bba\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"flag\":null,\"param\":null,\"search\":{\"use\":\"1\",\"field\":\"title,keywords\",\"total\":\"500\",\"length\":\"4\",\"param_join\":\"-\",\"param_rule\":\"0\",\"param_field\":\"\",\"param_join_field\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"param_join_default_value\":\"0\"}}', '', 0, 0),
(3, '{\"1\":{\"html\":0,\"theme\":\"default\",\"domain\":\"\",\"template\":\"default\"}}', 'lunbotu', 0, '{\"order\":\"displayorder DESC,updatetime DESC\",\"verify_msg\":\"\",\"delete_msg\":\"\",\"list_field\":{\"title\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u4e3b\\u9898\",\"width\":\"\",\"func\":\"title\"},\"catid\":{\"use\":\"1\",\"order\":\"2\",\"name\":\"\\u680f\\u76ee\",\"width\":\"120\",\"func\":\"catid\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"updatetime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u66f4\\u65b0\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"comment_list_field\":{\"content\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u8bc4\\u8bba\",\"width\":\"\",\"func\":\"comment\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"inputtime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u8bc4\\u8bba\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"flag\":null,\"param\":null,\"search\":{\"use\":\"1\",\"field\":\"title,keywords\",\"total\":\"500\",\"length\":\"4\",\"param_join\":\"-\",\"param_rule\":\"0\",\"param_field\":\"\",\"param_join_field\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"param_join_default_value\":\"0\"}}', '', 0, 0),
(5, '{\"1\":{\"html\":0,\"theme\":\"default\",\"domain\":\"\",\"template\":\"default\"}}', 'guanyu', 0, '{\"order\":\"displayorder DESC,updatetime DESC\",\"verify_msg\":\"\",\"delete_msg\":\"\",\"list_field\":{\"title\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u4e3b\\u9898\",\"width\":\"\",\"func\":\"title\"},\"catid\":{\"use\":\"1\",\"order\":\"2\",\"name\":\"\\u680f\\u76ee\",\"width\":\"120\",\"func\":\"catid\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"updatetime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u66f4\\u65b0\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"comment_list_field\":{\"content\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u8bc4\\u8bba\",\"width\":\"\",\"func\":\"comment\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"inputtime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u8bc4\\u8bba\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"flag\":null,\"param\":null,\"search\":{\"use\":\"1\",\"field\":\"title,keywords\",\"total\":\"500\",\"length\":\"4\",\"param_join\":\"-\",\"param_rule\":\"0\",\"param_field\":\"\",\"param_join_field\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"param_join_default_value\":\"0\"}}', '', 0, 0),
(6, '{\"1\":{\"html\":0,\"theme\":\"default\",\"domain\":\"\",\"template\":\"default\"}}', 'lianxi', 1, '{\"order\":\"displayorder DESC,updatetime DESC\",\"verify_msg\":\"\",\"delete_msg\":\"\",\"list_field\":{\"title\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u4e3b\\u9898\",\"width\":\"\",\"func\":\"title\"},\"catid\":{\"use\":\"1\",\"order\":\"2\",\"name\":\"\\u680f\\u76ee\",\"width\":\"120\",\"func\":\"catid\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"updatetime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u66f4\\u65b0\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"comment_list_field\":{\"content\":{\"use\":\"1\",\"order\":\"1\",\"name\":\"\\u8bc4\\u8bba\",\"width\":\"\",\"func\":\"comment\"},\"author\":{\"use\":\"1\",\"order\":\"3\",\"name\":\"\\u4f5c\\u8005\",\"width\":\"100\",\"func\":\"author\"},\"inputtime\":{\"use\":\"1\",\"order\":\"4\",\"name\":\"\\u8bc4\\u8bba\\u65f6\\u95f4\",\"width\":\"160\",\"func\":\"datetime\"}},\"flag\":null,\"param\":null,\"search\":{\"use\":\"1\",\"field\":\"title,keywords\",\"total\":\"500\",\"length\":\"4\",\"param_join\":\"-\",\"param_rule\":\"0\",\"param_field\":\"\",\"param_join_field\":[\"\",\"\",\"\",\"\",\"\",\"\",\"\"],\"param_join_default_value\":\"0\"}}', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_module_form`
--

CREATE TABLE `mys_module_form` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '表单名称',
  `table` varchar(50) NOT NULL COMMENT '表单表名称',
  `module` varchar(50) NOT NULL COMMENT '模块目录',
  `disabled` tinyint(1) UNSIGNED NOT NULL COMMENT '是否禁用',
  `setting` text NOT NULL COMMENT '表单配置'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模块表单表';

-- --------------------------------------------------------

--
-- 表的结构 `mys_site`
--

CREATE TABLE `mys_site` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '站点名称',
  `domain` varchar(50) NOT NULL COMMENT '站点域名',
  `setting` text NOT NULL COMMENT '站点配置',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁用？'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='站点表';

--
-- 转存表中的数据 `mys_site`
--

INSERT INTO `mys_site` (`id`, `name`, `domain`, `setting`, `disabled`) VALUES
(1, 'D-shine', 'www.zhubao.com', '{\"webpath\":null,\"config\":{\"SITE_CLOSE\":\"\",\"SITE_CLOSE_MSG\":\"网站升级中....\",\"logo\":\"1\",\"SITE_NAME\":\"D-shine\",\"SITE_COPYRIGHT\":\"Copyright © 2018.Company name All rights reserved.网页模板\",\"SITE_ICP\":\"gff fbg \",\"SITE_TEL\":\"5455455\",\"SITE_PHONE\":\"\",\"SITE_QQ\":\"89789678\",\"SITE_EMAIL\":\"7878575\",\"SITE_ADDRESS\":\"sdssfdfd\",\"SITE_TONGJI\":\"\",\"SITE_LANGUAGE\":\"zh-cn\",\"SITE_TIME_FORMAT\":\"\",\"SITE_THEME\":\"default\",\"SITE_TEMPLATE\":\"default\",\"SITE_TIMEZONE\":\"8\",\"SITE_DOMAIN\":\"www.zhubao.com\",\"SITE_DOMAINS\":\"\"}}', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mys_urlrule`
--

CREATE TABLE `mys_urlrule` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '规则类型',
  `name` varchar(50) NOT NULL COMMENT '规则名称',
  `value` text NOT NULL COMMENT '详细规则'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='URL规则表';

--
-- 转存表中的数据 `mys_urlrule`
--

INSERT INTO `mys_urlrule` (`id`, `type`, `name`, `value`) VALUES
(1, 3, '共享栏目测试规则', '{\"list\":\"list-{dirname}.html\",\"list_page\":\"list-{dirname}-{page}.html\",\"show\":\"show-{id}.html\",\"show_page\":\"show-{id}-{page}.html\",\"catjoin\":\"\\/\"}'),
(2, 2, '共享模块测试规则', '{\"search\":\"{modname}\\/search.html\",\"search_page\":\"{modname}\\/search\\/{param}.html\",\"catjoin\":\"\\/\"}'),
(3, 1, '独立模块测试规则', '{\"module\":\"{modname}.html\",\"list\":\"{modname}\\/list\\/{id}.html\",\"list_page\":\"{modname}\\/list\\/{id}\\/{page}.html\",\"show\":\"{modname}\\/show\\/{id}.html\",\"show_page\":\"{modname}\\/show\\/{id}\\/{page}.html\",\"search\":\"{modname}\\/search.html\",\"search_page\":\"{modname}\\/search\\/{param}.html\",\"catjoin\":\"\\/\"}');

--
-- 转储表的索引
--

--
-- 表的索引 `mys_1_block`
--
ALTER TABLE `mys_1_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`);

--
-- 表的索引 `mys_1_chanpin`
--
ALTER TABLE `mys_1_chanpin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`,`updatetime`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `hits` (`hits`),
  ADD KEY `displayorder` (`displayorder`,`updatetime`);

--
-- 表的索引 `mys_1_chanpin_category`
--
ALTER TABLE `mys_1_chanpin_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show` (`show`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_chanpin_category_data`
--
ALTER TABLE `mys_1_chanpin_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_chanpin_category_data_0`
--
ALTER TABLE `mys_1_chanpin_category_data_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_chanpin_comment`
--
ALTER TABLE `mys_1_chanpin_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `reply` (`reply`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `aa` (`cid`,`status`,`inputtime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_comment_index`
--
ALTER TABLE `mys_1_chanpin_comment_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `tableid` (`tableid`);

--
-- 表的索引 `mys_1_chanpin_data_0`
--
ALTER TABLE `mys_1_chanpin_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_chanpin_draft`
--
ALTER TABLE `mys_1_chanpin_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_flag`
--
ALTER TABLE `mys_1_chanpin_flag`
  ADD KEY `flag` (`flag`,`id`,`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_chanpin_hits`
--
ALTER TABLE `mys_1_chanpin_hits`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `day_hits` (`day_hits`),
  ADD KEY `week_hits` (`week_hits`),
  ADD KEY `month_hits` (`month_hits`),
  ADD KEY `year_hits` (`year_hits`);

--
-- 表的索引 `mys_1_chanpin_index`
--
ALTER TABLE `mys_1_chanpin_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_recycle`
--
ALTER TABLE `mys_1_chanpin_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_search`
--
ALTER TABLE `mys_1_chanpin_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `keyword` (`keyword`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_time`
--
ALTER TABLE `mys_1_chanpin_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `posttime` (`posttime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_chanpin_verify`
--
ALTER TABLE `mys_1_chanpin_verify`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `backuid` (`backuid`);

--
-- 表的索引 `mys_1_form`
--
ALTER TABLE `mys_1_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table` (`table`);

--
-- 表的索引 `mys_1_form_lianxi`
--
ALTER TABLE `mys_1_form_lianxi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `displayorder` (`displayorder`);

--
-- 表的索引 `mys_1_form_lianxi_data_0`
--
ALTER TABLE `mys_1_form_lianxi_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`);

--
-- 表的索引 `mys_1_guanyu`
--
ALTER TABLE `mys_1_guanyu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`,`updatetime`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `hits` (`hits`),
  ADD KEY `displayorder` (`displayorder`,`updatetime`);

--
-- 表的索引 `mys_1_guanyu_category`
--
ALTER TABLE `mys_1_guanyu_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show` (`show`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_guanyu_category_data`
--
ALTER TABLE `mys_1_guanyu_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_guanyu_category_data_0`
--
ALTER TABLE `mys_1_guanyu_category_data_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_guanyu_comment`
--
ALTER TABLE `mys_1_guanyu_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `reply` (`reply`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `aa` (`cid`,`status`,`inputtime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_comment_index`
--
ALTER TABLE `mys_1_guanyu_comment_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `tableid` (`tableid`);

--
-- 表的索引 `mys_1_guanyu_data_0`
--
ALTER TABLE `mys_1_guanyu_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_guanyu_draft`
--
ALTER TABLE `mys_1_guanyu_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_flag`
--
ALTER TABLE `mys_1_guanyu_flag`
  ADD KEY `flag` (`flag`,`id`,`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_guanyu_hits`
--
ALTER TABLE `mys_1_guanyu_hits`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `day_hits` (`day_hits`),
  ADD KEY `week_hits` (`week_hits`),
  ADD KEY `month_hits` (`month_hits`),
  ADD KEY `year_hits` (`year_hits`);

--
-- 表的索引 `mys_1_guanyu_index`
--
ALTER TABLE `mys_1_guanyu_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_recycle`
--
ALTER TABLE `mys_1_guanyu_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_search`
--
ALTER TABLE `mys_1_guanyu_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `keyword` (`keyword`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_time`
--
ALTER TABLE `mys_1_guanyu_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `posttime` (`posttime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_guanyu_verify`
--
ALTER TABLE `mys_1_guanyu_verify`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `backuid` (`backuid`);

--
-- 表的索引 `mys_1_lianxi`
--
ALTER TABLE `mys_1_lianxi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`,`updatetime`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `hits` (`hits`),
  ADD KEY `displayorder` (`displayorder`,`updatetime`);

--
-- 表的索引 `mys_1_lianxi_category`
--
ALTER TABLE `mys_1_lianxi_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show` (`show`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_lianxi_category_data`
--
ALTER TABLE `mys_1_lianxi_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lianxi_category_data_0`
--
ALTER TABLE `mys_1_lianxi_category_data_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lianxi_comment`
--
ALTER TABLE `mys_1_lianxi_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `reply` (`reply`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `aa` (`cid`,`status`,`inputtime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_comment_index`
--
ALTER TABLE `mys_1_lianxi_comment_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `tableid` (`tableid`);

--
-- 表的索引 `mys_1_lianxi_data_0`
--
ALTER TABLE `mys_1_lianxi_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lianxi_draft`
--
ALTER TABLE `mys_1_lianxi_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_flag`
--
ALTER TABLE `mys_1_lianxi_flag`
  ADD KEY `flag` (`flag`,`id`,`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lianxi_hits`
--
ALTER TABLE `mys_1_lianxi_hits`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `day_hits` (`day_hits`),
  ADD KEY `week_hits` (`week_hits`),
  ADD KEY `month_hits` (`month_hits`),
  ADD KEY `year_hits` (`year_hits`);

--
-- 表的索引 `mys_1_lianxi_index`
--
ALTER TABLE `mys_1_lianxi_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_recycle`
--
ALTER TABLE `mys_1_lianxi_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_search`
--
ALTER TABLE `mys_1_lianxi_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `keyword` (`keyword`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_time`
--
ALTER TABLE `mys_1_lianxi_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `posttime` (`posttime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lianxi_verify`
--
ALTER TABLE `mys_1_lianxi_verify`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `backuid` (`backuid`);

--
-- 表的索引 `mys_1_lunbotu`
--
ALTER TABLE `mys_1_lunbotu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`,`updatetime`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `hits` (`hits`),
  ADD KEY `displayorder` (`displayorder`,`updatetime`);

--
-- 表的索引 `mys_1_lunbotu_category`
--
ALTER TABLE `mys_1_lunbotu_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show` (`show`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_lunbotu_category_data`
--
ALTER TABLE `mys_1_lunbotu_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lunbotu_category_data_0`
--
ALTER TABLE `mys_1_lunbotu_category_data_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lunbotu_comment`
--
ALTER TABLE `mys_1_lunbotu_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `reply` (`reply`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `aa` (`cid`,`status`,`inputtime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_comment_index`
--
ALTER TABLE `mys_1_lunbotu_comment_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `tableid` (`tableid`);

--
-- 表的索引 `mys_1_lunbotu_data_0`
--
ALTER TABLE `mys_1_lunbotu_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lunbotu_draft`
--
ALTER TABLE `mys_1_lunbotu_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_flag`
--
ALTER TABLE `mys_1_lunbotu_flag`
  ADD KEY `flag` (`flag`,`id`,`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_lunbotu_hits`
--
ALTER TABLE `mys_1_lunbotu_hits`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `day_hits` (`day_hits`),
  ADD KEY `week_hits` (`week_hits`),
  ADD KEY `month_hits` (`month_hits`),
  ADD KEY `year_hits` (`year_hits`);

--
-- 表的索引 `mys_1_lunbotu_index`
--
ALTER TABLE `mys_1_lunbotu_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_recycle`
--
ALTER TABLE `mys_1_lunbotu_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_search`
--
ALTER TABLE `mys_1_lunbotu_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `keyword` (`keyword`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_time`
--
ALTER TABLE `mys_1_lunbotu_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `posttime` (`posttime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_lunbotu_verify`
--
ALTER TABLE `mys_1_lunbotu_verify`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `backuid` (`backuid`);

--
-- 表的索引 `mys_1_news`
--
ALTER TABLE `mys_1_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`,`updatetime`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `hits` (`hits`),
  ADD KEY `displayorder` (`displayorder`,`updatetime`);

--
-- 表的索引 `mys_1_news_category`
--
ALTER TABLE `mys_1_news_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show` (`show`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_news_category_data`
--
ALTER TABLE `mys_1_news_category_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_news_category_data_0`
--
ALTER TABLE `mys_1_news_category_data_0`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_news_comment`
--
ALTER TABLE `mys_1_news_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `reply` (`reply`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `status` (`status`),
  ADD KEY `aa` (`cid`,`status`,`inputtime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_comment_index`
--
ALTER TABLE `mys_1_news_comment_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `support` (`support`),
  ADD KEY `oppose` (`oppose`),
  ADD KEY `comments` (`comments`),
  ADD KEY `avgsort` (`avgsort`),
  ADD KEY `tableid` (`tableid`);

--
-- 表的索引 `mys_1_news_data_0`
--
ALTER TABLE `mys_1_news_data_0`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_news_draft`
--
ALTER TABLE `mys_1_news_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_flag`
--
ALTER TABLE `mys_1_news_flag`
  ADD KEY `flag` (`flag`,`id`,`uid`),
  ADD KEY `catid` (`catid`);

--
-- 表的索引 `mys_1_news_hits`
--
ALTER TABLE `mys_1_news_hits`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `day_hits` (`day_hits`),
  ADD KEY `week_hits` (`week_hits`),
  ADD KEY `month_hits` (`month_hits`),
  ADD KEY `year_hits` (`year_hits`);

--
-- 表的索引 `mys_1_news_index`
--
ALTER TABLE `mys_1_news_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_recycle`
--
ALTER TABLE `mys_1_news_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_search`
--
ALTER TABLE `mys_1_news_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `keyword` (`keyword`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_time`
--
ALTER TABLE `mys_1_news_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `posttime` (`posttime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_1_news_verify`
--
ALTER TABLE `mys_1_news_verify`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `backuid` (`backuid`);

--
-- 表的索引 `mys_1_share_category`
--
ALTER TABLE `mys_1_share_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mid` (`mid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `show` (`show`),
  ADD KEY `dirname` (`dirname`),
  ADD KEY `module` (`pid`,`displayorder`,`id`);

--
-- 表的索引 `mys_1_share_index`
--
ALTER TABLE `mys_1_share_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mid` (`mid`);

--
-- 表的索引 `mys_admin`
--
ALTER TABLE `mys_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `mys_admin_login`
--
ALTER TABLE `mys_admin_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `loginip` (`loginip`),
  ADD KEY `logintime` (`logintime`);

--
-- 表的索引 `mys_admin_menu`
--
ALTER TABLE `mys_admin_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list` (`pid`),
  ADD KEY `displayorder` (`displayorder`),
  ADD KEY `mark` (`mark`),
  ADD KEY `hidden` (`hidden`),
  ADD KEY `uri` (`uri`);

--
-- 表的索引 `mys_admin_notice`
--
ALTER TABLE `mys_admin_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uri` (`uri`),
  ADD KEY `site` (`site`),
  ADD KEY `status` (`status`),
  ADD KEY `uid` (`uid`),
  ADD KEY `op_uid` (`op_uid`),
  ADD KEY `to_uid` (`to_uid`),
  ADD KEY `to_rid` (`to_rid`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_admin_role`
--
ALTER TABLE `mys_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mys_admin_role_index`
--
ALTER TABLE `mys_admin_role_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `roleid` (`roleid`);

--
-- 表的索引 `mys_admin_verify`
--
ALTER TABLE `mys_admin_verify`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mys_attachment`
--
ALTER TABLE `mys_attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `author` (`author`),
  ADD KEY `relatedtid` (`related`),
  ADD KEY `fileext` (`fileext`),
  ADD KEY `filemd5` (`filemd5`),
  ADD KEY `siteid` (`siteid`);

--
-- 表的索引 `mys_attachment_data`
--
ALTER TABLE `mys_attachment_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `fileext` (`fileext`),
  ADD KEY `remote` (`remote`),
  ADD KEY `author` (`author`),
  ADD KEY `uid` (`uid`);

--
-- 表的索引 `mys_attachment_remote`
--
ALTER TABLE `mys_attachment_remote`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mys_attachment_unused`
--
ALTER TABLE `mys_attachment_unused`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `inputtime` (`inputtime`),
  ADD KEY `fileext` (`fileext`),
  ADD KEY `remote` (`remote`),
  ADD KEY `author` (`author`);

--
-- 表的索引 `mys_cron`
--
ALTER TABLE `mys_cron`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site` (`site`),
  ADD KEY `type` (`type`),
  ADD KEY `status` (`status`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_export`
--
ALTER TABLE `mys_export`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `mys_field`
--
ALTER TABLE `mys_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list` (`relatedid`,`disabled`,`issystem`);

--
-- 表的索引 `mys_linkage`
--
ALTER TABLE `mys_linkage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `module` (`id`);

--
-- 表的索引 `mys_linkage_data_1`
--
ALTER TABLE `mys_linkage_data_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cname` (`cname`),
  ADD KEY `hidden` (`hidden`),
  ADD KEY `list` (`site`,`displayorder`);

--
-- 表的索引 `mys_mail_smtp`
--
ALTER TABLE `mys_mail_smtp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `displayorder` (`displayorder`);

--
-- 表的索引 `mys_member`
--
ALTER TABLE `mys_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`);

--
-- 表的索引 `mys_member_data`
--
ALTER TABLE `mys_member_data`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mys_member_explog`
--
ALTER TABLE `mys_member_explog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `mark` (`mark`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_member_group`
--
ALTER TABLE `mys_member_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `displayorder` (`displayorder`);

--
-- 表的索引 `mys_member_group_index`
--
ALTER TABLE `mys_member_group_index`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `gid` (`gid`);

--
-- 表的索引 `mys_member_group_verify`
--
ALTER TABLE `mys_member_group_verify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `status` (`status`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_member_level`
--
ALTER TABLE `mys_member_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `value` (`value`),
  ADD KEY `apply` (`apply`),
  ADD KEY `gid` (`gid`);

--
-- 表的索引 `mys_member_login`
--
ALTER TABLE `mys_member_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `loginip` (`loginip`),
  ADD KEY `logintime` (`logintime`);

--
-- 表的索引 `mys_member_menu`
--
ALTER TABLE `mys_member_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `mark` (`mark`),
  ADD KEY `hidden` (`hidden`),
  ADD KEY `uri` (`uri`),
  ADD KEY `displayorder` (`displayorder`);

--
-- 表的索引 `mys_member_notice`
--
ALTER TABLE `mys_member_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isnew` (`isnew`),
  ADD KEY `type` (`type`,`uid`);

--
-- 表的索引 `mys_member_oauth`
--
ALTER TABLE `mys_member_oauth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- 表的索引 `mys_member_paylog`
--
ALTER TABLE `mys_member_paylog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `touid` (`touid`),
  ADD KEY `mid` (`mid`),
  ADD KEY `status` (`status`),
  ADD KEY `value` (`value`),
  ADD KEY `paytime` (`paytime`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_member_scorelog`
--
ALTER TABLE `mys_member_scorelog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `mark` (`mark`),
  ADD KEY `inputtime` (`inputtime`);

--
-- 表的索引 `mys_member_setting`
--
ALTER TABLE `mys_member_setting`
  ADD PRIMARY KEY (`name`);

--
-- 表的索引 `mys_module`
--
ALTER TABLE `mys_module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dirname` (`dirname`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `displayorder` (`displayorder`);

--
-- 表的索引 `mys_module_form`
--
ALTER TABLE `mys_module_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table` (`table`),
  ADD KEY `disabled` (`disabled`);

--
-- 表的索引 `mys_site`
--
ALTER TABLE `mys_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- 表的索引 `mys_urlrule`
--
ALTER TABLE `mys_urlrule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `mys_1_block`
--
ALTER TABLE `mys_1_block`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin`
--
ALTER TABLE `mys_1_chanpin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_category`
--
ALTER TABLE `mys_1_chanpin_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_category_data`
--
ALTER TABLE `mys_1_chanpin_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_category_data_0`
--
ALTER TABLE `mys_1_chanpin_category_data_0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_comment`
--
ALTER TABLE `mys_1_chanpin_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID';

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_comment_index`
--
ALTER TABLE `mys_1_chanpin_comment_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_draft`
--
ALTER TABLE `mys_1_chanpin_draft`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_index`
--
ALTER TABLE `mys_1_chanpin_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_recycle`
--
ALTER TABLE `mys_1_chanpin_recycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_chanpin_time`
--
ALTER TABLE `mys_1_chanpin_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_form`
--
ALTER TABLE `mys_1_form`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_1_form_lianxi`
--
ALTER TABLE `mys_1_form_lianxi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu`
--
ALTER TABLE `mys_1_guanyu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_category`
--
ALTER TABLE `mys_1_guanyu_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_category_data`
--
ALTER TABLE `mys_1_guanyu_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_category_data_0`
--
ALTER TABLE `mys_1_guanyu_category_data_0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_comment`
--
ALTER TABLE `mys_1_guanyu_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID';

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_comment_index`
--
ALTER TABLE `mys_1_guanyu_comment_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_draft`
--
ALTER TABLE `mys_1_guanyu_draft`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_index`
--
ALTER TABLE `mys_1_guanyu_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_recycle`
--
ALTER TABLE `mys_1_guanyu_recycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_guanyu_time`
--
ALTER TABLE `mys_1_guanyu_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi`
--
ALTER TABLE `mys_1_lianxi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_category`
--
ALTER TABLE `mys_1_lianxi_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_category_data`
--
ALTER TABLE `mys_1_lianxi_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_category_data_0`
--
ALTER TABLE `mys_1_lianxi_category_data_0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_comment`
--
ALTER TABLE `mys_1_lianxi_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID';

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_comment_index`
--
ALTER TABLE `mys_1_lianxi_comment_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_draft`
--
ALTER TABLE `mys_1_lianxi_draft`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_index`
--
ALTER TABLE `mys_1_lianxi_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_recycle`
--
ALTER TABLE `mys_1_lianxi_recycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lianxi_time`
--
ALTER TABLE `mys_1_lianxi_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu`
--
ALTER TABLE `mys_1_lunbotu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_category`
--
ALTER TABLE `mys_1_lunbotu_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_category_data`
--
ALTER TABLE `mys_1_lunbotu_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_category_data_0`
--
ALTER TABLE `mys_1_lunbotu_category_data_0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_comment`
--
ALTER TABLE `mys_1_lunbotu_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID';

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_comment_index`
--
ALTER TABLE `mys_1_lunbotu_comment_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_draft`
--
ALTER TABLE `mys_1_lunbotu_draft`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_index`
--
ALTER TABLE `mys_1_lunbotu_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_recycle`
--
ALTER TABLE `mys_1_lunbotu_recycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_lunbotu_time`
--
ALTER TABLE `mys_1_lunbotu_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news`
--
ALTER TABLE `mys_1_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `mys_1_news_category`
--
ALTER TABLE `mys_1_news_category`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news_category_data`
--
ALTER TABLE `mys_1_news_category_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news_category_data_0`
--
ALTER TABLE `mys_1_news_category_data_0`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news_comment`
--
ALTER TABLE `mys_1_news_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论ID';

--
-- 使用表AUTO_INCREMENT `mys_1_news_comment_index`
--
ALTER TABLE `mys_1_news_comment_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_1_news_draft`
--
ALTER TABLE `mys_1_news_draft`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news_index`
--
ALTER TABLE `mys_1_news_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `mys_1_news_recycle`
--
ALTER TABLE `mys_1_news_recycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_news_time`
--
ALTER TABLE `mys_1_news_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_1_share_category`
--
ALTER TABLE `mys_1_share_category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `mys_1_share_index`
--
ALTER TABLE `mys_1_share_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `mys_admin`
--
ALTER TABLE `mys_admin`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_admin_login`
--
ALTER TABLE `mys_admin_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `mys_admin_menu`
--
ALTER TABLE `mys_admin_menu`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- 使用表AUTO_INCREMENT `mys_admin_notice`
--
ALTER TABLE `mys_admin_notice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `mys_admin_role`
--
ALTER TABLE `mys_admin_role`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `mys_admin_role_index`
--
ALTER TABLE `mys_admin_role_index`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_admin_verify`
--
ALTER TABLE `mys_admin_verify`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_attachment`
--
ALTER TABLE `mys_attachment`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- 使用表AUTO_INCREMENT `mys_attachment_remote`
--
ALTER TABLE `mys_attachment_remote`
  MODIFY `id` tinyint(2) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_cron`
--
ALTER TABLE `mys_cron`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_export`
--
ALTER TABLE `mys_export`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id';

--
-- 使用表AUTO_INCREMENT `mys_field`
--
ALTER TABLE `mys_field`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用表AUTO_INCREMENT `mys_linkage`
--
ALTER TABLE `mys_linkage`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_linkage_data_1`
--
ALTER TABLE `mys_linkage_data_1`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `mys_mail_smtp`
--
ALTER TABLE `mys_mail_smtp`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member`
--
ALTER TABLE `mys_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_member_data`
--
ALTER TABLE `mys_member_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_member_explog`
--
ALTER TABLE `mys_member_explog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_group`
--
ALTER TABLE `mys_member_group`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_member_group_index`
--
ALTER TABLE `mys_member_group_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_member_group_verify`
--
ALTER TABLE `mys_member_group_verify`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_level`
--
ALTER TABLE `mys_member_level`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_login`
--
ALTER TABLE `mys_member_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_menu`
--
ALTER TABLE `mys_member_menu`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `mys_member_notice`
--
ALTER TABLE `mys_member_notice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_oauth`
--
ALTER TABLE `mys_member_oauth`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_paylog`
--
ALTER TABLE `mys_member_paylog`
  MODIFY `id` bigint(18) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_member_scorelog`
--
ALTER TABLE `mys_member_scorelog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_module`
--
ALTER TABLE `mys_module`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `mys_module_form`
--
ALTER TABLE `mys_module_form`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `mys_site`
--
ALTER TABLE `mys_site`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `mys_urlrule`
--
ALTER TABLE `mys_urlrule`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
