<?php
namespace WIFI\JWE;
use WIFI\JWE\Tier\TierAbstract;
//alle weiteren Erben werden hier übergeben
// Iterator = Interface für Schleifendurchläufe
class Tiere implements TiereInterface, \Iterator {

    private array $herde = array (); //leeres Array wird vorbereitet

    // Typdeklaration (Type-Hint): TierAbstract
    // Nur Objekte, die von "TierAbstract" erben, oder selbst "TierAbstract" sind, dürfen als Argument an diese Methode übergeben werden.
    
    //void = nichts darf mit "return" zurückgegeben werden
    public function add(TierAbstract $tier): void { 
        $this->herde[] = $tier; // numerischer Index

    } 
    public function ausgabe(): string {
        $ret = ""; 
        foreach($this->herde as $tier) {
            $ret .= $tier->get_name();
            $ret .= " macht ";
            $ret .= $tier->gib_laut();
            $ret .= "<br>";

            get_class($tier);

            if ($tier instanceof Katze) {

            }
        }
        return $ret;
    }

    // Iterator-Interface Implementierung
    // ruft foreach die Parameter der Reihe nach auf
    private int $index = 0;

    public function current(): mixed {
        return $this->herde[$this->index];
    }

    public function key(): mixed {
        return $this->index;
    }

    public function next(): void {
        ++$this->index; // springen zum nächsten Element, springen zum current - mit nächster ID
    }

    public function valid(): bool { // prüft, ob es einen gültigen Index gibt (true), oder ob das Ende schon erreicht ist (false).
        return isset($this->herde[$this->index]);
    }

    public function rewind(): void {
        $this->index=0; // Index wird wieder auf null gesetzt
    }



}