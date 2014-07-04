-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-07-2014 a las 18:00:47
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apellido`, `mail`) VALUES
(3, 'Rodolfo', 'Dylan', NULL),
(13, 'Tomas', 'Carmona', NULL),
(14, 'Carmen', 'Valldejuli', NULL),
(17, 'Rodolfo', 'Pedroche', NULL),
(18, 'Tomas', 'Gago', NULL),
(19, 'Alfredo', 'Paz', NULL),
(20, 'Jorge', 'Jodos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `idEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `Etiqueta` varchar(30) NOT NULL,
  PRIMARY KEY (`idEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`idEtiqueta`, `Etiqueta`) VALUES
(13, 'ReposterÃ­a'),
(15, 'Vianda'),
(16, 'Minutas'),
(17, 'Jugos'),
(18, 'CafÃ©'),
(19, 'Agridulces'),
(24, 'Pastas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE IF NOT EXISTS `libro` (
  `idLibro` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `stockMinimo` int(11) NOT NULL,
  `img` tinytext CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `origen` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `resumen` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idioma` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `cantPaginas` int(11) NOT NULL,
  `baja` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLibro`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `isbn`, `stock`, `stockMinimo`, `img`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas`, `baja`) VALUES
(39, '1111111111111', 29, 23, '/portadas/Portada libro cocina 2008.jpg', 'Hong Kong', '23 recetas panificadas', 'Una maÃ±ana, tras un sueÃ±o intranquilo, Gregorio Samsa se despertÃ³ convertido en un monstruoso insecto. Estaba echado de espaldas sobre un duro caparazÃ³n y, al alzar la cabeza, vio su vientre convexo y oscuro, surcado por curvadas callosidades, sobre el que casi no se aguantaba la colcha, que estaba a punto de escurrirse hasta el suelo. Numerosas patas, penosamente delgadas en comparaciÃ³n con el grosor normal de sus piernas, se agitaban sin concierto. - Â¿QuÃ© me ha ocurrido? No estaba soÃ±ando. Su habitaciÃ³n, una habitaciÃ³n normal, aunque muy pequeÃ±a, tenÃ­a el aspecto habitual. Sobre la mesa habÃ­a desparramado un muestrario de paÃ±os - Samsa era viajante de comercio-, y de la pared colgaba una estampa recientemente recortada de una revista ilustrada y puesta en un marco dorado. La estampa mostraba a una mujer tocada con un gorro de pieles, envuelta en una estola tambiÃ©n de pieles, y que, muy erguida, esgrimÃ­a un amplio manguito, asimismo de piel, que ocultaba todo su antebrazo. Gregorio mirÃ³ hacia la ventana; estaba nublado, y sobre el cinc del alfÃ©izar repiqueteaban las gotas de lluvia, lo que le hizo sentir una gran melancolÃ­a. Â«Bueno -pensÃ³-; Â¿y si siguiese durmiendo un rato y me olvidase de', 'Noruego', 23.05, 234, 0),
(42, '1817234689732', 33, 23, '/portadas/1080_phaidonalianza.jpg', 'Argentina', 'Cocina criolla', 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es.Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', 'Castellano', 54.3, 20, 0),
(43, '3333333333333', 6, 23, '/portadas/consejos-para-ahorrar-en-la-cocina-9788466222891.jpg', 'Griego', 'Cocinando en Microondas', 'Y, viÃ©ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: SÃ¡bete, Sancho, que no es un hombre mÃ¡s que otro si no hace mÃ¡s que otro. Todas estas borrascas que nos suceden son seÃ±ales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquÃ­ se sigue que, habiendo durado mucho el mal, el bien estÃ¡ ya cerca. AsÃ­ que, no debes congojarte por las desgracias que a mÃ­ me suceden, pues a ti no te cabe parte dellas.Y, viÃ©ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: SÃ¡bete, Sancho, que no es un hombre mÃ¡s que otro si no hace mÃ¡s que otro. Todas estas borrascas que nos suceden son seÃ±ales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquÃ­ se sigue que, habiendo durado mucho el mal, el bien estÃ¡ ya cerca. AsÃ­ que, no debes congojarte por las desgracias que a mÃ­ me suceden, pues a ti no', 'LatÃ­n', 20.25, 89, 0),
(46, '2345354657456', 19, 5, '/portadas/portada-i6n62684.jpg', 'Australia', 'Penas del joven Werther', 'Reina en mi espÃ­ritu una alegrÃ­a admirable, muy parecida a las dulces alboradas de la primavera, de que gozo aquÃ­ con delicia. Estoy solo, y me felicito de vivir en este paÃ­s, el mÃ¡s a propÃ³sito para almas como la mÃ­a, soy tan dichoso, mi querido amigo, me sojuzga de tal modo la idea de reposar, que no me ocupo de mi arte. Ahora no sabrÃ­a dibujar, ni siquiera hacer una lÃ­nea con el lÃ¡piz; y, sin embargo, jamÃ¡s he sido mejor pintor Cuando el valle se vela en torno mÃ­o con un encaje de vapores; cuando el sol de mediodÃ­a centellea sobre la impenetrable sombra de mi bosque sin conseguir otra cosa que filtrar entre las hojas algunos rayos que penetran hasta el fondo del santuario, cuando recostado sobre la crecida hierba, cerca de la cascada, mi vista, mÃ¡s prÃ³xima a la tierra, descubre multitud de menudas y diversas plantas; cuando siento mÃ¡s cerca de mi corazÃ³n los rumores de vida de ese pequeÃ±o mundo que palpita en los tallos de las hojas, y veo las formas innumerables e infinitas de los gusanillos y de los insectos; cuando siento, en fin, la presencia del Todopoderoso, que nos ha creado', 'Ingles', 134, 123, 0),
(51, '1234124213412', 19, 2, '/portadas/consejos-para-ahorrar-en-la-cocina-9788466222891.jpg', 'asdf', 'asfd', 'werwq', 'asdf', 23, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `idLibroAutor` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  PRIMARY KEY (`idLibroAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=130 ;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`idLibroAutor`, `idLibro`, `idAutor`) VALUES
(93, 0, 18),
(94, 48, 18),
(95, 50, 13),
(112, 39, 13),
(113, 39, 19),
(114, 39, 14),
(115, 42, 3),
(116, 42, 18),
(117, 42, 19),
(118, 42, 17),
(119, 42, 14),
(121, 46, 13),
(128, 43, 13),
(129, 51, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `idLibroEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  PRIMARY KEY (`idLibroEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`idLibroEtiqueta`, `idLibro`, `idEtiqueta`) VALUES
(87, 0, 16),
(88, 48, 16),
(89, 50, 18),
(101, 39, 18),
(102, 39, 17),
(103, 39, 15),
(104, 42, 17),
(105, 42, 13),
(106, 42, 15),
(108, 46, 16),
(109, 46, 13),
(116, 43, 17),
(117, 51, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` int(11) NOT NULL,
  `monto` double NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `estado`, `timestamp`, `idUsuario`, `monto`) VALUES
(17, 'Pendiente', '2014-06-28 14:15:39', 3, 23.05);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidolibro`
--

CREATE TABLE IF NOT EXISTS `pedidolibro` (
  `idPedidoLibro` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'cantidad pedida por cada libros',
  PRIMARY KEY (`idPedidoLibro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `pedidolibro`
--

INSERT INTO `pedidolibro` (`idPedidoLibro`, `idLibro`, `idPedido`, `cantidad`) VALUES
(9, 42, 13, 1),
(10, 51, 14, 1),
(11, 39, 15, 1),
(12, 43, 16, 1),
(13, 39, 17, 1);

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
  `fechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `cp` int(11) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `piso` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `depto` varchar(10) NOT NULL,
  `dni_cuit` varchar(11) NOT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `baja` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreDeUsuario` (`nombreDeUsuario`,`dni_cuit`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreDeUsuario`, `password`, `apellido`, `nombre`, `fechaAlta`, `categoria`, `tel`, `cp`, `localidad`, `calle`, `piso`, `nro`, `depto`, `dni_cuit`, `mail`, `baja`) VALUES
(1, 'Admin', '1234', 'Llerena Suster', 'Jonatan Nahuel', '2014-05-05 03:00:00', 'administrador', '2214594942', 1897, 'Manuel B. Gonnet', '12', 23, 2985, '', '92739535', 'asdf@gmail.com', 0),
(2, 'Nahuel', '1234', 'Llerena ', 'Nahuel', '2014-06-23 03:00:00', 'usuario', '4840252', 1897, 'Manuel B. Gonnet', '11', 2, 2985, 'A', '20927395356', 'huelna@hotmail.com', 1),
(3, 'Cliente', '1234', 'compulsivo', 'compreta', '2014-06-25 03:00:00', 'usuario', '1241234124214', 1234, 'RinguelÃ©', '15', 3, 2985, 'B', '11111111111', 'sadf@asdf.cd', 0),
(4, 'qwerty', '123456', 'Tyuiop', 'Qwer', '2014-06-28 03:00:00', 'usuario', '1234567', 1234, 'Hudson', 'San Martin', 0, 2345, 'C', '98765432', 'qwerty@uiop.com', 1),
(5, 'pelon', '1234', 'panzalegre', 'pelon', '2014-07-04 15:01:39', 'usuario', '123', 1234, 'qwer', 'qwre', 0, 12, '', '12341234', 'pelon@panzale.gre', 0),
(6, 'qwer', 'qwer', 'qwer', 'qwer', '2014-07-04 15:05:26', 'usuario', '132', 1234, 'qwer', 'qwer', 0, 23, '', '12341233', 'qwer@qwer.qwer', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
