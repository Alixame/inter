
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura para procedure db_ecommerce.sp_userspasswordsrecoveries_create
DELIMITER //
CREATE PROCEDURE `sp_userspasswordsrecoveries_create`(
piduser INT,
pdesip VARCHAR(45)
)
BEGIN
  
  INSERT INTO tb_userspasswordsrecoveries (iduser, desip)
    VALUES(piduser, pdesip);
    
    SELECT * FROM tb_userspasswordsrecoveries
    WHERE idrecovery = LAST_INSERT_ID();
    
END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_usersupdate_save
DELIMITER //
CREATE PROCEDURE `sp_usersupdate_save`(
	IN `piduser` INT,
	IN `pdesperson` VARCHAR(64),
	IN `pdeslogin` VARCHAR(64),
	IN `pdespassword` VARCHAR(256),
	IN `pdesemail` VARCHAR(128),
	IN `pnrphone` VARCHAR(60),
	IN `pinadmin` TINYINT
)
BEGIN
  
    DECLARE vidperson INT;
    
  SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
    
    UPDATE tb_persons
    SET 
    desperson = pdesperson,
        desemail = pdesemail,
        nrphone = pnrphone
  WHERE idperson = vidperson;
    
    UPDATE tb_users
    SET
    deslogin = pdeslogin,
        despassword = pdespassword,
        inadmin = pinadmin
  WHERE iduser = piduser;
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = piduser;
    
END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_users_delete
DELIMITER //
CREATE PROCEDURE `sp_users_delete`(
piduser INT
)
BEGIN
  
    DECLARE vidperson INT;
    
  SELECT idperson INTO vidperson
    FROM tb_users
    WHERE iduser = piduser;
    
    DELETE FROM tb_users WHERE iduser = piduser;
    DELETE FROM tb_persons WHERE idperson = vidperson;
    
END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_users_save
DELIMITER //
CREATE PROCEDURE `sp_users_save`(
pdesperson VARCHAR(64), 
pdeslogin VARCHAR(64), 
pdespassword VARCHAR(256), 
pdesemail VARCHAR(128), 
pnrphone BIGINT, 
pinadmin TINYINT
)
BEGIN
  
    DECLARE vidperson INT;
    
  INSERT INTO tb_persons (desperson, desemail, nrphone)
    VALUES(pdesperson, pdesemail, pnrphone);
    
    SET vidperson = LAST_INSERT_ID();
    
    INSERT INTO tb_users (idperson, deslogin, despassword, inadmin)
    VALUES(vidperson, pdeslogin, pdespassword, pinadmin);
    
    SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) WHERE a.iduser = LAST_INSERT_ID();
    
END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_users_save
DELIMITER //
CREATE PROCEDURE `sp_message_save`(
pdesname VARCHAR(64), 
pnrphone varchar(30),
pdesemail VARCHAR(128),  
ptypemessage varchar(30),
pdesmessage VARCHAR(256)
)
BEGIN
  
    DECLARE vidmessage INT;
    
  INSERT INTO tb_messages (desname, nrphone, desemail, typemessage, desmessage)
    VALUES(pdesname, pnrphone, pdesemail, ptypemessage, pdesmessage);
    
    SET vidmessage = LAST_INSERT_ID();
        
	SELECT * FROM tb_messages WHERE idmessage = vidmessage;

END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `sp_message_delete`(
pidmessage INT
)
BEGIN
    
    DELETE FROM tb_messages WHERE idmessage = pidmessage;
    
END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_rooms_save
DELIMITER //
CREATE PROCEDURE `sp_rooms_save`(
pidroom INT,
pdesroom VARCHAR(64)
)
BEGIN
  IF pidroom > 0 THEN
		
		UPDATE tb_rooms
        SET desroom = pdesroom
        WHERE idroom = pidroom;
        
    ELSE
		
		INSERT INTO tb_rooms (desroom) VALUES(pdesroom);
        
        SET pidroom = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_rooms WHERE idroom = pidroom;

END//
DELIMITER ;

-- Copiando estrutura para procedure db_ecommerce.sp_devices_save
DELIMITER //
CREATE PROCEDURE `sp_devices_save`(
piddevice INT,
pdesdevice VARCHAR(64),
piduser INT
)
BEGIN
  IF piddevice > 0 THEN
		
		UPDATE tb_devices
        SET desdevice = pdesdevice
        WHERE iddevice = piddevice;
        
    ELSE
		
		INSERT INTO tb_devices (desdevice, piduser) VALUES(pdesdevice, piduser);
        
        SET piddevice = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_devices WHERE iddevice = piddevice;

END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
