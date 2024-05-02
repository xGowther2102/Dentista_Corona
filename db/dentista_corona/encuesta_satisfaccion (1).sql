-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2024 a las 06:02:49
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
-- Base de datos: `dentista_corona`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta_satisfaccion`
--

CREATE TABLE `encuesta_satisfaccion` (
  `id` int(11) NOT NULL,
  `comodidad_limpieza` int(11) DEFAULT NULL,
  `tiempo_espera` int(11) DEFAULT NULL,
  `atencion_doctor` int(11) DEFAULT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `encuesta_satisfaccion`
--

INSERT INTO `encuesta_satisfaccion` (`id`, `comodidad_limpieza`, `tiempo_espera`, `atencion_doctor`, `fecha_hora`) VALUES
(1, 1, 2, 5, '2024-05-01 22:56:03'),
(2, 3, 3, 3, '2024-05-01 23:00:41'),
(3, 5, 5, 4, '2024-05-01 23:02:44'),
(4, 4, 1, 1, '2024-05-01 23:02:52'),
(5, 4, 4, 4, '2024-05-01 23:38:24'),
(6, 5, 3, 3, '2024-05-02 01:03:36'),
(7, 5, 5, 5, '2024-05-02 03:29:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
