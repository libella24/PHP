<?php

// Namespace besteht aus Firma und dann dem Projektnamen
namespace WIFI\Php3\Fdb;

class Validieren {

    private array $errors = array();

    public function ist_ausgefuellt(string $wert, string $feldname): bool { // $wert wird auf Leerheit überprüft; $feldname = Variable, die Überprüft wird, wird in der Fehlermeldung verwendet
        if (empty($wert)) {
            $this->errors[] = $feldname . " war leer.";
            return false;
        }
        return true;
    }

    public function ist_kennzeichen(string $wert, string $feldname): bool { //Entspricht der $wert den Anforderungen?
        // nach irgendeinem Zeichen im Kennwort suchen, das NICHT A-Z, 0-9, oder Bindestrich ist.
        if (preg_match("/[^A-Z0-9\-]/i", $wert)) { //nach einem Zeichen gesucht wird, das nicht A-Z (Groß- oder Kleinbuchstaben), 0-9 (Ziffern) oder ein Bindestrich ist (der Bindestrich wird mit einem Backslash vorangestellt, um ihn als normales Zeichen zu behandeln). Das i am Ende des regulären Ausdrucks macht die Suche unabhängig von Groß- und Kleinschreibung.
            $this->errors[] = "Im " . $feldname . " sind nur Buchstaben, Zahlen und Minus erlaubt.";
            return false;
        }
        // auf korrekte Länge prüfen
        if (strlen($wert) > 8 || strlen($wert) < 3) {
            $this->errors[] = "Die Länge von " . $feldname . " ist falsch.";
            return false;
        }
        return true;
    }

    public function ist_baujahr(string $wert, string $feldname): bool {
        // Auf Zahlen prüfen
        if (!is_numeric($wert)) { // Wenn der $wert nicht numerisch ist, dann wird im errors Array die Fehlermeldung ergänzt
            $this->errors[] = "Im " . $feldname . " sind nur Zahlen erlaubt.";
            return false;
        }
        // Datum darf nicht in der Zukunft liegen
        if ($wert > date("Y") || $wert <= 1890) { // überprüft den wert, ob dieser größer als das aktuelle Jahr ist oder kleiner gleich 1890. Trifft die Bedingung nicht zu, dann wird im errors Array  die Fehlermeldung ergänzt
            $this->errors[] = $feldname . " muss größer als 1890 und darf nicht in der Zukunft liegen.";
            return false;
        }
        return true;
    }

    public function fehler_aufgetreten(): bool {  //überprüft, ob das Array $this->errors leer ist. 
        if (empty($this->errors)) {
            return false;
        }
        return true;
    }

    public function fehler_html(): string {

        // Ausnahme: Ohne Fehler leeren string zurückgeben
        if (!$this->fehler_aufgetreten()) {
            return "";
        }

        // Eigentliche Fehlermeldungen zusammenbauen
        $ret = "<ul>";
        foreach ($this->errors as $error) {
            $ret .= "<li>" . $error . "</li>";
        }
        $ret .= "</ul>";
        return $ret;
    }

    public function fehler_hinzu(string $fehler):void {
        $this->errors[] = $fehler;
    }
}