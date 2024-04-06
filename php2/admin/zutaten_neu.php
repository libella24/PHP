<?php
include "funktionen.php";
ist_eingeloggt();

$errors = array();
$erfolg = false;

// (1) Prüfen, ob das Formular abgeschickt wurde
// ==============================================
//     funktioniert im Zusammenhang mit Formulareingaben ($_POST)

if(!empty($_POST)){
    // (2) Alle Benutzereingaben auf Sonderzeichen prüfen
    //     Im weiteren Programmverlauf werden nur die bereits geprüften Eingaben - $sql_xxx - verwendet.

    $sql_titel = escape($_POST["titel"]); // die DB wird geholt (siehe funktionen.php)
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    // (3) Prüfung Titel darf nicht leer sein 
    // ========================================
    if(empty($sql_titel)) { // darf nicht "titel" sein, weil hier ja die escape darauf liegt.
        $errors[]="Bitte geben Sie den Titel an."; // $errors Array wird befüllt
    } else {
        // (4) Query absetzen: Gibt es diesen Titel schon?
        // ================================================
            $result = query("SELECT * FROM zutaten 
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
                $errors[]="Diese Zutat existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht
            }

    // (7) Prüfung, ob die Menge befüllt ist
    // ======================================
    }
    if(empty($sql_menge)){
        $errors[]="Bitte geben Sie die Menge ein.";
    }
    
    // (8) Werte deren Wert NOCH nicht feststeht...
    //     sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. 
    //     Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
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
        //     Wenn keine Fehler existieren, dann können wir die Zutat in die DB schreiben...
        query("INSERT INTO zutaten SET 
        titel = '{$sql_titel}', 
        kcal_pro_100 = {$sql_kcal_pro_100}, 
        menge = {$sql_menge}, 
        einheit = {$sql_einheit}"
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



<form action="zutaten_neu.php" method="post">
    <div>
        <label for="titel">Zutat:</label>
        <input type="text" name="titel" id="titel">
    </div>
    <div>
        <label for="kcal_pro_100">KCal/100:</label>
        <input type="number" name="kcal_pro_100">
    </div>
    <div>
        <label for="menge">Menge:</label>
        <input type="number" name="menge" id="menge">
    </div>
    <div>
        <label for="einheit">Einheit:</label>
        <input type="text" name="einheit" id="einheit">
    </div>
    <div>
        <button type="submit">Zutat anlegen</button>
    </div>




</form>
    
</body>
</html>