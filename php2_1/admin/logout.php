<?php
session_start();

// Ausloggen - Variante 1
// =======================
unset($_SESSION["eingeloggt"]); 

// Ausloggen - Variante 2
// =======================
session_unset(); // löscht alle Session-Variablen

// Ausloggen - Variante 3
// =======================
session_destroy(); // dadurch werden auch die Cookies gelöscht.


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h1>Logout aus dem Rezepte-Administrationsbereich</h1>
    <p>Sie wurden ausgeloggt.</p>
    <p></p>
    <button>
        <a href="login.php">Login</a>
    </button>
    
</body>
</html>


