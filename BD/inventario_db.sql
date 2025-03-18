-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2024 a las 23:19:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(6) UNSIGNED NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `tipo_equipo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `especificaciones` text NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `garantia` varchar(50) NOT NULL,
  `fecha_validacion` date NOT NULL,
  `estado` enum('bueno','regular','malo') NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `codigo`, `tipo_equipo`, `marca`, `serial`, `responsable`, `ubicacion`, `especificaciones`, `observaciones`, `fecha_ingreso`, `garantia`, `fecha_validacion`, `estado`, `reg_date`) VALUES
(4, 'ACT0062', 'IMAC', 'APPLE', 'C02C91MNH7JY', 'LIDER TIC', 'OFICINA TIC', 'CORE I5 DE DOS NUCLEOS-12 GB RAM - SSD S256 GB - MAUSE Y TECLADO MAC INALAMBRICO', 'POTENCIALIZADO', '2024-07-01', 'Vencido', '2024-07-29', 'bueno', '2024-07-29 17:12:03'),
(5, 'ACT0285', 'TELEFONO DE OFICINA', 'POLYCOM', '0004F27A2A8F', 'CARMENZA SANCHEZ', 'SALA DE TIC', 'TELEFONO ', 'NINGUNA', '2024-07-01', 'Vencido', '2024-07-29', 'bueno', '2024-07-29 17:12:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
