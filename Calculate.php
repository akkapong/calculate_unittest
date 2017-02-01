<?php

class Calculate {
    
    //Method for check type if value
    protected function checkType($value, $type)
    {
        //Define output
        $isRight = false;

        switch($type){
            case 'int':
                $isRight = is_int($value);
                break;
            
        }
        return $isRight;
    }

    //Method for sum 2 integer
    public function sum($int1, $int2)
    {
        //check input type
        if (!$this->checkType($int1, 'int')) {
            return null;
        }
        if (!$this->checkType($int2, 'int')) {
            return null;
        }

        return $int1 + $int2;
    } 

    //Method for divine 2 integer
    public function divine($int1, $int2)
    {
        //check input type
        if (!$this->checkType($int1, 'int')) {
            return null;
        }
        if (!$this->checkType($int2, 'int')) {
            return null;
        }

        if ($int2 == 0) {
            return null;
        }

        return $int1 / $int2;
    }     
}