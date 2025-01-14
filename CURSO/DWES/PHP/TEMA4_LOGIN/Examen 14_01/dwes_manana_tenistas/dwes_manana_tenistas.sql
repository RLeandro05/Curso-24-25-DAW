-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2023 a las 11:32:05
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
-- Base de datos: `dwes_tarde_tenistas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `superficies`
--

CREATE TABLE `superficies` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `superficies`
--

INSERT INTO `superficies` (`id`, `nombre`) VALUES
(1, 'Dura'),
(2, 'Arcilla'),
(3, 'Hierba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenistas`
--

CREATE TABLE `tenistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `altura` int(3) NOT NULL,
  `mano` enum('Diestro','Zurdo') NOT NULL,
  `anno_nacimiento` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tenistas`
--

INSERT INTO `tenistas` (`id`, `nombre`, `apellidos`, `altura`, `mano`, `anno_nacimiento`) VALUES
(1, 'Rafael', 'Nadal', 185, 'Zurdo', 1986),
(2, 'Novak', 'Djokovic', 188, 'Diestro', 1987),
(3, 'Roger', 'Federer', 185, 'Diestro', 1981),
(4, 'Pete', 'Sampras', 185, 'Diestro', 1971),
(5, 'Björn', 'Borg', 180, 'Diestro', 1956),
(6, 'Ivan', 'Lendl', 187, 'Diestro', 1960),
(7, 'Jinny', 'Connors', 178, 'Zurdo', 1952),
(8, 'Andre', 'Agassi', 180, 'Diestro', 1970),
(9, 'John', 'McEnroe', 180, 'Zurdo', 1959),
(10, 'Mats', 'Wilander', 183, 'Diestro', 1964),
(11, 'Stefan', 'Edberg', 188, 'Diestro', 1966),
(12, 'Boris', 'Becker', 190, 'Diestro', 1967),
(13, 'Andy', 'Murray', 188, 'Diestro', 1987),
(14, 'Stan', 'Wawrinka', 183, 'Diestro', 1985),
(15, 'Carlos', 'Álcaraz', 183, 'Diestro', 2003),
(16, 'Alexander ', 'Zverev', 198, 'Diestro', 1997),
(17, 'John', 'Isner', 208, 'Diestro', 1985),
(19, 'Juan', 'Martín del Potro', 198, 'Diestro', 1988);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `anno` int(11) NOT NULL,
  `tenista_id` int(11) NOT NULL,
  `torneo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `titulos`
--

INSERT INTO `titulos` (`anno`, `tenista_id`, `torneo_id`) VALUES
(1974, 5, 2),
(1974, 7, 1),
(1974, 7, 3),
(1974, 7, 4),
(1975, 5, 2),
(1976, 5, 3),
(1976, 7, 4),
(1977, 5, 3),
(1978, 5, 2),
(1978, 5, 3),
(1978, 7, 4),
(1979, 5, 2),
(1979, 5, 3),
(1979, 9, 4),
(1980, 5, 2),
(1980, 5, 3),
(1980, 9, 4),
(1981, 5, 2),
(1981, 9, 3),
(1981, 9, 4),
(1982, 7, 3),
(1982, 7, 4),
(1983, 7, 4),
(1983, 9, 3),
(1983, 10, 1),
(1984, 6, 2),
(1984, 9, 3),
(1984, 9, 4),
(1984, 10, 1),
(1985, 6, 4),
(1985, 11, 1),
(1985, 12, 3),
(1986, 6, 2),
(1986, 6, 4),
(1986, 12, 3),
(1987, 6, 2),
(1987, 6, 4),
(1987, 11, 1),
(1988, 10, 1),
(1988, 10, 2),
(1988, 10, 4),
(1988, 11, 3),
(1989, 6, 1),
(1989, 12, 3),
(1989, 12, 4),
(1990, 4, 3),
(1990, 4, 4),
(1990, 6, 1),
(1990, 11, 3),
(1991, 11, 4),
(1991, 12, 1),
(1992, 8, 3),
(1992, 11, 4),
(1993, 4, 4),
(1994, 4, 1),
(1994, 4, 3),
(1994, 8, 4),
(1995, 4, 3),
(1995, 4, 4),
(1995, 10, 2),
(1996, 4, 4),
(1996, 12, 1),
(1997, 4, 1),
(1997, 4, 3),
(1998, 4, 3),
(1998, 8, 1),
(1998, 10, 2),
(1999, 4, 3),
(1999, 8, 2),
(1999, 8, 4),
(2000, 4, 3),
(2000, 8, 1),
(2001, 8, 1),
(2002, 4, 4),
(2003, 3, 3),
(2003, 8, 1),
(2004, 3, 1),
(2004, 3, 3),
(2004, 3, 4),
(2005, 1, 2),
(2005, 3, 3),
(2005, 3, 4),
(2006, 1, 2),
(2006, 3, 1),
(2006, 3, 3),
(2006, 3, 4),
(2007, 1, 2),
(2007, 3, 1),
(2007, 3, 3),
(2007, 3, 4),
(2008, 1, 2),
(2008, 1, 3),
(2008, 2, 1),
(2008, 3, 4),
(2009, 1, 1),
(2009, 3, 2),
(2009, 3, 3),
(2009, 19, 4),
(2010, 1, 2),
(2010, 1, 3),
(2010, 1, 4),
(2010, 3, 1),
(2011, 1, 2),
(2011, 2, 1),
(2011, 2, 3),
(2011, 2, 4),
(2012, 1, 2),
(2012, 2, 1),
(2012, 3, 3),
(2012, 13, 4),
(2013, 1, 2),
(2013, 1, 4),
(2013, 2, 1),
(2013, 13, 3),
(2014, 1, 2),
(2014, 2, 3),
(2014, 14, 1),
(2015, 2, 1),
(2015, 2, 3),
(2015, 2, 4),
(2015, 14, 2),
(2016, 2, 1),
(2016, 2, 2),
(2016, 13, 3),
(2016, 14, 4),
(2017, 1, 2),
(2017, 1, 4),
(2017, 3, 1),
(2017, 3, 3),
(2018, 1, 2),
(2018, 2, 3),
(2018, 2, 4),
(2018, 3, 1),
(2019, 1, 2),
(2019, 1, 4),
(2019, 2, 1),
(2019, 2, 3),
(2020, 1, 2),
(2020, 2, 1),
(2021, 2, 1),
(2021, 2, 2),
(2021, 2, 3),
(2022, 1, 1),
(2022, 1, 2),
(2022, 2, 3),
(2022, 15, 4),
(2023, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `superficie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `ciudad`, `superficie_id`) VALUES
(1, 'Australian Open', 'Melbourne', 1),
(2, 'Roland Garros', 'París', 2),
(3, 'Wimbledon', 'Londres', 3),
(4, 'US Open', 'Nueva York', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(9) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `rol`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'TOTAL'),
(2, 'consulta', '*C09343BB7BFE0530FCF27E62FC6E500B683F2888', 'VER');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `superficies`
--
ALTER TABLE `superficies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tenistas`
--
ALTER TABLE `tenistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`anno`,`tenista_id`,`torneo_id`),
  ADD KEY `tenista_id` (`tenista_id`),
  ADD KEY `torneo_id` (`torneo_id`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `superficie_id` (`superficie_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `superficies`
--
ALTER TABLE `superficies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tenistas`
--
ALTER TABLE `tenistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD CONSTRAINT `titulos_ibfk_1` FOREIGN KEY (`tenista_id`) REFERENCES `tenistas` (`id`),
  ADD CONSTRAINT `titulos_ibfk_2` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id`);

--
-- Filtros para la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD CONSTRAINT `torneos_ibfk_1` FOREIGN KEY (`superficie_id`) REFERENCES `superficies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
