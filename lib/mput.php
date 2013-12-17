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
    
    /* later on this one */
    
    protected function _saveAssertionResult ($result, $message)
    {
        
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
}

