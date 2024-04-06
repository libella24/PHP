<?php

namespace WIFI\JWE; // Der Ordner "tiere" ist der Hauptordner, dieser muss nicht angegeben werden.
use WIFI\JWE\Tier\TierAbstract;

// Interface - Funktionen werden definiert (ohne Namen), die in einer Klasse vorgegeben sind. Info, für die Entwickler, um genau zu wissen, welche Funktionen eingebaut werden müssen.

interface TiereInterface {

    public function add(TierAbstract $tier): void; //alle weiteren Erben werden hier übergeben
}