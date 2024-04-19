<?php

namespace WIFI\apvsa\classes; // in diesem Verzeichnis liegt die Datei 

class Mysql {

    // Singleton Implementierung - nur eine DB Instanz aufbauen
    // =========================================================
    // Vermeidet mehrfache Erstellung des selben Objekts.
    // Um nicht mehrere Datenbank-Verbindungen
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