<?php

// very basic "calculator"
// I use it in all examples here

class Calculator
{
    private function _validateValue ($value)
    {
        if ( ! is_numeric ( $value ) )
        {
            throw new InvalidArgumentException ();
        }
        
        return true;
    }
    
    private function _validateValues ($x, $y)
    {
        $this->_validateValue ($x);
        $this->_validateValue ($y);
    }
    
    public function add ($x, $y)
    {
        $this->_validateValues ($x, $y);
        
        return ($x + $y);
    }
    
    public function subtract ($x, $y)
    {
        $this->_validateValues ($x, $y);
        
        return ($x - $y);
    }
    
    public function divide ($x, $y)
    {
        $this->_validateValues ($x, $y);
        
        return ($x / $y);
    }
    
    public function multiply ($x, $y)
    {
        $this->_validateValues ($x, $y);
        
        return ($x * $y);
    }
}
