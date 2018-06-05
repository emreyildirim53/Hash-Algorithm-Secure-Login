-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 06 Nis 2018, 19:12:26
-- Sunucu sürümü: 10.1.24-MariaDB
-- PHP Sürümü: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `zamazingo`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `salting`
--

CREATE TABLE `salting` (
  `email` varchar(25) CHARACTER SET latin5 NOT NULL,
  `salt` varchar(16) CHARACTER SET latin5 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `salting`
--

INSERT INTO `salting` (`email`, `salt`) VALUES
('53.emreyildirim@gmail.com', 'c18cb15bdbf7a3db'),
('ayben.onal.ao@gmail.com', '5bbda7e4660d0f4c');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) VALUES
('Emre', 'Yıldırım', '53.emreyildirim@gmail.com', 'e19a270e0c3b37bf37bb83b7a70fd5629599d90ebc1e6f77e37085f33831dcd4'),
('Ayben', 'Önal', 'ayben.onal.ao@gmail.com', 'c6d33c470ce52f1e15ac2529c44c706735cbb02aac037c351f7e079414606195');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `salting`
--
ALTER TABLE `salting`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
