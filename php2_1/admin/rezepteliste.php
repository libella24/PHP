<?php
    include "funktionen.php"; // DB-Zugriff ermöglichen:
      // ist_eingeloggt(); // Prüfung, ob der User eingeloggt ist, wenn nein, dann wird er zur Login-Seite weitergeleitet.
    include "kopf.php";
?>
<h1>Zutaten</h1>
<p><a href="rezepte_neu.php">Neues Rezept anlegen</a></p>

<?php
// (1) Alle Rezepte selektieren
// =============================

$result = query("SELECT rezepte.*, benutzer.benutzername 
    FROM rezepte 
    JOIN benutzer ON rezepte.benutzer_id = benutzer.id 
    ORDER BY titel ASC"
    );

// Zwischenzeitlich das Array anschauen, das mit der Abfrage herauskommt
print_r($result);

// (2) Die Tabelle aufbauen, in der die Rezepte angezeigt werden sollen
// =====================================================================

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th> Titel</th>";
            echo "<th> Beschreibung</th>";
            echo "<th> Benutzer</th>";
            echo "<th> Aktionen</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";



// (3) Jede Zeile durchiterieren und in ein Array packen
// ======================================================
//     Im $result wurde zuvor jede Zeile selektiert (Pkt. 1) 
//     Für jede Zeile wird eine Tabellenzeile erstellt

while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>". $row["titel"] . "</td>";
    echo "<td>". $row["beschreibung"] . "</td>";
    echo "<td>". $row["benutzername"] . "</td>";
    echo "<td>"
    . "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>Bearbeiten</a> - " // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
    . "<a href='rezept_entfernen.php?id={$row["id"]}'>Entfernen</a>"
    . "</td>"; // dieser Link ist die URL beim Aufruf der Seite "zutaten_bearbeiten"
    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";


?>

<?php
include "fuss.php";


?>