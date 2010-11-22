SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cpwebv3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cpwebv3` ;

-- -----------------------------------------------------
-- Table `cpwebv3`.`advogados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`advogados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `oab` INT(11) NOT NULL ,
  `nome` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`comarcas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`comarcas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_processos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`fases`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`fases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`instancias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`instancias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`naturezas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`naturezas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_partes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_partes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`estados`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`estados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `uf` VARCHAR(2) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`cidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`cidades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `estado_id` INT(11) NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cidades_estados1` (`estado_id` ASC) ,
  CONSTRAINT `fk_cidades_estados1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `cpwebv3`.`estados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`clientes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`clientes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `tipo_cliente` TINYINT(1) NOT NULL ,
  `cnpj` VARCHAR(14) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `cpf` VARCHAR(11) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `endereco` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `cidade_id` INT(11) NOT NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_clientes_cidades1` (`cidade_id` ASC) ,
  CONSTRAINT `fk_clientes_cidades1`
    FOREIGN KEY (`cidade_id` )
    REFERENCES `cpwebv3`.`cidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`modelos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`modelos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `nome` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`processos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `distribuicao` DATE NOT NULL ,
  `cliente_id` INT(11) NOT NULL ,
  `tipo_parte_id` INT(11) NOT NULL ,
  `parte_contraria` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `advogado_id` INT(11) NOT NULL ,
  `comarca_id` INT(11) NOT NULL ,
  `fase_id` INT(11) NOT NULL ,
  `instancia_id` INT(11) NOT NULL ,
  `natureza_id` INT(11) NOT NULL ,
  `status_id` INT(11) NOT NULL ,
  `tipo_processo_id` INT(11) NOT NULL ,
  `modelos_id` INT NOT NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_processos_comarcas1` (`comarca_id` ASC) ,
  INDEX `fk_processos_status1` (`status_id` ASC) ,
  INDEX `fk_processos_advogados1` (`advogado_id` ASC) ,
  INDEX `fk_processos_tipos_processos1` (`tipo_processo_id` ASC) ,
  INDEX `fk_processos_fases1` (`fase_id` ASC) ,
  INDEX `fk_processos_instancias1` (`instancia_id` ASC) ,
  INDEX `fk_processos_naturezas1` (`natureza_id` ASC) ,
  INDEX `fk_processos_tipos_partes1` (`tipo_parte_id` ASC) ,
  INDEX `fk_processos_clientes1` (`cliente_id` ASC) ,
  INDEX `fk_processos_modelos1` (`modelos_id` ASC) ,
  CONSTRAINT `fk_processos_comarcas1`
    FOREIGN KEY (`comarca_id` )
    REFERENCES `cpwebv3`.`comarcas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `cpwebv3`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_advogados1`
    FOREIGN KEY (`advogado_id` )
    REFERENCES `cpwebv3`.`advogados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_tipos_processos1`
    FOREIGN KEY (`tipo_processo_id` )
    REFERENCES `cpwebv3`.`tipos_processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_fases1`
    FOREIGN KEY (`fase_id` )
    REFERENCES `cpwebv3`.`fases` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_instancias1`
    FOREIGN KEY (`instancia_id` )
    REFERENCES `cpwebv3`.`instancias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_naturezas1`
    FOREIGN KEY (`natureza_id` )
    REFERENCES `cpwebv3`.`naturezas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_tipos_partes1`
    FOREIGN KEY (`tipo_parte_id` )
    REFERENCES `cpwebv3`.`tipos_partes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_clientes1`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `cpwebv3`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_modelos1`
    FOREIGN KEY (`modelos_id` )
    REFERENCES `cpwebv3`.`modelos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_audiencias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_audiencias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`audiencias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`audiencias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `tipo_audiencia_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `advogado_id` INT(11) NOT NULL ,
  `iscancelada` TINYINT(1) NOT NULL DEFAULT '0' ,
  `data` DATE NOT NULL ,
  `hora` TIME NOT NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_audiencias_advogados1` (`advogado_id` ASC) ,
  INDEX `fk_audiencias_processos1` (`processo_id` ASC) ,
  INDEX `fk_audiencias_tipos_audiencias1` (`tipo_audiencia_id` ASC) ,
  CONSTRAINT `fk_audiencias_advogados1`
    FOREIGN KEY (`advogado_id` )
    REFERENCES `cpwebv3`.`advogados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_audiencias_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_audiencias_tipos_audiencias1`
    FOREIGN KEY (`tipo_audiencia_id` )
    REFERENCES `cpwebv3`.`tipos_audiencias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`eventos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`eventos` (
  `id` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `data` DATE NOT NULL ,
  `evento` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_movimentos_processos1` (`processo_id` ASC) ,
  CONSTRAINT `fk_movimentos_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_numeros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_numeros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL DEFAULT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`numeros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`numeros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `tipo_numero_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `instancia` INT(1) NOT NULL ,
  `numero` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_numeros_tipos_numeros1` (`tipo_numero_id` ASC) ,
  INDEX `fk_numeros_processos1` (`processo_id` ASC) ,
  CONSTRAINT `fk_numeros_tipos_numeros1`
    FOREIGN KEY (`tipo_numero_id` )
    REFERENCES `cpwebv3`.`tipos_numeros` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_numeros_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`orgaos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`orgaos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`orgaos_processos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`orgaos_processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `orgao_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_orgaos_processos_processos1` (`processo_id` ASC) ,
  INDEX `join_orgaos_processos-orgaos` (`orgao_id` ASC) ,
  CONSTRAINT `fk_orgaos_processos_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `join_orgaos_processos-orgaos`
    FOREIGN KEY (`orgao_id` )
    REFERENCES `cpwebv3`.`orgaos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`telefones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`telefones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `cliente_id` INT(11) NOT NULL ,
  `ddd` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `telefone` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `contato` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_telefones_clientes` (`cliente_id` ASC) ,
  CONSTRAINT `fk_telefones_clientes`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `cpwebv3`.`clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_solicitacoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`solicitacoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `tipo_solicitacao_id` INT(11) NOT NULL ,
  `parent_code` INT(5) NOT NULL ,
  `children_code` INT(5) NOT NULL ,
  `solicitacao` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_solicitacoes_tipos_solicitacoes1` (`tipo_solicitacao_id` ASC) ,
  CONSTRAINT `fk_solicitacoes_tipos_solicitacoes1`
    FOREIGN KEY (`tipo_solicitacao_id` )
    REFERENCES `cpwebv3`.`tipos_solicitacoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`processos_solicitacoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`processos_solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `solicitacao_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_processos_solicitacoes_solicitacoes1` (`solicitacao_id` ASC) ,
  INDEX `fk_processos_solicitacoes_processos1` (`processo_id` ASC) ,
  CONSTRAINT `fk_processos_solicitacoes_solicitacoes1`
    FOREIGN KEY (`solicitacao_id` )
    REFERENCES `cpwebv3`.`solicitacoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`teses`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`teses` (
  `id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `filename` VARCHAR(100) NULL ,
  `nome` VARCHAR(45) NULL ,
  `modelos_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_teses_modelos1` (`modelos_id` ASC) ,
  CONSTRAINT `fk_teses_modelos1`
    FOREIGN KEY (`modelos_id` )
    REFERENCES `cpwebv3`.`modelos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`checklists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`checklists` (
  `id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `teses_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_checklists_teses1` (`teses_id` ASC) ,
  CONSTRAINT `fk_checklists_teses1`
    FOREIGN KEY (`teses_id` )
    REFERENCES `cpwebv3`.`teses` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`itens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`itens` (
  `id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `nome` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `login` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(99) NOT NULL ,
  `email` VARCHAR(99) NOT NULL ,
  `ativo` INT(1) NOT NULL ,
  `aniversario` VARCHAR(5) NOT NULL ,
  `ultimo_acesso` DATETIME NOT NULL ,
  `acessos` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_login` (`login` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`eventos_acordo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`eventos_acordo` (
  `id` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `evento` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_movimentos_processos1` (`processo_id` ASC) ,
  CONSTRAINT `fk_movimentos_processos10`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`perfis`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`perfis` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'tabela de perfis';


-- -----------------------------------------------------
-- Table `cpwebv3`.`usuarios_perfis`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cpwebv3`.`usuarios_perfis` (
  `usuarios_id` INT NOT NULL ,
  `perfis_id` INT NOT NULL ,
  PRIMARY KEY (`usuarios_id`, `perfis_id`) ,
  INDEX `fk_usuarios_has_perfis_perfis1` (`perfis_id` ASC) ,
  CONSTRAINT `fk_usuarios_has_perfis_usuarios1`
    FOREIGN KEY (`usuarios_id` )
    REFERENCES `cpwebv3`.`usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_perfis_perfis1`
    FOREIGN KEY (`perfis_id` )
    REFERENCES `cpwebv3`.`perfis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
