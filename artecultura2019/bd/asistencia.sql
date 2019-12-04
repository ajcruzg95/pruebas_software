-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2018 a las 06:09:58
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
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `IdAlumno` int(11) NOT NULL COMMENT 'El iD que identifica al registro Alumno',
  `AlumnoNombre` varchar(30) NOT NULL COMMENT 'El primer nombre del Alumno que se manejara',
  `AlumnoApellido` varchar(30) NOT NULL COMMENT 'El primer apellido  del Alumno que se manejara',
  `AlumnoCodigo` int(12) NOT NULL COMMENT 'El codigo de identificación del alumno  según la UNSA',
  `AlumnoCorreo` varchar(30) NOT NULL COMMENT 'Correo del alumno no necesariamente el institucional',
  `AlumnoCelular` int(12) NOT NULL COMMENT 'El numero celular del alumno no necesario para el proceso de matricula',
  `AlumnoContra` varchar(30) NOT NULL COMMENT 'Contraseña del alumno ',
  `AlumnoEstado` int(11) NOT NULL COMMENT 'El estado del registro del alumno , con esto es posible revisar si el alumno aun esta en la escuela'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`IdAlumno`, `AlumnoNombre`, `AlumnoApellido`, `AlumnoCodigo`, `AlumnoCorreo`, `AlumnoCelular`, `AlumnoContra`, `AlumnoEstado`) VALUES
(1, 'David', 'Deza', 20130873, 'ddezav', 941264670, 'hijodelafruna', 1),
(2, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 0),
(3, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(4, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(5, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(6, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(7, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(8, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(9, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(10, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(11, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(12, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(13, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(14, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(15, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(16, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(17, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(18, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(19, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(20, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(21, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(22, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(23, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(24, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(25, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(26, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(27, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(28, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(29, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(30, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(31, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(32, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(33, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(34, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(35, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(36, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(37, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(38, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(39, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(40, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(41, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(42, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(43, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(44, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(45, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(46, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(47, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(48, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(49, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(50, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(51, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(52, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(53, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(54, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(55, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(56, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(57, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(58, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(59, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(60, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(61, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(62, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(63, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(64, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(65, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(66, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1),
(67, 'casemiro', 'villegas', 20130873, 'ddezav', 941264670, 'dada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnogrupo`
--

CREATE TABLE `alumnogrupo` (
  `IdAlumnoGrupo` int(11) NOT NULL COMMENT 'Identificador de alumno grupo ',
  `IdGrupo` int(11) DEFAULT NULL COMMENT 'Clave foreanea del grupo a cual pertenece',
  `IdAlumno` int(11) DEFAULT NULL COMMENT 'Clave foranea del alumno',
  `AlumnoGrupoEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnogrupo`
--

INSERT INTO `alumnogrupo` (`IdAlumnoGrupo`, `IdGrupo`, `IdAlumno`, `AlumnoGrupoEstado`) VALUES
(1, 2, 2, 0),
(2, 2, 2, 1),
(3, 2, 2, 1),
(4, 2, 2, 1),
(5, 2, 2, 1),
(6, 2, 2, 1),
(7, 2, 2, 1),
(8, 2, 2, 1),
(9, 2, 2, 1),
(10, 2, 2, 1),
(11, 2, 2, 1),
(12, 2, 2, 1),
(13, 2, 2, 1),
(14, 2, 2, 1),
(15, 2, 2, 1),
(16, 2, 2, 1),
(17, 2, 2, 1),
(18, 2, 2, 1),
(19, 2, 2, 1),
(20, 2, 2, 1),
(21, 2, 2, 1),
(22, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaalumno`
--

CREATE TABLE `asistenciaalumno` (
  `IdAsistenciaAlumno` int(11) NOT NULL COMMENT 'Identificador principal de la clave asistencia alumno',
  `IdAlumno` int(11) DEFAULT NULL COMMENT 'Clave foranea del alumno',
  `IdAsistenciaDocente` int(11) DEFAULT NULL COMMENT 'Se relaciona con la asistencia del doncente ,  un alumno no puede tener asistencia si el docente no la tiene',
  `AsistenciaAlumnoEstado` int(11) NOT NULL COMMENT 'El estado del registro de la asistencia del alumno'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistenciaalumno`
--

INSERT INTO `asistenciaalumno` (`IdAsistenciaAlumno`, `IdAlumno`, `IdAsistenciaDocente`, `AsistenciaAlumnoEstado`) VALUES
(6, 2, 1, 1),
(7, 2, 1, 1),
(8, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciadocente`
--

CREATE TABLE `asistenciadocente` (
  `IdAsistenciaDocente` int(11) NOT NULL COMMENT 'Identificador de la asistencia del docente',
  `IdGrupo` int(11) DEFAULT NULL COMMENT 'clave foranea del grupo con el cual el docente se registra',
  `AistenciaDocenteFechaEntrada` datetime NOT NULL COMMENT 'incluye informacion de dia y de hora de entrada del docente',
  `AistenciaDocenteFechaSalida` datetime NOT NULL COMMENT 'Incluye informacion de salda y hora de salida del docente',
  `AsistenciaDocenteEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistenciadocente`
--

INSERT INTO `asistenciadocente` (`IdAsistenciaDocente`, `IdGrupo`, `AistenciaDocenteFechaEntrada`, `AistenciaDocenteFechaSalida`, `AsistenciaDocenteEstado`) VALUES
(1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 0),
(2, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(3, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(4, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(5, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(6, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(7, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(8, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(9, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(10, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(11, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(12, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(13, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(14, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(15, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(16, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(17, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(18, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `IdCurso` int(11) NOT NULL COMMENT 'Identificador del curso',
  `CursoNombre` varchar(40) NOT NULL COMMENT 'Nombre del curso que se va a llevar',
  `CursoCreditos` int(11) NOT NULL COMMENT 'Creditaje del curso   segun la escuela',
  `CursoEstado` int(11) NOT NULL COMMENT 'Estado del registro del curso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`IdCurso`, `CursoNombre`, `CursoCreditos`, `CursoEstado`) VALUES
(1, 'BD', 5, 1),
(2, 'ADA', 5, 0),
(47, 'ADA', 5, 1),
(48, 'SO', 5, 1),
(49, 'SD', 3, 0),
(50, 'SISTEMAS DISTRIBUIDOS', 30, 0),
(51, 'SD', 35, 0),
(52, 'IO', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `IdDia` int(11) NOT NULL COMMENT 'Identificador del dia',
  `DiaDescripcion` varchar(15) NOT NULL COMMENT 'Descripcion del dia establecido (Lunes, marte  ,etc)',
  `DiaEstado` int(11) NOT NULL COMMENT 'EStado del registro del dia'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`IdDia`, `DiaDescripcion`, `DiaEstado`) VALUES
(1, 'Lunes', 1),
(2, 'Martes', 0),
(3, 'MIERCOLES', 1),
(4, 'MIERCOLES', 1),
(5, 'MIERCOLES', 1),
(6, 'MIERCOLES', 1),
(7, 'MIERCOLES', 1),
(8, 'MIERCOLES', 1),
(9, 'MIERCOLES', 1),
(10, 'MIERCOLES', 1),
(11, 'MIERCOLES', 1),
(12, 'MIERCOLES', 1),
(13, 'MIERCOLES', 1),
(14, 'MIERCOLES', 1),
(15, 'MIERCOLES', 1),
(16, 'MIERCOLES', 1),
(17, 'MIERCOLES', 1),
(18, 'MIERCOLES', 1),
(19, 'MIERCOLES', 1),
(20, 'MIERCOLES', 1),
(21, 'MIERCOLES', 1),
(22, 'MIERCOLES', 1),
(23, 'MIERCOLES', 1),
(24, 'MIERCOLES', 1),
(25, 'MIERCOLES', 1),
(26, 'MIERCOLES', 1),
(27, 'MIERCOLES', 1),
(28, 'MIERCOLES', 1),
(29, 'MIERCOLES', 1),
(30, 'MIERCOLES', 1),
(31, 'MIERCOLES', 1),
(32, 'MIERCOLES', 1),
(33, 'MIERCOLES', 1),
(34, 'MIERCOLES', 1),
(35, 'MIERCOLES', 1),
(36, 'MIERCOLES', 1),
(37, 'MIERCOLES', 1),
(38, 'MIERCOLES', 1),
(39, 'MIERCOLES', 1),
(40, 'MIERCOLES', 1),
(41, 'MIERCOLES', 1),
(42, 'MIERCOLES', 1),
(43, 'MIERCOLES', 1),
(44, 'MIERCOLES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `IdDocente` int(11) NOT NULL COMMENT 'Identificador del docente',
  `DocenteNombre` varchar(30) NOT NULL COMMENT 'Primer nombre del docente ',
  `DocenteApellido` varchar(11) NOT NULL COMMENT 'Primer apellido del docente',
  `DocenteCodigo` int(11) NOT NULL COMMENT 'Código de la universidad para el docente',
  `DocenteDNI` varchar(8) NOT NULL COMMENT 'Documento nacional de identidad para el docente',
  `DoncenteContra` varchar(30) NOT NULL COMMENT 'Password del docente para ingresar al sistema',
  `DocenteCorreo` varchar(30) NOT NULL COMMENT 'Correo del docente no nesesariamente institucional',
  `DocenteCelular` varchar(11) NOT NULL COMMENT 'Telefono celular del docente ',
  `DocenteEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`IdDocente`, `DocenteNombre`, `DocenteApellido`, `DocenteCodigo`, `DocenteDNI`, `DoncenteContra`, `DocenteCorreo`, `DocenteCelular`, `DocenteEstado`) VALUES
(1, 'Cesar', 'Baluarte', 1111111, '09812345', '12345', 'cesar', '9999999', 1),
(2, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 0),
(3, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(4, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(5, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(6, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(7, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(8, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(9, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(10, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(11, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(12, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(13, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(14, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(15, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(16, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(17, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(18, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(19, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(20, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(21, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(22, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(23, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(24, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(25, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(26, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(27, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(28, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(29, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(30, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(31, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(32, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(33, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(34, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(35, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(36, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(37, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(38, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(39, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(40, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(41, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(42, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(43, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(44, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(45, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(46, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(47, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(48, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(49, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(50, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1),
(51, 'cesar', 'baluarte', 12312, '1', 'dddddd', 'cesasrb@gmail.com', '999999', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `IdGrupo` int(11) NOT NULL COMMENT 'Identificador del grupo',
  `IdCurso` int(11) DEFAULT NULL COMMENT 'Clave foránea para el atributo del curso',
  `IdDocente` int(11) DEFAULT NULL COMMENT 'Clave foranea que identifica al docente que maneja el grupo',
  `GrupoNombre` varchar(30) NOT NULL COMMENT 'Descripcion que diferencia a los distintos grupos de un mismo curso(A,B,C)',
  `GrupoEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`IdGrupo`, `IdCurso`, `IdDocente`, `GrupoNombre`, `GrupoEstado`) VALUES
(1, 1, 1, 'A', 1),
(2, 2, 2, 'B', 0),
(3, 2, 2, 'B', 0),
(4, 2, 2, 'B', 0),
(5, 2, 2, 'B', 0),
(6, 2, 2, 'B', 0),
(7, 2, 2, 'B', 0),
(8, 2, 2, 'B', 0),
(9, 2, 2, 'B', 0),
(10, 2, 2, 'B', 0),
(11, 2, 2, 'B', 0),
(12, 2, 2, 'B', 0),
(13, 2, 2, 'B', 0),
(14, 2, 2, 'B', 0),
(15, 2, 2, 'B', 0),
(16, 2, 2, 'B', 0),
(17, 2, 2, 'B', 0),
(18, 2, 2, 'B', 0),
(19, 2, 2, 'B', 0),
(20, 2, 2, 'B', 0),
(21, 2, 2, 'B', 0),
(22, 2, 2, 'B', 0),
(23, 2, 2, 'B', 0),
(24, 2, 2, 'B', 0),
(25, 2, 2, 'B', 0),
(26, 2, 2, 'B', 0),
(27, 2, 2, 'B', 0),
(28, 2, 2, 'B', 0),
(29, 2, 2, 'B', 0),
(30, 2, 2, 'B', 0),
(31, 2, 2, 'B', 0),
(32, 2, 2, 'B', 0),
(33, 2, 2, 'B', 0),
(34, 2, 2, 'B', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `IdHorario` int(11) NOT NULL COMMENT 'Identificador del horario ',
  `IdGrupo` int(11) DEFAULT NULL COMMENT 'Clave foránea que relaciona el grupo al cual pertenece el horario ',
  `IdLugar` int(11) DEFAULT NULL COMMENT 'Clave foranea que relaciona el lugar en la cual se llevara  a cabo el grupo',
  `IdDia` int(11) DEFAULT NULL COMMENT 'clave foranea para el dia en el cual se llevara a cabo el grupo',
  `HorarioEntrada` datetime NOT NULL COMMENT 'Hora de entrada asignada para el desarrollo de las actividades',
  `HorarioSalida` datetime NOT NULL COMMENT 'Hora de salida programada para el curso',
  `HorarioEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`IdHorario`, `IdGrupo`, `IdLugar`, `IdDia`, `HorarioEntrada`, `HorarioSalida`, `HorarioEstado`) VALUES
(1, 1, 1, 1, '2018-06-26 09:00:00', '2018-06-26 11:00:00', 1),
(2, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 0),
(3, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(4, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(5, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(6, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(7, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(8, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(9, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(10, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(11, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(12, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(13, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(14, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(15, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(16, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(17, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(18, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(19, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(20, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(21, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(22, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(23, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(24, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(25, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(26, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(27, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1),
(28, 2, 1, 2, '2018-06-26 06:00:00', '2018-06-26 11:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `IdLugar` int(11) NOT NULL COMMENT 'Idetificador de lugar',
  `LugarNombre` varchar(30) NOT NULL COMMENT 'En este caso numero del aula en la cual se realizan las actividades',
  `LugarEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`IdLugar`, `LugarNombre`, `LugarEstado`) VALUES
(1, 'AULA 301', 1),
(2, 'AULA 302', 1),
(3, 'AULA 303', 1),
(4, 'AULA 303', 1),
(5, 'AULA 303', 1),
(6, 'AULA 303', 1),
(7, 'AULA 303', 1),
(8, 'AULA 303', 1),
(9, 'AULA 303', 1),
(10, 'AULA 303', 1),
(11, 'AULA 303', 1),
(12, 'AULA 303', 1),
(13, 'AULA 303', 1),
(14, 'AULA 303', 1),
(15, 'AULA 303', 1),
(16, 'AULA 303', 1),
(17, 'AULA 303', 1),
(18, 'AULA 303', 1),
(19, 'AULA 303', 1),
(20, 'AULA 303', 1),
(21, 'AULA 303', 1),
(22, 'AULA 303', 1),
(23, 'AULA 303', 1),
(24, 'AULA 303', 1),
(25, 'AULA 303', 1),
(26, 'AULA 303', 1),
(27, 'AULA 303', 1),
(28, 'AULA 303', 1),
(29, 'AULA 303', 1),
(30, 'AULA 303', 1),
(31, 'AULA 303', 1),
(32, 'AULA 303', 1),
(33, 'AULA 303', 1),
(34, 'AULA 303', 1),
(35, 'AULA 303', 1),
(36, 'AULA 303', 1),
(37, 'AULA 303', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`IdAlumno`);

--
-- Indices de la tabla `alumnogrupo`
--
ALTER TABLE `alumnogrupo`
  ADD PRIMARY KEY (`IdAlumnoGrupo`),
  ADD KEY `IX_Relationship14` (`IdGrupo`),
  ADD KEY `IX_Relationship15` (`IdAlumno`),
  ADD KEY `IdGrupo` (`IdGrupo`),
  ADD KEY `IdAlumno` (`IdAlumno`);

--
-- Indices de la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  ADD PRIMARY KEY (`IdAsistenciaAlumno`),
  ADD KEY `IdAlumno` (`IdAlumno`),
  ADD KEY `IdAsistenciaDocente` (`IdAsistenciaDocente`);

--
-- Indices de la tabla `asistenciadocente`
--
ALTER TABLE `asistenciadocente`
  ADD PRIMARY KEY (`IdAsistenciaDocente`),
  ADD KEY `IX_Relationship13` (`IdGrupo`),
  ADD KEY `IdGrupo` (`IdGrupo`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`IdCurso`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`IdDia`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`IdDocente`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`IdGrupo`),
  ADD KEY `IX_Relationship12` (`IdDocente`),
  ADD KEY `IdGrupo` (`IdGrupo`),
  ADD KEY `IdDocente` (`IdDocente`),
  ADD KEY `IdCurso` (`IdCurso`),
  ADD KEY `IdCurso_2` (`IdCurso`),
  ADD KEY `IdDocente_2` (`IdDocente`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`IdHorario`),
  ADD KEY `IdGrupo` (`IdGrupo`),
  ADD KEY `IdLugar` (`IdLugar`),
  ADD KEY `IdDia` (`IdDia`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`IdLugar`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `IdAlumno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'El iD que identifica al registro Alumno', AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `alumnogrupo`
--
ALTER TABLE `alumnogrupo`
  MODIFY `IdAlumnoGrupo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de alumno grupo ', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  MODIFY `IdAsistenciaAlumno` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador principal de la clave asistencia alumno', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `asistenciadocente`
--
ALTER TABLE `asistenciadocente`
  MODIFY `IdAsistenciaDocente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la asistencia del docente', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `IdCurso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del curso', AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `IdDia` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del dia', AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `IdDocente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del docente', AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `IdGrupo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del grupo', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `IdHorario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del horario ', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `IdLugar` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Idetificador de lugar', AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnogrupo`
--
ALTER TABLE `alumnogrupo`
  ADD CONSTRAINT `alumnogrupo_ibfk_1` FOREIGN KEY (`IdGrupo`) REFERENCES `grupo` (`IdGrupo`),
  ADD CONSTRAINT `alumnogrupo_ibfk_2` FOREIGN KEY (`IdAlumno`) REFERENCES `alumno` (`IdAlumno`);

--
-- Filtros para la tabla `asistenciaalumno`
--
ALTER TABLE `asistenciaalumno`
  ADD CONSTRAINT `asistenciaalumno_ibfk_1` FOREIGN KEY (`IdAsistenciaDocente`) REFERENCES `asistenciadocente` (`IdAsistenciaDocente`);

--
-- Filtros para la tabla `asistenciadocente`
--
ALTER TABLE `asistenciadocente`
  ADD CONSTRAINT `asistenciadocente_ibfk_1` FOREIGN KEY (`IdGrupo`) REFERENCES `grupo` (`IdGrupo`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`IdDocente`) REFERENCES `docente` (`IdDocente`),
  ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`IdCurso`) REFERENCES `curso` (`IdCurso`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`IdGrupo`) REFERENCES `grupo` (`IdGrupo`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`IdDia`) REFERENCES `dia` (`IdDia`),
  ADD CONSTRAINT `horario_ibfk_3` FOREIGN KEY (`IdLugar`) REFERENCES `lugar` (`IdLugar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
