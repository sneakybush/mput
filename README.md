Micro PHP Unit Tester
---------------------
> Should I use __Stable__ & *community-powered* PHP testing libraries?  No! __NOT INVENTED HERE__

+ Heavily inspired by [Testify.php](https://github.com/marco-fiset/Testify.php)
+ Licensed under __the MIT license__

# Installation

+ Get it 
+ Make sure everything is OK - run tests using __PHPUnit__

~~~shell 
ilya@dev:/mput/root/dir$ phpunit 
PHPUnit 3.7.28 by Sebastian Bergmann.

Configuration read from /var/www/phpunit.xml.dist

..............................

Time: 29 ms, Memory: 3.00Mb

OK (30 tests, 33 assertions)
~~~
Tests are placed in __tests/mput__ directory

+ Check out __example.php__ for more info on how Mput works
+ **Now you're ready to write some code!**

# Write your first test suite
Add Mput to __your project__

~~~php
include __DIR__ . '/lib/mput.php'; 
~~~

