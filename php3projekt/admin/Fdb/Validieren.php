<?php

namespace WIFI\PHP3\Fdb;

// kein Konstruktor notwendig, kein Wert zu validieren bzw. übergeben

class Validieren 
{
    private array $errors = array(); // in dieses Array schreiben wir die Fehler


    public function ist_ausgefuellt(string $wert, string $feldname): bool // ist der zu prüfende Wert ausgefüllt; Rückgabewert, siehe login.php: Parameter 1 = $_POST benutzername, Parameter2 = Feldbezeichnung "Benutzername"/"Passwort"
    {
        if (empty($wert)){
            $this->errors[] = $feldname . " war leer.";

            return false; //wenn der Wert leer ist - false, sonst false
        }
        return true;
    }
    public function ist_kennzeichen(string $wert, string $feldname): bool
    {
       // Dacherl bedeutet, dass irgend Zeichen gesucht wird, dass nicht A-Z, 0-9 oder - ist. Alles, das gefunden wird, erzeugt einen Fehler. Das i bedeutet case-insensitive (egal ob Groß- oder Kleinbuchstaben)
        if(preg_match("/[^A-Z0-9\-]/i", $wert)){
            $this->errors[] = "Im " . $feldname . " sind nur Buchstaben (keine Umlaute), Zahlen und das Minus-Zeichen erlaubt.";
            return false;
        }
        // auf korrekte Länge prüfen
        if(strlen($wert) > 8 || strlen($wert) < 3) {
            $this->errors[] = "Die Länge im Feld " . $feldname . " ist nicht erlaubt. (min. 3, max. 8 Stellen sind erlaubt";
            return false;
        }
        return true;
    }
    public function ist_jahr(string $wert, string $feldname): bool
    {
       // ich suche alle, die nicht Zahlen sind und wirft dann einen Fehler
        if(preg_match("/[^0-9]/", $wert)){
            $this->errors[] = "Im " . $feldname . " sind nur Zahlen erlaubt.";
            return false;
        }
        // ist das BJ größer als das aktuelle Jahr oder 
        if($wert > date("Y") || $wert < 1900) {
            $this->errors[] = "Das " . $feldname . " darf nicht in der Zukunft bzw. nicht vor 1900 liegen";
            return false;
        }
        return true;
    }

    

    public function fehler_hinzu(string $fehler): void // wenn es kein "return" gibt dann gibt es keinen Rückgabewert
    {
        $this->errors[] = $fehler;
    }

    public function fehler_aufgetreten(): bool
    {
        return !empty($this->errors); //empty gibt boolean zurück
        /* if(empty($this->errors)){
            return false;
        }
        return true;*/
    }

    public function fehler_html(): string // Fehlermeldung soll ausgegeben werden
    {
        if (empty($this->errors)){
            return ""; //wenn keine Fehler im Errors Array sind, dann soll kein <ul> ausgegeben werden, sondern nur ein leerer String. Was wäre wenn Fehler - siehe Code darunter - wird gar nicht mehr ausgeführt. 
            // durch das "return" erspart man sich das "else" - ist evt. übersichtlicher/lesbarer
        }
        $ret = "<ul style='border:1px solid red;'>"; // Fehlermeldung wird zusammengebaut
        foreach($this->errors as $error) {
            $ret .= "<li>" . $error . "</li>";
        }
        $ret .= "</ul>";
        return $ret;


    }
}