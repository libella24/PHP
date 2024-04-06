<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funktionen</title>
</head>
<body>
    <h1>Funktionen</h1>
    <p>Werden zwecks Wiederverwendung verwendet.
        - vordefinierte Funktionen (siehe php Doku)
        - selbst definierte Funktionen
    </p>
    <p>JS Prüfungen müssen am Server ebenfalls erfolgen
        z.B. Texteingaben prüfen (plausibles Geburtsdatum)
    </p>
    <?php

    //==========================
    // Funktionen für Strings
    //===========================

    //String in Kleinbuchstaben umwandeln
    $text = "Herzlich Willkommen!";
    echo strtolower($text);
    echo mb_strtolower($text); //schreibt auch Sonderzeichen klein - wichtig bei anderen Schriftarten!
    echo "<br><br>"; 
    //mb_strtolower --> kann auch Sonderzeichen klein schreiben

    //Leerzeichen vor/nach einem Text entfernen
    $text = "     Herzlich    Willkommen   ";
    echo trim($text, "n e"); //entfernt von außen nach innen
    echo "<br><br>";

    // HTML Code aus String entfernen (strip_tags)

    $text = "Das ist <strong> fett</strong> und <em>kursiv</em> und überhaupt im Text.";
    echo $text. "<br>";
    echo strip_tags ($text,"<em> <strong>"); // im 2. Parameter werden die erlaubten Tags eingetragen.
    //bei mehreren Tags - einfach mit Space getrennt aneinanderketten
    echo "<br><br>";

    // Die Länge eines Strings zählen (strlen bzw. mb_strlen)

    echo strlen($text); // zählt z.B. Umlaute als 2 Zeichen
    echo "<br>";
    echo mb_strlen($text, "utf-8"); // zählt z.B. Umlaute als 1 Zeichen, 
    // das gewünschte Encoding kann als Parameter angegeben werden (muss aber nicht).
    echo "<br><br>";

    // Teil aus einem Text extrahieren

    $text = "Ich bin 43 Jahre alt.";
    echo substr($text, 8, 2); // Beim wievielten Zeichen beginnt der gewünschte String 
    // und wieviele Zeichen mag ich ab dieser haben
    echo "<br>";
    echo $text[8]; // Einzelne Zeichen 
    echo substr($text, -12, 2);
    echo "<br><br>";

    // Zeilenumbrüche in <br> umwandeln (nl2br)

    $text = 
    "Herzliche Willkommen
    im WIFI
    Salzburg";
    echo nl2br($text); //new lines to break
    echo "<br><br>";

    











    ?>
    
    
</body>
</html>