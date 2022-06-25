DROP TABLE IF EXISTS `{dbprefix}cron`;
CREATE TABLE IF NOT EXISTS `{dbprefix}cron` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site` int(10) NOT NULL COMMENT '站点',
  `type` varchar(20) NOT NULL COMMENT '类型',
  `value` text NOT NULL COMMENT '参数值',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `error` text DEFAULT NULL COMMENT '错误信息',
  `updatetime` int(10) unsigned NOT NULL COMMENT '执行时间',
  `inputtime` int(10) unsigned NOT NULL COMMENT '写入时间',
  PRIMARY KEY (`id`),
  KEY `site` (`site`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `updatetime` (`updatetime`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='任务管理';

DROP TABLE IF EXISTS `{dbprefix}export`;
CREATE TABLE IF NOT EXISTS `{dbprefix}export` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT '表名称',
  `value` text CHARACTER SET utf8 NOT NULL COMMENT '字段配置项目',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='导出数据字段配置';

DROP TABLE IF EXISTS `{dbprefix}urlrule`;
CREATE TABLE IF NOT EXISTS `{dbprefix}urlrule` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL COMMENT '规则类型',
  `name` varchar(50) NOT NULL COMMENT '规则名称',
  `value` text NOT NULL COMMENT '详细规则',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='URL规则表' ;

DROP TABLE IF EXISTS `{dbprefix}admin`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '管理员uid',
  `setting` Text DEFAULT NULL COMMENT '相关配置',
  `usermenu` text COMMENT '自定义面板菜单，序列化数组格式',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表';

DROP TABLE IF EXISTS `{dbprefix}admin_notice`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_notice` (
  `id` int(10) NOT NULL COMMENT 'id' AUTO_INCREMENT,
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
  `inputtime` int(10) NOT NULL COMMENT '提醒时间',
  PRIMARY KEY (`id`),
  KEY `uri` (`uri`),
  KEY `site` (`site`),
  KEY `status` (`status`),
  KEY `uid` (`uid`),
  KEY `op_uid` (`op_uid`),
  KEY `to_uid` (`to_uid`),
  KEY `to_rid` (`to_rid`),
  KEY `updatetime` (`updatetime`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台提醒表';

DROP TABLE IF EXISTS `{dbprefix}admin_login`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned DEFAULT NULL COMMENT '会员uid',
  `loginip` varchar(50) NOT NULL COMMENT '登录Ip',
  `logintime` int(10) unsigned NOT NULL COMMENT '登录时间',
  `useragent` varchar(255) NOT NULL COMMENT '客户端信息',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `loginip` (`loginip`),
  KEY `logintime` (`logintime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登录日志记录';

DROP TABLE IF EXISTS `{dbprefix}admin_menu`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL COMMENT '上级菜单id',
  `name` text NOT NULL COMMENT '菜单语言名称',
  `uri` varchar(255) DEFAULT NULL COMMENT 'uri字符串',
  `url` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `mark` varchar(255) DEFAULT NULL COMMENT '菜单标识',
  `hidden` tinyint(1) unsigned DEFAULT NULL COMMENT '是否隐藏',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标标示',
  `displayorder` int(5) DEFAULT NULL COMMENT '排序值',
  PRIMARY KEY (`id`),
  KEY `list` (`pid`),
  KEY `displayorder` (`displayorder`),
  KEY `mark` (`mark`),
  KEY `hidden` (`hidden`),
  KEY `uri` (`uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

INSERT INTO `{dbprefix}admin_menu` (`id`, `pid`, `name`, `uri`, `url`, `mark`, `hidden`, `icon`, `displayorder`) VALUES
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
(110, 67, '文章评论', 'news/comment_verify/index', '', 'verify-comment-news', 0, 'fa fa-comments', -1);


DROP TABLE IF EXISTS `{dbprefix}admin_role`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_role` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `site` text NOT NULL COMMENT '允许管理的站点，序列化数组格式',
  `name` text NOT NULL COMMENT '角色组语言名称',
  `system` text NOT NULL COMMENT '系统权限',
  `module` text NOT NULL COMMENT '模块权限',
  `application` text NOT NULL COMMENT '应用权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台角色权限表';

DROP TABLE IF EXISTS `{dbprefix}admin_role_index`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_role_index` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned DEFAULT NULL COMMENT '会员uid',
  `roleid` mediumint(8) unsigned DEFAULT NULL COMMENT '角色组id',
  PRIMARY KEY (`id`),
  KEY (`uid`),
  KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台角色组分配表';

DROP TABLE IF EXISTS `{dbprefix}admin_verify`;
CREATE TABLE IF NOT EXISTS `{dbprefix}admin_verify` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '名称',
  `verify` text NOT NULL COMMENT '审核部署',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='审核管理表';

DROP TABLE IF EXISTS `{dbprefix}mail_smtp`;
CREATE TABLE IF NOT EXISTS `{dbprefix}mail_smtp` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `host` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `port` mediumint(8) unsigned NOT NULL,
  `displayorder` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='邮件账户表';

DROP TABLE IF EXISTS `{dbprefix}attachment`;
CREATE TABLE IF NOT EXISTS `{dbprefix}attachment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `siteid` mediumint(5) unsigned NOT NULL COMMENT '站点id',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `tableid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '附件副表id',
  `download` mediumint(8) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `filesize` int(10) unsigned NOT NULL COMMENT '文件大小',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filemd5` varchar(50) NOT NULL COMMENT '文件md5值',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `author` (`author`),
  KEY `relatedtid` (`related`),
  KEY `fileext` (`fileext`),
  KEY `filemd5` (`filemd5`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件表';

DROP TABLE IF EXISTS `{dbprefix}attachment_remote`;
CREATE TABLE IF NOT EXISTS `{dbprefix}attachment_remote` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '类型',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `url` varchar(255) NOT NULL COMMENT '访问地址',
  `value` text NOT NULL COMMENT '参数值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='远程附件表';

DROP TABLE IF EXISTS `{dbprefix}attachment_data`;
CREATE TABLE IF NOT EXISTS `{dbprefix}attachment_data` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `related` varchar(50) NOT NULL COMMENT '相关表标识',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `inputtime` (`inputtime`),
  KEY `fileext` (`fileext`),
  KEY `remote` (`remote`),
  KEY `author` (`author`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件已归档表';

DROP TABLE IF EXISTS `{dbprefix}attachment_unused`;
CREATE TABLE IF NOT EXISTS `{dbprefix}attachment_unused` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '附件id',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `author` varchar(50) NOT NULL COMMENT '会员',
  `siteid` mediumint(5) unsigned NOT NULL COMMENT '站点id',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fileext` varchar(20) NOT NULL COMMENT '文件扩展名',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器路径',
  `remote` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '远程附件id',
  `attachinfo` text NOT NULL COMMENT '附件信息',
  `inputtime` int(10) unsigned NOT NULL COMMENT '入库时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `inputtime` (`inputtime`),
  KEY `fileext` (`fileext`),
  KEY `remote` (`remote`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='未使用的附件表';

DROP TABLE IF EXISTS `{dbprefix}field`;
CREATE TABLE IF NOT EXISTS `{dbprefix}field` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '字段别名语言',
  `fieldname` varchar(50) NOT NULL COMMENT '字段名称',
  `fieldtype` varchar(50) NOT NULL COMMENT '字段类型',
  `relatedid` smallint(5) unsigned NOT NULL COMMENT '相关id',
  `relatedname` varchar(50) NOT NULL COMMENT '相关表',
  `isedit` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可修改',
  `ismain` tinyint(1) unsigned NOT NULL COMMENT '是否主表',
  `issystem` tinyint(1) unsigned NOT NULL COMMENT '是否系统表',
  `ismember` tinyint(1) unsigned NOT NULL COMMENT '是否会员可见',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可搜索',
  `disabled` tinyint(1) unsigned NOT NULL COMMENT '禁用？',
  `setting` text NOT NULL COMMENT '配置信息',
  `displayorder` int(5) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `list` (`relatedid`,`disabled`,`issystem`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='字段表';

DROP TABLE IF EXISTS `{dbprefix}linkage`;
CREATE TABLE IF NOT EXISTS `{dbprefix}linkage` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '菜单名称',
  `type` tinyint(1) unsigned NOT NULL,
  `code` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `module` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='联动菜单表';

DROP TABLE IF EXISTS `{dbprefix}linkage_data_1`;
CREATE TABLE IF NOT EXISTS `{dbprefix}linkage_data_1` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site` mediumint(5) unsigned NOT NULL COMMENT '站点id',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `pids` varchar(255) DEFAULT NULL COMMENT '所有上级id',
  `name` varchar(30) NOT NULL COMMENT '栏目名称',
  `cname` varchar(30) NOT NULL COMMENT '别名',
  `child` tinyint(1) unsigned DEFAULT NULL DEFAULT '0' COMMENT '是否有下级',
  `hidden` tinyint(1) unsigned DEFAULT NULL DEFAULT '0' COMMENT '前端隐藏',
  `childids` text DEFAULT NULL COMMENT '下级所有id',
  `displayorder` mediumint(8) DEFAULT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cname` (`cname`),
  KEY `hidden` (`hidden`),
  KEY `list` (`site`,`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='联动菜单数据表';

DROP TABLE IF EXISTS `{dbprefix}module`;
CREATE TABLE IF NOT EXISTS `{dbprefix}module` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `site` text NULL COMMENT '站点划分',
  `dirname` varchar(50) NOT NULL COMMENT '目录名称',
  `share` tinyint(1) unsigned DEFAULT NULL COMMENT '是否共享模块',
  `setting` text NULL COMMENT '配置信息',
  `comment` text NULL COMMENT '评论信息',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁用？',
  `displayorder` smallint(5) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dirname` (`dirname`),
  KEY `disabled` (`disabled`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模块表';

DROP TABLE IF EXISTS `{dbprefix}module_form`;
CREATE TABLE IF NOT EXISTS `{dbprefix}module_form` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '表单名称',
  `table` varchar(50) NOT NULL COMMENT '表单表名称',
  `module` varchar(50) NOT NULL COMMENT '模块目录',
  `disabled` tinyint(1) unsigned NOT NULL COMMENT '是否禁用',
  `setting` text NOT NULL COMMENT '表单配置',
  PRIMARY KEY (`id`),
  KEY `table` (`table`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模块表单表';

DROP TABLE IF EXISTS `{dbprefix}site`;
CREATE TABLE IF NOT EXISTS `{dbprefix}site` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '站点名称',
  `domain` varchar(50) NOT NULL COMMENT '站点域名',
  `setting` text NOT NULL COMMENT '站点配置',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT '禁用？',
  PRIMARY KEY (`id`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='站点表';

DROP TABLE IF EXISTS `{dbprefix}member`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(50) NOT NULL DEFAULT '' COMMENT '邮箱地址',
  `phone` char(20) NOT NULL COMMENT '手机号码',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '加密密码',
  `salt` char(10) NOT NULL COMMENT '随机加密码',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `money` decimal(10,2) unsigned NOT NULL COMMENT 'RMB',
  `freeze` decimal(10,2) unsigned NOT NULL COMMENT '冻结RMB',
  `spend` decimal(10,2) unsigned NOT NULL COMMENT '消费RMB总额',
  `score` int(10) unsigned NOT NULL COMMENT '虚拟币',
  `experience` int(10) unsigned NOT NULL COMMENT '经验值',
  `regip` varchar(50) NOT NULL COMMENT '注册ip',
  `regtime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `randcode` mediumint(6) unsigned NOT NULL COMMENT '随机验证码',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表';

DROP TABLE IF EXISTS `{dbprefix}member_data`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) unsigned DEFAULT 0 COMMENT '是否是管理员',
  `is_lock` tinyint(1) unsigned DEFAULT 0 COMMENT '账号锁定标识',
  `is_auth` tinyint(1) unsigned DEFAULT 0 COMMENT '实名认证标识',
  `is_verify` tinyint(1) unsigned DEFAULT 0 COMMENT '审核标识',
  `is_mobile` tinyint(1) unsigned DEFAULT 0 COMMENT '手机认证标识',
  `is_avatar` tinyint(1) unsigned DEFAULT 0 COMMENT '头像上传标识',
  `is_complete` tinyint(1) unsigned DEFAULT 0 COMMENT '完善资料标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员表';

DROP TABLE IF EXISTS `{dbprefix}member_login`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned DEFAULT NULL COMMENT '会员uid',
  `type` varchar(30) NOT NULL COMMENT '登录方式',
  `loginip` varchar(50) NOT NULL COMMENT '登录Ip',
  `logintime` int(10) unsigned NOT NULL COMMENT '登录时间',
  `useragent` varchar(255) NOT NULL COMMENT '客户端信息',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `loginip` (`loginip`),
  KEY `logintime` (`logintime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登录日志记录';


DROP TABLE IF EXISTS `{dbprefix}member_group`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT '用户组名称',
  `price` decimal(10,2) NOT NULL COMMENT '售价',
  `unit` tinyint(1) unsigned NOT NULL COMMENT '价格单位:1虚拟币，0金钱',
  `days` int(10) unsigned NOT NULL COMMENT '生效天数',
  `apply` tinyint(1) unsigned NOT NULL COMMENT '是否申请',
  `register` tinyint(1) unsigned NOT NULL COMMENT '是否允许注册',
  `setting` text NOT NULL COMMENT '用户组配置',
  `displayorder` smallint(5) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组表';

DROP TABLE IF EXISTS `{dbprefix}member_level`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_level` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `gid` smallint(5) unsigned NOT NULL COMMENT '用户id',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `stars` tinyint(2) NOT NULL COMMENT '星星数量',
  `value` int(10) unsigned NOT NULL COMMENT '升级值要求',
  `note` text NOT NULL COMMENT '备注',
  `apply` tinyint(1) unsigned NOT NULL COMMENT '是否允许升级',
  PRIMARY KEY (`id`),
  KEY `value` (`value`),
  KEY `apply` (`apply`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组级别表';

DROP TABLE IF EXISTS `{dbprefix}member_group_index`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_group_index` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `gid` smallint(5) unsigned NOT NULL COMMENT '用户组id',
  `lid` smallint(5) unsigned NOT NULL COMMENT '用户组等级id',
  `stime` int(10) unsigned NOT NULL COMMENT '开通时间',
  `etime` int(10) unsigned NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `lid` (`lid`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组归属表';

DROP TABLE IF EXISTS `{dbprefix}member_group_verify`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_group_verify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `gid` smallint(5) unsigned NOT NULL COMMENT '用户组id',
  `lid` smallint(5) unsigned NOT NULL COMMENT '用户组等级id',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '自定义字段信息',
  `inputtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `status` (`status`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组申请审核';

DROP TABLE IF EXISTS `{dbprefix}member_setting`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_setting` (
  `name` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户属性参数表';

DROP TABLE IF EXISTS `{dbprefix}member_menu`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL COMMENT '上级菜单id',
  `name` text NOT NULL COMMENT '菜单语言名称',
  `uri` varchar(255) DEFAULT NULL COMMENT 'uri字符串',
  `url` varchar(255) DEFAULT NULL COMMENT '外链地址',
  `mark` varchar(20) DEFAULT NULL COMMENT '菜单标识',
  `hidden` tinyint(1) unsigned DEFAULT NULL COMMENT '是否隐藏',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标标示',
  `group` text NOT NULL COMMENT '用户组划分',
  `site` text NOT NULL COMMENT '站点划分',
  `displayorder` int(5) DEFAULT NULL COMMENT '排序值',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `mark` (`mark`),
  KEY `hidden` (`hidden`),
  KEY `uri` (`uri`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组菜单表';

DROP TABLE IF EXISTS `{dbprefix}member_oauth`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_oauth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL COMMENT '会员uid',
  `oid` varchar(255) NOT NULL COMMENT 'OAuth返回id',
  `oauth` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `expire_at` int(10) unsigned NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户OAuth授权表';

DROP TABLE IF EXISTS `{dbprefix}member_paylog`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_paylog` (
  `id` bigint(18) unsigned NOT NULL AUTO_INCREMENT,
  `site` int(10) NOT NULL COMMENT '站点',
  `mid` varchar(100) NOT NULL COMMENT '支付标识',
  `uid` int(10) unsigned NOT NULL COMMENT '付款人',
  `username` varchar(50) NOT NULL COMMENT '付款账号',
  `touid` int(10) unsigned DEFAULT 0 COMMENT '收款人',
  `tousername` varchar(50) DEFAULT NULL COMMENT '收款人账号',
  `title` varchar(255) NOT NULL COMMENT '支付标题',
  `url` varchar(255) NOT NULL COMMENT '相关链接',
  `value` decimal(10,2) NOT NULL COMMENT '支付金额',
  `type` varchar(20) NOT NULL COMMENT '支付方式',
  `status` tinyint(1) unsigned NOT NULL COMMENT '支付状态',
  `result` text NOT NULL COMMENT '支付结果',
  `paytime` int(10) unsigned NOT NULL COMMENT '支付时间',
  `inputtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `touid` (`touid`),
  KEY `mid` (`mid`),
  KEY `status` (`status`),
  KEY `value` (`value`),
  KEY `paytime` (`paytime`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户支付记录表';


DROP TABLE IF EXISTS `{dbprefix}member_notice`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL COMMENT '类型',
  `uid` mediumint(8) unsigned NOT NULL COMMENT '通知者uid',
  `isnew` tinyint(1) unsigned NOT NULL COMMENT '新提醒',
  `content` text NOT NULL COMMENT '通知内容',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) unsigned NOT NULL COMMENT '提交时间',
  PRIMARY KEY (`id`),
  KEY (`isnew`),
  KEY `type` (`type`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员通知提醒表';

DROP TABLE IF EXISTS `{dbprefix}member_scorelog`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_scorelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '账号',
  `value` int(10) NOT NULL COMMENT '分数变化值',
  `mark` varchar(50) NOT NULL COMMENT '标记',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `mark` (`mark`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='金币流水日志';

DROP TABLE IF EXISTS `{dbprefix}member_explog`;
CREATE TABLE IF NOT EXISTS `{dbprefix}member_explog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL COMMENT '账号',
  `value` int(10) NOT NULL COMMENT '分数变化值',
  `mark` varchar(50) NOT NULL COMMENT '标记',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `url` varchar(255) NOT NULL COMMENT '相关地址',
  `inputtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `mark` (`mark`),
  KEY `inputtime` (`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='经验值流水日志';

REPLACE INTO `{dbprefix}admin_role` VALUES(1, '', '超级管理员', '', '', '');
REPLACE INTO `{dbprefix}admin_role` VALUES(2, '', '网站编辑员', '', '', '');
REPLACE INTO `{dbprefix}linkage` VALUES(1, '中国地区', 0, 'address');
REPLACE INTO `{dbprefix}linkage_data_1` VALUES(1, 1, 0, '0', '北京', 'bj', 0, 0, '1', 0);
REPLACE INTO `{dbprefix}linkage_data_1` VALUES(2, 1, 0, '0', '成都', 'cd', 0, 0, '2', 0);
REPLACE INTO `{dbprefix}admin_verify` VALUES(1, '默认审核', '{"edit":"1","role":{"1":"2"}}');