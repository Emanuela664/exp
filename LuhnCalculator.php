<?php
namespace Task1;

class LuhnCalculator
{

    public function sum($number)
    {
        $numberArray = array_reverse(str_split($number));
        $sum = 0;
        for ($index = 0; $index < count($numberArray); $index++) {
            $digit = (int)$numberArray[$index];
            $sum += ($index % 2 == 0) ? $this->multiplyNumber($digit) : $digit;
        }
        return $sum;
    }

    public function verificationDigit($number)
    {
        return 10 - ($this->sum($number) % 10 ?: 10);
    }

    private function multiplyNumber($number)
    {
        $result = $number * 2;
        return ($result >= 10) ? $result - 9 : $result;
    }
}
