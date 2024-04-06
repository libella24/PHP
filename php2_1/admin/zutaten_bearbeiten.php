<?php
include "funktionen.php";
ist_eingeloggt();

$sql_id = escape($_GET["id"]); //escape Funktion auf ID anwenden.

$erfolg = false;

// (1) Formular wurde abgeschickt, eingegebene Daten werden validiert
// ===================================================================
// wenn das Formular abgeschickt wurde (die POSTs sind nicht leer)....

if(!empty($_POST)){ // .... dann werden Daten validiert
    $sql_titel = escape($_POST["titel"]); 
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    if(empty($sql_titel)) { // darf nicht "titel" sein, weil hier ja die escape darauf liegt... oder so...
        $errors[]="Bitte geben Sie den Titel an."; 
    } else { 
// Der Titel darf geändert werden, allerings darf es keine andere Zutat (mit anderer ID) mit demselben Titel geben 
        $result = query("SELECT * FROM zutaten 
                            WHERE titel = '{$sql_titel}'
                            AND id != '{$sql_id}'");
    
        $row = mysqli_fetch_assoc($result); 

        if($row){
            $errors[]="Diese Zutat existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht

        }
    }
    if(empty($errors)){ /// Werte deren Wert NOCH nicht feststeht, sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
        if($sql_kcal_pro_100 == ""){
            $sql_kcal_pro_100 = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_menge == ""){
            $sql_menge = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_einheit == ""){
            $sql_einheit = "NULL"; // wird dann leer angezeigt.
        }
        // dann können wir die Zutat in die DB schreiben...
        query("UPDATE zutaten SET 
            titel = '{$sql_titel}', 
            kcal_pro_100 = {$sql_kcal_pro_100}, 
            menge = {$sql_menge}, 
            einheit = '{$sql_einheit}'
        WHERE id = '{$sql_id}'
        ");

        $erfolg = true;
    }

}



include "kopf.php";

?>
    <h1>Zutat bearbeiten</h1>
<?php
// Fehler werden hier ausgegeben 
if(!empty($errors)){
    foreach($errors as $key => $error){
        echo "<li>".$error."</li>";
    }
    echo "<ul>"; 
}

// Erfolgsmeldung
if($erfolg){
    echo "<p>Die Zutat wurde erfolgreich bearbeitet.<br>
    <a href='zutatenliste.php'>Zurück zur Liste</a>
    </p>";
}

$result = query("SELECT * from zutaten WHERE id = '{$sql_id}'");
$row = mysqli_fetch_assoc($result);

// im Formular muss beim Speichern (SUBMIT) der Bearbeitung auch die richtige ID mitgegeben werden werden. Deshalb wird die URL manipuliert und die ID in der URL ergänzt. Dazu muss die ACTION ("zutaten_bearbeiten.php" um die ID ergänzt werden. Dazu muss im Formular im Wert der Action die ID dynamisch ergänzt werden.  

?>

<form action="zutaten_bearbeiten.php?id=<?php echo $row["id"]?>" method="post">
    <div>
        <label for="titel">Zutat:</label>
        <input type="text" name="titel" id="titel" value="<?php 
        if(!$erfolg && !empty($_POST["titel"])){
            // Der Wert darf verändert werden, die ID bleibt die Gleich.
            echo htmlspecialchars ($_POST["titel"]);
            
        }else {
            // Vorbelegung des Wertes aus der Datenbank. 
            echo htmlspecialchars($row["titel"]);
        }
        ?>"/>
    </div>
    <div>
        <label for="kcal_pro_100">KCal/100:</label>
        <input type="number" name="kcal_pro_100" value="<?php 
        if(!$erfolg && !empty($_POST["kcal_pro_100"])){
            echo htmlspecialchars ($_POST["kcal_pro_100"]);
            
        }else { 
            echo htmlspecialchars ($row["kcal_pro_100"]);
        }
        ?>">
    </div>
    <div>
        <label for="menge">Menge:</label>
        <input type="number" name="menge" id="menge" value="<?php 
        if(!$erfolg && !empty($_POST["menge"])){
            echo htmlspecialchars ($_POST["menge"]);
            
        }else {
            echo htmlspecialchars($row["menge"]);
        }
        ?>">
    </div>
    <div>
        <label for="einheit">Einheit:</label>
        <input type="text" name="einheit" id="einheit" value="<?php 
        if(!$erfolg && !empty($_POST["einheit"])){
            echo htmlspecialchars ($_POST["einheit"]);
            
        }else {
            echo htmlspecialchars($row["einheit"]);
        }
        ?>">
    </div>
    <div>
        <button type="submit">Zutat speichern</button>
    </div>



</form>
    <?php
    include "fuss.php";
?>