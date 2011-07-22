<?php
	// menu ferramentas
	if ($this->Session->check( 'Auth.Usuario.id') && $this->Session->read('Auth.Usuario.id')==1)
	{
		$ferramentas[0]['url'] = Router::url('/',true).'popular';
		$ferramentas[0]['tit'] = 'Popular as tabelas';
	}
?>
<ul class="sf-menu">
	<li>
		<a href="<?php echo Router::url('/'); ?>">Principal</a>
	</li>

	<li>
		<a href="<?php echo Router::url('/').$this->Session->read('modul_ativo'); ?>">Módulos</a>
		<ul>

			<?php if (!in_array('contatos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'contatos'; ?>">Cadastro de Contatos</a></li>
			<?php endif; ?>

			<?php if (!in_array('processos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'processos'; ?>">Controle de Processos</a></li>
			<?php endif; ?>

			<?php if (!in_array('protocolos',$this->Session->read('urlsNao'))) : ?>
			<li><a href="<?php echo Router::url('/').'protocolos'; ?>">Protocolos</a></li>
			<?php endif; ?>

		</ul>
	</li>

</ul>
