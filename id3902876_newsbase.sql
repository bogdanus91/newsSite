-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 07 2017 г., 11:35
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id3902876_newsbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clicks`
--

CREATE TABLE `clicks` (
  `id` int(11) NOT NULL,
  `unique_clicks` int(11) NOT NULL DEFAULT '0',
  `click` int(11) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `record_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clicks`
--

INSERT INTO `clicks` (`id`, `unique_clicks`, `click`, `country_code`, `date`, `record_id`) VALUES
(5, 1, 5, 'UA', '2017-12-07 09:16:44', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date_published`) VALUES
(2, 'record 1', 'sometext', '2017-12-05 14:50:30'),
(3, 'record 2', 'text', '2017-12-05 14:51:41'),
(5, 'record 3', 'text', '2017-12-05 14:51:48'),
(7, 'record 4', 'text', '2017-12-05 14:51:56'),
(9, 'record 5', 'text', '2017-12-05 14:52:03'),
(11, 'record 6', 'text', '2017-12-05 14:52:08'),
(13, 'record 7', 'text', '2017-12-05 14:52:14'),
(15, 'record 8', 'text', '2017-12-05 14:52:18'),
(17, 'record 9', 'text', '2017-12-05 14:52:21'),
(19, 'record 10', 'text', '2017-12-05 14:52:24');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clicks_ibfk_1` (`record_id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD CONSTRAINT `clicks_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `news` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
