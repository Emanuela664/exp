<?php
namespace Task1;

class Validator
{

    public static function isValid($number,$tester=null,$type=null)
    {
        $lastDigit = substr($number, -1);
        $number    = substr($number, 0, -1);

        if($tester==null)
        {
            return (new LuhnCalculator())->verificationDigit($number) == $lastDigit;
        }

        else
        {
            if($type==null)
            {
                if($tester>=1 && $tester <=75)
                    return true;
                elseif($tester >75 &&  $tester<=100)
                    return false;
            }
            else
            {
                if($type==4 && $tester>=1 && $tester <=35)
                    return false;

                elseif($type==5 && $tester>35 && $tester <=95)
                    return false;
                else
                    return true;
            }
        }



    }

}
