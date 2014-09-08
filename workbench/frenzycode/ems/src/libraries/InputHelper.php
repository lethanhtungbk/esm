<?php

namespace Frenzycode\Ems\Libraries;

class InputHelper {
    const DELIMITER = '||';
    public static function getInput($index,$input,$default = '')
    {
        if ($input == null)
        {
            return $default;
        }
        
        if (array_key_exists($index, $input))
        {
            $value = $input[$index];
        }
        else
        {
            $value = $default;
        }
        return $value;
    }
        
}
