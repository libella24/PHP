<?php
include "setup.php";
ist_eingeloggt();
include "kopf.php";

echo "<h1>Fahrzeug bearbeiten</h1>";

use WIFI\PHP3\Fdb\Validieren;
use WIFI\PHP3\Fdb\Model\Row\Fahrzeug;
use WIFI\PHP3\Fdb\Model\Marken;

$erfolg = false; // noch vor der Prüfung

// Prüfen, ob das Formular abgeschickt wurde
if(!empty($_POST)) {
    // Validieren
    $validieren  = new Validieren();
    // Methode "ist ausgefüllt" wird aufgerufen
    // usen, um die Klasse "Validieren" zu finden, 2. Parameter ist die Variable für die Fehlermeldung
    if($validieren->ist_ausgefuellt($_POST["kennzeichen"], "Kennzeichen")){
        $validieren->ist_kennzeichen($_POST["kennzeichen"], "Kennzeichen");
    }
    $validieren->ist_ausgefuellt($_POST["marken_id"], "Marke");
    $validieren->ist_ausgefuellt($_POST["farbe"], "Farbe");
    if($validieren->ist_ausgefuellt($_POST["baujahr"], "Baujahr")){
        $validieren->ist_jahr($_POST["baujahr"], "Baujahr");
    }
    // Wenn keine Fehler aufgetreten sind...
    if(!$validieren->fehler_aufgetreten()) {
        //speichern
        $fahrzeug = new Fahrzeug(array(
            "id" => $_GET["id"] ?? null,  // wenn vorhanden, dann verwenden, sonst leer
            "kennzeichen" => $_POST["kennzeichen"],
            "marken_id" => $_POST["marken_id"],
            "farbe" => $_POST["farbe"],
            "baujahr" => $_POST["baujahr"], 
        ));
        $fahrzeug->speichern();
        $erfolg = true;

    };
}

if ($erfolg) {
    echo "<p><strong>Fahrzeug wurde gespeichert.</strong><br>
    <a href='fahrzeuge_liste.php'>Zurück zur Liste</a></p>";
}

// wenn das Formular abgeschickt wurde, dann wird bei Fehlern ein Fehler-Html ausgegeben
if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

if(!empty($_GET["id"])) {
    // Fahrzeugdaten bestehen schon - Bearbeiten-Modus - Daten vorbefüllen
    $fahrzeug = new Fahrzeug($_GET["id"]);

}

?>

<!-- Formular zur Fahrzeugeingabe -->

<form action="fahrzeuge_bearbeiten.php<?php
if(!empty($fahrzeug)) {
    echo "?id=".$fahrzeug->id;
}?>

" method="post">
    <!-- DIV für jedes Feld -->
    <div>
        <label for="kennzeichen">Kennzeichen:</label>
        <!-- name = POST Variable -->
        <input type="text" name="kennzeichen" id="kennzeichen" placeholder="z.B. SL-123AB" value="<?php
        if(!empty($_POST["kennzeichen"])) {
            echo htmlspecialchars($_POST["kennzeichen"]); // bei neuen Einträgen gibt es nur den $_POST
        }else if (!empty($fahrzeug)) { 
            echo htmlspecialchars($fahrzeug->kennzeichen);
        }
        ?>">
    </div>
    <div>
        <label for="marken_id">Marke:</label>
        <select name="marken_id" id="marken_id">
            <option value="">- Bitte wählen -</option>
            <option value="1"><?php
            $marken = new Marken();
            $alle_marken = $marken->alle_marken();
            foreach ($alle_marken as $marke) {
                echo "<option value='{$marke->id}'";
                if(!empty($_POST["marken_id"]) && $_POST["marken_id"] == $marke->id) {
                    echo " selected";
                } else if (!empty($fahrzeug) && $fahrzeug->marken_id == $marke->id) {
                    echo " selected";
                }
                echo ">{$marke->hersteller}</option>";
            }
            
            ?>
            </option>
        </select>
    </div>
    <div>
        <label for="farbe">Farbe:</label>
        <input type="text" name="farbe" id="farbe" placeholder="z.B. 'blau-metallic'"value="<?php
        if(!empty($_POST["farbe"])) {
            echo htmlspecialchars($_POST["farbe"]); // bei neuen Einträgen gibt es nur den $_POST
        }else if (!empty($fahrzeug)) { 
            echo htmlspecialchars($fahrzeug->farbe);
        }
        ?>">
    </div>
    <div>
        <label for="baujahr">Baujahr:</label>
        <input type="text" name="baujahr" id="baujahr" placeholder="z.B. '2022'"value="<?php
        if(!empty($_POST["baujahr"])) {
            echo htmlspecialchars($_POST["baujahr"]); // bei neuen Einträgen gibt es nur den $_POST
        }else if (!empty($fahrzeug)) { 
            echo htmlspecialchars($fahrzeug->baujahr);
        }
        ?>">
    </div>
    <div>
        <button type="submit">Fahrzeug speichern</button>
    </div>





</form>




<?php

include "fuss.php";

?>
