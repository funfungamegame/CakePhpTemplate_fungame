DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `id` INT NOT NULL,
  `name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

INSERT INTO classes VALUE ('1','Druid'),('2','Hunter'),('3','Magic'),('4','Paladin'),('5','Priest'),('6','Rough'),('7','Shaman'),('8','Warlock'),('9','Warrior');