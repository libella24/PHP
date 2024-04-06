<?php
// ist notwenidg um auf die $_SESSION zur Verfügung zu haben.
session_start();

//Verbindung zur Datenbank herstellen
$db = mysqli_connect("localhost", "root", "", "php2");
//MySQLI mitteilen, dass unsere Befehle als utf8 kommen
mysqli_set_charset($db, "utf8");

//Funktion für mysqli_query (Kurzform)
function query ($sql_befehl) {
    //$sql_befehl ist eine selbstdefinerte Variable die nur innerhalb der Fn gültig ist.
    global $db; //keyword global um die $DB Variable vom globalen scope zu übernehmen
    $result = mysqli_query($db, $sql_befehl) or die(mysqli_error($db)."<br />".$sql_befehl);

    return $result;
}


//Function um SQL-Injections zu vermeiden
function escape($post_var) {
    global $db; //keyword global um die $DB Variable vom globalen scope zu übernehmen
    return mysqli_real_escape_string($db, $post_var);
}


//Dies Funktion überprüft, ob der Benutzer eingeloggt ist.
//Falls nicht, dann wird er automatisch auf die Log-In Seite umgeleitet.
function ist_eingeloggt(){
    if (empty ( $_SESSION["eingeloggt"])) {
        header("Location: login.php");
        exit; //damit der teil darunter nicht mehr zum Browser geschickt wird.
    }
}


