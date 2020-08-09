create database temperature character set utf8 collate utf8_spanish_ci;
use temperature;

create table stations 
(
	id int primary key not null,
    description varchar(50) not null,
    ipAddress varchar(20) not null
)engine=InnoDB character set utf8 collate utf8_spanish_ci;

insert into stations (id, description, ipAddress) values
(1, 'Outside', '192.168.0.1'),
(2, 'Inside', '192.168.0.2');

create table readings 
(
	id int auto_increment primary key not null,
    date datetime not null,
    value double not null,
    idStation int not null
)engine=InnoDB character set utf8 collate utf8_spanish_ci;

insert into readings (date, value, idStation) values
('2018-11-20 00:00:00', 39.4, 1),
('2018-11-20 00:00:01', 58.1, 2),
('2018-11-20 01:00:00', 37.9, 1),
('2018-11-20 01:00:01', 57.9, 2),
('2018-11-20 02:00:00', 39.2, 1),
('2018-11-20 02:00:01', 58.0, 2),
('2018-11-20 03:00:00', 43.2, 1),
('2018-11-20 03:00:01', 58.9, 2),
('2018-11-20 04:00:00', 48.4, 1),
('2018-11-20 04:00:01', 59.1, 2),
('2018-11-20 05:00:00', 49.1, 1),
('2018-11-20 05:00:01', 62.3, 2),
('2018-11-20 06:00:00', 53.5, 1),
('2018-11-20 06:00:01', 65.4, 2),
('2018-11-20 07:00:00', 59.3, 1),
('2018-11-20 07:00:01', 68.5, 2),
('2018-11-20 08:00:00', 61.4, 1),
('2018-11-20 08:00:01', 72.1, 2),
('2018-11-20 09:00:00', 70.2, 1),
('2018-11-20 09:00:01', 75.4, 2),
('2018-11-20 10:00:00', 72.1, 1),
('2018-11-20 10:00:01', 76.6, 2),
('2018-11-20 11:00:00', 77.5, 1),
('2018-11-20 11:00:01', 80.4, 2);

alter table readings add constraint fkReadingStation foreign key (idStation)
references stations (id);