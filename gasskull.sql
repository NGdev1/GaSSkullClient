
DROP DATABASE auto_service;
CREATE DATABASE auto_service;

USE `auto_service`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
  (1, 'Misha', 123123),
  (2, 'Lesnik', 123123);

CREATE TABLE `car_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `car_type` (`id`, `name`) VALUES
  (1, 'ВАЗ классика'),
  (2, 'ВАЗ 8кл'),
  (3, 'ВАЗ 16кл'),
  (4, 'Нива'),
  (5, 'Нива Шеви'),
  (6, 'Иномарка седан'),
  (7, 'Паркетник');

CREATE TABLE `price_list` (
  `id` int(11) NOT NULL,
  `id_car_type` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `id_work` int(11) NOT NULL,
  `price` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `price_list` (`id`, `id_car_type`, `id_detail`, `id_section`, `id_work`, `price`) VALUES
  (1, 1, 1, 1, 1, '400 р.');


CREATE TABLE IF NOT EXISTS `price_list_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `price_list_details` (`id`, `name`) VALUES
  (1, 'Амортизатор задний'),
  (2, 'Амортизатор передний'),
  (3, 'Бак топливный'),
  (4, 'Балка задняя');


CREATE TABLE `price_list_sections` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `price_list_sections` (`id`, `name`) VALUES
  (1, 'Нет разделов');

CREATE TABLE `price_list_works` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `price_list_works` (`id`, `name`) VALUES
  (1, 'Замена'),
  (2, 'Смена/Установка'),
  (3, 'Установка');

CREATE TABLE `service_record` (
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `id_car_type` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `device_platform` varchar(300) NOT NULL,
  `device_name` varchar(300) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `image` varchar(300) NOT NULL,
  `car_number` varchar(30) NOT NULL,
  `name` varchar(300) NOT NULL,
  `registration_date` date NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `pin`, `id_car_type`, `device_id`, `device_platform`, `device_name`, `phone`, `image`, `car_number`, `name`, `registration_date`, `last_activity`) VALUES
  (63, 32851, 1, 4254342, 'Android 5.3', 'Samsung Galaxy S3', '+73464735967', 'NULL', 'м345ун116', 'Oleg', '2017-02-04', '2017-02-04 08:23:06'),
  (64, 11369, 1, 4254345, 'Android 5.3', 'Samsung Galaxy S3', '+73464735967', 'NULL', 'м345ун116', 'Иван', '2017-02-08', '2017-02-08 06:01:29');


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `car_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `price_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_car_type` (`id_car_type`),
  ADD KEY `id_usluga` (`id_detail`),
  ADD KEY `id_section` (`id_section`),
  ADD KEY `id_work` (`id_work`);

ALTER TABLE `price_list_sections`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `price_list_works`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `service_record`
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_car_type` (`id_car_type`);


ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `car_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `price_list_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `price_list_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
ALTER TABLE `price_list_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;

ALTER TABLE `price_list`
  ADD CONSTRAINT `price_list_ibfk_1` FOREIGN KEY (`id_detail`) REFERENCES `price_list_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_list_ibfk_2` FOREIGN KEY (`id_work`) REFERENCES `price_list_works` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_list_ibfk_3` FOREIGN KEY (`id_car_type`) REFERENCES `car_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_list_ibfk_4` FOREIGN KEY (`id_section`) REFERENCES `price_list_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `service_record`
  ADD CONSTRAINT `service_record_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_car_type`) REFERENCES `car_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
