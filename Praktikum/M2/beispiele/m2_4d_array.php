<!--
- Praktikum DBWT. Autoren:
- Marco, Catulo, 3124518
- Shafiq, Azam, 3241745
-->

<?php

$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

function noWinnerYear($famousMeals) {
    $year = new SplFixedArray(21);

    foreach ($famousMeals as $index => $item) {
        if (is_array($famousMeals[$index]['winner']))   // falls winner ist ein Array
        {
            for ($j =0; $j < count($famousMeals[$index]['winner']); $j++) {
                if ($famousMeals[$index]['winner'][$j] > 2009)
                {
                    $yearStr = (string)($famousMeals[$index]['winner'][$j]);
                    $year[$yearStr[2].$yearStr[3]] = true;
                }
                else {
                    $yearStr = (string)($famousMeals[$index]['winner'][$j]);
                    $year[$yearStr[3]] = true;
                }
            }
        }
        else {
            if ($famousMeals[$index]['winner'] > 2009)
            {
                $yearStr = (string)($famousMeals[$index]['winner']);
                $year[$yearStr[2].$yearStr[3]] = true;
            }
            else {
                $yearStr = (string)($famousMeals[$index]['winner']);
                $year[$yearStr[3]] = true;
            }
        }
    }
    echo "Jahre, die keine Gewinner haben sind: ";
    foreach ($year as $index => $boo) {
        if ($index < 10 && $year[$index] != true) {
            echo "200".$index." ";
        }
        else if ($index > 9 && $year[$index] != true) {
            echo "20".$index." ";
        }
    }
}


?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Array</title>
        <style>
            li {
                margin: 20px 10px;
            }
        </style>
    </head>
    <body>
        <?php noWinnerYear($famousMeals); ?>
        <ol>

            <?php
            foreach ($famousMeals as $index => $item) {
                echo "<li>";
                echo $famousMeals[$index]['name']."<br>";
                if (is_array($famousMeals[$index]['winner']))   // falls winner ist ein Array
                {
                    for ($j =0; $j < count($famousMeals[$index]['winner']); $j++) {
                        echo $famousMeals[$index]['winner'][$j]." ";
                    }
                }
                else {
                    echo $famousMeals[$index]['winner'];
                }

                echo "</li>";
            }
            ?>
        </ol>
    </body>
</html>