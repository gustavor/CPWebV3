<?php echo $this->element('cpweb_cab'); ?>
<div id="logo"></div>
<div id='menu'>
	<h2>Temporário só pra teste.</h2>
<ul>
	<li><a href="<?php echo Router::url('/',true).'cidades'; ?>">Cidades</a></li>
	<li><a href="<?php echo Router::url('/',true).'estados'; ?>">Estados</a></li>
	<li><a href="<?php echo Router::url('/',true).'usuarios'; ?>">Usuários</a></li>
	<li><a href="<?php echo Router::url('/',true).'perfis'; ?>">Perfis</a></li>
</ul>
</div>
<?php $this->Html->css('painel.css', null, array('inline' => false)); ?>
