<?php
    include "funktionen.php"; // DB-Zugriff ermöglichen:
      // ist_eingeloggt(); // Prüfung, ob der User eingeloggt ist, wenn nein, dann wird er zur Login-Seite weitergeleitet.
    include "kopf.php";
?>
<h1>Zutaten</h1>

<!-- Link auf "Neue Zutat anlegen" -->
<p><a href="zutaten_neu.php">Neue Zutat anlegen</a></p>

<?php
// (1) Alle Zutaten selektieren und in $result packen
// ==================================================

$result = mysqli_query($db, "SELECT * FROM zutaten ORDER BY titel ASC");

// Zwischenzeitlich das Array anschauen, das mit der Abfrage herauskommt
print_r($result);

// (2) Die Kopfzeile der Tabelle aufbauen
// ==================================

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th> Titel</th>";
            echo "<th> Kcal pro 100 g</th>";
            echo "<th> Menge</th>";
            echo "<th> Einheit</th>";
            echo "<th> Aktionen</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// (3) Jede Zeile durchiterieren und in ein Array packen
// ======================================================
//     jede Zeile ist in der Variable "$row" abrufbar

while ($row = mysqli_fetch_assoc($result)){

// (4) Listeneinträge anzeigen
// ============================
        // Zugriff auf die einzelnen Zeilen mit der Variable "$row" und der angabe des Feldes ["..."]

    echo "<tr>";
    echo "<td>". $row["titel"] . "</td>";
    echo "<td>". $row["kcal_pro_100"] . "</td>";
    echo "<td>". $row["menge"] . "</td>";
    echo "<td>". $row["einheit"] . "</td>";

// (5) Die Links zur Seite "Bearbeiten" und "Entfernen" aufbauen
// ==============================================================
//      Dabei wird im "a" Tag der Pfad nach dem "admin" Verzeichnis nachgebaut.
//      Die ID wird verwendet, um die gewünschte Zeile aus der DB zu erhalten ($row) -
//      Dazu wird der Suchparameter gebaut: "?id={$row}["id"]
    echo "<td>"
        . "<a href='zutaten_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a> - " // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
        . "<a href='zutaten_entfernen.php?id={$row["id"]}'>Entfernen</a>"
        . "</td>"; 
    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";
?>

<?php
include "fuss.php";


?>