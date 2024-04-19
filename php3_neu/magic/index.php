<?php

error_reporting(E_ALL); // PHP meldet alle Fehlerarten

include "Magic.php";

$m = new Magic(); // macht ein Objekt vom Typ Magic
// vorname ist nirgens definiert --> Variable = vorname, Wert = Maria

// Magic method = __set()
// ========================
$m->vorname = "Maria"; 
$m->nachname = "Huber";

// Magic method: __get()
// ========================
echo $m->nachname;

// Magic method __call()
// ========================
$m->speichern("benutzer", "insert", 5);

// Magic method __toString()
// ========================
echo $m; // wandelt in einen String um 
//echo "<pre>"; print_r($m);

