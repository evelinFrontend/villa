-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2019 at 12:34 AM
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
(1, 'Disponible', 'Esta disponible', '#fff'),
(2, 'Reservada', '', '#000'),
(3, 'Tiempo Parcial', '', '#ddff00'),
(4, 'Cortesia', '', '#lkjhg8'),
(5, 'Promoción', '', '#dsasf'),
(6, 'Limpieza', '', '#ppppss');

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
(9, 1, 'sadasasd', 1, '2019-09-11', 0),
(10, 11, 'mm', 1, '2019-09-14', 1);

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
(8, 'PNE-001', 'cosito', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 4, '2019-09-12', '2019-09-12', 1),
(9, 'PNE-002', 'cosito', 19000, 20000, 4, 4, 'img_deafult_product.jpg', 1, '2019-09-13', '2019-09-13', 1),
(12, '78678', '8976', 78678, 6786, 4, 5, 'img_deafult_product.jpg', 786, '2019-09-14', '2019-09-14', 1),
(13, '89765', '9876', 98765, 789765, 4, 5, '7d507038e0e25a8b24aedb992a7e98ea.JPG', 789087, '2019-09-14', '2019-09-14', 1),
(14, '567890', '67890', 9876544567890, 987654345678, 4, 5, '0df42219dd71b6ed6fd5e4010acf8c06.JPG', 90987, '2019-09-14', '2019-09-14', 1);

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
  `ra_habitacion_decorada` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reserva_activa`
--

INSERT INTO `reserva_activa` (`id_reserva`, `hab_numero`, `id_usuario`, `promo_id`, `ra_fecha_hora_ingreso`, `ra_inicio_tiempo_parcial`, `ra_fin_tiempo_parcial`, `ra_numero_personas_adicionales`, `ra_habitacion_decorada`) VALUES
(25, 2, 6, NULL, '2019-09-15 16:19:17', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reserva_activa_detalle`
--

CREATE TABLE `reserva_activa_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `re_det_id_producto` int(11) NOT NULL,
  `re_det_cantidad` bigint(20) NOT NULL,
  `re_det_valor_unidad` bigint(20) NOT NULL,
  `re_det_valor_total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `villa_config`
--

INSERT INTO `villa_config` (`id_conf`, `conf_iva`, `conf_minutos_cortesia`, `id_usuario`) VALUES
(1, 19, 7, 6);

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
-- Indexes for table `estado_reserva`
--
ALTER TABLE `estado_reserva`
  ADD PRIMARY KEY (`sr_estado_reserva`);

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
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

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
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reserva_activa_detalle`
--
ALTER TABLE `reserva_activa_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `reserva_activa`
--
ALTER TABLE `reserva_activa`
  ADD CONSTRAINT `reserva_activa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`usu_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_activa_ibfk_2` FOREIGN KEY (`hab_numero`) REFERENCES `habitacion` (`hab_numero`) ON UPDATE CASCADE;

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
