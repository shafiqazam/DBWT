<?php

session_start();

const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';


if (!isset($_SESSION['show_description']))
{
    $_SESSION['show_description'] = "1";
}
else if (!empty($_GET['lang']))
{ }
else if (isset($_SESSION['show_description']) && !empty($_GET['show_description']))
{
    $_SESSION['show_description'] = "1";
}
else if (isset($_SESSION['show_description']) && empty($_GET['show_description']))
{
    $_SESSION['show_description'] = "0";
}

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "de";
}
else if (isset($_GET['lang']) && ($_GET['lang'] != $_SESSION['lang']) && !empty($_GET['lang']))
{
    if ($_GET['lang'] == "de") {
        $_SESSION['lang'] = "de";
    }
    else if ($_GET['lang'] == "en") {
        $_SESSION['lang'] = "en";
    }
}

$spracheen = array(
        "gericht" => "Dish",
        "bewertungen"=> "Rating",
        "allergene" => "Allergies",
        "stern" => "Stars",
        "insgesamt" => "Total",
        "zeige_beschreibung" => "Show description",
        "autor" => "Author",
        "deutsch" => "German",
        "englisch" => "English"
);

$sprachede = array(
    "gericht" => "Gericht",
    "bewertungen"=> "Bewertungen",
    "allergene" => "Allergene",
    "stern" => "Stern",
    "insgesamt" => "Insgesamt",
    "zeige_beschreibung" => "Zeige Beschreibung",
    "autor" => "Autor",
    "deutsch" => "Deutsch",
    "englisch" => "Englisch"
);

/**
 * Liste aller möglichen Allergene.
 */
$allergens = array(
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch' )
;

$meal = [ // Kurzschreibweise für ein Array (entspricht = array())
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => '2.90'.'€',
    'price_extern' => '3.90'.'€',
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.
];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stripos($rating['text'], $searchTerm) !== false) {  /// finde text in den Saetzen
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars($ratings) : float { // : float gibt an, dass der Rückgabewert vom Typ "float" ist
    $sum = 0;
    $i = 1;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
        $i++;
    }
    return $sum / count($ratings);
}



?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>Gericht: <?php echo $meal['name']; ?></title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }

            .rating_author {
                padding-left: 50px;
            }

            nav {
                text-align: right;
            }

            nav * {
                margin-left: 30px;
            }


        </style>
    </head>
    <body>
        <nav>
                <a href="meal.php?lang=en"><?php echo ${"sprache".$_SESSION['lang']}["englisch"];  ?></a>
                <a href="meal.php?lang=de"><?php echo ${"sprache".$_SESSION['lang']}["deutsch"];  ?></a>
        </nav>
        <h1><?php echo ${"sprache".$_SESSION['lang']}["gericht"];  ?>: <?php echo  $meal['name']." ( ".$meal['price_intern']." )"; ?></h1>
        <p><?php if ($_SESSION['show_description'] == "1")
            {
                echo $meal['description'];
            }
            else if ($_SESSION['show_description'] == "0"){
                echo "";
            }
            ?>
        </p>
        <h1><?php echo ${"sprache".$_SESSION['lang']}["bewertungen"];  ?> (<?php echo ${"sprache".$_SESSION['lang']}["insgesamt"];  ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
        <form method="get">
            <input type="checkbox" name="show_description" id="show_description" value="1"
            <?php if ($_SESSION['show_description'] == "1") echo checked?>
            >
            <label for="show_description"> <?php echo ${"sprache".$_SESSION['lang']}["zeige_beschreibung"];  ?></label> <br>
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo $_GET[GET_PARAM_SEARCH_TEXT]; ?>">
            <input type="submit" value="Suchen">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td><?php echo ${"sprache".$_SESSION['lang']}["stern"];  ?></td>
                <td class=rating_author><?php echo ${"sprache".$_SESSION['lang']}["autor"];  ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    <h3><?php echo ${"sprache".$_SESSION['lang']}["allergene"];  ?>  :</h3>
        <ul>
            <?php foreach ($meal['allergens'] as $value) {
                echo "<li>$allergens[$value]</li>";
            } ?>
        </ul>
    </body>
</html>