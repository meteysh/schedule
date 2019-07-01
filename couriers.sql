-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2019 г., 10:52
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `couriers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `couriers`
--

CREATE TABLE `couriers` (
  `id` int(5) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `secondname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `couriers`
--

INSERT INTO `couriers` (`id`, `firstname`, `secondname`) VALUES
(1, 'Дмитрий', 'Егоров'),
(2, 'Сергей', 'Федоров'),
(5, 'Андрей', 'Петров'),
(7, 'Юрий', 'Троникс'),
(8, 'Георгий', 'Сухоруков'),
(9, 'Ярослав', 'Сухоруков'),
(10, 'Алексей', 'Вояжный'),
(11, 'Петр', 'Евлампий');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region` varchar(32) NOT NULL,
  `time` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `region`, `time`) VALUES
(1, 'Санкт-Петербург', 22),
(2, 'Уфа', 19),
(3, 'Нижний Новгород', 15),
(4, 'Владимир', 13),
(5, 'Кострома', 15),
(6, 'Екатеринбург', 25),
(7, 'Ковров', 14),
(8, 'Воронеж', 6),
(9, 'Самара', 14),
(10, 'Астрахань', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `timing`
--

CREATE TABLE `timing` (
  `id` int(11) NOT NULL,
  `id_couriers` int(11) NOT NULL,
  `id_regions` int(11) NOT NULL,
  `date_dep` date DEFAULT NULL,
  `date_arrive` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `timing`
--

INSERT INTO `timing` (`id`, `id_couriers`, `id_regions`, `date_dep`, `date_arrive`) VALUES
(69, 7, 3, '2019-06-14', '2019-06-18'),
(70, 5, 3, '2019-06-22', '2019-06-25'),
(71, 8, 4, '2019-06-16', '2019-06-18'),
(72, 5, 4, '2019-06-16', '2019-06-18'),
(74, 1, 1, '2019-06-14', '2019-06-19'),
(75, 1, 5, '2019-06-28', '2019-07-02'),
(82, 2, 3, '2019-08-11', '2019-08-13'),
(83, 2, 2, '2019-06-11', '2019-06-14'),
(84, 10, 5, '2019-06-19', '2019-06-21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timing`
--
ALTER TABLE `timing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_couriers` (`id_couriers`),
  ADD KEY `id_regions` (`id_regions`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `timing`
--
ALTER TABLE `timing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `timing`
--
ALTER TABLE `timing`
  ADD CONSTRAINT `timing_ibfk_1` FOREIGN KEY (`id_couriers`) REFERENCES `couriers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timing_ibfk_2` FOREIGN KEY (`id_regions`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
