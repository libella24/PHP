<?php
include "funktionen.php";

//wurde das Formular abgeschickt?
//print_r($_POST);
if (! empty($_POST)){
    //Validierung
    if(empty($_POST["benutzername"]) || empty($_POST["passwort"])){
        $error = "Benutzername oder Passwort ist leer";
    } else {
        //Benutzername und Passwort werden übergeben
        // -> in der DB nachsehen ob der Benutzer existiert

        //diese Funktion bewahrt uns vor jeglicher sqlinjection
        //alle Daten aus $_POST u. $_GET (alle Benutzer bzw. Formulardaten)
        //$sql_benutzername = mysqli_real_escape_string($db, $_POST["benutzername"]);
        $sql_benutzername = escape($_POST["benutzername"]);

       //Datenbank zugriff und Abfrage
       //$result = mysqli_query($db, "SELECT * FROM benutzer 
//                WHERE benutzername = '{$sql_benutzername}'");
        $result = query("SELECT * FROM benutzer 
        WHERE benutzername = '{$sql_benutzername}'");

//print_r($result);

        //Datensatz aus mysqli in ein php Array umwandeln
        $row = mysqli_fetch_assoc($result);

        
//print_r($row);
        if ( $row) {
            //Benutzer existiert -> Passwort prüfen


            if ( password_verify( $_POST['passwort'], $row['passwort'])) {
                //Alles gut
                //echo "ist eingeloggt";

                $_SESSION["eingeloggt"] = true;
                $_SESSION["benutzername"] = $row["benutzername"];
                $_SESSION["benutzer_id"] = $row["id"];

                //Anzahl Logins in DB speichern
/*                mysqli_query($db, "UPDATE benutzer SET
                            anzahl_logins = anzahl_logins + 1
                            , letztes_login = NOW()
                            WHERE id = {$row["id"]}");
*/
                query("UPDATE benutzer SET
                    anzahl_logins = anzahl_logins + 1
                    , letztes_login = NOW()
                    WHERE id = {$row["id"]}");



                //Umleitung in Admin-system
                header("Location: index.php");
                exit;
            } else {
                //Passwort war falsch
                $error = "Benutzername oder Passwort sind falsch";
            }

        } else {
            //Benutzername wurde nicht in der DB gefunden
            $error = "Benutzername oder Passwort sind falsch";
        }


    }
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginbereich zur Rezepteverwaltung</title>
</head>
<body>
    <h1>Loginbereich zur Rezepteverwaltung</h1>
    <?php
    if (!empty($error)) {
        echo "<p>".$error."</p>";
    }
    ?>
    <form   action="login.php" method="post">
        <div>
            <label for="benutzername">Benutzername:</label>
            <input type="text" name="benutzername" id="benutzername" />
        </div>
        <div>
            <label for="passwort">Passwort:</label>
            <input type="password" name="passwort" id="passwort" />
        </div>
        <div>
            <button type="submit">Einloggen</button>
        </div>
    </form>
</body>
</html>
