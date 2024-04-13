<?php

// Konfiguration für das Projekt
// ==============================
// Konstanten, auf die zugegriffen werden kann.
const MYSQL_HOST = "localhost";
const MYSQL_USER = "root";
const MYSQL_PASSWORT = "";
const MYSQL_DATENBANK = "php3";
// Setup-Code: Nur verändern, wenn Du weißt, was Du tust.


spl_autoload_register(
    function(string $klasse){ // "leere" Funktion; die Klasse wird übergeben
        // Projektspezifisches Namespace Präfix
        $prefix = "WIFI\\PHP3\\"; // der 2. Backslash ist zum escapen, es zählt nur 1 Backslash - für die substr Funktion später...
        // Basisverzeichnis für das Projekt
        $basis = __DIR__ . "/"; // standardmäßig ist das Verzeichnis der index.php enthalten
        //die($klasse); // Wenn die Klasse das Präfix nicht verwenden, wird abgebrochen. Wir laden damit keine Dateien anderer Projekte.
        $laenge = strlen($prefix);
        if (substr($klasse, 0, $laenge) !== $prefix) {
            return; // dann bricht das Programm ab
        }  // die ersten 9 Zeichen müssen "WIFI/JWE/" enthalten, der 9er wurde durch $laenge ersetzt - falls sich die Präfix-Bezeichnung mal ändert.
        
        // Klasse ohne Präfix
        $klasse_ohne_prefix = substr($klasse, $laenge); //der letzte Parameter (letzte Stelle) wird weggelassen - damit nimmt er alle Zeichen bis zum Ende.
        //die($klasse_ohne_prefix);

        // Dateipfad erstellen
        $datei = $basis . $klasse_ohne_prefix . ".php";
        $datei = str_replace("\\", "/", $datei);
        
        // Wenn die Datei existiert, dann einbinden
        if(file_exists($datei)) {
            include $datei;
        }
    }
);
/*$db = mysqli_connect("localhost", "root", "", "php3");
// MySQLI mitteilen, in welchem Zeichenformat die Daten kommen:
mysqli_set_charset($db, "utf8");

function escape($post_var){
    global $db; //keywort, global um die $db variable vom globalen scope zu verwenden
    return mysqli_real_escape_string($db, $post_var);
}*/


session_start(); // dann wird die Session verbunden und man kann mit $_SESSION arbeiten


// AUTOLOADER

function ist_eingeloggt(){
    if(empty($_SESSION["eingeloggt"])){
        header("Location: login.php"); // Benutzer ist noch nicht eingeloggt und wird zum Login geleitet
        exit; //damit der Teil darunter nicht mehr zum Browser geschickt wird. 
    }
}