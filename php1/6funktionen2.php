<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funktionen für Arrays</title>
</head>
<body>
    <h1>Funktionen für Arrays</h1>
    <?php
    //==========================
    // Funktionen für Arrays
    //===========================

    $namen = array("Peter", "Sonja", "Klara", "Klaus", "Franziska", "Mario", "Christian", "Mario", "Peter");

    //Elemente in einem Array zählen (count)
    //======================================

    echo count($namen);
    echo "<br>";

    //kann auch einer Variable zugeordnet werden, um diese später wieder verwendne zu können
   // $anzahl count ($namen);

    //Zufälligen Namen ausgeben (array_rand)
    //======================================

    $index = array_rand($namen); // gibt nur den Index aus
    echo $index;
    echo "<br>";
    
    echo $namen[$index];
    echo "<br><br>";
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";
    echo "<br><br>";

    //Doppelte Werte entfernen
    //=========================

    array_unique($namen); //bestehendes Array bleibt bestehen, 
    //generiert neues Array mit uniquen Werten
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";
    echo count ($namen);
    echo "<br><br>";

    //Prüfen, ob ein Wert im Array existiert (in_array)
    //===================================================

    // liefert nur ja oder nein retour, deshalb if-else
    // z.B. Benutzer anlegen - nicht die ganze Liste anzeigen, nur Bitte wähle anderen Namen (Benutzername ODER Kennwort falsch!) Alles offen lassen - Sicherheit

    if (in_array("Mario", $namen)){
        echo "Diese Person ist registriert";
    } else {
        echo "Diese Person gibt's bei uns NICHT!";
    };
    echo "<br><br>";

    // Alphabetisch aufsteigend nach Namen sortieren (asort)
    //=======================================================

    // Eintrag behält den Index
    // z.B. Drop-down alphabetisch anzeigen aber ID (die in der DB ist) gleich zu lassen

    asort($namen);
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";

    // Wert im Nachhinein hinzufügen (array_push)
    //=======================================================
    $namen[] = "Herbert";
    array_push($namen, "Gerhard", "Regina");
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";

    // Sortieren und Indizes neu zuweisen (sort)
    //=======================================================
    // ACHTUNG! Der Index wird dadurch neu vergeben. 
    // In der Datenbank bleibt aber der bisherige Index!!!

    sort($namen);
    echo "<pre>"; // formatiert als Liste und mit Array-Bezeichnung
    print_r($namen); //nur für den internen Gebrauch
    echo "</pre>";

    echo "<br><br>";

    // Bsp: Grad in Fahrenheit umrechnen

    

   





    


    ?>

</body>
</html>