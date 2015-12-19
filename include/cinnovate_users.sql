-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 17 dec 2015 om 11:32
-- Serverversie: 5.5.45
-- PHP-versie: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinnovate_users`
--
CREATE DATABASE IF NOT EXISTS `cinnovate_users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cinnovate_users`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `helpcalls`
--

CREATE TABLE IF NOT EXISTS `helpcalls` (
  `ID` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_time` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `helpcalls`
--

TRUNCATE TABLE `helpcalls`;
--
-- Gegevens worden geëxporteerd voor tabel `helpcalls`
--

INSERT INTO `helpcalls` (`ID`, `id_patient`, `id_time`) VALUES(9, 2, 1450284660);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL,
  `master` int(11) NOT NULL,
  `patient` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `links`
--

TRUNCATE TABLE `links`;
--
-- Gegevens worden geëxporteerd voor tabel `links`
--

INSERT INTO `links` (`id`, `master`, `patient`) VALUES(1, 1, 5);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(3, 0, 7);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(4, 1, 2);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(5, 1, 6);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(6, 0, 3);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(7, 0, 5);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(10, 1, 2);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(14, 0, 3);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(15, 1, 3);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(16, 1, 29122752);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(17, 1, 0);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(18, 1, 3);
INSERT INTO `links` (`id`, `master`, `patient`) VALUES(19, 0, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `lastName` text NOT NULL,
  `description` text NOT NULL,
  `birthdate` date NOT NULL,
  `patients` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `master`
--

TRUNCATE TABLE `master`;
--
-- Gegevens worden geëxporteerd voor tabel `master`
--

INSERT INTO `master` (`ID`, `name`, `lastName`, `description`, `birthdate`, `patients`) VALUES(0, 'Jasper', 'van der Lindenboom', 'Master', '2015-12-01', '');
INSERT INTO `master` (`ID`, `name`, `lastName`, `description`, `birthdate`, `patients`) VALUES(1, 'Jasper', 'van der Linden', 'Master', '2015-11-09', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `Patient_ID` int(11) NOT NULL,
  `fName` text CHARACTER SET utf8 NOT NULL,
  `insertion` varchar(10) NOT NULL,
  `lName` text NOT NULL,
  `age` int(3) NOT NULL,
  `description` text NOT NULL,
  `profile_picture` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `patients`
--

TRUNCATE TABLE `patients`;
--
-- Gegevens worden geëxporteerd voor tabel `patients`
--

INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(2, 'Jasper', '', 'van der Linden', 16, 'Is gewoon knettergek!!!', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(3, 'Jacob', '', 'Bunschoten', 99, 'Geeft geen cijfers!', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(4, 'Mariska', '', 'Verhagen', 16, 'Schopt!', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(5, 'Erik', '', 'Baalbergen', 17, 'Nog gekker dan patiÃ«nt 2', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(6, 'Max', '', 'van der Horst', 18, 'Gekke hacker jongï¿½h', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(7, 'Raphael', '', 'Bunck', 16, 'Die jolige jongen toch', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(8, 'Ruben', '', 'Siekman', 17, '#AdventureSquat', NULL);
INSERT INTO `patients` (`Patient_ID`, `fName`, `insertion`, `lName`, `age`, `description`, `profile_picture`) VALUES(9, 'Scorpio', '', 'Baardwijk', 16, 'De benjamin van het stel.', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pillnotifications`
--

CREATE TABLE IF NOT EXISTS `pillnotifications` (
  `Notif_ID` int(11) NOT NULL,
  `Pill_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Time_ID` varchar(11) NOT NULL,
  `Master_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='Hier komen de notificaties van de pilletjes die genomen moeten worden door de patienten.';

--
-- Tabel leegmaken voor invoegen `pillnotifications`
--

TRUNCATE TABLE `pillnotifications`;
--
-- Gegevens worden geëxporteerd voor tabel `pillnotifications`
--

INSERT INTO `pillnotifications` (`Notif_ID`, `Pill_ID`, `Patient_ID`, `Time_ID`, `Master_ID`) VALUES(19, 1, 7, '11122015150', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pills`
--

CREATE TABLE IF NOT EXISTS `pills` (
  `Pill_ID` int(11) NOT NULL,
  `Pill_Name` text NOT NULL,
  `Beschrijving` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `pills`
--

TRUNCATE TABLE `pills`;
--
-- Gegevens worden geëxporteerd voor tabel `pills`
--

INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(1, 'Diclofenac', '(Cataflam, Voltaren), werkt als ontstekingsremmende pijnstiller; NSAID');
INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(2, 'Amoxicilline', '(Clamoxyl), antibioticum');
INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(3, 'Omeprazol', '(Losec-mups), Remt productie overvloedig maagzuur');
INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(4, 'Doxycycline', '(Vibramycin), antibioticum');
INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(5, 'Ibuprofen', '(Brufen), pijnstiller');
INSERT INTO `pills` (`Pill_ID`, `Pill_Name`, `Beschrijving`) VALUES(6, 'Ritalin', 'Methylfenidaat\r\nHet remt de heropname van dopamine en noradrenaline');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `helpcalls`
--
ALTER TABLE `helpcalls`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `ID_2` (`ID`);

--
-- Indexen voor tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- Indexen voor tabel `pillnotifications`
--
ALTER TABLE `pillnotifications`
  ADD PRIMARY KEY (`Notif_ID`);

--
-- Indexen voor tabel `pills`
--
ALTER TABLE `pills`
  ADD PRIMARY KEY (`Pill_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `helpcalls`
--
ALTER TABLE `helpcalls`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT voor een tabel `master`
--
ALTER TABLE `master`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `Patient_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `pillnotifications`
--
ALTER TABLE `pillnotifications`
  MODIFY `Notif_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT voor een tabel `pills`
--
ALTER TABLE `pills`
  MODIFY `Pill_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
