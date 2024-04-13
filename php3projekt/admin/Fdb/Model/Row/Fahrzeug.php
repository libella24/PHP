<?php

namespace WIFI\PHP3\Fdb\Model\Row;

class Fahrzeug extends RowAbstract //wir erben von der RowAbstract
{
    protected string $tabelle = "fahrzeuge";

    public function get_marke(): Marke //gibt das Marken Objekt zurück
    {
        return new Marke($this->marken_id);
    }
}