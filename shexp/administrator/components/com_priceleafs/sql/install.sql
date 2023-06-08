CREATE TABLE IF NOT EXISTS `#__priceleaf_razdel`
(`id` int(10) unsigned NOT NULL auto_increment,
`raz` int(10) NOT NULL default 1,
`name` varchar(255) NOT NULL default 'Пример раздел 1',
`text` text,
`vote_raz` varchar(255) NOT NULL default '1',
`state` varchar(255) NOT NULL default '1',
`ordering` int(11) NOT NULL default 1,
PRIMARY KEY (`id`)
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;

CREATE TABLE IF NOT EXISTS `#__priceleaf_cat` 
(`id` int( 10 ) unsigned NOT NULL auto_increment,
`raz_cat` int( 10 ) NOT NULL default 1,
`name_cat` varchar( 255 ) NOT NULL default 'Пример категория 1',
`state` varchar(255) NOT NULL default '1',
`ordering` int(11) NOT NULL default 1,
PRIMARY KEY ( `id` ) 
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;

CREATE TABLE IF NOT EXISTS `#__priceleaf_na`
(`id` int( 10 ) unsigned NOT NULL auto_increment,
`cat_naimenovanie` int( 10 ) NOT NULL default 1,
`name` varchar( 255 ) NOT NULL default 'Пример наименование 1',
`opisanie` text,
`cena` varchar( 255 ) NOT NULL default 1,
`cena1` varchar( 255 ) NOT NULL default 1,
`cena2` varchar( 255 ) NOT NULL default 1,
`cena3` varchar( 255 ) NOT NULL default 1,
`cena4` varchar( 255 ) NOT NULL default 1,
`cena5` varchar( 255 ) NOT NULL default 1,
`cena6` varchar( 255 ) NOT NULL default 1,
`cena7` varchar( 255 ) NOT NULL default 1,
`cena8` varchar( 255 ) NOT NULL default 1,
`cena9` varchar( 255 ) NOT NULL default 1,
`radio1` varchar( 255 ) NOT NULL default 1,
`radio2` varchar( 255 ) NOT NULL default 1,
`radio3` varchar( 255 ) NOT NULL default 1,
`radio4` varchar( 255 ) NOT NULL default 1,
`radio5` varchar( 255 ) NOT NULL default 1,
`radio6` varchar( 255 ) NOT NULL default 1,
`radio7` varchar( 255 ) NOT NULL default 1,
`radio8` varchar( 255 ) NOT NULL default 1,
`radio9` varchar( 255 ) NOT NULL default 1,
`radio10` varchar( 255 ) NOT NULL default 1,
`optional_field1` varchar( 255 ) NOT NULL default 1,
`optional_field2` varchar( 255 ) NOT NULL default 1,
`optional_field3` varchar( 255 ) NOT NULL default 1,
`optional_field4` varchar( 255 ) NOT NULL default 1,
`optional_field5` varchar( 255 ) NOT NULL default 1,
`optional_field6` varchar( 255 ) NOT NULL default 1,
`optional_field7` varchar( 255 ) NOT NULL default 1,
`optional_field8` varchar( 255 ) NOT NULL default 1,
`optional_field9` varchar( 255 ) NOT NULL default 1,
`optional_field10` varchar( 255 ) NOT NULL default 1,
`optional_description1` varchar( 255 ) NOT NULL default 1,
`optional_description2` varchar( 255 ) NOT NULL default 1,
`optional_description3` varchar( 255 ) NOT NULL default 1,
`optional_description4` varchar( 255 ) NOT NULL default 1,
`optional_description5` varchar( 255 ) NOT NULL default 1,
`optional_description6` varchar( 255 ) NOT NULL default 1,
`optional_description7` varchar( 255 ) NOT NULL default 1,
`optional_description8` varchar( 255 ) NOT NULL default 1,
`optional_description9` varchar( 255 ) NOT NULL default 1,
`optional_description10` varchar( 255 ) NOT NULL default 1,
`state` varchar(255) NOT NULL default '1',
`ordering` int(11) NOT NULL default 1,
`opredelenie` varchar( 255 ) NOT NULL default 0,
`edizm` varchar( 255 ) NOT NULL default '',
`total_tovar` varchar( 255 ) NOT NULL default '1',
`pereopredelenie` varchar(255) NOT NULL default '',
`old` varchar(255) NOT NULL default '',
`minus` varchar( 255 ) NOT NULL default '1',
`plus` varchar( 255 ) NOT NULL default '1',
PRIMARY KEY (`id`)
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;

CREATE TABLE IF NOT EXISTS `#__priceleaf_option`
(`id` INT( 10 ) NOT NULL AUTO_INCREMENT ,
`valuta` VARCHAR( 20 ) default 'руб.',
`spoiler` VARCHAR( 255 ) default 0,
`state` varchar(255) NOT NULL default '1',
`ordering` int(11) NOT NULL default 1,
`mail` varchar(255) NOT NULL ,
`percent` varchar(10) NOT NULL default '1',
`percent_number` varchar(10) NOT NULL default '10',
`percent_bill` varchar(10) NOT NULL default '99',
`percent_order` varchar(255) NOT NULL default 'При заказе свыше 99 рублей скидка ',
`forma` varchar(10) NOT NULL default '1',
`total_sum` varchar(255) NOT NULL default '0',
`stoimost` varchar(255) NOT NULL default '',
`col` varchar(255) NOT NULL default '',
`pechat` varchar(255) NOT NULL default '',
`pechat_duble` varchar(255) NOT NULL default '',
`merchant_id` varchar(255) NOT NULL default '',
`currency_id` varchar(255) NOT NULL default '',
`description` varchar(255) NOT NULL default '',
`success_url` varchar(255) NOT NULL default '',
`fail_url` varchar(255) NOT NULL default '',
`payment_state` varchar(255) NOT NULL default '',
`simbol` varchar(1) NOT NULL default '',
`from` varchar(255) NOT NULL default '',
`vote` varchar(255) NOT NULL default '',
`captcha` varchar(255) NOT NULL default '',
`icons` varchar(255) NOT NULL default '',
`more_options` varchar(255) NOT NULL default '',
`status` varchar(255) NOT NULL default '',
PRIMARY KEY ( `id` ) 
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;

CREATE TABLE IF NOT EXISTS `#__priceleaf_zakaz` 
(`id` int( 10 ) unsigned NOT NULL auto_increment,
`zapisvbd` text,
`pojta` varchar(255) NOT NULL default '1',
`date` varchar(255) NOT NULL default '1',
`id_user` varchar(255) NOT NULL default '1',
`col` varchar(255) NOT NULL default '1',
`col_id` varchar(255) NOT NULL default '1',
`state` varchar(255) NOT NULL default '1',
`ordering` int(11) NOT NULL default 1,
`oplata` varchar(255) NOT NULL default '',
`merchant_id` varchar(255) NOT NULL default '',
`currency_id` varchar(255) NOT NULL default '',
`description` varchar(255) NOT NULL default '',
`success_url` varchar(255) NOT NULL default '',
`fail_url` varchar(255) NOT NULL default '',
`cenahidden` varchar(255) NOT NULL default '',
PRIMARY KEY ( `id` ) 
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;


CREATE TABLE IF NOT EXISTS `#__priceleaf_vote`
(`id` int(10) unsigned NOT NULL auto_increment,
`id_tovar` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`ordering` int(11) NOT NULL default 1,
PRIMARY KEY (`id`)
) ENGINE = MyISAM DEFAULT CHARACTER SET = `utf8`;



INSERT INTO `#__priceleaf_razdel`
(`raz`, `name`, `text`, `state`)
VALUES
('1', 'Пример раздел 1', 'Дополнительное поле, внесите свои данные', '1');

INSERT INTO `#__priceleaf_cat`
(`raz_cat`, `name_cat`, `state`)
VALUES
('1', 'Пример категория 1', '1');

INSERT INTO `#__priceleaf_na`
(`cat_naimenovanie`, `name`, `opisanie`, `cena`, `state`, `opredelenie`, `edizm`, `total_tovar`, `pereopredelenie`)
VALUES
('1', 'Пример наименование 1', 'Описание', '100', '1', '0', 'шт', '5', '1');

INSERT INTO `#__priceleaf_option`
(`valuta`, `spoiler`, `state`, `percent`, `percent_number`, `percent_bill`, `percent_order`, `forma`, `total_sum`, `stoimost`, `col`, `pechat`, `pechat_duble`, `payment_state`, `status`, `vote`, `captcha`, `icons`, `more_options`)
VALUES
('руб.', '0', '1', '1', '10', '99', 'При заказе свыше 99 рублей скидка ', '1', '0', '1', '1', 'components/com_priceleaf/images/pechat.png', '1', '0', '1', '1', '1', '1', '1');

INSERT INTO `#__priceleaf_zakaz`
(`zapisvbd`, `pojta`, `state`)
VALUES
('Список заказов', 'mail', '1');

INSERT INTO `#__priceleaf_vote`
(`id_tovar`, `ip`)
VALUES
('1', '127.0.0.1');