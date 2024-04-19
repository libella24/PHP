<?php
include "funktionen.php";
ist_eingeloggt();

$sql_id = escape($_GET["id"]); //escape Funktion auf ID anwenden.

$erfolg = false;

// (1) Formular wurde abgeschickt, eingegebene Daten werden validiert
// ===================================================================
// wenn das Formular abgeschickt wurde (die POSTs sind nicht leer)....

if(!empty($_POST)){ // .... dann werden Daten validiert
    // (2) Eingaben um Sonderzeichen bereinigen - Sicherheit
    // ======================================================
    $sql_titel = escape($_POST["titel"]); // Escape Funktion ist allgemein definiert (siehe funktionen.php)
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_profil = escape($_POST["profil"]);
    $sql_dienstort = escape($_POST["dienstort"]);
    $sql_stunden = escape($_POST["stunden"]);
    $sql_gehalt = escape($_POST["gehalt"]);
    $sql_firmen_id = $_SESSION["firmen_id"];

    // (3) Nach der Änderung darf der Titel nicht leer sein
    // =====================================================
    if(empty($sql_titel)) { 
        $errors[]="Bitte geben Sie den Titel an."; 
        // Man kann den Titel ändern. Allerdings darf es nicht eine andere ID mit diesem Titel geben. 
    } else { 
        $result = query("SELECT * FROM jobs 
                            WHERE titel = '{$sql_titel}'
                            AND id != '{$sql_id}'"); //Gibt es diesen Titel mit anderer ID noch? 

        // Das Ergebnis wird in ein Array gepackt
        // =====================================
        $row = mysqli_fetch_assoc($result); 

        if($row){
            $errors[]="Dieser Job existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht

        }
    }
    if(empty($errors)){ /// Werte deren Wert NOCH nicht feststeht, sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
        if($sql_beschreibung == ""){
            $sql_beschreibung = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_profil == ""){
            $sql_profil = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_dienstort == ""){
            $sql_dienstort = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_stunden == ""){
            $sql_stunden = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_gehalt == ""){
            $sql_gehalt = "NULL"; // wird dann leer angezeigt.
        }
        // dann können wir den Job in die DB schreiben...
        query("UPDATE jobs SET 
            titel = '{$sql_titel}', 
            beschreibung = {$sql_beschreibung}, 
            profil = {$sql_profil}, 
            dienstort = '{$sql_dienstort}',
            stunden = '{$sql_stunden}',
            gehalt = '{$sql_gehalt}'
        WHERE id = '{$sql_id}'  
        "); // ACHTUNG: WHERE-Bedingung, damit nicht alle Datensätze irrtümlicherweise aktualisiert werden.

        $erfolg = true;
    }

}



include "kopf.php";

?>
    <h1>Job bearbeiten</h1>
<?php
// Fehler werden hier im HTML ausgegeben 
// Ist das Errors-Array nicht leer dann durchlaufen wir mittels foreach Schleife jeden Eintrag im Errors array#
// Vom $errors-Array nehmen wir jeden $key und schreiben den $error raus
if(!empty($errors)){
    foreach($errors as $key => $error){
        echo "<li>".$error."</li>";
    }
    echo "<ul>"; 
}

// Erfolgsmeldung- wenn 
if($erfolg){
    echo "<p>Der Job wurde erfolgreich bearbeitet.<br>
    <a href='job_liste.php'>Zurück zur Liste</a>
    </p>";
}

$result = query("SELECT * from jobs WHERE id = '{$sql_id}'");
$row = mysqli_fetch_assoc($result);

// im Formular muss beim Speichern (SUBMIT) der Bearbeitung auch die richtige ID mitgegeben werden werden. Deshalb wird die URL manipuliert und die ID in der URL ergänzt. Dazu muss die ACTION ("zutaten_bearbeiten.php" um die ID ergänzt werden. Dazu muss im Formular im Wert der Action die ID dynamisch ergänzt werden.  

?>


<form action="job_bearbeiten.php?id=<?php echo $row["id"]?>" method="post">
    <div>
        <label for="titel">Titel:</label>
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
        <label for="beschreibung">Beschreibung:</label>
        <input type="text" name="beschreibung" value="<?php 
        if(!$erfolg && !empty($_POST["beschreibung"])){
            echo htmlspecialchars ($_POST["beschreibung"]);
            
        }else { 
            echo htmlspecialchars ($row["beschreibung"]);
        }
        ?>">
    </div>
    <div>
        <label for="profil">Profil:</label>
        <input type="text" name="profil" id="profil" value="<?php 
        if(!$erfolg && !empty($_POST["profil"])){
            echo htmlspecialchars ($_POST["profil"]);
            
        }else {
            echo htmlspecialchars($row["profil"]);
        }
        ?>">
    </div>
    <div>
        <label for="dienstort">Dienstort:</label>
        <input type="text" name="dienstort" id="dienstort" value="<?php 
        if(!$erfolg && !empty($_POST["dienstort"])){
            echo htmlspecialchars ($_POST["dienstort"]);
            
        }else {
            echo htmlspecialchars($row["dienstort"]);
        }
        ?>">
    </div>
    <div>
        <label for="stunden">Stunden:</label>
        <input type="text" name="stunden" id="stunden" value="<?php 
        if(!$erfolg && !empty($_POST["stunden"])){
            echo htmlspecialchars ($_POST["stunden"]);
            
        }else {
            echo htmlspecialchars($row["stunden"]);
        }
        ?>">
    </div>
    <div>
        <label for="gehalt">Gehalt:</label>
        <input type="text" name="gehalt" id="gehalt" value="<?php 
        if(!$erfolg && !empty($_POST["gehalt"])){
            echo htmlspecialchars ($_POST["gehalt"]);
            
        }else {
            echo htmlspecialchars($row["gehalt"]);
        }
        ?>">
    </div>
    <div>
        <button type="submit">Job speichern</button>
    </div>



</form>
    <?php
    include "fuss.php";
?>