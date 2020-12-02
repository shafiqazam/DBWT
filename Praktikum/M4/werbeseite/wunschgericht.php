<?php
// Init der Datenbank
$link = mysqli_connect("localhost", "root", "12345", "wunschgerichtdb");

// Check connection
//if ($link->connect_error) {
//    die("Connection failed: " . $link->connect_error);
//}
//echo "Connected successfully";
//

if (isset($_POST['submitbutton']) && $_POST['submitbutton'] == "Wunsch abschicken") {
    $submitbutton = true;
}
else {
    $submitbutton = false;
}

if ($submitbutton)
{
    if($_POST['name'] == "")
    {
        $name = 'anonym';
    } else {
        $name = mysqli_real_escape_string($link, $_POST['name']);
    }

    // Eingabemaskierung
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $gerichtsname = mysqli_real_escape_string($link, $_POST['gerichtsname']);
    $beschreibung = mysqli_real_escape_string($link, $_POST['beschreibung']);

    // Prepared statement
    // Fuege Daten in die Datenbank
    $sql = "insert into ersteller (name, email) VALUES (?,?)";
    $stmt = mysqli_prepare($link, $sql);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();

    $sql = "insert into wunschgericht (namen, beschreibung, erstellungsdatum) VALUES (?, ?, CURDATE())";
    $stmt = mysqli_prepare($link, $sql);
    $stmt->bind_param("ss", $gerichtsname, $beschreibung);
    $stmt->execute();

    // Query innerhalb php ( serverseitig )
   $sql = "select nummer from wunschgericht where namen = '".$gerichtsname."'";
   $gerichtsnummer = mysqli_query($link, $sql);
   $nummer = 0;
   while($row = mysqli_fetch_row($gerichtsnummer)) {
       $nummer = $row[0];
       //var_dump($nummer);
   }

    $sql = "insert into ersteller_email_hat_wunschgericht (nummer,email) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    $stmt->bind_param("ss", $nummer, $email);
    $stmt->execute();

}

?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wunschgericht</title>
</head>
<body>
<h2>Ist Ihr Lieblingsgericht nicht da?</h2>
<form method="post" action="wunschgericht.php">
    <fieldset>
        <h4>Kontaktdetails: </h4>
        <label for="ersteller-name">Name : </label>
        <input type="text" id="ersteller-name" name="name"><br>
        <label for="" id="ersteller-email">Email : </label>
        <input type="email" id="ersteller-email" name="email">
        <hr>
        <h4>Ihr Wunsch</h4>
        <label for="gerichtsname">Gerichtsname : </label>
        <input type="text" id="gerichtsname" name="gerichtsname"> <br>
        <label for="">Beschreibung : </label>
        <input type="text" id="beschreibung" name="beschreibung"> <br>
        <br>
        <input type="submit" value="Wunsch abschicken" name="submitbutton">
    </fieldset>
</form>
</body>
</html>