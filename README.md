Micro PHP Unit Tester
---------------------
> Should I use __Stable__ & *community-powered* PHP testing libraries?  No! __NOT INVENTED HERE__

+ Heavily inspired by [Testify.php](https://github.com/marco-fiset/Testify.php)
+ Licensed under __the MIT license__
+ Not even created

# Public API

* `createTestCase ( string $name , \Closure $testCase )`
* `setCallback ( string $eventName , \Closure $callback )`
* `fireCallback ( string $eventName )`
* `run ( )`
* `assertEquals ( $argument1 , $argument2 , $message )`
 * `assertNotEquals ( $argument1 , $argument2 , $message )`
* `assertTrue ( $argument , $message )`
* `assertFalse ( $argument , $message )`
* `fail ( )`
* `pass ( )`
* `assertSame ( $argument1 , $argument2 , $message )`
 * `assertTheSame ( $argument1 , $argument2 , $message )`