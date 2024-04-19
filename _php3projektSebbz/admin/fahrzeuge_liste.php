<!-- 
//////////////////
Fahrzeuge ausgeben
//////////////////
-->

<?php

include "setup.php";
ist_eingeloggt();

// verlinkt auf die Klasse "Fahrzeuge", die von dieser Datei aus gesehen unter Fdb\Model\Fahrzeuge liegt. Daher usen...

use WIFI\Php3\Fdb\Model\Fahrzeuge;



?>

<h1>Fahrzeug-Liste</h1>

<?php

    echo "<p><a href='fahrzeuge_bearbeiten.php'>Fahrzeug erfassen</a></p>";
    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
        echo "<th>Kennzeichen</th>";
        echo "<th>Marke</th>";
        echo "<th>Farbe</th>";
        echo "<th>Baujahr</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

    $fahrzeuge = new Fahrzeuge();
    $alle_fahrzeuge = $fahrzeuge->alle_fahrzeuge(); // gibt "Fahrzeug" Objekte als Array zurück

    foreach ($alle_fahrzeuge as $auto) { //bei dieser foreach Schleife brauchen wir nicht den Key, deshalb kann man den auch weglassen
        echo "<tr>";
            echo "<td>" . $auto->kennzeichen . "</td>";
            echo "<td>" . $auto->get_marke()->marke . "</td>";
            echo "<td>" . $auto->farbe . "</td>";
            echo "<td>" . $auto->baujahr . "</td>";
            echo "<td>"."<a href='fahrzeuge_bearbeiten.php?id={$auto->id}'>Bearbeiten</a>"."</td>";
            echo "<td>"."<a href='fahrzeuge_entfernen.php?id={$auto->id}'>Entfernen</a>"."</td>";
        echo "</tr>";

    }
/*
    while ($row = mysqli_fetch_assoc($result)) {
        //print_r($row);
        echo "<tr>";
        echo "<td>". $row["titel"]."</td>";
        echo "<td>". $row["beschreibung"]."</td>";
        echo "<td>". $row["benutzername"] . "</td>";
        echo "<td>". $row["benutzername"] . "</td>";
        echo "<td>" . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>";
        echo "<td>" . "<a href='rezepte_entfernen.php?id={$row["id"]}'>Entfernen</a>";
        echo "</tr>";
    }*/

    echo "</tbody>";
    echo "</table>";


    /*
    $db = Mysql::getInstanz();
    $ergebnis = $db->query("SELECT * FROM fahrzeuge");
    $fahrzeuge = $ergebnis->fetch_assoc();
    //echo "<pre>"; print_r($benutzer);

    if (empty($fahrzeuge)) {
        // Fehler: Eingegebener Benutzer existiert nicht
        $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
    } else {

        echo "<h1>Fahrzeuge</h1>";
        echo "<p><a href='fahrzeuge_bearbeiten.php'>Fahrzeuge bearbeiten</a></p>";

        echo "<table border='1'>";

        echo "<thread>";
        echo "<tr>";
            echo "<th>Titel</th>";
            echo "<th>Beschreibung</th>";
            echo "<th>Benutzer</th>";
        echo "</tr>";
        echo "</thread>";
        echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                //print_r($row);
                echo "<tr>";
                echo "<td>". $row["titel"]."</td>";
                echo "<td>". $row["beschreibung"]."</td>";
                echo "<td>". $row["benutzername"] . "</td>";
                echo "<td>" . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>";
                echo "<td>" . "<a href='rezepte_entfernen.php?id={$row["id"]}'>Entfernen</a>";
                echo "</tr>";
            }

        echo "</tbody>";
        echo "</table>";

    }


    //SQL JOINS (da gibt es verschiedene, Siehe Google Bilder)
    /*$result = mysqli_query($db, "SELECT rezepte.*, benutzer.benutzername 
    FROM rezepte LEFT JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
    ORDER BY rezepte.titel ASC"); */

    //print_r($result);

    
?>

<?php

include "fuss.php";

?>