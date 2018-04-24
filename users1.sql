-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2018 at 01:36 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `user_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `user_f_name` text NOT NULL,
  `user_l_name` text NOT NULL,
  `user_email` text NOT NULL,
  `user_password` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_marital_status` text NOT NULL,
  `user_phone_no` text NOT NULL,
  `user_profession` text NOT NULL,
  `user_website` text NOT NULL,
  `user_address` text NOT NULL,
  `user_about_me` text NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`user_id`, `role`, `user_f_name`, `user_l_name`, `user_email`, `user_password`, `user_gender`, `user_marital_status`, `user_phone_no`, `user_profession`, `user_website`, `user_address`, `user_about_me`, `user_date`) VALUES
(12, 'Site Admin', 'Leslie', 'Tetteh', 'leslie.tetteh@gmail.com', 'landan', 'male', 'single', '02081234567', 'Web Developer', 'www.phys.org', 'My Road, My Heath, My City, UK', 'I am a graduate currently holding a Master’s degree in Biochemical Engineering (MEng). I am a member of British Mensa and have previously placed multiple times in the top 1000 students for the UK Mathematical Olympiad. I know several languages including via professional development courses such as C++, C, Java, HTML/CSS, PL/SQL, Excel/VBA, MATLAB, and PHP https://github.com/lestetedelioncourt. I have worked as a department head at an independent school, and taught for around 1 and a half years gaining invaluable experience in public speaking and planning, resource management, MS Powerpoint, MS Word. I am also proficient in the use of CRM databases from my time as a Business Developer, and have organized, funded and run my own events, including ticketing and flyers.', '2018-04-22 10:49:12'),
(13, 'Subscriber', 'Lab', 'Raider', 'labias@gmail.com', 'poontoon', 'male', 'single', '07858008618', '', '', '1 Dick Downs\r\nPlough Lane\r\n', '', '2018-04-22 10:48:52'),
(15, 'Admin', 'Another ', 'Admin', 'admin@gmail.com', 'nadnal', 'male', 'single', '02012345678', '', '', '44 Cashews Lane,\r\nDerry,\r\nIreland', '', '2018-04-22 12:13:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
