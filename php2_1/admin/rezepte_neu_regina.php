<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

//echo "<pre>"; print_r($_POST); echo "</pre>";

// (1) Prüfen, ob das Formular abgeschickt wurde
// ==============================================
//     funktioniert im Zusammenhang mit Formulareingaben ($_POST)

if(!empty($_POST)){
// (2) Alle Benutzereingaben auf Sonderzeichen prüfen
//     Im weiteren Programmverlauf werden nur die bereits geprüften Eingaben - $sql_xxx - verwendet.
    $sql_titel = escape($_POST["titel"]);
    $sql_benutzer_id = escape($_POST["benutzer_id"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);

// (3) Prüfung Titel darf nicht leer sein 
// ========================================
    if(empty($sql_titel)) { // darf nicht "titel" sein, weil hier ja die escape darauf liegt.
        $errors[]="Bitte geben Sie den Titel an."; // $errors Array wird befüllt
    } else {
// (4) Query absetzen: Gibt es diesen Titel schon?
// ================================================
            $result = query("SELECT * FROM rezepte 
            WHERE titel = '{$sql_titel}'");

// (5) Ergebnis in ein Array packen
// =================================
//         Datensatz aus mysqli in ein php Array umwandeln
            $row = mysqli_fetch_assoc($result); 

            // (6) Prüfen, ob es diesen Titel schon gibt 
            // ======================================
            //     case-sensitiv, wenn das nicht extra abgefangen wird
            if($row){  // schön kurz! Gibt's die Zeile schon? true/false
                $errors[]="Dieses Rezept existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht
            }
        }

// (6) Wenn keine Fehler vorhanden sind...
// ==========================================
    if(empty($errors)){ 
        
// (7) Dann wird das Rezept in die DB geschrieben
// ==============================================
        query("INSERT INTO rezepte SET 
        benutzer_id = '{$sql_benutzer_id}',
        titel = '{$sql_titel}', 
        beschreibung = '{$sql_beschreibung}'"
        );

// (8) Die allgemeine Funktion "mysqli_insert_id" gibt zurück, welche ID zuletzt vergeben wurde
// =============================================================================================
        $neue_rezepte_id = mysqli_insert_id($db); 

// (9) Zuordnung zu Zutaten anlegen
// =================================
//      pro eingegebener Zutat-ID
        foreach ($_POST["zutaten_id"] as $zutatNr){
            if(empty($zutatNr)) continue;
            // Zuordnung zu Zutaten anlegen
            $sql_zutaten_id = escape($zutatNr);
            query("INSERT INTO zutaten_zu_rezepte SET zutaten_id = '{$sql_zutaten_id}', rezepte_id = '{$neue_rezepte_id}'");
        }

// (10) Nachdem alles erledigt ist --> Erfolgt = true
// ===================================================

        $erfolg = true;
    }
}


include "kopf.php";

?>

<h1>Neues Rezept anlegen</h1>

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
    echo "<p>Das Rezept wurde erfolgreich hinzugefügt.<br>
    <a href='zutatenliste.php'>Zurück zur Liste</a>
    </p>";
}

?>

<form action="rezepte_neu.php" method="post">
        <div>
            <label for="benutzer_id">Benutzer:</label>
            <select name="benutzer_id" id="benutzer_id">
                <?php 
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
                }
            ?>"/>
        </div>
        <div>
            <label for="beschreibung">Beschreibung:</label>
            <textarea name="beschreibung" id="beschreibung"><?php if ( !empty($_POST['beschreibung']) && !$erfolg  ) {
                echo htmlspecialchars($_POST["beschreibung"]);
            } ?></textarea>
        </div>
        <div class="zutatenliste">
            <?php 
            $bloecke = 1;
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
            <button type="submit">Rezept anlegen</button>
        </div>
    </form>
<?php
include "fuss.php";