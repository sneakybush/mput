<?php

error_reporting (-1); // displays all errors possible

// this shouldn't be done this way but it's just an example
ini_set ('display_errors', true); 

require_once __DIR__ . '/lib/mput.php'; 

require_once __DIR__ . '/example/calculator.php';

// -----------------------------------------------------------------------

$tester = Mput::create ('Calculator Test Suite');

$tester->setCallback (Mput::TEST_CASE_BEFORE, function ($tester)
{
    $tester->data ()->calculator = new Calculator ();
});

$tester->createTestCase ('Testing add ()', function ($tester)
{

});

$tester->createTestCase ('Testing subtract ()', function ($tester)
{

});

$tester->createTestCase ('Testing divide ()', function ($tester)
{
    
});

$tester->createTestCase ('Testing multiply ()', function ($tester)
{
    
});

// -------------------------------------------------------------------------

$tester->run ();