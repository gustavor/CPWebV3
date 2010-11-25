<div id='cabecalho'>
	<div id='logo_va'></div>
	<div id='texto_va'>
		<a href="<?php echo Router::url('/',true); ?>"><?php echo SISTEMA; ?></a><?php if(isset($pluralVar)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'">'.$pluralHumanName.'</a>'; if(isset($action)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'/'.mb_strtolower($action).'">'.ucfirst(mb_strtolower($action)).'</a>'; ?>

	</div>
</div>
