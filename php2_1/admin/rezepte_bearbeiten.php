<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

$sql_id = escape($_GET["id"]);

//echo "<pre>"; print_r($_POST); echo "</pre>";

//Prüfen ob das Formular abgeschicht wurde
if ( !empty($_POST)) {

    //$sql_titel = mysqli_real_escape_string($db, $_POST["titel"]);
    $sql_benutzer_id = escape($_POST["benutzer_id"]);
    $sql_titel = escape($_POST["titel"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);



    //Felder validieren
    if ( empty($sql_titel) ) {
        $errors[] = "Bitte geben Sie einen Namen für dieses Rezept an.";
    } 


    //Validierung - wenn keine Fehler dann in DB speichern
    if ( empty($errors)) {

//echo "<pre>"; print_r($_POST); echo "</pre>";
//die();

    
        //wenn kein Validierungsfehler --> DB speichern
        query("UPDATE rezepte SET
            titel = '{$sql_titel}',
            beschreibung = '{$sql_beschreibung}',
            benutzer_id = '{$sql_benutzer_id}' 
            WHERE id = '{$sql_id}'
        ");
        
        //Alle Zutaten-Zuordnungen löschen und neu anlegen
        query("DELETE FROM zutaten_zu_rezepte WHERE rezepte_id = '{$sql_id}'");

        //Zuordnung zu Zutaten anlegen
        foreach ($_POST["zutaten_id"] as $zutatNr) {

            if ( empty($zutatNr) ) continue;

            
            $sql_zutaten_id = escape($zutatNr);

            query("INSERT INTO zutaten_zu_rezepte SET
                zutaten_id = '{$sql_zutaten_id}'
                , rezepte_id = '{$sql_id}'
            ");

        }


        $erfolg = true;
    }

}

include "kopf.php";
?>
    <h1>Rezept bearbeiten</h1>
<?php 
    if(! empty($errors)) {
        echo "<ul>";
        foreach ($errors as $key => $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
    }

    //Erfolgsmeldung
    if ( $erfolg) {
        echo "<p>Rezept wurde erfolgreich bearbeitet.<br>
        <a href='rezepte_liste.php'>Zurück zur Liste</a>
        </p>";
    }

    $sql_id = escape($_GET["id"]);
    $result = query("SELECT * FROM rezepte WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);
    
    ?><form action="rezepte_bearbeiten.php?id=<?php echo $row["id"]?>" method="post">
        <div>
            <label for="benutzer_id">Benutzer:</label>
            <select name="benutzer_id" id="benutzer_id"><?php 
                $user_result = query("SELECT id, benutzername FROM benutzer ORDER BY benutzername ASC");
                while ($user = mysqli_fetch_assoc($user_result)) {
                    echo "<option value='{$user["id"]}'";
                    if ( !empty($_POST["benutzer_id"]) && !$erfolg && $_POST["benutzer_id"] == $user["id"]) {
                        echo " selected";
                    } elseif ( empty($_POST["benutzer_id"]) && $user["id"] == $_SESSION["benutzer_id"]) {
                        echo " selected";
                    }
                    echo ">{$user["benutzername"]}</option>";
                }
            ?></select>
        </div>
        <div>
            <label for="titel">Rezepttitel:</label>
            <input type="text" name="titel" id="titel" value="<?php 
                if ( !empty($_POST["titel"]) && !$erfolg  ) {
                    echo htmlspecialchars($_POST["titel"]);
                } else {
                    echo htmlspecialchars($row["titel"]);
                }
            ?>"/>
        </div>
        <div>
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php if ( !empty($_POST['beschreibung']) && !$erfolg  ) {
                echo htmlspecialchars($_POST["beschreibung"]);
            } else { echo htmlspecialchars($row["beschreibung"]); } ?></textarea>
        </div>
        <div class="zutatenliste">
            <?php 
            //ermitteln, wieviele Zutaten-Blöcke wir benötigen
            //(zum Vorausfüllen)
            $bloecke = 1;
            $result = query("SELECT * FROM zutaten_zu_rezepte WHERE rezepte_id = '{$sql_id}' ORDER BY id ASC");
            $bloecke = mysqli_num_rows($result);
            $zutaten_zuordnung = array();
            while ( $zuordnung = mysqli_fetch_assoc($result) ) {
                $zutaten_zuordnung[] = $zuordnung;
            }
            if ( $bloecke < 1 ) $bloecke = 1;
            for ( $i=0; $i < $bloecke; $i++ ) { 
                ?>
                <div class="zutatenblock">
                    <div>
                        <label for="zutaten_id">Zutat:</label>
                        <select name="zutaten_id[]" id="zutaten_id">
                            <option>---Bitte wählen---</option>
                            <?php
                            $zutaten_result = query("SELECT * FROM zutaten ORDER BY titel ASC");
                            while ($zutat = mysqli_fetch_assoc($zutaten_result)) {
                                echo "<option value='{$zutat["id"]}'";
                                if ( (empty($_POST["zutaten_id"]) || $erfolg)
                                    && !empty($zutaten_zuordnung[$i])
                                    && $zutaten_zuordnung[$i]["zutaten_id"] == $zutat["id"]) {
                                    echo " selected";
                                }
                                echo ">{$zutat["titel"]}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            <?php
            } //Ende for-Schleife
            ?>
        </div>
        <a class="zutat-neu" onclick="neueZutat();">Zutat hinzufügen</a>
        <div>
            <button type="submit">Rezept aktualisieren</button>
        </div>
    </form>
<?php
include "fuss.php";