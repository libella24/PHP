<?php
include "funktionen.php";
include "kopf.php";

$errors = array();
$erfolg = false;

print_r($_POST);

if(!empty($_POST)){
  // Benutzereingaben auf Sonderzeichen prüfen - allgemeine Funktion "escape"
  $sql_vorname = escape($_POST["vorname"]); 
  $sql_nachname = escape($_POST["nachname"]);
  $sql_geburtsdatum = escape($_POST["geburtsdatum"]);
  $sql_flugangst = escape($_POST["flugangst"]);
  $sql_flugnr = escape($_POST["flugnr"]);

  if(empty($sql_nachname)) { // Es muss eine Person erfasst sein - macht sonst keinen Sinn
    $errors[]="Bitte geben Sie den Nachnamen an."; // $errors Array wird befüllt
  }
  if(empty($errors)){
    if($sql_flugangst == ""){
      $sql_flugangst = "nein"; 
    }
    if($sql_flugangst == "on"){
        $sql_flugangst = "ja"; 
  }
    query("INSERT INTO passagiere SET 
        vorname = '{$sql_vorname}', 
        nachname = '{$sql_nachname}', 
        geburtsdatum = '{$sql_geburtsdatum}', 
        flugangst = '{$sql_flugangst}',
        flug_id = '{$sql_flugnr}'"
        );
        $erfolg=true;

        $neue_flug_id = mysqli_insert_id($db); // gibt zurück, welche ID zuletzt vergeben wurde

        /*foreach ($_POST["flugnr"] as $flugnr){ // neueste Flugnummer
            if(empty($flugnr)) continue; 
            $sql_flugnr = escape($flugnr);
            query("INSERT INTO fluege_zu_passagiere SET flug_id = '
            {$neue_flug_id}', passagier_id = '{$neue_flug_id}'");*/
        }
  }



?>

<!-- FORMULAR HTML -->
    <h1>Neuen Passagier anlegen</h1>
    
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
?>
<form action="passagier_neu.php" method="post">
    <div>
      <!-- Vorname -->
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" id="vorname">
    </div>
    <div>
      <!-- Nachname -->
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname">
    </div>
    <div>
      <!-- Geburtsdatum -->
        <label for="geburtsdatum">Geburtsdatum:</label>
        <input type="date" name="geburtsdatum" id="geburtsdatum">
    </div>
    <div>
      <!-- Flugangst -->
        <label for="flugangst">Flugangst:</label>
        <input type="radio" name="flugangst" id="flugangst">
    </div>
    <div class="flug">
      <div>
        <label for="flugnr">Flug auswählen:</label>
        <select name="flugnr" id="flugnr"> 
          <option>----Bitte wählen-----</option>
            <?php 
              // Alle Flüge werden angeboten /selektiert 
              $fluegx = 1;
              $fluege = query("SELECT * FROM fluege ORDER BY abflug DESC");
              $flug= mysqli_fetch_assoc($fluege);
              foreach($fluege as $key => $flug){
                echo "<option value='{$flug["flugnr"]}'>{$flug["flugnr"]}</option>";
              }
              print_r($fluege);
              
              /*
              $fluegx = mysqli_num_rows($fluege); // Anzahl der Flüge
              // Alle Flüge in ein Array schreiben
              //$flug= mysqli_fetch_assoc($fluege);
              for ( $i=0; $i < $fluegx; $i++ ) {
                echo "<option value='{$flug["flugnr"]}'</option>";
                            //echo "<option value='{$flug["ziel_flgh"]}'";
                        } /*
              // Alle Flüge in ein Array schreiben
                  while($flug= mysqli_fetch_assoc($fluege)){
                            echo "<option value='{$flug["flugnr"]}'</option>";
                            //echo "<option value='{$flug["ziel_flgh"]}'";
                        }
                      }
                       */ ?>

                    </select>

      </div>





    
    <div>
        <button type="submit">Passagier anlegen</button>
    </div>




</form>

<?php



include "fuss.php";
?>
