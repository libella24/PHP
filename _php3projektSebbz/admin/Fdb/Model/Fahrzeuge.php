<?php

namespace WIFI\Php3\Fdb\Model;

use WIFI\Php3\Fdb\Mysql;
use WIFI\Php3\Fdb\Model\Row\Fahrzeug;

// In dieser Klasse geht es um die Liste der Fahrzeuge
// ruft die Funktion "alle_fahrzeuge" auf
// selektiert alle Einträge der Tabelle "fahrzeuge" und packt sie in ein Array
// 
class Fahrzeuge {
    public function alle_fahrzeuge(): array {
        $alle_fahrzeuge = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM fahrzeuge ORDER BY id ASC");
        while ($row = $ergebnis->fetch_assoc()) {
            $alle_fahrzeuge[] = new Fahrzeug($row);
        }
        return $alle_fahrzeuge;
    }
}