<div id="pesquisa">
	<span id="spPesquisa">Pesquisar</span>
	<?php
		$parametrosPesquisa				= array();
		$parametrosPesquisa['label'] 	= false;
		$parametrosPesquisa['div']		= false;
		$parametrosPesquisa['class']	= 'slPesquisa';
		$parametrosPesquisa['id']		= 'slPesquisa';
		$parametrosPesquisa['options']	= $camposPesquisa;
		$parametrosPesquisa['default'] 	= ($this->Session->check('campoPesquisa'.$pluralHumanName)) ? $this->Session->read('campoPesquisa'.$pluralHumanName) : false;
	?>
	<?php echo $this->Form->input('slPesquisa',$parametrosPesquisa); ?>
	<input type="text" name="inPesquisa" id="inPesquisa" class="inPesquisa" />
	<div id="rePesquisa"></div>
</div>
