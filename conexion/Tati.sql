-- Table `proyecto_sena`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto_sena`.`usuarios` (
  `id` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `apellido` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `clave` VARCHAR(255) NOT NULL,
  `cedula` VARCHAR(255) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(255) NOT NULL,
  `rol` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`email` ASC));

-- Table `proyecto_sena`.`pqr`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto_sena`.`pqr` (
  `id` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(255) NOT NULL,
  `texto` TEXT(500) NULL DEFAULT NULL,
  `respuesta` TEXT(500) NULL DEFAULT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuarios_id`),
  INDEX `fk_pqr_usuarios_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_pqr_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `proyecto_sena`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- Table `proyecto_sena`.`catalogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proyecto_sena`.`catalogo` (
  `id` INT NULL DEFAULT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuarios_id`),
  INDEX `fk_catalogo_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_catalogo_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `proyecto_sena`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
