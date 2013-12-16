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
    
    # some more tests here
    
    
    
    public function tearDown ()
    {
        $this->mputInstance = null;
    }
}
