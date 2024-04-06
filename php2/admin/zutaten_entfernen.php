<?php
include "funktionen.php";
ist_eingeloggt();

include "kopf.php";

echo "<h1>Zutat entfernen</h1>";
// Sicherheitsabfrage
// Zutat, die verwendet wird, darf nicht gelöscht werden.

// ID aufrufen, die der User in der Zutatenliste markiert hat
// ===========================================================
$sql_id = escape($_GET["id"]); //escape Funktion auf ID anwenden.

if(!empty($_GET["doit"])){
    //Bestätigungslink wurde geklickt --> Nachfrage, ob der Eintrag wirdklich in der DB gelöscht werden soll
    // Doit ist selbst erfundener Eintrag, der die Sicherheitsabfrage dokumentiert.
    query("DELETE FROM zutaten where id ='{$sql_id}'"); 
    echo "<p>Zutat wurde erfolgreich entfernt.<br> 
    <a href='zutatenliste.php'> Zurück zur Liste</a>
    </p>";
}else{
    //Benutzer fragen, ob die Zutat wirklich entfernt werden soll
    $result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}' ");
    $row = mysqli_fetch_assoc($result);

    //Prüfen, ob die Zutat noch in einem Rezept vorkommt
    $result2("SELECT * FROM zutaten_zu_rezepte WHERE zutaten_id = '{$sql_id}'");
    $ist_mit_rezept_verknüpft = mysqli_fetch_assoc($result2);


if(empty($row)){
    //wenn die Zutat nicht existiert...
    echo "<p>Diese Zutat existiert nicht (mehr)!<br>
    <a href='zutatenliste.php'>Zurück zur Liste</a>
    </p>";
}else if ($ist_mit_rezept_verknüpft){
    //Sicherheitsabfrage
    echo "<p>Diese Zutat ".htmlspecialchars($row["titel"])."wird noch in einem Rezept verwendet und darf nicht entfernt werden.</p>";
    echo "<p><a href='zutatenliste.php'>Zurück zur Liste</a></p>";
}else { //die Sicherheitsabfrage wurde gestellt, Zutat kann gelöscht werden
    echo "<p>Sind Sie sicher, dass Sie diese Zutat".htmlspecialchars($row)["titel"]. "entfernen möchten?";
}
    echo "<p>"
    "<a href='zutaten_entfernen.php?id={$row['id']}&amp;doit=1'>Ja</a>"
        "<a href='zutatenliste.php'>Nein</a>"
        "</p>"; 
}  




include "fuss.php"
?>