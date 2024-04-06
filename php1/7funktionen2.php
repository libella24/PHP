<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funktionen 3 in PHP</title>
</head>
<body>
    <?php

    // Aufgabe: Grad in Fahrenheit umrechnen

    // Funktion Struktur:
    // ===================

    // Funktion ohne Parameter: Gib mir alle Benutzer

    //Bezeichnung "function"
    // Name der Funktion
    // Parameter () - müssen nicht befüllt sein
    // Funktionsbereich {}
    // gibt Fahrenheit aus. (return)

    function celsius_in_fahrenheit($celsius){ //Wirkungsbereich in geschwungender Klammer
        $fahrenheit = $celsius * 1.8 + 32;
        return $fahrenheit;
    }
    $grad = 20; //Variable
    echo celsius_in_fahrenheit(15);
    echo "<br>";
    echo celsius_in_fahrenheit($grad);
    echo "<br><br>";

    // global Variable wieder verwenden
    // static gleichen Variablenwert wieder verwenden

    // Datum formatieren (date_format)
    // =================================
function de_datum($datum_falsch){
    $tag = substr($datum_falch, 8,2);
    $monat = substr($datum_falsch, 5,2);
    $jahr = substr($datum_falsch, 0,4);
    return $tag . ".§ " . $monat . "." . $jahr;
}
    
    
    
    $datum_mysql = date_create ("2024-02-24"); // aus der Datenbank kommt folgendes Datum
    // Ziel: 24.02.2024
    echo date_format($datum_mysql, 'd.m.Y');
    echo "<br>";

    // echo de_datum($datum_mysql);
    
   // function de_datum_mit_date($datum_falsch){
    //    $time = strtotime($datum_falsch);
    //    $d =

    // explode


    // Zeichenkette nach 10 Zeichen abschneiden und "..." anhängen
    
    
    function text_abschneiden($text_lang, $laenge = 10){
       if (strlen($text_lang) >= $laenge){
        $text_kurz = substr($text_lang, 0, $laenge);
        return $text_kurz . "...";
       } else {
        return $text_lang;
       }
    } 
    $text = "Lorem ipsum dolor";
    echo $text;
    echo "<br><br>";
    echo text_abschneiden($text, 30);

    

    





    



    ?>
    
</body>
</html>