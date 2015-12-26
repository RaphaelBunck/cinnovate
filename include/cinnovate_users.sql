-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 26 dec 2015 om 01:47
-- Serverversie: 5.5.45
-- PHP-versie: 5.4.44

--
-- Database die bij de CinnovateApp van Max, Ruben, Raphaël, Scorpio, Jasper en Erik hoort.
--
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cinnovate_users`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `helpcalls`
--
-- Aangemaakt: 14 dec 2015 om 23:00
--

CREATE TABLE IF NOT EXISTS `helpcalls` (
  `ID` int(11) NOT NULL,
  `id_patient` int(11) NOT NULL,
  `id_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `links`
--
-- Aangemaakt: 14 dec 2015 om 22:45
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL,
  `master` int(11) NOT NULL,
  `patient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `master`
--
-- Aangemaakt: 18 dec 2015 om 22:42
--

CREATE TABLE IF NOT EXISTS `master` (
  `id` int(11) NOT NULL,
  `voornaam` text NOT NULL,
  `achternaam` text NOT NULL,
  `beschrijving` text NOT NULL,
  `geboortedatum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patients`
--
-- Aangemaakt: 18 dec 2015 om 22:44
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL,
  `voornaam` text CHARACTER SET utf8 NOT NULL,
  `achternaam` text NOT NULL,
  `geboortedatum` int(11) NOT NULL,
  `beschrijving` text NOT NULL,
  `profielfoto` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pillnotifications`
--
-- Aangemaakt: 07 dec 2015 om 13:35
--

CREATE TABLE IF NOT EXISTS `pillnotifications` (
  `Notif_ID` int(11) NOT NULL,
  `Pill_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Time_ID` varchar(11) NOT NULL,
  `Master_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Hier komen de notificaties van de pilletjes die genomen moeten worden door de patienten.';

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pills`
--
-- Aangemaakt: 09 dec 2015 om 16:00
--

CREATE TABLE IF NOT EXISTS `pills` (
  `Pill_ID` int(11) NOT NULL,
  `Pill_Name` text NOT NULL,
  `Beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`),
  ADD KEY `ID_2` (`id`);

--
-- Indexen voor tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `pillnotifications`
--
ALTER TABLE `pillnotifications`
  MODIFY `Notif_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `pills`
--
ALTER TABLE `pills`
  MODIFY `Pill_ID` int(11) NOT NULL AUTO_INCREMENT;