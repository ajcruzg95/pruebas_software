-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2018 a las 08:23:32
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistenciapermiso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `IdAcceso` int(11) NOT NULL,
  `AccesoNombre` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`IdAcceso`, `AccesoNombre`) VALUES
(1, 'GESTION ALUMNOS'),
(2, 'GESTION CURSOS'),
(3, 'GESTION INSTRUCTOR'),
(4, 'GESTION AMBIENTES'),
(5, 'GESTION HORARIOS'),
(6, 'HABILITAR TALLER'),
(7, 'REPORTE DE ASISTENCIA CURSO'),
(8, 'REPORTE DE ASISTENCIA ALUMNO'),
(9, 'TOMAR ASISTENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesocab`
--

CREATE TABLE `accesocab` (
  `IdAccesoCab` int(11) NOT NULL,
  `IdTipoUsuario` int(11) DEFAULT NULL,
  `IdAcceso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `accesocab`
--

INSERT INTO `accesocab` (`IdAccesoCab`, `IdTipoUsuario`, `IdAcceso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 8),
(10, 2, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `IdTipoUsuario` int(11) NOT NULL,
  `TipoUsuarioNombre` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`IdTipoUsuario`, `TipoUsuarioNombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'DOCENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdTipoUsuario` int(11) DEFAULT NULL,
  `UsuarioNombre` char(50) DEFAULT NULL,
  `UsuarioApellido` char(50) DEFAULT NULL,
  `UsuarioContrasenia` char(50) DEFAULT NULL,
  `UsuarioEstReg` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `IdTipoUsuario`, `UsuarioNombre`, `UsuarioApellido`, `UsuarioContrasenia`, `UsuarioEstReg`) VALUES
(10101010, 2, 'JAKELINE', 'DEZA VELIZ', 'china', 1),
(10293847, 2, 'RICHARD', 'VENTURA COSI', 'richard', 1),
(12345678, 2, 'pepe', 'asdas as dasdas', 'pepe', 1),
(20202020, 2, 'VICTORIA', 'VELIZ PUMAYALLI', 'victoria', 1),
(23456789, 2, 'David', 'asdas', 'asd', 1),
(27011996, 2, 'MARGOT', 'VELIZ PUMAYALLI', 'margot', 1),
(70403157, 2, 'gg', 'gg', 'admin', 1),
(77678383, 1, 'administrador', 'administrador', 'admin', 1),
(77679090, 2, 'David', 'Delgado Veliz', 'asd', 1),
(80808080, 2, 'pablo', 'moran carrasco', 'asd', 1),
(90909090, 2, 'JUAN', 'RAMIREZ GALLARDO', 'asd', 1),
(192837465, 2, 'RICHARD', 'VENTURA COSI', 'richard', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`IdAcceso`);

--
-- Indices de la tabla `accesocab`
--
ALTER TABLE `accesocab`
  ADD PRIMARY KEY (`IdAccesoCab`),
  ADD KEY `Relationship8` (`IdTipoUsuario`),
  ADD KEY `Relationship11` (`IdAcceso`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`IdTipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `Relationship9` (`IdTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `IdAcceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `accesocab`
--
ALTER TABLE `accesocab`
  MODIFY `IdAccesoCab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `IdTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesocab`
--
ALTER TABLE `accesocab`
  ADD CONSTRAINT `Relationship11` FOREIGN KEY (`IdAcceso`) REFERENCES `acceso` (`IdAcceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Relationship8` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`IdTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Relationship9` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`IdTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
