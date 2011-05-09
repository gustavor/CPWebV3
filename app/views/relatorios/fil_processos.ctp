<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));

	$dataFiltro['funcionario']['options']['label']['text'] 	= 'Funcionário';
	$dataFiltro['funcionario']['options']['default'] 		= 0;
	$dataFiltro['funcionario']['options']['style'] 			= 'width: 320px;';
	$dataFiltro['funcionario']['options']['empty'] 			= '-- escolha uma opção --';
	$dataFiltro['contato']['options']['default'] 			= 0;
	$dataFiltro['contato']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['contato']['options']['style'] 				= 'width: 320px;';
	$dataFiltro['departamento']['options']['label']['text'] = 'Departamento';
	$dataFiltro['departamento']['options']['default'] 		= 0;
	$dataFiltro['departamento']['options']['style'] 		= 'width: 320px;';
	$dataFiltro['departamento']['options']['empty'] 		= '-- escolha uma opção --';
	$dataFiltro['ordem']['options']['label']['text'] 		= 'Ordenar por';
	$dataFiltro['ordem']['options']['default'] 				= 0;
	$dataFiltro['ordem']['options']['style'] 				= 'width: 320px;';
	$dataFiltro['ordem']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['ordem']['options']['default'] 				= 'created';
	$dataFiltro['data_ini']['options']['label']['text']		= 'data Inicio';
	$dataFiltro['data_ini']['options']['div'] 				= null;
	$dataFiltro['data_ini']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_ini']['options']['monthNames'] 		= false;
	$dataFiltro['data_ini']['options']['interval']			= 3;
	$dataFiltro['data_ini']['options']['type'] 				= 'date';
	$dataFiltro['data_ini']['options']['value'] 			= strtotime('-5 days');
	$dataFiltro['data_fim']['options']['label']['text']		= 'data Fim';
	$dataFiltro['data_fim']['options']['div'] 				= null;
	$dataFiltro['data_fim']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_fim']['options']['monthNames'] 		= false;
	$dataFiltro['data_fim']['options']['year'] 				= 2012;
	$dataFiltro['data_fim']['options']['type'] 				= 'date';
	$dataFiltro['data_fim']['options']['value'] 			= strtotime('+30 days');
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
			<li><?php echo $this->Form->input('funcionario',$dataFiltro['funcionario']['options']); ?></li>
			<li><?php echo $this->Form->input('contato',$dataFiltro['contato']['options']); ?></li>
			<li><?php echo $this->Form->input('departamento',$dataFiltro['departamento']['options']); ?></li>
			<li><?php echo $this->Form->input('data_ini',$dataFiltro['data_ini']['options']); ?></li>
			<li><?php echo $this->Form->input('data_fim',$dataFiltro['data_fim']['options']); ?></li>
		</ul>
	</div>
	<br />
	<div id="ordem">
		<ul>
			<li><?php echo $this->Form->input('ordem',$dataOrdem['ordem']['options']); ?></li>
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
