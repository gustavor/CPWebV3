<?php
	$this->Html->css('listar.css', null, array('inline' => false));
	$this->Html->css('relatorios.css', null, array('inline' => false));

    $dataFiltro['cliente']['options']['default'] 			= 0;
    $dataFiltro['cliente']['options']['empty'] 				= '-- escolha uma opção --';
    $dataFiltro['cliente']['options']['style'] 				= 'width: 320px;';

	$dataFiltro['usuario']['options']['default'] 			= 0;
	$dataFiltro['usuario']['options']['empty'] 				= '-- escolha uma opção --';
	$dataFiltro['usuario']['options']['style'] 				= 'width: 320px;';

    $dataFiltro['departamento']['options']['default'] 		= 0;
    $dataFiltro['departamento']['options']['empty'] 		= '-- escolha uma opção --';
    $dataFiltro['departamento']['options']['style'] 		= 'width: 320px;';

    $dataFiltro['tipoprocesso']['options']['label']['text'] = 'Tipo do Processo';
    $dataFiltro['tipoprocesso']['options']['default'] 		= 0;
    $dataFiltro['tipoprocesso']['options']['style'] 		= 'width: 320px;';

	$dataFiltro['solicitacao']['options']['label']['text'] 	= 'Solicitacao';
	$dataFiltro['solicitacao']['options']['default'] 		= 0;
    $dataFiltro['solicitacao']['options']['empty'] 		    = '-- escolha uma opção --';
	$dataFiltro['solicitacao']['options']['style']			= 'width: 326px;';

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
            <li><?php echo $this->Form->input('cliente',$dataFiltro['cliente']['options']); ?></li>
			<li><?php echo $this->Form->input('usuario',$dataFiltro['usuario']['options']); ?></li>
            <li><?php echo $this->Form->input('departamento',$dataFiltro['departamento']['options']); ?></li>
			<li><?php echo $this->Form->input('solicitacao',$dataFiltro['solicitacao']['options']); ?></li>
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
