<h2>
	<div id='logo_va'></div>
	<span>
		<a href="<?php echo Router::url('/',true); ?>"><?php echo SISTEMA; ?></a><?php if(isset($pluralVar)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'">'.$pluralHumanName.'</a>'; if(isset($action)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'/'.mb_strtolower($action).'">'.ucfirst(mb_strtolower($action)).'</a>'; ?>

	</span>
</h2>
