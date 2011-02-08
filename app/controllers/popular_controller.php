<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/controllers/processos_controller.php
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
class PopularController extends AppController {
	/**
	 * Nome do controlador
	 * 
	 * @var	string
	 * @access	public
	 */
	public $name = 'Popular';

	/**
	 * Modelo usado pelo controlador 
	 * 
	 * @var		string
	 * @access	public
	 */
	public $uses	= 'Popular';

	/**
	 * Método start
	 */
	public function index()
	{
	}

	/**
	 * Executa o processo de popular as tabelas do banco
	 * 
	 * @return void
	 */
	public function executar()
	{
		// texto genérico
		$valor = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel mi non lorem facilisis scelerisque at suscipit est. Praesent posuere ultrices metus sit amet pulvinar. Donec pharetra dolor vel tortor feugiat eleifend. Morbi vitae nunc dapibus metus molestie';
		
		// modelos
		$modelos['AdvogadoContrario'] 	= 50;
		$modelos['Audiencia']				= 50;
		$modelos['Checklist']				= 30;
		$modelos['Cliente']					= 200;
		$modelos['Comarca']					= 100;
		$modelos['Complexidade']			= 50;
		$modelos['ContatoTelefonico']		= 100;
		$modelos['Departamento']			= 50;
		$modelos['Efetividade']				= 10;
		$modelos['Equipe']					= 30;
		$modelos['Evento']					= 60;
		$modelos['Evento_acordo']			= 60;
		$modelos['Fase']					= 70;
		$modelos['Gestao']					= 80;
		$modelos['Instancia']				= 90;
		$modelos['Item']					= 60;
		$modelos['Modelo']					= 50;
		$modelos['Natureza']				= 50;
		$modelos['Numero']					= 50;
		$modelos['Orgao']					= 50;
		$modelos['ParteContraria']			= 50;
		$modelos['Perfil']					= 10;
		$modelos['Processo']				= 10000;
		$modelos['ProcessoSolicitacao']	= 20000;
		$modelos['Segmento']				= 1000;
		$modelos['Solicitacao']				= 5000;
		$modelos['Status']					= 50;
		$modelos['Telefone']				= 50;
		/*$modelos['TipoAudiencia']			= 50;
		$modelos['TipoParecer']			= 50;
		$modelos['TipoParte']				= 50;
		$modelos['TipoPeticao']			= 50;
		$modelos['TipoProcesso']			= 50;
		$modelos['TipoSolicitacao']		= 50;
		$modelos['TipoIrl']				= 50;*/
		$modelos['Usuario']					= 50;

		// populando model por model
		foreach($modelos as $_model => $_total)
		{
			$this->loadModel($_model);
			$this->$_model->validate = null;
			// recuperando os relacionamentos
			foreach($this->$_model->__associations as $associacao)
			{
				if (count($this->$_model->$associacao))
				{
					foreach($this->$_model->$associacao as $assoc => $arr_opcoes)
					{
						$lista[$associacao] = $this->controller->$modelClass->$assoc->find('list');
					}
				}
			}

			// recuperando os campos
			$campos = array();
			foreach($this->$_model->_schame as $_campo => $_arrTipo)
			{
				if ($_campo!='id') array_push($campos,$_campo);
			}

			// populando ...
			for($i=0; $i<$total; $i++)
			{
				// criando um valor para cada campo
				foreach($campos as $_campo)
				{
					switch($this->$_model->_schema[$_campo]['type'])
					{
						case 'integer':
							$this->$_model->data[$_campo] = 1;
							break
						default:
							$this->$_model->data[$_campo] = substr($valor,0,100);
							break;
					}
				}
			}
		}
	}
}
?>
