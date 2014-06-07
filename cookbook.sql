-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-06-2014 a las 01:58:24
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apellido`, `mail`) VALUES
(3, 'Rodolfo', 'Agustin', NULL),
(11, 'Walter', 'Kato', NULL),
(13, 'Tomas', 'Carmona', NULL),
(14, 'Carmen', 'Valldejuli', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `Etiqueta` varchar(30) NOT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`idEtiqueta`, `Etiqueta`) VALUES
(13, 'ReposterÃ­a'),
(15, 'Viandas'),
(16, 'Minutas'),
(17, 'Jugos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMinimo` int(11) NOT NULL,
  `img` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `resumen` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idioma` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `cantPaginas` int(11) NOT NULL,
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `isbn`, `stock`, `stockMinimo`, `img`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas`) VALUES
(39, '3456546694576', 34, 23, NULL, 'Hong Kong', '23 recetas panificadas', 'wgsdgsdfg', 'Noruego', 23.05, 234),
(42, '1817234689732', 35, 23, NULL, 'Argentina', 'Cocina criolla', 'Comida criolla', 'Castellano', 54.3, 20),
(43, '3333333333333', 9, 23, NULL, 'Griego', 'Cocinando en Microondas', 'asdffasdf', 'LatÃ­n', 20, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `idLibroAutor` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  PRIMARY KEY (`idLibroAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`idLibroAutor`, `idLibro`, `idAutor`) VALUES
(29, 42, 3),
(30, 42, 14),
(70, 43, 11),
(77, 39, 11),
(78, 39, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `idLibroEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  PRIMARY KEY (`idLibroEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`idLibroEtiqueta`, `idLibro`, `idEtiqueta`) VALUES
(21, 42, 17),
(22, 42, 13),
(23, 42, 15),
(59, 43, 13),
(64, 39, 16),
(65, 39, 17),
(66, 39, 15);

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
