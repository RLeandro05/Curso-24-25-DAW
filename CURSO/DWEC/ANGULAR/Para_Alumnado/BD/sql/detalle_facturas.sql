-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2015 a las 20:32:35
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pruebas_ajax`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_facturas`
--

CREATE TABLE IF NOT EXISTS `detalle_facturas` (
`ID` int(11) NOT NULL,
  `ID_FACTURA` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `CONCEPTO` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `PRECIO` double NOT NULL,
  `TIPO_IVA` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_facturas`
--

INSERT INTO `detalle_facturas` (`ID`, `ID_FACTURA`, `CANTIDAD`, `CONCEPTO`, `PRECIO`, `TIPO_IVA`) VALUES
(1, 1, 2, 'Salchicón de Lorca', 5.26, 4),
(2, 1, 4, 'Mortadela con olivas', 3.72, 4),
(3, 1, 3, 'Atún en escabeche', 4.83, 4),
(4, 1, 2, 'Pendrais de 16 GB', 8.23, 21),
(5, 2, 1, 'Jamón Bellota 7kg', 145, 4),
(6, 2, 4, 'Puntero laser rojo', 26.11, 21),
(7, 3, 2, 'Cuerda escalada 10.2 mm x 60 m.', 96.22, 21),
(8, 3, 10, 'Aseguradoras expres escalada', 7.4, 21),
(9, 4, 5, 'Gafas de sol pa chulearse', 67.5, 21),
(10, 4, 7, 'Fijador para el pelo con brillantina GREASE', 13.45, 7),
(11, 4, 4, 'Vaselina pa los labios', 4.3, 9),
(12, 5, 100, 'Profilácticos barriguitas', 0.7, 14),
(13, 5, 2, 'Colonia pachuli', 11, 21),
(14, 7, 2, 'Consolador momentos de soledad', 37.84, 21),
(15, 7, 3, 'Gel de Masaje Estimulante Durex Play 200 ml.', 11.05, 21),
(16, 7, 2, 'Baby-Doll con flecos', 21.99, 21),
(17, 7, 2, 'Sotana talla M', 250, 21);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
