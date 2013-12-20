/*
SQLyog Ultimate v8.53 
MySQL - 5.5.16 : Database - bouts_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bouts_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bouts_db`;

/*Table structure for table `perspectiva` */

DROP TABLE IF EXISTS `perspectiva`;

CREATE TABLE `perspectiva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perspectiva` varchar(50) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `perspectiva` */

LOCK TABLES `perspectiva` WRITE;

insert  into `perspectiva`(`id`,`perspectiva`,`descricao`) values (1,'0','perfil 0ºGraus'),(2,'45','perfil 45ºGraus'),(3,'270','perfil frente 270ºGraus'),(4,'145','perfil 145ºGraus'),(5,'90','perfil sola 90ºGraus');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
