<?php
include "kreis.php";

$k = new Kreis(3);

echo "Fläche: ".$k->flaeche();
echo "<br>";
echo "Durchmesser: ".$k->durchmesser();
echo "<br>";
echo "Umfang: ".$k->umfang();
echo "<br>";
echo "Umfang - mit dem Durchmesser berechnet: ".$k->umfang1(); //hier berechnen wir den Umfang aufgrund des Durchmessers
echo "<br>";
$k->set_radius(5);
echo "Durchmesser NEU: ".$k->durchmesser();
echo "<br>";

$benutzer_eingabe = -12;

// Try - catch
// =============
// Wird in einem try-Block eine Exception geworfen, dann hat man mit "catch" die Möglichkeit, darauf zu reagieren.

try { //versuchen, das Geworfene zu fangen
    $k->set_radius($benutzer_eingabe);
echo "Durchmesser zum Schluss: ".$k->durchmesser();

} catch (Exception $ex){ //fängt alle Exception Objekte ab, die im try-Block geworfen wurden: throw new Exception("...");
    echo "<br>";
    echo "Da war was falsch.".$ex->getMessage(); 
    echo "<br>";
} finally {
    echo "Das wars wohl.<br>";
}
unset($k);
echo "letzte Ausgabe<br>";

//echo "<br>"; print_r($k);

