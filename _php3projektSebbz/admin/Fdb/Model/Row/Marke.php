<?php

namespace WIFI\Php3\Fdb\Model\Row;

class Marke extends RowAbstract {   // die Klasse "Marke" erbt alle Methoden und Eigenschaften von RowAbstract und kann diese überschreiben oder erweitern
    protected string $tabelle = "marken";  //  um auf die Tabelle "Marken von Unterklassen aus zugreifen zu können 
}