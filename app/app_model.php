<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model {
	/**
	 * Antes da validação
	 * 
	 * Cria regra de preenchimento obrigatório para campos relacionados
	 * 
	 * Transforma todos os campos em maiúsculo
	 * 
	 * @return boolean
	 */
	public function beforeValidate()
	{
		// criando a regra para cardinalidades vazias
		$l = 0;
		foreach($this->_schema as $_campo => $_arrOpcoes)
		{
			$l++;
			if 	(
					empty($_arrOpcoes['null']) 		&&
					!isset($this->validate[$_campo]['rule']['notEmpty']) &&
					$_campo != $this->primaryKey &&
					$_campo != 'created' &&
					$_campo != 'modified'
				)
			{
				$i = true;
				while($i) if (isset($this->validate[$_campo][$l])) $l++; else $i=false;
				$this->validate[$_campo][$l]['rule']		= 'notEmpty';
				$this->validate[$_campo][$l]['required'] 	= true;
				$this->validate[$_campo][$l]['message']		= 'É necessário informar um valor para o campo <strong>'.$this->getNomeCampo($_campo).'</strong>';
			}
		}

		// atualizando cpf e cnpj
		$this->setCpf();
		
		// transformando tudo em maísculos
		foreach($this->data as $_model => $_arrCampos)
		{
			foreach($_arrCampos as $_campo => $_valor)
			{
				if (is_string($_valor) && !strpos($_valor,'@'))
				{
					$this->data[$_model][$_campo] = mb_strtoupper($this->data[$_model][$_campo]);
				}
			}
		}
		return true;
	}

	/**
	 * Retona o nome do campo relacionado
	 * 
	 * @return $campo string
	 */
	private function getNomeCampo($campo=null)
	{
		foreach($this->belongsTo as $_model => $_arrOpcoes) if (isset($_arrOpcoes['foreignKey']) && $_arrOpcoes['foreignKey']==$campo) return $_arrOpcoes['className'];
		return $campo;
	}
	
	/**
	 * Função que valida a Data
	 * 
	 * @return boolean
	 */
	public function ValidaData($data)
	{
		// recuperando o cpf da matriz
		foreach($data as $_item => $_valor) $_data = $_valor;

		// não testamos vazio
		if (strlen($_data)==0) return true;

		$_data = explode("/","$_data"); // fatia a string $dat em pedados, usando / como referência
		$d = $_data[0];
		$m = $_data[1];
		$y = $_data[2];

		// verifica se a data é válida!
		// 1 = true (válida)
		// 0 = false (inválida)
		$res = checkdate($m,$d,$y);
		if ($res) return true; else return false;
	}

	
	
	/**
	 * Função que valida o CPF
	 * 
	 * @autor: Moacir Selínger Fernandes
	 * @email: hassed@hassed.com
	*/
	public function validaCPF($data)
	{
		// recuperando o cpf da matriz
		foreach($data as $_item => $_valor) $cpf = $_valor;

		// não testamos vazio
		if (empty($cpf)) return true;

		// Verifiva se o número digitado contém todos os digitos
		$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
		return false;
		}
		else
		{   // Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}

				$d = ((10 * $d) % 11) % 10;

				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	/**
	 * Função para validar CNPJ
	 * 
	 * @return boolean
	 */
	function validaCNPJ($data) 
	{ 
		// recuperando o cpf da matriz
		foreach($data as $_item => $_valor) $cnpj = $_valor;
		
		// não testamos vazio
		if (empty($cnpj)) return true;
		
		$cnpj = preg_replace ("@[./-]@", "", $cnpj);

		if (strlen($cnpj) <> 14) return FALSE;

		$soma = 0;

		$soma += ($cnpj[0] * 5);
		$soma += ($cnpj[1] * 4);
		$soma += ($cnpj[2] * 3);
		$soma += ($cnpj[3] * 2);
		$soma += ($cnpj[4] * 9);
		$soma += ($cnpj[5] * 8);
		$soma += ($cnpj[6] * 7);
		$soma += ($cnpj[7] * 6);
		$soma += ($cnpj[8] * 5);
		$soma += ($cnpj[9] * 4);
		$soma += ($cnpj[10] * 3);
		$soma += ($cnpj[11] * 2);

		$d1 = $soma % 11;
		$d1 = $d1 < 2 ? 0 : 11 - $d1;

		$soma = 0;
		$soma += ($cnpj[0] * 6);
		$soma += ($cnpj[1] * 5);
		$soma += ($cnpj[2] * 4);
		$soma += ($cnpj[3] * 3);
		$soma += ($cnpj[4] * 2);
		$soma += ($cnpj[5] * 9);
		$soma += ($cnpj[6] * 8);
		$soma += ($cnpj[7] * 7);
		$soma += ($cnpj[8] * 6);
		$soma += ($cnpj[9] * 5);
		$soma += ($cnpj[10] * 4);
		$soma += ($cnpj[11] * 3);
		$soma += ($cnpj[12] * 2);

		$d2 = $soma % 11;
		$d2 = $d2 < 2 ? 0 : 11 - $d2;

		if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

    /**
	 * Limpa cpf e cnpj
	 *
	 * @return void
	 */
	public function setCpf()
	{
		// limpando cnpj e cpf
		if (isset($this->data[$this->name]['cnpj'])) $this->data[$this->name]['cnpj'] = ereg_replace('[./-]','',$this->data[$this->name]['cnpj']);
		if (isset($this->data[$this->name]['cpf']))	 $this->data[$this->name]['cpf'] = ereg_replace('[./-]','',$this->data[$this->name]['cpf']);
	}

    public $actsAs = array('Containable');

}
?>
