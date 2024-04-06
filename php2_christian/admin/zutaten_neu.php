<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

//Prüfen ob das Formular abgeschicht wurde
if ( !empty($_POST)){

    //$sql_titel = mysqli_real_escape_string($db, $_POST["titel"]);
    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    //Felder validieren
    if ( empty($sql_titel) ) {
        $errors[] = "Bitte geben Sie einen Namen für die Zutat an.";
    } else {
        //überprüfen ob es die zutat bereits gibt.
        //$result = mysqli_query($db, "SELECT * FROM zutaten         WHERE titel = '{$sql_titel}'");
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");

        //Datensatz aus mysqli in ein php Array umwandeln
        $row = mysqli_fetch_assoc($result);


        if ( $row ) {
            //Wenn die Zutat bereits existiert -> Fehlermeldung bzw. Hinweis
            $errors[] = "Diese Zutat existiert bereits.";
        } 

    }

    //Wenn keine Fehler existieren, dann können wir die Zutat in der DB speichern
    if ( empty($errors)) {
        if ( $sql_kcal_pro_100 == "" )  {
            $sql_kcal_pro_100 = "NULL";
        }

        if ( $sql_einheit == "" )  {
            $sql_einheit = "NULL";
        }

        if ( $sql_menge == "" )  {
            $sql_menge = "NULL";
        }

        query("INSERT INTO zutaten SET 
            titel = '{$sql_titel}',
            kcal_pro_100 = {$sql_kcal_pro_100},
            menge = {$sql_menge},
            einheit = '{$sql_einheit}'
        ");

        $erfolg = true;
    }

}

include "kopf.php";
?>
    <h1>Neue Zutat anlegen</h1>
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
        echo "<p>Zutat wurde erfolgreich angelegt.<br>
        <a href='zutaten_liste.php'>Zurück zur Liste</a>
        </p>";
    }
    
    ?><form action="zutaten_neu.php" method="post">
        <div>
            <label for="titel">Zutat:</label>
            <input type="text" name="titel" id="titel" />
        </div>
        <div>
            <label for="kcal_pro_100">KCal/100:</label>
            <input type="number" name="kcal_pro_100" id="kcal_pro_100" />
        </div>
        <div>
            <label for="menge">Menge:</label>
            <input type="number" name="menge" id="menge" />
        </div>
        <div>
            <label for="einheit">Einheit:</label>
            <input type="text" name="einheit" id="einheit" />
        </div>
        <div>
            <button type="submit">Zutat anlegen</button>
        </div>
    </form>
<?php
include "fuss.php";