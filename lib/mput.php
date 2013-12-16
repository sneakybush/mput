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
     * @var string Name of test suite
     */
    
    private $_name;
    
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
}

