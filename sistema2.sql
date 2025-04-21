-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2025 a las 03:10:41
-- Tiempo de generación: 17-04-2025 a las 00:20:25
>>>>>>> 2d9fb6e (Volviendo a la version 7bff)
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
<<<<<<< HEAD
  `aprobacion` varchar(250) NOT NULL,
  `asesor` varchar(100) DEFAULT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL
=======
  `aprobacion` varchar(250) NOT NULL
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resumen_solicitud`
--

<<<<<<< HEAD
INSERT INTO `resumen_solicitud` (`id_solicitud`, `usuario_id`, `titulo`, `fecha`, `nota_usuario`, `nota_jefe`, `estado_jefe`, `nota_sistemas`, `estado_sistemas`, `aprobacion`, `asesor`, `nombre_usuario`) VALUES
(16, 23, 'Permisos celular\r\ncelular: Brian', '17/04/2025 00:17:33', 'Permisos', 'Rechazado por que no hay celulares', 'Rechazado', 'Pendiente Sistemas', 'Pendiente', 'Pendiente', NULL, 'Brian Acevedo'),
(17, 23, 'Permisos Pimovi\r\nusuario: brian.acevedo', '17/04/2025 09:03:25', 'Ruta pimovi/pedidos/autorizados', 'Aprobado solo ruta de pedidos', 'Aprobado', 'Pendiente Sistemas', 'Pendiente', 'Pendiente', NULL, 'Brian Acevedo');
=======
INSERT INTO `resumen_solicitud` (`id_solicitud`, `usuario_id`, `titulo`, `fecha`, `nota_usuario`, `nota_jefe`, `estado_jefe`, `nota_sistemas`, `estado_sistemas`, `aprobacion`) VALUES
(1, 23, 'Permisos Siesa', '16/04/2025', 'Permisos / Facturador / Notas Credito\r\nusuario: brian.acevedo', 'Aprobado', 'Aprobado Boton', 'Se asignan los permisos', 'Aprobado', 'Permisos asignados usuario brian.acevedo por favor validar'),
(2, 23, 'Permisos Siesa', '16/04/2025', 'Permisos de Cartera Almacen 250 / Sede 120', 'Aprobado', 'Aprobado', 'Aprobado', 'Aprobado', 'Aprobado'),
(3, 23, 'dfsa', '17/04/2025', '', 'Pendiente Jefe', 'Pendiente Estado J', 'Pendiente Sistemas', 'Pendiente estado s', 'Pendiente'),
(4, 23, 'TEST 16-04-2025 5:12', '17/04/2025', '', 'Pendiente Jefe', 'Pendiente Estado J', 'Pendiente Sistemas', 'Pendiente estado s', 'Pendiente'),
(5, 23, '123456', '17/04/2025', '123456', 'Pendiente Jefe', 'Pendiente Estado J', 'Pendiente Sistemas', 'Pendiente estado s', 'Pendiente'),
(6, 23, 'Permisos Siesa\r\nusuario: brian.acevedo', '17/04/2025', 'Permisos notas/credito/aprobado', 'Pendiente Jefe', 'Pendiente Estado J', 'Pendiente Sistemas', 'Pendiente estado s', 'Pendiente'),
(7, 23, 'Permisos Pagina Tropi', '16/04/2025', 'Fecha 16/04/2025 Facturacion/Permiso/Facturas', 'Pendiente Jefe', 'Pendiente Estado J', 'Pendiente Sistemas', 'Pendiente estado s', 'Pendiente');
>>>>>>> 2d9fb6e (Volviendo a la version 7bff)

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
(14, 'Inteligencia Artificial', 'Brian Acevedo', 'Arley Lorenzo', '2024-11-25', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, ad.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt vero labore ut cum molestias cupiditate aperiam laboriosam rerum molestiae possimus, architecto sequi aliquid. Accusamus', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt vero labore ut cum molestias cupiditate aperiam laboriosam rerum molestiae possimus, architecto sequi aliquid. Accusamus amet ipsum harum! Neque, eos est!.', 'uploads/20241125211019_Test123.pdf', 'IA', 'GOOGLE', 'MICROSOFT', 'CHAT', 'GPT', 'NVIDIA', 23, '', '', 'Pendiente', 'APROBADO 11:27PM POR CUMPLE LOS REQUISITOS', 'Rechazado', 'RECHAZADO 11:28PM'),
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
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `email`, `password`, `rol`) VALUES
(23, 'Brian', 'Acevedo', 'estudiante@uc.edu.co', '$2y$10$Y5zHtMCJpGuMg4iTHxRWHeAf500I1XBTsIybAizwaxl24.H1JBjte', '1'),
(24, 'Mariano', 'Castro', 'estudiante2@uc.edu.co', '$2y$10$pUUWqT4fH9QhqRhvIGzwrulC3nYNuPzHaGCOEsI9r99lVkS9dsw0.', '1'),
(25, 'Steven', 'Ramirez', 'comite@uc.edu.co', '$2y$10$nBC6T5eU92RVVeg4sF5Kt.ziJt2czIIaYiWVBPCleX8AwiircWdA6', '2'),
(26, 'Santiago', 'Ospina', 'asesor@uc.edu.co', '$2y$10$A4erWRvI8mJwtCb4XgVpoO/4iqifeerm6mJWAKWeC42s6a7FIx1H6', '3'),
(27, 'Carlos', 'Alvarez', 'evaluador@uc.edu.co', '$2y$10$HRbjLC2cjHfw/AtfrEfZ5OayZtUuNOQRRQpbGvtR5b/.YtiCBzgiy', '4'),
(28, 'Martin', 'Mendez', 'estudiante3@uc.edu.co', '$2y$10$v2AdVhzWXnnj5khqsJRy/e7n3Cjst7l7vGkWdJ7/d6d9CyoefbJ/e', '1'),
(30, 'Albeiro', 'Ortiz', 'admin@uc.edu.co', '$2y$10$plTR4N68.5n0N7ui9CtWtOnWASi2CmpmlY7GB4W3JjV6UpFeeClZm', '5');

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
<<<<<<< HEAD
  MODIFY `id_solicitud` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
=======
  MODIFY `id_solicitud` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
>>>>>>> 2d9fb6e (Volviendo a la version 7bff)

--
-- AUTO_INCREMENT de la tabla `trabajo_grado`
--
ALTER TABLE `trabajo_grado`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
