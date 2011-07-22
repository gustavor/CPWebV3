<?php $this->Html->script('jquery.meio.mask.1.1.3.js', array('inline' => false)); ?>
<div id='protocolo'>
	<center>
	<br /><br />
	<?php echo $this->Form->button('Novo Lote',		array('id'=>'btNovo', 		'class'=>'btProtocolo')); ?>
	<br /><br /><br />
	<div id='formConLote'>
		<?php echo $this->Form->create('protocolo', array('url'=>Router::url('/',true).'protocolos')); ?>
		<?php echo $this->Form->input('lote',array('label'=>array('text'=>'Código'))); ?>
		<br />
		<?php echo $this->Form->end('Consultar Lote'); ?>
	</div>
	<br /><br /><br />
	<div id='msg'>
	<?php if(isset($msg)) echo $msg; ?>
	</div>
	</center>
</div>
<?php 
	$on_read_view .= "\n".'$("#protocoloLote").focus();';
	$on_read_view .= "\n".'$("#protocoloLote").setMask("99/99/9999-9999");';
	$on_read_view .= "\n".'$("#btNovo").click(function() {window.location.href="'.Router::url('/',true).'lotes/novo"} );';
	include_once('../views/cpweb_crud/rodape.ctp');
?>
