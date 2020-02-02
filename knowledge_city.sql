-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.10-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para knowledge_city
DROP DATABASE IF EXISTS `knowledge_city`;
CREATE DATABASE IF NOT EXISTS `knowledge_city` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `knowledge_city`;

-- Volcando estructura para tabla knowledge_city.api_users
DROP TABLE IF EXISTS `api_users`;
CREATE TABLE IF NOT EXISTS `api_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla knowledge_city.api_users: 2 rows
/*!40000 ALTER TABLE `api_users` DISABLE KEYS */;
INSERT INTO `api_users` (`id`, `name`, `lastname`, `email`, `password`) VALUES
	(1, 'Armando', 'Garcia', 'ic.armando.1992@gmail.com', '4fk+pIPOCsn5Swaq5o8iFg=='),
	(2, 'Test', 'User', 'test_user@gmail.com', 'j4XBAdYc2oFNK1oXRJuVJQ==');
/*!40000 ALTER TABLE `api_users` ENABLE KEYS */;

-- Volcando estructura para tabla knowledge_city.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `token` text NOT NULL,
  `last_activity` int(11) NOT NULL DEFAULT 0,
  `remember` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `session_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla knowledge_city.sessions: 0 rows
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Volcando estructura para tabla knowledge_city.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla knowledge_city.students: 17 rows
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `name`, `lastname`) VALUES
	(1, 'Bernardo', 'Santini'),
	(2, 'George', 'Quebedo'),
	(3, 'Rob', 'Schnneider'),
	(4, 'Terry', 'Cruz'),
	(5, 'David', 'Smith'),
	(6, 'Jhon', 'Doe'),
	(7, 'Will', 'Smith'),
	(8, 'Leonel', 'Messi'),
	(9, 'Ronaldinho', 'Gaucho'),
	(10, 'Cuahtemoc', 'Blanco'),
	(11, 'Guillermo', 'Ochoa'),
	(12, 'Javier', 'Hernandez'),
	(13, 'Giovanny', 'Dos Santos'),
	(14, 'Diego', 'Garcia'),
	(15, 'Adriana', 'Lujan'),
	(16, 'Alberto', 'Mora'),
	(17, 'Sergey', 'Izvekov');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
