<?php

include "setup.php";
ist_eingeloggt();

use WIFI\Php3\Fdb\Validieren;
use WIFI\Php3\Fdb\Model\Row\Fahrzeug;
use WIFI\Php3\Fdb\Model\Marken;

$erfolg = false;

if (! empty($_POST)) {

    $validieren = new Validieren();
    if ($validieren->ist_ausgefuellt($_POST["kennzeichen"], "Kennzeichen")) {
        $validieren->ist_kennzeichen($_POST["kennzeichen"], "Kennzeichen");
    }
    $validieren->ist_ausgefuellt($_POST["marken_id"], "Marke"); // DB-Feld, Feldbezeichnung $feldname
    $validieren->ist_ausgefuellt($_POST["farbe"], "Farbe");
    if ($validieren->ist_ausgefuellt($_POST["baujahr"], "Baujahr")) {
        $validieren->ist_baujahr($_POST["baujahr"], "Baujahr");
    }

    if (!$validieren->fehler_aufgetreten()) {
        $fahrzeug = new Fahrzeug(array(
            "id" => $_GET["id"] ?? null, // ??: wenn id vorhanden, dann verwenden, 
            // sonst den rechten Wert (null)
            "kennzeichen" => $_POST["kennzeichen"],
            "marken_id" => $_POST["marken_id"],
            "farbe" => $_POST["farbe"],
            "baujahr" => $_POST["baujahr"]
        ));
        $fahrzeug->speichern();
        $erfolg = true;
    }
}

?>

<h1>Fahrzeug bearbeiten</h1>

<?php

if ($erfolg) {
    echo "<p><strong>Fahrzeug wurde gespeichert</strong><br>
    <a href='fahrzeuge_liste.php'>Zurück zur Liste</a></p>";
}

if(!empty($validieren)) {
    echo $validieren->fehler_html();
}

if (!empty($_GET["id"])) {
    //Bearbeiten-Modus - Fehrzeugdaten ermitteln zum Formular vorausfüllen
    $fahrzeug = new Fahrzeug($_GET["id"]);

}

?>

<form action="fahrzeuge_bearbeiten.php<?php 
    if (!empty($fahrzeug)) {
     echo "?id=" . $fahrzeug->id;   
    }
    ?>" method="post">
    <div>
        <label for="kennzeichen">Kennzeichen</label>
        <!-- Name steht für den Text den man dann mit der $_POST Variable abgeschickt wird -->
        <input type="text" name="kennzeichen" id="kennzeichen" placeholder="S-XXXX" value="<?php
            if (!empty($_POST["kennzeichen"])) {
                echo htmlspecialchars($_POST["kennzeichen"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->kennzeichen);
            }
        ?>">
    </div>
    <div>
        <label for="marken_id">Marke</label>
        <select name="marken_id" id="marken_id">
            <option value="">--Bitte wählen--</option>
            <?php
                $marken = new Marken();
                $alle_marken = $marken->alle_marken();
                foreach ($alle_marken as $einzelnemarke) {
                    echo "<option value='{$einzelnemarke->id}'";
                    if (!empty($_POST["marken_id"]) && ($_POST["marken_id"]) == $einzelnemarke->id) {
                        echo " selected";
                    } else if (!empty($fahrzeug) && $fahrzeug->marken_id == $einzelnemarke->id) {
                        echo " selected";
                    }
                    echo ">{$einzelnemarke->marke}</option>";
                };
            ?>
        </select>
    </div>
    <div>
        <label for="farbe">Farbe</label>
        <input type="text" name="farbe" id="farbe" value="<?php
            if (!empty($_POST["farbe"])) {
                echo htmlspecialchars($_POST["farbe"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->farbe);
            }
        ?>">
    </div>
    <div>
        <label for="baujahr">Baujahr</label>
        <input type="text" name="baujahr" id="baujahr" value="<?php
            if (!empty($_POST["baujahr"])) {
                echo htmlspecialchars($_POST["baujahr"]);
            } else if (!empty($fahrzeug)) {
                echo htmlspecialchars($fahrzeug->baujahr);
            }
        ?>">
    </div>
    <div class="submit-button">
        <button type="submit">Fahrzeug speichern</button>
    </div>
</form>

<?php

include "fuss.php";

?>