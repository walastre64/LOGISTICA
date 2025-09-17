-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-03-2019 a las 12:08:20
-- Versión del servidor: 10.1.38-MariaDB-cll-lve
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bzrmbmzn_scripts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `process`
--

DROP TABLE IF EXISTS `process`;
CREATE TABLE `process` (
  `id_process` int(10) NOT NULL,
  `executed` int(10) NOT NULL,
  `total` int(10) NOT NULL,
  `percentage` float NOT NULL,
  `execute_time` varchar(128) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `process`
--

INSERT INTO `process` (`id_process`, `executed`, `total`, `percentage`, `execute_time`, `date_add`, `date_upd`) VALUES
(1, 0, 0, 0, '', '2019-03-27 12:05:48', '2019-03-27 11:06:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
