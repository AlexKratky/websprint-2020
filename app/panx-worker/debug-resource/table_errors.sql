CREATE TABLE `debug_errors` (
	`ID` INT(11) NOT NULL AUTO_INCREMENT,
	`ERR_LEVEL` ENUM('ERROR','WARNING','NOTICE','OTHER') NULL DEFAULT 'OTHER' COLLATE 'utf8mb4_bin',
	`ERR_MESSAGE` TEXT NULL COLLATE 'utf8mb4_bin',
	`ERR_FILE` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_bin',
	`ERR_LINE` INT(11) NULL DEFAULT '0',
	`CREATED_AT` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ID`)
)
COLLATE='utf8mb4_bin'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
