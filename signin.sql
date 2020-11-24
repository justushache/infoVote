-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Nov 2020 um 15:28
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `signin`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `name` varchar(300) NOT NULL,
  `number` varchar(300) NOT NULL,
  `manufacturer` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`name`, `number`, `manufacturer`, `description`, `ID`) VALUES
('Shampoo', '69420', 'Daniel', 'Valla eine sehr gute Shampooo', 9),
('Daniel', '5', 'Justus', 'So nen halbstarker Unternehmer ', 10),
('Jusus', '89', 'Justus', 'So nen halbstarker Streber', 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `uid` int(11) NOT NULL,
  `millisCreated` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sessions`
--

INSERT INTO `sessions` (`id`, `hash`, `uid`, `millisCreated`) VALUES
(1, '0', 0, 0),
(2, '433e6eb192559b541db010323bfcce2640af5136', 4, 1606225317),
(3, '29d164a16565c314ab6e47dadf437b65a35eadf8', 4, 1606225372),
(4, 'd74885406ee199dee5bafd0ce0774ea8b39f1d6a', 4, 2147483647),
(5, '773cb8340a583f096cf5ea5729a02e60034f90fe', 4, 1606226794),
(6, '4255597a05bd31b83c10723e3e9db880709047b3', 4, 1606226875),
(7, '30e9d206dd7c97a2498536c6368a886afcf194e4', 4, 1606226955),
(8, 'd606db461e06399f3865cd596130049747dab95a', 4, 1606227133),
(9, 'e889c2abf782fdec5149fb50423d5d42c071c8b7', 4, 1606227147),
(10, 'b8768e4c9c1dd35796eaef23286e01d795815f17', 4, 1606227154),
(11, '6537c92b6a67b358f0e753c48f18a909e11591a8', 4, 1606227156),
(12, 'a36702c9cb91729457039ea8ceb1ca03433e3264', 4, 1606227156),
(13, '1949d0b124ce50ee44613017cfe33524daf01302', 4, 1606227160),
(14, '8e15fe528966b7676e06e7838095f9d99dad330a', 4, 1606227161),
(15, '69cf03679cbe5a86e32e245b8176a347eefe7c85', 4, 1606227162),
(16, '27c118b3af696a5a43905b153e1eefc1e184d104', 4, 1606227199),
(17, 'cc87bc3e8880aa31789a5581397d27f4ff57627e', 4, 1606227201),
(18, 'f80eef59dd8c49c1a755c18c4a1af891f0ab1490', 4, 1606227202),
(19, '73fb4b7ea4fb105bffdc2b8dd42349e291437ea3', 4, 1606227203),
(20, '77cfe3a162c96bc3ad4aafb55da3ee29a39c0495', 4, 1606227204),
(21, 'b56fe3dfa5cdbea9db3bd158efe16603e00083ee', 4, 1606227269),
(22, 'e966ecca397857f797fd46d730b7ae78d5b8bd5e', 4, 1606227270),
(23, '8ac1c56246ba136bb2c4ea86574f9d51785a0bd2', 4, 1606227271),
(24, '1d93716119b49aff6a538eb180aad7a936a7c8f7', 4, 1606227272),
(25, 'a584593771ab91ae31f6d3ce17fa955c2c01f3aa', 4, 1606227273),
(26, '739e39aa6e1ee27aa402e599816fa47ca4e0f5e1', 4, 1606227275),
(27, '20d81fd36abbed12b78c9425c28bea2424d6cd2b', 4, 1606227291);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `name`, `password`) VALUES
(1, 'hallo', '$2y$10$3UKethQ7sapZxOxWy2L9CObcRaPwP6omXNSFg7j3bg0eQ16yuxOAi'),
(2, '', '$2y$10$eOYL3AlOEuFuCT9BWgd9/OHXjUgc7JHu246PwCM7j/3DVKdMQPPZ6'),
(3, 'justus', '$2y$10$RPwBswUEaQwxIyAGjGanPOd.bYOF2C2f8JLBGl0LXCxMADoa5iR06'),
(4, 'theo', '$2y$10$ISKIcYw5bixnElnhJOxaeeNAOaqMNkNSf/Mtj.zyvCatGf2tF9Kbu');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `votes`
--

CREATE TABLE `votes` (
  `ID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
