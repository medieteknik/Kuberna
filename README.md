cloaked-octo-hipster
====================

Cloaked Octo Hipster is a simple voting system that isn't using any known system layout. In other words, the code is messy.

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

### License
The MIT License (MIT)

Copyright (c) 2014 (<a href="graphs/contributors">The ones who contributed to this repo.</a>)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
