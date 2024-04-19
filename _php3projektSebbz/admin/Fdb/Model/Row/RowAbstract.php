<?php

namespace WIFI\Php3\Fdb\Model\Row;
use WIFI\Php3\Fdb\Mysql;

abstract class RowAbstract {

    protected string $tabelle;
    private array $daten = [];

    public function __construct(array|int $id_oder_daten) {  // erstellt ein Objekt der Klasse, ruft entweder array oder key ab und speichert die Daten
        if (is_array($id_oder_daten)) {
            // Fertiges Array wurde übergeben, verwenden wie gegeben.
            $this->daten = $id_oder_daten;
        } else {
            //id wurde übergeben, Daten aus Datenbank auslesen.
            $db = Mysql::getInstanz();
            $sql_id = $db->escape($id_oder_daten);
            $ergebnis = $db->query("SELECT * FROM {$this->tabelle} WHERE id = '{$sql_id}'");
            $this->daten = $ergebnis->fetch_assoc();
        }
    }

    public function __get(string $eigenschaft): mixed {  //Magic method - prüft, ob eine Spalte in einer Tabelle existiert (gibt Array aus) oder nicht (wirft Exception)
        if (!array_key_exists($eigenschaft, $this->daten)) {
            throw new \Exception("Die Spalte {$eigenschaft} existiert in der Tabelle {$this->tabelle} nicht.");
        }
        return $this->daten[$eigenschaft];
    }

    public function entfernen(): void { // entfernt
        $db = Mysql::getInstanz();
        $sql_id = $db->escape($this->id);
        $db->query("DELETE FROM {$this->tabelle} WHERE id = '{$sql_id}'");
    }

    public function speichern(): void {

        $db = Mysql::getInstanz();
        $sql_felder = "";

        foreach ($this->daten as $spaltenname => $wert) {
            if ($spaltenname == "id") { // spaltenname "id" nie updaten oder inserten
                continue;
            }
            $sql_wert = $db->escape($wert);
            $sql_felder .= "{$spaltenname} = '{$wert}', "; 
        }

        // Letztes Komma entfernen
        $sql_felder = rtrim($sql_felder, ", ");

        // In DB einfügen
        if (!empty($this->daten["id"])) {
            // in DB bearbeiten
            $sql_id = $db->escape($this->daten["id"]);
            $db->query("UPDATE {$this->tabelle} SET {$sql_felder} WHERE id = '{$sql_id}'");
        } else {
            // in DB einfügen
            $db->query("INSERT INTO {$this->tabelle} SET {$sql_felder}");
        }

        /*Würde so aussehen: query("INSERT INTO rezepte SET
        titel = '{$sql_titel}',
        beschreibung = '{$sql_beschreibung}',
        benutzer_id = '{$sql_benutzer_id}'
        ");*/
    }
}