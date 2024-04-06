<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variablen mit PHP</title>
</head>
<body>
    <h1>Variablen mit PHP</h1>
    
    <?php 
    //Ganzzahl (integer) definieren
    $alter = 47; 
    echo "Ich bin ";
    echo $alter; 
    echo " Jahre alt. <br><br>"; 
    //Fließkommazahl (float) definieren
    //===================================
    $float = 13.7103;
    echo "Der EURO wird mit ";
    echo $float;
    echo " umgerechnet.";

    echo "<br><br>";
    //Text (string) einer Variable zuweisen und ausgeben
    //===================================================
    $name = "Peter";
    //ACHTUNG: Variablen im Text
    // Bei doppelten Hochkomma kann Variable im Text enthalten sein.
    // Einfaches Hochkomma benötigt "."
    // VERKETTUNG von Variable/Text-Kombi erfolgt durch "." (Punkt) 
    echo "Ich heiße $name.<br>";
    echo 'Ich heiße ' . $name;
    echo "<br><br>";
    //Aufgabe "Ich habe Peters Stift.":
    // Variante 1:
    echo "Ich habe ";
    echo $name;
    echo "s Stift.";

    echo "<br>";
    // Variante 2:
    echo 'Ich habe ' . $name. 's Stift.';

    //Datentyp: Boolean (true/false)
    //==============================
    echo "<br>";
    $wahr = true;
    echo ">".$wahr."< = true"; //1 wird ausgegeben
    echo "<br>";
    $falsch = false;
    echo ">".$falsch."<= false"; // nix wird ausgegeben
    echo "<br>";
    $nichts = null;
    echo ">".$nichts."<= null";
    echo "<br><br>";

    //=======================
    //== KONSTANTE (const) ==
    //=======================
    define("datenbank", "php23"); //Name, Text - alt, nicht verwenden
    echo datenbank;
    echo "<br>";
    //Neuere Schreibweise
    const datenbank2 = "phpNeu"; //Neu! Verwenden!
    echo datenbank2;
    echo "<br><br>";

    ?>
</body>
</html>