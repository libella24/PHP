<?php

// Autoload - Laden der eigenen Dateien steuern
// =============================================
// Alles, was mit WIFI/JWE beginnt, wird dadurch geladen
// erhält Klassennamen mit Namespace, die noch nicht included wurden.  Diesen können wir in einen Dateipfad umwandeln und die Datei danach einbinden. Wird für jede Klasse bei der ersten Verwendung automatisch aufgerufen.
spl_autoload_register(
    function(string $klasse){ // "leere" Funktion; die Klasse wird übergeben
        // Projektspezifisches Namespace Präfix
        $prefix = "WIFI\\JWE\\"; // der 2. Backslash ist zum escapen, es zählt nur 1 Backslash - für die substr Funktion später...
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
// Funktion ist Argument für das Auto-Loading. Kümmert sich um das Inkludieren der einzelnen Dateien. 


// Das index.php wird am Browser angezeigt, in den anderen Seiten sind die Klassen, die mit "new" initialisiert werden, definiert

/*

include "Tier/TierAbstract.php"; // muss vor den anderen Tieren vorhanden sein
include "Tier/Hund.php";
include "Tier/Katze.php";
include "Tier/Maus.php";*/

// Namespace verknüpfen
// =====================
// in den untergeordneten Dateien muss der entsprechende Namespace definiert sein.
use WIFI\JWE\Tier\Hund\Dogge;
use WIFI\JWE\Tier\Hund;
use WIFI\JWE\Tier\Katze;
use WIFI\JWE\Tier\Maus; 
use WIFI\JWE\Tiere;

$dogge = new Dogge  ("Spike: "); // Ich brauche eine Klasse, die Hund heißt...
// "new" ist auch gleichzeitig der Aufruf des Construktors

$hund = new Hund  ("Bello: "); // Ich brauche eine Klasse, die Hund heißt...
// "new" ist auch gleichzeitig der Aufruf des Construktors

$katze = new Katze  ("Tom: "); // Ich brauche eine Klasse, die Hund heißt...


$maus = new Maus  ("Jerry: "); // Ich brauche eine Klasse, die Hund heißt...

$tiere = new Tiere();
$tiere->add($dogge);
$tiere->add($hund);
$tiere->add($katze);
$tiere->add($maus);
$tiere->add(new Maus("Mickey")); // Das Objekt ann auch direkt erstellt und als Parameter übergeben werden

echo $tiere->ausgabe();

foreach ($tiere as $tier) {
    echo "<br>";
    echo $tier->get_name();
}
