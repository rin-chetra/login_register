-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 06:52 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_social_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `languages` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `act_code` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `activated` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `u_name`, `u_email`, `gender`, `languages`, `country`, `password`, `signup_date`, `last_login`, `act_code`, `note`, `activated`) VALUES
(1, 'Varun', 'varun@gmail.com', 'm', 'English', 'India', '$2y$10$/YgYTyI2NKmC9y/TeI4BCOmRsxfBIlYfMFkauqr42z9rcdNx76AsC', '2017-02-13 10:30:31', '2017-02-13 10:30:31', '115f2d8a77ea2dc1e345453bd3853e0b4828449166c172b4', '', '0'),
(2, 'Rizwan Khan', 'rizwankhan.august16@gmail.com', 'm', 'English,Hindi,Urdu', 'India', '$2y$10$fpbIMK4jjuItZZVJoq5Cou4ujcgEVJBmuNci1FERBtKa745IgbBWa', '2017-02-13 10:33:07', '2017-03-11 18:56:28', '710f383d4788d416e97a98a3b136b281e67222c9ad158be7', '', '1'),
(3, 'Test', 'test@gmail.com', 'm', 'English,Urdu', 'India', '$2y$10$9PV1b1RE7BVu3q4ORhpe1eS7oFRZjPJBKqUE.B784sCnpkMzVIdee', '2017-02-13 12:00:19', '2017-02-13 12:00:19', 'e369d882b81d5ca989e24780ad63975173783e615db11854', '', '0'),
(4, 'Salman Khan', 'salman@gmail.com', 'm', 'English', 'India', '$2y$10$w3BCtlsYAoLoazRGwGyjnu9U2EOKipWbInOAHhrlMEtQb4IJ7qbHO', '2017-02-13 12:01:45', '2017-02-13 12:01:45', '961753ad6948ece86a55346510fa98997a67476028149e6f', '', '0'),
(5, 'Katrina Kaif', 'katrinakaif@yahoo.com', 'f', 'English', 'India', '$2y$10$IdTwCNQGYBqckW54/1rYRushsizxXpWQeMKjUvTJUbBzt7BeQ6cRy', '2017-02-13 12:04:52', '2017-02-13 12:04:52', 'd8039041ae897602668463f5523688b98782365648b42d15', '', '0'),
(6, 'Katrina Kaif', 'best@yahoo.com', 'f', 'English', 'India', '$2y$10$HiIJ1zkFehIB4DBF6y6fTOc03.3VKfy69BnYyqdkVrwZe56b75AEW', '2017-02-13 12:06:06', '2017-02-13 12:06:06', '4b4687b994fa9f8682902908b4c176070898c31b6cb6e582', '', '0'),
(7, 'Katrina Kaif', 'graat@yahoo.com', 'f', 'English', 'India', '$2y$10$62OaaGVQ.bTVE1gXjQVIxuw6yv.SwJzyINAF5XjgTaSZZdbFbFwta', '2017-02-13 12:07:22', '2017-02-13 12:07:22', 'a6e64482240e7dc99f9f57197d6388d5d2b456520da4e918', '', '0'),
(14, 'Shahrukh Khan', 'srk@gmail.com', 'm', 'English,Hindi,Urdu', 'India', '$2y$10$C.tK7tdur9lQHS7b1XP/Uue1/V63jACQszMMO3oLm9ehsrRuG5DsO', '2017-02-13 12:27:38', '2017-02-13 12:27:38', 'd1c7b6b1a314656652768957f22d8e855d3b713fb1446754', '', '0'),
(15, 'Md Rizwan', 'rizwankgust16@gmail.com', 'm', 'English', 'India', '$2y$10$fnrvFMxBlYpa7szr5do.5O9ytVZnpBN66.BEwbIbaFredOOFMBBDu', '2017-02-18 04:27:10', '2017-02-18 04:27:10', '87b861847e24a656629944cca8a0023a456316267f388209', '', '0'),
(16, 'Sonam Gupta', 'sonam@gmail.com', 'f', 'English,Hindi', 'India', '$2y$10$CfU4uFp7tFRIGC7KGZKcmOe6FNZbBTYSX1f3k5RPPJSjRHYnALmve', '2017-02-18 15:09:13', '2017-02-18 15:09:13', '8812f9593952e8c72e4539103103764971aa6cecd8ed56d7', '', '0'),
(17, 'Rizwan', 'riz@f.com', 'm', 'English', 'India', '$2y$10$1OWNaFtSGu/bg.yV6trONe5RVNnHOWMM7L8h43K3OO/.VoamyCNWa', '2017-02-21 17:27:04', '2017-02-21 17:27:04', '4708142ac917f4683174ca9819eb075010147792c2c26344', '', '0'),
(18, 'Karan', 'karan@gmail.com', 'm', 'English', 'India', '$2y$10$F2FyBJL5ZR6ojrKFVd/qSOecJfopeoG7.O93wzQz.0R8kOq7A84C2', '2017-02-26 10:43:28', '2017-02-26 10:43:28', '4d06d502078c01a5b9899cd841168f08ad0fde1a922e2073', '', '0'),
(19, 'Amjad Khan', 'amjad@gmail.com', 'm', 'English', 'Pakistan', '$2y$10$Jt1QhW2HEG3PDVB93x/DA.z44SD1/Ztmr252opiSMKC/eai/5mT9.', '2017-03-11 10:51:25', '2017-03-11 10:51:25', '7d21981889286a304465269f8158e5089045959247592818', '', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
