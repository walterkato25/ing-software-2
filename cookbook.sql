-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-06-2014 a las 01:44:34
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apellido`, `mail`) VALUES
(3, 'Carlos', 'Carden', NULL),
(6, 'asdfsad', 'sfdbdfb', NULL),
(7, 'zxvxzcv', 'asdfsdf', NULL),
(8, 'xzvxzcv', 'xcvzxcv', NULL),
(9, 'hjljkl', 'rtyeyr', NULL),
(10, 'cvbncvbn', 'fghdfgh', NULL),
(11, 'Walter', 'Kato', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `Etiqueta` varchar(30) NOT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`idEtiqueta`, `Etiqueta`) VALUES
(12, 'Minutas'),
(13, 'Reposteria'),
(14, 'Etiqueta14'),
(15, 'Etiqueta16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMinimo` int(11) NOT NULL,
  `img` varchar(50) DEFAULT NULL,
  `origen` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `resumen` text NOT NULL,
  `idioma` varchar(20) NOT NULL,
  `precio` double NOT NULL,
  `cantPaginas` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `isbn` (`isbn`,`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `isbn`, `stock`, `stockMinimo`, `img`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas`) VALUES
(1, 2147483647, 23, 2, NULL, 'no se', 'alguno', 'abuuuurrido', 'frances', 34.15, 23),
(2, 45675467, 4, 1, NULL, 'sadfsdf', 'qerewr', 'dfsadfsdfsadfasdf', 'qwer', 34, 123),
(3, 21341242, 76, 5, NULL, 'qwerwqer', 'werwq', 'werqwerw', 'qwerwer', 56, 2134),
(4, 0, 0, 0, NULL, '', '', '', '', 0, 0),
(5, 5, 32, 3, NULL, 'asdf', 'dafs', 'sdfasdf', 'asdf', 0.1, 3),
(6, 2345, 0, 0, NULL, '', '', '', '', 0, 0),
(8, 3465, 0, 0, NULL, '', '', '', '', 0, 0),
(10, 5678, 0, 0, NULL, '', '', '', '', 0, 0),
(11, 9870, 0, 0, NULL, '', '', '', '', 0, 0),
(13, 2, 0, 0, NULL, '', '', '', '', 0, 0),
(15, 56, 0, 0, NULL, '', '', '', '', 0, 0),
(16, 7777, 0, 0, NULL, '', '', '', '', 0, 0),
(19, 3333, 0, 0, NULL, '', '', '', '', 0, 0),
(20, 5544, 0, 0, NULL, '', '', '', '', 0, 0),
(21, 666, 0, 0, NULL, '', '', '', '', 0, 1234),
(28, 786549, 0, 0, NULL, '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `idLibroAutor` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  PRIMARY KEY (`idLibroAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`idLibroAutor`, `idLibro`, `idAutor`) VALUES
(1, 10, 3),
(2, 10, 6),
(3, 11, 6),
(4, 11, 7),
(5, 13, 6),
(6, 16, 3),
(7, 16, 6),
(8, 21, 8),
(9, 21, 9),
(10, 21, 10),
(11, 21, 11),
(12, 28, 3),
(13, 28, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `idLibroEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  PRIMARY KEY (`idLibroEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`idLibroEtiqueta`, `idLibro`, `idEtiqueta`) VALUES
(1, 15, 12),
(2, 19, 12),
(3, 19, 13),
(4, 20, 12),
(5, 20, 13),
(6, 28, 12),
(7, 28, 13);

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
