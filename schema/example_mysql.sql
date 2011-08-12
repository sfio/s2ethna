CREATE TABLE `cd` (
       `ID` INT NOT NULL
     , `TITLE` VARCHAR(100)
     , `CONTENT` VARCHAR(200)
     , PRIMARY KEY (`ID`)
)TYPE=InnoDB;

CREATE TABLE `shelf` (
       `ID` INT NOT NULL AUTO_INCREMENT
     , `CD_ID` INT NOT NULL
     , `ADD_TIME` DATETIME DEFAULT '2005-12-25 10:12:13'
     , PRIMARY KEY (`ID`, `CD_ID`)
     , INDEX (`CD_ID`)
     , CONSTRAINT `FK_shelf_1` FOREIGN KEY (`CD_ID`)
                  REFERENCES `cd` (`ID`)
)TYPE=InnoDB;

INSERT INTO `cd` ( ID, CONTENT, TITLE )
VALUES ( 1, 'hello!!', 'S2Dao!!!' ) ;
INSERT INTO `shelf` ( CD_ID, ADD_TIME )
VALUES ( 1, '2005-12-18 10:12:34' ) ;

