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
    try
    {
        $tester->data ()->calculator->add (null, false);
        $this->fail ('Arguments validation');
    } 
    catch (InvalidArgumentException $exception) 
    {
        $tester->pass ('Arguments validation');
    }
    
    $result = $tester->data ()->calculator->add (6, 12);
    $tester->assertEquals ($result, 18, 'Right result'); // 6 + 12 = 18
});

$tester->createTestCase ('Testing subtract ()', function ($tester)
{
    try
    {
        $tester->data ()->calculator->subtract (null, false);
        $this->fail ('Arguments validation');
    } 
    catch (InvalidArgumentException $exception) 
    {
        $tester->pass ('Arguments validation');
    }
    
    $result = $tester->data ()->calculator->subtract (10, 8);
    $tester->assertEquals ($result, 2, 'Right result'); // 10*0.2=2
});

$tester->createTestCase ('Testing divide ()', function ($tester)
{
    try
    {
        $tester->data ()->calculator->divide (null, false);
        $this->fail ('Arguments validation');
    } 
    catch (InvalidArgumentException $exception) 
    {
        $tester->pass ('Arguments validation');
    }
    
    $result = $tester->data ()->calculator->divide (40, 2);
    $tester->assertEquals ($result, 20, 'Right result'); // 40*0.5=20    
});

$tester->createTestCase ('Testing multiply ()', function ($tester)
{
    try
    {
        $tester->data ()->calculator->multiply (null, false);
        $this->fail ('Arguments validation');
    } 
    catch (InvalidArgumentException $exception) 
    {
        $tester->pass ('Arguments validation');
    }
    
    $result = $tester->data ()->calculator->multiply (5, 5);
    $tester->assertEquals ($result, 25, 'Right result'); // 5^2=25    
});

// -------------------------------------------------------------------------

$tester->run ();