<!-- 
//////////////////
Session löschen & Logout
//////////////////
-->

<?php

    session_start();

    //einer dieser drei Befehle würde schon reichen
    unset($_SESSION["eingeloggt"]);

    //Löscht alle vorhandenen Sessions
    session_unset();

    //Vernichtet die Session samt Cookies
    session_destroy();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout aus der Fahrzeug-DB</title>
</head>
<body>
    <h1>Logout aus der Fahrzeug-DB</h1>
    <p>Sie wurden ausgeloggt.</p>
    <p><a href="login.php">Hier gehts zurück zum Login</a></p>
</body>
</html>