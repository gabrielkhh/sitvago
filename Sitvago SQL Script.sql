CREATE SCHEMA `sitvago_test_db` DEFAULT CHARACTER SET utf8 ;
-- USE `sitvago_test_db`;
CREATE TABLE `sitvago_test_db`.`User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(100),
  `last_name` varchar(100),
  `username` varchar(255) UNIQUE,
  `email` varchar(255) UNIQUE NOT NULL,
  `phone_number` varchar(30),
  `country` varchar(255),
  `password` nvarchar(255),
  `billing_address` varchar(255),
  `card_number` varchar(50),
  `role_id` int,
  `is_confirmed` bit,
  `created_at` datetime,
  `updated_at` datetime
);
CREATE TABLE `sitvago_test_db`.`Role` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100),
  `created_at` datetime
);
CREATE TABLE `sitvago_test_db`.`HotelRoomCategory` (
  `hotel_id` int,
  `room_category_id` int,
  `availability` bit,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  PRIMARY KEY (`hotel_id`, `room_category_id`),
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`RoomCategory` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(100),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`Room` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `room_number` varchar(100),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`Hotel` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `description` mediumtext,
  `rating` float,
  `geo_id` int,
  `discounted_price` float,
  `original_price` float,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`HotelImage` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(255),
  `hotel_id` int,
  `is_thumbnail` bit,
  `image_extension` varchar(10),
  `alt_text` varchar(100),
  `width` int,
  `height` int
);
CREATE TABLE `sitvago_test_db`.`UserImage` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL UNIQUE,
  `url` varchar(255),
  `image_extension` varchar(10),
  `alt_text` varchar(100),
  `width` int,
  `height` int,
  FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`AboutUs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `description` mediumtext,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`GeoLocation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`Booking` (
  `hotel_id` int,
  `user_id` int,
  `price` float,
  `check_in` datetime,
  `check_out` datetime,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  PRIMARY KEY (`hotel_id`, `user_id`),
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`FAQ` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(255),
  `answer` varchar(255),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_test_db`.`Review` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `hotel_id` int,
  `title` varchar(255),
  `rating` float,
  `description` mediumtext,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
ALTER TABLE `sitvago_test_db`.`User`
ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);
ALTER TABLE `sitvago_test_db`.`Hotel`
ADD FOREIGN KEY (`geo_id`) REFERENCES `GeoLocation` (`id`);
ALTER TABLE `sitvago_test_db`.`HotelImage`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);
ALTER TABLE `sitvago_test_db`.`Booking`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);
ALTER TABLE `sitvago_test_db`.`Booking`
ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
ALTER TABLE `sitvago_test_db`.`Review`
ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
ALTER TABLE `sitvago_test_db`.`Review`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);

-- Seed Data
USE `sitvago_test_db`;
INSERT INTO Role (name, created_at) VALUES("Administrator", now());
INSERT INTO Role (name, created_at) VALUES("User", now());

INSERT INTO User (first_name, last_name, username, email, phone_number, country, password, billing_address, card_number, role_id, is_confirmed, created_at, updated_at) VALUES("Towkay", NULL, "admin", "admin@sitvago.com", NULL, NULL, NULL, NULL, NULL, (SELECT id from Role WHERE name="administrator"), 1, now(), now());