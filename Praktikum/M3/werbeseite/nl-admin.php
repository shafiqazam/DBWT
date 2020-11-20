<?php
const GET_PARAM_SEARCH_TEXT = 'search_text';

if (!isset($_GET['sort-value'])) {
    $_GET['sort-value'] = "0";
}
if (!isset($_GET['search_text']))
{
    $_GET['search_text'] = "";
}

function listeDarstellen($dateiName) {
    $fn = fopen($dateiName,"r");
    $arrDaten = (array) null;;

    // setup array according to preference and print
    while (!feof($fn)) {
        $result = fgets($fn);
        $arrLine = trimInArray($arrDaten,$result);
        //var_dump($arrLine);
        if ($arrLine[0] != "") {
            array_push($arrDaten,$arrLine);
        }
    }
    // Sortieren des Arrays
    $sort = [];

    foreach ($arrDaten as $key => $row) {
        $sort[$key] = $row[$_GET['sort-value']];
    }

    array_multisort($sort,SORT_ASC,$arrDaten);
    return $arrDaten;
}

function trimInArray($arr,$line) {
    $line = trim($line);
    // trim and insert data in array
    return explode(';',$line);
}

$showNames= [];
$Names = listeDarstellen("newletteranmeldungen.txt");

if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($Names as $key) {
        if (stripos($key[0], $searchTerm) !== false)  {
            $showNames[] = $key;
        }
    }
    $Names = $showNames;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NL-Admin</title>
</head>
<body>
    <h1>Liste zur Newsletteranmeldung</h1>
    <form method="get">
        <fieldset>
            <input type="radio" name="sort-value" value="0" <?php if ($_GET['sort-value'] == "0") echo 'checked';?>> Sortierung nach Name <br>
            <input type="radio" name="sort-value" value="1" <?php if ($_GET['sort-value'] == "1") echo 'checked'; ?>> Sortierung nach E-Mail <br>
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value=<?php echo $_GET[GET_PARAM_SEARCH_TEXT]?>>
            <input type="submit">
        </fieldset>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Sprache des Newsletter</th>
                <th>Datenschutz</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //$arrDaten =  listeDarstellen("newletteranmeldungen.txt");
        // Ausgabe des Arrays
        //var_dump($arrDaten);
        foreach ($Names as $keyArray)
        {
            echo '<tr>';
            foreach ($keyArray as $value) {
                echo '<td>'.$value;
            }
                echo '</tr>';

        }
        ?>
        </tbody>
    </table>
</body>
</html>
