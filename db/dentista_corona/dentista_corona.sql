-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2024 a las 08:11:55
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
(7, 5, 5, 5, '2024-05-02 03:29:53'),
(8, 2, 4, 2, '2024-05-02 06:01:47'),
(9, 2, 1, 3, '2024-05-02 19:19:34'),
(10, 2, 3, 4, '2024-05-02 19:22:13'),
(11, 1, 2, 1, '2024-05-03 05:22:24'),
(12, 2, 3, 2, '2024-05-06 02:20:00'),
(13, 3, 4, 2, '2024-05-06 02:28:30'),
(14, 5, 5, 3, '2024-05-06 02:36:24'),
(15, 2, 3, 3, '2024-05-06 02:38:11'),
(16, 3, 3, 2, '2024-05-06 02:40:14'),
(17, 4, 2, 5, '2024-05-06 22:14:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `correo`, `password`) VALUES
(1, 'Edwin Ronnyel vv', 'qwerty', 'prueba_guardarxdxd@gmail.com', 'Edwin135');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
