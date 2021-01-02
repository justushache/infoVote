-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 01:04 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uid`) VALUES
(5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `name` varchar(300) NOT NULL,
  `number` varchar(300) NOT NULL,
  `uid` int(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `ID` int(11) NOT NULL,
  `imagepath` varchar(150) NOT NULL,
  `homepage` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `number`, `uid`, `description`, `ID`, `imagepath`, `homepage`) VALUES
('Cyberpunk 2077', '1337', 5, 'Bestes Spiel überhaupt. hoffe ich zumindest', 13, '1607444986595Cyberpunk 2077.jpg', 'https://www.cyberpunk.net/de/en/'),
('The Witcher 3', '42', 5, 'Auch ein seht gutes Spiel', 15, '1607446028956The Witcher 3.jpg', 'https://thewitcher.com/en/'),
('Half life 2', '2', 5, 'Eigentlich das erste gute 3D game', 16, '1607446526858Half life 2.jpg', 'https://www.half-life.com/en/halflife2'),
('Half life', '1', 5, 'Eines der ersten 3D games, nicht wirklich gut', 17, '1607446775096Half life.jpg', 'https://www.half-life.com/en/halflife'),
('Portal 2', '2', 5, 'Ich meine es ist Portal und die Story ist mal nicht ganz so kurz ?', 18, '1607446931442Portal 2.jpg', 'www.thinkwithportals.com'),
('Portal', '1', 5, 'Einfach nur geil bloß zu kurz', 19, '1607447063469Portal.jpg', 'https://store.steampowered.com/app/400/Portal/'),
('', '', 5, '', 50, '1609236769152.', ''),
('', '', 5, '', 51, '1609236774455.', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID`, `uid`, `title`, `review`, `pid`) VALUES
(16, 5, 'd', 'd', 13),
(17, 5, 'sadf', 'asdf', 13),
(18, 5, 'asdf', 'asdf', 17),
(19, 5, 'asdf', 'asdf', 17),
(20, 5, 'super Spiel', 'geile Story mit viel Liebe geschrieben.\r\n10/10 would buy again', 13),
(21, 5, 'dsf', 'asdf', 15),
(22, 5, 'asdf', 'asdf', 19),
(23, 5, 'asdf', 'asdf', 15),
(24, 8, 'Super Game', 'die Bugs machen fast gar nichts\r\n', 13),
(25, 8, 'sfa', 'asdf', 15),
(26, 8, 'asdf', 'asdf', 16),
(27, 8, 'asdf', 'asdf', 17),
(28, 8, 'dfgh', 'dfgh', 18),
(29, 5, 'super Spiel 1 ', '1234', 18),
(30, 5, 'asdf', 'asdf', 51);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `uid` int(11) NOT NULL,
  `millisCreated` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
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
(27, '20d81fd36abbed12b78c9425c28bea2424d6cd2b', 4, 1606227291),
(28, '857e69b55934b87e97114f5896fb51749981f017', 5, 1607444751),
(29, '12a976dbe3a0cc14842bae22bc80b57537dc6e4f', 5, 1607446756),
(30, 'da1827c946af0edd490b28b863e850f22992e236', 5, 1607979619),
(31, '4a77313e7f02bcb6cbf47c3317a9bce7bc8b34ab', 5, 1607980897),
(32, '420c6416dd409dcf120dccb5929e5be66b2e67d7', 5, 1608484631),
(33, 'cf36b56b4871b63a2eff2bed06e00b5a267e35a4', 5, 1608487806),
(34, '64868ae591581f7bb0b9b83061a69877f4674be9', 13, 1608490687),
(35, '973aca1ae172ec870ba5df417bf9dccce19730af', 5, 1608491073),
(36, '47e7558b8daed2957a7b63b39e9538b2a974dc5b', 5, 1608491201),
(37, '1f4927d5eedc0ece21ab258c2b9510031adb16a0', 14, 1608491223),
(38, '291640d99ebab7a53c9961ac41f1794c7f27c0ef', 5, 1608913887),
(39, '9152a26b7d649044adf30801788ae3c8897a9287', 5, 1609083812),
(40, '131c416c3eb34e98f4db4ae7095eabbe87b6b455', 5, 1609159182),
(41, 'b128a4a5bc3ddcf20ca13b1fb10bcc7c686e5141', 5, 1609166364),
(42, '81680a53aa28348d494b6664e8e52a8c18d86949', 5, 1609234452),
(43, '8980fd6c0733cb02bc20b613c650b555dd9aa31c', 5, 1609236488),
(44, 'fc52a071c6629aafca8c6e45cf14102241de14bc', 8, 1609237983),
(45, 'c8c4b9edca510c997ab066d8c226570e4489c095', 5, 1609527465),
(46, 'f8d9e8fa25cd70983cd9c68374c4a1ecac6c5ddf', 5, 1609582462);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`uid`, `pid`, `stars`, `ID`) VALUES
(5, 13, 4, 1),
(5, 15, 5, 2),
(8, 13, 5, 4),
(8, 15, 5, 6),
(8, 16, 5, 8),
(8, 17, 5, 10),
(8, 18, 2, 12),
(5, 19, 5, 14),
(5, 19, 5, 15),
(5, 18, 5, 16),
(5, 18, 5, 17),
(5, 51, 5, 18),
(5, 51, 5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `password`) VALUES
(1, 'hallo', '$2y$10$3UKethQ7sapZxOxWy2L9CObcRaPwP6omXNSFg7j3bg0eQ16yuxOAi'),
(2, '', '$2y$10$eOYL3AlOEuFuCT9BWgd9/OHXjUgc7JHu246PwCM7j/3DVKdMQPPZ6'),
(3, 'justus', '$2y$10$RPwBswUEaQwxIyAGjGanPOd.bYOF2C2f8JLBGl0LXCxMADoa5iR06'),
(4, 'theo', '$2y$10$ISKIcYw5bixnElnhJOxaeeNAOaqMNkNSf/Mtj.zyvCatGf2tF9Kbu'),
(5, 'katze', '$2y$10$y8GOUNeSt67g152hxP7IR.vcHTqN27FoyPpZBzKG6UNG.IySRyKvG'),
(6, 'Heinz', '$2y$10$3Yw.fRei5MNxDFbg42dn3.mIc7K0a7xZQnM09.rn.Isp86zUTVyES'),
(7, 'Andre', '$2y$10$EFgoduBDbQFZv3nKUyokoeuFAFbFGcnxfa8iRIUJoAKwEs3R19CnK'),
(8, 'Half life', '$2y$10$xHFUlg8D7Xs88v5uS/W3Lu1jlJrxttX/vHUwqegLqdOf8UZoBRTuS'),
(9, 'asd', '$2y$10$DtvG7ztHd0H07mtubNL9deOfjsQZ.bYBstGE9TiQ8WNXH2hoKN18m'),
(10, 'root', '$2y$10$ptvQuTiBM4kvrfhUpx0jnusfhWYDe3NEEfDEmP6m2f9YI/twFG56a'),
(11, '1234', '$2y$10$W4C90fESnZmNt9uD6JAjAuUO8mhF4rQdrQq4zrg15csvQHpiq/.VK'),
(12, '125136', '$2y$10$ItkO6uaIEJx1xR2WM3YOJe/YQMAPHdZqRkAP6WqaDXKFGE6TUAX9e'),
(13, '1654136', '$2y$10$2oS7TgJMweZqt8xcSrfqtujqxY4F5lO46WV0Kop6Z.stwqCyexcNO'),
(14, '1', '$2y$10$9.nihTt/ZhSZcrbHH7W9QOMGvVrqQtVi04XzM9o.b4PLJa7Q6D1iy');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `ID` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
