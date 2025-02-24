-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-01-2022 a las 20:57:55
-- Versión del servidor: 8.0.27-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3


SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `login` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `comentario` varchar(30) NOT NULL,
  `bloqueo` int NOT NULL,
  `saldo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`login`, `nombre`, `password`, `comentario`, `bloqueo`, `saldo`) VALUES
('2r34', 'Ramón Rodriguez', '309403sk', 'Programador Junior', 0, '19.06'),
('9389', 'Silvia Pérez  Pio', 'o3o3o3', 'Analista JR2dd', 1, '73.37'),
('fernan', 'Fernando Pérez 3', '12345', 'SysADM & DB manager', 1, '148.50'),
('sad', 'Silvia Ana', 'sdsad12312', 'Jefe de proyectos', 0, '5.10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
