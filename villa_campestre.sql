-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2019 at 03:45 AM
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
(7, 'test', 'nn', '2019-09-14'),
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
  `total_facturas_realizadas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `control_turnos`
--

INSERT INTO `control_turnos` (`id_control`, `id_usuario`, `valor_inicial`, `factura_inicio`, `factura_fin`, `fecha_turno`, `hora_inicio`, `hora_fin`, `valor_total_cierre`, `total_facturas_realizadas`) VALUES
(12, 6, 2000, NULL, 0, '2019-09-15', '10:54:32', '10:54:37', 2000, 20),
(13, 2, 12000, NULL, NULL, '2019-09-18', '11:59:36', NULL, NULL, NULL),
(14, 2, 1, NULL, NULL, '2019-09-19', '12:05:24', NULL, NULL, NULL);

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
(26, 14, 9, 5, 19000, 20000, 100000, '2019-09-18 20:16:10');

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
  `tipo_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`fac_consecutivo`, `id_reserva`, `hab_numero`, `id_usuario`, `promo_id`, `fac_fecha_hora_ingreso`, `fac_inicio_tiempo_parcial`, `fac_fin_tiempo_parcial`, `fac_numero_personas_adicionales`, `fac_habitacion_decorada`, `fac_hora_salida`, `tipo_pago`, `tiempo_total`, `valor_factura`, `tipo_reserva`) VALUES
(1, 1, 1, 2, 2, '2019-09-06 00:00:00', '2019-09-06 00:00:00', '2019-09-19 00:00:00', 1, 1, '2019-09-19 00:00:00', '1', '21:00:00', 1000, 1),
(2, 45, 3, 6, NULL, '2019-09-18 19:19:56', '', '', 0, 1, '2019-09-18 19:48:11', 'tipo_pago', '00:28:00', 142000, 2),
(3, 45, 3, 6, NULL, '2019-09-18 19:19:56', '', '', 0, 1, '2019-09-18 20:02:53', 'tipo_pago', '00:42:00', 142000, 2),
(4, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:03:41', 'tipo_pago', '00:42:58', 142000, 2),
(5, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:04:51', 'tipo_pago', '00:43:58', 142000, 2),
(6, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:06:34', 'tipo_pago', '00:45:58', 142000, 2),
(7, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:06:37', 'tipo_pago', '00:45:58', 142000, 2),
(8, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:07:14', 'tipo_pago', '00:46:58', 142000, 2),
(9, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:07:58', 'tipo_pago', '00:47:58', 142000, 2),
(10, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:08:09', 'tipo_pago', '00:47:58', 142000, 2),
(11, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:08:36', 'tipo_pago', '00:47:58', 142000, 2),
(12, 45, 3, 6, NULL, '2019-09-18 19:19:56', '2019-09-18 20:03:30', '2019-09-18 20:03:32', 0, 1, '2019-09-18 20:10:56', 'tipo_pago', '00:50:58', 142000, 2),
(13, 44, 1, 6, NULL, '2019-09-18 18:55:20', '', '', 0, 1, '2019-09-18 20:11:11', 'tipo_pago', '01:15:00', 162000, 2),
(14, 43, 2, 6, NULL, '2019-09-16 15:00:35', '', '', 0, 1, '2019-09-18 20:16:10', 'tipo_pago', '53:15:00', 1202000, 2);

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
(2, 1, '', 2, '2019-09-08', 1),
(3, 1, '', 1, '2019-09-08', 1),
(4, 1, '', 1, '2019-09-08', 1),
(5, 1, '', 1, '2019-09-08', 1),
(6, 1, '', 1, '2019-09-08', 1),
(7, 1, '', 1, '2019-09-08', 1),
(8, 1, 'kjh', 1, '2019-09-11', 1),
(9, 1, 'sadasasd', 1, '2019-09-11', 1),
(10, 11, 'mm', 1, '2019-09-14', 1),
(11, 5, '', 1, '2019-09-18', 1);

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
(8, 'PNE-001', 'Prod 1', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 188, '2019-09-12', '2019-09-12', 1),
(9, 'PNE-002', 'Prod 2', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 140, '2019-09-13', '2019-09-13', 1),
(12, '78678', 'Prod 3', 78678, 10000, 4, 5, 'img_deafult_product.jpg', 5, '2019-09-14', '2019-09-14', 1),
(13, '89765', 'Prod 4', 98765, 15000, 4, 5, 'img_deafult_product.jpg', 789087, '2019-09-14', '2019-09-14', 1),
(14, '567890', 'Prod 5', 9876544567890, 30000, 4, 5, 'img_deafult_product.jpg', 90987, '2019-09-14', '2019-09-14', 1);

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
(5, '2x 1000 mil', '03:00:00', 100000, '2019-09-18', 6, 1);

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
(66, 2, 6, NULL, '2019-09-22 20:42:08', NULL, NULL, 0, 1, 2, NULL);

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
(184, 66, 8, 1, 19000, 20000, 20000),
(185, 66, 9, 5, 19000, 20000, 100000);

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
  `th_valor_hora` bigint(20) NOT NULL,
  `th_valor_persona_adicional` bigint(20) NOT NULL,
  `th_estado` int(1) NOT NULL,
  `th_fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id_tipo_habitacion`, `th_nombre_tipo`, `th_descripcion`, `th_valor_hora`, `th_valor_persona_adicional`, `th_estado`, `th_fecha_creacion`) VALUES
(1, 'Premium', 'Cama doble para tiki tiki', 20000, 12000, 1, '2019-09-07'),
(2, 'Premium2', 'des', 23232, 12000, 1, '2019-09-07'),
(3, 'Premium3', 'des', 23232, 1, 1, '2019-09-07'),
(4, 'Premium4', 'des', 23232, 1, 1, '2019-09-07'),
(5, 'Basico', 'cama', 2000, 12000, 1, '2019-09-14'),
(6, 'Prueba', 'sadfds', 30000, 3000, 1, '2019-09-14'),
(7, '324', '2344', 234, 234, 1, '2019-09-14'),
(8, '234', '234', 234, 324, 1, '2019-09-14'),
(9, 'ttt', '4324', 324, 234234, 1, '2019-09-14'),
(10, 'fdsfsd', 'sdf', 324324, 23432, 1, '2019-09-14'),
(11, 'tyt', '2434', 34243, 23423, 1, '2019-09-14');

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
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villa_config`
--

INSERT INTO `villa_config` (`id_conf`, `conf_iva`, `conf_minutos_cortesia`, `conf_precio_decoracion`, `id_usuario`) VALUES
(1, 19, 4, 5000, 6);

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
-- Indexes for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fac_consecutivo` (`fac_consecutivo`),
  ADD KEY `det_id_producto` (`det_id_producto`);

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
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `estado_reserva`
--
ALTER TABLE `estado_reserva`
  MODIFY `sr_estado_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`fac_consecutivo`) REFERENCES `facturas` (`fac_consecutivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`det_id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

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
