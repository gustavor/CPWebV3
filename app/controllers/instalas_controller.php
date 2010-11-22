<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/instalas_controller.php
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
class InstalasController extends AppController {
	/**
	 * nome
	 */
	public $name = 'Instalas';
	
	/**
	 * 
	 */
	public $erro = '';
	
	/**
	 * Modelo
	 */
	public $uses = null;
	
	/**
	 * Método start
	 * 
	 * @return void
	 */
	public function index()
	{
		$msg 	= '';
		if (!empty($this->data))
		{
			$admin		= $this->data['instala']['ed_admin'];
			$senha		= $this->data['instala']['ed_senha'];
			$email		= $this->data['instala']['ed_email'];
			if ( !empty($admin) && !empty($senha) && !empty($senha) )
			{
				$msg = $this->getInstala($admin, $senha, $email);
			} else
			{
				$msg = 'Preencha todos os campos !!!';
			}
		}
		if (!empty($this->erro)) 
		{
			$erro = $this->erro;
			$this->set(compact('erro'));
		} else $this->set(compact('msg'));
	}
	
	/**
	 * Executa a instalação do banco de dados Cpweb
	 * 
	 * @return string $retorno Mensagen do status da instalação
	 */
	private function getInstala($admin,$senha,$email)
	{
		$retorno = '';

		// conecta no banco
		
		// instala todas as tabelas

		// atualiza usuário administrador
		$sql  = 'INSERT INTO usuarios (login,senha,email,ativo,acessos,ultimo_acesso,created,modified) values ';
		$sql .= '("'.$admin.'","'.$senha.'","'.$email.'",1,1,now(),now(),now())';
		$retorno = $sql;

		// atualiza outras tabelas

		// desconecta no banco

		return $retorno;
	}
}
