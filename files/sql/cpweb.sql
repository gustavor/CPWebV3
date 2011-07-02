SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `comarcas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `comarcas` ;

CREATE  TABLE IF NOT EXISTS `comarcas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `status` ;

CREATE  TABLE IF NOT EXISTS `status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_processos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_processos` ;

CREATE  TABLE IF NOT EXISTS `tipos_processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `fases`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fases` ;

CREATE  TABLE IF NOT EXISTS `fases` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `instancias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `instancias` ;

CREATE  TABLE IF NOT EXISTS `instancias` (
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
-- Table `naturezas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `naturezas` ;

CREATE  TABLE IF NOT EXISTS `naturezas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `orgaos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `orgaos` ;

CREATE  TABLE IF NOT EXISTS `orgaos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `segmentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `segmentos` ;

CREATE  TABLE IF NOT EXISTS `segmentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `equipes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `equipes` ;

CREATE  TABLE IF NOT EXISTS `equipes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `gestoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gestoes` ;

CREATE  TABLE IF NOT EXISTS `gestoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `departamentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `departamentos` ;

CREATE  TABLE IF NOT EXISTS `departamentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE  TABLE IF NOT EXISTS `usuarios` (
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
  `isadvogado` TINYINT(1)  NULL DEFAULT 0 ,
  `departamento_id` INT(11) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_departamentos1` (`departamento_id` ASC) ,
  CONSTRAINT `fk_usuarios_departamentos1`
    FOREIGN KEY (`departamento_id` )
    REFERENCES `departamentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `processos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `processos` ;

CREATE  TABLE IF NOT EXISTS `processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `distribuicao` DATE NOT NULL ,
  `ordinal_orgao` INT(2) NULL ,
  `orgao_id` INT(11) NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `comarca_id` INT(11) NOT NULL ,
  `fase_id` INT(11) NOT NULL ,
  `instancia_id` INT(11) NOT NULL ,
  `natureza_id` INT(11) NOT NULL ,
  `status_id` INT(11) NOT NULL ,
  `tipo_processo_id` INT(11) NOT NULL ,
  `segmento_id` INT(11) NULL ,
  `equipe_id` INT(11) NULL ,
  `gestao_id` INT(11) NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `operacao_contrato` TEXT NULL ,
  `numero` VARCHAR(30) NOT NULL ,
  `numero_auxiliar` VARCHAR(30) NOT NULL ,
  `familia_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_processos_comarcas1` (`comarca_id` ASC) ,
  INDEX `fk_processos_status1` (`status_id` ASC) ,
  INDEX `fk_processos_tipos_processos1` (`tipo_processo_id` ASC) ,
  INDEX `fk_processos_fases1` (`fase_id` ASC) ,
  INDEX `fk_processos_instancias1` (`instancia_id` ASC) ,
  INDEX `fk_processos_naturezas1` (`natureza_id` ASC) ,
  INDEX `fk_processos_orgaos1` (`orgao_id` ASC) ,
  INDEX `fk_processos_segmentos1` (`segmento_id` ASC) ,
  INDEX `fk_processos_equipes1` (`equipe_id` ASC) ,
  INDEX `i_numero` (`numero` ASC) ,
  INDEX `i_numero_auxiliar` (`numero_auxiliar` ASC) ,
  INDEX `fk_processos_gestoes1` (`gestao_id` ASC) ,
  INDEX `fk_processos_usuarios1` (`usuario_id` ASC) ,
  INDEX `i_familia_id` (`familia_id` ASC) ,
  CONSTRAINT `fk_processos_comarcas1`
    FOREIGN KEY (`comarca_id` )
    REFERENCES `comarcas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_tipos_processos1`
    FOREIGN KEY (`tipo_processo_id` )
    REFERENCES `tipos_processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_fases1`
    FOREIGN KEY (`fase_id` )
    REFERENCES `fases` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_instancias1`
    FOREIGN KEY (`instancia_id` )
    REFERENCES `instancias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_naturezas1`
    FOREIGN KEY (`natureza_id` )
    REFERENCES `naturezas` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_orgaos1`
    FOREIGN KEY (`orgao_id` )
    REFERENCES `orgaos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_segmentos1`
    FOREIGN KEY (`segmento_id` )
    REFERENCES `segmentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_equipes1`
    FOREIGN KEY (`equipe_id` )
    REFERENCES `equipes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_gestoes1`
    FOREIGN KEY (`gestao_id` )
    REFERENCES `gestoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_audiencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_audiencias` ;

CREATE  TABLE IF NOT EXISTS `tipos_audiencias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `audiencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `audiencias` ;

CREATE  TABLE IF NOT EXISTS `audiencias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `tipo_audiencia_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `iscancelada` TINYINT(1) NOT NULL DEFAULT '0' ,
  `data` DATE NOT NULL ,
  `hora` TIME NOT NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_audiencias_processos1` (`processo_id` ASC) ,
  INDEX `fk_audiencias_tipos_audiencias1` (`tipo_audiencia_id` ASC) ,
  INDEX `fk_audiencias_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_audiencias_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_audiencias_tipos_audiencias1`
    FOREIGN KEY (`tipo_audiencia_id` )
    REFERENCES `tipos_audiencias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_audiencias_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `estados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estados` ;

CREATE  TABLE IF NOT EXISTS `estados` (
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
-- Table `cidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cidades` ;

CREATE  TABLE IF NOT EXISTS `cidades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `estado_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cidades_estados1` (`estado_id` ASC) ,
  CONSTRAINT `fk_cidades_estados1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `estados` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `profissoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `profissoes` ;

CREATE  TABLE IF NOT EXISTS `profissoes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(65) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contatos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contatos` ;

CREATE  TABLE IF NOT EXISTS `contatos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `tipo_contato` TINYINT(1) NOT NULL ,
  `cnpj` VARCHAR(14) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `cpf` VARCHAR(11) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `endereco` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL ,
  `cep` VARCHAR(8) NULL ,
  `bairro` VARCHAR(45) NULL ,
  `email` VARCHAR(99) NULL ,
  `oab` VARCHAR(6) NULL ,
  `obs` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL DEFAULT NULL ,
  `cidade_id` INT(11) NOT NULL ,
  `profissao_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_clientes_cidades1` (`cidade_id` ASC) ,
  INDEX `fk_contatos_profissoes1` (`profissao_id` ASC) ,
  INDEX `i_oab` (`oab` ASC) ,
  CONSTRAINT `fk_clientes_cidades1`
    FOREIGN KEY (`cidade_id` )
    REFERENCES `cidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatos_profissoes1`
    FOREIGN KEY (`profissao_id` )
    REFERENCES `profissoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_eventos` ;

CREATE  TABLE IF NOT EXISTS `tipos_eventos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NULL ,
  `nome` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `eventos` ;

CREATE  TABLE IF NOT EXISTS `eventos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `data` DATE NOT NULL ,
  `evento` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL ,
  `processo_id` INT(11) NOT NULL ,
  `tipo_evento_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_movimentos_processos1` (`processo_id` ASC) ,
  INDEX `fk_eventos_tipos_eventos1` (`tipo_evento_id` ASC) ,
  CONSTRAINT `fk_movimentos_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_tipos_eventos1`
    FOREIGN KEY (`tipo_evento_id` )
    REFERENCES `tipos_eventos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `numeros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `numeros` ;

CREATE  TABLE IF NOT EXISTS `numeros` (
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
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `telefones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `telefones` ;

CREATE  TABLE IF NOT EXISTS `telefones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `ddd` VARCHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `telefone` VARCHAR(8) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `ramal` VARCHAR(4) NOT NULL ,
  `contato` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `modelo` VARCHAR(45) NOT NULL ,
  `modelo_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_telefone` (`telefone` ASC) ,
  INDEX `i_modelo` (`modelo` ASC) ,
  INDEX `i_modelo_id` (`modelo_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_partes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_partes` ;

CREATE  TABLE IF NOT EXISTS `tipos_partes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `solicitacoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitacoes` ;

CREATE  TABLE IF NOT EXISTS `solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `solicitacao` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_peticoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_peticoes` ;

CREATE  TABLE IF NOT EXISTS `tipos_peticoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `tipos_pareceres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tipos_pareceres` ;

CREATE  TABLE IF NOT EXISTS `tipos_pareceres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `complexidades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `complexidades` ;

CREATE  TABLE IF NOT EXISTS `complexidades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `processos_solicitacoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `processos_solicitacoes` ;

CREATE  TABLE IF NOT EXISTS `processos_solicitacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `solicitacao_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `data_atendimento` DATETIME NULL ,
  `data_fechamento` DATETIME NULL ,
  `finalizada` TINYINT(1)  NOT NULL ,
  `obs` TEXT NULL ,
  `usuario_solicitante` INT(11) NOT NULL ,
  `usuario_atribuido` INT(11) NOT NULL ,
  `departamento_id` INT(11) NOT NULL ,
  `tipo_parecer_id` INT(11) NULL ,
  `tipo_peticao_id` INT(11) NULL ,
  `complexidade_id` INT(11) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_processos_solicitacoes_solicitacoes1` (`solicitacao_id` ASC) ,
  INDEX `fk_processos_solicitacoes_processos1` (`processo_id` ASC) ,
  INDEX `fk_processos_solicitacoes_departamento1` (`departamento_id` ASC) ,
  INDEX `fk_processos_solicitacoes_tipos_peticoes1` (`tipo_peticao_id` ASC) ,
  INDEX `fk_processos_solicitacoes_tipos_pareceres1` (`tipo_parecer_id` ASC) ,
  INDEX `fk_processos_solicitacoes_complexidades1` (`complexidade_id` ASC) ,
  CONSTRAINT `fk_processos_solicitacoes_solicitacoes1`
    FOREIGN KEY (`solicitacao_id` )
    REFERENCES `solicitacoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_departamento1`
    FOREIGN KEY (`departamento_id` )
    REFERENCES `departamentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_tipos_peticoes1`
    FOREIGN KEY (`tipo_peticao_id` )
    REFERENCES `tipos_peticoes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_tipos_pareceres1`
    FOREIGN KEY (`tipo_parecer_id` )
    REFERENCES `tipos_pareceres` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_solicitacoes_complexidades1`
    FOREIGN KEY (`complexidade_id` )
    REFERENCES `complexidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `eventos_acordos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `eventos_acordos` ;

CREATE  TABLE IF NOT EXISTS `eventos_acordos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `evento` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `data` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_movimentos_processos1` (`processo_id` ASC) ,
  INDEX `fk_eventos_acordo_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_movimentos_processos10`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_acordo_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `perfis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `perfis` ;

CREATE  TABLE IF NOT EXISTS `perfis` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'tabela de perfis' ;


-- -----------------------------------------------------
-- Table `usuarios_perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios_perfil` ;

CREATE  TABLE IF NOT EXISTS `usuarios_perfil` (
  `usuarios_id` INT NOT NULL ,
  `perfis_id` INT NOT NULL ,
  PRIMARY KEY (`usuarios_id`, `perfis_id`) ,
  INDEX `fk_usuarios_has_perfis_perfis1` (`perfis_id` ASC) ,
  CONSTRAINT `fk_usuarios_has_perfis_usuarios1`
    FOREIGN KEY (`usuarios_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_perfis_perfis1`
    FOREIGN KEY (`perfis_id` )
    REFERENCES `perfis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `urls`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `urls` ;

CREATE  TABLE IF NOT EXISTS `urls` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(200) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `i_url` (`url` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'url aonde o usuário não terá permissão de acesso' ;


-- -----------------------------------------------------
-- Table `urls_perfil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `urls_perfil` ;

CREATE  TABLE IF NOT EXISTS `urls_perfil` (
  `urls_id` INT NOT NULL ,
  `perfis_id` INT NOT NULL ,
  PRIMARY KEY (`urls_id`, `perfis_id`) ,
  INDEX `fk_urls_has_perfis_perfis1` (`perfis_id` ASC) ,
  CONSTRAINT `fk_urls_has_perfis_urls1`
    FOREIGN KEY (`urls_id` )
    REFERENCES `urls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_urls_has_perfis_perfis1`
    FOREIGN KEY (`perfis_id` )
    REFERENCES `perfis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `urls_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `urls_usuario` ;

CREATE  TABLE IF NOT EXISTS `urls_usuario` (
  `urls_id` INT NOT NULL ,
  `usuarios_id` INT NOT NULL ,
  PRIMARY KEY (`urls_id`, `usuarios_id`) ,
  INDEX `fk_urls_has_usuarios_usuarios1` (`usuarios_id` ASC) ,
  CONSTRAINT `fk_urls_has_usuarios_urls1`
    FOREIGN KEY (`urls_id` )
    REFERENCES `urls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_urls_has_usuarios_usuarios1`
    FOREIGN KEY (`usuarios_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `efetividades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `efetividades` ;

CREATE  TABLE IF NOT EXISTS `efetividades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `contatos_telefonicos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contatos_telefonicos` ;

CREATE  TABLE IF NOT EXISTS `contatos_telefonicos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `data` DATE NOT NULL ,
  `nome` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `efetividade_id` INT(11) NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `obs` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_telefone` (`nome` ASC) ,
  INDEX `i_nome` (`nome` ASC) ,
  INDEX `fk_contatos_telefonicos_processos1` (`processo_id` ASC) ,
  INDEX `fk_contatos_telefonicos_efetividades1` (`efetividade_id` ASC) ,
  INDEX `fk_contatos_telefonicos_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_contatos_telefonicos_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatos_telefonicos_efetividades1`
    FOREIGN KEY (`efetividade_id` )
    REFERENCES `efetividades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatos_telefonicos_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `testemunhas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `testemunhas` ;

CREATE  TABLE IF NOT EXISTS `testemunhas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `processo_id` INT(11) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `nome` VARCHAR(200) NOT NULL ,
  `aprovado` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `convocado` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `usuario_id` INT(11) NOT NULL ,
  `data_entrevista` DATE NOT NULL ,
  `obs` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_testemunhas_processos1` (`processo_id` ASC) ,
  INDEX `fk_testemunhas_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_testemunhas_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_testemunhas_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `envolvimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `envolvimentos` ;

CREATE  TABLE IF NOT EXISTS `envolvimentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `nome` VARCHAR(99) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_nome` (`nome` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contatos_processos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contatos_processos` ;

CREATE  TABLE IF NOT EXISTS `contatos_processos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `principal` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `contato_id` INT(11) NOT NULL ,
  `processo_id` INT(11) NOT NULL ,
  `tipo_parte_id` INT(11) NOT NULL ,
  `envolvimento_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `i_principal` (`principal` ASC) ,
  INDEX `fk_clientes_processos_clientes1` (`contato_id` ASC) ,
  INDEX `fk_clientes_processos_processos1` (`processo_id` ASC) ,
  INDEX `fk_contatos_processos_tipos_partes1` (`tipo_parte_id` ASC) ,
  INDEX `fk_contatos_processos_envolvimentos1` (`envolvimento_id` ASC) ,
  CONSTRAINT `fk_clientes_processos_clientes1`
    FOREIGN KEY (`contato_id` )
    REFERENCES `contatos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_processos_processos1`
    FOREIGN KEY (`processo_id` )
    REFERENCES `processos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatos_processos_tipos_partes1`
    FOREIGN KEY (`tipo_parte_id` )
    REFERENCES `tipos_partes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contatos_processos_envolvimentos1`
    FOREIGN KEY (`envolvimento_id` )
    REFERENCES `envolvimentos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `fluxos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fluxos` ;

CREATE  TABLE IF NOT EXISTS `fluxos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `created` VARCHAR(45) NOT NULL ,
  `solicitacao_id` INT(11) NOT NULL ,
  `proxima_id` INT(11) NOT NULL ,
  `complexidade_id` INT(11) NOT NULL ,
  `departamento_id` INT(11) NOT NULL ,
  `contato_id` INT(11) NULL DEFAULT 0 ,
  `atribuir_proxima_advogado` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `fechar_anterior` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `atualizar_sistema` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `nome_botao` VARCHAR(20) NOT NULL COMMENT 'nome do botao' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
