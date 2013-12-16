<?php

/*
 * Mput main test file
 * 
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
        
        $this->mputInstance->setCallback ('test', function ($mput)
        {
            // nothing here
        });
        
        $this->assertCount (1, $this->mputInstance->getCallbacks ());
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    
    public function testSetCallback ()
    {
        $this->mputInstance->setCallback ('something', null);
    }
    
    /**
     * @expectedException UnexpectedValueException
     */
    
    public function testFireCallback ()
    {
        $this->mputInstance->fireCallback ( uniqid () );
    }
    
    public function tearDown ()
    {
        $this->mputInstance = null;
    }
}
