<?php
// Passwort-Generator
// ===================
$db_passwort = "81dc9bdb52d04dc20036dbd8313ed055";
$passwort = "Passwort3";
$salt = "köakkälk";

// md5 Verschlüsselung
// ====================
// Fixer Encryption Wert --> es kommt immer ein gleichbleibender Wert heraus. 
// Nur ein Baustein steht in der DB ($passwort), nicht das gesamte PWD, Der Ursprung kann zurückgerechnet werden

if ($db_passwort == md5($passwort)){
    echo "Passwort ist richtig";
    echo "<br>";
} else { echo "Passwort ist nicht richtig.";};


// User Passwort mit MD5 verschlüsselt
// ====================================
echo "<br><p>Eingegebenes User Passwort:</p>";
echo $passwort;
echo "<br><p>User Passwort MD5 verschlüsselt:</p>";
echo md5($passwort);

// User Passwort mit MD5 und SALT verschlüsselt
// =============================================
echo "<br><p>User Passwort MD5 und SALT verschlüsselt:</p>";
echo md5($passwort.$salt);
//parameter 1 = PW des Benutzers
//parameter 2 = zufälliger String, um das PW vergleichen zu können, diesen Teil weiß der User nicht.
echo "<br><p>User Passwort MD5 und SALT verschlüsselt:</p>";
echo md5($passwort.$salt); // dieser String bleibt immer gleich

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