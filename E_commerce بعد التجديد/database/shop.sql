-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 06:33 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `visibility` tinyint(11) NOT NULL DEFAULT 0,
  `allo_adv` tinyint(11) NOT NULL DEFAULT 0,
  `allow_comment` tinyint(11) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `ordering`, `visibility`, `allo_adv`, `allow_comment`, `parent`) VALUES
(1, 'Clothes', 'It is strong category', 1, 0, 1, 0, 0),
(2, 'Technology', 'It has very smart items', 2, 0, 0, 1, 0),
(3, 'Uniforms', 'It is for students', 4, 1, 0, 0, 1),
(4, 'Suit', 'It suitable for businesmans', 7, 1, 1, 0, 1),
(5, 'Electricals', 'Good department', 9, 1, 1, 0, 0),
(6, 'D.J', 'It ha a great volume', 10, 1, 0, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `date`, `user_id`, `item_id`) VALUES
(1, 'It is very good t-shirt', 1, '2001-03-19', 6, 1),
(2, 'Good', 1, '2019-09-09', 1, 2),
(3, 'It is very special', 1, '2019-09-09', 1, 2),
(14, 'it is agood item', 1, '2019-09-09', 1, 2),
(19, 'It has agood cotton\r\n', 1, '2019-09-09', 1, 1),
(26, 'It made from a good material', 1, '2019-09-09', 1, 1),
(31, '       It is very wonderful jacket', 1, '2019-09-10', 6, 4),
(35, 'It is good lamb', 1, '2019-09-23', 3, 9),
(40, 'It is very smart', 1, '2019-09-29', 6, 3),
(41, 'it is good', 1, '2019-10-26', 17, 16);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `rating` smallint(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `approve` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `rate` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `date`, `rating`, `price`, `country`, `image`, `status`, `member_id`, `cat_id`, `approve`, `tags`, `rate`) VALUES
(1, 'T-Shirt', 'It is made from cotton', '2019-09-06', 0, '20', 'Boland', 'tshirt.jpg', '1', 1, 1, 1, 'zara', 1),
(2, 'I Phone', 'It is a smart phone ', '2019-09-06', 0, '300', 'U.S.A', 'iPhone.jpg', '1', 1, 2, 1, '', 0),
(3, 'SAMSUNG', 'It is very smart phone', '2019-09-08', NULL, '800', 'Jaban', 'Sam.jpg', '2', 6, 2, 1, 'China', 0),
(4, 'Jacket', 'It is made for winter', '2019-09-08', NULL, '80', 'Englang', 'jack.jpg', '1', 6, 1, 1, '', 1),
(7, 'Scarf', 'It is made from natural skin', '2019-09-09', NULL, '40', 'France', 'scarf.jpg', '3', 6, 1, 1, 'zara', 0),
(8, 'Honor ', 'It is from huawei  ', '2019-09-10', NULL, '500', 'U.S.A', 'honor.jpg', '2', 6, 2, 1, 'Huawei,China', 0),
(9, 'Lamba_neun', 'It is 20 watt', '2019-09-11', NULL, '2', 'England', 'neun.jpg', '1', 3, 5, 1, 'Nasser , Boulak', 0),
(10, 'Machine', 'It is very simple machine', '2019-09-12', NULL, '300', 'German', 'machine.jpg', '1', 3, 5, 1, 'German,machine', 0),
(11, 'Washing machine', 'It is suitable for houses', '2019-09-12', NULL, '700', 'German', 'wsh.jpg', '3', 3, 5, 1, 'German,washing', 0),
(12, 'Cell phone', 'It is made for houses', '2019-09-15', NULL, '50', 'Jaban', 'cell.jpg', '2', 11, 5, 1, 'discound', 0),
(16, 'apple', 'Good', '2019-10-26', NULL, '30', 'Jaban', 'apple.jpg', '1', 17, 1, 1, 'fruit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `truststatus` int(11) NOT NULL DEFAULT 0,
  `regstatus` int(11) NOT NULL DEFAULT 0,
  `groupid` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `fullname`, `email`, `truststatus`, `regstatus`, `groupid`, `date`, `avatar`, `image`) VALUES
(1, 'youssef', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', 'Youssef ayman', 'yassenyousef702@gmail.com', 0, 1, 1, '2001-03-19', '', 'youssef.jbg'),
(2, 'Treika', '1a9b9508b6003b68ddfe03a9c8cbc4bd4388339b', 'Abo trieka', 'treika@gmail.com', 0, 1, 0, '2019-09-06', '', 'treika.jpg'),
(3, 'messi', '8b05af0ef2eac32530836bcebd512f38e0beae64', 'Leo messi', 'messi@gmail.com', 0, 1, 0, '2019-09-06', '', 'messi.jpg'),
(5, 'drogba', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', 'didiah drogba\r\n', 'drogba11@gmail.com', 0, 1, 0, '2019-09-07', '', 'dro.jbg'),
(6, 'salah', '011c945f30ce2cbafc452f39840f025693339c42', 'Mohamed salah', 'Mosalah11@gmail.com', 0, 1, 0, '2019-09-08', '', 'salah.jpg'),
(11, 'Henery', '1966e694bad90686516f99cdf432800fdca39290', 'Terry henery', 'henery@gmail.com', 0, 1, 0, '2019-09-15', '', 'hene.jbg'),
(16, 'Navas', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Killor navas', 'navas@gmail.com', 0, 1, 0, '2019-09-23', '', 'navass.jbg'),
(17, 'mohazaa', '11904a4e8b77f6242e2d288705023adad00a9310', 'Mohamed hazaa', 'hazaa@gmail.com', 0, 1, 0, '2019-10-26', '', ''),
(18, 'hesham', '420df50a0a436cabe48e1597a9508a2b5449d35e', 'hesham', 'hh@gmil.com', 0, 1, 0, '2019-10-27', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `com` (`user_id`),
  ADD KEY `comm` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mem` (`member_id`),
  ADD KEY `cat` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `com` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comm` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mem` FOREIGN KEY (`member_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
