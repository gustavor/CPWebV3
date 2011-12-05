<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));

	$dataFiltro['tipoprocesso']['options']['label']['text'] = 'Tipo de Processo';
	$dataFiltro['tipoprocesso']['options']['default'] 		= 0;
	$dataFiltro['tipoprocesso']['options']['empty'] 		= '-- escolha uma opção --';
	$dataFiltro['tipoprocesso']['options']['style']			= 'width: 326px;';

	$dataFiltro['contato']['options']['default'] 			= 0;
	$dataFiltro['contato']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['contato']['options']['style'] 				= 'width: 320px;';

	$dataFiltro['advogado']['options']['label']['text'] 	= 'Adv.Responsável';
	$dataFiltro['advogado']['options']['default'] 			= 0;
	$dataFiltro['advogado']['options']['empty'] 			= '-- escolha uma opção --';
	$dataFiltro['advogado']['options']['style'] 			= 'width: 320px;';
	$dataFiltro['advogado']['options']['options'] 			= $dataFiltro['usuario']['options']['options'];

	$dataFiltro['ordem']['options']['label']['text'] 		= 'Ordenar por';
	$dataFiltro['ordem']['options']['default'] 				= 0;
	$dataFiltro['ordem']['options']['style'] 				= 'width: 320px;';
	$dataFiltro['ordem']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['ordem']['options']['default'] 				= 'created';
	$dataFiltro['ordem']['options']['options'] 				= array('created'=>'Criado','modified'=>'Modificado');
	$dataFiltro['data_ini']['options']['label']['text']		= 'Início';
	$dataFiltro['data_ini']['options']['div'] 				= null;
	$dataFiltro['data_ini']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_ini']['options']['monthNames'] 		= false;
	$dataFiltro['data_ini']['options']['interval']			= 3;
	$dataFiltro['data_ini']['options']['type'] 				= 'date';
	$dataFiltro['data_ini']['options']['value'] 			= strtotime('today');
	$dataFiltro['data_fim']['options']['label']['text']		= 'Fim';
	$dataFiltro['data_fim']['options']['div'] 				= null;
	$dataFiltro['data_fim']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_fim']['options']['monthNames'] 		= false;
	$dataFiltro['data_fim']['options']['year'] 				= 2012;
	$dataFiltro['data_fim']['options']['type'] 				= 'date';
	$dataFiltro['data_fim']['options']['value'] 			= strtotime('+1 week');
?>

<div class="lista" id="listaRelatorios">

<div id="topo">

<div id="titulo"><?php echo $paramRelatorio['titulo']; ?></div>

</div>

<?php echo $this->element('menu_relatorios'); ?>

<div id="direita">

<?php echo $this->Form->create($action,array('url'=>array('controller'=>'relatorios','action'=>$action)))."\n"; ?>
<?php echo $this->Form->input('relatorio',array('value'=>$relatorio,'type'=>'hidden')); ?>

<div id="filtro">
	<div id="campos">
		<ul>
			<li><?php echo $this->Form->input('tipoprocesso',$dataFiltro['tipoprocesso']['options']); ?></li>
			<li><?php echo $this->Form->input('contato',$dataFiltro['contato']['options']); ?></li>
			<li><?php echo $this->Form->input('advogado',$dataFiltro['advogado']['options']); ?></li>
			<li><?php echo $this->Form->input('data_ini',$dataFiltro['data_ini']['options']); ?></li>
			<li><?php echo $this->Form->input('data_fim',$dataFiltro['data_fim']['options']); ?></li>
		</ul>
	</div>
	<br />
	<div id="ordem">
		<ul>
			<li><?php echo $this->Form->input('ordem',$dataFiltro['ordem']['options']); ?></li>
		</ul>
	</div>
	<br />
	<div id="botoes">
		<?php echo $this->Form->button('Enviar'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>

</div>

</div>
