<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>
	</li>

	<li>
		<a href="<?php echo Router::url('/').$this->Session->read('modul_ativo'); ?>">Módulos</a>
		<ul>
			<?php if (!in_array('clientes',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'clientes'; ?>">Clientes</a></li>
			<?php endif; ?>
			
			<?php if (!in_array('processos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'processos'; ?>">Processos</a></li>
			<?php endif; ?>
		</ul>
	</li>

<?php if (in_array('ADMINISTRADOR',$this->Session->read('perfis'))) : ?>
	<li>
		<?php $admin_ativo = ($this->Session->check('admin_ativo')) ? $this->Session->read('admin_ativo') : 'advogados'; ?>
		<a href="<?php echo Router::url('/').$admin_ativo; ?>">Administração</a>
	</li>
	<li>
		<a href="<?php echo Router::url('/').$this->Session->read('siste_ativo'); ?>">Sistema</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'perfis'; ?>">Perfils</a></li>
			<li><a href="<?php echo Router::url('/').'urls'; ?>">Urls</a></li>
			<li><a href="<?php echo Router::url('/').'usuarios'; ?>">Usuários</a></li>
		</ul>
	</li>
<?php endif ?>

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
