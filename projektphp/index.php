<?php

// Seite aufrufen
// ==============================

if (empty($_GET["seite"])){//Existiert die Seite? Fehler abwenden
    $site = "home";
} else {
    $site = $_GET["seite"]; //über GET-Parameter ansteuerbar
};
if ($site == "home") {
    $include_datei = "home.php";
    $seitentitel = "Dahoam";
    $metadescription = "Seite, auf der man zuerst landet.";
} else if ($site == "leistungen") {
    $include_datei = "leistungen.php";
    $seitentitel = "Waschen-schneiden-föhnen";
    $metadescription = "Anzeige der Leistungen, die bei diesem Friseur angeboten werden";
} else if($site == "kontakt") {
    $include_datei = "kontakt.php";
    $seitentitel = "TreffenKontakt";
    $metadescription = "Informationen zur Kontaktaufnahme.";
} else if($site == "oeffnungszeiten"){
    $include_datei = "oeffnungszeiten.php";
    $seitentitel = "EmpfangOeff";
    $metadescription = "Zu diesen Zeiten ist der Friseur für Sie da.";
} else {
    $include_datei = "error404.php";
    $seitentitel = "SchleichDi";
    $metadescription = "Also hier bist Du leider komplett falsch";
};

// "$include_datei" definieren:
// ==============================



include "kopf.php"; //dieser Befehl muss unten stehen, weil zuvor noch ein paar Definitionen vorhanden sein sollen

include "inhalte/$include_datei";

include "fuss.php";

// Die INDEX.PHP muss im Root-Verzeichnis liegen
// der Ende-PHP-Tag muss nicht unbedingt sein, weil wir keinen HTML-Code haben
