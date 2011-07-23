<?php	

	$campos['Historico']['tipo_historico_id']['label']['text']		= 'Tipo';
	if (isset($tipos_historicos)) $campos['Historico']['tipo_historico_id']['options']['options'] = $tipos_historicos;

	$campos['Historico']['processo_id']['label']['text']			= 'Processo';
	$campos['Historico']['processo_id']['options']['type']			= 'text';

	$campos['Historico']['usuario_id']['label']['text']				= 'Usuário';
	$campos['Historico']['usuario_id']['options']['type']			= 'text';

	$campos['Historico']['texto']['options']['label']['text']		= 'Texto';
	$campos['Historico']['texto']['estilo_th'] 						= 'width="600px";';
	$campos['Historico']['texto']['thOff']							= true;
	$campos['Historico']['texto']['link_off']						= true;

	$campos['Historico']['created']['link_off']						= true;

	$edicaoCampos 	= array('Historico.tipo_historico_id','#','Historico.processo_id','#','Historico.usuario_id');

	$on_read_view .= "\n".'$("#formFerramentas").fadeOut();';

	$botoesEdicao 		= array();
	
	// atualizando formulário
	if (in_array($this->action,array('emprestimo','devolucao','remessa')))
	{
		$on_read_view .= "\n".'$("#HistoricoProcessoId").focus();';
		$on_read_view .= "\n".'$("input").blur(function () {setValidaFormHistoricoEmprestimo(); });';
	}	
	if ($this->action == 'emprestimo')
	{
		$campos['Historico']['tipo_historico_id']['options']['default'] = 1;
	}
	if ($this->action == 'devolucao')
	{
		$campos['Historico']['tipo_historico_id']['options']['default'] = 2;
	}
	if ($this->action == 'remessa')
	{
		$campos['Historico']['tipo_historico_id']['options']['default'] = 3;
	}

	// zerando o formulário, pois este aqui é só para criar
	if ($this->data)
	{
		$this->Form->data['tipo_historico_id']['processo_id'] 	= '';
		$this->Form->data['Historico']['processo_id'] 	= '';
		$this->Form->data['Historico']['usuario_id'] 	= '';
	}
?>
