<?php

// Session eröffnen (SESSION_START)
// ================================
// Erstellt eine $_SESSION, diese ist global verfügbar
// Funktion ist notwendig, um  die $_SESSION zur Verfügung zu haben.
session_start();

// Verbindung zur DB herstellen (MSQLI_CONNECT)
// ============================================
// Parameter: Server, Username, Passwort, DB-Bezeichnung

$db = mysqli_connect("localhost", "root", "", "php2");
// MySQLI mitteilen, in welchem Zeichenformat die Daten kommen:
mysqli_set_charset($db, "utf8");

// Prüfung, ob der Benutzer eingeloggt ist, oder nicht
// ====================================================
// Falls nicht, dann wird er automatisch auf die Login-Seite umgeleitet.

function ist_eingeloggt(){
    if(empty($_SESSION["eingeloggt"])){
        header("Location: login.php");
        exit; //damit der Teil darunter nicht mehr zum Browser geschickt wird. 
    }
}

// jegliche Benutzereingabe soll geprüft werden
// =============================================
function escape($post_var){
    global $db; //keywort, global um die $db variable vom globalen scope zu verwenden
    return mysqli_real_escape_string($db, $post_var);
}

// mysqli_query in eine Funktion auslagern
// ========================================

function query ($sql_befehl) { // $sql_befehl ist eine selbstdefinierte Variable, die nur innerhalb der Funktion gültig ist. 
    global $db; // Keyword "global", um die $db Variable vom globalen Scope zu übernehmen
    $result = mysqli_query($db, $sql_befehl);
    return $result;
}
// Bisherige SQL-Abfragen "$result = mysqli_query($db,"SELECT * FROM zutaten WHERE titel = '{$sql_titel}'"); brauchen dann nur noch mit "query" aufgerufen werden.

?>