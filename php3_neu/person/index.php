<?php

// Objekt muss hier erstellt werden - Klassendefinition einbinden 

include "Person.php";

// Objekt erzeugen aus der Klasse "Person"
// Instanz erstellen
$ich = new Person("Regina"); // "new" = Stichwort, ruft Construktor auf - "Regina" wandert in die Variable $name, aber noch nicht in die Property/Eigenschaft.

echo  $ich->vorstellen(); //im $ich ist das Regina array vorhanden, die Funktion "Vorstellen" wird ausgeführt.
echo "<br>";

$ich->set_vorname("Regina");

echo $ich->get_vorname();
echo "<br>";

// Weiteres Objekt erstellen
$sie = new Person("Sabrina");
echo $sie->vorstellen();

echo "<br>";

