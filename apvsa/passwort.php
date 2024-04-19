<?php
// Passwort-Generator
// ===================
$passwort = "Passwort1";

// password_hash Verschlüsselung 
// ==============================
// ACHTUNG: PW soll 255 Zeichen in der DB erlauben
// liefert jedes Mal ein anderes Ergebnis, d.h. wenn mehrere User das gleiche Passwort eingeben, kommt ein anderer Hash heraus
// Beim Prüfen validiert jeder Hash 
// PASSWORD_DEFAULT ist der Standard-bcrypt-Algorithmus von PHP. Weitere Verschlüsselungsmethoden siehe php.net manual
echo "<br><p>User Passwort mit password_hash verschlüsselt</p>";
$pw_hash = password_hash($passwort, PASSWORD_DEFAULT);
echo $pw_hash;
echo "<br>Dieses Passwort wurde mit PASSWORD_DEFAULT erstellt";


// Passwort verifizieren (PASSWORD_VERIFY (User-Passwort, PW-Hash))
// ===============================================================
// Prüfen, ob das vom User eingegebene Passwort mit dem PW-Hash übereinstimmt:
if (password_verify($passwort,$pw_hash)){
    echo "<br>";
    echo "Password stimmt überein";
};
// Der User gibt sein Passwort ein, der Hash in der DB wird verglichen 
// In der Funktion $pw_hash ist die Variante gespeichert (PASSWORD_DEFAULT)
// beim Aufruf password_verify wird $passwort mit der Variante PASSWORD_DEFAULT erzeugt und mit dem Hash-Wert, 
// der in der DB steht, verglichen. Ist der Wert kompatibel, dann kommt der User rein. 


?>