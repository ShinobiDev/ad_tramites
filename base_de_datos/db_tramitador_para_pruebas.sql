-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2019 at 05:01 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tramitador_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo_anuncio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_anuncio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `id_tramite` int(11) NOT NULL,
  `valor_tramite` decimal(12,2) NOT NULL,
  `estado_anuncio` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ciudad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validez_anuncio` enum('Activo','Bloqueado','Sin publicar') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sin publicar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anuncios`
--

INSERT INTO `anuncios` (`id`, `codigo_anuncio`, `descripcion_anuncio`, `id_user`, `id_tramite`, `valor_tramite`, `estado_anuncio`, `ciudad`, `validez_anuncio`, `created_at`, `updated_at`) VALUES
(429, 't15518937291', 'prueba', 23, 1, '500.00', '0', 'Bogotá, Bogota, Colombia', 'Activo', NULL, '2019-03-06 20:35:05'),
(430, 't15519020241', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 23, 1, '10000.00', '1', 'Bogotá, Bogota, Colombia', 'Activo', NULL, '2019-03-06 20:21:59'),
(431, 't15519036251', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 1, '25600.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:35:02'),
(432, 't15519036252', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 2, '50000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:26'),
(433, 't15519036253', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 3, '30000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:10'),
(434, 't15519036254', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 4, '65000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:12'),
(435, 't15519036255', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 5, '56000.00', '0', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:24:29'),
(436, 't15519036256', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 6, '65300.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:15'),
(437, 't15519036257', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 7, '120000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:19'),
(438, 't15519036258', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 8, '320000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:17'),
(439, 't15519036259', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 9, '65000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:21'),
(440, 't155190362510', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 10, '65000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:29'),
(441, 't155190362511', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 11, '98000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:28'),
(442, 't155190362512', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 12, '98000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:31'),
(443, 't155190362513', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 13, '78000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:39'),
(444, 't155190362514', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 14, '780000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:43'),
(445, 't155190362515', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 15, '45000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:48'),
(446, 't155190362516', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 16, '59000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:44'),
(447, 't155190362517', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 17, '65200.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:40'),
(448, 't155190362518', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 18, '98000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:49'),
(449, 't155190362519', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 19, '78000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-07 18:12:03'),
(450, 't155190362520', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 20, '66000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:33'),
(451, 't155190362521', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 21, '653200.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-07 18:12:01'),
(452, 't155190362522', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 22, '32000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-06 20:22:51'),
(453, 't155190362523', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 23, '65890.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:53'),
(454, 't155190362524', 'rem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s s', 23, 24, '320000.00', '1', 'Soacha, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-06 20:22:35'),
(455, 't15519819871', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 2, '560000.00', '1', 'Medellín, Medellin, Antioquia, Colombia', 'Activo', NULL, '2019-03-07 18:11:33'),
(456, 't15519820291', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 7, '89000.00', '1', 'Girardot, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-07 18:11:25'),
(457, 't15519820292', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 8, '78000.00', '1', 'Girardot, Cundinamarca, Colombia', 'Bloqueado', NULL, '2019-03-07 18:11:21'),
(458, 't15519820293', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 24, '98000.00', '1', 'Girardot, Cundinamarca, Colombia', 'Activo', NULL, '2019-03-07 18:11:47'),
(459, 't15519822001', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 1, '100000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:10:54'),
(460, 't15519822002', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 2, '100000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:35'),
(461, 't15519822003', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 3, '100000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:00'),
(462, 't15519822004', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 4, '582000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:02'),
(463, 't15519822005', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 5, '65000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:05'),
(464, 't15519822006', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 6, '23000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:06'),
(465, 't15519822007', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 7, '56000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:27'),
(466, 't15519822008', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 8, '123000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:23'),
(467, 't15519822009', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 9, '320000.00', '1', 'Neiva, Huila, Colombia', 'Bloqueado', NULL, '2019-03-07 18:11:28'),
(468, 't155198220010', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 10, '132000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:38'),
(469, 't155198220011', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 11, '65000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:36'),
(470, 't155198220012', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 12, '653200.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:33'),
(471, 't155198220013', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 13, '65300.00', '1', 'Neiva, Huila, Colombia', 'Bloqueado', NULL, '2019-03-07 18:11:53'),
(472, 't155198220014', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 14, '98000.00', '1', 'Neiva, Huila, Colombia', 'Bloqueado', NULL, '2019-03-07 18:12:13'),
(473, 't155198220015', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 15, '78010.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:09'),
(474, 't155198220016', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 16, '74500.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:11'),
(475, 't155198220017', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 17, '98500.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:55'),
(476, 't155198220018', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 18, '89400.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:08'),
(477, 't155198220019', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 20, '32000.00', '1', 'Neiva, Huila, Colombia', 'Bloqueado', NULL, '2019-03-07 18:11:45'),
(478, 't155198220020', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 21, '78000.00', '1', 'Neiva, Huila, Colombia', 'Bloqueado', NULL, '2019-03-07 18:12:00'),
(479, 't155198220021', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 22, '784000.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:06'),
(480, 't155198220022', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 23, '98500.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:12:04'),
(481, 't155198220023', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s', 22, 24, '23200.00', '1', 'Neiva, Huila, Colombia', 'Activo', NULL, '2019-03-07 18:11:51'),
(482, 't15519827821', 'prueba', 26, 22, '64998.00', '1', 'Valledupar, Cesar, Colombia', 'Sin publicar', NULL, NULL),
(483, 't15519828451', 'prueba', 26, 20, '78000.00', '1', 'Arauca, Colombia', 'Sin publicar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apis`
--

CREATE TABLE `apis` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apis`
--

INSERT INTO `apis` (`id`, `nombre`, `key`, `created_at`, `updated_at`) VALUES
(1, 'GoogleDirections', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCjK1P7ObTN9d1kZ8LTVU-mvoY8Uc2it1w&libraries=places&callback=iniciarApp', '2018-12-13 15:12:00', '2018-12-13 15:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `bonificaciones`
--

CREATE TABLE `bonificaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_bonificacion` enum('REGISTRO','RECARGA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_detalle_referido` int(11) NOT NULL,
  `valor_bonificacion` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonificaciones`
--

INSERT INTO `bonificaciones` (`id`, `tipo_bonificacion`, `fk_id_detalle_referido`, `valor_bonificacion`, `created_at`, `updated_at`) VALUES
(13, 'REGISTRO', 8, '100.00', NULL, NULL),
(14, 'REGISTRO', 9, '100.00', NULL, NULL),
(15, 'REGISTRO', 10, '100.00', '2019-03-06 17:11:53', NULL),
(16, 'REGISTRO', 11, '100.00', '2019-03-07 17:17:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campanias`
--

CREATE TABLE `campanias` (
  `id` int(11) NOT NULL,
  `nombre_campania` varchar(256) NOT NULL,
  `tipo_campania` enum('global','personal') NOT NULL,
  `tipo_canje` enum('compra','recarga') NOT NULL,
  `fecha_inicial_vigencia` datetime DEFAULT NULL,
  `fecha_final_vigencia` datetime NOT NULL,
  `numero_de_cupones` int(11) NOT NULL,
  `cupones_disponibles` int(11) NOT NULL,
  `cupones_canjeados` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `limite_por_usuario` int(11) NOT NULL DEFAULT '1',
  `tipo_de_descuento` enum('porcentaje','valor_neto') NOT NULL DEFAULT 'porcentaje',
  `valor_de_descuento` decimal(10,2) NOT NULL,
  `costo_minimo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `es_acumulable` enum('0','1') NOT NULL DEFAULT '0',
  `estado_campania` enum('ABIERTA','CERRADA') NOT NULL DEFAULT 'ABIERTA',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campanias`
--

INSERT INTO `campanias` (`id`, `nombre_campania`, `tipo_campania`, `tipo_canje`, `fecha_inicial_vigencia`, `fecha_final_vigencia`, `numero_de_cupones`, `cupones_disponibles`, `cupones_canjeados`, `id_user`, `limite_por_usuario`, `tipo_de_descuento`, `valor_de_descuento`, `costo_minimo`, `es_acumulable`, `estado_campania`, `created_at`, `updated_at`) VALUES
(14, 'PRUEBA RECARGA 20 MIL REGALO', 'global', 'recarga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 9, 1, NULL, 1, 'valor_neto', '20000.00', '500.00', '0', 'ABIERTA', '2019-03-06 15:27:19', '2019-03-06 15:36:41'),
(15, 'RECARGA  BONO REGALO 20 %', 'global', 'recarga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 9, 1, NULL, 1, 'porcentaje', '20.00', '500.00', '0', 'ABIERTA', '2019-03-06 15:28:07', '2019-03-06 15:47:31'),
(16, 'RECARGA ACUMULABLE', 'global', 'recarga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 8, 2, NULL, 2, 'valor_neto', '15000.00', '15000.00', '1', 'ABIERTA', '2019-03-06 15:29:14', '2019-03-06 15:50:03'),
(17, 'MI PRIMER COMPRA 15 MIL DE REGALO', 'global', 'compra', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 9, 1, NULL, 1, 'valor_neto', '15000.00', '50000.00', '0', 'ABIERTA', '2019-03-06 15:30:09', '2019-03-06 16:39:22'),
(18, 'Compras al 50 % de descuento', 'global', 'compra', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 7, 3, NULL, 1, 'porcentaje', '50.00', '35000.00', '0', 'ABIERTA', '2019-03-06 15:30:50', '2019-03-07 12:38:39'),
(19, 'COMPRA  ACUMULABLE', 'global', 'compra', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 10, 0, NULL, 2, 'porcentaje', '5.00', '63000.00', '1', 'ABIERTA', '2019-03-06 15:31:30', '2019-03-06 15:31:30'),
(20, 'RECARGA FREE BONO REGALO 20 MIL', 'personal', 'recarga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, 22, 1, 'valor_neto', '29980.00', '500.00', '0', 'ABIERTA', '2019-03-11 11:34:45', '2019-03-11 11:34:45'),
(21, 'solo andrea', 'personal', 'recarga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 0, 3, 1, 'valor_neto', '20000.00', '500.00', '0', 'ABIERTA', '2019-03-11 11:40:44', '2019-03-11 11:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `ciudads`
--

CREATE TABLE `ciudads` (
  `id` int(11) NOT NULL,
  `ciudad` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ciudads`
--

INSERT INTO `ciudads` (`id`, `ciudad`, `created_at`, `updated_at`) VALUES
(1, 'MEDELLIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(2, 'ABEJORRAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(3, 'ABRIAQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(4, 'ALEJANDRIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(5, 'AMAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(6, 'AMALFI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(7, 'ANDES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(8, 'ANGELOPOLIS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(9, 'ANGOSTURA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(10, 'ANORI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(11, 'SANTAFE DE ANTIOQUIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(12, 'ANZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(13, 'APARTADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(14, 'ARBOLETES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(15, 'ARGELIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(16, 'ARMENIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(17, 'BARBOSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(18, 'BELMIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(19, 'BELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(20, 'BETANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(21, 'BETULIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(22, 'CIUDAD BOLIVAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(23, 'BRICEÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(24, 'BURITICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(25, 'CACERES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(26, 'CAICEDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(27, 'CALDAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(28, 'CAMPAMENTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(29, 'CAÑASGORDAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(30, 'CARACOLI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(31, 'CARAMANTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(32, 'CAREPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(33, 'EL CARMEN DE VIBORAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(34, 'CAROLINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(35, 'CAUCASIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(36, 'CHIGORODO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(37, 'CISNEROS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(38, 'COCORNA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(39, 'CONCEPCION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(40, 'CONCORDIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(41, 'COPACABANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(42, 'DABEIBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(43, 'DON MATIAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(44, 'EBEJICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(45, 'EL BAGRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(46, 'ENTRERRIOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(47, 'ENVIGADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(48, 'FREDONIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(49, 'FRONTINO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(50, 'GIRALDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(51, 'GIRARDOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(52, 'GOMEZ PLATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(53, 'GRANADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(54, 'GUADALUPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(55, 'GUARNE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(56, 'GUATAPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(57, 'HELICONIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(58, 'HISPANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(59, 'ITAGUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(60, 'ITUANGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(61, 'JARDIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(62, 'JERICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(63, 'LA CEJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(64, 'LA ESTRELLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(65, 'LA PINTADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(66, 'LA UNION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(67, 'LIBORINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(68, 'MACEO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(69, 'MARINILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(70, 'MONTEBELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(71, 'MURINDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(72, 'MUTATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(73, 'NARIÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(74, 'NECOCLI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(75, 'NECHI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(76, 'OLAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(77, 'PEÐOL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(78, 'PEQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(79, 'PUEBLORRICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(80, 'PUERTO BERRIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(81, 'PUERTO NARE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(82, 'PUERTO TRIUNFO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(83, 'REMEDIOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(84, 'RETIRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(85, 'RIONEGRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(86, 'SABANALARGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(87, 'SABANETA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(88, 'SALGAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(89, 'SAN ANDRES DE CUERQUIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(90, 'SAN CARLOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(91, 'SAN FRANCISCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(92, 'SAN JERONIMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(93, 'SAN JOSE DE LA MONTAÑA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(94, 'SAN JUAN DE URABA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(95, 'SAN LUIS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(96, 'SAN PEDRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(97, 'SAN PEDRO DE URABA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(98, 'SAN RAFAEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(99, 'SAN ROQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(100, 'SAN VICENTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(101, 'SANTA BARBARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(102, 'SANTA ROSA DE OSOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(103, 'SANTO DOMINGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(104, 'EL SANTUARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(105, 'SEGOVIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(106, 'SONSON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(107, 'SOPETRAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(108, 'TAMESIS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(109, 'TARAZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(110, 'TARSO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(111, 'TITIRIBI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(112, 'TOLEDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(113, 'TURBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(114, 'URAMITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(115, 'URRAO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(116, 'VALDIVIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(117, 'VALPARAISO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(118, 'VEGACHI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(119, 'VENECIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(120, 'VIGIA DEL FUERTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(121, 'YALI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(122, 'YARUMAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(123, 'YOLOMBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(124, 'YONDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(125, 'ZARAGOZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(126, 'BARRANQUILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(127, 'BARANOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(128, 'CAMPO DE LA CRUZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(129, 'CANDELARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(130, 'GALAPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(131, 'JUAN DE ACOSTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(132, 'LURUACO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(133, 'MALAMBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(134, 'MANATI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(135, 'PALMAR DE VARELA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(136, 'PIOJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(137, 'POLONUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(138, 'PONEDERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(139, 'PUERTO COLOMBIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(140, 'REPELON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(141, 'SABANAGRANDE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(142, 'SABANALARGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(143, 'SANTA LUCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(144, 'SANTO TOMAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(145, 'SOLEDAD', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(146, 'SUAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(147, 'TUBARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(148, 'USIACURI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(149, 'BOGOTA, D.C.', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(150, 'CARTAGENA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(151, 'ACHI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(152, 'ALTOS DEL ROSARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(153, 'ARENAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(154, 'ARJONA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(155, 'ARROYOHONDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(156, 'BARRANCO DE LOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(157, 'CALAMAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(158, 'CANTAGALLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(159, 'CICUCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(160, 'CORDOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(161, 'CLEMENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(162, 'EL CARMEN DE BOLIVAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(163, 'EL GUAMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(164, 'EL PEÑON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(165, 'HATILLO DE LOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(166, 'MAGANGUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(167, 'MAHATES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(168, 'MARGARITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(169, 'MARIA LA BAJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(170, 'MONTECRISTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(171, 'MOMPOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(172, 'NOROSI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(173, 'MORALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(174, 'PINILLOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(175, 'REGIDOR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(176, 'RIO VIEJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(177, 'SAN CRISTOBAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(178, 'SAN ESTANISLAO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(179, 'SAN FERNANDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(180, 'SAN JACINTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(181, 'SAN JACINTO DEL CAUCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(182, 'SAN JUAN NEPOMUCENO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(183, 'SAN MARTIN DE LOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(184, 'SAN PABLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(185, 'SANTA CATALINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(186, 'SANTA ROSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(187, 'SANTA ROSA DEL SUR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(188, 'SIMITI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(189, 'SOPLAVIENTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(190, 'TALAIGUA NUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(191, 'TIQUISIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(192, 'TURBACO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(193, 'TURBANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(194, 'VILLANUEVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(195, 'ZAMBRANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(196, 'TUNJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(197, 'ALMEIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(198, 'AQUITANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(199, 'ARCABUCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(200, 'BELEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(201, 'BERBEO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(202, 'BETEITIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(203, 'BOAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(204, 'BOYACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(205, 'BRICEÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(206, 'BUENAVISTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(207, 'BUSBANZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(208, 'CALDAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(209, 'CAMPOHERMOSO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(210, 'CERINZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(211, 'CHINAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(212, 'CHIQUINQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(213, 'CHISCAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(214, 'CHITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(215, 'CHITARAQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(216, 'CHIVATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(217, 'CIENEGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(218, 'COMBITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(219, 'COPER', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(220, 'CORRALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(221, 'COVARACHIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(222, 'CUBARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(223, 'CUCAITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(224, 'CUITIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(225, 'CHIQUIZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(226, 'CHIVOR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(227, 'DUITAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(228, 'EL COCUY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(229, 'EL ESPINO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(230, 'FIRAVITOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(231, 'FLORESTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(232, 'GACHANTIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(233, 'GAMEZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(234, 'GARAGOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(235, 'GUACAMAYAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(236, 'GUATEQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(237, 'GUAYATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(238, 'GsICAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(239, 'IZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(240, 'JENESANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(241, 'JERICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(242, 'LABRANZAGRANDE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(243, 'LA CAPILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(244, 'LA VICTORIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(245, 'LA UVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(246, 'VILLA DE LEYVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(247, 'MACANAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(248, 'MARIPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(249, 'MIRAFLORES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(250, 'MONGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(251, 'MONGUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(252, 'MONIQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(253, 'MOTAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(254, 'MUZO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(255, 'NOBSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(256, 'NUEVO COLON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(257, 'OICATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(258, 'OTANCHE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(259, 'PACHAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(260, 'PAEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(261, 'PAIPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(262, 'PAJARITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(263, 'PANQUEBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(264, 'PAUNA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(265, 'PAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(266, 'PAZ DE RIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(267, 'PESCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(268, 'PISBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(269, 'PUERTO BOYACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(270, 'QUIPAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(271, 'RAMIRIQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(272, 'RAQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(273, 'RONDON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(274, 'SABOYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(275, 'SACHICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(276, 'SAMACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(277, 'SAN EDUARDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(278, 'SAN JOSE DE PARE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(279, 'SAN LUIS DE GACENO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(280, 'SAN MATEO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(281, 'SAN MIGUEL DE SEMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(282, 'SAN PABLO DE BORBUR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(283, 'SANTANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(284, 'SANTA MARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(285, 'SANTA ROSA DE VITERBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(286, 'SANTA SOFIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(287, 'SATIVANORTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(288, 'SATIVASUR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(289, 'SIACHOQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(290, 'SOATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(291, 'SOCOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(292, 'SOCHA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(293, 'SOGAMOSO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(294, 'SOMONDOCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(295, 'SORA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(296, 'SOTAQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(297, 'SORACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(298, 'SUSACON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(299, 'SUTAMARCHAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(300, 'SUTATENZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(301, 'TASCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(302, 'TENZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(303, 'TIBANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(304, 'TIBASOSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(305, 'TINJACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(306, 'TIPACOQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(307, 'TOCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(308, 'TOGsI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(309, 'TOPAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(310, 'TOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(311, 'TUNUNGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(312, 'TURMEQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(313, 'TUTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(314, 'TUTAZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(315, 'UMBITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(316, 'VENTAQUEMADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(317, 'VIRACACHA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(318, 'ZETAQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(319, 'MANIZALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(320, 'AGUADAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(321, 'ANSERMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(322, 'ARANZAZU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(323, 'BELALCAZAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(324, 'CHINCHINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(325, 'FILADELFIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(326, 'LA DORADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(327, 'LA MERCED', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(328, 'MANZANARES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(329, 'MARMATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(330, 'MARQUETALIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(331, 'MARULANDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(332, 'NEIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(333, 'NORCASIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(334, 'PACORA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(335, 'PALESTINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(336, 'PENSILVANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(337, 'RIOSUCIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(338, 'RISARALDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(339, 'SALAMINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(340, 'SAMANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(341, 'SAN JOSE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(342, 'SUPIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(343, 'VICTORIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(344, 'VILLAMARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(345, 'VITERBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(346, 'FLORENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(347, 'ALBANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(348, 'BELEN DE LOS ANDAQUIES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(349, 'CARTAGENA DEL CHAIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(350, 'CURILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(351, 'EL DONCELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(352, 'EL PAUJIL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(353, 'LA MONTAÑITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(354, 'MILAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(355, 'MORELIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(356, 'PUERTO RICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(357, 'SAN JOSE DEL FRAGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(358, 'SAN VICENTE DEL CAGUAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(359, 'SOLANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(360, 'SOLITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(361, 'VALPARAISO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(362, 'POPAYAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(363, 'ALMAGUER', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(364, 'ARGELIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(365, 'BALBOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(366, 'BOLIVAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(367, 'BUENOS AIRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(368, 'CAJIBIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(369, 'CALDONO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(370, 'CALOTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(371, 'CORINTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(372, 'EL TAMBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(373, 'FLORENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(374, 'GUACHENE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(375, 'GUAPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(376, 'INZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(377, 'JAMBALO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(378, 'LA SIERRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(379, 'LA VEGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(380, 'LOPEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(381, 'MERCADERES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(382, 'MIRANDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(383, 'MORALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(384, 'PADILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(385, 'PAEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(386, 'PATIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(387, 'PIAMONTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(388, 'PIENDAMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(389, 'PUERTO TEJADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(390, 'PURACE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(391, 'ROSAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(392, 'SAN SEBASTIAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(393, 'SANTANDER DE QUILICHAO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(394, 'SANTA ROSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(395, 'SILVIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(396, 'SOTARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(397, 'SUAREZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(398, 'SUCRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(399, 'TIMBIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(400, 'TIMBIQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(401, 'TORIBIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(402, 'TOTORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(403, 'VILLA RICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(404, 'VALLEDUPAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(405, 'AGUACHICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(406, 'AGUSTIN CODAZZI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(407, 'ASTREA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(408, 'BECERRIL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(409, 'BOSCONIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(410, 'CHIMICHAGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(411, 'CHIRIGUANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(412, 'CURUMANI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(413, 'EL COPEY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(414, 'EL PASO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(415, 'GAMARRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(416, 'GONZALEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(417, 'LA GLORIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(418, 'LA JAGUA DE IBIRICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(419, 'MANAURE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(420, 'PAILITAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(421, 'PELAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(422, 'PUEBLO BELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(423, 'RIO DE ORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(424, 'LA PAZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(425, 'SAN ALBERTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(426, 'SAN DIEGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(427, 'SAN MARTIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(428, 'TAMALAMEQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(429, 'MONTERIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(430, 'AYAPEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(431, 'BUENAVISTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(432, 'CANALETE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(433, 'CERETE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(434, 'CHIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(435, 'CHINU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(436, 'CIENAGA DE ORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(437, 'COTORRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(438, 'LA APARTADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(439, 'LORICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(440, 'LOS CORDOBAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(441, 'MOMIL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(442, 'MONTELIBANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(443, 'MOÑITOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(444, 'PLANETA RICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(445, 'PUEBLO NUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(446, 'PUERTO ESCONDIDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(447, 'PUERTO LIBERTADOR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(448, 'PURISIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(449, 'SAHAGUN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(450, 'SAN ANDRES SOTAVENTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(451, 'SAN ANTERO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(452, 'SAN BERNARDO DEL VIENTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(453, 'SAN CARLOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(454, 'SAN PELAYO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(455, 'TIERRALTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(456, 'VALENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(457, 'AGUA DE DIOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(458, 'ALBAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(459, 'ANAPOIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(460, 'ANOLAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(461, 'ARBELAEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(462, 'BELTRAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(463, 'BITUIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(464, 'BOJACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(465, 'CABRERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(466, 'CACHIPAY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(467, 'CAJICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(468, 'CAPARRAPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(469, 'CAQUEZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(470, 'CARMEN DE CARUPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(471, 'CHAGUANI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(472, 'CHIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(473, 'CHIPAQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(474, 'CHOACHI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(475, 'CHOCONTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(476, 'COGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(477, 'COTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(478, 'CUCUNUBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(479, 'EL COLEGIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(480, 'EL PEÑON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(481, 'EL ROSAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(482, 'FACATATIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(483, 'FOMEQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(484, 'FOSCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(485, 'FUNZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(486, 'FUQUENE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(487, 'FUSAGASUGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(488, 'GACHALA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(489, 'GACHANCIPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(490, 'GACHETA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(491, 'GAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(492, 'GIRARDOT', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(493, 'GRANADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(494, 'GUACHETA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(495, 'GUADUAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(496, 'GUASCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(497, 'GUATAQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(498, 'GUATAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(499, 'GUAYABAL DE SIQUIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(500, 'GUAYABETAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(501, 'GUTIERREZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(502, 'JERUSALEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(503, 'JUNIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(504, 'LA CALERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(505, 'LA MESA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(506, 'LA PALMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(507, 'LA PEÑA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(508, 'LA VEGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(509, 'LENGUAZAQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(510, 'MACHETA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(511, 'MADRID', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(512, 'MANTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(513, 'MEDINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(514, 'MOSQUERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(515, 'NARIÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(516, 'NEMOCON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(517, 'NILO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(518, 'NIMAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(519, 'NOCAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(520, 'VENECIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(521, 'PACHO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(522, 'PAIME', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(523, 'PANDI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(524, 'PARATEBUENO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(525, 'PASCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(526, 'PUERTO SALGAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(527, 'PULI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(528, 'QUEBRADANEGRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(529, 'QUETAME', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(530, 'QUIPILE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(531, 'APULO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(532, 'RICAURTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(533, 'SAN ANTONIO DEL TEQUENDAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(534, 'SAN BERNARDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(535, 'SAN CAYETANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(536, 'SAN FRANCISCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(537, 'SAN JUAN DE RIO SECO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(538, 'SASAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(539, 'SESQUILE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(540, 'SIBATE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(541, 'SILVANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(542, 'SIMIJACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(543, 'SOACHA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(544, 'SOPO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(545, 'SUBACHOQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(546, 'SUESCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(547, 'SUPATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(548, 'SUSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(549, 'SUTATAUSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(550, 'TABIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(551, 'TAUSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(552, 'TENA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(553, 'TENJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(554, 'TIBACUY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(555, 'TIBIRITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(556, 'TOCAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(557, 'TOCANCIPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(558, 'TOPAIPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(559, 'UBALA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(560, 'UBAQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(561, 'VILLA DE SAN DIEGO DE UBATE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(562, 'UNE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(563, 'UTICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(564, 'VERGARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(565, 'VIANI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(566, 'VILLAGOMEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(567, 'VILLAPINZON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(568, 'VILLETA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(569, 'VIOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(570, 'YACOPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(571, 'ZIPACON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(572, 'ZIPAQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(573, 'QUIBDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(574, 'ACANDI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(575, 'ALTO BAUDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(576, 'ATRATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(577, 'BAGADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(578, 'BAHIA SOLANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(579, 'BAJO BAUDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(580, 'BOJAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(581, 'EL CANTON DEL SAN PABLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(582, 'CARMEN DEL DARIEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(583, 'CERTEGUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(584, 'CONDOTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(585, 'EL CARMEN DE ATRATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(586, 'EL LITORAL DEL SAN JUAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(587, 'ISTMINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(588, 'JURADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(589, 'LLORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(590, 'MEDIO ATRATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(591, 'MEDIO BAUDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(592, 'MEDIO SAN JUAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(593, 'NOVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(594, 'NUQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(595, 'RIO IRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(596, 'RIO QUITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(597, 'RIOSUCIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(598, 'SAN JOSE DEL PALMAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(599, 'SIPI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(600, 'TADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(601, 'UNGUIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(602, 'UNION PANAMERICANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(603, 'NEIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(604, 'ACEVEDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(605, 'AGRADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(606, 'AIPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(607, 'ALGECIRAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(608, 'ALTAMIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(609, 'BARAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(610, 'CAMPOALEGRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(611, 'COLOMBIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(612, 'ELIAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(613, 'GARZON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(614, 'GIGANTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(615, 'GUADALUPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(616, 'HOBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(617, 'IQUIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(618, 'ISNOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(619, 'LA ARGENTINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(620, 'LA PLATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(621, 'NATAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(622, 'OPORAPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(623, 'PAICOL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(624, 'PALERMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(625, 'PALESTINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(626, 'PITAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(627, 'PITALITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(628, 'RIVERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(629, 'SALADOBLANCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(630, 'SAN AGUSTIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(631, 'SANTA MARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(632, 'SUAZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(633, 'TARQUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(634, 'TESALIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(635, 'TELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(636, 'TERUEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(637, 'TIMANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(638, 'VILLAVIEJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(639, 'YAGUARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(640, 'RIOHACHA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(641, 'ALBANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(642, 'BARRANCAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(643, 'DIBULLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(644, 'DISTRACCION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(645, 'EL MOLINO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(646, 'FONSECA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(647, 'HATONUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(648, 'LA JAGUA DEL PILAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(649, 'MAICAO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(650, 'MANAURE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(651, 'SAN JUAN DEL CESAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(652, 'URIBIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(653, 'URUMITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(654, 'VILLANUEVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(655, 'SANTA MARTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(656, 'ALGARROBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(657, 'ARACATACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(658, 'ARIGUANI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(659, 'CERRO SAN ANTONIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(660, 'CHIBOLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(661, 'CIENAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(662, 'CONCORDIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(663, 'EL BANCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(664, 'EL PIÑON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(665, 'EL RETEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(666, 'FUNDACION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(667, 'GUAMAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(668, 'NUEVA GRANADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(669, 'PEDRAZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(670, 'PIJIÑO DEL CARMEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(671, 'PIVIJAY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(672, 'PLATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(673, 'PUEBLOVIEJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(674, 'REMOLINO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(675, 'SABANAS DE SAN ANGEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(676, 'SALAMINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(677, 'SAN SEBASTIAN DE BUENAVISTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(678, 'SAN ZENON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(679, 'SANTA ANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(680, 'SANTA BARBARA DE PINTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(681, 'SITIONUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(682, 'TENERIFE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(683, 'ZAPAYAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(684, 'ZONA BANANERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(685, 'VILLAVICENCIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(686, 'ACACIAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(687, 'BARRANCA DE UPIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(688, 'CABUYARO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(689, 'CASTILLA LA NUEVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(690, 'CUBARRAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(691, 'CUMARAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(692, 'EL CALVARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(693, 'EL CASTILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(694, 'EL DORADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(695, 'FUENTE DE ORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(696, 'GRANADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(697, 'GUAMAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(698, 'MAPIRIPAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(699, 'MESETAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(700, 'LA MACARENA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(701, 'URIBE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(702, 'LEJANIAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(703, 'PUERTO CONCORDIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(704, 'PUERTO GAITAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(705, 'PUERTO LOPEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(706, 'PUERTO LLERAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(707, 'PUERTO RICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(708, 'RESTREPO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(709, 'SAN CARLOS DE GUAROA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(710, 'SAN JUAN DE ARAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(711, 'SAN JUANITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(712, 'SAN MARTIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(713, 'VISTAHERMOSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(714, 'PASTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(715, 'ALBAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(716, 'ALDANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(717, 'ANCUYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(718, 'ARBOLEDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(719, 'BARBACOAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(720, 'BELEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(721, 'BUESACO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(722, 'COLON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(723, 'CONSACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(724, 'CONTADERO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(725, 'CORDOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(726, 'CUASPUD', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(727, 'CUMBAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(728, 'CUMBITARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(729, 'CHACHAGsI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(730, 'EL CHARCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(731, 'EL PEÑOL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(732, 'EL ROSARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(733, 'EL TABLON DE GOMEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(734, 'EL TAMBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(735, 'FUNES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(736, 'GUACHUCAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(737, 'GUAITARILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(738, 'GUALMATAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(739, 'ILES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(740, 'IMUES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(741, 'IPIALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(742, 'LA CRUZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(743, 'LA FLORIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(744, 'LA LLANADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(745, 'LA TOLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(746, 'LA UNION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(747, 'LEIVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(748, 'LINARES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(749, 'LOS ANDES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(750, 'MAGsI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(751, 'MALLAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(752, 'MOSQUERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(753, 'NARIÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(754, 'OLAYA HERRERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(755, 'OSPINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(756, 'FRANCISCO PIZARRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(757, 'POLICARPA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(758, 'POTOSI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(759, 'PROVIDENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(760, 'PUERRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(761, 'PUPIALES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(762, 'RICAURTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(763, 'ROBERTO PAYAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(764, 'SAMANIEGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(765, 'SANDONA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(766, 'SAN BERNARDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(767, 'SAN LORENZO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(768, 'SAN PABLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(769, 'SAN PEDRO DE CARTAGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(770, 'SANTA BARBARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(771, 'SANTACRUZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(772, 'SAPUYES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(773, 'TAMINANGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(774, 'TANGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(775, 'SAN ANDRES DE TUMACO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(776, 'TUQUERRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(777, 'YACUANQUER', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(778, 'CUCUTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(779, 'ABREGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(780, 'ARBOLEDAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(781, 'BOCHALEMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(782, 'BUCARASICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(783, 'CACOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(784, 'CACHIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34');
INSERT INTO `ciudads` (`id`, `ciudad`, `created_at`, `updated_at`) VALUES
(785, 'CHINACOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(786, 'CHITAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(787, 'CONVENCION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(788, 'CUCUTILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(789, 'DURANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(790, 'EL CARMEN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(791, 'EL TARRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(792, 'EL ZULIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(793, 'GRAMALOTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(794, 'HACARI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(795, 'HERRAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(796, 'LABATECA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(797, 'LA ESPERANZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(798, 'LA PLAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(799, 'LOS PATIOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(800, 'LOURDES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(801, 'MUTISCUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(802, 'OCAÑA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(803, 'PAMPLONA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(804, 'PAMPLONITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(805, 'PUERTO SANTANDER', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(806, 'RAGONVALIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(807, 'SALAZAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(808, 'SAN CALIXTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(809, 'SAN CAYETANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(810, 'SANTIAGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(811, 'SARDINATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(812, 'SILOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(813, 'TEORAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(814, 'TIBU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(815, 'TOLEDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(816, 'VILLA CARO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(817, 'VILLA DEL ROSARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(818, 'ARMENIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(819, 'BUENAVISTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(820, 'CALARCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(821, 'CIRCASIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(822, 'CORDOBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(823, 'FILANDIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(824, 'GENOVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(825, 'LA TEBAIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(826, 'MONTENEGRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(827, 'PIJAO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(828, 'QUIMBAYA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(829, 'SALENTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(830, 'PEREIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(831, 'APIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(832, 'BALBOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(833, 'BELEN DE UMBRIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(834, 'DOSQUEBRADAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(835, 'GUATICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(836, 'LA CELIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(837, 'LA VIRGINIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(838, 'MARSELLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(839, 'MISTRATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(840, 'PUEBLO RICO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(841, 'QUINCHIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(842, 'SANTA ROSA DE CABAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(843, 'SANTUARIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(844, 'BUCARAMANGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(845, 'AGUADA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(846, 'ALBANIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(847, 'ARATOCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(848, 'BARBOSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(849, 'BARICHARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(850, 'BARRANCABERMEJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(851, 'BETULIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(852, 'BOLIVAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(853, 'CABRERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(854, 'CALIFORNIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(855, 'CAPITANEJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(856, 'CARCASI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(857, 'CEPITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(858, 'CERRITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(859, 'CHARALA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(860, 'CHARTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(861, 'CHIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(862, 'CHIPATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(863, 'CIMITARRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(864, 'CONCEPCION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(865, 'CONFINES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(866, 'CONTRATACION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(867, 'COROMORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(868, 'CURITI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(869, 'EL CARMEN DE CHUCURI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(870, 'EL GUACAMAYO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(871, 'EL PEÑON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(872, 'EL PLAYON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(873, 'ENCINO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(874, 'ENCISO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(875, 'FLORIAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(876, 'FLORIDABLANCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(877, 'GALAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(878, 'GAMBITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(879, 'GIRON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(880, 'GUACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(881, 'GUADALUPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(882, 'GUAPOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(883, 'GUAVATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(884, 'GsEPSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(885, 'HATO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(886, 'JESUS MARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(887, 'JORDAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(888, 'LA BELLEZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(889, 'LANDAZURI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(890, 'LA PAZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(891, 'LEBRIJA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(892, 'LOS SANTOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(893, 'MACARAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(894, 'MALAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(895, 'MATANZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(896, 'MOGOTES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(897, 'MOLAGAVITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(898, 'OCAMONTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(899, 'OIBA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(900, 'ONZAGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(901, 'PALMAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(902, 'PALMAS DEL SOCORRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(903, 'PARAMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(904, 'PIEDECUESTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(905, 'PINCHOTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(906, 'PUENTE NACIONAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(907, 'PUERTO PARRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(908, 'PUERTO WILCHES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(909, 'RIONEGRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(910, 'SABANA DE TORRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(911, 'SAN ANDRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(912, 'SAN BENITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(913, 'SAN GIL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(914, 'SAN JOAQUIN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(915, 'SAN JOSE DE MIRANDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(916, 'SAN MIGUEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(917, 'SAN VICENTE DE CHUCURI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(918, 'SANTA BARBARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(919, 'SANTA HELENA DEL OPON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(920, 'SIMACOTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(921, 'SOCORRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(922, 'SUAITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(923, 'SUCRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(924, 'SURATA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(925, 'TONA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(926, 'VALLE DE SAN JOSE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(927, 'VELEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(928, 'VETAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(929, 'VILLANUEVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(930, 'ZAPATOCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(931, 'SINCELEJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(932, 'BUENAVISTA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(933, 'CAIMITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(934, 'COLOSO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(935, 'COROZAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(936, 'COVEÑAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(937, 'CHALAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(938, 'EL ROBLE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(939, 'GALERAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(940, 'GUARANDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(941, 'LA UNION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(942, 'LOS PALMITOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(943, 'MAJAGUAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(944, 'MORROA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(945, 'OVEJAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(946, 'PALMITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(947, 'SAMPUES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(948, 'SAN BENITO ABAD', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(949, 'SAN JUAN DE BETULIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(950, 'SAN MARCOS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(951, 'SAN ONOFRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(952, 'SAN PEDRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(953, 'SAN LUIS DE SINCE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(954, 'SUCRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(955, 'SANTIAGO DE TOLU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(956, 'TOLU VIEJO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(957, 'IBAGUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(958, 'ALPUJARRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(959, 'ALVARADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(960, 'AMBALEMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(961, 'ANZOATEGUI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(962, 'ARMERO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(963, 'ATACO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(964, 'CAJAMARCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(965, 'CARMEN DE APICALA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(966, 'CASABIANCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(967, 'CHAPARRAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(968, 'COELLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(969, 'COYAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(970, 'CUNDAY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(971, 'DOLORES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(972, 'ESPINAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(973, 'FALAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(974, 'FLANDES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(975, 'FRESNO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(976, 'GUAMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(977, 'HERVEO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(978, 'HONDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(979, 'ICONONZO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(980, 'LERIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(981, 'LIBANO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(982, 'MARIQUITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(983, 'MELGAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(984, 'MURILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(985, 'NATAGAIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(986, 'ORTEGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(987, 'PALOCABILDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(988, 'PIEDRAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(989, 'PLANADAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(990, 'PRADO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(991, 'PURIFICACION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(992, 'RIOBLANCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(993, 'RONCESVALLES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(994, 'ROVIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(995, 'SALDAÑA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(996, 'SAN ANTONIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(997, 'SAN LUIS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(998, 'SANTA ISABEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(999, 'SUAREZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1000, 'VALLE DE SAN JUAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1001, 'VENADILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1002, 'VILLAHERMOSA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1003, 'VILLARRICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1004, 'CALI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1005, 'ALCALA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1006, 'ANDALUCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1007, 'ANSERMANUEVO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1008, 'ARGELIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1009, 'BOLIVAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1010, 'BUENAVENTURA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1011, 'GUADALAJARA DE BUGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1012, 'BUGALAGRANDE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1013, 'CAICEDONIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1014, 'CALIMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1015, 'CANDELARIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1016, 'CARTAGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1017, 'DAGUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1018, 'EL AGUILA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1019, 'EL CAIRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1020, 'EL CERRITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1021, 'EL DOVIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1022, 'FLORIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1023, 'GINEBRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1024, 'GUACARI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1025, 'JAMUNDI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1026, 'LA CUMBRE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1027, 'LA UNION', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1028, 'LA VICTORIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1029, 'OBANDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1030, 'PALMIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1031, 'PRADERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1032, 'RESTREPO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1033, 'RIOFRIO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1034, 'ROLDANILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1035, 'SAN PEDRO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1036, 'SEVILLA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1037, 'TORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1038, 'TRUJILLO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1039, 'TULUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1040, 'ULLOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1041, 'VERSALLES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1042, 'VIJES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1043, 'YOTOCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1044, 'YUMBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1045, 'ZARZAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1046, 'ARAUCA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1047, 'ARAUQUITA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1048, 'CRAVO NORTE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1049, 'FORTUL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1050, 'PUERTO RONDON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1051, 'SARAVENA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1052, 'TAME', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1053, 'YOPAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1054, 'AGUAZUL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1055, 'CHAMEZA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1056, 'HATO COROZAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1057, 'LA SALINA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1058, 'MANI', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1059, 'MONTERREY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1060, 'NUNCHIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1061, 'OROCUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1062, 'PAZ DE ARIPORO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1063, 'PORE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1064, 'RECETOR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1065, 'SABANALARGA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1066, 'SACAMA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1067, 'SAN LUIS DE PALENQUE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1068, 'TAMARA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1069, 'TAURAMENA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1070, 'TRINIDAD', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1071, 'VILLANUEVA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1072, 'MOCOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1073, 'COLON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1074, 'ORITO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1075, 'PUERTO ASIS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1076, 'PUERTO CAICEDO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1077, 'PUERTO GUZMAN', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1078, 'LEGUIZAMO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1079, 'SIBUNDOY', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1080, 'SAN FRANCISCO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1081, 'SAN MIGUEL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1082, 'SANTIAGO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1083, 'VALLE DEL GUAMUEZ', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1084, 'VILLAGARZON', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1085, 'SAN ANDRES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1086, 'PROVIDENCIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1087, 'LETICIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1088, 'EL ENCANTO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1089, 'LA CHORRERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1090, 'LA PEDRERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1091, 'LA VICTORIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1092, 'MIRITI - PARANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1093, 'PUERTO ALEGRIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1094, 'PUERTO ARICA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1095, 'PUERTO NARIÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1096, 'PUERTO SANTANDER', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1097, 'TARAPACA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1098, 'INIRIDA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1099, 'BARRANCO MINAS', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1100, 'MAPIRIPANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1101, 'SAN FELIPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1102, 'PUERTO COLOMBIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1103, 'LA GUADALUPE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1104, 'CACAHUAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1105, 'PANA PANA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1106, 'MORICHAL', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1107, 'SAN JOSE DEL GUAVIARE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1108, 'CALAMAR', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1109, 'EL RETORNO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1110, 'MIRAFLORES', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1111, 'MITU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1112, 'CARURU', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1113, 'PACOA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1114, 'TARAIRA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1115, 'PAPUNAUA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1116, 'YAVARATE', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1117, 'PUERTO CARREÑO', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1118, 'LA PRIMAVERA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1119, 'SANTA ROSALIA', '2018-12-28 05:47:34', '2018-12-28 05:47:34'),
(1120, 'CUMARIBO', '2018-12-28 05:47:34', '2018-12-28 05:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `cupones_campanias`
--

CREATE TABLE `cupones_campanias` (
  `id` int(11) NOT NULL,
  `codigo_cupon` varchar(100) NOT NULL,
  `estado` enum('sin canjear','canjeado','canjeado_pagado') NOT NULL DEFAULT 'sin canjear',
  `fecha_canje` datetime DEFAULT NULL,
  `id_campania` int(10) UNSIGNED NOT NULL,
  `transaccion_donde_se_aplico` varchar(256) DEFAULT NULL,
  `monto_valor_redimido` decimal(10,2) DEFAULT NULL,
  `id_usuario_canje` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cupones_campanias`
--

INSERT INTO `cupones_campanias` (`id`, `codigo_cupon`, `estado`, `fecha_canje`, `id_campania`, `transaccion_donde_se_aplico`, `monto_valor_redimido`, `id_usuario_canje`, `created_at`, `updated_at`) VALUES
(401, '#MIPRIMERRECARGA20MILREGALO', 'canjeado_pagado', '2019-03-06 15:36:41', 14, 'rec_1551904515-15', '20000.00', 23, '2019-03-06 15:27:19', '2019-03-06 15:36:41'),
(402, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(403, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(404, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(405, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(406, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(407, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(408, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(409, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(410, '#MIPRIMERRECARGA20MILREGALO', 'sin canjear', NULL, 14, NULL, NULL, NULL, '2019-03-06 15:27:19', '2019-03-06 15:27:19'),
(411, '#MIPRIMERRECARGA20%REGALO', 'canjeado_pagado', '2019-03-06 15:47:31', 15, 'rec_1551905227-07', '20000.00', 23, '2019-03-06 15:28:07', '2019-03-06 15:48:22'),
(412, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(413, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(414, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(415, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(416, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(417, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(418, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(419, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(420, '#MIPRIMERRECARGA20%REGALO', 'sin canjear', NULL, 15, NULL, NULL, NULL, '2019-03-06 15:28:07', '2019-03-06 15:28:07'),
(421, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'canjeado', '2019-03-06 15:49:10', 16, 'rec_1551905308-28', '15000.00', 23, '2019-03-06 15:29:14', '2019-03-06 15:49:10'),
(422, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'canjeado_pagado', '2019-03-06 15:50:03', 16, 'rec_1551905395-92', '15000.00', 23, '2019-03-06 15:29:14', '2019-03-06 15:51:10'),
(423, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(424, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(425, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(426, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(427, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(428, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(429, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(430, '#MIPRIMERRECARGA15MILREGALOACUMULABLE', 'sin canjear', NULL, 16, NULL, NULL, NULL, '2019-03-06 15:29:14', '2019-03-06 15:29:14'),
(431, '#MIPRIMERCOMPRADEREGALO15MIL', 'canjeado_pagado', '2019-03-06 16:39:22', 17, 't15519036256-436-11', '65300.00', 22, '2019-03-06 15:30:09', '2019-03-06 16:39:22'),
(432, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(433, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(434, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(435, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(436, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(437, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(438, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(439, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(440, '#MIPRIMERCOMPRADEREGALO15MIL', 'sin canjear', NULL, 17, NULL, NULL, NULL, '2019-03-06 15:30:09', '2019-03-06 15:30:09'),
(441, '#COMPRACONEL50%DEDTO', 'canjeado', '2019-03-06 16:01:37', 18, 't15519036252-432-13', '50000.00', 22, '2019-03-06 15:30:50', '2019-03-06 16:01:37'),
(443, '#COMPRACONEL50%DEDTO', 'canjeado', '2019-03-07 12:38:39', 18, 't15519036256107-436-11', '65300.00', 26, '2019-03-06 15:30:50', '2019-03-07 12:38:39'),
(444, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(445, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(446, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(447, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(448, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(449, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(450, '#COMPRACONEL50%DEDTO', 'sin canjear', NULL, 18, NULL, NULL, NULL, '2019-03-06 15:30:50', '2019-03-06 15:30:50'),
(451, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:31', '2019-03-06 15:31:31'),
(452, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:31', '2019-03-06 15:31:31'),
(453, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:31', '2019-03-06 15:31:31'),
(454, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:31', '2019-03-06 15:31:31'),
(455, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:31', '2019-03-06 15:31:31'),
(456, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:32', '2019-03-06 15:31:32'),
(457, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:32', '2019-03-06 15:31:32'),
(458, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:32', '2019-03-06 15:31:32'),
(459, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:32', '2019-03-06 15:31:32'),
(460, '#COMPRAACUMULADA5%', 'sin canjear', NULL, 19, NULL, NULL, NULL, '2019-03-06 15:31:32', '2019-03-06 15:31:32'),
(461, 'TZ8CKN', 'sin canjear', NULL, 20, NULL, NULL, NULL, '2019-03-11 11:34:46', '2019-03-11 11:34:46'),
(462, 'BEN0ZS', 'sin canjear', NULL, 21, NULL, NULL, NULL, '2019-03-11 11:40:45', '2019-03-11 11:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_clic_anuncios`
--

CREATE TABLE `detalle_clic_anuncios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `costo` decimal(8,2) NOT NULL,
  `num_visitas` int(11) NOT NULL,
  `opinion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion` int(11) NOT NULL DEFAULT '0',
  `comentario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_clic_anuncios`
--

INSERT INTO `detalle_clic_anuncios` (`id`, `id_anuncio`, `id_usuario`, `costo`, `num_visitas`, `opinion`, `calificacion`, `comentario`, `created_at`, `updated_at`) VALUES
(140, 431, 22, '500.00', 13, NULL, 0, NULL, '2019-03-06 20:41:29', '2019-03-08 21:00:10'),
(141, 441, 22, '500.00', 1, NULL, 0, NULL, '2019-03-06 20:43:23', '2019-03-06 20:43:23'),
(142, 432, 22, '500.00', 3, NULL, 0, NULL, '2019-03-06 20:45:19', '2019-03-06 21:01:35'),
(143, 454, 22, '500.00', 5, NULL, 0, NULL, '2019-03-06 21:00:08', '2019-03-11 17:07:55'),
(144, 430, 22, '500.00', 1, NULL, 0, NULL, '2019-03-06 21:01:27', '2019-03-06 21:01:27'),
(145, 436, 22, '0.00', 1, NULL, 0, NULL, '2019-03-06 21:39:20', '2019-03-06 21:39:20'),
(146, 431, 26, '650.00', 3, NULL, 0, NULL, '2019-03-07 17:22:32', '2019-03-07 17:23:14'),
(147, 436, 26, '0.00', 15, NULL, 0, NULL, '2019-03-07 17:23:57', '2019-03-07 17:58:19'),
(148, 433, 22, '0.00', 1, NULL, 0, NULL, '2019-03-08 21:00:23', '2019-03-08 21:00:23'),
(149, 442, 22, '0.00', 1, NULL, 0, NULL, '2019-03-08 21:07:12', '2019-03-08 21:07:12'),
(150, 468, 23, '650.00', 1, NULL, 0, NULL, '2019-03-11 15:06:03', '2019-03-11 15:06:03'),
(151, 459, 23, '650.00', 7, NULL, 0, NULL, '2019-03-11 15:06:18', '2019-03-11 15:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_horarios`
--

CREATE TABLE `detalle_horarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `dia` enum('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `horario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '08:00|20:00',
  `estado` enum('Abierto','Cerrado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_horarios`
--

INSERT INTO `detalle_horarios` (`id`, `id_user`, `dia`, `horario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'LUNES', '12:00|00:00', 'Abierto', NULL, NULL),
(2, 1, 'MARTES', '12:00|00:00', 'Abierto', NULL, NULL),
(3, 1, 'MIERCOLES', '12:00|00:00', 'Abierto', NULL, NULL),
(4, 1, 'JUEVES', '12:00|00:00', 'Abierto', NULL, NULL),
(5, 1, 'VIERNES', '12:00|00:00', 'Abierto', NULL, NULL),
(6, 1, 'SABADO', '12:00|00:00', 'Abierto', NULL, NULL),
(7, 1, 'DOMINGO', '12:00|00:00', 'Abierto', NULL, NULL),
(8, 2, 'LUNES', '12:00|00:00', 'Abierto', NULL, NULL),
(9, 2, 'MARTES', '12:00|00:00', 'Abierto', NULL, NULL),
(10, 2, 'MIERCOLES', '12:00|00:00', 'Abierto', NULL, NULL),
(11, 2, 'JUEVES', '12:00|00:00', 'Abierto', NULL, NULL),
(12, 2, 'VIERNES', '12:00|00:00', 'Abierto', NULL, NULL),
(13, 2, 'SABADO', '12:00|00:00', 'Abierto', NULL, NULL),
(14, 2, 'DOMINGO', '12:00|00:00', 'Abierto', NULL, NULL),
(15, 3, 'LUNES', '12:00|00:00', 'Abierto', NULL, NULL),
(16, 3, 'MARTES', '12:00|00:00', 'Abierto', NULL, NULL),
(17, 3, 'MIERCOLES', '12:00|00:00', 'Abierto', NULL, NULL),
(18, 3, 'JUEVES', '12:00|00:00', 'Abierto', NULL, NULL),
(19, 3, 'VIERNES', '12:00|00:00', 'Abierto', NULL, NULL),
(20, 3, 'SABADO', '12:00|00:00', 'Abierto', NULL, NULL),
(21, 3, 'DOMINGO', '12:00|00:00', 'Abierto', NULL, NULL),
(127, 22, 'LUNES', '08:00|17:00', 'Abierto', NULL, NULL),
(128, 22, 'MARTES', '08:00|17:00', 'Abierto', NULL, NULL),
(129, 22, 'MIERCOLES', '08:00|17:00', 'Abierto', NULL, NULL),
(130, 22, 'JUEVES', '08:00|17:00', 'Abierto', NULL, NULL),
(131, 22, 'VIERNES', '08:00|17:00', 'Abierto', NULL, NULL),
(132, 22, 'SABADO', '08:00|17:00', 'Cerrado', NULL, NULL),
(133, 22, 'DOMINGO', '08:00|17:00', 'Cerrado', NULL, NULL),
(134, 23, 'LUNES', '08:00|17:00', 'Abierto', NULL, NULL),
(135, 23, 'MARTES', '08:00|17:00', 'Abierto', NULL, NULL),
(136, 23, 'MIERCOLES', '08:00|13:58', 'Cerrado', NULL, NULL),
(137, 23, 'JUEVES', '08:00|17:00', 'Abierto', NULL, NULL),
(138, 23, 'VIERNES', '08:00|17:00', 'Abierto', NULL, NULL),
(139, 23, 'SABADO', '08:00|17:00', 'Cerrado', NULL, NULL),
(140, 23, 'DOMINGO', '08:00|17:00', 'Cerrado', NULL, NULL),
(141, 24, 'LUNES', '08:00|17:00', 'Abierto', NULL, NULL),
(142, 24, 'MARTES', '08:00|17:00', 'Abierto', NULL, NULL),
(143, 24, 'MIERCOLES', '08:00|17:00', 'Abierto', NULL, NULL),
(144, 24, 'JUEVES', '08:00|17:00', 'Abierto', NULL, NULL),
(145, 24, 'VIERNES', '08:00|17:00', 'Abierto', NULL, NULL),
(146, 24, 'SABADO', '08:00|17:00', 'Cerrado', NULL, NULL),
(147, 24, 'DOMINGO', '08:00|17:00', 'Cerrado', NULL, NULL),
(148, 25, 'LUNES', '08:00|17:00', 'Abierto', NULL, NULL),
(149, 25, 'MARTES', '08:00|17:00', 'Abierto', NULL, NULL),
(150, 25, 'MIERCOLES', '08:00|17:00', 'Abierto', NULL, NULL),
(151, 25, 'JUEVES', '08:00|17:00', 'Abierto', NULL, NULL),
(152, 25, 'VIERNES', '08:00|17:00', 'Abierto', NULL, NULL),
(153, 25, 'SABADO', '08:00|17:00', 'Cerrado', NULL, NULL),
(154, 25, 'DOMINGO', '08:00|17:00', 'Cerrado', NULL, NULL),
(155, 26, 'LUNES', '08:00|17:00', 'Abierto', NULL, NULL),
(156, 26, 'MARTES', '08:00|17:00', 'Abierto', NULL, NULL),
(157, 26, 'MIERCOLES', '08:00|17:00', 'Abierto', NULL, NULL),
(158, 26, 'JUEVES', '08:00|17:00', 'Abierto', NULL, NULL),
(159, 26, 'VIERNES', '08:00|17:00', 'Abierto', NULL, NULL),
(160, 26, 'SABADO', '08:00|17:00', 'Cerrado', NULL, NULL),
(161, 26, 'DOMINGO', '08:00|17:00', 'Cerrado', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_recargas`
--

CREATE TABLE `detalle_recargas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `tipo_recarga` enum('BONIFICACION','RECARGA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor_recarga` decimal(8,2) NOT NULL,
  `valor_pagado` decimal(10,2) DEFAULT NULL,
  `referencia_pago` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia_pago_pay_u` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metodo_pago` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_detalle_recarga` enum('APROBADA','PENDIENTE','RECHAZADA','REGISTRADA','SIN REGISTRAR','EXPIRADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SIN REGISTRAR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_recargas`
--

INSERT INTO `detalle_recargas` (`id`, `id_usuario`, `tipo_recarga`, `valor_recarga`, `valor_pagado`, `referencia_pago`, `referencia_pago_pay_u`, `metodo_pago`, `estado_detalle_recarga`, `created_at`, `updated_at`) VALUES
(171, 1, 'BONIFICACION', '100.00', NULL, '155189119622', '155189119622', 'BONIFICACION REGISTRO REFERIDO ', 'APROBADA', NULL, NULL),
(172, 23, 'BONIFICACION', '100.00', NULL, '155189126324', '155189126324', 'BONIFICACION REGISTRO REFERIDO ', 'APROBADA', NULL, NULL),
(173, 23, 'BONIFICACION', '100.00', NULL, '155189231325', '155189231325', 'BONIFICACION REGISTRO REFERIDO ', 'APROBADA', NULL, NULL),
(174, 23, 'RECARGA', '20000.00', '16000.00', 'rec_1551905227-07', '222098991', 'BALOTO', 'APROBADA', NULL, '2019-03-06 20:48:22'),
(175, 23, 'RECARGA', '20000.00', NULL, '155190460123', '155190460123', 'RECARGA GRATIS', 'APROBADA', '2019-03-06 20:36:41', '2019-03-06 20:36:41'),
(176, 23, 'RECARGA', '50000.00', '35000.00', 'rec_1551905395-92', '222099514', 'BALOTO', 'APROBADA', NULL, '2019-03-06 20:51:10'),
(177, 22, 'RECARGA', '20000.00', '20000.00', 'rec_1552079026-46', '222657826', 'BALOTO', 'PENDIENTE', NULL, '2019-03-08 21:05:37'),
(178, 22, 'BONIFICACION', '100.00', NULL, '155197905226', '155197905226', 'BONIFICACION REGISTRO REFERIDO ', 'APROBADA', NULL, NULL),
(179, 26, 'RECARGA', '65300.00', '32650.00', 't15519036256107-436-11', NULL, NULL, 'SIN REGISTRAR', NULL, NULL),
(180, 22, 'RECARGA', '20000.00', '20000.00', 'rec_1552079269-49', '222658948', 'BALOTO', 'PENDIENTE', NULL, '2019-03-08 21:08:48'),
(181, 23, 'RECARGA', '20000.00', '20000.00', 'rec_1552082583-03', '222674333', 'BALOTO', 'APROBADA', NULL, '2019-03-08 22:04:48'),
(182, 23, 'RECARGA', '20000.00', '20000.00', 'rec_1552317748-28', '845418587', 'BALOTO', 'APROBADA', NULL, '2019-03-11 15:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_referidos`
--

CREATE TABLE `detalle_referidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_cabeza` int(11) NOT NULL,
  `id_referido` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detalle_referidos`
--

INSERT INTO `detalle_referidos` (`id`, `id_cabeza`, `id_referido`, `created_at`, `updated_at`) VALUES
(8, 1, 22, NULL, NULL),
(9, 23, 24, NULL, NULL),
(10, 23, 25, '2019-03-06 17:11:53', NULL),
(11, 22, 26, '2019-03-07 17:17:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(146, '2014_10_12_000000_create_users_table', 1),
(147, '2014_10_12_100000_create_password_resets_table', 1),
(148, '2018_11_23_013535_create_tramites_table', 1),
(149, '2018_11_23_013716_create_anuncios_table', 1),
(150, '2018_11_23_014009_detalle_anuncio_tramite', 1),
(151, '2018_11_23_014843_detalle_horario', 1),
(152, '2018_11_23_030848_create_payus_table', 1),
(153, '2018_11_23_031331_detalle_clic_anuncios', 1),
(154, '2018_11_23_031341_detalle_recargas', 1),
(155, '2018_11_23_031354_detalle_referidos', 1),
(156, '2018_11_23_031512_bonificaciones', 1),
(157, '2018_11_23_034237_registro_pagos_anuncios', 1),
(158, '2018_11_23_192752_create_permission_tables', 1),
(159, '2018_12_03_175300_create_apis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(1, 'App\\User', 2),
(3, 'App\\User', 3),
(2, 'App\\User', 22),
(2, 'App\\User', 23),
(3, 'App\\User', 24),
(3, 'App\\User', 25),
(2, 'App\\User', 26);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('adrian.vargas.2018@hotmail.com', '$2y$10$dz0OGr3YqO.bLWvzhMXj3uftkBnZe/G6v8cgBLzmUOxt.BNyTlWIe', '2019-01-10 18:46:51'),
('adrian.vargas.2018@outlook.com', '$2y$10$bvB2TgkjGjfrOm1G35jq9ejQROyVc33Ju9HfwGPurqhh6Ab42E0bW', '2019-03-06 17:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `payus`
--

CREATE TABLE `payus` (
  `id` int(10) UNSIGNED NOT NULL,
  `API_KEY` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchantId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlResponse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlConfirm` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlError` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlApi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_encrypt` enum('MD5','SHA1','SHA256') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SHA256',
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_contacto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('TEST','PRODUCTION') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payus`
--

INSERT INTO `payus` (`id`, `API_KEY`, `merchantId`, `accountId`, `urlResponse`, `urlConfirm`, `urlError`, `urlApi`, `type_encrypt`, `razon_social`, `nit`, `tel_contacto`, `type`, `created_at`, `updated_at`) VALUES
(1, '4Vj8eK4rloUd272L48hsrarnUA', '508029', '512321', '/response', '/confirm', '/error', 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu', 'MD5', 'Tu Tramitador', '1234567', '3015355602', 'TEST', '2018-12-13 15:12:00', '2018-12-13 15:12:00'),
(2, 'vS05fgTaH66DNm6hTbE0CCrqBO', '740783', '746361', '/response', '/confirm', '/error', 'https://checkout.payulatam.com/ppp-web-gateway-payu/', 'MD5', 'Tu Tramitador', '1234567', '3015355602', 'PRODUCTION', '2018-12-13 15:12:00', '2018-12-13 15:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Ver Usuarios', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(2, 'Crear Usuarios', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(3, 'Editar Usuarios', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(4, 'Eliminar Usuarios', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(5, 'Ver Roles', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(6, 'Crear Roles', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(7, 'Editar Roles', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(8, 'Eliminar Roles', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(9, 'Ver Permisos', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48'),
(10, 'Editar Permisos', 'web', '2018-08-09 09:02:48', '2018-08-09 09:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `registro_pagos_anuncios`
--

CREATE TABLE `registro_pagos_anuncios` (
  `id` int(10) UNSIGNED NOT NULL,
  `transactionId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionState` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transation_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `id_user_compra` int(11) NOT NULL,
  `metodo_pago` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_pago` enum('APROBADA','PENDIENTE','RECHAZADA','TRAMITE REALIZADO','PAGO A TRAMITADOR','TRANSACCION FINALIZADA','PAGO TRAMITADOR CONFIRMADO','EXPIRADA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `porcentaje_pago` decimal(10,2) DEFAULT NULL,
  `opinion` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `comentario` varchar(110) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registro_pagos_anuncios`
--

INSERT INTO `registro_pagos_anuncios` (`id`, `transactionId`, `transactionState`, `transation_value`, `id_anuncio`, `id_user_compra`, `metodo_pago`, `estado_pago`, `porcentaje_pago`, `opinion`, `calificacion`, `comentario`, `created_at`, `updated_at`) VALUES
(16, '222102119', '7', '25000.00', 432, 22, 'BALOTO', 'PAGO A TRAMITADOR', '5.00', 'Recomendadísimo', 5, 'Recomendadísimo', '2019-03-06 21:02:03', '2019-02-05 21:09:43'),
(17, '222111296', '7', '50300.00', 436, 22, 'BALOTO', 'PAGO TRAMITADOR CONFIRMADO', '5.00', 'Excelente atención', 5, 'Excelente atención', '2019-03-06 21:39:54', '2019-03-07 16:38:52'),
(18, '222312826', '7', '32650.00', 436, 26, 'BALOTO', 'PENDIENTE', NULL, NULL, NULL, NULL, '2019-03-07 17:49:06', '2019-03-07 17:49:06'),
(21, '222658641', '7', '98000.00', 442, 22, 'BALOTO', 'PENDIENTE', NULL, NULL, NULL, NULL, '2019-03-08 21:07:40', '2019-03-08 21:07:40'),
(22, '218245017', '4', '2300000.00', 39, 2, 'EFECTY', 'APROBADA', NULL, NULL, NULL, NULL, '2019-03-08 21:58:32', '2019-03-08 21:58:32'),
(23, '845418577', '7', '100000.00', 459, 23, 'BALOTO', 'APROBADA', NULL, NULL, NULL, NULL, '2019-03-11 15:07:02', '2019-03-11 15:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2018-12-13 15:11:59', '2018-12-13 15:11:59'),
(2, 'Anunciante', 'web', '2018-12-13 15:11:59', '2018-12-13 15:11:59'),
(3, 'Usuario', 'web', '2018-12-13 15:11:59', '2018-12-13 15:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tramites`
--

CREATE TABLE `tramites` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tramite` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tramites`
--

INSERT INTO `tramites` (`id`, `nombre_tramite`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Blindaje', 'Una breve descripcion del tramite', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(2, 'Desmonte de blindaje', 'Una breve descripcion del tramite', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(3, 'Cambio de color', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(4, 'Cambio de motor', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(5, 'Cambio de placa', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(6, 'Cambio de servicio', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(7, 'Cancelación de servicio', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(8, 'Cancelación de la matrícula', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(9, 'Cerfificado de libertad y tradición', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(10, 'Duplicado de placa', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(11, 'Duplicado de licencía de tránsito', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(12, 'Inscripción,levantamiento o modificación', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(13, 'Radicación de matrícula', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(14, 'Regrabación de motor', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(15, 'Regrabación de VIN', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(16, 'Regrabación de serial', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(17, 'Regrabación de chasis', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(18, 'Rematrícula', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(19, 'Traspaso propiedad', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(20, 'Matrícula', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(21, 'Traspaso propiedad persona indeterminada', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(22, 'Transformación (Cambio de caracteristicas)', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(23, 'Traslado matrícula', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53'),
(24, 'Pago de impuestos', '', '2018-11-27 14:51:53', '2018-11-27 14:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_referido` int(11) DEFAULT NULL,
  `valor_recarga` decimal(10,2) NOT NULL,
  `status_recarga` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo_clic` decimal(8,2) NOT NULL,
  `nota` int(11) NOT NULL,
  `num_calificaciones` int(11) NOT NULL DEFAULT '1',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ultima_recarga` date DEFAULT NULL,
  `cuenta_bancaria` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificacion_bancaria` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nombre`, `email`, `telefono`, `codigo_referido`, `valor_recarga`, `status_recarga`, `costo_clic`, `nota`, `num_calificaciones`, `password`, `fecha_ultima_recarga`, `cuenta_bancaria`, `certificacion_bancaria`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Edgar Guzman', 'edgar.guzman21@gmail.com', '3148790445', 3, '10100.00', 'ACTIVA', '0.00', 3, 1, '$2y$10$lcKQlMalKBAHYdmwVgrf3eRWBBIXmRWg0cHmW1PZz/odruILu/QVO', NULL, NULL, NULL, 'UOwACgEa3W8rRY4Q1SEQcw3bsSj7PRAXaWa5ytd6D7Ihx4n9O3T20p5ggdXi', '2018-12-13 15:12:02', '2019-03-06 21:37:21'),
(2, 'Soporte ', 'soporte@prismaweb.net', '3148790440', 4, '10000.00', 'ACTIVA', '0.00', 3, 1, '$2y$10$0VnT.r9vfspscqUDlej/8OT4HfazflJQ852T5MHWB4yfJt7y4UFRK', NULL, NULL, NULL, 'GUMfySlvpJyawL6oPa9L68wYfvrWCrddOUuWWZ1MUPBDd4Cv77kRWhc1HVbw', '2018-12-13 15:12:02', '2019-03-06 21:37:23'),
(3, 'Andrea Daniela Mojica', 'andreadmojica@gmail.com', '3002334392', 500, '0.00', 'ACTIVA', '0.00', 3, 1, '$2y$10$bCU3WW3/DXa5OMYT6LAZJ.weXb1TvSooovPC9ONMeQkZ9gQ9k22XG', NULL, NULL, NULL, NULL, '2019-02-25 01:33:46', '2019-03-06 21:37:25'),
(22, 'edgar gmail', 'edgar.devmohan@gmail.com', '3158790445', 501, '8700.00', 'ACTIVA', '650.00', 3, 1, '$2y$10$V0HpzGXzQtqep4oSUBk6AuYe/P2DkQUAy.s0d9ejx90x2RR.5m1qq', NULL, NULL, NULL, 'L78765jglwo69S5YYX8yR4P6s9MqrdaouQYJceSNAtQnEhAn7jGxx5CyszL8', '2019-03-06 16:53:16', '2019-03-11 15:06:32'),
(23, 'adrian outlook', 'adrian.vargas.2018@outlook.com', '3158790446', 502, '307050.00', 'ACTIVA', '650.00', 3, 1, '$2y$10$jZImGGFmoR7D2nJsrycHh.ffueGkSbaj1uBbc2OQOwcn3rPrhnnje', '2019-03-11', '021212121', '/archivos/23/certificacion_bancaria.pdf', 'l5fTj3tfktSFkOFXXoG0l3OuJAZMskycRC2pfNOlfbvnYr6IXYRYuejuuYPA', '2019-03-06 16:54:00', '2019-03-11 17:07:54'),
(24, 'edgar hotmail', 'adrian.vargas.2018@hotmail.com', '3158790448', 503, '0.00', 'ACTIVA', '650.00', 3, 1, '$2y$10$AA.zggvJFYyG0fPQgaMGYuluknlKVe90oy9JOJTTE0vHb14a/roQC', NULL, NULL, NULL, NULL, '2019-03-06 16:54:23', '2019-03-06 21:37:16'),
(25, 'edgar uandina', 'eguzman30@estudiantes.areandina.edu.co', '3158790449', 504, '0.00', 'ACTIVA', '650.00', 3, 1, '$2y$10$4Oq.ay7uK2KvQabSvUbkMuGH5QPmQoU9L7P871tckSXftG7SFqYMa', NULL, NULL, NULL, 'znoplh0vbbVBivt2abPPBTqEbp4p5AfKm98DMTLTugJd4poOCozabw6INBDE', '2019-03-06 17:11:52', '2019-03-06 21:37:16'),
(26, 'Edgar 2', 'notificaciones@tutramitador.com', '7323251', 505, '0.00', 'ACTIVA', '500.00', 3, 1, '$2y$10$MMC.CEwO0ojEufUYWoP8d.reb0MPIl7d.sigUNR8jHvlsyN4siNGe', NULL, NULL, NULL, 'w1WD473OUZcu2yDCzJEq6zY2KSHWCA2xAC70CktuBl93FumKCmZulA0xpflU', '2019-03-07 17:17:32', '2019-03-07 17:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `variables`
--

CREATE TABLE `variables` (
  `id` int(11) NOT NULL,
  `nombre` varchar(192) NOT NULL,
  `valor` varchar(192) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `variables`
--

INSERT INTO `variables` (`id`, `nombre`, `valor`, `created_at`, `updated_at`) VALUES
(1, 'porcentaje_tramite', '5', '2018-12-28 01:27:27', '2019-01-31 14:30:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indexes for table `apis`
--
ALTER TABLE `apis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonificaciones`
--
ALTER TABLE `bonificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanias`
--
ALTER TABLE `campanias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ciudads`
--
ALTER TABLE `ciudads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cupones_campanias`
--
ALTER TABLE `cupones_campanias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_campania` (`id_campania`);

--
-- Indexes for table `detalle_clic_anuncios`
--
ALTER TABLE `detalle_clic_anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_horarios`
--
ALTER TABLE `detalle_horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_recargas`
--
ALTER TABLE `detalle_recargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_referidos`
--
ALTER TABLE `detalle_referidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payus`
--
ALTER TABLE `payus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registro_pagos_anuncios`
--
ALTER TABLE `registro_pagos_anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tramites`
--
ALTER TABLE `tramites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telefono_unique` (`telefono`);

--
-- Indexes for table `variables`
--
ALTER TABLE `variables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;
--
-- AUTO_INCREMENT for table `apis`
--
ALTER TABLE `apis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bonificaciones`
--
ALTER TABLE `bonificaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `campanias`
--
ALTER TABLE `campanias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ciudads`
--
ALTER TABLE `ciudads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;
--
-- AUTO_INCREMENT for table `cupones_campanias`
--
ALTER TABLE `cupones_campanias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;
--
-- AUTO_INCREMENT for table `detalle_clic_anuncios`
--
ALTER TABLE `detalle_clic_anuncios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `detalle_horarios`
--
ALTER TABLE `detalle_horarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `detalle_recargas`
--
ALTER TABLE `detalle_recargas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT for table `detalle_referidos`
--
ALTER TABLE `detalle_referidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `payus`
--
ALTER TABLE `payus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `registro_pagos_anuncios`
--
ALTER TABLE `registro_pagos_anuncios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tramites`
--
ALTER TABLE `tramites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `variables`
--
ALTER TABLE `variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
ALTER TABLE `users` ADD `estado` ENUM('0','1') NOT NULL DEFAULT '1' AFTER `updated_at`; 