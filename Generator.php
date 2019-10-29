<?php
namespace Task1;

class Generator
{

    public static function single($prefix = null, $length = 16)
    {
        if ($length <= strlen($prefix)) {
            throw new \InvalidArgumentException(
                'The \'length\' parameter should be greater than \'prefix\' '.
                'string length'
            );
        }
        $number = $prefix . Generator::getRand($length - strlen($prefix));
        return $number . (new LuhnCalculator())->verificationDigit($number);
    }

    private static function getRand($length)
    {
        $rand = '';
        for ($index = 1; $index < $length; $index++) {
            $rand .= rand(0, 9);
        }
        return $rand;
    }
}
