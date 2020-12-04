CREATE SCHEMA `sitvago_db` DEFAULT CHARACTER SET utf8 ;
-- USE `sitvago_db`;
CREATE TABLE `sitvago_db`.`User` (
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
  `stripe_customer_id` varchar(255),
  `created_at` datetime,
  `updated_at` datetime
);
CREATE TABLE `sitvago_db`.`Role` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100),
  `created_at` datetime
);
CREATE TABLE `sitvago_db`.`HotelRoomCategory` (
  `hotel_id` int,
  `room_category_id` int,
  `availability` bit,
  `price_per_night` float,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  PRIMARY KEY (`hotel_id`, `room_category_id`),
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_db`.`RoomCategory` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(100),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_db`.`Hotel` (
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
CREATE TABLE `sitvago_db`.`HotelImage` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(255),
  `secure_url` varchar(255),
  `original_src` varchar(255),
  `hotel_id` int,
  `is_thumbnail` bit,
  `image_extension` varchar(10),
  `alt_text` varchar(100),
  `width` int,
  `height` int
);
CREATE TABLE `sitvago_db`.`UserImage` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL UNIQUE,
  `url` varchar(255),
  `image_extension` varchar(10),
  `alt_text` varchar(100),
  `width` int,
  `height` int,
  FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_db`.`GeoLocation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);
CREATE TABLE `sitvago_db`.`Booking` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `hotel_id` int,
  `user_id` int,
  `room_category_id` int,
  `price` float,
  `check_in` datetime,
  `check_out` datetime,
  `stripe_payment_id` varchar(255),
  `created_at` datetime,
  FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  FOREIGN KEY (`room_category_id`) REFERENCES `RoomCategory` (`id`)
);
CREATE TABLE `sitvago_db`.`FAQ` (
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
CREATE TABLE `sitvago_db`.`Review` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `hotel_id` int,
  `title` varchar(255),
  `rating` float,
  `content` mediumtext,
  `created_at` datetime,
  `created_by` int,
  `updated_at` datetime,
  `updated_by` int,
  FOREIGN KEY (`created_by`) REFERENCES `User` (`id`),
  FOREIGN KEY (`updated_by`) REFERENCES `User` (`id`)
);

CREATE TABLE `sitvago_db`.`FAQCategory` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `created_by` INT NULL,
  `updated_at` DATETIME NULL,
  `updated_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_user_created_idx` (`created_by` ASC),
  INDEX `fk_user_updated_idx` (`updated_by` ASC),
  CONSTRAINT `fk_user_created`
    FOREIGN KEY (`created_by`)
    REFERENCES `sitvago_db`.`User` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_updated`
    FOREIGN KEY (`updated_by`)
    REFERENCES `sitvago_db`.`User` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION);

ALTER TABLE `sitvago_db`.`FAQ` 
ADD COLUMN `category_id` INT NULL AFTER `updated_by`,
ADD INDEX `faq_cat_id_idx` (`category_id` ASC);
;
ALTER TABLE `sitvago_db`.`FAQ` 
ADD CONSTRAINT `faq_cat_id`
  FOREIGN KEY (`category_id`)
  REFERENCES `sitvago_db`.`FAQCategory` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `sitvago_db`.`FAQ` 
CHANGE COLUMN `question` `question` VARCHAR(20000) NULL DEFAULT NULL ,
CHANGE COLUMN `answer` `answer` MEDIUMTEXT NULL DEFAULT NULL ;

ALTER TABLE `sitvago_db`.`HotelImage` 
CHANGE COLUMN `url` `url` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `secure_url` `secure_url` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `original_src` `original_src` VARCHAR(5000) NULL DEFAULT NULL ,
CHANGE COLUMN `alt_text` `alt_text` VARCHAR(1000) NULL DEFAULT NULL ;


ALTER TABLE `sitvago_db`.`User`
ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);
ALTER TABLE `sitvago_db`.`Hotel`
ADD FOREIGN KEY (`geo_id`) REFERENCES `GeoLocation` (`id`);
ALTER TABLE `sitvago_db`.`HotelImage`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);
ALTER TABLE `sitvago_db`.`Booking`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);
ALTER TABLE `sitvago_db`.`Booking`
ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
ALTER TABLE `sitvago_db`.`Review`
ADD FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);
ALTER TABLE `sitvago_db`.`Review`
ADD FOREIGN KEY (`hotel_id`) REFERENCES `Hotel` (`id`);

-- Seed Data
USE `sitvago_db`;
INSERT INTO Role (name, created_at) VALUES("Administrator", now());
INSERT INTO Role (name, created_at) VALUES("User", now());

INSERT INTO User (first_name, last_name, username, email, phone_number, country, password, billing_address, card_number, role_id, is_confirmed, created_at, updated_at) VALUES("Super Administrator", NULL, "admin", "admin@sitvago.com", NULL, NULL, NULL, NULL, NULL, (SELECT id from Role WHERE name="administrator"), 1, now(), now());

INSERT INTO GeoLocation (name, created_at, created_by, updated_at, updated_by) VALUES("North", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO GeoLocation (name, created_at, created_by, updated_at, updated_by) VALUES("South", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO GeoLocation (name, created_at, created_by, updated_at, updated_by) VALUES("East", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO GeoLocation (name, created_at, created_by, updated_at, updated_by) VALUES("West", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));

INSERT INTO RoomCategory (category_name, created_at, created_by, updated_at, updated_by) VALUES("Deluxe Double Room", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO RoomCategory (category_name, created_at, created_by, updated_at, updated_by) VALUES("Premium Queen Room", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO RoomCategory (category_name, created_at, created_by, updated_at, updated_by) VALUES("Twin Room", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));

INSERT INTO FAQCategory (category_name, created_at, created_by, updated_at, updated_by) VALUES("General questions", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));
INSERT INTO FAQCategory (category_name, created_at, created_by, updated_at, updated_by) VALUES("Regarding Booking of our Hotels", now(), (SELECT id FROM User WHERE email="admin@sitvago.com"), now(), (SELECT id FROM User WHERE email="admin@sitvago.com"));