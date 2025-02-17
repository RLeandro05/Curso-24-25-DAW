-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2024 a las 21:19:29
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
-- Base de datos: `cine`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'Ciencia ficción'),
(3, 'Terror'),
(5, 'Suspense'),
(11, 'Aventuras'),
(7, 'Comedia'),
(12, 'Drama');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interpretes`
--

CREATE TABLE `interpretes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `biografia` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `interpretes`
--

INSERT INTO `interpretes` (`id`, `nombre`, `apellidos`, `fecha_nacimiento`, `biografia`) VALUES
(1, 'Katharine', 'Hepburn', '1907-05-12', 'Katharine Hepburn nació el 12 de mayo de 1907 en Hartford, Connecticut, Estados Unidos. Fue una actriz y escritora, conocida por El león en invierno (1968), Historias de Filadelfia (1940) y En el estanque dorado (1981). Estuvo casada con Ludlow Ogden Smith. Murió el 29 de junio de 2003 en Connecticut, Estados Unidos.'),
(2, 'Humphrey', 'Bogart', '0000-00-00', 'Humphrey Bogart nació el 25 de diciembre de 1899 en Nueva York, Nueva York, EE.UU.. Fue un actor y productor, conocido por Casablanca (1942), En un lugar solitario (1950) y La reina de África (1951). Estuvo casado con Lauren Bacall, Mayo Methot, Mary Philips y Helen Menken. Murió el 14 de enero de 1957 en Los Ángeles, California, EE.UU..'),
(3, 'Roman', 'Griffin Davis', '2007-03-05', 'Roman Griffin Davis nació el 5 de marzo de 2007 en Londres, Inglaterra. Es un actor, conocido por Jojo Rabbit (2019) y Silent Night (2021).'),
(4, 'Thomasin', 'McKenzie', '2000-07-26', 'Thomasin McKenzie nació el 26 de julio de 2000 en Wellington, Nueva Zelanda. Es una actriz, conocida por Jojo Rabbit (2019), No dejes rastro (2018) y Última noche en el Soho (2021).'),
(5, 'Scarlett Ingrid', 'Johansson', '1984-11-22', 'Scarlett Johansson nació el 22 de noviembre de 1984 en Manhattan, Nueva York, Nueva York, Estados Unidos. Es una actriz y productora, conocida por Lost in Translation (2003), Her (2013) y Los Vengadores (2012). Está casada con Colin Jost desde octubre de 2020. Tienen un niño. Ha estado casada con Romain Dauriac y Ryan Reynolds.'),
(6, 'Taika', 'Waititi', '1975-08-16', 'Taika Waititi nació el 16 de agosto de 1975 en Wellington, Nueva Zelanda. Es un productor y escritor, conocido por Lo que hacemos en las sombras (2014), Jojo Rabbit (2019) y A la caza de los ñumanos (2016). Está casado con Rita Ora desde agosto de 2022. Ha estado casado con Chelsea Winstanley.'),
(7, 'Meryl', 'Streep', '1949-06-22', 'Meryl Streep nació el 22 de junio de 1949 en Summit, Nueva Jersey, EE.UU.. Es una actriz y escritora, conocida por Memorias de África (1985), La decisión de Sophie (1982) y Agosto (2013). Está casada con Don Gummer desde el 30 de septiembre de 1978. Tienen cuatro niños.'),
(8, 'Robert', 'Redford', '1936-08-18', 'Robert Redford nació el 18 de agosto de 1936 en Santa Mónica, California, EE.UU.. Es un productor y actor, conocido por El mejor (1984), Gente corriente (1980) y Dos hombres y un destino (1969). Está casado con Bylle Szaggars-Redford desde el 11 de julio de 2009. Ha estado casado con Lola Van Wagenen.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `id_genero` int(11) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `nombre`, `fecha`, `id_genero`, `sinopsis`) VALUES
(1, 'La reina de África', '1952-03-21', 11, 'Una imperativa mujer misionera consigue que un capitán de barco, amante de la ginebra, luche contra los alemanes en el Congo durante la Primera Guerra Mundial.'),
(2, 'Jojo Rabbit', '2019-09-08', 12, 'Durante la Segunda Guerra Mundial, un joven de las Juventudes Hitlerianas descubre que su madre está ocultando en su casa a una niña judía.'),
(3, 'Memorias de África', '1985-12-10', 12, 'A principios del Siglo XX, Karen Blixen, una mujer danesa, se establece en Kenia con su infiel esposo. Allí conocerá a un misterioso y solitario cazador.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas_interpretes`
--

CREATE TABLE `peliculas_interpretes` (
  `id_pelicula` int(11) NOT NULL,
  `id_interprete` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `peliculas_interpretes`
--

INSERT INTO `peliculas_interpretes` (`id_pelicula`, `id_interprete`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `interpretes`
--
ALTER TABLE `interpretes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peliculas_interpretes`
--
ALTER TABLE `peliculas_interpretes`
  ADD PRIMARY KEY (`id_pelicula`,`id_interprete`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `interpretes`
--
ALTER TABLE `interpretes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
