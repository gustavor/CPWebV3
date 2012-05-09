<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));

    $dataFiltro['contato']['options']['style'] 				= 'width: 320px;';
    $dataFiltro['contato']['options']['empty']              = '-- escolha uma opção --';

    $dataFiltro['usuario']['options']['empty']              = '-- escolha uma opção --';
    $dataFiltro['usuario']['options']['label']['text']      = 'Adv. Responsável';

    $dataFiltro['tipoprocesso']['options']['label']['text'] = 'Tipo do Processo';
    $dataFiltro['tipoprocesso']['options']['default'] 		= 0;
    $dataFiltro['tipoprocesso']['options']['style'] 		= 'width: 320px;';

	$dataFiltro['data_ini']['options']['label']['text']		= 'Data Inicial';
	$dataFiltro['data_ini']['options']['div'] 				= null;
	$dataFiltro['data_ini']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_ini']['options']['monthNames'] 		= false;
	$dataFiltro['data_ini']['options']['interval']			= 3;
	$dataFiltro['data_ini']['options']['type'] 				= 'date';
	$dataFiltro['data_ini']['options']['value'] 			= strtotime('first day of this month');

	$dataFiltro['data_fim']['options']['label']['text']		= 'Data Final';
	$dataFiltro['data_fim']['options']['div'] 				= null;
	$dataFiltro['data_fim']['options']['dateFormat'] 		= 'DMY';
	$dataFiltro['data_fim']['options']['monthNames'] 		= false;
	$dataFiltro['data_fim']['options']['year'] 				= 2012;
	$dataFiltro['data_fim']['options']['type'] 				= 'date';
	$dataFiltro['data_fim']['options']['value'] 			= strtotime('last day of this month');
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
            <li><?php echo $this->Form->input('contato',$dataFiltro['contato']['options']); ?></li>
            <li><?php echo $this->Form->input('usuario',$dataFiltro['usuario']['options']); ?></li>
            <li><?php echo $this->Form->input('tipoprocesso',$dataFiltro['tipoprocesso']['options']); ?></li>
			<li><?php echo $this->Form->input('data_ini',$dataFiltro['data_ini']['options']); ?></li>
			<li><?php echo $this->Form->input('data_fim',$dataFiltro['data_fim']['options']); ?></li>
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
