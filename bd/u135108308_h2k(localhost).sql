-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-06-2015 a las 19:47:46
-- Versión del servidor: 5.5.43-MariaDB-1ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u135108308_h2k`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `idisla` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario_2` (`idusuario`),
  KEY `idcategoria` (`idcategoria`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idisla` (`idisla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `idusuario`, `idcategoria`, `titulo`, `created`, `descripcion`, `idmunicipio`, `idisla`) VALUES
(1, 1, 1, 'Curso básico de desarrollo web.', '2015-05-23 20:59:54', 'Aprende las bases del desarrollo web con este curso. Duración de 18 meses. Precio total: 3500€', 38031, 7),
(2, 1, 2, 'Clases de padel.', '2015-05-23 20:59:54', 'Clases de padel en el gimnasio de santa Ursula los Martes y los Jueves de 17:00 a 18:00. Precio 18€ la clase, alquiler de cancha no incluido.', 38039, 7),
(4, 3, 4, 'Clases de pintura moderna.', '2015-05-23 21:12:31', 'Te enseño las mejores técnicas de la pintura moderna. 25€/por clase. Antiguo pintor de paredes.', 35004, 3),
(5, 3, 5, 'Clases After Efects', '2015-05-23 21:16:28', 'Doy clases de after effects en mi casa desde 15€/hora conceptos básicos y avanzados.', 35004, 3),
(6, 1, 6, 'Clases de DJ', '2015-05-23 21:16:28', 'Aprende a ser uno de los mejores DJ de la historia con mis clases. 24€/hora', 38038, 7),
(7, 1, 7, 'Clases de piano.', '2015-05-23 21:22:05', 'Doy clases de piano para adultos. De 30 años hasta 99. Máximo 2 personas por hora. 20€/hora. Teléfono: 922380345', 38038, 7),
(8, 2, 8, 'Clases de matemáticas.', '2015-05-23 21:22:05', 'Si tienes dificultades con las matemáticas te puedo ayudar, doy clases en el salón de mi casa a 10€/hora. Todos los niveles menos universidad. también doy clases a domicilio. Preguntar precio Tel: 666645123', 38041, 7),
(9, 2, 9, 'Clases de cocina creativa.', '2015-05-23 21:26:27', 'Aprende a hacer platos que dejarán boquiabiertos a tus comensales, con la ayuda del Chef Pepe, en las maravillosas instalaciones del hotel la quinta. Precio 100€/clase, de gustación incluida', 38041, 7),
(10, 3, 10, 'Curso de origami', '2015-05-23 21:26:27', 'Aprende a hacer 500 figuras de Origami en mi curso online intensivo de 3 meses.\r\nContacto origamifirend@juanas.com', 35004, 3),
(11, 1, 1, 'Aprende a desmontar tu ordenador.', '2015-05-25 16:52:06', 'Pequeño curso gratuito en la asociación de vecinos del barrio. Tel:922323232', 38031, 7),
(12, 1, 1, 'Curso de informática para mayores.', '2015-05-25 16:52:06', 'Despídete de tu miedo a los ratones con el curso de informática para mayores de 55 años, en donde te explicamos todo paso a paso. Email: noexiste@ironia.com', 38031, 7),
(13, 1, 1, 'Desarrollo para android', '2015-05-25 16:54:01', 'Aprende desarrollo en android con mi curso de 2 años en la escuela privada. Tel: 922922922', 38031, 7),
(14, 1, 1, 'Clases de php', '2015-05-25 17:04:47', 'Tienes problemas con php en los estudios. Te puedo ayudar tanto telematicamente como en persona. Contacta conmigo en el 656565655 o en el email elphpepe@pepe.com', 38031, 7),
(15, 1, 1, 'Creemos nuestro propio videojuego', '2015-05-25 17:04:47', 'Estoy empezando a crear mi propio MMO y me gustaría crear un grupo de trabajo para aprender y que lo pasemos genial. Más Info: 666555444', 38031, 7),
(16, 1, 1, 'Blender 3D designer', '2015-05-25 17:04:48', 'Estoy buscando a alguien que sepa de blender en 3D. Email: miemail@email.com', 38031, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxcategorias`
--

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

CREATE TABLE IF NOT EXISTS `auxislas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_spanish_ci NOT NULL,
  `avatar` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `auxislas`
--

INSERT INTO `auxislas` (`id`, `nombre`, `avatar`) VALUES
(1, 'Fuerteventura', 'img/img_pagina/islas/fuerteventura.png'),
(2, 'Gran Canaria', 'img/img_pagina/islas/gran-canaria.png'),
(3, 'Lanzarote', 'img/img_pagina/islas/lanzarote.png'),
(4, 'La Gomera', 'img/img_pagina/islas/la-gomera.png'),
(5, 'El Hierro', 'img/img_pagina/islas/el-hierro.png'),
(6, 'La Palma', 'img/img_pagina/islas/la-palma.png'),
(7, 'Tenerife', 'img/img_pagina/islas/tenerife.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxmunicipios`
--

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
(35014, 'La Oliva', 1),
(35015, 'Pájara', 1),
(35016, 'Las Palmas de Gran Canaria', 2),
(35017, 'Puerto del Rosario', 1),
(35018, 'San Bartolomé', 3),
(35019, 'San Bartolomé de Tirajana', 2),
(35020, 'La Aldea de San Nicolás', 2),
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
(38018, 'La Guancha', 7),
(38019, 'Guía de Isora', 7),
(38020, 'Güímar', 7),
(38021, 'Hermigua', 4),
(38022, 'Icod de los Vinos', 7),
(38023, 'San Cristóbal de La Laguna', 7),
(38024, 'Los Llanos de Aridane', 6),
(38025, 'La Matanza de Acentejo', 7),
(38026, 'La Orotava', 7),
(38027, 'El Paso', 6),
(38028, 'Puerto de la Cruz', 7),
(38029, 'Puntagorda', 6),
(38030, 'Puntallana', 6),
(38031, 'Los Realejos', 7),
(38032, 'El Rosario', 7),
(38033, 'San Andrés y Sauces', 6),
(38034, 'San Juan de la Rambla', 7),
(38035, 'San Miguel de Abona', 7),
(38036, 'San Sebastián de la Gomera', 4),
(38037, 'Santa Cruz de la Palma', 6),
(38038, 'Santa Cruz de Tenerife', 7),
(38039, 'Santa Úrsula', 7),
(38040, 'Santiago del Teide', 7),
(38041, 'El Sauzal', 7),
(38042, 'Los Silos', 7),
(38043, 'Tacoronte', 7),
(38044, 'El Tanque', 7),
(38045, 'Tazacorte', 6),
(38046, 'Tegueste', 7),
(38047, 'Tijarafe', 6),
(38048, 'Valverde', 5),
(38049, 'Valle Gran Rey', 4),
(38050, 'Vallehermoso', 4),
(38051, 'La Victoria de Acentejo', 7),
(38052, 'Vilaflor', 7),
(38053, 'Villa de Mazo', 6),
(38901, 'El Pinar de El Hierro', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxroles`
--

CREATE TABLE IF NOT EXISTS `auxroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `auxroles`
--

INSERT INTO `auxroles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centroseducativos`
--

CREATE TABLE IF NOT EXISTS `centroseducativos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `longitud` double NOT NULL,
  `latitud` double NOT NULL,
  `informacion` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `idisla` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idisla` (`idisla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `centroseducativos`
--

INSERT INTO `centroseducativos` (`id`, `nombre`, `longitud`, `latitud`, `informacion`, `idisla`, `created`) VALUES
(1, 'IES Puerto de la Cruz (Telesforo Bravo)', -16.5503413, 28.412001, 'Tel: 922 38 01 12\nTelegram: 610 285 167 \n\nCalle las Cabezas, 7\n38400 Puerto de la Cruz\nSanta Cruz de Tenerife\nEspaña', 7, '2015-06-06 09:14:17'),
(2, 'IES Mencey Bencomo', -16.583146, 28.383485, 'Calle San Isidro, 40B\r\n38419 Los Realejos\r\nSanta Cruz de Tenerife, España', 7, '2015-06-06 09:16:07'),
(3, 'IES Mesa y López', -15.4422778, 28.1205402, 'Av. José Mesa y López, 69\r\n35010 Las Palmas de Gran Canaria\r\nLas Palmas\r\nEspaña', 2, '2015-06-06 09:18:04'),
(5, 'IES la Laboral de la Laguna', -16.313346, 28.478607, 'Av Lora Tamayo, 2\r\n38205 San Cristóbal de La Laguna, Santa Cruz de Tenerife\r\nSanta Cruz de Tenerife', 7, '2015-06-06 19:21:15'),
(6, 'Ies Agustín Espinosa', -13.6504782, 29.0386277, 'Calle Coronel Bens, 5\r\n35500 Arrecife\r\nLas Palmas', 3, '2015-06-06 19:23:32'),
(7, 'Instituto de Educación Secundaria Ies Roques de Salmor', -18.0218438, 27.743538, 'Calle de la Boca, 0\r\n38911 Frontera\r\nSanta Cruz de Tenerife', 5, '2015-06-06 19:24:16'),
(8, 'Instituto de Educación Secundaria Ies Luis Cobiella Cuevas', -17.7621201, 28.6877087, 'Calle el Pilar, 12\r\n38700 Santa Cruz de la Palma\r\nSanta Cruz de Tenerife', 6, '2015-06-06 19:25:21'),
(9, 'Instituto de Educación Secundaria Ies San Sebastián de la Gomera', -17.1180473, 28.0984666, 'Calle de Fernando Padilla\r\n38800 San Sebastián de La Gomera\r\nSanta Cruz de Tenerife', 4, '2015-06-06 19:26:08'),
(10, 'IES Gran Tarajal', -14.1663093, 28.400446, 'Calle Pico de la Pila, 30\r\n35628 Pájara\r\nLas Palmas', 1, '2015-06-06 19:27:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `texto` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idactividad` (`idactividad`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `idactividad`, `idusuario`, `texto`, `created`) VALUES
(1, 1, 2, 'La crema de la crema', '2015-05-25 13:31:47'),
(2, 1, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(3, 2, 6, 'Comentario de prueba', '2015-05-25 13:31:47'),
(4, 2, 7, 'Comentario de prueba', '2015-05-25 13:31:47'),
(7, 1, 6, 'Comentario de prueba aleatorio', '2015-05-25 13:31:47'),
(8, 10, 4, 'Comentario de prueba', '2015-05-25 13:31:47'),
(9, 10, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(11, 2, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(12, 2, 4, 'Comentario de prueba', '2015-05-25 13:31:47'),
(14, 6, 5, 'Comentario de prueba', '2015-05-25 13:31:47'),
(15, 10, 7, 'Comentario de prueba', '2015-05-25 13:31:47'),
(16, 2, 5, 'Este comentario ha sido baneado por el adminsitrador', '2015-05-25 14:31:56'),
(17, 10, 1, 'prueba comentario', '2015-06-11 19:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `ruta` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idactividad` (`idactividad`),
  KEY `idactividad_2` (`idactividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `idactividad`, `ruta`, `created`) VALUES
(1, 1, 'img/img_actividades/clasesdesarrollo.jpg', '2015-05-23 21:30:15'),
(2, 2, 'img/img_actividades/clasespadel.jpg', '2015-05-23 21:30:15'),
(4, 4, 'img/img_actividades/clasepintura.jpg', '2015-05-23 21:50:28'),
(5, 5, 'img/img_actividades/cursoafterefects.png', '2015-05-23 21:51:40'),
(6, 6, 'img/img_actividades/clasesdj.jpg', '2015-05-23 21:51:40'),
(7, 7, 'img/img_actividades/clasespiano.jpg', '2015-05-23 21:52:36'),
(8, 8, 'img/img_actividades/clasesmatematicas.jpg', '2015-05-23 21:52:36'),
(9, 9, 'img/img_actividades/cocinacreativa.jpg', '2015-05-23 21:53:29'),
(10, 10, 'img/img_actividades/cursoorigami.jpg', '2015-05-23 21:53:29'),
(11, 11, 'img/img_actividades/cursodesmontar.jpg', '2015-05-25 17:09:59'),
(12, 12, 'img/img_actividades/clasesinformaticaadultos.jpg', '2015-05-25 17:09:59'),
(13, 13, 'img/img_actividades/calsesandroid.jpg', '2015-05-25 17:09:59'),
(14, 14, 'img/img_actividades/ayudaconphp.png', '2015-05-25 17:09:59'),
(15, 15, 'img/img_actividades/crearvideojuego.jpg', '2015-05-25 17:09:59'),
(16, 16, 'img/img_actividades/blenderdesign.png', '2015-05-25 17:09:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `idrol` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `idisla` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'img/img_usuarios/avatares/default.png',
  `social` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idrol` (`idrol`),
  KEY `idisla` (`idisla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nick`, `nombre`, `apellidos`, `password`, `idrol`, `idmunicipio`, `idisla`, `created`, `avatar`, `social`) VALUES
(1, 'janaigus@gmail.com', 'janai', 'Janai Gustavo', 'Expósito Bethencourt', '2e99bf4e42962410038bc6fa4ce40d97', 1, 38031, 7, '2015-05-15 21:39:36', 'img/img_usuarios/avatares/janaisavatar.png', ''),
(2, 'jonaigus@gmail.com', 'admin', 'Administrador', 'Administrador', '2e99bf4e42962410038bc6fa4ce40d97', 1, 38041, 7, '2015-05-15 21:39:36', 'img/img_usuarios/avatares/default.png', ''),
(3, 'janai_exposito@outlook.com', 'Usuario', 'Usuario', 'Usuario', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35004, 3, '2015-05-15 21:40:41', 'img/img_usuarios/avatares/default.png', ''),
(4, 'otrouser@otrouser.es', 'Otrouser', 'Otrouser', 'Otrouser', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35015, 1, '2015-05-15 21:40:41', 'img/img_usuarios/avatares/default.png', ''),
(5, 'pepe@benavente.com', 'pebe', 'Pepe', 'Benavente', '2e99bf4e42962410038bc6fa4ce40d97', 2, 38028, 7, '2015-05-23 21:58:05', 'img/img_usuarios/avatares/default.png', ''),
(6, 'hely@clak.com', 'hecl', 'Hely', 'Clarckson', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35016, 2, '2015-05-23 22:00:18', 'img/img_usuarios/avatares/default.png', ''),
(7, 'metal@lovers.com', 'melo', 'Metal', 'Lovers', '2e99bf4e42962410038bc6fa4ce40d97', 2, 38901, 5, '2015-05-23 22:04:03', 'img/img_usuarios/avatares/default.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE IF NOT EXISTS `votos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idactividad` (`idactividad`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=99 ;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `idactividad`, `idusuario`, `valoracion`, `created`) VALUES
(78, 5, 3, 5, '2015-05-24 09:21:57'),
(79, 5, 3, 4, '2015-05-24 09:21:57'),
(81, 2, 3, 2, '2015-05-24 09:21:57'),
(83, 7, 3, 2, '2015-05-24 09:21:57'),
(84, 4, 7, 1, '2015-05-24 09:21:57'),
(85, 2, 3, 2, '2015-05-24 09:21:57'),
(86, 1, 7, 3, '2015-05-24 09:21:57'),
(88, 4, 6, 4, '2015-05-24 09:21:57'),
(89, 10, 6, 6, '2015-05-24 09:21:57'),
(91, 2, 6, 3, '2015-05-24 09:21:57'),
(92, 2, 3, 5, '2015-05-24 09:21:57'),
(93, 6, 6, 3, '2015-05-24 09:21:57'),
(94, 10, 4, 4, '2015-05-24 09:21:57'),
(95, 5, 3, 4, '2015-05-24 09:21:57'),
(96, 4, 7, 2, '2015-05-24 09:21:57'),
(97, 8, 6, 5, '2015-05-24 09:21:57'),
(98, 10, 1, 4, '2015-06-11 19:20:20');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `auxcategorias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_ibfk_3` FOREIGN KEY (`idmunicipio`) REFERENCES `auxmunicipios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actividades_ibfk_4` FOREIGN KEY (`idisla`) REFERENCES `auxislas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `auxmunicipios`
--
ALTER TABLE `auxmunicipios`
  ADD CONSTRAINT `auxmunicipios_ibfk_1` FOREIGN KEY (`idisla`) REFERENCES `auxislas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `centroseducativos`
--
ALTER TABLE `centroseducativos`
  ADD CONSTRAINT `centroseducativos_ibfk_1` FOREIGN KEY (`idisla`) REFERENCES `auxislas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idmunicipio`) REFERENCES `auxmunicipios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `auxroles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idisla`) REFERENCES `auxislas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos_ibfk_1` FOREIGN KEY (`idactividad`) REFERENCES `actividades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `votos_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
