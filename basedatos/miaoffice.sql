-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-01-2018 a las 20:13:39
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miaoffice`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id_evento` bigint(20) NOT NULL,
  `ca_titulo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ca_fecha_inicio` date NOT NULL,
  `ca_fecha_fin` date NOT NULL,
  `ca_horario_inicio` time NOT NULL,
  `ca_horario_fin` time NOT NULL,
  `ca_id_oficina` int(11) NOT NULL,
  `ca_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id_evento`, `ca_titulo`, `ca_fecha_inicio`, `ca_fecha_fin`, `ca_horario_inicio`, `ca_horario_fin`, `ca_id_oficina`, `ca_status`) VALUES
(1, 'Disponible', '2018-01-01', '2018-01-01', '09:30:00', '15:30:00', 2, 1),
(2, 'Disponible', '2018-01-03', '2018-01-03', '10:00:00', '14:30:00', 1, 1),
(3, 'Aniversario matrimonio', '2018-01-12', '2018-01-12', '08:30:00', '20:30:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cl_clientes`
--

CREATE TABLE `cl_clientes` (
  `cl_id_cliente` bigint(20) NOT NULL,
  `cl_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_apellido_paterno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_apellido_materno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_usuario` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_contrasenia` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_correo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cl_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cl_clientes`
--

INSERT INTO `cl_clientes` (`cl_id_cliente`, `cl_nombre`, `cl_apellido_paterno`, `cl_apellido_materno`, `cl_usuario`, `cl_contrasenia`, `cl_correo`, `cl_telefono`, `cl_status`) VALUES
(1, 'Cesar', 'Vieyra', '', 'vieyra4', 'bc0438362c72e32c2d5f017c0735739d', 'cesar.vieyra4@gmail.com', '4433622613', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nu_nivel_usuarios`
--

CREATE TABLE `nu_nivel_usuarios` (
  `nu_id_nivel_usuario` bigint(20) NOT NULL,
  `nu_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nu_nivel_usuarios`
--

INSERT INTO `nu_nivel_usuarios` (`nu_id_nivel_usuario`, `nu_nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `of_oficinas`
--

CREATE TABLE `of_oficinas` (
  `of_id_oficina` bigint(20) NOT NULL,
  `of_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `of_precio` double NOT NULL,
  `of_id_ubicacion` int(11) NOT NULL,
  `of_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `of_oficinas`
--

INSERT INTO `of_oficinas` (`of_id_oficina`, `of_nombre`, `of_precio`, `of_id_ubicacion`, `of_status`) VALUES
(1, 'San Pedro', 1500, 1, 1),
(2, 'San Agustin', 2500, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ub_ubicaciones`
--

CREATE TABLE `ub_ubicaciones` (
  `ub_id_ubicacion` bigint(20) NOT NULL,
  `ub_calle` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ub_numero_exterior` int(11) NOT NULL,
  `ub_numero_interior` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ub_colonia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ub_codigo_postal` varchar(5) NOT NULL,
  `ub_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ub_ubicaciones`
--

INSERT INTO `ub_ubicaciones` (`ub_id_ubicacion`, `ub_calle`, `ub_numero_exterior`, `ub_numero_interior`, `ub_colonia`, `ub_codigo_postal`, `ub_status`) VALUES
(1, 'Rio Yaqui', 369, '', 'Ventura Puente', '58020', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `us_usuarios`
--

CREATE TABLE `us_usuarios` (
  `us_id_usuario` bigint(20) NOT NULL,
  `us_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_apellido_paterno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_apellido_materno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_correo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_usuario` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_contrasenia` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `us_id_nivel_usuario` int(11) NOT NULL,
  `us_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `us_usuarios`
--

INSERT INTO `us_usuarios` (`us_id_usuario`, `us_nombre`, `us_apellido_paterno`, `us_apellido_materno`, `us_correo`, `us_usuario`, `us_contrasenia`, `us_id_nivel_usuario`, `us_status`) VALUES
(1, 'Cesar', 'Vieyra', 'Garcia', 'cesar.vieyra4@gmail.com', 'vieyra4', 'bc0438362c72e32c2d5f017c0735739d', 1, 1),
(2, 'Patricia', 'Garcia', 'Gaona', 'patito.garcia1@gmail.com', 'patito', '833ad14369f72a6d02350a3eb76b687d', 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `cl_clientes`
--
ALTER TABLE `cl_clientes`
  ADD PRIMARY KEY (`cl_id_cliente`);

--
-- Indices de la tabla `nu_nivel_usuarios`
--
ALTER TABLE `nu_nivel_usuarios`
  ADD PRIMARY KEY (`nu_id_nivel_usuario`);

--
-- Indices de la tabla `of_oficinas`
--
ALTER TABLE `of_oficinas`
  ADD PRIMARY KEY (`of_id_oficina`);

--
-- Indices de la tabla `ub_ubicaciones`
--
ALTER TABLE `ub_ubicaciones`
  ADD PRIMARY KEY (`ub_id_ubicacion`);

--
-- Indices de la tabla `us_usuarios`
--
ALTER TABLE `us_usuarios`
  ADD PRIMARY KEY (`us_id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_evento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cl_clientes`
--
ALTER TABLE `cl_clientes`
  MODIFY `cl_id_cliente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nu_nivel_usuarios`
--
ALTER TABLE `nu_nivel_usuarios`
  MODIFY `nu_id_nivel_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `of_oficinas`
--
ALTER TABLE `of_oficinas`
  MODIFY `of_id_oficina` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ub_ubicaciones`
--
ALTER TABLE `ub_ubicaciones`
  MODIFY `ub_id_ubicacion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `us_usuarios`
--
ALTER TABLE `us_usuarios`
  MODIFY `us_id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
