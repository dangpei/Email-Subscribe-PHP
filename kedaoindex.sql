CREATE TABLE `subscribe_email` (
 `ord` int(11) NOT NULL AUTO_INCREMENT,
 `email` text NOT NULL COMMENT 'email��ַ',
 `datetime` datetime NOT NULL COMMENT '����ʱ��',
 `other` text NOT NULL,
 PRIMARY KEY (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='�洢�����ʼ��б�'

CREATE TABLE `temp_ip` (
 `ord` int(11) NOT NULL AUTO_INCREMENT,
 `ipaddress` text NOT NULL,
 `datetime` datetime NOT NULL,
 `other` text NOT NULL,
 PRIMARY KEY (`ord`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8