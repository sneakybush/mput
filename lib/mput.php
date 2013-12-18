<?php

/*
 * Part of mput library 
 * Licensed under the MIT license
 * For more info please check the /LICENSE file
 * 
 */

/**
 * Mput main class.
 * 
 * @package mput
 * @author  Ilya
 */

class Mput
{
        
    /**
     * @var string Name of test suite
     */
    
    private $_name;
    
    /**
     * @see setCallback
     * @see fireCallback
     * @see getCallbacks
     * @var array registered events
     */
    
    private $_events = [];
    
    /**
     * @var all asserted values
     * @see assert*
     * @see fail
     * @see pass
     * @see _saveAssertionResult
     * @see getAssertions
     */
    
    private $_assertions = [];
    
    /**
     * @var test cases related to this test suite
     * @see createTestCase
     * @see getTestCases
     */
    
    private $_testCases = [];
    
    /** 
     * @var string 
     * @see _switchTestCase 
     */
    
    private $_latestTestCase;
    
    /**
     * @var some stuff you might want to store here during runtime
     * @see data
     */
    
    private $_data;
    
    /**
     * Returns new instance of Mput
     * @return Mput instance
     */
    
    public static function create ($name)
    {
        $instance = (new static);
        $instance->setName ($name);
        return $instance;
    }
    
    /**
     * The constructor
     */
    
    public function __construct ()
    {
        $this->_data = new stdClass ();
    }
    
    /**
     * Returns the reference to the _data property
     * @return stdClass data
     */
    
    public function data ()
    {
        return $this->_data;
    }
    
    /**
     * Sets $_name property
     * @param string $name {@see _name}
     */
    
    public function setName ($name)
    {
        $this->_name = (string) $name;
    }
    
    /**
     * Returns the name of test suite
     * @return string
     */
    
    public function getName ()
    {
        return $this->_name;
    }
    
    /**
     * Typical getter for _events
     * 
     * @return array {@see _events}
     */
    
    public function getCallbacks ()
    {
        return $this->_events;
    }
    
    /**
     * 
     * Overrides (or sets) given callback for specified event 
     * 
     * @param string $eventName event name
     * @param \Closure $callback
     * @throws InvalidArgumentException
     */
    
    public function setCallback ($eventName, $callback)
    {
        $eventName = (string) $eventName;
        
        if ( ! ($callback instanceof Closure) )
        {
            throw new InvalidArgumentException ();
        }
        
        $this->_events [$eventName] = $callback;
    }
    
    /**
     * 
     * Invokes specified callback
     * 
     * @param string $eventName event name
     * @return mixed
     * @throws UnexpectedValueException
     */
    
    public function fireCallback ($eventName)
    {
        $callbacks = $this->getCallbacks ();
        
        if ( ! array_key_exists ($eventName, $callbacks) )
        {
            throw new UnexpectedValueException (
                '$eventName is not found in $_events'
            );
        }
        
        return $callbacks [$eventName] ();
    }
    
    /**
     * Creates a new test case
     * 
     * @param string $name name of test case
     * @param Closure $testCase test case itself
     * @throws InvalidArgumentException
     * @throws LogicException
     */
    
    public function createTestCase ($name, $testCase)
    {
       $name = (string) $name; 
        
       if ( ! ($testCase instanceof Closure) )
       {
           throw new InvalidArgumentException ();
       }
       
       if ( array_key_exists ($name, $this->getTestCases ()) )
       {
           throw new LogicException ();
       }
        
       $this->_testCases [$name] = $testCase; 
    }
    
    /**
     * Returns all created test cases (name => code wrapped in Closure)
     * 
     * @return array
     */
    
    public function getTestCases ()
    {
        return $this->_testCases;
    }
    
    /**
     * Returns the latest test case selected using _switchTestCase
     * 
     * @see _switchTestCase
     * @return string name of the latest test case
     */
    
    public function getLatestTestCase ()
    {
        if ( ! $this->_latestTestCase )
        {
            throw new LogicException ();
        }
        
        return $this->_latestTestCase;
    }
    
    /**
     * Public but not a part of API
     * 
     * @param string $testCaseName name
     */
    
    public function _switchTestCase ($testCaseName)
    {
        $testCaseName = (string) $testCaseName;
        
        if ( ! array_key_exists ($testCaseName, $this->getTestCases ()) )
        {
            throw new LogicException ();
        }
        
        $this->_latestTestCase = $testCaseName;
    }
    
    /**
     * Saves given assertion data {@see _assertions}
     * 
     * @param boolean $result
     * @param string $message assertion message (MUST BE specified!)
     */
    
    private function _saveAssertionResult ($result, $message)
    {
        if ( ! is_bool ($result) )
        {
            throw new InvalidArgumentException ();
        }
        
        $latestTestCase = $this->getLatestTestCase ();
        
        if ( ! $latestTestCase )
        {
            throw new LogicException ();
        }
        
        $this->_assertions [$latestTestCase][] = [
            'result'  => $result  ,
            'message' => $message
        ];
    }
    
    /**
     * Returns all asserted values grouped by testCase
     * 
     * @return array
     */
    
    public function getAssertions ()
    {
        return $this->_assertions;
    }
    
    /**
     * Non-strict value comparing.
     * 
     * @param mixed $argument1 firt argument
     * @param mixed $argument2 second argument
     * @param string $message assertion message (MUST BE specified)
     * @return bool comparison result
     */
    
    public function assertEquals ($argument1, $argument2, $message)
    {
        // non-strict, worth your attention
        $result = ($argument1 == $argument2); 
        $this->_saveAssertionResult ($result, $message);
        return $result; // purpose of testing
    }
    
    /**
     * 
     * Like assertEquals, but vise versa
     * @see assertEquals
     * @return bool !assertEquals
     * 
     */
    
    public function assertNotEquals ($argument1, $argument2, $message)
    {
        return ! $this->assertEquals ($argument1, $argument2, $message);
    }
    
    /**
     * Compares given value to true (non-strict)
     * 
     * @param mixed $argument
     * @param string $message assertion message (MUST BE specified)
     * @return comparison result
     */
    
    public function assertTrue ($argument, $message)
    {
        return $this->assertEquals ($argument, true, $message);
    }
    
    /**
     * Compares given value to false (non-strict)
     * 
     * @param mixed $argument
     * @param string $message assertion message (MUST BE specified)
     * @return comparison result
     */
    
    public function assertFalse ($argument, $message)
    {
        return $this->assertEquals ($argument, false, $message);
    }
    
    /**
     * Will always fail
     * 
     * @param string $message assertion message (MUST BE specified)
     * @return boolean false
     */
    
    public function fail ($message)
    {
        $this->_saveAssertionResult (false, $message);
        return false;
    }
    
    /**
     * Will always pass
     * 
     * @param string $message assertion message (MUST BE specified)
     * @return boolean true
     */
    
    public function pass ($message)
    {
        $this->_saveAssertionResult (true, $message);
        return true;
    }
    
    /**
     * STRICT values comparing.
     * 
     * @param mixed $argument1 firt argument
     * @param mixed $argument2 second argument
     * @param string $message assertion message (MUST BE specified)
     * @return bool comparison result
     */
    
    public function assertSame ($argument1, $argument2, $message)
    {
        $result = ($argument1 === $argument2);
        $this->_saveAssertionResult ($result, $message);
        return $result;
    }
    
    /**
     * 
     * Like assertSame, but vise versa
     * @see assertSame
     * @return bool !assertSame
     * 
     */
    
    public function assertNotSame ($argument1, $argument2, $message)
    {
        return ! $this->assertSame ($argument1, $argument2, $message);
    }
    
    /**
     * Makes everything work magically
     */
    
    public function run ()
    {                
        foreach ($this->getTestCases () as $name => $testCase)
        {
            $this->_switchTestCase ($name);
            $testCase ($this);
        }
        
        // I want to override $this
        $isolation = function ($structure)
        {
            require_once __DIR__ . '/views/main.php';
        };
        
        $isolation ($this->getAssertions ());
    }
    
} // end Mput

