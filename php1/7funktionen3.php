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

    function celsius_in_fahrenheit($celsius){ //Wirkungsbereich in geschwungender Klammer
        $fahrenheit = $celsius *1.8 + 32;
        return $fahrenheit;
    }
    $grad = 20;
    echo celsius_in_fahrenheit(15);
    echo "<br>";
    echo celsius_in_fahrenheit($grad);
    echo "<br><br>";

    // Datum formatieren (date_format)

    $datum_mysql = date_create ("2024-02-24"); // aus der Datenbank kommt folgendes Datum
    // Ziel: 24.02.2024
    echo date_format($datum_mysql, 'd.m.Y');
    echo "<br>";

    // Zeichenkette nach 10 Zeichen abschneiden und "..." anhängen
    
    
    function text_abschneiden($text_lang, $laenge){
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