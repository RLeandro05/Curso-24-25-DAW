-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2024 a las 11:10:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `departamentos_profesores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Informática', 'Se encarga del romanticismo, es decir, del binario.\r\n\r\nEntre otras cosas.'),
(2, 'Matemáticas', 'Para que no te engañen cuando vas a pagar la invitación a cubatas de los amigos.'),
(3, 'Física', 'Para entender mejor porqué te caes cuando no te agarras bien'),
(4, 'Geografía e Historia', 'En resumen. Que es lo que pasó y ande pasó');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_civiles`
--

CREATE TABLE `estados_civiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `estados_civiles`
--

INSERT INTO `estados_civiles` (`id`, `nombre`) VALUES
(1, 'Soltera/o'),
(2, 'Casada/o'),
(5, 'Separada/o'),
(6, 'Divorciada/o'),
(7, 'Es complicado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_departamento` int(10) UNSIGNED NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `estado_civil` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `id_departamento`, `dni`, `nombre`, `apellidos`, `estado_civil`) VALUES
(1, 1, '27473339T', 'Marco Elio', 'García Gomariz', 1),
(3, 4, '11223344L', 'Doctor', 'Livingstone', 1),
(4, 4, '18181818F', 'Willy', 'Fog', 1),
(5, 4, '19191919E', 'Juan Sebastián', 'Elcano', 1),
(6, 1, '22334455T', 'Alan', 'Turing', 1),
(7, 2, '12312312P', 'Blaise', 'Pascal', 1),
(8, 2, '11111111K', 'Johannes', 'Kepler', 2),
(9, 2, '77777777B', 'Bernard', 'Bolzano', 1),
(10, 1, '55555555N', 'John', 'Von Neumann', 2),
(11, 2, '88888888F', 'Leonardo', 'Fibonacci', 1),
(12, 3, '10293847N', 'Isaac', 'Newton', 1),
(13, 3, '999999999', 'Galileo', 'Galilei', 1),
(14, 3, '13131313T', 'Nikola', 'Tesla', 1),
(15, 3, '14141414C', 'Nicolás', 'Copérnico', 1),
(16, 3, '15151515N', 'Alfred', 'Nobel', 1),
(17, 3, '16161616E', 'Albert', 'Einstein', 2),
(18, 3, '17171717H', 'Stephen William', 'Hawking', 2),
(19, 1, '44444444Z', 'Konrad', 'Zuse', 1),
(20, 1, '66666666D', 'Edsger', 'Dijkstra', 1),
(21, 1, '33333333T', 'Linus', 'Torvalds', 2),
(22, 1, '22222222S', 'Richard Matthew', 'Stallman', 7),
(221, 4, '27473339T', 'Que sobren', 'Datos para borrar', 1),
(227, 4, '27473339T', 'Prueba', 'Datos de prueba', 1),
(136, 4, '333333', 'Geografo', 'Geografía', 6),
(232, 4, '9908jklkj', 'Pruebas', 'son pruebas.', 1),
(233, 4, '908jklkj', 'Pruebas', 'son pruebas.', 1),
(240, 3, '34343433M', 'ljklkjlkj', 'jllkj', 1),
(231, 4, '9908jklkj', 'Pruebas', 'son pruebas.', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_civiles`
--
ALTER TABLE `estados_civiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estados_civiles`
--
ALTER TABLE `estados_civiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
