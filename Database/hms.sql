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
  `area` varchar(20) NOT NULL,
  PRIMARY KEY (`guide_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `guide` */

insert  into `guide`(`guide_id`,`nic`,`first_name`,`last_name`,`email`,`contact`,`address`,`area`) values ('G-1','789456123v','rajitha','senarathna','admin@esoft.lk','0784561230','gampaha','gampaha');

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
  `area` varchar(20) NOT NULL,
  PRIMARY KEY (`hotel_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `hotel` */

insert  into `hotel`(`hotel_id`,`name`,`contact`,`address`,`latitude`,`longitude`,`email`,`guide`,`transport`,`area`) values ('H-1','asdf','01123456','sasbj',1.230000,1.250000,'ksaak',1,0,'kottawa'),('H-2','mitsubishi','0784561230','kottawa',1.324500,1.045600,'wb@gmail.com',0,1,'kottawa');

/*Table structure for table `information` */

DROP TABLE IF EXISTS `information`;

CREATE TABLE `information` (
  `information_id` varchar(20) NOT NULL,
  `hotel_id` varchar(20) NOT NULL,
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
  `description` longtext,
  `area` varchar(20) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`location_id`,`name`,`lattitude`,`longitude`,`guide`,`duration`,`ticket`,`type`,`description`,`area`) values ('L-1','gale fort',1.123450,1.235600,0,1,1,'safari','best','galle'),('L-2','unawatuna',1.234500,1.236500,1,0,1,'beach','good','galle'),('L-3','trincomalee',1.234500,1.235600,0,1,1,'beach','better','trinco');

/*Table structure for table `package` */

DROP TABLE IF EXISTS `package`;

CREATE TABLE `package` (
  `package_id` varchar(50) NOT NULL,
  `location_id` varchar(20) NOT NULL,
  `hotel_id` varchar(20) NOT NULL,
  `guide_id` varchar(20) NOT NULL,
  `transport_id` varchar(20) NOT NULL,
  `vehicle_id` varchar(20) NOT NULL,
  `package_budget` int(10) NOT NULL,
  `package_duration` int(10) NOT NULL,
  `package_rating` int(2) NOT NULL,
  `primary_key` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`primary_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `package` */

insert  into `package`(`package_id`,`location_id`,`hotel_id`,`guide_id`,`transport_id`,`vehicle_id`,`package_budget`,`package_duration`,`package_rating`,`primary_key`) values ('Galle Tour','L-1','H-1','G-1','C-1','V-1',9000,3,6,1),('Galle Tour','L-2','H-2','G-2','C-2','V-2',9000,3,6,2),('Trinco','L-3','H-3','G-3','C-3','V-3',8000,2,7,3);

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
  `area` varchar(20) NOT NULL,
  PRIMARY KEY (`restaurant_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `restaurant` */

insert  into `restaurant`(`restaurant_id`,`name`,`contact`,`address`,`lattitude`,`longitude`,`email`,`area`) values ('R-1','galadari','119','kottawa',1.235600,1.025300,'r@gmail.com','colombo');

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `location_id` varchar(20) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `ticket_id` varchar(20) NOT NULL,
  `country` int(1) NOT NULL,
  `age` int(1) NOT NULL,
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

insert  into `transport`(`transport_id`,`name`,`contact`,`address`,`email`) values ('C-1','sls cabs','7894561230','piliyandala','sls@yahoo.com'),('C-2','rcb cabs','0456789456','nugegoda','g@gmail.com');

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

insert  into `traveller`(`nic`,`first_name`,`last_name`,`country`,`email`,`contact`,`traveller_id`) values ('914567891v','buddika','alwis','America','alwissaranga@yahoo.com','2147483647','T-3'),('987456123','kasun','tharindu','America','kasun@gmail.com','0114567893','T-6'),('904561234v','somapala','sumanasiri','srilanka','supun@striking.lk','0111234567','T-7'),('904561234v','udayanga','senarathna','Australia','udayanag@gmail.com','0115647892','T-5'),('931340034v','vimukthi','saranga','Sri Lanka','v.saranga@yahoo.com','0711790372','T-4');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`email`,`password`,`type`) values ('admin@esoft.lk','145','guide'),('g@gmail.com','456','transport'),('r@gmail.com','145','restaurant'),('supun@striking.lk','Password',''),('v.saranga@yahoo.com','0112608198',''),('wb@gmail.com','789','hotel');

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
