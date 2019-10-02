-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2019 at 07:57 AM
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
(4, 'Lubricantes', 'pa que entre derecho y rico', '2019-09-12'),
(5, 'Jello', '', '2019-09-14'),
(6, 'prueba', 'nn', '2019-09-14'),
(8, 'wdsf', '234324', '2019-09-14'),
(9, 'asdas', 'asd', '2019-09-14'),
(10, 'asdasd', 'sada', '2019-09-14'),
(11, 'asd', 'asd', '2019-09-14'),
(12, 'ewq', 'wer', '2019-09-14'),
(13, 'daasd', 'dsad', '2019-09-14');

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
(18, 6, 2000, 30, 59, '2019-09-25', '05:35:21', '06:03:49', 2651000, 30, 1279000, 1342000, 30000);

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
(1, 1, 6, '2019-09-23 13:10:54', '', '', 0, 1, '2019-09-23 18:15:55', 'credito', '05:05:00', 1, 0, 157000, 0),
(2, 1, 6, '2019-09-23 13:10:54', '', '', 0, 1, '2019-09-23 18:27:43', 'credito', '05:16:00', 1, 0, 157000, 0),
(3, 1, 6, '2019-09-23 13:10:54', '', '', 0, 1, '2019-09-23 18:28:34', 'credito', '05:17:00', 1, 0, 157000, 0),
(4, 1, 6, '2019-09-23 13:10:54', '', '', 0, 1, '2019-09-23 18:38:06', 'credito', '05:27:00', 1, 0, 157000, 0);

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
(1, 2, 8, 1, 19000, 20000, 20000, '2019-09-23'),
(2, 2, 9, 5, 19000, 20000, 100000, '2019-09-23'),
(3, 3, 8, 1, 19000, 20000, 20000, '2019-09-23'),
(4, 3, 9, 5, 19000, 20000, 100000, '2019-09-23'),
(5, 4, 8, 1, 19000, 20000, 20000, '2019-09-23'),
(6, 4, 9, 5, 19000, 20000, 100000, '2019-09-23');

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
(3, 3, 8, 1, 19000, 20000, 20000, '2019-09-18 20:02:53'),
(4, 3, 9, 5, 19000, 20000, 100000, '2019-09-18 20:02:53'),
(5, 4, 8, 1, 19000, 20000, 20000, '2019-09-18 20:03:41'),
(6, 4, 9, 5, 19000, 20000, 100000, '2019-09-18 20:03:41'),
(7, 5, 8, 1, 19000, 20000, 20000, '2019-09-18 20:04:51'),
(8, 5, 9, 5, 19000, 20000, 100000, '2019-09-18 20:04:51'),
(9, 6, 8, 1, 19000, 20000, 20000, '2019-09-18 20:06:34'),
(10, 6, 9, 5, 19000, 20000, 100000, '2019-09-18 20:06:34'),
(11, 7, 8, 1, 19000, 20000, 20000, '2019-09-18 20:06:37'),
(12, 7, 9, 5, 19000, 20000, 100000, '2019-09-18 20:06:37'),
(13, 8, 8, 1, 19000, 20000, 20000, '2019-09-18 20:07:14'),
(14, 8, 9, 5, 19000, 20000, 100000, '2019-09-18 20:07:14'),
(15, 9, 8, 1, 19000, 20000, 20000, '2019-09-18 20:07:58'),
(16, 9, 9, 5, 19000, 20000, 100000, '2019-09-18 20:07:58'),
(17, 10, 8, 1, 19000, 20000, 20000, '2019-09-18 20:08:09'),
(18, 10, 9, 5, 19000, 20000, 100000, '2019-09-18 20:08:09'),
(19, 11, 8, 1, 19000, 20000, 20000, '2019-09-18 20:08:36'),
(20, 11, 9, 5, 19000, 20000, 100000, '2019-09-18 20:08:36'),
(21, 12, 8, 1, 19000, 20000, 20000, '2019-09-18 20:10:56'),
(22, 12, 9, 5, 19000, 20000, 100000, '2019-09-18 20:10:56'),
(23, 13, 8, 1, 19000, 20000, 20000, '2019-09-18 20:11:11'),
(24, 13, 9, 5, 19000, 20000, 100000, '2019-09-18 20:11:11'),
(25, 14, 8, 1, 19000, 20000, 20000, '2019-09-18 20:16:10'),
(26, 14, 9, 5, 19000, 20000, 100000, '2019-09-18 20:16:10'),
(27, 15, 12, 1, 78678, 10000, 10000, '2019-09-22 21:33:20'),
(28, 16, 12, 1, 78678, 10000, 10000, '2019-09-22 21:53:32'),
(29, 17, 8, 1, 19000, 20000, 20000, '2019-09-22 21:56:48'),
(30, 17, 9, 5, 19000, 20000, 100000, '2019-09-22 21:56:48'),
(31, 18, 8, 1, 19000, 20000, 20000, '2019-09-22 22:08:56'),
(32, 18, 9, 5, 19000, 20000, 100000, '2019-09-22 22:08:56'),
(33, 19, 8, 1, 19000, 20000, 20000, '2019-09-22 22:09:37'),
(34, 19, 9, 5, 19000, 20000, 100000, '2019-09-22 22:09:37'),
(35, 20, 8, 1, 19000, 20000, 20000, '2019-09-22 22:16:04'),
(36, 20, 9, 5, 19000, 20000, 100000, '2019-09-22 22:16:04'),
(37, 21, 8, 1, 19000, 20000, 20000, '2019-09-22 22:29:31'),
(38, 21, 9, 5, 19000, 20000, 100000, '2019-09-22 22:29:31'),
(39, 22, 9, 1, 19000, 20000, 20000, '2019-09-22 22:51:34'),
(40, 23, 8, 1, 19000, 20000, 20000, '2019-09-22 22:54:16'),
(41, 23, 9, 5, 19000, 20000, 100000, '2019-09-22 22:54:16'),
(42, 24, 8, 1, 19000, 20000, 20000, '2019-09-22 22:58:48'),
(43, 24, 9, 5, 19000, 20000, 100000, '2019-09-22 22:58:48'),
(44, 25, 8, 1, 19000, 20000, 20000, '2019-09-23 14:57:24'),
(45, 25, 9, 5, 19000, 20000, 100000, '2019-09-23 14:57:24'),
(46, 26, 8, 1, 19000, 20000, 20000, '2019-09-24 16:19:21'),
(47, 27, 8, 1, 19000, 20000, 20000, '2019-09-24 16:40:40'),
(48, 28, 8, 1, 19000, 20000, 20000, '2019-09-24 16:45:28'),
(49, 29, 8, 1, 19000, 20000, 20000, '2019-09-24 16:46:09'),
(50, 30, 9, 1, 19000, 20000, 20000, '2019-09-25 09:04:44'),
(51, 31, 8, 1, 19000, 20000, 20000, '2019-09-25 09:37:00'),
(52, 31, 9, 5, 19000, 20000, 100000, '2019-09-25 09:37:00'),
(53, 32, 8, 1, 19000, 20000, 20000, '2019-09-25 09:38:43'),
(54, 32, 9, 5, 19000, 20000, 100000, '2019-09-25 09:38:43'),
(55, 33, 9, 1, 19000, 20000, 20000, '2019-09-25 09:50:10'),
(56, 33, 13, 1, 98765, 15000, 15000, '2019-09-25 09:50:10'),
(57, 34, 9, 1, 19000, 20000, 20000, '2019-09-25 09:51:49'),
(58, 40, 8, 1, 19000, 20000, 20000, '2019-09-25 10:24:51'),
(59, 41, 8, 1, 19000, 20000, 20000, '2019-09-25 10:25:41'),
(60, 42, 8, 1, 19000, 20000, 20000, '2019-09-25 10:39:22'),
(61, 42, 9, 5, 19000, 20000, 100000, '2019-09-25 10:39:22'),
(62, 43, 8, 1, 19000, 20000, 20000, '2019-09-25 10:44:03'),
(63, 43, 9, 5, 19000, 20000, 100000, '2019-09-25 10:44:03'),
(64, 44, 8, 1, 19000, 20000, 20000, '2019-09-25 10:47:03'),
(65, 44, 9, 5, 19000, 20000, 100000, '2019-09-25 10:47:03'),
(66, 45, 8, 1, 19000, 20000, 20000, '2019-09-25 10:50:47'),
(67, 45, 9, 5, 19000, 20000, 100000, '2019-09-25 10:50:47'),
(68, 46, 8, 1, 19000, 20000, 20000, '2019-09-25 10:57:11'),
(69, 46, 9, 5, 19000, 20000, 100000, '2019-09-25 10:57:11'),
(70, 47, 8, 1, 19000, 20000, 20000, '2019-09-25 10:57:46'),
(71, 47, 9, 5, 19000, 20000, 100000, '2019-09-25 10:57:46'),
(72, 48, 8, 1, 19000, 20000, 20000, '2019-09-25 10:58:42'),
(73, 48, 9, 5, 19000, 20000, 100000, '2019-09-25 10:58:42'),
(74, 49, 8, 1, 19000, 20000, 20000, '2019-09-25 11:01:47'),
(75, 50, 8, 1, 19000, 20000, 20000, '2019-09-25 11:06:41'),
(76, 50, 9, 5, 19000, 20000, 100000, '2019-09-25 11:06:41'),
(77, 51, 8, 1, 19000, 20000, 20000, '2019-09-25 11:08:01'),
(78, 51, 9, 5, 19000, 20000, 100000, '2019-09-25 11:08:01'),
(79, 52, 8, 1, 19000, 20000, 20000, '2019-09-25 11:13:17'),
(80, 55, 8, 1, 19000, 20000, 20000, '2019-09-25 11:24:00'),
(81, 55, 12, 1, 78678, 10000, 10000, '2019-09-25 11:24:00'),
(82, 56, 8, 4, 19000, 20000, 80000, '2019-09-25 15:15:16'),
(83, 56, 9, 12, 19000, 20000, 240000, '2019-09-25 15:15:16'),
(84, 56, 12, 1, 78678, 10000, 10000, '2019-09-25 15:15:16'),
(85, 56, 13, 11, 98765, 15000, 165000, '2019-09-25 15:15:16'),
(86, 58, 8, 2, 19000, 20000, 40000, '2019-09-25 16:18:30'),
(87, 59, 8, 22, 19000, 20000, 440000, '2019-09-25 17:45:25'),
(88, 59, 9, 1, 19000, 20000, 20000, '2019-09-25 17:45:25'),
(89, 59, 12, 1, 78678, 10000, 10000, '2019-09-25 17:45:25'),
(90, 60, 8, 1, 19000, 20000, 20000, '2019-09-26 12:08:37'),
(91, 60, 13, 1, 98765, 15000, 15000, '2019-09-26 12:08:37'),
(92, 62, 13, 1, 98765, 15000, 15000, '2019-10-01 23:18:04'),
(93, 62, 8, 1, 19000, 20000, 20000, '2019-10-01 23:18:04'),
(94, 63, 8, 1, 19000, 20000, 20000, '2019-10-01 23:21:13'),
(95, 64, 8, 1, 19000, 20000, 20000, '2019-10-01 23:22:32'),
(96, 64, 9, 1, 19000, 20000, 20000, '2019-10-01 23:22:32'),
(97, 64, 12, 1, 78678, 10000, 10000, '2019-10-01 23:22:32'),
(98, 64, 13, 1, 98765, 15000, 15000, '2019-10-01 23:22:32'),
(99, 64, 14, 1, 9876544567890, 30000, 30000, '2019-10-01 23:22:32'),
(100, 65, 8, 1, 19000, 20000, 20000, '2019-10-01 23:23:44'),
(101, 65, 9, 1, 19000, 20000, 20000, '2019-10-01 23:23:44'),
(102, 66, 8, 1, 19000, 20000, 20000, '2019-10-01 23:25:03'),
(103, 67, 8, 1, 19000, 20000, 20000, '2019-10-01 23:27:04');

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

--
-- Dumping data for table `detalle_movimiento`
--

INSERT INTO `detalle_movimiento` (`id_det_mov`, `id_movimiento`, `id_producto`, `det_mov_cantidad`, `fecha`, `det_mov_cantidad_actual`, `det_mov_cantidad_nueva`) VALUES
(1, 5, 14, 10, '2019-09-24', 0, 0),
(2, 13, 8, 1, '2019-09-24', 0, 0),
(3, 13, 9, 5, '2019-09-24', 0, 0),
(4, 14, 8, 1, '2019-09-24', 0, 0),
(5, 14, 9, 5, '2019-09-24', 0, 0),
(6, 15, 8, 1, '2019-09-24', 0, 0),
(7, 15, 9, 5, '2019-09-24', 0, 0),
(8, 16, 8, 1, '2019-09-24', 0, 0),
(9, 16, 9, 55, '2019-09-24', 0, 0),
(10, 19, 14, 10, '2019-09-24', 0, 0),
(11, 19, 12, 19, '2019-09-24', 0, 0),
(12, 20, 14, 1, '2019-09-24', 0, 0),
(13, 21, 14, 1, '2019-09-24', 0, 0),
(14, 22, 14, 1, '2019-09-24', 0, 0),
(15, 23, 14, 987, '2019-09-24', 0, 0),
(16, 25, 14, 1, '2019-09-24', 0, 0),
(17, 26, 14, 1, '2019-09-24', 0, 0),
(18, 27, 12, 2, '2019-09-24', 0, 0),
(19, 28, 13, 789087, '2019-09-24', 0, 0),
(20, 29, 14, 5, '2019-09-24', 0, 0),
(21, 29, 12, 6, '2019-09-24', 0, 0),
(22, 29, 13, 7, '2019-09-24', 0, 0),
(23, 30, 14, 1, '2019-09-24', 0, 0),
(24, 31, 14, 1, '2019-09-24', 0, 0),
(25, 32, 14, 2, '2019-09-24', 0, 0),
(26, 33, 14, 3, '2019-09-24', 0, 0),
(27, 34, 12, 1, '2019-10-02', 2, 1);

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
(1, 1, 1, 2, 2, '2019-09-06 00:00:00', '2019-09-06 00:00:00', '2019-09-19 00:00:00', 1, 1, '2019-09-19 00:00:00', '1', '21:00:00', 1000, 1, 0, 0, 0),
(2, 45, 3, 6, NULL, '2019-09-18 19:19:56', '', '', 0, 1, '2019-09-18 19:48:11', 'tipo_pago', '00:28:00', 142000, 2, 0, 0, 0),
(3, 45, 3, 6, NULL, '2019-09-18 19:19:56', '', '', 0, 1, '2019-09-18 20:02:53', 'tipo_pago', '00:42:00', 142000, 2, 0, 0, 0),
(4, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:03:41', 'tipo_pago', '00:42:58', 142000, 2, 0, 0, 0),
(5, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:04:51', 'tipo_pago', '00:43:58', 142000, 2, 0, 0, 0),
(6, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:06:34', 'tipo_pago', '00:45:58', 142000, 2, 0, 0, 0),
(7, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:06:37', 'tipo_pago', '00:45:58', 142000, 2, 0, 0, 0),
(8, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:07:14', 'tipo_pago', '00:46:58', 142000, 2, 0, 0, 0),
(9, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:07:58', 'tipo_pago', '00:47:58', 142000, 2, 0, 0, 0),
(10, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:08:09', 'tipo_pago', '00:47:58', 142000, 2, 0, 0, 0),
(11, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:08:36', 'tipo_pago', '00:47:58', 142000, 2, 0, 0, 0),
(12, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:10:56', 'tipo_pago', '00:50:58', 142000, 2, 0, 0, 0),
(13, 44, 1, 6, NULL, '2019-09-18 18:55:20', '', '', 0, 1, '2019-09-18 20:11:11', 'tipo_pago', '01:15:00', 162000, 2, 0, 0, 0),
(14, 43, 2, 6, NULL, '2019-09-16 15:00:35', '', '', 0, 1, '2019-09-18 20:16:10', 'tipo_pago', '53:15:00', 1202000, 2, 0, 0, 0),
(15, 67, 1, 6, NULL, '2019-09-22 21:09:11', '', '', 0, 0, '2019-09-22 21:33:20', 'tipo_pago', '00:24:00', 30000, 2, 0, 0, 0),
(16, 69, 1, 6, NULL, '2019-09-22 21:41:36', '', '', 0, 0, '2019-09-22 21:53:32', 'tipo_pago', '00:11:00', 30000, 2, 0, 0, 0),
(17, 70, 1, 6, NULL, '2019-09-22 21:53:59', '', '', 0, 1, '2019-09-22 21:56:48', 'tipo_pago', '00:02:00', 125000, 2, 0, 0, 0),
(18, 71, 1, 6, NULL, '2019-09-22 22:04:03', '', '', 0, 1, '2019-09-22 22:08:56', 'tipo_pago', '00:04:00', 125000, 2, 0, 0, 0),
(19, 72, 1, 6, NULL, '2019-09-22 22:09:18', '', '', 0, 1, '2019-09-22 22:09:37', 'tipo_pago', '00:00:19', 125000, 2, 0, 0, 0),
(20, 73, 1, 6, NULL, '2019-09-22 22:15:53', '', '', 0, 1, '2019-09-22 22:16:04', 'mixto', '00:00:11', 125000, 2, 124000, 500, 500),
(21, 74, 1, 6, NULL, '2019-09-22 22:18:43', '', '', 0, 1, '2019-09-22 22:29:31', 'credito', '00:10:00', 145000, 2, 0, 125000, 0),
(22, 75, 1, 6, NULL, '2019-09-22 22:36:14', '', '', 0, 0, '2019-09-22 22:51:34', 'credito', '00:15:00', 40000, 2, 0, 40000, 0),
(23, 76, 1, 6, NULL, '2019-09-22 22:51:39', '', '', 0, 1, '2019-09-22 22:54:16', 'credito', '00:02:00', 125000, 2, 0, 125000, 0),
(24, 77, 1, 6, NULL, '2019-09-22 22:58:37', '', '', 0, 1, '2019-09-22 22:58:48', 'credito', '00:00:11', 125000, 2, 0, 125000, 0),
(25, 80, 2, 6, NULL, '2019-09-23 14:57:00', '', '', 0, 1, '2019-09-23 14:57:24', 'credito', '00:00:24', 122000, 2, 0, 122000, 0),
(26, 81, 3, 6, NULL, '2019-09-24 14:44:36', '', '', 0, 0, '2019-09-24 16:19:21', 'efectivo', '01:34:00', 40000, 2, 40000, 0, 0),
(27, 82, 2, 6, NULL, '2019-09-24 16:21:22', '', '', 0, 0, '2019-09-24 16:40:40', 'efectivo', '00:19:00', 40000, 2, 40000, 0, 0),
(28, 83, 3, 6, NULL, '2019-09-24 16:41:04', '', '', 0, 0, '2019-09-24 16:45:28', 'efectivo', '00:04:00', 40000, 2, 40000, 0, 0),
(29, 84, 1, 6, NULL, '2019-09-24 16:45:57', '', '', 0, 0, '2019-09-24 16:46:09', 'efectivo', '00:00:12', 20000, 2, 20000, 0, 0),
(30, 87, 1, 6, NULL, '2019-09-25 09:03:40', '', '', 0, 0, '2019-09-25 09:04:44', 'efectivo', '00:01:00', 20000, 2, 20000, 0, 0),
(31, 89, 2, 6, NULL, '2019-09-25 09:33:13', '', '', 0, 1, '2019-09-25 09:37:00', 'credito', '00:03:00', 122000, 2, 0, 122000, 0),
(32, 90, 2, 6, NULL, '2019-09-25 09:38:30', '', '', 0, 1, '2019-09-25 09:38:43', 'credito', '00:00:13', 122000, 2, 0, 122000, 0),
(33, 88, 1, 6, NULL, '2019-09-25 09:07:31', '', '', 0, 0, '2019-09-25 09:50:10', 'efectivo', '00:42:00', 55000, 2, 55000, 0, 0),
(34, 91, 2, 6, NULL, '2019-09-25 09:50:21', '', '', 0, 0, '2019-09-25 09:51:49', 'efectivo', '00:01:00', 20000, 2, 20000, 0, 0),
(35, 92, 1, 6, NULL, '2019-09-25 09:54:23', '', '', 0, 0, '2019-09-25 09:55:52', 'efectivo', '00:01:00', 0, 2, 0, 0, 0),
(36, 93, 3, 6, NULL, '2019-09-25 10:07:12', '', '', 0, 0, '2019-09-25 10:08:10', 'efectivo', '00:00:58', 0, 2, 0, 0, 0),
(37, 94, 4, 6, NULL, '2019-09-25 10:09:08', '', '', 0, 0, '2019-09-25 10:09:13', 'efectivo', '00:00:05', 0, 2, 0, 0, 0),
(38, 95, 5, 6, NULL, '2019-09-25 10:13:32', '', '', 0, 0, '2019-09-25 10:13:38', 'efectivo', '00:00:06', 0, 2, 0, 0, 0),
(39, 96, 6, 6, NULL, '2019-09-25 10:18:01', '', '', 0, 0, '2019-09-25 10:18:06', 'efectivo', '00:00:05', 0, 2, 0, 0, 0),
(40, 97, 7, 6, NULL, '2019-09-25 10:24:42', '', '', 0, 0, '2019-09-25 10:24:51', 'efectivo', '00:00:09', 20000, 2, 20000, 0, 0),
(41, 98, 8, 6, NULL, '2019-09-25 10:25:35', '', '', 0, 0, '2019-09-25 10:25:41', 'efectivo', '00:00:06', 20000, 2, 20000, 0, 0),
(42, 99, 2, 6, NULL, '2019-09-25 10:39:19', '', '', 0, 1, '2019-09-25 10:39:22', 'credito', '00:00:03', 122000, 2, 0, 122000, 0),
(43, 100, 2, 6, NULL, '2019-09-25 10:44:02', '', '', 0, 1, '2019-09-25 10:44:03', 'credito', '00:00:01', 122000, 2, 0, 122000, 0),
(44, 101, 2, 6, NULL, '2019-09-25 10:47:02', '', '', 0, 1, '2019-09-25 10:47:03', 'credito', '00:00:01', 122000, 2, 0, 122000, 0),
(45, 102, 2, 6, NULL, '2019-09-25 10:50:45', '', '', 0, 1, '2019-09-25 10:50:47', 'credito', '00:00:02', 122000, 2, 0, 122000, 0),
(46, 103, 2, 6, NULL, '2019-09-25 10:57:09', '', '', 0, 1, '2019-09-25 10:57:11', 'credito', '00:00:02', 122000, 2, 0, 122000, 0),
(47, 104, 2, 6, NULL, '2019-09-25 10:57:44', '', '', 0, 1, '2019-09-25 10:57:46', 'credito', '00:00:02', 122000, 2, 0, 122000, 0),
(48, 105, 2, 6, NULL, '2019-09-25 10:58:41', '', '', 0, 1, '2019-09-25 10:58:42', 'credito', '00:00:01', 122000, 2, 0, 122000, 0),
(49, 106, 9, 6, NULL, '2019-09-25 11:01:38', '', '', 0, 0, '2019-09-25 11:01:47', 'efectivo', '00:00:09', 20000, 2, 20000, 0, 0),
(50, 107, 2, 6, NULL, '2019-09-25 11:06:06', '', '', 0, 1, '2019-09-25 11:06:41', 'credito', '00:00:35', 122000, 2, 0, 122000, 0),
(51, 108, 2, 6, NULL, '2019-09-25 11:07:51', '', '', 0, 1, '2019-09-25 11:08:01', 'credito', '00:00:10', 122000, 2, 0, 122000, 0),
(52, 109, 10, 6, NULL, '2019-09-25 11:13:08', '', '', 0, 0, '2019-09-25 11:13:17', 'efectivo', '00:00:09', 20000, 2, 20000, 0, 0),
(53, 110, 11, 6, NULL, '2019-09-25 11:13:29', '', '', 0, 0, '2019-09-25 11:13:36', 'credito', '00:00:07', 0, 2, 0, 0, 0),
(54, 111, 1, 6, NULL, '2019-09-25 11:23:05', '', '', 0, 0, '2019-09-25 11:23:11', 'efectivo', '00:00:06', 0, 2, 0, 0, 0),
(55, 112, 1, 6, NULL, '2019-09-25 11:23:46', '', '', 0, 0, '2019-09-25 11:24:00', 'transferencia', '00:00:14', 30000, 2, 0, 0, 30000),
(56, 113, 1, 6, NULL, '2019-09-25 11:25:04', '', '', 3, 1, '2019-09-25 15:15:16', 'efectivo', '03:50:00', 532000, 2, 532000, 0, 0),
(57, 118, 5, 6, 1, '2019-09-25 15:25:49', '', '', 0, 0, '2019-09-25 16:14:48', 'efectivo', '00:48:00', 30000, 5, 30000, 0, 0),
(58, 119, 5, 6, 2, '2019-09-25 16:17:44', '', '', 0, 0, '2019-09-25 16:18:30', 'efectivo', '00:00:46', 40000, 5, 40000, 0, 0),
(59, 115, 3, 6, 1, '2019-09-25 13:22:39', '', '', 1, 1, '2019-09-25 17:45:25', 'efectivo', '04:22:00', 502000, 5, 502000, 0, 0),
(60, 114, 2, 6, NULL, '2019-09-25 11:47:41', '', '', 2, 0, '2019-09-26 12:08:37', 'efectivo', '24:20:00', 175000, 2, 175000, 0, 0),
(61, 117, 4, 6, NULL, '2019-09-25 15:25:04', '2019-09-25 16:28:43', '2019-09-25 16:29:44', 0, 0, '2019-10-01 20:24:49', 'efectivo', '04:57:59', 0, 2, 0, 0, 0),
(62, 121, 1, 6, NULL, '2019-10-01 20:26:37', '2019-10-01 21:02:59', '2019-10-01 21:03:24', 0, 0, '2019-10-01 23:18:04', 'efectivo', '02:50:35', 65000, 2, 65000, 0, 0),
(63, 124, 2, 6, NULL, '2019-10-01 23:20:31', '', '', 0, 0, '2019-10-01 23:21:13', 'efectivo', '00:00:42', 20000, 2, 20000, 0, 0),
(64, 123, 7, 6, NULL, '2019-10-01 21:09:53', '', '', 0, 0, '2019-10-01 23:22:32', 'efectivo', '02:12:00', 120500, 2, 120500, 0, 0),
(65, 125, 8, 6, NULL, '2019-10-01 23:23:14', '', '', 0, 0, '2019-10-01 23:23:44', 'efectivo', '00:00:30', 40000, 2, 40000, 0, 0),
(66, 126, 9, 6, NULL, '2019-10-01 23:24:52', '', '', 0, 0, '2019-10-01 23:25:03', 'efectivo', '00:00:11', 20000, 2, 20000, 0, 0),
(67, 127, 6, 6, NULL, '2019-10-01 23:26:54', '', '', 0, 0, '2019-10-01 23:27:04', 'efectivo', '00:00:10', 20000, 2, 20000, 0, 0);

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
(1, 1, 'nada', 6, '0000-00-00', 1),
(2, 1, 'sad', 6, '2019-09-08', 1),
(3, 2, '221', 5, '2019-09-08', 1),
(4, 3, '213', 1, '2019-09-08', 1),
(5, 2, '2121321321321', 1, '2019-09-08', 1),
(6, 3, '12', 6, '2019-09-08', 1),
(7, 1, '', 6, '2019-09-08', 1),
(8, 1, 'kjh', 6, '2019-09-11', 1),
(9, 1, 'sadasasd', 6, '2019-09-11', 1),
(10, 11, 'mm', 1, '2019-09-14', 1),
(11, 5, '', 1, '2019-09-18', 1),
(12, 4, '88', 1, '2019-09-23', 0);

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

--
-- Dumping data for table `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `id_usuario`, `mov_fecha`, `mov_tipo`, `mov_observaciones`, `mov_fecha_realizacion`, `total`) VALUES
(1, 6, '2019-09-17', 'sumar', '32', '2019-09-24', 0),
(2, 6, '2019-09-17', 'descontar', '32', '2019-09-24', 0),
(3, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(4, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(5, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(6, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(7, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(8, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(9, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(10, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(11, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(12, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(13, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(14, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(15, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(16, 6, '2019-08-20', 'sumar', 'jugyfdgh', '2019-09-24', 0),
(17, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(18, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(19, 6, '2019-09-17', 'cortesia', '32', '2019-09-24', 0),
(20, 6, '2019-09-27', 'descontar', '123', '2019-09-24', 0),
(21, 6, '2019-09-13', 'cortesia', '1sda', '2019-09-24', 0),
(22, 6, '2019-09-14', 'cortesia', '23432', '2019-09-24', 0),
(23, 6, '2019-09-19', 'descontar', 'Descontar', '2019-09-24', 0),
(24, 6, '2019-09-07', 'descontar', '21', '2019-09-24', 0),
(25, 6, '2019-09-07', 'descontar', '21', '2019-09-24', 0),
(26, 6, '2019-09-07', 'descontar', '21', '2019-09-24', 0),
(27, 6, '2019-09-14', 'descontar', 'dsda', '2019-09-24', 0),
(28, 6, '2019-09-19', 'descontar', 'dasda', '2019-09-24', 0),
(29, 6, '2019-09-13', 'sumar', 'kjhg', '2019-09-24', 0),
(30, 6, '2019-09-28', 'cortesia', 'sad', '2019-09-24', 0),
(31, 6, '2019-09-12', 'descontar', '3423', '2019-09-24', 0),
(32, 6, '2019-09-20', 'descontar', 'kl', '2019-09-24', 60000),
(33, 6, '2019-09-17', 'sumar', 'Nada', '2019-09-24', 90000),
(34, 6, '2019-10-10', 'descontar', 'nada', '2019-10-02', 10000);

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
(8, 'PNE-001', 'Prod 1', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 125, '2019-09-12', '2019-09-12', 1),
(9, 'PNE-002', 'Prod 2', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 16, '2019-09-13', '2019-09-13', 1),
(12, '78678', 'Prod 3', 78678, 10000, 4, 5, 'img_deafult_product.jpg', 1, '2019-09-14', '2019-09-14', 1),
(13, '89765', 'Prod 4', 98765, 15000, 4, 5, 'img_deafult_product.jpg', -8, '2019-09-14', '2019-09-14', 1),
(14, '567890', 'Prod 5', 9876544567890, 30000, 4, 5, 'img_deafult_product.jpg', -1, '2019-09-14', '2019-09-14', 1);

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
  `promo_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `promo_nombre`, `promo_tiempo`, `promo_valor`, `promo_fecha_registro`, `id_usuario`, `promo_estado`) VALUES
(1, '3x1', '04:00:00', 30000, '2019-09-05', 6, 0),
(2, '2x1', '03:00:00', 100000, '2019-09-18', 6, 0),
(5, '2x 1000 mil', '03:00:00', 100000, '2019-09-18', 6, 1),
(8, '5x1', '05:00:00', 20000, '2019-09-23', 6, 1),
(9, '7x2', '07:00:00', 40000, '2019-09-23', 6, 1);

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
(4, '78778782-1', 'Condoncito feliz', 'Dale Dale!!!', 32338889, 'calle 95', 'sinhijos@hotmail.com', '8000222222', 'Ahorros', 'BBVA', 'Javier', '2019-09-12', '2019-09-12'),
(5, '3987633', 'jkhhkj', '23432', 23432, '234', '32432@gmail.com', '324', '234', '324', 'jknjkhjk', '2019-09-14', '2019-09-14'),
(6, '213123', '21312', '123', 123, '123', '324322@gmail.com', '123', '123', '123', '123123', '2019-09-14', '2019-09-14');

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
(1, 3, 6, 1, '2019-09-16 16:21:39', 1, '1'),
(2, 3, 6, 1, '2019-09-16 16:21:39', 1, 'Por que si '),
(3, 1, 6, NULL, '2019-09-18 20:17:28', 1, 'Por que si ');

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
(122, 3, 6, 1, '2019-10-01 20:56:27', '2019-10-01 23:55:32', '2019-10-01 23:55:55', 0, 0, 5, NULL);

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
(298, 122, 8, 1, 19000, 20000, 20000);

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
(1, 'Premium', 'Cama doble para tiki tiki', 20000, 12000, 1, '2019-09-07', 20000, 25500, 30000, 35000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 110000, 115000, 120000, 125000, 130000, 135000, 140000),
(2, 'Premium2', 'Cama doble para tiki tiki', 20000, 12000, 1, '2019-09-07', 20000, 25000, 30000, 35000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 110000, 115000, 120000, 125000, 130000, 135000, 140000),
(3, 'Premium3', 'des', 23232, 1, 1, '2019-09-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Premium4', 'des', 23232, 1, 1, '2019-09-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Basico', 'cama', 2000, 12000, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Prueba', 'sadfds', 30000, 3000, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '324', '2344', 234, 234, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'jjjjj', '234', 22220, 324, 1, '2019-09-14', 22220, 222200, 22220, 22220, 222200, 22220, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200, 222200),
(9, 'ttt', '4324', 324, 234234, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 'fdsfsd', 'sdf', 324324, 23432, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'tyt', '2434', 34243, 23423, 1, '2019-09-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, '24', 'des', 23232, 1, 0, '2019-09-23', 20000, 25000, 30000, 35000, 40000, 45000, 50000, 55000, 60000, 65000, 70000, 75000, 80000, 85000, 90000, 95000, 100000, 110000, 115000, 120000, 125000, 130000, 135000, 140000);

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
(2, 'Caja', 'Caja', 0, '2019-09-14', 0, '0', 'caja', 2, '$2y$10$rvr2xtuecn1WfoIew5fbLefP6nxQBhNCKdgBfWE7occUsqSVRra0u', '2019-09-14', 1),
(6, 'Cristian Alexis', 'Lopera Bedoya', 1214746318, '1999-04-20', 3233557660, 'cristian1020011@gmail.com', 'admin', 1, '$2y$10$rvr2xtuecn1WfoIew5fbLefP6nxQBhNCKdgBfWE7occUsqSVRra0u', '2019-09-05', 1);

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
(1, 19, 15, 2000, 30, 6);

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
(1, '1876201208237', 'APARTA HOTEL VILLA CAMPESTRE', 'INVESTMENTS GROUP S.A.S', '901233749-6', 'CARRETERA LA CORDIALIDAD N0 22-72', '(095)6632106', 'Cartagena, Bolivar (Colombia)', '2018-12-31', '2018-12-31', '000001', 'VC 200000', 'MUCHAS GRACIAS POR SU VISITA.', '930a77b34acfddeb24c47eeb2d92ff54.JPG', 6);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `control_turnos`
--
ALTER TABLE `control_turnos`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detalle_cortesia`
--
ALTER TABLE `detalle_cortesia`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  MODIFY `id_det_mov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `estado_reserva`
--
ALTER TABLE `estado_reserva`
  MODIFY `sr_estado_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservas_anuladas`
--
ALTER TABLE `reservas_anuladas`
  MODIFY `id_anulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
