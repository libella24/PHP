<?php
include "funktionen.php";
ist_eingeloggt();

// Fehleranzeige
//===============
// Die Fehler sind das Ergebnis der nachfolgenden Prüfungen (if-Abfragen, die "true" ergeben)
// Ergibt die Prüfung ein "true" dann wird das Array "$errors" befüllt
// - titel = empty (
// - titel = schon vorhanden
// - menge = leer

$errors = array();

// Erfolgsmeldung
// ===============
// Initial ist der Erfolg "false"
// Nachdem die Zutat erfolgreich gespeichert wurde, ändert sich der Status auf "true".
// Im HTML wird, bei "if $erfolg (=true), dann wird die Meldung "Die Zutat wurde erfolgreich gespeichert" ausgegeben und
// Der Link "Zurück zur Liste" wird eingeblendet

$erfolg = false;

// (1) Prüfen, ob das Formular abgeschickt wurde
// ===========================================

if(!empty($_POST)){
// (2) Alle Benutzereingaben auf Sonderzeichen prüfen

    $sql_titel = escape($_POST["titel"]); 
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

// (3) Prüfung: Titel darf nicht leer sein 
// ========================================
    if(empty($sql_titel)) { // darf nicht "titel" sein, weil hier ja die escape darauf liegt.
        $errors[]="Bitte geben Sie den Titel an."; // $errors Array wird befüllt
    } else {
// (4) Query absetzen: Gibt es diesen Titel schon?
// ================================================
//          Das Abfrageergebnis wird in die Variable "$result" gespeichert.
            $result = query("SELECT * FROM zutaten 
            WHERE titel = '{$sql_titel}'");

// (5) Ergebnis in ein Array packen
// =================================
//          Datensatz aus der Abfrage in ein php Array packen
//          Dabei wird der Zeile die Variable "$row" zugeordnet
            $row = mysqli_fetch_assoc($result); 
            print_r($row);

// (6) Prüfen, ob es diesen Titel schon gibt 
// ======================================
//          case-sensitiv, wenn das nicht extra abgefangen wird
//          fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht
            if($row){  // schön kurz! Gibt's die Zeile schon? true/false

                $errors[]="Diese Zutat existiert bereits"; 
            }
        }

// (7) Prüfung: Menge darf nicht leer sein
// ======================================
    
    if(empty($sql_menge)){
        $errors[]="Bitte geben Sie die Menge ein.";
    }
    
// (8) Werte deren Wert NOCH nicht feststeht...
// ==============================================
//  sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. 
//  Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
//  Wenn es keine Fehler gibt und wenn das Feld ... leer ist dann, soll NULL eingetragen werden.
    if(empty($errors)){ 
        if($sql_kcal_pro_100 == ""){
            $sql_kcal_pro_100 = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_menge == ""){
            $sql_menge = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_einheit == ""){
            $sql_einheit = "NULL"; // wird dann leer angezeigt.
        }

// (9) Zutat in die DB schreiben
// ==============================
//      Wenn keine Fehler existieren, dann können wir die Zutat in die DB schreiben...
        query("INSERT INTO zutaten SET 
        titel = '{$sql_titel}', 
        kcal_pro_100 = {$sql_kcal_pro_100}, 
        menge = {$sql_menge}, 
        einheit = '{$sql_einheit}'"
        );

        $erfolg = true;

    }
}

// Werte deren Wert NOCH nicht feststeht, sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. 
// Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
// die single quotes müssen in der INSERT Query weg, damit die NULL-Regel angewendet 

include "kopf.php";

?>
    <title>Neue Zutat anlegen</title>
</head>
<body>

<h1>Neue Zutat anlegen</h1>

<?php
// Fehler werden hier ausgegeben 
// ==============================
// Abfrage aus dem Array mit "foreach"
// pro ID, der die Variable "$key" zugewiesen wird
// wird der jeweilige $error (= selbst vergeben - pro Fehlereintrag) angezeigt.
if(!empty($errors)){
    foreach($errors as $key => $error){
        echo "<li>".$error."</li>";
    }
    echo "<ul>";
    
}
// Erfolgsmeldung bei $erfolg = true
// ==================================
if($erfolg){
    echo "<p>Die Zutat wurde erfolgreich bearbeitet.<br>
    <a href='zutatenliste.php'>Zurück zur Liste</a>
    </p>";
}
?>



<form action="zutaten_neu.php" method="post">
    <div>
        <!-- titel -->
        <label for="titel">Zutat:</label>
        <input type="text" name="titel" id="titel">
    </div>
    <div>
        <!-- kcal_pro_100 -->
        <label for="kcal_pro_100">KCal/100:</label>
        <input type="number" name="kcal_pro_100">
    </div>
    <div>
        <!-- menge -->
        <label for="menge">Menge:</label>
        <input type="number" name="menge" id="menge">
    </div>
    <div>
        <!-- einheit -->
        <label for="einheit">Einheit:</label>
        <input type="text" name="einheit" id="einheit">
    </div>
    <div>
        <button type="submit">Zutat anlegen</button>
    </div>




</form>
    
</body>
</html>