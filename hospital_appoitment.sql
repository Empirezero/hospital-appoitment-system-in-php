-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 09:41 PM
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
-- Database: `hospital_appoitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `phone`, `email`, `password`) VALUES
(2, 'vene', 717136695, 'vene@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `status` enum('pending','approved','cancelled') NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `appointment_date`, `appointment_time`, `doctor_id`, `patient_id`, `email`, `phone_no`, `specialization`, `status`, `message`) VALUES
(5, '2024-03-18', '22:58:00', 48, 1, 'rempire098@gmail.com', 717136695, 'Psychologist', 'approved', 'Emmergecy appoitment'),
(7, '2024-03-20', '11:44:00', 48, 1, 'vene@gmail.com', 717136695, 'Psychologist', 'pending', 'helllo'),
(8, '2024-04-01', '16:52:00', 50, 1, 'vene@gmail.com', 717136695, 'Psychologist', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `specialization_id` int(11) DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `specialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `first_name`, `last_name`, `email`, `phone`, `specialization_id`, `Status`, `password`, `address`, `image`, `date_joined`, `specialization`) VALUES
(48, 'Shaqtegan', 'ngugi', 'rempire098@gmail.com', '+2547689781122', NULL, 'Active', '81dc9bdb52d04dc20036dbd8313ed055', '169 Rocky River Dr fresno, CA 93730', 'images.jpeg', '2024-03-31 09:46:24', 'Psychologist'),
(50, 'dan', 'Ngugi', 'vene@gmail.com', '0717136695', NULL, 'Inactive', '81dc9bdb52d04dc20036dbd8313ed055', 'Rainbow resort lane', 'doctor-03.jpg', '2024-03-31 09:44:26', 'Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `patient_id` int(30) NOT NULL,
  `department` varchar(255) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `billing_address` text DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `other_information` text DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','partially paid','paid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `patient_id`, `department`, `tax`, `billing_address`, `invoice_date`, `due_date`, `other_information`, `item`, `description`, `unit_cost`, `qty`, `amount`, `message`, `created_at`, `status`) VALUES
(23, 1, 'Psychologist', '', 'hello', '2024-04-02', '2024-04-03', NULL, 'fever', 'fever', 250.00, 4, 1000.00, '', '2024-04-02 09:17:17', 'pending'),
(36, 1, '', '', 'Rainbow resort lane', '2024-04-07', '2024-04-09', NULL, 'pending', 'fever', 0.00, 208, 0.00, '1', '2024-04-07 12:33:36', 'paid'),
(37, 5, 'Psychologist', 'VAT', 'Rainbow resort lane', '2024-04-08', '2024-04-09', NULL, 'pending', 'fever', 233.00, 8, 1864.00, '', '2024-04-08 10:23:42', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `Address`, `date_of_birth`, `email`, `first_name`, `last_name`, `image`, `password`, `gender`, `phone`) VALUES
(1, 'komarock', '2024-03-08', 'vene@gmail.com', 'vene', 'ngugi', 'doctor-thumb-02.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 'female', '07171316695'),
(5, '', '2024-04-07', 'sharoncassy1@gmail.com1', 'Cassy', 'Sharon', '', '827ccb0eea8a706c4c34a16891f84e7b', 'female', '0717136695'),
(6, '', '2024-04-07', 'sharoncassy1666@gmail.com', '213133', '6666666666666', '', '827ccb0eea8a706c4c34a16891f84e7b', 'male', '0717136695');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `day_of_week` varchar(15) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `day_of_week`, `start_time`, `end_time`, `message`, `status`) VALUES
(18, 50, 'Friday', '10:25:00', '12:25:00', 'hello', 'Active'),
(19, 48, 'Tuesday', '10:08:00', '15:07:00', 'hello', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialization_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specialization_id`, `name`, `description`, `status`) VALUES
(12, 'Psychologist', '', 'Active'),
(13, 'Nurse', 'the best', 'Inactive'),
(14, 'surgeon', 'expert', 'Active'),
(15, 'neurologist', '', 'Active'),
(16, 'neuro sergeon', '', 'Active'),
(17, 'doctor', '', 'Active'),
(18, 'dentst', '', 'Active'),
(19, 'Nurse1', '', 'Active'),
(20, 'doctor1', '', 'Active'),
(21, 'doc', '', 'Active'),
(22, 'doc2', '', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_appointment_doctor_id` (`doctor_id`),
  ADD KEY `fk_appointment_patient_id` (`patient_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `specialization_id` (`specialization_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_appointment_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `fk_appointment_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`specialization_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
