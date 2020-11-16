<!--
- Praktikum DBWT. Autoren:
- Marco, Catulo, 3124518
- Shafiq, Azam, 3241745
-->
<?php

// Init der Datenbank
$link = mysqli_connect("localhost", "root", "12345", "emensawerbeseite");

// SQL Anfrage der Gerichten
$gericht_liste = "SELECT g.NAME,g.preis_intern,g.preis_extern, GROUP_CONCAT(a.code), GROUP_CONCAT(a.name)
FROM gericht g 
join gericht_hat_allergen gha on g.id = gha.gericht_id
join allergen a on gha.code = a.code
GROUP BY g.name LIMIT 5";

$gericht = mysqli_query($link,$gericht_liste);

    // Uberpruefe ob der Name nicht leer ist
    function checkName() {
        if(empty(trim($_POST['user']))) {
            return false;
        }
        return true;
    }

    //Ueberpruefe ob die eingegebene Email gueltig ist
    function checkEmail() {
        if(empty($_POST['email'])) {
            return false;
        }
        else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    function getDomain($email) {
        $arr = explode('@', $email);
        return $arr[1];
    }

    // Uberpruefe ob die eingegebene Email in der Blacklist steht
    function emailBlacklist() {
        $blacklist = [
            'rcpt.at',
            'damnthespam.at',
            'wegwerfemail.de',
            'trashmail.de',
            'trashmail.com'
        ];

        if (in_array(getDomain($_POST['email']), $blacklist)) {
            return true;
        }
        return false;
    }

    // Ueberpruefe Eingaben im Form
    function checkForm() {
        if(isset($_POST['datenschutz']) and isset($_POST['language']) and isset($_POST['user']) and isset($_POST['email'])) {
            if(checkName()) {
                if(checkEmail()){
                    if(emailBlacklist()) {
                        echo "<p style = 'color: red'>Email ist Teil der Blacklist.</p>";
                    }
                    else {
                        $file = fopen('./newletteranmeldungen.txt', 'a');
                        fwrite($file, $_POST['user']."; ".$_POST['email']."; ".$_POST['language']."; ".'true'."\n");
                        fclose($file);
                        echo "<p style='color: green'>Erfolgreich zum Newsletter angemeldet.</p>";
                    }
                }
                else {
                    echo "<p style = 'color: red'>Ungültige E-Mail Addresse.</p>";
                }
            }
            else {
                echo "<p style = 'color: red'>Name darf nicht leer sein.</p>";
            }
        }
        else {
            echo "<p style = 'color: red'>Den Datenschutzbestimmungen muss zugestimmt sein.</p>";
        }
    }

$allergen_array = array();

// Zeige Gerichte in der Tabelle
function displayMeal(&$allergen_array,$gericht) {
        $gericht_anzahl = 0;
        while($row = mysqli_fetch_row($gericht))
        {
            $gericht_anzahl++;
            echo '<tr>';
                for ($i =0; $i < 5; $i++)  {
                    if ($i == 4)
                    {
                        allergenConnect($allergen_array,$row);
                    }
                    else {
                        echo '<td>' . $row[$i] . '</td>';
                    }
                }
            echo '</tr>';
        }
        return $gericht_anzahl;
}

function allergenConnect(&$allergen_array,$row) {
    $allergens_code = explode(',',$row[3]);
    $allergens_name = explode(',',$row[4]);
    for ($i = 0; $i < sizeof($allergens_code); $i++) {
        if (!array_key_exists($allergens_code[$i],$allergen_array)) {
            $allergen_array[$allergens_code[$i]] = $allergens_name[$i];
        }
    }
    ksort($allergen_array);
}

$zaehler= unserialize(file_get_contents('./zaehler.txt'));
$zaehler['Besuche'] += 1;
$zaehler['Anmeldungen zum Newsletter'] = count(file("newletteranmeldungen.txt"));
file_put_contents('./zaehler.txt',serialize($zaehler));

?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" href="index-stylesheet.css" media="screen">
    <link rel="icon" href="./img/favicon-96x96.png">
</head>
<body>
    <div class="grid-container">
        <div class="header">
            <div id="logo">
                <img src="./img/E_Mensa_logo.jpg" alt="E-Mensa Logo">
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="#Ankündigungen">Ankündigung</a></li>
                    <li><a href="#Speisekarte">Speisen</a></li>
                    <li><a href="#Statistik">Zahlen</a></li>
                    <li><a href="#form">Kontakt</a></li>
                    <li><a href="#Wichtig">Wichtig für uns</a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <div id="left"></div>
            <div id="center">
                <div id="banner">
                    <img src="./img/banner.jpg" alt="banner" width="500" height="500">
                </div>
                <div id="Ankündigungen">
                    <h2>Bald gibt es Essen auch online ;)</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                        et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                        labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                        et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div id="Speisekarte">
                    <h2>Köstlichkeiten, die Sie erwarten</h2>
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Preis intern</th>
                            <th>Preis extern</th>
                            <th>Allergens</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $gericht_anzahl = displayMeal($allergen_array, $gericht) ;
                              $zaehler['Speisen'] = $gericht_anzahl;
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>...</th>
                            <th>...</th>
                            <th>...</th>
                            <th>...</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <h3>Allergenshinweise: </h3>
                <div id="Allergens">

                    <?php
                    foreach ($allergen_array as $key => $item) {

                        echo '<div class="allergens-list">'.$key.'=>"'.$item.'"</div>';
                    }
                    ?>
                </div>
                <div id="Statistik">
                    <h2>E-Mensa in Zahlen</h2>
                    <ul>
                        <li><?php echo (int)$zaehler['Besuche']++; ?></li>
                        <li>Besuche</li>
                        <li><?php echo (int)$zaehler['Anmeldungen zum Newsletter']; ?></li>
                        <li>Anmeldungen zum Newsletter</li>
                        <li><?php echo (int)$zaehler['Speisen']; ?></li>
                        <li>Speisen</li>
                    </ul>
                </div>
                <div id="form">
                    <h2>Interesse geweckt? Wir informieren Sie!</h2>
                    <form id="newsletteranmeldung" method="post"><!--action="index.php"-->
                        <label for="name">Ihr Name:<br>
                            <input type="text" id="name" name="user" placeholder="Vorname" required>
                        </label>
                        <label for="email">Ihre E-Mail:<br>
                            <input type="text" id="email" name="email" placeholder="" required>
                        </label>
                        <label for="language">Newsletter bitte in:<br>
                            <select id="language" name="language">
                                <option value="de" selected>Deutsch</option>
                                <option value="en">English</option>
                            </select>
                        </label><br>
                        <label for="datenschutz">
                            <input type="checkbox" id="datenschutz" name="datenschutz" required>
                            Den Datenschutzbestimmungen stimme ich zu
                        </label>
                        <input type="submit" id="submit" value="Zum Newsletter anmelden"><!--disabled-->
                        <?php echo '<br>'.checkForm(); ?>
                    </form>
                </div>
                <div id="Wichtig">
                    <h2>Das ist uns wichtig</h2>
                    <ul>
                        <li>Beste frische saisonale Zutaten</li>
                        <li>Ausgewogene abwechslungsreiche Gerichte</li>
                        <li>Sauberkeit</li>
                    </ul>
                </div>
                <div>
                    <h1>Wir freuen uns auf Ihren Besuch!</h1>
                </div>
            </div>
            <div id="right"></div>
        </div>
        <div class="footer">
            <ul>
                <li>&copy; E-Mensa GmbH</li>
                <li>Marco Catulo</li>
                <li>Shafiq Azam</li>
                <li><a href="impressum.html">Impressum</a></li>
            </ul>
        </div>
    </div>
</body>
</html>