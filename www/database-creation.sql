SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `prefix_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

INSERT INTO `prefix_role`
(id, name)
VALUES(1, 'user');
INSERT INTO `prefix_role`
(id, name)
VALUES(2, 'editor');
INSERT INTO `prefix_role`
(id, name)
VALUES(3, 'admin');


CREATE TABLE `prefix_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `id_role` int DEFAULT NULL,
  `token` char(255) DEFAULT NULL,
  `reset_token` char(255) DEFAULT NULL,
  `auth_token` char(255) DEFAULT NULL,
  `reset_token_expiration` timestamp NULL DEFAULT NULL,
  `token_expiration` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `prefix_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `prefix_user`
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `prefix_user`
ADD FOREIGN KEY (`id_role`) REFERENCES `prefix_role`(`id`);

CREATE TABLE `prefix_comment` (
    id INT NOT NULL AUTO_INCREMENT,
    id_page INT NOT NULL,
    id_user INT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    verified TINYINT NOT NULL,
    createdAt timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updatedAt timestamp on update CURRENT_TIMESTAMP NULL,
    reported TINYINT NOT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (`id_page`) REFERENCES `prefix_page`(`id`),
     FOREIGN KEY (`id_user`) REFERENCES `prefix_user`(`id`)
)
ENGINE=InnoDB
DEFAULT CHARSET=latin1
COLLATE=latin1_swedish_ci;

CREATE TABLE `prefix_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `prefix_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  `prefix_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  `font` varchar(255) NOT NULL,
  `background` varchar(10) NOT NULL,
  `active` BOOLEAN NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `prefix_template`
(id, name, color, font, background, active)
VALUES(
  1, 
  'default', 
  '000000', 
  'https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap',
  '959595',
  1
);


CREATE TABLE `prefix_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `createdAt` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
  `updatedAt` timestamp on update CURRENT_TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `prefix_checkout_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `prefix_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `prefix_checkout_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_checkout` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_checkout` (`id_checkout`),
  CONSTRAINT `prefix_checkout_product_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `prefix_checkout` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;