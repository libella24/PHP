
<?php
// Passwort Abfrage
// =================

$passwort = $_POST["passwort"]; // Das, was im Formularfeld name="passwort" eingegeben wurde, wird in der Variable $passwort gespeichert. 
 
if($passwort=="geheim")
   {
   echo "Herzlich Willkommen im internen Bereich";
   }
else
   {
   echo "Das Passwort ist leider falsch";
   }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort ohne SHA</title>
</head>
<body>
    <h1>Passwortabfrage 1 ohne Verschlüsselung</h1>
    

 <!-- Formular Eingabefeld ("passwort" = name) -->
<form action="4passwort1.php" method="post"> 
<input type="Password" name="passwort" id="passwort" />
<input type="Submit" value="Absenden" />
</form> 
   
</body>
</html>



   // Um zu überprüfen, ob überhaupt etwas ins Formular eingegeben wurde, soll man "!=" benutzen:

   $user = $_POST["user"];
 
if($user!="")  // Ist der User ungleich leer, dann geben wird "Herzlich..." aus. 
   {
   echo "Herzlich Willkommen $user";
   }
else
   {
   echo "Das Feld User wurde nicht ausgefüllt";
   }
