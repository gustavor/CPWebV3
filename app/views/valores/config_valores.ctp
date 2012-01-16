<?php

	$campos['Valor']['data']['options']['label']['text'] 		= 'Data';
	$campos['Valor']['data']['options']['style'] 				= 'width: 100px; ';
	$campos['Valor']['data']['mascara'] 						= 'data';
	$campos['Valor']['data']['options']['dateFormat'] 			= 'DMY';

    $campos['Valor']['valor']['options']['label']['text'] 		= 'Valor';
    $campos['Valor']['valor']['options']['style'] 				= 'width: 200px; ';
	
	$campos['Valor']['evento']['options']['label']['text'] 	    = 'Evento';
	$campos['Valor']['evento']['options']['style'] 			    = 'width: 600px; text-transform: uppercase; ';

	$campos['Valor']['processo_id']['options']['type']      	= 'hidden';
	if (isset($processos)) $campos['Evento']['processo_id']['options']['options']	= $processos;

    $campos[$modelClass]['usuario_id']['options']['type']  	    	        = 'hidden';
    $campos['Usuario']['nome']['options']['label']['text'] 		            = 'Usuário Responsável';

	$campos['Valor']['tipo_valor_id']['options']['label']['text']       = 'Tipo';
	$campos['Valor']['tipo_valor_id']['options']['empty'] 	            = '-- escolha uma opção --';
	$campos['Valor']['tipo_valor_id']['options']['style']		        = 'width: 500px;';
	if (isset($tiposvalores)) $campos['Valor']['tipo_valor_id']['options']['options']	= $tiposvalores;

    $campos['TipoValor']['nome']['options']['label']['text'] = 'Tipo de Valor';
    $campos['Fase']['nome']['options']['label']['text'] = 'Fase do Processo';
    $campos[$modelClass]['fase_id']['options']['type']  	    	        = 'hidden';

	if ($action=='editar' || $action=='excluir')
	{
		$edicaoCampos = array('Valor.fase_id','Valor.data','Valor.processo_id','#','Valor.tipo_valor_id','#','Valor.valor','#','Valor.modified','#','Valor.created');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='imprimir')
	{
        $edicaoCampos = array('Valor.data','Valor.processo_id','#','Valor.tipo_valor_id','#','Valor.valor','#','Valor.modified','#','Valor.created');
	}

	if ($action=='novo')
	{
		$edicaoCampos = array('Valor.fase_id','Valor.data','Valor.processo_id','#','Valor.tipo_valor_id','#','Valor.valor','Valor.usuario_id');
		$botoesEdicao['Listar']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/listar/processo/'.$idProcesso.'\'';
	}

	if ($action=='editar' || $action=='listar')
	{
		$idProcesso = isset($this->params['pass'][1]) ? $this->params['pass'][1] : 0;
	}

	if ($action=='editar')
	{
        if (!in_array('ADMINISTRADOR',$this->Session->read('perfis')))
        {
            $botoesEdicao['Excluir'] 	= array();
            $listaFerramentas[2] = array();
        }

		if (isset($this->Form->data['Processo']['id']) && !empty($this->Form->data['Processo']['id']))
		{
			$redirecionamentos['Processo']['onclick'] 		= 'document.location.href=\''.Router::url('/',true).'processos/editar/'.$this->Form->data['Processo']['id'].'\'';
			//$edicaoCampos = array('Evento.data','Evento.processo_id','#','Evento.tipo_evento_id');
		}
		$botoesEdicao['Novo']['onClick'] = 'javascript:document.location.href=\''.Router::url('/',true).$name.'/novo/'.$this->Form->data['Processo']['id'].'\'';

        $padrao = array(
            'before'=> 'R$ ',
            'after' => '',
            'zero' => 'R$ 0,00',
            'places' => 2,
            'thousands' => '.',
            'decimals' => ',',
            'negative' => '()',
            'escape' => true
        );
        $this->Form->data['Valor']['valor'] = $this->Number->format($this->data['Valor']['valor'], $padrao);
	}

	if ($action=='listar')	
	{
		$listaCampos 								= array('Valor.data','TipoValor.nome','Fase.nome','Valor.valor','Usuario.nome');
        $padrao = array(
            'before'=> 'R$ ',
            'after' => '',
            'zero' => 'R$ 0,00',
            'places' => 2,
            'thousands' => '.',
            'decimals' => ',',
            'negative' => '()',
            'escape' => true
        );
        foreach($this->data as $linha => $arrayModelos)
        {
            foreach($arrayModelos as $modelo => $arrayCampos)
            {
                foreach($arrayCampos as $campo => $valor)
                {
                    if($campo == 'valor')
                    {
                        $this->data[$linha][$modelo][$campo] = $this->Number->format($this->data[$linha][$modelo][$campo],$padrao);
                    }
                }
            }
        }
	}
?>
