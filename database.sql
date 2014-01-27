-- database.sql, the voteing database

USE `vote`;

DROP TABLE IF EXISTS `votes`;

CREATE TABLE IF NOT EXISTS `votes` (
	`voteid` INT(6) NOT NULL AUTO_INCREMENT,
	`vote1` INT(6) NOT NULL,
	`vote2` INT(6) NOT NULL,
	`liuid` CHAR(130) NOT NULL,
	PRIMARY KEY (`voteid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
