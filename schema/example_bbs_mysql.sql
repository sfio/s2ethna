CREATE TABLE `bbs` (
       `id` INT NOT NULL AUTO_INCREMENT
     , `date` TIMESTAMP
     , `name` VARCHAR(255)
     , `email` VARCHAR(255)
     , `subject` VARCHAR(255)
     , `body` TEXT
     , `password` VARCHAR(8)
     , `host` VARCHAR(40)
     , PRIMARY KEY (`id`)
);

