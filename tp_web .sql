-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 04:40:03
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
-- Base de datos: `tp_web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` text DEFAULT NULL,
  `clave` char(60) NOT NULL,
  `administrador` tinyint(1) DEFAULT NULL,
  `id_vuelo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `clave`, `administrador`, `id_vuelo`) VALUES
(1, 'Raul', 'EmailRaul@hotmail.com', '$2y$10$bgGoNpXQAFdUn4f8F4UUpuHiLIKaeROmlkAtY3xFANGsdjcGE.DfC', 0, 1),
(2, 'Franco', 'EmailFranco@hotmail.com', '$2y$10$bgGoNpXQAFdUn4f8F4UUpuHiLIKaeROmlkAtY3xFANGsdjcGE.DfC', 0, 1),
(10, 'Jose', 'EmailJose@hotmail.com', '$2y$10$bgGoNpXQAFdUn4f8F4UUpuHiLIKaeROmlkAtY3xFANGsdjcGE.DfC', 0, NULL),
(12, 'Javier', 'EmailJavier@hotmail.com', '$2y$10$bgGoNpXQAFdUn4f8F4UUpuHiLIKaeROmlkAtY3xFANGsdjcGE.DfC', 0, 2),
(13, 'Pedro', 'EmailPedro@hotmail.com', '$2y$10$bgGoNpXQAFdUn4f8F4UUpuHiLIKaeROmlkAtY3xFANGsdjcGE.DfC', 0, 2),
(18, 'web', 'webadmin@gmail.com', '$2y$10$AHSrLN8aqOkwS9Ac7s8ltO2P3taU7xcRcXaQ8QQ2kmCIAkR67gMJq', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `id` int(11) NOT NULL,
  `salida` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `destino` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `avion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `hs_salida` time(2) NOT NULL,
  `hs_llegada` time(3) NOT NULL,
  `fecha` date NOT NULL,
  `precio` int(11) NOT NULL,
  `capacidad` int(3) NOT NULL,
  `url_Imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`id`, `salida`, `destino`, `avion`, `hs_salida`, `hs_llegada`, `fecha`, `precio`, `capacidad`, `url_Imagen`) VALUES
(1, 'Mar del Plata', 'Balcarce', 'Boing707', '15:00:00.00', '15:40:00.000', '2024-09-24', 15000, 45, './img/Balcarce-sierras.jpg'),
(2, 'Aereo parque', 'Ushuaia', 'Airbus320', '21:00:00.00', '00:00:00.000', '2024-09-30', 200000, 45, './img/Ushuaia.jpg'),
(4, 'Jujuy', 'Buenos aires', 'Airbus320', '15:00:00.00', '19:40:00.000', '2024-10-31', 45000, 50, './img/BuenosAires.jpg'),
(5, 'Catamarca', 'Misiones', 'Boing707', '04:00:00.00', '06:40:00.000', '2024-10-06', 32000, 50, './img/Misiones.jpg'),
(6, 'Gardey', 'Azucena', 'avioneta', '14:00:00.00', '14:30:00.000', '2024-10-29', 1500, 3, './img/Azucena.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
