<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Arrays in PHP"; $cssClass = "red";?></title>
</head>
<body class="<?php echo "gruen"; ?>">
    
    <?php
    echo "<h1>Arrays in PHP</h1>"; //PHP kann überall stehen und dynamisch verwendet werden
    //
    //Nummerisches Array definieren
    //==============================

    // Der Index startet bei 0 (wie JavaScript)
    $namen = array ("Katharina", "Jonathan", "Julia", "Peter");
    echo $namen[0]. " und " . $namen[2];
    echo "<br><br>";

    //Eintrag am Ende hinzufügen
    $namen[] = "Mario"; //Das System vergibt den Index

    //Liste mit Index anzeigen
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";

    //Inhalt pro Index anzeigen
    $index = 3;
    echo $namen[$index];
    echo "<br>";
    echo $namen[$index+1];
    echo "<br><br>";

    //Assoziatives Array definieren (Index ist ein Text)
    //===================================================
    $person = array(
        "name" => "Markus",
        "alter" => 63,
        "ort" => "Salzburg"
    );
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($person); //nur für den internen Gebrauch
    echo "</pre>";
    
    //Beispiel: "Markus (63) aus Salzburg
    //Variante 1 - Variablen mit Punkt aneinanderketten
    echo $person["name"] . " (". $person["alter"]. ") aus ". $person["ort"];
    echo "<br><br>";
    //Variante 2 - in einer Zeile zusammenfassen 
    echo "{$person["name"]} ({$person["alter"]}) aus {$person["ort"]}";
    echo "<br><br>";

    // Assoziatives Array erweitern
    // =============================

    $person["guthaben"] = 100;

    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($person); //nur für den internen Gebrauch
    echo "</pre>";

    // Mehrdimensionales Array (Array in einem Array)
    // ===============================================

    // Ein Array hat mehrere Arrays

    $personen = array ( //numerisches Array - jeder Eintrag (nummer) hat ein Array
        array(   //assoziatives Array
            "name" => "Herbert",
            "alter" => 33,
            "ort" => "Linz"
        ),
        array(   //assoziatives Array
            "name" => "Luise",
            "alter" => 58,
            "ort" => "St. Gallen"
        ),
        array(   //assoziatives Array
            "name" => "Anja",
            "alter" => 18,
            "ort" => "Schörfling"
        ),
        $person   //Variable wurde im Scriptverlauf zuvor erstellt
    );

    // Arrays mit Index usw. ausgeben

    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($personen); //nur für den internen Gebrauch
    echo "</pre>";
    echo "<br><br>";

    // Ausgabe Linz

    echo $personen[0]["ort"]; //Array - Index - inneres Array/gewünschter Eintrag
    echo "<br><br>";

    // Ausgabe Ich bin Herbert, bin 18 Jahre alt und habe ein Guthaben von 100 EUR.

    echo "Ich bin ".$personen[0]["name"]. ", bin ".$personen[2]["alter"]." Jahre alt und habe ein Guthaben von ". $personen[3]["guthaben"]." EUR.";
    

    ?>

    
</body>
</html>