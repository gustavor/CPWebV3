<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/app_controller.php
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
class AppError extends ErrorHandler {

	/**
	 * Trata o erro 500, caso o parâmetro table seja usuário redireciona para a página de instalação
	 * 
	 * @param array $params Parâmetro do controlador
	 * @access public
	 * @return void
	 */
	public function error500($params)
	{
		//echo '<pre>'.print_r($params,true).'</pre>';
		if ($params['table']=='usuarios') header("Location: ".Router::url('/',true).'instala');
	}

	/**
	 * securityError
	 *
	 * @return void
	 */
    public function securityError() {
        $this->controller->set(array('referer' => $this->controller->referer(),));
        $this->_outputMessage('security');
    }
}
?>
