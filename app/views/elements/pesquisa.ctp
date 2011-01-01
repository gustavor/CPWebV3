<?php //exibe o formulário de pesquisa ?>
<div id="pesquisa">
	<span id="spPesquisa">Pesquisar</span>
	<?php
		$parametrosPesquisa				= array();
		$parametrosPesquisa['label'] 	= false;
		$parametrosPesquisa['div']		= false;
		$parametrosPesquisa['class']	= 'slPesquisa';
		$parametrosPesquisa['id']		= 'slPesquisa';
		$parametrosPesquisa['options']	= $camposPesquisa;
		$parametrosPesquisa['default'] 	= ($this->Session->check('campoPesquisa'.$name)) ? $this->Session->read('campoPesquisa'.$name) : false;
	?>
	<?php echo $this->Form->input('slPesquisa',$parametrosPesquisa); ?>
	<input type="text" name="inPesquisa" id="inPesquisa" class="inPesquisa" />
	<div id="rePesquisa"></div>
</div>
