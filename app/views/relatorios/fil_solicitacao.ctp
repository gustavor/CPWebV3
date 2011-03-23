<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));

	$dataFiltro['cliente']['options']['default'] 			= 0;
	$dataFiltro['cliente']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['cliente']['options']['style'] 				= 'width: 320px;';

	$dataFiltro['solicitacao']['options']['label']['text'] 	= 'Solicitacao';
	$dataFiltro['solicitacao']['options']['default'] 		= 0;
	$dataFiltro['solicitacao']['options']['disabled'] 		= 'disabled';
	$dataFiltro['solicitacao']['options']['value'] 			= $relatorio;

	$dataFiltro['ordem']['options']['label']['text'] 		= 'Ordenar por';
	$dataFiltro['ordem']['options']['default'] 				= 0;
	$dataFiltro['ordem']['options']['style'] 				= 'width: 320px;';
	$dataFiltro['ordem']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['ordem']['options']['default'] 				= 'created';
	$dataFiltro['ordem']['options']['options'] 				= array('created'=>'Criado','distribuicao'=>'Distribuição');
	$dataFiltro['data_ini']['options']['label']['text']		= 'data Inicio';
	$dataFiltro['data_ini']['options']['div'] 				= null;
	$dataFiltro['data_ini']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_ini']['options']['monthNames'] 		= false;
	$dataFiltro['data_ini']['options']['interval']			= 3;
	$dataFiltro['data_ini']['options']['type'] 				= 'date';
	$dataFiltro['data_ini']['options']['value'] 			= strtotime('-1 year');
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
			<li><?php echo $this->Form->input('cliente',$dataFiltro['cliente']['options']); ?></li>
			<li><?php echo $this->Form->input('solicitacao',$dataFiltro['solicitacao']['options']); ?></li>
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
