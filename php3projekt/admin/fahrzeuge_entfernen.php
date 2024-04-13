<?php
include "setup.php";
ist_eingeloggt();
include "kopf.php";

echo "<h1>Fahrzeug entfernen</h1>";

use WIFI\PHP3\Fdb\Validieren;
use WIFI\PHP3\Fdb\Model\Row\Fahrzeug;
use WIFI\PHP3\Fdb\Model\Marken;

$fahrzeug = new Fahrzeug($_GET["id"]);

if(!empty($_GET["doit"])){

   $fahrzeug->entfernen();
    echo "<p>Das Fahrzeug wurde erfolgreich entfernt.<br> 
    <a href='fahrzeuge_liste.php'> Zurück zur Liste</a>
    </p>";
}else{
    //Benutzer fragen, ob die Zutat wirklich entfernt werden soll
    echo "<p>Sind Sie sicher, dass Sie das Fahrzeugentfernen möchten?</p>";
    echo "<strong>Kennzeichen: </strong>". $fahrzeug->kennzeichen . "<br>";
    echo "<strong>Marke: </strong>". $fahrzeug->get_marke()->hersteller  . "<br>";
    echo "<strong>Farbe: </strong>". $fahrzeug->farbe . "<br>";
    echo "<strong>Baujahr: </strong>". $fahrzeug->baujahr . "<br>";
    echo "<p>"
    ."<a href='fahrzeuge_liste.php'>Nein, abbrechen.</a>
    <a href= 'fahrzeuge_entfernen.php?id={$fahrzeug->id}&amp;doit=1'>Ja</a>"
    ."</p>"; 
} 



include "fuss.php"
?>