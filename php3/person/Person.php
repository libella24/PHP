<?php
// Klasse definieren, die später als Objekt verwendet werden kann
class Person {
    // Eigenschaft (property) festlegen: 
    // Platzhalter für spätere Werte (wie eine Variable)
    // Private properties können nur innerhalb der Klasse angesprochen werden.

    private $vorname; // public ist von außen änderbar - private ist nur in der Datei änderbar, 

    // Konstruktor
    // =============
    // Wird automatisch aufgerufen, sobald das Objekt erzeugt wird.
    // z.B.: new Person()
    // ein Konstruktor kann auch ohne Parameter sein

    public function __construct($name) {  //Standardmethode
        $this->vorname = $name;
    }

    // Public Methode, die von außen angesprochen werden kann.

    public function vorstellen() {
        return "Hallo, ich bin ". $this->vorname; //$vorname liegt außerhalb, daher muss man $this verwenden.
    }

    // Methode zum Holen des privaten Vornamens --> "GETTER"
    // ======================================================

    public function get_vorname(){
        return $this->vorname;
    }

    // Vornamen von außen setzen - "SETTER"
    // =====================================

    public function set_vorname($neuer_name){
        // Durch diese Methode haben wir die Möglichkeit, Überprüfungen vor dem Setzen des neuen Namens einzufügen
        if ($this->vorname == $neuer_name){
            echo "<strong>So heiße ich bereits!</strong>";
        } else {
            $this->vorname = $neuer_name;
        }
    }
}