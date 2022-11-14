-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2022 a las 23:50:12
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--
CREATE DATABASE IF NOT EXISTS `db_tpe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_tpe`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID`, `nombre`, `descripcion`) VALUES
(1, 'Perifericos', 'los perifericos son todos los elementos que ayudan a interactuar con el pc!!!'),
(3, 'Placas de video', 'las placas de video se usan para mejorar tu experiencia en videojuegos!'),
(5, 'Procesadores', 'Son el cerebro de tu pc!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `imagen` text DEFAULT '\'./img/predeterminado.jpg\'',
  `descripcion` text NOT NULL,
  `marca` varchar(10) NOT NULL,
  `precio` double NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `imagen`, `descripcion`, `marca`, `precio`, `id_categoria`) VALUES
(1, 'aorus', './img/mouse-gamer-rgb_40805_1.jpeg', 'un maus +/-', 'redragon', 999, 1),
(6, 'Rtx 3090', './img/Placa-De-Video-GeForce-RTX-3090-24Gb-Asus-Rog-Strix-Gaming-Oc-Blanco_43111_1.jpeg', 'Una maquina del hardware una bestia autentica!!!', 'gygabyte', 99999, 3),
(7, 'Yama k222', './img/redragon-teclado-k550-yama-blanco-11-cbb5229492386a5c2716242352952486-1024-1024.jpg', 'Teclado mecanico de redragon con muchas luces!', 'redragon', 15000, 1),
(8, 'Cloud flight ', './img/1558733874_236778llo.jpg', 'auriculares que son lo mejor lo mejor del mundo del gaming', 'Hyperx!', 18000, 1),
(9, 'Harrow', './img/1534181389_ll.png', 'Joystick inalambrico de redragon que sirve para jugar a distancia', 'redragon', 10000, 1),
(13, 'i7 7700', './img/BX80677I77700T_800.jpg', 'Es un procesador de alta gama de hace unos añitos', 'intel', 13000, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contraseña` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `contraseña`) VALUES
(3, 'pepitojuega333', '$2a$12$JcyAnljGLMP/RAh6ZcauCufzdxUuw59VMED5DN1PM1h.wTfLSyxKO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categorias_id_categoria_productos` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categorias_id_categoria_productos` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`ID`);
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------
