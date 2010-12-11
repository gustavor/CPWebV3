<?php
/**
 * CPWeb - Controle Virtual de Processos
 * Versão 3.0 - Novembro de 2010
 *
 * app/views/helpers/cpweb_mask.php
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
 class CpwebMaskHelper extends Helper {

	/**
	 * Retorna um campo mascarado
	 * 
	 * @parameter string $tipo Tipo do Campo
	 * @parameter string $valor Valor do campo
	 * @return string $formatado campo formatado
	 */
	public function mask($tipo,$valor)
	{
		$formatado = $valor;
		swith($tipo)
		{
			case 'cpf': // 123.456.789-01 
				$_valor = str_replace('.','',$valor);
				$_valor = str_replace('-','',$valor);
				$_valor = str_replace('/','',$valor);
				$formatado = substr($_valor,1,3).'.'.substr($_valor,4,3).'.'.substr($_valor,7,3).'-'.substr($_valor,10,2);
				break;
			case 'cnpj': // 123.456.789/0123-45
				$_valor = str_replace('.','',$valor);
				$_valor = str_replace('-','',$valor);
				$_valor = str_replace('/','',$valor);
				$formatado = substr($_valor,1,3).'.'.substr($_valor,4,3).'.'.substr($_valor,7,3).'/'.substr($_valor,10,4).'-'.substr($_valor,14,2);
				break;
		}
		return $formatado;
	}
 
}
?>
