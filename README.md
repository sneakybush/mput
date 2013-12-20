Micro PHP Unit Tester
---------------------
__NOT INVENTED HERE__


+ Heavily inspired by [Testify.php](https://github.com/marco-fiset/Testify.php)
+ Licensed under __the MIT license__

# Installation

+ Get it 
+ Add it to your project

# Write your first test suite
Add Mput to __your project__.

~~~php
include __DIR__ . '/lib/mput.php';
$mput = Mput::create ('Sample Suite');
~~~

Use __callbacks__ system to do some work __before/after each case/suite__ if needed.

~~~php
$mput->setCallback (Mput::TEST_CASE_BEFORE, function ($mput)
{
    // everything stored in data() will be available across all your test cases
    $mput->data ()->info = 'cats';
});
~~~

## All constants available

+ `Mput::TEST_SUITE_BEFORE`
+ `Mput::TEST_SUITE_AFTER`
+ `Mput::TEST_CASE_BEFORE`
+ `Mput::TEST_CASE_AFTER`

Declare your test cases.

~~~php
$mput->createTestCase ('Testing something', function ($mput)
{
    // test something here
});
~~~

Add some __tests__.

~~~php
$mput->assertFalse (true, 'I broke it!');
$mput->assertEquals ($mput->data ()->info, 'foobar', 'Comparing two strings');
$mput->fail ('Love doing everything wrong');
~~~

## All available methods

+ `assertTrue ($arg, $msg)`
+ `assertFalse ($arg, $msg)`
+ `fail ($msg)`
+ `pass ($msg)`
+ `assertEquals ($arg1, $arg2, $msg)`
+ `assertNotEquals ($arg1, $arg2, $msg)`
+ `assertSame ($arg1, $arg2, $msg)`
+ `assertNotSame ($arg1, $arg2, $msg)`

Make it work!

~~~php
$mput->run ();
~~~


