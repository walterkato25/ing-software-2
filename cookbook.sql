-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-06-2014 a las 12:13:51
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`idAutor`, `nombre`, `apellido`, `mail`) VALUES
(3, 'Federico', 'Agustin', NULL),
(11, 'Walter', 'Kato', NULL),
(13, 'Tomas', 'Carmona', NULL),
(14, 'Carmen', 'Valldejuli', NULL),
(17, 'Rodolfo', 'Pedroche', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `isbn`, `stock`, `stockMinimo`, `img`, `origen`, `nombre`, `resumen`, `idioma`, `precio`, `cantPaginas`) VALUES
(39, '3456546694576', 34, 23, NULL, 'Hong Kong', '23 recetas panificadas', 'Una maÃ±ana, tras un sueÃ±o intranquilo, Gregorio Samsa se despertÃ³ convertido en un monstruoso insecto. Estaba echado de espaldas sobre un duro caparazÃ³n y, al alzar la cabeza, vio su vientre convexo y oscuro, surcado por curvadas callosidades, sobre el que casi no se aguantaba la colcha, que estaba a punto de escurrirse hasta el suelo. Numerosas patas, penosamente delgadas en comparaciÃ³n con el grosor normal de sus piernas, se agitaban sin concierto. - Â¿QuÃ© me ha ocurrido? No estaba soÃ±ando. Su habitaciÃ³n, una habitaciÃ³n normal, aunque muy pequeÃ±a, tenÃ­a el aspecto habitual. Sobre la mesa habÃ­a desparramado un muestrario de paÃ±os - Samsa era viajante de comercio-, y de la pared colgaba una estampa recientemente recortada de una revista ilustrada y puesta en un marco dorado. La estampa mostraba a una mujer tocada con un gorro de pieles, envuelta en una estola tambiÃ©n de pieles, y que, muy erguida, esgrimÃ­a un amplio manguito, asimismo de piel, que ocultaba todo su antebrazo. Gregorio mirÃ³ hacia la ventana; estaba nublado, y sobre el cinc del alfÃ©izar repiqueteaban las gotas de lluvia, lo que le hizo sentir una gran melancolÃ­a. Â«Bueno -pensÃ³-; Â¿y si siguiese durmiendo un rato y me olvidase de', 'Noruego', 23.05, 234),
(42, '1817234689732', 35, 23, NULL, 'Argentina', 'Cocina criolla', 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es.Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', 'Castellano', 54.3, 20),
(43, '3333333333333', 9, 23, NULL, 'Griego', 'Cocinando en Microondas', 'Y, viÃ©ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: SÃ¡bete, Sancho, que no es un hombre mÃ¡s que otro si no hace mÃ¡s que otro. Todas estas borrascas que nos suceden son seÃ±ales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquÃ­ se sigue que, habiendo durado mucho el mal, el bien estÃ¡ ya cerca. AsÃ­ que, no debes congojarte por las desgracias que a mÃ­ me suceden, pues a ti no te cabe parte dellas.Y, viÃ©ndole don Quijote de aquella manera, con muestras de tanta tristeza, le dijo: SÃ¡bete, Sancho, que no es un hombre mÃ¡s que otro si no hace mÃ¡s que otro. Todas estas borrascas que nos suceden son seÃ±ales de que presto ha de serenar el tiempo y han de sucedernos bien las cosas; porque no es posible que el mal ni el bien sean durables, y de aquÃ­ se sigue que, habiendo durado mucho el mal, el bien estÃ¡ ya cerca. AsÃ­ que, no debes congojarte por las desgracias que a mÃ­ me suceden, pues a ti no', 'LatÃ­n', 20.25, 100),
(46, '2345354657456', 23, 5, NULL, 'Australia', 'Penas del joven Werther', 'Reina en mi espÃ­ritu una alegrÃ­a admirable, muy parecida a las dulces alboradas de la primavera, de que gozo aquÃ­ con delicia. Estoy solo, y me felicito de vivir en este paÃ­s, el mÃ¡s a propÃ³sito para almas como la mÃ­a, soy tan dichoso, mi querido amigo, me sojuzga de tal modo la idea de reposar, que no me ocupo de mi arte. Ahora no sabrÃ­a dibujar, ni siquiera hacer una lÃ­nea con el lÃ¡piz; y, sin embargo, jamÃ¡s he sido mejor pintor Cuando el valle se vela en torno mÃ­o con un encaje de vapores; cuando el sol de mediodÃ­a centellea sobre la impenetrable sombra de mi bosque sin conseguir otra cosa que filtrar entre las hojas algunos rayos que penetran hasta el fondo del santuario, cuando recostado sobre la crecida hierba, cerca de la cascada, mi vista, mÃ¡s prÃ³xima a la tierra, descubre multitud de menudas y diversas plantas; cuando siento mÃ¡s cerca de mi corazÃ³n los rumores de vida de ese pequeÃ±o mundo que palpita en los tallos de las hojas, y veo las formas innumerables e infinitas de los gusanillos y de los insectos; cuando siento, en fin, la presencia del Todopoderoso, que nos ha creado', 'Ingles', 134, 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE IF NOT EXISTS `libroautor` (
  `idLibroAutor` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  PRIMARY KEY (`idLibroAutor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `libroautor`
--

INSERT INTO `libroautor` (`idLibroAutor`, `idLibro`, `idAutor`) VALUES
(83, 43, 17),
(84, 39, 13),
(85, 39, 14),
(86, 42, 3),
(87, 42, 14),
(88, 46, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroetiqueta`
--

CREATE TABLE IF NOT EXISTS `libroetiqueta` (
  `idLibroEtiqueta` int(11) NOT NULL AUTO_INCREMENT,
  `idLibro` int(11) NOT NULL,
  `idEtiqueta` int(11) NOT NULL,
  PRIMARY KEY (`idLibroEtiqueta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Volcado de datos para la tabla `libroetiqueta`
--

INSERT INTO `libroetiqueta` (`idLibroEtiqueta`, `idLibro`, `idEtiqueta`) VALUES
(72, 43, 13),
(73, 39, 17),
(74, 39, 16),
(75, 39, 15),
(76, 42, 17),
(77, 42, 13),
(78, 42, 15),
(79, 46, 16),
(80, 46, 13);

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
