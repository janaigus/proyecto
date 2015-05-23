-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-05-2015 a las 22:51:15
-- Versión del servidor: 5.5.43-MariaDB-1ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `helptoknow`
--
CREATE DATABASE IF NOT EXISTS `helptoknow` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `helptoknow`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `direccion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario_2` (`idusuario`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idmunicipio` (`idmunicipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxcategorias`
--

DROP TABLE IF EXISTS `auxcategorias`;
CREATE TABLE IF NOT EXISTS `auxcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `auxcategorias`
--

INSERT INTO `auxcategorias` (`id`, `nombre`, `created`) VALUES
(1, 'Informática', '2015-05-14 12:39:10'),
(2, 'Deportes', '2015-05-14 12:39:10'),
(3, 'Infantil', '2015-05-14 12:42:50'),
(4, 'Arte', '2015-05-14 12:42:50'),
(5, 'Video', '2015-05-14 12:43:19'),
(6, 'Audio', '2015-05-14 12:43:19'),
(7, 'Música', '2015-05-14 12:46:28'),
(8, 'Apoyo educativo', '2015-05-14 12:46:56'),
(9, 'Cocina', '2015-05-19 16:29:08'),
(10, 'Manualidades', '2015-05-19 16:29:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxislas`
--

DROP TABLE IF EXISTS `auxislas`;
CREATE TABLE IF NOT EXISTS `auxislas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `auxislas`
--

INSERT INTO `auxislas` (`id`, `nombre`) VALUES
(1, 'Fuerteventura'),
(2, 'Gran Canaria'),
(3, 'Lanzarote'),
(4, 'La Gomera'),
(5, 'El Hierro'),
(6, 'La Palma'),
(7, 'Tenerife');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxmunicipios`
--

DROP TABLE IF EXISTS `auxmunicipios`;
CREATE TABLE IF NOT EXISTS `auxmunicipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `idisla` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idisla` (`idisla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=38902 ;

--
-- Volcado de datos para la tabla `auxmunicipios`
--

INSERT INTO `auxmunicipios` (`id`, `nombre`, `idisla`) VALUES
(35001, 'Agaete', 2),
(35002, 'Agüimes', 2),
(35003, 'Antigua', 1),
(35004, 'Arrecife', 3),
(35005, 'Artenara', 2),
(35006, 'Arucas', 2),
(35007, 'Betancuria', 1),
(35008, 'Firgas', 2),
(35009, 'Gáldar', 2),
(35010, 'Haría', 3),
(35011, 'Ingenio', 2),
(35012, 'Mogán', 2),
(35013, 'Moya', 2),
(35014, 'Oliva, La', 1),
(35015, 'Pájara', 1),
(35016, 'Palmas de Gran Canaria, Las', 2),
(35017, 'Puerto del Rosario', 1),
(35018, 'San Bartolomé', 3),
(35019, 'San Bartolomé de Tirajana', 2),
(35020, 'Aldea de San Nicolás, La', 2),
(35021, 'Santa Brígida', 2),
(35022, 'Santa Lucía de Tirajana', 2),
(35023, 'Santa María de Guía de Gran Canaria', 2),
(35024, 'Teguise', 3),
(35025, 'Tejeda', 2),
(35026, 'Telde', 2),
(35027, 'Teror', 2),
(35028, 'Tías', 3),
(35029, 'Tinajo', 3),
(35030, 'Tuineje', 1),
(35031, 'Valsequillo de Gran Canaria', 2),
(35032, 'Valleseco', 2),
(35033, 'Vega de San Mateo', 2),
(35034, 'Yaiza', 3),
(38001, 'Adeje', 7),
(38002, 'Agulo', 4),
(38003, 'Alajeró', 4),
(38004, 'Arafo', 7),
(38005, 'Arico', 7),
(38006, 'Arona', 7),
(38007, 'Barlovento', 6),
(38008, 'Breña Alta', 6),
(38009, 'Breña Baja', 6),
(38010, 'Buenavista del Norte', 7),
(38011, 'Candelaria', 7),
(38012, 'Fasnia', 7),
(38013, 'Frontera', 5),
(38014, 'Fuencaliente de la Palma', 6),
(38015, 'Garachico', 7),
(38016, 'Garafía', 6),
(38017, 'Granadilla de Abona', 7),
(38018, 'Guancha, La', 7),
(38019, 'Guía de Isora', 7),
(38020, 'Güímar', 7),
(38021, 'Hermigua', 4),
(38022, 'Icod de los Vinos', 7),
(38023, 'San Cristóbal de La Laguna', 7),
(38024, 'Llanos de Aridane, Los', 6),
(38025, 'Matanza de Acentejo, La', 7),
(38026, 'Orotava, La', 7),
(38027, 'Paso, El', 6),
(38028, 'Puerto de la Cruz', 7),
(38029, 'Puntagorda', 6),
(38030, 'Puntallana', 6),
(38031, 'Realejos, Los', 7),
(38032, 'Rosario, El', 7),
(38033, 'San Andrés y Sauces', 6),
(38034, 'San Juan de la Rambla', 7),
(38035, 'San Miguel de Abona', 7),
(38036, 'San Sebastián de la Gomera', 4),
(38037, 'Santa Cruz de la Palma', 6),
(38038, 'Santa Cruz de Tenerife', 7),
(38039, 'Santa Úrsula', 7),
(38040, 'Santiago del Teide', 7),
(38041, 'Sauzal, El', 7),
(38042, 'Silos, Los', 7),
(38043, 'Tacoronte', 7),
(38044, 'Tanque, El', 7),
(38045, 'Tazacorte', 6),
(38046, 'Tegueste', 7),
(38047, 'Tijarafe', 6),
(38048, 'Valverde', 5),
(38049, 'Valle Gran Rey', 4),
(38050, 'Vallehermoso', 4),
(38051, 'Victoria de Acentejo, La', 7),
(38052, 'Vilaflor', 7),
(38053, 'Villa de Mazo', 6),
(38901, 'Pinar de El Hierro, El', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxroles`
--

DROP TABLE IF EXISTS `auxroles`;
CREATE TABLE IF NOT EXISTS `auxroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `auxroles`
--

INSERT INTO `auxroles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxtiposrecursos`
--

DROP TABLE IF EXISTS `auxtiposrecursos`;
CREATE TABLE IF NOT EXISTS `auxtiposrecursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcategoriatipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `auxtiposrecursos`
--

INSERT INTO `auxtiposrecursos` (`id`, `tipo`) VALUES
(2, 'audio'),
(1, 'imagen'),
(3, 'video');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `texto` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idactividad` (`idactividad`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

DROP TABLE IF EXISTS `recursos`;
CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `idtipo` int(11) NOT NULL,
  `ruta` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idtipo` (`idtipo`),
  KEY `idactividad` (`idactividad`),
  KEY `idtipo_2` (`idtipo`),
  KEY `idactividad_2` (`idactividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idrol` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idrol` (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nick`, `nombre`, `apellidos`, `password`, `idrol`, `idmunicipio`, `created`) VALUES
(1, 'janaigus@gmail.com', 'janai', 'Janai Gustavo', 'Expósito Bethencourt', '123456789', 1, 38031, '2015-05-15 21:39:36'),
(2, 'jonaigus@gmail.com', 'admin', 'Administrador', 'Administrador', '123456789', 1, 38041, '2015-05-15 21:39:36'),
(3, 'janai_exposito@outlook.com', 'Usuario', 'Usuario', 'Usuario', '123456789', 2, 35004, '2015-05-15 21:40:41'),
(4, 'invitado@invitado.es', 'Invitado', 'Invitado', 'Invitado', '123456789', 3, 35015, '2015-05-15 21:40:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

DROP TABLE IF EXISTS `votos`;
CREATE TABLE IF NOT EXISTS `votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idactividad` (`idactividad`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `auxcategorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_ibfk_3` FOREIGN KEY (`idmunicipio`) REFERENCES `auxmunicipios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `auxmunicipios`
--
ALTER TABLE `auxmunicipios`
  ADD CONSTRAINT `auxmunicipios_ibfk_1` FOREIGN KEY (`idisla`) REFERENCES `auxislas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`idusuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recursos_ibfk_2` FOREIGN KEY (`idtipo`) REFERENCES `auxtiposrecursos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idmunicipio`) REFERENCES `auxmunicipios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `auxroles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
