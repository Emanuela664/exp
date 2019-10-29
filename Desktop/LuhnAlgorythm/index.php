<?php
require __DIR__ . "\Generator.php";
require __DIR__ . "\Validator.php";
require __DIR__ . "\LuhnCalculator.php";
require __DIR__ . "\Experiments.php";
?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>


<div class="container ">
    <div class="row">
        <form role="form" action="index.php" method="POST" class="col-md-3 ">
            <h2>Gjenero numra të kartave të kreditit</h2>

            <div class="form-group">

                <input type="checkbox" name="random"  id="type" class="form-control" checked value="random"> Të rastësishme

            </div>
            <br>
            <div class="form-group">
                <label for="message">Prefiksi </label>
                <input type="number" name="prefix" id="prefix" class="form-control" disabled >

            </div>

            <div class="form-group">
                <label for="message">Gjatësia </label>
                <input  type="number" name="length" id="length" class="form-control" disabled >

            </div>

            <div class="form-group">
             <button type="submit" class="btn btn-info">Gjenero</button>
            </div>
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $number = '';

            if (!isset($_POST['prefix']) && !isset($_POST['length']))
                $number = \Task1\Generator::single();

            elseif (isset($_POST['prefix']) && isset($_POST['length']))
                $number = \Task1\Generator::single($_POST['prefix'], $_POST['length']);

            echo $number."<br>  <div class=\"form-group\">
             <a href='index.php?number=".$number."' class=\"btn btn-info\">Valido</a>
            </div>";


        }

        if(isset($_GET['number'])) {

            if( \Task1\Validator::isValid($_GET['number']) ==true)
                echo $_GET['number'] . '<br> <br>Valid';
            else
                echo $_GET['number'] . '<br> <br>Jo Valid';
        }

        ?>

        <br>
        <br>
        <br>
        <div class="form-group">
            <a  href="index.php?experiment1" class="btn btn-info">Eksperimenti 1</a>
        </div>
        <br>
        <div class="form-group">
            <a  href="index.php?experiment2" class="btn btn-info">Eksperimenti 2</a>
        </div>

        <br>
        <div class="form-group">
            <a  href="index.php?experiment3" class="btn btn-info">Eksperimenti 3</a>
        </div>


        <?php

        if(isset($_GET['experiment1'])) {

            $result=\Task1\Experiments::experiment1();

            echo '<br>'. $result ;
        }

        if(isset($_GET['experiment2'])) {

            $result=\Task1\Experiments::experiment2();

            echo '<br>'. $result ;
        }

        if(isset($_GET['experiment3'])) {

            $result=\Task1\Experiments::experiment3();

            echo '<br>'. $result ;
        }
        ?>


    </div>

</div>

<script>
    $('#type').change(function () {

        if ($(this).is(':checked'))
        {
            $('#prefix').attr('disabled','disabled').removeAttr('required');
            $('#length').attr('disabled','disabled').removeAttr('required');
        }
        else
        {
            $('#prefix').removeAttr('disabled').attr('required','required');
            $('#length').removeAttr('disabled').attr('required','required');
        }

    });
</script>

</body>

</html>
