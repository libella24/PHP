<?php
include "funktionen.php";
// ist_eingeloggt();

$errors = array();
$erfolg = false;



// (1) Prüfen, ob das Formular abgeschickt wurde
if(!empty($_POST)){
    // (2) Alle Benutzereingaben prüfen
    //     Im weiteren Programmverlauf werden nur die bereits geprüften Eingaben - $sql_xxx - verwendet.
    $sql_titel = escape($_POST["titel"]); // die DB wird geholt (siehe funktionen.php)
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_profil = escape($_POST["profil"]);
    $sql_dienstort = escape($_POST["dienstort"]);
    $sql_stunden = escape($_POST["stunden"]);
    $sql_gehalt = escape($_POST["gehalt"]);
    $sql_firmen_id = $_SESSION["firmen_id"]; //OFFEN: Firmen-ID der aktuell eingeloggten Firma ermitteln

    // (3) Prüfung Titel darf nicht leer sein 
    // ========================================
    if(empty($sql_titel)) { // darf nicht "titel" sein, weil hier ja die escape darauf liegt.
        $errors[]="Bitte geben Sie den Titel an."; // $errors Array wird befüllt
    } else {
        // (4) Query absetzen: Gibt es diesen Job (Titel) schon?
        // ================================================
            $result = query("SELECT * FROM jobs 
            WHERE titel = '{$sql_titel}'"); 

            // (5) Jobdaten in ein Array packen
            // =================================
            //     Datensatz aus mysqli in ein php Array umwandeln
            $row = mysqli_fetch_assoc($result); 
            
            echo "<br>"; print_r($row); echo "<br>";

            // (6) Prüfen, ob es diesen Titel schon gibt 
            // ======================================
            //     case-sensitiv, wenn das nicht extra abgefangen wird
            if($row){  // schön kurz! Gibt's die Zeile schon? true/false
                $errors[]="Dieser Job existiert bereits"; // fragt die gesamte Row ab, ob in der Spalte Titel der exakte Titel besteht, oder nicht
            }

    // (7) Prüfung, ob die Menge befüllt ist
    // ======================================
    }
    if(empty($sql_beschreibung)){
        $errors[]="Bitte geben Sie die Aufgaben ein.";
    }
    if(empty($sql_profil)){
        $errors[]="Bitte geben Sie das Profil/die Anforderungen im Feld 'Das erwarten wir von Ihnen' ein.";
    }
    if(empty($sql_dienstort)){
        $errors[]="Bitte geben Sie den Dienstort an.";
    }
    if(empty($sql_stunden)){
        $errors[]="Bitte geben Sie das Stundenausmaß an.";
    }
    if(empty($sql_gehalt)){
        $errors[]="Bitte geben Sie das Gehalt an.";
    }
    
    // (8) Werte deren Wert NOCH nicht feststeht...
    //     sollen in der DB nicht mit 0 gespeichert werden, sondern mit NULL. 
    //     Erst wenn der Wert 0 feststeht, dann soll 0 drinnen stehen.
    /*if(empty($errors)){ 
        if($sql_kcal_pro_100 == ""){
            $sql_kcal_pro_100 = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_menge == ""){
            $sql_menge = "NULL"; // wird dann leer angezeigt.
        }
        if($sql_einheit == ""){
            $sql_einheit = "NULL"; // wird dann leer angezeigt.
        }*/

        // (9) Job in die DB schreiben
        // ==============================
        //     Wenn keine Fehler existieren, dann können wir die Zutat in die DB schreiben...
        // OFFEN: angemeldete Firma muss noch ins Feld firmen_id geschrieben werden. 
        query("INSERT INTO jobs SET 
        titel = '{$sql_titel}', 
        beschreibung = '{$sql_beschreibung}',
        profil = '{$sql_profil}', 
        dienstort = '{$sql_dienstort}', 
        stunden = '{$sql_stunden}', 
        gehalt = '{$sql_gehalt}', 
        firmen_id = '{$sql_firmen_id}', 
        created_at = now()"
        );
        $erfolg = true;

    }

include "kopf.php";

?>
    <title>Neuen Job anlegen</title>
</head>
<body>

<h1>Neuen Job anlegen</h1>

<?php
echo "<br>Eingeloggt als: ";
echo "<br>";
echo "Username: .$_SESSION["benutzer"] ;
echo "<br>";
echo $_SESSION["firmen_id"];
echo $_SESSION["bezeichnung"];
echo "<br>";
// Fehler werden hier ausgegeben 
if(!empty($errors)){
    foreach($errors as $key => $error){
        echo "<li>".$error."</li>";
    }
    echo "<ul>";
    
}
// Erfolgsmeldung
if($erfolg){
    echo "<p>Der Job wurde erfolgreich angelegt.<br>
    <a href='job_liste.php'>Zurück zur Liste</a>
    </p>";
}
?>



<form action="job_neu.php" method="post">
    <div>
        <label for="titel">Titel</label>
        <input type="text" name="titel" id="titel">
    </div>
    <div>
        <label for="beschreibung">Ihre Aufgaben:</label>
        <textarea
           name="beschreibung"
           id="beschreibung"
           cols="30"
           rows="10"
           placeholder="Beschreiben Sie bitte die ausgeschriebene Stelle..."
           >
         </textarea>
    </div>
    <div>
        <label for="profil">Das erwarten wir von Ihnen:</label>
        <textarea 
            name="profil" 
            id="profil" 
            cols="30" 
            rows="10" 
            placeholder="Geben Sie hier bitte die gewünschten Skills des Bewerbers ein..."
            >
        </textarea>
    </div>
    <div>
        <label for="dienstort">Dienstort:</label>
        <input type="text" name="dienstort" id="dienstort">
    </div>
    <div>
        <label for="stunden">Stundenausmaß:</label>
        <input type="text" name="stunden" id="stunden">
    </div>
    <div>
        <label for="gehalt">Gehalt:</label>
        <input type="text" name="gehalt" id="gehalt">
    </div>
    <div>
        <button type="submit">Job anlegen</button>
    </div>
    




</form>
    
</body>
</html>