<?php
    session_start();

    //einer dieser drei Befehle würde schon reichen
    unset($_SESSION["eingeloggt"]);

    //löscht alle Session variablen
    session_unset();

    //Vernichtet die Session samt Cookies
    session_destroy();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout aus dem Rezepte-Administrationsbereich</title>
</head>
<body>
    <h1>Logout aus dem Rezepte-Administrationsbereich</h1>
    <p>Sie wurden ausgeloggt.</p>
    <p><a href="login.php">Hier gehts zurück zum Login</a></p>
</body>
</html>