<?php
$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "12345",    // Passwort
    "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT * FROM gericht";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

echo "<ol>";

while ($row = mysqli_fetch_row($result)) {
    echo "<li>";
    foreach ($row as $item) {
        echo "$item ";
    }
    echo "</li>";
}

echo "</ol>";

mysqli_free_result($result);
mysqli_close($link);

?>