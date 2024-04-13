<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Fahrzeugdatenbank</title>
</head>
   
<body>
    <h1>Fahrzeugdatenbank - Admin</h1>
    <h3>Willkommen im Administrationsbereich</h3>
    <nav>
        <ul>
            <li><a href="index.php">Start</a></li>
            <li><a href="fahrzeuge_liste.php">Fahrzeugliste</a></li>
            <li>Eingeloggt als: <?php echo $_SESSION["benutzername"]?></li>
            <li> <a href="logout.php">Ausloggen</a></li>
        </ul>
    </nav>
    
