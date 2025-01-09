-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2023 a las 10:42:53
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basico_tarde`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(9) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `autonomia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `ciudad`, `provincia`, `autonomia`) VALUES
(1, 'Sevilla', 'Sevilla\r\n', 'Andalucía'),
(2, 'Coria del Río', 'Sevilla', 'Andalucía'),
(3, 'Pozoblanco', 'Córdoba\r\n', 'Andalucía'),
(4, 'Córdoba', 'Córdoba', 'Andalucía'),
(5, 'Tomares', 'Sevilla\r\n', 'Andalucía'),
(6, 'Huelva', 'Huelva', 'Andalucía'),
(7, 'Ayamonte', 'Huelva\r\n', 'Andalucía'),
(8, 'Lepe', 'Huelva', 'Andalucía'),
(9, 'Jerez', 'Cádiz\r\n', 'Andalucía'),
(10, 'Chiclana de la Frontera', 'Cádiz', 'Andalucía'),
(11, 'Cádiz', 'Cádiz\r\n', 'Andalucía'),
(12, 'Grazalema', 'Cádiz', 'Andalucía'),
(13, 'Mérida', 'Badajoz', 'Extremadura'),
(14, 'Badajoz', 'Badajoz\r\n', 'Extremadura'),
(15, 'Cáceres', 'Cáceres', 'Extremadura'),
(16, 'Plasencia', 'Cáceres\r\n', 'Extremadura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id` int(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_ciudad` int(9) NOT NULL,
  `id_genero` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `nombre`, `apellidos`, `email`, `id_ciudad`, `id_genero`) VALUES
(1, 'Manuela', 'López Gomara', 'mlopezgomara@email.com', 5, 1),
(2, 'Antonio', 'Manzano Gil', 'amgil@email.com', 1, 2),
(3, 'Marta', 'Vacas González', 'martavg@email.com', 2, 1),
(4, 'Alejandro', 'García Carrión', 'alexgc@email.com', 7, 2),
(5, 'Inmaculada', 'Sáez García', 'inmasaezgarcia@email.com', 1, 1),
(6, 'Francisco', 'Cruz Muñoz', 'asesoríafc@email.com', 9, 2),
(7, 'Jordi', 'Puig Hernández', 'jordipuig@email.com', 16, 2),
(8, 'Amparo', 'López López', 'lopezlopeza@email.com', 2, 1),
(9, 'Daniel', 'Cruz Fuentes', 'dcrufue018@g.educaand.es', 10, 2),
(10, 'Andrés', 'Sánchez Estévez', 'asanchez@email.com', 1, 2),
(11, 'Rosa', 'Quintero Padilla', 'rosamontero@email.com', 7, 1),
(12, 'María del Carmen', 'Díaz López', 'mcdiazlopez@email.com', 1, 1),
(24, 'Alfredo', 'Monasterio Galán', 'alfredo@email.com', 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id` int(9) NOT NULL,
  `genero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero`) VALUES
(1, 'Femenino'),
(2, 'Masculino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ciudad` (`id_ciudad`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
