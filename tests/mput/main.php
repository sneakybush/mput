<?php

/*
 * Mput main test file
 * Licensed under the MIT license
 * For more info please check the /LICENSE file
 *  
 */

/**
 * Mput test class.
 * 
 * @package mput
 * @author  Ilya
 */

class MputTest extends PHPUnit_Framework_TestCase
{
    public $mputInstance;
    
    public $testSuiteName = 'Test Suite';
    
    public function setUp ()
    {
        $this->mputInstance = Mput::create ($this->testSuiteName);
        $this->mputInstance->createTestCase ('__hidden__', function () {} );
    }
    
    public function tearDown ()
    {
        $this->mputInstance = null;
    }
    
    public function testGetName ()
    {
        $this->assertEquals (
            $this->testSuiteName, 
            $this->mputInstance->getName ()
        );
    }
    
    public function testGetCallbacks ()
    {
        $this->assertEquals ($this->mputInstance->getCallbacks (), []);
        
        $this->mputInstance->setCallback ('test', function ()
        {
            // nothing here
        });
        
        $this->assertCount (1, $this->mputInstance->getCallbacks ());
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    
    public function testSetCallbackValidation ()
    {
        $this->mputInstance->setCallback ('something', null);
    }
    
    public function testSetCallback ()
    {
        $this->mputInstance->setCallback ('test', function ()
        {
            return 42;
        });
        
        $this->assertCount (1, $this->mputInstance->getCallbacks ());
        $this->assertEquals (42, $this->mputInstance->fireCallback ('test'));
    }
    
    /**
     * @expectedException UnexpectedValueException
     */
    
    public function testFireCallbackValidation ()
    {
        $this->mputInstance->fireCallback ( uniqid () );
    }
    
    public function testFireCallback ()
    {
        $this->mputInstance->setCallback ('test', function () 
        {
            return 42;
        });
        
        $this->assertEquals (42, $this->mputInstance->fireCallback ('test'));
    }
    
    /**
     * @dataProvider assertEqualsProvider
     */
    
    public function testAssertEquals ($argument1, $argument2, $result)
    {
        // pass an empty string for the 3rd param in Mput::assertEquals
        $this->assertEquals ($result, 
                $this->mputInstance->assertEquals ($argument1, $argument2, ''));
    }
    
    /**
     * @dataProvider assertEqualsProvider
     */
    
    public function testAssertNotEquals ($argument1, $argument2, $result)
    {
        $this->assertEquals (!$result, 
                $this->mputInstance->assertNotEquals ($argument1, $argument2, ''));
    }
    
    public function assertEqualsProvider ()
    {
        return [
              [ ''   , null  , true ]
            , [ 0    , false , true ]
            , [ null , 0     , true ]
        ];
    }
    
    public function testAssertTrue ()
    {
        $this->assertTrue ($this->mputInstance->assertTrue (true, ''));
        
        $this->assertFalse ($this->mputInstance->assertTrue (false, ''));
    }
    
    public function testAssertFalse ()
    {
        $this->assertFalse ($this->mputInstance->assertFalse (true, ''));
        
        $this->assertTrue ($this->mputInstance->assertFalse (false, ''));
    }
    
    // next 2 tests don't make any sense
    // but hey
    // what they always tell you?
    // "always test all your code"
    
    public function testFail ()
    {
        $this->assertFalse ($this->mputInstance->fail (''));
    }
    
    public function testPass ()
    {
        $this->assertTrue ($this->mputInstance->pass (''));
    }
    
    /**
     * @dataProvider assertSameProvider
     */
    
    public function testAssertSame ($argument1, $argument2, $result)
    {
        $this->assertEquals ($result,
            $this->mputInstance->assertSame ($argument1, $argument2, '')
        );
    }
    
    /**
     * @dataProvider assertSameProvider
     */
    
    public function testAssertNotSame ($argument1, $argument2, $result)
    {
        $this->assertEquals (!$result,
            $this->mputInstance->assertNotSame ($argument1, $argument2, '')
        );
    }
    
    public function assertSameProvider ()
    {
        return [
              [ 0     , null  , false ]
            , [ 'foo' , true  , false ]
            , [ 'bar' , 'bar' , true  ]
        ];
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    
    public function testCreateTestCaseArgumentValidation ()
    {
        $this->mputInstance->createTestCase ('test', null);
    }
    
    /**
     * @expectedException LogicException
     */
    
    public function testCreateTestCaseLogicValidation ()
    {
        $callback = function () {}; // new Closure
        
        // it's ok
        $this->mputInstance->createTestCase ('test', $callback);
        
        // oh!
        $this->mputInstance->createTestCase ('test', $callback);
    }
    
    public function testGetTestCases ()
    {
        $this->mputInstance->createTestCase ('test', function () {} );
        
        // don't forget about __hidden__ the only purpose of which is to
        // make the rest of tests work 
        $this->assertCount (2, $this->mputInstance->getTestCases ());
    }
    
    public function testGetLatestTestCase ()
    {
        $this->mputInstance->createTestCase ('test', function () {} );
        $this->assertEquals ('test', $this->mputInstance->getLatestTestCase ());
    }
    
    // probably this one is the most difficult to read & understand
    // attention, please
    
    public function testGetAssertions ()
    {
        $this->mputInstance->createTestCase ('test', function () {} );
        
        $this->mputInstance->assertTrue (false, 'foo');
        $this->mputInstance->assertSame (42, 42, 'bar');
        
        // the ouput should be
        $output = 
        [
            'test' => 
            [
                [
                    'result'  => false,
                    'message' => 'foo'
                ],
                
                [
                    'result'  => true,
                    'message' => 'bar'
                ]
            ]
        ];
        
        // so let's check
        $this->assertEquals ($output, $this->mputInstance->getAssertions ());
    }
    
} // MputTest
