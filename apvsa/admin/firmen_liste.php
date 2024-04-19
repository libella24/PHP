<?php
    include "funktionen.php"; // DB-Zugriff ermöglichen:
      // ist_eingeloggt(); // Prüfung, ob der User eingeloggt ist, wenn nein, dann wird er zur Login-Seite weitergeleitet.
    include "kopf.php";
?>
<h1>Firmenliste</h1>
<p><a href="firmen_neu.php">Neue Firma anlegen</a></p>

<?php
// (1) Alle Firmen selektieren
// =============================

$result = query("SELECT id, bezeichnung, ort, benutzer
    FROM firmen 
    ORDER BY bezeichnung ASC"
    );

// Zwischenzeitlich das Array anschauen, das mit der Abfrage herauskommt
//print_r($result);

// (2) Die Tabelle aufbauen (Kopfzeile), in der die Firmen angezeigt werden sollen
// =====================================================================

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th> Bezeichnung</th>";
            echo "<th> Ort</th>";
            echo "<th> Benutzer</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// (3) Jede Zeile durchiterieren und in ein Array packen
// ======================================================
//     Im $result wird jede zuuvor selektierte Zeile gespeichert (Pkt. 1) 
//     Für jede Zeile wird eine Tabellenzeile erstellt

while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>". $row["bezeichnung"] . "</td>";
    echo "<td>". $row["ort"] . "</td>";
    echo "<td>". $row["benutzer"] . "</td>";
    echo "<td>". "<a href='firma_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>". "</td>"; // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";


?>

<?php
include "fuss.php";


?>