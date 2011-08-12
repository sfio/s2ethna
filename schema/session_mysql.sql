CREATE TABLE `session` (
       `id` VARCHAR(255) NOT NULL
     , `sess_data` TEXT
     , `remote_addr` VARCHAR(255)
     , `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
     , PRIMARY KEY (`id`)
);

