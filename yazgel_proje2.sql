-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 Oca 2024, 18:17:05
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ders_programi_projesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

CREATE TABLE `dersler` (
  `ders_id` int(11) NOT NULL,
  `ders_ad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`ders_id`, `ders_ad`) VALUES
(1, 'Ayrık Matematik'),
(2, 'Web Tasarım'),
(3, 'Bulut Bilişim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders_zamani`
--

CREATE TABLE `ders_zamani` (
  `ders_zamani_id` int(11) NOT NULL,
  `ders_saati_araligi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ders_zamani`
--

INSERT INTO `ders_zamani` (`ders_zamani_id`, `ders_saati_araligi`) VALUES
(1, '9:00-10:00'),
(2, '10:00-11:00'),
(3, '11:00-12:00'),
(4, '12:00-13:00'),
(5, '13:00-14:00'),
(6, '14:00-15:00'),
(7, '15:00-16:00'),
(8, '16:00-17:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gunler`
--

CREATE TABLE `gunler` (
  `gun_id` int(11) NOT NULL,
  `gun_ad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `gunler`
--

INSERT INTO `gunler` (`gun_id`, `gun_ad`) VALUES
(1, 'Pazartesi'),
(2, 'Salı'),
(3, 'Çarşamba'),
(4, 'Perşembe'),
(5, 'Cuma');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmen`
--

CREATE TABLE `ogretmen` (
  `ogretmen_id` int(11) NOT NULL,
  `ogretmen_ad` varchar(45) NOT NULL,
  `ogretmen_soyad` varchar(45) NOT NULL,
  `ogretmen_brans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ogretmen`
--

INSERT INTO `ogretmen` (`ogretmen_id`, `ogretmen_ad`, `ogretmen_soyad`, `ogretmen_brans`) VALUES
(1, 'Süleyman', 'Eken', 1),
(2, 'Önder', 'Yakut', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmen_ders`
--

CREATE TABLE `ogretmen_ders` (
  `ogretmen_ders_id` int(11) NOT NULL,
  `ogretmen_id` int(11) NOT NULL,
  `ders_id` int(11) NOT NULL,
  `ders_gun_id` int(11) NOT NULL,
  `ders_zamani_id` int(11) NOT NULL,
  `sinif_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `ogretmen_ders`
--

INSERT INTO `ogretmen_ders` (`ogretmen_ders_id`, `ogretmen_id`, `ders_id`, `ders_gun_id`, `ders_zamani_id`, `sinif_id`) VALUES
(27, 2, 2, 1, 1, 1),
(28, 2, 3, 1, 5, 1),
(29, 1, 1, 2, 2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinif`
--

CREATE TABLE `sinif` (
  `sinif_id` int(11) NOT NULL,
  `sinif_ad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `sinif`
--

INSERT INTO `sinif` (`sinif_id`, `sinif_ad`) VALUES
(1, '1036'),
(2, '1041'),
(3, '1040'),
(4, '1044');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`ders_id`);

--
-- Tablo için indeksler `ders_zamani`
--
ALTER TABLE `ders_zamani`
  ADD PRIMARY KEY (`ders_zamani_id`);

--
-- Tablo için indeksler `gunler`
--
ALTER TABLE `gunler`
  ADD PRIMARY KEY (`gun_id`);

--
-- Tablo için indeksler `ogretmen`
--
ALTER TABLE `ogretmen`
  ADD PRIMARY KEY (`ogretmen_id`),
  ADD KEY `ogretmen_brans_fk_idx` (`ogretmen_brans`);

--
-- Tablo için indeksler `ogretmen_ders`
--
ALTER TABLE `ogretmen_ders`
  ADD PRIMARY KEY (`ogretmen_ders_id`),
  ADD KEY `ders_gun_fk_idx` (`ders_gun_id`),
  ADD KEY `zaman_slotu_fk_idx` (`ders_zamani_id`),
  ADD KEY `sinif_fk_idx` (`sinif_id`),
  ADD KEY `ders_fk_idx` (`ders_id`),
  ADD KEY `ogretmen_fk_idx` (`ogretmen_id`);

--
-- Tablo için indeksler `sinif`
--
ALTER TABLE `sinif`
  ADD PRIMARY KEY (`sinif_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `dersler`
--
ALTER TABLE `dersler`
  MODIFY `ders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ders_zamani`
--
ALTER TABLE `ders_zamani`
  MODIFY `ders_zamani_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--

-- Tablo için AUTO_INCREMENT değeri `ogretmen`
--
ALTER TABLE `ogretmen`
  MODIFY `ogretmen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `ogretmen_ders`
--
ALTER TABLE `ogretmen_ders`
  MODIFY `ogretmen_ders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--


--
-- Tablo kısıtlamaları `ogretmen`
--
ALTER TABLE `ogretmen`
  ADD CONSTRAINT `ogretmen_brans_fk` FOREIGN KEY (`ogretmen_brans`) REFERENCES `dersler` (`ders_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Tablo kısıtlamaları `ogretmen_ders`
--
ALTER TABLE `ogretmen_ders`
  ADD CONSTRAINT `ders2_fk` FOREIGN KEY (`ders_id`) REFERENCES `dersler` (`ders_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ders_gun2_fk` FOREIGN KEY (`ders_gun_id`) REFERENCES `gunler` (`gun_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ogretmen2_fk` FOREIGN KEY (`ogretmen_id`) REFERENCES `ogretmen` (`ogretmen_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sinif2_fk` FOREIGN KEY (`sinif_id`) REFERENCES `sinif` (`sinif_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `zaman_slotu2_fk` FOREIGN KEY (`ders_zamani_id`) REFERENCES `ders_zamani` (`ders_zamani_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
