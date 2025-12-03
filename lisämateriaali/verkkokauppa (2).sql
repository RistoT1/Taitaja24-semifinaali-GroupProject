-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03.12.2025 klo 13:43
-- Palvelimen versio: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verkkokauppa`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_11_19_162759_create_sessions_table', 1),
(2, '2025_11_25_063438_create_cache_table', 2),
(3, '2025_11_25_075416_add_remember_token_to_users_table', 3),
(8, '2025_11_25_183629_add_email_confirmed_to_users_table', 4),
(9, '2025_11_26_062757_add_two_factor_columns_to_users_table', 5);

-- --------------------------------------------------------

--
-- Rakenne taululle `reseptit`
--

CREATE TABLE `reseptit` (
  `Resepti_ID` int(11) NOT NULL,
  `Nimi` varchar(255) NOT NULL,
  `Ainesosat` text NOT NULL,
  `Valmistusohje` text NOT NULL,
  `Kategoria` varchar(100) NOT NULL,
  `Kuva` varchar(255) DEFAULT NULL,
  `Tila` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `reseptit`
--

INSERT INTO `reseptit` (`Resepti_ID`, `Nimi`, `Ainesosat`, `Valmistusohje`, `Kategoria`, `Kuva`, `Tila`) VALUES
(1, 'Täysjyväsämpylä-hampurilainen', 'Täysjyväsämpylä, hampurilaispihvi, juusto, salaatti, tomaatti, kurkku, majoneesi, ketsuppi', 'Paahda sämpylät kevyesti. Paista hampurilaispihvi haluamaasi kypsyyteen. Kasaa sämpylä, pihvi, juusto ja vihannekset. Lisää kastikkeet ja tarjoile heti.', 'Leipä', 'taysjyvasampyla_hampurilainen.jpg', 1),
(2, 'Avokado-ruisleipä', 'Ruisleipä, avokado, tomaatti, suola, pippuri', 'Muussaa avokado ja levitä ruisleivälle. Lisää tomaatin siivut, mausta suolalla ja pippurilla.', 'Leipä', 'avokado_ruisleipa.jpg', 1),
(3, 'Kauraleipä-hummusvoileipä', 'Kauraleipä, hummus, kurkku, paprika, salaatti', 'Levitä hummus kauraleivälle, lisää viipaloidut vihannekset ja salaatti. Tarjoile heti.', 'Leipä', 'kauraleipa_hummus.jpg', 1),
(4, 'Briossi-hampurilainen', 'Briossisämpylä, hampurilaispihvi, juusto, salaatti, tomaatti, kastike', 'Paahda briossi kevyesti. Paista hampurilaispihvi, lisää juusto ja vihannekset. Kasaa sämpylän väliin ja tarjoile.', 'Leipä', 'briossi_hampurilainen.jpg', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dgjEzKW9ZS9twYbn2LyiuxZbe91Bc1yXfM9WjwAr', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRnlxeWVBZ3NNd1llVjc4QmNxZmFJb3U3WmNoM1lOblZHY3RJVFBXYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3QvcHJvZHVjdD9pZD0iO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjA7YToyOntzOjc6IlR1b3RlSUQiO3M6MToiMiI7czo4OiJxdWFudGl0eSI7czoxOiIxIjt9fX0=', 1764669872),
('edhq8qdoy43JSX8983ayEPEv1uYX3vNPSM9ml89Z', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibkFKQlNma2s5bXBoTk93ZFdMR1l6aTR1N2ZVbUlNYzdvNTQ0OUdNTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9sb2NhbGhvc3Qva2lyamF1ZHUiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YTozOntpOjA7YToyOntzOjc6IlR1b3RlSUQiO3M6MjoiMzQiO3M6ODoicXVhbnRpdHkiO2k6NDt9aToxO2E6Mjp7czo3OiJUdW90ZUlEIjtzOjE6IjIiO3M6ODoicXVhbnRpdHkiO2k6NTE7fWk6MjthOjI6e3M6NzoiVHVvdGVJRCI7czoxOiI1IjtzOjg6InF1YW50aXR5IjtzOjE6IjEiO319czoxMToiMmZhOnVzZXJfaWQiO2k6MjM7fQ==', 1764676946),
('f2RXZ4kUxAQk40YUvYzVHBt5MeddvzB25E0SZVpm', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY2l2RFh6VkZxNGR2SjkyNXgyakw4alNFY2k2cTRkRzhkS0tscTR3YiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxOToiaHR0cDovL2xvY2FsaG9zdC9tZSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vbG9jYWxob3N0L3Jlc2VwdGl0P0thdGVnb3JpYT11bmRlZmluZWQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjA7YToyOntzOjc6IlR1b3RlSUQiO3M6MjoiMzQiO3M6ODoicXVhbnRpdHkiO2k6Njt9fX0=', 1764760720),
('PJnfgt07EhpElgGjfrpFT8LInQxJWHz4gIna8xqP', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEw4RDFDanZKRm5DMTZ6eExkNXRtNUY0UEY1d1VFc2s4VUFIcERxaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO047fXM6MTE6IjJmYTp1c2VyX2lkIjtpOjIzO3M6NDoiY2FydCI7YToxOntpOjA7YToyOntzOjc6IlR1b3RlSUQiO3M6MjoiMzQiO3M6ODoicXVhbnRpdHkiO3M6MToiNyI7fX19', 1764678364),
('Z3cjP0GzHQIYdY3FuJsjqI1fScbmXXaXMami10SC', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDVJNEViR3RjSkptRGtRb2k5RDdrazdrdWdDamtmUVlzSjV4SDVSQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764675952);

-- --------------------------------------------------------

--
-- Rakenne taululle `tilaukset`
--

CREATE TABLE `tilaukset` (
  `Tilaus_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `TilausPvm` timestamp NOT NULL DEFAULT current_timestamp(),
  `Tila` enum('Tilattu','Valmistetaan','Valmis','Peruutettu') DEFAULT 'Tilattu',
  `Kokonaishinta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `tilausrivit`
--

CREATE TABLE `tilausrivit` (
  `TilausriviID` int(11) NOT NULL,
  `Tilaus_ID` int(11) NOT NULL,
  `Tuote_ID` int(11) NOT NULL,
  `Määrä` int(11) NOT NULL,
  `Hinta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `tuotteet`
--

CREATE TABLE `tuotteet` (
  `Tuote_ID` int(11) NOT NULL,
  `Nimi` varchar(200) NOT NULL,
  `Kategoria` varchar(50) NOT NULL,
  `Kuvaus` text DEFAULT NULL,
  `Hinta` decimal(10,2) NOT NULL,
  `Kuva` varchar(255) DEFAULT NULL,
  `Tila` tinyint(1) DEFAULT 1,
  `Lisätty` timestamp NOT NULL DEFAULT current_timestamp(),
  `Muokattu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `tuotteet`
--

INSERT INTO `tuotteet` (`Tuote_ID`, `Nimi`, `Kategoria`, `Kuvaus`, `Hinta`, `Kuva`, `Tila`, `Lisätty`, `Muokattu`) VALUES
(1, 'Ruisleipä Classic', 'Leipä', 'Perinteinen suomalainen ruisleipä 600g', 2.49, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(2, 'Täysjyväsämpylä 6-pack', 'Leipä', 'Pehmeät täysjyväsämpylät', 1.89, 'taysjyvasampyla', 1, '2025-11-19 08:38:14', '2025-12-01 11:02:41'),
(3, 'Vaalea Paahtoleipä', 'Leipä', 'Viipaloitu vehnäpaahtoleipä 500g', 1.29, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(4, 'Patonki Tuore', 'Leipä', 'Paistopisteen tuore patonki', 1.10, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(5, 'Croissant Voilla', 'Leipä', 'Ranskalainen voicroissant', 1.20, NULL, 0, '2025-11-19 08:38:14', '2025-11-21 12:10:53'),
(6, 'Täysjyväpaahto', 'Leipä', 'Täysjyväpaahtoleipä viipaleina', 1.59, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(7, 'Sämpylä Vehnä 4-pack', 'Leipä', 'Tuoreet vehnäsämpylät', 1.29, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(8, 'Ruispalat', 'Leipä', 'Pehmeät ruisviipaleet 500g', 2.19, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(9, 'Kauraleipä', 'Leipä', 'Kauralla leivottu viipaleleipä', 2.29, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(10, 'Briossi-sämpylä 2kpl', 'Leipä', 'Makeahko briossisämpylä', 1.79, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(11, 'Kevytmaito 1L', 'Maitotuotteet', 'Kotimainen kevytmaito', 1.35, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(12, 'Rasvaton Maito 1L', 'Maitotuotteet', 'Laktoositon rasvaton', 1.45, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(13, 'Täysmaito 1L', 'Maitotuotteet', 'Perinteinen täysmaito', 1.50, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(14, 'Jogurtti Mansikka 200g', 'Maitotuotteet', 'Maustettu mansikkajogurtti', 0.89, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(15, 'Jogurtti Mustikka 200g', 'Maitotuotteet', 'Maustettu mustikkajogurtti', 0.89, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(16, 'Vaniljarahka 150g', 'Maitotuotteet', 'Paksu vaniljarahka', 1.05, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(17, 'Rahkavälipala Banaani', 'Maitotuotteet', 'Proteiinirahka banaanilla', 1.25, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(18, 'Kerma 2dl', 'Maitotuotteet', 'Kuohukerma ruoanlaittoon', 1.25, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(19, 'Juustoviipale Cheddar 300g', 'Maitotuotteet', 'Oranssit juustoviipaleet', 3.19, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(20, 'Juustoraaste Mozzarella 300g', 'Maitotuotteet', 'Mozzarellaraaste', 2.79, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(21, 'Omena Gala', 'Hedelmät', 'Tuore Gala-omena per kpl', 0.55, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(22, 'Omena Granny Smith', 'Hedelmät', 'Hapan vihreä omena', 0.59, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(23, 'Päärynä Conference', 'Hedelmät', 'Makea päärynä', 0.65, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(24, 'Banaani', 'Hedelmät', 'Keltainen banaani per kpl', 0.39, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(25, 'Appelsiini Sweet', 'Hedelmät', 'Mehukas appelsiini', 0.79, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(26, 'Mandariini', 'Hedelmät', 'Pienehkö mandariini', 0.49, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(27, 'Kiivi', 'Hedelmät', 'Tuore kiivi', 0.45, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(28, 'Sitruuna', 'Hedelmät', 'Sitruuna ruoanlaittoon', 0.40, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(29, 'Viinirypäleet vihreät 500g', 'Hedelmät', 'Makeat pöytärypäleet', 2.49, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(30, 'Mansikka (pakaste) 500g', 'Hedelmät', 'Kotimainen pakastemansikka', 3.99, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(31, 'Kurkku Suomi', 'Vihannekset', 'Kotimainen kasvihuonekurkku', 1.19, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(32, 'Tomaatti Suomi', 'Vihannekset', 'Punainen tomaatti 500g', 1.59, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(33, 'Salaatti Iceberg', 'Vihannekset', 'Jääsalaattikerä', 1.09, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(34, 'Porkkana 1kg', 'Vihannekset', 'kotimainen perse', 0.99, 'Porkkana', 1, '2025-11-19 08:38:14', '2025-12-02 10:04:44'),
(35, 'Peruna 1kg', 'Vihannekset', 'Kiinteä peruna', 1.09, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(36, 'Keltasipuli 1kg', 'Vihannekset', 'Ruokasipuli', 1.20, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(37, 'Parsakaali', 'Vihannekset', 'Tuore parsakaali', 1.89, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(38, 'Kesäkurpitsa', 'Vihannekset', 'Tuore kesäkurpitsa', 1.39, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(39, 'Paprika Punainen', 'Vihannekset', 'Värikäs paprika', 1.29, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(40, 'Paprika Trio', 'Vihannekset', '3 värin paprika-pussi', 2.99, NULL, 1, '2025-11-19 08:38:14', '2025-11-19 08:38:14'),
(41, 'Jauheliha Naudan 400g', 'Liha', '17% rasvaa, kotimainen', 3.99, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(42, 'Jauheliha Sika-Nauta 400g', 'Liha', 'Perinteinen seosjauheliha', 2.99, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(43, 'Kanan Rintafile 500g', 'Liha', 'Tuore broilerin filee', 4.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(44, 'Kanafilee Marinoitu', 'Liha', 'Marinoidut broilerin fileet', 5.29, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(45, 'Pekoni Viipale 200g', 'Liha', 'Savustettu pekoni', 2.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(46, 'Nakki Perinteinen 300g', 'Liha', 'Perinteiset nakkimakkarat', 2.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(47, 'Kabanossi Grillimakkara', 'Liha', 'Mausteinen grillimakkara', 3.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(48, 'Kalkkunaleike 200g', 'Liha', 'Ohuet kalkkunaleikkeet', 2.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(49, 'Kinkkuleike 150g', 'Liha', 'Leikkele kinkkuviipaleina', 2.29, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(50, 'Meetvursti Viipaleet 150g', 'Liha', 'Meetvursti leikkeleenä', 2.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(51, 'Lohifilee Pakaste 400g', 'Kala', 'Pakastettu norjalainen lohi', 5.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(52, 'Silakkafileet 500g', 'Kala', 'Tuoreet silakkafileet', 3.20, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(53, 'Seiti Kuutiot 400g', 'Kala', 'Pakastettu seiti', 2.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(54, 'Tonnikala Öljyssä 185g', 'Kala', 'Tonnikalapalat öljyssä', 1.69, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(55, 'Tonnikala Vedessä 185g', 'Kala', 'Tonnikalapalat vedessä', 1.59, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(56, 'Herkkusienet Purkki', 'Säilykkeet', 'Viipaloidut herkkusienet', 1.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(57, 'Tomaattimurska 400g', 'Säilykkeet', 'Hienoksi murskattu tomaatti', 0.95, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(58, 'Tomaattipyree 200g', 'Säilykkeet', 'Tiivistetty tomaattipyree', 0.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(59, 'Kidneypavut 400g', 'Säilykkeet', 'Punaiset kidneypavut', 1.10, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(60, 'Mustapavut 400g', 'Säilykkeet', 'Mustapavut liemessä', 1.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(61, 'Riisi Jasmiini 1kg', 'Kuivatavarat', 'Pitkäjyväinen jasmiiniriisi', 2.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(62, 'Riisi Basmati 1kg', 'Kuivatavarat', 'Aromikas basmatiriisi', 3.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(63, 'Makaronit 400g', 'Kuivatavarat', 'Sarvimakaronit', 0.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(64, 'Spagetti 500g', 'Kuivatavarat', 'Durumspagetti', 1.05, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(65, 'Pasta Fusilli 500g', 'Kuivatavarat', 'Kierteinen pasta', 1.10, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(66, 'Pasta Penne 500g', 'Kuivatavarat', 'Penne-putkipastaaa', 1.15, 'PastaPenne', 1, '2025-11-19 08:38:55', '2025-11-22 13:30:09'),
(67, 'Vehnäjauho 1kg', 'Kuivatavarat', 'Perusvehnäjauhot', 0.99, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(68, 'Kaurahiutale 1kg', 'Kuivatavarat', 'Perinteiset kaurahiutaleet', 1.29, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(69, 'Durumvehnäjauho 1kg', 'Kuivatavarat', 'Pastan valmistukseen', 1.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(70, 'Muskovadosokeri 500g', 'Kuivatavarat', 'Tumma ruokosokeri', 1.99, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(71, 'Colajuoma 1.5L', 'Juomat', 'Sokerilla makeutettu cola', 1.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(72, 'Sokeriton Cola 1.5L', 'Juomat', 'Kevyt cola', 1.69, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(73, 'Sitruunalimu 1.5L', 'Juomat', 'Hiilihapollinen sitrusjuoma', 1.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(74, 'Omenamehu 1L', 'Juomat', 'Täysmehu', 2.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(75, 'Appelsiinimehu 1L', 'Juomat', 'Täysmehu appelsiinista', 2.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(76, 'Energiajuoma 0.33L', 'Juomat', 'Sitrusmakuinen energiajuoma', 1.39, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(77, 'Vesi 1.5L', 'Juomat', 'Pullotettu lähdevesi', 0.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(78, 'Vadelmalimonadi 1.5L', 'Juomat', 'Makeutettu limonadi', 1.55, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(79, 'Kivennäisvesi Sitruuna 0.5L', 'Juomat', 'Sitruunalla maustettu vesi', 1.25, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(80, 'Jäätee Persikka 0.5L', 'Juomat', 'Persikkainen jäätee', 1.69, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(81, 'Sipsit Suola 200g', 'Naposteltavat', 'Suolatut perunalastut', 2.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(82, 'Sipsit Paprika 200g', 'Naposteltavat', 'Paprikamaustetut lastut', 2.79, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(83, 'Suklaalevy Maitosuklaa 200g', 'Naposteltavat', 'Perinteinen maitosuklaa', 2.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(84, 'Tumma Suklaa 70% 100g', 'Naposteltavat', 'Tumma hieno suklaa', 2.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(85, 'Keksi Kaurainen 300g', 'Naposteltavat', 'Kaurakeksi makea', 1.99, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(86, 'Suolapähkinät 250g', 'Naposteltavat', 'Suolatut maapähkinät', 2.29, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(87, 'Cashew-pähkinät 150g', 'Naposteltavat', 'Paahdetut cashewpähkinät', 3.59, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(88, 'Popcorn Mikro 3-pack', 'Naposteltavat', 'Voimakuiset mikropopcornit', 2.19, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(89, 'Pretzel Snacks 150g', 'Naposteltavat', 'Rapeita suolarinkeleitä', 1.89, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(90, 'Lakupussi 180g', 'Naposteltavat', 'Perinteinen lakritsipussi', 1.49, NULL, 1, '2025-11-19 08:38:55', '2025-11-19 08:38:55'),
(91, 'Pestokastike 190g', 'Säilykkeet', 'Vihreä basilika-pesto', 2.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(92, 'Tacosalsa Mieto 230g', 'Säilykkeet', 'Mieto salsakastike', 1.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(93, 'Punaiset Linssit 500g', 'Kuivatavarat', 'Kuivatut punaiset linssit', 2.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(94, 'Kikherneet 400g', 'Säilykkeet', 'Kikherneitä liemessä', 1.29, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(95, 'Ananaspalat 565g', 'Säilykkeet', 'Säilötty ananas mehussa', 1.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(96, 'Pinaatti Pakaste 200g', 'Pakasteet', 'Pakastepinaattikuutiot', 0.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(97, 'Ranskalaiset 1kg', 'Pakasteet', 'Pakasteranskalaiset', 1.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(98, 'Pakastepitsa Pepperoni', 'Pakasteet', 'Pepperonipizza 350g', 2.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(99, 'Pakastepitsa Margherita', 'Pakasteet', 'Juustopizza 350g', 2.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(100, 'Jäätelö Vanilja 1L', 'Pakasteet', 'Vaniljajäätelö', 2.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(101, 'Jäätelö Suklaa 1L', 'Pakasteet', 'Suklaajäätelö', 2.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(102, 'Marjasekoitus 500g', 'Pakasteet', 'Pakastemarjasekoitus', 3.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(103, 'Broilerin Nugetit 300g', 'Pakasteet', 'Rapeat kananugetit', 3.29, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(104, 'Kalapuikot 15kpl', 'Pakasteet', 'Klassiset kalapuikot', 2.89, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(105, 'Wokvihannekset 750g', 'Pakasteet', 'Pakastewokvihannessekoitus', 2.39, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(106, 'Suihkusaippua 500ml', 'Hygienia', 'Kosteuttava suihkusaippua', 2.19, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(107, 'Shampoo 500ml', 'Hygienia', 'Normaalille hiustyypille', 2.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(108, 'Hoitoaine 500ml', 'Hygienia', 'Kosteuttava hoitoaine', 2.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(109, 'Hammastahna Minttu 100ml', 'Hygienia', 'Raikas hammastahna', 1.89, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(110, 'Hammasharja Medium', 'Hygienia', 'Keskikova harja', 1.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(111, 'Saippua Palasaippua', 'Hygienia', 'Perinteinen palasaippua', 0.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(112, 'Kasvopyyhepaketti 6kpl', 'Kotitalous', 'Pehmeät pyyhkeet', 6.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(113, 'Vessapaperi 12 rll', 'Kotitalous', 'Pehmeä wc-paperi', 4.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(114, 'Talouspaperi 6 rll', 'Kotitalous', 'Imukykyinen talouspaperi', 3.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(115, 'Astianpesuaine 500ml', 'Kotitalous', 'Sitruunantuoksuinen', 2.29, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(116, 'Astianpesutabletit 30kpl', 'Kotitalous', 'Astianpesukonetabletit', 5.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(117, 'Pyykinpesuaine 1.5L', 'Kotitalous', 'Neste pyykinpesuun', 5.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(118, 'Pyykinhuuhteluaine', 'Kotitalous', 'Kukkaistuoksu', 2.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(119, 'Roskapussit 20kpl', 'Kotitalous', '50L jätesäkit', 2.59, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(120, 'Talouskelmu', 'Kotitalous', 'Ruokakelmu 30m', 1.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(121, 'Juustohampurilaispihvit 10kpl', 'Pakasteet', 'Valmiit pihvit', 3.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(122, 'Nuudelit Kana 5-pack', 'Kuivatavarat', 'Pakettinuudelit kanamaulla', 1.59, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(123, 'Nuudelit Naudanliha 5-pack', 'Kuivatavarat', 'Nuudelit naudanlihamaulla', 1.59, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(124, 'Kaakaopulveri 400g', 'Kuivatavarat', 'Makea kaakaojauhe', 2.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(125, 'Cornflakes 500g', 'Aamiaistuotteet', 'Maissihiutaleet', 2.39, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(126, 'Mysli Marja 750g', 'Aamiaistuotteet', 'Marjamysli täysjyvästä', 3.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(127, 'Mysli Suklaa 750g', 'Aamiaistuotteet', 'Suklaapallomysli', 3.79, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(128, 'Kauramaito 1L', 'Maitotuotteet', 'Kasvipohjainen juoma', 2.19, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(129, 'Soijamaito 1L', 'Maitotuotteet', 'Soijajuoma makeuttamaton', 2.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(130, 'Kaakaomaito 0.5L', 'Maitotuotteet', 'Suklaamaitojuoma', 1.39, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(131, 'Ketsuppi 1kg', 'Mausteet', 'Perinteinen tomaattiketsuppi', 2.99, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(132, 'Sinappi Mieto 300g', 'Mausteet', 'Perinteinen mieto sinappi', 1.29, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(133, 'Majoneesi 250g', 'Mausteet', 'Kermainen majoneesi', 1.89, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(134, 'BBQ-kastike 300g', 'Mausteet', 'Savunmakuinen BBQ-kastike', 2.49, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(135, 'Chilikastike 250g', 'Mausteet', 'Tulinen chilikastike', 2.19, NULL, 1, '2025-11-19 08:41:13', '2025-11-19 08:41:13'),
(136, 'Limeeee', 'Hedelmät', 'Tuore vihreä lime', 0.60, '', 0, '2025-11-19 08:43:01', '2025-12-01 09:49:54'),
(137, 'Greippi', 'Hedelmät', 'Mehukas greippi', 0.85, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(138, 'Punainen Viinirypäle 500g', 'Hedelmät', 'Makeat punaiset rypäleet', 2.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(139, 'Vihreä Viinirypäle 500g', 'Hedelmät', 'Raikkaat vihreät rypäleet', 2.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(140, 'Kirsikka 300g', 'Hedelmät', 'Tuoreet kirsikat', 3.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(141, 'Parsakaali', 'Vihannekset', 'Tuore parsakaali', 1.59, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(142, 'Kesäkurpitsa', 'Vihannekset', 'Monikäyttöinen vihannes', 1.29, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(143, 'Munakoiso', 'Vihannekset', 'Iso ja mehevä munakoiso', 1.89, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(144, 'Purjo', 'Vihannekset', 'Tuore purjo', 1.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(145, 'Pinaatti Tuore 200g', 'Vihannekset', 'Pinaatinlehtiä ruoanlaittoon', 1.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(146, 'Lehtikaali 200g', 'Vihannekset', 'Täyteläinen lehtikaali', 1.79, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(147, 'Jäävuorisalaatti', 'Vihannekset', 'Rapea salaattiklassikko', 1.29, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(148, 'Tomaatti Suomi 1kg', 'Vihannekset', 'Kotimaiset tomaatit', 3.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(149, 'Kirsikkatomaatti 250g', 'Vihannekset', 'Makeita kirsikkatomaatteja', 2.29, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(150, 'Herkkusieni 250g', 'Vihannekset', 'Tuoreita herkkusieniä', 0.90, '', 1, '2025-11-19 08:43:01', '2025-11-22 13:39:27'),
(151, 'Mozzarella Pallo 125g', 'Maitotuotteet', 'Pehmeä mozzarellajuusto', 1.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(152, 'Parmesaani 150g', 'Maitotuotteet', 'Italiailainen kovajuusto', 3.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(153, 'Voita 500g', 'Maitotuotteet', 'Suomalainen voi', 3.29, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(154, 'Jogurtti Mansikka 1kg', 'Maitotuotteet', 'Mansikkajogurtti', 2.59, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(155, 'Jogurtti Vanilja 1kg', 'Maitotuotteet', 'Vaniljajogurtti', 2.59, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(156, 'Rahka Maustamaton 500g', 'Maitotuotteet', 'Maustamaton rahka', 1.79, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(157, 'Kerma 2dl', 'Maitotuotteet', 'Kuohukerma ruoanlaittoon', 1.39, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(158, 'Ranskankerma 200g', 'Maitotuotteet', 'Hapan kermavalmiste', 1.19, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(159, 'Feta Juusto 200g', 'Maitotuotteet', 'Kreikkalainen fetajuusto', 2.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(160, 'Kananmunat 10kpl', 'Muna', 'Tuoreita kananmunia', 2.59, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(161, 'Kananmunat 15kpl', 'Muna', 'Isompi munapakkaus', 3.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(162, 'Keittokinkku 300g', 'Liha', 'Siivutettu kinkku', 2.89, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(163, 'Meetvursti 200g', 'Liha', 'Voimakas meetvurstisiivu', 3.29, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(164, 'Broilerin Fileesuikale 300g', 'Liha', 'Maustamattomat kanasuikaleet', 3.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(165, 'Jauheliha Naudan 400g', 'Liha', '17% naudan jauhelihaa', 4.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(166, 'Jauheliha Sika-Nauta 400g', 'Liha', 'Perinteinen sekoitus', 3.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(167, 'Grillimakkara 400g', 'Liha', 'Suomalainen grillimakkara', 2.79, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(168, 'Kasslerpihvit 500g', 'Liha', 'Marinoidut kasslerpihvit', 4.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(169, 'Kebablastut 300g', 'Liha', 'Valmiiksi paistetut kebablastut', 3.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(170, 'Nakkipaketti 300g', 'Liha', 'Perinteiset nakit', 2.59, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(171, 'Perunarieska 4kpl', 'Leipä', 'Pehmeä perunarieska', 2.19, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(172, 'Sämpylät 6kpl', 'Leipä', 'Tuoreet sämpylät', 1.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(173, 'Patonki Valkosipuli', 'Leipä', 'Valkosipulipatonki', 1.79, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(174, 'Ruispalat 700g', 'Leipä', 'Klassinen suomalaisleipä', 2.79, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(175, 'Croissant 4kpl', 'Leipä', 'Voiset croissantit', 2.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(176, 'Piparit 500g', 'Makeiset', 'Jouluiset piparkakut', 2.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(177, 'Suklaalevy Maitosuklaa', 'Makeiset', 'Maitosuklaalevy 200g', 2.19, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(178, 'Suklaalevy Tumma', 'Makeiset', 'Tumma suklaa 70%', 2.39, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(179, 'Karkkipussi 180g', 'Makeiset', 'Sekoituspussi', 2.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(180, 'Lakupötkö', 'Makeiset', 'Pehmeä lakritsipötkö', 0.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(181, 'Pähkinäsekoitus 200g', 'Naposteltavat', 'Paahdettu pähkinäsekoitus', 3.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(182, 'Cashewpähkinä 150g', 'Naposteltavat', 'Suolatut cashewpähkinät', 2.99, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(183, 'Popcorn Jyvät 500g', 'Naposteltavat', 'Popcornjyviä', 1.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(184, 'Tortillas 8kpl', 'Leipä', 'Vehnätortillat', 2.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01'),
(185, 'Sushiriisi 1kg', 'Kuivatavarat', 'Lyhytjyväinen sushiriisi', 3.49, NULL, 1, '2025-11-19 08:43:01', '2025-11-19 08:43:01');

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Nimi` varchar(100) NOT NULL,
  `Sähköposti` varchar(150) NOT NULL,
  `Puhelin` varchar(20) DEFAULT NULL,
  `Rooli` enum('asiakas','admin') DEFAULT 'asiakas',
  `SalasanaHash` varchar(255) NOT NULL,
  `Luotu` timestamp NOT NULL DEFAULT current_timestamp(),
  `Muokattu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `two_factor_code` varchar(255) DEFAULT NULL,
  `two_factor_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`User_ID`, `Nimi`, `Sähköposti`, `Puhelin`, `Rooli`, `SalasanaHash`, `Luotu`, `Muokattu`, `remember_token`, `email_verified_at`, `two_factor_code`, `two_factor_expires_at`) VALUES
(1, 'Risto', 'risto@example.com', '0401234567', 'asiakas', '$2y$10$abc123hashedpassword', '2025-11-24 10:54:21', '2025-11-24 10:54:57', NULL, NULL, NULL, NULL),
(5, 'pekka', 'pekka@gmail.com', '', 'asiakas', '$2y$12$l6myGvOpG6THzsLRaGTjWuaJ4P5IV86nhYWY1KUoUfaOn10i6JqXy', '2025-11-24 17:30:27', '2025-11-24 17:30:27', NULL, NULL, NULL, NULL),
(6, 'jusu', 'jusu@gmail.com', '1011010', 'asiakas', '$2y$12$uDJVFmOdG4sd80BacIYgQee0fUiMAmuCCX/gI35kCVox43RFuDu6W', '2025-11-24 18:11:56', '2025-11-24 18:11:56', NULL, NULL, NULL, NULL),
(7, 'at', 'at@at', '101010', 'asiakas', '$2y$12$RH3goQna0rhbBsl4vBBhCOFQ1XvPDeRcdN3ypbn.AbPC/lL710g5a', '2025-11-24 20:18:57', '2025-11-25 18:05:37', 'SJzHvmqeT23IEz84i5eiB5G9SGDZ3W9Zk6Z62pmC3yRUexQBH4HwzrS1omuM', NULL, NULL, NULL),
(23, 'a', 'ristotoiv.rt@gmail.com', '0449787395', 'asiakas', '$2y$12$Rts.vCg/C9pxVHbrCks4AOLJ45q0y4ii9EcXIc.j1O7nGWpODMbFC', '2025-11-25 18:19:05', '2025-12-02 12:02:31', 'u4Coy0PTPQys0LWki4cjnfVs99w7ZJZE2McDvtSa9O2zb1bQVMqZLHLk1aeJ', '2025-11-25 18:19:21', '263720', '2025-12-02 10:12:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseptit`
--
ALTER TABLE `reseptit`
  ADD PRIMARY KEY (`Resepti_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tilaukset`
--
ALTER TABLE `tilaukset`
  ADD PRIMARY KEY (`Tilaus_ID`),
  ADD KEY `idx_user` (`User_ID`),
  ADD KEY `idx_tila_tilaus` (`Tila`),
  ADD KEY `idx_pvm` (`TilausPvm`),
  ADD KEY `idx_user_tila` (`User_ID`,`Tila`);

--
-- Indexes for table `tilausrivit`
--
ALTER TABLE `tilausrivit`
  ADD PRIMARY KEY (`TilausriviID`),
  ADD KEY `idx_tilaus` (`Tilaus_ID`),
  ADD KEY `idx_tuote` (`Tuote_ID`);

--
-- Indexes for table `tuotteet`
--
ALTER TABLE `tuotteet`
  ADD PRIMARY KEY (`Tuote_ID`),
  ADD KEY `idx_kategoria` (`Kategoria`),
  ADD KEY `idx_tila` (`Tila`),
  ADD KEY `idx_nimi` (`Nimi`),
  ADD KEY `idx_kategoria_tila` (`Kategoria`,`Tila`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `idx_email` (`Sähköposti`),
  ADD KEY `idx_rooli` (`Rooli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reseptit`
--
ALTER TABLE `reseptit`
  MODIFY `Resepti_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tilaukset`
--
ALTER TABLE `tilaukset`
  MODIFY `Tilaus_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tilausrivit`
--
ALTER TABLE `tilausrivit`
  MODIFY `TilausriviID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuotteet`
--
ALTER TABLE `tuotteet`
  MODIFY `Tuote_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `tilaukset`
--
ALTER TABLE `tilaukset`
  ADD CONSTRAINT `tilaukset_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE;

--
-- Rajoitteet taululle `tilausrivit`
--
ALTER TABLE `tilausrivit`
  ADD CONSTRAINT `tilausrivit_ibfk_1` FOREIGN KEY (`Tilaus_ID`) REFERENCES `tilaukset` (`Tilaus_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tilausrivit_ibfk_2` FOREIGN KEY (`Tuote_ID`) REFERENCES `tuotteet` (`Tuote_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
