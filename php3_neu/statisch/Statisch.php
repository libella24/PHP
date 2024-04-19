<?php
class Statisch {
    // Eine statische Eigenschaft gehört zur einmal existierenden Klasse und nicht zum erstellten Objekt.
    // Dadurch bleibt die Eigenschaft über die gesamte Laufzeit bestehen.
    public static int $id = 0; 

    // Diese statische Methode wird auch direkt der Klasse zugeordnet. Wie die Eigenschaft wird sie über Statisch::set_to_0() aufgerufen und kann nicht auf $this zugreifen. Sie ist nicht Teil des Objekts.

    public static function set_to_0() {
        self::$id=0; // setzt die Variable auf 0 zurück
    }

    public function __construct() {
        self::$id++; // self referenziert auf die Klasse "Statisch"
    }

    public function mache_etwas() {
        // kann mit herkömmlichen Funktionen kombiniert werden.
    }
}