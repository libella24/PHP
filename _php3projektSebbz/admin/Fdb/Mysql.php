<?php

namespace WIFI\Php3\Fdb;

class Mysql {

    // Singleton Implementierung
    //Vermeidet mehrfache Erstellung des selben Objekts.
    // Hier gewünscht, um nicht mehrere Datenbank-Verbindungen
    // (Über den Konstruktor) gleichzeitig aufzubauen
    private static ?Mysql $instanz = null;

    public static function getInstanz(): Mysql {
        if (!self::$instanz) {
            self::$instanz = new Mysql();
        }
        return self::$instanz;
    }
    // Singleton Implementierung ENDE

    // Jede Klasse ist gleichzeitig ein Datentyp
    private \mysqli $db;

    private function __construct() {
        $this->verbinden();
    }

    public function verbinden() {
        // Mysqli-Objekt (von PHP) erstellen und DB-Verbindung aufbauen
        // PHP hat mysqli auf der obersten Ebene definiert, deshalb der Backslash vor mysqli
        // Das new mysqli kommt von der PHP-Dokumentation und ist für Klassen anders als für prozedurale
        $this->db = new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORT, MYSQL_DATENBANK);
        // Zeichensatz mitteilen, in dem wir mit der DB sprechen wollen
        $this->db->set_charset('utf8mb4');
    }

    //Funktion um SQL-Injektionen zu vermeiden
    public function escape(string $wert): string {
        return $this->db->real_escape_string($wert);
    }

    public function query(string $input): \mysqli_result|bool {
        $ergebnis = $this->db->query($input);
        return $ergebnis;
    }
}