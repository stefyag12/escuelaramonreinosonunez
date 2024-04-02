-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2024 a las 04:55:03
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
-- Base de datos: `inscripcion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `cedula` int(8) NOT NULL,
  `nombre_estudiante` varchar(50) NOT NULL,
  `nombre_representante` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grado` varchar(60) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `direccion` text NOT NULL,
  `acta` varchar(50) NOT NULL,
  `fotorep` varchar(30) NOT NULL,
  `fotoest` varchar(50) NOT NULL,
  `vacuna` varchar(50) NOT NULL,
  `certificado` varchar(50) NOT NULL,
  `cardio` varchar(50) NOT NULL,
  `edad` varchar(2) NOT NULL,
  `observacion` text NOT NULL,
  `id_docente` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`cedula`, `nombre_estudiante`, `nombre_representante`, `telefono`, `email`, `grado`, `fecha_nacimiento`, `sexo`, `fecha`, `direccion`, `acta`, `fotorep`, `fotoest`, `vacuna`, `certificado`, `cardio`, `edad`, `observacion`, `id_docente`) VALUES
(1, 'Julieth Mejias Ruz', 'Jenny Beatriz Mejias Ruz', '04121677549', 'jennymr@gmail.com', '1ero', '2018-01-01', 'Hembra', '2024-03-30 19:45:55', 'URB las 40 calle 5', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '6', 'SO', 0),
(55, 'Claudia Lorenza Lopez Ramirez', 'Zaida Lopez Urbina perez', '04126652266', 'weofib9ub@vbub-com', '2do', '2007-02-18', 'Hembra', '2024-03-26 21:17:46', 'Los Laureles, sector 9df sdfosdfsdfsdf13123123123123123', 'Sí', 'Sí', 'No', 'No', 'No', 'No', '12', 'asd', 0),
(87, 'Claudia Lorenza Lopez', 'Zaida Lopez Urbina', '04126652266', 'studentss2@gmail.com', '2do', '2001-12-12', 'Hembra', '2024-03-26 21:04:07', 'Los Laureles, sector 9df sdfosdfsdfsdf13123123123123123', 'Sí', 'No', 'Sí', 'No', 'Sí', 'Sí', '10', 'S/O', 0),
(150, 'Erick Jose Mi amiguito loquito', 'Stefany Aguilar', '09876543233', 'docente1@gmail.com', '6to', '2009-12-12', 'Varon', '0000-00-00 00:00:00', 'Delicias nuevas', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', '12', '12', 0),
(152, 'Solana Martinez Lugo', 'Miranda Martinez Lugo', '09876543233', 'mirandalugo@gmail.com', '2do', '2014-02-12', 'Hembra', '2024-04-01 17:49:02', 'Av 33', 'No', 'No', 'No', 'No', 'No', 'No', '10', '', 0),
(11456239, 'Stefany Carolina Aguilar', 'Ruben Dario Aguilar Pena', '04121621615', 'rubenaguilar@hotmail.com', '5to', '2013-12-20', 'Hembra', '0000-00-00 00:00:00', 'hola', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '10', 'Stefany tiene alergia', 0),
(11885699, 'Emily Carolina Chirinos Romero', 'Nohemi Chirinos', '04246416427', 'nohemichirinos@hotmail.com', '6to', '2011-12-05', 'Hembra', '0000-00-00 00:00:00', 'Los laureles', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '12', 'Sin observaciones', 0),
(12344567, 'Claudia Josefa Lopez Labrador', 'Zailu Lopez', '04126652266', 'Zailulopez@gmail.com', '3ero', '2001-12-12', 'Hembra', '2024-03-30 20:17:16', 'Av. principal delicias nuevas, diagonal a la panaderia mujer', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', '10', 'Sin observaciones', 0),
(21428050, 'Harold Antonio Martinez', 'Heiza Martinez', '04120636081', 'HeizaM12@outlook.com', '5to', '2010-02-20', 'Varon', '0000-00-00 00:00:00', 'calle la estrella sector amparito', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '13', 'Harold es un niño muy vicioso a videojuegos, no permitirle utilizar el telefono en clases', 0),
(23111555, 'Abraham Alejandro Thiago Sanchez', 'Rocio Yesenia Meza Que mas aplauda', '02642513938', 'RocioYese@outlook.com', '2do', '2016-05-20', 'Varon', '0000-00-00 00:00:00', 'Delicias nuevas', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', '7', 'Es un niño muy alegre y extrovertido', 0),
(23123123, ' Julio', '1231231', '12312312312', 'rfsgfdgf@jhgjhg.cpom', '2do', '2001-03-02', 'Hembra', '0000-00-00 00:00:00', '123123123', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '12', 'qweqwe', 0),
(28544659, 'Nestor Luis Castro Lugo', 'Brenda del Carmen ', '04146655223', 'Brendis_12@outlook.com', '1ero', '2011-01-20', 'Varon', '0000-00-00 00:00:00', 'Por la bomba trinidad', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '12', 'Nestor posee alergia al mango', 0),
(29519760, 'Emily Chirisno', 'stefany', '04121621615', 'robertklare2@gmail.com', '4to', '2001-02-03', 'Hembra', '0000-00-00 00:00:00', 'los laurelea', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '12', 'asdasdad', 0),
(29584625, 'Willians Bless Sanchez Zabala', 'Yolimir Zabala', '0412655988', 'YolimirZabala13@hotmail.com', '6to', '2011-05-19', 'Varon', '0000-00-00 00:00:00', 'Concordia, calle la paz', 'Sí', 'No', 'No', 'Sí', 'No', 'No', '12', 'No hay observaciones', 0),
(29819092, 'Alexandro Enrique Gonzalez Escova', 'Guillermo Enrique González Escova', '04121621545', 'luismiguelvilladiego@hotmail.com', '4to', '2012-05-19', 'Varon', '0000-00-00 00:00:00', 'en su casa', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '11', 'Alexandro Es imperactivo', 0),
(31115477, 'Andres Fernandez', 'Danialys Castellanos', '04120637071', 'robertklare2@gmail.com', '4to', '2014-01-27', 'Varon', '0000-00-00 00:00:00', 'Urb. Colinas de bello monte', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', '10', 'Vive lejos', 0),
(39908666, 'Emily Chirisno', 'Nohemis karmina', '0412621616', 'rfsgfdgf@jhgjhg.cpo', '1ero', '2008-05-12', 'Hembra', '0000-00-00 00:00:00', 'los laurele', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí', '10', 'es bella', 0),
(115563221, '456123123', 'stefanys', '31231231231', 'asdasda@ajfhadjs.xom', '5to', '6220-02-03', 'Hembra', '0000-00-00 00:00:00', 's', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '12', 'S/o', 0),
(118856992, 'Erick Ruz Gonzalez', 'Marisela Monagas Ruz', '04121677549', 'mariruz@gmail.com', '6to', '2018-03-12', 'Varon', '2024-04-01 17:52:02', 'Delicias nuevas', 'No', 'No', 'No', 'No', 'No', 'No', '6', '', 0),
(333465156, 'Stefany Aguilar', 'Nohemis karminaa', '4562123554', 'marthaejimenez@hotmail.com', '3ero', '2001-03-09', 'Hembra', '0000-00-00 00:00:00', 'los laurelea', 'Sí', 'No', 'Sí', 'No', 'Sí', 'Sí', '45', '123132', 0),
(399086663, 'Julieth Mejias Ruz Lopez', 'Jenny Beatriz Mejias Ruz', '04126652266', 'weofib9ub@vbub.com', '5to', '2014-03-31', 'Hembra', '2024-04-01 17:45:25', 'Delicias nuevas', 'No', 'No', 'No', 'No', 'No', 'No', '10', '', 0),
(1112990192, 'Jose Luis Morales Marquez', 'Luis Morales Capielo', '04121621845', 'LuisMora@gmail.com', '3ero', '2015-02-02', 'Varon', '0000-00-00 00:00:00', 'Av. Principal Delicias Nuevas', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '8', 'Sin observaciones', 0),
(1112990194, 'kevin martinez', 'stefany', '04121621845', 'LuisMora@gmail.com', '3ero', '3333-03-03', 'Varon', '0000-00-00 00:00:00', 'Av. Principal Delicias Nuevas', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '8', 'Sin observaciones', 0),
(1234456712, 'Claudia Lorenza Lopez Morales', 'Zaida Lopez Urbina Morales', '04126652266', 'weofib9ub@vbub-com', '1ero', '2012-03-31', 'Hembra', '2024-04-01 17:33:29', 'Delicias nuevas', 'No', 'No', 'No', 'No', 'No', 'No', '12', '', 0),
(1234789213, 'Stefany Carolina Aguilar Chirinos', 'Alexandro Enrique Gonzalez Chankleta', '12312783418', 'stefanyaguilar.1@hotmail.com', '6to', '2023-05-26', 'Hembra', '0000-00-00 00:00:00', 'calle la estrella sector amparito', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '21', 'adws', 0),
(2147483647, 'Guillermo Jose Gonzalez Cova', 'Liliana Josefina Cova ', '04121621615', 'LiliJoseCova@hotmail.com', '1ero', '2017-12-02', 'Varon', '0000-00-00 00:00:00', 'Delicias Nuevas, calle san Felix', 'Sí', 'No', 'Sí', 'No', 'Sí', 'No', '6', 'Sin observaciones', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `cedula` int(8) NOT NULL,
  `nota` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `cedula`, `nota`) VALUES
(23, 28544659, '1'),
(24, 333465156, '1'),
(25, 29519760, '1'),
(26, 11456239, '0'),
(27, 23111555, '0'),
(28, 1112990192, '0'),
(29, 11885696, '0'),
(30, 21428050, '0'),
(31, 1112990194, 'a'),
(32, 31115477, '0'),
(33, 115563221, 'A'),
(34, 29819092, 'A'),
(35, 39908666, 'A'),
(36, 12344567, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `username`, `password`, `user_type`) VALUES
(6, 'HaroldAntonio', 'stefany12', 'normal_user'),
(7, 'AlexandroG', 'aleg24', 'admin'),
(9, 'willian24', 'stefany12', 'normal_user'),
(14, 'karinaferrer', 'stefany12', 'normal_user'),
(15, 'stefanyaguilar918', 'Stefany12*', 'docente'),
(16, 'stefanyaguilar918', 'Stefany12*', 'admin'),
(17, 'kevin', 'stefany12', 'docente'),
(18, 'a', '$2y$10$j9QTGhGXe/qjtfdd.aU2BOkhBR4.lBFToHQoOI2X82j', 'normal_user'),
(19, 'Stefany12', '$2y$10$FCEx8A7uFd.oD/ZSqnlTE.pdXydDsvanQ4o4Slxgawq', 'admin'),
(20, 'AlexandroG1', '$2y$10$wvOY/QcbG4kyBcrsNbs8eOqHd/X8/qp1bfp7zVCqD5U', 'normal_user'),
(21, 'Stef12', '$2y$10$q8YLAtuHtvWwk2mSTxRvneLJAYnXW624gwvVo4JPO4P', 'normal_user'),
(22, 'Stef12', '$2y$10$HB0RkbaA/BurxUZucRTxCObgo6qPV3WJ1QflVOTStXb', 'normal_user'),
(23, 'stefanyaguilar912@gmail.com', '$2y$10$x7pYlDaC/qNQYI9PW3x.Pew035cdYlMyOO87HIbLOcP', 'admin'),
(24, 'AlexandroG', '$2y$10$wW.oEHGA4pHAn8axrSHICuq.xqsV4lDwALftXHznE3I', 'admin'),
(25, 'Stefanycac', '$2y$10$KU/sQi/T7QSNPLKZCN.OaeeiqTj0YPbCRrSKme1m1/C', 'normal_user'),
(26, 'Stefanycac', '$2y$10$NVWhM0wAjgpFEfIQNnfzBeHbfBe5DDPnuM6FHnY75jL', 'normal_user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrodocente`
--

CREATE TABLE `registrodocente` (
  `cedula` int(8) NOT NULL,
  `nombre_docente` varchar(50) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grado` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `edad` varchar(2) NOT NULL,
  `observacion` varchar(50) NOT NULL,
  `acta` varchar(50) NOT NULL,
  `fotorep` varchar(50) NOT NULL,
  `fotoest` varchar(50) NOT NULL,
  `vacuna` varchar(50) NOT NULL,
  `certificado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registrodocente`
--

INSERT INTO `registrodocente` (`cedula`, `nombre_docente`, `fecha_ingreso`, `telefono`, `email`, `grado`, `fecha_nacimiento`, `sexo`, `direccion`, `edad`, `observacion`, `acta`, `fotorep`, `fotoest`, `vacuna`, `certificado`) VALUES
(0, '', '0000-00-00', '', '', '', '0000-00-00', 'Hombre', 'los laurelea', '', '1212', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí'),
(2000, '1212', '0000-00-00', '121', 'marthaejimenez@hotmail.com', '3ero', '1211-02-12', 'Hembra', '12121', '21', '12121', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí'),
(31115477, 'putencia2', '1211-02-12', '231', 'robertklare2@gmail.com', '4to', '2009-12-12', 'Hembra', 'asdasd', '12', '123123123', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí'),
(39908666, 'Maria Andrea Camacho Soto', '2001-12-12', '09876543233', 'ProfDC2@gmail.com', '5to', '1960-12-12', 'Hembra', 'Delicias nuevas', '12', 'Tiene dos hijos', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí'),
(2147483647, 'Douglas Andres Camacho Soto', '4444-05-04', '66666674433', 'ProfDC@gmail.com', '1ero', '5555-06-05', 'Varon', 'Delicias nuevas', '12', 'hpñaaa', 'Sí', 'Sí', 'Sí', 'Sí', 'Sí');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registrodocente`
--
ALTER TABLE `registrodocente`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `cedula` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `registrodocente`
--
ALTER TABLE `registrodocente`
  MODIFY `cedula` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
