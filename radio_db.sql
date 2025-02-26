-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2025 a las 05:52:01
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
-- Base de datos: `jp_radiodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabina`
--

CREATE TABLE `cabina` (
  `id_cabina` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cabina`
--

INSERT INTO `cabina` (`id_cabina`, `nombre`, `ubicacion`, `capacidad`) VALUES
(1, 'Cabina Principal', 'Avenida Central #123, Ciudad', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia`
--

CREATE TABLE `frecuencia` (
  `id_frecuencia` int(11) NOT NULL,
  `banda` varchar(50) NOT NULL,
  `frecuencia` decimal(5,2) NOT NULL,
  `estacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `frecuencia`
--

INSERT INTO `frecuencia` (`id_frecuencia`, `banda`, `frecuencia`, `estacion`) VALUES
(1, 'FM', 101.50, 'Radio Éxitos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locutores`
--

CREATE TABLE `locutores` (
  `id_locutor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `experiencia` int(11) DEFAULT NULL,
  `id_cabina` int(11) DEFAULT NULL,
  `id_frecuencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `locutores`
--

INSERT INTO `locutores` (`id_locutor`, `nombre`, `apellido`, `experiencia`, `id_cabina`, `id_frecuencia`) VALUES
(2, 'Carlos', 'Ramírez', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `musica`
--

CREATE TABLE `musica` (
  `id_musica` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `artista` varchar(100) NOT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `id_frecuencia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `musica`
--

INSERT INTO `musica` (`id_musica`, `titulo`, `artista`, `genero`, `duracion`, `id_frecuencia`) VALUES
(1, 'Bohemian Rhapsody', 'Queen', 'Rock', '00:05:55', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cabina`
--
ALTER TABLE `cabina`
  ADD PRIMARY KEY (`id_cabina`);

--
-- Indices de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  ADD PRIMARY KEY (`id_frecuencia`),
  ADD UNIQUE KEY `frecuencia` (`frecuencia`);

--
-- Indices de la tabla `locutores`
--
ALTER TABLE `locutores`
  ADD PRIMARY KEY (`id_locutor`),
  ADD KEY `id_cabina` (`id_cabina`),
  ADD KEY `id_frecuencia` (`id_frecuencia`);

--
-- Indices de la tabla `musica`
--
ALTER TABLE `musica`
  ADD PRIMARY KEY (`id_musica`),
  ADD KEY `id_frecuencia` (`id_frecuencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cabina`
--
ALTER TABLE `cabina`
  MODIFY `id_cabina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id_frecuencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `locutores`
--
ALTER TABLE `locutores`
  MODIFY `id_locutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `musica`
--
ALTER TABLE `musica`
  MODIFY `id_musica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `locutores`
--
ALTER TABLE `locutores`
  ADD CONSTRAINT `locutores_ibfk_1` FOREIGN KEY (`id_cabina`) REFERENCES `cabina` (`id_cabina`),
  ADD CONSTRAINT `locutores_ibfk_2` FOREIGN KEY (`id_frecuencia`) REFERENCES `frecuencia` (`id_frecuencia`);

--
-- Filtros para la tabla `musica`
--
ALTER TABLE `musica`
  ADD CONSTRAINT `musica_ibfk_1` FOREIGN KEY (`id_frecuencia`) REFERENCES `frecuencia` (`id_frecuencia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
