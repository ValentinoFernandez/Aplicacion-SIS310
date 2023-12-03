-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2023 a las 21:59:18
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
-- Base de datos: `empresas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`) VALUES
(8, 'ABC'),
(9, 'Salvietti'),
(7, 'SAS'),
(5, 'URL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pareto`
--

CREATE TABLE `pareto` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `ingreso_venta` int(11) DEFAULT NULL,
  `ingresos_totales_venta` int(11) DEFAULT NULL,
  `porcentaje_acumulado` int(11) DEFAULT NULL,
  `porcentaje_acumulado_porcentaje` decimal(10,2) DEFAULT NULL,
  `Gestion` int(11) NOT NULL,
  `Mes` varchar(25) NOT NULL,
  `cantidad_unidades` int(11) NOT NULL,
  `precio_unitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pareto`
--

INSERT INTO `pareto` (`id`, `id_producto`, `ingreso_venta`, `ingresos_totales_venta`, `porcentaje_acumulado`, `porcentaje_acumulado_porcentaje`, `Gestion`, `Mes`, `cantidad_unidades`, `precio_unitario`) VALUES
(6, 17, 989, 989, 989, 48.50, 2019, 'Enero', 23, 43),
(7, 18, 702, 702, 1691, 82.93, 2019, 'Enero', 78, 9),
(8, 14, 348, 348, 2039, 100.00, 2019, 'Enero', 87, 4),
(9, 14, 3026, 3026, 3026, 52.57, 2023, 'Diciembre', 34, 89),
(10, 14, 1794, 3026, 3026, 52.57, 2023, 'Marzo', 78, 23),
(11, 14, 936, 3026, 3026, 52.57, 2023, 'Junio', 12, 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_empresa`, `nombre`) VALUES
(10, 5, 'Fierro'),
(13, 7, 'Coca cola'),
(14, 8, 'Herramientas'),
(15, 8, 'Ladrillo'),
(16, 8, 'Pintura'),
(17, 8, 'Cerámica'),
(18, 8, 'Clavos'),
(19, 9, 'Papaya'),
(20, 9, 'Granadina'),
(21, 9, 'Limon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentabilidad`
--

CREATE TABLE `rentabilidad` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `Gestion` int(4) DEFAULT NULL,
  `utilidades` decimal(10,2) DEFAULT NULL,
  `Ingresos_por_venta` double NOT NULL,
  `Total_ingresos_por_venta` double NOT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL,
  `rentabilidad` decimal(10,2) DEFAULT NULL,
  `indice_comerciabilidad` decimal(10,2) DEFAULT NULL,
  `contribucion_utilitaria` decimal(10,2) DEFAULT NULL,
  `Mes` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rentabilidad`
--

INSERT INTO `rentabilidad` (`id`, `id_producto`, `Gestion`, `utilidades`, `Ingresos_por_venta`, `Total_ingresos_por_venta`, `costo_total`, `rentabilidad`, `indice_comerciabilidad`, `contribucion_utilitaria`, `Mes`) VALUES
(60, 13, 2023, 82.00, 120, 480, 38.00, 0.68, 0.25, 0.98, 'Abril'),
(61, 13, 2023, 82.00, 120, 480, 38.00, 0.68, 0.25, 0.98, 'Abril'),
(62, 13, 2023, 42.00, 80, 480, 38.00, 0.68, 0.25, 0.98, 'Abril'),
(63, 13, 2023, 42.00, 80, 480, 38.00, 0.68, 0.25, 0.98, 'Abril'),
(64, 13, 2023, 14.00, 80, 480, 66.00, 0.68, 0.25, 0.98, 'Abril'),
(65, 21, 2019, 180.00, 233, 775, 53.00, 0.77, 0.30, 0.98, 'Diciembre'),
(66, 19, 2019, 167.00, 289, 775, 122.00, 0.58, 0.37, 0.88, 'Diciembre'),
(67, 20, 2019, 114.00, 253, 775, 139.00, 0.45, 0.33, 0.89, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `usuario`, `contrasena`) VALUES
(1, 'Julian', 'julian@gmail.com', 'teva12345', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `pareto`
--
ALTER TABLE `pareto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `nombre_2` (`nombre`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `rentabilidad`
--
ALTER TABLE `rentabilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pareto`
--
ALTER TABLE `pareto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rentabilidad`
--
ALTER TABLE `rentabilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pareto`
--
ALTER TABLE `pareto`
  ADD CONSTRAINT `pareto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `rentabilidad`
--
ALTER TABLE `rentabilidad`
  ADD CONSTRAINT `rentabilidad_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
