CREATE TABLE `api_keys` (
	`ID` INT(11) NOT NULL AUTO_INCREMENT,
	`API_KEY` VARCHAR(32) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_bin',
	`RATE_LIMIT` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`RATE_LIMIT_MONTHLY` INT(11) UNSIGNED NOT NULL DEFAULT '10000',
	`RATE_LIMIT_DAILY_CURRENT` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`RATE_LIMIT_DAILY` INT(11) UNSIGNED NOT NULL DEFAULT '1000',
	`RATE_LIMIT_WEEKLY_CURRENT` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`RATE_LIMIT_WEEKLY` INT(11) UNSIGNED NOT NULL DEFAULT '5000',
	`RATE_LIMIT_TOTAL` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ID`),
	UNIQUE INDEX `API_KEY` (`API_KEY`)
)
COLLATE='utf8mb4_bin'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
