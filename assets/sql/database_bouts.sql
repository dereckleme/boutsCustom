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

/*Table structure for table `custom` */

DROP TABLE IF EXISTS `custom`;

CREATE TABLE `custom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idperspectiva` int(11) NOT NULL,
  `idtennis` int(11) NOT NULL,
  `idtipocustom` int(11) DEFAULT NULL,
  `posicao_x` varchar(20) DEFAULT NULL,
  `posicao_y` varchar(20) DEFAULT NULL,
  `cod_materia_prima` varchar(20) DEFAULT NULL,
  `desc_materia_prima` varchar(30) DEFAULT NULL,
  `num_componente` int(11) NOT NULL,
  `desc_componente` varchar(30) DEFAULT NULL,
  `num_desc_componente_forro_colarinho` varchar(30) DEFAULT NULL,
  `num_desc_componente_forro_pala` varchar(30) DEFAULT NULL,
  `num_desc_componente` tinytext,
  `cod_etiqueta_pala` varchar(20) DEFAULT NULL,
  `desc_etiqueta_pala` varchar(30) DEFAULT NULL,
  `num_componente_etiqueta_pala` int(11) DEFAULT NULL,
  `desc_componente_etiqueta_pala` varchar(30) DEFAULT NULL,
  `imagem_custom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_FKIndex2` (`idtennis`),
  KEY `custom_FKIndex1` (`idperspectiva`),
  KEY `custom_FKIndex3` (`idtipocustom`),
  CONSTRAINT `custom_FKIndex1` FOREIGN KEY (`idperspectiva`) REFERENCES `perspectiva` (`id`),
  CONSTRAINT `custom_FKIndex2` FOREIGN KEY (`idtennis`) REFERENCES `tennis` (`id`),
  CONSTRAINT `custom_FKIndex3` FOREIGN KEY (`idtipocustom`) REFERENCES `tipo_custom` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `modelo` */

DROP TABLE IF EXISTS `modelo`;

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `image_default` varchar(100) DEFAULT NULL,
  `slug_modelo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `perspectiva` */

DROP TABLE IF EXISTS `perspectiva`;

CREATE TABLE `perspectiva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perspectiva` varchar(50) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `svg` */

DROP TABLE IF EXISTS `svg`;

CREATE TABLE `svg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtennis` int(11) NOT NULL,
  `idperspectiva` int(11) NOT NULL,
  `svgxml` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `svg_FKIndex1` (`idtennis`),
  KEY `svg_FKIndex2` (`idperspectiva`),
  CONSTRAINT `svg_FKIndex1` FOREIGN KEY (`idtennis`) REFERENCES `tennis` (`id`),
  CONSTRAINT `svg_FKIndex2` FOREIGN KEY (`idperspectiva`) REFERENCES `perspectiva` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `tennis` */

DROP TABLE IF EXISTS `tennis`;

CREATE TABLE `tennis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmodelo` int(11) NOT NULL,
  `imagem_frente` varchar(100) DEFAULT NULL,
  `imagem_frontal` varchar(100) DEFAULT NULL,
  `imagem_vertical` varchar(100) DEFAULT NULL,
  `imagem_horizontal` varchar(100) DEFAULT NULL,
  `imagem_solo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tennis_FKIndex1` (`idmodelo`),
  CONSTRAINT `tennis_FKIndex1` FOREIGN KEY (`idmodelo`) REFERENCES `modelo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `tipo_custom` */

DROP TABLE IF EXISTS `tipo_custom`;

CREATE TABLE `tipo_custom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtennis` int(11) DEFAULT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `posicao_x` decimal(10,0) DEFAULT NULL,
  `posicao_y` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_custom_FKIndex1` (`idtennis`),
  CONSTRAINT `tipo_custom_FKIndex1` FOREIGN KEY (`idtennis`) REFERENCES `tennis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
