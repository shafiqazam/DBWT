<!--
- Praktikum DBWT. Autoren:
- Marco, Catulo, 3124518
- Shafiq, Azam, 3241745
-->

<!DOCTYPE HTML>
<html>
<head>
    <title>Additonsberechnung</title>
</head>
<body>
<form method="get">
    <input type="number" name="num1">
    <input type="number" name="num2">
    <input type="submit" value="Addieren" name="btn">
    <input type="submit" value="Multiplikation" name="btn">
</form>
<h3> Das Ergebnis lautet: <?php
    if ($_GET['btn'] == "Addieren") {
        echo $_GET['num1'] + $_GET['num2'];
    }
    else if ($_GET['btn'] == "Multiplikation") {
        echo $_GET['num1'] * $_GET['num2'];
    }
    ?></h3>
</body>
</html>
