#
# TABLE STRUCTURE FOR: admin_groups
#

DROP TABLE IF EXISTS `admin_groups`;

CREATE TABLE `admin_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES ('1', 'webmaster', 'Webmaster');
INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES ('2', 'admin', 'Administrator');
INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES ('3', 'manager', 'Manager');
INSERT INTO `admin_groups` (`id`, `name`, `description`) VALUES ('4', 'staff', 'Staff');


#
# TABLE STRUCTURE FOR: admin_login_attempts
#

DROP TABLE IF EXISTS `admin_login_attempts`;

CREATE TABLE `admin_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: admin_users
#

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES ('1', '127.0.0.1', 'webmaster', '$2y$08$/X5gzWjesYi78GqeAv5tA.dVGBVP7C1e1PzqnYCVe5s1qhlDIPPES', NULL, 'webmaster@gmail.com', NULL, NULL, NULL, NULL, '1451900190', '1490966215', '1', 'Webmaster', '');
INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES ('2', '127.0.0.1', 'admin', '$2y$08$7Bkco6JXtC3Hu6g9ngLZDuHsFLvT7cyAxiz1FzxlX5vwccvRT7nKW', NULL, 'admin@gmail.com', NULL, NULL, NULL, NULL, '1451900228', '1489447906', '1', 'Admin', '');
INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES ('3', '127.0.0.1', 'manager', '$2y$08$snzIJdFXvg/rSHe0SndIAuvZyjktkjUxBXkrrGdkPy1K6r5r/dMLa', NULL, NULL, NULL, NULL, NULL, NULL, '1451900430', '1465489585', '1', 'Manager', '');
INSERT INTO `admin_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`) VALUES ('4', '127.0.0.1', 'staff', '$2y$08$NigAXjN23CRKllqe3KmjYuWXD5iSRPY812SijlhGeKfkrMKde9da6', NULL, NULL, NULL, NULL, NULL, NULL, '1451900439', '1465489590', '1', 'Staff', '');


#
# TABLE STRUCTURE FOR: admin_users_groups
#

DROP TABLE IF EXISTS `admin_users_groups`;

CREATE TABLE `admin_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES ('1', '1', '1');
INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES ('2', '2', '2');
INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES ('3', '3', '3');
INSERT INTO `admin_users_groups` (`id`, `user_id`, `group_id`) VALUES ('4', '4', '4');


#
# TABLE STRUCTURE FOR: api_access
#

DROP TABLE IF EXISTS `api_access`;

CREATE TABLE `api_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL DEFAULT '',
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: api_keys
#

DROP TABLE IF EXISTS `api_keys`;

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES ('1', '0', 'anonymous', '1', '1', '0', NULL, '1463388382');


#
# TABLE STRUCTURE FOR: api_limits
#

DROP TABLE IF EXISTS `api_limits`;

CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: api_logs
#

DROP TABLE IF EXISTS `api_logs`;

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cobro_hijo` float(9,2) DEFAULT '0.00',
  `cobro_nieto` float(9,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`, `cobro_hijo`, `cobro_nieto`) VALUES ('1', 'Vendedor', 'Vendedor', '0.00', '0.00');
INSERT INTO `groups` (`id`, `name`, `description`, `cobro_hijo`, `cobro_nieto`) VALUES ('2', 'Consumidor', 'Vendedor Consumidor', '12.00', '4.00');


#
# TABLE STRUCTURE FOR: invitations
#

DROP TABLE IF EXISTS `invitations`;

CREATE TABLE `invitations` (
  `id_invitation` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned DEFAULT NULL,
  `to` varchar(45) DEFAULT NULL,
  `message` text,
  `status` tinyint(1) DEFAULT '1' COMMENT '1 = Sent, 2 = Clicked, 3 = Accepted',
  `sent_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_invitation`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1 PACK_KEYS=0;

INSERT INTO `invitations` (`id_invitation`, `id_user`, `to`, `message`, `status`, `sent_at`, `approved_at`) VALUES ('71', '1', 'yunior@gmail.com', 'Bienvenido al SMM', '3', '2017-03-31 15:52:40', '2017-03-31 15:54:56');
INSERT INTO `invitations` (`id_invitation`, `id_user`, `to`, `message`, `status`, `sent_at`, `approved_at`) VALUES ('72', '1', 'walfrido@gmail.com', 'Bienvenido al SMM', '3', '2017-03-31 15:52:40', '2017-03-31 15:53:58');
INSERT INTO `invitations` (`id_invitation`, `id_user`, `to`, `message`, `status`, `sent_at`, `approved_at`) VALUES ('73', '27', 'yunior1@gmail.com', 'Welcome', '3', '2017-03-31 15:59:30', '2017-03-31 16:02:32');
INSERT INTO `invitations` (`id_invitation`, `id_user`, `to`, `message`, `status`, `sent_at`, `approved_at`) VALUES ('74', '27', 'yunior2@gmail.com', 'Welcome', '1', '2017-03-31 15:59:30', NULL);


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: payment
#

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) unsigned DEFAULT NULL,
  `amount` float(9,2) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `payment_history_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 PACK_KEYS=0;

INSERT INTO `payment` (`id_payment`, `id_user`, `amount`, `paid_at`) VALUES ('7', '27', '36.40', '2017-03-31 16:36:52');
INSERT INTO `payment` (`id_payment`, `id_user`, `amount`, `paid_at`) VALUES ('8', '28', '21.60', '2017-03-31 16:36:52');
INSERT INTO `payment` (`id_payment`, `id_user`, `amount`, `paid_at`) VALUES ('9', '29', '51.60', '2017-03-31 16:36:52');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) unsigned DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_dumbu` tinyint(1) DEFAULT '0',
  `dumbu_id` varchar(200) DEFAULT NULL,
  `plan_amount` float(9,2) DEFAULT NULL,
  `monthly_payment` int(11) DEFAULT '0',
  `invitation_code` varchar(32) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `id_parent` (`id_parent`),
  CONSTRAINT `users_fk1` FOREIGN KEY (`id_parent`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('1', NULL, '127.0.0.1', 'info@smm.com', 'super', '$2y$08$TetV28WiqPBFpdOiNd4pMOMhBanWRUyvPYj/kMs6JqNLNB/a.lT2C', NULL, NULL, NULL, NULL, NULL, '1490966451', '1490967190', '1', 'Super', 'Raiz', NULL, '0', NULL, NULL, '0', '0f9d8da5fad1e011ec782fa975e6d096', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('26', NULL, '127.0.0.1', 'walfrido@gmail.com', 'walfrido@gmail.com', '$2y$08$fvuAAJ.nmt/OIQ.SNC5ReOUEjilMu31jfKi4AnltsclMxplkJK8XS', NULL, NULL, NULL, NULL, NULL, '1490968437', '1490968465', '1', 'Walfrido', 'Serrano', NULL, '0', NULL, NULL, '0', '08d493b485f242d31050d82ab08a8d65', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('27', NULL, '127.0.0.1', 'yunior@gmail.com', 'yunior@gmail.com', '$2y$08$CFfA.F4PclhY.vzLPt8Rd.h5aTymjZ4WezP6avomv36yaPsWNDWzC', NULL, NULL, NULL, NULL, NULL, '1490968496', '1490971910', '1', 'Yunior', 'Arias', NULL, '0', NULL, NULL, '0', 'ca549e6e9c22522524fa51ed5ae62139', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('28', '27', '127.0.0.1', 'yunior1@gmail.com', 'yunior1@gmail.com', '$2y$08$qAUdyaSboTvu8VhQVJ9qmuxibT4ApM0e5DbOL31MkCG13rRFNG3k.', NULL, '', NULL, NULL, NULL, '1490968921', NULL, '1', 'Yunior1', '', NULL, '0', '6', '100.00', '1', 'eaf7babad145338eab761b12244eddde', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('29', '27', '127.0.0.1', 'yunior2@gmail.com', 'yunior2@gmail.com', '$2y$08$wJP.jOI9UegUxxWBGXBwme/7/zWAWPey38PT0ABV7zq3XPuGc9KtS', NULL, '', NULL, NULL, NULL, '1490969005', '1490971050', '1', 'Yunior2', '', NULL, '0', '7', '180.00', '1', '714fd0e2f4956dae7ffb9a522c81204f', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('30', '28', '127.0.0.1', 'yunior3@gmail.com', 'yunior3@gmail.com', '$2y$08$DaBTPoDaV2ya72WH3twuL.UFTnmd8pevrgiDzk6Hu5DT8TY9Msbyi', NULL, '', NULL, NULL, NULL, '1490969127', NULL, '1', 'Yunior3', '', NULL, '0', '2', '180.00', '1', '2ad9f09cd03b055e95fb20f78324f292', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('31', '29', '127.0.0.1', 'yunior4@gmail.com', 'yunior4@gmail.com', '$2y$08$9XPB07t1.g0AmVkY9xkO2e1E6Ir39xgYnKE9.x2wvZOQrvH3m5JMy', NULL, '', NULL, NULL, NULL, '1490969407', '1490971809', '1', 'Yunior4', '', NULL, '0', '3', '250.00', '1', '9d062a3c0f005ffed21cbe044bc844ac', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('32', '29', '127.0.0.1', 'yunior5@gmail.com', 'yunior5@gmail.com', '$2y$08$zMJoWYnP5X3w.39.yGb.7.le4yJzargIkUuTa0rSEmtcdaC9zp0AW', NULL, '', NULL, NULL, NULL, '1490969460', '1490971825', '1', 'Yunior5', '', NULL, '0', '4', '180.00', '1', '8f434e54348090cf9be3bc14e25163e4', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('33', '29', '127.0.0.1', 'yunior6@gmail.com', 'yunior6@gmail.com', '$2y$08$8kNGoDQQ1N2kOo0mNtwBA.4xx0LjJSJo83PTYkdfYruqT/JwP9Xi6', NULL, '', NULL, NULL, NULL, '1490969481', NULL, '1', 'Yunior6', '', NULL, '0', NULL, NULL, '0', '598eb95c7451989322076d2f4cf14a37', '0');
INSERT INTO `users` (`id`, `id_parent`, `ip_address`, `email`, `username`, `password`, `salt`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `user_dumbu`, `dumbu_id`, `plan_amount`, `monthly_payment`, `invitation_code`, `deleted`) VALUES ('34', '31', '127.0.0.1', 'yunior7@gmail.com', 'yunior7@gmail.com', '$2y$08$p4cNoPWzW6ENWh52tZMW1ujDqYrtfliMAiaM/zkPA6exQX8imGqe.', NULL, '', NULL, NULL, NULL, '1490969530', NULL, '1', 'Yunior7', '', NULL, '0', NULL, NULL, '0', '3167d63bac731897230ad49efe9e4e86', '0');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('1', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('26', '26', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('27', '27', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('28', '28', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('29', '29', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('30', '30', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('31', '31', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('32', '32', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('33', '33', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('34', '34', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('35', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('36', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('37', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('38', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('39', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('40', '0', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('41', '27', '2');


