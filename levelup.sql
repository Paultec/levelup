-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 16 2013 г., 13:07
-- Версия сервера: 5.6.11
-- Версия PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `levelup`
--
CREATE DATABASE IF NOT EXISTS `levelup` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `levelup`;

-- --------------------------------------------------------

--
-- Структура таблицы `classroom`
--

CREATE TABLE IF NOT EXISTS `classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` smallint(6) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `classroom`
--

INSERT INTO `classroom` (`id`, `number`, `description`) VALUES
(1, 777, 'фымфваыипацыи'),
(2, 222, 'ййй укпйк'),
(3, 111, '111 222 333');

-- --------------------------------------------------------

--
-- Структура таблицы `days_week`
--

CREATE TABLE IF NOT EXISTS `days_week` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` enum('Пн','Вт','Ср','Чт','Пт','Сб','Вс') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `day` (`day`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `days_week`
--

INSERT INTO `days_week` (`id`, `day`) VALUES
(1, 'Пн'),
(2, 'Вт'),
(3, 'Ср'),
(4, 'Чт'),
(5, 'Пт'),
(6, 'Сб'),
(7, 'Вс');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `idSpecialisation` int(11) NOT NULL,
  `startStudying` date NOT NULL,
  `hoursAtLession` tinyint(4) NOT NULL,
  `timeStartLession` time NOT NULL,
  `monthsAtCourse` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSpecialisation` (`idSpecialisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `idSpecialisation`, `startStudying`, `hoursAtLession`, `timeStartLession`, `monthsAtCourse`) VALUES
(3, 'РПО 12-4', 1, '2012-12-15', 3, '15:00:00', 3),
(4, 'РПО 12-5', 2, '2013-03-01', 3, '18:00:00', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idStudent` int(11) NOT NULL,
  `sum` smallint(6) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idStudent` (`idStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ref_sub_spec`
--

CREATE TABLE IF NOT EXISTS `ref_sub_spec` (
  `idSpecialisation` int(11) NOT NULL,
  `idSubject` int(11) NOT NULL,
  KEY `idSpecialisation` (`idSpecialisation`),
  KEY `idSubject` (`idSubject`),
  KEY `idSpecialisation_2` (`idSpecialisation`),
  KEY `idSubject_2` (`idSubject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClassroom` int(11) NOT NULL,
  `idUsersInfo` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `idDay` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idClassroom` (`idClassroom`),
  KEY `idUsersInfo` (`idUsersInfo`),
  KEY `idGroup` (`idGroup`),
  KEY `idDay` (`idDay`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `idClassroom`, `idUsersInfo`, `idGroup`, `idDay`) VALUES
(1, 1, 3, 3, 1),
(2, 1, 3, 3, 3),
(3, 1, 3, 3, 5),
(4, 1, 4, 4, 1),
(5, 1, 4, 4, 4),
(6, 2, 4, 4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `specialisation`
--

CREATE TABLE IF NOT EXISTS `specialisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialisation` varchar(255) NOT NULL,
  `specDurations` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `specialisation`
--

INSERT INTO `specialisation` (`id`, `specialisation`, `specDurations`) VALUES
(1, 'PHP', 12),
(2, '.NET', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'работает'),
(2, 'в отпуске');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `passportSeries` varchar(2) NOT NULL,
  `passportNumber` varchar(6) NOT NULL,
  `inn` varchar(14) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `phoneFurther` varchar(25) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `emailFurther` varchar(50) DEFAULT NULL,
  `skype` varchar(50) NOT NULL,
  `linkVK` varchar(50) DEFAULT NULL,
  `linkFB` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `numberContract` varchar(25) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `sumContract` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`idStatus`),
  KEY `status_2` (`idStatus`),
  KEY `idGroup` (`idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `subjectDurations` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsersRole` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `passportSeries` varchar(2) NOT NULL,
  `passportNumber` varchar(6) NOT NULL,
  `inn` varchar(14) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `phoneFurther` varchar(25) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `emailFurther` varchar(50) DEFAULT NULL,
  `skype` varchar(50) NOT NULL,
  `linkVK` varchar(50) DEFAULT NULL,
  `linkFB` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `idStatus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsersRole` (`idUsersRole`),
  KEY `status` (`idStatus`),
  KEY `idStatus` (`idStatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users_info`
--

INSERT INTO `users_info` (`id`, `idUsersRole`, `firstName`, `lastName`, `patronymic`, `birthday`, `passportSeries`, `passportNumber`, `inn`, `photo`, `phone`, `phoneFurther`, `email`, `emailFurther`, `skype`, `linkVK`, `linkFB`, `address`, `idStatus`) VALUES
(1, 1, 'Иван', 'Иванов', 'Иванович', '2013-10-01', 'ЫЫ', '123456', '01234567890123', 'ссылка на фото', '+38-056-777-77-77', '', 'admin@levelup.ua', '', 'adminSkype', 'ссылка на ВКонтакте', 'ссылка на Фейсбук', 'г. Днепропетровск', 1),
(2, 2, 'Анна', 'Орлова', 'Львовна', '1990-12-31', 'ЙФ', '111222', '12345678910112', 'ссылка на фото ', '111-22-33', '222-33-44', 'anna@anna.ua', '', 'annavskype', 'ссылка', 'ссылка', 'Украина', 1),
(3, 3, 'Петр', 'Куликов', 'Петрович', '1985-01-31', 'АК', '777777', '98765432101234', 'фото', '777-77-77', '777-88-88', 'qw@qw.ua', '', 'petr', 'petrVK', 'petrFB', 'USA', 2),
(4, 3, 'Sam', '', '', '1999-01-01', '', '', '', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users_login`
--

CREATE TABLE IF NOT EXISTS `users_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersLogin` varchar(255) NOT NULL,
  `usersPassword` varchar(255) NOT NULL,
  `idUsersInfo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsersInfo` (`idUsersInfo`),
  KEY `idUsersInfo_2` (`idUsersInfo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users_login`
--

INSERT INTO `users_login` (`id`, `usersLogin`, `usersPassword`, `idUsersInfo`) VALUES
(1, 'admin', 'admin', 1),
(2, 'manager', 'manager', 2),
(3, 'lecturer', 'lecturer', 3),
(4, 'lector', 'lector', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users_role`
--

CREATE TABLE IF NOT EXISTS `users_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersRole` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users_role`
--

INSERT INTO `users_role` (`id`, `usersRole`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'lecturer');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`idSpecialisation`) REFERENCES `specialisation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`idStudent`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ref_sub_spec`
--
ALTER TABLE `ref_sub_spec`
  ADD CONSTRAINT `ref_sub_spec_ibfk_1` FOREIGN KEY (`idSpecialisation`) REFERENCES `specialisation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ref_sub_spec_ibfk_2` FOREIGN KEY (`idSubject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`idClassroom`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`idGroup`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`idUsersInfo`) REFERENCES `users_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`idDay`) REFERENCES `days_week` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`idStatus`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`idGroup`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `users_info_ibfk_1` FOREIGN KEY (`idUsersRole`) REFERENCES `users_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_info_ibfk_2` FOREIGN KEY (`idStatus`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUsersInfo`) REFERENCES `users_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
