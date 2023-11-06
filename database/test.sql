-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Nov 06, 2023 at 01:34 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamp_docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `title`, `content`, `date`) VALUES
(1, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris congue mauris vel turpis tempus pulvinar. Aliquam ac lacus sed diam malesuada sagittis non scelerisque quam. Praesent nulla orci, fringilla sed pulvinar vel, mollis vitae felis. Morbi tempus vulputate semper. Nullam ornare accumsan rutrum. Nullam eget ante tempus dui elementum placerat quis eu est.', '2023-11-02'),
(2, 'Fusce auctor quis', 'Fusce auctor quis sem nec porta. Aliquam consequat facilisis ligula, ut consequat mauris ultrices sagittis. Duis at tristique metus. Vivamus vel vulputate orci, non dignissim mauris. Sed risus libero, sollicitudin ut ante non, mattis vehicula nulla. Vestibulum scelerisque pellentesque tristique. Suspendisse ac quam massa. Nullam quis pretium arcu. Nullam feugiat neque et nibh vestibulum hendrerit.', '2023-11-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
