


drop table s_goods;
drop table s_store;
drop table s_order;
drop table s_log;
--
-- 数据库: `big`
--

-- --------------------------------------------------------

--
-- 表的结构 `s_goods`
--


CREATE TABLE IF NOT EXISTS `s_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) NOT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- 转存表中的数据 `s_goods`
--


INSERT INTO `s_goods` (`goods_id`, `goods_name`) VALUES
(1,'小米手机');

-- --------------------------------------------------------

--
-- 表的结构 `s_log`
--

CREATE TABLE IF NOT EXISTS `s_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `s_log`
--


-- --------------------------------------------------------

--
-- 表的结构 `s_order`
--

CREATE TABLE IF NOT EXISTS `s_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` char(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `sku_id` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `s_order`
--


-- --------------------------------------------------------

--
-- 表的结构 `s_store`
--

CREATE TABLE IF NOT EXISTS `s_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `sku_id` int(10) unsigned NOT NULL DEFAULT '0',
  `number` int(10) NOT NULL DEFAULT '0',
  `freez` int(11) NOT NULL DEFAULT '0' COMMENT '虚拟库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='库存';

--
-- 转存表中的数据 `s_store`
--

INSERT INTO `s_store` (`id`, `goods_id`, `sku_id`, `number`, `freez`) VALUES
(1, 1, 11, 500, 0);


select * from s_goods;
select * from s_store;
select * from s_order;
select * from s_log;
