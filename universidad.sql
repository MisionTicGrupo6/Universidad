-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2019 a las 13:54:24
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `universidad`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cambiarEstado` (IN `id` INT)  NO SQL
BEGIN

UPDATE matriculas SET Estado = (CASE WHEN Estado = 1 THEN 0 ELSE 1 END) WHERE IdMatricula = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editarCurso` (IN `id` INT, IN `horas` INT, IN `nivel` INT, IN `costo` FLOAT)  NO SQL
BEGIN
UPDATE cursos SET Horas = horas, Nivel = nivel, ValorCurso = costo WHERE IdCurso = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editarEstudiante` (IN `id` INT, IN `nombres` VARCHAR(100), IN `correo` VARCHAR(100))  NO SQL
BEGIN
UPDATE estudiantes SET Nombres = nombres, Correo = correo WHERE IdEstudiante = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editarUsuario` (IN `id` INT, IN `nombres` VARCHAR(100), IN `usuario` VARCHAR(100))  NO SQL
BEGIN

UPDATE usuarios SET NombreCompleto = nombres, Usuario = usuario WHERE IdUsuario = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarCurso` (IN `id` INT)  NO SQL
BEGIN

DELETE FROM	cursos WHERE IdCurso = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarEstudiante` (IN `id` INT)  NO SQL
BEGIN

DELETE FROM	estudiantes WHERE IdEstudiante = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarUsuario` (IN `id` INT)  NO SQL
BEGIN

DELETE FROM usuarios WHERE IdUsuario = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarCurso` (IN `curso` VARCHAR(100), IN `horas` INT, IN `nivel` INT, IN `valor` FLOAT)  NO SQL
BEGIN

INSERT INTO cursos(Curso, Horas, Nivel, ValorCurso) 
VALUES(curso, horas, nivel, valor);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarEstudiante` (IN `documento` VARCHAR(20), IN `nombres` VARCHAR(100), IN `correo` VARCHAR(100))  NO SQL
BEGIN

INSERT INTO estudiantes(Documento, Nombres, Correo) 
VALUES(documento, nombres, correo);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarMatricula` (IN `fechamatricula` DATE, IN `estado` TINYINT, IN `idCurso` INT, IN `idEstudiante` INT, IN `idUsuario` INT)  NO SQL
BEGIN

INSERT INTO matriculas(FechaMatricula, Estado, IdCurso, IdEstudiante, IdUsuario) VALUES(fechamatricula, estado, idCurso, idEstudiante, idUsuario);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertarUsuario` (IN `usuario` VARCHAR(100), IN `clave` VARCHAR(255), IN `nombreC` VARCHAR(100), IN `estado` TINYINT)  NO SQL
BEGIN

INSERT INTO usuarios(Usuario, Clave, NombreCompleto, Estado) 
VALUES(usuario, clave, nombreC, estado);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaCursos` ()  NO SQL
BEGIN
SELECT * FROM cursos;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaEstudiantes` ()  NO SQL
BEGIN
SELECT * FROM estudiantes;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaMatriculas` ()  NO SQL
BEGIN

SELECT M.IdMatricula, M.FechaMatricula, C.Curso, E.Documento, E.Nombres, M.Estado
FROM matriculas AS M INNER JOIN cursos AS C ON M.IdCurso = C.IdCurso
INNER JOIN estudiantes AS E ON M.IdEstudiante = E.IdEstudiante;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listaUsuarios` ()  NO SQL
BEGIN
SELECT IdUsuario, Usuario, NombreCompleto, Estado FROM usuarios;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarUsuario` (IN `users` VARCHAR(100), IN `pass` VARCHAR(255))  NO SQL
BEGIN

SELECT * FROM usuarios WHERE Usuario = users AND Clave = pass
AND Estado = 1;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `IdCurso` int(11) NOT NULL,
  `Curso` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Horas` int(11) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `ValorCurso` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`IdCurso`, `Curso`, `Horas`, `Nivel`, `ValorCurso`) VALUES
(1, 'mat', 10, 2, 25000),
(2, 'esp', 10, 2, 25000),
(6, 'php', 450, 5, 1200000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `IdEstudiante` int(11) NOT NULL,
  `Documento` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Nombres` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Correo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`IdEstudiante`, `Documento`, `Nombres`, `Correo`) VALUES
(1, '1152198951', 'Michael', 'maicd.g_0322@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `IdMatricula` int(11) NOT NULL,
  `FechaMatricula` date NOT NULL,
  `Estado` tinyint(4) NOT NULL,
  `IdCurso` int(11) NOT NULL,
  `IdEstudiante` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`IdMatricula`, `FechaMatricula`, `Estado`, `IdCurso`, `IdEstudiante`, `IdUsuario`) VALUES
(1, '2019-12-06', 1, 1, 1, 1),
(2, '2019-12-05', 1, 6, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Usuario` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Clave` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `NombreCompleto` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Usuario`, `Clave`, `NombreCompleto`, `Estado`) VALUES
(1, 'lizeth', 'adcd7048512e64b48da55b027577886ee5a36350', 'Lizeth Pino', 1),
(3, 'mzapata', 'adcd7048512e64b48da55b027577886ee5a36350', 'Michael', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`IdCurso`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`IdEstudiante`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`IdMatricula`),
  ADD KEY `IdCurso` (`IdCurso`),
  ADD KEY `IdEstudiante` (`IdEstudiante`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `IdCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `IdEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `IdMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `fk_matriculas_cursos` FOREIGN KEY (`IdCurso`) REFERENCES `cursos` (`IdCurso`),
  ADD CONSTRAINT `fk_matriculas_estudiantes` FOREIGN KEY (`IdEstudiante`) REFERENCES `estudiantes` (`IdEstudiante`),
  ADD CONSTRAINT `fk_matriculas_usuarios` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
