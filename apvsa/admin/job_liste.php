<?php

include "setup.php";
ist_eingeloggt();

use WIFI\apvsa\classes\Jobs;
   
?>
<h1>Job Liste</h1>
<p><a href="job_neu.php">Neuen Job anlegen</a></p>

<?php
// Liste - Kopfzeile

echo "<table border='1'>";
    echo "<thread>";
        echo "<tr>";
            echo "<th> Titel</th>";
            echo "<th> Firma</th>";
            echo "<th> Dienstort</th>";
        echo "</tr>";
    echo "</thread>";
echo "<tbody>";

// Die Klasse "Jobs" selektiert alle Stellen
// mit foreach werden sie in eine Liste geschrieben

$jobs = new Jobs();
$all_jobs = $jobs->all_jobs();

echo "<pre>";print_r($all_jobs);echo "</pre>"; // in $all_jobs stehen alle drinnen :-)

foreach ($all_jobs as $row) {
    echo "<tr>";
    echo "<td>". $row->titel . "</td>";
    echo "<td>". $row->beschreibung . "</td>";
    echo "<td>". $row->profil . "</td>";
    echo "<td>". $row->dienstort . "</td>";
    echo "<td>". $row->stunden . "</td>";
    echo "<td>". $row->gehalt . "</td>";
    // die URL der Position wird erzeugt
    echo "<td>". "<a href='job_bearbeiten.php?id={$row->id}'>Bearbeiten</a>". "</td>"; // URL zum Bearbeiten des Jobs
    echo "<td>". "<a href='job_loeschen.php?id={$row->id}'>Entfernen</a>". "</td>"; // URL zum Löschen des Jobs
    echo "</tr>";

}

echo "</tbody>";
echo "</table>";

include "fuss.php";

?>