-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2025 a las 07:06:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_solicitud`
--

CREATE TABLE `resumen_solicitud` (
  `id_solicitud` int(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` varchar(250) NOT NULL,
  `nota_usuario` varchar(255) NOT NULL,
  `nota_jefe` varchar(255) NOT NULL,
  `estado_jefe` varchar(255) NOT NULL,
  `nota_sistemas` varchar(255) NOT NULL,
  `estado_sistemas` varchar(255) NOT NULL,
  `aprobacion` varchar(250) NOT NULL,
  `asesor` varchar(100) DEFAULT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `evaluador` varchar(255) DEFAULT NULL,
  `hora_solucion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resumen_solicitud`
--

INSERT INTO `resumen_solicitud` (`id_solicitud`, `usuario_id`, `titulo`, `fecha`, `nota_usuario`, `nota_jefe`, `estado_jefe`, `nota_sistemas`, `estado_sistemas`, `aprobacion`, `asesor`, `nombre_usuario`, `evaluador`, `hora_solucion`) VALUES
(25, 23, 'Permiso pagina Tropi\r\nusuarrio: brian.acevedo', '21/04/2025 09:38:38 PM', 'Ruta permisos/facturacion/escritura', 'Aprobado por cartera', 'Aprobado', 'Permisos asignados', 'Aprobado', 'Pendiente', '23', 'Brian Acevedo', '27', '21/04/2025 09:39:47 PM'),
(26, 23, 'Permiso pimovi\r\nusuario: steven.ramirez', '21/04/2025 09:41:18 PM', 'Ruta pedidos/compras/aprobacion', 'Permisos solo para gerentes', 'Rechazado', 'Permisos solo para gerentes', 'Rechazado', 'Pendiente', '23', 'Brian Acevedo', '27', '21/04/2025 09:42:35 PM'),
(27, 23, 'permisos siesa\r\nusuario: steven.ramirez', '21/04/2025 10:33:03 PM', 'ruta: pedidos/cancelados', 'Aprobado por gerencia', 'Aprobado', 'Sistemas 003', 'Aprobado', 'Pendiente', '23', 'Brian Acevedo', '27', '21/04/2025 11:13:35 PM'),
(35, 23, 'Permisos area facturacion', '27/04/2025 09:49:29 AM', '<strong>Plataforma: </strong>Pimovi<strong> Usuario: </strong>brian.acevedo<strong> Nota: </strong>Ruta pedidos/aprobados', 'Aprobado por logistica', 'Aprobado', 'Permiso solo para gerentes', 'Rechazado', 'Pendiente', '23', 'Brian Acevedo', '27', '27/04/2025 09:52:41 AM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_grado`
--

CREATE TABLE `trabajo_grado` (
  `id_trabajo` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `autor1` varchar(250) NOT NULL,
  `autor2` varchar(250) DEFAULT NULL,
  `fecha_trabajo` varchar(250) NOT NULL,
  `resumen` varchar(250) NOT NULL,
  `abstract` varchar(250) NOT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `pclave1` varchar(100) NOT NULL,
  `pclave2` varchar(100) NOT NULL,
  `pclave3` varchar(100) NOT NULL,
  `pclave4` varchar(100) NOT NULL,
  `pclave5` varchar(100) NOT NULL,
  `pclave6` varchar(100) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `asesor` varchar(255) DEFAULT NULL,
  `evaluador` varchar(255) DEFAULT NULL,
  `estado_asesor` varchar(50) DEFAULT NULL,
  `conclusion_asesor` text DEFAULT NULL,
  `estado_evaluador` varchar(50) DEFAULT NULL,
  `conclusion_evaluador` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trabajo_grado`
--

INSERT INTO `trabajo_grado` (`id_trabajo`, `titulo`, `autor1`, `autor2`, `fecha_trabajo`, `resumen`, `abstract`, `archivo`, `pclave1`, `pclave2`, `pclave3`, `pclave4`, `pclave5`, `pclave6`, `usuario_id`, `asesor`, `evaluador`, `estado_asesor`, `conclusion_asesor`, `estado_evaluador`, `conclusion_evaluador`) VALUES
(14, 'Inteligencia Artificial', 'Brian Acevedo', 'Arley Lorenzo', '2024-11-25', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, ad.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt vero labore ut cum molestias cupiditate aperiam laboriosam rerum molestiae possimus, architecto sequi aliquid. Accusamus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt vero labore ut cum molestias cupiditate aperiam laboriosam rerum molestiae possimus, architecto sequi aliquid. Accusamus amet ipsum harum! Neque, eos est!.', 'uploads/20241125211019_Test123.pdf', 'IA', 'GOOGLE', 'MICROSOFT', 'CHAT', 'GPT', 'NVIDIA', 23, '26', '27', 'Pendiente', 'APROBADO 11:27PM POR CUMPLE LOS REQUISITOS', 'Rechazado', 'RECHAZADO 11:28PM'),
(15, 'Investigacion de Marketing', 'Mariano Castro', 'Samuel Alvarez', '2024-11-25', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae velit voluptate pariatur ipsam tenetur ducimus quibusdam laudantium corrupti, placeat accusamus?.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim doloribus, commodi facilis officiis impedit quisquam maxime. Dignissimos ipsum fugiat quo!', 'uploads/20241125211704_Test2.pdf', 'IA', 'KPG', 'KPI', 'ANALISIS', 'MARKET', 'CAP', 24, '26', '27', 'Aprobado', 'APROBADO JACINTO LINARES 123456', 'Aprobado', 'CONFIRMADO EMILIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `cc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `rol`, `cc`) VALUES
(23, 'Brian', 'Acevedo', 'brianacevedo2001@gmail.com', '$2y$10$Y5zHtMCJpGuMg4iTHxRWHeAf500I1XBTsIybAizwaxl24.H1JBjte', '1', '1004680'),
(24, 'Steven', 'Ramirez', 'brianace674@gmail.com', '$2y$10$pUUWqT4fH9QhqRhvIGzwrulC3nYNuPzHaGCOEsI9r99lVkS9dsw0.', '1', '1004689'),
(26, 'Dorian', 'Trujillo', 'jefe@grupotropi.com', '$2y$10$A4erWRvI8mJwtCb4XgVpoO/4iqifeerm6mJWAKWeC42s6a7FIx1H6', '3', '1004681'),
(27, 'Juan', 'Beltran', 'sistemas@grupotropi.com', '$2y$10$HRbjLC2cjHfw/AtfrEfZ5OayZtUuNOQRRQpbGvtR5b/.YtiCBzgiy', '4', '1004682'),
(30, 'Albeiro', 'Ortiz', 'admin@grupotropi.com', '$2y$10$plTR4N68.5n0N7ui9CtWtOnWASi2CmpmlY7GB4W3JjV6UpFeeClZm', '5', '1004683');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `resumen_solicitud`
--
ALTER TABLE `resumen_solicitud`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `trabajo_grado`
--
ALTER TABLE `trabajo_grado`
  ADD PRIMARY KEY (`id_trabajo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resumen_solicitud`
--
ALTER TABLE `resumen_solicitud`
  MODIFY `id_solicitud` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `trabajo_grado`
--
ALTER TABLE `trabajo_grado`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
