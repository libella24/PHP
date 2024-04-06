<!DOCTYPE html>
<html lang="de" dir="ltr">
    <head>
        <title><?php echo seitentitel; 
        // kann der Kunde selbst den Eintrag schreiben, dann sichert man sich mit "htmlspecialchars" ab, dass SpezialZeichen &,... richtig angezeigt werden.
        ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="keywords" content="" />
        <meta name="description" content="<?php echo $metadescription; ?>" />

        <link href="css/screen.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
           <?php include "nav.php"; ?>
            <figure>
                <img src="images/stage.jpg" alt="" />
            </figure>
        </header>