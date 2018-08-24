SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `army` (
  `army_level` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `army_id` int(11) NOT NULL,
  `army_name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `give_xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `army` (`army_level`, `money`, `time`, `army_id`, `army_name`, `give_xp`) VALUES
(1, 40, 0, 1, 'Меченосци', 20);

CREATE TABLE `army_now` (
  `user_id` int(11) NOT NULL,
  `army_name` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `army_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `building` (
  `build_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `money` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `geo_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `geo_location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `building` (`build_name`, `money`, `time`, `building_id`, `geo_id`, `geo_location`) VALUES
('Казарма', 550, 1, 1, 'kazarma', '84,102,2,3');

CREATE TABLE `building_now` (
  `user_id` int(11) NOT NULL,
  `building_name` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `real_name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `money` int(11) NOT NULL,
  `xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_building` (
  `user_id` int(11) NOT NULL,
  `build_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `build_lv` int(11) NOT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_army` (
  `user_id` int(11) NOT NULL,
  `army_name` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `army`
  ADD PRIMARY KEY (`army_id`);

ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;