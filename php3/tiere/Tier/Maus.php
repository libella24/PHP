<?php

namespace WIFI\JWE\Tier;

// "extends TierAbstract" kopiert alle Eigenschaften und Methoden (die nicht private sind) von der übergeordneten "TierAbstract" Klasse. Somit hat diese Klasse alle Möglichkeiten der Eltern-Klasse.

// Die Funktion wird im Kind überschrieben...

class Maus extends TierAbstract {
    // Hat die Methode den selben Namen, wie in der Elternklasse, dann überschreibt diese Methode jene aus der Elternklasse.

    public function get_name():string{ //public final function get_name(): Bei "final" kann keine Kind-Klasse diese Methode überschreiben. 
        $name = parent::get_name(); //übergeordnete Funktion aus der Elternklasse wird aufgerufen und wir können den Rückgabewert in unserer überschriebenen Methode weiterverwenden.
        return $name." (Maus)";
    }
    
    public function gib_laut (): string {
        return "Pieps!";
    }

}