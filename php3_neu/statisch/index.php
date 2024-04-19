<?php

// z.B., um Datenbankverbindungen zu speichern

include "Statisch.php";

$neu = new Statisch();
$neu2 = new Statisch();
$neu3 = new Statisch(); // Die Variable "$id" gilt für alle gleich

echo Statisch::$id; // die Variable gibt es nur 1 x und ist der Klasse "Statisch" zugeordnet.
echo "<br>";
Statisch::set_to_0();

echo Statisch::$id;
