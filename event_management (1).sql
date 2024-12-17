-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `username`, `title`, `description`, `date`, `category`, `location`) VALUES
(1, 'gsh', 'Tech Summit', 'The Tech Summit is a premier event that brings together technology enthusiasts, industry leaders, innovators, and thought leaders from various sectors to explore the latest trends and breakthroughs in technology. This dynamic event offers a platform for networking, knowledge-sharing, and collaboration, driving innovation across fields like artificial intelligence, blockchain, cloud computing, cybersecurity, data science, and more.\r\n\r\nWith keynote speeches from top industry experts, interactive workshops, panel discussions, and live demonstrations, the Tech Summit provides participants with valuable insights into emerging technologies and their real-world applications. Whether you\'re a tech professional, startup founder, student, or simply passionate about technology, this event equips you with cutting-edge knowledge and the inspiration to shape the future of tech.\r\n\r\nThe summit also offers opportunities for hands-on experiences, career development sessions, and a showcase of the latest technological solutions by leading companies and startups, making it an essential event for anyone looking to stay ahead in the rapidly evolving tech landscape.', '2024-10-27', 'Education', 'SCET'),
(2, 'jay_rangoon', 'TechFest 2024', 'Annual technology festival showcasing innovative projects and competitions.', '2024-10-27', 'Education', 'IIT Bombay, Mumbai'),
(3, 'jay_rangoon', 'Web Development Bootcamp', '3-day hands-on bootcamp covering HTML, CSS, JavaScript, and React.', '2024-10-25', 'Social', ' Virtual'),
(4, 'keshav', 'Music on the Beach', 'Live music performance by local indie bands on the beach.\r\n\r\n', '2024-10-30', 'Music', 'Juhu Beach, Mumbai'),
(5, 'keshav', 'EcoRun Marathon', 'Charity marathon aimed at raising awareness for environmental conservation.\r\n\r\n', '2024-10-31', 'Sports', 'Marine Drive, Mumbai'),
(6, 'muskan', 'Digital Marketing Summit', 'Industry experts share insights on the latest digital marketing trends and strategies.', '2024-10-28', 'Social', 'HICC, Hyderabad'),
(7, 'muskan', 'Film and Literature Fest', ' A festival celebrating the intersection of cinema and literature through screenings and panel discussions.', '2024-11-07', 'Other', 'Prithvi Theatre, Mumbai');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(100) NOT NULL,
  `eventid` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `attendees` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `eventid`, `title`, `hostname`, `attendees`) VALUES
(4, 1, 'Tech Summit', 'gsh', 'jay_rangoon'),
(5, 2, 'TechFest 2024', 'jay_rangoon', 'keshav'),
(6, 3, 'Web Development Bootcamp', 'jay_rangoon', 'keshav'),
(7, 1, 'Tech Summit', 'gsh', 'muskan'),
(8, 4, 'Music on the Beach', 'keshav', 'muskan'),
(9, 5, 'EcoRun Marathon', 'keshav', 'muskan'),
(10, 2, 'TechFest 2024', 'jay_rangoon', 'muskan'),
(12, 2, 'TechFest 2024', 'jay_rangoon', ''),
(13, 1, 'Tech Summit', 'gsh', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `email`, `password`) VALUES
(1, 'bhds', 'thrt@dsf', '202cb962ac59075b964b07152d234b70'),
(2, 'gsh', 'sdsd@ds', '202cb962ac59075b964b07152d234b70'),
(3, 'nas', 'thrt@dsf', '202cb962ac59075b964b07152d234b70'),
(4, 'muskan', 'muskan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'jay', 'jay@mail', '202cb962ac59075b964b07152d234b70'),
(6, 'ascc', 'cascac@sdgv', '152e5dfe57dc7075cc2b681ce2b0e5b6'),
(7, 'india', 'thrt@dsf', '827ccb0eea8a706c4c34a16891f84e7b'),
(8, 'jay_rangoon', 'jay@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(9, 'keshav', 'keshav@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
