<?php // menu principal ?>
<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>
	</li>

	<?php if (!in_array('minhas_solicitacoes',$this->Session->read('urlsNao')) && $this->Session->check( 'Auth.Usuario.id') ) : ?>
	<li><a href="<?php echo Router::url('/').'processos_solicitacoes/filtrar/usuario_atribuido:' . $this->Session->read( 'Auth.Usuario.id' ) . '/finalizada:0' ; ?>">Minhas Solicitações</a></li>
	<?php endif; ?>

	<?php if (!in_array('solicitacoes_departamentos',$this->Session->read('urlsNao')) && $this->Session->check( 'Auth.Usuario.departamento_id') ) : ?>
	<li><a href="<?php echo Router::url('/').'processos_solicitacoes/filtrar/departamento_id:' . $this->Session->read( 'Auth.Usuario.departamento_id') . '/finalizada:0'; ?>">Solicitações do Departamento</a></li>
	<?php endif; ?>

	<li>
		<a href="<?php echo Router::url('/').$this->Session->read('modul_ativo'); ?>">Módulos</a>
		<ul>

			<?php if (!in_array('advogados_contrarios',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'advogados_contrarios'; ?>">Cadastro de Advogados Contrários</a></li>
			<?php endif; ?>

			<?php if (!in_array('partes_contrarias',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'partes_contrarias'; ?>">Cadastro de Partes Contrárias</a></li>
			<?php endif; ?>

			<?php if (!in_array('clientes',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'clientes'; ?>">Cadastro de Clientes</a></li>
			<?php endif; ?>

			<?php if (!in_array('processos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'processos'; ?>">Controle de Processos</a></li>
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
