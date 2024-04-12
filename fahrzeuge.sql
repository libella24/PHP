-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2024 um 20:12
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeuge`
--

CREATE TABLE `fahrzeuge` (
  `id` int(10) UNSIGNED NOT NULL,
  `kennzeichen` varchar(50) NOT NULL,
  `marken_id` int(10) UNSIGNED NOT NULL,
  `farbe` varchar(255) NOT NULL,
  `baujahr` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `fahrzeuge`
--

INSERT INTO `fahrzeuge` (`id`, `kennzeichen`, `marken_id`, `farbe`, `baujahr`) VALUES
(1, 'SL-891MO', 1, 'schwarz', '2019'),
(4, 'SL-892MO', 1, 'anthrazit', '2020'),
(5, 'S-123AB', 4, 'rot', '2022'),
(6, 'HA-456CZ', 4, 'metallic-grün', '1998'),
(7, 'ZE-445HU', 2, 'hellblau', '2004');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marken_id` (`marken_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fahrzeuge`
--
ALTER TABLE `fahrzeuge`
  ADD CONSTRAINT `fahrzeuge_ibfk_1` FOREIGN KEY (`marken_id`) REFERENCES `marken` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
