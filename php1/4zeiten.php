<?php
// =============== //
//  Z e i t e n    //
// =============== //

$timestamp = time(); // gibt den UNIX Timestamp aus (Sekunden ab 1.1.1970)
$datum = date("d.m.Y. - H:i", $timestamp);
echo $datum;
echo time();

// oder auch
echo "<br><br>";
$datum = date("d.m.Y. - H:i");
echo $datum;

echo "<br><br>";

// Auf die MET umrechnen - +1 Stunde
// ==================================
$time = date("Y-m-d h:i")+1; //die Zeitzone richtet sich nach dem Server, liefert einen Wert von 0-24
echo $time. "time";

// d = Tag des Monats 2-stellig = d
// m = Nummer des Monats 2-stellig = m
// n = Nummer des Monats 1-stellig = n
// y = Jahr 2-stellig = y
// Y = Jahr 4-stellig = Y
// H = Stunden (24-std.) = H

// Ausgabe des Wochentages auf Deutsch:
// ====================================

$tage = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
$tag = date("w"); // Ausgabe des Wochentages als Nummer
echo $tage[$tag]; // Gib mir den Tag mit der Nummer ... aus dem Array $tage.

echo "<br><br>";

//Ausgabe des Monatsnamens auf Deutsch:
// ====================================

// Monat auf Deutsch ausgeben
// Weil es keinen 0. Monat gibt, muss man ein assoziatives Array - mit Zahlen - machen

$monate = array(1=>"Jänner", 2=>"Februar", 3=>"März", 4=>"April", 5=>"Mai", 6=>"Juni", 7=>"Juli", 8=>"August", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Dezember");
$monat = date("n");
echo $monate[$monat];


// UNIX Timestamp erzeugen (STRTOTIME)
// ===================================

echo "<br><br>";

echo strtotime("+1 day")."<br />";
echo strtotime("+1 week")."<br />";
echo strtotime("+1 week 2 days 4 hours 2 seconds")."<br />";
echo strtotime("next Thursday")."<br />";
echo strtotime("last Monday")."<br />";
?>