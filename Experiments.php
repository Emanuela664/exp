<?php
namespace Task1;

class Experiments
{

    /**  Detyra 1, Pika 3 */

    public static function experiment1()
    {
        $generator = new Generator();
        $validator = new Validator();

        $errors = 0;
        $total = 100;

        for ($i=0; $i < $total; $i++) {

            $types=array(4,5,34,37,6);

            $rand_type=array_rand($types);

            $input = $generator->single($rand_type);

            $rand = rand(1, 100);

            $output = $validator->isValid($input, $rand);

            if ($output == false) {
                $errors++;
            }
        }

        $reliability =  ( ($total-$errors) / $total ) * 100;


        return "<strong>Besueshmeria: " .$reliability . " %</strong>";
    }



    /**  Detyra 1, Pika 4(a) */

    public static function experiment2()
    {
        $generator = new Generator();
        $validator = new Validator();

        $errors = 0;
        $total = 100;

        for ($i=0; $i < $total; $i++)
        {

            $types=array(4,5,34,37,6);

            $rand_type=array_rand($types);

            if ($rand_type==34 || $rand_type==37)
                $input = $generator->single($rand_type,15);
            else
                $input = $generator->single($rand_type);


            $rand=rand(1,100);

            $output=$validator->isValid($input,$rand,$rand_type);

            if ($output==false)
            {
                $errors++;
            }
        }
        $successRate = 100-( ($total-$errors) / $total ) * 100;

        return "<strong>Perqindja e ekzekutimeve te gabuara: " .$successRate . " %</strong>";
    }


    /**  Detyra 1, Pika 4(b) */

    public static function experiment3()
    {
        $generator = new Generator();
        $validator = new Validator();

        $errors = 0;
        $total = 100;

        for ($i=0; $i < $total; $i++)
        {

            $types=array(4,5,34,37,6);

            $rand_type=array_rand($types);

            if($i>=0 && $i<50)
                $input = $generator->single(4);

            elseif ($i>=50 && $i<74)
                $input = $generator->single(5);
            else
            {
                if ($rand_type==34 || $rand_type==37)
                $input = $generator->single($rand_type,15);
            else
                $input = $generator->single($rand_type);

            }

            $rand=rand(1,100);

            $output=$validator->isValid($input,$rand,$rand_type);

            if ($output==false)
            {
                $errors++;
            }
        }
        $successRate = 100-( ($total-$errors) / $total ) * 100;

        return "<strong>Perqindja e ekzekutimeve te gabuara: " .$successRate . " %</strong>";
    }



}
