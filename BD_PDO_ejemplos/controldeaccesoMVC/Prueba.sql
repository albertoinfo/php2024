-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-12-2023 a las 22:07:00
-- Versión del servidor: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE `Productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`id`, `nombre`, `stock`, `precio`) VALUES
(200, 'Martillo', 10, 30),
(201, 'Maza', 3, 69),
(302, 'Tuercas 10 mm', 20, 5),
(305, 'Tuercas 20 mm', 20, 1),
(309, 'Tuercas 10 mm', 20, 5.5),
(315, 'Tuercas 20 mm', 20, 5.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `login` varchar(8) NOT NULL,
  `passwd` varchar(10) NOT NULL,
  `Nombre` varchar(15) NOT NULL,
  `accesos` int(11) NOT NULL,
  `bloqueo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`login`, `passwd`, `Nombre`, `accesos`, `bloqueo`) VALUES
('admin', 'admin', 'Administrador', 41, 0),
('patata', '123456', 'manolo', 11, 0),
('user01', '12345', 'Usuario Pepe', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Users`
--
ALTER TABLE `Users`
  ADD UNIQUE KEY `login` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
