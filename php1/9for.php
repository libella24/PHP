<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For-Schleifen</title>
</head>
<body>
    <h1>For Schleifen</h1>
    <br>
    <?php
    echo "<table border='1'>";
    echo "<tr>";
    for($i=1; $i<=11; $i++){
        echo "<td>";
        echo $i;
        echo "</td>";
    }
    echo "</table border='1'>";
    echo "</tr>";

    echo "<br>";

    // 1x1 in einer Tabelle darstellen


    echo "<table border='1'>";

    for($zeile=1; $zeile<=10; $zeile++){
        if ($zeile==6) continue;
        echo "<tr>";
       
        
    for ($spalte=1; $spalte<=10; $spalte++){
        echo "<td>";
        if (($spalte * $zeile) % 7 !=0) echo $spalte * $zeile; //wenn durch 7 Teilbar, dann --> MODULO %=Modulo - 7er Reihe wird ausgeblendet
        echo "</td>";
    }
    echo "</tr>";
}
    echo "</table >";
    
    
    ?>
    <br><br>
    <table border="1">
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
        </tr>
        <tr>
            <td>4</td>
            <td>5</td>
            <td>6</td>
        </tr>
</body>
</html>