DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  id int(11) NOT NULL,
  login varchar(100) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO admin (id, login, password) VALUES
  (1, 'Misha', 123123),
  (2, 'Il', 123321);

DROP TABLE IF EXISTS price_list;
CREATE TABLE price_list (
  id_car_type int(11) NOT NULL,
  id_services int(11) NOT NULL,
  price varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO price_list (id_car_type, id_services, price) VALUES
  (2, 1, '400 р.'),
  (1, 1, '400 р.'),
  (3, 1, '400 р.'),
  (4, 1, '300 р.'),
  (5, 1, '300 р.'),
  (6, 1, '300 - 750 р.'),
  (7, 1, '400 - 750 р.');

DROP TABLE IF EXISTS services;
CREATE TABLE services (
  id int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO services (id, name) VALUES
  (1, 'амортизатор задний'),
  (2, 'амортизатор передний'),
  (3, 'бак топливный'),
  (4, 'балка задняя');

DROP TABLE IF EXISTS service_record;
CREATE TABLE service_record (
  user_id int(11) NOT NULL,
  `date` date NOT NULL,
  message varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL,
  pin int(11) NOT NULL,
  id_car_type int(11) NOT NULL,
  device_id int(11) NOT NULL,
  device_platform varchar(100) NOT NULL,
  device_name varchar(100) NOT NULL,
  phone varchar(12) NOT NULL,
  image varchar(100) NOT NULL,
  car_number varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  registration_date date NOT NULL,
  last_activity datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

INSERT INTO users (id, pin, id_car_type, device_id, device_platform, device_name, phone, image, car_number, name, registration_date, last_activity) VALUES
  (1, 84858, 7, 4254345, 'Android 5.3', 'Samsung Galaxy S3', '+73464735967', 'NULL', 'м345ун116', 'Кирилл', '2017-02-02', '2017-02-02 20:04:37'),
  (2, 41052, 3, 5603475, 'IOS 10', 'IPhone 7', '+73464433964', 'NULL', 'у323еп116', 'Жора', '2017-02-02', '2017-02-02 20:15:55');

DROP TABLE IF EXISTS car_type;
CREATE TABLE car_type (
  id int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO car_type (id, name) VALUES
  (1, 'ВАЗ классика'),
  (2, 'ВАЗ 8кл'),
  (3, 'ВАЗ 16кл'),
  (4, 'Нива'),
  (5, 'Шевролет Нива'),
  (6, 'Иномарка седан'),
  (7, 'Паркетник');

ALTER TABLE admin
  ADD PRIMARY KEY (id);

ALTER TABLE car_type
  ADD PRIMARY KEY (id);

ALTER TABLE price_list
  ADD KEY id_car_type (id_car_type),
  ADD KEY id_usluga (id_services);

ALTER TABLE services
  ADD PRIMARY KEY (id);

ALTER TABLE service_record
  ADD KEY user_id (user_id);

ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD KEY id_car_type (id_car_type);


ALTER TABLE admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE car_type
  MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE services
  MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;

ALTER TABLE price_list
  ADD CONSTRAINT price_list_ibfk_1 FOREIGN KEY (id_car_type) REFERENCES car_type (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT price_list_ibfk_2 FOREIGN KEY (id_services) REFERENCES services (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE service_record
  ADD CONSTRAINT service_record_ibfk_1 FOREIGN KEY (user_id) REFERENCES `users` (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE users
  ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (id_car_type) REFERENCES car_type (id) ON DELETE CASCADE ON UPDATE CASCADE;
