-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-27 07:48:22
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `think_auth_group`
--

INSERT INTO `think_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '6,147,148,20,1,3,4,5,132,133,143,144,21,7,8,9,10,134,135,136,137,11,12,13,14,15,138,139,140,19,129,130,131,141,142,104,105,145,146,149,150,151,152,153,154,155,156'),
(2, '产品管理员', 1, '6,20,1,3,4,5,132,133,143,144'),
(4, '文章编辑', 1, '6,104,105,145,146');

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

--
-- 转存表中的数据 `think_auth_group_access`
--

INSERT INTO `think_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(7, 2),
(8, 4);

-- --------------------------------------------------------

--
-- 表的结构 `think_auth_rule`
--

CREATE TABLE IF NOT EXISTS `think_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：为1正常，为0禁用',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规则表' AUTO_INCREMENT=157 ;

--
-- 转存表中的数据 `think_auth_rule`
--

INSERT INTO `think_auth_rule` (`id`, `pid`, `name`, `title`, `status`, `type`, `condition`) VALUES
(1, 20, 'Admin/Menu/index', '菜单管理', 1, 1, ''),
(142, 19, 'Admin/User/update', '修改管理员', 1, 1, ''),
(3, 1, 'Admin/Menu/create', '添加菜单视图', 1, 1, ''),
(4, 1, 'Admin/Menu/edit', '修改菜单视图', 1, 1, ''),
(5, 1, 'Admin/Menu/destory', '删除菜单', 1, 1, ''),
(21, 0, '2', '权限控制', 1, 1, ''),
(7, 21, 'Admin/AuthRule/index', '权限管理', 1, 1, ''),
(8, 7, 'Admin/AuthRule/create', '添加权限视图', 1, 1, ''),
(9, 7, 'Admin/AuthRule/edit', '修改权限视图', 1, 1, ''),
(10, 7, 'Admin/AuthRule/destory', '删除权限', 1, 1, ''),
(11, 21, 'Admin/AuthGroup/index', '用户组管理', 1, 1, ''),
(12, 11, 'Admin/AuthGroup/create', '添加用户组视图', 1, 1, ''),
(13, 11, 'Admin/AuthGroup/edit', '修改用户组视图', 1, 1, ''),
(14, 11, 'Admin/AuthGroup/destory', '删除用户组', 1, 1, ''),
(15, 11, 'Admin/AuthGroup/access', '分配权限视图', 1, 1, ''),
(141, 19, 'Admin/User/store', '添加管理员', 1, 1, ''),
(19, 21, 'Admin/User/index', '管理员列表', 1, 1, ''),
(20, 0, '1', '系统设置', 1, 1, ''),
(6, 0, 'Admin/Index/index', '后台首页', 1, 1, ''),
(144, 1, 'Admin/Menu/store_sub', '添加子菜单', 1, 1, ''),
(143, 1, 'Admin/Menu/create_sub', '添加子菜单视图', 1, 1, ''),
(104, 0, '3', '文章管理', 1, 1, ''),
(105, 104, 'Admin/Article/index', '文章列表', 1, 1, ''),
(132, 1, 'Admin/Menu/store', '添加菜单', 1, 1, ''),
(133, 1, 'Admin/Menu/update', '修改菜单', 1, 1, ''),
(134, 7, 'Admin/AuthRule/store', '添加权限', 1, 1, ''),
(136, 7, 'Admin/AuthRule/create_sub', '添加子权限视图', 1, 1, ''),
(140, 11, 'Admin/AuthGroup/access_store', '分配权限', 1, 1, ''),
(139, 11, 'Admin/AuthGroup/update', '修改用户组', 1, 1, ''),
(138, 11, 'Admin/AuthGroup/store', '添加用户组', 1, 1, ''),
(137, 7, 'Admin/AuthRule/store_sub', '添加子权限', 1, 1, ''),
(135, 7, 'Admin/AuthRule/update', '修改权限', 1, 1, ''),
(131, 19, 'Admin/User/destory', '删除管理员', 1, 1, ''),
(130, 19, 'Admin/User/edit', '修改管理员视图', 1, 1, ''),
(129, 19, 'Admin/User/create', '添加管理员视图', 1, 1, ''),
(145, 0, '4', '功能整合', 1, 1, ''),
(146, 145, 'Admin/Func/qrcode', '生成二维码', 1, 1, ''),
(147, 6, 'Admin/Index/create_model', '自动创建模型', 1, 1, ''),
(148, 6, 'Admin/Index/create_controller', '创建控制器视图', 1, 1, ''),
(149, 145, 'Admin/Func/export_excel', '导入导出Excel、Csv', 1, 1, ''),
(150, 149, 'Admin/Func/export_xls', '导出Excel', 1, 1, ''),
(151, 149, 'Admin/Func/export_csv', '导出Csv', 1, 1, ''),
(152, 149, 'Admin/Func/import_xls', '导入Excel', 1, 1, ''),
(153, 149, 'Admin/Func/import_csv', '导入csv', 1, 1, ''),
(154, 145, 'Admin/Func/pdf', '生成pdf', 1, 1, ''),
(155, 145, 'Admin/Func/send_email', '发送邮件', 1, 1, ''),
(156, 145, 'Admin/Func/geetest_check', '滑动验证码', 1, 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='登录日志' AUTO_INCREMENT=37 ;

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
(11, 1, 'only', '1476336496', '127.0.0.1'),
(12, 1, 'only', '1477193777', '127.0.0.1'),
(13, 1, 'only', '1477227131', '127.0.0.1'),
(14, 1, 'only', '1477274229', '127.0.0.1'),
(15, 7, 'admin', '1477287029', '127.0.0.1'),
(16, 1, 'only', '1477287106', '127.0.0.1'),
(17, 7, 'admin', '1477287286', '127.0.0.1'),
(18, 7, 'admin', '1477287516', '127.0.0.1'),
(19, 7, 'admin', '1477287726', '127.0.0.1'),
(20, 7, 'admin', '1477287741', '127.0.0.1'),
(21, 1, 'only', '1477288911', '127.0.0.1'),
(22, 1, 'only', '1477289278', '127.0.0.1'),
(23, 7, 'admin', '1477289304', '127.0.0.1'),
(24, 1, 'only', '1477290376', '127.0.0.1'),
(25, 7, 'admin', '1477292247', '127.0.0.1'),
(26, 1, 'only', '1477293437', '127.0.0.1'),
(27, 7, 'admin', '1477295163', '127.0.0.1'),
(28, 1, 'only', '1477295295', '127.0.0.1'),
(29, 7, 'admin', '1477296077', '127.0.0.1'),
(30, 1, 'only', '1477296239', '127.0.0.1'),
(31, 8, 'editor', '1477315368', '127.0.0.1'),
(32, 1, 'only', '1477315394', '127.0.0.1'),
(33, 1, 'only', '1477368530', '127.0.0.1'),
(34, 1, 'only', '1477382747', '127.0.0.1'),
(35, 1, 'only', '1477449425', '127.0.0.1'),
(36, 1, 'only', '1477546666', '127.0.0.1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `think_menu`
--

INSERT INTO `think_menu` (`id`, `pid`, `name`, `mca`, `sort`) VALUES
(1, 0, '系统设置', '1', 0),
(2, 0, '权限控制', '2', 0),
(3, 0, '文章管理', '3', 0),
(4, 1, '菜单管理', 'Admin/Menu/index', 1),
(5, 2, '权限管理', 'Admin/AuthRule/index', 1),
(6, 2, '用户组管理', 'Admin/AuthGroup/index', 2),
(7, 2, '管理员列表', 'Admin/User/index', 3),
(8, 3, '文章列表', 'Admin/Article/index', 1),
(9, 0, '功能整合', '4', 0),
(10, 9, '生成二维码', 'Admin/Func/qrcode', 1),
(11, 9, '导入导出Excel、Csv', 'Admin/Func/export_excel', 2),
(12, 9, '生成Pdf', 'Admin/Func/pdf', 3),
(13, 9, '发送邮件', 'Admin/Func/send_email', 4),
(14, 9, '滑动验证码', 'Admin/Func/geetest_check', 5);

-- --------------------------------------------------------

--
-- 表的结构 `think_rongyun_user`
--

CREATE TABLE IF NOT EXISTS `think_rongyun_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `face` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `access_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- 转存表中的数据 `think_rongyun_user`
--

INSERT INTO `think_rongyun_user` (`id`, `name`, `password`, `face`, `access_token`) VALUES
(88, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '/Uploads/face/user1.jpg', 'xKX+KpWmnQv9thlk5DW7cyQmKe0yMO+J4U8bCkk5syr0+u7ZUQaW2RkQuljH0YuC7+IEQhInCd6yjyGI3e3g6w=='),
(89, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', '/Uploads/face/user2.jpg', 'EgdHN0UKGWeIQQjcXoClMiQmKe0yMO+J4U8bCkk5syr0+u7ZUQaW2Q/uXCbiZp5yAAUQwqJ6yy2yjyGI3e3g6w==');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `think_user`
--

INSERT INTO `think_user` (`id`, `username`, `password`, `status`, `logintime`, `loginip`) VALUES
(1, 'only', 'f379eaf3c831b04de153469d1bec345e', 1, '1477546666', '1270.0.01'),
(7, 'admin', 'f379eaf3c831b04de153469d1bec345e', 1, '1477296077', ''),
(8, 'editor', 'f379eaf3c831b04de153469d1bec345e', 1, '1477315368', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
