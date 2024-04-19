<?php

/**
 * Diese Blöcke sind Beispiele für "phpDoc" / "DocBlock" und können mit phpDocumentor verarbeitet werden.
 * 
 */

class Kreis {
    const PI = 3.141592654;
    private $radius; //damit man im Nachhinein den Radius nicht ändern kann
    public function __construct(float $r) {
        $this->set_radius($r);//Die Klasse ruft Methoden von sich selbst auf. ACHTUNG: Endlosverarbeitung!!!
        // Methode ruft sich selbst auf = Rekursion
        //radius = $r; // float ist als Eingabeformat Voraussetzung
    }
    // Der destruktor wird auf jeden Fall ausgeführt, wenn das Objekt gelöscht wird. Dies kann über unset($k) durch den Programmierer passieren, oder automatisch durch PHP, wenn das Programm zu Ende durchgelaufen ist.

    public function __destruct() {
        echo "Kreis mit Radius ".$this->radius."wurde zerstört.<br>"; // Aufräumen: Alle Variablen werden nach der letzten Ausführung gelöscht, damit der Arbeitsspeicher wieder geleert wird. 
    }

    public function flaeche():float {
        // r^2 * PI; "float"ist eher zur Info, welches Format ausgegeben wird.
       return pow($this->radius, 2) * Kreis::PI;
    }
    public function durchmesser():float {
        return $this->radius * 2;
    }
    /**
     * Berechnet anhand des gegebenen Radius den Umfang des Kreises.
     * @return float Der berechnete Umfang des Kreises.
     */
    public function umfang():float {
        // r * 2 * PI
       return $this->radius * 2 * self::PI; //statt "Kreis" kann auch "self" verwendet werden. Damit wird immer der Klassenname verwendet. Der Klassenname kann dadurch problemlos umbenannt werden. 
    }
    public function umfang1() {
        // r * 2 * PI
       return $this->durchmesser() * self::PI; //da der Durchmesser nur als Funktion vorhanden ist, muss man die Klammern anhängen
    }

    /**
     * Setzt neuen Radius für den Kreis
     * Auch wenn der Kreis bereits existiert und mit einem Radius im Konstruktor befüllt wurde, kann man so einen Radius setzen.
     * @param int|float $r Der neue Radius, der gesetzt werden soll.
     * @return void Es wird nichts wirklich zurückgegeben.
     * @throws Exception
     */
    public function set_radius(float $neuer_radius): void { //void = leer, diese Funktion gibt nichts zurück
        if ($neuer_radius <= 0) {
            throw new Exception("Radius muss größer als 0 sein."); //Exception ist eine vordefinierte Klasse, die Verarbeitung hört an dieser Stelle auf, wenn das Geworfene nicht gefangen wird - uncought exception
        }
        $this->radius = $neuer_radius;
    }
}