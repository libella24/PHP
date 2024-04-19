<?php
namespace WIFI\JWE\Tier; // Dateipfad wird so zusammengebaut
// Eigener Namensraum für das Projekt, bzw. die Klasse.
// Wird verwendet, um gleich benannte Klassen in verschiedenen Projekten zu erlauben.


// Abstrakte Klassen
// ==================
// Werden in den anderen Klassen mit "extends" eingetragen
// Basis-/Sammelklasse - Sie kann nicht selbst als Objekt erstellt (instanziert) werden.

// Sichtbakreits-Modifikatioren
// =============================
// Wenn Kind-Klassen von außen (index.php) verändert werden sollen, dann "protected" statt "private"
// so streng wie möglich - zuerst private, dann protected
//  > protected: diese Klasse und die Kind-Klassen können die Eigenschaft verwenden
//  > private: Ausschließlich diese Klasse kann die Eigenschaft verwenden. 

class TierAbstract {
    
    private string $name; // private ist nicht von Kind-Klassen erreichbar
    // private readonly string $name: "readolnly" (seit PHP 8.1); die Eigenschaft kann einmalig gesetzt (construct) und danach nur mehr gelesen werden

    public function __construct (string $tiername) { // Constructor Promotion (seit PHP 8.0) - Wird "public function __construct(private string $name) eingegeben, dann  kann man sich "private string $name" (oben) und "$this->name= $tiername"sparen.
        $this->name = $tiername;
        
    }
    public function get_name (): string { //public final function get_name(): Bei "final" kann keine Kind-Klasse diese Methode überschreiben. 
        return $this->name;
    }

    //abstract public function gib_laut(): string; // Diese Methode muss in den Kind-Klassen implementiert werden. Damit wird - falls in der Klasse die Methode fehlt - in der Fehlermeldung angezeigt, dass eine abstrakte Methode (benennt sogar den Namen) nicht implementiert wurde.
}