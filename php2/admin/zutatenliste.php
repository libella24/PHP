<?php
    include "funktionen.php"; // DB-Zugriff ermöglichen:
      // ist_eingeloggt(); // Prüfung, ob der User eingeloggt ist, wenn nein, dann wird er zur Login-Seite weitergeleitet.
    include "kopf.php";
?>
<h1>Zutaten</h1>
<p><a href="zutaten_neu.php">Neue Zutat anlegen</a></p>

<?php
// (1) Alle Zutaten selektieren
// =============================

$result = mysqli_query($db, "SELECT * FROM zutaten ORDER BY titel ASC");

// Zwischenzeitlich das Array anschauen, das mit der Abfrage herauskommt
//print_r($result);

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th> Titel</th>";
            echo "<th> Kcal pro 100 g</th>";
            echo "<th> Menge</th>";
            echo "<th> Einheit</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// (2) Jede Zeile durchiterieren und in ein Array packen
// ======================================================

while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>". $row["titel"] . "</td>";
    echo "<td>". $row["kcal_pro_100"] . "</td>";
    echo "<td>". $row["menge"] . "</td>";
    echo "<td>". $row["einheit"] . "</td>";
    // die URL der Position wird erzeugt
    echo "<td>". "<a href='zutaten_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a>". "</td>"; // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
    echo "<td>". "<a href='zutaten_entfernen.php?id={$row["id"]}'>Entfernen</a>". "</td>"; // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";
?>

<?php
include "fuss.php";


?>