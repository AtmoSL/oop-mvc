-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2023 г., 20:09
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oop-mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(65) NOT NULL,
  `genre_id` int NOT NULL,
  `theater_id` int NOT NULL,
  `date` date NOT NULL,
  `is_published` tinyint(1) DEFAULT '1',
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `title`, `genre_id`, `theater_id`, `date`, `is_published`, `count`) VALUES
(3, 'Бешенные деньги', 1, 1, '2023-04-26', 1, 23),
(4, 'Без вины виноватые', 1, 1, '2023-04-13', 1, 42),
(5, 'Приговор любви', 2, 3, '2023-04-29', 1, 53),
(6, 'Мастер и Маргарита', 2, 2, '2023-04-12', 1, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `event_photos`
--

CREATE TABLE `event_photos` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `event_photos`
--

INSERT INTO `event_photos` (`id`, `event_id`, `photo`) VALUES
(1, 3, 'besh1.webp'),
(2, 3, 'besh2.webp'),
(3, 3, 'besh3.webp'),
(5, 4, '1.webp'),
(6, 4, '2.webp'),
(7, 4, '3.webp'),
(8, 5, 'prig1.webp'),
(9, 5, 'prig2.webp'),
(10, 5, 'prig3.webp'),
(11, 6, 'mim1.webp'),
(12, 6, 'mim2.webp'),
(13, 6, 'mim3.webp');

-- --------------------------------------------------------

--
-- Структура таблицы `event_rows`
--

CREATE TABLE `event_rows` (
  `id` int NOT NULL,
  `num` int NOT NULL,
  `event_id` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `event_rows`
--

INSERT INTO `event_rows` (`id`, `num`, `event_id`, `price`) VALUES
(1, 1, 3, 500),
(2, 2, 3, 300),
(3, 1, 4, 500),
(4, 2, 4, 300),
(5, 1, 5, 500),
(6, 2, 5, 300),
(7, 1, 6, 500),
(8, 2, 6, 300);

-- --------------------------------------------------------

--
-- Структура таблицы `event_seats`
--

CREATE TABLE `event_seats` (
  `id` int NOT NULL,
  `event_row_id` int NOT NULL,
  `num` int NOT NULL,
  `is_occupied` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `event_seats`
--

INSERT INTO `event_seats` (`id`, `event_row_id`, `num`, `is_occupied`) VALUES
(1, 1, 2, 0),
(2, 1, 3, 0),
(3, 1, 4, 0),
(4, 1, 5, 0),
(5, 1, 6, 0),
(6, 1, 7, 0),
(7, 1, 8, 0),
(8, 1, 9, 0),
(9, 1, 10, 0),
(10, 2, 1, 0),
(11, 2, 2, 0),
(12, 2, 3, 0),
(13, 2, 4, 1),
(14, 2, 5, 0),
(15, 2, 6, 0),
(16, 2, 7, 1),
(17, 2, 8, 1),
(18, 2, 9, 0),
(19, 3, 2, 0),
(20, 3, 3, 0),
(21, 3, 4, 0),
(22, 3, 5, 0),
(23, 3, 6, 0),
(24, 3, 7, 0),
(25, 3, 8, 0),
(26, 3, 9, 0),
(27, 3, 10, 0),
(28, 3, 1, 0),
(29, 4, 2, 0),
(30, 4, 3, 0),
(31, 4, 4, 0),
(32, 4, 5, 0),
(33, 4, 6, 0),
(34, 4, 7, 0),
(35, 4, 8, 0),
(36, 4, 9, 0),
(37, 4, 10, 0),
(38, 4, 1, 0),
(39, 5, 2, 0),
(40, 5, 3, 0),
(41, 5, 4, 0),
(42, 5, 5, 0),
(43, 5, 6, 0),
(44, 5, 7, 0),
(45, 5, 8, 0),
(46, 5, 9, 0),
(47, 5, 10, 0),
(48, 5, 1, 0),
(49, 6, 2, 0),
(50, 6, 3, 0),
(51, 6, 4, 0),
(52, 6, 5, 0),
(53, 6, 6, 0),
(54, 6, 7, 0),
(55, 6, 8, 0),
(56, 6, 9, 0),
(57, 6, 10, 0),
(58, 6, 1, 0),
(59, 7, 2, 0),
(60, 7, 3, 0),
(61, 7, 4, 0),
(62, 7, 5, 0),
(63, 7, 6, 0),
(64, 7, 7, 0),
(65, 7, 8, 0),
(66, 7, 9, 0),
(67, 7, 10, 0),
(68, 7, 1, 0),
(69, 8, 2, 0),
(70, 8, 3, 0),
(71, 8, 4, 0),
(72, 8, 5, 0),
(73, 8, 6, 0),
(74, 8, 7, 0),
(75, 8, 8, 0),
(76, 8, 9, 0),
(77, 8, 10, 0),
(78, 8, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `title`) VALUES
(0, 'Без жанра'),
(1, 'Комедия'),
(2, 'Мюзикл');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `total_price` int NOT NULL,
  `order_status_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `event_id`, `total_price`, `order_status_id`) VALUES
(21, 16, 3, 2600, 3),
(22, 16, 3, 2600, 3),
(23, 16, 3, 2600, 2),
(24, 16, 3, 1500, 3),
(25, 16, 3, 1500, 1),
(26, 16, 3, 1500, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_seats`
--

CREATE TABLE `order_seats` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `event_seat_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_seats`
--

INSERT INTO `order_seats` (`id`, `order_id`, `event_seat_id`) VALUES
(5, 21, 1),
(6, 21, 4),
(7, 21, 5),
(8, 21, 7),
(9, 21, 12),
(10, 21, 18),
(11, 22, 1),
(12, 22, 4),
(13, 22, 5),
(14, 22, 7),
(15, 22, 12),
(16, 22, 18),
(17, 23, 1),
(18, 23, 4),
(19, 23, 5),
(20, 23, 7),
(21, 23, 12),
(22, 23, 18),
(23, 24, 1),
(24, 24, 2),
(25, 24, 3),
(26, 25, 1),
(27, 25, 2),
(28, 25, 3),
(29, 26, 1),
(30, 26, 2),
(31, 26, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `title`) VALUES
(1, 'Новый'),
(2, 'Подтверждён'),
(3, 'Отменён');

-- --------------------------------------------------------

--
-- Структура таблицы `theaters`
--

CREATE TABLE `theaters` (
  `id` int NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `theaters`
--

INSERT INTO `theaters` (`id`, `title`) VALUES
(1, 'Театр комедии им. Акимова'),
(2, 'ЛДМ. Новая-новая сцена'),
(3, 'Алеко');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role_id` int NOT NULL DEFAULT '1',
  `date_of_registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role_id`, `date_of_registration`, `email`) VALUES
(16, 'Админ Админович', 'f5bb0c8de146c67b44babbf4e6584cc0', 2, '2023-05-15 15:54:55', 'admin@admin.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_roles`
--

INSERT INTO `user_roles` (`id`, `title`) VALUES
(1, 'Пользователь'),
(2, 'Администратор'),
(3, 'Супер-администратор');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event_photos`
--
ALTER TABLE `event_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Индексы таблицы `event_rows`
--
ALTER TABLE `event_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Индексы таблицы `event_seats`
--
ALTER TABLE `event_seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_row_id` (`event_row_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`order_status_id`);

--
-- Индексы таблицы `order_seats`
--
ALTER TABLE `order_seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_seat_id` (`event_seat_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `event_photos`
--
ALTER TABLE `event_photos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `event_rows`
--
ALTER TABLE `event_rows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `event_seats`
--
ALTER TABLE `event_seats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `order_seats`
--
ALTER TABLE `order_seats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event_photos`
--
ALTER TABLE `event_photos`
  ADD CONSTRAINT `event_photos_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `event_rows`
--
ALTER TABLE `event_rows`
  ADD CONSTRAINT `event_rows_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `event_seats`
--
ALTER TABLE `event_seats`
  ADD CONSTRAINT `event_seats_ibfk_1` FOREIGN KEY (`event_row_id`) REFERENCES `event_rows` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `order_seats`
--
ALTER TABLE `order_seats`
  ADD CONSTRAINT `order_seats_ibfk_1` FOREIGN KEY (`event_seat_id`) REFERENCES `event_seats` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_seats_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
