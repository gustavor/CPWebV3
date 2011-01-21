<?php $this->Html->css('filtro.css', null, array('inline' => false)); ?>
<?php $arq = '../views/'.$name.'/config_'.$name.'.ctp'; if (file_exists($arq)) include_once($arq); ?>

<?php $url = Router::url('/',true).$name.'/relatorios/'.$relatorio; ?>

<br />
<h2><center><?php echo mb_strtoupper($titulo); ?></center></h2>

<?php echo $this->Form->create($modelClass,array('url'=>$url))."\n"; ?>
<div id="filtro">
	<div id="campos">
		<ul>
			<li><?php echo $this->Form->input('funcionario',$data['funcionario']['options']); ?></li>
			<li><?php echo $this->Form->input('cliente',$data['cliente']['options']); ?></li>
			<li><?php echo $this->Form->input('equipe',$data['equipe']['options']); ?></li>
			<li><?php echo $this->Form->input('data_ini',$data['data_ini']['options']); ?></li>
			<li><?php echo $this->Form->input('data_fim',$data['data_fim']['options']); ?></li>
		</ul>
	</div>
	<div id="botoes">
		<?php 
			echo $this->Form->button('Imprimir');
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<?php include_once('../views/cpweb_crud/rodape.ctp'); ?>
