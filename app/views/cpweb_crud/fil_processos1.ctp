<?php $this->Html->css('filtro.css', null, array('inline' => false)); ?>
<?php $arq = '../views/'.$name.'/config_'.$name.'.ctp'; if (file_exists($arq)) include_once($arq); ?>

<?php $url = Router::url('/',true).$name.'/relatorios/'.$relatorio; ?>
<?php echo $this->Form->create($modelClass,array('url'=>$url))."\n"; ?>
<div id="filtro">
	<div id="campos">
		<ul>
			<li><?php echo $this->Form->input('funcionario',array('div'=>null,'label'=>'Funcionários')); ?></li>
			<li><?php echo $this->Form->input('cliente',array('div'=>null,'label'=>'Cliente')); ?></li>
			<li><?php echo $this->Form->input('equipe',array('div'=>null,'label'=>'Funcionários')); ?></li>
			<li><?php echo $this->Form->input('data_ini',array('div'=>null,'label'=>'Data Início')); ?></li>
			<li><?php echo $this->Form->input('data_fim',array('div'=>null,'label'=>'Data Fim')); ?></li>
		</ul>
	</div>
	<div id="botoes">
		<?php echo $this->Form->button('Pdf'); ?>
		<?php echo $this->Form->button('Xls'); ?>
		<?php echo $this->Form->button('Csv'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
