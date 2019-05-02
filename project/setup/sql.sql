SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `army`
(
  `army_level` int(11)                        NOT NULL,
  `money`      int(11)                        NOT NULL,
  `time`       int(11)                        NOT NULL,
  `army_id`    int(11)                        NOT NULL,
  `army_name`  varchar(80) CHARACTER SET utf8 NOT NULL,
  `give_xp`    int(11)                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `army` (`army_level`, `money`, `time`, `army_id`, `army_name`, `give_xp`)
VALUES
  (1, 40, 1, 1, 'Копиеносци', 20);
INSERT INTO `army` (`army_level`, `money`, `time`, `army_id`, `army_name`, `give_xp`)
VALUES
  (2, 50, 1, 2, 'Меченосци', 25);

CREATE TABLE `army_now`
(
  `user_id`   int(11) NOT NULL,
  `army_name` int(11) NOT NULL,
  `end_time`  int(11) NOT NULL,
  `army_num`  int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `building`
(
  `build_name`   varchar(50) CHARACTER SET utf8 NOT NULL,
  `money`        int(11)                        NOT NULL,
  `time`         int(11)                        NOT NULL,
  `building_id`  int(11)                        NOT NULL,
  `geo_id`       varchar(50) CHARACTER SET utf8 NOT NULL,
  `geo_location` varchar(150)                   NOT NULL,
  `shape`        varchar(15) CHARACTER SET utf8 NOT NULL,
  `give_xp`      int(11)                        NOT NULL
) ENGINE = InnoDB ,
  DEFAULT CHARSET = utf8;

INSERT INTO `building` (`build_name`, `money`, `time`, `building_id`, `geo_id`, `geo_location`, `shape`, `give_xp`)
VALUES
  ('barrack', 550, 1, 1, 'barrack', '113,96,3,7', 'rect', 100);

INSERT INTO `building` (`build_name`, `money`, `time`, `building_id`, `geo_id`, `geo_location`, `shape`, `give_xp`)
VALUES
  ('castle', 800, 5, 2, 'castle', '668,367,774,441', 'rect', 500);

INSERT INTO `building` (`build_name`, `money`, `time`, `building_id`, `geo_id`, `geo_location`, `shape`, `give_xp`)
VALUES
  ('house', 800, 1, 3, 'house', '613,161,712,99', 'rect', 60);

CREATE TABLE `building_now`
(
  `user_id`       int(11) NOT NULL,
  `building_name` int(11) NOT NULL,
  `end_time`      int(11) NOT NULL,
  `building_id`   int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `users`
(
  `user_id`   int(11)                        NOT NULL,
  `user_name` varchar(80) CHARACTER SET utf8 NOT NULL,
  `real_name` varchar(80)                    NOT NULL,
  `email`     varchar(100)                   NOT NULL,
  `pass`      varchar(100)                   NOT NULL,
  `money`     int(11)                        NOT NULL,
  `xp`        int(11)                        NOT NULL,
  `people`    int(11)                        NOT NULL DEFAULT '50',
  `lastlogin` varchar(80)                    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `users_building`
(
  `user_id`     int(11)                        NOT NULL,
  `build_name`  varchar(50) CHARACTER SET utf8 NOT NULL,
  `build_lv`    int(11)                        NOT NULL,
  `building_id` int(11)                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `user_army`
(
  `user_id`   int(11) NOT NULL,
  `army_name` int(11) NOT NULL,
  `count`     int(11) NOT NULL,
  `lvl`       int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `army`
  ADD PRIMARY KEY (`army_id`);

ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  CHANGE `user_id` `user_id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  ADD `active` TINYINT NOT NULL DEFAULT '1' AFTER `xp`;

CREATE TABLE `battle`
(
  `attacker` INT NOT NULL,
  `defender` INT NOT NULL,
  `result`   INT NOT NULL,
  `start`    INT NOT NULL,
  `end`      INT NOT NULL
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `levels`
(
  `level_id`   INT NOT NULL AUTO_INCREMENT,
  `from_xp`    INT NOT NULL,
  `to_xp`      INT NOT NULL,
  `give_money` INT NOT NULL,
  `give_xp`    INT NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE = InnoDB;

ALTER TABLE `user_army`
  CHANGE `lvl` `lvl` INT(11) NOT NULL DEFAULT '1';

ALTER TABLE `user_army`
  ADD `army_id` INT NOT NULL AUTO_INCREMENT FIRST,
  ADD PRIMARY KEY (`army_id`);

ALTER TABLE `upgrade_army`
  ADD `user_id` INT NOT NULL AFTER `level`;

INSERT INTO `levels` (`level_id`, `from_xp`, `to_xp`, `give_money`, `give_xp`)
VALUES ('1', '1', '99', '0', '0'),
       ('2', '100', '199', '100', '5'),
       ('3', '200', '299', '200', '20'),
       ('4', '300', '399', '300', '30');

CREATE TABLE IF NOT EXISTS `upgrade_army`
(
  `army_id`   INT NOT NULL AUTO_INCREMENT,
  `army_name` INT NOT NULL,
  `start`     INT NOT NULL,
  `end`       INT NOT NULL,
  `level`     INT NOT NULL,
  PRIMARY KEY (`army_id`)
) ENGINE = InnoDB;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;