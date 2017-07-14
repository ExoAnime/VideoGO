-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2017 at 06:56 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videogo_script`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_title` varchar(100) NOT NULL,
  `c_slogan` varchar(150) NOT NULL,
  `c_seo` text NOT NULL,
  `c_domain` varchar(100) NOT NULL,
  `c_ssl` int(2) NOT NULL DEFAULT '1',
  `c_www` int(2) NOT NULL DEFAULT '1',
  `c_fb_page` varchar(220) NOT NULL,
  `c_expire_limit` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`c_id`, `c_name`, `c_title`, `c_slogan`, `c_seo`, `c_domain`, `c_ssl`, `c_www`, `c_fb_page`, `c_expire_limit`) VALUES
(1, 'VideoGO', 'VideoGo', 'Peliculas y Series sin limites', 'peliculas, sereies, online, movies, download, animes, mega, netflix, 1080p, HD', 'videogo.es', 1, 1, '', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(20) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_name` varchar(150) NOT NULL,
  `u_email` varchar(150) NOT NULL,
  `u_status` int(5) NOT NULL DEFAULT '0',
  `u_level` int(2) NOT NULL DEFAULT '1',
  `u_level_name` varchar(25) NOT NULL DEFAULT 'usuario',
  `u_date` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
