-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: db:3306
-- Час створення: Бер 07 2026 р., 08:10
-- Версія сервера: 8.0.45
-- Версія PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `lab5`
--

-- --------------------------------------------------------

--
-- Структура таблиці `tov`
--

CREATE TABLE `tov` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `tov`
--

INSERT INTO `tov` (`id`, `name`, `price`, `quantity`, `category`) VALUES
(1, 'Laptop', 1200.00, 5, 'Electronics'),
(2, 'Smartphone', 800.00, 10, 'Electronics'),
(3, 'Headphones', 150.00, 20, 'Electronics'),
(4, 'Keyboard', 70.00, 15, 'Accessories'),
(5, 'Mouse', 40.00, 25, 'Accessories'),
(6, 'Monitor', 300.00, 7, 'Electronics'),
(7, 'USB Flash Drive', 20.00, 50, 'Storage'),
(8, 'External HDD', 120.00, 12, 'Storage'),
(9, 'Webcam', 90.00, 9, 'Accessories'),
(10, 'Microphone', 110.00, 6, 'Accessories');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `user_role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `surname`, `birth_date`, `phone`, `address`, `avatar_url`, `user_role`, `created_at`, `updated_at`) VALUES
(1, '11111', '$2y$10$5PjKBfRpfeT2kJp3XrvEn.9kwDr6zH9wd263/ombrhaUN/7CK7.Se', 'aaa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2026-03-06 20:20:52', '2026-03-06 20:20:52'),
(2, '123456', '$2y$10$N311EQmCeZ4VTmvnNJ7qqe4nMHo.tM5KDIYh1UeeyaKbSoh04CTrO', 'aaaaa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'user', '2026-03-06 20:25:58', '2026-03-06 20:25:58'),
(5, 'user1', '$2y$10$0N7U3cu5Se3GRWb7nu9G6uAc..dqGreBKnvbTesD4NFNJUIXQJC5K', 'user@gmail.com', '', '', NULL, '', '', NULL, 'user', '2026-03-06 20:57:01', '2026-03-06 20:57:11');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `tov`
--
ALTER TABLE `tov`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `tov`
--
ALTER TABLE `tov`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
