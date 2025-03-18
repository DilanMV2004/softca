-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2024 a las 21:42:17
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
-- Base de datos: `studend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `father`
--

CREATE TABLE `father` (
  `ID` int(11) NOT NULL,
  `Nombres_Padre` varchar(100) DEFAULT NULL,
  `Apellidos_Padre` varchar(100) DEFAULT NULL,
  `Tipo_Documento_Padre` varchar(50) DEFAULT NULL,
  `Documento_Padre` varchar(50) DEFAULT NULL,
  `Lugar_Expedicion_Padre` varchar(100) DEFAULT NULL,
  `Fecha_de_Nacimiento_Padre` date DEFAULT NULL,
  `Edad_Padre` int(11) DEFAULT NULL,
  `Estado_Civil_Padre` varchar(50) DEFAULT NULL,
  `Direccion_Residencia_Padre` varchar(200) DEFAULT NULL,
  `Email_Padre` varchar(100) DEFAULT NULL,
  `Celular_Padre` varchar(20) DEFAULT NULL,
  `Profesion_Padre` varchar(100) DEFAULT NULL,
  `Nombre_Empresa_Padre` varchar(100) DEFAULT NULL,
  `Telefono_Oficina_Padre` varchar(20) DEFAULT NULL,
  `Direccion_Oficina_Padre` varchar(200) DEFAULT NULL,
  `Telefono_Residencia_Padre` varchar(20) DEFAULT NULL,
  `Padre_ExAlumno` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mother`
--

CREATE TABLE `mother` (
  `ID` int(11) NOT NULL,
  `Nombres_Madre` varchar(100) DEFAULT NULL,
  `Apellidos_Madre` varchar(100) DEFAULT NULL,
  `Tipo_Documento_Madre` varchar(50) DEFAULT NULL,
  `Documento_Madre` varchar(50) DEFAULT NULL,
  `Lugar_Expedicion_Madre` varchar(100) DEFAULT NULL,
  `Fecha_de_Nacimiento_Madre` date DEFAULT NULL,
  `Edad_Madre` int(11) DEFAULT NULL,
  `Estado_Civil_Madre` varchar(50) DEFAULT NULL,
  `Direccion_Residencia_Madre` varchar(200) DEFAULT NULL,
  `Profesion_Madre` varchar(100) DEFAULT NULL,
  `Nombre_Empresa_Madre` varchar(100) DEFAULT NULL,
  `Telefono_Oficina_Madre` varchar(20) DEFAULT NULL,
  `Direccion_Oficina_Madre` varchar(200) DEFAULT NULL,
  `Telefono_Madre` varchar(20) DEFAULT NULL,
  `Email_Madre` varchar(100) DEFAULT NULL,
  `Celular_Madre` varchar(20) DEFAULT NULL,
  `Madre_ExAlumno` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `ID` int(11) NOT NULL,
  `Nombre_Responsable` varchar(100) DEFAULT NULL,
  `Apellidos_Responsable` varchar(100) DEFAULT NULL,
  `Tipo_Documento_Responsable` varchar(50) DEFAULT NULL,
  `Documento_Responsable` varchar(50) DEFAULT NULL,
  `Lugar_Expedicion_Responsable` varchar(100) DEFAULT NULL,
  `Fecha_de_Nacimiento_Responsable` date DEFAULT NULL,
  `Edad_Responsable` int(11) DEFAULT NULL,
  `Estado_Civil_Responsable` varchar(50) DEFAULT NULL,
  `Categoria_Responsable` varchar(50) DEFAULT NULL,
  `Nombre_Empresa_Responsable` varchar(100) DEFAULT NULL,
  `Telefono_Oficina_Responsable` varchar(20) DEFAULT NULL,
  `Direccion_Oficina_Responsable` varchar(200) DEFAULT NULL,
  `Telefono_Responsable` varchar(20) DEFAULT NULL,
  `Email_Responsable` varchar(100) DEFAULT NULL,
  `Celular_Responsable` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `Codigo_Alumno` varchar(50) NOT NULL,
  `Doc_Alumno` varchar(50) NOT NULL,
  `Tipo_Documento_Alumno` varchar(50) NOT NULL,
  `Primer_Nombre_Alumno` varchar(50) NOT NULL,
  `Segundo_Nombre_Alumno` varchar(50) DEFAULT NULL,
  `Primer_Apellido_Alumno` varchar(50) NOT NULL,
  `Segundo_Apellido_Alumno` varchar(50) DEFAULT NULL,
  `Lugar_Expedicion_Alumno` varchar(100) DEFAULT NULL,
  `Lugar_de_Nacimiento_Alumno` varchar(100) DEFAULT NULL,
  `Depto_Nacimiento_Alumno` varchar(100) DEFAULT NULL,
  `Municipio_Nacimiento_Alumno` varchar(100) DEFAULT NULL,
  `Fecha_de_Nacimiento_Alumno` date DEFAULT NULL,
  `Sexo_Alumno` varchar(10) DEFAULT NULL,
  `Fecha_de_Ingreso_Alumno` date DEFAULT NULL,
  `Email_Alumno` varchar(100) DEFAULT NULL,
  `Edad_Alumno` int(11) DEFAULT NULL,
  `EPS_Alumno` varchar(50) DEFAULT NULL,
  `Grupo_Sanguineo_Alumno` varchar(5) DEFAULT NULL,
  `RH_Alumno` varchar(5) DEFAULT NULL,
  `Telefono_Alumno` varchar(20) DEFAULT NULL,
  `Direccion_Residencia_Alumno` varchar(200) DEFAULT NULL,
  `Barrio_Alumno` varchar(100) DEFAULT NULL,
  `Estrato_Alumno` varchar(10) DEFAULT NULL,
  `Grupo_Alumno` varchar(50) DEFAULT NULL,
  `Grado_Alumno` varchar(50) DEFAULT NULL,
  `Total_Hermanos_Alumno` int(11) DEFAULT NULL,
  `Lugar_Que_Ocupa_Alumno` varchar(50) DEFAULT NULL,
  `Colegio_Procedencia_Alumno` varchar(100) DEFAULT NULL,
  `Nro_Matricula_Alumno` varchar(50) DEFAULT NULL,
  `Madre_ID` int(11) DEFAULT NULL,
  `Padre_ID` int(11) DEFAULT NULL,
  `Responsable_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `father`
--
ALTER TABLE `father`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `mother`
--
ALTER TABLE `mother`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Codigo_Alumno`),
  ADD KEY `Madre_ID` (`Madre_ID`),
  ADD KEY `Padre_ID` (`Padre_ID`),
  ADD KEY `Responsable_ID` (`Responsable_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `father`
--
ALTER TABLE `father`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mother`
--
ALTER TABLE `mother`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `responsable`
--
ALTER TABLE `responsable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Madre_ID`) REFERENCES `mother` (`ID`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`Padre_ID`) REFERENCES `father` (`ID`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`Responsable_ID`) REFERENCES `responsable` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
