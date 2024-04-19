<?php

include "setup.php";

use WIFI\apvsa\classes\Validieren;
use WIFI\apvsa\classes\Mysql;

echo "<br>"; echo "Das hier sind die vom User eingegebenen Logindaten."; print_r($_POST); echo "<br>";

// (1) Prüfen, ob das Formular abgeschickt wurde
//     wenn Daten eingegeben wurden = $_POST ist nicht leer, dann...
if(!empty($_POST)){
    $validieren = new Validieren();
    $validieren->ist_ausgefuellt($_POST["benutzer"], "benutzer");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    // ist_ausgefüllt: überprüft die Eingabe im POST-Feld, z.B. "benutzer" (=$wert), ob es ausgefüllt ist (if (empty ($wert)). Wenn nicht, wird ein Fehler im errors Array aufgenommen. Der 2. Parameter (=$feldname wird in die Fehlermeldung geschrieben.
    if (!$validieren->fehler_aufgetreten()) {
        // wenn KEINE Fehler aufgetreten sind, dann: weiter machen mit einloggen.
        $db = Mysql::getInstanz();
        $sql_benutzer = $db->escape($_POST["benutzer"]);
        $ergebnis = $db->query("SELECT * FROM firmen WHERE benutzer = '{$sql_benutzer}'");
        $benutzer = $ergebnis->fetch_assoc();
        echo "<pre>"; print_r($benutzer); echo "</pre>"; 

        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {
            // Fehler: Eingegebener Benutzer existiert nicht
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
        } else {
            // Alles ok -> Login in Session merken
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzer["benutzer"];
            $_SESSION["benutzer_id"] = $benutzer["id"];

            // Umleitung zum Admin-System
            header("Location: index.php");
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
    <title>Login für Firmen</title>
</head>
<body>
    <h1>Loginbereich für Firmen</h1>
    <?php
    // Wenn im $error Array ein Fehler registriert wurde - $error is not empty - , dann soll der Fehlertext ($error = "Blabla") oberhalb des Formulars angezeigt werden.
    if(!empty($error)){
        echo "<p>".$error."</p>";
    }
    ?>
    <form action="login.php" method="post">
        <div>
            <label for="benutzer">Benutzername:</label>
            <input type="text" name="benutzer" id= "benutzer">
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