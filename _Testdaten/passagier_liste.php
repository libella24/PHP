<?php
include "funktionen.php";

include "kopf.php";
?>
    <h1>Passagiere</h1>
    <p><a href="passagier_neu.php">Passagier anlegen</a></p>
<?php
    
    $result = query("SELECT passagiere.*, fluege_zu_passagiere.* 
    FROM passagiere
    JOIN fluege_zu_passagiere ON passagiere.id = fluege_zu_passagiere.passagier_id 
    ORDER BY passagiere.nachname ASC");

echo "<pre>";
print_r($result);
echo "</pre>";

echo "<table border='1'>";

    echo "<thread>";
        echo "<tr>";
            echo "<th>Vorname</th>";
            echo "<th>Nachname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Flugangst</th>";
            echo "<th>Flug</th>";
        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
        while ( $row = mysqli_fetch_assoc($result) ) {
            echo "<tr>";
                echo "<td>". $row["vorname"] ."</td>";
                echo "<td>". $row["nachname"] ."</td>";
                echo "<td>". $row["geburtdatum"] ."</td>";
                echo "<td>". $row["flugangst"] ."</td>";
                echo "<td>". $row["flug_id"] ."</td>";
                
            echo "</tr>";
        }
    echo "</tbody>";
echo "</table>";

?>
<?php

include "fuss.php";
?>