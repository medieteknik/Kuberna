cloaked-octo-hipster
====================

Cloaked Octo Hipster is a simple voting system.

This'll be gooood


### Installation
For this system to run, you need a MySQL database. In the <code>database</code> folder, add a new file called <code>config.php</code> add the following to it:

```
<?php
// database connection settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'pass');
define('DB_DATABASE', 'vote');
?>
```

Then, create a MySQL table in that database using this code:

```
-- the vote database

DROP TABLE IF EXISTS `votes`;

CREATE TABLE IF NOT EXISTS `votes` (
	`voteid` INT(6) NOT NULL AUTO_INCREMENT,
	`vote1` INT(6) NOT NULL,
	`vote2` INT(6) NOT NULL,
	`liuid` CHAR(130) NOT NULL,
	PRIMARY KEY (`voteid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;
```
