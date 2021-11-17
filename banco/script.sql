
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura do banco de dados para db_automacao
CREATE DATABASE IF NOT EXISTS `db_automacao` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_automacao`;

-- Copiando estrutura para tabela db_automacao.tb_persons
DROP TABLE IF EXISTS `db_automacao`.`tb_persons`;

CREATE TABLE IF NOT EXISTS `tb_persons` (
  `idperson` int(11) NOT NULL AUTO_INCREMENT,
  `desperson` VARCHAR(64) NOT NULL,
  `desemail` VARCHAR(128) DEFAULT NULL,
  `nrphone` VARCHAR(50) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idperson`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela db_automacao.tb_users
DROP TABLE IF EXISTS `db_automacao`.`tb_users`;

CREATE TABLE IF NOT EXISTS `tb_users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `idperson` int(11) NOT NULL,
  `deslogin` VARCHAR(64) NOT NULL,
  `despassword` VARCHAR(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL DEFAULT '0',
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`iduser`),
  KEY `FK_users_persons_idx` (`idperson`),
  CONSTRAINT `fk_users_persons` FOREIGN KEY (`idperson`) REFERENCES `tb_persons` (`idperson`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela db_automacao.tb_userspasswordsrecoveries
DROP TABLE IF EXISTS `db_automacao`.`tb_userspasswordsrecoveries`;

CREATE TABLE IF NOT EXISTS `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `desip` VARCHAR(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idrecovery`),
  KEY `fk_userspasswordsrecoveries_users_idx` (`iduser`),
  CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela db_automacao.tb_userspasswordsrecoveries
DROP TABLE IF EXISTS `db_automacao`.`tb_messages`;

CREATE TABLE IF NOT EXISTS `tb_messages` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `desname` VARCHAR(64) NOT NULL, 
  `nrphone` VARCHAR(30) NOT NULL,
  `desemail` VARCHAR(128) NOT NULL,  
  `typemessage` VARCHAR(30) NOT NULL,
  `desmessage` VARCHAR(256) NOT NULL,
  `responsed` tinyint(4) NOT NULL DEFAULT '0',
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_automacao.tb_rooms
DROP TABLE IF EXISTS `db_automacao`.`tb_rooms`;

CREATE TABLE IF NOT EXISTS `tb_rooms` (
  `idroom` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `desroom` VARCHAR(64) NOT NULL, 
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para tabela db_automacao.tb_devices
DROP TABLE IF EXISTS `db_automacao`.`tb_devices`;

CREATE TABLE IF NOT EXISTS `tb_devices` (
  `iddevice` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `desdevice` VARCHAR(64) NOT NULL, 
  `deson` tinyint DEFAULT "0",
  `pin_A` bigint,
  `iduser` int(11) NOT NULL,
  `idroom` int(11) DEFAULT "0",
  CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_idroom` FOREIGN KEY (`idroom`) REFERENCES `tb_rooms` (`idroom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;


INSERT INTO `db_automacao`.`tb_persons` VALUES (1,'Administrador','admin@lumira.com.br','17992162676','2017-03-01 03:00:00'),(7,'Suporte','suporte@lumira.com.br','17992162676','2017-03-15 16:10:27');

INSERT INTO `db_automacao`.`tb_users` VALUES (1,1,'admin','$2y$12$YlooCyNvyTji8bPRcrfNfOKnVMmZA9ViM2A3IpFjmrpIbp5ovNmga',1,'2017-03-13 03:00:00'),(7,7,'suporte','$2y$12$YlooCyNvyTji8bPRcrfNfOKnVMmZA9ViM2A3IpFjmrpIbp5ovNmga',1,'2017-03-15 16:10:27');

INSERT INTO `db_automacao`.`tb_userspasswordsrecoveries` VALUES (1,7,'127.0.0.1',NULL,'2017-03-15 16:10:59'),(2,7,'127.0.0.1','2017-03-15 13:33:45','2017-03-15 16:11:18'),(3,7,'127.0.0.1','2017-03-15 13:37:35','2017-03-15 16:37:12');
