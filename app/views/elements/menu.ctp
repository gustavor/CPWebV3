
<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>

	</li>
	<li>
		<a href="#">Tabelas</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'cidades'; ?>" class="subLinha">Cidades</a></li>
			<li><a href="<?php echo Router::url('/').'estados'; ?>">Estados</a></li>
			<li><a href="<?php echo Router::url('/').'usuarios'; ?>">Usuários</a></li>
			<li><a href="<?php echo Router::url('/').'perfis'; ?>">Perfis</a></li>
		</ul>
	</li>

	<li>
		<a href="#">Ferramentas</a>
		<ul>
			<li><a href="#">Fer1</a></li>
			<li><a href="#">Fer2</a></li>
		</ul>
	</li>
	<li>
		<a href="#">Relatórios</a>
		<ul>
			<li><a href="#">Rel1</a></li>
			<li><a href="#">Rel2</a></li>
		</ul>
	</li>
	<li>
		<a href="#">Ajuda</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'sobre'; ?>">Sobre</a></li>
		</ul>
	</li>
</ul>
