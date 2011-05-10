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
class InstalaController extends AppController {
	/**
	 * nome
	 * 
	 * @var		string
	 * @access	public
	 */
	public $name = 'Instala';

	/**
	 * mensagens de erro
	 * 
	 * @var		string
	 * @access	public
	 */
	public $erro = '';

	/**
	 * tabelas que serão populadas
	 * 
	 * @var		array
	 * @access	public
	 */
	public $csv	= array('estados','perfis','usuarios_perfil','cidades',
                        'status','naturezas','comarcas','gestoes','envolvimentos',
                        'segmentos','equipes','fases','tipos_partes',
                        'complexidades','departamentos','instancias','tipos_audiencias',
                        'tipos_processos','orgaos','tipos_pareceres','tipos_peticoes',
                        'efetividades', 'solicitacoes', 'profissoes');

	/**
	 * Modelo
	 * 
	 * @var		string
	 * @access	public
	 */
	public $uses = 'Instala';

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
			$nome		= $this->data['instala']['ed_nome'];
			$admin		= $this->data['instala']['ed_admin'];
			$senha		= $this->data['instala']['ed_senha'];
			$email		= $this->data['instala']['ed_email'];
			if ( !empty($nome) && !empty($admin) && !empty($senha) && !empty($email) )
			{
				$msg = $this->getInstala($nome, $admin, $senha, $email);
			} else
			{
				$this->erro = 'Preencha todos os campos !!!';
			}
		}
		if (!empty($this->erro)) 
		{
			$erro = $this->erro;
			$this->set(compact('erro'));
		} else
		{
			$this->set(compact('msg'));
			if ($msg===true) $this->set('instala_ok',true);
		}
	}

	/**
	 * Executa a instalação do banco de dados
	 * 
	 * @return boolean
	 */
	private function getInstala($nome,$admin,$senha,$email)
	{
		// instancio o datasource só pra pegar erros do banco
		$db = ConnectionManager::getDataSource('default'); 

		// instala todas as tabelas do sistema
		$arq = ROOT.DS.'files'.DS.'sql'.DS.mb_strtolower(SISTEMA).'.sql';
		if (!file_exists($arq))
		{
			$this->erro = 'Não foi possível localicar o arquivo '.$arq;
			exit('não foi possível localizar o arquivo '.$arq);
			return false;
		}
		$handle  = fopen($arq,"r");
		$texto   = fread($handle, filesize($arq));
		$sqls	 = explode(";",$texto);
		fclose($handle);
		foreach($sqls as $sql) // executando sql a sql
		{
			if (trim($sql))
			{
				$this->Instala->query($sql, $cachequeries=false);
				if ($db->lastError())
				{
					$this->erro = $db->lastError();
					return false;
				}
			}
		}

		// encriptando a senha
		/*$hash = Security::getInstance();
		Security::setHash($hash->hashType);*/
		$senha = Security::hash(Configure::read('Security.salt') . $senha);

		// inclui usuário administrador
		$sql  = 'INSERT INTO usuarios (nome,login,senha,email,ativo,acessos,aniversario,ultimo_acesso,created,modified) values ';
		$sql .= '("'.mb_strtoupper($nome).'","'.$admin.'","'.$senha.'","'.$email.'",1,1,"'.date('d/m').'",now(),now(),now())';
		$this->Instala->query($sql, $cachequeries=false);
		if ($db->lastError())
		{
			$this->erro = $db->lastError().'<br />'.$sql;
			return false;
		}

		// atualiza outras tabelas vias CSV
		foreach($this->csv as $tabela)
		{
			$arq = ROOT.DS.'files'.DS.'sql'.DS.$tabela.'.csv';
			if (!file_exists($arq))
			{
				$this->erro = 'Não foi possível localizar o arquivo '.$arq;
				return false;
			} else
			{
				$handle  	= fopen($arq,"r");
				$l 			= 0;
				$campos 	= '';
				$valores 	= '';
				while ($linha = fgetcsv($handle, 2048, ";"))
				{
					if (!$l)
					{
						$i = 0;
						$t = count($linha);
						foreach($linha as $campo)
						{
							$campos .= $campo;
							$i++;
							if ($i!=$t) $campos .= ',';
						}
						$arr_campos = explode(',',$campos);
					} else
					{
						$valores  = '';
						$i = 0;
						$t = count($linha);
						foreach($linha as $valor)
						{
							if ($arr_campos[$i]=='created' || $arr_campos[$i]=='modified') $valor = date("Y-m-d h:i:s");
							$valores .= "'".str_replace("'","\'",$valor)."'";
							$i++;
							if ($i!=$t) $valores .= ',';
						}
						$sql = 'INSERT INTO '.$tabela.' ('.$campos.') VALUES ('.$valores.')';
						$this->Instala->query($sql, $cachequeries=false);
						if ($db->lastError())
						{
							$this->erro = $db->lastError();
							return false;
						}
					}
					$l++;
				}
				fclose($handle);
			}
		}

		return true;
	}
}
?>
