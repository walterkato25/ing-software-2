-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-06-2014 a las 16:49:00
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cookbook`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `idAutor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `mail` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apellido`, `mail`) VALUES
(3, 'Carlos', 'Carden', NULL),
(11, 'Walter', 'Kato', NULL),
(12, 'Federico', 'Agustin', NULL),
(13, 'Tomas', 'Bavo', NULL),
(14, 'Carmen', 'Valldejuli', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `Etiqueta` varchar(30) NOT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`idEtiqueta`, `Etiqueta`) VALUES
(13, 'Reposteria'),
(15, 'Viandas'),
(16, 'Jugos'),
(17, 'Minutas'),
(18, 'Criolla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMinimo` int(11) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `origen` varchar(20) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `resumen` text NOT NULL,
  `idioma` varchar(20) NOT NULL,
  `precio` double NOT NULL,
  `cantPaginas` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `isbn`, `stock`, `stockMinimo`, `img`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas`) VALUES
(39, '8888888888888', 34, 3, NULL, 'wwer', '23', 'wgsdgsdfg', 'Español', 3, 34),
(40, '5555555555555', 45, 4, NULL, 'rewrt', 'qwer', 'werfdgsd', 'Español', 45, 234),
(41, '3333333333333', 78, 9, NULL, 'dfghj', 'tyuiop', 'esfbsfhob', 'q', 34, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `idLibroAutor` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  PRIMARY KEY (`idLibroAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`idLibroAutor`, `idLibro`, `idAutor`) VALUES
(15, 0, 14),
(16, 0, 12),
(17, 0, 13),
(18, 0, 13),
(19, 0, 14),
(20, 0, 3),
(21, 0, 12),
(22, 0, 12),
(23, 39, 3),
(24, 40, 11),
(25, 40, 12),
(26, 41, 12),
(27, 41, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `idLibroEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  PRIMARY KEY (`idLibroEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`idLibroEtiqueta`, `idLibro`, `idEtiqueta`) VALUES
(9, 0, 18),
(10, 0, 15),
(11, 0, 15),
(12, 0, 15),
(13, 0, 13),
(14, 39, 15),
(15, 40, 15),
(16, 41, 13),
(17, 41, 16),
(18, 41, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidolibro`
--

CREATE TABLE IF NOT EXISTS `pedidolibro` (
  `idPedidoLibro` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`idPedidoLibro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreDeUsuario` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `fechaAlta` date NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `tel` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `piso` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `depto` varchar(10) NOT NULL,
  `dni/cuit` int(11) NOT NULL,
  `mail` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreDeUsuario` (`nombreDeUsuario`,`dni/cuit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
