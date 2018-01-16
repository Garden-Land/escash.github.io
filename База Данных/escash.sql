-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2017 г., 16:52
-- Версия сервера: 5.7.16
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `escash`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(255) NOT NULL,
  `total_given` int(255) NOT NULL DEFAULT '0',
  `type` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL,
  `items` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `cases`
--

INSERT INTO `cases` (`id`, `name`, `price`, `total_given`, `type`, `img`, `items`, `created_at`, `updated_at`) VALUES
(1, 'Кейс №1', 20, 199, 'corp', '/assets/uploads/50.png', '[\"11\",\"10\",\"9\",\"7\",\"6\",\"5\",\"4\",\"3\",\"2\",\"1\"]', '2017-04-26 15:05:50', '2017-04-30 07:28:30'),
(2, 'Кейс №2', 50, 295, 'gold', '/assets/uploads/100.png', '[\"16\",\"15\",\"14\",\"13\",\"12\",\"11\",\"9\",\"7\",\"5\",\"4\",\"3\"]', '2017-04-26 16:39:56', '2017-04-26 16:42:58'),
(3, 'Кейс №3', 70, 480, 'gold', '/assets/uploads/250.png', '[\"18\",\"17\",\"16\",\"15\",\"14\",\"13\",\"12\",\"11\",\"9\",\"7\",\"5\"]', '2017-04-26 16:43:59', '2017-04-26 16:46:16'),
(4, 'Кейс №4', 99, 1540, 'blue', '/assets/uploads/500.png', '[\"39\",\"22\",\"21\",\"20\",\"19\",\"18\",\"17\",\"16\",\"15\",\"14\",\"13\",\"12\",\"11\",\"9\",\"7\"]', '2017-04-26 16:47:33', '2017-04-26 16:51:42'),
(5, 'Кейс №5', 240, 2350, 'gold', '/assets/uploads/1000.png', '[\"39\",\"27\",\"26\",\"25\",\"24\",\"23\",\"22\",\"21\",\"20\",\"19\",\"18\",\"17\",\"16\",\"11\"]', '2017-04-26 16:55:41', '2017-04-26 16:58:42'),
(6, 'Кейс №6', 399, 540, 'yellow', '/assets/uploads/1500.png', '[\"39\",\"28\",\"27\",\"26\",\"25\",\"24\",\"23\",\"22\",\"21\",\"20\",\"19\",\"18\",\"17\",\"16\",\"13\"]', '2017-04-26 17:00:08', '2017-04-26 17:00:45'),
(7, 'Кейс №7', 499, 1150, 'yellow', '/assets/uploads/2500.png', '[\"39\",\"30\",\"29\",\"28\",\"27\",\"24\",\"23\",\"22\",\"21\",\"19\",\"18\",\"17\",\"16\"]', '2017-04-26 17:02:04', '2017-04-26 17:04:51'),
(8, 'Кейс №8', 799, 700, 'yellow', '/assets/uploads/3500.png', '[\"39\",\"32\",\"31\",\"30\",\"29\",\"28\",\"27\",\"25\",\"24\",\"23\",\"22\",\"21\",\"20\",\"19\",\"18\",\"17\"]', '2017-04-26 17:06:37', '2017-04-26 17:07:31'),
(9, 'Кейс №9', 1499, 500, 'yellow', '/assets/uploads/6000.png', '[\"35\",\"34\",\"33\",\"31\",\"30\",\"28\",\"27\",\"24\",\"22\",\"21\",\"19\"]', '2017-04-26 17:08:46', '2017-04-26 17:09:54'),
(10, 'Кейс №10', 2999, 2000, 'red', '/assets/uploads/10000.png', '[\"36\",\"34\",\"30\",\"27\",\"26\",\"25\",\"24\",\"23\",\"22\"]', '2017-04-26 17:10:53', '2017-04-26 17:11:18'),
(11, 'Кейс №11', 6999, 13000, 'red', '/assets/uploads/20000.png', '[\"41\",\"40\",\"38\",\"37\",\"36\",\"35\",\"34\",\"33\",\"31\",\"29\",\"27\"]', '2017-04-26 17:14:36', '2017-04-26 17:15:31');

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `namesite` varchar(256) NOT NULL,
  `ref_sum` int(255) NOT NULL,
  `min_withdraw` int(255) NOT NULL,
  `min_box_withdraw` int(255) NOT NULL,
  `shop_id_paytrio` int(255) NOT NULL,
  `secret_word_paytrio` varchar(256) NOT NULL,
  `payment` varchar(256) NOT NULL,
  `shop_id_freekassa` int(255) NOT NULL,
  `secret_word_freekassa` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`id`, `namesite`, `ref_sum`, `min_withdraw`, `min_box_withdraw`, `shop_id_paytrio`, `secret_word_paytrio`, `payment`, `shop_id_freekassa`, `secret_word_freekassa`, `created_at`, `updated_at`) VALUES
(1, 'escash', 50, 100, 10, 123124, 'TopSecret', 'pay-trio', 123145125, 'TopSecretWord', '2017-04-23 21:00:00', '2017-04-24 22:29:31');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `sell_price` int(255) NOT NULL,
  `type` varchar(256) NOT NULL,
  `img` text NOT NULL,
  `chance` int(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `sell_price`, `type`, `img`, `chance`, `created_at`, `updated_at`) VALUES
(1, 1, 'gray', '/assets/uploads/1.png', 100, '2017-04-26 15:05:31', '2017-04-26 15:07:49'),
(2, 5, 'gray', '/assets/uploads/5.png', 95, '2017-04-26 15:33:18', '2017-04-26 15:33:18'),
(3, 10, 'gray', '/assets/uploads/10.png', 80, '2017-04-26 15:50:42', '2017-04-26 15:50:42'),
(4, 15, 'gray', '/assets/uploads/15.png', 60, '2017-04-26 15:50:55', '2017-04-26 15:50:55'),
(5, 20, 'gray', '/assets/uploads/20.png', 50, '2017-04-26 15:51:02', '2017-04-26 15:51:02'),
(6, 25, 'gray', '/assets/uploads/25.png', 40, '2017-04-26 15:51:10', '2017-04-26 15:51:10'),
(7, 30, 'gray', '/assets/uploads/30.png', 30, '2017-04-26 15:51:24', '2017-04-26 15:51:24'),
(8, 35, 'gray', '/assets/uploads/35.png', 25, '2017-04-26 15:52:16', '2017-04-26 15:52:16'),
(9, 40, 'gray', '/assets/uploads/40.png', 20, '2017-04-26 15:52:31', '2017-04-26 15:52:31'),
(10, 45, 'gray', '/assets/uploads/45.png', 15, '2017-04-26 15:53:17', '2017-04-26 15:53:17'),
(11, 50, 'corp', '/assets/uploads/50.png', 10, '2017-04-26 15:53:33', '2017-04-26 15:53:33'),
(12, 60, 'corp', '/assets/uploads/60.png', 50, '2017-04-26 15:54:23', '2017-04-26 15:54:23'),
(13, 70, 'corp', '/assets/uploads/70.png', 40, '2017-04-26 15:54:54', '2017-04-26 15:54:54'),
(14, 80, 'corp', '/assets/uploads/80.png', 30, '2017-04-26 15:55:09', '2017-04-26 15:55:09'),
(15, 90, 'corp', '/assets/uploads/90.png', 20, '2017-04-26 15:55:28', '2017-04-26 15:55:28'),
(16, 100, 'gold', '/assets/uploads/100.png', 10, '2017-04-26 15:55:44', '2017-04-26 15:55:44'),
(17, 150, 'gold', '/assets/uploads/150.png', 20, '2017-04-26 15:56:00', '2017-04-26 15:56:00'),
(18, 250, 'gold', '/assets/uploads/250.png', 10, '2017-04-26 15:56:09', '2017-04-26 15:56:09'),
(19, 300, 'gold', '/assets/uploads/300.png', 15, '2017-04-26 15:56:32', '2017-04-26 15:56:32'),
(20, 350, 'gold', '/assets/uploads/350.png', 10, '2017-04-26 15:57:21', '2017-04-26 15:57:21'),
(21, 400, 'gold', '/assets/uploads/400.png', 5, '2017-04-26 15:57:32', '2017-04-26 15:57:32'),
(22, 500, 'blue', '/assets/uploads/500.png', 2, '2017-04-26 15:57:39', '2017-04-26 15:57:39'),
(23, 600, 'blue', '/assets/uploads/600.png', 5, '2017-04-26 15:58:11', '2017-04-26 15:58:11'),
(24, 700, 'blue', '/assets/uploads/700.png', 3, '2017-04-26 15:58:19', '2017-04-26 15:58:19'),
(25, 800, 'blue', '/assets/uploads/800.png', 2, '2017-04-26 15:58:25', '2017-04-26 15:58:25'),
(26, 900, 'blue', '/assets/uploads/900.png', 2, '2017-04-26 15:58:53', '2017-04-26 15:58:53'),
(27, 1000, 'yellow', '/assets/uploads/1000.png', 1, '2017-04-26 15:59:08', '2017-04-26 15:59:08'),
(28, 1500, 'yellow', '/assets/uploads/1500.png', 1, '2017-04-26 15:59:27', '2017-04-26 15:59:27'),
(29, 2000, 'yellow', '/assets/uploads/2000.png', 1, '2017-04-26 15:59:42', '2017-04-26 15:59:42'),
(30, 2500, 'yellow', '/assets/uploads/2500.png', 1, '2017-04-26 15:59:56', '2017-04-26 15:59:56'),
(31, 3000, 'yellow', '/assets/uploads/3000.png', 1, '2017-04-26 16:00:10', '2017-04-26 16:00:10'),
(32, 3500, 'yellow', '/assets/uploads/3500.png', 1, '2017-04-26 16:00:26', '2017-04-26 16:00:26'),
(33, 4000, 'yellow', '/assets/uploads/4000.png', 1, '2017-04-26 16:00:44', '2017-04-26 16:00:44'),
(34, 5000, 'yellow', '/assets/uploads/5000.png', 1, '2017-04-26 16:01:01', '2017-04-26 16:01:01'),
(35, 6000, 'yellow', '/assets/uploads/6000.png', 1, '2017-04-26 16:01:08', '2017-04-26 17:09:51'),
(36, 10000, 'red', '/assets/uploads/10000.png', 1, '2017-04-26 16:01:29', '2017-04-26 16:01:29'),
(37, 15000, 'red', '/assets/uploads/15000.png', 1, '2017-04-26 16:01:43', '2017-04-26 16:01:43'),
(38, 20000, 'red', '/assets/uploads/20000.png', 1, '2017-04-26 16:01:53', '2017-04-26 16:01:53'),
(39, 200, 'gold', '/assets/uploads/200.png', 5, '2017-04-26 16:47:47', '2017-04-26 16:47:47'),
(40, 7000, 'yellow', '/assets/uploads/7000.png', 1, '2017-04-26 17:12:40', '2017-04-26 17:12:40'),
(41, 9000, 'yellow', '/assets/uploads/9000.png', 1, '2017-04-26 17:13:21', '2017-04-26 17:13:21');

-- --------------------------------------------------------

--
-- Структура таблицы `live_drop`
--

CREATE TABLE `live_drop` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `item_id` varchar(256) NOT NULL,
  `case_id` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `avatar` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `balance` int(255) NOT NULL DEFAULT '0',
  `affiliate_code` varchar(256) DEFAULT NULL,
  `affiliate_use` varchar(256) DEFAULT NULL,
  `affiliate_profit` int(255) NOT NULL DEFAULT '0',
  `open_box` int(255) NOT NULL DEFAULT '0',
  `open_sum` int(255) NOT NULL DEFAULT '0',
  `role` varchar(256) NOT NULL DEFAULT 'user',
  `remember_token` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `payway` varchar(256) NOT NULL,
  `amount` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `live_drop`
--
ALTER TABLE `live_drop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT для таблицы `live_drop`
--
ALTER TABLE `live_drop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
