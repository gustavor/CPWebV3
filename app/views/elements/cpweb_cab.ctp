<h2>
	<img src='<?php echo Router::url('/',true); ?>img/advocacia.png' style='float: left; ' border='0' />
	<span>
		<a href="<?php echo Router::url('/',true); ?>">CPWeb</a><?php if(isset($pluralVar)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'">'.$pluralHumanName.'</a>'; if(isset($action)) echo ' : <a href="'.Router::url('/',true).$pluralVar.'/'.mb_strtolower($action).'">'.ucfirst(mb_strtolower($action)).'</a>'; ?>

	</span>
</h2>
