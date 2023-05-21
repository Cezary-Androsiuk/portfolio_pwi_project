-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Maj 14, 2023 at 06:00 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `about_me`
--

CREATE TABLE `about_me` (
  `data_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `about_me`
--

INSERT INTO `about_me` (`data_id`, `content`) VALUES
(1, 'Content - I am baby programer');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password_hash` text NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `login`, `password_hash`, `register_date`) VALUES
(1, 'Czarek_login', '138179396bc71b5c4ba1c1c9e82160f0fcb3df08a72d0dad42a53d08ea357d6f', '2023-05-14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `response_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `name`, `date`, `content`, `response_id`) VALUES
(1, 1, 'Fajny komentator', '2023-04-20', 'Zawartość komentarza', NULL),
(2, 1, 'Drugi komentujący poprzedni komentarz', '2023-04-20', 'Zawartość komentarza komentującego inny komentarz', 1),
(3, 1, 'Trzeci komentujący pierwszy komentarz', '2023-04-20', 'Zawartość komentarza komentującego również inny komentarz', 1),
(24, 1, '4 komentujący pierwszy komentarz', '2023-05-13', 'wiadomość', 1),
(25, 1, '5 komentujący post', '2023-05-13', 'zawartość komentarza ', NULL),
(26, 1, '6 komentator', '2023-05-14', 'ja tylko testuje liczenie komentarzy', NULL),
(27, 1, '7 komentator', '2023-05-14', 'Wszystko fajnie działa :)', 26),
(32, 1, 'asd', '2023-05-14', 'asdasda', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `sender_mail` text NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `readed` int(11) NOT NULL DEFAULT 0,
  `spam` int(11) NOT NULL DEFAULT 0,
  `sender_ip` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `sender_mail`, `message`, `date`, `readed`, `spam`, `sender_ip`) VALUES
(1, 'marek@gmail.com', 'Siemka, jestem zainteresowany współpracą', '2023-04-20', 1, 0, '192.168.0.1'),
(2, 'arek@gmail.com', 'Siemka, również jestem zainteresowany współpracą', '2023-04-20', 1, 0, '192.168.0.2'),
(3, '123@gmail.com', 'nsdfjskdfbsdfkhsbdfkhsdbfkhsdbfksdhfbskdhsbkdfbskjf', '2023-04-20', 1, 1, '192.168.0.2'),
(4, 'email@gmail.com', 'SIEMKA', '2023-05-09', 0, 0, '192.168.3.1'),
(7, 'mailoo@m.com', 'TEST WEB MESSAGE', '2023-05-10', 1, 0, '192.168.0.1'),
(24, 'czarek@gmail.com', 'message with usleep(2000)', '2023-05-11', 0, 0, NULL),
(25, 'czarek@gmail.com', 'Message with sleep(2)', '2023-05-11', 0, 0, NULL),
(27, 'Test@email.com', 'Test if email is okey', '2023-05-13', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `education`
--

CREATE TABLE `education` (
  `data_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`data_id`, `content`) VALUES
(1, 'Student in uwb');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `comments` int(11) NOT NULL DEFAULT 0,
  `visible` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `date`, `comments`, `visible`) VALUES
(1, 'Testowy Post - edit', 'Tutaj są główne informacje o poście - edit', '2023-04-19', 8, 1),
(2, 'Drugi artykuł', 'zawartość jego', '2023-04-20', 0, 0),
(3, 'Trzeci artykuł', 'zawartość jego', '2023-04-20', 0, 1),
(4, 'add_test', 'adding new article by form', '2023-05-13', 0, 1),
(5, 'add_test2', 'adding new invisible article by form', '2023-05-13', 0, 0),
(10, 'SUPER LONG TITLE cześć jestem czarek i testuje wyświetlanie portfolio a ten tytuł nie powinien się mieścić w zakresie w jakim powinien się on mieścić', 'kontent strony postu nie jest tak istotny', '2023-05-14', 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skills`
--

CREATE TABLE `skills` (
  `data_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`data_id`, `content`) VALUES
(1, 'C/C++, Python, PHP');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `about_me`
--
ALTER TABLE `about_me`
  ADD PRIMARY KEY (`data_id`);

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `response_id_fk` (`response_id`),
  ADD KEY `post_id_fk` (`post_id`);

--
-- Indeksy dla tabeli `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indeksy dla tabeli `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`data_id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indeksy dla tabeli `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_me`
--
ALTER TABLE `about_me`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`response_id`) REFERENCES `comments` (`comment_id`) ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
