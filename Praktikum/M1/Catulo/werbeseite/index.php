<!--
- Praktikum DBWT. Autoren:
- Marco, Catulo, 3124518
- Shafiq, Azam, 3241745
-->
<?php

$meals = array(
        '0' => [ 'name' => 'Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie Nudeln',
                 'preis-intern' => "3.50",
                 'preis-extern' => "6.20"
                ],
        '1' => [ 'name' => 'Spinatrisotto mit kleinen Samosateigecken und gemischter Salat',
                 'preis-intern' => "3.50",
                 'preis-extern' => "6.20"
                ],
        '2' => [ 'name' => 'Pizza mit Thunfisch',
                 'preis-intern' => "4.00",
                 'preis-extern' => "7.50"
                ],
        '3' => [ 'name' => 'Lachsfillet',
                'preis-intern' => "3.50",
                'preis-extern' => "8.00"
                ]
);

$picFile = array(
        "Rindfleish mit Bambus.jpg","Spinatrisotto.jpg","thunfisch-pizza.jpg","Lachsfillet.jpg",
);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link rel="stylesheet" href="index-stylesheet.css" media="screen">
    <link rel="icon" href="img/favicon-96x96.png">
</head>
<body>
    <div class="grid-container">
        <div class="header">
            <div id="logo">
                <img src="E_Mensa_logo.jpg" alt="E-Mensa Logo">
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
                    <?php
                    foreach ($picFile as $index => $key)
                    echo '<img src="./img/'.$picFile[$index].'" alt="Photo of food">';
                    ?>
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
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($meals as $index => $key) {
                            echo "<tr>";
                            echo "<td>" . $meals[$index]['name'] . "</td>";
                            echo "<td>" . $meals[$index]['preis-intern'] . "</td>";
                            echo "<td>" . $meals[$index]['preis-extern'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>...</th>
                            <th>...</th>
                            <th>...</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="Statistik">
                    <h2>E-Mensa in Zahlen</h2>
                    <ul>
                        <li>X</li>
                        <li>Besuche</li>
                        <li>Y</li>
                        <li>Anmeldungen zum Newsletter</li>
                        <li>Z</li>
                        <li>Speisen</li>
                    </ul>
                </div>
                <div id="form">
                    <h2>Interesse geweckt? Wir informieren Sie!</h2>
                    <form id="newsletteranmeldung" action="formdata.html" method="post">
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
                        <input type="submit" id="submit" value="Zum Newsletter anmelden" disabled>
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