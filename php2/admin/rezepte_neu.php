<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

echo "<pre>";
print_r($_POST);
echo "</pre>";



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
            //     Datensatz aus mysqli in ein php Array umwandeln
            $row = mysqli_fetch_assoc($result); 
            print_r($row);

            // (6) Prüfen, ob es diesen Titel schon gibt 
            // ======================================
            //     case-sensitiv, wenn das nicht extra abgefangen wird
            if($row){  // schön kurz! Gibt's die Zeile schon? true/false
                $errors[]="Dieses Rezept existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht
            }
        }


    
    // (8) Werte deren Wert NOCH nicht feststeht...
    //     sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. 
    //     Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
    if(empty($errors)){ /*
        if($sql_kcal_pro_100 == ""){
            $sql_kcal_pro_100 = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_menge == ""){
            $sql_menge = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_einheit == ""){
            $sql_einheit = "NULL"; // wird dann leer angezeigt.
        }*/

        // (9) Zutat in die DB schreiben
        // ==============================
        //     Wenn keine Fehler existieren, dann können wir die Zutat in die DB schreiben...
        query("INSERT INTO rezepte SET 
        benutzer_id = '{$sql_benutzer_id}',
        titel = '{$sql_titel}', 
        beschreibung = '{$sql_beschreibung}'"
        );

        $neue_rezepte_id = mysqli_insert_id($db); // gibt zurück, welche ID zuletzt vergeben wurde

        foreach ($_POST["zutaten_id"] as $zutatNr){ // damit hab ich die neueste Rezepte-ID
            if(empty($zutatNr)) continue; // wenn's die zutaten_id schon gibt, dann braucht nichts weiteres in der DB gespeichert werden und - continue
            // Zuordnung zu Zutaten anlegen
            $sql_zutaten_id = escape($zutatNr);
            query("INSERT INTO zutaten_zu_rezepte SET zutaten_id = '{$sql_zutaten_id}', rezepte_id = '{$neue_rezepte_id}'");
        }

        // Zutaten zuordnen
        //==================

        $sql_zutaten_id = escape($_POST["zutaten_id"]);

        // Zutaten in der DB anlegen

    



        $erfolg = true;

    }
}


include "kopf.php";

?>
    <title>Neues Rezept anlegen</title>
</head>
<body>

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
        <select name="benutzer_id" id="benutzer_id" ><?php // wir brauchen nicht nur den Benutzernamen sondern auch die ID, die beim Rezept gespeichert wird.
        $user_result = query("SELECT id, benutzername FROM benutzer ORDER BY benutzername ASC");
        // Für jeden User wird eine Option erstellt - ARRAY
        while($user = mysqli_fetch_assoc($user_result)){
            echo "<option value='{$user["id"]}'";
            if($user["id"]== $_SESSION["benutzer_id"]){ // wenn der User aus der Session (lt. Benutzer DB) $_SESSION-benutezr_id muss definiert sein
                echo "selected";
            }elseif(!empty($_POST["benutzer_id"])&& $user["id"] == $_SESSION["benutzer_id"]){
                echo " selected";
            }
            echo ">{$user["benutzername"]}</option>";
        }

        ?>
        
        </select>
    
 
    </div>    
    <div>
        <label for="titel">Rezept:</label>
        <input type="text" name="titel" id="titel" value="<?php if(!empty($_POST["titel"]) && $erfolg){
            echo htmlspecialchars($_POST["titel"]);
        }
        ?>"/>
    </div>
    <div>
        <label for="Beschreibung:">Beschreibung:</label>
        <textarea name="beschreibung" id="beschreibung"><?php if(!empty($_POST['beschreibung']) && !$erfolg){
            echo htmlspecialchars($_POST["beschreibung"]);
        }?></textarea>
    </div>
    <div class="zutatenliste">
        <?php 
        // eine Zutat (Zutatenblock) ist standardmäßig auswählbar
        $bloecke = 1;
        // Das Backend bereitet die Funktion so vor, dass jeweils durch Klick weitere Blöcke hinzugefügt werden 
        for($i=0; $i < $bloecke; $i++){
            ?>
            <!-- Zutatenblock - Dropdown -->
            <div class="zutatenblock">
                <div>
                    <label for="zutaten_id">Zutat:</label>
                    <select name="zutaten_id[]" id="zutaten_id"> 
                        <option>----Bitte wählen-----</option>
                        <?php 
                        // Alle Zutaten selektieren
                        $zutaten_result=query("SELECT * FROM zutaten ORDER BY titel ASC");
                        // Alle Zutaten in ein Array schreiben
                        // Den einzelnen Zutaten wird die Variable "$zutat" zugewiesen
                        while($zutat= mysqli_fetch_assoc($zutaten_result)){
                            echo "<option value='{$zutat["id"]}'";
                            echo ">{$zutat["titel"]}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>    
        <?php
        } /// Ende der for-Schleife
        ?>
    </div>
    <!-- Bei Klick auf den Link "Zutat hinzufügen" wird die JS-Funktion "neueZutat()" ausgeführt -->
    <!-- Voraussetzung: script.js ist im HTML verlinkt (siehe "fuss.php") -->
    <a class="zutat-neu" onclick="neueZutat();">Zutat hinzufügen</a>
        
         
    
    <div>
        <button type="submit">Rezept anlegen</button>
    </div>




</form>
<?php
include "fuss.php"   
?>
