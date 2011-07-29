<?php 
	$codigo = isset($this->data[0]['Lote']['codigo']) ? $this->data[0]['Lote']['codigo'] : '';
	echo $this->Form->create($modelClass, array('url'=>Router::url('/',true).'lotes_processos_solicitacoes/listar/lote:'.$idLote));
	echo $this->Form->input('Lote.codigo',array('type'=>'hidden','value'=>$codigo));
	echo $this->Form->input('Lote.tipo',array('type'=>'hidden','value'=>'edicao'));
?>

<?php $on_read_view .= "\n".'$("#btEdicaoImprimir").click(function() { $("#LoteTipo").val("imprimir"); });'; ?>
<?php $on_read_view .= "\n".'$("#btEdicaoImprimir2").click(function() { $("#LoteTipo").val("imprimir2"); });'; ?>
<?php $on_read_view .= "\n".'$("#btEdicaoSalvar").click(function() { $("#LoteTipo").val(""); });'; ?>

<div id='erros' style='color: red; font-weight: bold; text-align: center;'><?php if (isset($erros)) echo $erros; ?></div>
<div id='lote' style='position: absolute; left: 400px; font-weight: bold; margin: 10px auto; text-align: center;'>
<input type='hidden' value='<?php echo $idLote;  ?>' name='data[ProcessoSolicitacao][lote]' id='data[ProcessoSolicitacao][lote]' />
<?php echo 'CÓDIGO LOTE: '.$codigo ?>
</div>
<?php require_once('../views/cpweb_crud/listar.ctp'); ?>
<?php echo $this->Form->end(); ?>
