<?php
	foreach($this->data as $_linha => $_arrModel)
	{
		$idProt		= $_arrModel['LoteProcessoSolicitacao']['id'];
		$idInProt	= '$("#data[ProcessoSolicitacao][prot]['.$idProt.']")';
		$idCxProt	= '$("#data['.$idProt.'][ProcessoSolicitacao][id]")';

		//$on_read_view .= "\n".$idCxProt.".click( alert('oi'); );";
	}
?>
<?php $codigo = isset($this->data[0]['Lote']['codigo']) ? $this->data[0]['Lote']['codigo'] : ''; ?>
<?php echo $this->Form->create($modelClass, array('url'=>Router::url('/',true).'lotes_processos_solicitacoes/listar/lote:'.$idLote)); ?>
<div id='erros' style='color: red; font-weight: bold; text-align: center;'><?php if (isset($erros)) echo $erros; ?></div>
<div id='lote' style='position: absolute; left: 300px; font-weight: bold; margin: 10px auto; text-align: center;'>
<input type='hidden' value='<?php echo $idLote;  ?>' name='data[ProcessoSolicitacao][lote]' id='data[ProcessoSolicitacao][lote]' />
<?php echo 'Código: '.$codigo ?>
</div>
<?php require_once('../views/cpweb_crud/listar.ctp'); ?>
<?php echo $this->Form->end(); ?>
