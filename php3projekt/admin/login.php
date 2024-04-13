<?php

include "setup.php"; 

use WIFI\PHP3\Fdb\Validieren; // use triggert den Autoloader und weist die Klasse zu
use WIFI\PHP3\Fdb\Mysql;

// (1) Prüfen, ob das Formular abgeschickt wurde
//     wenn Daten eingegeben wurden = $_POST ist nicht leer, dann...
if(!empty($_POST)){
    // Formular validieren
    $validieren = new Validieren(); // neue Klasse - wie will ich das Objekt verwenden? 
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername"); // was wird geprüft
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort"); 
    
    if(!$validieren->fehler_aufgetreten()) {
        $db = Mysql::getInstanz();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $ergebnis = $db->query("SELECT * FROM benutzer 
        WHERE benutzername = '{$sql_benutzername}'");
        $benutzer = $ergebnis->fetch_assoc();
        echo "<pre>"; print_r($benutzer);  echo "</pre>";

        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
        } else {
            // alles ok -> Login in session merken
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"]= $benutzer["benutzername"];
            $_SESSION["benutzer_id"] = $benutzer["id"]; 
            // Umleitung zum Admin -System
            header("Location:index.php");
            exit;
        }

    }
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Loginbereich zur Fahrzeug-DB</h1>
    <?php
    
    if(!empty($validieren)){
        echo $validieren->fehler_html(); // Fehler aus der Validierung ausgeben
    }
    ?>
    <form action="login.php" method="post">
        <div>
            <label for="benutzername">Benutzername:</label>
            <input type="text" name="benutzername" id= "benutzername">
        </div>
        <div>
            <label for="passwort">Passwort:</label>
            <input type="password" name="passwort" id="passwort">
        </div>
        <div>
            <button type="submit">Einloggen</button>
        </div>


    </form>
    
</body>
</html>