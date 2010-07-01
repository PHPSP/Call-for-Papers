SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cfp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

-- -----------------------------------------------------
-- Table `cfp`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `password` CHAR(40) NOT NULL ,
  `fbid` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `group_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`email` ASC) ,
  INDEX `fk_users_groups` (`group_id` ASC) ,
  CONSTRAINT `fk_users_groups`
    FOREIGN KEY (`group_id` )
    REFERENCES `cfp`.`groups` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`speakers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`speakers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `rg` VARCHAR(100) NOT NULL ,
  `abstract` TEXT NOT NULL ,
  `description` TEXT NULL ,
  `zip` VARCHAR(45) NOT NULL ,
  `country` VARCHAR(255) NOT NULL DEFAULT 'Brazil' ,
  `city` VARCHAR(255) NOT NULL ,
  `state` VARCHAR(255) NOT NULL ,
  `address` VARCHAR(255) NOT NULL ,
  `complement` VARCHAR(100) NULL ,
  `twitter` VARCHAR(100) NULL ,
  `site` VARCHAR(255) NULL ,
  `size` ENUM('M','G','GG','XG','XGG') NULL COMMENT 'T-shirt size' ,
  `image` VARCHAR(100) NULL ,
  `phone` VARCHAR(45) NULL ,
  `phone2` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_speakers_users` (`user_id` ASC) ,
  CONSTRAINT `fk_speakers_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `cfp`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`areas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`areas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`proposals`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`proposals` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `speaker_id` INT NOT NULL ,
  `area_id` INT NOT NULL ,
  `title` VARCHAR(155) NOT NULL ,
  `abstract` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `after` TEXT NOT NULL COMMENT 'After the session, what will the attendee learn?' ,
  `level` ENUM('B','I','A') NOT NULL DEFAULT 'B' COMMENT 'Begginer, Intermediate, Advanced' ,
  `time` INT NOT NULL COMMENT 'In minutes' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_proposals_speakers` (`speaker_id` ASC) ,
  INDEX `fk_proposals_areas` (`area_id` ASC) ,
  CONSTRAINT `fk_proposals_speakers`
    FOREIGN KEY (`speaker_id` )
    REFERENCES `cfp`.`speakers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_proposals_areas`
    FOREIGN KEY (`area_id` )
    REFERENCES `cfp`.`areas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`acos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`acos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `parent_id` INT NULL ,
  `model` VARCHAR(255) NULL ,
  `foreign_key` INT NULL ,
  `alias` VARCHAR(255) NULL ,
  `lft` INT NULL ,
  `rght` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_acos_acos` (`parent_id` ASC) ,
  CONSTRAINT `fk_acos_acos`
    FOREIGN KEY (`parent_id` )
    REFERENCES `cfp`.`acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`aros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`aros` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `parent_id` INT NULL ,
  `model` VARCHAR(255) NULL ,
  `foreign_key` INT NULL ,
  `alias` VARCHAR(255) NULL ,
  `lft` INT NULL ,
  `rght` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_acos_acos1` (`parent_id` ASC) ,
  CONSTRAINT `fk_aros_aros`
    FOREIGN KEY (`parent_id` )
    REFERENCES `cfp`.`aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`acos_aros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`acos_aros` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `aco_id` INT NOT NULL ,
  `aro_id` INT NOT NULL ,
  `_create` VARCHAR(2) NOT NULL ,
  `_read` VARCHAR(2) NOT NULL ,
  `_update` VARCHAR(2) NOT NULL ,
  `_delete` VARCHAR(2) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_acos_has_aros_acos` (`aco_id` ASC) ,
  INDEX `fk_acos_has_aros_aros` (`aro_id` ASC) ,
  CONSTRAINT `fk_acos_has_aros_acos`
    FOREIGN KEY (`aco_id` )
    REFERENCES `cfp`.`acos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acos_has_aros_aros`
    FOREIGN KEY (`aro_id` )
    REFERENCES `cfp`.`aros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`i18n`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`i18n` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `locale` VARCHAR(6) NOT NULL ,
  `model` VARCHAR(255) NOT NULL ,
  `foreign_key` INT NOT NULL ,
  `field` VARCHAR(255) NOT NULL ,
  `content` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`criterias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`criterias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `multiplier` INT UNSIGNED NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`evaluations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`evaluations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `proposal_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_evaluations_users1` (`user_id` ASC) ,
  INDEX `fk_evaluations_proposals1` (`proposal_id` ASC) ,
  CONSTRAINT `fk_evaluations_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `cfp`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluations_proposals1`
    FOREIGN KEY (`proposal_id` )
    REFERENCES `cfp`.`proposals` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cfp`.`criterias_evaluations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cfp`.`criterias_evaluations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `criteria_id` INT NOT NULL ,
  `evaluation_id` INT NOT NULL ,
  `value` INT NOT NULL ,
  PRIMARY KEY (`id`, `criteria_id`, `evaluation_id`) ,
  INDEX `fk_criterias_has_evaluations_criterias1` (`criteria_id` ASC) ,
  INDEX `fk_criterias_has_evaluations_evaluations1` (`evaluation_id` ASC) ,
  CONSTRAINT `fk_criterias_has_evaluations_criterias1`
    FOREIGN KEY (`criteria_id` )
    REFERENCES `cfp`.`criterias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_criterias_has_evaluations_evaluations1`
    FOREIGN KEY (`evaluation_id` )
    REFERENCES `cfp`.`evaluations` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
