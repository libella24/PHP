<?php

namespace WIFI\Php3\Fdb\Model;

use WIFI\Php3\Fdb\Mysql;
use WIFI\Php3\Fdb\Model\Row\Marke;

class Marken {
    public function alle_marken(): array {
        $alle_marken = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM marken ORDER BY marke ASC");
        while ($row = $ergebnis->fetch_assoc()) {
            $alle_marken[] = new Marke($row);
        }
        return $alle_marken;
    }
}