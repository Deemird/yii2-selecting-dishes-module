-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 09 2017 г., 23:21
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_selecting_dishes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `dish`
--

INSERT INTO `dish` (`id`, `name`) VALUES
(3, 'Салат \"Бунито\"'),
(1, 'Салат \"Вдохновение\"'),
(2, 'Салат \"Купеческий\"'),
(6, 'Салат \"Мимоза\"'),
(5, 'Салат \"Раковые шейки\"'),
(4, 'Салат \"Сельдь под шубой\"');

-- --------------------------------------------------------

--
-- Структура таблицы `dish_ingredient`
--

CREATE TABLE `dish_ingredient` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dish_ingredient`
--

INSERT INTO `dish_ingredient` (`id`, `dish_id`, `ingredient_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 1, 7),
(6, 1, 10),
(7, 2, 2),
(8, 2, 7),
(9, 2, 8),
(10, 2, 9),
(11, 2, 11),
(12, 2, 12),
(13, 2, 13),
(14, 2, 14),
(15, 3, 3),
(16, 3, 10),
(17, 3, 15),
(18, 3, 17),
(19, 3, 19),
(20, 3, 20),
(21, 3, 21),
(22, 4, 3),
(23, 4, 9),
(24, 4, 12),
(25, 4, 19),
(26, 4, 22),
(27, 4, 23),
(28, 4, 24),
(29, 4, 25),
(30, 5, 7),
(31, 5, 12),
(32, 5, 16),
(33, 5, 26),
(34, 6, 2),
(35, 6, 3),
(36, 6, 5),
(37, 6, 7),
(38, 6, 12),
(39, 6, 18),
(40, 6, 27);

-- --------------------------------------------------------

--
-- Структура таблицы `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name_ingredient` varchar(75) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ingredient`
--

INSERT INTO `ingredient` (`id`, `name_ingredient`, `status`) VALUES
(1, 'Копченая говядина', 1),
(2, 'Соль', 1),
(3, 'Яйца', 1),
(4, 'Помидора', 1),
(5, 'Лук (зелень)', 1),
(6, 'Чеснок', 1),
(7, 'Майонез', 1),
(8, 'Свинина', 1),
(9, 'Лук (репка)', 1),
(10, 'Сыр', 1),
(11, 'Сахар', 1),
(12, 'Морковь', 1),
(13, 'Уксус', 1),
(14, 'Перец', 1),
(15, 'Филе куриное', 1),
(16, 'Укроп', 1),
(17, 'Морковь (по-корейски)', 1),
(18, 'Картофель', 1),
(19, 'Сметана', 0),
(20, 'Зелень', 1),
(21, 'Ягоды', 1),
(22, 'Сельдь', 1),
(23, 'Семга', 0),
(24, 'Свекла', 1),
(25, 'Желатин', 1),
(26, 'Минтай', 1),
(27, 'Консервы рыбные', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '4bEvDYyIBaROEy3yuvxQ4zVNFjAt3XLW', '$2y$13$8YB2bd16wZ.8..1h0XNcQu542YglG6GTf0oVqq0AUhJ7CZTBwDFl6', NULL, 'admin@mail.ru', 10, 1485266977, 1499364792);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-dish_ingredient-dish_id` (`dish_id`),
  ADD KEY `idx-dish_ingredient-ingredient_id` (`ingredient_id`);

--
-- Индексы таблицы `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_ingredient` (`name_ingredient`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `dish_ingredient`
--
ALTER TABLE `dish_ingredient`
  ADD CONSTRAINT `fk-dish_ingredient-ingredient_id` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dish_ingredient-dish_id` FOREIGN KEY (`dish_id`) REFERENCES `dish` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
