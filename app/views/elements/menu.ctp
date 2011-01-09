<?php // menu principal ?>
<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>
	</li>

	<li>
		<a href="<?php echo Router::url('/').$this->Session->read('modul_ativo'); ?>">Módulos</a>
		<ul>

			<?php if (!in_array('advogados_contrarios',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'advogados_contrarios'; ?>">Cadastro de Advogados Contrários</a></li>
			<?php endif; ?>

			<?php if (!in_array('clientes',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'clientes'; ?>">Cadastro de Clientes</a></li>
			<?php endif; ?>

			<?php if (!in_array('processos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'processos'; ?>">Controle de Processos</a></li>
			<?php endif; ?>

			<?php if (!in_array('solicitacoes',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'solicitacoes'; ?>">Cadastro de Solicitações</a></li>
			<?php endif; ?>

		</ul>
	</li>

<?php if (in_array('ADMINISTRADOR',$this->Session->read('perfis'))) : ?>
	<li>
		<?php $admin_ativo = ($this->Session->check('admin_ativo')) ? $this->Session->read('admin_ativo') : 'audiencias'; ?>
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
			<?php foreach($ferramentas as $_item => $_arrOpcoes) echo "\t".'<li><a href="'.$_arrOpcoes['url'].'">'.$_arrOpcoes['tit'].'</a></li>'."\n"; ?>
		</ul>
	</li>
<?php endif ?>

<?php if (isset($relatorios)) : ?>
	<li>
		<a href="#">Relatórios</a>
		<ul>
			<?php foreach($relatorios as $_item => $_arrOpcoes) echo "\t".'<li><a href="'.$_arrOpcoes['url'].'">'.$_arrOpcoes['tit'].'</a></li>'."\n"; ?>
		</ul>
	</li>
<?php endif ?>
	
	<li>
		<a href="#">Ajuda</a>
		<ul>
			<li><a href="<?php echo Router::url('/').'sobre'; ?>">Sobre</a></li>
			<?php if (isset($pluralHumanName) && isset($ajuda) ) : ?>
			<li><a href="<?php echo Router::url('/').$this->params['controller'].'/ajuda/sobre'; ?>">Sobre <?php echo $pluralHumanName; ?></a></li>
			<?php endif; ?>
		</ul>
	</li>
</ul>
