<?php

namespace WIFI\apvsa\classes;

use WIFI\apvsa\classes\Mysql; 

class Jobs {
    public function all_jobs(): array {
        $all_jobs = array();
        $db = Mysql::getInstanz();
        $ergebnis = $db->query("SELECT * FROM jobs ORDER BY id ASC");
        while($row = $ergebnis->fetch_assoc()) {
            //$all_jobs[] = new Job($row);
            $all_jobs[] = $row;
        }
        return $all_jobs;
    }
}