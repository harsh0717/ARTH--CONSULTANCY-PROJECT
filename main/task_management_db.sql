-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 06:40 AM
-- Server version: 8.0.39
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `assigned_to` int DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_to`, `due_date`, `status`, `created_at`) VALUES
(1, 'Task for shubh', 'you are the assign for the create graphic design for image', 2, NULL, 'completed', '2025-06-12 05:02:11'),
(6, 'Design Homepage Layout', 'Create a responsive and attractive homepage layout using HTML, CSS, and JavaScript.', 2, '2025-06-13', 'completed', '2025-06-12 10:20:27'),
(8, 'Create Employee Dashboard', 'Develop a dashboard to display employee-specific information such as assigned tasks and status.', 3, NULL, 'in_progress', '2025-06-12 10:21:19'),
(9, 'Implement Task Filter by Status', 'Add functionality to filter tasks by &quot;Pending&quot;, &quot;In Process&quot;, and &quot;Completed&quot;.', 3, '2025-06-13', 'completed', '2025-06-12 10:21:43'),
(10, 'Setup MySQL Database', 'Design and create the MySQL schema including tables for users, roles, tasks, and logs.', 3, '2025-06-13', 'pending', '2025-06-12 10:22:06'),
(18, 'test a', 'test', 4, '2025-06-16', 'completed', '2025-06-16 10:25:26');

--
-- Triggers `tasks`
--
DELIMITER $$
CREATE TRIGGER `before_insert_tasks` BEFORE INSERT ON `tasks` FOR EACH ROW BEGIN
  IF NEW.due_date IS NULL THEN
    SET NEW.due_date = CURDATE();
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dob` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `created_at`, `dob`, `email`, `phone`, `address`) VALUES
(1, 'Harsh', 'Admin', '$2y$10$LI.YcP/mFVwjdX.VPFGZWuz2EAs0E0dVVW4siN1UhKiIfsVfHkynC', 'admin', '2025-06-05 09:19:10', NULL, NULL, '', NULL),
(2, 'shubh soni', 'shubh', '$2y$10$thl7oRj3dVysgu7.4AVNmeuixAIa7MiuHXiwHmackblCu4H3IrkOC', 'employee', '2025-06-05 09:21:20', NULL, NULL, NULL, NULL),
(3, 'sneh bhalgamiya', 'sneh', '$2y$10$i547xNQxSo49oMlb3NhhRO2pDlPjnB7i6ey3v9RcXDwJ/4xQ6HbgO', 'employee', '2025-06-05 09:22:11', '2006-07-15', 'sneh@gmail.com', '1234567890', 'afrgfbtrsfxthbgfcnbhnf'),
(4, 'Rushabh Chauhan', 'rushabh', '$2y$10$R6fBEjBuHs86MasNniFcj.PfCH4rf8AFPF7XbHQzf3uxcUPXsRoOC', 'employee', '2025-06-13 03:51:55', NULL, NULL, NULL, NULL),
(5, 'Shivam T. Gohil', 'shivam', '$2y$10$anNP3dPuIu.94nEDtHnwJeYiDhvpGUXbBtzKAa5TBkTJ3NpsfpWEC', 'employee', '2025-06-16 12:00:05', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
