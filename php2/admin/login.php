<?php

include "funktionen.php"; 
// - session_start() - Session wird eröffnet
// - mysqli_connect (DB, User, DB-Name) - DB wird aufgerufen

//wurde das Formular abgeschickt
//print_r($_POST);

// (1) Prüfen, ob das Formular abgeschickt wurde
//     wenn Daten eingegeben wurden = $_POST ist nicht leer, dann...
if(!empty($_POST)){
    // (2)    Fehler ausgeben, wenn entweder der Benutzername oder das Passwort leer sind. 
    if(empty($_POST["benutzername"]) || empty($_POST["passwort"])){ //OR, weil beide Felder geprüft werden, nicht entweder/oder
        $error = "Benutzername oder Passwort ist leer."; // Fehlermeldung $error Array wird befüllt
    } else {
        //(3) Eingabe "username" um Sonderzeichen bereinigen
        //    M Y S Q L I _ R E A L _ E S C A P E _ S T R I N G   (db, Post,[""])
        //    Dem Post "username" wird die Variable "$sql_benutzername" zugewiesen. Gleichzeitig ist diese Variable von Sonderzeichen 
        //    bereinigt. Im weiteren Programmverlauf soll nur mehr die Variable "$sql_benutzername" verwendet werden.
        
        $sql_benutzername = mysqli_real_escape_string($db, $_POST["benutzername"]); // bewahrt vor SQL Injections
        
        //(4) Benutzer in der DB abfragen 
        //    M Y S Q L I _ Q U E R Y   (db, "Statement")
        //    die Benutzereingabe wird mit {'...'} formatiert
        //    dem Abfrageergebnis wird die Variable "$result" zugewiesen
        $result = mysqli_query($db,"SELECT * FROM benutzer 
        WHERE benutzername = '{$sql_benutzername}'");
        //print_r($result);

        //(5) Benutzer Abfrageergebnis in ein Array speichern
        //    M Y S Q L I _ F E T C H _ A S S O C   (Abfrageergebnis)
        $row = mysqli_fetch_assoc($result); 
        //print_r($row);

        //(6) Benutzer prüfen
        if($row){
            //(7) Passwort prüfen - PHP Standardfunktion
            //    P A S S W O R D _ V E R I F Y   (eingebebenes PW, Hash)
            //    Die Funktion "password_verify" prüft, ob das eingegebene Passwort mit dem DB-Hash der mit PASSWORD_HASH() erzeugt wurde,
            //    validiert. (Vorteil: password_hash erzeugt unterschiedliche Schlüssel für gleich PW.)
            //    if($_POST["passwort"] == $row["passwort"]) { -- würde nur das eingegebene Passwort prüfen, 
            //    wir brauchen die "password_verify" funktion und geben das eingegebene PW und den Hash aus der DB. 
                if(password_verify($_POST["passwort"], $row["passwort"])){
                //Passwort stimmt überein
                //echo "Sie sind eingeloggt.";

                // (8) $ _ S E S S I O N 
                //     Superglobale Variable - ist im ganzen Programm gültig und muss nicht mit "global" gekennzeichnet werden
                //     In das $_SESSION Array wird der Benutzer als "eingeloggt" eingetragen. 
                //     In der Funktion "ist_eingeloggt" (siehe funktionen.php) wird geprüft, ob der User eingeloggt ist. 

                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];
                $_SESSION["benutzer_id"] = $row["id"];
                // (9) Anzahl der Logins und Last Login in DB speichern 
                //     Im DB-Feld darf nicht NULL definiert sein, sonst kann keine Berechnung stattfinden.
                //     Last login speichern: im DB Feld muss NULL erlaubt sein. 
                //     2 Prüfungen können in einem Statement erfasst werden
                query("UPDATE benutzer SET 
                anzahl_logins = anzahl_logins + 1,
                last_login = NOW() 
                WHERE id ={$row["id"]}");


                //Switch in die Start-Seite
                header("Location: index.php");
            } else {
                //Passwort war falsch
                $error = "Benutzername oder Passwort sind falsch!";
                
            }
            } else {
                //Benutzername wurde nicht in der DB gefunden
                $error = "Benutzername oder Passwort sind falsch!";
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
    <h1>Loginbereich zur Rezepteverwaltung</h1>
    <?php
    // Wenn im $error Array ein Fehler registriert wurde - $error is not empty - , dann soll der Fehlertext ($error = "Blabla") oberhalb des Formulars angezeigt werden.
    if(!empty($error)){
        echo "<p>".$error."</p>";
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