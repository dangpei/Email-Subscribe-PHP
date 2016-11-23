CREATE TABLE `subscribe_email` (
 `ord` int(11) NOT NULL AUTO_INCREMENT,
 `email` text NOT NULL COMMENT 'email地址',
 `datetime` datetime NOT NULL COMMENT '订阅时间',
 `other` text NOT NULL,
 PRIMARY KEY (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='存储订阅邮件列表'

CREATE TABLE `temp_ip` (
 `ord` int(11) NOT NULL AUTO_INCREMENT,
 `ipaddress` text NOT NULL,
 `datetime` datetime NOT NULL,
 `other` text NOT NULL,
 PRIMARY KEY (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8