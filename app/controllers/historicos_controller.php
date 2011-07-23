<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/historicos_controller.php
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
class HistoricosController extends AppController {
	/**
	 * Nome
	 * 
	 * @var		string
	 * @access 	public
	 */
	public $name 	= 'Historicos';

	/**
	 * Modelo
	 * 
	 * @var string
	 * @access public
	 */
	public $uses	= 'Historico';

	/**
	 * Ajudantes 
	 * 
	 * @var array
	 * @access public
	 */
	public $helpers = array('CakePtbr.Formatacao');

	/**
	 * Componentes
	 * 
	 * @var array Componentes
	 * @access public
	 */
	public $components	= array('CpwebCrud','Session');

	/**
	 * Método chamado antes de qualquer outro método
	 * 
	 * @access 	public
	 * @return 	void
	 */
	public function beforeFilter()
	{
		$this->set('arqListaMenu','menu_modulos');
		$this->layout = 'historico';
		parent::beforeFilter();
	}

	/**
	 * método start
	 * 
	 * @return void
	 */
	public function index()
	{
	}

	/**
	 * Lista os dados em paginação
	 * 
	 * @parameter integer 	$pag 		Número da página
	 * @parameter string 	$ordem 		Campo usado no order by da sql
	 * @parameter string 	$direcao 	Direção ASC ou DESC
	 * @return void
	 */
	public function listar($pag=1,$ordem=null,$direcao='DESC')
	{
		$idProcesso = isset($this->params['pass'][1]) ? $this->params['pass'][1] : 0;
		$msgLista 	= '';
		if ($idProcesso)
		{
			$this->setIdProcesso();
			$ultimoHistorico = $this->Historico->find('first',array('order'=>array('Historico.created DESC'), 'conditions'=>array('Historico.processo_id'=>$idProcesso)));
			switch($ultimoHistorico['Historico']['tipo_historico_id'])
			{
				case '1':
					$msgLista = 'PROCESSO NÃO DISPONÍVEL NO ARQUIVO';
					break;
				case '2':
					$msgLista = 'PROCESSO DISPONÍVEL NO ARQUIVO';
					break;
				case '3':
					$msgLista = 'PROCESSO NÃO DISPONÍVEL NO ARQUIVO';
					break;
			}
		}
		$this->set('msgLista',$msgLista);
		$this->CpwebCrud->listar($pag,$ordem,$direcao);
	}

	/**
	 * Exibe o formulário de histórico para empréstimos
	 * 
	 * @return	void
	 */
	public function emprestimo()
	{
		$this->setForm();
	}

	/**
	 * Exibe o formulário de histórico para devolução
	 * 
	 * @return	void
	 */
	public function devolucao()
	{
		$this->setForm();
	}

	/**
	 * Exibe o formulário de histórico para remessa
	 * 
	 * @return	void
	 */
	public function remessa()
	{
		$this->setForm();
	}

	/**
	 * Exibe o formulário de inclusão para históricos
	 * 
	 * @return	void
	 */
	private function setForm()
	{
		$tipos_historicos = $this->Historico->TipoHistorico->find('list');
		if ($this->data)
		{
			$opcoes = array();
			unset($this->data['Historico']['id']);
			$this->Historico->create();
			if (!$this->Historico->save($this->data,$opcoes))
			{
				$this->controller->Session->setFlash('<span style="font-size: 20px;">Registro incluído com sucesso !!!</span>');
			} else
			{
				$this->Session->setFlash('O Formulário ainda contém erros !!!');
			}
		}
		$this->set('tipos_historicos',$tipos_historicos);
		$this->render('emprestimo');
	}
}
?>
