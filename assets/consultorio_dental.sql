-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-03-2024 a las 23:36:22
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
-- Base de datos: `consultorio_dental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tratamiento` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `id_pacientes` int(11) DEFAULT NULL,
  `doctor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `nombre`, `apellido_paterno`, `apellido_materno`, `tratamiento`, `fecha_hora`, `id_pacientes`, `doctor`) VALUES
(6, 'Luis ', 'Miguel', 'Barbosa', 'Dosis diaria de Paracetamol', '2023-11-22 18:00:00', 10, 'Hector A.'),
(7, 'Edwin Ronnyel', 'Hernandez', 'Peralta', 'Diente picado', '2023-11-22 19:00:00', 9, 'Hector A.'),
(8, 'Luis ', 'Miguel', 'Barbosa', 'Nada', '2023-11-22 17:50:00', 10, 'Jose A.'),
(9, 'Edwin Ronnyel', 'Hernandez', 'Peralta', 'Jugar al Programador', '2023-11-23 16:00:00', 9, 'Jose A.'),
(10, 'Gael Emmanuel', 'Juárez', 'Cabrera', 'L', '2023-11-24 18:36:00', 11, 'Hector A.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_pacientes` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enfermedades_padecidas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_pacientes`, `nombre`, `numero_telefono`, `correo_electronico`, `edad`, `sexo`, `enfermedades_padecidas`, `apellido_paterno`, `apellido_materno`) VALUES
(9, 'Edwin Ronnyel', '7462221234', 'prueba_guardarxdxd@gmail.com', 20, 'Masculino', 'Nada\r\n', 'Hernandez', 'Peralta'),
(10, 'Luis ', '5456789111', 'llha_diez@gmail.com', 45, 'Masculino', '._. xd', 'Miguel', 'Barbosa'),
(11, 'Gael Emmanuel', '25213970434', 'ereintony@gmail.com', 19, 'Masculino', 'Gripa', 'Juárez', 'Cabrera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reset_password`
--

INSERT INTO `reset_password` (`id`, `email`, `token`, `expires_at`) VALUES
(1, 'edwin.hpx@outlook.com', 'd5617f8ad75c6be51924b89d995f329a53429482', '2023-11-23 03:55:09'),
(2, 'edwin.hpx@gmail.com', 'a4762fa1d2e2dd8a433cd6a9885a0685039cf3c7', '2023-11-23 04:01:16'),
(3, 'edwin.hpx@gmail.com', 'ea9d247cc8b6bd866a0c3ebca8daa5b984b81e3e', '2023-11-23 04:07:14'),
(4, 'edwin.hpx@gmail.com', '6f12ff5dc95d908002b711d475e85d62278c093b', '2023-11-23 04:07:18'),
(5, 'edwin.hpx@gmail.com', '20f035522dd243ee993203b2477c54e7df8f44b9', '2023-11-23 04:13:07'),
(6, 'edwin.hpx@gmail.com', '533e5f3ede858ecd8feb21f5172d749f1e6c78a4', '2023-11-23 04:14:20'),
(7, 'edwin.hpx@gmail.com', 'a8e2385d113d0cb153373bc48d1c65edfdfb32bc', '2023-11-23 04:14:34'),
(8, 'edwin.hpx@gmail.com', '6002fde665d3adc31ffaf1729cfac226a221ec6d', '2023-11-23 04:26:33'),
(9, 'edwin.hpx@gmail.com', 'fad4fc0b1e644757b7fbf894d1ab141c25232138', '2023-11-23 04:26:47'),
(10, 'edwin.hpx@gmail.com', 'ca01c17a61e224655c06e354bddb685631f388b0', '2023-11-23 04:30:43'),
(11, 'edwin.hpx@gmail.com', 'b3b1ec7e0039c78a2344b1727f2af777a64ad390', '2023-11-23 04:30:54'),
(12, 'edwin.hpx@gmail.com', 'ed546da91eece4e0c3bf65b368018041c9bdb519', '2023-11-23 04:55:58'),
(13, 'edwin.hpx@gmail.com', '56f72f1a9335ee327e9ce5960a85925cf114c1f3', '2023-11-23 04:56:21'),
(14, 'edwin.hpx@gmail.com', 'a58432156b1d8eec97a0089b11d498b7298fc2bf', '2023-11-23 04:57:46'),
(15, 'edwin.hpx@gmail.com', 'e69b82a00aa117315fcbfa5052cf097d4bca6ce0', '2023-11-23 05:07:15'),
(16, 'edwin.hpx@gmail.com', 'a59176b6037bb36177148242a6fc12dc51c572ae', '2023-11-23 05:15:58'),
(17, 'edwin.hpx@gmail.com', 'd30dba11179c7aa12cd4a4d5f6209b30061d37b1', '2023-11-23 05:18:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `correo`, `contrasena`, `rol`) VALUES
(1, 'Juan Jose', 'admin_1', 'admin1@gmail.com', 'adminjose', 'administrador'),
(2, 'Juan Hector', 'admin_2', 'admin2@gmail.com', 'adminhector', 'administrador'),
(3, 'Juan Daniel', 'usuario1', 'usuario1@gmail.com', 'user', 'usuario'),
(4, 'FErca zzzz', 'culo_1', 'enfa_2@gmail.com', '1234', 'administrador'),
(7, 'Edwin Hernandez', 'edwinHPx', 'edwin.hpx@gmail.com', 'edwin135', 'administrador'),
(8, 'Gael Emanuel', 'HECTOR123', 'ereintony@gmail.com', 'hola1350', 'administrador'),
(10, 'carlos', 'admin', 'alberto@gmail.com', '1234ASas', 'administrador'),
(11, 'carlosA', 'bee', 'as4596071@gmail.com', 'AS1234567890', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `fk_pacientes` (`id_pacientes`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_pacientes`);

--
-- Indices de la tabla `reset_password`
--
ALTER TABLE `reset_password`
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
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_pacientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_pacientes` FOREIGN KEY (`id_pacientes`) REFERENCES `pacientes` (`id_pacientes`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
