-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2019 at 02:41 AM
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
-- Table structure for table `habitacion`
--

CREATE TABLE `habitacion` (
  `hab_numero` int(11) NOT NULL,
  `id_tipo_habitacion` int(11) NOT NULL,
  `hab_detalle` longtext NOT NULL,
  `hab_fecha_creacion` date NOT NULL,
  `hab_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `habitacion`
--

INSERT INTO `habitacion` (`hab_numero`, `id_tipo_habitacion`, `hab_detalle`, `hab_fecha_creacion`, `hab_estado`) VALUES
(1, 1, 'nada', '0000-00-00', 0),
(2, 1, '', '2019-09-08', 1),
(3, 1, '', '2019-09-08', 1),
(4, 1, '', '2019-09-08', 1),
(5, 1, '', '2019-09-08', 1),
(6, 1, '', '2019-09-08', 1),
(7, 1, '', '2019-09-08', 1);

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
(1, 'empleado', 'caja'),
(2, 'administrador', 'admin');

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
(4, 'Premium4', 'des', 23232, 1, 1, '2019-09-07');

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
(6, 'Cristian Alexis', 'Lopera Bedoya', 1214746318, '1999-04-20', 3233557660, 'cristian1020011@gmail.com', 'dompi', 1, '$2y$10$rvr2xtuecn1WfoIew5fbLefP6nxQBhNCKdgBfWE7occUsqSVRra0u', '2019-09-05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`hab_numero`),
  ADD KEY `id_tipo_habitacion` (`id_tipo_habitacion`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id_tipo_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `habitacion_ibfk_1` FOREIGN KEY (`id_tipo_habitacion`) REFERENCES `tipo_habitacion` (`id_tipo_habitacion`) ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_rol`) REFERENCES `rol` (`rol_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
