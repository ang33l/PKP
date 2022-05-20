-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Czas generowania: 20 Maj 2022, 09:57
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pkp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `connections`
--

CREATE TABLE `connections` (
  `connection_id` int(50) NOT NULL,
  `from_where` varchar(50) NOT NULL,
  `to_where` varchar(50) NOT NULL,
  `depature_time` date NOT NULL,
  `arrive_time` date NOT NULL,
  `hour_of_depature` time(6) NOT NULL,
  `hour_of_arrive` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `connections`
--

INSERT INTO `connections` (`connection_id`, `from_where`, `to_where`, `depature_time`, `arrive_time`, `hour_of_depature`, `hour_of_arrive`) VALUES
(1, 'Krk', 'Rze', '2022-05-02', '2022-05-05', '23:42:55.000000', '24:42:55.000000');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `connection_id` int(50) DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL,
  `position` int(50) DEFAULT NULL,
  `compartment` int(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `buytime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_id`, `connection_id`, `quantity`, `position`, `compartment`, `active`, `buytime`) VALUES
(44, 1, NULL, 1, 2, NULL, 1, '2022-05-19 20:08:58'),
(45, 1, NULL, 9, 7, NULL, 0, '2022-05-19 20:09:16'),
(46, 4, NULL, 4, 3, NULL, 1, '2022-05-19 20:11:52'),
(47, 4, NULL, 3, 4, NULL, 1, '2022-05-19 20:29:09'),
(48, 1, NULL, 1, 2, NULL, 1, '2022-05-19 20:31:32'),
(49, 1, NULL, 3, 4, NULL, 1, '2022-05-19 20:35:05');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`) VALUES
(1, 'admin', '$2y$10$FGM6TuPLYsc41z99NdRy1esIZPGINn./DUe69HKpU0tYYBDEwvHV6'),
(4, 'test', '$2y$10$rxMKWPfFFh3CfPN7T63aY.ULhkg7gx7QHqtOdu1I2j//MPJQgZItu');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connection_id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `connection_id` (`connection_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `connections`
--
ALTER TABLE `connections`
  MODIFY `connection_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`connection_id`) REFERENCES `connections` (`connection_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
