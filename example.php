<?php

error_reporting (-1); // displays all errors possible

// this shouldn't be done this way but it's just an example
ini_set ('display_errors', true); 

// DIRECTORY_SEPARATOR should be used
// but it's beyond this example...
require_once __DIR__ . '/lib/mput.php'; 

$tester = Mput::create ('Sample Test Suite');

$tester->setCallback ('test_case.before', function ($tester)
{
    $tester->data ()->info = 'foobar';
});

$tester->createTestCase ('First Test Case', function ($tester)
{
    // everything here will pass (just an example)
    
    $tester->assertEquals ('true', true, 'passed');
    
    $tester->assertSame (42, 42, 'passed');
    
    $tester->assertTrue (true, 'passed');
    
    $tester->pass ('passed');
});

$tester->createTestCase ('Second Test Suite', function ($tester)
{
    // everything here will fail (just an example)
    
    $tester->assertNotEquals ('false', true, 'failed');
    
    $tester->assertNotSame (42, 42, 'failed');
    
    $tester->assertFalse (true, 'failed');
    
    $tester->fail ('failed');
});


$tester->run ();