
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2015 a las 20:08:47
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `idusuario`, `idcategoria`, `titulo`, `created`, `descripcion`, `idmunicipio`, `idisla`) VALUES
(1, 1, 1, 'Curso básico de desarrollo web.', '2015-05-23 20:59:54', 'Aprende las bases del desarrollo web con este curso. Duración de 18 meses. Precio total: 3500€', 38031, 7),
(2, 1, 2, 'Clases de padel.', '2015-05-23 20:59:54', 'Clases de padel en el gimnasio de santa Ursula los Martes y los Jueves de 17:00 a 18:00. Precio 18€ la clase, alquiler de cancha no incluido.', 38039, 7),
(3, 4, 3, 'Cuenta cuentos.', '2015-05-23 21:12:31', 'Actividad de cuenta cuentos al aire libre en el Centro Municipal de deportes. Totalmente gratis. Apuntate.', 35015, 1),
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
(16, 1, 1, 'Blender 3D designer', '2015-05-25 17:04:48', 'Estoy buscando a alguien que sepa de blender en 3D. Email: miemail@email.com', 38031, 7),
(23, 11, 4, 'Aprende a hacer libretas creativas', '2015-06-03 22:28:20', 'Talleres creativos para todas las edades. Crea tus propias libretas, cuadernos, agendas,... organízate en tu día a día a partir de estos materiales. Contacta en: libretascreativas@crea.com. Precios a consultar según el taller.', 38031, 7),
(24, 11, 1, 'Como un profesional editorial', '2015-06-03 22:52:54', 'Curso básico en Adobe Indesign. ¿Buscas qué tus trabajos queden como si fueras un profesional del diseño? Aquí te proponemos dar el primer paso con Adobe Indesign. Clases personalizadas, en grupos pequeños a 15€/hora. Contacta en: 699805067. ', 38023, 7),
(25, 11, 4, 'Estilo propio', '2015-06-03 23:06:06', '¿Te gusta la moda? Tienes una oportunidad de acercarte a ella. Aprende a desfilar como un/a modelo profesional. Participarás en desfiles de nuevas marcas emprendedoras. Clases gratuitas los martes a las 17:00 en la Casa de La Cultura de Garachico. ', 38015, 7),
(26, 11, 10, 'Recicla', '2015-06-03 23:17:56', 'Crea objetos a partir del reciclaje. Asociación de vecinos de la Cruz Santa, nos reunimos todos los viernes de 18:00 a 20:00 horas. Solo necesitas elementos que quieras reutilizar y tu creatividad. ¡Te esperamos!', 38031, 7),
(27, 12, 9, 'Postres', '2015-06-03 23:24:02', '¿Quieres sorprender a tus invitados con postres extraordinarios?. Clases de repostería a 10€/ hora. Ponte en contacto conmigo en 660354075.', 38025, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxcategorias`
--

CREATE TABLE IF NOT EXISTS `auxcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=38902 ;

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

CREATE TABLE IF NOT EXISTS `auxroles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `auxroles`
--

INSERT INTO `auxroles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `idactividad`, `idusuario`, `texto`, `created`) VALUES
(1, 1, 2, 'Comentario de prueba', '2015-05-25 13:31:47'),
(2, 1, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(3, 2, 6, 'Comentario de prueba', '2015-05-25 13:31:47'),
(4, 2, 7, 'Comentario de prueba', '2015-05-25 13:31:47'),
(5, 3, 8, 'Comentario de prueba', '2015-05-25 13:31:47'),
(6, 3, 5, 'Comentario de prueba', '2015-05-25 13:31:47'),
(7, 1, 6, 'Comentario de prueba aleatorio', '2015-05-25 13:31:47'),
(8, 10, 4, 'Comentario de prueba', '2015-05-25 13:31:47'),
(9, 10, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(10, 3, 6, 'Comentario de prueba', '2015-05-25 13:31:47'),
(11, 2, 3, 'Comentario de prueba', '2015-05-25 13:31:47'),
(12, 2, 4, 'Comentario de prueba', '2015-05-25 13:31:47'),
(13, 6, 8, 'Comentario de prueba', '2015-05-25 13:31:47'),
(14, 6, 5, 'Comentario de prueba', '2015-05-25 13:31:47'),
(15, 10, 7, 'Comentario de prueba', '2015-05-25 13:31:47'),
(16, 2, 5, 'Comentario de prueba con hora distinta', '2015-05-25 14:31:56'),
(41, 23, 1, 'Me apunto. Tiene muy buena pinta, cuanto cuesta?', '2015-06-03 22:38:47'),
(42, 23, 11, 'Talleres económicos y a la vez útiles. ', '2015-06-03 22:38:48'),
(43, 23, 11, 'Los talleres cuestan entre 20 y 50 euros dependiendo de los materiales a utilizar y la fecha, puedes encontrar más información en www.tallerescrea.com', '2015-06-03 22:39:55'),
(44, 3, 11, 'Una actividad genial para los más pequeños', '2015-06-03 22:57:06'),
(45, 9, 11, 'Recomendado para innovar en tu cocina, les animo a probar. ', '2015-06-03 23:08:56'),
(46, 26, 11, '¡Nos vemos en la Cruz Santa!, gran iniciativa de los vecinos, junto con profesionales de arte.', '2015-06-03 23:20:05'),
(47, 9, 12, 'Interesante si quieres aprender algo nuevo y experimentar con la cocina. He asistido a una clase. Actividad recomendada.', '2015-06-03 23:25:31'),
(48, 23, 12, 'He creado la mía, me encanta dejar a un lado las típicas agenda y poder adaptarla a mis necesidades. Muy recomendable.', '2015-06-03 23:27:00'),
(49, 8, 12, 'Hecho en falta el nivel universitario.', '2015-06-03 23:27:56'),
(50, 27, 12, 'Encantada con estas clases, te enseñan recetas innovadoras y a la vez sencillas. ', '2015-06-03 23:30:00'),
(51, 27, 1, 'Si y quedan muy ricas', '2015-06-04 09:51:05'),
(52, 27, 1, 'Buenisimas', '2015-06-05 20:02:42');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `idactividad`, `ruta`, `created`) VALUES
(1, 1, 'img/img_actividades/clasesdesarrollo.jpg', '2015-05-23 21:30:15'),
(2, 2, 'img/img_actividades/clasespadel.jpg', '2015-05-23 21:30:15'),
(3, 3, 'img/img_actividades/cuentacuentos.jpg', '2015-05-23 21:50:28'),
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
(16, 16, 'img/img_actividades/blenderdesign.png', '2015-05-25 17:09:59'),
(23, 23, 'img/img_actividades/Aprende a hacer libretas creativasavatar.png', '2015-06-03 22:28:20'),
(24, 24, 'img/img_actividades/Como un profesional editorialavatar.png', '2015-06-03 22:52:54'),
(25, 25, 'img/img_actividades/Estilo propioavatar.png', '2015-06-03 23:06:06'),
(26, 26, 'img/img_actividades/Reciclaavatar.png', '2015-06-03 23:17:56'),
(27, 27, 'img/img_actividades/Postresavatar.png', '2015-06-03 23:24:02');

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
  PRIMARY KEY (`id`),
  KEY `idmunicipio` (`idmunicipio`),
  KEY `idrol` (`idrol`),
  KEY `idisla` (`idisla`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nick`, `nombre`, `apellidos`, `password`, `idrol`, `idmunicipio`, `idisla`, `created`, `avatar`) VALUES
(1, 'janaigus@gmail.com', 'janai', 'Janai Gustavo', 'Expósito Bethencourt', '2e99bf4e42962410038bc6fa4ce40d97', 1, 38031, 7, '2015-05-15 21:39:36', 'img/img_usuarios/avatares/janaisavatar.png'),
(2, 'jonaigus@gmail.com', 'admin', 'Administrador', 'Administrador', '2e99bf4e42962410038bc6fa4ce40d97', 1, 38041, 7, '2015-05-15 21:39:36', 'img/img_usuarios/avatares/default.png'),
(3, 'janai_exposito@outlook.com', 'Usuario', 'Usuario', 'Usuario', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35004, 3, '2015-05-15 21:40:41', 'img/img_usuarios/avatares/default.png'),
(4, 'otrouser@otrouser.es', 'Otrouser', 'Otrouser', 'Otrouser', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35015, 1, '2015-05-15 21:40:41', 'img/img_usuarios/avatares/default.png'),
(5, 'pepe@benavente.com', 'pebe', 'Pepe', 'Benavente', '2e99bf4e42962410038bc6fa4ce40d97', 2, 38028, 7, '2015-05-23 21:58:05', 'img/img_usuarios/avatares/default.png'),
(6, 'hely@clak.com', 'hecl', 'Hely', 'Clarckson', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35016, 2, '2015-05-23 22:00:18', 'img/img_usuarios/avatares/default.png'),
(7, 'metal@lovers.com', 'melo', 'Metal', 'Lovers', '2e99bf4e42962410038bc6fa4ce40d97', 2, 38901, 5, '2015-05-23 22:04:03', 'img/img_usuarios/avatares/default.png'),
(8, 'datos@prueba.com', 'dapr', 'Datosde', 'Pruebas', '2e99bf4e42962410038bc6fa4ce40d97', 2, 35007, 1, '2015-05-23 22:05:41', 'img/img_usuarios/avatares/dapravatar.jpg'),
(11, 'judithamaroes@gmail.com', 'judithamaroes', 'Judith', 'Amaro', '795d03fcaf9ebead8800526b5c3f9dcb', 2, 38031, 7, '2015-06-03 22:08:47', 'img/img_usuarios/avatares/default.png'),
(12, 'pardiluna@gmail.com', 'PardiLuna', 'Pardi', 'Luna', '795d03fcaf9ebead8800526b5c3f9dcb', 2, 38023, 7, '2015-06-03 23:20:56', 'img/img_usuarios/avatares/default.png');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=124 ;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id`, `idactividad`, `idusuario`, `valoracion`, `created`) VALUES
(78, 5, 3, 5, '2015-05-24 09:21:57'),
(79, 5, 3, 4, '2015-05-24 09:21:57'),
(80, 2, 2, 3, '2015-05-24 09:21:57'),
(81, 2, 3, 3, '2015-05-24 09:21:57'),
(82, 9, 8, 4, '2015-05-24 09:21:57'),
(83, 7, 3, 2, '2015-05-24 09:21:57'),
(84, 4, 7, 1, '2015-05-24 09:21:57'),
(85, 2, 3, 2, '2015-05-24 09:21:57'),
(86, 1, 7, 3, '2015-05-24 09:21:57'),
(87, 3, 5, 3, '2015-05-24 09:21:57'),
(88, 4, 6, 4, '2015-05-24 09:21:57'),
(89, 10, 6, 6, '2015-05-24 09:21:57'),
(90, 3, 3, 2, '2015-05-24 09:21:57'),
(91, 2, 6, 3, '2015-05-24 09:21:57'),
(92, 2, 3, 5, '2015-05-24 09:21:57'),
(93, 6, 6, 3, '2015-05-24 09:21:57'),
(94, 10, 4, 4, '2015-05-24 09:21:57'),
(95, 5, 3, 4, '2015-05-24 09:21:57'),
(96, 4, 7, 2, '2015-05-24 09:21:57'),
(97, 8, 6, 5, '2015-05-24 09:21:57'),
(117, 23, 11, 5, '2015-06-03 22:38:48'),
(118, 3, 11, 5, '2015-06-03 22:57:06'),
(119, 9, 11, 5, '2015-06-03 23:08:56'),
(120, 9, 12, 4, '2015-06-03 23:25:31'),
(121, 23, 12, 4, '2015-06-03 23:27:00'),
(122, 27, 12, 5, '2015-06-03 23:30:00'),
(123, 27, 1, 5, '2015-06-05 20:02:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
