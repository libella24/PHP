<?php
$username = $_POST["username"]; // Das, was im Formularfeld name="username" eingegeben wurde, wird in der Variable $username gespeichert. 
$passwort = $_POST["passwort"];
// das Passwort ist eine SHA1 Funktion mit dem Parameter "$passwort".
$pass = sha1($passwort); 

//echo $pass; // = Passwort SHA1-codiert

if($username = "regina" AND $pass == "cbfdac6008f9cab4083784cbd1874f76618d2a97")
   {
   echo "Herzlich Willkommen im internen Bereich";
   }
else
   {
   echo "Das Passwort ist leider falsch";
   }

/*
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
*/
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort Abfrage</title>
</head>
<body>
    <h1>Passwort Abfrage</h1>
    


   <!-- Formular mit Eingabefeld ("passwort" = name) 
method = "post"
-->
<form action="4passwort.php" method="post"> 
Benutzername:<br />
<input type="Text" name="username"><br /><br />
 
Passwort:<br />
<input type="Password" name="passwort" />
 
<input type="Submit" value="Absenden" />
</form>





</body>
</html>