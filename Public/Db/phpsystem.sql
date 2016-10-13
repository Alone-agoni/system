-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-13 10:46:48
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpsystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_group`
--

CREATE TABLE IF NOT EXISTS `think_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text COMMENT '规则id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `think_auth_group`
--

INSERT INTO `think_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '6,96,20,1,2,3,4,5,64,21,7,8,9,10,11,12,13,14,15,16,123,124,125,19,104,105,106,107,108,118,109,110,111,112,117'),
(2, '产品管理员', 1, '6,96,1,2,3,4,56,57,60,61,63,71,72,65,67,74,75,66,68,69,70,73,77,78,82,83,88,89,90,99,91,92,97,98,104,105,106,107,108,118,109,110,111,112,117,113,114'),
(4, '文章编辑', 1, '6,96,21,19,104,105,106,107,108,118,109,110,111,112,117');

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `think_auth_group_access` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- --------------------------------------------------------

--
-- 表的结构 `think_log`
--

CREATE TABLE IF NOT EXISTS `think_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `logintime` varchar(10) NOT NULL,
  `loginip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='登录日志' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `think_log`
--

INSERT INTO `think_log` (`id`, `userid`, `username`, `logintime`, `loginip`) VALUES
(1, 1, 'only', '1475998723', '127.0.0.1'),
(2, 1, 'only', '1475999197', '127.0.0.1'),
(3, 1, 'only', '1475999846', '127.0.0.1'),
(4, 1, 'only', '1476001909', '127.0.0.1'),
(5, 1, 'only', '1476003246', '127.0.0.1'),
(6, 1, 'only', '1476003299', '127.0.0.1'),
(7, 1, 'only', '1476009024', '127.0.0.1'),
(8, 1, 'only', '1476063012', '127.0.0.1'),
(9, 1, 'only', '1476086409', '127.0.0.1'),
(10, 1, 'only', '1476235537', '127.0.0.1'),
(11, 1, 'only', '1476336496', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `think_menu`
--

CREATE TABLE IF NOT EXISTS `think_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mca` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `think_menu`
--

INSERT INTO `think_menu` (`id`, `pid`, `name`, `mca`, `sort`) VALUES
(1, 0, '系统设置', '#', 0),
(2, 0, '权限控制', '#', 0),
(3, 0, '文章管理', '#', 0),
(4, 1, '菜单管理', 'Admin/Menu/index', 1),
(5, 2, '权限管理', 'Admin/Access/index', 1),
(6, 2, '用户组管理', 'Admin/Group/index', 2),
(7, 2, '管理员列表', 'Admin/User/index', 3),
(8, 3, '文章列表', 'Admin/Article/index', 1);

-- --------------------------------------------------------

--
-- 表的结构 `think_user`
--

CREATE TABLE IF NOT EXISTS `think_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `logintime` varchar(10) NOT NULL COMMENT '登录时间',
  `loginip` varchar(15) NOT NULL COMMENT '登录IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `think_user`
--

INSERT INTO `think_user` (`id`, `username`, `password`, `status`, `logintime`, `loginip`) VALUES
(1, 'only', 'f379eaf3c831b04de153469d1bec345e', 1, '1476336496', '1270.0.01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
