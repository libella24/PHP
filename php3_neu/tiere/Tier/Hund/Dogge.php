<?php
namespace WIFI\JWE\Tier\Hund;

use WIFI\JWE\Tier\Hund;

// Vererbungen können über mehrere Ebenen gehen

class Dogge extends Hund { 
    public function gib_laut (): string {
        return "'Grrrrrrrr!'";
    }
    // jede Klasse kann beliebige Methoden / Eigenschaften ergänzen
    public function beissen(): string {
        return "Autsch!";
    }

}