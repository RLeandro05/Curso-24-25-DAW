-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2020 a las 21:55:31
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ajax`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `ID` int(11) NOT NULL,
  `DNI` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `APELLIDOS` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID`, `DNI`, `NOMBRE`, `APELLIDOS`) VALUES
(1, '12345', 'Filemón', 'Pi'),
(2, '27473339T', 'Marco Elio', 'García Gomariz'),
(41, '345678J', 'David', 'García Gomariz'),
(46, '99999M', 'Miguel Angel', 'García'),
(51, '354344334', 'Anacleto', 'Agente Secreto'),
(183, '12345678', 'Rigoberto', 'Rigo'),
(191, '12345678M', 'Lucas', 'Sinclair'),
(110, '12345678M', 'Pippi', 'Långstrump'),
(222, '27473339T', 'Forrest', 'Gump'),
(231, 'Borrar', 'Pa borrar', 'borralo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
