<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/protocolos_controller.php
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
class ProtocolosController extends AppController {

	/**
	 * Nome do controlador
	 * 
	 * @var string
	 * @access public
	 */
	public $name = 'Protocolos';

	/**
	 * Modelo para o controlador
	 * 
	 * @var string
	 * @access public
	 */
	public $uses = array();

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
		$this->layout = 'protocolo';
		$this->set('arqListaMenu','menu_modulos');
		parent::beforeFilter();
	}

	/**
	 * método start
	 * 
	 * @return void
	 */
	public function index()
	{
		if (isset($this->data))
		{
			$msg = 'Não foi possível localizar nenhum lote com este número !!!';
			$idLote = $this->data['protocolo']['lote'];
			if ($idLote>0)
			{
				$this->loadModel('Lote');
				$dataLote = $this->Lote->find('list',array('conditions'=>array('Lote.id'=>$idLote)));
				if (count($dataLote))
				{
					foreach($dataLote as $_idLote => $_codigo)
					{
						$this->redirect(Router::url('/',true).'lotes_processos_solicitacoes/listar/lote:'.$_idLote);
					}
				}
			}
			$this->set('msg',$msg);
		}
	}
}
?>
