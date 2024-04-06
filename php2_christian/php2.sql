-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Mrz 2024 um 15:32
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `php2`
--
CREATE DATABASE IF NOT EXISTS `php2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php2`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `benutzername` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwort` varchar(255) NOT NULL,
  `anzahl_logins` int(11) NOT NULL,
  `letztes_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `benutzername`, `email`, `passwort`, `anzahl_logins`, `letztes_login`) VALUES
(1, 'herbert', NULL, '$2y$10$YInydJWDSXv8m53TzaTWluImjAbKFdv.mBBTZf.Oelg8HW4mpYtSO', 6, '2024-03-15 19:02:45'),
(3, 'gustav', 'gustav@wifi.de', '$2y$10$NEGIpX8jCEeZswXVvQvRwuup1OdtUjKy0z.UPWgYYVjYkb.ioX4rG', 6, '2024-03-16 09:39:51'),
(4, 'christian', 'herbst@gmx.at', '$2y$10$NEGIpX8jCEeZswXVvQvRwuup1OdtUjKy0z.UPWgYYVjYkb.ioX4rG', 0, NULL),
(5, 'herbst', 'herbst@wifi.at', '$2y$10$YInydJWDSXv8m53TzaTWluImjAbKFdv.mBBTZf.Oelg8HW4mpYtSO', 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rezepte`
--

CREATE TABLE `rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL,
  `benutzer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `rezepte`
--

INSERT INTO `rezepte` (`id`, `titel`, `beschreibung`, `benutzer_id`) VALUES
(1, 'Kaiserschmarr', 'Ist sehr gelb.', 1),
(2, 'Gulasch', 'herzhaft lecker', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten`
--

CREATE TABLE `zutaten` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(50) NOT NULL,
  `menge` float DEFAULT NULL,
  `einheit` varchar(50) DEFAULT NULL,
  `kcal_pro_100` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `zutaten`
--

INSERT INTO `zutaten` (`id`, `titel`, `menge`, `einheit`, `kcal_pro_100`) VALUES
(1, 'Zwiebel', 1, 'Stk', 100),
(2, 'Mehl', 100, 'Gramm', 10),
(3, 'Eier', 1, 'Stk', 250),
(4, 'Spinat', 1, 'gramm', 15),
(5, 'Ingwer', 0, '', 0),
(6, 'Käse', 0, '', 0),
(7, 'Fleisch', 0, '', 0),
(9, 'Getreide', NULL, NULL, NULL),
(11, 'Mais', 4, 'stk', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutaten_zu_rezepte`
--

CREATE TABLE `zutaten_zu_rezepte` (
  `id` int(10) UNSIGNED NOT NULL,
  `rezepte_id` int(10) UNSIGNED NOT NULL,
  `zutaten_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `zutaten_zu_rezepte`
--

INSERT INTO `zutaten_zu_rezepte` (`id`, `rezepte_id`, `zutaten_id`) VALUES
(1, 2, 3),
(2, 1, 2),
(3, 2, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- Indizes für die Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titel` (`titel`),
  ADD KEY `benutzer_id` (`benutzer_id`);

--
-- Indizes für die Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rezepte_id` (`rezepte_id`),
  ADD KEY `zutaten_id` (`zutaten_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `zutaten`
--
ALTER TABLE `zutaten`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rezepte`
--
ALTER TABLE `rezepte`
  ADD CONSTRAINT `rezepte_ibfk_2` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints der Tabelle `zutaten_zu_rezepte`
--
ALTER TABLE `zutaten_zu_rezepte`
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_1` FOREIGN KEY (`rezepte_id`) REFERENCES `rezepte` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `zutaten_zu_rezepte_ibfk_2` FOREIGN KEY (`zutaten_id`) REFERENCES `zutaten` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
