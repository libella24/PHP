<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

//echo "<pre>"; print_r($_POST); echo "</pre>";

//Prüfen ob das Formular abgeschicht wurde
if ( !empty($_POST)) {

    //$sql_titel = mysqli_real_escape_string($db, $_POST["titel"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_strasse = escape($_POST["strasse"]);
    $sql_plz = escape($_POST["plz"]);
    $sql_ort = escape($_POST["ort"]);
    $sql_email = escape($_POST["email"]);
    $sql_benutzer = escape($_POST["benutzer"]);
    $sql_passwort = escape($_POST["passwort"]);

    //Felder validieren
    if ( empty($sql_beschreibung) ) {
        $errors[] = "Bitte geben Sie die Firmenbezeichnung ein.";
    } else {
        //überprüfen ob es die Rezept bereits gibt.
        $result = query("SELECT * FROM firmen WHERE titel = '{$sql_beschreibung}'");

        //Datensatz aus mysqli in ein php Array umwandeln
        $row = mysqli_fetch_assoc($result);


        if ( $row ) {
            //Wenn die Zutat bereits existiert -> Fehlermeldung bzw. Hinweis
            $errors[] = "Diese Firma existiert bereits";
        } 
    }

    //Validierung - wenn keine Fehler dann in DB speichern
    if ( empty($errors)) {

//echo "<pre>"; print_r($_POST); echo "</pre>";
//die();
    
        //wenn kein Validierungsfehler --> DB speichern
        query("INSERT INTO firmen SET
            beschreibung = '{$sql_beschreibung}',
            strasse = '{$sql_strasse}',
            plz = '{$sql_plz}',
            ort = '{$sql_ort}',
            email = '{$sql_email}',
            benutzer = '{$sql_benutzer}',
            plz = '{$sql_plz}'
        ");
        
        $neue_rezepte_id = mysqli_insert_id($db); // .. gibt zurück welche ID zuletzt vergeben wurde

        //Zuordnung zu Zutaten anlegen
        foreach ($_POST["zutaten_id"] as $zutatNr) {

            if ( empty($zutatNr) ) continue;

            
            $sql_zutaten_id = escape($zutatNr);

            query("INSERT INTO zutaten_zu_rezepte SET
                zutaten_id = '{$sql_zutaten_id}'
                , rezepte_id = '{$neue_rezepte_id}'
            ");

        }


        $erfolg = true;
    }

}

include "kopf.php";
?>
    <h1>Neue Firma anlegen</h1>
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
        echo "<p>Die Firma wurde erfolgreich angelegt.<br>
        <a href='rezepte_liste.php'>Zurück zur Liste</a>
        </p>";
    }
    // Formular
    ?><form action="firma_neu.php" method="post">
        <div>
            <label for="bezeichnung">Firmenname:</label>
            <input type="text" name="bezeichnung" id="bezeichnung">
            
        </div>
        <div>
            <<label for="strasse">Straße:</label>
            <input type="text" name="strasse" id="strasse">
        </div>
        <div>
            <label for="plz">PLZ:</label>
            <input type="number" name="plz" id="plz" min ="1000" max ="99999" >
        </div>
        <div>
            <<label for="ort">Ort:</label>
            <input type="text" name="ort" id="ort">
        </div>
       
        <a class="zutat-neu" onclick="neueZutat();">Zutat hinzufügen</a>
        <div>
            <button type="submit">Rezept anlegen</button>
        </div>
    </form>
<?php
include "fuss.php";