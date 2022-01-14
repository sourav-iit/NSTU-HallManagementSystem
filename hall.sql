-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 03:33 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_activeteachers`
--

CREATE TABLE `tbl_activeteachers` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_activeteachers`
--

INSERT INTO `tbl_activeteachers` (`id`, `name`, `time`, `phone`) VALUES
(19, 'Dipok chandra das', '2021-10-04 15:12:28', '01766753645'),
(20, 'asif sir', '2021-10-04 15:13:45', '983892743'),
(21, 'Dipok chandra das', '2021-10-05 06:02:57', '01766753645'),
(22, 'Dipok chandra das', '2021-10-10 07:43:49', '01766753645');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `id` int(11) NOT NULL,
  `university_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `is_accept` int(10) DEFAULT NULL,
  `room_id` int(10) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`id`, `university_id`, `name`, `email`, `faculty`, `phone`, `address`, `session`, `reason`, `is_accept`, `room_id`, `time`) VALUES
(8, 'ASH1825001M', 'kamruzzaman shekh', 'shekhnstuiit@gmail.com', 'ESDM', '9076544254', 'shahrasti', '2018-19', 'emergency needed ', 0, 77, '2021-10-10 05:39:01'),
(9, 'ASH1825001M', 'hi', 'test@gmail.com', 'SE', '9076544254', 'shahrasti', '2017-18', '......want it....', 0, 76, '2021-10-10 05:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daymeal`
--

CREATE TABLE `tbl_daymeal` (
  `id` int(11) NOT NULL,
  `lunch` text NOT NULL,
  `dinner` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daymeal`
--

INSERT INTO `tbl_daymeal` (`id`, `lunch`, `dinner`, `time`) VALUES
(48, 'murgi', '', '2021-10-03 09:52:20'),
(49, 'Golden Fish', '', '2021-10-03 09:59:26'),
(50, 'Hot Tea', '', '2021-10-03 09:59:30'),
(51, '', 'Hot Tea', '2021-10-03 09:59:34'),
(52, '', 'murgi', '2021-10-03 09:59:40'),
(53, 'Hot Tea', '', '2021-10-03 19:06:45'),
(54, '', 'murgi', '2021-10-04 08:31:27'),
(55, 'Golden Fish', '', '2021-10-04 09:12:11'),
(57, 'begun baja', '', '2021-10-04 09:52:50'),
(58, '', 'Golden Fish', '2021-10-04 14:09:16'),
(59, '', 'begun baja', '2021-10-04 14:12:23'),
(60, 'dal', '', '2021-10-04 14:13:16'),
(61, '', 'dal', '2021-10-04 14:13:29'),
(62, '', 'Rice', '2021-10-04 14:25:42'),
(65, '', 'begun baja', '2021-10-05 06:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE `tbl_doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialist` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_doctors`
--

INSERT INTO `tbl_doctors` (`id`, `name`, `email`, `specialist`, `phone`, `image`) VALUES
(1, 'dr. kamruzzaman', 'doctor@gmail.com', 'prediatric', '01882895332', '.png'),
(4, 'dr. azad hossain', 'azad@gmail.com', 'prediatric', '01882895332', ''),
(6, 'dr. rafia jannat', 'rafia@gmail.com', 'medicine', '01882895332', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `job`, `address`, `phone`, `image`) VALUES
(3, 'Nupur', ' Hall Cleaner', 'Dumki', 2147483647, '3.jpg'),
(4, 'Rabeya', 'Cook Manager', 'Dumki', 54356567, '4.jpg'),
(6, ' Shamol Das', 'guard', 'Dumki', 1510002231, '6.jpg'),
(7, 'Morsheda Islam', 'Cooker', 'Dumki', 2147483647, '7.jpg'),
(8, 'Shirin jahan', 'Dining Manager', 'Patuakhali', 54356567, '8.jpg'),
(9, 'Sathi', 'Cooker', 'Dumki', 2147483647, '9.jpg'),
(10, 'shekh', 'cook', 'shahrasti', 2147483647, '10.jpg'),
(11, 'azad', 'cooker', 'noakhali', 1726765, '11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foods`
--

CREATE TABLE `tbl_foods` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_foods`
--

INSERT INTO `tbl_foods` (`id`, `name`, `price`) VALUES
(8, 'murgi', 40),
(9, 'Rice', 8),
(10, 'Hot Tea', 8),
(11, 'Golden Fish', 70),
(13, 'begun baja', 10),
(14, 'dal', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `email`, `password`) VALUES
(3, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_managerlogin`
--

CREATE TABLE `tbl_managerlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_managerlogin`
--

INSERT INTO `tbl_managerlogin` (`id`, `email`, `password`) VALUES
(1, 'manager@gmail.com', 'manager'),
(3, 's96mini.cube@gmail.com', 'abrar'),
(4, 's69mini.cube@gmail.com', 'abrar'),
(5, 'shekh@gmail.com', 'manager'),
(6, 'dining@gmail.com', 'dining');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_managers`
--

CREATE TABLE `tbl_managers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_managers`
--

INSERT INTO `tbl_managers` (`id`, `name`, `email`, `phone_no`) VALUES
(3, 'Abrar Hossain', 's69mini.cube@gmail.com', '01882656454'),
(4, 'kamruzzaman', 'shekh@gmail.com', '01882895332'),
(5, 'dining manager', 'dining@gmail.com', '017654343');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notices`
--

CREATE TABLE `tbl_notices` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notices`
--

INSERT INTO `tbl_notices` (`id`, `title`, `description`, `time`) VALUES
(8, 'hellow', '<p><u><em>hey</em></u></p>\r\n', '2021-09-28 18:12:53'),
(9, 'off', '<p>mnjbdfhvfh</p>\r\n', '2021-09-29 15:56:08'),
(12, 'party new', '<p>parttttyyyyyyyy</p>\r\n', '2021-10-04 09:56:13'),
(13, ' SPL2  presentaion', '<p>Today is SPL2 Final presentaion.</p>\r\n', '2021-10-05 06:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `registration_no` int(11) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `is_verified` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_problems`
--

CREATE TABLE `tbl_problems` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `st_id` text NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `is_solved` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_problems`
--

INSERT INTO `tbl_problems` (`id`, `description`, `st_id`, `name`, `is_solved`) VALUES
(21, 'i havemore problem', '109', 'new azad', 1),
(22, 'i havemore problem', '109', 'new azad', 1),
(25, 'sourav created problem', '110', 'sourav', 1),
(27, 'sourav created problem', '110', 'sourav', 1),
(29, 'nooo solution', '110', 'ohhh', 1),
(31, 'dining management so bad', '109', 'azad', 1),
(36, 'need more doctor', '109', 'kamruzzaman shekh', 1),
(37, 'bad broken', '119', 'Azad  Hossain', 1),
(39, 'bistir pani pore', '119', 'Azad  Hossain', 1),
(41, 'I am from faysal room', '120', 'faysal ahamed', 1),
(42, '..........ROOM-308......', '132', 'kamruzzaman shekh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `block` varchar(10) NOT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id`, `name`, `block`, `size`) VALUES
(76, '500', 'A', 15),
(77, '3seat_Room', 'A', 3),
(79, 'Bad Boy', 'A', 3),
(82, 'hellow group', 'A', 3),
(83, 'Good Boys', 'B', 5),
(84, '300', 'A', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `university_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `faculty` varchar(100) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `university_id`, `name`, `email`, `faculty`, `phone_no`, `address`, `room_id`, `session`) VALUES
(132, 'ASH1825035M', 'kamruzzaman shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 77, '2017-18'),
(133, 'ASH1825005M', 'Abrar Hossain', 's96mini.cube@gmail.com', 'AMATH', '01657508443', 'chittagong', 83, '2018-19'),
(134, 'ASH1825005M', 'Abrar Hossain', 's96mini.cube@gmail.com', 'AMATH', '01657508443', 'chittagong', 83, '2018-19'),
(135, 'ASH1825031M', 'saifur rahman', 'saifur@gmail.com', 'ACCE', '01767564544', 'Feni', 83, '2019-2020'),
(136, 'ASH1825001M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(137, 'ASH1825001M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(138, 'ASH1825001M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(139, 'ASH1825001M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(140, 'ASH1825001M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(141, 'ASH1825009M', 'arif arif', 'azad@gmail.com', 'AMATH', '9076544254', 'shahrasti', 83, '2014-2015'),
(142, 'ASH1825009M', 'arif arif', 'azad@gmail.com', 'AMATH', '9076544254', 'shahrasti', 83, '2014-2015'),
(143, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(144, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(145, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(146, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(147, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(148, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(149, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(150, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(151, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015'),
(152, 'ASH1825014M', 'shekh shekh', 'shekhnstuiit@gmail.com', 'SE', '9076544254', 'shahrasti', 76, '2014-2015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentlogin`
--

CREATE TABLE `tbl_studentlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_studentlogin`
--

INSERT INTO `tbl_studentlogin` (`id`, `email`, `password`) VALUES
(27, 'shekhnstuiit@gmail.com', 'shekh'),
(28, 's96mini.cube@gmail.com', 'asif'),
(29, 's96mini.cube@gmail.com', 'asif'),
(30, 'saifur@gmail.com', 'saifur'),
(31, 'shekhnstuiit@gmail.com', '12345'),
(32, 'shekhnstuiit@gmail.com', '12345'),
(33, 'shekhnstuiit@gmail.com', '12345'),
(34, 'shekhnstuiit@gmail.com', '12345'),
(35, 'shekhnstuiit@gmail.com', '12345'),
(36, 'azad@gmail.com', '12345'),
(37, 'azad@gmail.com', '12345'),
(38, 'shekhnstuiit@gmail.com', '123456'),
(39, 'shekhnstuiit@gmail.com', '123456'),
(40, 'shekhnstuiit@gmail.com', '123456'),
(41, 'shekhnstuiit@gmail.com', '123456'),
(42, 'shekhnstuiit@gmail.com', '123456'),
(43, 'shekhnstuiit@gmail.com', '123456'),
(44, 'shekhnstuiit@gmail.com', '123456'),
(45, 'shekhnstuiit@gmail.com', '123456'),
(46, 'shekhnstuiit@gmail.com', '123456'),
(47, 'shekhnstuiit@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE `tbl_teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `work` varchar(100) NOT NULL,
  `phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`id`, `name`, `email`, `work`, `phone`) VALUES
(3, 'kamruzzaman', 'shekhnstuiit@gmail.com', 'iit', '01882895332'),
(4, 'Dipok chandra das', 'dipoksiriit@gmail.com', 'SE', '01766753645'),
(5, 'asif sir', 's69mini.cube@gmail.com', 'CSTE', '983892743');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activeteachers`
--
ALTER TABLE `tbl_activeteachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_daymeal`
--
ALTER TABLE `tbl_daymeal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_managerlogin`
--
ALTER TABLE `tbl_managerlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_managers`
--
ALTER TABLE `tbl_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notices`
--
ALTER TABLE `tbl_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_problems`
--
ALTER TABLE `tbl_problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_studentlogin`
--
ALTER TABLE `tbl_studentlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activeteachers`
--
ALTER TABLE `tbl_activeteachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_daymeal`
--
ALTER TABLE `tbl_daymeal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_foods`
--
ALTER TABLE `tbl_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_managerlogin`
--
ALTER TABLE `tbl_managerlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_managers`
--
ALTER TABLE `tbl_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notices`
--
ALTER TABLE `tbl_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_problems`
--
ALTER TABLE `tbl_problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `tbl_studentlogin`
--
ALTER TABLE `tbl_studentlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_teachers`
--
ALTER TABLE `tbl_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
