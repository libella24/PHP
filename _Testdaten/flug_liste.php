<?php
include "funktionen.php";
include "kopf.php";

$datum = date("d.m.Y. - H:i");
echo $datum;


// alle Flüge selektieren
$result = query(
  "SELECT * FROM fluege 
  WHERE abflug > '2024-03-23 11:40'
  ORDER BY abflug DESC;");

//print_r($result);
?>


    <h1>Alle Flüge</h1>

    <div class='row font-weight-bold border-bottom text-center'action="flug_liste.php">
      <div class='col-2'>Flugnummer</div>
      <div class='col-3'>Abflug</div>
      <div class='col-3'>Ankunft</div>
      <div class='col-2'>Startflughafen</div>
      <div class='col-2'>Zielflughafen</div>
    </div>

    <?php


while($row=mysqli_fetch_assoc($result)){
  echo "<div class='row text-center'>";
      echo"<div class='col-2'>".$row["flugnr"]. "</div>";
      echo"<div class='col-3'>".$row["abflug"]. "</div>";
      echo"<div class='col-3'>".$row["ankunft"]. "</div>";
      echo"<div class='col-2'>".$row["start_flgh"]. "</div>";
      echo"<div class='col-2'>".$row["ziel_flgh"]. "</div>";
    echo"</div>";
}



include "fuss.php";
?>
