-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2018 at 05:37 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anime_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `username`, `hashed_password`) VALUES
(2, 'Juli', 'Cheng', 'hello@email.com', 'julicheng', '$2y$10$mNprkCVwKbnRVPy5JsTIGeVQVWVu44jKAxxbU6IKLVUh50c.AN11C'),
(3, 'John', 'Smith', 'john@hello.com', 'johnsmith', '$2y$10$hQwE4Y3xAl4UZ/A7RbZ4GOp3nowyFYluctDOCpHVhGIDhfXWm.L96');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'Comedy', 1, 1),
(2, 'Slice of Life', 2, 1),
(3, 'Romance', 3, 1),
(4, 'Drama', 4, 1),
(5, 'School', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `fk_genre_id` (`genre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `genre_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(1, 1, 'Barukamon', 1, 0, 'barukamon'),
(2, 1, 'Free!', 3, 1, 'free!'),
(3, 1, 'Lucky Star', 4, 1, 'lucky star'),
(4, 1, 'Skip Beat!', 5, 1, 'skip beat!'),
(5, 1, 'Toradora!', 6, 1, 'toradora!'),
(6, 2, 'Usagi Drop', 6, 1, 'usagi drop'),
(7, 2, 'Clannad', 7, 1, 'clannad'),
(8, 3, 'Kimi Ni Todoke', 8, 1, 'kimi ni todoke'),
(9, 3, 'Tsuki Ga Kirei', 9, 1, 'tsuki ga kirei'),
(10, 4, 'Nana', 10, 1, 'nana'),
(11, 5, 'Ouran High School Host Club', 11, 1, 'ouran high school host club'),
(12, 5, 'School Rumble', 12, 1, 'school rumble'),
(13, 1, 'The Melancholy of Haruhi Suzumiya', 2, 0, 'haruhi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
