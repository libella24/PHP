<?php

namespace WIFI\PHP3\Fdb;

class Mysql
{
    // Singleton Implementierung

    private static ?Mysql $instanz = null; // Beim ersten Mal ist die Methode leer; die Instanz ist für alle Objekte gleich, kann auch null sein

    public static function getInstanz(): Mysql
    {
        if (empty(self::$instanz)) { // wenn die Instanz leer ist, dann ....
            self::$instanz = new Mysql(); //merkt sich hier in dieser Klasse die DB-Verbindung 
        }
        return self::$instanz;
    }
    // Singleton Implementierung Ende



    private \mysqli $db; // die Klasse ist auch der Datentyp

    private public function __construct()
    {
        $this->verbinden();
        // $this->einstellung = "asdf";
        // $this->query("");
    }

    public function verbinden() // verlinkt auf den Konstructor wenn der meherer andere Settings beinhaltet. 
    {   // Mysqli-Objekt (von PHP) erstellen und DB-Verbindung aufbauen
        $this->db = new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORT, MYSQL_DATENBANK);
        // Zeichensatz mitteilen, in dem wir mit der DB sprechen wollen
        $this->db->set_charset("utf8mb4");

    }
    public function escape(string $wert): string 
    {
        return $this->db->real_escape_string($wert);
    }
    public function query(string $input): \mysqli_result|bool
    {
        $ergebnis = $this->db->query($input);
        //echo "<pre>"; print_r($ergebnis);
        return $ergebnis;
    }
}