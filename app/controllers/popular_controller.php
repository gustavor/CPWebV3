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
		// se não é o administrador carca fora
		if (!in_array('ADMINISTRADOR',$this->Session->read('perfis')) )
		{
			$this->Session->setFlash('<span class="alertaFlashMessage">Somente administradores podem popular as tabelas do banco !!!</span>');
			$this->redirect(Router::url('/',true).'usuarios/editar/'.$this->Session->read('Auth.Usuario.id'));
		}
		
		// texto genérico
		$valor = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel mi non lorem facilisis scelerisque at suscipit est. Praesent posuere ultrices metus sit amet pulvinar. Donec pharetra dolor vel tortor feugiat eleifend. Morbi vitae nunc dapibus metus molestie';

		// erros
		$erros = '';
		
		// modelos
		$modelos['AdvogadoContrario'] 		= 109;
		$modelos['Cliente']					= 500;
		$modelos['Item']					= 90;
		$modelos['Modelo']					= 300;
		$modelos['Tese']					= 500;
		$modelos['Checklist']				= 100;
		$modelos['ParteContraria']			= 80;
		$modelos['Solicitacao']				= 876;
		$modelos['Processo']				= 1546;
		$modelos['ProcessoSolicitacao']		= 1478;
		$modelos['Numero']					= 800;
		$modelos['Audiencia']				= 456;
		$modelos['Evento']					= 567;
		$modelos['EventoAcordo']			= 567;
		$modelos['ContatoTelefonico']		= 678;
		$modelos['Telefone']				= 346;
		$modelos['Usuario']					= 566;

		// descobrindo as opções possíveis para os relacionamentos do model de cada modelo
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
						$lista[$arr_opcoes['foreignKey']] = $this->$_model->$assoc->find('list');
					}
				}
			}

			// recuperando todos os campos do modelo, com excessão do campo id porque é autoincrement
			$campos = array();
			foreach($this->$_model->_schema as $_campo => $_arrTipo) if ($_campo!='id') array_push($campos,$_campo);

			// populando modelo por modelo
			for($i=0; $i<$_total; $i++)
			{
				// limpando data do ccontroller
				$this->data = array();

				// criando um valor para cada campo
				foreach($campos as $_campo)
				{
					$tipo = $this->$_model->_schema[$_campo]['type'];

					// campos padrão
					if ($tipo=='datetime')		$this->data[$_campo] = date('Y-m-d h:i:s');
					if ($tipo=='date')			$this->data[$_campo] = date('Y-m-d');
					if ($tipo=='time')			$this->data[$_campo] = date('h:i:s');
					if ($tipo=='text')			$this->data[$_campo] = $valor;
					if ($tipo=='integer')		$this->data[$_campo] = rand(0,1);
					if ($_campo=='ativo')		$this->data[$_campo] = rand(0,1);
					if ($_campo=='isadvogado')	$this->data[$_campo] = rand(0,1);
					if ($_campo=='cnpj')		$this->data[$_campo] = rand(11111111111111,99999999999999); 
					if ($_campo=='cpf')			$this->data[$_campo] = rand(11111111111,99999999999);
					if ($_campo=='telefone')	$this->data[$_campo] = rand(1111111111111,9999999999999);
					if ($_campo=='senha')		$this->data[$_campo] = 'b1b3e6827fbdb291b415b9ef7efee925d749bf34d945b882a640cbf93b4f7585';
					if (isset($lista[$_campo]) && count($lista[$_campo])) $this->data[$_campo] = array_rand($lista[$_campo]);
					if (!isset($this->data[$_campo])) $this->data[$_campo] = substr($valor,0,$this->$_model->_schema[$_campo]['length']);
				}
				$this->$_model->create();
				if (!$this->$_model->save($this->data)) 
				{
					exit($_model.'<pre>'.print_r($this->$_model->validationErrors,true).'</pre>');
					$erros .= $i.' - '.$_model.' erro ...<br />';
				}
			}
		}
		if (!empty($erros)) $this->set('msg',$erros); else $this->set('ok','ok');
	}
}
?>
