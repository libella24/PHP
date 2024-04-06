<?php

$error = false;

if(!empty($_POST)){
    
    // Wenn entweder der Benutzername oder das Passwort leer sind. 
    if(empty($_POST["email"]) || empty($_POST["kommentar"])){ // OR, um beide Felder abzufragen
        $error = "Benutzername oder Passwort ist leer.";
        echo $error;
    };

}


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
<form action="4alleFelderAusgefüllt.php" method="post">
E-Mail:<br>
<input type="Text" name="email"><br><br>
 
<!-- Formular Kommentarfeld (Textarea) -->
Kommentar:<br>
<textarea name="kommentar" cols="30" rows="5">
</textarea>
 
<input type="Submit" value="Absenden">
</form>
</body>
</html>
