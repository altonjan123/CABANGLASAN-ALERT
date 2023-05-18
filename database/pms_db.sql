-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 01:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(100) NOT NULL,
  `medicine_name` varchar(100) CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine_name`) VALUES
(1, 'Amoxixillin'),
(2, 'Antibiotic'),
(3, 'Antihistamine'),
(4, 'Atorvastatin'),
(5, 'Bioflu'),
(6, 'Biogesic'),
(7, 'Losartan'),
(8, 'Mefenamic'),
(9, 'Neozep');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_details`
--

CREATE TABLE `medicine_details` (
  `id` int(100) NOT NULL,
  `medicine_id` int(100) NOT NULL,
  `packing` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `Number_of_supply` int(100) NOT NULL,
  `release_medicine` int(100) NOT NULL,
  `Expiration` varchar(100) NOT NULL,
  `Manufacture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_details`
--

INSERT INTO `medicine_details` (`id`, `medicine_id`, `packing`, `Number_of_supply`, `release_medicine`, `Expiration`, `Manufacture`) VALUES
(1, 1, 'Tablet', 9870, 130, 'january 1 2030', 'ESTENZO'),
(2, 2, 'capsule', 9761, 239, 'january 1 2031', 'ROSE pharmacy'),
(3, 3, 'Tablet', 9995, 5, 'january 1 2030', 'ROJON PHARMACY');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_prenatal`
--

CREATE TABLE `new_prenatal` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `date_of_consultation` varchar(50) NOT NULL,
  `next_visit_date` varchar(50) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `age` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_prenatal_lpm`
--

CREATE TABLE `new_prenatal_lpm` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `age_of_gestation` varchar(50) NOT NULL,
  `number_of_prenatal_visit` varchar(50) NOT NULL,
  `medical_history` varchar(255) NOT NULL,
  `high_risk_pregnancy` varchar(50) NOT NULL,
  `services` varchar(50) NOT NULL,
  `blood_pressure` varchar(50) NOT NULL,
  `temperature` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `respiratory_rate` varchar(50) NOT NULL,
  `fundal_height` varchar(50) NOT NULL,
  `internal_examination` varchar(50) NOT NULL,
  `fundal_height2` varchar(50) NOT NULL,
  `leopolds_manuever` varchar(255) NOT NULL,
  `urinalysis_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_prenatal_obscore`
--

CREATE TABLE `new_prenatal_obscore` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `gravida` varchar(255) NOT NULL,
  `para` varchar(255) NOT NULL,
  `term` varchar(255) NOT NULL,
  `preterm` varchar(255) NOT NULL,
  `abortion` varchar(255) NOT NULL,
  `living` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_prenatal_ttvs`
--

CREATE TABLE `new_prenatal_ttvs` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `first_tt` varchar(50) NOT NULL,
  `sec_tt` varchar(50) NOT NULL,
  `third_tt` varchar(50) NOT NULL,
  `fourt_tt` varchar(50) NOT NULL,
  `fifth_tt` varchar(50) NOT NULL,
  `deworming_status` varchar(50) NOT NULL,
  `deworming_status2` varchar(50) NOT NULL,
  `date_given` varchar(50) NOT NULL,
  `vitamin_a_status` varchar(50) NOT NULL,
  `date_given2` varchar(50) NOT NULL,
  `calcium_supplement_status` varchar(50) NOT NULL,
  `date_given3` varchar(50) NOT NULL,
  `iron_supplemental_status` varchar(50) NOT NULL,
  `date_give4` varchar(50) NOT NULL,
  `folic_acid_supplemetal_status` varchar(50) NOT NULL,
  `date_given5` varchar(50) NOT NULL,
  `birth_plan` varchar(50) NOT NULL,
  `other_exammining_result` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(60) NOT NULL,
  `Purok` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `cnic` varchar(17) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `Purok`, `address`, `cnic`, `date_of_birth`, `phone_number`, `gender`) VALUES
(6, 'Oliveros, Altonjan, Alsa', 'PUROK 3', 'Poblacion', '1', '2001-01-09', '09451991333', 'Male'),
(7, 'Gumanod, Liezel', 'PUROK 3', 'Aglayan', '12345', '2023-02-07', '+63946074313', 'Female'),
(10, 'Rivera, Emlou', 'south', 'Maramag', '123456', '2023-02-14', '09050773097', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medication_history`
--

CREATE TABLE `patient_medication_history` (
  `id` int(11) NOT NULL,
  `patient_visit_id` int(11) NOT NULL,
  `medicine_details_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `dosage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_medication_history`
--

INSERT INTO `patient_medication_history` (`id`, `patient_visit_id`, `medicine_details_id`, `quantity`, `dosage`) VALUES
(44, 42, 1, 2, '50'),
(45, 43, 1, 2, '50'),
(46, 44, 1, 2, '50'),
(47, 45, 1, 5, '50'),
(48, 52, 1, 2, '50'),
(49, 61, 1, 86, '50'),
(50, 62, 1, 2, '50'),
(51, 62, 2, 5, '50'),
(52, 63, 2, 100, '50');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visits`
--

CREATE TABLE `patient_visits` (
  `id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `next_visit_date` date DEFAULT NULL,
  `bp` varchar(23) NOT NULL,
  `weight` varchar(12) NOT NULL,
  `disease` varchar(30) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_visits`
--

INSERT INTO `patient_visits` (`id`, `visit_date`, `next_visit_date`, `bp`, `weight`, `disease`, `patient_id`) VALUES
(102, '2023-05-08', '2023-05-16', '70/120', '80', 'Diarrhea', 7),
(103, '2023-05-08', '2023-06-12', '70/120', '80', 'Diarrhea', 6),
(104, '2023-05-08', '2023-05-15', '70/120', '80', 'skin cancer', 6),
(105, '2023-05-08', '2023-06-13', '120/80', '80', 'Diarrhea', 7),
(106, '2023-05-08', '2023-06-13', '70/120', '80', 'Diarrhea', 6),
(107, '2023-05-08', '2023-05-16', '70/120', '80', 'Diarrhea', 6),
(108, '2023-05-08', '2023-05-16', '70/120', '80', 'Diarrhea', 6),
(109, '2023-05-08', '2023-05-17', '70/120', '80', 'hangover', 6),
(110, '2023-05-09', '2023-06-14', '120/80', '80', 'fever', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `display_name`, `user_name`, `password`, `profile_picture`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', '1656551981avatar.png '),
(2, 'John Doe', 'jdoe', '9c86d448e84d4ba23eb089e0b5160207', '1656551999avatar_.png');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(250) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `date_of_vaccination` varchar(50) NOT NULL,
  `date_of_next_vaccination` varchar(50) NOT NULL,
  `type_of_vaccine` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `no_of_dose` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`id`, `patient_id`, `date_of_birth`, `age`, `date_of_vaccination`, `date_of_next_vaccination`, `type_of_vaccine`, `brand`, `no_of_dose`) VALUES
(44, 'Oliveros, Altonjan, Alsa', '2001-01-09', '22', '02/01/2023', '02/02/2023', 'covid', 'moderna ', '1'),
(45, 'Gumanod, Liezel', '2023-02-07', '21', '03/21/2023', '03/07/2023', 'sample', 'moderna 1', '1'),
(46, 'Oliveros, Altonjan, Alsa', '2001-01-09', '22', '04/28/2023', '04/30/2023', 'covid', 'sinovac', '50'),
(47, 'Oliveros, Altonjan, Alsa', '2001-01-09', '22', '04/29/2023', '04/30/2023', 'covid', 'moderna ', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicine_name` (`medicine_name`);

--
-- Indexes for table `medicine_details`
--
ALTER TABLE `medicine_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medicine_details_medicine_id` (`medicine_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_prenatal`
--
ALTER TABLE `new_prenatal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_prenatal_lpm`
--
ALTER TABLE `new_prenatal_lpm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_prenatal_obscore`
--
ALTER TABLE `new_prenatal_obscore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_prenatal_ttvs`
--
ALTER TABLE `new_prenatal_ttvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_medication_history`
--
ALTER TABLE `patient_medication_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_medication_history_patients_visits_id` (`patient_visit_id`),
  ADD KEY `fk_patient_medication_history_medicine_details_id` (`medicine_details_id`);

--
-- Indexes for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patients_visit_patient_id` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicine_details`
--
ALTER TABLE `medicine_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `new_prenatal`
--
ALTER TABLE `new_prenatal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `new_prenatal_lpm`
--
ALTER TABLE `new_prenatal_lpm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `new_prenatal_obscore`
--
ALTER TABLE `new_prenatal_obscore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `new_prenatal_ttvs`
--
ALTER TABLE `new_prenatal_ttvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_medication_history`
--
ALTER TABLE `patient_medication_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `patient_visits`
--
ALTER TABLE `patient_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD CONSTRAINT `fk_patients_visit_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
