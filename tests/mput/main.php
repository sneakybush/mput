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
    
    public function assertEqualsProvider ()
    {
        return [
              [ ''   , null  , true ]
            , [ 0    , false , true ]
            , [ null , 0     , true ]
        ];
    }
}
