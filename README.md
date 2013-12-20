# Micro PHP Unit Tester
__NOT INVENTED HERE__


+ Heavily inspired by [Testify.php](https://github.com/marco-fiset/Testify.php)
+ Licensed under __the MIT license__

## Installation

+ Get it 
+ Add it to your project

~~~php
include __DIR__ . '/lib/mput.php';
$mput = Mput::create ('Sample Suite');
~~~

## Usage
It's pretty simple, worth trying.

### Callbacks

Use __callbacks__ system to do some work __before/after each case/suite__ if needed.

~~~php
$mput->setCallback (Mput::TEST_CASE_BEFORE, function ($mput)
{
    // everything stored in data() will be available across all your test cases
    $mput->data ()->info = 'cats';
});
~~~

#### All constants available

+ `Mput::TEST_SUITE_BEFORE`
+ `Mput::TEST_SUITE_AFTER`
+ `Mput::TEST_CASE_BEFORE`
+ `Mput::TEST_CASE_AFTER`

### Test cases
Declare your test cases.

~~~php
$mput->createTestCase ('Testing something', function ($mput)
{
    // test something here
});
~~~

### Tests
Add some __tests__.

~~~php
$mput->assertFalse (true, 'I broke it!');
$mput->assertEquals ($mput->data ()->info, 'foobar', 'Comparing two strings');
$mput->fail ('Love doing everything wrong');
~~~

#### All methods available

+ `assertTrue ($arg, $msg)`
+ `assertFalse ($arg, $msg)`
+ `fail ($msg)`
+ `pass ($msg)`
+ `assertEquals ($arg1, $arg2, $msg)` non-strict comparison
+ `assertNotEquals ($arg1, $arg2, $msg)`
+ `assertSame ($arg1, $arg2, $msg)` strict comparison
+ `assertNotSame ($arg1, $arg2, $msg)`

### Running
Make it work!

~~~php
$mput->run ();
~~~


