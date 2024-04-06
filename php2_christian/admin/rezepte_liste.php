<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";
?>
    <h1>Rezepte</h1>
    <p><a href="rezepte_neu.php">Neues Rezept anlegen</a></p>
<?php

    //$result = query("SELECT * FROM rezepte ORDER BY titel ASC");
    $result = query("SELECT rezepte.*, benutzer.benutzername 
    FROM rezepte LEFT JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
    ORDER BY rezepte.titel ASC");

echo "<table border='1'>";

    echo "<thread>";
        echo "<tr>";
            echo "<th>Titel</th>";
            echo "<th>Beschreibung</th>";
            echo "<th>Benutzer</th>";
            echo "<th>Aktionen</th>";
        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
        while ( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
                echo "<td>". $row["titel"] ."</td>";
                echo "<td>". $row["beschreibung"] ."</td>";
                echo "<td>". $row["benutzername"] ."</td>";
                echo "<td>"
                    . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a> - " 
                    . "<a href='rezepte_entfernen.php?id={$row["id"]}'>Entfernen</a>"
                    ."</td>";
            echo "</tr>";
        }
    echo "</tbody>";
echo "</table>";

?>
<?php

include "fuss.php";
?>