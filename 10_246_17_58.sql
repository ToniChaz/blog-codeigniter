-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 10.246.17.58:3306
-- Generation Time: Sep 20, 2014 at 11:57 AM
-- Server version: 5.5.38-MariaDB-1~wheezy
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `larutadelginton`
--
CREATE DATABASE `larutadelginton` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `larutadelginton`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(100) NOT NULL,
  `postuser` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `vote` int(10) DEFAULT NULL,
  `description` varchar(170) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title` (`title`,`text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author`, `postuser`, `date`, `text`, `title`, `slug`, `price`, `vote`, `description`, `status`, `type`) VALUES
(1, 'Toni Chaz', 'toni', '2014-02-08', '<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno est&aacute;ndar de las industrias desde el a&ntilde;o 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido us&oacute; una galer&iacute;a de textos y los mezcl&oacute; de tal manera que logr&oacute; hacer un libro de textos especimen. No s&oacute;lo sobrevivi&oacute; 500 a&ntilde;os, sino que tambien ingres&oacute; como texto de relleno en documentos electr&oacute;nicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creaci&oacute;n de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y m&aacute;s recientemente con software de autoedici&oacute;n, como por ejemplo Aldus PageMaker, el cual incluye versiones de (Los Extremos del Bien y El Mal)</p>', '¿Que es Lorem Ipsum es todo esto?', 'que-es-lorem-ipsum-es-todo-esto', 'low', 10, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 1, 'post'),
(2, 'Admin Surname', 'admin', '2014-03-02', '<p>Es un hecho establecido hace demasiado tiempo que un lector se distraer&aacute; con el contenido del texto de un sitio mientras que mira su dise&ntilde;o. El punto de usar Lorem Ipsum es que tiene una distribuci&oacute;n m&aacute;s o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aqu&iacute;, contenido aqu&iacute;". Estos textos hacen parecerlo un espa&ntilde;ol que se puede leer</p>', 'El trozo de texto estándar de Lorem Ipsum', 'el-trozo-de-texto-estandar-de-lorem-ipsum', 'low', NULL, '', 1, 'post'),
(3, 'Admin Surname', 'admin', '2014-03-02', '<p>Es un hecho establecido hace demasiado tiempo que un lector se distraer&aacute; con el contenido del texto de un sitio mientras que mira su dise&ntilde;o. El punto de usar Lorem Ipsum es que tiene una distribuci&oacute;n m&aacute;s o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aqu&iacute;, contenido aqu&iacute;".</p>', '¿Porque lo usamos?', 'porque-lo-usamos', 'low', NULL, '', 1, 'post'),
(4, 'Toni Chaz', 'toni', '2014-03-06', '<p><img src="/media/source/oceanos.jpg" alt="oceanos azul" width="600" height="334" /></p>\n<p>fh aksljdf hjkdsf hlasjkf halskdfj alsjkdf halskdfj aslkfj aslkfj aslkjf aslkfj aslkfjd haslkfdjh alskfjd haslfkjasdf los pasajes de Lorem Ipsum disponibles, pero la mayor&iacute;a sufri&oacute; alteraciones en alguna manera, ya sea porque se le agreg&oacute; humor, o palabras aleatorias que no parecen ni un poco cre&iacute;bles.&nbsp;</p>', 'Como lo puedes usar', 'como-lo-puedes-usar', 'medium', NULL, '', 1, 'post');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(2) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatarurl` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `role`, `name`, `surname`, `email`, `avatarurl`, `url`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Admin', 'Surname', 'toniwindows@hotmail.com', 'photo.jpg', NULL),
(20, 'toni', '4a7d1ed414474e4033ac29ccb8653d9b', 1, 'Toni', 'Chaz', 'toni.chaz@hotmail.com', 'snapshot5.png', 'http://www.tonichaz.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
