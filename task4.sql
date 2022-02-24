-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 16 Oca 2022, 23:33:45
-- Sunucu sürümü: 10.4.16-MariaDB
-- PHP Sürümü: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `task4`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_and_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date_and_time`, `user_id`) VALUES
(1, 'a', 'b', '2022-01-08 15:23:00', 4),
(6, 'c', 'c', '2022-01-08 10:53:00', 4),
(7, 'c', 'c', '2022-01-08 10:53:00', 4),
(8, 'd', 'd', '2022-01-02 10:54:00', 4),
(9, 'v', 'v', '2022-01-02 10:56:00', 4),
(10, 'g', 'v', '2022-01-09 10:56:00', 4),
(19, 'test', 'test', '2022-01-14 14:55:00', 4),
(20, 'eren', 'eren', '2022-01-09 14:55:00', 4),
(21, 'asdfa', 'asdfsadf', '2021-12-31 23:20:00', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `events_and_keywords`
--

CREATE TABLE `events_and_keywords` (
  `id` int(11) NOT NULL,
  `keyword_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `events_and_keywords`
--

INSERT INTO `events_and_keywords` (`id`, `keyword_id`, `event_id`, `media_id`) VALUES
(1, 1, 10, NULL),
(2, 3, 10, NULL),
(3, 8, 10, NULL),
(4, 2, 10, NULL),
(5, 3, 10, NULL),
(6, 2, 19, NULL),
(7, 3, 19, NULL),
(8, 1, 20, NULL),
(9, 2, 20, NULL),
(10, 3, 20, NULL),
(11, 3, 20, NULL),
(12, 4, 20, NULL),
(13, 1, 20, NULL),
(14, 2, 20, NULL),
(15, 3, 20, NULL),
(16, 1, 20, NULL),
(17, 3, 20, NULL),
(18, 9, 20, NULL),
(24, 1, NULL, 2),
(25, 1, NULL, 3),
(26, 2, NULL, 4),
(27, 1, NULL, 5),
(28, 2, NULL, 5),
(29, 2, NULL, 5),
(30, 4, NULL, 5),
(31, 8, NULL, 5),
(32, 8, NULL, 6),
(33, 9, NULL, 6),
(34, 4, NULL, 7),
(35, 8, NULL, 7),
(36, 2, NULL, 8),
(37, 2, NULL, 9),
(38, 4, NULL, 10),
(39, 3, NULL, 11),
(40, 3, NULL, 12),
(41, 3, NULL, 15),
(42, 1, 21, NULL),
(43, 3, 21, NULL),
(44, 1, NULL, 16),
(45, 3, NULL, 16),
(46, 1, NULL, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `keywords`
--

INSERT INTO `keywords` (`id`, `keyword`) VALUES
(1, 'asdvsadv'),
(2, 'fasdfasdf'),
(3, 'asdfasdf'),
(4, '3ascazxc'),
(8, 'f'),
(9, 'asfv'),
(10, 'asdfasdfasdfsadfasdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `media_records`
--

CREATE TABLE `media_records` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_and_time` datetime NOT NULL,
  `original_post` varchar(255) NOT NULL,
  `original_publisher` varchar(255) NOT NULL,
  `media_type` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `media_records`
--

INSERT INTO `media_records` (`id`, `title`, `description`, `date_and_time`, `original_post`, `original_publisher`, `media_type`, `file_path`, `user_id`, `event_id`) VALUES
(1, 's', 's', '2022-01-16 12:47:00', 's', 's', 's', 'uploads/download.png', 4, 1),
(2, 'w', 'w', '2022-01-16 12:50:00', 'w', 'w', 'w', 'uploads/download.png', 4, 6),
(3, 'vrf', 'adsfasd', '2022-01-16 16:12:00', 'sadf', 'sdfsadf', 'sadfasd', 'uploads/download.png', 4, 7),
(4, 'd', 'dds', '2022-01-08 14:00:00', 'asd', 'sdfsadf', 'sa', 'uploads/download.png', 4, 8),
(5, 'askdfjnalksdf lasdjnflkasd kasjdnf', 'lorelkasd lfkas dfm aslkdjfn laksjdnflkajsndflkas dlak sdlkfjnasld flaskdjfnlaskdj flaskjd fnlaksjdnflaskdjf nlaskd lfkajsn dlfk alskdfjnalskdjnfa sldkfj nalskdjfn alskdf nlaksdjf nklasjdf', '2022-01-16 14:00:00', 'https://www.w3schools.com/php/php_superglobals_get.asp', 'eren bezirgancı', 'image', 'uploads/Screen Shot 2022-01-13 at 12.20.03.png', 4, 6),
(6, 'asdf', 'asdfsafg', '2022-01-16 17:48:00', 'asdfsdf', 'ekuryon.com', 'image', 'uploads/Screen Shot 2022-01-16 at 17.26.09.png', 4, 20),
(7, 'aasdf', 'wsvdsdfv', '2022-01-16 17:50:00', 'ekuryon.com', 'eren bezirgancı', 'sdf', 'uploads/Screen Shot 2022-01-12 at 09.56.07.png', 4, 1),
(8, 'a', 'saf', '2022-01-09 17:53:00', 'adsf', 'asdfds', 'dafs', 'uploads/naloge_erasmus.pdf', 4, 6),
(9, 'sd', 'fdas', '2022-01-16 17:59:00', 'sad', 'sd', 'asd', 'uploads/Adsız tasarım-2.mp4', 4, 1),
(10, 'sda', 'sda', '2022-01-01 18:01:00', 'asd', 'sd', 'ads', 'uploads/Adsız tasarım-2.mp4', 4, 7),
(11, 'adv', 'asdf', '2022-01-02 18:03:00', 'asdfasdf', '', 'asdfsadf', 'uploads/Akgunduz_microeconomics_204_2021 (1).docx', 4, 7),
(12, 'adv', 'asdf', '2022-01-02 18:03:00', 'asdfasdf', '', 'asdfsadf', 'uploads/2_00d6bb1f5b-asket_tee_white_cart_thumb-original.jpeg', 4, 7),
(13, 'vsdfvsdf', 'asfdv', '2022-01-16 21:58:00', 'asdvasdv', 'sadvsadv', 'asdvsadv', 'uploads/download.png', 4, 6),
(14, 'asdf', 'asdf', '2022-01-16 21:59:00', 'asdf', 'asdfasdfg', 'asdfg', 'uploads/download.png', 4, 7),
(15, 'asdfsadf', 'asdfsdf', '2022-01-16 22:01:00', 'asdfsdf', 'sdfasdf', 'asdf', 'uploads/slide_4.jpeg', 4, 6),
(16, 'asdf', 'asdf', '2022-01-16 23:26:00', 'asdfasdf', 'sdfsad', 'asdfd', 'uploads/Take Home Exam 1.docx', 4, 1),
(17, 'asfasdf', 'asdfasdf', '2022-01-02 23:31:00', 'asdfsadf', 'asdfsadf', 'asdfasdf', 'uploads/Akgunduz_microeconomics_204_2021 (1) (1).docx', 5, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(55) NOT NULL,
  `surname` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `mail`, `password`, `name`, `surname`) VALUES
(4, 'erenbezirganci99@gmail.com', '0714dc616af0952fd1685408641d796210cc245a', 'eren', 'bezirganci'),
(5, 'erenbezirganci@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'erentwo', 'bezirgancitwo');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event_user_id` (`user_id`);

--
-- Tablo için indeksler `events_and_keywords`
--
ALTER TABLE `events_and_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event_keywords_id` (`keyword_id`),
  ADD KEY `media_id` (`media_id`),
  ADD KEY `fk_event_id` (`event_id`);

--
-- Tablo için indeksler `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `media_records`
--
ALTER TABLE `media_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pw` (`mail`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `events_and_keywords`
--
ALTER TABLE `events_and_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `media_records`
--
ALTER TABLE `media_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `events_and_keywords`
--
ALTER TABLE `events_and_keywords`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_event_keywords_id` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_media_keywords_id` FOREIGN KEY (`media_id`) REFERENCES `media_records` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Tablo kısıtlamaları `media_records`
--
ALTER TABLE `media_records`
  ADD CONSTRAINT `fk_media_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_media_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
