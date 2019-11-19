-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2019 at 01:06 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `villa_campestre`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `cat_nombre` varchar(100) NOT NULL,
  `cat_descripcion` longtext NOT NULL,
  `cat_fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `cat_nombre`, `cat_descripcion`, `cat_fecha_creacion`) VALUES
(4, 'Lubricantes', 'pa que entre derecho y rico0', '2019-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `control_turnos`
--

CREATE TABLE `control_turnos` (
  `id_control` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_inicial` int(11) NOT NULL,
  `factura_inicio` int(11) DEFAULT NULL,
  `factura_fin` int(11) DEFAULT NULL,
  `fecha_turno` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time DEFAULT NULL,
  `valor_total_cierre` bigint(20) DEFAULT NULL,
  `total_facturas_realizadas` int(11) DEFAULT NULL,
  `total_efectivo` bigint(20) NOT NULL DEFAULT 0,
  `total_credito` bigint(20) NOT NULL DEFAULT 0,
  `total_transferencia` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `control_turnos`
--

INSERT INTO `control_turnos` (`id_control`, `id_usuario`, `valor_inicial`, `factura_inicio`, `factura_fin`, `fecha_turno`, `hora_inicio`, `hora_fin`, `valor_total_cierre`, `total_facturas_realizadas`, `total_efectivo`, `total_credito`, `total_transferencia`) VALUES
(2, 1, 30000, 2, 2, '2019-10-05', '09:20:44', '09:29:31', 20000, 1, 20000, 0, 0),
(3, 1, 2000, 7, 7, '2019-10-06', '01:11:57', '01:19:24', 6783, 1, 6783, 0, 0),
(4, 1, 20000, 14, 14, '2019-10-09', '09:38:35', '10:15:10', 6783, 1, 6783, 0, 0),
(5, 1, 2130, 15, 16, '2019-10-21', '10:11:46', '11:05:03', 8783, 2, 6783, 0, 2000),
(6, 1, 2000, 23, 23, '2019-10-30', '05:45:45', '05:45:54', 42000, 1, 42000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cortesia`
--

CREATE TABLE `cortesia` (
  `cor_consecutivo` int(11) NOT NULL,
  `hab_numero` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cor_fecha_hora_ingreso` datetime NOT NULL,
  `cor_inicio_tiempo_parcial` varchar(20) DEFAULT NULL,
  `cor_fin_tiempo_parcial` varchar(20) DEFAULT NULL,
  `cor_numero_personas_adicionales` int(11) NOT NULL,
  `cor_habitacion_decorada` int(11) NOT NULL,
  `cor_hora_salida` datetime NOT NULL,
  `tipo_pago` varchar(20) NOT NULL,
  `tiempo_total` time NOT NULL,
  `valor_cortesia` int(11) NOT NULL,
  `cor_valor_efectivo` bigint(20) NOT NULL,
  `cor_valor_credito` bigint(20) NOT NULL,
  `cor_valor_transferencia` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cortesia`
--

INSERT INTO `cortesia` (`cor_consecutivo`, `hab_numero`, `id_usuario`, `cor_fecha_hora_ingreso`, `cor_inicio_tiempo_parcial`, `cor_fin_tiempo_parcial`, `cor_numero_personas_adicionales`, `cor_habitacion_decorada`, `cor_hora_salida`, `tipo_pago`, `tiempo_total`, `valor_cortesia`, `cor_valor_efectivo`, `cor_valor_credito`, `cor_valor_transferencia`) VALUES
(1, 1, 2, '2019-10-05 21:53:20', NULL, NULL, 0, 0, '2019-10-06 13:17:35', 'efectivo', '15:24:00', 1, 85000, 0, 0),
(2, 1, 2, '2019-10-05 21:53:20', NULL, NULL, 0, 0, '2019-10-06 13:18:46', 'efectivo', '15:25:00', 1, 85000, 0, 0),
(3, 1, 2, '2019-10-06 13:24:53', NULL, NULL, 0, 0, '2019-10-06 17:19:44', 'efectivo', '03:54:00', 1, 30000, 0, 0),
(4, 1, 2, '2019-10-06 17:21:57', NULL, NULL, 0, 0, '2019-10-06 17:22:31', 'credito', '00:00:34', 1, 0, 16783, 0),
(5, 1, 2, '2019-10-06 17:27:12', NULL, NULL, 0, 0, '2019-10-06 17:27:15', 'credito', '00:00:03', 1, 0, 16783, 0),
(6, 1, 2, '2019-10-06 17:27:27', NULL, NULL, 0, 0, '2019-10-06 17:27:31', 'credito', '00:00:04', 1, 0, 16783, 0),
(7, 1, 2, '2019-10-06 17:29:34', NULL, NULL, 0, 0, '2019-10-06 17:29:36', 'credito', '00:00:02', 1, 0, 16783, 0),
(8, 1, 2, '2019-10-06 17:30:03', NULL, NULL, 0, 0, '2019-10-06 17:30:14', 'efectivo', '00:00:11', 1, 6783, 0, 0),
(9, 1, 2, '2019-10-06 17:32:34', NULL, NULL, 0, 0, '2019-10-06 17:34:14', 'credito', '00:01:00', 1, 0, 6783, 0),
(10, 1, 2, '2019-10-06 17:35:27', NULL, NULL, 0, 0, '2019-10-06 17:35:30', 'credito', '00:00:03', 1, 0, 16783, 0),
(11, 1, 2, '2019-10-06 17:35:44', NULL, NULL, 0, 0, '2019-10-06 17:35:46', 'credito', '00:00:02', 1, 0, 16783, 0),
(12, 1, 2, '2019-10-06 17:36:03', NULL, NULL, 0, 0, '2019-10-06 17:36:05', 'credito', '00:00:02', 1, 0, 16783, 0),
(13, 1, 2, '2019-10-06 17:36:20', NULL, NULL, 0, 0, '2019-10-06 17:36:23', 'credito', '00:00:03', 1, 0, 16783, 0),
(14, 1, 2, '2019-10-06 17:36:47', NULL, NULL, 0, 0, '2019-10-06 17:36:48', 'credito', '00:00:01', 1, 0, 16783, 0),
(15, 1, 2, '2019-10-06 17:38:09', NULL, NULL, 0, 0, '2019-10-06 17:38:12', 'credito', '00:00:03', 1, 0, 16783, 0),
(16, 1, 2, '2019-10-06 17:38:35', NULL, NULL, 0, 0, '2019-10-06 17:38:37', 'credito', '00:00:02', 1, 0, 16783, 0),
(17, 1, 2, '2019-10-06 17:39:02', NULL, NULL, 0, 0, '2019-10-06 17:39:04', 'credito', '00:00:02', 1, 0, 16783, 0),
(18, 1, 2, '2019-10-06 17:39:15', NULL, NULL, 0, 0, '2019-10-06 17:39:17', 'credito', '00:00:02', 1, 0, 16783, 0),
(19, 1, 2, '2019-10-06 17:39:41', NULL, NULL, 0, 0, '2019-10-06 17:39:43', 'credito', '00:00:02', 1, 0, 16783, 0),
(20, 1, 2, '2019-10-06 17:39:58', NULL, NULL, 0, 0, '2019-10-06 17:40:00', 'credito', '00:00:02', 1, 0, 16783, 0),
(21, 1, 2, '2019-10-06 17:40:27', NULL, NULL, 0, 0, '2019-10-06 17:40:30', 'credito', '00:00:03', 1, 0, 16783, 0),
(22, 1, 2, '2019-10-06 17:41:27', NULL, NULL, 0, 0, '2019-10-06 17:41:28', 'credito', '00:00:01', 1, 0, 16783, 0),
(23, 1, 2, '2019-10-06 17:41:45', NULL, NULL, 0, 0, '2019-10-06 17:41:46', 'credito', '00:00:01', 1, 0, 16783, 0),
(24, 1, 2, '2019-10-06 17:42:23', NULL, NULL, 0, 0, '2019-10-06 17:42:26', 'credito', '00:00:03', 1, 0, 16783, 0),
(25, 1, 2, '2019-10-06 17:43:23', NULL, NULL, 0, 0, '2019-10-06 17:43:25', 'credito', '00:00:02', 1, 0, 16783, 0),
(26, 1, 2, '2019-10-07 09:20:57', NULL, NULL, 0, 0, '2019-10-07 09:21:14', 'credito', '00:00:17', 1, 0, 16783, 0),
(27, 1, 2, '2019-10-07 09:33:50', NULL, NULL, 0, 0, '2019-10-07 09:34:07', 'credito', '00:00:17', 1, 0, 16783, 0),
(28, 1, 2, '2019-10-07 09:35:08', NULL, NULL, 0, 0, '2019-10-07 09:35:09', 'credito', '00:00:01', 1, 0, 16783, 0),
(29, 1, 2, '2019-10-07 09:35:52', NULL, NULL, 0, 0, '2019-10-07 09:35:54', 'credito', '00:00:02', 1, 0, 16783, 0),
(30, 1, 2, '2019-10-07 09:36:46', NULL, NULL, 0, 0, '2019-10-07 09:36:49', 'credito', '00:00:03', 1, 0, 16783, 0),
(31, 1, 2, '2019-10-07 09:37:10', NULL, NULL, 0, 0, '2019-10-07 09:37:12', 'credito', '00:00:02', 1, 0, 16783, 0),
(32, 1, 2, '2019-10-07 09:38:16', NULL, NULL, 0, 0, '2019-10-07 09:38:17', 'credito', '00:00:01', 1, 0, 16783, 0),
(33, 1, 2, '2019-10-07 09:38:46', NULL, NULL, 0, 0, '2019-10-07 09:38:54', 'efectivo', '00:00:08', 1, 6783, 0, 0),
(34, 1, 2, '2019-10-07 09:39:41', NULL, NULL, 0, 0, '2019-10-07 09:39:49', 'efectivo', '00:00:08', 1, 6783, 0, 0),
(35, 2, 2, '2019-10-07 09:40:58', NULL, NULL, 0, 0, '2019-10-07 09:41:23', 'efectivo', '00:00:25', 2, 6783, 0, 0),
(36, 1, 2, '2019-10-08 17:54:02', NULL, NULL, 0, 0, '2019-10-08 19:47:05', 'credito', '01:53:00', 1, 0, 36783, 0),
(37, 1, 2, '2019-10-08 19:55:53', NULL, NULL, 0, 0, '2019-10-08 19:56:10', 'credito', '00:00:17', 1, 0, 16783, 0),
(38, 1, 2, '2019-10-08 19:57:21', NULL, NULL, 0, 0, '2019-10-08 19:57:23', 'credito', '00:00:02', 1, 0, 16783, 0),
(39, 1, 2, '2019-10-08 19:58:27', NULL, NULL, 0, 0, '2019-10-08 19:58:28', 'credito', '00:00:01', 1, 0, 16783, 0),
(40, 1, 2, '2019-10-08 19:59:11', NULL, NULL, 0, 0, '2019-10-08 19:59:20', 'efectivo', '00:00:09', 1, 6783, 0, 0),
(41, 1, 2, '2019-10-08 22:59:42', NULL, NULL, 0, 0, '2019-10-09 09:38:48', 'efectivo', '10:39:00', 1, 71783, 0, 0),
(42, 1, 1, '2019-10-09 09:45:14', NULL, NULL, 0, 0, '2019-10-09 09:45:19', 'efectivo', '00:00:05', 1, 6783, 0, 0),
(43, 1, 1, '2019-10-09 09:25:59', '2019-10-21 09:56:10', NULL, 0, 0, '2019-10-21 10:32:44', 'efectivo', '288:30:00', 1, 0, 0, 0),
(44, 4, 2, '2019-10-30 14:58:28', NULL, NULL, 0, 0, '2019-10-30 15:00:30', 'efectivo', '00:02:00', 1, 6783, 0, 0),
(45, 4, 2, '2019-10-30 15:22:31', NULL, NULL, 0, 0, '2019-10-30 15:22:49', 'efectivo', '00:00:18', 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_cortesia`
--

CREATE TABLE `detalle_cortesia` (
  `id_detalle` int(11) NOT NULL,
  `cor_consecutivo` int(11) NOT NULL,
  `det_cor_id_producto` int(11) NOT NULL,
  `det_cor_cantidad` int(11) NOT NULL,
  `det_cor_precio_compra` bigint(20) NOT NULL,
  `det_cor_valor_unidad` bigint(20) NOT NULL,
  `det_cor_valor_total` bigint(20) NOT NULL,
  `det_cor_fecha_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_cortesia`
--

INSERT INTO `detalle_cortesia` (`id_detalle`, `cor_consecutivo`, `det_cor_id_producto`, `det_cor_cantidad`, `det_cor_precio_compra`, `det_cor_valor_unidad`, `det_cor_valor_total`, `det_cor_fecha_venta`) VALUES
(1, 4, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(2, 4, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(3, 5, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(4, 5, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(5, 6, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(6, 6, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(7, 7, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(8, 7, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(9, 8, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(10, 9, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(11, 10, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(12, 10, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(13, 11, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(14, 11, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(15, 12, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(16, 12, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(17, 13, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(18, 13, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(19, 14, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(20, 14, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(21, 15, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(22, 15, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(23, 16, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(24, 16, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(25, 17, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(26, 17, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(27, 18, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(28, 18, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(29, 19, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(30, 19, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(31, 20, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(32, 20, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(33, 21, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(34, 21, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(35, 22, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(36, 22, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(37, 23, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(38, 23, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(39, 24, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(40, 24, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(41, 25, 15, 1, 7667, 6783, 6783, '2019-10-06'),
(42, 25, 16, 5, 20000, 2000, 10000, '2019-10-06'),
(43, 26, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(44, 26, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(45, 27, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(46, 27, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(47, 28, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(48, 28, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(49, 29, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(50, 29, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(51, 30, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(52, 30, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(53, 31, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(54, 31, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(55, 32, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(56, 32, 16, 5, 20000, 2000, 10000, '2019-10-07'),
(57, 33, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(58, 34, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(59, 35, 15, 1, 7667, 6783, 6783, '2019-10-07'),
(60, 36, 15, 1, 7667, 6783, 6783, '2019-10-08'),
(61, 36, 16, 5, 20000, 2000, 10000, '2019-10-08'),
(62, 37, 15, 1, 7667, 6783, 6783, '2019-10-08'),
(63, 37, 16, 5, 20000, 2000, 10000, '2019-10-08'),
(64, 38, 15, 1, 7667, 6783, 6783, '2019-10-08'),
(65, 38, 16, 5, 20000, 2000, 10000, '2019-10-08'),
(66, 39, 15, 1, 7667, 6783, 6783, '2019-10-08'),
(67, 39, 16, 5, 20000, 2000, 10000, '2019-10-08'),
(68, 40, 15, 1, 7667, 6783, 6783, '2019-10-08'),
(69, 41, 15, 1, 7667, 6783, 6783, '2019-10-09'),
(70, 42, 15, 1, 7667, 6783, 6783, '2019-10-09'),
(71, 44, 15, 1, 7667, 6783, 6783, '2019-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `fac_consecutivo` int(11) NOT NULL,
  `det_id_producto` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_pro_precio_compra` bigint(20) NOT NULL,
  `det_valor_unidad` bigint(20) NOT NULL,
  `det_valor_total` bigint(20) NOT NULL,
  `det_fecha_venta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `fac_consecutivo`, `det_id_producto`, `det_cantidad`, `det_pro_precio_compra`, `det_valor_unidad`, `det_valor_total`, `det_fecha_venta`) VALUES
(109, 2, 15, 1, 7667, 6783, 6783, '2019-10-05 21:16:48'),
(110, 4, 15, 1, 7667, 6783, 6783, '2019-10-06 13:12:09'),
(111, 4, 16, 1, 20000, 2000, 2000, '2019-10-06 13:12:09'),
(112, 7, 15, 1, 7667, 6783, 6783, '2019-10-06 13:19:21'),
(113, 10, 15, 1, 7667, 6783, 6783, '2019-10-07 09:22:42'),
(114, 11, 16, 1, 20000, 2000, 2000, '2019-10-08 19:44:39'),
(115, 12, 15, 1, 7667, 6783, 6783, '2019-10-08 19:51:53'),
(116, 13, 15, 1, 7667, 6783, 6783, '2019-10-08 19:59:41'),
(117, 14, 15, 1, 7667, 6783, 6783, '2019-10-09 09:39:17'),
(118, 15, 15, 1, 7667, 6783, 6783, '2019-10-21 10:33:06'),
(119, 16, 16, 1, 20000, 2000, 2000, '2019-10-21 11:05:00'),
(120, 17, 15, 1, 7667, 6783, 6783, '2019-10-30 13:48:24'),
(121, 18, 15, 1, 7667, 6783, 6783, '2019-10-30 14:28:54'),
(122, 19, 15, 1, 7667, 6783, 6783, '2019-10-30 14:52:02'),
(123, 22, 15, 1, 7667, 6783, 6783, '2019-10-30 15:39:42'),
(124, 23, 16, 1, 20000, 2000, 2000, '2019-10-30 17:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_movimiento`
--

CREATE TABLE `detalle_movimiento` (
  `id_det_mov` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `det_mov_cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `det_mov_cantidad_actual` int(11) NOT NULL,
  `det_mov_cantidad_nueva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estado_reserva`
--

CREATE TABLE `estado_reserva` (
  `sr_estado_reserva` int(11) NOT NULL,
  `sr_nombre` varchar(50) NOT NULL,
  `sr_descripcion` longtext NOT NULL,
  `sr_color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estado_reserva`
--

INSERT INTO `estado_reserva` (`sr_estado_reserva`, `sr_nombre`, `sr_descripcion`, `sr_color`) VALUES
(1, 'Disponible', 'Esta disponible', '#28a745'),
(2, 'Reservada', '', '#ffc107'),
(3, 'Tiempo Parcial', '', '#dc3545'),
(4, 'Cortesia', '', '#6f42c1'),
(5, 'Promoción', '', '#343a40'),
(6, 'Limpieza', '', '#17a2b8');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `fac_consecutivo` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `hab_numero` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `fac_fecha_hora_ingreso` datetime NOT NULL,
  `fac_inicio_tiempo_parcial` varchar(70) DEFAULT NULL,
  `fac_fin_tiempo_parcial` varchar(70) DEFAULT NULL,
  `fac_numero_personas_adicionales` int(11) NOT NULL,
  `fac_habitacion_decorada` int(1) NOT NULL,
  `fac_hora_salida` datetime NOT NULL,
  `tipo_pago` varchar(20) NOT NULL,
  `tiempo_total` time NOT NULL,
  `valor_factura` bigint(20) NOT NULL,
  `tipo_reserva` int(11) NOT NULL,
  `fac_valor_efectivo` bigint(20) NOT NULL,
  `fac_valor_credito` bigint(20) NOT NULL,
  `fac_valor_transferencia` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`fac_consecutivo`, `id_reserva`, `hab_numero`, `id_usuario`, `promo_id`, `fac_fecha_hora_ingreso`, `fac_inicio_tiempo_parcial`, `fac_fin_tiempo_parcial`, `fac_numero_personas_adicionales`, `fac_habitacion_decorada`, `fac_hora_salida`, `tipo_pago`, `tiempo_total`, `valor_factura`, `tipo_reserva`, `fac_valor_efectivo`, `fac_valor_credito`, `fac_valor_transferencia`) VALUES
(1, 10, 1, 2, NULL, '2019-10-05 21:06:09', NULL, NULL, 0, 0, '2019-10-05 21:14:26', 'efectivo', '00:08:00', 20000, 2, 20000, 0, 0),
(2, 11, 2, 1, NULL, '2019-10-05 21:16:32', NULL, NULL, 0, 0, '2019-10-05 21:16:48', 'efectivo', '00:00:16', 6783, 2, 20000, 0, 0),
(3, 12, 2, 1, NULL, '2019-10-05 21:35:31', NULL, NULL, 0, 1, '2019-10-05 21:46:59', 'efectivo', '00:11:00', 110000, 2, 110000, 0, 0),
(4, 14, 2, 2, NULL, '2019-10-06 13:06:20', NULL, NULL, 0, 0, '2019-10-06 13:12:09', 'efectivo', '00:05:00', 28783, 2, 28783, 0, 0),
(5, 15, 4, 2, NULL, '2019-10-06 13:06:48', NULL, NULL, 0, 1, '2019-10-06 13:13:07', 'efectivo', '00:06:00', 110000, 2, 110000, 0, 0),
(6, 4, 3, 2, 1, '2019-10-05 20:28:14', NULL, NULL, 0, 0, '2019-10-06 13:15:55', 'efectivo', '16:47:00', 290000, 5, 290000, 0, 0),
(7, 16, 1, 1, NULL, '2019-10-06 13:19:17', NULL, NULL, 0, 0, '2019-10-06 13:19:21', 'efectivo', '00:00:04', 6783, 2, 6783, 0, 0),
(8, 17, 2, 2, NULL, '2019-10-06 13:24:40', NULL, NULL, 0, 0, '2019-10-06 17:20:01', 'efectivo', '03:55:00', 35000, 2, 35000, 0, 0),
(9, 20, 4, 2, 1, '2019-10-06 13:25:04', NULL, NULL, 2, 0, '2019-10-06 17:20:15', 'efectivo', '03:55:00', 50000, 5, 50000, 0, 0),
(10, 44, 2, 2, NULL, '2019-10-07 09:22:31', NULL, NULL, 0, 0, '2019-10-07 09:22:42', 'credito', '00:00:11', 6783, 2, 0, 6783, 0),
(11, 18, 2, 2, NULL, '2019-10-08 17:40:31', NULL, NULL, 0, 0, '2019-10-08 19:44:39', 'efectivo', '02:04:00', 27500, 2, 27500, 0, 0),
(12, 54, 4, 2, NULL, '2019-10-08 17:44:38', NULL, NULL, 0, 0, '2019-10-08 19:51:53', 'efectivo', '02:07:00', 32283, 2, 32283, 0, 0),
(13, 60, 2, 2, NULL, '2019-10-08 19:59:34', NULL, NULL, 0, 0, '2019-10-08 19:59:41', 'efectivo', '00:00:07', 6783, 2, 6783, 0, 0),
(14, 62, 2, 1, NULL, '2019-10-09 09:39:11', NULL, NULL, 0, 0, '2019-10-09 09:39:17', 'efectivo', '00:00:06', 6783, 2, 6783, 0, 0),
(15, 66, 3, 1, NULL, '2019-10-21 10:33:01', NULL, NULL, 0, 0, '2019-10-21 10:33:06', 'efectivo', '00:00:05', 6783, 2, 6783, 0, 0),
(16, 67, 1, 1, NULL, '2019-10-21 11:04:50', NULL, NULL, 0, 0, '2019-10-21 11:05:00', 'transferencia', '00:00:10', 2000, 2, 0, 0, 2000),
(17, 68, 1, 2, NULL, '2019-10-30 13:48:18', NULL, NULL, 0, 0, '2019-10-30 13:48:24', 'efectivo', '00:00:06', 6783, 2, 6783, 0, 0),
(18, 69, 1, 2, NULL, '2019-10-30 13:52:22', NULL, NULL, 0, 0, '2019-10-30 14:28:54', 'efectivo', '00:36:00', 26783, 2, 26783, 0, 0),
(19, 71, 3, 2, NULL, '2019-10-30 14:51:57', NULL, NULL, 0, 0, '2019-10-30 14:52:02', 'efectivo', '00:00:05', 6783, 2, 6783, 0, 0),
(20, 75, 4, 2, NULL, '2019-10-30 15:06:16', '2019-10-30 15:16:07', '2019-10-30 15:16:12', 0, 0, '2019-10-30 15:22:24', 'efectivo', '00:15:55', 20000, 2, 20000, 0, 0),
(21, 78, 4, 2, NULL, '2019-10-30 15:35:01', NULL, NULL, 0, 0, '2019-10-30 15:38:13', 'efectivo', '00:03:00', 0, 2, 0, 0, 0),
(22, 79, 4, 2, NULL, '2019-10-30 15:38:27', '2019-10-30 15:38:34', '2019-10-30 15:38:38', 0, 0, '2019-10-30 15:39:42', 'efectivo', '00:00:56', 6783, 2, 6783, 0, 0),
(23, 70, 1, 1, NULL, '2019-10-30 14:31:23', NULL, NULL, 1, 0, '2019-10-30 17:45:52', 'efectivo', '03:14:00', 42000, 2, 42000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `habitacion`
--

CREATE TABLE `habitacion` (
  `hab_numero` int(11) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL,
  `hab_detalle` longtext NOT NULL,
  `sr_estado_reserva` int(11) NOT NULL,
  `hab_fecha_creacion` date NOT NULL,
  `hab_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `habitacion`
--

INSERT INTO `habitacion` (`hab_numero`, `id_tipo_habitacion`, `hab_detalle`, `sr_estado_reserva`, `hab_fecha_creacion`, `hab_estado`) VALUES
(1, 1, 'nada', 1, '0000-00-00', 1),
(2, 1, 'sad', 4, '2019-09-08', 1),
(3, 1, '221', 2, '2019-09-08', 1),
(4, 1, '', 5, '2019-10-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `historial_proceso`
--

CREATE TABLE `historial_proceso` (
  `id_historial` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `procentaje_ingresado` varchar(50) NOT NULL,
  `valor_debia_eliminar` varchar(50) NOT NULL,
  `valor_eliminado` varchar(50) NOT NULL,
  `facturas_eliminadas` mediumtext NOT NULL,
  `facturas_reorganizadas` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mov_fecha` date NOT NULL,
  `mov_tipo` varchar(20) NOT NULL,
  `mov_observaciones` longtext NOT NULL,
  `mov_fecha_realizacion` date NOT NULL,
  `total` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `pro_codigo` varchar(50) NOT NULL,
  `pro_nombre` varchar(100) NOT NULL,
  `pro_precio_compra` bigint(11) NOT NULL,
  `pro_precio_venta` bigint(20) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `pro_imagen` varchar(200) NOT NULL,
  `pro_cantidad_disponible` int(11) NOT NULL,
  `pro_fecha_ultima_modificacion` date NOT NULL,
  `pro_fecha_creacion` date NOT NULL,
  `pro_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id_producto`, `pro_codigo`, `pro_nombre`, `pro_precio_compra`, `pro_precio_venta`, `id_categoria`, `id_proveedor`, `pro_imagen`, `pro_cantidad_disponible`, `pro_fecha_ultima_modificacion`, `pro_fecha_creacion`, `pro_estado`) VALUES
(15, '78692', '876832', 7667, 6783, 4, 4, '3d15e4d092aaf3fc3af0ffc672285bc0.png', -46, '2019-10-04', '2019-10-03', 1),
(16, 'CODD-0001', 'EJEMPLO', 20000, 2000, 4, 4, '556a2f5311d96723404a18e826762205.png', -149, '2019-10-05', '2019-10-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `promo_nombre` varchar(80) NOT NULL,
  `promo_tiempo` time NOT NULL,
  `promo_valor` bigint(20) NOT NULL,
  `promo_fecha_registro` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `promo_estado` int(1) NOT NULL,
  `promo_color` varchar(20) NOT NULL DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `promo_nombre`, `promo_tiempo`, `promo_valor`, `promo_fecha_registro`, `id_usuario`, `promo_estado`, `promo_color`) VALUES
(1, '3x1', '03:00:00', 30000, '2019-09-05', 2, 1, '#4104b5');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `pr_nit` varchar(15) NOT NULL,
  `pr_nombre` varchar(100) NOT NULL,
  `pr_razon_social` varchar(100) NOT NULL,
  `pr_telefono` bigint(20) NOT NULL,
  `pr_direccion` varchar(60) NOT NULL,
  `pr_email` varchar(100) NOT NULL,
  `pr_numero_cuenta` varchar(50) NOT NULL,
  `pr_tipo_cuenta` varchar(30) NOT NULL,
  `pr_banco` varchar(70) NOT NULL,
  `nombre_contacto` varchar(100) NOT NULL,
  `pr_ultimo_aprovisionamiento` date NOT NULL,
  `pr_fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `pr_nit`, `pr_nombre`, `pr_razon_social`, `pr_telefono`, `pr_direccion`, `pr_email`, `pr_numero_cuenta`, `pr_tipo_cuenta`, `pr_banco`, `nombre_contacto`, `pr_ultimo_aprovisionamiento`, `pr_fecha_registro`) VALUES
(4, '78778782-1', 'Condoncito felizx', 'Dale Dale!!!', 32338889, 'calle 95', 'sinhijos@hotmail.com', '8000222222', 'Ahorros', 'BBVA', 'Javier', '2019-09-12', '2019-09-12');

-- --------------------------------------------------------

--
-- Table structure for table `reservas_anuladas`
--

CREATE TABLE `reservas_anuladas` (
  `id_anulacion` int(11) NOT NULL,
  `hab_numero` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `ranula_fecha_hora_ingreso` datetime NOT NULL,
  `ranula_habitacion_decorada` int(1) NOT NULL,
  `ranula_motivo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservas_anuladas`
--

INSERT INTO `reservas_anuladas` (`id_anulacion`, `hab_numero`, `id_usuario`, `promo_id`, `ranula_fecha_hora_ingreso`, `ranula_habitacion_decorada`, `ranula_motivo`) VALUES
(1, 4, 2, NULL, '2019-10-05 20:54:28', 0, 'Por que la vida es dura Puta vida'),
(2, 4, 2, NULL, '2019-10-05 20:58:10', 0, 'Por que quiero y puedo'),
(3, 4, 2, 1, '2019-10-30 15:01:30', 0, 'N/A'),
(4, 4, 2, NULL, '2019-10-30 15:23:03', 0, 'N/A'),
(5, 4, 2, NULL, '2019-10-30 15:39:59', 0, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `reserva_activa`
--

CREATE TABLE `reserva_activa` (
  `id_reserva` int(11) NOT NULL,
  `hab_numero` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `ra_fecha_hora_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
  `ra_inicio_tiempo_parcial` datetime DEFAULT NULL,
  `ra_fin_tiempo_parcial` datetime DEFAULT NULL,
  `ra_numero_personas_adicionales` int(11) NOT NULL,
  `ra_habitacion_decorada` int(1) NOT NULL,
  `ra_tipo_reserva_inicio` int(11) NOT NULL,
  `ra_tipo_cortesia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserva_activa`
--

INSERT INTO `reserva_activa` (`id_reserva`, `hab_numero`, `id_usuario`, `promo_id`, `ra_fecha_hora_ingreso`, `ra_inicio_tiempo_parcial`, `ra_fin_tiempo_parcial`, `ra_numero_personas_adicionales`, `ra_habitacion_decorada`, `ra_tipo_reserva_inicio`, `ra_tipo_cortesia`) VALUES
(65, 2, 2, NULL, '2019-10-18 18:30:50', '2019-10-18 18:30:52', NULL, 0, 0, 2, NULL),
(72, 3, 2, NULL, '2019-10-30 14:55:28', NULL, NULL, 0, 1, 2, NULL),
(81, 4, 2, 1, '2019-10-30 15:50:54', NULL, NULL, 0, 0, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reserva_activa_detalle`
--

CREATE TABLE `reserva_activa_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `re_det_id_producto` int(11) NOT NULL,
  `re_det_cantidad` bigint(20) NOT NULL,
  `re_precio_compra` bigint(20) NOT NULL,
  `re_det_valor_unidad` bigint(20) NOT NULL,
  `re_det_valor_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserva_activa_detalle`
--

INSERT INTO `reserva_activa_detalle` (`id_detalle`, `id_reserva`, `re_det_id_producto`, `re_det_cantidad`, `re_precio_compra`, `re_det_valor_unidad`, `re_det_valor_total`) VALUES
(85, 65, 15, 1, 7667, 6783, 6783),
(94, 72, 15, 3, 7667, 6783, 20349);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(50) NOT NULL,
  `rol_descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rol_descripcion`) VALUES
(1, 'administrador', 'admin'),
(2, 'empleado', 'caja');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id_tipo_habitacion` int(11) NOT NULL,
  `th_nombre_tipo` varchar(50) NOT NULL,
  `th_descripcion` longtext NOT NULL,
  `th_valor_hora_despues24` bigint(20) NOT NULL,
  `th_valor_persona_adicional` bigint(20) NOT NULL,
  `th_estado` int(1) NOT NULL,
  `th_fecha_creacion` date NOT NULL,
  `th_valor_hora1` bigint(20) NOT NULL,
  `th_valor_hora2` bigint(20) NOT NULL,
  `th_valor_hora3` bigint(20) NOT NULL,
  `th_valor_hora4` bigint(20) NOT NULL,
  `th_valor_hora5` bigint(20) NOT NULL,
  `th_valor_hora6` bigint(20) NOT NULL,
  `th_valor_hora7` bigint(20) NOT NULL,
  `th_valor_hora8` bigint(20) NOT NULL,
  `th_valor_hora9` bigint(20) NOT NULL,
  `th_valor_hora10` bigint(20) NOT NULL,
  `th_valor_hora11` bigint(20) NOT NULL,
  `th_valor_hora12` bigint(20) NOT NULL,
  `th_valor_hora13` bigint(20) NOT NULL,
  `th_valor_hora14` bigint(20) NOT NULL,
  `th_valor_hora15` bigint(20) NOT NULL,
  `th_valor_hora16` bigint(20) NOT NULL,
  `th_valor_hora17` bigint(20) NOT NULL,
  `th_valor_hora18` bigint(20) NOT NULL,
  `th_valor_hora19` bigint(20) NOT NULL,
  `th_valor_hora20` bigint(20) NOT NULL,
  `th_valor_hora21` bigint(20) NOT NULL,
  `th_valor_hora22` bigint(20) NOT NULL,
  `th_valor_hora23` bigint(20) NOT NULL,
  `th_valor_hora24` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id_tipo_habitacion`, `th_nombre_tipo`, `th_descripcion`, `th_valor_hora_despues24`, `th_valor_persona_adicional`, `th_estado`, `th_fecha_creacion`, `th_valor_hora1`, `th_valor_hora2`, `th_valor_hora3`, `th_valor_hora4`, `th_valor_hora5`, `th_valor_hora6`, `th_valor_hora7`, `th_valor_hora8`, `th_valor_hora9`, `th_valor_hora10`, `th_valor_hora11`, `th_valor_hora12`, `th_valor_hora13`, `th_valor_hora14`, `th_valor_hora15`, `th_valor_hora16`, `th_valor_hora17`, `th_valor_hora18`, `th_valor_hora19`, `th_valor_hora20`, `th_valor_hora21`, `th_valor_hora22`, `th_valor_hora23`, `th_valor_hora24`) VALUES
(1, 'Premium', 'Cama doble para tiki tiki', 20000, 10000, 1, '2019-09-07', 20000, 25500, 30000, 35000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 110000, 115000, 120000, 125000, 130000, 135000, 140000),
(2, 'ljh', 'kjh', 20000, 789, 1, '2019-10-03', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(3, '234lnjkhg', 'ghjk', 20000, 43, 1, '2019-10-03', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(4, 'nadasd', 'dada,ada', 20000, 3245, 1, '2019-10-05', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(5, 'Hola', 'tv,jacussi,hola,nada,todo', 20000, 3245, 1, '2019-10-05', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(6, '3242', '32423', 20000, 234, 1, '2019-10-05', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(7, '2321321', 'holaaa,nnn,aaqa', 20000, 123120, 1, '2019-10-05', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000),
(8, 'nueva', 'tv,bb,vv', 20000, 20000, 1, '2019-10-06', 20000, 25000, 30000, 35000, 40000, 45000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 105000, 110000, 115000, 120000, 125000);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nombres` varchar(100) NOT NULL,
  `usu_apellidos` varchar(100) NOT NULL,
  `usu_numero_documento` bigint(20) NOT NULL,
  `usu_fecha_nacimiento` date NOT NULL,
  `usu_numero_contacto` bigint(20) NOT NULL,
  `usu_correo` varchar(100) NOT NULL,
  `usu_nombre_login` varchar(70) NOT NULL,
  `usu_rol` int(11) NOT NULL,
  `usu_contrasena` varchar(250) NOT NULL,
  `usu_fecha_creacion` date NOT NULL,
  `usu_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombres`, `usu_apellidos`, `usu_numero_documento`, `usu_fecha_nacimiento`, `usu_numero_contacto`, `usu_correo`, `usu_nombre_login`, `usu_rol`, `usu_contrasena`, `usu_fecha_creacion`, `usu_estado`) VALUES
(1, 'Caja', 'Caja', 0, '2019-09-14', 0, '0', 'caja', 2, '$2y$10$rvr2xtuecn1WfoIew5fbLefP6nxQBhNCKdgBfWE7occUsqSVRra0u', '2019-09-14', 1),
(2, 'Cristian Alexis', 'Lopera Bedoya', 1214746318, '1999-04-20', 3233557660, 'cristian1020011@gmail.com', 'admin', 1, '$2y$10$rvr2xtuecn1WfoIew5fbLefP6nxQBhNCKdgBfWE7occUsqSVRra0u', '2019-09-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `villa_config`
--

CREATE TABLE `villa_config` (
  `id_conf` int(11) NOT NULL,
  `conf_iva` int(11) NOT NULL,
  `conf_minutos_cortesia` int(11) NOT NULL,
  `conf_precio_decoracion` bigint(20) NOT NULL,
  `minutos_contar_hora` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villa_config`
--

INSERT INTO `villa_config` (`id_conf`, `conf_iva`, `conf_minutos_cortesia`, `conf_precio_decoracion`, `minutos_contar_hora`, `id_usuario`) VALUES
(1, 19, 2, 90000, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `villa_conf_facturas`
--

CREATE TABLE `villa_conf_facturas` (
  `conf_id_fac` int(11) NOT NULL,
  `conf_resolucion` varchar(100) NOT NULL,
  `conf_razon_social` varchar(200) NOT NULL,
  `conf_nombre_empresa` varchar(100) NOT NULL,
  `conf_nit` varchar(50) NOT NULL,
  `conf_direccion` varchar(70) NOT NULL,
  `conf_telefono` varchar(20) NOT NULL,
  `conf_ciudad` varchar(30) NOT NULL,
  `conf_fecha_inicio` date NOT NULL,
  `conf_fecha_fin` date NOT NULL,
  `conf_rango_inicio` varchar(20) NOT NULL,
  `conf_rango_fin` varchar(20) NOT NULL,
  `conf_mensaje` varchar(150) NOT NULL,
  `conf_logo` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villa_conf_facturas`
--

INSERT INTO `villa_conf_facturas` (`conf_id_fac`, `conf_resolucion`, `conf_razon_social`, `conf_nombre_empresa`, `conf_nit`, `conf_direccion`, `conf_telefono`, `conf_ciudad`, `conf_fecha_inicio`, `conf_fecha_fin`, `conf_rango_inicio`, `conf_rango_fin`, `conf_mensaje`, `conf_logo`, `id_usuario`) VALUES
(1, '1876201208237', 'APARTA HOTEL VILLA CAMPESTRE', 'INVESTMENTS GROUP S.A.S', '901233749-6', 'CARRETERA LA CORDIALIDAD N0 22-72', '(095)6632106', 'Cartagena, Bolivar (Colombia)', '2018-12-31', '2018-12-31', '000001', 'VC 200000', 'MUCHAS GRACIAS POR SU VISITA.', '930a77b34acfddeb24c47eeb2d92ff54.JPG', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `control_turnos`
--
ALTER TABLE `control_turnos`
  ADD PRIMARY KEY (`id_control`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `cortesia`
--
ALTER TABLE `cortesia`
  ADD PRIMARY KEY (`cor_consecutivo`),
  ADD KEY `hab_numero` (`hab_numero`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `hab_numero_2` (`hab_numero`),
  ADD KEY `id_usuario_2` (`id_usuario`);

--
-- Indexes for table `detalle_cortesia`
--
ALTER TABLE `detalle_cortesia`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `cor_consecutivo` (`cor_consecutivo`),
  ADD KEY `det_cor_id_producto` (`det_cor_id_producto`);

--
-- Indexes for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fac_consecutivo` (`fac_consecutivo`),
  ADD KEY `det_id_producto` (`det_id_producto`);

--
-- Indexes for table `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD PRIMARY KEY (`id_det_mov`),
  ADD KEY `id_movimiento` (`id_movimiento`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `estado_reserva`
--
ALTER TABLE `estado_reserva`
  ADD PRIMARY KEY (`sr_estado_reserva`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`fac_consecutivo`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `hab_numero` (`hab_numero`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `promo_id` (`promo_id`),
  ADD KEY `tipo_reserva` (`tipo_reserva`);

--
-- Indexes for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`hab_numero`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`),
  ADD KEY `sr_estado_reserva` (`sr_estado_reserva`);

--
-- Indexes for table `historial_proceso`
--
ALTER TABLE `historial_proceso`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indexes for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indexes for table `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`),
  ADD UNIQUE KEY `promo_nombre` (`promo_nombre`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indexes for table `reservas_anuladas`
--
ALTER TABLE `reservas_anuladas`
  ADD PRIMARY KEY (`id_anulacion`),
  ADD KEY `hab_numero` (`hab_numero`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `promo_id` (`promo_id`);

--
-- Indexes for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `hab_numero` (`hab_numero`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `promo_id` (`promo_id`);

--
-- Indexes for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `hab_numero` (`id_reserva`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indexes for table `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id_tipo_habitacion`),
  ADD UNIQUE KEY `th_nombre_tipo` (`th_nombre_tipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `usu_rol` (`usu_rol`);

--
-- Indexes for table `villa_config`
--
ALTER TABLE `villa_config`
  ADD PRIMARY KEY (`id_conf`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `villa_conf_facturas`
--
ALTER TABLE `villa_conf_facturas`
  ADD PRIMARY KEY (`conf_id_fac`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `control_turnos`
--
ALTER TABLE `control_turnos`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detalle_cortesia`
--
ALTER TABLE `detalle_cortesia`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  MODIFY `id_det_mov` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado_reserva`
--
ALTER TABLE `estado_reserva`
  MODIFY `sr_estado_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `historial_proceso`
--
ALTER TABLE `historial_proceso`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservas_anuladas`
--
ALTER TABLE `reservas_anuladas`
  MODIFY `id_anulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `villa_config`
--
ALTER TABLE `villa_config`
  MODIFY `id_conf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `control_turnos`
--
ALTER TABLE `control_turnos`
  ADD CONSTRAINT `control_turnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cortesia`
--
ALTER TABLE `cortesia`
  ADD CONSTRAINT `cortesia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `detalle_cortesia`
--
ALTER TABLE `detalle_cortesia`
  ADD CONSTRAINT `detalle_cortesia_ibfk_1` FOREIGN KEY (`cor_consecutivo`) REFERENCES `cortesia` (`cor_consecutivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_cortesia_ibfk_2` FOREIGN KEY (`det_cor_id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

--
-- Constraints for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`fac_consecutivo`) REFERENCES `facturas` (`fac_consecutivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`det_id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

--
-- Constraints for table `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD CONSTRAINT `detalle_movimiento_ibfk_1` FOREIGN KEY (`id_movimiento`) REFERENCES `movimientos` (`id_movimiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_movimiento_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`promo_id`) REFERENCES `promocion` (`id_promocion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`hab_numero`) REFERENCES `habitacion` (`hab_numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_ibfk_4` FOREIGN KEY (`tipo_reserva`) REFERENCES `estado_reserva` (`sr_estado_reserva`) ON UPDATE CASCADE;

--
-- Constraints for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id_tipo_habitacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `habitacion_ibfk_2` FOREIGN KEY (`sr_estado_reserva`) REFERENCES `estado_reserva` (`sr_estado_reserva`) ON UPDATE CASCADE;

--
-- Constraints for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE;

--
-- Constraints for table `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `promocion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservas_anuladas`
--
ALTER TABLE `reservas_anuladas`
  ADD CONSTRAINT `reservas_anuladas_ibfk_1` FOREIGN KEY (`hab_numero`) REFERENCES `habitacion` (`hab_numero`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_anuladas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_anuladas_ibfk_3` FOREIGN KEY (`promo_id`) REFERENCES `promocion` (`id_promocion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  ADD CONSTRAINT `reserva_activa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_activa_ibfk_2` FOREIGN KEY (`hab_numero`) REFERENCES `habitacion` (`hab_numero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_activa_ibfk_3` FOREIGN KEY (`promo_id`) REFERENCES `promocion` (`id_promocion`) ON UPDATE CASCADE;

--
-- Constraints for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  ADD CONSTRAINT `reserva_activa_detalle_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva_activa` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_rol`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE;

--
-- Constraints for table `villa_config`
--
ALTER TABLE `villa_config`
  ADD CONSTRAINT `villa_config_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Constraints for table `villa_conf_facturas`
--
ALTER TABLE `villa_conf_facturas`
  ADD CONSTRAINT `villa_conf_facturas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
