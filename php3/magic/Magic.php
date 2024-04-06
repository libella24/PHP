<?php



class Magic {
    //speichert alle eigenschaften über __set(), die nicht als selbstständige Eigenschaften existieren. 
    private array $daten = array();
    
    //wird von außen eine Eigenschaft gesetzt, die es im Objekt nicht gibt, wird automatisch die __set()-Magic-Method verwendet.
    public function __set($variable, $wert) {
        $this->daten[$variable] = $wert;
    }

    //wird von außen eine Eigenschaft VERWENDET, die es im Objekt nicht gibt, wird automatisch die __get()-Magic-Method verwendet.
    public function __get($variable) {
        return $this->daten[$variable];
    }
    // Wird von außen eine Funktion (Methode) aufgerufen, die es hier im Objekt nicht gibt, wird automatisch die __call()-Magic-Methode verwendet.
    // beliebig benannte Methode aufrufen

    public function __call($methode, $parameter) {
        echo "Es wurde die Methode ".$methode." aufgerufen.";
        echo "<pre>";
        print_r($parameter);
        echo "</pre>";
    }

    // Wird ein komplettes Objekt als String verwendet (z.B. mit echo,...), dann verwendet PHP den Rückgabewert der __toString()-Magic-Method
    public function __toString() {
        return print_r($this->daten, true);
    }
    
}