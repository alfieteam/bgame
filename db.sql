-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 26 2018 г., 02:16
-- Версия сервера: 10.1.29-MariaDB
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bgame`
--

-- --------------------------------------------------------

--
-- Структура таблицы `build`
--

CREATE TABLE `build` (
  `build_id` int(11) NOT NULL,
  `build_type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `build_addres` varchar(70) CHARACTER SET utf8 NOT NULL,
  `build_profit` int(11) NOT NULL DEFAULT '0',
  `build_cost` int(11) NOT NULL DEFAULT '0',
  `build_sell_cost` int(11) NOT NULL DEFAULT '0',
  `build_owner` int(11) NOT NULL,
  `build_in_sell` varchar(3) CHARACTER SET utf8 NOT NULL,
  `build_status` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `build`
--

INSERT INTO `build` (`build_id`, `build_type`, `build_addres`, `build_profit`, `build_cost`, `build_sell_cost`, `build_owner`, `build_in_sell`, `build_status`) VALUES
(1, 'school', 'china', 0, 1000, 0, 6, '', 'in_construction'),
(2, 'house', 'ukraine', 0, 1000, 0, 6, '', 'in_construction'),
(3, 'house', 'ukraine', 0, 1000, 0, 6, '', 'in_construction'),
(4, 'room', 'ukraine', 0, 1000, 0, 6, '', 'in_construction'),
(5, 'restaurant', 'usa', 0, 2000, 0, 6, '', 'in_construction');

-- --------------------------------------------------------

--
-- Структура таблицы `build_log`
--

CREATE TABLE `build_log` (
  `build_id` int(11) NOT NULL,
  `build_type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `build_owner` int(11) NOT NULL,
  `builders_amount` int(11) NOT NULL,
  `building_start` int(11) NOT NULL,
  `building_end` int(11) NOT NULL,
  `building_status` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `build_log`
--

INSERT INTO `build_log` (`build_id`, `build_type`, `build_owner`, `builders_amount`, `building_start`, `building_end`, `building_status`) VALUES
(1, '', 6, 5, 1516927665, 1516944945, 'in_construction'),
(2, '', 6, 1, 1516928195, 1517014595, 'in_construction'),
(3, 'house', 0, 1, 1516929067, 1517015467, 'in_construction'),
(4, 'room', 6, 1, 1516929243, 1517015643, 'in_construction'),
(5, 'restaurant', 6, 5, 1516929260, 1516946540, 'in_construction');

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `energy` int(3) NOT NULL,
  `builders` int(11) NOT NULL DEFAULT '0',
  `builders_in_use` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `stats`
--

INSERT INTO `stats` (`id`, `cash`, `energy`, `builders`, `builders_in_use`) VALUES
(6, 1858, 100, 10, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(6, 'dimasikkk', '3fc4210dfed00df8b11b9150e738550c', 'alfieteam1993@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `workv1`
--

CREATE TABLE `workv1` (
  `id` int(11) NOT NULL,
  `workname` varchar(60) CHARACTER SET utf8 NOT NULL,
  `work_pay` int(11) NOT NULL,
  `work_owner` varchar(24) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `workv1`
--

INSERT INTO `workv1` (`id`, `workname`, `work_pay`, `work_owner`) VALUES
(1, 'Coca-Cola', 100, 'Jeck Rock'),
(2, 'IQ-commercial', 132, 'Rick Whitehouse');

-- --------------------------------------------------------

--
-- Структура таблицы `work_log`
--

CREATE TABLE `work_log` (
  `id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_start` int(11) NOT NULL,
  `work_end` int(11) NOT NULL,
  `work_pay` int(11) NOT NULL,
  `work_status` varchar(12) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `work_log`
--

INSERT INTO `work_log` (`id`, `work_id`, `user_id`, `work_start`, `work_end`, `work_pay`, `work_status`) VALUES
(62, 1, 6, 1516906831, 1516906891, 100, 'completed'),
(63, 2, 6, 1516907552, 1516907612, 132, 'completed'),
(64, 1, 6, 1516907628, 1516907688, 100, 'completed'),
(65, 1, 6, 1516907692, 1516907752, 100, 'completed'),
(66, 1, 6, 1516907794, 1516907854, 100, 'completed'),
(67, 2, 6, 1516907877, 1516907937, 132, 'completed'),
(68, 1, 6, 1516908040, 1516908100, 100, 'completed'),
(69, 2, 6, 1516908116, 1516908176, 132, 'completed'),
(70, 2, 6, 1516922974, 1516923034, 132, 'completed'),
(59, 2, 6, 1516906591, 1516906651, 110, 'completed'),
(60, 1, 6, 1516906661, 1516906721, 100, 'completed'),
(61, 1, 6, 1516906758, 1516906818, 100, 'completed'),
(58, 2, 6, 1516906481, 1516906541, 110, 'completed'),
(57, 1, 6, 1516906403, 1516906463, 100, 'completed'),
(56, 1, 6, 1516906257, 1516906317, 100, 'completed'),
(55, 2, 6, 1516905326, 1516905386, 110, 'completed'),
(54, 1, 6, 1516905258, 1516905318, 100, 'completed');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `build`
--
ALTER TABLE `build`
  ADD PRIMARY KEY (`build_id`);

--
-- Индексы таблицы `build_log`
--
ALTER TABLE `build_log`
  ADD PRIMARY KEY (`build_id`);

--
-- Индексы таблицы `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `workv1`
--
ALTER TABLE `workv1`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work_log`
--
ALTER TABLE `work_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `build`
--
ALTER TABLE `build`
  MODIFY `build_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `build_log`
--
ALTER TABLE `build_log`
  MODIFY `build_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `workv1`
--
ALTER TABLE `workv1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `work_log`
--
ALTER TABLE `work_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
