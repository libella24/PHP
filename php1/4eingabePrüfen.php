<?php
// Datenbank verbinden (MYSQLI_CONNECT (host, user, db-name))
// ===========================================================

$db = mysqli_connect("localhost", "root", "", "php2");

$error = false;


// (1) Prüfen, ob das Formular abgeschickt wurde
if(!empty($_POST)){
    
    // (2) Fehler ausgeben, wenn entweder der Benutzername oder das Passwort leer sind. 
    if(empty($_POST["username"]) || empty($_POST["password"])){ // OR, um beide Felder abzufragen
        $error = "Benutzername oder Passwort ist leer.";
        echo $error;
    } else {
        //(3) Eingabe "username" um Sonderzeichen bereinigen
        //    M Y S Q L I _ R E A L _ E S C A P E _ S T R I N G   (db, Post,[""])
        //    Dem Post "username" wird die Variable "$sql_benutzername" zugewiesen. Gleichzeitig ist diese Variable von Sonderzeichen 
        //    bereinigt. Im weiteren Programmverlauf soll nur mehr die Variable "$sql_benutzername" verwendet werden.
        $sql_benutzername = mysqli_real_escape_string($db, $_POST["benutzername"]); // bewahrt vor SQL Injections

        //(4) Benutzer in der DB abfragen 
        //    M Y S Q L I _ Q U E R Y   (db, "Statement")
        //    die Benutzereingabe wird mit {'...'} formatiert
        //    dem Abfrageergebnis wird die Variable "$result" zugewiesen
        $result = msqli_query($db, "SELECT * FROM benutzer WHERE benutzername = {'$sql_benutzername'}");

        //(5) Benutzer Abfrageergebnis in ein Array speichern
        //    M Y S Q L I _ F E T C H _ A S S O C   (Abfrageergebnis)
        $row = mysqli_fetch_assoc ($result);

        //(6) Benutzer prüfen

        if($row){
            //(7) Passwort prüfen - PHP Standardfunktion
            //    P A S S W O R D _ V E R I F Y   (eingebebenes PW, Hash)
            // if($_POST["passwort"] == $row["passwort"]) { -- würde nur das eingegebene Passwort prüfen, wir brauchen die "password_verify" funktion und geben das eingegebene PW und den Hash aus der DB. password_verify schaut dann, ob diese beiden Werte zusammenpassen.
                if(password_verify($_POST["passwort"], $row["passwort"])){
                //Passwort stimmt überein
                //echo "Sie sind eingeloggt.";

                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];

                // Anzahl der Logins in DB speichern  
                // Im DB-Feld darf nicht NULL definiert sein, sonst kann keine Berechnung stattfinden.
                // Last login speichern: im DB Feld muss NULL erlaubt sein. 
                // 2 Prüfungen können in einem Statement erfasst werden
                query($db, "UPDATE benutzer SET 
                anzahl_logins = anzahl_logins + 1,
                last_login = NOW() 
                WHERE id ={$row["id"]}");
    }
    
print_r($result);
        // Datensatz aus mysqli in ein php Array umwandeln
        $row = mysqli_fetch_assoc($result); 
        //print_r($row);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prüfung, ob alle Felder ausgefüllt sind</title>
</head>
<body>

<h1>Prüfung, ob alle Felder ausgefüllt sind</h1>
<?php
// Pro Fehler definierte Fehlermeldungen werden ausgegeben
if(!empty($error)){
    echo "<p>$error</p>";
}
?>
<!-- Formular Username/Password -->
<form action="4eingabePrüfen.php" method="post">
<label for="username">Benutzer:</label><br>
<input type="text" id="username" name="username"><br>
<label for="password">Passwort:</label><br>
<input type="password" id="password" name="password"><br><br>
 
<input type="Submit" value="Absenden">
</form>
</body>
</html>
