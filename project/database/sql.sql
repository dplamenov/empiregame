
CREATE TABLE `digia_greatempire`.`users` ( `user_id` INT NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(80) NOT NULL , `real_name` VARCHAR(80) NOT NULL , `email` VARCHAR(100) NOT NULL , `pass` VARCHAR(100) NOT NULL , PRIMARY KEY (`user_id`)) ENGINE = InnoDB;

CREATE TABLE `digia_greatempire`.`building` ( `build_name` VARCHAR(50) NOT NULL , `money` INT NOT NULL , `time` INT NOT NULL , `building_id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`building_id`)) ENGINE = InnoDB;

CREATE TABLE `digia_greatempire`.`building_now` ( `user_id` INT NOT NULL , `building_name` INT NOT NULL , `end_time` INT NOT NULL ) ENGINE = InnoDB;


CREATE TABLE `digia_greatempire`.`users_building` ( `user_id` INT NOT NULL , `build_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `build_lv` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `building_now` ADD `building_id` INT NOT NULL AFTER `end_time`;

ALTER TABLE `users_building` ADD `building_id` INT NOT NULL AFTER `build_lv`;

ALTER TABLE `building` ADD `geo_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `building_id`;

ALTER TABLE `building` ADD `geo_location` VARCHAR(150) NOT NULL AFTER `geo_id`;

ALTER TABLE `army` ADD `army_name` VARCHAR(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `army_id`;

CREATE TABLE `digia_greatempire`.`army_now` ( `user_id` INT NOT NULL , `army_name` INT NOT NULL , `end_time` INT NOT NULL , `army_num` INT NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `digia_greatempire`.`user_army` ( `user_id` INT NOT NULL , `army_name` INT NOT NULL , `count` INT NOT NULL , `lvl` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `army` ADD `give_xp` INT NOT NULL AFTER `army_name`;

ALTER TABLE `users` CHANGE `real_name` `real_name` VARCHAR(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `building` CHANGE `geo_location` `geo_location` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;