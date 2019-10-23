-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Paź 2019, 02:07
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `portal`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `ID` int(11) NOT NULL,
  `ID_LOGIN` int(11) NOT NULL,
  `TEKST` text COLLATE utf8_polish_ci NOT NULL,
  `DATA` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`ID`, `ID_LOGIN`, `TEKST`, `DATA`) VALUES
(8, 40, 'afdf sadf asd f as f asdf as df as df asd f\r\nasdf asd fs adf ads f asdf \r\nsdf as f asdf sad f sa f \r\ndf asd fsad f saddf s adf\r\nas df sadf sad f sdaf s adf\r\nfasdf asd f dsaf sda f\r\nsf ads fds af asf ', '2019-10-21 02:07:33'),
(10, 41, 'sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf ', '2019-10-21 02:11:49'),
(11, 41, 'sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf ', '2019-10-21 02:12:20'),
(12, 41, 'sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf ', '2019-10-21 02:13:08'),
(13, 41, 'sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf ', '2019-10-21 02:13:38'),
(14, 41, 'sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf sdf asd f asdfsadfasd ffads fsad fas fsad fsad fasd sad ffsafsasd fasd fasdfassdafadsfsadfsaddasdafsa fas f saf sa df as fs af sd f sa df sdaf ds f sd fa sf sa f sa fasdf ', '2019-10-21 02:13:48'),
(15, 41, 'sgr', '2019-10-22 22:26:13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `LOGIN` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `HASLO` varchar(254) COLLATE utf8_polish_ci NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `URODZENIE` date NOT NULL,
  `PLEC` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `OPIS` text COLLATE utf8_polish_ci,
  `MIEJSCOWOSC` text COLLATE utf8_polish_ci,
  `HOBBY` text COLLATE utf8_polish_ci,
  `profilowe` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `LOGIN`, `HASLO`, `EMAIL`, `URODZENIE`, `PLEC`, `OPIS`, `MIEJSCOWOSC`, `HOBBY`, `profilowe`) VALUES
(40, 'mateusz', '$2y$10$MsR2sNzj4VHTAXEjZmRvwuH3cKk.QJIRs8eUgrg2LW7frlBGRwc6i', 'mat@o2.pl', '2000-10-05', 'K', 'asdaXZZX', 'asd', 'asd', ''),
(41, 'bartek', '$2y$10$gxrGmHqNtnqqded2T4G4Be2sGzVd39oh9j70BDWRERMlp37v/J.tm', 'bartek@o2.pl', '2001-10-05', 'M', 'ssdf', 'xsxsx', 'sxsxz', ''),
(42, 'Natalia', '$2y$10$DgRJkMEtGpqpRUT8kr10o.4bbpAsqy/8q/f10IkzlLrcgpmCRHfdi', 'natalia@o2.pl', '1993-10-01', 'K', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zaproszenia`
--

CREATE TABLE `zaproszenia` (
  `ID` int(11) NOT NULL,
  `ZAPRASZAJACY` int(11) NOT NULL,
  `PRZYJMUJACY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `znajomi`
--

CREATE TABLE `znajomi` (
  `ID` int(11) NOT NULL,
  `ID_LOGIN_1` int(11) NOT NULL,
  `ID_LOGIN_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `LOGIN` (`LOGIN`);

--
-- Indexes for table `zaproszenia`
--
ALTER TABLE `zaproszenia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `znajomi`
--
ALTER TABLE `znajomi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT dla tabeli `zaproszenia`
--
ALTER TABLE `zaproszenia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `znajomi`
--
ALTER TABLE `znajomi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
