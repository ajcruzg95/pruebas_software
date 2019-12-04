-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2018 a las 23:36:02
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaalumno`
--

CREATE TABLE `asistenciaalumno` (
  `IdAsistenciaAlumno` int(11) NOT NULL COMMENT 'Identificador principal de la clave asistencia alumno',
  `IdAlumno` int(11) DEFAULT NULL COMMENT 'Clave foranea del alumno',
  `IdAsistenciaDocente` int(11) DEFAULT NULL COMMENT 'Se relaciona con la asistencia del doncente ,  un alumno no puede tener asistencia si el docente no la tiene',
  `AsistenciaAlumnoEstado` int(11) NOT NULL COMMENT 'El estado del registro de la asistencia del alumno',
  `AsistenciaAlumnoEstadoRegistro` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistenciaalumno`
--

INSERT INTO `asistenciaalumno` (`IdAsistenciaAlumno`, `IdAlumno`, `IdAsistenciaDocente`, `AsistenciaAlumnoEstado`, `AsistenciaAlumnoEstadoRegistro`) VALUES
(6, 2, 1, 1, 1),
(7, 2, 2, 1, 1),
(8, 2, 3, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  ADD PRIMARY KEY (`IdAsistenciaAlumno`),
  ADD KEY `IdAlumno` (`IdAlumno`),
  ADD KEY `IdAsistenciaDocente` (`IdAsistenciaDocente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  MODIFY `IdAsistenciaAlumno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador principal de la clave asistencia alumno', AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  ADD CONSTRAINT `asistenciaalumno_ibfk_1` FOREIGN KEY (`IdAsistenciaDocente`) REFERENCES `asistenciadocente` (`IdAsistenciaDocente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
