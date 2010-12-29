SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cpwebv3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cpwebv3` ;

-- -----------------------------------------------------
-- Table `cpwebv3`.`advogados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`advogados` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`comarcas` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`status` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_processos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`tipos_processos` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`fases` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`instancias` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`naturezas` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`tipos_partes` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`estados` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`cidades` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`clientes` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`modelos` ;

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
-- Table `cpwebv3`.`advogados_contrarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`advogados_contrarios` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`advogados_contrarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `oab` INT(11) NOT NULL ,
  `nome` VARCHAR(200) NOT NULL ,
  `e-mail` VARCHAR(99) NULL ,
  `obs` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`orgaos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`orgaos` ;

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
-- Table `cpwebv3`.`segmentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`segmentos` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`segmentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`equipes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`equipes` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`equipes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`gestoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`gestoes` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`gestoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`processos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`processos` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `distribuicao` DATE NOT NULL ,
  `cliente_id` INT(11) NOT NULL ,
  `tipo_parte_id` INT(11) NOT NULL ,
  `parte_contraria` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `ordinal_orgao` INT(2) NULL ,
  `orgao_id` INT(11) NOT NULL ,
  `advogado_contrario_id` INT(11) NOT NULL ,
  `advogado_id` INT(11) NOT NULL ,
  `comarca_id` INT(11) NOT NULL ,
  `fase_id` INT(11) NOT NULL ,
  `instancia_id` INT(11) NOT NULL ,
  `natureza_id` INT(11) NOT NULL ,
  `status_id` INT(11) NOT NULL ,
  `tipo_processo_id` INT(11) NOT NULL ,
  `modelos_id` INT NOT NULL ,
  `segmento_id` INT(11) NULL ,
  `equipe_id` INT(11) NULL ,
  `gestao_id` INT(11) NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `numero` VARCHAR(30) NOT NULL ,
  `numero_auxiliar` VARCHAR(30) NOT NULL ,
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
  INDEX `fk_processos_advogados_contrarios1` (`advogado_contrario_id` ASC) ,
  INDEX `fk_processos_orgaos1` (`orgao_id` ASC) ,
  INDEX `fk_processos_segmentos1` (`segmento_id` ASC) ,
  INDEX `fk_processos_equipes1` (`equipe_id` ASC) ,
  INDEX `i_numero` (`numero` ASC) ,
  INDEX `i_numero_auxiliar` (`numero_auxiliar` ASC) ,
  INDEX `fk_processos_gestoes1` (`gestao_id` ASC) ,
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
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_advogados_contrarios1`
    FOREIGN KEY (`advogado_contrario_id` )
    REFERENCES `cpwebv3`.`advogados_contrarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_orgaos1`
    FOREIGN KEY (`orgao_id` )
    REFERENCES `cpwebv3`.`orgaos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_segmentos1`
    FOREIGN KEY (`segmento_id` )
    REFERENCES `cpwebv3`.`segmentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_equipes1`
    FOREIGN KEY (`equipe_id` )
    REFERENCES `cpwebv3`.`equipes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_gestoes1`
    FOREIGN KEY (`gestao_id` )
    REFERENCES `cpwebv3`.`gestoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_audiencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`tipos_audiencias` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`audiencias` ;

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
DROP TABLE IF EXISTS `cpwebv3`.`eventos` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`eventos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
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
-- Table `cpwebv3`.`numeros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`numeros` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`numeros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `tipo_numero_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `instancia` INT(1) NOT NULL ,
  `numero` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_numeros_processos1` (`processo_id` ASC) ,
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
-- Table `cpwebv3`.`telefones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`telefones` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`telefones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `cliente_id` INT(11) NOT NULL ,
  `ddd` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `telefone` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `ramal` VARCHAR(4) NOT NULL ,
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
-- Table `cpwebv3`.`destinos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`destinos` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`destinos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`solicitacoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`solicitacoes` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `solicitacao` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `destino_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_solicitacoes_destinos1` (`destino_id` ASC) ,
  CONSTRAINT `fk_solicitacoes_destinos1`
    FOREIGN KEY (`destino_id` )
    REFERENCES `cpwebv3`.`destinos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_peticoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`tipos_peticoes` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_peticoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`tipos_pareceres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`tipos_pareceres` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`tipos_pareceres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`complexidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`complexidades` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`complexidades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`processos_solicitacoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`processos_solicitacoes` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`processos_solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `solicitacao_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `data_atendimento` DATETIME NULL ,
  `data_fechamento` DATETIME NULL ,
  `finalizada` TINYINT(1)  NULL ,
  `destino_id` INT(11) NOT NULL ,
  `tipo_peticao_id` INT(11) NOT NULL ,
  `tipo_parecer_id` INT(11) NOT NULL ,
  `complexidade_id` INT(11) NOT NULL ,
  `ispeticao` TINYINT(1)  NULL ,
  `isparecer` TINYINT(1)  NULL ,
  `obs` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_processos_solicitacoes_solicitacoes1` (`solicitacao_id` ASC) ,
  INDEX `fk_processos_solicitacoes_processos1` (`processo_id` ASC) ,
  INDEX `fk_processos_solicitacoes_destinos1` (`destino_id` ASC) ,
  INDEX `fk_processos_solicitacoes_tipos_peticoes1` (`tipo_peticao_id` ASC) ,
  INDEX `fk_processos_solicitacoes_tipos_pareceres1` (`tipo_parecer_id` ASC) ,
  INDEX `fk_processos_solicitacoes_complexidades1` (`complexidade_id` ASC) ,
  CONSTRAINT `fk_processos_solicitacoes_solicitacoes1`
    FOREIGN KEY (`solicitacao_id` )
    REFERENCES `cpwebv3`.`solicitacoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `cpwebv3`.`processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_destinos1`
    FOREIGN KEY (`destino_id` )
    REFERENCES `cpwebv3`.`destinos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_tipos_peticoes1`
    FOREIGN KEY (`tipo_peticao_id` )
    REFERENCES `cpwebv3`.`tipos_peticoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_tipos_pareceres1`
    FOREIGN KEY (`tipo_parecer_id` )
    REFERENCES `cpwebv3`.`tipos_pareceres` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_complexidades1`
    FOREIGN KEY (`complexidade_id` )
    REFERENCES `cpwebv3`.`complexidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`teses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`teses` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`teses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
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
DROP TABLE IF EXISTS `cpwebv3`.`checklists` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`checklists` (
  `id` INT NOT NULL AUTO_INCREMENT ,
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
DROP TABLE IF EXISTS `cpwebv3`.`itens` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`itens` (
  `id` INT NOT NULL AUTO_INCREMENT ,
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
DROP TABLE IF EXISTS `cpwebv3`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `login` VARCHAR(45) NOT NULL ,
  `nome` VARCHAR(60) NOT NULL ,
  `senha` VARCHAR(99) NOT NULL ,
  `email` VARCHAR(99) NULL ,
  `ativo` INT(1) NOT NULL ,
  `off` INT(1) NOT NULL ,
  `aniversario` VARCHAR(5) NOT NULL ,
  `ultimo_acesso` DATETIME NOT NULL ,
  `acessos` INT NOT NULL ,
  `trocasenha` TINYINT(1)  NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`eventos_acordo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`eventos_acordo` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`eventos_acordo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
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
DROP TABLE IF EXISTS `cpwebv3`.`perfis` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`perfis` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'tabela de perfis';


-- -----------------------------------------------------
-- Table `cpwebv3`.`usuarios_perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`usuarios_perfil` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`usuarios_perfil` (
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


-- -----------------------------------------------------
-- Table `cpwebv3`.`urls`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`urls` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`urls` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(200) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `i_url` (`url` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'url aonde o usuário não terá permissão de acesso';


-- -----------------------------------------------------
-- Table `cpwebv3`.`urls_perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`urls_perfil` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`urls_perfil` (
  `urls_id` INT NOT NULL ,
  `perfis_id` INT NOT NULL ,
  PRIMARY KEY (`urls_id`, `perfis_id`) ,
  INDEX `fk_urls_has_perfis_perfis1` (`perfis_id` ASC) ,
  CONSTRAINT `fk_urls_has_perfis_urls1`
    FOREIGN KEY (`urls_id` )
    REFERENCES `cpwebv3`.`urls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_urls_has_perfis_perfis1`
    FOREIGN KEY (`perfis_id` )
    REFERENCES `cpwebv3`.`perfis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `cpwebv3`.`urls_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cpwebv3`.`urls_usuario` ;

CREATE  TABLE IF NOT EXISTS `cpwebv3`.`urls_usuario` (
  `urls_id` INT NOT NULL ,
  `usuarios_id` INT NOT NULL ,
  PRIMARY KEY (`urls_id`, `usuarios_id`) ,
  INDEX `fk_urls_has_usuarios_usuarios1` (`usuarios_id` ASC) ,
  CONSTRAINT `fk_urls_has_usuarios_urls1`
    FOREIGN KEY (`urls_id` )
    REFERENCES `cpwebv3`.`urls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_urls_has_usuarios_usuarios1`
    FOREIGN KEY (`usuarios_id` )
    REFERENCES `cpwebv3`.`usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

