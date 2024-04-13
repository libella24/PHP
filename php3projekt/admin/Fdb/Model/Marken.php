<?php

namespace WIFI\PHP3\Fdb\Model;

use WIFI\PHP3\Fdb\Mysql;
use WIFI\PHP3\Fdb\Model\Row\Marke;

class Marken

{
    public function alle_marken(): array // 
    {
        $alle_marken = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM marken ORDER BY id ASC");
        while ($row = $ergebnis->fetch_assoc()){
            $alle_marken[] = new Marke($row);
        }
        return $alle_marken;
    }
}