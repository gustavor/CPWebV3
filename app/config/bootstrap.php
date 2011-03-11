<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/config/bootstrap.php
 *
 * A reprodução de qualquer parte desse arquivo sem a prévia autorização
 * do detentor dos direitos autorais constitui crime de acordo com
 * a legislação brasileira.
 *
 * This product is protected by copyright and distributed under licenses restricting
 * copying, distribution, and non-allowed selling/trading
 *
 * @copyright   Copyright 2010, Valéria Esteves Advogados Associados ( www.veadvogados.com.br )
 * @copyright   Copyright 2010, Gustavo Dias Duarte Ramos ( gustavo at gustavo-ramos dot com )
 * @link http://cpweb.veadvogados.adv.br
 * @package cpweb
 * @subpackage cpweb.v3
 * @since CPWeb V3
 */

	// mudando a criptografia pra aumentar a segurança
	App::import('Core','Security');
	Security::setHash('sha256');

	// cakePTBR
	require APP . 'plugins' . DS . 'cake_ptbr' . DS . 'config' . DS . 'bootstrap.php';

    //versão do sistema
    Configure::write('CPWeb.Versao', '3.0.1');

    //algumas constantes do sistema
	define( 'DEPT_NUC_JUR_TRAB', 2 );
    define( 'DEPT_NUC_JUR_CIV', 1 );
    define( 'DEPT_POOL_CIVEL', 3 );
    define( 'DEPT_POOL_TRAB', 4 );
    define( 'DEPT_ACORDO', 5 );
    define( 'DEPT_FINANCEIRO', 6 );
?>
