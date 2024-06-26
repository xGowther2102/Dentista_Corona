-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2024 a las 23:26:46
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
-- Base de datos: `dentista_corona`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_paterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_materno` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tratamiento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `estatus` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `tratamiento`, `fecha_hora`, `paciente_id`, `estatus`) VALUES
(2, 'alberto', 'santiago', 'santiago', 'caries', '2024-05-13 16:55:00', 1, 'pendiente');

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
(17, 4, 2, 5, '2024-05-06 22:14:23'),
(18, 2, 3, 3, '2024-05-07 20:17:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `historial_medico` text DEFAULT NULL,
  `sexo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `telefono`, `email`, `fecha_nacimiento`, `direccion`, `historial_medico`, `sexo`) VALUES
(1, 'alberto', 'andres', 'santiago', '2349872180', 'albert@gmail.com', '2003-01-14', 'mexico', 'picado', 'hombre'),
(4, 'doralina', 'santiago', 'santiago', '6789053467', 'doralina34@gmail.com', '2003-12-11', 'loma', 'femenino', 'dientes'),
(5, 'alberto', 'santiago', 'santiago', '6789053467', 'de_cartoncito@gmail.com', '2003-12-25', 'loma', 'masculino', 'muela picada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reset_password`
--

INSERT INTO `reset_password` (`id`, `correo`, `token`, `expires_at`) VALUES
(1, 're4tacho@gmail.com', '6813e22438c14dd784ada22606762139aa66bd68', '2024-05-07 12:40:40'),
(2, 're4tacho@gmail.com', 'e7bb6405253cfac4d03227786703cdea167889a3', '2024-05-07 12:42:28'),
(3, 're4tacho@gmail.com', '79a7557a85d3c444d7048599a9c51f8dd895f092', '2024-05-07 12:44:27'),
(4, 're4tacho@gmail.com', '07bb59a71313eb8c6844963c91eacc4ceaf0303e', '2024-05-07 12:45:00'),
(5, 're4tacho@gmail.com', 'f60306f7a49a695d3467d35d663938f9dea9e544', '2024-05-07 12:45:17'),
(12, 're4tacho@gmail.com', '862a33247ebf10699f89678456c2dad31b9ee292', '2024-05-07 19:52:56'),
(15, 're4tacho@gmail.com', 'd6223f4055aeadc782f558583cabde26a78f98f4', '2024-05-07 20:16:26'),
(16, 're4tacho@gmail.com', '83cedcfde9079660e5c5d0018bd97131114e2cd1', '2024-05-07 20:17:01'),
(17, 'prueba_guardarxdxd@gmail.com', 'efef337621c359b39db62906ce77acecd95db787', '2024-05-07 20:17:07'),
(18, 'prueba_guardarxdxd@gmail.com', '132f0887eab150636e13fa6e5bd7114e4f59b06d', '2024-05-07 20:17:29'),
(19, 're4tacho@gmail.com', 'bf2200ca20097c9067c5c15c65b360010dede975', '2024-05-07 20:17:33'),
(20, 're4tacho@gmail.com', 'e75d8b82eca4c87c2935aea15264149e9eaa89e6', '2024-05-07 20:24:04'),
(21, 're4tacho@gmail.com', '12ceb71bbd0929d23dafd4e57997fa2e8dca85c0', '2024-05-07 22:15:42'),
(22, 're4tacho@gmail.com', '4ff18e9b447e6d9a56ad38d538e55d80e28471c5', '2024-05-07 22:22:17'),
(23, 're4tacho@gmail.com', '00af0ffd86c6e24309d0f5e6efcb8f3ddc7a5b1e', '2024-05-07 22:23:10'),
(24, 're4tacho@gmail.com', 'be09a5aa9a88234445fdcc5dcffe11f57dbe70e7', '2024-05-07 22:24:57'),
(25, 're4tacho@gmail.com', '21b2173cd3dc0a01ccbdfdc30802ae6f1db51156', '2024-05-07 22:25:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `correo`, `password`) VALUES
(5, 'alberto', 'es_un_muñeco', 'de_cartoncito@gmail.com', '12carlosAS'),
(6, 'doralina', 'doralina7', 'doralina34@gmail.com', 'as12hioA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paciente` (`paciente_id`);

--
-- Indices de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `encuesta_satisfaccion`
--
ALTER TABLE `encuesta_satisfaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
