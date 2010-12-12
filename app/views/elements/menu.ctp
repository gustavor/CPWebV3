
<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>

	</li>

	<li>
		<a href="#">Módulos</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'clientes'; ?>">Clientes</a></li>
		</ul>
	</li>

	<li>
		<a href="<?php echo Router::url('/').'usuarios'; ?>">Administração</a>
	</li>

<?php if (isset($ferramentas)) : ?>
	<li>
		<a href="#">Ferramentas</a>
		<ul>
			<li><a href="#">Fer1</a></li>
			<li><a href="#">Fer2</a></li>
		</ul>
	</li>
<?php endif ?>

<?php if (isset($ferramentas)) : ?>
	<li>
		<a href="#">Relatórios</a>
		<ul>
			<li><a href="#">Rel1</a></li>
			<li><a href="#">Rel2</a></li>
		</ul>
	</li>
<?php endif ?>
	
	<li>
		<a href="#">Ajuda</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'sobre'; ?>">Sobre</a></li>
		</ul>
	</li>
</ul>
