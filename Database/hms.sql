/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.1.8-MariaDB : Database - hms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `hms`;

/*Table structure for table `guide` */

DROP TABLE IF EXISTS `guide`;

CREATE TABLE `guide` (
  `guide_id` varchar(20) NOT NULL,
  `nic` varchar(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`guide_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `guide` */

insert  into `guide`(`guide_id`,`nic`,`first_name`,`last_name`,`email`,`contact`,`address`) values ('G-1','931340034v','sumanapala','sirisoma','siri@gmail.com','0784561230','kandy'),('G-2','945678912v','nihal','perera','nihal@gmail.com','0784561230','galle'),('G-3','369874561v','udayanga','senarathna','supunuddeepa2@gmail.com','0112369874','nugegoda');

/*Table structure for table `hotel` */

DROP TABLE IF EXISTS `hotel`;

CREATE TABLE `hotel` (
  `hotel_id` varchar(50) NOT NULL DEFAULT 'H-1',
  `name` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `guide` int(1) NOT NULL,
  `transport` int(1) NOT NULL,
  PRIMARY KEY (`hotel_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hotel` */

insert  into `hotel`(`hotel_id`,`name`,`contact`,`address`,`latitude`,`longitude`,`email`,`guide`,`transport`) values ('H-1','galadari','0784561230','colombo10',1.582100,1.234500,'galadari@gmail.com',1,1),('H-2','cinamon','0712345678','negombo',1.582100,1.234500,'cinamon@gmail.com',0,0);

/*Table structure for table `information` */

DROP TABLE IF EXISTS `information`;

CREATE TABLE `information` (
  `information_id` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `info` longtext NOT NULL,
  PRIMARY KEY (`information_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `information` */

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `location_id` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lattitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `guide` int(1) NOT NULL,
  `duration` int(2) NOT NULL,
  `ticket` int(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `location` */

/*Table structure for table `pictures` */

DROP TABLE IF EXISTS `pictures`;

CREATE TABLE `pictures` (
  `id` varchar(20) NOT NULL,
  `pic_id` varchar(40) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pictures` */

/*Table structure for table `rating` */

DROP TABLE IF EXISTS `rating`;

CREATE TABLE `rating` (
  `id` varchar(20) NOT NULL,
  `stars` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rating` */

/*Table structure for table `restaurant` */

DROP TABLE IF EXISTS `restaurant`;

CREATE TABLE `restaurant` (
  `restaurant_id` varchar(20) NOT NULL DEFAULT 'R-1',
  `name` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `lattitude` float(10,6) NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `restaurant` */

insert  into `restaurant`(`restaurant_id`,`name`,`contact`,`address`,`lattitude`,`longitude`,`email`) values ('R-25','sunil','0112608198','colombo',1.235600,1.456900,'vimukthi@gmail.com'),('R-26','nihal','0111234567','perera',1.235600,1.234500,'nihal@gmail.com');

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `location_id` varchar(20) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `ticket_id` varchar(20) NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ticket` */

/*Table structure for table `transport` */

DROP TABLE IF EXISTS `transport`;

CREATE TABLE `transport` (
  `transport_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`transport_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transport` */

insert  into `transport`(`transport_id`,`name`,`contact`,`address`,`email`) values ('C-1','sls cabs','7894561230','piliyandala','sls@yahoo.com'),('C-2','rbc cabs','7845698201','nugegoda','rbc@yahoo.com'),('C-3','hms','0441234560','matara','hms@gmail.com');

/*Table structure for table `traveller` */

DROP TABLE IF EXISTS `traveller`;

CREATE TABLE `traveller` (
  `nic` varchar(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `country` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `traveller_id` varchar(20) NOT NULL,
  PRIMARY KEY (`email`,`traveller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `traveller` */

insert  into `traveller`(`nic`,`first_name`,`last_name`,`country`,`email`,`contact`,`traveller_id`) values ('914567891v','buddika','alwis','America','alwissaranga@yahoo.com','2147483647','T-3'),('987456123','kasun','tharindu','America','kasun@gmail.com','0114567893','T-6'),('904561234v','udayanga','senarathna','Australia','udayanag@gmail.com','0115647892','T-5'),('931340034v','vimukthi','saranga','Sri Lanka','v.saranga@yahoo.com','0711790372','T-4');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*Table structure for table `vehicle` */

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle` (
  `vehicle_id` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `type` varchar(40) NOT NULL,
  `passengers` int(3) NOT NULL,
  `model` varchar(20) NOT NULL,
  `comfort` varchar(10) NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vehicle` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
