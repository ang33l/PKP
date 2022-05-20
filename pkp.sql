-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Maj 2022, 13:39
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

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
-- Struktura tabeli dla tabeli `carriage`
--

CREATE TABLE `carriage` (
  `carriage_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `carriage`
--

INSERT INTO `carriage` (`carriage_id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `carriage_compartment`
--

CREATE TABLE `carriage_compartment` (
  `carriage_compartment_id` int(50) NOT NULL,
  `carriage_id` int(50) NOT NULL,
  `compartment_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `carriage_compartment`
--

INSERT INTO `carriage_compartment` (`carriage_compartment_id`, `carriage_id`, `compartment_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(4, 1, 3),
(5, 1, 8),
(6, 2, 1),
(8, 2, 3),
(3, 2, 6),
(7, 2, 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `compartment`
--

CREATE TABLE `compartment` (
  `compartment_id` int(50) NOT NULL,
  `quantity_seats` int(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `compartment`
--

INSERT INTO `compartment` (`compartment_id`, `quantity_seats`, `type`) VALUES
(1, 10, '1. klasa'),
(2, 15, '1. klasa'),
(3, 20, '2. klasa'),
(4, 10, '2. klasa'),
(5, 15, '2. klasa'),
(6, 20, '1. klasa'),
(7, 25, '1. klasa'),
(8, 25, '2. klasa'),
(9, 30, '1. klasa'),
(10, 30, '2. klasa'),
(11, 35, '1. klasa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `connections`
--

CREATE TABLE `connections` (
  `connection_id` int(50) NOT NULL,
  `train_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `connections`
--

INSERT INTO `connections` (`connection_id`, `train_id`) VALUES
(1, 1),
(10, 1),
(11, 1),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `connections_stops`
--

CREATE TABLE `connections_stops` (
  `stops_id` int(11) NOT NULL,
  `connection_id` int(11) NOT NULL,
  `town` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `connections_stops`
--

INSERT INTO `connections_stops` (`stops_id`, `connection_id`, `town`, `date`) VALUES
(1, 8, 'Kraków', '2022-05-20 13:31:10'),
(2, 8, 'Warszawa', '2022-05-20 16:31:10'),
(3, 8, 'Wieliczka', '2022-05-20 12:32:56'),
(4, 8, 'Nowy Sącz', '2022-05-20 11:32:56');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `connection_id` int(50) DEFAULT NULL,
  `train_id` int(11) NOT NULL,
  `position` int(50) DEFAULT NULL,
  `compartment` int(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `buytime` timestamp NULL DEFAULT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `train`
--

CREATE TABLE `train` (
  `train_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `train`
--

INSERT INTO `train` (`train_id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `train_carriage`
--

CREATE TABLE `train_carriage` (
  `train_carriage_id` int(50) NOT NULL,
  `train_id` int(50) NOT NULL,
  `carriage_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `train_carriage`
--

INSERT INTO `train_carriage` (`train_carriage_id`, `train_id`, `carriage_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 2),
(4, 1, 2),
(5, 2, 1),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_type_id`, `user_name`, `password`, `email`, `first_name`, `last_name`) VALUES
(1, 1, 'admin', '$2y$10$FGM6TuPLYsc41z99NdRy1esIZPGINn./DUe69HKpU0tYYBDEwvHV6', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `name`) VALUES
(1, 'head_admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `carriage`
--
ALTER TABLE `carriage`
  ADD PRIMARY KEY (`carriage_id`);

--
-- Indeksy dla tabeli `carriage_compartment`
--
ALTER TABLE `carriage_compartment`
  ADD PRIMARY KEY (`carriage_compartment_id`),
  ADD KEY `carriage_id` (`carriage_id`,`compartment_id`),
  ADD KEY `compartment_id` (`compartment_id`);

--
-- Indeksy dla tabeli `compartment`
--
ALTER TABLE `compartment`
  ADD PRIMARY KEY (`compartment_id`);

--
-- Indeksy dla tabeli `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connection_id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `train_id_2` (`train_id`);

--
-- Indeksy dla tabeli `connections_stops`
--
ALTER TABLE `connections_stops`
  ADD PRIMARY KEY (`stops_id`),
  ADD KEY `connection_id` (`connection_id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `connection_id` (`connection_id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `start` (`start`,`end`);

--
-- Indeksy dla tabeli `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`train_id`);

--
-- Indeksy dla tabeli `train_carriage`
--
ALTER TABLE `train_carriage`
  ADD PRIMARY KEY (`train_carriage_id`),
  ADD KEY `train_id` (`train_id`),
  ADD KEY `carriage_id` (`carriage_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type` (`user_type_id`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indeksy dla tabeli `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `carriage`
--
ALTER TABLE `carriage`
  MODIFY `carriage_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `carriage_compartment`
--
ALTER TABLE `carriage_compartment`
  MODIFY `carriage_compartment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `compartment`
--
ALTER TABLE `compartment`
  MODIFY `compartment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `connections`
--
ALTER TABLE `connections`
  MODIFY `connection_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `connections_stops`
--
ALTER TABLE `connections_stops`
  MODIFY `stops_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `train`
--
ALTER TABLE `train`
  MODIFY `train_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `train_carriage`
--
ALTER TABLE `train_carriage`
  MODIFY `train_carriage_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `carriage_compartment`
--
ALTER TABLE `carriage_compartment`
  ADD CONSTRAINT `carriage_compartment_ibfk_1` FOREIGN KEY (`carriage_id`) REFERENCES `carriage` (`carriage_id`),
  ADD CONSTRAINT `carriage_compartment_ibfk_2` FOREIGN KEY (`compartment_id`) REFERENCES `compartment` (`compartment_id`);

--
-- Ograniczenia dla tabeli `connections`
--
ALTER TABLE `connections`
  ADD CONSTRAINT `connections_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`);

--
-- Ograniczenia dla tabeli `connections_stops`
--
ALTER TABLE `connections_stops`
  ADD CONSTRAINT `connections_stops_ibfk_1` FOREIGN KEY (`connection_id`) REFERENCES `connections` (`connection_id`);

--
-- Ograniczenia dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`connection_id`) REFERENCES `connections` (`connection_id`),
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`);

--
-- Ograniczenia dla tabeli `train_carriage`
--
ALTER TABLE `train_carriage`
  ADD CONSTRAINT `train_carriage_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`),
  ADD CONSTRAINT `train_carriage_ibfk_2` FOREIGN KEY (`carriage_id`) REFERENCES `carriage` (`carriage_id`);

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
